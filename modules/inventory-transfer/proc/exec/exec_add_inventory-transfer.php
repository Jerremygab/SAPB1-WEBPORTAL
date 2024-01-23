<?php
$err = 0;
$errmsg = '';
session_start();
include('../../../../config/config.php');

$docentry = '';

$txtCardCode = $_POST['txtCardCode'];
$txtPostingDate  = $_POST['txtPostingDate'];

$txtDocumentDate  = $_POST['txtDocumentDate'];
$txtContactPerson   = $_POST['txtContactPerson'];
$txtSalesEmpCode  = $_POST['txtSalesEmpCode'];
$txtOwnerCode  = $_POST['txtOwnerCode'];
$txtRemarks = $_POST['txtRemarks'];
$selShipToAddress  = $_POST['selShipToAddress'];

$txtJournalMemo  = $_POST['txtJournalMemo'];


$txtFromWSHECode  = $_POST['txtFromWSHECode'];
$txtToWSHECode  = $_POST['txtToWSHECode'];


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
			$oWtr = $vCmp->GetBusinessObject(67);
			if($txtCardCode != ""){
				$oWtr->CardCode = $txtCardCode;
				$oWtr->ContactPerson = $txtContactPerson;
				$oWtr->ShipToCode = $selShipToAddress;
			}
		
			$oWtr->TaxDate = $txtDocumentDate;
			
			$oWtr->DocDate = $txtPostingDate;
			
			
			
			
			$oWtr->Comments  = $txtRemarks;
			$oWtr->SalesPersonCode  = $txtSalesEmpCode;
			
			$oWtr->FromWarehouse = $txtFromWSHECode;
			$oWtr->ToWarehouse = $txtToWSHECode;
			
			
			
			
			
			$oWtr->JournalMemo = $txtJournalMemo;
			
			
				$udfJson = json_decode(stripslashes($udfJson));
				foreach ($udfJson as $key => $value) 
				{
					$oWtr->UserFields->Fields[$value[1]]->Value = $value[0];
				}
			
			
			if(json_decode($json) != null) 
			{
				$json = json_decode($json, true);
				//$ctr = -1;
				//$a = 0;
				foreach ($json as $key => $value) 
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
						
						$oWtr->Lines->ItemCode = valid_input($value[0]);
						$oWtr->Lines->Quantity = $value[2];
						$oWtr->Lines->MeasureUnit = valid_input($value[3]);
						//$oWtr->Lines->UnitPrice = $value[1]; 
						$oWtr->Lines->DiscountPercent = $value[4];
						
						
						$oWtr->Lines->FromWarehouseCode = $value[6];
						$oWtr->Lines->WarehouseCode = $value[7];
					
				
						$oWtr->Lines->Add();
				
					
					
				}
			} 
		
			$retval = $oWtr->Add();
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