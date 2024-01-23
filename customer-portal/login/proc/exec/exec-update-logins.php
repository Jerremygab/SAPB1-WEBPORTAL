<?php
session_start();
$err = 0;
$errmsg = '';

$txtUsername =	$_SESSION['SESS_USERCODE'];
$UserPass = $_SESSION['SESS_USERPASS'];

	if($err == 0){
	$qryActiveUpdate = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB2."]; UPDATE [dbo].[@OUSR] SET Active = 1 WHERE UserCode='$txtUsername' AND UserPass='$txtPassword' AND Status = 0  ");
	}


?>