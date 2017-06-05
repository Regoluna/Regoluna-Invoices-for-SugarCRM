<?php
$module_name = 'reg_invoices';
$_object_name = 'reg_invoices';
$viewdefs [$module_name] =
array (
  'DetailView' =>
  array (
    'templateMeta' =>
    array (
      'form' =>
      array (
        'headerTpl' => 'modules/reg_invoices/views/detailViewHeader.tpl',
        'buttons' =>
        array ( 'EDIT',
          'DUPLICATE',
          'DELETE',
          //array('customCode'=>
          //        '<input title="{$MOD.LBL_FACTURAE_TITLE}" accesskey="F" class="button" '.
          //        'onclick="this.form.action.value=\'XmlView\'; this.form.module.value=\'reg_invoices\';" '.
          //        'name="button" value="{$MOD.LBL_FACTURAE}" type="submit" '.
          //        '{if !($fields.numero.value > 0 && $fields.reg_invoices_type.value=="factura")}disabled style="color:#888;"{/if}>'
          //),

          array('customCode'=>
                '<input title="{$MOD.LBL_GET_PDF_TITLE}" accesskey="M" class="button" '.
                  'onclick="window.open(\'index.php?module=reg_invoices&action=PdfView&record={$fields.id.value}\',\'_blank\');return false;" '.
                  'name="button" value="{$MOD.LBL_GET_PDF}" type="submit">'
          ),

          //array('customCode'=>
          //      '<input title="{$MOD.LBL_PRINT_TITLE}" accesskey="P" class="button" '.
          //        'onclick="window.open(\'index.php?module=reg_invoices&action=PrintPdf&record={$fields.id.value}\',\'_blank\');return false;" '.
          //        'name="button" value="{$MOD.LBL_PRINT}" type="submit">'
          //),

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

        array (
          0 =>
          array (
            'name' => 'number',
            'type' => 'NumFactura',
            'label' => 'LBL_NUMERO',
            'displayParams' => array (
              'show_year' => ($GLOBALS['sugar_config']['fact_restart_number'] == 1),
              'show_prefix' => ($GLOBALS['sugar_config']['fact_restart_number'] == 2),
            ),
          ),
          1 =>
          array (
            'name' => 'total_discount',
            'label' => 'LBL_TOTAL_DESCUENTO',
          ),
        ),

        array (
          0 =>
          array (
            'name' => 'account_name',
          ),
          1 =>
          array (
            'name' => 'total_tax',
            'type' => 'Impuesto',
            'label' => 'LBL_TOTAL_IVA',
            'displayParams' => array (
              'tax_type' => 'output_tax',
              'signo' => '+',
            ),
          ),
        ),

        array (
          0 =>
          array (
            'name' => 'reg_invoices_type',
            'label' => 'LBL_TYPE',
          ),
          1 =>
          array (
            'name' => 'total_retention',
            'type' => 'Impuesto',
            'label' => 'LBL_TOTAL_RETENCION',
            'displayParams' => array (
              'tax_type' => 'retention',
              'signo' => '-',
              'siglas' => 'IRPF'
            ),
          ),
        ),

        array (
          0 =>
          array (
            'name' => 'state',
            'label' => 'LBL_ESTADO',
          ),
          1 => NULL,
        ),

        array ( 'issuer', NULL ),

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

        array (
          0 =>
          array (
            'name' => 'description',
            'label' => 'LBL_DESCRIPTION',
          ),
        ),

        array (
          0 =>
          array (
            'name' => 'conditions',
            'label' => 'LBL_CONDICIONES',
          ),
        ),
      ),
    ),
  ),
);
?>
