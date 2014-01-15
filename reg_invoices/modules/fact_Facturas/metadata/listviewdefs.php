<?php
$module_name = 'fact_Facturas';
$OBJECT_NAME = 'FACT_FACTURAS';
$listViewDefs [$module_name] = 
array (
  'NUMERO' => 
  array (
    'width' => '1%',
    'label' => 'LBL_NUMERO_LIST',
    'default' => true,
    'related_fields' => array('year'),
    'type' => 'NumFactura',
  ),
  'NAME' => 
  array (
    'width' => '30%',
    'label' => 'LBL_LIST_SALE_NAME',
    'link' => true,
    'default' => true,
  ),
  'AMOUNT' => 
  array (
    'width' => '10%',
    'label' => 'LBL_AMOUNT',
    'currency_format' => true,
    'default' => true,
  ),
  'ESTADO' => 
  array (
    'width' => '10%',
    'label' => 'LBL_ESTADO',
    'default' => true,
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '5%',
    'label' => 'LBL_LIST_ASSIGNED_USER',
    'default' => true,
  ),
  'DATE_CLOSED' => 
  array (
    'width' => '10%',
    'label' => 'LBL_FECHA_EMISION',
    'default' => true,
  ),
  'FACT_FACTURAS_TYPE' => 
  array (
    'width' => '15%',
    'label' => 'LBL_TYPE',
    'default' => false,
  ),
  'IVA' => 
  array (
    'width' => '10%',
    'label' => 'LBL_IVA',
    'default' => false,
  ),
  'RETENCION' => 
  array (
    'width' => '10%',
    'label' => 'LBL_RETENCION',
    'default' => false,
  ),
  'DESCUENTO' => 
  array (
    'width' => '10%',
    'label' => 'LBL_DESCUENTO',
    'default' => false,
  ),
);
?>
