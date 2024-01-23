<?php
session_start();
include_once('../../../../config/config.php');

$userid = '';
$err = 0;
$errmsg = '';
$docentry = 0;

$txtCode = $_POST['txtCode'];
$txtDescription = $_POST['txtDescription'];
$chkActive = $_POST['chkActive'];
$chkModule = $_POST['chkModule'];
$txtNumberofApprovals  = $_POST['txtNumberofApprovals'];
$txtNumberofDisapprovals  = $_POST['txtNumberofDisapprovals'];

$jsonQuery = $_POST['jsonQuery'];
$jsonUser = $_POST['jsonUser'];
$jsonTemplate = $_POST['jsonTemplate'];



if(isset($_POST['chkModule']))
{
	
		$chkModule = implode(', ', $_POST['chkModule']);
	
	
	
}
else
{
	$chkModule = '';
}

$sqlqry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB2."]; SELECT COUNT(*) AS Res FROM [dbo].[@OAPR] WHERE Code = '$txtCode' ");

while (odbc_fetch_row($sqlqry)) 
{
	if(odbc_result($sqlqry, 'Res') != 0)
	{		$errmsg .= 'Duplicate Approval Code!';

		$err += 1;
	}
	
}

odbc_free_result($sqlqry);

$docentryqry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB2."]; SELECT MAX(DocEntry) AS DocEntry FROM [dbo].[@OAPR] ");

while (odbc_fetch_row($docentryqry)) 
{
	if(odbc_result($docentryqry, 'DocEntry') != null)
	{	
		$docentry = odbc_result($docentryqry, 'DocEntry') + 1;
	}
	else{
		$docentry = 1;
	}
	
}

if ($err == 0) 
{
	
	$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB2."]; INSERT INTO [@OAPR](
														Code,
														Description,  
														Inactive, 
														Modules,
														DocEntry,
														NoOfApprovals,
														NoOfDisapprovals
														)
														VALUES(
															'$txtCode',
															'$txtDescription', 
															'$chkActive', 
															'$chkModule',
															$docentry,
															$txtNumberofApprovals,
															$txtNumberofDisapprovals) ");
	if(!$qry)
	{
		$err += 1;
		$errmsg .= 'Error Inserting User (Error Code: '.odbc_error().') - '.odbc_errormsg();
	}
	else{
		if(json_decode($jsonUser) != null) 
			{
				$jsonUser = json_decode($jsonUser, true);
				//$ctr = -1;
				//$a = 0;
				foreach ($jsonUser as $key => $value) 
				{
					$linenum = $value[0];
					$userid = $value[1];
					$username = $value[2];
					$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB2."]; INSERT INTO [@APR1](
													EmpId,
													EmpName,  
													Code,
													LineNum,
													DocEntry
													)
													VALUES(
														'$userid',
														'$username',
														'$txtCode',
														$linenum,
														$docentry) ");


					$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB2."]; UPDATE [@OUSR] SET Approver = 'Y' WHERE EmpId = '$userid' ");
					
				}
			}
			if(json_decode($jsonTemplate) != null) 
			{
				$jsonTemplate = json_decode($jsonTemplate, true);
				//$ctr = -1;
				//$a = 0;
				foreach ($jsonTemplate as $key => $value) 
				{
					$linenum = $value[0];
					$appid = $value[1];
					$appname = $value[2];
					$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB2."]; INSERT INTO [@APR2](
													Code,
													Description,  
													LineNum,
													DocEntry,
													TemplateCode
													)
													VALUES(
														'$txtCode',
														'$appname',
														$linenum,
														$docentry,
														'$appid') ");
					
				}
			}
			if(json_decode($jsonQuery) != null) 
			{
				$jsonQuery = json_decode($jsonQuery, true);
				//$ctr = -1;
				//$a = 0;
				foreach ($jsonQuery as $key => $value) 
				{
					$linenum = $value[0];
					$queryid = $value[1];
					$queryname = $value[2];
					$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB2."]; INSERT INTO [@APR3](
													Code,
													Description,  
													LineNum,
													DocEntry,
													Query
													)
													VALUES(
														'$txtCode',
														'$queryname',
														$linenum,
														$docentry,
														'$queryid') ");
					
				}
			}
	}
	
}

if ($err == 0) 
{
	$data = array("valid"=>true, 
						"msg"=>"Operation completed successfully - " .$txtCode,
						"name"=>$txtDescription);
	echo json_encode($data);
}
else
{
	$data = array("valid"=>false, "msg"=>$errmsg);
	echo json_encode($data);
}

?>