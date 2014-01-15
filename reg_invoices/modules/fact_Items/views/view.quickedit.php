<?php

require_once('include/MVC/View/views/view.edit.php');

class fact_ItemsViewQuickEdit extends ViewEdit{

  var $useForSubpanel = true;  //boolean variable to determine whether view can be used for subpanel creates
  var $useModuleQuickCreateTemplate = true; //boolean variable to determine whether or not SubpanelQuickCreate has a separate display function
  var $showTitle=false;
  
}