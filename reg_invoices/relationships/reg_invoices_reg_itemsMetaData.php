<?php
// created: 2009-12-01 12:50:46
$dictionary['reg_invoice_items'] = array (
  'true_relationship_type' => 'one-to-many',
  'relationships' =>
  array (
    'invoice_items' =>
    array (
      'lhs_module' => 'reg_invoices',
      'lhs_table' => 'reg_invoices',
      'lhs_key' => 'id',
      'rhs_module' => 'reg_items',
      'rhs_table' => 'reg_items',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'reg_invoice_items',
      'join_key_lhs' => 'invoice_id',
      'join_key_rhs' => 'item_id',
    ),
  ),
  'table' => 'reg_invoice_items',
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
      'name' => 'invoice_id',
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
        0 => 'invoice_id',
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
