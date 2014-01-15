<?php
require_once('include/generic/SugarWidgets/SugarWidgetField.php');

class SugarWidgetSubpanelItemDescription extends SugarWidgetField
{
  function displayList(&$layout_def)
  {
    $descripcion = $layout_def['fields']['DESCRIPTION'];
    $value = $layout_def['fields']['NAME'];
    return "<strong>$value</strong><table><tr><td style=\"border:none;\">$descripcion</td></tr></table>";
  }
  
}