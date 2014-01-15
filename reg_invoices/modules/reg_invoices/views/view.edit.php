<?php
require_once('include/MVC/View/views/view.edit.php');

class reg_invoicesViewEdit extends ViewEdit {

  function display() {
    
    // Solo al crear nuevas facturas añadimos los valores por defecto
    // indicados en la sección de configuración.
    if(!$this->bean->id){
      
      $conditions = trim($GLOBALS['sugar_config']['fact_conditions']);
      if($conditions){
        $this->bean->conditions = $conditions;
      }
      $tax_type = trim($GLOBALS['sugar_config']['fact_default_tax_type']);
      if($tax_type){
        $this->bean->tax_type = $tax_type;
      }
      $output_tax = trim($GLOBALS['sugar_config']['fact_default_tax']);
      if($output_tax){
        $this->bean->output_tax = $output_tax;
      }
      $retention = trim($GLOBALS['sugar_config']['fact_default_retention']);
      if($retention){
        $this->bean->retention = $retention;
      }
    }
    
    parent::display();
  }
  
}