<?php

$vCmp=new COM("SAPbobsCOM.company") or die ("No connection");
	
$DbServerType = 8;
$server = 'BENNIE';
$UseTrusted = false;
$DBusername = 'sa';
$DBpassword = 'P@ssw0rd1';
$CompanyDB = $_SESSION['MSSQL_DB'];
$username = 'manager';
$password = 'P@ssw0rd1';
$LicenseServer = "BENNIE:30000";

?>

