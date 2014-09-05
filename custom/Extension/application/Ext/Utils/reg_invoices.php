<?php

// Helper function to get companies list
function regInvoicesGetCompaniesDropdown(){
  require_once('modules/reg_companies/reg_companies.php');
  return reg_companies::getAvailableCompaniesList();
}
