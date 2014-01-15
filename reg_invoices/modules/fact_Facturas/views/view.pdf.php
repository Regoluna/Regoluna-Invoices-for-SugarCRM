<?php
require_once('modules/fact_Facturas/views/InvoiceView.php');

class fact_FacturasViewPdf extends InvoiceView{
  
  var $specialNumericFormat = array(
    'Quantity'=>"%s",
    'TaxRate'=>"%s",
  );
  
  var $units = array(
    '01' => 'Uds',
    '02' => 'h',
    '03' => 'Kg',
    '04' => 'L',
    '05' => 'Otros',
    '06' => 'Cajas',
    '07' => 'Bandejas',
    '08' => 'Barriles',
    '09' => 'Bidones',
    '10' => 'Bolsas',
    '11' => 'Bombonas',
    '12' => 'Botellas',
    '13' => 'Botes',
    '14' => 'Briks',
    '15' => 'Cl',
    '16' => 'Cm',
    '17' => 'Cubos',
    '18' => 'Doc.',
    '19' => 'Estuches-',
    '20' => 'Garrafas',
    '21' => 'gr',
    '22' => 'Km',
    '23' => 'Latas',
    '24' => 'Manojos',
    '25' => 'm',
    '26' => 'mm',
    '27' => '6-Pack',
    '28' => 'Paq.',
    '29' => 'Raciones',
    '30' => 'Rollos',
    '31' => 'Sobres',
    '32' => 'Tarrinas',
    '33' => 'm²',
    '34' => 'seg',
    '35' => 'W',
  );
  
  
  function display(){
    require_once('include/html2pdf/html2pdf.class.php');
    global $app_list_strings;
    global $sugar_config;
    
    $this->ss=new Sugar_Smarty();
    $this->ss->left_delimiter = '{{';
    $this->ss->right_delimiter = '}}';

    // **********************************
    // Campos no Facturae (para el PDF)
    // **********************************
    
    // Indica si es factura, presupuesto ect...
    $this->ss->assign("Tipo",$app_list_strings['fact_facturas_type_dom'][$this->bean->fact_facturas_type]);
    // Descripcion de la factura
    if(trim($this->bean->description)){
      $this->ss->assign("Descripcion",from_html($this->bean->description));
    }
    // Condiciones generales
    if(trim($this->bean->condiciones)){
      $this->ss->assign("Condiciones",from_html($this->bean->condiciones));
    }
    // Logo (definir en config.php)
    $ruta_logo = $sugar_config['fact_path_to_logo'];
    if($ruta_logo && file_exists($ruta_logo) ){
      $this->ss->assign("Logo",$ruta_logo);
    }else if(file_exists('themes/Sugar/images/company_logo.png') ){
      $this->ss->assign("Logo",'themes/Sugar/images/company_logo.png');
    }else if(file_exists('themes/default/images/company_logo.png') ){
      $this->ss->assign("Logo",'themes/default/images/company_logo.png');
    }
    
    // Lineas al pie de página (Parte derecha)
    // definir en config.php
    if($sugar_config['fact_seller_info']['invoice_footer']){
      $this->ss->assign("Pie",$sugar_config['fact_seller_info']['invoice_footer']);
    }
    
    // IMPUESTOS
    // Indicamos si hay que detallar por linea los impuestos, retenciones y descuentos
    // Según sean los impuestos, cambiará el tipo de tabla. (Filas, columnas etc...)
    // (Esto debería hacerse en la plantila)
    $cols=4;
    $descrWidth=40;
    if(!$this->bean->impuesto_unico) {
      $this->ss->assign("ImpuestosPorLinea",'1');
      $cols++;
      $descrWidth-=4;
    }
    if(!$this->bean->retencion_unica) {
      $this->ss->assign("RetencionPorLinea",'1');
      $cols++;
      $descrWidth-=4;
    }
    if($this->bean->total_descuento!=0) {
      $this->ss->assign("HayDescuento",'1');
      $cols++;
      $descrWidth-=4;
    }
    $width=sprintf('%d', (100-$descrWidth) / ($cols-1)) ;
    $rest=fmod(100-$descrWidth,($cols-1));
    $this->ss->assign("Cols",$cols);
    $this->ss->assign("Width",$width);
    $this->ss->assign("DWidth",$descrWidth+$rest); 
    
    // ******************************
    // Cabecera - FileHEader
    // ******************************
    if($sugar_config['fact_restart_number'] && $this->bean->year && $this->bean->numero){
      $this->ss->assign("Identifier","{$this->bean->year}-{$this->bean->numero}");
    }else{
      $this->ss->assign("Identifier",$this->bean->numero);
    }
    $this->ss->assign("TotalInvoicesAmount",$this->format_to_pdf($this->bean->amount));
    $this->ss->assign("TotalOutstandingAmount",$this->format_to_pdf($this->bean->amount));
    $this->ss->assign("TotalExecutableAmount",$this->format_to_pdf($this->bean->amount));
    
    // ******************************
    // Factura
    // ******************************
    
    // Cambiamos todos los datos numéricos y los formateamos según la
    // configuración local
    $this->format_all_pdf();
    
    // Informacion general de factura
    $this->ss->assign("i",$this->infoInvoice );
    
    // Información del vendedor
    $this->ss->assign("Seller",$this->sellerInfo );
    if($this->sellerInfo['PersonTypeCode']=='F'){
      $this->ss->assign("NombreFacturador",$this->sellerInfo['Name'].' '.$this->sellerInfo['FirstSurname'].' '.$this->sellerInfo['SecondSurname']);
    }else{
      $this->ss->assign("NombreFacturador",$this->sellerInfo['CorporateName']);
    }
    
    // Informacion del cliente
    // Corregimos el DNI y el CP
    if( is_numeric($this->buyerInfo['TaxIdentificationNumber']) && $this->buyerInfo['TaxIdentificationNumber']==0){
      unset($this->buyerInfo['TaxIdentificationNumber']);
    }
    if( is_numeric($this->buyerInfo['PostCode']) && $this->buyerInfo['PostCode']==0){
      unset($this->buyerInfo['PostCode']);
    }
    $this->ss->assign("Buyer",$this->buyerInfo );
    
        
    // Impuestos Repercutidos - TaxesOutputs
    $this->ss->assign("taxes",$this->infoTaxes );
        
    // Retenciones - TaxesWithheld
    if(is_array($this->infoTaxesWithheld) && count($this->infoTaxesWithheld>0) ){
      $this->ss->assign("taxeswithheld",$this->infoTaxesWithheld);
    }
           
    // Lineas de productos (Items)
    $this->ss->assign("Items",$this->infoItems );
    
    // GENERACION DEL PDF
    $ficheroPlantilla = $this->get_template();
    $contenido=utf8_decode( $this->ss->fetch( $ficheroPlantilla ) );
    $html2pdf = new HTML2PDF('P','A4','es', array(0, 0, 0, 0));
    $html2pdf->pdf->SetDisplayMode('fullpage');
    if(strtolower($_REQUEST['action'])=='printpdf') $html2pdf->pdf->IncludeJS("print(true);");
    $html2pdf->WriteHTML($contenido);
    ob_clean();
    $html2pdf->Output('Factura.pdf');
  }
  
  function getUnit($unidad){
    if($this->units[$unidad]) return $this->units[$unidad];
    return $unidad;
  }
  
  /**
   * Localiza la plantilla correcta en función del tipo. Permite definición en carpetas "custom"
   */
  function get_template(){
    $tipo = strtolower($this->bean->fact_facturas_type);
    $rutas = array(
      "custom/modules/fact_Facturas/templates/$tipo.html.tpl",
      "modules/fact_Facturas/templates/$tipo.html.tpl",
      "custom/modules/fact_Facturas/templates/default.html.tpl",
      "modules/fact_Facturas/templates/default.html.tpl",
    );
    foreach($rutas as $plantilla){
      if( file_exists($plantilla) )  return $plantilla; 
    }
  }
  
  // Display correct numeric values
  // This function must be overloaded to change precission.
  protected function num($num,$name=null){
    if(!is_numeric($num)){
      $num=0;
    }
    // Formateamos todo con 2 decimales.
    return sprintf($this->defaultNumericFormat,$num);
  }
  
  /**
   * Formats numeric values acording to locale configuration.
   */
  private function format_to_pdf($num){
    global $locale;
    if(!is_numeric($num)){
      return $num;
    }
    $p1 = $p2 = $locale->getPrecedentPreference('default_currency_significant_digits');
    return format_number($num, $p1 , $p2 );
  }
  
  /**
   * Formats all numbers in PDf output acording to locale settings.
   * @return unknown_type
   */
  private function format_all_pdf(){
    // Formateamos la informacion general
    foreach($this->infoInvoice as $i=>$value){
      if( preg_match('/[0-9]*\.[0-9][0-9]/',$value) ){
          $this->infoInvoice[$i]=$this->format_to_pdf($value);
      }
    } 
    // Formateamos los impuestos directos
    foreach($this->infoTaxes as $t=>$info){
      foreach($info as $i=>$value){
        if( is_string($value) && preg_match('/[0-9]*\.[0-9][0-9]/',$value) ){
            $this->infoTaxes[$t][$i]=$this->format_to_pdf($value);
        }
      } 
    }
    
    // Formateamos los impuestos indirectos
    foreach($this->infoTaxesWithheld as $t=>$info){
      foreach($info as $i=>$value){
        if( is_string($value) && preg_match('/[0-9]*\.[0-9][0-9]/',$value) ){
            $this->infoTaxesWithheld[$t][$i]=$this->format_to_pdf($value);
        }
      } 
    }
    
    // Formateamos los distintos items de la factura
    foreach($this->infoItems as $t=>$info){
      foreach($info as $i=>$value){
        if( is_string($value) && preg_match('/[0-9]*\.[0-9][0-9]/',$value) ){
            $this->infoItems[$t][$i]=$this->format_to_pdf($value);
        }
        // Las retenciones dentro de cada item
        if(is_array($this->infoItems[$t]['retencion']))
        foreach($this->infoItems[$t]['retencion'] as $r=>$valuer){
          if( is_string($valuer) && preg_match('/[0-9]*\.[0-9][0-9]/',$valuer) ){
              $this->infoItems[$t]['retencion'][$r]=$this->format_to_pdf($valuer);
          }
        }
        
      } 
    }
    
  } // Fin format_all_pdf
    
}
