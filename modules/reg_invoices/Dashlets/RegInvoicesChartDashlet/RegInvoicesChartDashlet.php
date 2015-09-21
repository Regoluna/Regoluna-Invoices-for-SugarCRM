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
require_once('include/Dashlets/DashletGenericChart.php');

class RegInvoicesChartDashlet extends DashletGenericChart
{
  public $fcd_ids = array();
  public $fcd_date_start;
  public $fcd_date_end;
  var $chartDefs;
  var $chartDefName;

  protected $_seedName = 'reg_invoices';

  public function __construct($id, array $options = null)
  {
    global $timedate;

    if(empty($options['fcd_date_start']))
      $options['fcd_date_start'] = date($timedate->get_db_date_time_format(), time());

    if(empty($options['fcd_date_end']))
      $options['fcd_date_end'] = date($timedate->get_db_date_time_format(), time()+86400*365);

    parent::__construct($id,$options);
  }
  
  /**
    * @see DashletGenericChart::displayOptions()
    */
  public function displayOptions() {
    global $app_list_strings;
    
    // Function dropdowns are not well supported in Charts
    // so we are creating a temporary list string.
    $invoice = $this->getSeedBean()->field_defs['issuer_id']['options'] = 'reg_invoices_issuer_dom_tmp';
    $app_list_strings['reg_invoices_issuer_dom_tmp'] = regInvoicesGetCompaniesDropdown();
    
    $config = parent::displayOptions();
    unset($app_list_strings['reg_invoices_issuer_dom_tmp']);
    return $config;    
  }

  public function display()
  {
    $currency_symbol = $GLOBALS['sugar_config']['default_currency_symbol'];
    if ($GLOBALS['current_user']->getPreference('currency')){
      require_once('modules/Currencies/Currency.php');
      $currency = new Currency();
      $currency->retrieve($GLOBALS['current_user']->getPreference('currency'));
      $currency_symbol = $currency->symbol;
    }
    
    $this->chartDefName = $this->which_chart[0];
    
    $chartDef = array(
        'type' => 'code',
        'id' => 'Chart_invoices_by_month',
        'label' => 'Invoices by Month',
        'chartUnits' => 'Invoice Size in $1K',
        'chartType' => 'stacked group by chart',
        'groupBy' => array( 'm', 'state_in_chart', ),
        'base_url'=> array(
            'module' => 'reg_invoices',
            'action' => 'index',
            'query' => 'true',
            'searchFormTab' => 'advanced_search',
        ),
        'url_params' => array( 'state', 'date_closed' ),
    );

    require_once('include/SugarCharts/SugarChartFactory.php');
    
    // Special chart config for RegInvoices
    $sugarChart = SugarChartFactory::getInstance('Jit','RegInvoices');

    $sugarChart->setProperties('', translate('LBL_FACT_SIZE', 'reg_invoices') . ' ' . $currency_symbol . '1' .translate('LBL_OPP_THOUSANDS', 'Charts'), $chartDef['chartType']);


    $sugarChart->base_url = $chartDef['base_url'];
    $sugarChart->is_currency = true;
    $sugarChart->group_by = $chartDef['groupBy'];
    $sugarChart->url_params = array();

    $sugarChart->getData($this->constructQuery());
    $this->sortData( $sugarChart->data_set );

    $xmlFile = $sugarChart->getXMLFileName($this->id);
    $sugarChart->saveXMLFile($xmlFile, $sugarChart->generateXML());

    return $this->getTitle('<div align="center"></div>') .
    '<div align="center">' . $sugarChart->display($this->id, $xmlFile, '100%', '480', false) . '</div><br />';
  }

  /**
   * @see DashletGenericChart::constructQuery()
   */
  protected function constructQuery()
  {
 
    $amountColumnName = ( $this->with_taxes == 1 )? 'amount' : 'total_base' ;
    $issuerCondition = $this->getIssuerCondition();
    
    $query =  'SELECT '.
        '  reg_invoices.state AS state_in_chart,'.
        '  DATE_FORMAT(reg_invoices.date_closed,"%Y-%m") AS m, '.
        '  sum('.$amountColumnName.'/1000) AS total, '.
        '  count(*) AS fact_count '.
        'FROM reg_invoices '.
        'WHERE reg_invoices.date_closed >= DATE_FORMAT("'.$this->fcd_date_start.'", "%Y-%m-%d %H:%i:%s") '.
        '  AND reg_invoices.date_closed <= DATE_FORMAT("'.$this->fcd_date_end.'", "%Y-%m-%d %H:%i:%s") '.
        '  AND reg_invoices.deleted=0 AND reg_invoices_type=\'invoice\' '.
        $issuerCondition.
        'GROUP BY state, DATE_FORMAT(reg_invoices.date_closed,"%Y-%m") ORDER BY m';
        
    $GLOBALS['log']->fatal( print_r($query, true) );
    return ($query);
  }
  
  private function getIssuerCondition(){
    if( is_array( $this->issuer_id ) && count($this->issuer_id) > 0 ){
      
      $list = array();
      foreach( $this->issuer_id as $id ){
        $list[] = "'$id'";
      }
      
      return 'AND issuer_id IN (' . implode(',',$list) . ') ';
      
    }else{
      return '';
    }
  }

  /**
   * Sorts data to force statuses always the same color.
   */
  protected function sortData( & $dataset ){
    global $app_list_strings;
    
    $dataByMonth = array();
    foreach($dataset as $field){
      $dataByMonth[$field['m']][]=$field;
    }
    
    //  Fill empty data on first month. This ensures color association.
    $dataset=array();
    $firstItem=true;
    foreach($dataByMonth as $i=>$month){
    
      // Tratamiento del primer elemento
      if($firstItem){
        $count=0;
        $nuevo=array();
        $states=array('invoice_emitted','invoice_paid','invoice_in_process' );
    
        foreach($states as $e){
          if($month[$count]['state_in_chart']==$e){
            $nuevo[]=$month[$count];
            $count++;
          }else{
            if($e!='elaborando' && $e!='esperando')
              $nuevo[]=array('state_in_chart'=>$e,'m'=>$i,'total'=>0);
          }
        }
        $dataByMonth[$i]=$nuevo;
        $firstItem = false;
      }
    
      // Fill original dataset
      foreach($dataByMonth[$i] as $m) $dataset[]=$m;
    
    }
    
    // Tranlate .
    foreach($dataset as $i=>$d){
      $dataset[$i]['state_in_chart'] = $app_list_strings['reg_invoice_state_dom'][$d['state_in_chart']];
    }

  }

}

?>
