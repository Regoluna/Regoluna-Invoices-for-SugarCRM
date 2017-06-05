<?php

$listViewDefs ['reg_companies'] = 
array (
  'NAME' => array (
    'width' => '10%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'NAME2' => array (
    'type' => 'varchar',
    'label' => 'LBL_NAME2',
    'width' => '10%',
    'default' => true,
  ),
  'NAME3' => array (
    'type' => 'varchar',
    'label' => 'LBL_NAME3',
    'width' => '20%',
    'default' => true,
  ),
  'NIF' => array (
    'type' => 'varchar',
    'label' => 'LBL_NIF',
    'width' => '10%',
    'default' => true,
  ),
  'TYPE' => array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_TYPE',
    'width' => '10%',
  ),
  'IS_DEFAULT' => array (
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_IS_DEFAULT',
    'width' => '10%',
  ),
);
?>
