<?php

if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

global $app_strings;
global $app_list_strings;
global $mod_strings;
global $theme;
global $currentModule;
global $gridline;

$theme_path="themes/".$theme."/";
$image_path=$theme_path."images/";
require_once($theme_path.'layout_utils.php');

require_once 'modules/Configurator/Configurator.php';


echo "<p>".get_module_title($mod_strings['LBL_MODULE_NAME'], $mod_strings['LBL_FACT_CHECK_TITLE'], true)."</p>";

// Comprobando GD
echo "<p>{$mod_strings['LBL_CHECKING_GD']}...   &nbsp;&nbsp;&nbsp;&nbsp;";
if (extension_loaded('gd') && function_exists('gd_info')) {
  echo "OK </p><p>{$mod_strings['LBL_GD_INSTALLED']}</p>";
}else{
  echo "ERROR </p><p>{$mod_strings['LBL_GD_NOT_INSTALLED']}</p>";
}

// Comprobando CryptoApplet
echo "<br/><br/><p>{$mod_strings['LBL_CHECKING_CRYPTOAPPLET']}...</p>";

$version="2.1.0";
$archivos=array(
  "uji-ui-applet-{$version}-signed.jar",
  "uji-config-{$version}-signed.jar",
  "uji-utils-{$version}-signed.jar",
  "uji-crypto-core-{$version}-signed.jar",
  "uji-keystore-{$version}-signed.jar",
  "uji-crypto-jxades-{$version}-signed.jar",
  "uji-format-facturae-{$version}-signed.jar",
  "uji-format-pdf-{$version}-signed.jar",
  "lib/bcmail-jdk15-143.jar",
  "lib/bcprov-jdk15-143.jar",
  "lib/bctsp-jdk15-143.jar",
  "lib/commons-logging.jar",
  "lib/itext-1.4.8.jar",
  "lib/jakarta-log4j-1.2.6.jar",
  "lib/jxades-1.0-signed.jar",
  "lib/myxmlsec.jar",
  "lib/xalan-2.7.0.jar",
  "lib/xmlsec.jar ",
);

echo "<ul>";
$crypto_ok=true;
foreach($archivos as $archivo){
  $f = trim("include/CryptoApplet/$archivo");
  echo "<li>$f ... ";
  if( file_exists($f) ){
    echo "OK </li>";
  }else{
    echo "<span style=\"background-color:red;font-weight:bold;padding:2px;color:#FFF;\">NOT FOUND</span></li>";
    $crypto_ok=false;
  }
}
echo "</ul>";
              
$configurator = new Configurator();

if ($crypto_ok) {
  
  echo "<p>{$mod_strings['LBL_CRYPTOAPPLET_INSTALLED']}</p>";
  if ( $configurator->config['fact_deactivate_applet'] ){
    echo "<p>{$mod_strings['LBL_CRYPTOAPPLET_ACTIVATED']}</p>";
    $configurator->config['fact_deactivate_applet']=false;
    $configurator->saveConfig();
  }
  
}else{
  
  echo "<p>NOTICE: {$mod_strings['LBL_CRYPTOAPPLET_NOT_INSTALLED']}</p>";
  echo "<p>NOTICE: {$mod_strings['LBL_CRYPTOAPPLET_INSTALL_HOW_TO']}</p>";
  echo "<p><span style=\"background-color:red;font-weight:bold;padding:2px;color:#FFF;\">".
           "{$mod_strings['LBL_CRYPTOAPPLET_DEACTIVATED']}</span></p>";
  $configurator->config['fact_deactivate_applet']=true;
  $configurator->saveConfig();
  
}
