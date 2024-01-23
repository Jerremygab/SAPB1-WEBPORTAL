<?php
$err = 0;
$errmsg = '';
session_start();
include('../../../../config/config.php');

$objSession = json_decode($_SESSION['ARInvoiceArr']);

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
// $txtCancellationDate  = $_POST['txtCancellationDate'];
// $txtRequiredDate = $_POST['txtRequiredDate'];
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

$refDocToObj = json_decode($_POST['refDocToObj']);
$objectType = $_POST['objectType'];
$baseType = $_POST['baseType'];
$childTable21 = $_POST['childTable21'];
$txtDocNum = $_POST['txtDocNum'];
$txtOwnerCode = $_SESSION['SESS_EMP'];

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
			$oRdr = $vCmp->GetBusinessObject($objSession->objectType);
		
			$oRdr->CardCode = $txtCardCode;
			$oRdr->TaxDate = $txtDocumentDate;
			$oRdr->DocDueDate = $txtDeliveryDate;
			$oRdr->DocDate = $txtPostingDate;
		
			$oRdr->NumAtCard  = $txtCustomerRefNo;
			
			$oRdr->Comments  = $txtRemarks;
		
			$oRdr->DocumentsOwner  = $txtOwnerCode;
			
			//$oRdr->BPL_IDAssignedToInvoice  = 52;
			

		
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
							$oRdr->Lines->BaseType = $baseType; 
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
			
						
				

			
			
						
				


						// $oRdr->Lines->ItemCode = '1000001505';
						// $oRdr->Lines->Quantity = 1;
						// $oRdr->Lines->UnitPrice = 491.07;

						// //$oRdr->Lines->PriceAfterVAT = 492.86 + 35.71; 
						

						// $oRdr->Lines->VatGroup = 'OVAT-N';
						// $oRdr->Lines->TaxTotal = 58.93;
						

						// $oRdr->Lines->Add();

						// //-------------------------------------------

						// $oRdr->Lines->ItemCode = 'DISC';
						// $oRdr->Lines->Quantity = 1;
						// $oRdr->Lines->UnitPrice = -35.71;

						// //$oRdr->Lines->PriceAfterVAT = -35.71; 
						

						// $oRdr->Lines->VatGroup = 'OVAT-E';
						

						// $oRdr->Lines->Add();
					
					
					
				
		
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
	updateRefDocModal($MSSQL_CONN, $MSSQL_DB, $refDocToObj, $childTable21, $txtDocNum, $objectType);
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

function updateRefDocModal($MSSQL_CONN, $MSSQL_DB, $refDocToObj, $childTable21, $txtDocNum, $objectType){
	
	if (count($refDocToObj->add) > 0) {
		foreach ($refDocToObj->add as $item) {
			if ($item->RefTable->objectType == -1) {
				$addQry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
					INSERT INTO $childTable21
						(DocEntry, ObjectType, LineNum, ExtDocNum, RefObjType, AccessKey, IssueDate, IssuerCNPJ, IssuerCode, Model, Series, RefAccKey, RefAmount, SubSeries, Remark, LinkRefTyp)
					VALUES
						($txtDocNum, $objectType, $item->LineNum, NULLIF('$item->ExtDocNum', ''), {$item->RefTable->objectType}, '', (CASE WHEN '$item->IssueDate' = '' THEN NULL ELSE CONVERT(datetime, '$item->IssueDate') END), '', '', '', '', '', 0.00, '', '$item->Remark', '00')
				");
			} else {
				$addQry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
					INSERT INTO $childTable21
						(DocEntry, ObjectType, LineNum, RefDocEntr, RefDocNum, ExtDocNum, RefObjType, IssueDate, Model, RefAccKey, RefAmount, Remark, LinkRefTyp)
					VALUES
						($txtDocNum, $objectType, $item->LineNum, $item->RefDocNum, $item->RefDocNum, '', {$item->RefTable->objectType}, (SELECT DocDate FROM {$item->RefTable->objectTable} WHERE DocEntry = $item->RefDocNum), 0, '', 0.00, NULLIF('$item->Remark', ''), '00')
				");
			}
			odbc_free_result($addQry);
		}

	}
}

?>