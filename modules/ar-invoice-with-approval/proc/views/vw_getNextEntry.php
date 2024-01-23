<?php
session_start();
include('../../../../config/config.php');
if ($postedorDraft == 'POSTED'){
	$table = 'OINV';
	$table2 = 'INV1';
	$objType = 13;
	$docentryString = ' T0.DocNum ';
}
else if ($postedorDraft == 'N/A'){
	$table = 'ORDR';
	$objType = 17;
	$docentryString = ' T0.DocEntry ';
}
else{
	$table = 'ODRF';
	$table2 = 'DRF1';
	$objType = 13;
	$docentryString = ' T0.DocEntry ';
}

$table = $_GET['table'];
$docNum = $_GET['docNum'];
	$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
		SELECT 
		MIN(T0.DocNum) AS 'PrevEntry'
	
		FROM ". $table ." T0
		
		WHERE T0.DocNum = $docNum + 1 ");
		
	while (odbc_fetch_row($qry)) 
		{
			echo odbc_result($qry, "PrevEntry");
			
		}
		odbc_free_result($qry);
?>
