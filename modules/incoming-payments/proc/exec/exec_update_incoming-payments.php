<?php
$err = 0;
$errmsg = '';
session_start();
include('../../../../config/config.php');

$docentry = '';

$Database = $_SESSION['SESS_COMPANY'];

if($Database == 'EBI_LIVEDB20220217'){
	$err += 1;
}
$txtDocEntry = $_POST['txtDocEntry'];
$txtDocNum = $_POST['txtDocNum'];
$txtRemarks = $_POST['txtRemarks'];
$txtJournalMemo = $_POST['txtJournalMemo'];
$txtPayTo = $_POST['txtPayTo'];
$txtReference = $_POST['txtReference'];
$txtPayNoDoc = $_POST['txtPayNoDoc'];
$selTransactionType = $_POST['selTransactionType'];
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
			$oRdr = $vCmp->GetBusinessObject(46);
			$oRdr->GetByKey($txtDocEntry);
			
			
			
  			$oRdr->CounterReference = $txtReference;
			$oRdr->Remarks = $txtRemarks;
			$oRdr->JournalRemarks = $txtJournalMemo;
			

			if($selTransactionType == 'S') {
				if($txtPayNoDoc == 'Y'){
				}
					
			}
			else{
				$oRdr->Address = $txtPayTo;
			}

			// $udfJson = json_decode(stripslashes($udfJson));
			// 	foreach ($udfJson as $key => $value) 
			// 	{
			// 		$oRdr->UserFields->Fields[$value[1]]->Value = $value[0];
			// 	}
			
			
		
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