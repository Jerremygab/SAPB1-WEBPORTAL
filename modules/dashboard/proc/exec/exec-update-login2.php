<?php
session_start();

include('../../../../config/config.php');

$err = 0;
$errmsg = '';
$txtUsername = $_POST['txtUsername'];
$txtPassword = $_POST['txtPassword'];
$MSSQL_DB = $selCompany;
$MSSQL_DB2 = 'GSDC-COMMON-2';


	if($err == 0){
	$qryActiveUpdate = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB2."]; UPDATE [dbo].[@OUSR] SET Active = 1 WHERE UserCode='$txtUsername' AND UserPass='$txtPassword' AND Status = 0  ");
	}


?>