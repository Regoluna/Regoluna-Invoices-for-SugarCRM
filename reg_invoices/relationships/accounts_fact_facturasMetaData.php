<?php

$dictionary["accounts_fact_facturas"] = array (
  'true_relationship_type' => 'one-to-many',
  'relationships' => 
  array (
    'accounts_fact_facturas' => 
    array (
      'lhs_module' => 'Accounts',
      'lhs_table' => 'accounts',
      'lhs_key' => 'id',
      'rhs_module' => 'fact_Facturas',
      'rhs_table' => 'fact_facturas',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'accounts_fact_facturas_c',
      'join_key_lhs' => 'accounts_f4ffcccounts_ida',
      'join_key_rhs' => 'accounts_fbc88acturas_idb',
    ),
  ),
  'table' => 'accounts_fact_facturas_c',
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
      'name' => 'accounts_f4ffcccounts_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'accounts_fbc88acturas_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'accounts_fact_facturasspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'accounts_fact_facturas_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'accounts_f4ffcccounts_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'accounts_fact_facturas_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'accounts_fbc88acturas_idb',
      ),
    ),
  ),
);