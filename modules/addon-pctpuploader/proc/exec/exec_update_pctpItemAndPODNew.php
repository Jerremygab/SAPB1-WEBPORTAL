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

$itemCode = '';
$itemData = '';
$podData = '';
$billingData = '';
$tpData = '';
$pricingData = '';
$someArray = [];

$existingItem = 0;
$existingPOD = 0;
$PODCode = 'None';
$creator = $_SESSION['SESS_NAME'];


$itemDataEach = '';

if((isset($_POST['itemCode']))){
	$itemCode = $_POST['itemCode'];

}
if((isset($_POST['itemData'])) ) 
{  
  $itemData  = $_POST['itemData'];
}
if((isset($_POST['podData']))){
	$podData = $_POST['podData'];

}
if((isset($_POST['billingData']))){
	$billingData = $_POST['billingData'];

}
if((isset($_POST['tpData']))){
	$tpData = $_POST['tpData'];

}
if((isset($_POST['pricingData']))){
	$pricingData = $_POST['pricingData'];

}



// foreach ($itemDataDecoded as $key => $jsons) { // This will search in the 2 jsons
//      foreach($jsons as $key => $value) {
//          $ItemPosted = $value; 
//     }
// }

// ITEM ------------------------------------------------------------------------------------------------------------
	$ctr = 0;
	$ctr2 = 0;


//http prefix
$http = 'https://';
// Host name
$host = $server;

// Port
$port = 50000;

// Login credentials
$params = [

	"CompanyDB" => $CompanyDB,
    "UserName" => "manager",
    "Password" => "sapb1",
   
    
];


$curl = curl_init();
curl_setopt($curl, CURLOPT_HEADER, 0);
curl_setopt($curl, CURLOPT_URL, $http . $host . ":" . $port . "/b1s/v1/Login");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_VERBOSE, 1);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($params));

$response = curl_exec($curl);
$response2 = '';
$response3 = '';
$response4 = '';
$jObj = json_decode($response);
$sessionId = $jObj->SessionId;
$routeId = ".node0";
$headers[] = "Cookie: B1SESSION=" . $sessionId . "; ROUTEID=" . $routeId . ";";
$PODNum = '';
$tester = '1212';
// ITEM 

	
 foreach ($itemData as $key => $value) {
	$value1 = json_decode($value);

	$value = get_object_vars($value1); // convert object to array
   




			$ItemCode = $value["ItemCode"];
			$ItemName = $value["ItemName"];
			$ItmsGrpCod = 103;


	$params1 = [

		"ItemCode" => $ItemCode,
		"ItemName" => $ItemName,
		"InventoryItem" => "tNO",
		"ItemsGroupCode" => 103

   
    
];

	$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
		SELECT 

		COUNT(ItemCode) AS Count
		
		FROM OITM T0

		WHERE T0.ItemCode = '$ItemCode'");

		while (odbc_fetch_row($qry)) 
		{
				if(odbc_result($qry, 'Count') != 0){

					$existingItem += 1;
					$response2 = json_encode(array("ItemCode"=>'Existing'));
					$ctr++;
				}else{
					if((isset($_POST['itemData']))){

						$curl2 = curl_init();
						curl_setopt($curl2, CURLOPT_HTTPHEADER, $headers);
						curl_setopt($curl2, CURLOPT_HEADER, 0);
						curl_setopt($curl2, CURLOPT_URL, $http . $host . ":" . $port . "/b1s/v1/Items");
						curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);
						curl_setopt($curl2, CURLOPT_SSL_VERIFYPEER, false);
						curl_setopt($curl2, CURLOPT_VERBOSE, 1);
						curl_setopt($curl2, CURLOPT_POST, true);
						curl_setopt($curl2, CURLOPT_POSTFIELDS, json_encode($params1));


						$response2 = curl_exec($curl2);
						$ItemPosted +=1;
						$ctr++;

					}
				}
				 
		}
		odbc_free_result($qry);

}




// if((isset($_POST['itemData']))){
// foreach ($itemData as $key => $value) {
// 		$value1 = json_decode($value);
//    	$value = get_object_vars($value1); // convert object to array
   

// 		 if((isset($value["ItemCode"]))){


// 			$ItemCode = $value["ItemCode"];
// 			$ItemName = $value["ItemName"];
// 			$ItmsGrpCod = 103;



// 	 	try{
// 					$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
					   

// 							BEGIN
// 							   IF NOT EXISTS (SELECT * FROM [OITM]
// 							                   WHERE ItemCode = '$ItemCode')
// 							   BEGIN
							       
						       

// INSERT INTO [OITM]

// (

// Series,
// ItemCode,
// ItemName,
// ItmsGrpCod,
// VatGourpSa,
// VatGroupPu, 
// UgpEntry,
// InvntItem,
// NumInSale,
// SalPackUn,
// SalFactor1,
// SalFactor2,
// SalFactor3,
// SalFactor4,
// NumInBuy,
// PurPackUn,
// PurFactor1,
// PurFactor2,
// PurFactor3,
// PurFactor4,
// Onhand,
// GLMethod,
// IUoMEntry
// )

// VALUES 
// (
// 		3,
// 		'$ItemCode',
// 		'$ItemName',
// 		103,
// 		'OVAT-N',
// 		'IVAT-N',
// 		'-1',
// 		'N',
// 		1,
// 		1,
// 		1,
// 		1,
// 		1,
// 		1,
// 		1,
// 		1,
// 		1,
// 		1,
// 			1,
// 		1,
		
// 		0.00,
// 		'C',
// 		-1

// )

// 							   END

// 							END");

// 	$qryAA = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
					   

// 							BEGIN
// 							   IF NOT EXISTS (SELECT * FROM [OITW]
// 							                   WHERE ItemCode = '$ItemCode')
// 							   BEGIN
// INSERT INTO OITW

// (
// ItemCode,
// WhsCode
// )
// values(
// '$ItemCode',
// '01'
// )




// 			   END

// 							END");


// 		$qryBB = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
					   

// 							BEGIN
// 							   IF NOT EXISTS (SELECT * FROM [ITM1]
// 							                   WHERE ItemCode = '$ItemCode')
// 							   BEGIN

// INSERT INTO ITM1 



// (
// ItemCode,
// PriceList
// )

// VALUES 
// (
// '$ItemCode',
// 1
// ),
// (
// '$ItemCode',
// 2
// ),
// (
// '$ItemCode',
// 3
// ),
// (
// '$ItemCode',
// 4
// ),
// (
// '$ItemCode',
// 5
// ),
// (
// '$ItemCode',
// 6
// ),
// (
// '$ItemCode',
// 7
// ),
// (
// '$ItemCode',
// 8
// ),
// (
// '$ItemCode',
// 9
// ),
// (
// '$ItemCode',
// 10
// )

// 			   END

// 							END");




// 	  	$ItemPosted +=1;
// 					$msgItem = 'Item Posted';


				
// 				}
// 			 catch (Exception $e) {

// 			 	 	$msgItem = 'Item Not Posted';
			
// 			}	
// 		}

// 	}

// }


if((isset($_POST['podData']))){
	foreach ($podData as $key => $value) {
			$value1 = json_decode($value);
	   	$value = get_object_vars($value1); // convert object to array
	  
	   		 if((isset($value["U_BookingNumber"]))){


$U_BookingDate=utf8_decode($value["U_BookingDate"]);
$U_BookingNumber=utf8_decode($value["U_BookingNumber"]);
$U_ClientName=utf8_decode($value["U_ClientName"]);
$U_SAPClient=utf8_decode($value["U_SAPClient"]);
$U_TruckerName=utf8_decode($value["U_TruckerName"]);
$U_SAPTrucker=utf8_decode($value["U_SAPTrucker"]);
$U_PlateNumber=utf8_decode($value["U_PlateNumber"]);
$U_VehicleTypeCap=utf8_decode($value["U_VehicleTypeCap"]);
$U_DeliveryOrigin=utf8_decode($value["U_DeliveryOrigin"]);
$U_ISLAND=utf8_decode($value["U_ISLAND"]);
$U_Destination=utf8_decode($value["U_Destination"]);
$U_ISLAND_D=utf8_decode($value["U_ISLAND_D"]);
$U_IFINTERISLAND=utf8_decode($value["U_IFINTERISLAND"]);
$U_DeliveryStatus=utf8_decode($value["U_DeliveryStatus"]);
$U_DeliveryDateDTR=utf8_decode($value["U_DeliveryDateDTR"]);
$U_DeliveryDatePOD=utf8_decode($value["U_DeliveryDatePOD"]);
$U_NoOfDrops=utf8_decode($value["U_NoOfDrops"]);
$U_TripType=utf8_decode($value["U_TripType"]);
$U_Remarks=utf8_decode($value["U_Remarks"]);
$U_DocNum=utf8_decode($value["U_DocNum"]);
$U_TripTicketNo=utf8_decode($value["U_TripTicketNo"]);
$U_WaybillNo=utf8_decode($value["U_WaybillNo"]);
$U_ShipmentNo=utf8_decode($value["U_ShipmentNo"]);
$U_DeliveryReceiptNo=utf8_decode($value["U_DeliveryReceiptNo"]);
$U_SeriesNo=utf8_decode($value["U_SeriesNo"]);
$U_OtherPODDoc=utf8_decode($value["U_OtherPODDoc"]);
$U_RemarksPOD=utf8_decode($value["U_RemarksPOD"]);
$U_Receivedby=utf8_decode($value["U_Receivedby"]);
$U_ClientReceivedDate=utf8_decode($value["U_ClientReceivedDate"]);
$U_ActualDateRec_Intitial=utf8_decode($value["U_ActualDateRec_Intitial"]);
$U_InitialHCRecDate=utf8_decode($value["U_InitialHCRecDate"]);
$U_ActualHCRecDate=utf8_decode($value["U_ActualHCRecDate"]);
$U_DateReturned=utf8_decode($value["U_DateReturned"]);
$U_PODinCharge=utf8_decode($value["U_PODinCharge"]);
$U_VerifiedDateHC=utf8_decode($value["U_VerifiedDateHC"]);
$U_PODStatusDetail=utf8_decode($value["U_PODStatusDetail"]);
$U_PTFNo=utf8_decode($value["U_PTFNo"]);
$U_DateForwardedBT=utf8_decode($value["U_DateForwardedBT"]);
$U_POD_TAT=utf8_decode($value["U_POD_TAT"]);
$U_BillingStatus=utf8_decode($value["U_BillingStatus"]);
$U_ServiceType=utf8_decode($value["U_ServiceType"]);
$U_SINo=utf8_decode($value["U_SINo"]);
$U_BillingTeam=utf8_decode($value["U_BillingTeam"]);
$U_BTRemarks=utf8_decode($value["U_BTRemarks"]);
$U_SOBNumber=utf8_decode($value["U_SOBNumber"]);
$U_OutletNo=utf8_decode($value["U_OutletNo"]);
$U_SI_DRNo=utf8_decode($value["U_SI_DRNo"]);
$U_CBM=utf8_decode($value["U_CBM"]);
$U_DeliveryMode=utf8_decode($value["U_DeliveryMode"]);
$U_SourceWhse=utf8_decode($value["U_SourceWhse"]);
$U_DestinationClient=utf8_decode($value["U_DestinationClient"]);
$U_TotalInvAmount=$value["U_TotalInvAmount"];
$U_SONo=utf8_decode($value["U_SONo"]);
$U_NameCustomer=utf8_decode($value["U_NameCustomer"]);
$U_CategoryDR=utf8_decode($value["U_CategoryDR"]);
$U_ForwardLoad=utf8_decode($value["U_ForwardLoad"]);
$U_BackLoad=utf8_decode($value["U_BackLoad"]);
$U_IDNumber=utf8_decode($value["U_IDNumber"]);
$U_TypeOfAccessorial=utf8_decode($value["U_TypeOfAccessorial"]);
$U_ApprovalStatus=utf8_decode($value["U_ApprovalStatus"]);
$U_TimeInEmptyDem=utf8_decode($value["U_TimeInEmptyDem"]);
$U_TimeOutEmptyDem=utf8_decode($value["U_TimeOutEmptyDem"]);
$U_VerifiedEmptyDem=utf8_decode($value["U_VerifiedEmptyDem"]);
$U_TimeInLoadedDem=utf8_decode($value["U_TimeInLoadedDem"]);
$U_TimeOutLoadedDem=utf8_decode($value["U_TimeOutLoadedDem"]);
$U_VerifiedLoadedDem=utf8_decode($value["U_VerifiedLoadedDem"]);
$U_Remarks2=utf8_decode($value["U_Remarks2"]);
$U_TimeInAdvLoading=utf8_decode($value["U_TimeInAdvLoading"]);
$U_DayOfTheWeek=utf8_decode($value["U_DayOfTheWeek"]);
$U_TimeIn=utf8_decode($value["U_TimeIn"]);
$U_TimeOut=utf8_decode($value["U_TimeOut"]);
$U_TotalNoExceed=utf8_decode($value["U_TotalNoExceed"]);
$U_ODOIn=utf8_decode($value["U_ODOIn"]);
$U_ODOOut=utf8_decode($value["U_ODOOut"]);
$U_TotalUsage=utf8_decode($value["U_TotalUsage"]);
$U_ClientSubStatus=utf8_decode($value["U_ClientSubStatus"]);
$U_ClientSubOverdue=utf8_decode($value["U_ClientSubOverdue"]);
$U_ClientPenaltyCalc=utf8_decode($value["U_ClientPenaltyCalc"]);
$U_PODStatusPayment=utf8_decode($value["U_PODStatusPayment"]);
$U_PODSubmitDeadline=utf8_decode($value["U_PODSubmitDeadline"]);
$U_OverdueDays=utf8_decode($value["U_OverdueDays"]);
$U_InteluckPenaltyCalc=utf8_decode($value["U_InteluckPenaltyCalc"]);
$U_WaivedDays=utf8_decode($value["U_WaivedDays"]);
$U_HolidayOrWeekend=utf8_decode($value["U_HolidayOrWeekend"]);
$U_LostPenaltyCalc=utf8_decode($value["U_LostPenaltyCalc"]);
$U_TotalSubPenalties=utf8_decode($value["U_TotalSubPenalties"]);
$U_Waived=utf8_decode($value["U_Waived"]);
$U_PercPenaltyCharge=utf8_decode($value["U_PercPenaltyCharge"]);
$U_Approvedby=utf8_decode($value["U_Approvedby"]);
$U_TotalPenaltyWaived=utf8_decode($value["U_TotalPenaltyWaived"]);
$Name=utf8_decode($value["Name"]);


					try{

					$PODNum = '';

				  $qry2 = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 




					BEGIN
					   IF NOT EXISTS (SELECT * FROM [@PCTP_POD]
					                   WHERE U_BookingNumber = '$U_BookingNumber')
					   BEGIN
					       

							INSERT INTO [@PCTP_POD]

										(
										U_BookingDate,
										U_BookingNumber,
										U_ClientName,
										U_SAPClient,
										U_TruckerName,
										U_SAPTrucker,
										U_PlateNumber,
										U_VehicleTypeCap,
										U_DeliveryOrigin,
										U_ISLAND,
										U_Destination,
										U_ISLAND_D,
										U_IFINTERISLAND,
										U_DeliveryStatus,
										U_DeliveryDateDTR,
										U_DeliveryDatePOD,
										U_NoOfDrops,
										U_TripType,
										U_Remarks,
										U_DocNum,
										U_TripTicketNo,
										U_WaybillNo,
										U_ShipmentNo,
										U_DeliveryReceiptNo,
										U_SeriesNo,
										U_OtherPODDoc,
										U_RemarksPOD,
										U_Receivedby,
										U_ClientReceivedDate,
										U_ActualDateRec_Intitial,
										U_InitialHCRecDate,
										U_ActualHCRecDate,
										U_DateReturned,
										U_PODinCharge,
										U_VerifiedDateHC,
										U_PODStatusDetail,
										U_PTFNo,
										U_DateForwardedBT,
										U_POD_TAT,
										U_BillingStatus,
										U_ServiceType,
										U_SINo,
										U_BillingTeam,
										U_BTRemarks,
										U_SOBNumber,
										U_OutletNo,
										U_SI_DRNo,
										U_CBM,
										U_DeliveryMode,
										U_SourceWhse,
										U_DestinationClient,
										U_TotalInvAmount,
										U_SONo,
										U_NameCustomer,
										U_CategoryDR,
										U_ForwardLoad,
										U_BackLoad,
										U_IDNumber,
										U_TypeOfAccessorial,
										U_ApprovalStatus,
										U_TimeInEmptyDem,
										U_TimeOutEmptyDem,
										U_VerifiedEmptyDem,
										U_TimeInLoadedDem,
										U_TimeOutLoadedDem,
										U_VerifiedLoadedDem,
										U_Remarks2,
										U_TimeInAdvLoading,
										U_DayOfTheWeek,
										U_TimeIn,
										U_TimeOut,
										U_TotalNoExceed,
										U_ODOIn,
										U_ODOOut,
										U_TotalUsage,
										U_ClientSubStatus,
										U_ClientSubOverdue,
										U_ClientPenaltyCalc,
										U_PODStatusPayment,
										U_PODSubmitDeadline,
										U_OverdueDays,
										U_InteluckPenaltyCalc,
										U_WaivedDays,
										U_HolidayOrWeekend,
										U_LostPenaltyCalc,
										U_TotalSubPenalties,
										U_Waived,
										U_PercPenaltyCharge,
										U_Approvedby,
										U_TotalPenaltyWaived,
										Name
									
								)
								OUTPUT INSERTED.Code
								VALUES 
								(
										'$U_BookingDate',
										'$U_BookingNumber',
										'$U_ClientName',
										'$U_SAPClient',
										'$U_TruckerName',
										'$U_SAPTrucker',
										'$U_PlateNumber',
										'$U_VehicleTypeCap',
										'$U_DeliveryOrigin',
										'$U_ISLAND',
										'$U_Destination',
										'$U_ISLAND_D',
										'$U_IFINTERISLAND',
										'$U_DeliveryStatus',
										'$U_DeliveryDateDTR',
										'$U_DeliveryDatePOD',
											$U_NoOfDrops,
										'$U_TripType',
										'$U_Remarks',
										'$U_DocNum',
										'$U_TripTicketNo',
										'$U_WaybillNo',
										'$U_ShipmentNo',
										'$U_DeliveryReceiptNo',
										'$U_SeriesNo',
										'$U_OtherPODDoc',
										'$U_RemarksPOD',
										'$U_Receivedby',
										'$U_ClientReceivedDate',
										'$U_ActualDateRec_Intitial',
										'$U_InitialHCRecDate',
										'$U_ActualHCRecDate',
										'$U_DateReturned',
										'$U_PODinCharge',
										'$U_VerifiedDateHC',
										'$U_PODStatusDetail',
										'$U_PTFNo',
										'$U_DateForwardedBT',
										$U_POD_TAT,
										'$U_BillingStatus',
										'$U_ServiceType',
										'$U_SINo',
										'$U_BillingTeam',
										'$U_BTRemarks',
										'$U_SOBNumber',
										'$U_OutletNo',
										'$U_SI_DRNo',
										'$U_CBM',
										'$U_DeliveryMode',
										'$U_SourceWhse',
										'$U_DestinationClient',
										'$U_TotalInvAmount',

										'$U_SONo',
										'$U_NameCustomer',
										'$U_CategoryDR',
										'$U_ForwardLoad',
										'$U_BackLoad',
										'$U_IDNumber',
										'$U_TypeOfAccessorial',
										'$U_ApprovalStatus',
										'$U_TimeInEmptyDem',
										'$U_TimeOutEmptyDem',
										'$U_VerifiedEmptyDem',
										'$U_TimeInLoadedDem',
										'$U_TimeOutLoadedDem',
										'$U_VerifiedLoadedDem',
										'$U_Remarks2',
										'$U_TimeInAdvLoading',
										'$U_DayOfTheWeek',
										'$U_TimeIn',
										'$U_TimeOut',
										$U_TotalNoExceed,
										'$U_ODOIn',
										'$U_ODOOut',
										$U_TotalUsage,
										'$U_ClientSubStatus',
										'$U_ClientSubOverdue',
										'$U_ClientPenaltyCalc',
										'$U_PODStatusPayment',
										'$U_PODSubmitDeadline',
										'$U_OverdueDays',
										'$U_InteluckPenaltyCalc',
										'$U_WaivedDays',
										'$U_HolidayOrWeekend',
										'$U_LostPenaltyCalc',
										'$U_TotalSubPenalties',
										'$U_Waived',
										'$U_PercPenaltyCharge',
										'$U_Approvedby',
										'$U_TotalPenaltyWaived',
										'$Name'

								)



					   END
					   ELSE


						UPDATE [dbo].[@PCTP_POD] SET 

							U_BookingDate = '$U_BookingDate',
							U_ClientName = '$U_ClientName',
							U_SAPClient = '$U_SAPClient',
							U_TruckerName = '$U_TruckerName',
							U_SAPTrucker = '$U_SAPTrucker',
							U_PlateNumber =  '$U_PlateNumber',
							U_VehicleTypeCap = '$U_VehicleTypeCap',
							U_DeliveryOrigin = '$U_DeliveryOrigin',
							U_ISLAND = '$U_ISLAND',
							U_Destination = '$U_Destination',
							U_ISLAND_D = '$U_ISLAND_D',
							U_IFINTERISLAND = '$U_IFINTERISLAND',
							U_DeliveryStatus = '$U_DeliveryStatus',
							U_DeliveryDateDTR = '$U_DeliveryDateDTR',
							U_DeliveryDatePOD = '$U_DeliveryDatePOD',
							U_NoOfDrops = $U_NoOfDrops,
							U_DocNum = '$U_DocNum',
							U_TripTicketNo = '$U_TripTicketNo',
							U_WaybillNo = '$U_WaybillNo',
							U_ShipmentNo = '$U_ShipmentNo',
							U_DeliveryReceiptNo = '$U_DeliveryReceiptNo',
							U_SeriesNo = '$U_SeriesNo',
							U_OtherPODDoc = '$U_OtherPODDoc',
							U_Remarks = '$U_Remarks',
							U_RemarksPOD = '$U_RemarksPOD',
							U_Receivedby = '$U_Receivedby',
							U_ClientReceivedDate = '$U_ClientReceivedDate',
							U_ActualDateRec_Intitial= '$U_ActualDateRec_Intitial',
							U_InitialHCRecDate = '$U_InitialHCRecDate',
							U_ActualHCRecDate = '$U_ActualHCRecDate',
							U_DateReturned = '$U_DateReturned',
							U_PODinCharge = '$U_PODinCharge',
							U_VerifiedDateHC = '$U_VerifiedDateHC',
							U_PODStatusDetail = '$U_PODStatusDetail',
							U_PTFNo = '$U_PTFNo',
							U_DateForwardedBT = '$U_DateForwardedBT',
							U_BillingStatus = '$U_BillingStatus',
							U_CBM = '$U_CBM',
							U_DeliveryMode = '$U_DeliveryMode',
							U_SourceWhse = '$U_SourceWhse',
							U_DestinationClient = '$U_DestinationClient'

						FROM [dbo].[@PCTP_POD] T0
						
						WHERE T0.U_BookingNumber = '$U_BookingNumber'



						

					


					END

				 	

					");
odbc_free_result($qry2);
	
				$PODPosted +=1;
				$msgPOD = 'POD Not Posted';
			}
		 catch (Exception $e) {

			 	$msgPOD = 'POD Not Posted';
			
			}
			


			}
		}

	}




if((isset($_POST['billingData']))){
	foreach ($billingData as $key => $value) {
			$value1 = json_decode($value);
	   	$value = get_object_vars($value1); // convert object to array
	  

// U_BookingDate
// U_BookingId
// U_CustomerName
// U_SAPClient
// U_PlateNumber
// U_VehicleTypeCap
// U_DeliveryOrigin
// U_Destination
// U_DeliveryStatus
// U_DeliveryDatePOD
// U_NoOfDrops
// U_TripType
// U_Remarks
// U_DocNum
// U_WaybillNo
// U_ShipmentManifestNo
// U_DeliveryReceiptNo
// U_SeriesNo
// U_OtherPODDoc
// U_RemarksPOD
// U_ClientReceivedDate
// U_ActualHCRecDate
								
$Name=utf8_encode($value["Name"]);
$U_BookingDate=utf8_encode($value["U_BookingDate"]);
$U_BookingId=utf8_encode($value["U_BookingId"]);
$U_CustomerName=utf8_encode($value["U_CustomerName"]);
$U_SAPClient=utf8_encode($value["U_SAPClient"]);
$U_PlateNumber=utf8_encode($value["U_PlateNumber"]);
$U_VehicleTypeCap=utf8_encode($value["U_VehicleTypeCap"]);
$U_DeliveryOrigin=utf8_encode($value["U_DeliveryOrigin"]);
$U_Destination=utf8_encode($value["U_Destination"]);
$U_DeliveryStatus=utf8_encode($value["U_DeliveryStatus"]);
$U_DeliveryDatePOD=utf8_encode($value["U_DeliveryDatePOD"]);
$U_NoOfDrops=utf8_encode($value["U_NoOfDrops"]);
$U_TripType=utf8_encode($value["U_TripType"]);
$U_Remarks=utf8_encode($value["U_Remarks"]);
$U_DocNum=utf8_encode($value["U_DocNum"]);
$U_WaybillNo=utf8_encode($value["U_WaybillNo"]);
$U_ShipmentManifestNo=utf8_encode($value["U_ShipmentManifestNo"]);
$U_DeliveryReceiptNo=utf8_encode($value["U_DeliveryReceiptNo"]);
$U_SeriesNo=utf8_encode($value["U_SeriesNo"]);
$U_OtherPODDoc=utf8_encode($value["U_OtherPODDoc"]);
$U_RemarksPOD=utf8_encode($value["U_RemarksPOD"]);
$U_ClientReceivedDate=utf8_encode($value["U_ClientReceivedDate"]);
$U_ActualHCRecDate=utf8_encode($value["U_ActualHCRecDate"]);

$U_PODinCharge=utf8_encode($value["U_PODinCharge"]);
$U_VerifiedDateHC=utf8_encode($value["U_VerifiedDateHC"]);
$U_PODStatusDetail=utf8_encode($value["U_PODStatusDetail"]);
$U_PTFNo=utf8_encode($value["U_PTFNo"]);
$U_DateForwardedBT=utf8_encode($value["U_DateForwardedBT"]);
$U_BillingStatus=utf8_encode($value["U_BillingStatus"]);
$U_ServiceType=utf8_encode($value["U_ServiceType"]);
$U_BillingTeam=utf8_encode($value["U_BillingTeam"]);
$U_BTRemarks=utf8_encode($value["U_BTRemarks"]);
$U_SOBNumber=utf8_encode($value["U_SOBNumber"]);
$U_OutletNo=utf8_encode($value["U_OutletNo"]);
$U_SI_DRNo=utf8_encode($value["U_SI_DRNo"]);
$U_CBM=utf8_encode($value["U_CBM"]);
$U_DeliveryMode=utf8_encode($value["U_DeliveryMode"]);
$U_SourceWhse=utf8_encode($value["U_SourceWhse"]);
$U_DestinationClient=utf8_encode($value["U_DestinationClient"]);
$U_TotalInvAmount=utf8_encode($value["U_TotalInvAmount"]);
$U_SONo=utf8_encode($value["U_SONo"]);
$U_NameCustomer=utf8_encode($value["U_NameCustomer"]);
$U_CategoryDR=utf8_encode($value["U_CategoryDR"]);
$U_ForwardLoad=utf8_encode($value["U_ForwardLoad"]);
$U_BackLoad=utf8_encode($value["U_BackLoad"]);
$U_IDNumber=utf8_encode($value["U_IDNumber"]);
$U_TypeOfAccessorial=utf8_encode($value["U_TypeOfAccessorial"]);
$U_Status=utf8_encode($value["U_Status"]);
$U_TimeInEmptyDem=utf8_encode($value["U_TimeInEmptyDem"]);
$U_TimeOutEmptyDem=utf8_encode($value["U_TimeOutEmptyDem"]);
$U_VerifiedEmptyDem=utf8_encode($value["U_VerifiedEmptyDem"]);
$U_TimeInLoadedDem=utf8_encode($value["U_TimeInLoadedDem"]);
$U_TimeOutLoadedDem=utf8_encode($value["U_TimeOutLoadedDem"]);
$U_VerifiedLoadedDem=utf8_encode($value["U_VerifiedLoadedDem"]);
$U_Remarks=utf8_encode($value["U_Remarks"]);
$U_TimeInAdvLoading=utf8_encode($value["U_TimeInAdvLoading"]);
$U_DayOfTheWeek=utf8_encode($value["U_DayOfTheWeek"]);
$U_TimeIn=utf8_encode($value["U_TimeIn"]);
$U_TimeOut=utf8_encode($value["U_TimeOut"]);
$U_TotalExceed=utf8_encode($value["U_TotalExceed"]);
$U_ODOIn=utf8_encode($value["U_ODOIn"]);
$U_ODOOut=utf8_encode($value["U_ODOOut"]);
$U_TotalUsage=utf8_encode($value["U_TotalUsage"]);
$U_Demurrage=utf8_encode($value["U_Demurrage"]);
$U_AddCharges=utf8_encode($value["U_AddCharges"]);
$U_ActualBilledRate=utf8_encode($value["U_ActualBilledRate"]);
$U_RateAdjustments=utf8_encode($value["U_RateAdjustments"]);
$U_ActualDemurrage=utf8_encode($value["U_ActualDemurrage"]);
$U_ActualAddCharges=utf8_encode($value["U_ActualAddCharges"]);
$U_TotalRecClients=utf8_encode($value["U_TotalRecClients"]);
$U_CWT2307=utf8_encode($value["U_CWT2307"]);




$qry3PODCode = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
	SELECT Code FROM [@PCTP_POD] WHERE U_BookingNumber = '$U_BookingId'");
	while (odbc_fetch_row($qry3PODCode)) 
		{
			$PODNum = odbc_result($qry3PODCode, "Code");
			
		}

					try{



				  $qry3 = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 




BEGIN
IF NOT EXISTS (SELECT * FROM [@PCTP_BILLING]
WHERE U_BookingId = '$U_BookingId')
BEGIN


INSERT INTO [@PCTP_BILLING]
(


Name	,
U_BookingDate	,
U_BookingId	,
U_CustomerName	,
U_SAPClient	,
U_PlateNumber	,
U_VehicleTypeCap	,
U_DeliveryOrigin	,
U_Destination	,
U_DeliveryStatus	,
U_DeliveryDatePOD	,
U_NoOfDrops	,
U_TripType	,
U_Remarks	,
U_DocNum	,
U_WaybillNo	,
U_ShipmentManifestNo	,
U_DeliveryReceiptNo	,
U_SeriesNo	,
U_OtherPODDoc	,
U_RemarksPOD	,
U_ClientReceivedDate	,
U_ActualHCRecDate	,
U_PODinCharge	,
U_VerifiedDateHC	,
U_PODStatusDetail	,
U_PTFNo	,
U_DateForwardedBT	,
U_BillingStatus	,
U_ServiceType	,
U_BillingTeam	,
U_BTRemarks	,
U_SOBNumber	,
U_OutletNo	,
U_SI_DRNo	,
U_CBM	,
U_DeliveryMode	,
U_SourceWhse	,
U_DestinationClient	,

U_SONo	,
U_NameCustomer	,
U_CategoryDR	,
U_ForwardLoad	,
U_BackLoad	,
U_IDNumber	,
U_TypeOfAccessorial	,
U_Status	,
U_TimeInEmptyDem	,
U_TimeOutEmptyDem	,
U_VerifiedEmptyDem	,
U_TimeInLoadedDem	,
U_TimeOutLoadedDem	,
U_VerifiedLoadedDem	,
--U_Remarks	,
U_TimeInAdvLoading	,
U_DayOfTheWeek	,
U_TimeIn	,
U_TimeOut	,
U_TotalExceed	,
U_ODOIn	,
U_ODOOut	,
U_TotalUsage	,
U_Demurrage	,
U_AddCharges	,
U_ActualBilledRate	,
U_RateAdjustments	,
U_ActualDemurrage	,
U_ActualAddCharges	,
U_TotalRecClients	,
U_CWT2307	,

U_PODNum


)


VALUES (

'$Name',
'$U_BookingDate',
'$U_BookingId',
'$U_CustomerName',
'$U_SAPClient',
'$U_PlateNumber',
'$U_VehicleTypeCap',
'$U_DeliveryOrigin',
'$U_Destination',
'$U_DeliveryStatus',
'$U_DeliveryDatePOD',
$U_NoOfDrops,
'$U_TripType',
'$U_Remarks',
'$U_DocNum',
'$U_WaybillNo',
'$U_ShipmentManifestNo',
'$U_DeliveryReceiptNo',
'$U_SeriesNo',
'$U_OtherPODDoc',
'$U_RemarksPOD',
'$U_ClientReceivedDate',
'$U_ActualHCRecDate',
'$U_PODinCharge',
'$U_VerifiedDateHC',
'$U_PODStatusDetail',
'$U_PTFNo',
'$U_DateForwardedBT',
'$U_BillingStatus',
'$U_ServiceType',
'$U_BillingTeam',
'$U_BTRemarks',
'$U_SOBNumber',
'$U_OutletNo',
'$U_SI_DRNo',
'$U_CBM',
'$U_DeliveryMode',
'$U_SourceWhse',
'$U_DestinationClient',

'$U_SONo',
'$U_NameCustomer',
'$U_CategoryDR',
'$U_ForwardLoad',
'$U_BackLoad',
'$U_IDNumber',
'$U_TypeOfAccessorial',
'$U_Status',
'$U_TimeInEmptyDem',
'$U_TimeOutEmptyDem',
'$U_VerifiedEmptyDem',
'$U_TimeInLoadedDem',
'$U_TimeOutLoadedDem',
'$U_VerifiedLoadedDem',

'$U_TimeInAdvLoading',
'$U_DayOfTheWeek',
'$U_TimeIn',
'$U_TimeOut',
'$U_TotalExceed',
'$U_ODOIn',
'$U_ODOOut',
'$U_TotalUsage',
'$U_Demurrage',
'$U_AddCharges',
'$U_ActualBilledRate',
'$U_RateAdjustments',
'$U_ActualDemurrage',
'$U_ActualAddCharges',
'$U_TotalRecClients',
'$U_CWT2307',

'$PODNum'



)

END
END

				 	

					");
			odbc_free_result($qry3);
			}
		 catch (Exception $e) {

			 	
			
			}
			
		}

	}



if((isset($_POST['tpData']))){
	foreach ($tpData as $key => $value) {
			$value1 = json_decode($value);
	   	$value = get_object_vars($value1); // convert object to array
	  

$Name=utf8_encode($value["Name"]);
$U_BookingDate=utf8_encode($value["U_BookingDate"]);
$U_BookingId=utf8_encode($value["U_BookingId"]);
$U_ClientName=utf8_encode($value["U_ClientName"]);
$U_TruckerName=utf8_encode($value["U_TruckerName"]);
$U_TruckerSAP=utf8_encode($value["U_TruckerSAP"]);
$U_DeliveryStatus=utf8_encode($value["U_DeliveryStatus"]);
$U_DeliveryDatePOD=utf8_encode($value["U_DeliveryDatePOD"]);
$U_Remarks=utf8_encode($value["U_Remarks"]);
$U_DocNum=utf8_encode($value["U_DocNum"]);
$U_TripTicketNo=utf8_encode($value["U_TripTicketNo"]);
$U_WaybillNo=utf8_encode($value["U_WaybillNo"]);
$U_ShipmentManifestNo=utf8_encode($value["U_ShipmentManifestNo"]);
$U_DeliveryReceiptNo=utf8_encode($value["U_DeliveryReceiptNo"]);
$U_SeriesNo=utf8_encode($value["U_SeriesNo"]);
$U_OtherPODDoc=utf8_encode($value["U_OtherPODDoc"]);
$U_REMARKS1=utf8_encode($value["U_REMARKS1"]);

$U_TPStatus=utf8_encode($value["U_TPStatus"]);
$U_TotalSubPenalty=utf8_encode($value["U_TotalSubPenalty"]);
$U_TotalPenaltyWaived=utf8_encode($value["U_TotalPenaltyWaived"]);
$U_GrossTruckerRates=utf8_encode($value["U_GrossTruckerRates"]);
$U_GrossTruckerRatesN=utf8_encode($value["U_GrossTruckerRatesN"]);
$U_RateBasis=utf8_encode($value["U_RateBasis"]);
$U_TaxType=utf8_encode($value["U_TaxType"]);
$U_Demurrage=utf8_encode($value["U_Demurrage"]);
$U_AddtlDrop=utf8_encode($value["U_AddtlDrop"]);
$U_BoomTruck=utf8_encode($value["U_BoomTruck"]);
$U_Manpower=utf8_encode($value["U_Manpower"]);
$U_BackLoad=utf8_encode($value["U_BackLoad"]);
$U_Addtlcharges=utf8_encode($value["U_Addtlcharges"]);
$U_DemurrageN=utf8_encode($value["U_DemurrageN"]);
$U_AddtlChargesN=utf8_encode($value["U_AddtlChargesN"]);
$U_ActualDemurrage=utf8_encode($value["U_ActualDemurrage"]);
$U_ActualCharges=utf8_encode($value["U_ActualCharges"]);
$U_ActualRates=utf8_encode($value["U_ActualRates"]);
$U_RateAdjustments=utf8_encode($value["U_RateAdjustments"]);
$U_BoomTruck2=utf8_encode($value["U_BoomTruck2"]);
$U_OtherCharges=utf8_encode($value["U_OtherCharges"]);
$U_TotalPenalty=utf8_encode($value["U_TotalPenalty"]);
$U_TotalPayable=utf8_encode($value["U_TotalPayable"]);
$U_EWT2307=utf8_encode($value["U_EWT2307"]);
$U_TotalPayableRec=utf8_encode($value["U_TotalPayableRec"]);
$U_ActualPaymentDate=utf8_encode($value["U_ActualPaymentDate"]);
$U_PaymentReference=utf8_encode($value["U_PaymentReference"]);
$U_ORRefNo=utf8_encode($value["U_ORRefNo"]);
$U_PaymentVoucherNo=utf8_encode($value["U_PaymentVoucherNo"]);
$U_PaymentStatus=utf8_encode($value["U_PaymentStatus"]);

$qry4PODCode = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
	SELECT Code FROM [@PCTP_POD] WHERE U_BookingNumber = '$U_BookingId'");
	while (odbc_fetch_row($qry4PODCode)) 
		{
			$PODNum = odbc_result($qry4PODCode, "Code");
			
		}

try{



$qry4 = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 




BEGIN
IF NOT EXISTS (SELECT * FROM [@PCTP_TP]
WHERE U_BookingId = '$U_BookingNumber')
BEGIN


INSERT INTO [@PCTP_TP]

(

Name	,
U_BookingDate	,
U_BookingId	,
U_ClientName	,
U_TruckerName	,
U_TruckerSAP	,
U_DeliveryStatus	,
U_DeliveryDatePOD	,
--U_Remarks	,
U_DocNum	,
U_TripTicketNo	,
U_WaybillNo	,
U_ShipmentManifestNo	,
U_DeliveryReceiptNo	,
U_SeriesNo	,
U_OtherPODDoc	,
--U_REMARKS1	,

U_TPStatus,
U_TotalSubPenalty,
U_TotalPenaltyWaived,
U_GrossTruckerRates,
U_GrossTruckerRatesN,
U_RateBasis,
U_TaxType,
U_Demurrage,
U_AddtlDrop,
U_BoomTruck,
U_Manpower,
U_BackLoad,
U_Addtlcharges,
U_DemurrageN,
U_AddtlChargesN,
U_ActualDemurrage,
U_ActualCharges,
U_ActualRates,
U_RateAdjustments,
U_BoomTruck2,
U_OtherCharges,
U_TotalPenalty,
U_TotalPayable,
U_EWT2307,
U_TotalPayableRec,
U_ActualPaymentDate,
U_PaymentReference,
U_ORRefNo,
U_PaymentVoucherNo,
U_PaymentStatus,
U_PODNum


)

VALUES 
(
'$Name',
'$U_BookingDate',
'$U_BookingId',
'$U_ClientName',
'$U_TruckerName',
'$U_TruckerSAP',
'$U_DeliveryStatus',
'$U_DeliveryDatePOD',

'$U_DocNum',
'$U_TripTicketNo',
'$U_WaybillNo',
'$U_ShipmentManifestNo',
'$U_DeliveryReceiptNo',
'$U_SeriesNo',
'$U_OtherPODDoc',

'$U_TPStatus',
$U_TotalSubPenalty,
$U_TotalPenaltyWaived,
$U_GrossTruckerRates,
$U_GrossTruckerRatesN,
'$U_RateBasis',
'$U_TaxType',
'$U_Demurrage',
'$U_AddtlDrop',
'$U_BoomTruck',
'$U_Manpower',
'$U_BackLoad',
$U_Addtlcharges,
'$U_DemurrageN',
'$U_AddtlChargesN',
'$U_ActualDemurrage',
$U_ActualCharges,
$U_ActualRates,
$U_RateAdjustments,
'$U_BoomTruck2',
$U_OtherCharges,
$U_TotalPenalty,
$U_TotalPayable,
$U_EWT2307,
$U_TotalPayableRec,
'$U_ActualPaymentDate',
'$U_PaymentReference',
'$U_ORRefNo',
'$U_PaymentVoucherNo',
'$U_PaymentStatus',
'$PODNum'

)


END



					END

				 	

					");
				
odbc_free_result($qry4);
			}
		 catch (Exception $e) {

			 	
			
			}
			
		}

	}

if((isset($_POST['pricingData']))){
	foreach ($pricingData as $key => $value) {
			$value1 = json_decode($value);
	   	$value = get_object_vars($value1); // convert object to array
	  

	
$Name=utf8_encode($value["Name"]);
$U_BookingDate=utf8_encode($value["U_BookingDate"]);
$U_BookingId=utf8_encode($value["U_BookingId"]);
$U_CustomerName=utf8_encode($value["U_CustomerName"]);
$U_TruckerName=utf8_encode($value["U_TruckerName"]);
$U_VehicleTypeCap=utf8_encode($value["U_VehicleTypeCap"]);
$U_DeliveryOrigin=utf8_encode($value["U_DeliveryOrigin"]);
$U_Destination=utf8_encode($value["U_Destination"]);
$U_DeliveryStatus=utf8_encode($value["U_DeliveryStatus"]);
$U_NoOfDrops=utf8_encode($value["U_NoOfDrops"]);
$U_TripType=utf8_encode($value["U_TripType"]);
$U_RemarksPOD=utf8_encode($value["U_RemarksPOD"]);

$U_GrossClientRates=utf8_encode($value["U_GrossClientRates"]);
$U_GrossClientRatesTax=utf8_encode($value["U_GrossClientRatesTax"]);
$U_RateBasis=utf8_encode($value["U_RateBasis"]);
$U_TaxType=utf8_encode($value["U_TaxType"]);
$U_GrossTruckerRates=utf8_encode($value["U_GrossTruckerRates"]);
$U_GrossTruckerRatesTax=utf8_encode($value["U_GrossTruckerRatesTax"]);
$U_RateBasisT=utf8_encode($value["U_RateBasisT"]);
$U_TaxTypeT=utf8_encode($value["U_TaxTypeT"]);
$U_Demurrage=utf8_encode($value["U_Demurrage"]);
$U_AddtlDrop=utf8_encode($value["U_AddtlDrop"]);
$U_BoomTruck=utf8_encode($value["U_BoomTruck"]);
$U_Manpower=utf8_encode($value["U_Manpower"]);
$U_Backload=utf8_encode($value["U_Backload"]);
$U_TotalAddtlCharges=utf8_encode($value["U_TotalAddtlCharges"]);
$U_AddtlCharges=utf8_encode($value["U_AddtlCharges"]);
$U_Demurrage2=utf8_encode($value["U_Demurrage2"]);
$U_AddtlDrop2=utf8_encode($value["U_AddtlDrop2"]);
$U_BoomTruck2=utf8_encode($value["U_BoomTruck2"]);
$U_Manpower2=utf8_encode($value["U_Manpower2"]);
$U_Backload2=utf8_encode($value["U_Backload2"]);
$U_totalAddtlCharges2=utf8_encode($value["U_totalAddtlCharges2"]);
$U_AddtlCharges2=utf8_encode($value["U_AddtlCharges2"]);
$U_TotalInitialClient=utf8_encode($value["U_TotalInitialClient"]);
$U_TotalInitialTruckers=utf8_encode($value["U_TotalInitialTruckers"]);
$U_TotalGrossProfit=utf8_encode($value["U_TotalGrossProfit"]);



$qry5PODCode = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
	SELECT Code FROM [@PCTP_POD] WHERE U_BookingNumber = '$U_BookingId'");
	while (odbc_fetch_row($qry5PODCode)) 
		{
			$PODNum = odbc_result($qry5PODCode, "Code");
			
		}





					try{



				  $qry5 = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 




					BEGIN
					   IF NOT EXISTS (SELECT * FROM [@PCTP_PRICING]
					                   WHERE U_BookingId = '$U_BookingNumber')
					   BEGIN
					       

							INSERT INTO [@PCTP_PRICING]

								(
										
Name	,
U_BookingDate	,
U_BookingId	,
U_CustomerName	,
U_TruckerName	,
U_VehicleTypeCap	,
U_DeliveryOrigin	,
U_Destination	,
U_DeliveryStatus	,
U_NoOfDrops	,
U_TripType	,
U_RemarksPOD	,
U_GrossClientRates,
U_GrossClientRatesTax,
U_RateBasis,
U_TaxType,
U_GrossTruckerRates,
U_GrossTruckerRatesTax,
U_RateBasisT,
U_TaxTypeT,
U_Demurrage,
U_AddtlDrop,
U_BoomTruck,
U_Manpower,
U_Backload,
U_TotalAddtlCharges,
U_AddtlCharges,
U_Demurrage2,
U_AddtlDrop2,
U_BoomTruck2,
U_Manpower2,
U_Backload2,
U_totalAddtlCharges2,
U_AddtlCharges2,
U_TotalInitialClient,
U_TotalInitialTruckers,
U_TotalGrossProfit,

U_PODNum

											
								)

								VALUES 
								(
									
'$Name',
'$U_BookingDate',
'$U_BookingId',
'$U_CustomerName',
'$U_TruckerName',
'$U_VehicleTypeCap',
'$U_DeliveryOrigin',
'$U_Destination',
'$U_DeliveryStatus',
$U_NoOfDrops,
'$U_TripType',
'$U_RemarksPOD',
$U_GrossClientRates,
$U_GrossClientRatesTax,
'$U_RateBasis',
'$U_TaxType',
$U_GrossTruckerRates,
$U_GrossTruckerRatesTax,
'$U_RateBasisT',
'$U_TaxTypeT',
$U_Demurrage,
$U_AddtlDrop,
$U_BoomTruck,
$U_Manpower,
$U_Backload,
$U_TotalAddtlCharges,
$U_AddtlCharges,
$U_Demurrage2,
$U_AddtlDrop2,
$U_BoomTruck2,
$U_Manpower2,
$U_Backload2,
$U_totalAddtlCharges2,
$U_AddtlCharges2,
$U_TotalInitialClient,
$U_TotalInitialTruckers,
$U_TotalGrossProfit,

'$PODNum'

								)


					   END
			
					END

				 	

					");
				
			}
		 catch (Exception $e) {

		
			
			}
			
		}

	}


// odbc_free_result($qry);

// odbc_free_result($qryAA);
// odbc_free_result($qryBB);


odbc_free_result($qry5);
odbc_close($MSSQL_CONN);


		// if($existingItem == 1 && $existingPOD == 0){
			
		// }

				
	if ($err == 0) 
	{

		//  $qryDeleteMultiple = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
  //  EXEC USP_DELETE_DUPLICATE_BN
 	// ");

		$data = array("valid"=>true, 
							"loggedIn" => 'Logged In!',
							"msg" => "Operation completed successfully!",
							"ItemPosted"=>$ItemPosted,
							"PODPosted"=>$PODPosted,
							"podData"=>$value

						);
		echo json_encode($data);
	}
	else
	{
		$data = array("valid"=>false, "msg"=>$errmsg);
		echo json_encode($data);
	}

?>