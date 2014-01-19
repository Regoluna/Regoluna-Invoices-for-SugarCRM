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

$dictionary['reg_invoices'] = array(
	'table'=>'reg_invoices',
	'audited'=>true,
	'fields'=>array (

	'number' => array (
    'required' => false,
    'name' => 'number',
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

  'discount' =>
  array (
    'required' => false,
    'name' => 'discount',
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
  'output_tax' =>
  array (
    'required' => false,
    'name' => 'output_tax',
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
  'tax_type' =>
  array (
    'required' => false,
    'name' => 'tax_type',
    'vname' => 'LBL_TIPO_IMPUESTO',
    'type' => 'enum',
    'options' => 'reg_tax_type_dom',
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
  'retention' =>
  array (
    'required' => false,
    'name' => 'retention',
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
  'state' =>
  array (
    'required' => false,
    'name' => 'state',
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
    'options' => 'reg_invoice_state_dom',
    'studio' => 'visible',
  ),

  'conditions' =>
  array (
    'required' => '0',
    'name' => 'conditions',
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
  'total_discount' =>
  array (
    'required' => false,
    'name' => 'total_discount',
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
  'total_tax' =>
  array (
    'required' => false,
    'name' => 'total_tax',
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
  'total_retention' =>
  array (
    'required' => false,
    'name' => 'total_retention',
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
  'unique_tax' => array (
        'massupdate' => false,
        'name' => 'unique_tax',
        'vname' => 'LBL_IMPUESTO_UNICO',
        'type' => 'bool',
  ),
  'unique_retention' => array (
        'massupdate' => false,
        'name' => 'unique_retention',
        'vname' => 'LBL_IMPUESTO_UNICO',
        'type' => 'bool',
  ),
 
	// For items subpanel
  'items'=> array(
    'name' => 'items',
    'type' => 'link',
    'relationship' => 'invoice_items',
    'module'=>'reg_items',
    'bean_name'=>'reg_items',
    'source'=>'non-db',
    'vname'=>'LBL_ITEMS',
  ),

  // 3 Campos para la relación con Cuenta (obligatoria)
  "accounts_reg_invoices" => array (
    'name' => 'accounts_reg_invoices',
    'type' => 'link',
    'relationship' => 'accounts_reg_invoices',
    'source' => 'non-db',
    'side' => 'right',
    'vname' => 'LBL_ACCOUNT',
    'required' => true,
  ),
  "accounts_reg_invoices_name" => array (
    'name' => 'accounts_reg_invoices_name',
    'type' => 'relate',
    'source' => 'non-db',
    'vname' => 'LBL_ACCOUNT',
    'save' => true,
    'required' => true,
    'id_name' => 'accounts_f4ffcccounts_ida',
    'link' => 'accounts_reg_invoices',
    'table' => 'accounts',
    'module' => 'Accounts',
    'rname' => 'name',
  ),
  "accounts_f4ffcccounts_ida" => array (
    'name' => 'accounts_f4ffcccounts_ida',
    'type' => 'link',
    'relationship' => 'accounts_reg_invoices',
    'source' => 'non-db',
    'side' => 'right',
    'vname' => 'LBL_ACCOUNT',
  ),

  // Para el Subpanel con NOTAS
  'notes' =>
  array (
    'name' => 'notes',
    'type' => 'link',
    'relationship' => 'invoice_notes',
    'module'=>'Notes',
    'bean_name'=>'Note',
    'source'=>'non-db',
    'vname'=>'LBL_NOTES',
  ),

),

'relationships'=>array (
  'invoice_notes' => array(
    'lhs_module'=> 'reg_invoices',
    'lhs_table'=> 'reg_invoices',
    'lhs_key' => 'id',
    'rhs_module'=> 'Notes',
    'rhs_table'=> 'notes',
    'rhs_key' => 'parent_id',
    'relationship_type'=>'one-to-many',
    'relationship_role_column'=>'parent_type',
    'relationship_role_column_value'=>'reg_invoices'
  ),
  'invoice_items' => array(
    'lhs_module'=> 'reg_invoices',
    'lhs_table'=> 'reg_invoices',
    'lhs_key' => 'id',
    'rhs_module'=> 'reg_items',
    'rhs_table'=> 'reg_items',
    'rhs_key' => 'invoice_id',
    'relationship_type'=>'one-to-many',
  ),
),

'optimistic_lock'=>true,
);

require_once('include/SugarObjects/VardefManager.php');
VardefManager::createVardef('reg_invoices','reg_invoices', array('basic','assignable','sale'));