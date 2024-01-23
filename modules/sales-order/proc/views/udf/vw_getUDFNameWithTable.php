<?php
session_start();
include('../../../../../config/config.php');

$value = $_GET['value'];
$table = $_GET['table'];

$table2 = '[@' . $table .']';

$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
			SELECT Name
			FROM ".$table2."
			WHERE Code = '$value'
				
			");


while (odbc_fetch_row($qry)) 
{
	echo odbc_result($qry, 'Name');
				
            
}
odbc_free_result($qry);
odbc_close($MSSQL_CONN);



?>