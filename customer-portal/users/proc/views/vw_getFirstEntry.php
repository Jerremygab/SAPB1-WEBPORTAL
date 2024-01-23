<?php
session_start();
include('../../../../config/config.php');


	$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
		SELECT 
		MIN(T0.UserId) AS 'FirstEntry'
	
		FROM [".$MSSQL_DB2."].[dbo].[@OUSR] T0");
		
	while (odbc_fetch_row($qry)) 
		{
			echo odbc_result($qry, "FirstEntry");
			
		}
		odbc_free_result($qry);
?>
