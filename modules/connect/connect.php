<?php

$vCmp=new COM("SAPbobsCOM.company") or die ("No connection");
	
$DbServerType = 10;
$server = 'SAPSERVER';
$UseTrusted = false;
$DBusername = 'sa';
$DBpassword = 'SAPB1Admin';
$CompanyDB = $_SESSION['MSSQL_DB'];
$username = 'manager';
$password = 'sapb1';
$LicenseServer = "SAPSERVER:30000";

?>

