<?php

if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

global $mod_strings, $app_strings, $sugar_config;
if(ACLController::checkAccess('reg_invoices', 'edit', true)){
  $module_menu[]=Array(
      "index.php?module=reg_invoices&action=EditView&return_module=reg_invoices&return_action=DetailView&amp;reg_invoices_type=invoice&state=invoice_in_process",
      $mod_strings['LNK_NEW_INVOICE'],
      "Createreg_invoices",
      'reg_invoices'
  );
  $module_menu[]=Array(
      "index.php?module=reg_invoices&action=EditView&return_module=reg_invoices&return_action=DetailView&amp;reg_invoices_type=quote&state=quote_in_process",
      $mod_strings['LNK_NEW_QUOTE'],
      "Createreg_invoices",
      'reg_invoices'
  );
}

if(ACLController::checkAccess('reg_invoices', 'list', true)){
  $module_menu[]=Array(
      "index.php?module=reg_invoices&action=index&return_module=reg_invoices&return_action=DetailView",
      $mod_strings['LNK_LIST'],
      "reg_invoices",
      'reg_invoices'
  );
}

