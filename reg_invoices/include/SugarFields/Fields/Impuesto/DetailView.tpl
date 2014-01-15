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
{{assign var="campo" value=$displayParams.tax_type}}
{{assign var="signo" value=$displayParams.signo}}
{{assign var="siglas" value=$displayParams.siglas}}
 
{if isset($fields.{{$campo}}.value) && trim($fields.{{$campo}}.value) > 0}

{sugar_number_format var={{sugarvar key='value' stringFormat='false'}} {{if !empty($vardef.precision)}}precision={{$vardef.precision}}{{/if}} }
 {{if !empty($displayParams.enableConnectors)}}
   {{sugarvar_connector view='DetailView'}} 
 {{/if}}

 &nbsp;&nbsp;<i>
 {if {{$campo}} == 'output_tax'}
	 {if trim($fields.unique_tax.value) }
    ( {{$signo}} {$fields.{{$campo}}.value}% {$fields.type.{{$campo}}.options[$fields.type.{{$campo}}.value]}{{$siglas}} )
	 {else}
	   ( Varios )
	 {/if}
 {/if}
 
 {if {{$campo}} == 'retention'}
  {if trim($fields.unique_retention.value) }
	  ( {{$signo}} {$fields.{{$campo}}.value}% {$fields.type.{{$campo}}.options[$fields.type.{{$campo}}.value]}{{$siglas}} )
	{else}
	  ( Varios )
  {/if}
 {/if}
  </i>
{/if}
