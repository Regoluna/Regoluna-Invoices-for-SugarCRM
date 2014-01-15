<?php
require_once('include/generic/SugarWidgets/SugarWidgetField.php');

class SugarWidgetSubpanelTax extends SugarWidgetField
{
  function displayList(&$layout_def)
  {
    //$value = $layout_def['fields']['NAME'];
    $value= $this->_get_list_value($layout_def);
    
    $impuesto = $layout_def['fields']['IMPUESTO'];
    $tipo_repercutido = $layout_def['fields']['TIPO_REPERCUTIDO'];
    
    if($layout_def['name']=='total_impuesto'){
      $impuesto = $layout_def['fields']['IMPUESTO'];
      $tipo_repercutido = $layout_def['fields']['TIPO_REPERCUTIDO'];
    }else if($layout_def['name']=='total_retencion'){
      $impuesto = $layout_def['fields']['RETENCION'];
      $tipo_repercutido = 'IRPF';
    }
    
    if($impuesto){
      $imp = " <span class=\"void-tax\">($impuesto% $tipo_repercutido)</span>";
    }
    
    if($value){
      return $value.$imp;
    }else{
      return "<span class=\"void-tax\">general</span>";
    }
  }
  
}