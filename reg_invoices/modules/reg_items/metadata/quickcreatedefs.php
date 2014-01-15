<?php
$module_name = 'reg_items';
$viewdefs [$module_name] = 
array (
  'QuickCreate' => 
  array (
    'templateMeta' => 
    array (
      'maxColumns' => '2',
      'widths' => 
      array (
        0 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
        1 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
      ),
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'name',
            'label' => 'LBL_NAME',
          ),
          1 => 
          array (
            'name' => 'unit',
            'label' => 'LBL_UNIDAD',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'type',
            'label' => 'LBL_TIPO',
          ),
          1 => 
          array (
            'name' => 'unit_price',
            'label' => 'LBL_PRECIO_UD',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'description',
            'label' => 'LBL_DESCRIPTION',
          ),
          1 => 
          array (
            'name' => 'iva',
            'label' => 'LBL_IVA',
          ),
        ),
        3 => 
        array (
          0 => NULL,
          /*
          array (
            'name' => 'invoice_name',
            'label' => 'LBL_FACT_FACTURAS_FACT_ITEMS_FROM_FACT_FACTURAS_TITLE',
          ),
          */
          1 => array (
            'name' => 'qty',
            'label' => 'LBL_CANTIDAD',
          ),
        ),
      ),
    ),
  ),
);
?>
