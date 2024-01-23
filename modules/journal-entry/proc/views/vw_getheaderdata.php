<?php
session_start();
include_once('../../../../config/config.php');

$docNum = $_GET['docNum'];
$objType = $_GET['objType'];

$table = '';
if($objType == 30){
	$table = 'OJDT';
}


$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
			SELECT DISTINCT
				T0.Number,
				T0.TransId,
				T0.RefDate,
				T0.DueDate,
				T0.TaxDate,
				T0.Memo,
				T0.Ref1,
				T0.Ref2,
				T0.Ref3,
				T0.Series,
				T0.BaseRef,
				T0.TransType,
				CASE
				WHEN T0.TransType = 30 THEN 'JE'
				WHEN T0.TransType = 14 THEN 'CN'
				WHEN T0.TransType = 15 THEN 'DN'
				WHEN T0.TransType = 24 THEN 'RC'
				WHEN T0.TransType = 24 THEN 'RC'
				WHEN T0.TransType = 59 THEN 'SI'
				WHEN T0.TransType = 13 THEN 'IN'
				WHEN T0.TransType = 19 THEN 'PC'
				WHEN T0.TransType = 18 THEN 'PU'
				END AS 'Origin',
				T0.ObjType,
				T0.LocTotal


			FROM " . $table . " T0
		
			WHERE T0.Number = $docNum
		
		
		
			ORDER BY T0.Number");

$arr = array();

while (odbc_fetch_row($qry)) 
{
	$arr[] = array(
				"Number" => odbc_result($qry, 'Number'),
				"TransId" => odbc_result($qry, 'TransId'),
				"Series" => odbc_result($qry, 'Series'),
				"Memo" => odbc_result($qry, 'Memo'),
				"Ref1" => odbc_result($qry, 'Ref1'),
				"Ref2" => odbc_result($qry, 'Ref2'),
				"Ref3" => odbc_result($qry, 'Ref3'),
				"Origin" => odbc_result($qry, 'Origin'),
				"BaseRef" => odbc_result($qry, 'BaseRef'),
				
				
				"RefDate" => date('Y-m-d' ,strtotime(odbc_result($qry, 'RefDate'))),
				"DueDate" => date('Y-m-d' ,strtotime(odbc_result($qry, 'DueDate'))),
				"TaxDate" => date('Y-m-d' ,strtotime(odbc_result($qry, 'TaxDate'))),
				"LocTotal" => number_format(odbc_result($qry, "LocTotal"),2),
				
				
				
			
				);
            
}
odbc_free_result($qry);
odbc_close($MSSQL_CONN);



echo json_encode($arr);

?>