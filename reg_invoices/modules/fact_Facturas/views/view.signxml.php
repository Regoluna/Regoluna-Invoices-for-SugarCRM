<?php
require_once('include/DetailView/DetailView2.php');

class fact_FacturasViewSignXml extends SugarView{

  //var $options = array('to_pdf' => true);
  
  function display(){
    global $sugar_config;
    
    switch(strtolower($_REQUEST['action'])){
      case 'signxml':
        $doc = 'XML';
        break;
      case 'signpdf':
        $doc = 'PDF';
        break;
    }
    
    echo "<div id=\"signpanel\"><p>".translate("LBL_FIRMANDO_$doc", 'fact_Facturas')."</p>";
    echo "<p>".translate('LBL_AVISO_JAVA', 'fact_Facturas')."</p>";
    
    $version="2.1.0";  // Si se cambia esto, revisar la sección de administración en la que se testea el sistema.
    $dirDoc=trim($sugar_config['site_url'],' /')."/index.php?module=fact_Facturas&action={$doc}view&record={$this->bean->id}";
    // echo "<p>Obteniendo documento de: <a href=\"$dirDoc\">$dirDoc</a></p>";
?>

<input type="submit" value="<?php print translate('LBL_CANCEL_BUTTON_LABEL');?>" 
       id="sign_subpanel_cancel_button" name="sign_subpanel_cancel_button" 
       onclick="return SUGAR.subpanelUtils.cancelCreate('subpanel_notes');return false;" 
       class="button" accesskey="X" title="Cancelar [Alt+X]">

<applet id="CryptoApplet" name="CryptoApplet" code="es.uji.security.ui.applet.SignatureApplet" 
        codebase="include/CryptoApplet/" mayscript width="0" height="0"
        archive="
                uji-ui-applet-<?php print $version ?>-signed.jar, 
                uji-config-<?php print $version ?>-signed.jar, 
                uji-utils-<?php print $version ?>-signed.jar, 
                uji-crypto-core-<?php print $version ?>-signed.jar, 
                uji-keystore-<?php print $version ?>-signed.jar, 
                uji-crypto-jxades-<?php print $version ?>-signed.jar,   
                uji-format-facturae-<?php print $version ?>-signed.jar,
                uji-format-pdf-<?php print $version ?>-signed.jar,
                lib/bcmail-jdk15-143.jar
                lib/bcprov-jdk15-143.jar,
                lib/bctsp-jdk15-143.jar,
                lib/commons-logging.jar,
                lib/itext-1.4.8.jar,
                lib/jakarta-log4j-1.2.6.jar,
                lib/jxades-1.0-signed.jar,
                lib/myxmlsec.jar,
                lib/xalan-2.7.0.jar,
                lib/xmlsec.jar "/></applet>          

<form id="send_signed_doc" action="index.php">
  <input type="hidden" name="record" value="<?php print $this->bean->id ?>" />
  <input type="hidden" name="action" value="addnote" />
  <input type="hidden" name="module" value="fact_Facturas" />
  <input type="hidden" name="type" value="<?php print $doc ?>" />
  <input type="hidden" name="doc" value="" id="form_documento"/>
</form>

<script language="javascript">

function onInitOk(){ 
	document.getElementById("sign_subpanel_cancel_button").style.visibility="hidden"; 
	Sign(); 
}
 
function onSignOk(signature){

 var theForm=document.getElementById("send_signed_doc");
 document.getElementById("form_documento").value=signature;
  
 //ajaxStatus.showStatus(SUGAR.language.get('app_strings', 'Guardando documento firmado...'));
 var success = function(data) {
	 subpanel='notes';
	 try { // Version 5.5 o superior
     SUGAR.subpanelUtils.cancelCreate('sign_subpanel_cancel_button');
   } catch (err) {}
  
   try { // Version 5.2 o superior
     SUGAR.subpanelUtils.cancelCreate('subpanel_' + subpanel);
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
 
function onSignError(errorDesc){ 
	alert("Error firmando\n"+errorDesc); 
	SUGAR.subpanelUtils.cancelCreate('subpanel_notes');
}
 
function onSignCancel(){ 
	/* alert("User Canceled"); */ 
	
	try { // Version 5.5 o superior
	     SUGAR.subpanelUtils.cancelCreate('sign_subpanel_cancel_button');
	} catch (err) {}
	  
  try { // Version 5.2 o superior
	   SUGAR.subpanelUtils.cancelCreate('subpanel_notes');
  } catch (err) {}
}
 
function Sign(){
  CryptoApplet= document.getElementById('CryptoApplet');
  <?php if($doc=='XML'){ ?>
    CryptoApplet.setInputDataEncoding("PLAIN");
    CryptoApplet.setOutputDataEncoding("PLAIN");
    CryptoApplet.setSignatureOutputFormat("FACTURAE");
  <?php }else if($doc=='PDF'){ ?>
    //CryptoApplet.setInputDataEncoding("BASE64");
    CryptoApplet.setOutputDataEncoding("BASE64");
    CryptoApplet.setSignatureOutputFormat("PDF");
  <?php } ?>
  
  CryptoApplet.setLanguage("ES_es");
  CryptoApplet.signDataUrlToFunc("<?php print $dirDoc ?>","onSignOk");
}
 
</script>
   
<?php  
  }
}