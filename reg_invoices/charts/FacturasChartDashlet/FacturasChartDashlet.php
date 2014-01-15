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

class FacturasChartDashlet extends DashletGenericChart
{
  public $fcd_ids = array();
  public $fcd_date_start;
  public $fcd_date_end;
  var $chartDefs;
  var $chartDefName;

  protected $_seedName = 'fact_Facturas';

  public function __construct($id, array $options = null)
  {
    global $timedate;

    if(empty($options['fcd_date_start']))
      $options['fcd_date_start'] = date($timedate->get_db_date_time_format(), time());

    if(empty($options['fcd_date_end']))
      $options['fcd_date_end'] = date($timedate->get_db_date_time_format(), time()+86400*365);

    parent::__construct($id,$options);
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
    //$chartDef = $this->chartDefs[$this->chartDefName];
    $chartDef = array(
        'type' => 'code',
        'id' => 'Chart_invoices_by_month',
        'label' => 'Invoices by Month',
        'chartUnits' => 'Invoice Size in $1K',
        'chartType' => 'stacked group by chart',
        'groupBy' => array( 'm', 'estado_advanced', ),
        'base_url'=> array( 'module' => 'fact_Facturas',
            'action' => 'index',
            'query' => 'true',
            'searchFormTab' => 'advanced_search',
        ),
        'url_params' => array( 'estado', 'date_closed' ),
    );

    require_once('include/SugarCharts/SugarChartFactory.php');
    $sugarChart = SugarChartFactory::getInstance('Jit','RegInvoices');
//     $sugarChart = SugarChartFactory::getInstance();
    $sugarChart->setProperties('', translate('LBL_FACT_SIZE', 'fact_Facturas') . ' ' . $currency_symbol . '1' .translate('LBL_OPP_THOUSANDS', 'Charts'), $chartDef['chartType']);
    
//     $sugarChart->setColors(array('#FF0000', '#FF6600', '#00AA00', '#FFFFFF'));
    
//     $GLOBALS['log']->fatal( 'Volcando clase: ' . get_class($sugarChart) );
//     $GLOBALS['log']->fatal( print_r($sugarChart->colors_list, true) );
//     $GLOBALS['log']->fatal( print_r($sugarChart, true) );
    
    ///@todo El método setColors parece que ya no funciona

    $sugarChart->base_url = $chartDef['base_url'];
    $sugarChart->is_currency = true;
    $sugarChart->group_by = $chartDef['groupBy'];
    $sugarChart->url_params = array();

    $sugarChart->getData($this->constructQuery());
    $this->sortData( $sugarChart->data_set );

    $xmlFile = $sugarChart->getXMLFileName($this->id);
    $sugarChart->saveXMLFile($xmlFile, $sugarChart->generateXML());

//     $GLOBALS['log']->fatal( 'Volcando clase: ' . get_class($sugarChart) );
//     $GLOBALS['log']->fatal( print_r($sugarChart->colors_list, true) );
//     $GLOBALS['log']->fatal( print_r($sugarChart, true) );
    
    return $this->getTitle('<div align="center"></div>') .
    '<div align="center">' . $sugarChart->display($this->id, $xmlFile, '100%', '480', false) . '</div><br />';
  }

  /**
   * @see DashletGenericChart::constructQuery()
   */
  protected function constructQuery()
  {

    $query =  'SELECT '.
        '  estado estado_advanced,'.
        '  DATE_FORMAT(fact_facturas.date_closed,"%Y-%m") as m, '.
        '  sum(amount/1000) as total, '.
        '  count(*) as fact_count '.
        'FROM fact_facturas '.
        'WHERE fact_facturas.date_closed >= DATE_FORMAT("'.$this->fcd_date_start.'", "%Y-%m-%d %H:%i:%s") '.
        '  AND fact_facturas.date_closed <= DATE_FORMAT("'.$this->fcd_date_end.'", "%Y-%m-%d %H:%i:%s") '.
        '  AND fact_facturas.deleted=0 AND fact_facturas_type=\'factura\' '.
        'GROUP BY estado,DATE_FORMAT(fact_facturas.date_closed,"%Y-%m") ORDER BY m';

    return ($query);
  }
  
  /**
   * Sorts data to force statuses hace allways the same color.
   */
  protected function sortData( & $dataset ){
    
//     $GLOBALS['log']->fatal( print_r($dataset, true) );
    
    
  }

}

?>
