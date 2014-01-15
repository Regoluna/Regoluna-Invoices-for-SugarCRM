<?php
require_once('include/DetailView/DetailView2.php');

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
  
  // On pre display, calculates values for templates.
  function preDisplay(){
    global $app_list_strings;
    
    parent::preDisplay();
    $this->calcularInfo();
    $this->infoParties();
  }
  
  function infoParties(){
    global $sugar_config;
    $this->sellerInfo = array(
      'PersonTypeCode'=>$sugar_config['fact_person_type_code'],
      'ResidenceTypeCode'=>$sugar_config['fact_residence_type_code'],
      'TaxIdentificationNumber'=>$sugar_config['fact_tax_number'],
      'Address'=>$sugar_config['fact_address'],  
      'PostCode'=>$sugar_config['fact_post_code'],  
      'Town'=>$sugar_config['fact_town'],  
      'Province'=>$sugar_config['fact_province'],  
      'CountryCode'=>$sugar_config['fact_country_code'],  
    );
    
    // Names and other attributes depends on person type
    if($sugar_config['fact_person_type_code']=='F'){
      $this->sellerInfo['Name']= $sugar_config['fact_corporate_name'];
      $this->sellerInfo['FirstSurname']= $sugar_config['fact_trade_name_surname1'];
      $this->sellerInfo['SecondSurname']= $sugar_config['fact_registration_surname2'];
    }else{
      $this->sellerInfo['CorporateName']= $sugar_config['fact_corporate_name'];
      $this->sellerInfo['TradeName']= $sugar_config['fact_trade_name_surname1'];
      $this->sellerInfo['RegistrationData']= $sugar_config['fact_registration_surname2'];
    }
    
    $this->bean->load_relationship('accounts_fact_facturas');
    $account = new Account();
    $account->retrieve($this->bean->accounts_f4ffcccounts_ida);
    
    $nif_field = ($sugar_config['fact_account_nif_field'])? $sugar_config['fact_account_nif_field'] : 'nonexistenfield' ;
    $this->buyerInfo = array(
      'PersonTypeCode'=>'J',  // @todo Introducir el tipo de cuenta en "Cliente" según Facturae
      'ResidenceTypeCode'=>'R',  // @todo Introducir el tipo de residencia en "Cliente" según Facturae
      'TaxIdentificationNumber'=> ($account->$nif_field)?$account->$nif_field:'000000',
      'CorporateName'=>$account->name,
      'Address'=>$account->billing_address_street,
      'PostCode'=>($account->billing_address_postalcode)?$account->billing_address_postalcode:'00000',
      'Town'=>$account->billing_address_city,
      'Province'=>$account->billing_address_state,
      'CountryCode'=>'ESP',   // @todo Introducir Pais en "Cliente" según Facturae
    ); 
    
    
  }
  
  // Calculamos la información que se mostrará en las facturas PDF y Facturae
  // Esta información surge de analizar uno por uno los distintos ITEMS
  function calcularInfo(){

    // Rellenamos alguna informacion de la factura.
    // el resto saldrá de repasar los Items
    $this->infoInvoice=array(
      'Number'=>$this->bean->numero,
      'IssueDate'=>$this->date($this->bean->date_closed),
      'Total'=>$this->num($this->bean->amount,'Total'),
      'TotalGrossAmount'=>$this->num($this->bean->total_items,'TotalGrossAmount'),
      'TotalGrossAmountBeforeTaxes'=>$this->num($this->bean->total_items,'TotalGrossAmountBeforeTaxes'),
      'TotalTaxOutputs'=>$this->num(0,'TotalTaxOutputs'), // Se calcula al repasar los items
      'TotalTaxesWithheld'=>$this->num(0,'TotalTaxesWithheld'), // Se calcula al repasar los items
    );
    
    $sql = " select *".
           " from fact_items i JOIN fact_factura_items f ON (i.id=f.item_id AND f.deleted=0) ".
           " where i.deleted=0 AND factura_id = '".$this->bean->id."' ORDER BY i.orden ASC"; 
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
        'Quantity'=>$this->num($row['cantidad'],'Quantity'),
        'UnitOfMeasure'=> $this->getUnit($row['unidad']),
        'UnitOfMeasure_PDF'=> ($row['unidad_custom'])? $row['unidad_custom'] : $this->getUnit($row['unidad']),
        'UnitPriceWithoutTax'=>$this->num($row['precio_ud'],'UnitPriceWithoutTax'),
        'TotalCost'=>$this->num($row['precio_ud']*$row['cantidad'],'TotalCost'),
        'GrossAmount'=>$this->num($row['total_antes'],'GrossAmount'),
        'TaxableBase'=>$this->num($row['total_antes'],'TaxableBase'),  
      );
      
    // Si se ha escrito una descripción, la ponemos
    if($row['description']){
      $item['AdditionalLineItemInformation']=$row['description'];
    }
      
    // Si tiene descuentos, añadimos una nueva entrada:
    if($row['total_descuento']){
      $item['DiscountAmount']=$this->num($row['total_descuento'],'DiscountAmount');
    }
    
    // Si no tiene sus propios impuestos, le aplicamos los generales
    if( $row['impuesto']>0 &&  ($row['tipo_repercutido'] != $this->bean->tipo_repercutido || $row['impuesto'] != $this->bean->repercutido) ) {
      $item['TaxRate']=$this->num($row['impuesto'],'TaxRate');
      $item['TaxAmount']=$this->num($row['total_impuesto'],'TaxAmount');  
      $item['TaxTypeCode']=$row['tipo_repercutido'];  
      $item['TaxTypeName']=$app_list_strings['tipo_impuesto_dom'][$row['tipo_repercutido']];
    }else{
      $item['TaxRate']=$this->num($this->bean->repercutido,'TaxRate');
      $item['TaxAmount']=$this->num($row['total_antes']*$this->bean->repercutido/100,'TaxAmount');  
      $item['TaxTypeCode']=$this->bean->tipo_repercutido;  
      $item['TaxTypeName']=$app_list_strings['tipo_impuesto_dom'][$this->bean->tipo_repercutido];
    }
    
    // Si no tiene retencion por item, aplicamos el general ( Si existe; es opcional )
    if( $row['retencion']>0 && ($row['retencion'] != $this->bean->retencion) ) {
      $item['retencion']=array(
        'TaxRate'=>$this->num($row['retencion'],'TaxRate'),
        'TaxableBase'=>$this->num($row['total_antes']),
        'TaxAmount'=>$this->num($row['total_retencion']),
        'TaxTypeCode'=>'04',
      );
    }else{
      if($this->bean->retencion){
        $item['retencion']=array(
          'TaxRate'=>$this->num($this->bean->retencion,'TaxRate'),
          'TaxableBase'=>$this->num($row['total_antes']),
          'TaxAmount'=>$this->num($row['total_antes']*$this->bean->retencion/100),
          'TaxTypeCode'=>'04',
        );
      }
    }
    
    // Añadimos el impuesto repercutido a la lista de impuestos de la factura
    $this->AddToTaxes($item);
    
    // Si el item tiene retención, lo añadimos a la lista de impuestos retenidos de la factura
    if($item['retencion']) $this->AddToTaxesWithheld($item['retencion']);
    
    // Finalmente, añadimos el nuevo Item Creado al Array
    $this->infoItems[] = $item;
    
  } // AddToInfo
  
  function AddToTaxes($tax){    
    global $app_list_strings;
    $index=$tax['TaxTypeCode'].'-'.$tax['TaxRate'];
    $this->infoTaxes[$index]['TaxTypeCode']=$tax['TaxTypeCode'];
    $this->infoTaxes[$index]['TaxRate']=$tax['TaxRate'];
    $this->infoTaxes[$index]['TaxableBase']=$this->num($tax['TaxableBase']+$this->infoTaxes[$index]['TaxableBase']);
    $this->infoTaxes[$index]['TaxAmount']=$this->num($tax['TaxAmount']+$this->infoTaxes[$index]['TaxAmount']);
    $this->infoTaxes[$index]['TaxTypeName']=$app_list_strings['tipo_impuesto_dom'][$tax['TaxTypeCode']];
    
    $this->infoInvoice['TotalTaxOutputs']=$this->num($this->infoInvoice['TotalTaxOutputs'] + $tax['TaxAmount'],'TotalTaxOutputs');
    
  } // AddToTaxes
  
  function AddToTaxesWithheld($tax){    
    global $app_list_strings;
    $index=$tax['TaxTypeCode'].'-'.$tax['TaxRate'];
    $this->infoTaxesWithheld[$index]['TaxTypeCode']=$tax['TaxTypeCode'];
    $this->infoTaxesWithheld[$index]['TaxRate']=$tax['TaxRate'];
    $this->infoTaxesWithheld[$index]['TaxableBase']=$this->num($this->infoTaxesWithheld[$index]['TaxableBase']+$tax['TaxableBase']);
    $this->infoTaxesWithheld[$index]['TaxAmount']=$this->num($this->infoTaxesWithheld[$index]['TaxAmount']+$tax['TaxAmount']);
    $this->infoTaxesWithheld[$index]['TaxTypeName']=$app_list_strings['tipo_impuesto_dom'][$tax['TaxTypeCode']];
    
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
  function getUnit($unidad){
    return $unidad;
  }
  
}