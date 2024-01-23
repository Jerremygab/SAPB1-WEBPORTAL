<?php
$err = 0;
$errmsg = '';
session_start();
include('../../../../config/config.php');

$docentry = '';

$txtDocNum  =  $_POST["txtDocNum"];
$txtCardCode = $_POST['txtCardCode'];
$txtPostingDate  = $_POST['txtPostingDate'];
$txtDeliveryDate  = $_POST['txtDeliveryDate'];
$txtDocumentDate  = $_POST['txtDocumentDate'];
$txtContactPerson   = $_POST['txtContactPerson'];
$txtCustomerRefNo  = $_POST['txtCustomerRefNo'];
$txtSalesEmpCode  = $_POST['txtSalesEmpCode'];
$txtOwnerCode  = $_POST['txtOwnerCode'];
$txtRemarks = $_POST['txtRemarks'];
$selShipToAddress  = $_POST['selShipToAddress'];
$selBillToAddress  = $_POST['selBillToAddress'];
$txtJournalMemo  = $_POST['txtJournalMemo'];
$txtPaymentTermsCode = $_POST['txtPaymentTermsCode'];
$txtCancellationDate  = $_POST['txtCancellationDate'];
$txtRequiredDate = $_POST['txtRequiredDate'];
//$txtTinNumber = $_POST['txtTinNumber'];

$txtFooterDiscountPercentage = $_POST['txtFooterDiscountPercentage'];

$txtStreetPOBoxS = $_POST['txtStreetPOBoxS'];
$txtCityS = $_POST['txtCityS'];
$txtZipCodeS = $_POST['txtZipCodeS'];
$txtCountryS = $_POST['txtCountryS'];
$txtStreetPOBoxB = $_POST['txtStreetPOBoxB'];
$txtCityB = $_POST['txtCityB'];
$txtZipCodeB = $_POST['txtZipCodeB'];
$txtCountryB = $_POST['txtCountryB'];
$selShippingType = $_POST['selShippingType'];

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
			$oRdr = $vCmp->GetBusinessObject(17);
			$oRdr->GetByKey($txtDocNum);
			
			$oRdr->TaxDate = $txtDocumentDate;
			$oRdr->DocDueDate = $txtDeliveryDate;
			$oRdr->DocDate = $txtPostingDate;
			$oRdr->ContactPersonCode = $txtContactPerson;
			
			$oRdr->NumAtCard  = $txtCustomerRefNo;
			
			$oRdr->Comments  = $txtRemarks;
			$oRdr->SalesPersonCode  = $txtSalesEmpCode;
			//$oRdr->DocumentsOwner  = $txtOwnerCode;
			$oRdr->DiscountPercent  = $txtFooterDiscountPercentage;
			
			
			$oRdr->ShipToCode = $selShipToAddress;
			$oRdr->PayToCode = $selBillToAddress;
			
			$oRdr->JournalMemo = $txtJournalMemo;
			$oRdr->PaymentGroupCode = $txtPaymentTermsCode;
			$oRdr->CancelDate = $txtCancellationDate;
			$oRdr->RequriedDate = $txtRequiredDate;
			
			$txtFooterDiscountPercentage = $txtFooterDiscountPercentage == "" ? 0 : $txtFooterDiscountPercentage;
			$oRdr->DiscountPercent = $txtFooterDiscountPercentage;
			
			$serviceType2 = $serviceType == "I" ? 0 : 1;
			$oRdr->DocType = $serviceType2;
			
			if($selShippingType != ''){
				$oRdr->TransportationCode = $selShippingType;
			}
			$oRdr->AddressExtension->ShipToStreet = $txtStreetPOBoxS;
			$oRdr->AddressExtension->ShipToCity = $txtCityS;
			$oRdr->AddressExtension->ShipToZipCode = $txtZipCodeS;
			$oRdr->AddressExtension->ShipToCountry = $txtCountryS;
			$oRdr->AddressExtension->BillToStreet = $txtStreetPOBoxB;
			$oRdr->AddressExtension->BillToCity = $txtCityB;
			$oRdr->AddressExtension->BillToZipCode = $txtZipCodeB;
			$oRdr->AddressExtension->BillToCountry = $txtCountryB;
			
				
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
			
			if(json_decode($json) != null) 
			{
				$json = json_decode($json, true);
				$ctr = -1;
				$a = 0;
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
						$oRdr->Lines->SetCurrentLine($a);
						
						$oRdr->Lines->ItemCode = valid_input($value[0]);
						$oRdr->Lines->Quantity = $value[2];
						$oRdr->Lines->UoMEntry = $value[3];
						$oRdr->Lines->UnitPrice = $value[1]; 
						$oRdr->Lines->DiscountPercent = $value[4];
						$oRdr->Lines->VatGroup = $value[5];
					
						$oRdr->Lines->Add();
						
					
					}
					else{
						$value[4] = $value[4] == "" ? 0 : $value[4];
						
						$oRdr->Lines->ItemDescription = $value[0];
						$oRdr->Lines->AccountCode = $value[1];
						$oRdr->Lines->Quantity = $value[2];
						$oRdr->Lines->UoMEntry = valid_input($value[3]);
						$oRdr->Lines->UnitPrice = $value[1]; 
						$oRdr->Lines->DiscountPercent = $value[4];
						$oRdr->Lines->VatGroup = $value[5];
					
				
						$oRdr->Lines->Add();
					
					}
					
					$a++;
				}
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