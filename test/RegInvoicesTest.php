<?php

define("REGINV_INV_BEAN_NAME", 'reg_invoices');
define("REGINV_ITEM_BEAN_NAME", 'fact_Item');



/**
 * Regoluna Invoices Unit and Integration tests.
 */

// Init SugarCRM. Only if you need to invoque this test outside Sugar admin section.

if(!defined('sugarEntry') || !sugarEntry) {
  chdir('../../../');
  // initialize sugarcrm environment _before_ doing anything else
  define('sugarEntry', TRUE);
  require_once('include/utils.php');
  require_once('include/modules.php');
  require_once('include/entryPoint.php');
  require_once('include/simpletest/autorun.php');
}

/**
 *
 * @author Rodrigo Saiz (rodrigo@regoluna.com)
 *
 * Basic tests for amount operations: taxes, discounts...
 *
 */
class RegInvoicesTest extends SugarUnitTestCase {
  
  function __construct() {
    parent::__construct( 'Basic Use Case Test' );
  }
  
  function getInvoice(){
    $invoice = $this->getBean( REGINV_INV_BEAN_NAME );
    $invoice->name = 'Invoice Test ' . microtime();
  }
  
  function getItem(){
    $item = $this->getBean( REGINV_ITEM_BEAN_NAME );
    $item->name = 'Foo Item ' . microtime();
    $item->unit_price = rand(1, 200);
    $item->qty = rand(1, 10);
  }
  
  function TestItemSum(){
    $invoice = $this->getInvoice();
    $invoice->save(); // Only saved invoices can have Items
    
    $item1 = $this->getItem();
    $item2 = $this->getItem();
    
    
    $this->assertTrue( true , 'Una prueba con un test correcto.' );
  }
  
} // End Tests




