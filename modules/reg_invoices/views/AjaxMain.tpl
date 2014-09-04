
{sugar_include include=$includes}

{{* Loop through all top level panels first *}}
{{counter name="panelCount" print=false start=0 assign="panelCount"}}
{{foreach name=section from=$sectionPanels key=label item=panel}}
{{assign var='panel_id' value=$panelCount}}
<div id='{{$label}}'>
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
{{* Print out the panel title if one exists*}}

{{* Check to see if the panel variable is an array, if not, we'll attempt an include with type param php *}}
{{* See function.sugar_include.php *}}
{{if !is_array($panel)}}
    {sugar_include type='php' file='{{$panel}}'}
{{else}}
	
	{{if !empty($label) && !is_int($label) && $label != 'DEFAULT'}}
	<h4 class="dataLabel">{sugar_translate label='{{$label}}' module='{{$module}}'}</h4><br>
	{{/if}}
	{{* Print out the table data *}}
	<table width='100%' border='0' cellspacing='{$gridline}' cellpadding='0'  class='tabDetailView'>
	
	{{if $panelCount == 0}}
	    {{* Render tag for VCR control if SHOW_VCR_CONTROL is true *}}
		{{if $SHOW_VCR_CONTROL}}
			{$PAGINATION}
		{{/if}}
		{{counter name="panelCount" print=false}}
	{{/if}}
	
	{{foreach name=rowIteration from=$panel key=row item=rowData}}
	<tr>
		{{assign var='columnsInRow' value=$rowData|@count}}
		{{assign var='columnsUsed' value=0}}
	    {{foreach name=colIteration from=$rowData key=col item=colData}}





			<td width='{{$def.templateMeta.widths[$smarty.foreach.colIteration.index].label}}%' class='tabDetailViewDL'>
				{{if isset($colData.field.customLabel)}}
			       {{$colData.field.customLabel}}
				{{elseif isset($colData.field.label) && strpos($colData.field.label, '$')}}
				   {capture name="label" assign="label"}
				   {{$colData.field.label}}
				   {/capture}
			       {$label|strip_semicolon}:
				{{elseif isset($colData.field.label)}}
				   {capture name="label" assign="label"}
				   {sugar_translate label='{{$colData.field.label}}' module='{{$module}}'}
				   {/capture}
			       {$label|strip_semicolon}:
				{{elseif isset($fields[$colData.field.name])}}
				   {capture name="label" assign="label"}
				   {sugar_translate label='{{$fields[$colData.field.name].vname}}' module='{{$module}}'}
				   {/capture}
			       {$label|strip_semicolon}:
				{{else}}
				   &nbsp;
				{{/if}}
			</td>
			<td width='{{$def.templateMeta.widths[$smarty.foreach.colIteration.index].field}}%' class='tabDetailViewDF' {{if $colData.colspan}}colspan='{{$colData.colspan}}'{{/if}}>
				{{if $colData.field.customCode || $colData.field.assign}}
					{counter name="panelFieldCount"}
					{{sugar_evalcolumn var=$colData.field colData=$colData}}	
				{{elseif $fields[$colData.field.name] && !empty($colData.field.fields) }}
				    {{foreach from=$colData.field.fields item=subField}}
				        {{if $fields[$subField]}}
				        	{counter name="panelFieldCount"}
				            {{sugar_field parentFieldArray='fields' tabindex=$tabIndex vardef=$fields[$subField] displayType='detailView'}}&nbsp;
				        {{else}}
				        	{counter name="panelFieldCount"}
				            {{$subField}}
				        {{/if}}
				    {{/foreach}}					    		
				{{elseif $fields[$colData.field.name]}}
					{counter name="panelFieldCount"}
					{{sugar_field parentFieldArray='fields' vardef=$fields[$colData.field.name] displayType='detailView' displayParams=$colData.field.displayParams typeOverride=$colData.field.type}}
				{{/if}}
				&nbsp;
			</td>








		{{/foreach}}
	</tr>
	{{/foreach}}
	</table>
{{/if}}
</div>


<p>
{{/foreach}}

