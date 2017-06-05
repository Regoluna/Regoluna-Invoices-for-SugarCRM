<?php

// Nuevo Subpanel para mostrar las facturas emitidas para cada cuenta
$layout_defs["Accounts"]["subpanel_setup"]["accounts_reg_invoices"] = array (
  'ordered' => 100,
  'module' => 'reg_invoices',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_FACTURAS',
  'get_subpanel_data' => 'reg_invoices',
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
      'mode' => 'MultiSelect',
    ),
  ),
);
