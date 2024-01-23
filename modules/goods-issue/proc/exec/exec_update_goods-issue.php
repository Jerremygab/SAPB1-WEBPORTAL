<?php
$err = 0;
$errmsg = '';
session_start();
include('../../../../config/config.php');

$docentry = '';

$txtDocNum  =  $_POST["txtDocNum"];
$txtDocumentDate  = $_POST['txtDocumentDate'];
$txtOwnerCode  = $_POST['txtOwnerCode'];
$txtRemarks = $_POST['txtRemarks'];
$txtRef2 = $_POST['txtRef2'];

$serviceType  = $_POST['serviceType'];

$json = $_POST['json'];
$jsonDeleteRow = $_POST['jsonDeleteRow'];
$udfJson = $_POST['udfJson'];



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
			$oRdr = $vCmp->GetBusinessObject(60);
			$oRdr->GetByKey($txtDocNum);
			
		
			
			$oRdr->TaxDate = $txtDocumentDate;
			
			
			
			$oRdr->Comments  = $txtRemarks;
			
			
			
			$oRdr->Reference2  = $txtRef2;
			
			$serviceType2 = $serviceType == "I" ? 0 : 1;
			$oRdr->DocType = $serviceType2;
			
			
			if($jsonDeleteRow != ''){
				$deleteLineNo = json_decode(stripslashes($jsonDeleteRow));
				foreach ($deleteLineNo as $key => $value) 
				{
					if ($serviceType == 'I') 
					{
						$oRdr->Lines->SetCurrentLine($value[0]);
						$oRdr->Lines->Delete();
						
					}
				}
			}
			
			$udfJson = json_decode(stripslashes($udfJson));
				foreach ($udfJson as $key => $value) 
				{
					$oRdr->UserFields->Fields[$value[1]]->Value = $value[0];
				}
			
			
			
		
			$retval = $oRdr->Update();
			if ($retval != 0) 
			{
				$errmsg .= $vCmp->GetLastErrorDescription;
				$err += 1;
			}
			else
			{
				$vCmp->GetNewObjectCode($docentry);
		
			}	  
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