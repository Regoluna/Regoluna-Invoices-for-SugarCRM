<?php
$module_name = 'reg_items';
$searchdefs [$module_name] = 
array (
  'layout' => 
  array (
    'basic_search' => 
    array (
      'name' => 
      array (
        'name' => 'name',
        'label' => 'LBL_NAME',
        'default' => true,
      ),
      'type' => 
      array (
        'width' => '10%',
        'label' => 'LBL_TIPO',
        'default' => true,
        'name' => 'type',
      ),
      'current_user_only' => 
      array (
        'name' => 'current_user_only',
        'label' => 'LBL_CURRENT_USER_FILTER',
        'type' => 'bool',
        'default' => true,
      ),
    ),
    'advanced_search' => 
    array (
      'name' => 
      array (
        'name' => 'name',
        'label' => 'LBL_NAME',
        'default' => true,
      ),
      'type' => 
      array (
        'width' => '10%',
        'label' => 'LBL_TIPO',
        'default' => true,
        'name' => 'type',
      ),
      'unit_price' => 
      array (
        'width' => '10%',
        'label' => 'LBL_PRECIO_UD',
        'currency_format' => true,
        'default' => true,
        'name' => 'unit_price',
      ),
      'unit' => 
      array (
        'width' => '10%',
        'label' => 'LBL_UNIDAD',
        'default' => true,
        'name' => 'unit',
      ),
      'description' => 
      array (
        'width' => '10%',
        'label' => 'LBL_DESCRIPTION',
        'sortable' => false,
        'default' => true,
        'name' => 'description',
      ),
    ),
  ),
  'templateMeta' => 
  array (
    'maxColumns' => '3',
    'widths' => 
    array (
      'label' => '10',
      'field' => '30',
    ),
  ),
);
?>
