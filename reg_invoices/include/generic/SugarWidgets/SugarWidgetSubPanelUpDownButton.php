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
require_once('include/generic/SugarWidgets/SugarWidgetField.php');

class SugarWidgetSubPanelUpDownButton extends SugarWidgetField
{
	function displayHeaderCell(&$layout_def)
	{
		return '&nbsp;';
	}

	function displayList(&$layout_def)
	{
		
		global $app_strings;
		global $image_path;
		
		$parent_record_id = $_REQUEST['record'];
		$parent_module = $_REQUEST['module'];

		$action = 'UpDown';
		$record = $layout_def['fields']['ID'];
		$current_module=$layout_def['module'];
		
		$return_module = $_REQUEST['module'];
		//$return_action = 'SubPanelViewer';
		$subpanel = $layout_def['subpanel_id'];
		$return_id = $_REQUEST['record'];
		if (isset($layout_def['linked_field_set']) && !empty($layout_def['linked_field_set'])) {
			$linked_field= $layout_def['linked_field_set'] ;
		} else {
			$linked_field = $layout_def['linked_field'];
		}
		$refresh_page = 0;
		if(!empty($layout_def['refresh_page'])){
			$refresh_page = 1;
		}
		$return_url = "index.php?module=$return_module&action=$return_action&subpanel=$subpanel&record=$return_id&sugar_body_only=1&inline=1";

		// $icon_up_text = $app_strings['LNK_REMOVE'];
		$icon_down_html = get_image($image_path . 'downarrow_inline', 'align="absmiddle" alt="' . $icon_remove_text . '" border="0"');
    $icon_up_html = get_image($image_path . 'uparrow_inline', 'align="absmiddle" alt="' . $icon_remove_text . '" border="0"');
		
		//based on listview since that lets you select records
		if($layout_def['ListView'] && !$hideremove) {
      $linkUp = "<a href=\"javascript:upDown('$subpanel', 'up', '$record', $refresh_page);\"" 
			        . " class=\"listViewTdToolsS1\">$icon_up_html</a>";
      $linkDown = "<a href=\"javascript:upDown('$subpanel', 'down', '$record', $refresh_page);\"" 
                . " class=\"listViewTdToolsS1\">$icon_down_html</a>";
			return $linkUp.'&nbsp;'.$linkDown;    
		}else{
			return '';
		}
	}
}
?>
