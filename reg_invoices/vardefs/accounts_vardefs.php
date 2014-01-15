<?php

// Nuevo campo añadido a "Cuentas" para mostrar el Subpanel de Facturas
$dictionary["Account"]["fields"]["accounts_reg_invoices"] = array (
  'name' => 'accounts_reg_invoices',
  'type' => 'link',
  'relationship' => 'accounts_reg_invoices',
  'source' => 'non-db',
  'vname' => 'LBL_FACTURAS',
);
