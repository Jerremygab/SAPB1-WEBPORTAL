<?php
session_start();
include_once('../../../../config/config.php');

$docNum = $_GET['docNum'];
$objType = $_GET['objType'];

$table = '';
if($objType == 20 ){
	$table = 'OPDN';
}
else if($objType == 15){
	$table = 'ODLN';
}
else{
	$table = '';
}

$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
			SELECT DISTINCT
				T0.DocNum,
				T0.DocEntry,
				T0.DocStatus,
				T0.Series,
				T0.DocCur,
				T0.DocType,
				
				CASE 
					WHEN T0.DocStatus = 'O' THEN 'Open' 
					WHEN T0.DocStatus = 'C' AND T0.Canceled = 'C' THEN 'Canceled' 
					WHEN T0.DocStatus = 'C' AND T0.Canceled = 'N' THEN 'Closed' 
				END AS 'DocStatusFullText',
				T0.CardCode,
				T0.CardName,
				T0.DocDate,
				T0.DocDueDate,
				T0.TaxDate,
				T0.ReqDate,
				T0.CancelDate,
				T0.LicTradNum,

				CASE WHEN T0.DocCur <> 'PHP' THEN T0.VatSumFC ELSE T0.VatSum END AS 'VatSum',
				CASE WHEN T0.DocCur <> 'PHP' THEN T0.DiscSumFC ELSE T0.DiscSum END AS 'DiscSum',
				CASE WHEN T0.DocCur <> 'PHP' THEN T0.DocTotalFC ELSE T0.DocTotal END AS 'DocTotal',
				CASE WHEN T0.DocCur <> 'PHP' THEN (T0.DocTotalFC + T0.DiscSumFC) - T0.VatSumFC ELSE (T0.DocTotal + T0.DiscSum) - T0.VatSum END AS 'TotalBeforeDisc',
				
				T0.DiscPrcnt,
				T0.NumAtCard,
				T0.Comments,

				T0.ShipToCode,
				T0.PayToCode,
				T0.TrnspCode,
				T0.JrnlMemo,
				T0.GroupNum,
				
			

				T1.SeriesName,
				T2.CntctCode,
				T2.Name AS 'ContactPerson',
				T3.SlpCode,
				T3.SlpName,
				T4.EmpID,
				T4.LastName + ', ' + T4.FirstName AS 'EmployeeName',

			

				T10.PymntGroup,

				T11.Series,
				T11.Number,
				T11.RefDate,
				T11.DueDate,
				T11.TaxDate,
				T11.Memo,

				T11.BaseRef,
				T11.TransId,
				T11.Ref1,
				T11.Ref2,
				T11.Ref3

				
			

				FROM " . $table . " T0
				INNER JOIN NNM1 T1 ON T0.Series= T1.Series
				LEFT JOIN OCPR T2 ON T0.CntctCode = T2.CntctCode
				LEFT JOIN OSLP T3 ON T0.SlpCode = T3.SlpCode
				LEFT JOIN OHEM T4 ON T0.OwnerCode = T4.empID
				LEFT JOIN OCRD T5 ON T5.CardCode = T0.CardCode
				LEFT JOIN OCTG T10 ON T0.GroupNum = T10.GroupNum
				LEFT JOIN OJDT T11 ON T11.TransId = T0.TransId
																	
			WHERE T0.DocNum = $docNum
		
		
		
			ORDER BY T0.DocNum");

$arr = array();

while (odbc_fetch_row($qry)) 
{
	$arr[] = array(
				"DocNum" => odbc_result($qry, 'DocNum'),
				"DocStatus" => odbc_result($qry, 'DocStatus'),
				"DocStatusFullText" => odbc_result($qry, 'DocStatusFullText'),
				"Series" => odbc_result($qry, 'Series'),
				"DocCur" => odbc_result($qry, 'DocCur'),
				"DocType" => odbc_result($qry, 'DocType'),
				"Ref1" => odbc_result($qry, 'Ref1'),
				"Ref2" => odbc_result($qry, 'Ref2'),
				"Ref3" => odbc_result($qry, 'Ref3'),
				
				"Series" => odbc_result($qry, 'Series'),
				"Number" => odbc_result($qry, 'Number'),
				"Memo" => odbc_result($qry, 'Memo'),
				"BaseRef" => odbc_result($qry, 'BaseRef'),
				"TransId" => odbc_result($qry, 'TransId'),
				"RefDate" => date('Y-m-d' ,strtotime(odbc_result($qry, 'RefDate'))),
				"DueDate" => date('Y-m-d' ,strtotime(odbc_result($qry, 'DueDate'))),
				"TaxDate" => date('Y-m-d' ,strtotime(odbc_result($qry, 'TaxDate'))),
				
			
			
				
			
				);
            
}
odbc_free_result($qry);
odbc_close($MSSQL_CONN);



echo json_encode($arr);

?>