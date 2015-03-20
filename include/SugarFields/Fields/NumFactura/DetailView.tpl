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
{{assign var="show_year" value=$displayParams.show_year+0 }}
{{assign var="show_prefix" value=$displayParams.show_prefix+0 }}

{if {{$show_year}} == 1} {$fields.year.value} / {/if}
{if {{$show_prefix}} == 1} {$fields.prefix.value} / {/if}
{{sugarvar key='value'}}
