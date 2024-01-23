<?php
session_start();
include('../../../../config/config.php');

$table = $_GET['table'];
$docNum = $_GET['docNum'];
	$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
		SELECT 
		MIN(T0.Number) AS 'PrevEntry'
	
		FROM ". $table ." T0
		
		WHERE T0.Number = $docNum - 1 ");
		
	while (odbc_fetch_row($qry)) 
		{
			echo odbc_result($qry, "PrevEntry");
			
		}
		odbc_free_result($qry);
?>
