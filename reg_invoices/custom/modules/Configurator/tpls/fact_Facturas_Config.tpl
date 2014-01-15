{*

/**
 * Copyright (c) 2008-2010 SugarDev.net (http://www.sugardev.net)
 * All rights reserved.
 *
 * Permission is granted for use, copying, modification, distribution,
 * and distribution of modified versions of this work as long as the
 * above copyright notice is included.
 */

/**
 * @package SugarDevTools
 * @author Loek van Gool <loekvangool@gmail.com>
 */
*}

<script type='text/javascript' src='include/javascript/overlibmws.js'></script>
<br>
<form name="ConfigureSettings" enctype='multipart/form-data' method="POST" action="index.php?module=Configurator&action=fact_Facturas_Config" onSubmit="return (add_checks(document.ConfigureSettings) && check_form('ConfigureSettings'));">
  <span class='error'>{$error.main}</span>
  <table width="100%" cellpadding="0" cellspacing="0" border="0">
    <tr>
      <td style="padding-bottom: 2px;">
        <input title="{$APP.LBL_SAVE_BUTTON_TITLE}" accessKey="{$APP.LBL_SAVE_BUTTON_KEY}" class="button"  type="submit"  name="save" value="  {$APP.LBL_SAVE_BUTTON_LABEL}  " >
      &nbsp;<input title="{$MOD.LBL_CANCEL_BUTTON_TITLE}"  onclick="document.location.href='index.php?module=Administration&action=index'" class="button"  type="button" name="cancel" value="  {$APP.LBL_CANCEL_BUTTON_LABEL}  " > </td>
    </tr>
  </table>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr><td>
    <br />

<!-- Informacion sobre el facturador -->
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tabForm">
      <tr>
        <th align="left" class="dataLabel" colspan="4">
          <h2>{$MOD.LBL_FACT_SELLER_INFO_TITLE}</h2>
        </th>
      </tr><tr>
        <td>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="20%" class="dataLabel">{$MOD.LBL_FACT_PERSON_TYPE}: </td>
              <td width="25%" class="dataField">
                <select name="fact_person_type_code">{$person_type_code_options}</select>
              </td>
              <td colspan="2" class="dataField">
                <i>{$MOD.LBL_FACT_PERSON_TYPE_DESC}</i>
              </td>
            </tr>
            <tr>
              <td width="20%" class="dataLabel">
                {$MOD.LBL_FACT_NAME}:
              </td>
              <td class="dataField" >
                <input name='fact_corporate_name' type="text" size="30" maxlength="60" value="{$config.fact_corporate_name}">
              </td>
              <td colspan="2" class="dataField">
                <i>{$MOD.LBL_FACT_NAME_DESC}</i>
              </td>
            </tr>
            <tr>
              <td width="20%" class="dataLabel">
                {$MOD.LBL_FACT_TRADE_SURNAME}:
              </td>
              <td class="dataField">
                <input name='fact_trade_name_surname1' type="text" size="30" maxlength="60" value="{$config.fact_trade_name_surname1}">
              </td>
              <td colspan="2" class="dataField">
                <i>{$MOD.LBL_FACT_TRADE_SURNAME_DESC}</i>
              </td>
            </tr>
            <tr>
              <td width="20%" class="dataLabel">
                {$MOD.LBL_FACT_REGISTRATION_SURNAME}:
              </td>
              <td class="dataField">
                <input name='fact_registration_surname2' type="text" size="30" maxlength="60" value="{$config.fact_registration_surname2}">
              </td>
              <td colspan="2" class="dataField">
                <i>{$MOD.LBL_FACT_REGISTRATION_SURNAME_DESC}</i>
              </td>
            </tr>
            <tr>
              <td width="20%" class="dataLabel">
                {$MOD.LBL_FACT_TAX_NUMBER}:
              </td>
              <td class="dataField">
                <input name='fact_tax_number' type="text" size="30" maxlength="15" value="{$config.fact_tax_number}">
              </td>
              <td colspan="2" class="dataField">
                <i>{$MOD.LBL_FACT_TAX_NUMBER_DESC}</i>
              </td>
            </tr>
            <tr>
              <td width="20%" class="dataLabel">
                {$MOD.LBL_FACT_RESIDENCE_TYPE_CODE}:
              </td>
              <td width="25%" class="dataField">
                <select name="fact_residence_type_code">{$residence_type_options}</select>
              </td>
              <td colspan="2" class="dataField">
                <i>{$MOD.LBL_FACT_RESIDENCE_TYPE_INFO}</i>
              </td>
            </tr>
            <tr>
              <td width="20%" class="dataLabel">
                {$MOD.LBL_FACT_ADRESS}:
              </td>
              <td class="dataField">
                <input name='fact_address' type="text" size="30" maxlength="100" value="{$config.fact_address}">
              </td>
              <td colspan="2" class="dataField">
                <i>{$MOD.LBL_FACT_ADRESS_DESC}</i>
              </td>
            </tr>
            <tr>
              <td width="20%" class="dataLabel">
                {$MOD.LBL_FACT_CP}:
              </td>
              <td class="dataField">
                <input name='fact_post_code' type="text" size="30" maxlength="6" value="{$config.fact_post_code}">
              </td>
              <td colspan="2" class="dataField">
                <i>{$MOD.LBL_FACT_CP_DESC}</i>
              </td>
            </tr>
            <tr>
              <td width="20%" class="dataLabel">
                {$MOD.LBL_FACT_TOWN}:
              </td>
              <td class="dataField">
                <input name='fact_town' type="text" size="30" maxlength="30" value="{$config.fact_town}">
              </td>
              <td colspan="2" class="dataField">
                <i>{$MOD.LBL_FACT_TOWN_DESC}</i>
              </td>
            </tr>
            <tr>
              <td width="20%" class="dataLabel">
                {$MOD.LBL_FACT_PROVINCE}:
              </td>
              <td class="dataField">
                <input name='fact_province' type="text" size="30" maxlength="30" value="{$config.fact_province}">
              </td>
              <td colspan="2" class="dataField">
                <i>{$MOD.LBL_FACT_PROVINCE_DESC}</i>
              </td>
            </tr>
            <tr>
              <td width="20%" class="dataLabel">
                {$MOD.LBL_COUNTRY_CODE}:
              </td>
              <td class="dataField">
                <input name='fact_country_code' type="text" size="30" maxlength="6" value="{$config.fact_country_code}">
              </td>
              <td colspan="2" class="dataField">
                <i>{$MOD.LBL_COUNTRY_CODE_DESC}</i>
              </td>
            </tr>
           
          </table>
      </td></tr>
    </table>

<!-- Opciones de factura -->
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tabForm">
      <tr>
        <th align="left" class="dataLabel" colspan="4">
          <h2>{$MOD.LBL_INVOICE_OPTIONS}</h2>
        </th>
      </tr>
      <tr>
        <td>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="20%" class="dataLabel">{$MOD.LBL_ACCOUNT_NIF_FIELD}: </td>
              <td width="25%" class="dataField">
                <select name="fact_account_nif_field">{$account_fields_options}</select>
              </td>
              <td colspan="2" class="dataField">
                <i>{$MOD.LBL_ACCOUNT_NIF_FIELD_DESC}</i>
              </td>
            </tr>
            
            <tr>
              <td width="20%" class="dataLabel">{$MOD.LBL_DEFAULT_TAX_TYPE}: </td>
              <td width="25%" class="dataField">
                <select name="fact_default_tax_type">{$tipo_impuesto_dom}</select>
              </td>
              <td colspan="2" class="dataField">
                <i>{$MOD.LBL_DEFAULT_TAX_TYPE_DESC}</i>
              </td>
            </tr>
            
            <tr>
              <td width="20%" class="dataLabel"> {$MOD.LBL_DEFAULT_TAX}: </td>
              <td class="dataField">
                <input name='fact_default_tax' type="text" size="30" maxlength="6" value="{$config.fact_default_tax}">
              </td>
              <td colspan="2" class="dataField">
                <i>{$MOD.LBL_DEFAULT_TAX_DESC}</i>
              </td>
            </tr>
            
            <tr>
              <td width="20%" class="dataLabel"> {$MOD.LBL_DEFAULT_RETENTION}: </td>
              <td class="dataField">
                <input name='fact_default_retention' type="text" size="30" maxlength="6" value="{$config.fact_default_retention}">
              </td>
              <td colspan="2" class="dataField">
                <i>{$MOD.LBL_DEFAULT_RETENTION_DESC}</i>
              </td>
            </tr>
           
            <tr>
              <td width="20%" class="dataLabel">{$MOD.LBL_RESTART_NUMBERS}: </td>
                {if !empty($config.fact_restart_number)}
                  {assign var='fact_restart_number_checked' value='CHECKED'}
                {else}
                  {assign var='fact_restart_number_checked' value=''}
                {/if}
              <td class="dataField">
                <input type='hidden' name='fact_restart_number' value='false'>
                <input name='fact_restart_number' type="checkbox" value="true" {$fact_restart_number_checked}>
              </td>
              <td colspan="2" class="dataField">
                <i>{$MOD.LBL_RESTART_NUMBERS_DESC}</i>
              </td>
            </tr>
            
            <tr>
              <td width="20%" class="dataLabel">
                {$MOD.LBL_PATH_TO_LOGO}:
              </td>
              <td class="dataField">
                <input name='fact_path_to_logo' type="text" size="40" maxlength="100" value="{$config.fact_path_to_logo}">
              </td>
              <td colspan="2" class="dataField">
                <i>{$MOD.LBL_PATH_TO_LOGO_DESC}</i>
              </td>
            </tr>

            <tr>
              <td width="20%" class="dataLabel">
                {$MOD.LBL_GENERAL_CONDITIONS}:
              </td>
              <td class="dataField" colspan="3">
                <textarea name='fact_conditions' type="text" rows="5" cols="70" maxlength="100">{$config.fact_conditions}</textarea>
              </td>

            </tr>
            
          </table>
      </td></tr>
    </table>

  </table>
  <br />
  <div style="padding-top: 2px;">
    <input title="{$APP.LBL_SAVE_BUTTON_TITLE}" class="button"  type="submit" name="save" value="  {$APP.LBL_SAVE_BUTTON_LABEL}  " />
    &nbsp;<input title="{$MOD.LBL_CANCEL_BUTTON_TITLE}"  onclick="document.location.href='index.php?module=Administration&action=index'" class="button"  type="button" name="cancel" value="  {$APP.LBL_CANCEL_BUTTON_LABEL}  " />
  </div>
  {$JAVASCRIPT}
  {literal}
  <script>
    addToValidate('ConfigureSettings', 'system_name', 'varchar', true,'System Name' );
  </script>
  <script type="text/javascript" language="Javascript" src="include/JSON.js"></script>
  <script>
    function uploadCheck(quotes){
      //AJAX call for checking the file size and comparing with php.ini settings.
      var callback = {
        success:function(r) {
          var file_type = r.responseText;
          if(file_type == 'empty'){
            //field empty
          }else{
            if(file_type == 'other_quotes'){
              alert(SUGAR.language.get('Configurator','LBL_ALERT_JPG_IMAGE'));
              document.getElementById("quotes_logo").value='';
            }
            if(file_type == 'other'){
              alert(SUGAR.language.get('Configurator','LBL_ALERT_TYPE_IMAGE'));
              document.getElementById("company_logo").value='';
            }
            if(file_type == 'size_quotes'){
              alert(SUGAR.language.get('Configurator','LBL_ALERT_SIZE_RATIO_QUOTES'));
              document.getElementById("quotes_logo").value='';
            }
            if(file_type == 'size'){
              alert(SUGAR.language.get('Configurator','LBL_ALERT_SIZE_RATIO'));
            }
            //error in getimagesize because unsupported type
            if(file_type.length > 20){
              alert(SUGAR.language.get('Configurator','LBL_ALERT_TYPE_IMAGE'));
              document.getElementById("quotes_logo").value='';
              document.getElementById("company_logo").value='';
            }
            else{
              //image is good
            }
          }
        }
      }
      if(quotes){
        var file_name = document.ConfigureSettings.quotes_logo.value;
        postData = 'file_name=' + JSON.stringify(file_name) + '&module=Configurator&action=UploadFileCheck&to_pdf=1&forQuotes=true';
      }
      else{
        var file_name = document.ConfigureSettings.company_logo.value;
        postData = 'file_name=' + JSON.stringify(file_name) + '&module=Configurator&action=UploadFileCheck&to_pdf=1&forQuotes=false';
      }

      YAHOO.util.Connect.asyncRequest('POST', 'index.php', callback, postData);
    }
  </script>
  {/literal}
</form>
