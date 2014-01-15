<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

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
require_once('include/generic/SugarWidgets/SugarWidgetSubPanelTopButton.php');

class SugarWidgetSubPanelTopButtonSignXml extends SugarWidgetSubPanelTopButton
{
  
  function &_get_form($defines, $additionalFormFields = null)
  {
    global $app_strings;
    global $currentModule;
    
    $mode=($defines['mode'])? strtoupper($defines['mode']) :'XML';
    
    $this->title = translate("LBL_SIGN_$mode",$currentModule);
    $this->form_value = translate("LBL_SIGN_$mode",$currentModule);
    
    $childModule = 'notes'; // Este nombre debe coincidir con el del subpanel
    $form = 'form' . $childModule;
    
    $button = '<form onsubmit="return SUGAR.subpanelUtils.sendAndRetrieve(this.id, \'subpanel_' . strtolower($childModule) . '\', \'' . addslashes($app_strings['LBL_LOADING']) . '\', \'' . strtolower($childModule) . '\');" 
               action="index.php" method="post" name="form" id="' . $form.$mode . "\">\n";

    //module_button is used to override the value of module name
    $button .= "<input type='hidden' name='target_module' value='".$childModule."'>\n";
    $button .= "<input type='hidden' name='".strtolower($defines['parent_bean_name'])."_id' value='".$defines['focus']->id."'>\n";
    $button .= '<input type="hidden" name="to_pdf" value="true" />';
    $button .= '<input type="hidden" name="return_module" value="' . $currentModule . "\" />\n";
    // $button .= '<input type="hidden" name="return_action" value="' . $defines['action'] . "\" />\n";
    $button .= '<input type="hidden" name="return_id" value="' . $defines['focus']->id . "\" />\n";
    $button .= '<input type="hidden" name="action" value="Sign'.$mode.'" />' . "\n";
    $button .= '<input type="hidden" name="module" value="fact_Facturas" />' . "\n";
    $button .= '<input type="hidden" name="record" value="'.$defines['focus']->id.'" />' . "\n";
    
    return $button;
  }
  
  function display($defines, $additionalFormFields = null){
    
    global $sugar_config;
    if($sugar_config['fact_deactivate_applet']) return null;
    
    $mode=($defines['mode'])? strtoupper($defines['mode']) :'XML';
    if( $mode=='XML' && ($defines['focus']->fact_facturas_type!="factura" || !($defines['focus']->numero > 0) ) ){
      return null;
    } 
    return parent::display($defines, $additionalFormFields = null);
  }
  
}
