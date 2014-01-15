<?php

// Nuevo campo añadido a "Cuentas" para mostrar el Subpanel de Facturas
$dictionary["Account"]["fields"]["accounts_fact_facturas"] = array (
  'name' => 'accounts_fact_facturas',
  'type' => 'link',
  'relationship' => 'accounts_fact_facturas',
  'source' => 'non-db',
  'vname' => 'LBL_FACTURAS',
);
