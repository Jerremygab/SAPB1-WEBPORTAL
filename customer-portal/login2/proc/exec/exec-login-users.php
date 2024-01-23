<?php
session_start();
$err = 0;
$errmsg = '';

$selCompany = valid_input($_POST['selCompany']);
$txtUsername = valid_input($_POST['txtUsername']);
$txtPassword = valid_input($_POST['txtPassword']);

$MSSQL_USER = 'sa';
$MSSQl_PASSWORD = 'P@ssw0rd1';
$MSSQL_SERVER = 'BENNIE';
$MSSQL_DB = $selCompany;
$MSSQL_DB2 = 'GSDC-COMMON-2';

$_SESSION['MSSQL_DB'] = $selCompany;

$MSSQL_CONN = odbc_connect("Driver={SQL Server Native Client 11.0};Server=$MSSQL_SERVER;", $MSSQL_USER, $MSSQl_PASSWORD) or 
die('Could not open database!');

function valid_input($data) 
{
  $data = addslashes($data);
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
  return $data;
}



$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB2."]; SELECT * FROM [dbo].[@OUSR] WHERE UserCode='$txtUsername' AND UserPass='$txtPassword' AND Status = 0  ");

odbc_fetch_row($qry);

if (odbc_num_rows($qry) <= 0) 
{
	$err += 1;
	$errmsg .= 'Invalid Username or Password!.';
}
odbc_free_result($qry);

if($err == 0)
{
	$qrySelect = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
		SELECT T0.UserId,
		T0.UserCode,
		T0.UserPass,
		T0.Site,
		T0.UserType,
		T0.Status,
		T0.Roles,
		T0.SapUser,
		T0.SapPass,
		T0.Modules,
		T0.EmpId,
		T0.ToEmail,
		CONCAT(T1.firstName, ' ',T1.lastName) AS Name,
		T0.PRApp,
		T0.POApp,
		T0.ITRApp,
		T0.PO,
		T0.GRtApp,
		T0.RPT1,
		T0.RPT2,
		T0.RPT3,
		T0.RPT4,
		T0.RPT5
		
		FROM [".$MSSQL_DB2."].[dbo].[@OUSR] T0
		INNER JOIN OHEM T1 ON T0.empid = T1.empID
		
		WHERE T0.UserCode='$txtUsername' AND T0.UserPass='$txtPassword' AND T0.Status = 0 ");
	
	
	odbc_fetch_row($qrySelect);
	$_SESSION['SESS_USERID'] = odbc_result($qrySelect, 'UserId');
	$_SESSION['SESS_USERCODE'] = odbc_result($qrySelect, 'UserCode');
	$_SESSION['SESS_NAME'] = odbc_result($qrySelect, 'Name');
	$_SESSION['SESS_USER_MDL'] = odbc_result($qrySelect, 'Modules');
	$_SESSION['SESS_SAPUSER'] = odbc_result($qrySelect, 'SapUser');
	$_SESSION['SESS_SAPPASS'] = odbc_result($qrySelect, 'SapPass');
	$_SESSION['SESS_EMP'] = odbc_result($qrySelect, 'EmpId');
	$_SESSION['SESS_SITE'] = odbc_result($qrySelect, 'Site');
	$_SESSION['SESS_EMAIL'] = odbc_result($qrySelect, 'ToEmail');
	$_SESSION['SESS_PRAPPSITE'] = odbc_result($qrySelect, 'PRApp');
	$_SESSION['SESS_POAPPSITE'] = odbc_result($qrySelect, 'POApp');
	$_SESSION['SESS_ITRAPPSITE'] = odbc_result($qrySelect, 'ITRApp');
	$_SESSION['SESS_PO'] = odbc_result($qrySelect, 'PO');
	$_SESSION['SESS_GRtApp'] = odbc_result($qrySelect, 'GRtApp');
	$_SESSION['SESS_RPT1'] = odbc_result($qrySelect, 'RPT1');
	$_SESSION['SESS_RPT2'] = odbc_result($qrySelect, 'RPT2');
	$_SESSION['SESS_RPT3'] = odbc_result($qrySelect, 'RPT3');
	$_SESSION['SESS_RPT4'] = odbc_result($qrySelect, 'RPT4');
	$_SESSION['SESS_RPT5'] = odbc_result($qrySelect, 'RPT5');

	odbc_free_result($qrySelect);
	echo 'true*Successfull! Redirecting...';
}
else
{
	echo 'false*'.$errmsg;
}


odbc_close($MSSQL_CONN);
?>