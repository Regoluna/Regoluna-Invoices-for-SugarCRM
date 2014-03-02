<?php


require_once("include/SugarCharts/Jit/Jit.php");

class JitRegInvoices extends Jit {

  /**
   * Overrides getConfigProperties() to alter default colors
   * for Regoluna Invoices. Colors won't be assigned ramdomly
   */
  function getConfigProperties() {
    $path = SugarThemeRegistry::current()->getImageURL('sugarColors.xml',false);
  
    if(!file_exists($path)) {
      $GLOBALS['log']->debug("Cannot open file ($path)");
    }
    $xmlstr = file_get_contents($path);
    $xml = new SimpleXMLElement($xmlstr);
    
    // Alter default color
    $xml->charts->chartElementColors->color[0]='0xFF0000';
    $xml->charts->chartElementColors->color[1]='0x00FF00';
    $xml->charts->chartElementColors->color[2]='0x9FBCFF';
    $xml->charts->chartElementColors->color[3]='0xFFBE4E';
    
    return $xml->charts;
  }
  
  
}

