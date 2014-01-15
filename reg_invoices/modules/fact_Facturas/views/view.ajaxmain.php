<?php
require_once('include/DetailView/DetailView2.php');

class fact_FacturasViewAjaxmain extends SugarView{
  
  var $type ='detail';
  var $dv;
  
  function fact_FacturasViewAjaxmain(){
    $this->options['show_title'] = false;
    $this->options['show_header'] = false;
    $this->options['show_footer'] = false;
    $this->options['show_javascript'] = false;
    $this->options['show_subpanels'] = false;
    $this->options['show_search'] = false;
    parent::SugarView();
    $this->options['show_title'] = false;
    $this->options['show_header'] = false;
    $this->options['show_footer'] = false;
    $this->options['show_javascript'] = false;
    $this->options['show_subpanels'] = false;
    $this->options['show_search'] = false;
  }

  function preDisplay(){
    $metadataFile = null;
    $foundViewDefs = false;
    if(file_exists('custom/modules/' . $this->module . '/metadata/detailviewdefs.php')){
      $metadataFile = 'custom/modules/' . $this->module . '/metadata/detailviewdefs.php';
      $foundViewDefs = true;
    }else{
      if(file_exists('custom/modules/'.$this->module.'/metadata/metafiles.php')){
        require_once('custom/modules/'.$this->module.'/metadata/metafiles.php');
        if(!empty($metafiles[$this->module]['detailviewdefs'])){
          $metadataFile = $metafiles[$this->module]['detailviewdefs'];
          $foundViewDefs = true;
        }
      }elseif(file_exists('modules/'.$this->module.'/metadata/metafiles.php')){
        require_once('modules/'.$this->module.'/metadata/metafiles.php');
        if(!empty($metafiles[$this->module]['detailviewdefs'])){
          $metadataFile = $metafiles[$this->module]['detailviewdefs'];
          $foundViewDefs = true;
        }
      }
    }
    $GLOBALS['log']->debug("metadatafile=". $metadataFile);
    if(!$foundViewDefs && file_exists('modules/'.$this->module.'/metadata/detailviewdefs.php')){
        $metadataFile = 'modules/'.$this->module.'/metadata/detailviewdefs.php';
    }

    $this->dv = new DetailView2();
    $this->dv->ss = &$this->ss;
    $this->dv->setup($this->module, $this->bean, $metadataFile, 'modules/fact_Facturas/views/AjaxMain.tpl');
    
    // First time the template is created we need to deactivate cached files
    if( !file_exists('cache/modules/fact_Facturas/form_DetailView_fact_Facturas.tpl') ){
       $this->th2 = new TemplateHandler();
       $this->th2->clearCache($this->module);
    }
       
  }
  
  function display(){
    if(empty($this->bean->id)){
      global $app_strings;
      sugar_die($app_strings['ERROR_NO_RECORD']);
    }
    $this->dv->process();
    echo $this->dv->display(false,true);
  }
  
}