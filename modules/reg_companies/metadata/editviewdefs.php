<?php

$module_name = 'reg_companies';
$viewdefs[$module_name]['EditView'] = array(

  'templateMeta' => array(
    'form' => array( 'enctype'=> 'multipart/form-data' ),
    'maxColumns' => '2',
    'widths' => array(
      array('label' => '10', 'field' => '30'),
      array('label' => '10', 'field' => '30')
    ),

    'javascript' => '{sugar_getscript file="include/javascript/dashlets.js"}
      <script>
      function deleteAttachmentCallBack(text)
        {literal} { {/literal}
        if(text == \'true\') {literal} { {/literal}
          document.getElementById(\'new_attachment\').style.display = \'\';
          ajaxStatus.hideStatus();
          document.getElementById(\'old_attachment\').innerHTML = \'\';
        {literal} } {/literal} else {literal} { {/literal}
          document.getElementById(\'new_attachment\').style.display = \'none\';
          ajaxStatus.flashStatus(SUGAR.language.get(\'Notes\', \'ERR_REMOVING_ATTACHMENT\'), 2000);
        {literal} } {/literal}
      {literal} } {/literal}
      </script>
      <script>toggle_portal_flag(); function toggle_portal_flag()  {literal} { {/literal} {$TOGGLE_JS} {literal} } {/literal} </script>',
  ),

  'panels' =>array (

    'default' => array (
      array ( 'name', 'name2' ),
      array ( 'nif', 'name3'  ),
      array ( 'is_default', 'invoice_prefix'  ),
      array ( 'footer_text'  ),
      array ( 'description', 'filename' ),
    ),

    'lbl_billing_address_panel' => array (
      array(
        array (
            'name' => 'billing_address_street',
            'type' => 'address',
            'hideLabel' => true,
            'displayParams' =>  array (
              'key' => 'billing',
              'rows' => 2,
              'cols' => 30,
              'maxlength' => 150,
            ),
        ),
      ),

    ),

    'lbl_facturae_panel' => array (
      array( 'residence',  'type' ),
    ),

  ),

);
?>
