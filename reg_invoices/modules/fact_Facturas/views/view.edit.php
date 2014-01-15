<?php
require_once('include/MVC/View/views/view.edit.php');

class fact_FacturasViewEdit extends ViewEdit {

  function display() {
    
    // Solo al crear nuevas facturas añadimos los valores por defecto
    // indicados en la sección de configuración.
    if(!$this->bean->id){
      
      $condiciones = trim($GLOBALS['sugar_config']['fact_conditions']);
      if($condiciones){
        $this->bean->condiciones = $condiciones;
      }
      $tipo_repercutido = trim($GLOBALS['sugar_config']['fact_default_tax_type']);
      if($tipo_repercutido){
        $this->bean->tipo_repercutido = $tipo_repercutido;
      }
      $repercutido = trim($GLOBALS['sugar_config']['fact_default_tax']);
      if($repercutido){
        $this->bean->repercutido = $repercutido;
      }
      $retencion = trim($GLOBALS['sugar_config']['fact_default_retention']);
      if($retencion){
        $this->bean->retencion = $retencion;
      }
    }
    
    parent::display();
  }
  
}