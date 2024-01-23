<?php
session_start();
include_once('../../../../config/config.php');

$docNum = $_GET['docNum'];

$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB2."];
			SELECT 
				T0.Code,
				T0.Description,
				T0.Active,
				T0.DocEntry
				
			

				FROM [USER-COMMON].[dbo].[@OAPT] T0
				
																	
			WHERE T0.DocEntry = $docNum
		
		
		
			ORDER BY T0.DocEntry");

$arr = array();

while (odbc_fetch_row($qry)) 
{
	$arr[] = array(
				"Code" => odbc_result($qry, 'Code'),
				"Description" => odbc_result($qry, 'Description'),
				"Active" => odbc_result($qry, 'Active'),
				"DocEntry" => odbc_result($qry, 'DocEntry'),

				);
}
odbc_free_result($qry);
odbc_close($MSSQL_CONN);



echo json_encode($arr);

?>