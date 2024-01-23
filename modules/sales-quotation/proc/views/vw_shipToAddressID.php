<?php
session_start();
include('../../../../config/config.php');

$cardCode = $_GET['cardCode'];
	$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
		SELECT 
		T0.Address
	
		FROM CRD1 T0
		
		WHERE T0.CardCode = '$cardCode' AND T0.AdresType = 'S'");
		
	while (odbc_fetch_row($qry)) 
		{
			echo '<option class="dropdown-item addressIDOption" value="' . odbc_result($qry, "Address") . '">' . odbc_result($qry, "Address") . '</option>';
			
		}
		odbc_free_result($qry);
?>
