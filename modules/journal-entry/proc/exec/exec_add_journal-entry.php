<?php
$err = 0;
$errmsg = '';
session_start();
include('../../../../config/config.php');

$docentry = '';

$txtPostingDate  = $_POST['txtPostingDate'];
$txtDeliveryDate  = $_POST['txtDeliveryDate'];
$txtDocumentDate  = $_POST['txtDocumentDate'];
$txtOwnerCode  = $_POST['txtOwnerCode'];
$txtRemarks  = $_POST['txtRemarks'];
$txtMemo  = $_POST['txtMemo'];
// $txtJournalMemo  = $_POST['txtJournalMemo'];
// $txtTransNo  = $_POST['txtTransNo'];
$txtRef1  = $_POST['txtRef1'];
$txtRef2  = $_POST['txtRef2'];
$txtRef3  = $_POST['txtRef3'];
//$txtBPLId  = $_POST['txtBPLId'];

$json = $_POST['json'];
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
			$oRdr = $vCmp->GetBusinessObject(30);
			

			// txtPostingDate
			// txtDeliveryDate
			// txtDocumentDate
			// txtOwnerCode
			// txtRemarks
			// txtMemo
			// txtJournalMemo
			// txtTransNo
			// txtRef1
			// txtRef2
			// txtRef3
			// txtBPLId

			// $oRdr->BplId  = $txtBPLId;
			$oRdr->ReferenceDate  = $txtPostingDate;
			$oRdr->TaxDate	  = $txtDocumentDate;	
			// $oRdr->StornoDate	  = $txtCardCode;
			// $oRdr->VatDate	  = $txtCardCode;		
			$oRdr->DueDate = $txtDeliveryDate;

			$oRdr->Memo	 = $txtMemo;
			$oRdr->Reference	 = $txtRef1;
			$oRdr->Reference2	 = $txtRef2;
			$oRdr->Reference3	 = $txtRef3;
			

				// $udfJson = json_decode(stripslashes($udfJson));
				// foreach ($udfJson as $key => $value) 
				// {
				// 	$oRdr->UserFields->Fields[$value[1]]->Value = $value[0];
				// }
			
			if(json_decode($json) != null) 
			{
				$json = json_decode($json, true);
				$setcurrentline = 0;
				foreach ($json as $key => $value) 
				{
						
						// glaccount
						// controlaccount
						// debit
						// credit
						// bplid
						// branchname

						// AccountCode	
						// Debit	
						// Credit	
						// ShortName	
						// ContraAccount

						$value[2] = $value[2] == "" ? 0 : $value[2];
						$value[3] = $value[3] == "" ? 0 : $value[3];
						
						if($value[3] == 'ACCT'){
							$oRdr->Lines->AccountCode = $value[0];
						}
						else{
							$oRdr->Lines->AccountCode = $value[1];
							//$oRdr->Lines->ShortName = $value[0];

						}
						
						//$oRdr->Lines->ContraAccount = $value[1];
						$oRdr->Lines->Debit = $value[2];
						$oRdr->Lines->Credit = $value[3];
						//ako nag galaw $oRdr->Lines->BplId = $value[4]; 
						//$oRdr->Lines->ShortName = $value[1]; 
					//	$oRdr->Lines->CostingCode = $value[6];
						//$oRdr->Lines->CostingCode2 = $value[7];
						//$oRdr->Lines->CostingCode3 = $value[8];
						
						
					

				
						$oRdr->Lines->Add();
						$setcurrentline++;
					
					
					
					
				}
			} 
		
			$retval = $oRdr->Add();
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