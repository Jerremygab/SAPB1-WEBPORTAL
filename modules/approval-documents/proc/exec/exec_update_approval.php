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



$docentryqry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB2."]; SELECT DocEntry  FROM [dbo].[@OAPR] WHERE Code = '$txtCode' ");

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
// 	UPDATE table_name
// SET column1 = value1, column2 = value2, ...
// WHERE condition;
	
	$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB2."]; UPDATE [@OAPR] 
														SET 
														
														Inactive = '$chkActive', 
														Modules = '$chkModule'

														WHERE Code = '$txtCode'
													");
	if(!$qry)
	{
		$err += 1;
		$errmsg .= 'Error Inserting User (Error Code: '.odbc_error().') - '.odbc_errormsg();
	}
	else{
		if(json_decode($jsonUser) != null) 
			{
				$qryDel = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB2."]; DELETE FROM [@APR1] WHERE Code = '$txtCode' ");
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
					
				}
			}
			if(json_decode($jsonTemplate) != null) 
			{
				$qryDel = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB2."]; DELETE FROM [@APR2] WHERE Code = '$txtCode' ");
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
				$qryDel = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB2."]; DELETE FROM [@APR3] WHERE Code = '$txtCode' ");
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