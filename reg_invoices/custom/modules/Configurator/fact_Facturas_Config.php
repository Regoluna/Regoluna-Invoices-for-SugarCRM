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
 * @package fact_Facturas
 * @author Rodrigo Saiz Camarero <rodrigo@regoluna.com>
 */


if (!defined('sugarEntry') || !sugarEntry)
  die('Not A Valid Entry Point');

if (!is_admin($current_user)) {
  sugar_die($app_strings['ERR_NOT_ADMIN']);
}

// Cargamos el idioma adecuado.
if(empty($_SESSION['authenticated_user_language'])) {
  $current_language = $sugar_config['default_language'];
} else {
  $current_language = $_SESSION['authenticated_user_language'];
}

if(file_exists('custom/modules/Configurator/Ext/Language/'.$current_language.'.lang.ext.php')) {
  require_once 'custom/modules/Configurator/Ext/Language/'.$current_language.'.lang.ext.php';
} else {
  require_once 'custom/modules/Configurator/Ext/Language/en_us.lang.ext.php';
}   


require_once 'include/Sugar_Smarty.php';

//require_once 'modules/Configurator/Forms.php';
echo get_module_title($mod_strings['LBL_MODULE_ID'], $mod_strings['LBL_FACT_CONF_TITLE'], false);
require_once 'modules/Configurator/Configurator.php';

require_once 'modules/Accounts/Account.php';

// Country code, debe ser ESP por defecto
if(!$sugar_config['fact_country_code']) $sugar_config['fact_country_code']="ESP";

$configurator = new Configurator();
$focus = new Administration();

//Add hidden options to configurable options
$configurator->allow_undefined[] = 'fact_person_type_code'; // Tipo de persona. Física o Jurídica. "F" - Física; "J" - Jurídica. 
$configurator->allow_undefined[] = 'fact_residence_type_code'; // Tipo de persona. Física o Jurídica. "F" - Física; "J" - Jurídica.  (Para la beta dejar en J)
$configurator->allow_undefined[] = 'fact_tax_number'; // NIF / CIF del facturador
$configurator->allow_undefined[] = 'fact_corporate_name'; // Razón social de la persona jurídica o nombre de persona física
$configurator->allow_undefined[] = 'fact_trade_name_surname1'; // Nombre comercial de la persona jurídica o apellido 1 de la física
$configurator->allow_undefined[] = 'fact_registration_surname2'; // Datos registrales de la persona jurídica o apellido 2 de la física
$configurator->allow_undefined[] = 'fact_address'; // Dirección. Tipo de vía, nombre, número, piso…
$configurator->allow_undefined[] = 'fact_post_code'; // Códi
$configurator->allow_undefined[] = 'fact_town'; // Población. Correspondiente al C.P.
$configurator->allow_undefined[] = 'fact_province'; // Provincia. Donde está situada la Población.
$configurator->allow_undefined[] = 'fact_country_code'; // Código País. Código según la ISO 3166-1:2006 Alpha-3.
$configurator->allow_undefined[] = 'fact_path_to_logo';
$configurator->allow_undefined[] = 'fact_account_nif_field'; // Que campo de cuenta se usa para el CIF del cliente.
$configurator->allow_undefined[] = 'fact_restart_number'; // Que campo de cuenta se usa para el CIF del cliente.
$configurator->allow_undefined[] = 'fact_conditions'; // Que campo de cuenta se usa para el CIF del cliente.
$configurator->allow_undefined[] = 'fact_default_tax_type'; // Tipo de impuesto por defecto
$configurator->allow_undefined[] = 'fact_default_tax'; // Porcentaje de impuesto por defecto
$configurator->allow_undefined[] = 'fact_default_retention'; // Porcentaje de retencion por defecto

if (!empty($_POST['save'])) {
  switch($_POST['dashlet_display_row_options']) {
    case "more":
      $_POST['dashlet_display_row_options'] = array(0 => '1', 1 => '3', 2 => '5', 3 => '10', 4 => '20', 5 => '30', 6 => '50');
      break;
    default:
      $_POST['dashlet_display_row_options'] = array(0 => '1', 1 => '3', 2 => '5', 3 => '10', 4 => null, 5 => null, 6 => null);
  }
  $configurator->saveConfig();
  $focus->saveConfig();
  SugarApplication::redirect('index.php?module=Administration');
}

$focus->retrieveSettings();

switch($sugar_config['dashlet_display_row_options']) {
  case array(0 => '1', 1 => '3', 2 => '5', 3 => '10', 4 => '20', 5 => '30', 6 => '50'):
    $selected_dashlet_option = "more";
    break;
  default:
    $selected_dashlet_option = "default";
}

$sugar_smarty = new Sugar_Smarty;
$sugar_smarty->assign('MOD', $mod_strings);
$sugar_smarty->assign('APP', $app_strings);
$sugar_smarty->assign('APP_LIST', $app_list_strings);
$sugar_smarty->assign('config', $configurator->config);
$sugar_smarty->assign('error', $configurator->errors);
// $sugar_smarty->assign("JAVASCRIPT", get_set_focus_js() . get_configsettings_js());
$sugar_smarty->assign("settings", $focus->settings);
$selected = (empty($sugar_config['save_query'])) ? "all" : $sugar_config['save_query'];
$sugar_smarty->assign("cwd", getcwd());

// Asignamos los desplegables
$sugar_smarty->assign("residence_type_options", get_select_options_with_id($mod_strings['residence_type_options'],$sugar_config['fact_residence_type_code']));
$sugar_smarty->assign("person_type_code_options", get_select_options_with_id($mod_strings['person_type_code_options'],$sugar_config['fact_person_type_code']));
$sugar_smarty->assign("tipo_impuesto_dom", get_select_options_with_id($app_list_strings['tipo_impuesto_dom'],$sugar_config['fact_default_tax_type']));

// El desplegable de "CIF" es especial.
$account = new Account();
//print_r($account);
$field_options=array();
foreach($account->field_name_map as $field=>$data){
  $field_options[$field]=$field;
}
$sugar_smarty->assign("account_fields_options", get_select_options_with_id($field_options,$sugar_config['fact_account_nif_field']));


$sugar_smarty->display('custom/modules/Configurator/tpls/fact_Facturas_Config.tpl');

require_once "include/javascript/javascript.php";
$javascript = new javascript();
$javascript->setFormName("ConfigureSettings");
echo $javascript->getScript();
