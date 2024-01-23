<?php
session_start();

include('../../../../../config/config.php');

$err = 0;
$errmsg = '';
$txtUsername = $_GET['txtUsername'];
$txtPassword = $_GET['txtPassword'];
$active = '';
$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB2."];
	 SELECT Active FROM [dbo].[@OUSR]  WHERE UserCode='$txtUsername' AND UserPass='$txtPassword' ");
$ctr = 1;

while (odbc_fetch_row($qry)) 
{
	
	$active = odbc_result($qry, "Active");

}

odbc_free_result($qry);
odbc_close($MSSQL_CONN);


echo $active
?>