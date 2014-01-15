<?php
$module_name = 'fact_Facturas';
$_module_name = 'fact_facturas';
$searchdefs [$module_name] = 
array (
  'layout' => 
  array (
    'basic_search' => 
    array (
      0 => 'name',
      1 => array(
        'name' => 'fact_facturas_type',
        'displayParams' => array (
            'size' => '3',
          ),
      ),
      2 => 
      array (
        'width' => '10%',
        'label' => 'LBL_ESTADO',
        'default' => true,
        'name' => 'estado',
        'displayParams' => array (
            'size' => '4',
          ),
      ),
//      3 => 
//      array (
//        'name' => 'current_user_only',
//        'label' => 'LBL_CURRENT_USER_FILTER',
//        'type' => 'bool',
//      ),
      3 => 
      array (
        'name' => 'year',
        'label' => 'LBL_YEAR',
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
      'amount' => 
      array (
        'name' => 'amount',
        'label' => 'LBL_AMOUNT',
        'default' => true,
        'currency_format' => true,
      ),
      'assigned_user_id' => 
      array (
        'name' => 'assigned_user_id',
        'type' => 'enum',
        'label' => 'LBL_ASSIGNED_TO',
        'function' => 
        array (
          'name' => 'get_user_array',
          'params' => 
          array (
            0 => false,
          ),
        ),
        'default' => true,
      ),
      'fecha_emision' => 
      array (
        'width' => '10%',
        'label' => 'LBL_FECHA_EMISION',
        'default' => true,
        'name' => 'fecha_emision',
      ),
      'estado' => 
      array (
        'width' => '10%',
        'label' => 'LBL_ESTADO',
        'default' => true,
        'name' => 'estado',
      ),
      'fact_facturas_type' => 
      array (
        'width' => '10%',
        'label' => 'LBL_TYPE',
        'default' => true,
        'name' => 'fact_facturas_type',
      ),
      array (
        'name' => 'year',
        'label' => 'LBL_YEAR',
      ),
    ),
  ),
  'templateMeta' => 
  array (
    'maxColumns' => '4',
    'widths' => 
    array (
      'label' => '5',
      'field' => '20',
    ),
  ),
);
?>
