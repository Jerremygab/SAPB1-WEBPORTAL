<?php
session_start();
include('../../../../config/config.php');
include('../../../connect/connect.php');
$userid = '';
$err = 0;
$errmsg = '';

$msgItem = '';
$msgTP = '';
$ItemPosted = 0;
$TPPosted = 0;

$docentry = 0;
$rowdata = '';


$creator = $_SESSION['SESS_NAME'];



	  

$BookingId = utf8_decode($_POST['BookingId']);
$BookingDate=utf8_decode($_POST["BookingDate"]);
$ClientName=utf8_decode($_POST["ClientName"]);
$TruckerName=utf8_decode($_POST["TruckerName"]);
$DeliveryStatus=utf8_decode($_POST["DeliveryStatus"]);
$Remarks=utf8_decode($_POST["Remarks"]);
$WaybillNo=utf8_decode($_POST["WaybillNo"]);
$DeliveryReceiptNo=utf8_decode($_POST["DeliveryReceiptNo"]);
$SeriesNo=utf8_decode($_POST["SeriesNo"]);
$OtherPODDoc=utf8_decode($_POST["OtherPODDoc"]);
$TruckerSAP=utf8_decode($_POST["TruckerSAP"]);
// $txtStreetPOBoxB=utf8_decode($_POST["txtStreetPOBoxB"]);
$DeliveryDatePOD=utf8_decode($_POST["DeliveryDatePOD"]);
$ShipmentManifestNo=utf8_decode($_POST["ShipmentManifestNo"]);
$TPincharge=utf8_decode($_POST["TPincharge"]);
$Aging=utf8_decode($_POST["Aging"]);
$GrossTruckerRates=utf8_decode($_POST["GrossTruckerRates"]);
$GrossTruckerRatesN=utf8_decode($_POST["GrossTruckerRatesN"]); 
$RateBasis=utf8_decode($_POST["RateBasis"]);
$TaxType=utf8_decode($_POST["TaxType"]);
$Demurrage=utf8_decode($_POST["Demurrage"]);
$AddtlDrop=utf8_decode($_POST["AddtlDrop"]);
$BoomTruck=utf8_decode($_POST["BoomTruck"]);
$Manpower=utf8_decode($_POST["Manpower"]);
$BackLoad=utf8_decode($_POST["BackLoad"]);
$Addtlcharges=utf8_decode($_POST["Addtlcharges"]);
$DemurrageN=utf8_decode($_POST["DemurrageN"]);
$AddtlChargesN=utf8_decode($_POST["AddtlChargesN"]);
$ActualRates=utf8_decode($_POST["ActualRates"]);
$ActualDemurrage=utf8_decode($_POST["ActualDemurrage"]);
$ActualCharges=utf8_decode($_POST["ActualCharges"]);
$BoomTruck2=utf8_decode($_POST["BoomTruck2"]);
$OtherCharges=utf8_decode($_POST["OtherCharges"]);
$TotalSubPenalty=utf8_decode($_POST["TotalSubPenalty"]);
$TotalPenaltyWaived=utf8_decode($_POST["TotalPenaltyWaived"]);
$TotalPenalty=utf8_decode($_POST["TotalPenalty"]);
$CAandDP=utf8_decode($_POST["CAandDP"]);
$Interest=utf8_decode($_POST["Interest"]);
$OtherDeductions=utf8_decode($_POST["OtherDeductions"]);
$TOTALDEDUCTIONS=utf8_decode($_POST["TOTALDEDUCTIONS"]);
$REMARKS1=utf8_decode($_POST["REMARKS1"]);
$TotalPayable=utf8_decode($_POST["TotalPayable"]);
$EWT2307=utf8_decode($_POST["EWT2307"]);
$TotalAP=utf8_decode($_POST["TotalAP"]);
$RateAdjustments=utf8_decode($_POST["RateAdjustments"]);
$VarTP=utf8_decode($_POST["VarTP"]);
$TotalPayableRec=utf8_decode($_POST["TotalPayableRec"]);
$PVNo=utf8_decode($_POST["PVNo"]);
$ORRefNo=utf8_decode($_POST["ORRefNo"]);
$ActualPaymentDate=utf8_decode($_POST["ActualPaymentDate"]);
$PaymentReference=utf8_decode($_POST["PaymentReference"]);
$PaymentStatus=utf8_decode($_POST["PaymentStatus"]);
$Remarks=utf8_decode($_POST["Remarks"]);
$RowNoVertical=utf8_decode($_POST["RowNoVertical"]);
$TPStatus=utf8_decode($_POST["TPStatus"]);

$GrossTruckerRates = 0;
$GrossTruckerRatesN = 0;
$ActualRates = 0;
$RateAdjustments = 0;
$ActualDemurrage = 0;
$OtherCharges = 0;
$TotalSubPenalty = 0;
$TotalPenaltyWaived = 0;
$TotalPenalty = 0;
$CAandDP = 0;
$Interest = 0;
$OtherDeductions = 0;
$TOTALDEDUCTIONS = 0;
$TotalPayable = 0;
$EWT2307 = 0;
$TotalAP = 0;
$TotalPayableRec = 0;



					try{

					$PODNum = '';


				$qry2 = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 


						UPDATE [dbo].[@PCTP_TP] SET 

						U_BookingId = '$BookingId',
						U_BookingDate   = '$BookingDate',
						U_ClientName  = '$ClientName',
                        U_TruckerName = '$TruckerName',
						U_TruckerSAP = '$TruckerSAP', 
                        U_DeliveryStatus = '$DeliveryStatus',
						U_DeliveryDatePOD = '$DeliveryDatePOD',
						U_WaybillNo = '$WaybillNo',
						U_ShipmentManifestNo = '$ShipmentManifestNo', 
						U_DeliveryReceiptNo = '$DeliveryReceiptNo',
                        U_SeriesNo = '$SeriesNo',
						U_OtherPODDoc = '$OtherPODDoc',
                        U_TPincharge = '$TPincharge',
                        U_Aging = '$Aging',
                        U_GrossTruckerRates = $GrossTruckerRates,
                        U_GrossTruckerRatesN = $GrossTruckerRatesN,
                        U_RateBasis = '$RateBasis',
                        U_TaxType = '$TaxType',
                        U_Demurrage = '$Demurrage',
                        U_AddtlDrop = '$AddtlDrop',
                        U_BoomTruck = '$BoomTruck',
                        U_Manpower = '$Manpower',
                        U_BackLoad = '$BackLoad',
                        U_Addtlcharges = $Addtlcharges,
                        U_DemurrageN = '$DemurrageN',
                        U_AddtlChargesN = '$AddtlChargesN',
                        U_ActualRates = '$ActualRates',
                        U_RateAdjustments = '$RateAdjustments',
                        U_ActualDemurrage = '$ActualDemurrage',
                        U_ActualCharges = '$ActualCharges',
                        U_BoomTruck2 = '$BoomTruck2',
                        U_OtherCharges = $OtherCharges,       
                        U_TotalSubPenalty = $TotalSubPenalty,    
                        U_TotalPenaltyWaived = $TotalPenaltyWaived,     
                        U_TotalPenalty  = $TotalPenalty,
                        U_CAandDP = $CAandDP,    
                        U_Interest = $Interest,    
                        U_OtherDeductions = $OtherDeductions,    
                        U_TOTALDEDUCTIONS = $TOTALDEDUCTIONS,     
                        U_REMARKS1 = '$REMARKS1',
                        U_TotalPayable = $TotalPayable,    
                        U_EWT2307 = $EWT2307,          
                        U_TotalAP = $TotalAP,   
                        U_VarTP = '$VarTP',
                        U_TotalPayableRec = $TotalPayableRec,   
                        U_PVNo = '$PVNo',
                        U_ORRefNo = '$ORRefNo',
                        U_ActualPaymentDate = '$ActualPaymentDate',
                        U_PaymentReference = '$PaymentReference',
                        U_PaymentStatus = '$PaymentStatus',
                        U_Remarks = '$Remarks',
                        U_TPStatus = '$TPStatus'
                        
						WHERE U_BookingId = '$BookingId'


					");
odbc_free_result($qry2);

	
				$TPPosted +=1;
				$msTP = 'TP Posted';
			}
		 catch (Exception $e) {


			 	$msgTP = 'TP Not Posted';
			
			}





			
		
			
odbc_close($MSSQL_CONN);



				
	if ($err == 0) 
	{

		$data = array("valid"=>true, 
							"loggedIn" => 'Logged In!',
							"msg" => $msgTP,
							"ItemPosted"=>$ItemPosted,
							"TPPosted"=>$TPPosted,
							"tpData"=>$BookingId

						);
		echo json_encode($data);
	}
	else
	{
		$data = array("valid"=>false, "msg"=>$errmsg);
		echo json_encode($data);
	}

?>