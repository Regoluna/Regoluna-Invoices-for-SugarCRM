<?php

$manifest = array (
  'acceptable_sugar_versions' => array ( 'regex_matches' => array ( "6.*\.*"), ),
  'acceptable_sugar_flavors' => array( 'CE', 'PRO','ENT' ),
  'key'=>'reg',
  'author' => 'Rodrigo Saiz Camarero',
  'description' => 'Provides basic support to generate simple invoices. Aimed at small businesses and freelancers who bill services.',
  'icon' => '',
  'is_uninstallable' => true,
  'name' => 'Regoluna Invoices',
  'published_date' => '2014-1-15',
  'type' => 'module',
  'version' => '2.0',
);

$installdefs = array (
  'id' => 'reg_invoices',
  'image_dir' => '<basepath>/icons',

  'layoutdefs' => array (
    array( 'from'=> '<basepath>/subpanels/accounts_subpanels.php', 'to_module'=> 'Accounts' ),
  ),

  'beans' =>
  array (
    array (
      'module' => 'reg_invoices',
      'class' => 'reg_invoices',
      'path' => 'modules/reg_invoices/reg_invoices.php',
      'tab' => true,
    ),
    array (
      'module' => 'reg_items',
      'class' => 'reg_items',
      'path' => 'modules/reg_items/reg_items.php',
      'tab' => false,
    ),
  ),

  'copy' => array (
    // New modules
    array ( 'from' => '<basepath>/modules/reg_items', 'to' => 'modules/reg_items' ),
    array ( 'from' => '<basepath>/modules/reg_invoices', 'to' => 'modules/reg_invoices' ),

    // Some Javascript for Ajax edit o delete items
    array ( 'from' => '<basepath>/custom/include/generic/itemUtils.js',
            'to' => 'custom/include/generic/itemUtils.js' ),
    // New SugarWidget to delete items from list
    array ( 'from' => '<basepath>/include/generic/SugarWidgets/SugarWidgetSubPanelDeleteRelatedButton.php',
            'to' => 'include/generic/SugarWidgets/SugarWidgetSubPanelDeleteRelatedButton.php' ),
    // New SugarWidget to quick create Items
    array ( 'from' => '<basepath>/include/generic/SugarWidgets/SugarWidgetSubPanelTopButtonNewItem.php',
            'to' => 'include/generic/SugarWidgets/SugarWidgetSubPanelTopButtonNewItem.php' ),
    // New SugarWidget to quick edit Items (Needs quickcreate active)
    array ( 'from' => '<basepath>/include/generic/SugarWidgets/SugarWidgetSubPanelQuickItem.php',
            'to' => 'include/generic/SugarWidgets/SugarWidgetSubPanelQuickItem.php' ),
    // New SugarWidget to arrange Items (Needs quickcreate active)
    array ( 'from' => '<basepath>/include/generic/SugarWidgets/SugarWidgetSubPanelUpDownButton.php',
            'to' => 'include/generic/SugarWidgets/SugarWidgetSubPanelUpDownButton.php' ),

    // New SugarWidget to add a button to sign invoices
    array ( 'from' => '<basepath>/include/generic/SugarWidgets/SugarWidgetSubPanelTopButtonSignXml.php',
            'to' => 'include/generic/SugarWidgets/SugarWidgetSubPanelTopButtonSignXml.php' ),

    // Styles to show description under Items
    array ( 'from' => '<basepath>/custom/themes/default/reg_invoicesStyle.css',
            'to' => 'custom/themes/default/reg_invoicesStyle.css' ),

    // Sugarwidget to show individual item taxes
    array ( 'from' => '<basepath>/include/generic/SugarWidgets/SugarWidgetSubpanelTax.php',
            'to' => 'include/generic/SugarWidgets/SugarWidgetSubpanelTax.php' ),

    // New SugarField to WYSIWYG edition of Invoice Description and Conditions
    array ( 'from' => '<basepath>/include/SugarFields/Fields/Htmledit',
            'to' => 'include/SugarFields/Fields/Htmledit' ),
    // New SugarField for IVA and IRPF
    array ( 'from' => '<basepath>/include/SugarFields/Fields/Impuesto',
            'to' => 'include/SugarFields/Fields/Impuesto' ),
    // New SugarField for Invoice Number
    array ( 'from' => '<basepath>/include/SugarFields/Fields/NumFactura',
            'to' => 'include/SugarFields/Fields/NumFactura' ),

    // We use HTML2PDF (http://html2pdf.fr) to generate PDF output
    array ( 'from' => '<basepath>/include/html2pdf_v3.28', 'to' => 'include/html2pdf' ),

    // We use CryptoApplet (http://forja.uji.es/projects/cryptoapplet) to sign PDF and Facturae.
//    array ( 'from' => '<basepath>/include/CryptoApplet_V2.1.0', 'to' => 'include/CryptoApplet' ),

    // Install new Chart into Charts module
    array ( 'from' => '<basepath>/modules/Charts/Dashlets/RegInvoicesChartDashlet', 'to' => 'modules/Charts/Dashlets/RegInvoicesChartDashlet' ),
    // Chart engine to correct colors
    array ( 'from' => '<basepath>/custom/include/SugarCharts/Jit/JitRegInvoices.php', 'to' => 'custom/include/SugarCharts/Jit/JitRegInvoices.php' ),

    // Administration sections
    array ( 'from' => '<basepath>/custom/modules/Configurator/reg_invoices_Config.php', 'to' => 'custom/modules/Configurator/reg_invoices_Config.php' ),
    array ( 'from' => '<basepath>/custom/modules/Configurator/tpls/reg_invoices_Config.tpl', 'to' => 'custom/modules/Configurator/tpls/reg_invoices_Config.tpl' ),
    array ( 'from' => '<basepath>/custom/modules/Administration/reg_invoices_Check.php', 'to' => 'custom/modules/Administration/reg_invoices_Check.php' ),
  ),

  'language' => array (
    array ( 'from' => '<basepath>/language/application_es_es.lang.php', 'to_module' => 'application', 'language' => 'es_es' ),
    array ( 'from' => '<basepath>/language/application_en_us.lang.php', 'to_module' => 'application', 'language' => 'en_us' ),

    array ( 'from' => '<basepath>/language/accounts_es_es.lang.php', 'to_module' => 'Accounts', 'language' => 'es_es' ),
    array ( 'from' => '<basepath>/language/accounts_en_us.lang.php', 'to_module' => 'Accounts', 'language' => 'en_us' ),

    // Config section
    array ( 'from' => '<basepath>/language/configurator_es_es.lang.php', 'to_module' => 'Configurator', 'language' => 'es_es' ),
    array ( 'from' => '<basepath>/language/configurator_en_us.lang.php', 'to_module' => 'Configurator', 'language' => 'en_us' ),
    array ( 'from' => '<basepath>/language/administration_es_es.lang.php', 'to_module' => 'Administration', 'language' => 'es_es' ),
    array ( 'from' => '<basepath>/language/administration_en_us.lang.php', 'to_module' => 'Administration', 'language' => 'en_us' ),
  ),

  'vardefs' => array (
    array ('from' => '<basepath>/vardefs/accounts_vardefs.php', 'to_module' => 'Accounts' ),
  ),

  // Administration section
  'administration' => array(
    array(
      'from' => '<basepath>/administration/reg_invoices_options.php',
    ),
  ),


);