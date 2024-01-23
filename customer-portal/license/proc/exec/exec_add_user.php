<?php
session_start();
include_once('../../../../config/config.php');

$userid = '';
$err = 0;
$errmsg = '';


$txtEmpCode = $_POST['txtEmpCode'];
$txtUserCode = $_POST['txtUserCode'];
$txtUserName = $_POST['txtUserName'];
$txtPassword =$_POST['txtPassword'];
$chkAdmin = $_POST['chkAdmin'];

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

$sqlqry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB2."]; SELECT COUNT(*) AS Res FROM [dbo].[@OUSR] WHERE UserCode = '$txtUserCode' ");

while (odbc_fetch_row($sqlqry)) 
{
	if(odbc_result($sqlqry, 'Res') != 0)
	{		$errmsg .= 'Duplicate User Code!';

		$err += 1;
	}
	
}

odbc_free_result($sqlqry);

if ($err == 0) 
{
	
	$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB2."]; INSERT INTO [@OUSR](
														UserCode,
														Name,  
														UserPass, 
														SuperUser,
														MainModule,
														Module, 
														EmpId
														)
			
													VALUES(
															'$txtUserCode',
															'$txtUserName', 
															'$txtPassword', 
															'$chkAdmin', 
															'$chkMainModule', 
															'$chkModule', 
															'$txtEmpCode') ");
	if(!$qry)
	{
		$err += 1;
		$errmsg .= 'Error Inserting User (Error Code: '.odbc_error().') - '.odbc_errormsg();
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