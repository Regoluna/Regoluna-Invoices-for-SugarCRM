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


{if empty({{sugarvar key='value' string=true}})}
{assign var="value" value={{sugarvar key='default_value' string=true}} }
{else}
{assign var="value" value={{sugarvar key='value' string=true}} }
{/if}  

{literal}
{* <script type="text/javascript" src="include/javascript/tiny_mce/tiny_mce.js"></script> *}
<script type="text/javascript"> tinyMCE.init({
mode : "exact", 
theme : "advanced",
editor_selector: "mceEdit", 

{*plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups",*}
plugins : "table,advhr,insertdatetime,preview,searchreplace,paste,directionality",

elements : {/literal}"{{sugarvar key='name'}}"{literal}, 
{*
theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,fontselect,fontsizeselect",
theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,|,insertdate,inserttime,preview,|,forecolor,backcolor",
theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
*}
theme_advanced_buttons1 : "bold,italic,underline,|,justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,|,outdent,indent,blockquote,|,insertdate,inserttime,fullscreen",
theme_advanced_buttons2 : "",
theme_advanced_buttons3 : "",
	
theme_advanced_toolbar_location : "top",
theme_advanced_toolbar_align : "left",
theme_advanced_statusbar_location : "none",
theme_advanced_resizing : true });</script>

{/literal}


<textarea id="{{sugarvar key='name'}}" name="{{sugarvar key='name'}}" class="mceEdit" rows="{{$displayParams.rows|default:20}}" cols="{{$displayParams.cols|default:120}}" title='{{$vardef.help}}' tabindex="{{$tabindex}}">{$value}</textarea>


