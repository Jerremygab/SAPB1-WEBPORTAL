<?php
$err = 0;
$errmsg = '';
session_start();
include('../../../../config/config.php');

$Database = $_SESSION['MSSQL_DB'];

if($Database == 'EBI_LIVEDB20220217'){
	$err += 1;
}

$docentry = '';



$json = $_POST['json'];
$jsonCheck =  $_POST['jsonCheck'];
$txtSeriesOVPM = $_POST['txtSeriesOVPM'];

$txtCardCode = $_POST['txtCardCode'];
$txtCashGLCode = $_POST['txtCashGLCode'];
$txtCashAmount = $_POST['txtCashAmount'];
$txtTransferGLCode = $_POST['txtTransferGLCode'];
$txtTransferDate = $_POST['txtTransferDate'];
$txtTransferRef = $_POST['txtTransferRef'];
$txtTransferAmount = $_POST['txtTransferAmount'];
$txtPostingDate = $_POST['txtPostingDate'];
$txtDeliveryDate = $_POST['txtDeliveryDate'];
$txtDocumentDate = $_POST['txtDocumentDate'];
$txtRemarks = $_POST['txtRemarks'];
$txtReference = $_POST['txtReference'];
$txtToOrderOf = $_POST['txtToOrderOf'];
$txtPayTo = $_POST['txtPayTo'];
$selTransactionType = $_POST['selTransactionType'];
$txtPayNoDoc = $_POST['txtPayNoDoc'];
$txtGLCodePayNoDoc = $_POST['txtGLCodePayNoDoc'];
// $txtAcctName = $_POST['acctName'];
// $txtAcctNumber = $_POST['acctNumber'];
$txtCheckAmountTotal = $_POST['txtCheckAmountTotal'];
$udfJson = $_POST['udfJson'];
$Cash = 0.00;


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
			
			if($selTransactionType == 'S') {
				if($txtPayNoDoc == 'Y'){
					$oRdr->CardCode = $txtCardCode;
					

				}
				else{
					$oRdr->CardCode = $txtCardCode;
				}
			}
			else{
				$oRdr->DocType = 1;
				$oRdr->CardName = $txtToOrderOf;
				$oRdr->Address = $txtPayTo;
			}
			
			// txtPostingDate
			// txtDeliveryDate
			// txtDocumentDate

			$oRdr->DocDate = $txtPostingDate;
			$oRdr->DueDate = $txtDeliveryDate;
			$oRdr->TaxDate = $txtDocumentDate;

  			$oRdr->CounterReference = $txtReference;
		
			//$oRdr->Series = $txtSeriesOVPM;
			$oRdr->Remarks = $txtRemarks;
			

			if($txtPayNoDoc == 'Y'){
				$oRdr->ControlAccount = $txtGLCodePayNoDoc;

				}

				$udfJson = json_decode(stripslashes($udfJson));
				foreach ($udfJson as $key => $value) 
				{
					$oRdr->UserFields->Fields[$value[1]]->Value = $value[0];
				}
			
		
			
			if($txtPayNoDoc == 'N'){
			if(json_decode($json) != null) 
			{
				if($selTransactionType == 'S') {
					$json = json_decode($json, true);
					$ctr = 0;
				 	foreach ($json as $key => $value) {
					//for ($x = 0; $x <= $lengthCardCode; $x++) {
						
						$oRdr->Invoices->DocEntry = $value[0];
						$oRdr->Invoices->SumApplied = $value[1];
						if($value[2] == 'PU'){
							$oRdr->Invoices->InvoiceType = 18;
						}
						else if($value[2] == 'PC'){
							$oRdr->Invoices->InvoiceType = 19;
						}
						else if($value[2] == 'DT'){
							$oRdr->Invoices->InvoiceType = 204;
						}
						// $oRdr->Invoices->DistributionRule = $value[3];
						// $oRdr->Invoices->DistributionRule2 = $value[4];
						// $oRdr->Invoices->DistributionRule3 = $value[5];
							
							
						

		               				
						$oRdr->Invoices->Add();
					}		
				} 
				else{

					// glaccount
					// docremarks
					// price
					// taxcode
					// grossprice
					// ocrcode
					// ocrcode2
					// ocrcode3


					$json = json_decode($json, true);
					$ctr = 0;
						foreach ($json as $key => $value) {
						$oRdr->AccountPayments->AccountCode = $value[0];
						$oRdr->AccountPayments->Decription = $value[1];
						$oRdr->AccountPayments->SumPaid = $value[2];
						$oRdr->AccountPayments->VatGroup = $value[3];
						$oRdr->AccountPayments->GrossAmount = $value[4];
						$oRdr->AccountPayments->ProfitCenter = $value[5];
						$oRdr->AccountPayments->ProfitCenter2 = $value[6];
						$oRdr->AccountPayments->ProfitCenter3 = $value[7];
						$oRdr->AccountPayments->VatAmount = $value[8];

	
						


						$oRdr->AccountPayments->Add();
						
					}
				}
			}
		}
			//CHECKS
			if($txtCheckAmountTotal > 0){
				if(json_decode($jsonCheck) != null) 
				{
					// duedate
					// checkamount
					// bankcode
					// branch
					// account
					// checkno
					// glAcctCheck

						$jsonCheck = json_decode($jsonCheck, true);
						$ctr = 0;
					 	foreach ($jsonCheck as $key => $value) {

				            $oRdr->Checks->DueDate = $value[0];
				            $oRdr->Checks->CheckSum = $value[1];
				            $oRdr->Checks->BankCode = $value[2];
				            $oRdr->Checks->Branch = $value[3];
				            $oRdr->Checks->AccounttNum = $value[4];
				            $oRdr->Checks->CheckNumber = $value[5];
							$oRdr->CheckAccount = $value[6];
				           //$oRdr->Checks->CountryCode = $checkcountry;
				            $oRdr->Checks->Add();
							
						}		
				
				}

        	

		}
			
		//TRANSFER
			if($txtTransferGLCode != ''){
				$oRdr->TransferSum = $txtTransferAmount;
	  			$oRdr->TransferDate = $txtTransferDate;
	   			$oRdr->TransferAccount = $txtTransferGLCode;
	  			$oRdr->TransferReference = $txtTransferRef;
			}
				

		//CASH
			if($txtCashGLCode != ''){
				$oRdr->CashSum = $txtCashAmount;
    			$oRdr->CashAccount = $txtCashGLCode;	
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