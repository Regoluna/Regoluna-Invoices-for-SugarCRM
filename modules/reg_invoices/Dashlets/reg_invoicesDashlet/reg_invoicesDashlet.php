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

require_once('include/Dashlets/DashletGeneric.php');
require_once('modules/reg_invoices/reg_invoices.php');

class reg_invoicesDashlet extends DashletGeneric { 
    function reg_invoicesDashlet($id, $def = null) {
		global $current_user, $app_strings;
		require('modules/reg_invoices/metadata/dashletviewdefs.php');

        parent::DashletGeneric($id, $def);

        if(empty($def['title'])) $this->title = translate('LBL_HOMEPAGE_TITLE', 'reg_invoices');

        $this->searchFields = $dashletData['reg_invoicesDashlet']['searchFields'];
        $this->columns = $dashletData['reg_invoicesDashlet']['columns'];

        $this->seedBean = new reg_invoices();        
    }
}
