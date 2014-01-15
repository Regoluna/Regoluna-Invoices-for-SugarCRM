<?php
$module_name = 'fact_Facturas';
$_object_name = 'fact_facturas';
$viewdefs [$module_name] = 
array (
  'DetailView' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'headerTpl' => 'modules/fact_Facturas/views/detailViewHeader.tpl',
        'buttons' => 
        array ( 'EDIT',
          // 'DUPLICATE',
          'DELETE',
//        array ( 'customCode' => '<input title="{$APP.LBL_DUP_MERGE}" accesskey="M" class="button" onclick="this.form.return_module.value=\'fact_Facturas\';this.form.return_action.value=\'DetailView\';this.form.return_id.value=\'{$fields.id.value}\'; this.form.action.value=\'Step1\'; this.form.module.value=\'MergeRecords\';" name="button" value="{$APP.LBL_DUP_MERGE}" type="submit">', ),
          array('customCode'=>
                  '<input title="{$MOD.LBL_FACTURAE_TITLE}" accesskey="F" class="button" '.
                  'onclick="this.form.action.value=\'XmlView\'; this.form.module.value=\'fact_Facturas\';" '.
                  'name="button" value="{$MOD.LBL_FACTURAE}" type="submit" '.
                  '{if !($fields.numero.value > 0 && $fields.fact_facturas_type.value=="factura")}disabled style="color:#888;"{/if}>'
          ),
          
          array('customCode'=>
                '<input title="{$MOD.LBL_GET_PDF_TITLE}" accesskey="M" class="button" '.
                  'onclick="this.form.action.value=\'PdfView\'; this.form.module.value=\'fact_Facturas\';" '.
                  'name="button" value="{$MOD.LBL_GET_PDF}" type="submit">'
          ),
          
          array('customCode'=>
                '<input title="{$MOD.LBL_PRINT_TITLE}" accesskey="P" class="button" '.
                  'onclick="this.form.action.value=\'PrintPdf\'; this.form.module.value=\'fact_Facturas\';" '.
                  'name="button" value="{$MOD.LBL_PRINT}" type="submit">'
          ),

        ),
      ),
      'maxColumns' => '2',
      'widths' => 
      array (
        0 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
        1 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
      ),
      'includes' =>  array (
        array ( 'file' => 'custom/include/generic/itemUtils.js' ),
      ),
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'name',
            'label' => 'LBL_NAME',
          ),
          1 => 
          array (
            'name' => 'total_items',
            'label' => 'LBL_TOTAL_ITEMS',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'numero',
            'type' => 'NumFactura',
            'label' => 'LBL_NUMERO',
            'displayParams' => array (
              'show_year' => $GLOBALS['sugar_config']['fact_restart_number'],
            ),
          ),
          1 => 
          array (
            'name' => 'total_descuento',
            'label' => 'LBL_TOTAL_DESCUENTO',
          ),
        ),
        2 => 
        array (
          0 =>  
          array (
            'name' => 'accounts_fact_facturas_name',
          ),
          1 => 
          array (
            'name' => 'total_iva',
            'type' => 'Impuesto',
            'label' => 'LBL_TOTAL_IVA',
            'displayParams' => array (
              'tipo_impuesto' => 'repercutido',
              'signo' => '+',
            ),
          ),
        ),
        3 => 
        array (
          0 =>  
          array (
            'name' => 'fact_facturas_type',
            'label' => 'LBL_TYPE',
          ),
          1 => 
          array (
            'name' => 'total_retencion',
            'type' => 'Impuesto',
            'label' => 'LBL_TOTAL_RETENCION',
            'displayParams' => array (
              'tipo_impuesto' => 'retencion',
              'signo' => '-',
              'siglas' => 'IRPF'
            ),
          ),
        ),
        4 => 
        array (
          0 =>  
          array (
            'name' => 'estado',
            'label' => 'LBL_ESTADO',
          ),
          1 => NULL,
        ),
        5 => 
        array (
          0 =>  
          array (
            'name' => 'date_closed',
            'label' => 'LBL_FECHA_EMISION',
          ),
          1 => 
          array (
            'name' => 'amount',
            'label' => 'LBL_AMOUNT',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'description',
            'label' => 'LBL_DESCRIPTION',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'condiciones',
            'label' => 'LBL_CONDICIONES',
          ),
        ),
      ),
    ),
  ),
);
?>
