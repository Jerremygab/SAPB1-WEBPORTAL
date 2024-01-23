<?php
session_start();
include_once('../../../../config/config.php');

$userid = '';
$err = 0;
$errmsg = '';

$txtUserId = $_POST['txtUserId'];
$txtEmpCode = $_POST['txtEmpCode'];
$txtUserCode = $_POST['txtUserCode'];
$txtEmpName = $_POST['txtEmpName'];
$txtPassword =$_POST['txtPassword'];
$chkAdmin = $_POST['chkAdmin'];
$chkLocked = $_POST['chkLocked'];

$SUMMARY = $_POST['SUMMARY'];
$POD = $_POST['POD'];
$BILLING = $_POST['BILLING'];
$TP = $_POST['TP'];
$PRICING = $_POST['PRICING'];
$TREASURY = $_POST['TREASURY'];

if(isset($_POST['chkMainModule']))
{
	$chkMainModule = implode(', ', $_POST['chkMainModule']);
}
else
{
	$chkMainModule = '';
}

if(isset($_POST['chkModule']))
{
	if($chkAdmin == 'Y'){
		$adminModules = ', OUSR, OLIC';
		$chkModule = implode(', ', $_POST['chkModule']);
		$chkModule .= $adminModules;
	}else{
		$chkModule = implode(', ', $_POST['chkModule']);
	}
	
}
else
{
	$chkModule = '';
}


if ($err == 0) 
{
	if($txtPassword == "")
	{
		$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB2."]; UPDATE [@OUSR] SET 
												UserCode = '$txtUserCode', 
												Name = '$txtEmpName', 
												Superuser = '$chkAdmin',
												Locked = '$chkLocked',
												MainModule = '$chkMainModule',
												Module = '$chkModule',
												EmpId = $txtEmpCode,
												SUMMARY = '$SUMMARY',
												POD = '$POD',
												BILLING = '$BILLING',
												TP = '$TP',
												PRICING = '$PRICING',
												TREASURY = '$TREASURY'

												
												WHERE UserId = '$txtUserId' ");
	}
	else
	{
		$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB2."]; UPDATE [@OUSR] SET 
												UserCode = '$txtUserCode', 
												Name = '$txtEmpName', 
												UserPass = '$txtPassword',
												Superuser = '$chkAdmin',
												Locked = '$chkLocked',
												MainModule = '$chkMainModule',
												Module = '$chkModule',
												EmpId = $txtEmpCode,
												SUMMARY = '$SUMMARY',
												POD = '$POD',
												BILLING = '$BILLING',
												TP = '$TP',
												PRICING = '$PRICING',
												TREASURY = '$TREASURY'
												
												WHERE UserId = '$txtUserId' ");
	}
	if(!$qry)
	{
		$err += 1;
		$errmsg .= 'Error Inserting Header (Error Code: '.odbc_error().') - '.odbc_errormsg();
	}
	
}

if ($err == 0) 
{
	$data = array("valid"=>true, 
						"msg"=>"Operation completed successfully - " .$txtUserCode,
						"name"=>$txtEmpName,
						"empcode"=>$txtEmpCode);
	echo json_encode($data);
}
else
{
	$data = array("valid"=>false, "msg"=>$errmsg);
	echo json_encode($data);
}

?>