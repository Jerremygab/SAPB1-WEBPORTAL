<?php
session_start();
include_once('../../../../config/config.php');


$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
			SELECT Column_Name
			FROM INFORMATION_SCHEMA.COLUMNS
			WHERE TABLE_NAME = 'ORDR' AND LEFT(Column_Name,2) = 'U_'
				
			");

$arr = array();

while (odbc_fetch_row($qry)) 
{
	$arr[] = array(
				"Column_Name" => odbc_result($qry, 'Column_Name')
				);
            
}
odbc_free_result($qry);
odbc_close($MSSQL_CONN);



echo json_encode($arr);

?>