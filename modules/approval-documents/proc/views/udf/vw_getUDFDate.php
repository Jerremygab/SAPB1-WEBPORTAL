<?php
session_start();
include('../../../../../config/config.php');

$id2 = $_GET['id2'];
$table = $_GET['mainTable'];
$docNum = $_GET['docNum'];

$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
			SELECT ".$id2."
			FROM ".$table."
			WHERE DocNum = $docNum
				
			");


while (odbc_fetch_row($qry)) 
{
	echo date('Y-m-d' ,strtotime(odbc_result($qry, $id2)));
	
				
            
}
odbc_free_result($qry);
odbc_close($MSSQL_CONN);



?>