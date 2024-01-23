<?php
session_start();
include('../../../../config/config.php');

$table = $_GET['table'];
	$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
		SELECT 
		MIN(T0.Number) AS 'FirstEntry'
	
		FROM ". $table ." T0");
		
	while (odbc_fetch_row($qry)) 
		{
			echo odbc_result($qry, "FirstEntry");
			
		}
		odbc_free_result($qry);
?>
