<?php
session_start();
include('../../../../../config/config.php');

$table = $_GET['mainTable'];

$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
		SELECT 
			T0.Descr
		FROM CUFD T0
		WHERE T0.TableID = '".$table."'
				
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