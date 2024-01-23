<?php
session_start();
$err = 0;
$errmsg = '';

$selCompany = valid_input($_POST['selCompany']);
$txtUsername = valid_input($_POST['txtUsername']);
$txtPassword = valid_input($_POST['txtPassword']);

$MSSQL_USER = 'sa';
$MSSQl_PASSWORD = 'dev1s@p2020';
$MSSQL_SERVER = 'SUPERSPEED-DEV1';
$MSSQL_DB = $selCompany;
$MSSQL_DB2 = 'GSDC-COMMON-3';

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

$errChar='';

$qryActive = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB2."]; SELECT Active FROM [dbo].[@OUSR] WHERE UserCode='$txtUsername' AND UserPass='$txtPassword'   ");
	while (odbc_fetch_row($qryActive)){
		if (odbc_result($qryActive, 'Active') == 1) 
		{
			$err += 1;
			$errChar = 'a';
			
		}
		else{
			$errChar = '';
		}
	}
	
	odbc_free_result($qryActive);
if($err == 0){
	$qryActiveList = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB2."]; SELECT SUM(Active) AS Actives FROM [dbo].[@OUSR]  ");
	while (odbc_fetch_row($qryActiveList)){
		if (odbc_result($qryActiveList, 'Actives') > 20) 
		{
			$err += 1;
			$errChar = 'b';
			
		}
		else{
			$errChar = '';
		}
	}
	odbc_free_result($qryActiveList);
}
if($err == 0){
$qryLocked = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB2."]; SELECT Locked FROM [dbo].[@OUSR] WHERE UserCode='$txtUsername' AND UserPass='$txtPassword'   ");
	while (odbc_fetch_row($qryLocked)){
		if (odbc_result($qryLocked, 'Locked') == 'Y') 
		{
			$err += 1;
			$errChar = 'c';
			
		}
		else{
			$errChar = '';
		}
	}
	
	odbc_free_result($qryLocked);
}
if($err == 0){
$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB2."]; SELECT * FROM [dbo].[@OUSR] WHERE UserCode='$txtUsername' AND UserPass='$txtPassword'  ");

odbc_fetch_row($qry);

if (odbc_num_rows($qry) <= 0) 
{
	$err += 1;
	$errmsg .= 'Invalid Username or Password!.';
}
odbc_free_result($qry);
}


if($err == 0)
{
	$qrySelect = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
		SELECT 
		T0.UserId,
		T0.UserCode,
		T0.UserPass,
		T0.UserType,
	
		T0.SapUser,
		T0.SapPass,
		T0.Modules,
		T0.EmpId,
		T0.MainModule,
		T0.Module,
		T0.SuperUser,
		T0.Locked,
		
		T1.CardName AS Name,
		
		CONCAT(T2.FirstName, ' ', T2.LastName) AS 'CustomerType'
		
		
		FROM [".$MSSQL_DB2."].[dbo].[@OUSR] T0
		INNER JOIN OCRD T1 ON T0.EmpId = T1.U_UserId
		INNER JOIN OHEM T2 ON T0.EmpId = T2.EmpId
		
		WHERE T0.UserCode='$txtUsername' AND T0.UserPass='$txtPassword' ");
		
	
	
	odbc_fetch_row($qrySelect);
	
		$_SESSION['SESS_USERID'] = odbc_result($qrySelect, 'UserId');
		$_SESSION['SESS_USERCODE'] = odbc_result($qrySelect, 'UserCode');
		$_SESSION['SESS_USERPASS'] = odbc_result($qrySelect, 'UserPass');
		$_SESSION['SESS_NAME'] = odbc_result($qrySelect, 'Name');
		$_SESSION['SESS_USER_MDL'] = odbc_result($qrySelect, 'Modules');
		$_SESSION['SESS_USER_MAINMODULE'] = odbc_result($qrySelect, 'MainModule');
		$_SESSION['SESS_USER_MODULE'] = odbc_result($qrySelect, 'Module');
		$_SESSION['SESS_SAPUSER'] = odbc_result($qrySelect, 'SapUser');
		$_SESSION['SESS_SAPPASS'] = odbc_result($qrySelect, 'SapPass');
		$_SESSION['SESS_EMP'] = 13;
		$_SESSION['SESS_SUPERUSER'] = odbc_result($qrySelect, 'SuperUser');
		$_SESSION['SESS_CUSTOMERTYPE'] = odbc_result($qrySelect, 'CustomerType');
		
		
		odbc_free_result($qrySelect);
		echo 'true*Successfull! Redirecting...';
	
}

else if($errChar == 'a')
{
	echo 'false1*'.$errmsg;
}
else if($errChar == 'b')
{
	echo 'false2*'.$errmsg;
}
else if($errChar == 'c')
{
	echo 'false3*'.$errmsg;
}
else{
	echo 'false4*'.$errmsg;
}



odbc_close($MSSQL_CONN);
?>