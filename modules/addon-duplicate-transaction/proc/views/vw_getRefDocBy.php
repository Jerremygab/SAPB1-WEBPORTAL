<?php
session_start();
include('../../../../config/config.php');

$objType = $_POST['objType'];
$docNum = $_POST['docNum'];

	$itemno = 1;
	$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
		SELECT 
			ObjectTableName, ObjectTable, ObjectType, DocEntry, RefAmount, Remark
		FROM (
			SELECT RefObjType, RefDocNum, 'Sales Quotation' AS ObjectTableName, 'OQUT' AS ObjectTable, ObjectType, DocEntry, RefAmount, Remark FROM QUT21
				UNION ALL
			SELECT RefObjType, RefDocNum, 'Sales Order' AS ObjectTableName, 'ORDR' AS ObjectTable, ObjectType, DocEntry, RefAmount, Remark FROM RDR21
				UNION ALL
			SELECT RefObjType, RefDocNum, 'Delivery Notes' AS ObjectTableName, 'ODLN' AS ObjectTable, ObjectType, DocEntry, RefAmount, Remark FROM DLN21
				UNION ALL
			SELECT RefObjType, RefDocNum, 'Return Request' AS ObjectTableName, 'ORRR' AS ObjectTable, ObjectType, DocEntry, RefAmount, Remark FROM RRR21
				UNION ALL
			SELECT RefObjType, RefDocNum, 'Return' AS ObjectTableName, 'ORDN' AS ObjectTable, ObjectType, DocEntry, RefAmount, Remark FROM RDN21
				UNION ALL
			SELECT RefObjType, RefDocNum, 'A/R Down Payment' AS ObjectTableName, 'ODPI' AS ObjectTable, ObjectType, DocEntry, RefAmount, Remark FROM DPI21
				UNION ALL
			SELECT RefObjType, RefDocNum, 'A/R Invoice' AS ObjectTableName, 'OINV' AS ObjectTable, ObjectType, DocEntry, RefAmount, Remark FROM INV21
				UNION ALL
			SELECT RefObjType, RefDocNum, 'A/R Credit Memo' AS ObjectTableName, 'ORIN' AS ObjectTable, ObjectType, DocEntry, RefAmount, Remark FROM RIN21
				UNION ALL
			SELECT RefObjType, RefDocNum, 'Purchase Request' AS ObjectTableName, 'OPRQ' AS ObjectTable, ObjectType, DocEntry, RefAmount, Remark FROM PRQ21
				UNION ALL
			SELECT RefObjType, RefDocNum, 'Purchase Quotation' AS ObjectTableName, 'OPQT' AS ObjectTable, ObjectType, DocEntry, RefAmount, Remark FROM PQT21
				UNION ALL
			SELECT RefObjType, RefDocNum, 'Purchase Order' AS ObjectTableName, 'OPQR' AS ObjectTable, ObjectType, DocEntry, RefAmount, Remark FROM POR21
				UNION ALL
			SELECT RefObjType, RefDocNum, 'Goods Receipt PO' AS ObjectTableName, 'OPDN' AS ObjectTable, ObjectType, DocEntry, RefAmount, Remark FROM PDN21
				UNION ALL
			SELECT RefObjType, RefDocNum, 'Goods Return Request' AS ObjectTableName, 'OPRR' AS ObjectTable, ObjectType, DocEntry, RefAmount, Remark FROM PRR21
				UNION ALL
			SELECT RefObjType, RefDocNum, 'Goods Return' AS ObjectTableName, 'ORPD' AS ObjectTable, ObjectType, DocEntry, RefAmount, Remark FROM RPD21
				UNION ALL
			SELECT RefObjType, RefDocNum, 'A/P Down Payment' AS ObjectTableName, 'ODPO' AS ObjectTable, ObjectType, DocEntry, RefAmount, Remark FROM DPO21
				UNION ALL
			SELECT RefObjType, RefDocNum, 'A/P Invoice' AS ObjectTableName, 'OPCH' AS ObjectTable, ObjectType, DocEntry, RefAmount, Remark FROM PCH21
				UNION ALL
			SELECT RefObjType, RefDocNum, 'A/P Credit Memo' AS ObjectTableName, 'ORPC' AS ObjectTable, ObjectType, DocEntry, RefAmount, Remark FROM RPC21
				UNION ALL
			SELECT RefObjType, RefDocNum, 'Incoming Payments' AS ObjectTableName, 'ORCT' AS ObjectTable, ObjType AS ObjectType, DocEntry, 0.00 AS RefAmount, Remark FROM RCT9
				UNION ALL
			SELECT RefObjType, RefDocNum, 'Outgoing Payments' AS ObjectTableName, 'OVPM' AS ObjectTable, ObjType AS ObjectType, DocEntry, 0.00 AS RefAmount, Remark FROM VPM9
				UNION ALL
			SELECT RefObjType, RefDocNum, 'Checks for Payment' AS ObjectTableName, 'OCHO' AS ObjectTable, ObjType AS ObjectType, DocEntry, 0.00 AS RefAmount, Remark FROM CHO3
				UNION ALL
			SELECT RefObjType, RefDocNum, 'Goods Receipt' AS ObjectTableName, 'OIGN' AS ObjectTable, ObjectType, DocEntry, RefAmount, Remark FROM IGN21
				UNION ALL
			SELECT RefObjType, RefDocNum, 'Goods Issue' AS ObjectTableName, 'OIGE' AS ObjectTable, ObjectType, DocEntry, RefAmount, Remark FROM IGE21
				UNION ALL
			SELECT RefObjType, RefDocNum, 'Inventory Revaluation' AS ObjectTableName, 'OMRV' AS ObjectTable, ObjType AS ObjectType, DocEntry, 0.00 AS RefAmount, Remark FROM MRV4
				UNION ALL
			SELECT RefObjType, RefDocNum, 'Inventory Counting' AS ObjectTableName, 'OINC' AS ObjectTable, ObjType AS ObjectType, DocEntry, 0.00 AS RefAmount, Remark FROM INC12
				UNION ALL
			SELECT RefObjType, RefDocNum, 'Inventory Posting' AS ObjectTableName, 'OIQR' AS ObjectTable, ObjType AS ObjectType, DocEntry, 0.00 AS RefAmount, Remark FROM IQR5
				UNION ALL
			SELECT RefObjType, RefDocNum, 'Inventory Transfer Request' AS ObjectTableName, 'OWTQ' AS ObjectTable, ObjectType, DocEntry, RefAmount, Remark FROM WTQ21
				UNION ALL
			SELECT RefObjType, RefDocNum, 'Inventory Transfer' AS ObjectTableName, 'OWTR' AS ObjectTable, ObjectType, DocEntry, RefAmount, Remark FROM WTR21
				UNION ALL
			SELECT RefObjType, RefDocNum, 'Production Order' AS ObjectTableName, 'OWOR' AS ObjectTable, ObjType AS ObjectType, DocEntry, 0.00 AS RefAmount, Remark FROM WOR5
		) AS T0

		WHERE T0.RefObjType = $objType AND T0.RefDocNum = $docNum
	
	");

	$data = array();

	while (odbc_fetch_row($qry)) 
	{
		$item = array();
		$item['ObjectTableName'] = odbc_result($qry, "ObjectTableName");
		$item['ObjectTable'] = odbc_result($qry, "ObjectTable");
		$item['ObjectType'] = odbc_result($qry, "ObjectType");
		$item['DocEntry'] = odbc_result($qry, "DocEntry");
		$item['RefAmount'] = number_format(odbc_result($qry, "RefAmount"),2);
		$item['Remark'] = odbc_result($qry, "Remark");
		$item['IssueDate'] = date('Y-m-d');
		$data[] = $item;
	}
	
	odbc_free_result($qry);

	foreach ($data as $key => $value) {
		$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
			SELECT 
				DocDate
			FROM ".$value['ObjectTable']."
			WHERE DocEntry = ".$value['DocEntry']		
		);

		while (odbc_fetch_row($qry)) 
		{
			$data[$key]['IssueDate'] = SAPDateFormater(odbc_result($qry, 'DocDate'));
		}

		odbc_free_result($qry);
	}

	echo json_encode($data);
?>