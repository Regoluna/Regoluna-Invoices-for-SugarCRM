<?php
$module_name='fact_Items';
$subpanel_layout = array (
  'top_buttons' => 
  array (
    0 => 
    array (
      'widget_class' => 'SubPanelTopCreateButton',
    ),
    1 => 
    array (
      'widget_class' => 'SubPanelTopSelectButton',
      'popup_module' => 'fact_Productos',
    ),
  ),
  'where' => '',
  'fill_in_additional_fields' => true, 
  'list_fields' => 
  array (
  
    'updown_button' => 
    array (
      'widget_class' => 'SubPanelUpDownButton',
      'module' => 'fact_Productos',
      'width' => '1%',
      'default' => true,
      'sortable'=> false,
    ),
        /*
    'orden' => 
    array (
      'vname' => 'LBL_ORDEN',
      'width' => '1%',
      'default' => true,
      'sortable'=> false,
    ),
    */
   'name' => 
    array (
      'vname' => 'LBL_NAME',
      'widget_class' => 'SubpanelItemDescription',
      'width' => '25%',
      'default' => true,
      'sortable'=> false,
    ),
   'description' => 
    array (
      'vname' => 'LBL_NAME',
      'usage'=>'query_only',
    ),
    
    'tipo' => 
    array (
      'width' => '8%',
      'vname' => 'LBL_TIPO',
      'default' => true,
      'sortable'=> false,
    ),
//    'unidad' => 
//    array (
//      'width' => '8%',
//      'vname' => 'LBL_UNIDAD',
//      'default' => true,
//      'sortable'=> false,
//    ),
    'cantidad' => 
    array (
      'width' => '8%',
      'vname' => 'LBL_CANTIDAD',
      'default' => true,
      'sortable'=> false,
    ),
    'precio_ud' => 
    array (
      'width' => '8%',
      'vname' => 'LBL_PRECIO_UD',
  //    'currency_format' => true,
      'default' => true,
      'sortable'=> false,
    ),
    'descuento' => 
    array (
      'width' => '8%',
      'vname' => 'LBL_DESCUENTO',
      'default' => true,
      'sortable'=> false,
    ),
    'total_impuesto' => 
    array (
      'width' => '8%',
      'vname' => 'LBL_TOTAL_IMPUESTO',
      'currency_format' => true,
      'default' => true,
      'sortable'=> false,
      'widget_class' => 'SubpanelTax',
    ),
    'impuesto' =>  array ( 'usage'=>'query_only' ),
    'tipo_repercutido' =>  array ( 'usage'=>'query_only' ),
    'unidad_custom' =>  array ( 'usage'=>'query_only' ),
    'unidad' =>  array ( 'usage'=>'query_only' ),
    
    'total_retencion' => 
    array (
      'width' => '10%',
      'vname' => 'LBL_TOTAL_RETENCION',
      'currency_format' => true,
      'default' => true,
      'sortable'=> false,
      'widget_class' => 'SubpanelTax',
    ),
    'retencion' =>  array ( 'usage'=>'query_only' ),
    
    'total_antes' => 
    array (
      'width' => '15%',
      'vname' => 'LBL_TOTAL_ANTES',
      'currency_format' => true,
      'default' => true,
      'sortable'=> false,
    ),
    'edit_button' => 
    array (
      'widget_class' => 'SubPanelQuickItem',
      'module' => 'fact_Productos',
      'width' => '5%',
      'default' => true,
      'sortable'=> false,
    ),
    'remove_button' => 
    array (
      'widget_class' => 'SubPanelDeleteRelatedButton',
      'module' => 'fact_Productos',
      'width' => '5%',
      'default' => true,
      'sortable'=> false,
    ),
  ),
);