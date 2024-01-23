<?php

$vCmp=new COM("SAPbobsCOM.company") or die ("No connection");
	
$DbServerType = 8;
$server = 'SUPERSPEED-DEV1';
$UseTrusted = false;
$DBusername = 'sa';
$DBpassword = 'dev1s@p2020';
$CompanyDB = $_SESSION['MSSQL_DB'];
$username = 'manager';
$password = '4321';
$LicenseServer = "SUPERSPEED-DEV1:30000";

?>

