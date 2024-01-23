<?php
session_start();

$txtUsername =	'admin';
$txtPassword = '1234';


include('../../../../../config/config.php');

$err = 0;
$errmsg = '';

$MSSQL_DB = 'GSDC_TEST_20201228';
$MSSQL_DB2 = 'GSDC-COMMON-2';

	if($err == 0){
	$qryActiveUpdate = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB2."]; UPDATE [dbo].[@OUSR] SET Active = 0 WHERE UserCode='$txtUsername' AND UserPass='$txtPassword' AND Status = 0  ");
	}

session_destroy();

?>

