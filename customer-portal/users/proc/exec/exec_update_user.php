<?php
session_start();
include_once('../../../../config/config.php');

$userid = '';
$err = 0;
$errmsg = '';

$txtUserId = $_POST['txtUserId'];
$txtEmpCode = $_POST['txtEmpCode'];
$txtUserCode = $_POST['txtUserCode'];
$txtUserName = $_POST['txtUserName'];
$txtPassword =$_POST['txtPassword'];
$chkAdmin = $_POST['chkAdmin'];
$chkLocked = $_POST['chkLocked'];

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
	$chkModule = implode(', ', $_POST['chkModule']);
}
else
{
	$chkModule = '';
}


if ($err == 0) 
{
	if($txtPassword == "")
	{
		$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB3."]; UPDATE [@OUSR] SET 
												UserCode = '$txtUserCode', 
												Name = '$txtUserName', 
												
												Locked = '$chkLocked',
												MainModule = '$chkMainModule',
												Module = '$chkModule'													
												
												WHERE UserId = '$txtUserId' ");
	}
	else
	{
		$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB3."]; UPDATE [@OUSR] SET 
												UserCode = '$txtUserCode', 
												Name = '$txtUserName', 
												UserPass = '$txtPassword',
												
												Locked = '$chkLocked',
												MainModule = '$chkMainModule',
												Module = '$chkModule'		
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
						"name"=>$txtUserName,
						"empcode"=>$txtEmpCode);
	echo json_encode($data);
}
else
{
	$data = array("valid"=>false, "msg"=>$errmsg);
	echo json_encode($data);
}

?>