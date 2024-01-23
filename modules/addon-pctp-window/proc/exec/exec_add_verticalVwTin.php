<?php
session_start();
include('../../../../config/config.php');
include('../../../connect/connect.php');
$userid = '';
$err = 0;
$errmsg = '';

$msgItem = '';
$msgBILLING = '';
$ItemPosted = 0;
$BILLINGPosted = 0;

$docentry = 0;
$rowdata = '';


$creator = $_SESSION['SESS_NAME'];


// $ClientReceivedDate = $_POST["U_ClientReceivedDate"];
// $ActualDateRec_Intitial =$_POST["U_ActualDateRec_Intitial"];
// $InitialHCRecDate =$_POST["U_InitialHCRecDate"];
$BookingId = utf8_decode($_POST['BookingId']);
$BookingDate=utf8_decode($_POST["BookingDate"]);
$CustomerName=utf8_decode($_POST["CustomerName"]);
$SAPClient=utf8_decode($_POST["SAPClient"]);
$GroupProject=utf8_decode($_POST["GroupProject"]);
$PlateNumber=utf8_decode($_POST["PlateNumber"]);
$VehicleTypeCap=utf8_decode($_POST["VehicleTypeCap"]);
$DeliveryOrigin=utf8_decode($_POST["DeliveryOrigin"]);
$Destination=utf8_decode($_POST["Destination"]);
$DeliveryStatus=utf8_decode($_POST["DeliveryStatus"]);
$DeliveryDatePOD=utf8_decode($_POST["DeliveryDatePOD"]);
$TripType=utf8_decode($_POST["TripType"]);
// $TripTicketNo=utf8_decode($_POST["TripTicketNo"]);
$WayBillNo=utf8_decode($_POST["WayBillNo"]);
$ShipmentManifestNo=utf8_decode($_POST["ShipmentManifestNo"]);
$DeliveryReceiptNo=utf8_decode($_POST["DeliveryReceiptNo"]);
$SeriesNo=utf8_decode($_POST["SeriesNo"]);
$OtherPODDoc=utf8_decode($_POST["OtherPODDoc"]);
$RemarksPOD=utf8_decode($_POST["RemarksPOD"]);
$Remarks=utf8_decode($_POST["Remarks"]);
// $txtStreetPOBoxB=utf8_decode($_POST["txtStreetPOBoxB"]);
$ActualHCRecDate=utf8_decode($_POST["ActualHCRecDate"]);
$PODinCharge=utf8_decode($_POST["PODinCharge"]);
$VerifiedDateHC=utf8_decode($_POST["VerifiedDateHC"]);
$PODStatusDetail=utf8_decode($_POST["PODStatusDetail"]);
$PTFNo=utf8_decode($_POST["PTFNo"]);
$DateForwardedBT=utf8_decode($_POST["DateForwardedBT"]);
$BillingDeadline=utf8_decode($_POST["BillingDeadline"]);
$BillingStatus=utf8_decode($_POST["BillingStatus"]);
$ServiceType=utf8_decode($_POST["ServiceType"]);
$SINo=utf8_decode($_POST["SINo"]);
$BillingTeam=utf8_decode($_POST["BillingTeam"]);
$BTRemarks=utf8_decode($_POST["BTRemarks"]);
$GrossInitialRate=utf8_decode($_POST["GrossInitialRate"]);
$Demurrage=utf8_decode($_POST["Demurrage"]);
$AddCharges=utf8_decode($_POST["AddCharges"]);
$ActualBilledRate=utf8_decode($_POST["ActualBilledRate"]);
$RateAdjustments=utf8_decode($_POST["RateAdjustments"]);
$ActualDemurrage=utf8_decode($_POST["ActualDemurrage"]);
$ActualAddCharges=utf8_decode($_POST["ActualAddCharges"]);
$TotalRecClients=utf8_decode($_POST["TotalRecClients"]);
$CWT2307=utf8_decode($_POST["CWT2307"]);
$TotalAR=utf8_decode($_POST["TotalAR"]);
$VarAR=utf8_decode($_POST["VarAR"]);
$OutletNo=utf8_decode($_POST["OutletNo"]);
$CBM=utf8_decode($_POST["CBM"]);
$SI_DRNo=utf8_decode($_POST["SI_DRNo"]);
$DeliveryMode=utf8_decode($_POST["DeliveryMode"]);
$SourceWhse=utf8_decode($_POST["SourceWhse"]);
$DestinationClient=utf8_decode($_POST["DestinationClient"]);
$TotalInvAmount=utf8_decode($_POST["TotalInvAmount"]);
$SONo=utf8_decode($_POST["SONo"]);
$NameCustomer=utf8_decode($_POST["NameCustomer"]);
$CategoryDR=utf8_decode($_POST["CategoryDR"]);
$ForwardLoadNo=utf8_decode($_POST["ForwardLoadNo"]);
$BackLoad=utf8_decode($_POST["BackLoad"]);
$IDNumber=utf8_decode($_POST["IDNumber"]);
$TypeOfAccessorial=utf8_decode($_POST["TypeOfAccessorial"]);
$Status=utf8_decode($_POST["Status"]);
$TimeInEmptyDem=utf8_decode($_POST["TimeInEmptyDem"]);
$TimeOutEmptyDem=utf8_decode($_POST["TimeOutEmptyDem"]);
$VerifiedEmptyDem=utf8_decode($_POST["VerifiedEmptyDem"]);
$TimeInAdvLoading=utf8_decode($_POST["TimeInAdvLoading"]);
$DayOfTheWeek=utf8_decode($_POST["DayOfTheWeek"]);
$TimeIn=utf8_decode($_POST["TimeIn"]);
$TimeOut=utf8_decode($_POST["TimeOut"]);
$TotalExceed=utf8_decode($_POST["TotalExceed"]);
$ODOIn=utf8_decode($_POST["ODOIn"]);
$ODOOut=utf8_decode($_POST["ODOOut"]);
$TotalUsage=utf8_decode($_POST["TotalUsage"]);
// $RowNoVertical=utf8_decode($_POST["RowNoVertical"]);
// $TripTicketNo=utf8_decode($_POST["TripTicketNo"]);


$GrossInitialRate = 0;
$ActualBilledRate = 0;
$RateAdjustments = 0;
$ActualDemurrage = 0;
$ActualAddCharges = 0;
$TotalRecClients = 0;
// $CheckingTotalBilled = 0;
// $Checking = 0;
$TotalInvAmount = 0;
$Demurrage = 0;
$AddCharges = 0;
$CWT2307 = 0;
$NoOfDrops = 0;
$TotalExceed = 0;
$TotalUsage = 0;
$TotalAR = 0; 
$VarAR = 0;



					try{

					$PODNum = '';


				$qry2 = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 


						UPDATE [dbo].[@PCTP_BILLING] SET 

						
						
						
						U_ForwardLoad = '$ForwardLoadNo',
						U_BookingId = '$BookingId',
						U_BookingDate = '$BookingDate',
						U_CustomerName = '$CustomerName',
						U_SAPClient = '$SAPClient',
						U_GroupProject = '$GroupProject',
						U_PlateNumber = '$PlateNumber',
						U_VehicleTypeCap = '$VehicleTypeCap',
						U_DeliveryOrigin = '$DeliveryOrigin',
						U_Destination = '$Destination',
						U_DeliveryStatus = '$DeliveryStatus',
						U_DeliveryDatePOD = '$DeliveryDatePOD',
						U_TripType = '$TripType',
						
						U_WaybillNo = '$WayBillNo',
						U_ShipmentManifestNo = '$ShipmentManifestNo',
						U_DeliveryReceiptNo = '$DeliveryReceiptNo',
						U_SeriesNo  = '$SeriesNo',
						U_OtherPODDoc = '$OtherPODDoc',
						U_RemarksPOD = '$RemarksPOD',
						U_ActualHCRecDate = '$ActualHCRecDate',
						U_PODinCharge = '$PODinCharge',
						U_VerifiedDateHC = '$VerifiedDateHC',
						U_PODStatusDetail = '$PODStatusDetail',
						U_PTFNo = '$PTFNo',
						U_DateForwardedBT = '$DateForwardedBT',
						U_BillingDeadline = '$BillingDeadline',
						U_BillingStatus = '$BillingStatus',
						U_ServiceType = '$ServiceType',
						U_SINo = '$SINo',
						U_BillingTeam = '$BillingTeam',
						U_BTRemarks = '$BTRemarks',
						U_GrossInitialRate = $GrossInitialRate,
						U_Demurrage= $Demurrage,
						U_AddCharges= $AddCharges,
						U_ActualBilledRate= $ActualBilledRate,
						U_RateAdjustments = $RateAdjustments,
						U_ActualDemurrage = $ActualDemurrage,
						U_ActualAddCharges = $ActualAddCharges,
						U_TotalRecClients = $TotalRecClients,
						U_CWT2307 = '$CWT2307',
						U_TotalAR = $TotalAR,
						U_VarAR = $VarAR,
						U_OutletNo = '$OutletNo',
						U_CBM = '$CBM',
						U_SI_DRNo = '$SI_DRNo',
						U_DeliveryMode = '$DeliveryMode',
						U_SourceWhse = '$SourceWhse',
						U_DestinationClient = '$DestinationClient',
						U_TotalInvAmount = $TotalInvAmount,
						U_SONo = '$SONo',
						U_NameCustomer= '$NameCustomer',
						U_CategoryDR = '$CategoryDR',
						U_BackLoad = '$BackLoad',
						U_IDNumber = '$IDNumber',
						U_TypeOfAccessorial = '$TypeOfAccessorial',
						U_Status = '$Status',
						U_TimeInEmptyDem = '$TimeInEmptyDem',
						U_TimeOutEmptyDem = '$TimeOutEmptyDem',
						U_VerifiedEmptyDem = '$VerifiedEmptyDem',
						U_Remarks = '$Remarks',
						U_TimeInAdvLoading = '$TimeInAdvLoading',
						U_DayOfTheWeek = '$DayOfTheWeek',
						U_TimeIn = '$TimeIn',
						U_TimeOut = '$TimeOut',
						U_TotalExceed = $TotalExceed,
						U_ODOIn = '$ODOIn',
						U_ODOOut = '$ODOOut',
						U_TotalUsage = $TotalUsage
						
             



						WHERE U_BookingId = '$BookingId'


					");
odbc_free_result($qry2);

	
				$BILLINGPosted +=1;
				$msgBILLING= 'Billing Posted';
			}
		 catch (Exception $e) {


			 	$msgBILLING = 'Billing Not Posted';
			
			}





			
		
			
odbc_close($MSSQL_CONN);



				
	if ($err == 0) 
	{

		$data = array("valid"=>true, 
							"loggedIn" => 'Logged In!',
							"msg" => $msgBILLING,
							"ItemPosted"=>$ItemPosted,
							"BILLINGPosted"=>$BILLINGPosted,
							"BILLINGData"=>$BookingId

						);
		echo json_encode($data);
	}
	else
	{
		$data = array("valid"=>false, "msg"=>$errmsg);
		echo json_encode($data);
	}

?>