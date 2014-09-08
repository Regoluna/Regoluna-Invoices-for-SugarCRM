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
  'layoutdefs' => 
  array (
    0 => 
    array (
      'from' => '<basepath>/subpanels/accounts_subpanels.php',
      'to_module' => 'Accounts',
    ),
  ),

  'copy' => 
  array (

    array (
      'from' => '<basepath>/modules/reg_items',
      'to' => 'modules/reg_items',
    ),

    array (
      'from' => '<basepath>/modules/reg_invoices',
      'to' => 'modules/reg_invoices',
    ),

    array (
      'from' => '<basepath>/modules/reg_companies',
      'to' => 'modules/reg_companies',
    ),

    array (
      'from' => '<basepath>/custom/Extension/application/Ext/Include/reg_companies.php',
      'to' => 'custom/Extension/application/Ext/Include/reg_companies.php',
    ),
    
    array (
      'from' => '<basepath>/custom/Extension/application/Ext/Include/reg_invoices.php',
      'to' => 'custom/Extension/application/Ext/Include/reg_invoices.php',
    ),
    
    array (
      'from' => '<basepath>/custom/Extension/application/Ext/Include/reg_items.php',
      'to' => 'custom/Extension/application/Ext/Include/reg_items.php',
    ),

    array (
      'from' => '<basepath>/custom/include/generic/itemUtils.js',
      'to' => 'custom/include/generic/itemUtils.js',
    ),

    array (
      'from' => '<basepath>/include/generic/SugarWidgets/SugarWidgetSubPanelDeleteRelatedButton.php',
      'to' => 'include/generic/SugarWidgets/SugarWidgetSubPanelDeleteRelatedButton.php',
    ),

    array (
      'from' => '<basepath>/include/generic/SugarWidgets/SugarWidgetSubPanelTopButtonNewItem.php',
      'to' => 'include/generic/SugarWidgets/SugarWidgetSubPanelTopButtonNewItem.php',
    ),

    array (
      'from' => '<basepath>/include/generic/SugarWidgets/SugarWidgetSubPanelQuickItem.php',
      'to' => 'include/generic/SugarWidgets/SugarWidgetSubPanelQuickItem.php',
    ),

    array (
      'from' => '<basepath>/include/generic/SugarWidgets/SugarWidgetSubPanelUpDownButton.php',
      'to' => 'include/generic/SugarWidgets/SugarWidgetSubPanelUpDownButton.php',
    ),

    array (
      'from' => '<basepath>/include/generic/SugarWidgets/SugarWidgetSubPanelTopButtonSignXml.php',
      'to' => 'include/generic/SugarWidgets/SugarWidgetSubPanelTopButtonSignXml.php',
    ),

    array (
      'from' => '<basepath>/custom/themes/default/reg_invoicesStyle.css',
      'to' => 'custom/themes/default/reg_invoicesStyle.css',
    ),

    array (
      'from' => '<basepath>/include/generic/SugarWidgets/SugarWidgetSubpanelTax.php',
      'to' => 'include/generic/SugarWidgets/SugarWidgetSubpanelTax.php',
    ),

    array (
      'from' => '<basepath>/include/SugarFields/Fields/Htmledit',
      'to' => 'include/SugarFields/Fields/Htmledit',
    ),

    array (
      'from' => '<basepath>/include/SugarFields/Fields/Impuesto',
      'to' => 'include/SugarFields/Fields/Impuesto',
    ),

    array (
      'from' => '<basepath>/include/SugarFields/Fields/NumFactura',
      'to' => 'include/SugarFields/Fields/NumFactura',
    ),

    array (
      'from' => '<basepath>/include/html2pdf_v3.28',
      'to' => 'include/html2pdf',
    ),

    array (
      'from' => '<basepath>/modules/Charts/Dashlets/RegInvoicesChartDashlet',
      'to' => 'modules/Charts/Dashlets/RegInvoicesChartDashlet',
    ),

    array (
      'from' => '<basepath>/custom/include/SugarCharts/Jit/JitRegInvoices.php',
      'to' => 'custom/include/SugarCharts/Jit/JitRegInvoices.php',
    ),

    array (
      'from' => '<basepath>/custom/Extension/modules/Administration/Ext/Administration/reg_invoices_options.php',
      'to' => 'custom/Extension/modules/Administration/Ext/Administration/reg_invoices_options.php',
    ),

    array (
      'from' => '<basepath>/custom/modules/Administration/reg_invoices_Check.php',
      'to' => 'custom/modules/Administration/reg_invoices_Check.php',
    ),

    array (
      'from' => '<basepath>/custom/Extension/modules/Administration/Ext/Language/en_us.reg_invoices.php',
      'to' => 'custom/Extension/modules/Administration/Ext/Language/en_us.reg_invoices.php',
    ),

    array (
      'from' => '<basepath>/custom/Extension/modules/Administration/Ext/Language/es_es.reg_invoices.php',
      'to' => 'custom/Extension/modules/Administration/Ext/Language/es_es.reg_invoices.php',
    ),

    array (
      'from' => '<basepath>/custom/Extension/application/Ext/Language/en_us.reg_invoices.php',
      'to' => 'custom/Extension/application/Ext/Language/en_us.reg_invoices.php',
    ),

    array (
      'from' => '<basepath>/custom/Extension/application/Ext/Language/es_es.reg_invoices.php',
      'to' => 'custom/Extension/application/Ext/Language/es_es.reg_invoices.php',
    ),

    array (
      'from' => '<basepath>/custom/Extension/modules/Accounts/Ext/Language/en_us.reg_invoices.php',
      'to' => 'custom/Extension/modules/Accounts/Ext/Language/en_us.reg_invoices.php',
    ),

    array (
      'from' => '<basepath>/custom/Extension/modules/Accounts/Ext/Language/es_es.reg_invoices.php',
      'to' => 'custom/Extension/modules/Accounts/Ext/Language/es_es.reg_invoices.php',
    ),

    array (
      'from' => '<basepath>/custom/themes/default/images/Createreg_companies.gif',
      'to' => 'custom/themes/default/images/Createreg_companies.gif',
    ),
    array (
      'from' => '<basepath>/custom/themes/default/images/Createreg_invoices.gif',
      'to' => 'custom/themes/default/images/Createreg_invoices.gif',
    ),
    array (
      'from' => '<basepath>/custom/themes/default/images/icon_reg_invoices.gif',
      'to' => 'custom/themes/default/images/icon_reg_invoices.gif',
    ),
    array (
      'from' => '<basepath>/custom/themes/default/images/icon_reg_invoices_32.gif',
      'to' => 'custom/themes/default/images/icon_reg_invoices_32.gif',
    ),
    array (
      'from' => '<basepath>/custom/themes/default/images/icon_reg_companies.gif',
      'to' => 'custom/themes/default/images/icon_reg_companies.gif',
    ),
    array (
      'from' => '<basepath>/custom/themes/default/images/icon_reg_companies_32.gif',
      'to' => 'custom/themes/default/images/icon_reg_companies_32.gif',
    ),
    array (
      'from' => '<basepath>/custom/themes/default/images/reg_invoices.gif',
      'to' => 'custom/themes/default/images/reg_invoices.gif',
    ),
    array (
      'from' => '<basepath>/custom/themes/default/images/reg_companies.gif',
      'to' => 'custom/themes/default/images/reg_companies.gif',
    ),
    array (
      'from' => '<basepath>/custom/Extension/application/Ext/Utils/reg_invoices.php',
      'to' => 'custom/Extension/application/Ext/Utils/reg_invoices.php',
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
