<?php
$module_name = 'reg_invoices';
$_module_name = 'reg_invoices';
$searchdefs [$module_name] = 
array (
  'layout' => array (
    'basic_search' => array (
      'name',
      array(
        'name' => 'reg_invoices_type',
        'displayParams' => array (
            'size' => '3',
          ),
      ),
      array (
        'width' => '10%',
        'label' => 'LBL_ESTADO',
        'default' => true,
        'name' => 'state',
        'displayParams' => array (
            'size' => '4',
          ),
      ),
      array (
        'name' => 'year',
        'label' => 'LBL_YEAR',
      ),
      
    ),
    'advanced_search' => array (
      array (
        'name' => 'name',
        'label' => 'LBL_NAME',
        'default' => true,
      ),
      array (
        'name' => 'total_base',
        'label' => 'LBL_AMOUNT',
        'default' => true,
        'currency_format' => true,
      ),
      array (
        'name' => 'year',
        'label' => 'LBL_YEAR',
      ),
      array (
        'width' => '10%',
        'label' => 'LBL_FECHA_EMISION',
        'default' => true,
        'name' => 'date_closed',
      ),
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
      array (
        'width' => '10%',
        'label' => 'LBL_ESTADO',
        'default' => true,
        'name' => 'state',
      ),
      array (
        'width' => '10%',
        'label' => 'LBL_TYPE',
        'default' => true,
        'name' => 'reg_invoices_type',
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
