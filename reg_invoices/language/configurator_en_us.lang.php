<?php

$mod_strings['LBL_FACT_CONF_TITLE'] = 'Invoice Configuration';

//Form panel titles
$mod_strings['LBL_FACT_SELLER_INFO_TITLE'] = 'Seller info';
$mod_strings['LBL_FACT_PERSON_TYPE'] = 'Person type';
$mod_strings['LBL_FACT_PERSON_TYPE_DESC'] = 'Individual or Legal Entity <strong>(Facturae - Spain only)</strong>.';
$mod_strings['LBL_FACT_NAME'] = 'Name';
$mod_strings['LBL_FACT_NAME_DESC'] = 'Corporate Name (Legal Entity) or Name (Individual)';
$mod_strings['LBL_FACT_TRADE_SURNAME'] = 'Trade name / Surname 1';
$mod_strings['LBL_FACT_TRADE_SURNAME_DESC'] = 'Trade name (Legal Entity) or Surname 1 (Individual) <strong>(Facturae - Spain only)</strong>.';
$mod_strings['LBL_FACT_REGISTRATION_SURNAME'] = 'Registration Data / Surname 2';
$mod_strings['LBL_FACT_REGISTRATION_SURNAME_DESC'] = 'Data as shown in the file at the Register of Companies: Register, File, Book, Folio… (Legal Entity) or Surname 2 (individual) <strong>(Facturae - Spain only)</strong>.';
$mod_strings['LBL_FACT_TAX_NUMBER'] = 'Tax identification number';
$mod_strings['LBL_FACT_TAX_NUMBER_DESC'] = 'Issuer’s Tax Identification Number.';
$mod_strings['LBL_FACT_RESIDENCE_TYPE_CODE'] = 'Residence type';
$mod_strings['LBL_FACT_RESIDENCE_TYPE_INFO'] = 'It identifies whether the person is resident or non-resident <strong>(Facturae - Spain only)</strong>.';
$mod_strings['LBL_FACT_ADRESS'] = 'Adress';
$mod_strings['LBL_FACT_ADRESS_DESC'] = 'Street name, number, flat...';
$mod_strings['LBL_FACT_CP'] = 'Postal Code';
$mod_strings['LBL_FACT_CP_DESC'] = 'Postcode allocated by the Post Office.';
$mod_strings['LBL_FACT_TOWN'] = 'Town';
$mod_strings['LBL_FACT_TOWN_DESC'] = 'Town corresponding to the postcode.';
$mod_strings['LBL_FACT_PROVINCE'] = 'Province';
$mod_strings['LBL_FACT_PROVINCE_DESC'] = 'Province where the town is located.';
$mod_strings['LBL_COUNTRY_CODE'] = 'Pais';
$mod_strings['LBL_COUNTRY_CODE_DESC'] = 'ISO 3166-1:2006 Alpha-3 code. Since the address is located in Spain, it will always be “ESP” <strong>(Facturae - Spain only)</strong>.';

$mod_strings['LBL_INVOICE_OPTIONS'] = 'Invoice Options';
$mod_strings['LBL_ACCOUNT_NIF_FIELD'] = 'Tax identification number field in Accounts';
$mod_strings['LBL_ACCOUNT_NIF_FIELD_DESC'] = 'Select one field from Accounts to be treated as Tax Number';
$mod_strings['LBL_RESTART_NUMBERS'] = 'Yearly numbering';
$mod_strings['LBL_RESTART_NUMBERS_DESC'] = 'Reset invoice numbering each year.';

$mod_strings['LBL_PATH_TO_LOGO'] = 'Path to logo';
$mod_strings['LBL_PATH_TO_LOGO_DESC'] = 'Where is logo image for PDFs<br>(By default "themes/Sugar/images/company_logo.png")';

$mod_strings['LBL_GENERAL_CONDITIONS'] = 'General Conditions';
$mod_strings['LBL_GENERAL_CONDITIONS_DESC'] = 'General conditions default value for all invoices.';

// Residence Type Options (Don't translate the key)
$mod_strings['residence_type_options'] = array(
  'R' => 'Resident (in Spain)',
  'U' => 'European Union resident (except Spain)',
  'E' => 'Foreigner (outside the European Union)'
);

// Person type options (Don't translate the key)
$mod_strings['person_type_code_options'] = array(
  'F' => 'Individual',
  'J' => 'Legal Entity'
);

$mod_strings['LBL_DEFAULT_TAX_TYPE'] = 'Default tax type';
$mod_strings['LBL_DEFAULT_TAX'] = 'Default tax';
$mod_strings['LBL_DEFAULT_RETENTION'] = 'Default retention';
