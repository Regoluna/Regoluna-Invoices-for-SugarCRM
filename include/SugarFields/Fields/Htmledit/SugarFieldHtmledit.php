<?php
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
require_once('include/SugarFields/Fields/Base/SugarFieldBase.php');

class SugarFieldHtmledit extends SugarFieldBase {

  function getWirelessEditViewSmarty($parentFieldArray, $vardef, $displayParams, $tabindex) {
    $displayParams['nl2br'] = true;
    $displayParams['url2html'] = true;
    $vardef['usertheme'] = $_GET['usertheme'];
    return parent::getWirelessEditViewSmarty($parentFieldArray, $vardef, $displayParams, $tabindex);
  }

  function getVardefValue($vardef) {
    if (empty($vardef['value'])) {
      if (!empty($vardef['default'])) return from_html($vardef['default']);
      elseif (!empty($vardef['default_value'])) return from_html($vardef['default_value']);
    } else {
      return from_html($vardef['value']);
    }
  }

  function getEditViewSmarty($parentFieldArray, $vardef, $displayParams, $tabindex) {
    // parse as standard Textfield in Quickcreate ...
    $GLOBALS['log']->debug('HTMLEdit View: '.$displayParams['formName']);
    if ($displayParams['formName'] != 'EditView') {
      $type = $this->type;
      $this->type = 'text';
      $result = $this->getSmartyView($parentFieldArray, $vardef, $displayParams, $tabindex, 'EditView');
      $this->type = $type;
    } else {
      $result = $this->getSmartyView($parentFieldArray, $vardef, $displayParams, $tabindex, 'EditView');
    }
    return $result;
  }
}
