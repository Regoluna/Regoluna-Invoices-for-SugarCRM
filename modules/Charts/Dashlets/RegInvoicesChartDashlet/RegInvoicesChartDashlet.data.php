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
$dashletData['RegInvoicesChartDashlet']['searchFields'] = array(

    'fcd_date_start' => array(
        'name'  => 'fcd_date_start',
        'vname' => 'LBL_DATE_START',
        'type'  => 'datepicker',
    ),
    'fcd_date_end' => array(
        'name'  => 'fcd_date_end',
        'vname' => 'LBL_DATE_END',
        'type'  => 'datepicker',
    ),
    'fcd_date_end' => array(
        'name'  => 'fcd_date_end',
        'vname' => 'LBL_DATE_END',
        'type'  => 'datepicker',
    ),
    'with_taxes' => array(
        'name'  => 'with_taxes',
        'vname' => 'LBL_AMOUNT_WITH_TAXES',
        'type'  => 'bool',
    ),
);
