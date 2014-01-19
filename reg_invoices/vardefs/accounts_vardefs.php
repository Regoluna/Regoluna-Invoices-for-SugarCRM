<?php

// Nuevo campo añadido a "Cuentas" para mostrar el Subpanel de Facturas
$dictionary["Account"]["fields"]["reg_invoices"] = array (
  'name' => 'reg_invoices',
  'type' => 'link',
  'relationship' => 'accounts_reg_invoices',
  'source' => 'non-db',
  'vname' => 'LBL_FACTURAS',
);

$dictionary["Account"]["relationships"]["accounts_reg_invoices"] = array (
    'lhs_module'=> 'Accounts',
    'lhs_table'=> 'accounts',
    'lhs_key' => 'id',
    'rhs_module'=> 'reg_invoices',
    'rhs_table'=> 'reg_invoices',
    'rhs_key' => 'account_id',
    'relationship_type'=>'one-to-many',
);