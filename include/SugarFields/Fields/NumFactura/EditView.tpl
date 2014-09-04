{*
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
*}
{if strlen({{sugarvar key='value' string=true}}) <= 0}
{assign var="value" value={{sugarvar key='default_value' string=true}} }
{else}
{assign var="value" value={{sugarvar key='value' string=true}} }
{/if}  

<input type='text' name='{{sugarvar key='name'}}' id='{{sugarvar key='name'}}' size='{{$displayParams.size|default:6}}' 
       {{if !empty($vardef.len)}}maxlength='{{$vardef.len}}'{{elseif !empty($displayParams.maxlength)}}maxlength='{{$displayParams.maxlength}}'{{/if}} 
       value='{$value}' title='{{$vardef.help}}' tabindex='{{$tabindex}}'> 

<span id="{{sugarvar key='name'}}_autogenspan" >  
<input type="checkbox" id="{{sugarvar key='name'}}_autogen" name="{{sugarvar key='name'}}_autogen" 
       value="1" OnChange="checkboxCambiado();" tabindex="{{$tabindex}}" {{$checked}} > {{$textocheck}} </span>       

<form>
<input class="button" type="submit" id="{{sugarvar key='name'}}_changeb" name="{{sugarvar key='name'}}_changeb" 
       value="{{$textocambio}}" tabindex="{{$tabindex}}" OnClick="editarTexto('{{sugarvar key='name'}}');return false;"
       Style="display:none;">     
</form>

<script type="text/javascript" language="javascript">
    id_campo_nombre='{{sugarvar key='name'}}';
    //inicializarNumero('{{sugarvar key='name'}}');
</script>
<script type="text/javascript" src="include/SugarFields/Fields/NumFactura/SugarFieldNumFactura.js"></script>
       