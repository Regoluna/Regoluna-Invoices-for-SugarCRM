<?php
require_once('include/generic/SugarWidgets/SugarWidgetField.php');

class SugarWidgetSubpanelTax extends SugarWidgetField
{
  function displayList(&$layout_def)
  {
    //$value = $layout_def['fields']['NAME'];
    $value= $this->_get_list_value($layout_def);
    
    $tax = $layout_def['fields']['IMPUESTO'];
    $tax_type = $layout_def['fields']['TIPO_REPERCUTIDO'];
    
    if($layout_def['name']=='total_tax'){
      $tax = $layout_def['fields']['IMPUESTO'];
      $tax_type = $layout_def['fields']['TIPO_REPERCUTIDO'];
    }else if($layout_def['name']=='total_retention'){
      $tax = $layout_def['fields']['RETENCION'];
      $tax_type = 'IRPF';
    }
    
    if($tax){
      $imp = " <span class=\"void-tax\">($tax% $tax_type)</span>";
    }
    
    if($value){
      return $value.$imp;
    }else{
      return "<span class=\"void-tax\">general</span>";
    }
  }
  
}