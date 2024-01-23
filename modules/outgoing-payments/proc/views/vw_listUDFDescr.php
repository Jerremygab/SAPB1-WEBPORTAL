<?php
session_start();
include_once('../../../../config/config.php');


$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
		SELECT 
			T0.Descr
		FROM CUFD T0
		WHERE T0.TableID = 'ORDR'
				
			");

$arr = array();

while (odbc_fetch_row($qry)) 
{
	$arr[] = array(
				"Descr" => odbc_result($qry, 'Descr')
				);
            
}
odbc_free_result($qry);
odbc_close($MSSQL_CONN);



echo json_encode($arr);

?>