<?php
session_start();
include('../../../../../config/config.php');

$cardCode = $_GET['cardCode'];
$options = '';
$tagged = '';
	$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
		SELECT DISTINCT
		T0.TrnspCode,
		T0.TrnspName

		FROM OSHP T0
		LEFT JOIN OCRD T1 ON T1.ShipType = T0.TrnspCode
		WHERE T1.CardCode = '$cardCode'");
		
	while (odbc_fetch_row($qry)) 
		{
			$tagged = odbc_result($qry, "TrnspCode");
			$options = '<option class="dropdown-item" value="' . odbc_result($qry, "TrnspCode") . '">' . odbc_result($qry, "TrnspName") . '</option>';
			
		}	
		$qry2 = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
		SELECT DISTINCT
		T0.TrnspCode,
		T0.TrnspName

		FROM OSHP T0
		WHERE T0.TrnspCode != '$tagged'
		");
		
	while (odbc_fetch_row($qry2)) 
		{
			$options .= '<option class="dropdown-item" value="' . odbc_result($qry2, "TrnspCode") . '">' . odbc_result($qry2, "TrnspName") . '</option>';
			
		}
		
		
		echo $options;
		
		odbc_free_result($qry);
		odbc_free_result($qry2);
?>
