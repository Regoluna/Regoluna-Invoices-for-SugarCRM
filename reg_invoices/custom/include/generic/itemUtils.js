
function deleteRelatedElement(sp,mod_borrar,id_borrar,rp){
	
	return_url="index.php?module="+get_module_name()
	+"&action=SubPanelViewer&subpanel="+sp
	+"&record="+get_record_id()
	+"&sugar_body_only=1&inline=1";
		
	remove_url="index.php?module=fact_Items"
	+"&action=Delete"
	+"&record="+id_borrar
	+"&return_url="+escape(escape(return_url))
	+"&refresh_page="+rp;
	
	showSubPanel(sp,remove_url,true);
	actualizarTotal(get_record_id());
}
 
function actualizarTotal(id){

	var form = document.createElement("form");
	createNewFormElement(form, "record", id);
	createNewFormElement(form, "action", "AjaxMain");
	createNewFormElement(form, "module", "fact_Facturas");
	createNewFormElement(form, "to_pdf", "true");
	document.body.appendChild(form);
	form.method = "POST";
	form.id="update_main";
	form.action= "index.php";
	
	sendAndRetrieve(form.id, 'fact_Facturas_detailview_tabs', 'Loading ...');
}
 
// Guardamos los datos cambiados mediante "QuickEdit"
function saveQuickEdit(theForm, subpanel) {

	ajaxStatus.showStatus(SUGAR.language.get('app_strings', 'LBL_SAVING'));
	
	var success = function(data) {
		try { // Version 5.5 o superior
		  SUGAR.subpanelUtils.cancelCreate('fact_Items_subpanel_cancel_button');
		} catch (err) {}
		
		try { // Version 5.2 o superior
		  SUGAR.subpanelUtils.cancelCreate('subpanel_fact_items');
		} catch (err) {}
		
		var module = get_module_name();
		var id = get_record_id();
		var layout_def_key = get_layout_def_key();

		try {
			eval('result = ' + data.responseText);
		} catch (err) {
		
		}

		if (typeof(result) != 'undefined' && result != null && typeof(result['status']) != 'undefined' && result['status'] !=null && result['status'] == 'dupe') {
			document.location.href = "index.php?" + result['get'].replace(/&amp;/gi,'&').replace(/&lt;/gi,'<').replace(/&gt;/gi,'>').replace(/&#039;/gi,'\'').replace(/&quot;/gi,'"').replace(/\r\n/gi,'\n');
			return;
		} else {
			showSubPanel(subpanel, null, true);
			ajaxStatus.showStatus(SUGAR.language.get('app_strings', 'LBL_SAVED'));
			window.setTimeout('ajaxStatus.hideStatus()', 1000);
            if(reloadpage) window.location.reload(false);
            actualizarTotal(id);
		}
	}
    // reload page if we are setting status to Held
    var reloadpage = false;
    YAHOO.util.Connect.setForm(theForm, true, true); 			
	var cObj = YAHOO.util.Connect.asyncRequest('POST', 'index.php', {success: success, failure: success, upload:success});					  
	return false;
}
 

//helper function to add elements to the form
function createNewFormElement(inputForm, elementName, elementValue){
 	 //var newElement = document.createElement("<input name='"+elementName+"' type='hidden'>");
 	var newElement = document.createElement("input");
 	newElement.setAttribute('name',elementName);
 	newElement.setAttribute('type',"hidden");
 	newElement.setAttribute('value',elementValue);
 	
 	 //alert("Nuevo elemento" + elementName + " - " + elementValue);
 	 inputForm.appendChild(newElement);
 	 // newElement.value = elementValue;
 	 return newElement;
}

 
function quickEditItem(id){	
	
	var form = document.getElementById('formformfact_Items');

	form.record.value = id
	form.action.value = "QuickEdit"; 
	form.module.value = "fact_Items";
	//form.return_module.value = "fact_Facturas"; 
	form.return_action.value = "DetailView"; 


	// Send form and retrieve into subpanel
	SUGAR.subpanelUtils.sendAndRetrieve(form.id, 'subpanel_fact_items', 'Loading ...', 'fact_items');
	
	form.record.value = '';
}

function upDown(sp,ordenar,id,rp){
	
	return_url="index.php?module="+get_module_name()
	+"&action=SubPanelViewer"
	+"&subpanel="+sp
	+"&record="+get_record_id()
	+"&sugar_body_only=1&inline=1";
		
	remove_url="index.php?module=fact_Items"
	+"&action=UpDown"
	+"&record="+id
	+"&factid="+get_record_id()
	+"&ordenar="+ordenar
	+"&return_url="+escape(escape(return_url))
	+"&refresh_page="+rp;
	
	showSubPanel(sp,remove_url,true);
}