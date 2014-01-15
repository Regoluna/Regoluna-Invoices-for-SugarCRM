<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once('include/utils.php');
require_once('include/formbase.php'); 

require_once('modules/fact_Items/fact_Items.php');

// perform the reorder if a record is given
if(empty($_REQUEST['record']))
{
	$GLOBALS['log']->info('Up Down called without a record id specified');
}
else
{
  $sugarbean = new fact_Items();
	$record = $_REQUEST['record'];
	$sugarbean->retrieve($record);
	
	// Opciones de busqueda:
	$buscar = null;
	if(strtolower( $_REQUEST['ordenar'] ) == 'up'){
	  $buscar = "< $sugarbean->orden";
	  $seleccionar = "MAX(orden)";
	}else if(strtolower( $_REQUEST['ordenar'] ) == 'down'){
    $buscar = "> $sugarbean->orden";
    $seleccionar = "MIN(orden)";
	}
	
	// Si sabemos que item buscamos
	if($buscar){
	  // Obtenemos el ID del item superior o inferior
	  $sql = " SELECT i.id id ".
	         " FROM fact_items i LEFT JOIN fact_factura_items f ON (i.id=f.item_id AND f.deleted=0 ) ".
	         " WHERE i.deleted=0 ".
	         " AND   f.factura_id = '{$_REQUEST['factid']}' ".
	         " AND   i.orden = ".
	         "  ( SELECT $seleccionar FROM fact_items i2 LEFT JOIN fact_factura_items f2 ON(f2.item_id=i2.id AND f2.deleted=0) ".
	         "    WHERE f2.factura_id='{$_REQUEST['factid']}' AND i2.orden  $buscar  )";
    $result = $sugarbean->db->query($sql);
    $row = $sugarbean->db->fetchByAssoc($result);
    $item_id = $row['id'];
    
    // Si encontramos el item superior o inferior, intercambiamos sus valores.
    if($item_id){
      $otro = new fact_Items();
      $otro->retrieve($item_id);
      $temp = $otro->orden;
      $otro->orden=$sugarbean->orden;
      $otro->save();
      $sugarbean->orden=$temp;
      $sugarbean->save();
    }
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