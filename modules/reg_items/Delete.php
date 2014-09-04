<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once('include/utils.php');
require_once('include/formbase.php');

require_once('modules/reg_items/reg_items.php');
if(file_exists('modules/reg_invoices/reg_invoices.php')){
  require_once('modules/reg_invoices/reg_invoices.php');
}
$sugarbean = new reg_items();

// perform the delete if given a record to delete
if(empty($_REQUEST['record']))
{
	$GLOBALS['log']->info('delete called without a record id specified');
}
else
{
	$record = $_REQUEST['record'];
	$sugarbean->retrieve($record);
	if(!$sugarbean->ACLAccess('Delete')){
		ACLController::displayNoAccess(true);
		sugar_cleanup(true);
	}
	$GLOBALS['log']->info("deleting Item: $record");

	// Antes de borrar, obtenemos el ID de la factura
  $sql = " select invoice_id from invoice_items where deleted=0 and id = '$record' ";
  $result = $sugarbean->db->query($sql);
  $row = $sugarbean->db->fetchByAssoc($result);
  $invoice_id = $row['invoice_id'];
	
	// Borramos el Item
	$sugarbean->mark_deleted($record);

	// Actualizamos la factura asociada.
  if($invoice_id){
    $invoice = new reg_invoices();
    $invoice->retrieve($invoice_id);
    $invoice->calcularTotal();
    $invoice->save();
  }

}

// handle the return location variables
if(!empty($_REQUEST['return_url'])){
  $_REQUEST['return_url'] =urldecode($_REQUEST['return_url']);
}
$GLOBALS['log']->debug("deleted Item: bean: $bean_name, " );
if(empty($_REQUEST['refresh_page'])){
  handleRedirect();
}

exit;