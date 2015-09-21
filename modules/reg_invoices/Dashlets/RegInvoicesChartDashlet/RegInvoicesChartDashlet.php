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
	private $chart;

  protected $_seedName = 'reg_invoices';

  public function __construct($id, array $options = null)
  {
    global $timedate;

    // load searchfields
		$classname = get_class($this);
		if ( is_file("modules/reg_invoices/Dashlets/$classname/$classname.data.php") ) {
				require("modules/reg_invoices/Dashlets/$classname/$classname.data.php");
				$this->_searchFields = $dashletData[$classname]['searchFields'];
		}

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
        'groupBy' => array( 'm', 'state_advanced', ),
        'base_url'=> array(
            'module' => 'reg_invoices',
            'action' => 'index',
            'query' => 'true',
            'searchFormTab' => 'advanced_search',
        ),
        // 'url_params' => array( 'state', 'date_closed' ),
    );

    require_once('include/SugarCharts/SugarChartFactory.php');

    // Special chart config for RegInvoices
    $this->chart = SugarChartFactory::getInstance('Jit','RegInvoices');

    $chartTitle = '';
    $chartFooter = translate('LBL_FACT_SIZE', 'reg_invoices') . ' ' . $currency_symbol . '1' .translate('LBL_OPP_THOUSANDS', 'Charts');
    $this->chart->setProperties( $chartTitle, $chartFooter, $chartDef['chartType']);
    $this->chart->base_url = $chartDef['base_url'];
    $this->chart->group_by = $chartDef['groupBy'];
    $this->chart->is_currency = true;
    $this->chart->url_params = array();

    $this->chart->getData($this->constructQuery());

    $this->prepareData( );
    $this->sortData( );

    $xmlFile = $this->chart->getXMLFileName($this->id);
    $this->chart->saveXMLFile($xmlFile, $this->chart->generateXML());

    return
      $this->getTitle('<div align="center"></div>') .
      '<div align="center">' .
      $this->chart->display($this->id, $xmlFile, '100%', '480', false) .
      '</div><br />';
  }

  /**
   * @see DashletGenericChart::constructQuery()
   */
  protected function constructQuery()
  {

    $amountColumnName = ( $this->with_taxes == 1 )? 'amount' : 'total_base' ;
    $issuerCondition = $this->getIssuerCondition();

    $query =  'SELECT '.
        '  reg_invoices.state AS state_advanced,'.
        '  DATE_FORMAT(reg_invoices.date_closed,"%Y-%m") AS m, '.
        '  sum('.$amountColumnName.'/1000) AS total, '.
        '  count(*) AS fact_count '.
        'FROM reg_invoices '.
        'WHERE reg_invoices.date_closed >= DATE_FORMAT("'.$this->fcd_date_start.'", "%Y-%m-%d %H:%i:%s") '.
        '  AND reg_invoices.date_closed <= DATE_FORMAT("'.$this->fcd_date_end.'", "%Y-%m-%d %H:%i:%s") '.
        '  AND reg_invoices.deleted=0 AND reg_invoices_type=\'invoice\' '.
        $issuerCondition.
        'GROUP BY state, DATE_FORMAT(reg_invoices.date_closed,"%Y-%m") ORDER BY m';

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

  private function prepareData(){
		global $app_list_strings;
		$states = $app_list_strings['reg_invoice_state_dom'];
	  $data = &$this->chart->data_set;

		// Translate .
    foreach($data as $i=>$d){
			$data[$i]['state_advanced_dom_option'] = $d['state_advanced'];
      $data[$i]['state_advanced'] = $states[ $d['state_advanced'] ];
    }
	}

  /**
   * Sorts data to force statuses always the same color.
   */
  protected function sortData( ){
    global $app_list_strings;
    $dataset = &$this->chart->data_set;

    $dataByMonth = array();
    $lastMonth = null;

    foreach($dataset as $field){

      $currentMonth = $field['m'];

      // Fill empty months
      if( !empty($lastMonth) && $currentMonth != $lastMonth ){
        list( $lastY, $lastM ) = explode('-', $lastMonth);
        list( $year, $month ) = explode('-', $currentMonth);

        $m=$lastM+1;
        $y=$lastY;
        if( $m>12 ) { $m=1; $y++; }

        while( $m<$month || $y<$year ){
          if( $m>12 ) { $m=1; $y++; }
          if( $y == $year && $m == $month ) break;

          $dataByMonth[ "$y-$m" ][] = array(
            'state_advanced' => 'Sin facturación',
            'm' => "$y-$m",
            'total' => 0,
            'fact_count' => 1,
            'state_advanced_dom_option' => 'Sin facturación',
          );

          $m++;
        }

      }

      $dataByMonth[ $currentMonth ][]=$field;
      $lastMonth = $currentMonth;
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
          if($month[$count]['state_advanced_dom_option']==$e){
            $nuevo[]=$month[$count];
            $count++;
          }else{
            if($e!='invoice_in_process' && $e!='invoice_waiting')
              $nuevo[]=array('state_advanced_dom_option'=>$e,'m'=>$i,'total'=>0);
          }
        }
        $dataByMonth[$i]=$nuevo;
        $firstItem = false;
      }

      // Fill original dataset
      foreach($dataByMonth[$i] as $m) $dataset[]=$m;

    }

  }

}

?>
