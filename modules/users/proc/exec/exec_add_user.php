<?php
session_start();
include_once('../../../../config/config.php');

$userid = '';
$err = 0;
$errmsg = '';


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
														Locked,
														MainModule,
														Module, 
														EmpId,
														SUMMARY,
														POD,
														BILLING,
														TP,
														PRICING,
														TREASURY
														)
			
													VALUES(
															'$txtUserCode',
															'$txtEmpName', 
															'$txtPassword', 
															'$chkAdmin',
															'$chkLocked',													
															'$chkMainModule', 
															'$chkModule', 
															'$txtEmpCode',
															'$SUMMARY',
															'$POD',
															'$BILLING',
															'$TP',
															'$PRICING',
															'$TREASURY') ");
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