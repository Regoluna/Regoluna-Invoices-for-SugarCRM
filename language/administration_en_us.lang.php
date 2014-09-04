<?php

$mod_strings['LBL_FACT_CONFIG_GROUP']= 'Regoluna Invoices';
$mod_strings['LBL_FACT_CONFIG_GROUP_DESC']= 'Configure invoices.';

$mod_strings['LBL_FACT_CONFIG']= 'Invoice config';
$mod_strings['LBL_FACT_CONFIG_DESC']= 'Opciones de numeración y generación de facturas PDF y Facturae';

$mod_strings['LBL_FACT_CHECK']= 'System check';
$mod_strings['LBL_FACT_CHECK_DESC']= 'Check dependencies and configuration';

// Sección de comprobación
$mod_strings['LBL_CHECKING_GD']= 'Checking GD ...';
$mod_strings['LBL_GD_INSTALLED']= 'It looks like GD is installed';
$mod_strings['LBL_GD_NOT_INSTALLED']= 'It looks like GD extension for PHP is not installed.<br>GD is needed to generate invoice PDFs';

$mod_strings['LBL_CHECKING_CRYPTOAPPLET']= 'Checking CryptoApplet ...';
$mod_strings['LBL_CRYPTOAPPLET_INSTALLED']= 'It looks like CryptoApplet is correctly installed';
$mod_strings['LBL_CRYPTOAPPLET_NOT_INSTALLED']= 'CryptoApplet is not installed.<br>CryptoApplet is needed to sign invoices';

$mod_strings['LBL_CRYPTOAPPLET_ACTIVATED']= 'Electronic signature has been activated.';
$mod_strings['LBL_CRYPTOAPPLET_DEACTIVATED']= 'Electronic signature has been deactivated.';
$mod_strings['LBL_CRYPTOAPPLET_INSTALL_HOW_TO']=
  '<p>To be able to digitally sign documents you need to download CryptoApplet from '.
  '<a href="http://forja.uji.es/frs/download.php/124/CryptoApplet_V2.1.0.tgz">this link</a>. '.
  'Uncompress and save it to <strong>include/CryptoApplet</strong> and visit this page again.</p>';

?>