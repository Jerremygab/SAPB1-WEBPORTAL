<?php
session_start();

$txtUsername =	$_SESSION['SESS_USERCODE'];
$UserPass = $_SESSION['SESS_USERPASS'];

$qryActiveUpdate = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB2."]; UPDATE [dbo].[@OUSR] SET Active = 0 WHERE UserCode='$txtUsername' AND UserPass='$txtPassword' AND Status = 0  ");


session_destroy();

?>

