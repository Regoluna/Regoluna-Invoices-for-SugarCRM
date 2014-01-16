<?php
$module_name='reg_items';
$subpanel_layout = array (
  'top_buttons' =>
  array (
    0 =>
    array (
      'widget_class' => 'SubPanelTopCreateButton',
    ),
  ),
  'where' => '',
  'fill_in_additional_fields' => true,
  'list_fields' =>
  array (

    'updown_button' =>
    array (
      'widget_class' => 'SubPanelUpDownButton',
      'width' => '1%',
      'default' => true,
      'sortable'=> false,
    ),
        /*
    'ordered' =>
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
      'type' => 'textarea',
      'width' => '25%',
      'default' => true,
      'sortable'=> false,
    ),
   'description' =>
    array (
      'vname' => 'LBL_NAME',
      'usage'=>'query_only',
    ),

    'type' =>
    array (
      'width' => '8%',
      'vname' => 'LBL_TIPO',
      'default' => true,
      'sortable'=> false,
    ),
//    'unit' =>
//    array (
//      'width' => '8%',
//      'vname' => 'LBL_UNIDAD',
//      'default' => true,
//      'sortable'=> false,
//    ),
    'qty' =>
    array (
      'width' => '8%',
      'vname' => 'LBL_CANTIDAD',
      'default' => true,
      'sortable'=> false,
    ),
    'unit_price' =>
    array (
      'width' => '8%',
      'vname' => 'LBL_PRECIO_UD',
  //    'currency_format' => true,
      'default' => true,
      'sortable'=> false,
    ),
    'discount' =>
    array (
      'width' => '8%',
      'vname' => 'LBL_DESCUENTO',
      'default' => true,
      'sortable'=> false,
    ),
    'total_tax' =>
    array (
      'width' => '8%',
      'vname' => 'LBL_TOTAL_IMPUESTO',
      'currency_format' => true,
      'default' => true,
      'sortable'=> false,
      'widget_class' => 'SubpanelTax',
    ),
    'tax' =>  array ( 'usage'=>'query_only' ),
    'tax_type' =>  array ( 'usage'=>'query_only' ),
    'unit_custom' =>  array ( 'usage'=>'query_only' ),
    'unit' =>  array ( 'usage'=>'query_only' ),

    'total_retention' =>
    array (
      'width' => '10%',
      'vname' => 'LBL_TOTAL_RETENCION',
      'currency_format' => true,
      'default' => true,
      'sortable'=> false,
      'widget_class' => 'SubpanelTax',
    ),
    'retention' =>  array ( 'usage'=>'query_only' ),

    'total_base' =>
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