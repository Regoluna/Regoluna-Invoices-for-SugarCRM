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
require_once('modules/fact_Items/fact_Items.php');

class fact_ItemsDashlet extends DashletGeneric { 
    function fact_ItemsDashlet($id, $def = null) {
		global $current_user, $app_strings;
		require('modules/fact_Items/metadata/dashletviewdefs.php');

        parent::DashletGeneric($id, $def);

        if(empty($def['title'])) $this->title = translate('LBL_HOMEPAGE_TITLE', 'fact_Items');

        $this->searchFields = $dashletData['fact_ItemsDashlet']['searchFields'];
        $this->columns = $dashletData['fact_ItemsDashlet']['columns'];

        $this->seedBean = new fact_Items();        
    }
}
