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
require_once('modules/reg_items/reg_items_sugar.php');

if(file_exists('modules/reg_invoices/reg_invoices.php')){
  require_once('modules/reg_invoices/reg_invoices.php');
}
class reg_items extends reg_items_sugar {

	function reg_items(){
		parent::reg_items_sugar();
	}

	// Al guardar, tendremos que actualizar varios campos:
	//  * Total del item (aplicando descuentos e impuestos)
	//  * Peso: indica el orden dentro de la lista de Items
	//  * Factura: obliga a la factura asociada a recalcular sus totales
	function save($check_notify = FALSE){

	  // Antes de guardar, si no tiene un "Peso" que indique el orden, le ponemos el último
	  if(!$this->ordered && !empty($_POST['relate_id']) ) {
  	  $sql = " SELECT MAX(ordered) ordered".
  	         " FROM reg_invoice_items f LEFT JOIN reg_items i ON (f.item_id=i.id AND f.deleted=0 AND i.deleted=0)".
  	         " WHERE invoice_id = '{$_POST['relate_id']}' ";
  	  $result = $this->db->query($sql);
      $row = $this->db->fetchByAssoc($result);
      $ordered = $row['ordered'];
      if(is_numeric($ordered) && $ordered>0){
         $this->ordered=$ordered+1;
      }else{
        $this->ordered=1;
      }
	  }

	  // Calculamos el Total antes de impuestos
	  if($this->discount && $this->discount!=0){

	    $preDescuento=$this->qty * $this->unit_price;
      $discount = 0;

      if($this->discount[strlen($this->discount)-1] == '%'){
        $discount = substr($this->discount,0,strlen($this->discount)-1);
        $this->total_discount = ( $preDescuento * ($discount+0) / 100 );
        $this->total_base = $preDescuento - $this->total_discount;
      }else{
        if($this->discount +0 >= $preDescuento){
          $this->total_base = 0;
          $this->total_discount = $preDescuento;
        }else{
          //$preDescuento = $this->discount;
          $this->total_base = $preDescuento - ($this->discount+0);
          $this->total_discount = $this->discount;
        }
      }
	  }else{
	    $this->total_base = $this->qty * $this->unit_price;
	    $this->total_discount = 0;
	  }

	  // Calculamos el total de Impuestos (si los hubiera)
	  if($this->tax && is_numeric($this->tax) && $this->tax>0 ){
	    $this->total_tax = $this->total_base * ($this->tax / 100);
	  }else{
	    $this->total_tax = '';
	    $this->tax = '';
	  }

	  // Calculamos la retención
    if($this->retention && is_numeric($this->retention) && $this->retention>0 ){
      $this->total_retention = $this->total_base * ($this->retention / 100);
    }else{
      $this->total_retention = '';
      $this->retention = '';
    }

    // Si se está ordenando, los datos están como se guardan en la base de datos
    // hay que desformatearlos para que al llamar a save() no se estropicien.
    if( !empty($_REQUEST['ordenar']) && strtolower( $_REQUEST['ordenar'] ) == 'up'){
      $this->format_all_fields();
    }
    parent::save($check_notify);

    // Asociamos con la Factura correspondiente.
    if( !empty($_POST['relate_id']) ){
      $invoice = new reg_invoices();
      $invoice->retrieve($_POST['relate_id']);
      $invoice->calculateTotal();
      $invoice->save();
    }

	}

  /**
   * Formatea algunos campos para su visualizacion en los listados
   */
  function fill_in_additional_list_fields(){
    global $app_list_strings;

    parent::fill_in_additional_list_fields();
    $this->format_all_fields();

    if($this->unit_custom){
      $this->qty = "$this->qty <i>$this->unit_custom</i>";
    }else if ($this->unit != '05'){
      $this->qty = "$this->qty <i>".$app_list_strings['item_unit_dom'][$this->unit]."</i>";
    }

  }

}
?>