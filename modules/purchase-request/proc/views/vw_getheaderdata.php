<?php
session_start();
include_once('../../../../config/config.php');

$docNum = $_GET['docNum'];

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
				T0.Requester,
				T0.ReqName,
				T0.Branch,
				T0.Department,
				T0.DocDate,
				T0.DocDueDate,
				T0.TaxDate,
				T0.ReqDate,
				T0.CancelDate,
				T0.LicTradNum,

				CASE WHEN T0.DocCur <> 'PHP' THEN T0.VatSum ELSE T0.VatSum END AS 'VatSum',
				CASE WHEN T0.DocCur <> 'PHP' THEN T0.DiscSum ELSE T0.DiscSum END AS 'DiscSum',
				CASE WHEN T0.DocCur <> 'PHP' THEN T0.DocTotal ELSE T0.DocTotal END AS 'DocTotal',
				CASE WHEN T0.DocCur <> 'PHP' THEN (T0.DocTotal + T0.DiscSum) - T0.VatSum ELSE (T0.DocTotal + T0.DiscSum) - T0.VatSum END AS 'TotalBeforeDisc',
				T0.DiscPrcnt,
				T0.NumAtCard,
				T0.Comments,

			

				T1.SeriesName,
				T2.CntctCode,
				T2.Name AS 'ContactPerson',
			
				T4.EmpID,
				T4.LastName + ', ' + T4.FirstName AS 'EmployeeName',

				

				T5.Name AS 'BranchName',
				T6.Name AS 'DepartmentName'
				

				FROM OPRQ T0
				INNER JOIN NNM1 T1 ON T0.Series= T1.Series
				LEFT JOIN OCPR T2 ON T0.CntctCode = T2.CntctCode
				LEFT JOIN OHEM T4 ON T0.OwnerCode = T4.empID
				LEFT JOIN OUBR T5 ON T5.Code = T0.Branch
				LEFT JOIN OUDP T6 ON T6.Code = T0.Department
				
																	
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
				
				
				
				"DocDate" => date('Y-m-d' ,strtotime(odbc_result($qry, 'DocDate'))),
				"DocDueDate" => date('Y-m-d' ,strtotime(odbc_result($qry, 'DocDueDate'))),
				"TaxDate" => date('Y-m-d' ,strtotime(odbc_result($qry, 'TaxDate'))),
				"ReqDate" => date('Y-m-d' ,strtotime(odbc_result($qry, 'ReqDate'))),
				"CancelDate" => date('Y-m-d' ,strtotime(odbc_result($qry, 'CancelDate'))),
				
				
				
				"CardCode" => odbc_result($qry, 'CardCode'),
				"CardName" => odbc_result($qry, 'CardName'),
				
				"Requester" => odbc_result($qry, 'Requester'),
				"ReqName" => odbc_result($qry, 'ReqName'),
				
				"Branch" => odbc_result($qry, 'Branch'),
				"BranchName" => odbc_result($qry, 'BranchName'),
				"Department" => odbc_result($qry, 'Department'),
				"DepartmentName" => odbc_result($qry, 'DepartmentName'),
				
				"LicTradNum" => odbc_result($qry, 'LicTradNum'),
				
				"VatSum" => number_format(odbc_result($qry, 'VatSum'),4),
				"DiscSum" => number_format(odbc_result($qry, 'DiscSum'),4),
				"DocTotal" => number_format(odbc_result($qry, 'DocTotal'),4),
				"TotalBeforeDisc" => number_format(odbc_result($qry, 'TotalBeforeDisc'),4),
				"DiscPrcnt" => number_format(odbc_result($qry, 'DiscPrcnt'),4),
				
				"NumAtCard" => odbc_result($qry, 'NumAtCard'),
				"Comments" => odbc_result($qry, 'Comments'),
				
				
				"SeriesName" => odbc_result($qry, 'SeriesName'),
				
				"EmpID" => odbc_result($qry, 'EmpID'),
				"EmployeeName" => odbc_result($qry, 'EmployeeName')
			
				
			
				);
            
}
odbc_free_result($qry);
odbc_close($MSSQL_CONN);



echo json_encode($arr);

?>