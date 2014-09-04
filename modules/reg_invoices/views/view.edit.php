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
    
    if( !empty( $_REQUEST['isDuplicate'] ) && $_REQUEST['isDuplicate'] !== 'false' ){
      
      $this->bean->number = null;
      
      $timedate = TimeDate::getInstance();
      $this->bean->date_closed = $timedate->asUserDate(new SugarDateTime(), $GLOBALS['current_user']);
      
      if( !empty($this->bean->name) ) $this->bean->name = $this->bean->name . ' (' . translate('LBL_COPY', 'reg_invoices') . ')';
      
      if( $this->bean->reg_invoices_type == 'invoice' ) $this->bean->state = 'invoice_in_process';
      elseif ( $this->bean->reg_invoices_type == 'quote' ) $this->bean->state = 'quote_in_process';
    }
    
    parent::display();
  }
  
}