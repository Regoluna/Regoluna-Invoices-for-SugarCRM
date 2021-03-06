<?php
require_once('include/DetailView/DetailView2.php');
require_once('modules/reg_companies/reg_companies.php');

abstract class InvoiceView extends SugarView{

  var $options = array('to_pdf' => true, 'show_javascript'=>false);
  var $ss;

  var $defaultNumericFormat = '%01.2F';
  var $specialNumericFormat = array();

  protected $infoItems;
  protected $infoTaxes;
  protected $infoTaxesWithheld;
  protected $infoInvoice;
  protected $buyerInfo;
  protected $sellerInfo;
  protected $issuer;

  // On pre display, calculates values for templates.
  function preDisplay(){
    global $app_list_strings;
    
    $this->issuer = $this->getIssuerCompany();
    
    parent::preDisplay();
    $this->calcularInfo();
    $this->infoParties();
  }

  function infoParties(){
    global $sugar_config;
    
    $issuer = $this->issuer;
    
    $this->sellerInfo = array(
      'PersonTypeCode'=>$issuer->type,
      'ResidenceTypeCode'=>$issuer->residence,
      'TaxIdentificationNumber'=>$issuer->nif,
      'Address'=>$issuer->billing_address_street,
      'PostCode'=>$issuer->billing_address_postalcode,
      'Town'=>$issuer->billing_address_city,
      'Province'=>$issuer->billing_address_state,
      'CountryCode'=>$issuer->billing_address_country,
    );

    // Names and other attributes depends on person type
    if( $issuer->type=='F' ){
      $this->sellerInfo['Name']= $issuer->name;
      $this->sellerInfo['FirstSurname']= $issuer->name2;
      $this->sellerInfo['SecondSurname']= $issuer->name3;
    }else{
      $this->sellerInfo['CorporateName']= $issuer->name;
      //$this->sellerInfo['TradeName']= $issuer->name2;
      //$this->sellerInfo['RegistrationData']= $issuer->name3;
    }

    $account = new Account();
    $account->retrieve($this->bean->account_id);

    $nif_field = ($sugar_config['fact_account_nif_field'])? $sugar_config['fact_account_nif_field'] : 'nonexistenfield' ;
    $this->buyerInfo = array(
      'PersonTypeCode'=>'J',  // @todo Introducir el.type.de cuenta en "Cliente" según Facturae
      'ResidenceTypeCode'=>'R',  // @todo Introducir el.type.de residencia en "Cliente" según Facturae
      'TaxIdentificationNumber'=> !empty($account->$nif_field)?$account->$nif_field:'000000',
      'CorporateName'=>$account->name,
      'Address'=>$account->billing_address_street,
      'PostCode'=>($account->billing_address_postalcode)?$account->billing_address_postalcode:'00000',
      'Town'=>$account->billing_address_city,
      'Province'=>$account->billing_address_state,
      'CountryCode'=>'ESP',   // @todo Introducir Pais en "Cliente" según Facturae
    );


  }
  
  protected function getIssuerCompany(){
    $issuer = new reg_companies();
    
    if( !empty($this->bean->issuer_id) ){
      $issuer->retrieve($this->bean->issuer_id);
    }
    
    if( empty($issuer->id) ){
      $issuer->retrieveDefault();
    }
    
    return $issuer;
  }

  // Calculamos la información que se mostrará en las facturas PDF y Facturae
  // Esta información surge de analizar uno por uno los distintos ITEMS
  function calcularInfo(){

    // Rellenamos alguna informacion de la factura.
    // el resto saldrá de repasar los Items
    $this->infoInvoice=array(
      'Number'=>$this->bean->number,
      'IssueDate'=>$this->date($this->bean->date_closed),
      'Total'=>$this->num($this->bean->amount,'Total'),
      'TotalGrossAmount'=>$this->num($this->bean->total_items,'TotalGrossAmount'),
      'TotalGrossAmountBeforeTaxes'=>$this->num($this->bean->total_items,'TotalGrossAmountBeforeTaxes'),
      'TotalTaxOutputs'=>$this->num(0,'TotalTaxOutputs'), // Se calcula al repasar los items
      'TotalTaxesWithheld'=>$this->num(0,'TotalTaxesWithheld'), // Se calcula al repasar los items
    );

    $sql = " select *".
           " from reg_items i ".
           " where deleted=0 AND invoice_id = '".$this->bean->id."' ORDER BY ordered ASC";
    $result = $this->bean->db->query($sql);

    // Procesamos las filas de Items para calcular los totales.
    while($row = $this->bean->db->fetchByAssoc($result)){
      $this->addToInfo($row);
    }
  }

  // Añade la información de un Item a la información general de la factura
  // para la visualizacion posterior en PDF o Facturae
  function addToInfo($row){
    global $app_list_strings;

    $item = array(
        'ItemDescription'=>$row['name'],
        'Quantity'=>$this->num($row['qty'],'Quantity'),
        'UnitOfMeasure'=> $this->getUnit($row['unit']),
        'UnitOfMeasure_PDF'=> ($row['custom_unit'])? $row['custom_unit'] : $this->getUnit($row['unit']),
        'UnitPriceWithoutTax'=>$this->num($row['unit_price'],'UnitPriceWithoutTax'),
        'TotalCost'=>$this->num($row['unit_price']*$row['qty'],'TotalCost'),
        'GrossAmount'=>$this->num($row['total_base'],'GrossAmount'),
        'TaxableBase'=>$this->num($row['total_base'],'TaxableBase'),
      );

    // Si se ha escrito una descripción, la ponemos
    if($row['description']){
      $item['AdditionalLineItemInformation']=$row['description'];
    }

    // Si tiene descuentos, añadimos una nueva entrada:
    if($row['total_discount']){
      $item['DiscountAmount']=$this->num($row['total_discount'],'DiscountAmount');
    }

    // Si no tiene sus propios impuestos, le aplicamos los generales
    if( $row['tax']>0 &&  ($row['tax_type'] != $this->bean->tax_type || $row['tax'] != $this->bean->output_tax) ) {
      $item['TaxRate']=$this->num($row['tax'],'TaxRate');
      $item['TaxAmount']=$this->num($row['total_tax'],'TaxAmount');
      $item['TaxTypeCode']=$row['tax_type'];
      $item['TaxTypeName']=$app_list_strings['reg_tax_type_dom'][$row['tax_type']];
    }else{
      $item['TaxRate']=$this->num($this->bean->output_tax,'TaxRate');
      $item['TaxAmount']=$this->num($row['total_base']*$this->bean->output_tax/100,'TaxAmount');
      $item['TaxTypeCode']=$this->bean->tax_type;
      $item['TaxTypeName']=$app_list_strings['reg_tax_type_dom'][$this->bean->tax_type];
    }

    // Si no tiene.retention.por item, aplicamos el general ( Si existe; es opcional )
    if($row['retention']>0 && ($row['retention'] != $this->bean->retention) ) {
      $item['retention']=array(
        'TaxRate'=>$this->num($row['retention'],'TaxRate'),
        'TaxableBase'=>$this->num($row['total_base']),
        'TaxAmount'=>$this->num($row['total_retention']),
        'TaxTypeCode'=>'04',
      );
    }else{
      if(!empty($this->bean->retention)){
        $item['retention']=array(
          'TaxRate'=>$this->num($this->bean->retention,'TaxRate'),
          'TaxableBase'=>$this->num($row['total_base']),
          'TaxAmount'=>$this->num($row['total_base']*$this->bean->retention/100),
          'TaxTypeCode'=>'04',
        );
      }
    }

    // Añadimos el impuesto.output_tax.a la lista de impuestos de la factura
    $this->AddToTaxes($item);

    // Si el item tiene retención, lo añadimos a la lista de impuestos retenidos de la factura
    if( !empty($item['retention'])) $this->AddToTaxesWithheld($item['retention']);

    // Finalmente, añadimos el nuevo Item Creado al Array
    $this->infoItems[] = $item;

  } // AddToInfo

  function AddToTaxes($tax){
    global $app_list_strings;
    $index=$tax['TaxTypeCode'].'-'.$tax['TaxRate'];
    $this->infoTaxes[$index]['TaxTypeCode']=$tax['TaxTypeCode'];
    $this->infoTaxes[$index]['TaxRate']=$tax['TaxRate'];
    $this->infoTaxes[$index]['TaxTypeName']=$app_list_strings['reg_tax_type_dom'][$tax['TaxTypeCode']];
    
    if( !empty($tax['TaxableBase']) && empty($this->infoTaxes[$index]['TaxableBase']) ) $this->infoTaxes[$index]['TaxableBase'] = 0;
    $this->infoTaxes[$index]['TaxableBase']=$this->num($tax['TaxableBase']+$this->infoTaxes[$index]['TaxableBase']);
    
    if( !empty($tax['TaxAmount']) && empty($this->infoTaxes[$index]['TaxAmount']) ) $this->infoTaxes[$index]['TaxAmount'] = 0;
    $this->infoTaxes[$index]['TaxAmount']=$this->num($tax['TaxAmount']+$this->infoTaxes[$index]['TaxAmount']);

    $this->infoInvoice['TotalTaxOutputs']=$this->num($this->infoInvoice['TotalTaxOutputs'] + $tax['TaxAmount'],'TotalTaxOutputs');

  } // AddToTaxes

  function AddToTaxesWithheld($tax){
    global $app_list_strings;
    $index=$tax['TaxTypeCode'].'-'.$tax['TaxRate'];
    $this->infoTaxesWithheld[$index]['TaxTypeCode']=$tax['TaxTypeCode'];
    $this->infoTaxesWithheld[$index]['TaxRate']=$tax['TaxRate'];
    $this->infoTaxesWithheld[$index]['TaxableBase']=$this->num($this->infoTaxesWithheld[$index]['TaxableBase']+$tax['TaxableBase']);
    $this->infoTaxesWithheld[$index]['TaxAmount']=$this->num($this->infoTaxesWithheld[$index]['TaxAmount']+$tax['TaxAmount']);
    $this->infoTaxesWithheld[$index]['TaxTypeName']=$app_list_strings['reg_tax_type_dom'][$tax['TaxTypeCode']];

    $this->infoInvoice['TotalTaxesWithheld']=$this->num( $this->infoInvoice['TotalTaxesWithheld'] + $tax['TaxAmount'],'TotalTaxesWithheld');
  } // AddToRetenciones

  // Display correct numeric values
  // This function must be overloaded to change precission but not format
  protected function num($num,$name=null){
    if(!is_numeric($num)){
      $num=0;
    }

    if($this->specialNumericFormat[$name]){
      return sprintf($this->specialNumericFormat[$name],$num);
    }else{
      return sprintf($this->defaultNumericFormat,$num);
    }
  }

  /**
   * Esta función puede sobreescribirse para cambiar los formatos de fecha.
   */
  protected function date($date){
    return $date;
  }

  // Get unit name from code
  function getUnit($unit){
    return $unit;
  }

}