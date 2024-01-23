<?php
session_start();
include('../../../../config/config.php');

$table = $_GET['table'];
	$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
		SELECT 
		MAX(T0.Number) AS 'LastEntry'
	
		FROM ". $table ." T0");
		
	while (odbc_fetch_row($qry)) 
		{
			echo odbc_result($qry, "LastEntry");
			
		}
		odbc_free_result($qry);
?>
