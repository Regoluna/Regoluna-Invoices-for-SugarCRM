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
//TODO Rename this to edit link
class SugarWidgetSubPanelQuickItem  extends SugarWidgetField
{
	function displayHeaderCell(&$layout_def)
	{
		return '&nbsp;';
	}

	function displayList(&$layout_def)
	{
		global $app_strings;
		global $image_path;

		$edit_icon_html = get_image($image_path . 'edit_inline', 
		  'align="absmiddle" alt="' . $app_strings['LNK_EDIT'] . '" border="0"');
		if($layout_def['EditView']){
		   return "<a href='#' onClick=\"javascript:quickEditItem('".$layout_def['fields']['ID']."');\"" .
              ' class="listViewTdToolsS1">' . $edit_icon_html . '&nbsp;' . $app_strings['LNK_EDIT'] .'</a>&nbsp;';     
		}else{
			return '';
		}
	}
		
}

?>
