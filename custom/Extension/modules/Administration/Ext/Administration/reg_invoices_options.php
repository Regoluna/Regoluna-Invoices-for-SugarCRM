<?php
// *******************************
// REGOLUNA INVOICES Configuration sections 
// *******************************

if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
/**
 * Copyright (c) 2008-2010 Rodrigo Saiz Camarero (http://www.regoluna.com)
 * All rights reserved.
 *
 * Permission is granted for use, copying, modification, distribution,
 * and distribution of modified versions of this work as long as the
 * above copyright notice is included.
 * 
 * @package reg_invoices
 * @author Rodrigo Saiz Camarero <rodrigo@regoluna.com>
 */

require_once 'modules/Administration/UpgradeHistory.php';

$admin_option_defs = array();

// Invoice options
$admin_option_defs[] = array(
  'reg_invoices',
  'LBL_FACT_CONFIG',
  'LBL_FACT_CONFIG_DESC',
  './index.php?module=reg_invoices&action=Config',
);

// Dependencies checker
//// temporarily disabled

//$admin_option_defs[] = array(
//  'Administration',
//  'LBL_FACT_CHECK',
//  'LBL_FACT_CHECK_DESC',
//  './index.php?module=Administration&action=reg_invoices_Check',
//);

// Multiple 
$admin_option_defs[] = array(
  'icon_Address',
  'LBL_FACT_COMPANIES',
  'LBL_FACT_COMPANIES_DESC',
  './index.php?module=reg_companies',
);

/*
 * Add administration options to page
 * Supports:
 */
$US = new UpgradeHistory;

/*
 * Prepare for < 5.5
 */
$minimal = explode(".", "5.5.0");
$current = explode(".", $GLOBALS['sugar_version']);
if (!$US->is_right_version_greater($minimal, $current, true)) {
  foreach($admin_option_defs AS $key=>$val) {
    //Add $image_path
    $admin_option_defs[$key][0] = $image_path . $admin_option_defs[$key][0];
  }
}

$minimal = explode(".", "5.2.0");
$current = explode(".", $GLOBALS['sugar_version']);
// 5.2 and later
if ($US->is_right_version_greater($minimal, $current, true)) {
  $admin_group_header[] = array(
    'LBL_FACT_CONFIG_GROUP',
    '',
    false,
    array("Administration" => $admin_option_defs),
    'LBL_FACT_CONFIG_GROUP_DESC',
  );
//5.1 and earlier
} else {
  $admin_group_header[] = array(
    'LBL_FACT_CONFIG_GROUP',
    '',
    false,
    $admin_option_defs,
    'LBL_FACT_CONFIG_GROUP_DESC',
  );
}
