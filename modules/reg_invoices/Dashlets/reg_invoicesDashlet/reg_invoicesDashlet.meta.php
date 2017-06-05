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

$dashletMeta['reg_invoicesDashlet'] = array('module'		=> 'reg_invoices',
										  'title'       => translate('LBL_HOMEPAGE_TITLE', 'reg_invoices'), 
                                          'description' => 'A customizable view into reg_invoices',
                                          'icon'        => 'themes/default/images/icon_reg_invoices_32.gif',
                                          'category'    => 'Module Views');
