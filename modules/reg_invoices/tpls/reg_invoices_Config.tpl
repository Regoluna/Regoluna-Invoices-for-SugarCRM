
<!-- Regoluna Invoices configuration form -->
{literal}
<style media="screen">
  .tabForm td{ vertical-align: top; padding: 6px; }
  td p { margin-bottom: 5px; }
</style>
{/literal}
<form name="ConfigureSettings"
      enctype='multipart/form-data'
      method="POST"
      action="index.php?module=reg_invoices&action=Config" >

  <span class='error'>{$error.main}</span>

  <!-- Upper buttons -->
  <input title="{$APP.LBL_SAVE_BUTTON_TITLE}"
         accessKey="{$APP.LBL_SAVE_BUTTON_KEY}"
         class="button"
         type="submit"
         name="save"
         value="  {$APP.LBL_SAVE_BUTTON_LABEL}  " >  &nbsp;
  <input title="{$MOD.LBL_CANCEL_BUTTON_TITLE}"
         onclick="document.location.href='index.php?module=Administration&action=index'"
         class="button"
         type="button"
         name="cancel"
         value="{$APP.LBL_CANCEL_BUTTON_LABEL}">

  <!-- General invoice options -->
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tabForm">

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
        <select name="fact_default_tax_type">{$reg_tax_type_dom}</select>
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
        {if $config.fact_restart_number==0 }
          {assign var='rst_check_0' value='CHECKED'}
        {else}
          {assign var='rst_check_0' value=''}
        {/if}
        {if $config.fact_restart_number==1 }
          {assign var='rst_check_1' value='CHECKED'}
        {else}
          {assign var='rst_check_1' value=''}
        {/if}
        {if $config.fact_restart_number==2 }
          {assign var='rst_check_2' value='CHECKED'}
        {else}
          {assign var='rst_check_2' value=''}
        {/if}
      <td class="dataField">

        <p><input type="radio" name="fact_restart_number" value="0" {$rst_check_0}>
          {$MOD.LBL_RESTART_CONTINUOUS}
        </input></p>

        <p><input type="radio" name="fact_restart_number" value="1" {$rst_check_1}>
          {$MOD.LBL_RESTART_YEARLY}
        </input></p>

        <input type="radio" name="fact_restart_number" value="2" {$rst_check_2}>
        {$MOD.LBL_RESTART_DAILY}
        </input><br/>

        <!-- <input type='hidden' name='fact_restart_number' value='false'>
        <input name='fact_restart_number' type="checkbox" value="true" {$rst_check}> -->
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

</form>
