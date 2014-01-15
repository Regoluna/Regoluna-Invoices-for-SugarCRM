<?php
$module_name = 'reg_items';
$viewdefs [$module_name] =
array (
  'EditView' =>
  array (
    'templateMeta' =>
    array (
      'maxColumns' => '2',
      'form' =>
      array (
        'hideAudit' => true,
        'footerTpl' => 'modules/reg_items/vacio.tpl',
        'buttons' =>
        array (
          0 =>
          array (
            'customCode' => '
                                            <input type="submit" value="{$APP.LBL_SAVE_BUTTON_LABEL}"
                                              id="reg_items_subpanel_save_button" name="reg_items_subpanel_save_button"
                                              onclick="this.form.action.value=\'Save\';
                                                       if(!check_form(\'EditView\')) return false;
                                                       return saveQuickEdit(this.form.id, \'reg_items\');"
                                              class="button" accesskey="S" title="{$APP.LBL_SAVE_BUTTON_TITLE}" />',
          ),
          1 => 'SUBPANELCANCEL',
        ),
      ),
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
    ),
    'footerTpl' => NULL,
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
            'name' => 'type',
            'label' => 'LBL_TIPO',
          ),
        ),
        1 =>
        array (
          0 =>
          array (
            'name' => 'unit_custom',
            'label' => 'LBL_UNIDAD_CUSTOM',
          ),
          1 =>
          array (
            'name' => 'unit',
            'label' => 'LBL_UNIDAD',
          ),
        ),
        2 =>
        array (
          0 =>
          array (
            'name' => 'unit_price',
            'label' => 'LBL_PRECIO_UD',
          ),
          1 =>
          array (
            'name' => 'tax_type',
            'label' => 'LBL_TIPO_IMPUESTO',
          ),
        ),
        3 =>
        array (
          0 =>
          array (
            'name' => 'qty',
            'label' => 'LBL_CANTIDAD',
          ),
          1 =>
          array (
            'name' => 'tax',
            'label' => 'LBL_REPERCUTIDO',
          ),
        ),
        4 =>
        array (
          0 =>
          array (
            'name' => 'discount',
            'label' => 'LBL_DESCUENTO',
          ),
          1 =>
          array (
            'name' => 'retention',
            'label' => 'LBL_RETENCION',
          ),
        ),
        5 =>
        array (
          0 =>
          array (
            'name' => 'description',
            'label' => 'LBL_DESCRIPTION',
          ),
          1 => null
        ),
       ),
    ),
  ),
);
?>
