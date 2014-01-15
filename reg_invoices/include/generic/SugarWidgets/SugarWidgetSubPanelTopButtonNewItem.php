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

class SugarWidgetSubPanelTopButtonNewItem extends SugarWidgetSubPanelTopButton
{
  
  function &_get_form($defines, $additionalFormFields = null)
  {
    global $app_strings;
    global $currentModule;
    
    // Modificaciones para Crear nuevos Items en Facturas.
    $this->additional_form_fields['factura_id']='id';
    $this->additional_form_fields['factura_name']='name';
    $this->title = $app_strings['LBL_NEW_ITEM_BUTTON'];
    $this->form_value = $app_strings['LBL_NEW_ITEM_BUTTON'];
    
    // Create the additional form fields with real values if they were not passed in
    if(empty($additionalFormFields) && $this->additional_form_fields)
    {
      foreach($this->additional_form_fields as $key=>$value)
      {
        if(!empty($defines['focus']->$value))
        {
          $additionalFormFields[$key] = $defines['focus']->$value;
        }
        else
        {
          $additionalFormFields[$key] = '';
        }
      }
    }
    
    $defines['child_module_name'] = 'fact_Items'; // Este nombre debe coincidir con el del subpanel
    $defines['parent_bean_name'] = get_class( $defines['focus']);

    $form = 'form' . $defines['child_module_name'];
    $button = '<form onsubmit="return SUGAR.subpanelUtils.sendAndRetrieve(this.id, \'subpanel_' . strtolower($defines['child_module_name']) . '\', \'' . addslashes($app_strings['LBL_LOADING']) . '\', \'' . strtolower($defines['child_module_name']) . '\');" action="index.php" method="post" name="form" id="form' . $form . "\">\n";

    //module_button is used to override the value of module name
    $button .= "<input type='hidden' name='target_module' value='".$defines['child_module_name']."'>\n";
    $button .= "<input type='hidden' name='".strtolower($defines['parent_bean_name'])."_id' value='".$defines['focus']->id."'>\n";

    if(isset($defines['focus']->name))
    {
      $button .= "<input type='hidden' name='".strtolower($defines['parent_bean_name'])."_name' value='".$defines['focus']->name."'>";
    }
    if(!empty($defines['view']))
    $button .= '<input type="hidden" name="target_view" value="'. $defines['view'] . '" />';
    $button .= '<input type="hidden" name="to_pdf" value="true" />';
    $button .= '<input type="hidden" name="tpl" value="QuickCreate.tpl" />';
    $button .= '<input type="hidden" name="return_module" value="' . $currentModule . "\" />\n";
    $button .= '<input type="hidden" name="return_action" value="' . $defines['action'] . "\" />\n";
    $button .= '<input type="hidden" name="return_id" value="' . $defines['focus']->id . "\" />\n";
     
    // TODO: move this out and get $additionalFormFields working properly
    if(empty($additionalFormFields['parent_type']))
    {
        $additionalFormFields['parent_type'] = $defines['focus']->module_dir;
    }
    if(empty($additionalFormFields['parent_name']))
    {
        $additionalFormFields['parent_name'] = $defines['focus']->name;
    }
    if(empty($additionalFormFields['parent_id']))
    {
        $additionalFormFields['parent_id'] = $defines['focus']->id;
    }

    $additionalFormFields['record'] = '';
      
    //$button .= '<input type="hidden" name="action" value="SubpanelCreates" />' . "\n";
    $button .= '<input type="hidden" name="action" value="QuickEdit" />' . "\n";
    $button .= '<input type="hidden" name="module" value="fact_Items" />' . "\n";
    $button .= '<input type="hidden" name="target_action" value="EditView" />' . "\n";
    
    // fill in additional form fields for all but action
    foreach($additionalFormFields as $key => $value)
    {
      if($key != 'action')
      {
        $button .= '<input type="hidden" name="' . $key . '" value=\'' . $value . '\' />' . "\n";
      }
    }
    
    return $button;
  }
}
