<?php
/*********************************************************************************
 * 
 * Copyright (C) 2008 Rodrigo Saiz Camarero (http://www.regoluna.com)
 *
 * This file is part of "Regoluna® Spanish Invoices" module.
 *
 * "Regoluna® Spanish Invoices" is free software: you can redistribute it and/or 
 * modify it under the terms of the GNU Lesser General Public License as published 
 * by the Free Software Foundation, version 3 of the License.
 *   
 ********************************************************************************/

$dictionary['fact_Facturas'] = array(
	'table'=>'fact_facturas',
	'audited'=>true,
	'fields'=>array (
  
	'numero' => array (
    'required' => false,
    'name' => 'numero',
    'vname' => 'LBL_NUMERO',
    'type' => 'int',
    'massupdate' => 0,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => 1,
    'reportable' => 0,
    'len' => '11',
    //'disable_num_format' => true,
  ),
  'year' => array (
    'required' => false,
    'name' => 'year',
    'vname' => 'LBL_YEAR',
    'type' => 'int',
    'massupdate' => 0,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => 1,
    'reportable' => 0,
    'len' => '11',
    'disable_num_format' => true,
  ),
  'date_closed' => 
  array (
    'required' => '1',
    'name' => 'date_closed',
    'vname' => 'LBL_FECHA_EMISION',
    'type' => 'date',
    'massupdate' => 0,
    'comments' => '',
    'help' => 'Fecha de emisión de la factura',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => 1,
    'reportable' => 0,
    'display_default' => 'now',
  ),
  'description' =>
  array (
    'name' => 'description',
    'vname' => 'LBL_DESCRIPTION',
    'dbtype' => 'text',
    'type' => 'Htmledit',
    'comment' => 'The description of the invoice'
  ),
  
  'descuento' => 
  array (
    'required' => false,
    'name' => 'descuento',
    'vname' => 'LBL_DESCUENTO',
    'type' => 'varchar',
    'massupdate' => 0,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => 1,
    'reportable' => 0,
    'len' => '25',
    //'disable_num_format' => '1'
  ),
  'repercutido' => 
  array (
    'required' => false,
    'name' => 'repercutido',
    'vname' => 'LBL_REPERCUTIDO',
    'type' => 'float',
    //'dbtype' => 'float',
    'massupdate' => 0,
    'default' => NULL,
    'comments' => '',
    'help' => 'Si se indica un valor, se aplicará a todos los productos',
    'importable' => 'true',
    'audited' => 0,
    'reportable' => 0,
    //'len' => '18',
    'precision' => '0',
    'disable_num_format' => '0'    
),
  'tipo_repercutido' => 
  array (
    'required' => false,
    'name' => 'tipo_repercutido',
    'vname' => 'LBL_TIPO_IMPUESTO',
    'type' => 'enum',
    'options' => 'tipo_impuesto_dom',
    //'dbtype' => 'float',
    'massupdate' => 0,
    'default' => '01',
    'comments' => '',
    'help' => 'Si se indica un valor, se aplicará a todos los productos',
    'importable' => 'true',
    'audited' => 0,
    'reportable' => 0,
    'len' => '18',
    'precision' => '0',
    'disable_num_format' => '1'
  ),
  'retencion' => 
  array (
    'required' => false,
    'name' => 'retencion',
    'vname' => 'LBL_RETENCION',
    'type' => 'float',
    //'options' => 'irpf_type_dom',
    //'dbtype' => 'float',
    'massupdate' => 0,
    'default' => '',
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => 0,
    'reportable' => 0,
    //'len' => '18',
    'precision' => '0',
    'disable_num_format' => '1'
  ),
  'estado' => 
  array (
    'required' => false,
    'name' => 'estado',
    'vname' => 'LBL_ESTADO',
    'type' => 'enum',
    'massupdate' => true,
    'default' => 'elaborando',
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => 1,
    'reportable' => 0,
    'len' => 100,
    'options' => 'facturas_estado_list',
    'studio' => 'visible',
  ),
    
  'condiciones' => 
  array (
    'required' => '0',
    'name' => 'condiciones',
    'vname' => 'LBL_CONDICIONES',
    'type' => 'Htmledit',
    'dbtype' => 'text',
    'massupdate' => 0,
    'duplicate_merge' => 'disabled',
    'audited' => 0,
    'reportable' => 0,
  ),
  
  // Campos calculados automáticamente.
  'total_items' => 
  array (
    'required' => false,
    'name' => 'total_items',
    'vname' => '0',
    'type' => 'float',
    'massupdate' => 0,
    'default' => NULL,
    'comments' => '',
    'help' => '',
    'importable' => false,
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => 0,
    'reportable' => 0,
    'len' => '18',
    'precision' => '2',
    //'disable_num_format' => '1'
  ),
  'total_descuento' => 
  array (
    'required' => false,
    'name' => 'total_descuento',
    'vname' => 'LBL_TOTAL_DESCUENTO',
    'type' => 'float',
    'massupdate' => 0,
    'default' => NULL,
    'comments' => '',
    'help' => '',
    'importable' => false,
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => 0,
    'reportable' => 0,
    'len' => '18',
    'precision' => '2',
    //'disable_num_format' => '1'
  ),
  'total_base' => 
  array (
    'required' => false,
    'name' => 'total_base',
    'vname' => 'LBL_TOTAL_BASE',
    'type' => 'float',
    'massupdate' => 0,
    'default' => NULL,
    'comments' => '',
    'help' => '',
    'importable' => false,
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => 0,
    'reportable' => 0,
    'len' => '18',
    'precision' => '2',
    //'disable_num_format' => '1'
  ),
  'total_iva' => 
  array (
    'required' => false,
    'name' => 'total_iva',
    'vname' => 'LBL_TOTAL_IVA',
    'type' => 'float',
    'massupdate' => 0,
    'default' => NULL,
    'comments' => '',
    'help' => '',
    'importable' => false,
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => 0,
    'reportable' => 0,
    'len' => '18',
    'precision' => '2',
//    'disable_num_format' => '0'
  ),
  'total_retencion' => 
  array (
    'required' => false,
    'name' => 'total_retencion',
    'vname' => 'LBL_TOTAL_RETENCION',
    'type' => 'float',
    'massupdate' => 0,
    'default' => NULL,
    'comments' => '',
    'help' => '',
    'importable' => false,
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => 0,
    'reportable' => 0,
    'len' => '18',
    'precision' => '2',
    //'disable_num_format' => '1'
  ),
  'impuesto_unico' => array (
        'massupdate' => false,
        'name' => 'impuesto_unico',
        'vname' => 'LBL_IMPUESTO_UNICO',
        'type' => 'bool',
  ),
  'retencion_unica' => array (
        'massupdate' => false,
        'name' => 'retencion_unica',
        'vname' => 'LBL_IMPUESTO_UNICO',
        'type' => 'bool',
  ),
      
  // Enlace para el subpanel de Items
  "items" => array (
    'name' => 'items',
    'type' => 'link',
    'relationship' => 'factura_items',
    'source' => 'non-db',
    'vname' => 'LBL_ITEMS',
  ),
  
  // 3 Campos para la relación con Cuenta (obligatoria)
  "accounts_fact_facturas" => array (
    'name' => 'accounts_fact_facturas',
    'type' => 'link',
    'relationship' => 'accounts_fact_facturas',
    'source' => 'non-db',
    'side' => 'right',
    'vname' => 'LBL_ACCOUNT',
    'required' => true,
  ),
  "accounts_fact_facturas_name" => array (
    'name' => 'accounts_fact_facturas_name',
    'type' => 'relate',
    'source' => 'non-db',
    'vname' => 'LBL_ACCOUNT',
    'save' => true,
    'required' => true,
    'id_name' => 'accounts_f4ffcccounts_ida',
    'link' => 'accounts_fact_facturas',
    'table' => 'accounts',
    'module' => 'Accounts',
    'rname' => 'name',
  ),
  "accounts_f4ffcccounts_ida" => array (
    'name' => 'accounts_f4ffcccounts_ida',
    'type' => 'link',
    'relationship' => 'accounts_fact_facturas',
    'source' => 'non-db',
    'side' => 'right',
    'vname' => 'LBL_ACCOUNT',
  ),
  
  // Para el Subpanel con NOTAS
  'notes' =>
  array (
    'name' => 'notes',
    'type' => 'link',
    'relationship' => 'factura_notes',
    'module'=>'Notes',
    'bean_name'=>'Note',
    'source'=>'non-db',
    'vname'=>'LBL_NOTES',
  ),
  
),

'relationships'=>array (
  'factura_notes' => array(
    'lhs_module'=> 'fact_Facturas', 
    'lhs_table'=> 'fact_facturas', 
    'lhs_key' => 'id', 
    'rhs_module'=> 'Notes', 
    'rhs_table'=> 'notes', 
    'rhs_key' => 'parent_id',
    'relationship_type'=>'one-to-many', 
    'relationship_role_column'=>'parent_type',                  
    'relationship_role_column_value'=>'fact_Facturas'
  ),
),

'optimistic_lock'=>true,
);

require_once('include/SugarObjects/VardefManager.php');
VardefManager::createVardef('fact_Facturas','fact_Facturas', array('basic','assignable','sale'));