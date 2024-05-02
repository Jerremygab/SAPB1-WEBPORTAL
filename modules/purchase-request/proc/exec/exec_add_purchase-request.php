<?php
$err = 0;
$errmsg = '';
session_start();
include('../../../../config/config.php');

$docentry = '';


$txtCardCode = $_POST['txtCardCode'];
$txtPostingDate  = $_POST['txtPostingDate'];
$txtDeliveryDate  = $_POST['txtDeliveryDate'];
$txtDocumentDate  = $_POST['txtDocumentDate'];
$selBranch = $_POST['selBranch'];
$selDept  = $_POST['selDept']; 
$txtOwnerCode  = $_POST['txtOwnerCode'];
$txtRemarks = $_POST['txtRemarks'];
$txtRequiredDate = $_POST['txtRequiredDate'];
$jsonAttachment = $_POST['jsonAttachment'];


$serviceType  = $_POST['serviceType'];

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
			$oPrQ = $vCmp->GetBusinessObject(1470000113);
			
			$oPrQ->ReqType = 171;
			$oPrQ->Requester = $txtCardCode;
			if($selBranch != ""){
				$oPrQ->RequesterBranch = $selBranch;
			}
			if($selDept != ""){
				$oPrQ->RequesterDepartment = $selDept;
			}
			
		
			
			
			$oPrQ->DocDate = $txtPostingDate;
			$oPrQ->TaxDate = $txtDocumentDate;
			$oPrQ->DocDueDate = $txtDeliveryDate;
			$oPrQ->DocDate = $txtPostingDate;
			
			
			$oPrQ->Comments  = $txtRemarks;
			
			$oPrQ->DocumentsOwner  = $txtOwnerCode;
			$oPrQ->RequriedDate = $txtRequiredDate;
			
			$serviceType2 = $serviceType == "I" ? 0 : 1;
			$oPrQ->DocType = $serviceType2;
			
			
			$udfJson = json_decode(stripslashes($udfJson));
				foreach ($udfJson as $key => $value) 
				{
					$oPrQ->UserFields->Fields[$value[1]]->Value = $value[0];
				}
			
			
  
			if(json_decode($json) != null) 
			{
				$json = json_decode($json, true);
				//$ctr = -1;
				//$a = 0;
				foreach ($json as $key => $value) 
				{
					if ($serviceType == 'I') 
					{
						//$value[0] - Item Code
						//$value[1] - Source
						//$value[2] - Destination
						//$value[3] - UoMEntry
						//$value[4] - UnitPrice
						//$value[5] - GrossPrice
						//$value[6] - Quantity
						//$value[7] - Plant DR
						//$value[8] - TaxCode
						//$value[9] - Discount Amount
						//$value[10] - Discount%
						//$value[11] - LineTotal
						//$value[12] - GrossTotal
						
						
						
						//$value[4] = $value[4] == "" ? 0 : $value[4];
						//$value[5] = $value[5] == "" ? 0 : $value[5];
						//$value[6] = $value[6] == "" ? 0 : $value[6];
						//$value[10] = $value[10] == "" ? 0 : $value[10];
						//$value[11] = $value[11] == "" ? 0 : $value[11];
						
						//make it better
						//$discount = $value[9] == "" ? ($value[9] / $value[12]) : 0;
						$value[4] = $value[4] == "" ? 0 : $value[4];
						
						$oPrQ->Lines->ItemCode = valid_input($value[0]);
						$oPrQ->Lines->Quantity = $value[2];
						$oPrQ->Lines->UoMEntry = $value[3];
						if($value[1] != ""){
							$oPrQ->Lines->UnitPrice = $value[1]; 
						}
					
						$oPrQ->Lines->DiscountPercent = $value[4];
						$oPrQ->Lines->VatGroup = $value[5];
						$oPrQ->Lines->LineVendor = $value[6];
						$oPrQ->Lines->RequiredDate = $value[7];
						if($value[8] != ''){
							$oPrQ->Lines->CostingCode = $value[8];
						}
						if($value[9] != ''){
							$oPrQ->Lines->CostingCode2 = $value[9];
						}
					
						$oPrQ->Lines->Add();
					
					}
					else{
						$value[4] = $value[4] == "" ? 0 : $value[4];
						
						$oPrQ->Lines->ItemDescription = $value[0];
						$oPrQ->Lines->AccountCode = $value[1];
						$oPrQ->Lines->Quantity = $value[3];
						//$oPrQ->Lines->UoMEntry = valid_input($value[3]);
						if($value[1] != ""){
							$oPrQ->Lines->UnitPrice = $value[2]; 
						} 
						$oPrQ->Lines->DiscountPercent = $value[4];
						$oPrQ->Lines->VatGroup = $value[5];
						$oPrQ->Lines->LineVendor = $value[6];
						$oPrQ->Lines->RequiredDate = $value[7];

						if($value[8] != ''){
							$oPrQ->Lines->CostingCode = $value[8];
						}
						if($value[9] != ''){
							$oPrQ->Lines->CostingCode2 = $value[9];
						}
				
						$oPrQ->Lines->Add();
					
					}
					
					
				}
			} 
		
			$retval = $oPrQ->Add();
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