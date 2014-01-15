<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
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
 
global $app_strings;

$dashletMeta['fact_FacturasDashlet'] = array('module'		=> 'fact_Facturas',
										  'title'       => translate('LBL_HOMEPAGE_TITLE', 'fact_Facturas'), 
                                          'description' => 'A customizable view into fact_Facturas',
                                          'icon'        => 'themes/default/images/icon_fact_Facturas_32.gif',
                                          'category'    => 'Module Views');
