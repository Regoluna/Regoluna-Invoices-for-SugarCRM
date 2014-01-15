<?php

/**
 *
 * @author Rodrigo Saiz (rodrigo@regoluna.com)
 *
 */
class RegInvoicesUnitTestCase extends SugarUnitTestCase {
  
  /**
   * SugarCRM database abstraction.
   *
   * @var unknown_type
   */
  protected $db;
  
  /**
   *
   * @var Array $to_remove
   */
  protected $to_remove = array();
  
  function __construct( $name = '' ) {
    parent::__construct( $name );
    $this->db = DBManagerFactory::getInstance();
  }
  
  
  function tearDown() {

    // Remove created beans.
    foreach( $this->to_remove as $object){
      if( is_a($object, 'SugarBean')   ){
        $table = $object->getTableName();
        $object->mark_deleted($object->id );
        $this->db->query("DELETE FROM $table WHERE id = '$object->id' ");
        $this->db->query("DELETE FROM {$table}_audit WHERE parent_id = '$object->id' ");
        unset($object);
      }
    }
    $this->to_remove = array();
    
  }
  
  
  /**
   * Creates one invoice for testing.
   * This bean will be removed from DB when the test has finished.
   */
  function getInvoice(){
    $invoice = new REGINV_INV_BEAN_NAME();
    $this->to_remove[] = $invoice;
    return $invoice;
  }
  
} // End Tests
