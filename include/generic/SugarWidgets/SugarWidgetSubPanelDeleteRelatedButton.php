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

class SugarWidgetSubPanelDeleteRelatedButton extends SugarWidgetField
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

		//$action = 'DeleteRelationship';
		$action = 'Delete';
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

		$icon_remove_text = $app_strings['LNK_REMOVE'];
		$icon_remove_html = get_image($image_path . 'delete_inline',
			'align="absmiddle" alt="' . $icon_remove_text . '" border="0"');
		if($linked_field == 'get_products_query')
			$linked_field = 'products';
		//based on listview since that lets you select records
		if($layout_def['ListView'] && !$hideremove) {
            $retStr = "<a href=\"javascript:deleteRelatedElement('$subpanel', '$current_module', '$record', $refresh_page);\"" 
			. ' class="listViewTdToolsS1"'
			. " onclick=\"return sp_rem_conf();\""
			. ">$icon_remove_html&nbsp;$icon_remove_text</a>";
        return $retStr;
            
		}else{
			return '';
		}
	}
}
?>
