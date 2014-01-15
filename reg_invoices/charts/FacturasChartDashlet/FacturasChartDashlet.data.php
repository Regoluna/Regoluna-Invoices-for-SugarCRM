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
$dashletData['FacturasChartDashlet']['searchFields'] = array(
	/*'which_chart' => array(
                'name'  => 'which_chart',
                'vname' => translate('LBL_WHICH_CHART','Charts'),
                'type'  => 'enum',
                'options' => array(),
            ),
        'fcd_ids' => array(
                'name'  => 'fcd_ids',
                'vname' => 'LBL_USERS',
                'type'  => 'user_name',
            ),*/
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
        );
?>
