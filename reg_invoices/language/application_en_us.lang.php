<?php
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

//$app_list_strings['moduleList']['fact_Productos'] = 'Productos';
$app_list_strings['moduleList']['fact_Facturas'] = 'Invoices';
$app_list_strings['moduleList']['fact_Items'] = 'Items';

$app_list_strings['producto_tipo_list']=array(
  'Service' => 'Service',
  'Product' => 'Product',
);

// Desplegables para el módulo de Facturas
$app_list_strings['facturas_estado_list']=array(
  'elaborando' =>'Draft',
  'esperando' => 'Waiting for approval',
  'emitida' => 'Emitted',
  'cobrada' => 'Paid',
);

$app_list_strings['fact_facturas_type_dom']['factura'] ='Invoice';
$app_list_strings['fact_facturas_type_dom']['presupuesto'] ='Quote';
$app_list_strings['fact_facturas_type_dom']['proforma'] ='Proforma';

// Textos para creación rápida de Items en Facturas
$app_strings['LBL_NEW_ITEM_BUTTON']="New Item";

// Desplegables para impuestos
$app_list_strings['iva_type_dom']=array(
  '0' =>'',
  '0.16' =>'+16% IVA General',
  '0.07' =>'+7% IVA Reducido',
  '0.04' =>'+4% IVA Superreducido',
);

// Desplegables para impuestos
$app_list_strings['irpf_type_dom']=array(
  '0' =>'',
  '0.15' =>'-15% IRPF',
  '0.07' =>'-7% IRPF',
);

// Invoice items unit types
$app_list_strings['item_unit_dom']=array(
  '01' => 'Unidades',
  '02' => 'Horas-HUR',
  '03' => 'Kilogramos-KGM',
  '04' => 'Litros-LTR',
  '05' => 'Otros',
  '06' => 'Cajas-BX',
  '07' => 'Bandejas-DS',
  '08' => 'Barriles-BA',
  '09' => 'Bidones-JY',
  '10' => 'Bolsas-BG',
  '11' => 'Bombonas-CO',
  '12' => 'Botellas-BO',
  '13' => 'Botes-CI',
  '14' => 'Tetra Briks',
  '15' => 'Centilitros-CLT',
  '16' => 'Centímetros-CMT',
  '17' => 'Cubos-BI',
  '18' => 'Docenas',
  '19' => 'Estuches-CS',
  '20' => 'Garrafas-DJ',
  '21' => 'Gramos-GRM',
  '22' => 'Kilómetros-KMT',
  '23' => 'Latas-CA',
  '24' => 'Manojos-BH',
  '25' => 'Metros-MTR',
  '26' => 'Milímetros-MMT',
  '27' => '6-Packs',
  '28' => 'Paquetes-PK',
  '29' => 'Raciones',
  '30' => 'Rollos-RO',
  '31' => 'Sobres-EN',
  '32' => 'Tarrinas-TB',
  '33' => 'Metro cúbico-MTQ',
  '34' => 'Segundo-SEC',
  '35' => 'Vatio-WTT',
);

// Tax Types (Spanish Facturae)
$app_list_strings['tipo_impuesto_dom']=array(
  '01' => 'IVA',
  '04' => 'IRPF',
  '02' => 'IPSI',
  '03' => 'IGIC',
  '06' => 'ITPAJD',
  '07' => 'IE',
  '08' => 'Ra',
  '09' => 'IGTECM',
  '10' => 'IECDPCAC',
  '11' => 'IIIMAB',
  '12' => 'ICIO',
  '13' => 'IMVDN',
  '14' => 'IMSN',
  '15' => 'IMGSN',
  '16' => 'IMPN',
  '05' => 'Other',
);

// Añadimos una opción para el enlace de Facturas con Notas
$app_list_strings['record_type_display_notes']['fact_Facturas'] = 'Invoice';