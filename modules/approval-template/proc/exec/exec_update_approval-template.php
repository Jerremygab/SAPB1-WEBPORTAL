<?php
$err = 0;
$errmsg = '';
session_start();
include('../../../../config/config.php');

$docentry = '';

$txtDocNum  =  $_POST["txtDocNum"];

$txtCode  =  $_POST["txtCode"];
$txtDescription  =  $_POST["txtDescription"];

$otArrLineNum = $_POST["otArrLineNum"];
$LineNum = ltrim(implode($otArrLineNum));




if ($err == 0) 
{
	include('../../../connect/connect.php');
	
	$vCmp=new COM("SAPbobsCOM.company") or die ("No connection");
	
	$vCmp->DbServerType = $DbServerType;
	$vCmp->server =  $server;
	$vCmp->UseTrusted =$UseTrusted;
	$vCmp->DBusername = $DBusername;
	$vCmp->DBpassword = $DBpassword;
	$vCmp->CompanyDB = $CompanyDB;
	$vCmp->username = $username;
	$vCmp->password = $password;
	$vCmp->LicenseServer = $LicenseServer;
	
	$errid = 0;
    
	$lRetCode = $vCmp->Connect;

	

	if ($lRetCode != 0) 
	{
		$errmsg .= $vCmp->GetLastErrorDescription;
		$err += 1;
	}
	else
	{
		$deleterowqry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB2."]; 
		DELETE FROM [@APT1] WHERE LineNum in ($LineNum) AND Code = '$txtCode'");
			  
	}
}

if ($err == 0) 
{
	$data = array("valid"=>true, 
						"msg"=>"Operation completed successfully - " .$docentry,
						"docref"=>$docentry,
						"docentry"=>$docentry);
	echo json_encode($data);
}
else
{
	$data = array("valid"=>false, "msg"=>$errmsg);
	echo json_encode($data);
}



?>