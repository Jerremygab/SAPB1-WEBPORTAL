<?php
session_start();
include('../../../../config/config.php');

$objSession = json_decode($_SESSION['APInvoiceArr']);

if (isset($_POST['docNum'])) {
	$docNum = $_POST['docNum'];
	$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
		SELECT 
			Address2
		FROM $objSession->objectTable
		WHERE DocNum = $docNum
	");
		
	while (odbc_fetch_row($qry)) 
		{
			echo odbc_result($qry, "Address2");
		}
} else {
	$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
		SELECT 
		CompnyAddr
	
		FROM OADM");
		
	while (odbc_fetch_row($qry)) 
		{
			echo odbc_result($qry, "CompnyAddr");
		}
}
	
		odbc_free_result($qry);
?>