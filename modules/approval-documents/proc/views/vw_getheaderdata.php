<?php
session_start();
include_once('../../../../config/config.php');

$code = $_GET['code'];


$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB2."];
			SELECT DISTINCT
				T0.Code,
				T0.Description,
				CAST(T0.Modules AS VARCHAR) AS Modules,
				T0.Inactive,
				T0.DocEntry
			FROM [@OAPR] T0													
			WHERE T0.Code = '$code'
		
			");

$arr = array();

while (odbc_fetch_row($qry)) 
{
	$arr[] = array(
				"Code" => odbc_result($qry, 'Code'),
				"Description" => odbc_result($qry, 'Description'),
				"Modules" => odbc_result($qry, 'Modules'),
				"Active" => odbc_result($qry, 'Inactive'),
				"DocEntry" => odbc_result($qry, 'DocEntry'),
				
			
				
			
				);
            
}
odbc_free_result($qry);
odbc_close($MSSQL_CONN);



echo json_encode($arr);

?>