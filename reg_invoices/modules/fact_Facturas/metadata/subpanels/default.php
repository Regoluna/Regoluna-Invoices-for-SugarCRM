<?php
$module_name='fact_Facturas';
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
      'popup_module' => 'fact_Facturas',
    ),
  ),
  'where' => '',
  'list_fields' => 
  array (
    'name' => 
    array (
      'name' => 'name',
      'vname' => 'LBL_LIST_SALE_NAME',
      'widget_class' => 'SubPanelDetailViewLink',
      'width' => '40%',
      'default' => true,
    ),
    'estado' => 
    array (
      'name' => 'estado',
      'vname' => 'LBL_ESTADO',
      'width' => '15%',
      'default' => true,
    ),
    'date_closed' => 
    array (
      'name' => 'fecha_emision',
      'vname' => 'LBL_FECHA_EMISION',
      'width' => '15%',
      'default' => true,
    ),
    'amount' => 
    array (
      'vname' => 'LBL_LIST_AMOUNT',
      'width' => '15%',
      'currency_format' => true,
      'default' => true,
    ),
    'fact_facturas_type' => 
    array (
      'width' => '15%',
      'vname' => 'LBL_TYPE',
      'default' => false,
    ),
    'edit_button' => 
    array (
      'widget_class' => 'SubPanelEditButton',
      'module' => 'fact_Facturas',
      'width' => '4%',
      'default' => true,
    ),
    'remove_button' => 
    array (
      'widget_class' => 'SubPanelRemoveButton',
      'module' => 'fact_Facturas',
      'width' => '5%',
      'default' => true,
    ),
    'amount_usdollar' => 
    array (
      'usage' => 'query_only',
    ),
  ),
);