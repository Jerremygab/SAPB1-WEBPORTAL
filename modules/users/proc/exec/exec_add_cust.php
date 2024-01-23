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
//$chkAdmin = $_POST['chkAdmin'];
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

$sqlqry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB3."]; SELECT COUNT(*) AS Res FROM [dbo].[@OUSR] WHERE UserCode = '$txtUserCode' ");

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
	
	$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB3."]; INSERT INTO [@OUSR](
														UserCode,
														Name,  
														UserPass, 
														
														Locked,
														MainModule,
														Module, 
														EmpId
														)
			
													VALUES(
															'$txtUserCode',
															'$txtUserName', 
															'$txtPassword', 
															
															'$chkLocked',													
															'$chkMainModule', 
															'$chkModule', 
															13) ");
	if(!$qry)
	{
		$err += 1;
		$errmsg .= 'Error Inserting User (Error Code: '.odbc_error().') - '.odbc_errormsg();
	}
	
}

$cardCodeLink = '';
$cardCodeLink2 = '';
$sqlqry2 = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB3."]; SELECT UserId FROM [@OUSR] WHERE UserCode = '$txtUserCode' ");

while (odbc_fetch_row($sqlqry2)) 
{
	if(odbc_result($sqlqry2, 'UserId') == '')
	{		
		$errmsg .= "User Code Doesn't Exists!";
		$err += 1;
	}
	else
	{
		$cardCodeLink = odbc_result($sqlqry2, 'UserId');
	}
}
$sqlqry3 = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT CardCode FROM OCRD WHERE CardCode = '$txtUserCode' ");

while (odbc_fetch_row($sqlqry3)) 
{
	if(odbc_result($sqlqry3, 'CardCode') == '')
	{		
		$errmsg .= "User Code Doesn't Exists!";
		$err += 1;
	}
	else
	{
		$qryOCRD = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; UPDATE OCRD SET 
												U_UserID = '$cardCodeLink'												
												
												WHERE CardCode = '$txtUserCode' ");
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