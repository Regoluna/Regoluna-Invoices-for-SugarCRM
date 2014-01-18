<?php
$module_name = 'reg_items';
$listViewDefs [$module_name] = 
array (
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'UNIT' => 
  array (
    'width' => '10%',
    'label' => 'LBL_UNIDAD',
    'default' => true,
  ),
  'UNIT_PRICE' => 
  array (
    'width' => '10%',
    'label' => 'LBL_PRECIO_UD',
    'currency_format' => true,
    'default' => true,
  ),
  'TYPE' => 
  array (
    'width' => '10%',
    'label' => 'LBL_TIPO',
    'default' => true,
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '9%',
    'label' => 'LBL_ASSIGNED_TO_NAME',
    'default' => false,
  ),
);
?>
