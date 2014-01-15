<?PHP
/*********************************************************************************
 * 
 * Copyright (C) 2008 Rodrigo Saiz Camarero (http://www.regoluna.com)
 *
 * This file is part of "Regoluna® Spanish Invoices" module.
 *
 * "Regoluna® Spanish Invoices" is free software: you can redistribute it and/or 
 * modify it under the terms of the GNU Lesser General Public License as published 
 * by the Free Software Foundation, version 3 of the License.
 *   
 ********************************************************************************/
require_once('modules/fact_Items/fact_Items_sugar.php');

if(file_exists('modules/fact_Facturas/fact_Facturas.php')){
  require_once('modules/fact_Facturas/fact_Facturas.php');
}
class fact_Items extends fact_Items_sugar {
	
	function fact_Items(){	
		parent::fact_Items_sugar();
	}
	
	// Al guardar, tendremos que actualizar varios campos:
	//  * Total del item (aplicando descuentos e impuestos)
	//  * Peso: indica el orden dentro de la lista de Items
	//  * Factura: obliga a la factura asociada a recalcular sus totales
	function save($check_notify = FALSE){
	  
	  // Antes de guardar, si no tiene un "Peso" que indique el orden, le ponemos el último
	  if(!$this->orden && $_POST['relate_id']){
  	  $sql = " SELECT MAX(orden) orden".
  	         " FROM fact_factura_items f LEFT JOIN fact_items i ON (f.item_id=i.id AND f.deleted=0 AND i.deleted=0)".
  	         " WHERE factura_id = '{$_POST['relate_id']}' ";
  	  $result = $this->db->query($sql);
      $row = $this->db->fetchByAssoc($result);
      $orden = $row['orden']; 
      if(is_numeric($orden) && $orden>0){
         $this->orden=$orden+1;
      }else{
        $this->orden=1;
      }
	  }
	  
	  // Calculamos el Total antes de impuestos
	  if($this->descuento && $this->descuento!=0){
	    
	    $preDescuento=$this->cantidad * $this->precio_ud;
      $descuento = 0;
      
      if($this->descuento[strlen($this->descuento)-1] == '%'){
        $descuento = substr($this->descuento,0,strlen($this->descuento)-1);
        $this->total_descuento = ( $preDescuento * ($descuento+0) / 100 );
        $this->total_antes = $preDescuento - $this->total_descuento;
      }else{
        if($this->descuento +0 >= $preDescuento){
          $this->total_antes = 0;
          $this->total_descuento = $preDescuento;
        }else{
          //$preDescuento = $this->descuento;
          $this->total_antes = $preDescuento - ($this->descuento+0);
          $this->total_descuento = $this->descuento;
        }
      }
	  }else{
	    $this->total_antes = $this->cantidad * $this->precio_ud;
	    $this->total_descuento = 0;
	  }
	  
	  // Calculamos el total de Impuestos (si los hubiera)
	  if($this->impuesto && is_numeric($this->impuesto) && $this->impuesto>0 ){
	    $this->total_impuesto = $this->total_antes * ($this->impuesto / 100);
	  }else{
	    $this->total_impuesto = '';
	    $this->impuesto = '';
	  }
	  
	  // Calculamos la retención
    if($this->retencion && is_numeric($this->retencion) && $this->retencion>0 ){
      $this->total_retencion = $this->total_antes * ($this->retencion / 100);
    }else{
      $this->total_retencion = '';
      $this->retencion = '';
    }

    // Si se está ordenando, los datos están como se guardan en la base de datos
    // hay que desformatearlos para que al llamar a save() no se estropicien.
    if(strtolower( $_REQUEST['ordenar'] ) == 'up'){
      $this->format_all_fields();
    }
    parent::save($check_notify);
    
    // Asociamos con la Factura correspondiente.
    if($_POST['relate_id']){
      $factura = new fact_Facturas();
      $factura->retrieve($_POST['relate_id']);
      $factura->calcularTotal();
      $factura->save();
    }
    
	}
	
  /**
   * Formatea algunos campos para su visualizacion en los listados
   */
  function fill_in_additional_list_fields(){
    global $app_list_strings;
    
    parent::fill_in_additional_list_fields();
    $this->format_all_fields();
    
    if($this->unidad_custom){
      $this->cantidad = "$this->cantidad <i>$this->unidad_custom</i>";
    }else if ($this->unidad != '05'){
      $this->cantidad = "$this->cantidad <i>".$app_list_strings['item_unit_dom'][$this->unidad]."</i>";
    }

  }
	
}
?>