<?php 
session_start();
include('../../../../../config/config.php');

	$err = 0;
	$errmsg = '';
	$ItemCode = '';

	$pid = $_GET["pid"];


	$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
		SELECT 

		
		T0.Code,
		T0.Name,
		CONVERT(VARCHAR(10),T0.U_BookingDate,23) AS U_BookingDate,
		U_BookingNumber,
		T1.CardName AS U_ClientName,
		U_SAPClient,
		T0.U_TruckerName,
		U_SAPTrucker,
		U_PlateNumber,
		T0.U_VehicleTypeCap,
		
		
		T0.U_DeliveryStatus,
		CONVERT(VARCHAR(10),U_DeliveryDateDTR,23) AS U_DeliveryDateDTR,
		CONVERT(VARCHAR(10),U_DeliveryDatePOD,23) AS U_DeliveryDatePOD,
		T0.U_NoOfDrops,
		T0.U_TripType,
		CAST(U_Remarks AS NVARCHAR) AS U_Remarks,
		U_TripTicketNo,
		U_WaybillNo,
		U_ShipmentNo,
		U_DeliveryReceiptNo,
		U_SeriesNo,
		CAST(U_OtherPODDoc AS NVARCHAR) AS U_OtherPODDoc,
		CAST(T0.U_RemarksPOD AS NVARCHAR) AS U_RemarksPOD, 
		U_Receivedby,
		CONVERT(VARCHAR(10),U_ClientReceivedDate,23) AS U_ClientReceivedDate,
		CONVERT(VARCHAR(10),U_InitialHCRecDate,23) AS U_InitialHCRecDate,
		CONVERT(VARCHAR(10),U_ActualHCRecDate,23) AS U_ActualHCRecDate,
		CONVERT(VARCHAR(10),U_DateReturned,23) AS U_DateReturned,
		U_PODinCharge,
		CONVERT(VARCHAR(10),U_VerifiedDateHC,23) AS U_VerifiedDateHC,
		CAST(U_PODStatusDetail AS NVARCHAR) AS U_PODStatusDetail,
		U_PTFNo,
		CONVERT(VARCHAR(10),U_DateForwardedBT,23) AS U_DateForwardedBT,
		U_BillingDeadline,
		U_BillingStatus,
		T0.U_ServiceType,
		U_SINo,
		U_BillingTeam,
		CAST(U_BTRemarks AS NVARCHAR) AS U_BTRemarks, 
		U_SOBNumber,
		U_OutletNo,
		U_CBM,
		U_SI_DRNo,
		U_DeliveryMode,
		U_SourceWhse,
		CAST(U_DestinationClient AS NVARCHAR) AS U_DestinationClient, 
		
		U_TotalInvAmount,
		U_SONo,
		U_NameCustomer,
		U_CategoryDR,
		U_ForwardLoad,
		T0.U_BackLoad,
		U_IDNumber,
		U_TypeOfAccessorial,
		U_ApprovalStatus,
		U_TimeInEmptyDem,
		U_TimeOutEmptyDem,
		U_VerifiedEmptyDem,
		U_TimeInLoadedDem,
		U_TimeOutLoadedDem,
		U_VerifiedLoadedDem,
		CAST(U_Remarks2 AS NVARCHAR) AS U_Remarks2,
		U_TimeInAdvLoading,
		U_DayOfTheWeek,
		U_TimeIn,
		U_TimeOut,
		U_ODOIn,
		U_ODOOut,
		CASE WHEN ISNULL(U_ClientReceivedDate, '') != '' THEN 
		'SUBMITTED'
		ELSE 'PENDING'
		END AS   U_ClientSubStatus,
		U_ClientSubOverdue,
		ISNULL(U_ClientPenaltyCalc, 0) AS U_ClientPenaltyCalc,

		CASE WHEN ISNULL(U_InitialHCRecDate,'') = '' THEN
			CASE 
				WHEN DATEDIFF(day, DATEADD(day, CAST(ISNULL(T1.U_CDC,0) AS INT), U_DeliveryDateDTR), GETDATE() ) < 0 THEN 'Ontime' 
				WHEN DATEDIFF(day, DATEADD(day, CAST(ISNULL(T1.U_CDC,0) AS INT), U_DeliveryDateDTR), GETDATE() )  > 0 AND DATEDIFF(day, DATEADD(day, CAST(ISNULL(T1.U_CDC,0) AS INT), U_DeliveryDateDTR), GETDATE() ) < 20  THEN 'Late' 
				WHEN DATEDIFF(day, DATEADD(day, CAST(ISNULL(T1.U_CDC,0) AS INT), U_DeliveryDateDTR), GETDATE() ) >= 20 THEN 'Lost' 

				END
		ELSE 
			CASE 
				WHEN DATEDIFF(day, U_InitialHCRecDate, GETDATE() )  < 0 THEN 'Ontime' 
				WHEN DATEDIFF(day, U_InitialHCRecDate, GETDATE() )  > 0 AND DATEDIFF(day, U_InitialHCRecDate, GETDATE() ) < 20  THEN 'Late' 
				WHEN DATEDIFF(day, U_InitialHCRecDate, GETDATE() )  >= 20 THEN 'Lost' 

			END

			
		END AS U_PODStatusPayment,

		CONVERT(VARCHAR(10),DATEADD(day, CAST(ISNULL(T1.U_CDC,0) AS INT), U_DeliveryDateDTR),23) AS U_PODSubmitDeadline,
		CASE WHEN ISNULL(U_InitialHCRecDate,'') = '' THEN
		DATEDIFF(day, DATEADD(day, CAST(ISNULL(T1.U_CDC,0) AS INT), U_DeliveryDateDTR), GETDATE() ) 
		ELSE 
		DATEDIFF(day, U_InitialHCRecDate, GETDATE() ) 
		END AS U_OverdueDays,

		ISNULL(U_InteluckPenaltyCalc,0) AS U_InteluckPenaltyCalc,
		U_WaivedDays,
		U_HolidayOrWeekend,
		ISNULL(U_LostPenaltyCalc,0) AS U_LostPenaltyCalc,
		U_TotalSubPenalties,
		U_Waived,
		U_PercPenaltyCharge,
		U_Approvedby,
		U_TotalPenaltyWaived,
		U_DocNum,
		CONVERT(VARCHAR(10),T0.U_UpdateDate,23) AS U_UpdateDate,
		CONVERT(VARCHAR(10),T0.U_CreateDate,23) AS U_CreateDate,
		CAST(U_Attachment AS NVARCHAR) AS U_Attachment,
		U_Creator,
		U_TotalNoExceed,
		U_TotalUsage,
		ISNULL(T1.U_CDC,0) AS ClientLeadTime,
		T2.U_TotalInitialTruckers,


		CAST(T0.U_DeliveryOrigin as nvarchar) AS U_DeliveryOrigin,
		CAST(T0.U_Destination as nvarchar) AS U_Destination



		FROM [dbo].[@PCTP_POD] T0
		LEFT JOIN OCRD T1 ON U_SAPClient = T1.CardCode
		LEFT JOIN [dbo].[@PCTP_PRICING] T2 ON T0.Code = T2.U_PODNum


		WHERE T0.Code = $pid ");


	$arr = array();
	while (odbc_fetch_row($qry)) 
	{
		
		$arr[] = array( 

		"Code"=> odbc_result($qry, 'Code'),
		"Name"=> odbc_result($qry, 'Name'),
		"U_BookingDate"=> odbc_result($qry, 'U_BookingDate'),
		"U_BookingNumber"=> odbc_result($qry, 'U_BookingNumber'),
		"U_ClientName"=> odbc_result($qry, 'U_ClientName'),
		"U_SAPClient"=> odbc_result($qry, 'U_SAPClient'),
		"U_TruckerName"=> odbc_result($qry, 'U_TruckerName'),
		"U_SAPTrucker"=> odbc_result($qry, 'U_SAPTrucker'),
		"U_PlateNumber"=> odbc_result($qry, 'U_PlateNumber'),
		"U_VehicleTypeCap"=> odbc_result($qry, 'U_VehicleTypeCap'),
		"U_DeliveryOrigin"=> odbc_result($qry, 'U_DeliveryOrigin'),
		"U_Destination"=> odbc_result($qry, 'U_Destination'),
		"U_DeliveryStatus"=> odbc_result($qry, 'U_DeliveryStatus'),
		"U_DeliveryDateDTR"=> odbc_result($qry, 'U_DeliveryDateDTR'),
		"U_DeliveryDatePOD"=> odbc_result($qry, 'U_DeliveryDatePOD'),
		"U_NoOfDrops"=> odbc_result($qry, 'U_NoOfDrops'),
		"U_TripType"=> odbc_result($qry, 'U_TripType'),
		"U_Remarks"=> odbc_result($qry, 'U_Remarks'),
		"U_TripTicketNo"=> odbc_result($qry, 'U_TripTicketNo'),
		"U_WaybillNo"=> odbc_result($qry, 'U_WaybillNo'),
		"U_ShipmentNo"=> odbc_result($qry, 'U_ShipmentNo'),
		"U_DeliveryReceiptNo"=> odbc_result($qry, 'U_DeliveryReceiptNo'),
		"U_SeriesNo"=> odbc_result($qry, 'U_SeriesNo'),
		"U_OtherPODDoc"=> odbc_result($qry, 'U_OtherPODDoc'),
		"U_RemarksPOD"=> odbc_result($qry, 'U_RemarksPOD'),
		"U_Receivedby"=> odbc_result($qry, 'U_Receivedby'),
		"U_ClientReceivedDate"=> odbc_result($qry, 'U_ClientReceivedDate'),
		"U_InitialHCRecDate"=> odbc_result($qry, 'U_InitialHCRecDate'),
		"U_ActualHCRecDate"=> odbc_result($qry, 'U_ActualHCRecDate'),
		"U_DateReturned"=> odbc_result($qry, 'U_DateReturned'),
		"U_PODinCharge"=> odbc_result($qry, 'U_PODinCharge'),
		"U_VerifiedDateHC"=> odbc_result($qry, 'U_VerifiedDateHC'),
		"U_PODStatusDetail"=> odbc_result($qry, 'U_PODStatusDetail'),
		"U_PTFNo"=> odbc_result($qry, 'U_PTFNo'),
		"U_DateForwardedBT"=> odbc_result($qry, 'U_DateForwardedBT'),
		"U_BillingDeadline"=> odbc_result($qry, 'U_BillingDeadline'),
		"U_BillingStatus"=> odbc_result($qry, 'U_BillingStatus'),
		"U_ServiceType"=> odbc_result($qry, 'U_ServiceType'),
		"U_SINo"=> odbc_result($qry, 'U_SINo'),
		"U_BillingTeam"=> odbc_result($qry, 'U_BillingTeam'),
		"U_BTRemarks"=> odbc_result($qry, 'U_BTRemarks'),
		"U_SOBNumber"=> odbc_result($qry, 'U_SOBNumber'),
		"U_OutletNo"=> odbc_result($qry, 'U_OutletNo'),
		"U_CBM"=> odbc_result($qry, 'U_CBM'),
		"U_SI_DRNo"=> odbc_result($qry, 'U_SI_DRNo'),
		"U_DeliveryMode"=> odbc_result($qry, 'U_DeliveryMode'),
		"U_SourceWhse"=> odbc_result($qry, 'U_SourceWhse'),
		"U_DestinationClient"=> odbc_result($qry, 'U_DestinationClient'),
		"U_TotalInvAmount"=> odbc_result($qry, 'U_TotalInvAmount'),
		"U_SONo"=> odbc_result($qry, 'U_SONo'),
		"U_NameCustomer"=> odbc_result($qry, 'U_NameCustomer'),
		"U_CategoryDR"=> odbc_result($qry, 'U_CategoryDR'),
		"U_ForwardLoad"=> odbc_result($qry, 'U_ForwardLoad'),
		"U_BackLoad"=> odbc_result($qry, 'U_BackLoad'),
		"U_IDNumber"=> odbc_result($qry, 'U_IDNumber'),
		"U_TypeOfAccessorial"=> odbc_result($qry, 'U_TypeOfAccessorial'),
		"U_ApprovalStatus"=> odbc_result($qry, 'U_ApprovalStatus'),
		"U_TimeInEmptyDem"=> odbc_result($qry, 'U_TimeInEmptyDem'),
		"U_TimeOutEmptyDem"=> odbc_result($qry, 'U_TimeOutEmptyDem'),
		"U_VerifiedEmptyDem"=> odbc_result($qry, 'U_VerifiedEmptyDem'),
		"U_TimeInLoadedDem"=> odbc_result($qry, 'U_TimeInLoadedDem'),
		"U_TimeOutLoadedDem"=> odbc_result($qry, 'U_TimeOutLoadedDem'),
		"U_VerifiedLoadedDem"=> odbc_result($qry, 'U_VerifiedLoadedDem'),
		"U_Remarks2"=> odbc_result($qry, 'U_Remarks2'),
		"U_TimeInAdvLoading"=> odbc_result($qry, 'U_TimeInAdvLoading'),
		"U_DayOfTheWeek"=> odbc_result($qry, 'U_DayOfTheWeek'),
		"U_TimeIn"=> odbc_result($qry, 'U_TimeIn'),
		"U_TimeOut"=> odbc_result($qry, 'U_TimeOut'),
		"U_ODOIn"=> odbc_result($qry, 'U_ODOIn'),
		"U_ODOOut"=> odbc_result($qry, 'U_ODOOut'),
		"U_ClientSubStatus"=> odbc_result($qry, 'U_ClientSubStatus'),
		"U_ClientSubOverdue"=> odbc_result($qry, 'U_ClientSubOverdue'),
		"U_ClientPenaltyCalc"=> odbc_result($qry, 'U_ClientPenaltyCalc'),
		"U_PODStatusPayment"=> odbc_result($qry, 'U_PODStatusPayment'),
		"U_PODSubmitDeadline"=> odbc_result($qry, 'U_PODSubmitDeadline'),
		"U_OverdueDays"=> odbc_result($qry, 'U_OverdueDays'),
		"U_InteluckPenaltyCalc"=> odbc_result($qry, 'U_InteluckPenaltyCalc'),
		"U_WaivedDays"=> odbc_result($qry, 'U_WaivedDays'),
		"U_HolidayOrWeekend"=> odbc_result($qry, 'U_HolidayOrWeekend'),
		"U_LostPenaltyCalc"=> odbc_result($qry, 'U_LostPenaltyCalc'),
		"U_TotalSubPenalties"=> odbc_result($qry, 'U_TotalSubPenalties'),
		"U_Waived"=> odbc_result($qry, 'U_Waived'),
		"U_PercPenaltyCharge"=> odbc_result($qry, 'U_PercPenaltyCharge'),
		"U_Approvedby"=> odbc_result($qry, 'U_Approvedby'),
		"U_TotalPenaltyWaived"=> odbc_result($qry, 'U_TotalPenaltyWaived'),
		"U_DocNum"=> odbc_result($qry, 'U_DocNum'),
		"U_UpdateDate"=> odbc_result($qry, 'U_UpdateDate'),
		"U_CreateDate"=> odbc_result($qry, 'U_CreateDate'),
		"U_Attachment"=> odbc_result($qry, 'U_Attachment'),
		"U_Creator"=> odbc_result($qry, 'U_Creator'),
		"U_TotalNoExceed"=> odbc_result($qry, 'U_TotalNoExceed'),
		"U_TotalUsage"=> odbc_result($qry, 'U_TotalUsage'),
		"ClientLeadTime"=> odbc_result($qry, 'ClientLeadTime'),
		"U_TotalInitialTruckers"=> odbc_result($qry, 'U_TotalInitialTruckers')
		
	);
		
		
	}
	
	
	if ($err == 0) 
	{

		
		echo json_encode($arr);
		
		
	}
	else
	{
		echo 'FAILURE!';
	
	}

?>
	