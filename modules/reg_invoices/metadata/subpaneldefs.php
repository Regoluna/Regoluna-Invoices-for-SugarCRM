<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

$layout_defs['reg_invoices'] = array(
	// list of what Subpanels to show in the DetailView 
	'subpanel_setup' => array(
    // Mucho OJO con el nombre que le damos, porque si es incorrecto
    // no funcionará la creación rápida.
		'reg_items' => array(    
			'ordered' => 1,
      'sort_order' => 'ASC',
      'sort_by' => 'ordered',
			'module' => 'reg_items',
			'subpanel_name' => 'default',
			'get_subpanel_data' => 'items', // Nombre del campo LINK
			'title_key' => 'LBL_ITEMS_SUBPANEL',
			'top_buttons' => array(
				array('widget_class' => 'SubPanelTopButtonNewItem'),
			),
		),

		'notes' => array(    
      'ordered' => 30,
      'sort_order' => 'DESC',
      'sort_by' => 'date_modified',
      'module' => 'Notes',
      'subpanel_name' => 'default',
      'get_subpanel_data' => 'notes', // Nombre del campo LINK
      'title_key' => 'LBL_NOTES_SUBPANEL',
      'top_buttons' => array(
        array('widget_class' => 'SubPanelTopCreateButton'),
        array('widget_class' => 'SubPanelTopButtonSignXml'),
        array('widget_class' => 'SubPanelTopButtonSignXml','mode'=>'Pdf'),
      ),
    ),
		
	),
);
?>
