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
class fact_FacturasController extends SugarController{

  // returns a simple view of detail view to be loaded via Ajax.
  function action_AjaxMain(){
    $this->view = 'ajaxmain';
  }
  
  // returns xml view in "facturae" format (spanish invoices).
  function action_XmlView(){
    $this->view = 'xml';
  }
  
  // returns invoice in PDF format.
  function action_PdfView(){
    $this->view = 'pdf';
  }

  // returns invoice in PDF format.
  function action_PrintPdf(){
    $this->view = 'pdf';
  }
  
  // Signs XML using CryptoApplet.
  function action_SignXml(){
    $this->view = 'SignXml';
  }
  
  // Signs PDF using CryptoApplet.
  function action_SignPdf(){
    $this->view = 'SignXml';
  }
  
  // Adds a note with attachment from signed XML or PDF.
  function action_AddNote(){
    global $sugar_config;
    
    // $this->view = 'AddNote';
       
    // Creamos una nota
    require_once "modules/Notes/Note.php";
    $nota=new Note();
    $nota->name="Factura firmada ".date();
    $nota->parent_type="fact_Facturas";
    $nota->parent_id=$_POST['record'];
    //$GLOBALS['log']->fatal("NOTA= ".print_r($_POST,true) );
    
    // Guardamos la nota y obtenemos el id
    $id=$nota->save();
    
    // Guardamos el archivo ($_POST['doc'])
    if($_POST['type']=='XML'){
      file_put_contents(trim($sugar_config['upload_dir']," /")."/$id" , trim(html_entity_decode($_POST['doc'])));
      $nota->file_mime_type="text/xml";
      $nota->filename="Factura.xml";
      $nota->save();
    }else if($_POST['type']=='PDF'){
      file_put_contents(trim($sugar_config['upload_dir']," /")."/$id" , base64_decode($_POST['doc']) );
      $nota->file_mime_type="application/pdf";
      $nota->filename="Factura.pdf";
      $nota->save();
    }
    die();
  }
  
}