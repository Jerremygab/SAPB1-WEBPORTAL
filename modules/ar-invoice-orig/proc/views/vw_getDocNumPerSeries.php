<?php
session_start();
include('../../../../config/config.php');

$series = $_GET['series'];
	$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
	SELECT 
	T1.Series,
	T1.NextNumber AS newDocNum
	FROM NNM1 T1

	WHERE SeriesName = '$series' AND ObjectCode = 13
	");
		
	while (odbc_fetch_row($qry)) 
		{
			$arr[] = array(
				"Series" => odbc_result($qry, 'Series'),	
				"newDocNum" => odbc_result($qry, 'newDocNum'),
			);
			
		}
		odbc_free_result($qry);
		echo json_encode($arr);
?>
