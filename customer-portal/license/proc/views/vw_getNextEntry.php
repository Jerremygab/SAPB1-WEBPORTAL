<?php
session_start();
include('../../../../config/config.php');

$docNum = $_GET['docNum'];
	$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
		SELECT 
		MIN(T0.UserId) AS 'PrevEntry'
	
		FROM [".$MSSQL_DB2."].[dbo].[@OUSR] T0
		
		WHERE T0.UserId = $docNum + 1 ");
		
	while (odbc_fetch_row($qry)) 
		{
			echo odbc_result($qry, "PrevEntry");
			
		}
		odbc_free_result($qry);
?>
