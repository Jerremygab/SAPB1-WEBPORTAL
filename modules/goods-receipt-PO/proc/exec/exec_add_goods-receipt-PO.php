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
			$oRdr = $vCmp->GetBusinessObject(20);
		
			$oRdr->CardCode = $txtCardCode;
			$oRdr->TaxDate = $txtDocumentDate;
			$oRdr->DocDueDate = $txtDeliveryDate;
			$oRdr->DocDate = $txtPostingDate;
			if($txtContactPerson != ''){
				$oRdr->ContactPersonCode = $txtContactPerson;
			}
			
			$oRdr->NumAtCard  = $txtCustomerRefNo;
			
			$oRdr->Comments  = $txtRemarks;
			if($txtSalesEmpCode != ''){
				$oRdr->SalesPersonCode  = $txtSalesEmpCode;
			}
			
			$oRdr->DocumentsOwner  = $txtOwnerCode;
			
			
			$oRdr->ShipToCode = $selShipToAddress;
			$oRdr->PayToCode = $selBillToAddress;
			
			$oRdr->JournalMemo = $txtJournalMemo;
			if($txtPaymentTermsCode != ''){
				$oRdr->PaymentGroupCode = $txtPaymentTermsCode;
			}
			$oRdr->CancelDate = $txtCancellationDate;
			$oRdr->RequriedDate = $txtRequiredDate;
			
			$txtFooterDiscountPercentage = $txtFooterDiscountPercentage == "" ? 0 : $txtFooterDiscountPercentage;
			$oRdr->DiscountPercent = $txtFooterDiscountPercentage;
			
			$serviceType2 = $serviceType == "I" ? 0 : 1;
			$oRdr->DocType = $serviceType2;
			
			$udfJson = json_decode(stripslashes($udfJson));
				foreach ($udfJson as $key => $value) 
				{
					$oRdr->UserFields->Fields[$value[1]]->Value = $value[0];
				}
			
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
			
			
			
			
			
			if(json_decode($json) != null) 
			{
				$json = json_decode($json, true);
				//$ctr = -1;
				//$a = 0;
				foreach ($json as $key => $value) 
				{
					if ($serviceType == 'I') 
					{
						
						
						//make it better
						//$discount = $value[9] == "" ? ($value[9] / $value[12]) : 0;
						$value[4] = $value[4] == "" ? 0 : $value[4];
						
						
					
						if ($value[6] != '') 
						{
							$oRdr->Lines->BaseEntry = $value[6];
							$oRdr->Lines->BaseLine = $value[7];
							$oRdr->Lines->BaseType = 22; 
						}
						
						if($value[19] == 'B'){
							$batchCode = explode(",",$value[8]);
							$batchQTY = explode(",",$value[9]);
							$batchExpDate = explode(",",$value[11]);
							$batchMfrDate = explode(",",$value[12]);
							$batchAdminDate = explode(",",$value[13]);
							$batchLocation = explode(",",$value[14]);
							$batchDetails = explode(",",$value[15]);
							
							$length = count($batchCode);
							for($x = 0; $x < $length; $x++){
								$oRdr->Lines->BatchNumbers->SetCurrentLine($x);
								$oRdr->Lines->BatchNumbers->BatchNumber = $batchCode[$x];
								$oRdr->Lines->BatchNumbers->Quantity = $batchQTY[$x];
								if($value[11] != ''){
									$oRdr->Lines->BatchNumbers->ExpiryDate = $batchExpDate[$x];
								}
								if($value[12] != ''){
									$oRdr->Lines->BatchNumbers->ManufacturingDate = $batchMfrDate[$x];
								}
								$oRdr->Lines->BatchNumbers->AddmisionDate = $batchAdminDate[$x];
								
								$oRdr->Lines->BatchNumbers->Location = $batchLocation[$x];
								$oRdr->Lines->BatchNumbers->Notes = $batchDetails[$x];
								
								$oRdr->Lines->BatchNumbers->Add();
							}
						}
						else if($value[19] == 'S'){
							$mfrSerialCode = explode(",",$value[18]);
							$serialCode = explode(",",$value[8]);
							$serialQTY = explode(",",$value[9]);
							$serialExpDate = explode(",",$value[11]);
							$serialMfrDate = explode(",",$value[12]);
							$serialAdminDate = explode(",",$value[13]);
							$serialLocation = explode(",",$value[14]);
							$serialDetails = explode(",",$value[15]);
							
							$length = count($serialCode);
							for($x = 0; $x < $length; $x++){
								$oRdr->Lines->SerialNumbers->SetCurrentLine($x);
								$oRdr->Lines->SerialNumbers->ManufacturerSerialNumber = $mfrSerialCode[$x];
								$oRdr->Lines->SerialNumbers->InternalSerialNumber = $serialCode[$x];
								
								if($value[11] != ''){
									$oRdr->Lines->SerialNumbers->ExpiryDate = $serialExpDate[$x];
								}
								if($value[12] != ''){
									$oRdr->Lines->SerialNumbers->ManufactureDate = $serialMfrDate[$x];
								}
								$oRdr->Lines->SerialNumbers->ReceptionDate = $serialAdminDate[$x];
								
								$oRdr->Lines->SerialNumbers->Location = $serialLocation[$x];
								$oRdr->Lines->SerialNumbers->Notes = $serialDetails[$x];
								
								$oRdr->Lines->SerialNumbers->Add();
							}
						}
						
						$oRdr->Lines->ItemCode = valid_input($value[0]);
						$oRdr->Lines->Quantity = $value[2];
						$oRdr->Lines->UoMEntry = valid_input($value[3]);
						$oRdr->Lines->UnitPrice = $value[1]; 
						$oRdr->Lines->DiscountPercent = $value[4];
						$oRdr->Lines->VatGroup = $value[5];
						$oRdr->Lines->WarehouseCode = $value[17];
						
						$oRdr->Lines->Add();
					
					}
					else{
						$value[4] = $value[4] == "" ? 0 : $value[4];
						
						$oRdr->Lines->ItemDescription = $value[0];
						$oRdr->Lines->AccountCode = $value[1];
						$oRdr->Lines->Quantity = $value[3];
						//$oRdr->Lines->UoMEntry = valid_input($value[3]);
						$oRdr->Lines->UnitPrice = $value[2]; 
						$oRdr->Lines->DiscountPercent = $value[4];
						$oRdr->Lines->VatGroup = $value[5];
					
					
						$oRdr->Lines->Add();
					
					}
					
					
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