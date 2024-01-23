<?php
session_start();
include('../../../../config/config.php');


	$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB2."];
		SELECT 
		MAX(T0.DocEntry) AS 'LastEntry'
	
		FROM [@OAPT] T0");
		
	while (odbc_fetch_row($qry)) 
		{
			echo odbc_result($qry, "LastEntry");
			
		}
		odbc_free_result($qry);
?>
