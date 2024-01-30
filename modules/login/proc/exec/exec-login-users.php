<?php
session_start();
$err = 0;
$errmsg = '';


$selCompany = valid_input($_POST['selCompany']);
$txtUsername = valid_input($_POST['txtUsername']);
$txtPassword = valid_input($_POST['txtPassword']);

$MSSQL_USER = 'sa';
$MSSQl_PASSWORD = 'sapb1';
$MSSQL_SERVER = 'JERREMY';
$MSSQL_DB = $selCompany;
$MSSQL_DB2 = 'USER-COMMON';

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
		T0.Active,
	
		T0.SapUser,
		T0.SapPass,
		T0.EmpId,
		T0.MainModule,
		T0.Module,
		T0.SuperUser,
		T0.Locked,
		T0.Theme,
		CONCAT(T1.firstName, ' ',T1.lastName) AS Name,

		T0.Approver,
		T0.ApproverModules
		
		
		FROM [".$MSSQL_DB2."].[dbo].[@OUSR] T0
		INNER JOIN OHEM T1 ON T0.empid = T1.empID
		
		WHERE T0.UserCode='$txtUsername' AND T0.UserPass='$txtPassword' ");
		
	
	
	odbc_fetch_row($qrySelect);
	
		$_SESSION['SESS_USERID'] = odbc_result($qrySelect, 'UserId');
		$_SESSION['SESS_USERCODE'] = odbc_result($qrySelect, 'UserCode');
		$_SESSION['SESS_USERPASS'] = odbc_result($qrySelect, 'UserPass');
		$_SESSION['SESS_ACTIVE'] = odbc_result($qrySelect, 'Active');
		$_SESSION['SESS_NAME'] = odbc_result($qrySelect, 'Name');
		$_SESSION['SESS_USER_MAINMODULE'] = odbc_result($qrySelect, 'MainModule');
		$_SESSION['SESS_USER_MODULE'] = odbc_result($qrySelect, 'Module');
		$_SESSION['SESS_SAPUSER'] = odbc_result($qrySelect, 'SapUser');
		$_SESSION['SESS_SAPPASS'] = odbc_result($qrySelect, 'SapPass');
		$_SESSION['SESS_EMP'] = odbc_result($qrySelect, 'EmpId');
		$_SESSION['SESS_SUPERUSER'] = odbc_result($qrySelect, 'SuperUser');
		$_SESSION['SESS_THEME'] = odbc_result($qrySelect, 'Theme');
		$_SESSION['SESS_APPROVER'] = odbc_result($qrySelect, 'Approver');
		$_SESSION['SESS_APPROVERMODULES'] = odbc_result($qrySelect, 'ApproverModules');
		
		$empid = $_SESSION['SESS_EMP'];
		
		odbc_free_result($qrySelect);
		echo 'true*Successfull! Redirecting...';

		$_SESSION['NoOfApprovals'] = '';
		$_SESSION['ApprovalTemplateCode'] = '';
		$_SESSION['OriginatorEmpId'] = '';
		$_SESSION['ApprovalStageCode'] = '';
		$_SESSION['ApproverEmpId'] = '';
		$_SESSION['ApprovalModules'] = '';
		$_SESSION['NoOfApprovals'] = '';
		$_SESSION['NoOfDisapprovals'] = '';
		$_SESSION['DisapprovedbyApprovers'] = '';

		$listOfApprovers = [];

		$qryApp = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
	
			SELECT 
	
			T0.Code AS ApprovalTemplateCode,
			T1.Description AS ApprovalTemplateName,
			T0.EmpId AS OriginatorEmpId,
			T0.EmpName AS OriginatorEmpName,
			T4.Code AS ApprovalStageCode,
			T4.Description AS ApprovalStageName,
			T3.EmpId AS ApproverEmpId,
			T3.EmpName AS ApproverEmpName,
			CAST(T4.Modules AS NVARCHAR(200)) AS ApprovalModules,
			T4.NoOfApprovals,
			T4.NoOfDisapprovals
			
			FROM [".$MSSQL_DB2."].[dbo].[@APT1] T0 
			INNER JOIN [".$MSSQL_DB2."].[dbo].[@OAPT] T1 ON T0.Code = T1.Code
			INNER JOIN [".$MSSQL_DB2."].[dbo].[@APR2] T2 ON T2.TemplateCode = T0.Code
			INNER JOIN [".$MSSQL_DB2."].[dbo].[@APR1] T3 ON T3.Code = T2.Code
			INNER JOIN [".$MSSQL_DB2."].[dbo].[@OAPR] T4 ON T4.Code = T2.Code
			
			
			WHERE T0.EmpId = $empid"
			);
	
	
			while (odbc_fetch_row($qryApp)) 
			{
				$_SESSION['ApprovalTemplateCode'] = odbc_result($qryApp, 'ApprovalTemplateCode');
				$_SESSION['OriginatorEmpId'] = odbc_result($qryApp, 'OriginatorEmpId');
				$_SESSION['ApprovalStageCode'] = odbc_result($qryApp, 'ApprovalStageCode');
				$_SESSION['ApproverEmpId'] = odbc_result($qryApp, 'ApproverEmpId');
				$_SESSION['ApprovalModules'] = odbc_result($qryApp, 'ApprovalModules');
				$_SESSION['NoOfApprovals'] = odbc_result($qryApp, 'NoOfApprovals');
				$_SESSION['NoOfDisapprovals'] = odbc_result($qryApp, 'NoOfDisapprovals');
				// $_SESSION['DisapprovedbyApprovers'] = odbc_result($qryApp, 'DisapprovedbyApprovers');


				array_push($listOfApprovers,odbc_result($qryApp, 'ApproverEmpId'));
				
				
			}


			$_SESSION['ApproverEmpId'] = $listOfApprovers;
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