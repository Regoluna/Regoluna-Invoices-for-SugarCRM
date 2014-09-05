<?php
$manifest = array (
  'acceptable_sugar_versions' => 
  array (
    'regex_matches' => 
    array (
      0 => '6.*\\.*',
    ),
  ),
  'acceptable_sugar_flavors' => 
  array (
    0 => 'CE',
    1 => 'PRO',
    2 => 'ENT',
  ),
  'key' => 'reg',
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
  'layoutdefs' => 
  array (
    0 => 
    array (
      'from' => '<basepath>/subpanels/accounts_subpanels.php',
      'to_module' => 'Accounts',
    ),
  ),
  'beans' => 
  array (
    0 => 
    array (
      'module' => 'reg_invoices',
      'class' => 'reg_invoices',
      'path' => 'modules/reg_invoices/reg_invoices.php',
      'tab' => true,
    ),
    1 => 
    array (
      'module' => 'reg_items',
      'class' => 'reg_items',
      'path' => 'modules/reg_items/reg_items.php',
      'tab' => false,
    ),
  ),
  'copy' => 
  array (
    0 => 
    array (
      'from' => '<basepath>/modules/reg_items',
      'to' => 'modules/reg_items',
    ),
    1 => 
    array (
      'from' => '<basepath>/modules/reg_invoices',
      'to' => 'modules/reg_invoices',
    ),
    2 => 
    array (
      'from' => '<basepath>/modules/reg_companies',
      'to' => 'modules/reg_companies',
    ),
    3 => 
    array (
      'from' => '<basepath>/custom/Extension/application/Ext/Include/reg_companies.php',
      'to' => 'custom/Extension/application/Ext/Include/reg_companies.php',
    ),
    4 => 
    array (
      'from' => '<basepath>/custom/include/generic/itemUtils.js',
      'to' => 'custom/include/generic/itemUtils.js',
    ),
    5 => 
    array (
      'from' => '<basepath>/include/generic/SugarWidgets/SugarWidgetSubPanelDeleteRelatedButton.php',
      'to' => 'include/generic/SugarWidgets/SugarWidgetSubPanelDeleteRelatedButton.php',
    ),
    6 => 
    array (
      'from' => '<basepath>/include/generic/SugarWidgets/SugarWidgetSubPanelTopButtonNewItem.php',
      'to' => 'include/generic/SugarWidgets/SugarWidgetSubPanelTopButtonNewItem.php',
    ),
    7 => 
    array (
      'from' => '<basepath>/include/generic/SugarWidgets/SugarWidgetSubPanelQuickItem.php',
      'to' => 'include/generic/SugarWidgets/SugarWidgetSubPanelQuickItem.php',
    ),
    8 => 
    array (
      'from' => '<basepath>/include/generic/SugarWidgets/SugarWidgetSubPanelUpDownButton.php',
      'to' => 'include/generic/SugarWidgets/SugarWidgetSubPanelUpDownButton.php',
    ),
    9 => 
    array (
      'from' => '<basepath>/include/generic/SugarWidgets/SugarWidgetSubPanelTopButtonSignXml.php',
      'to' => 'include/generic/SugarWidgets/SugarWidgetSubPanelTopButtonSignXml.php',
    ),
    10 => 
    array (
      'from' => '<basepath>/custom/themes/default/reg_invoicesStyle.css',
      'to' => 'custom/themes/default/reg_invoicesStyle.css',
    ),
    11 => 
    array (
      'from' => '<basepath>/include/generic/SugarWidgets/SugarWidgetSubpanelTax.php',
      'to' => 'include/generic/SugarWidgets/SugarWidgetSubpanelTax.php',
    ),
    12 => 
    array (
      'from' => '<basepath>/include/SugarFields/Fields/Htmledit',
      'to' => 'include/SugarFields/Fields/Htmledit',
    ),
    13 => 
    array (
      'from' => '<basepath>/include/SugarFields/Fields/Impuesto',
      'to' => 'include/SugarFields/Fields/Impuesto',
    ),
    14 => 
    array (
      'from' => '<basepath>/include/SugarFields/Fields/NumFactura',
      'to' => 'include/SugarFields/Fields/NumFactura',
    ),
    15 => 
    array (
      'from' => '<basepath>/include/html2pdf_v3.28',
      'to' => 'include/html2pdf',
    ),
    16 => 
    array (
      'from' => '<basepath>/modules/Charts/Dashlets/RegInvoicesChartDashlet',
      'to' => 'modules/Charts/Dashlets/RegInvoicesChartDashlet',
    ),
    17 => 
    array (
      'from' => '<basepath>/custom/include/SugarCharts/Jit/JitRegInvoices.php',
      'to' => 'custom/include/SugarCharts/Jit/JitRegInvoices.php',
    ),
    18 => 
    array (
      'from' => '<basepath>/custom/Extension/modules/Administration/Ext/Administration/reg_invoices_options.php',
      'to' => 'custom/Extension/modules/Administration/Ext/Administration/reg_invoices_options.php',
    ),
    19 => 
    array (
      'from' => '<basepath>/custom/modules/Configurator/reg_invoices_Config.php',
      'to' => 'custom/modules/Configurator/reg_invoices_Config.php',
    ),
    20 => 
    array (
      'from' => '<basepath>/custom/modules/Configurator/tpls/reg_invoices_Config.tpl',
      'to' => 'custom/modules/Configurator/tpls/reg_invoices_Config.tpl',
    ),
    21 => 
    array (
      'from' => '<basepath>/custom/modules/Administration/reg_invoices_Check.php',
      'to' => 'custom/modules/Administration/reg_invoices_Check.php',
    ),
    22 => 
    array (
      'from' => '<basepath>/custom/Extension/modules/Administration/Ext/Language/en_us.reg_invoices.php',
      'to' => 'custom/Extension/modules/Administration/Ext/Language/en_us.reg_invoices.php',
    ),
    23 => 
    array (
      'from' => '<basepath>/custom/Extension/modules/Administration/Ext/Language/es_es.reg_invoices.php',
      'to' => 'custom/Extension/modules/Administration/Ext/Language/es_es.reg_invoices.php',
    ),
  ),
  'language' => 
  array (
    0 => 
    array (
      'from' => '<basepath>/language/application_es_es.lang.php',
      'to_module' => 'application',
      'language' => 'es_es',
    ),
    1 => 
    array (
      'from' => '<basepath>/language/application_en_us.lang.php',
      'to_module' => 'application',
      'language' => 'en_us',
    ),
    2 => 
    array (
      'from' => '<basepath>/language/accounts_es_es.lang.php',
      'to_module' => 'Accounts',
      'language' => 'es_es',
    ),
    3 => 
    array (
      'from' => '<basepath>/language/accounts_en_us.lang.php',
      'to_module' => 'Accounts',
      'language' => 'en_us',
    ),
    4 => 
    array (
      'from' => '<basepath>/language/configurator_es_es.lang.php',
      'to_module' => 'Configurator',
      'language' => 'es_es',
    ),
    5 => 
    array (
      'from' => '<basepath>/language/configurator_en_us.lang.php',
      'to_module' => 'Configurator',
      'language' => 'en_us',
    ),
  ),
  'vardefs' => 
  array (
    0 => 
    array (
      'from' => '<basepath>/vardefs/accounts_vardefs.php',
      'to_module' => 'Accounts',
    ),
  ),
);
