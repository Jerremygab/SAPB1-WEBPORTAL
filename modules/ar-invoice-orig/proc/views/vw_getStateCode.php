<?php
session_start();
include('../../../../config/config.php');

$stateName = $_GET['stateName'];

	$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
		SELECT
			Code
		FROM OCST
		WHERE Name = '$stateName'
	
	");

	while (odbc_fetch_row($qry)) 
	{
		echo odbc_result($qry, 'Code');	  
	}
	
	odbc_free_result($qry);
	
?>