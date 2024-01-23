<?php
session_start();
include('../../../../config/config.php');

$objSession = json_decode($_SESSION['ARInvoiceArr']);

$docNum = $_POST['docNum'];

	$itemno = 1;
	$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
		SELECT 
			ISNULL(NULLIF(LineNum, ''),'') AS LineNum,
			ISNULL(NULLIF(RefObjType, ''),'') AS RefObjType,
			ISNULL(NULLIF(RefDocNum, ''),'') AS RefDocNum,
			ISNULL(NULLIF(ExtDocNum, ''),'') AS ExtDocNum,
			ISNULL(NULLIF(CONVERT(varchar,IssueDate, 21), ''),'') AS IssueDate,
			ISNULL(NULLIF(Remark, ''),'') AS Remark
		FROM $objSession->childTable21
		WHERE DocEntry = '$docNum'
		ORDER BY LineNum
	");

	$data = array();

	while (odbc_fetch_row($qry)) 
	{
		$item = array();
		$item['LineNum'] = odbc_result($qry, "LineNum");
		$item['RefTable'] = odbc_result($qry, "RefObjType");
		$item['RefDocNum'] = odbc_result($qry, "RefDocNum") == 0 ? '' : odbc_result($qry, "RefDocNum");
		$item['ExtDocNum'] = odbc_result($qry, "ExtDocNum");
		$item['IssueDate'] = odbc_result($qry, "IssueDate") == '' ? '' : date('Y-m-d' ,strtotime(odbc_result($qry, "IssueDate")));
		$item['Remark'] = odbc_result($qry, "Remark");
		$data[] = $item;
	}
	
	odbc_free_result($qry);

	echo json_encode($data);
?>