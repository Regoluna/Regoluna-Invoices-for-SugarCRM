<?php

$mod_strings['LBL_FACT_CONF_TITLE'] = 'Configuración de facturas';

//Form panel titles
$mod_strings['LBL_FACT_SELLER_INFO_TITLE'] = 'Información del Facturador.';
$mod_strings['LBL_FACT_PERSON_TYPE'] = 'Tipo de persona';
$mod_strings['LBL_FACT_PERSON_TYPE_DESC'] = 'Tipo de persona. Física o Jurídica <strong>(Facturae)</strong>.';
$mod_strings['LBL_FACT_NAME'] = 'Name';
$mod_strings['LBL_FACT_NAME_DESC'] = 'Razón Social (Persona jurídica) o Nombre (Persona física)';
$mod_strings['LBL_FACT_TRADE_SURNAME'] = 'Nombre comercial / Apellido 1';
$mod_strings['LBL_FACT_TRADE_SURNAME_DESC'] = 'Nombre comercial (Persona jurídica) o Apellido 1 (Persona física) <strong>(Facturae)</strong>.';
$mod_strings['LBL_FACT_REGISTRATION_SURNAME'] = 'Datos registrales / Apellido 2';
$mod_strings['LBL_FACT_REGISTRATION_SURNAME_DESC'] = 'Datos Registrales: Inscripción Registro, Tomo, Folio,… (Persona jurídica) o Apellido 2 (Persona física) <strong>(Facturae)</strong>.';
$mod_strings['LBL_FACT_TAX_NUMBER'] = 'NIF/CIF';
$mod_strings['LBL_FACT_TAX_NUMBER_DESC'] = 'NIF/CIF o identificador fiscal del Facturador.';
$mod_strings['LBL_FACT_RESIDENCE_TYPE_CODE'] = 'Residencia';
$mod_strings['LBL_FACT_RESIDENCE_TYPE_INFO'] = 'Identificación del tipo de residencia y/o extranjería <strong>(Facturae)</strong>.';
$mod_strings['LBL_FACT_ADRESS'] = 'Dirección';
$mod_strings['LBL_FACT_ADRESS_DESC'] = 'Dirección. Tipo de vía, nombre, número, piso…';
$mod_strings['LBL_FACT_CP'] = 'Código postal';
$mod_strings['LBL_FACT_CP_DESC'] = 'Código Postal asignado por Correos.';
$mod_strings['LBL_FACT_TOWN'] = 'Población';
$mod_strings['LBL_FACT_TOWN_DESC'] = 'Población. Correspondiente al C.P.';
$mod_strings['LBL_FACT_PROVINCE'] = 'Provincia';
$mod_strings['LBL_FACT_PROVINCE_DESC'] = 'Provincia. Donde está situada la Población.';
$mod_strings['LBL_COUNTRY_CODE'] = 'Pais';
$mod_strings['LBL_COUNTRY_CODE_DESC'] = 'Código País. Código según la ISO 3166-1:2006 Alpha-3. Como se trata de facturas españolas debería ser siempre "ESP" <strong>(Facturae)</strong> ';

$mod_strings['LBL_INVOICE_OPTIONS'] = 'Opciones de factura';
$mod_strings['LBL_ACCOUNT_NIF_FIELD'] = 'Campo NIF/CIF en cuentas';
$mod_strings['LBL_ACCOUNT_NIF_FIELD_DESC'] = 'Indica que campo de cuentas guarda el identificador fiscal del cliente';
$mod_strings['LBL_RESTART_NUMBERS'] = 'Numeración anual';
$mod_strings['LBL_RESTART_NUMBERS_DESC'] = 'Indica si debe reiniciarse el contador de número de factura cada año';

$mod_strings['LBL_PATH_TO_LOGO'] = 'Ruta al logo';
$mod_strings['LBL_PATH_TO_LOGO_DESC'] = 'Ruta donde se guarda la imagen que se usará como logo en las facturas PDF.<br>(Por defecto "themes/Sugar/images/company_logo.png")';

$mod_strings['LBL_GENERAL_CONDITIONS'] = 'Condiciones generales';
$mod_strings['LBL_GENERAL_CONDITIONS_DESC'] = 'Permite indicar unas condiciones generales para todas las facturas';

// Residence Type Options (Don't translate the key)
$mod_strings['residence_type_options'] = array(
  'R' => 'Residente en España',
  'U' => 'Residente en la unión Europea',
  'E' => 'Extranjero'
);

// Person type options (Don't translate the key)
$mod_strings['person_type_code_options'] = array(
  'F' => 'Física',
  'J' => 'Jurídica'
);

$mod_strings['LBL_DEFAULT_TAX_TYPE'] = 'Tipo de impuesto por defecto';
$mod_strings['LBL_DEFAULT_TAX'] = 'Porcentaje de impuesto por defecto';
$mod_strings['LBL_DEFAULT_RETENTION'] = 'Porcentaje de retención por defecto';
