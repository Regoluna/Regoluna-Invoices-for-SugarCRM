<?php
$module_name='reg_invoices';
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
      'popup_module' => 'reg_invoices',
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
    'state' =>
    array (
      'name' => 'state',
      'vname' => 'LBL_ESTADO',
      'width' => '15%',
      'default' => true,
    ),
    'date_closed' =>
    array (
      'name' => 'date_closed',
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
    'reg_invoices_type' =>
    array (
      'width' => '15%',
      'vname' => 'LBL_TYPE',
      'default' => false,
    ),
    'edit_button' =>
    array (
      'widget_class' => 'SubPanelEditButton',
      'module' => 'reg_invoices',
      'width' => '4%',
      'default' => true,
    ),
    'remove_button' =>
    array (
      'widget_class' => 'SubPanelRemoveButton',
      'module' => 'reg_invoices',
      'width' => '5%',
      'default' => true,
    ),
    'amount_usdollar' =>
    array (
      'usage' => 'query_only',
    ),
  ),
);