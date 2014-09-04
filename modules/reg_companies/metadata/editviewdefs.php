<?php

$module_name = 'reg_companies';
$viewdefs[$module_name]['EditView'] = array(
  
  'templateMeta' => array(
    'maxColumns' => '2',
    'widths' => array(
      array('label' => '10', 'field' => '30'), 
      array('label' => '10', 'field' => '30')
    ),                                                                                                                                    
  ),

  'panels' =>array (
    
    'default' => array (
      array ( 'name', 'name2' ),
      array ( 'nif', 'name3'  ),
      array ( 'description' ),
    ),
    
    'lbl_billing_address_panel' => array (
      array(
        array (
            'name' => 'billing_address_street',
            'type' => 'address',
            'hideLabel' => true,
            'displayParams' =>  array (
              'key' => 'billing',
              'rows' => 2,
              'cols' => 30,
              'maxlength' => 150,
            ),
        ),
      ),
    ),
    
    'lbl_facturae_panel' => array (
      array( 'residence',  'type' ),
    ),
    
  ),
  
);
?>