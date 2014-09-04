<?php
/*********************************************************************************
 * 
 * Copyright (C) 2008 Rodrigo Saiz Camarero (http://www.regoluna.com)
 *
 * This file is part of "Regoluna® Spanish Invoices" module.
 *
 * "Regoluna® Spanish Invoices" is free software: you can redistribute it and/or 
 * modify it under the terms of the GNU Lesser General Public License as published 
 * by the Free Software Foundation, version 3 of the License.
 *   
 ********************************************************************************/
require_once('include/SugarFields/Fields/Base/SugarFieldBase.php');

class SugarFieldNumFactura extends SugarFieldBase {
  
  function getEditViewSmarty($parentFieldArray, $vardef, $displayParams, $tabindex) {
    global $mod_strings;
    $this->ss->assign('textocheck', $mod_strings['LBL_AUTOGEN']);
    $this->ss->assign('textocambio', $mod_strings['LBL_CHANGE_BUTTON']);
    // Mark checked if Number field is empty
    /*
    echo "<pre>";
    print_r($vardef);
    echo "</pre>";
    */
    if( !$vardef['value'] || $vardef['value']=="" ){
       $this->ss->assign('checked', 'CHECKED');
    }    
    return parent::getEditViewSmarty($parentFieldArray, $vardef, $displayParams, $tabindex);
  }
  
  public function formatField($rawField, $vardef){
    
    return $rawField;
//    
//        // A null precision uses the user prefs / system prefs by default
//        $precision = null;
//        if ( isset($vardef['precision']) ) {
//            $precision = $vardef['precision'];
//        }
//        
//        if ( $rawField === '' || $rawField === NULL ) {
//            return '';
//        }
//        return $rawField;
//        return format_number($rawField,$precision,$precision);
    }
  
}

?>
