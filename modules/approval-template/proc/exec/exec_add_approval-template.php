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
$json = $_POST['json'];

if(isset($_POST['chkMainModule']))
{
	$chkMainModule = implode(', ', $_POST['chkMainModule']);
}
else
{
	$chkMainModule = '';
}



$sqlqry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB2."]; SELECT COUNT(*) AS Res FROM [dbo].[@OAPT] WHERE Code = '$txtCode' ");

while (odbc_fetch_row($sqlqry)) 
{
	if(odbc_result($sqlqry, 'Res') != 0)
	{		$errmsg .= 'Duplicate Approval Code!';

		$err += 1;
	}
	
}

odbc_free_result($sqlqry);

$docentryqry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB2."]; SELECT MAX(DocEntry) AS DocEntry FROM [dbo].[@OAPT] ");

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

odbc_free_result($docentryqry);

if ($err == 0) 
{
	
	$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB2."]; INSERT INTO [@OAPT](
														Code,
														Description,  
														Active,
														DocEntry
														)
														VALUES(
															'$txtCode',
															'$txtDescription', 
															'$chkActive',
															$docentry) ");
	if(!$qry)
	{
		$err += 1;
		$errmsg .= 'Error Inserting User (Error Code: '.odbc_error().') - '.odbc_errormsg();
	}
	else{


		if(json_decode($json) != null) 
			{
				$json = json_decode($json, true);
				//$ctr = -1;
				//$a = 0;
				foreach ($json as $key => $value) 
				{
					$linenum = $value[0];
					$empid = $value[1];
					$empname = $value[2];
					$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB2."]; INSERT INTO [@APT1](
													EmpId,
													EmpName,  
													Code,
													LineNum,
													DocEntry
													)
													VALUES(
														'$empid',
														'$empname',
														'$txtCode',
														$linenum,
														$docentry) ");
					
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