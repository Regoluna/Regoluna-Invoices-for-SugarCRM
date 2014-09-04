<?php

$mod_strings['LBL_FACT_CONFIG_GROUP']= 'Facturas Regoluna';
$mod_strings['LBL_FACT_CONFIG_GROUP_DESC']= 'Configuración de facturas y chequeo de dependencias.';

$mod_strings['LBL_FACT_CONFIG']= 'Configuración de facturas';
$mod_strings['LBL_FACT_CONFIG_DESC']= 'Opciones de numeración y generación de facturas PDF y Facturae';

$mod_strings['LBL_FACT_CHECK']= 'Comprobar sistema';
$mod_strings['LBL_FACT_CHECK_DESC']= 'Comprueba si el sistema está listo para generar y firmar facturas.';

// Sección de comprobación
$mod_strings['LBL_CHECKING_GD']= 'Comprobando GD ...';
$mod_strings['LBL_GD_INSTALLED']= 'Parece que GD está instalado';
$mod_strings['LBL_GD_NOT_INSTALLED']= 'Parece que la extensión GD de PHP no está instalada.<br>La librería GD es necesaria para generar los PDFs de las facturas.';

$mod_strings['LBL_CHECKING_CRYPTOAPPLET']= 'comprobando CryptoApplet ...';
$mod_strings['LBL_CRYPTOAPPLET_INSTALLED']= 'Parece que CryptoApplet está correctamente instalado';
$mod_strings['LBL_CRYPTOAPPLET_NOT_INSTALLED']= 'No se ha encontrado CryptoApplet .<br>CryptoApplet es necesario para firmar digitalmente las facturas.';
$mod_strings['LBL_CRYPTOAPPLET_ACTIVATED']= 'Las funcionalidades de firma digital han sido activadas.';
$mod_strings['LBL_CRYPTOAPPLET_DEACTIVATED']= 'Se han desactivado las funciones de firma digital.';
$mod_strings['LBL_CRYPTOAPPLET_INSTALL_HOW_TO']=
  '<p>Para poder firmar documentos digitalmente tendrá que descargar cryptoapplet desde '.
  '<a href="http://forja.uji.es/frs/download.php/124/CryptoApplet_V2.1.0.tgz">este enlace</a>. '.
  'Descomprimirlo y guardarlo en la carpeta <strong>include/CryptoApplet</strong> y después visite esta página de nuevo.</p>';
?>
