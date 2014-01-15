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
require_once('modules/fact_Facturas/fact_Facturas_sugar.php');
class fact_Facturas extends fact_Facturas_sugar {

  function fact_Facturas() {
    parent::fact_Facturas_sugar();
  }
  
  function unformat_all_fields(){
    // Corregimos el comportamiento erroneo de SugarCRM en algunos casos.
    if ($this->number_formatting_done)  parent::unformat_all_fields();
  }
  
  function save($check_notify = FALSE) {
    
    $this->calcularTotal();
    
    // Guardamos el año, en función de la fecha.
    global $timedate;
    $fecha_partes = explode('-', $timedate->to_db($this->date_closed));
    if (is_numeric($fecha_partes[0])) {
      $anio = $fecha_partes[0];
    } else {
      $anio = '0000';
    }
    $this->year = $anio;

    // Si se marca el checkbox de auto-generar y la factura está emitida o pagada
    // calculamos el número.
    if ($_POST['numero_autogen'] == 1 && ($this->estado == 'emitida' || $this->estado == 'cobrada')) {
      $this->calcularNumero();
    }
    
    // echo "Antes de guardar - Si no esta formateado, lo hacemos<br/>";   
    if(!$this->number_formatting_done) $this->format_all_fields();
    
    // No usamos el campo 'amount_usdollar' sin embargo, su definición por defecto puede dar problemas
    $this->field_defs['amount_usdollar']['disable_num_format']=0; // corrige un comportamiento inadecuado
    parent::save($check_notify);
  }

  
  
  /**
   * 
   * Asigna el siguiente número disponible para facturas
   * Cada tipo tiene su propia numeración.
   * 
   */
  function calcularNumero() {
    global $sugar_config;

    // Para el caso en el que la facturación se reinicie anualmente
    $anual = ($sugar_config['fact_restart_number']) ? " AND year = $this->year" : '';

    $sql = " select MAX(numero) numero".
      " from fact_facturas ".
      " where deleted=0 AND fact_facturas_type = '$this->fact_facturas_type' AND id <> '$this->id' $anual";

    $result = $this->db->query($sql);
    $row = $this->db->fetchByAssoc($result);
    if ($row['numero']) {
      $this->numero = $row['numero'] + 1;
    } else {
      $this->numero = 1;
    }
  }

  
  
  /**
   * 
   * Hace todos los calculos necesarios para obtener la base imponible
   * y el total a pagar después de decuentos, IVA y retenciónes.
   * 
   */
  function calcularTotal() {

    // Por si el usuario introduce campos negativos
    if ($this->repercutido < 0) $this->repercutido = -$this->repercutido;
    if ($this->retencion < 0) $this->retencion = -$this->retencion;

    $this->total_base = 0;
    $this->total_iva = 0;
    $this->total_retencion = 0;
    $this->total_descuento = 0;
    $this->impuesto_unico = true;
    $this->retencion_unica = true;

    // Obtenemos la lista de Items con sus precios para procesarlos.
    $sql = " select total_antes, tipo_repercutido,impuesto, total_impuesto, total_descuento, retencion, total_retencion ".
      " from fact_items i JOIN fact_factura_items f ON (i.id=f.item_id AND f.deleted=0) ".
      " where i.deleted=0 AND factura_id = '$this->id' ";
    $result = $this->db->query($sql);

    // Procesamos las filas de Items para calcular los totales.
    while ($row = $this->db->fetchByAssoc($result)) {
      $this->total_base += $row['total_antes'];
      $this->total_descuento -= $row['total_descuento'];

      // Si no tiene impuesto por item, aplicamos el general
      if ($row['impuesto'] > 0 && ($row['tipo_repercutido'] != $this->tipo_repercutido || $row['impuesto'] != $this->repercutido)) {
        $this->total_iva += $row['total_impuesto'];
        $this->impuesto_unico = false;
      } else {
        $this->total_iva += $row['total_antes'] * $this->repercutido / 100;
      }

      // Si no tiene retencion por item, aplicamos el general
      if ($row['retencion'] > 0 && ($row['retencion'] != $this->retencion)) {
        $this->total_retencion -= $row['total_retencion'];
        $this->retencion_unica = false;
      } else {
        $this->total_retencion -= $row['total_antes'] * $this->retencion / 100;
      }
    }
    $this->amount = $this->total_base + $this->total_iva + $this->total_retencion;
    $this->total_items = $this->total_base; // Porque ya no hay descuento general
  }

  
  
  /**
   * 
   * Cambiamos el comportamiento al borrar una factura.
   * Hay que borrar también todos sus Items asociados
   * 
   */
  function mark_deleted($id) {

    // Obtenemos la lista de Items, y los marcamos como borrados.
    $bean = new fact_Facturas();
    $bean->retrieve($id);
    $items = $bean->get_linked_beans('items', 'fact_Items');
    foreach ($items as $item) {
      $item->mark_deleted($item->id);
    }

    // Después ejecutamos el borrado normal.
    parent::mark_deleted($id);
  }

  
  
  /**
   * 
   * Formatea algunos campos para su visualizacion en los listados
   * 
   */
  function fill_in_additional_list_fields() {
    global $sugar_config;
    if ($sugar_config['fact_restart_number'] && $this->year && $this->numero) {
      $this->numero = "{$this->year}/{$this->numero}";
    }
  }

}
