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
class fact_ItemsController extends SugarController{

  // returns a simple view of edit view for quick edit.
  function action_QuickEdit(){
    $this->view = 'quickedit';
  }
  
  // When trying to DetailView, redirects to fact_Factura.
  function action_DetailView(){
    SugarApplication::redirect("index.php?action=DetailView&module=fact_Facturas&record={$this->bean->factura_id}");
  }
  
}