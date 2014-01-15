<?php
// created: 2009-12-01 12:50:46
$dictionary["factura_items"] = array (
  'true_relationship_type' => 'one-to-many',
  'relationships' => 
  array (
    'factura_items' => 
    array (
      'lhs_module' => 'fact_Facturas',
      'lhs_table' => 'fact_facturas',
      'lhs_key' => 'id',
      'rhs_module' => 'fact_Items',
      'rhs_table' => 'fact_items',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'fact_factura_items',
      'join_key_lhs' => 'factura_id',
      'join_key_rhs' => 'item_id',
    ),
  ),
  'table' => 'fact_factura_items',
  'fields' => 
  array (
    0 => 
    array (
      'name' => 'id',
      'type' => 'varchar',
      'len' => 36,
    ),
    1 => 
    array (
      'name' => 'date_modified',
      'type' => 'datetime',
    ),
    2 => 
    array (
      'name' => 'deleted',
      'type' => 'bool',
      'len' => '1',
      'default' => '0',
      'required' => true,
    ),
    3 => 
    array (
      'name' => 'factura_id',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'item_id',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'indice_pk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'indice_factura',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'factura_id',
      ),
    ),
    2 => 
    array (
      'name' => 'indice_item',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'item_id',
      ),
    ),
  ),
);
?>
