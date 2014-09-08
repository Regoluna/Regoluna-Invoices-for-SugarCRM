<?php

/**
 * Copyright (c) 2008 SugarDev.net (http://www.sugardev.net)
 * All rights reserved.
 *
 * Permission is granted for use, copying, modification, distribution,
 * and distribution of modified versions of this work as long as the
 * above copyright notice is included.
 *
 * @file sugardev_HiddenConfig.php
 * @package reg_invoices
 * @author Rodrigo Saiz Camarero <rodrigo@regoluna.com>
 */
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
if (!is_admin($current_user)) sugar_die($app_strings['ERR_NOT_ADMIN']);

require_once 'include/Sugar_Smarty.php';
require_once 'modules/Configurator/Configurator.php';
require_once 'modules/Accounts/Account.php';

// Load language
$lang = empty($_SESSION['authenticated_user_language']) ? $sugar_config['default_language'] : $_SESSION['authenticated_user_language'];

if( file_exists('modules/reg_invoices/language/'.$lang.'.lang.php') ) {
  require_once 'modules/reg_invoices/language/'.$lang.'.lang.php';
}else{
  require_once 'modules/reg_invoices/language/en_us.lang.php';
}

if(file_exists('custom/modules/reg_invoices/Ext/Language/'.$lang.'.lang.ext.php')) {
  require_once 'custom/modules/reg_invoices/Ext/Language/'.$lang.'.lang.ext.php';
}


echo get_module_title($mod_strings['LBL_MODULE_ID'], $mod_strings['LBL_FACT_CONF_TITLE'], false);


//
// Configuration Process
// =======================

$configurator = new Configurator();

//Add hidden options to configurable options
$configurator->allow_undefined[] = 'fact_path_to_logo';
$configurator->allow_undefined[] = 'fact_account_nif_field'; // Que campo de cuenta se usa para el CIF del cliente.
$configurator->allow_undefined[] = 'fact_restart_number'; // Que campo de cuenta se usa para el CIF del cliente.
$configurator->allow_undefined[] = 'fact_conditions'; // Que campo de cuenta se usa para el CIF del cliente.
$configurator->allow_undefined[] = 'fact_default_tax_type'; // Tipo de impuesto por defecto
$configurator->allow_undefined[] = 'fact_default_tax'; // Porcentaje de impuesto por defecto
$configurator->allow_undefined[] = 'fact_default_retention'; // Porcentaje de.retention.por defecto

if (!empty($_POST['save'])) {
  $configurator->saveConfig();
  SugarApplication::redirect('index.php?module=Administration');
}


// Show config form
$sugar_smarty = new Sugar_Smarty;
$sugar_smarty->assign('MOD', $mod_strings);
$sugar_smarty->assign('APP', $app_strings);
$sugar_smarty->assign('APP_LIST', $app_list_strings);
$sugar_smarty->assign('config', $configurator->config);
$sugar_smarty->assign('error', $configurator->errors);
$sugar_smarty->assign("cwd", getcwd());

// Dropdowns
$sugar_smarty->assign("residence_type_options", get_select_options_with_id($mod_strings['residence_type_options'],$sugar_config['fact_residence_type_code']));
$sugar_smarty->assign("person_type_code_options", get_select_options_with_id($mod_strings['person_type_code_options'],$sugar_config['fact_person_type_code']));
$sugar_smarty->assign('reg_tax_type_dom', get_select_options_with_id($app_list_strings['reg_tax_type_dom'],$sugar_config['fact_default_tax_type']));

// Special Dropdown for NIF / Tax number.
$account = new Account();
$field_options=array();
foreach($account->field_name_map as $field=>$data){
  if( $data['type'] == 'varchar' && strpos( $field, 'address') === false ){
    $field_options[$field]=$field;
  }
}
$sugar_smarty->assign("account_fields_options", get_select_options_with_id($field_options,$sugar_config['fact_account_nif_field']));


$sugar_smarty->display('modules/reg_invoices/tpls/reg_invoices_Config.tpl');

