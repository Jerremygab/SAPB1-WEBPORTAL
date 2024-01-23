<?php
session_start();
include('../../../../config/config.php');

$CountryCode = $_GET['CountryCode'];

	$itemno = 1;
	$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
		SELECT
			T0.Code,
			T0.Name
		FROM OCST T0
			INNER JOIN OCRY T1 ON T1.Code = T0.Country
		WHERE T1.Code = '$CountryCode'
	
	");

	while (odbc_fetch_row($qry)) 
	{
		echo '<tr class="">
					<td>'.$itemno.'</td>
					<td class="item-1">'.odbc_result($qry, 'Code').'</td>
					<td class="item-2">'.odbc_result($qry, 'Name').'</td>
				  </tr>';
		$itemno++;	  
	}
	
	odbc_free_result($qry);
	
?>