<?php

// Nuevo Subpanel para mostrar las facturas emitidas para cada cuenta
$layout_defs["Accounts"]["subpanel_setup"]["accounts_fact_facturas"] = array (
  'order' => 100,
  'module' => 'fact_Facturas',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_FACTURAS',
  'get_subpanel_data' => 'accounts_fact_facturas',
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
      'mode' => 'MultiSelect',
    ),
  ),
);
