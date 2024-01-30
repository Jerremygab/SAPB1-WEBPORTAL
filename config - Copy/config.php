<?php


if(!isset($_SESSION['SESS_USERID']) && empty($_SESSION['SESS_USERID'])) 
{	
	header("Location: ../../login/login.php");
/* 	$err += 1;
	$errmsg = 'Please login again.';
	$sessionexpired = 1; */
}



$MSSQL_USER = 'sa';
$MSSQl_PASSWORD = 'sapb1';
$MSSQL_SERVER = 'JERREMY';
$MSSQL_DB = $_SESSION['MSSQL_DB'];
$MSSQL_DB2 = 'USER-COMMON';
$MSSQL_DB3 = 'CUSTOMER-COMMON';

$MSSQL_CONN = odbc_connect("Driver={SQL Server Native Client 11.0};Server=$MSSQL_SERVER;", $MSSQL_USER, $MSSQl_PASSWORD) or 
die('Could not open database!');

if($MSSQL_CONN) 
{
	//echo "Connection established.";
} 
else
{
	//die("Connection could not be established.");
}

function valid_input($data) 
{
  $data = addslashes($data);
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
  return $data;
}

$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT DateFormat FROM OADM");
		while (odbc_fetch_row($qry)) 
		{
			$_SESSION['SAPDateFormat'] = odbc_result($qry, 'DateFormat');
		}
	odbc_free_result($qry);

function SAPDateFormater($dateLiteral){
	$dateFormats = array('d.m.y', 'd.m.Y', 'm.d.y', 'm.d.Y', 'Y.m.d', 'd.F.Y', 'y.m.d');
	return date($dateFormats[$_SESSION['SAPDateFormat']], strtotime($dateLiteral));
}

$objectTablesArr = array(
	array(
		'tableName' => 'Sales Quotation',
		'objectTable' => 'OQUT',
		'childTable1' => 'QUT1',
		'objectType' => 23
	),
	array(
		'tableName' => 'Sales Order',
		'objectTable' => 'ORDR',
		'childTable1' => 'RDR1',
		'objectType' => 17
	),
	array(
		'tableName' => 'Delivery',
		'objectTable' => 'ODLN',
		'childTable1' => 'DLN1',
		'objectType' => 15
	),
	array(
		'tableName' => 'Return Request',
		'objectTable' => 'ORRR',
		'childTable1' => 'RRR1',
		'objectType' => 234000031
	),
	array(
		'tableName' => 'Return',
		'objectTable' => 'ORDN',
		'childTable1' => 'RDN1',
		'objectType' => 16
	),
	array(
		'tableName' => 'A/R Down Payment',
		'objectTable' => 'ODPI',
		'childTable1' => 'DPI1',
		'objectType' => 203
	),
	array(
		'tableName' => 'A/R Invoice',
		'objectTable' => 'OINV',
		'childTable1' => 'INV1',
		'objectType' => 13
	),
	array(
		'tableName' => 'A/R Credit Memo',
		'objectTable' => 'ORIN',
		'childTable1' => 'RIN1',
		'objectType' => 14
	),
	array(
		'tableName' => 'Purchase Request',
		'objectTable' => 'OPRQ',
		'childTable1' => 'PRQ1',
		'objectType' => 1470000113
	),
	array(
		'tableName' => 'Purchase Quotation',
		'objectTable' => 'OPQT',
		'childTable1' => 'PQT1',
		'objectType' => 540000006
	),
	array(
		'tableName' => 'Purchase Order',
		'objectTable' => 'OPOR',
		'childTable1' => 'POR1',
		'objectType' => 22
	),
	array(
		'tableName' => 'Goods Receipt PO',
		'objectTable' => 'OPDN',
		'childTable1' => 'PDN1',
		'objectType' => 20
	),
	array(
		'tableName' => 'Goods Return Request',
		'objectTable' => 'OPRR',
		'childTable1' => 'PRR1',
		'objectType' => 234000032
	),
	array(
		'tableName' => 'Goods Return',
		'objectTable' => 'ORPD',
		'childTable1' => 'RPD1',
		'objectType' => 21
	),
	array(
		'tableName' => 'A/P Down Payment',
		'objectTable' => 'ODPO',
		'childTable1' => 'DPO1',
		'objectType' => 204
	),
	array(
		'tableName' => 'A/P Invoice',
		'objectTable' => 'OPCH',
		'childTable1' => 'PCH1',
		'objectType' => 18
	),
	array(
		'tableName' => 'A/P Credit Memo',
		'objectTable' => 'ORPC',
		'childTable1' => 'RPC1',
		'objectType' => 19
	),
	array(
		'tableName' => 'Incoming Payments',
		'objectTable' => 'ORCT',
		'childTable1' => 'RCT1',
		'objectType' => 24
	),
	array(
		'tableName' => 'Outgoing Payments',
		'objectTable' => 'OVPM',
		'childTable1' => 'VPM1',
		'objectType' => 46
	),
	array(
		'tableName' => 'Checks for Payment',
		'objectTable' => 'OCHO',
		'childTable1' => 'CHO1',
		'objectType' => 57
	),
	array(
		'tableName' => 'Goods Receipt',
		'objectTable' => 'OIGN',
		'childTable1' => 'IGN1',
		'objectType' => 59
	),
	array(
		'tableName' => 'Goods Issue',
		'objectTable' => 'OIGE',
		'childTable1' => 'IGE1',
		'objectType' => 60
	),
	array(
		'tableName' => 'Inventory Revaluation',
		'objectTable' => 'OMRV',
		'childTable1' => 'MRV1',
		'objectType' => 162
	),
	array(
		'tableName' => 'Inventory Counting',
		'objectTable' => 'OINC',
		'childTable1' => 'INC1',
		'objectType' => 1470000065
	),
	array(
		'tableName' => 'Inventory Posting',
		'objectTable' => 'OIQR',
		'childTable1' => 'IQR1',
		'objectType' => 10000071
	),
	array(
		'tableName' => 'Inventory Transfer Request',
		'objectTable' => 'OWTQ',
		'childTable1' => 'WTQ1',
		'objectType' => 1250000001
	),
	array(
		'tableName' => 'Inventory Transfer',
		'objectTable' => 'OWTR',
		'childTable1' => 'WTR1',
		'objectType' => 67
	),
	array(
		'tableName' => 'Production Order',
		'objectTable' => 'OWOR',
		'childTable1' => 'WOR1',
		'objectType' => 202
	),
	array(
		'tableName' => 'External Document',
		'objectTable' => '',
		'objectTable' => '',
		'objectType' => -1
	)
);

$_SESSION['objectTablesArr'] = json_encode($objectTablesArr);

?>