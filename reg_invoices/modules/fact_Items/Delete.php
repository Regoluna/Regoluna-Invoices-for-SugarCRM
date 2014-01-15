<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once('include/utils.php');
require_once('include/formbase.php'); 

require_once('modules/fact_Items/fact_Items.php');
if(file_exists('modules/fact_Facturas/fact_Facturas.php')){
  require_once('modules/fact_Facturas/fact_Facturas.php');
}
$sugarbean = new fact_Items();

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
  $sql = " select factura_id from fact_factura_items where deleted=0 and item_id = '$record' ";  
  $result = $sugarbean->db->query($sql);
  $row = $sugarbean->db->fetchByAssoc($result);
  $factura_id = $row['factura_id'];
	
	// Borramos el Item
	$sugarbean->mark_deleted($record);

	// Actualizamos la factura asociada.  
  if($factura_id){
    $factura = new fact_Facturas();
    $factura->retrieve($factura_id);
    $factura->calcularTotal();
    $factura->save();
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