<?php
require_once('modules/fact_Facturas/views/InvoiceView.php');

class fact_FacturasViewXml extends InvoiceView{
    
  var $specialNumericFormat = array(
    'UnitPriceWithoutTax'=>'%01.6F',
    'TotalCost'=>'%01.6F',
    'GrossAmount'=>'%01.6F',
    'TaxableBase'=>'%01.2F',
    'DiscountAmount'=>'%01.6F',
//    'TotalTaxesWithheld'=>'%01.6F',
  );
  
  function display(){
    header('Content-Type: text/xml');
    // @todo Descomentar para forzar descarga del XML
    header('Content-Disposition: attachment;filename="factura.xml"');
    
    $this->ss=new Sugar_Smarty();
    $this->ss->left_delimiter = '{{';
    $this->ss->right_delimiter = '}}';

    // ******************************
    // Cabecera - FileHEader
    // ******************************
    $this->ss->assign("BatchIdentifier",$this->bean->numero.'1');
    
    // Suma de los importes InvoiceTotal del Fichero. 
    // Este importe lo es a efectos de total de factura y fiscales, sin tener en cuenta 
    // subvenciones, anticipos y/o retenciones que pudieran haberse practicado
    $this->ss->assign("TotalInvoicesAmount",$this->num($this->bean->amount));
    
    // Es el importe que efectivamente se adeuda, una vez descontados 
    // los anticipos y sin tener en cuenta las retenciones
    $this->ss->assign("TotalOutstandingAmount",$this->num($this->bean->amount));
    
    // Total a Ejecutar. Sumatorio de las diferencias de los importes (TotalOutstandingAmount y WithholdingAmount) 
    // del fichero = Sumatorio de los Importes TotalExecutableAmount, con dos decimales. 
    // Es el importe que se adeuda minorado en un posible importe retenido en garantía de cumplimientos contractuales
    $this->ss->assign("TotalExecutableAmount",$this->num($this->bean->amount));
    
    // ******************************
    // Factura
    // ******************************
    
    // Informacion general de factura
    $this->ss->assign("i",$this->infoInvoice );
    
    // Información del vendedor
    $this->ss->assign("Seller",$this->sellerInfo );
    
    // Informacion del cliente
    $this->ss->assign("Buyer",$this->buyerInfo );
        
    // Impuestos Repercutidos - TaxesOutputs
    $this->ss->assign("taxes",$this->infoTaxes );
        
    // Retenciones - TaxesWithheld
    if(is_array($this->infoTaxesWithheld) && count($this->infoTaxesWithheld>0) ){
      $this->ss->assign("taxeswithheld",$this->infoTaxesWithheld);
    }
           
    // Lineas de productos (Items)
    $this->ss->assign("Items",$this->infoItems );
    
    // Enviamos el documento al navegador.
    ob_clean();
    echo $this->ss->fetch('modules/fact_Facturas/templates/facturae.xml.tpl');
  }
  
  // Ajustamos las fechas para el formato Facturae.
  protected function date($date){
    global $current_user;
    global $sugar_config;
    
    $udf = $current_user->getPreference('datef');
    if ($udf == "") $udf = $sugar_config['default_date_format'];

    $udf=str_replace('d','%d',$udf);
    $udf=str_replace('m','%m',$udf);
    $udf=str_replace('Y','%Y',$udf);
    
    $strf = strptime($date,$udf);
    $fecha = sprintf ('%02d-%02d-%02d',$strf['tm_year']+1900,$strf['tm_mon']+1,$strf['tm_mday']) ;
    return $fecha;
  }
  
}