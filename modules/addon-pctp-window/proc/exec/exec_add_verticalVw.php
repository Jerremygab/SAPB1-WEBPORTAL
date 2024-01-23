<?php
session_start();
include('../../../../config/config.php');
include('../../../connect/connect.php');
$userid = '';
$err = 0;
$errmsg = '';

$msgItem = '';
$msgPOD = '';
$ItemPosted = 0;
$PODPosted = 0;

$docentry = 0;
$rowdata = '';


$creator = $_SESSION['SESS_NAME'];



	  

$BookingId = utf8_decode($_POST['BookingId']);
$BookingDate=utf8_decode($_POST["BookingDate"]);
$ClientName=utf8_decode($_POST["ClientName"]);

$SapClient=utf8_decode($_POST["SapClient"]);
$TruckerName=utf8_decode($_POST["TruckerName"]);
$SapTrucker=utf8_decode($_POST["SapTrucker"]);
$PlateNumber=utf8_decode($_POST["PlateNumber"]);
$Vehicletype=utf8_decode($_POST["Vehicletype"]);
$DeliveryOrigin=utf8_decode($_POST["DeliveryOrigin"]);
$TypeOfAccessorial=utf8_decode($_POST["TypeOfAccessorial"]);


$Destination=utf8_decode($_POST["Destination"]);


$DeliveryStatus=utf8_decode($_POST["DeliveryStatus"]);
$DeliveryDateDTR=utf8_decode($_POST["DeliveryDateDTR"]);

$NoOfDrops=utf8_decode($_POST["NoOfDrops"]);
$TripType=utf8_decode($_POST["TripType"]);
$Remarks=utf8_decode($_POST["Remarks"]);
$DocNum=utf8_decode($_POST["DocNum"]);
$BackLoad=utf8_decode($_POST["BackLoad"]);
$DeliveryDatePOD=utf8_decode($_POST["DeliveryDatePOD"]);

$TripTicketNo=utf8_decode($_POST["TripTicketNo"]);

$WayBillNo=utf8_decode($_POST["WayBillNo"]);

$ShipmentNo=utf8_decode($_POST["ShipmentNo"]);
$DeliveryReceiptNo=utf8_decode($_POST["DeliveryReceiptNo"]);
$SeriesNo=utf8_decode($_POST["SeriesNo"]);
$OtherPODDoc=utf8_decode($_POST["OtherPODDoc"]);
$RemarksPOD=utf8_decode($_POST["RemarksPOD"]);
$Receivedby=utf8_decode($_POST["Receivedby"]);


$ActualHCRecDate=utf8_decode($_POST["ActualHCRecDate"]);
$DateReturned=utf8_decode($_POST["DateReturned"]);
$PODinCharge=utf8_decode($_POST["PODinCharge"]);
$VerifiedDateHC=utf8_decode($_POST["VerifiedDateHC"]);
$ShiPODStatusDetailpmentNo=utf8_decode($_POST["ShiPODStatusDetailpmentNo"]);
$PTFNo=utf8_decode($_POST["PTFNo"]);
$DateForwardedBT=utf8_decode($_POST["DateForwardedBT"]);
$VERIFICATION_TAT=utf8_decode($_POST["VERIFICATION_TAT"]);
$POD_TAT=utf8_decode($_POST["POD_TAT"]);
$BillingDeadline=utf8_decode($_POST["BillingDeadline"]);
$BillingStatus=utf8_decode($_POST["BillingStatus"]);

$ServiceType=utf8_decode($_POST["ServiceType"]);
$SINo=utf8_decode($_POST["SINo"]);
$BillingTeam=utf8_decode($_POST["BillingTeam"]);
$BTRemarks=utf8_decode($_POST["BTRemarks"]);
$SOBNumber=utf8_decode($_POST["SOBNumber"]);
$OutletNo=utf8_decode($_POST["OutletNo"]);
$SI_DRNo=utf8_decode($_POST["SI_DRNo"]);
$CBM=utf8_decode($_POST["CBM"]);
$DeliveryMode=utf8_decode($_POST["DeliveryMode"]);
$SourceWhse=utf8_decode($_POST["SourceWhse"]);
$DestinationClient=utf8_decode($_POST["DestinationClient"]);
$TotalInvAmount=$_POST["TotalInvAmount"];
$NameCustomer=$_POST["NameCustomer"];
$CategoryDR=$_POST["CategoryDR"];
$ForwardLoad=$_POST["ForwardLoadNo"];
$SONo=$_POST["SONo"];
$IDNumber=$_POST["IDNumber"];
$ApprovalStatus=$_POST["ApprovalStatus"];
$TimeInEmptyDem=$_POST["TimeInEmptyDem"];
$TimeOutEmptyDem=$_POST["TimeOutEmptyDem"];
$VerifiedEmptyDem=$_POST["VerifiedEmptyDem"];
$Remarks2=$_POST["Remarks2"];
$TimeInAdvLoading=$_POST["TimeInAdvLoading"];
$DayOfTheWeek=$_POST["DayOfTheWeek"];
$TimeIn=$_POST["TimeIn"];
$TimeOut=$_POST["TimeOut"];
$U_ClientReceivedDate = $_POST["U_ClientReceivedDate"];
$U_ActualDateRec_Intitial =$_POST["U_ActualDateRec_Intitial"];
$U_InitialHCRecDate =$_POST["U_InitialHCRecDate"];
$TotalNoExceed=utf8_decode($_POST["TotalNoExceed"]);
$ODOIn=utf8_decode($_POST["ODOIn"]);
$ODOOut=utf8_decode($_POST["ODOOut"]);
$TotalUsage=utf8_decode($_POST["TotalUsage"]);
$ClientSubStatus=utf8_decode($_POST["ClientSubStatus"]);
$ClientSubOverdue=utf8_decode($_POST["ClientSubOverdue"]);
$ClientPenaltyCalc=utf8_decode($_POST["ClientPenaltyCalc"]);
$PODStatusPayment=utf8_decode($_POST["PODStatusPayment"]);
$PODSubmitDeadline=utf8_decode($_POST["PODSubmitDeadline"]);
$OverdueDays=utf8_decode($_POST["OverdueDays"]);
$InteluckPenaltyCalc=utf8_decode($_POST["InteluckPenaltyCalc"]);
$WaivedDays=utf8_decode($_POST["WaivedDays"]);
$HolidayOrWeekend=utf8_decode($_POST["HolidayOrWeekend"]);
$LostPenaltyCalc=utf8_decode($_POST["LostPenaltyCalc"]);
$PenaltiesManual=utf8_decode($_POST["PenaltiesManual"]);
$TotalSubPenalties=utf8_decode($_POST["TotalSubPenalties"]);
$Waived=utf8_decode($_POST["Waived"]);
$PercPenaltyCharge=utf8_decode($_POST["PercPenaltyCharge"]);
$Approvedby=utf8_decode($_POST["Approvedby"]);
$TotalPenaltyWaived=utf8_decode($_POST["TotalPenaltyWaived"]);
$RowNoVertical=utf8_decode($_POST["RowNoVertical"]);
$InterIsland=utf8_decode($_POST["InterIsland"]);
$ISLAND=utf8_decode($_POST["ISLAND"]);




$NoOfDrops = 0;
$VERIFICATION_TAT = 0;
$POD_TAT = 0;
$TotalNoExceed = 0;
$TotalUsage = 0;
$PenaltiesManual = 0;

// $U_ClientReceivedDate = date("Y-m-d");
// $U_ActualDateRec_Intitial = date("Y-m-d");
// $U_InitialHCRecDate = date("Y-m-d");
// $ActualHCRecDate = date("Y-m-d");
// $VerifiedDateHC = date("Y-m-d");
// $DateForwardedBT = date("Y-m-d");
// $DateReturned = date("Y-m-d");







					try{

					$PODNum = '';


				$qry2 = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 


						UPDATE [dbo].[@PCTP_POD] SET 

						
						U_BookingNumber = '$BookingId',
						U_TypeOfAccessorial = '$TypeOfAccessorial',
						U_ClientReceivedDate   = '$U_ClientReceivedDate',
						U_ActualDateRec_Intitial  = '$U_ActualDateRec_Intitial',
						U_InitialHCRecDate  = '$U_InitialHCRecDate',
						U_BookingDate = '$BookingDate',
						U_ClientName = '$ClientName',
						U_SAPClient = '$SapClient',
						U_TruckerName = '$TruckerName',
						U_DeliveryDatePOD = '$DeliveryDatePOD',
						
						U_SAPTrucker = '$SapTrucker',
						U_PlateNumber = '$PlateNumber',
						U_VehicleTypeCap = '$Vehicletype',
						U_DeliveryOrigin = '$DeliveryOrigin',
						U_Destination = '$Destination',

						U_IFINTERISLAND = '$InterIsland',
						U_ISLAND = '$ISLAND',
						U_DeliveryStatus = '$DeliveryStatus',
						U_DeliveryDateDTR = '$DeliveryDateDTR',
						U_NoOfDrops = $NoOfDrops,
						U_TripType = '$TripType',
						U_Remarks = '$Remarks',
						U_DocNum = '$DocNum',
						U_TripTicketNo = '$TripTicketNo',
						U_ShipmentNo = '$ShipmentNo',
						U_WaybillNo = '$WayBillNo',
						U_DeliveryReceiptNo = '$DeliveryReceiptNo',
						U_SeriesNo = '$SeriesNo',
						U_OtherPODDoc = '$OtherPODDoc',
						U_RemarksPOD = '$RemarksPOD',
						U_Receivedby = '$Receivedby',
						U_ActualHCRecDate = '$ActualHCRecDate',
						U_DateReturned = '$DateReturned',
						U_PODinCharge = '$PODinCharge',
						U_VerifiedDateHC = '$VerifiedDateHC',
						U_PODStatusDetail = '$ShiPODStatusDetailpmentNo',
						U_PTFNo = '$PTFNo',
						U_DateForwardedBT = '$DateForwardedBT',
						U_VERIFICATION_TAT = $VERIFICATION_TAT,
						U_POD_TAT = $POD_TAT,
						U_BillingDeadline = '$BillingDeadline',
						U_BillingStatus = '$BillingStatus',
						U_ServiceType = '$ServiceType',
						U_SINo = '$SINo',
						U_BillingTeam = '$BillingTeam',
						U_BTRemarks = '$BTRemarks',
						U_SOBNumber = '$SOBNumber',
						U_OutletNo = '$OutletNo',
						U_CBM = '$CBM',
						U_SI_DRNo = '$SI_DRNo',
						U_DeliveryMode = '$DeliveryMode',
						U_SourceWhse = '$SourceWhse',
						U_DestinationClient = '$DestinationClient',
						U_TotalInvAmount = '$TotalInvAmount',
						U_NameCustomer = '$NameCustomer',
						U_CategoryDR = '$CategoryDR',
						U_ForwardLoad = '$ForwardLoad',
						U_SONo = '$SONo',
						U_BackLoad = '$BackLoad',
						U_IDNumber = '$IDNumber',
						U_ApprovalStatus = '$ApprovalStatus',
						U_TimeInEmptyDem = '$TimeInEmptyDem',
						U_TimeOutEmptyDem = '$TimeOutEmptyDem',
						U_VerifiedEmptyDem = '$VerifiedEmptyDem',
						U_Remarks2 = '$Remarks2',
						U_TimeInAdvLoading = '$TimeInAdvLoading',
						U_DayOfTheWeek = '$DayOfTheWeek',
						U_TimeIn = '$TimeIn',
						U_TimeOut = '$TimeOut',
						U_TotalNoExceed = $TotalNoExceed,
						U_ODOIn = '$ODOIn',
						U_ODOOut = '$ODOOut',
						U_TotalUsage = $TotalUsage,
						U_ClientSubStatus = '$ClientSubStatus',
						U_ClientSubOverdue = '$ClientSubOverdue',
						U_ClientPenaltyCalc = '$ClientPenaltyCalc',
						U_PODStatusPayment = '$PODStatusPayment',
						U_PODSubmitDeadline = '$PODSubmitDeadline',
						U_OverdueDays = '$OverdueDays',
						U_InteluckPenaltyCalc = '$InteluckPenaltyCalc',
						U_WaivedDays = '$WaivedDays',
						U_HolidayOrWeekend = '$HolidayOrWeekend',
						U_LostPenaltyCalc = '$LostPenaltyCalc',
						U_PenaltiesManual = $PenaltiesManual,
						U_TotalSubPenalties = '$TotalSubPenalties',
						U_Waived = '$Waived',
						U_PercPenaltyCharge = '$PercPenaltyCharge',
						U_Approvedby = '$Approvedby',
						U_TotalPenaltyWaived = '$TotalPenaltyWaived'
						


						WHERE U_BookingNumber = '$BookingId'


					");
odbc_free_result($qry2);

	
				$PODPosted +=1;
				$msgPOD = 'POD Posted';
			}
		 catch (Exception $e) {


			 	$msgPOD = 'POD Not Posted';
			
			}





			
		
			
odbc_close($MSSQL_CONN);



				
	if ($err == 0) 
	{

		$data = array("valid"=>true, 
							"loggedIn" => 'Logged In!',
							"msg" => $msgPOD,
							"ItemPosted"=>$ItemPosted,
							"PODPosted"=>$PODPosted,
							"podData"=>$BookingId

						);
		echo json_encode($data);
	}
	else
	{
		$data = array("valid"=>false, "msg"=>$errmsg);
		echo json_encode($data);
	}

?>