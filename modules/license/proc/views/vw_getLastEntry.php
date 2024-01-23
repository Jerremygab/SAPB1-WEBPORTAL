<?php
session_start();
include('../../../../config/config.php');


	$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
		SELECT 
		MAX(T0.UserId) AS 'LastEntry'
	
		FROM [".$MSSQL_DB2."].[dbo].[@OUSR] T0");
		
	while (odbc_fetch_row($qry)) 
		{
			echo odbc_result($qry, "LastEntry");
			
		}
		odbc_free_result($qry);
?>
