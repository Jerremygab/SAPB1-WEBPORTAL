<?php
session_start();
include('../../../../config/config.php');

$series = $_GET['series'];
	$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
		SELECT

		MAX(T0.DocNum) + 1 AS newDocNum

		FROM OINV T0
		INNER JOIN NNM1 T1 ON T0.Series = T1.Series

		WHERE SeriesName = '$series'");
		
	while (odbc_fetch_row($qry)) 
		{
			echo odbc_result($qry, "newDocNum");
			
		}
		odbc_free_result($qry);
?>
