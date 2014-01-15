<?php
$module_name = 'fact_Items';
$viewdefs [$module_name] = 
array (
  'DetailView' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 'EDIT',
          1 => 'DUPLICATE',
          2 => 'DELETE',
        ),
      ),
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
            'name' => 'unidad',
            'label' => 'LBL_UNIDAD',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'tipo',
            'label' => 'LBL_TIPO',
          ),
          1 => 
          array (
            'name' => 'precio_ud',
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
          0 => 
          array (
            'name' => 'factura_name',
          ),
        ),
      ),
    ),
  ),
);
?>
