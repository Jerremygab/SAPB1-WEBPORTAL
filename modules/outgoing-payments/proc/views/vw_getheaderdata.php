<?php
session_start();
include_once('../../../../config/config.php');

$docNum = $_GET['docNum'];
$objType = $_GET['objType'];

$table = '';
if($objType == 46){
	$table = 'OVPM';
}

else{
	$table = '';
}

$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
		SELECT DISTINCT
				T0.DocNum,
				T0.DocEntry,
				T0.AtcEntry,
				T0.DocDate,
				T0.DocDueDate,
				T0.TaxDate,
				T0.Status,
				T0.Series,
				T0.DocCurr,
				T0.DocType,
				T0.PayNoDoc,
				T0.NoDocSum,
				'' AS Address,
				T0.BPLId,
				T0.BPLName,
				T0.CounterRef,
				T0.DocTotal,

				T0.CashSum,
				T0.CashAcct,
				T10.AcctName AS CashGLName,

				T0.TrsfrSum,
				T0.TrsfrAcct,
				T0.TrsfrDate,
				T0.TrsfrRef,
				T11.AcctName AS TrsfrGLName,

				CASE 
					WHEN T0.Status = 'O' THEN 'Open' 
					WHEN T0.Status = 'C' AND T0.Canceled = 'C' THEN 'Canceled' 
					WHEN T0.Status = 'C' AND T0.Canceled = 'N' THEN 'Closed' 
				END AS 'DocStatusFullText',
				T0.CardCode,
				T0.CardName,
				T0.DocDate,
				T0.DocDueDate,
				T0.TaxDate,
				T0.CancelDate,
				T0.OpenBal,
				CASE WHEN T0.DocCurr <> 'PHP' THEN T0.DocTotalFC ELSE T0.DocTotal END AS 'DocTotal',

				


				T0.Comments,
				T0.JrnlMemo,
				T0.BPAct + ' - ' + T6.AcctName AS 'ControlAccount',
			

				T1.SeriesName,
				T2.CntctCode,
				T2.Name AS 'ContactPerson',


				T4.EmpID,
				T4.LastName + ', ' + T4.FirstName AS 'EmployeeName',


				SUM(T9.VatAmnt) AS VatSum,
				T0.DocTotal - SUM(T9.VatAmnt) AS NetTotal

				
			

				FROM OVPM T0
				LEFT JOIN NNM1 T1 ON T0.Series= T1.Series
				LEFT JOIN OCPR T2 ON T0.CntctCode = T2.CntctCode

				LEFT JOIN OHEM T4 ON T0.OwnerCode = T4.empID
				LEFT JOIN OCRD T5 ON T5.CardCode = T0.CardCode
				LEFT JOIN OACT T6 ON T6.AcctCode = T0.BPAct

				LEFT JOIN OBPL T7 ON T0.BPLId = T7.BPLId

				LEFT JOIN VPM2 T8 ON T8.DocNum = T0.DocEntry
				LEFT JOIN VPM4 T9 ON T9.DocNum = T0.DocEntry

				LEFT JOIN OACT T10 ON T10.AcctCode = T0.CashAcct
				LEFT JOIN OACT T11 ON T10.AcctCode = T0.TrsfrAcct

			WHERE T0.DocEntry = $docNum


			GROUP BY

				T0.DocNum,
				T0.DocEntry,
				T0.AtcEntry,
				T0.DocDate,
				T0.DocDueDate,
				T0.TaxDate,
				T0.Status,
				T0.Series,
				T0.DocCurr,
				T0.DocType,
				T0.PayNoDoc,
				T0.NoDocSum,
				T0.Address,
				T0.BPLId,
				T0.BPLName,
				T0.CounterRef,
				T0.DocTotal,



				T0.CashSum,
				T0.CashAcct,


				TrsfrSum,
				TrsfrAcct,
				TrsfrDate,
				TrsfrRef,



				T0.Canceled,
				T0.CardCode,
				T0.CardName,
				T0.DocDate,
				T0.DocDueDate,
				T0.TaxDate,
				T0.CancelDate,
				T0.DocTotalFC,
				T0.OpenBal,
				


				T0.Comments,
				T0.JrnlMemo,
				T0.BPAct,
				T6.AcctName,
			

				T1.SeriesName,
				T2.CntctCode,
				T2.Name,


				T4.EmpID,
				T4.LastName,
				T4.FirstName,

				
				T10.AcctCode,
				T10.AcctName,
				T11.AcctCode,
				T11.AcctName
		
		
		
			ORDER BY T0.DocNum");

$arr = array();

while (odbc_fetch_row($qry)) 
{
	$arr[] = array(
				"DocNum" => odbc_result($qry, 'DocNum'),
				"DocEntry" => odbc_result($qry, 'DocEntry'),
				"AtcEntry" => odbc_result($qry, 'AtcEntry'),
				"DocStatus" => odbc_result($qry, 'Status'),
				"DocStatusFullText" => odbc_result($qry, 'DocStatusFullText'),
				"Series" => odbc_result($qry, 'Series'),
				"DocCurr" => odbc_result($qry, 'DocCurr'),
				"DocType" => odbc_result($qry, 'DocType'),
				"PayNoDoc" => odbc_result($qry, 'PayNoDoc'),
				"Address" => odbc_result($qry, 'Address'),
				"CounterRef" => odbc_result($qry, 'CounterRef'),
				
				
				"DocDate" => date('Y-m-d' ,strtotime(odbc_result($qry, 'DocDate'))),
				"DocDueDate" => date('Y-m-d' ,strtotime(odbc_result($qry, 'DocDueDate'))),
				"TaxDate" => date('Y-m-d' ,strtotime(odbc_result($qry, 'TaxDate'))),
				"CancelDate" => date('Y-m-d' ,strtotime(odbc_result($qry, 'CancelDate'))),
				
				
				
				"CardCode" => odbc_result($qry, 'CardCode'),
				"CardName" => odbc_result($qry, 'CardName'),
				
				"VatSum" => number_format(odbc_result($qry, 'VatSum'),6),
				"NoDocSum" => number_format(odbc_result($qry, 'NoDocSum'),6),
				"DocTotal" => number_format(odbc_result($qry, 'DocTotal'),6),
				"NetTotal" => number_format(odbc_result($qry, 'NetTotal'),6),
				"OpenBal" => number_format(odbc_result($qry, 'OpenBal'),6),
				
				"CashSum" => number_format(odbc_result($qry, 'CashSum'),6),
				"CashAcct" => odbc_result($qry, 'CashAcct'),
				"CashGLName" => odbc_result($qry, 'CashGLName'),

				"TrsfrSum" => number_format(odbc_result($qry, 'TrsfrSum'),6),
				"TrsfrAcct" => odbc_result($qry, 'TrsfrAcct'),
				"TrsfrGLName" => odbc_result($qry, 'TrsfrGLName'),
				"TrsfrDate" => date('Y-m-d' ,strtotime(odbc_result($qry, 'TrsfrDate'))),
				"TrsfrRef" => odbc_result($qry, 'TrsfrRef'),





				"JrnlMemo" => odbc_result($qry, 'JrnlMemo'),
				"Comments" => odbc_result($qry, 'Comments'),
				"ControlAccount" => odbc_result($qry, 'ControlAccount'),
				
				"SeriesName" => odbc_result($qry, 'SeriesName'),
				"CntctCode" => odbc_result($qry, 'CntctCode'),
				"ContactPerson" => odbc_result($qry, 'ContactPerson'),
			
				
				"EmpID" => odbc_result($qry, 'EmpID'),
				"EmployeeName" => odbc_result($qry, 'EmployeeName'),
			
			
				
			
				);
            
}
odbc_free_result($qry);
odbc_close($MSSQL_CONN);



echo json_encode($arr);

?>