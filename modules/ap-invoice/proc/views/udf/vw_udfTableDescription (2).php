<?php
session_start();
include('../../../../../config/config.php');

$udfTable = $_GET['udfTable'];


$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT 
														T0.Descr
													
														FROM OUTB T0
														WHERE T0.TableName = '$udfTable'
														
														");

	while (odbc_fetch_row($qry)) 
	{
		echo 'List of '.odbc_result($qry, 'Descr');
		  
	}

odbc_free_result($qry);
odbc_close($MSSQL_CONN);

?>

