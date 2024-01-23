<?php
session_start();
include('../../../../config/config.php');

$docnum = $_GET['docnum'];
	$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
		SELECT 
		T0.Series,
		T1.SeriesName
	
		FROM ORDR T0
		INNER JOIN NNM1 T1 ON T1.Series = T0.Series
		WHERE T0.DocNum = $docnum");
		
	while (odbc_fetch_row($qry)) 
		{
			echo '<option class="dropdown-item seriesIDOption" value="' . odbc_result($qry, "Series") . '">' . odbc_result($qry, "SeriesName") . '</option>';
			
		}
		odbc_free_result($qry);
?>
