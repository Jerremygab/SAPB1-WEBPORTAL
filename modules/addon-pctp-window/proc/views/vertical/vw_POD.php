<?php 
session_start();
include('../../../../../config/config.php');


	$err = 0;
	$errmsg = '';
	$ItemCode = '';

	$pid = $_GET["pid"];


	$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
		
	SELECT 

	CASE
   WHEN EXISTS(SELECT 1 FROM OINV H, INV1 L WHERE H.DocEntry = L.DocEntry AND L.ItemCode = T0.U_BookingNumber AND H.CANCELED = 'N')
	   AND EXISTS(
		   SELECT 1 
		   FROM OPCH H, PCH1 L 
		   WHERE H.DocEntry = L.DocEntry AND H.CANCELED = 'N' 
		   AND (L.ItemCode = T0.U_BookingNumber
		   OR (REPLACE(REPLACE(RTRIM(LTRIM(T0.U_PVNo)), ' ', ''), ',', '') LIKE '%' + RTRIM(LTRIM(H.U_PVNo)) + '%')))
   THEN 'Y'
   ELSE 'N'
END AS DisableTableRow,


   T0.su_Code,
   T0.po_Code,
   CONVERT(VARCHAR(10),T0.U_BookingDate,23) AS U_BookingDate,
   U_BookingNumber,
   T1.CardName AS U_ClientName,
   T0.U_SAPClient,
   T0.U_TruckerName,
   U_SAPTrucker,
   T0.U_PlateNumber,
   T0.U_VehicleTypeCap,
   
   
   T0.U_DeliveryStatus,
   CONVERT(VARCHAR(10),U_DeliveryDateDTR,23) AS U_DeliveryDateDTR,
   CONVERT(VARCHAR(10),T0.U_DeliveryDatePOD,23) AS U_DeliveryDatePOD,
   T0.U_NoOfDrops,
   T0.U_TripType,
   CAST(T0.U_Remarks AS NVARCHAR(200)) AS U_Remarks,
   CAST(T0.U_TripTicketNo AS NVARCHAR(200)) AS U_TripTicketNo,
   CAST(T0.U_WaybillNo AS NVARCHAR(200)) AS U_WaybillNo,
   CAST(T0.U_ShipmentNo AS NVARCHAR(200)) AS U_ShipmentNo,
   CAST(T0.U_DeliveryReceiptNo AS NVARCHAR(200)) AS U_DeliveryReceiptNo,
   CAST(T0.U_SeriesNo AS NVARCHAR(200)) AS U_SeriesNo,
   CAST(T0.U_OtherPODDoc AS NVARCHAR(200)) AS U_OtherPODDoc,
   CAST(T0.U_RemarksPOD AS NVARCHAR(200)) AS U_RemarksPOD, 
   U_Receivedby,
   CONVERT(VARCHAR(10),T0.U_ClientReceivedDate,23) AS U_ClientReceivedDate,
   CONVERT(VARCHAR(10),U_InitialHCRecDate,23) AS U_InitialHCRecDate,
   CONVERT(VARCHAR(10),T0.U_ActualHCRecDate,23) AS U_ActualHCRecDate,
   CONVERT(VARCHAR(10),U_DateReturned,23) AS U_DateReturned,
   T0.U_PODinCharge,
   CONVERT(VARCHAR(10),T0.U_VerifiedDateHC,23) AS U_VerifiedDateHC,
   CAST(T0.U_PODStatusDetail AS NVARCHAR) AS U_PODStatusDetail,
   T0.U_PTFNo,
   CONVERT(VARCHAR(10),T0.U_DateForwardedBT,23) AS U_DateForwardedBT,
   T0.U_BillingDeadline,
   T0.U_BillingStatus,
   T0.U_ServiceType,
   T0.U_SINo,
   T0.U_BillingTeam,
   CAST(T0.U_BTRemarks AS NVARCHAR(200)) AS U_BTRemarks, 
   CAST(T0.U_SOBNumber AS NVARCHAR(200)) AS U_SOBNumber, 
   CAST(T0.U_OutletNo AS NVARCHAR(200)) AS U_OutletNo, 
   CAST(T0.U_CBM AS NVARCHAR(200)) AS U_CBM, 
   CAST(T0.U_SI_DRNo AS NVARCHAR(200)) AS U_SI_DRNo, 
   CAST(T0.U_DeliveryMode AS NVARCHAR(200)) AS U_DeliveryMode, 
   CAST(T0.U_SourceWhse AS NVARCHAR(200)) AS U_SourceWhse, 
   
   CAST(T0.U_DestinationClient AS  NVARCHAR(200)) AS U_DestinationClient, 
   

   CAST(T0.U_TotalInvAmount AS  NVARCHAR(200)) AS U_TotalInvAmount, 
   CAST(T0.U_SONo AS  NVARCHAR(200)) AS U_SONo, 
   CAST(T0.U_NameCustomer AS  NVARCHAR(200)) AS U_NameCustomer, 
   CAST(T0.U_CategoryDR AS  NVARCHAR(200)) AS U_CategoryDR, 
   CAST(T0.U_ForwardLoad AS  NVARCHAR(200)) AS U_ForwardLoad, 

   CAST(T0.U_IDNumber AS  NVARCHAR(200)) AS U_IDNumber, 


   --T0.U_BackLoad,
   
   T0.U_TypeOfAccessorial,

   CAST(T0.U_ApprovalStatus AS  NVARCHAR(200)) AS U_ApprovalStatus, 

   T0.U_TimeInEmptyDem,
   T0.U_TimeOutEmptyDem,
   T0.U_VerifiedEmptyDem,
   T0.U_TimeInLoadedDem,
   T0.U_TimeOutLoadedDem,
   T0.U_VerifiedLoadedDem,
   CAST(U_Remarks2 AS NVARCHAR) AS U_Remarks2,
   T0.U_TimeInAdvLoading,
   DATENAME(WEEKDAY, T0.U_BookingDate) AS U_DayOfTheWeek,
   T0.U_TimeIn,
   T0.U_TimeOut,
   T0.U_ODOIn,
   T0.U_ODOOut,
   CASE WHEN ISNULL(T0.U_ClientReceivedDate, '') != '' THEN 
   'SUBMITTED'
   ELSE 'PENDING'
   END AS   U_ClientSubStatus,
	CASE WHEN ISNULL(T0.U_ClientReceivedDate,'') != '' AND ISNULL(T0.U_DeliveryDateDTR,'') != '' THEN DATEDIFF(day, T0.U_ClientReceivedDate, T0.U_DeliveryDateDTR) + ISNULL(T1.U_DCD,0) + CAST(ISNULL(T0.U_WaivedDays,'0') AS int) 
	   ELSE 0 END AS U_ClientSubOverdue, 


CASE WHEN ISNULL(T0.U_ClientReceivedDate,'') != '' AND ISNULL(T0.U_DeliveryDateDTR,'') != '' THEN DATEDIFF(day, T0.U_ClientReceivedDate, T0.U_DeliveryDateDTR) + ISNULL(T1.U_DCD,0) + CAST(ISNULL(T0.U_WaivedDays,'0') AS int) 
ELSE 0 END AS 'U_ClientSubOverdue', 
CASE WHEN ISNULL(T0.U_ClientReceivedDate,'') != '' AND ISNULL(T0.U_DeliveryDateDTR,'') != '' THEN 
   (CASE WHEN (DATEDIFF(day, T0.U_ClientReceivedDate, T0.U_DeliveryDateDTR) + ISNULL(T1.U_DCD,0)) < 0 THEN (DATEDIFF(day, T0.U_ClientReceivedDate, T0.U_DeliveryDateDTR) + ISNULL(T1.U_DCD,0)) * 1000 ELSE 0 END)
ELSE 0 END AS U_ClientPenaltyCalc,
   U_InitialHCRecDate,
   U_DeliveryDateDTR,
   CASE 
   WHEN ISNULL(T0.U_ActualHCRecDate,'') = '' AND ISNULL(T0.U_DeliveryDateDTR,'') != ''  THEN 
	   (CASE WHEN DATEDIFF(day, GETDATE(), DATEADD(day, CAST(ISNULL(T1.U_CDC,'0') AS int) , T0.U_DeliveryDateDTR)) >= 0 THEN 'Ontime' 
		   WHEN DATEDIFF(day, GETDATE(), DATEADD(day, CAST(ISNULL(T1.U_CDC,'0') AS int) , T0.U_DeliveryDateDTR)) BETWEEN -13 AND 0 THEN 'Late'
		   WHEN DATEDIFF(day, GETDATE(), DATEADD(day, CAST(ISNULL(T1.U_CDC,'0') AS int) , T0.U_DeliveryDateDTR)) <= -13 THEN 'Lost'
	   END)
   WHEN ISNULL(T0.U_ActualHCRecDate,'') != '' AND ISNULL(T0.U_DeliveryDateDTR,'') != '' THEN 
	   (CASE WHEN DATEDIFF(day, T0.U_ActualHCRecDate, DATEADD(day, CAST(ISNULL(T1.U_CDC,'0') AS int) , T0.U_DeliveryDateDTR)) >= 0 THEN 'Ontime'
		   WHEN DATEDIFF(day, T0.U_ActualHCRecDate, DATEADD(day, CAST(ISNULL(T1.U_CDC,'0') AS int) , T0.U_DeliveryDateDTR)) BETWEEN -13 AND 0 THEN 'Late'
		   WHEN DATEDIFF(day, T0.U_ActualHCRecDate, DATEADD(day, CAST(ISNULL(T1.U_CDC,'0') AS int) , T0.U_DeliveryDateDTR)) <= -13 THEN 'Lost'
	   END)
   ELSE '' END AS U_PODStatusPayment,

   CONVERT(VARCHAR(10),DATEADD(day, CAST(ISNULL(T1.U_CDC,0) AS INT), U_DeliveryDateDTR),23) AS U_PODSubmitDeadline,

   
	 CASE 
   WHEN ISNULL(T0.U_ActualHCRecDate,'') = '' AND ISNULL(T0.U_DeliveryDateDTR,'') != '' THEN DATEDIFF(day, GETDATE(), DATEADD(day, CAST(ISNULL(T1.U_CDC,'0') AS int) + CAST(ISNULL(T0.U_HolidayOrWeekend,'0') AS int), T0.U_DeliveryDateDTR))
   WHEN ISNULL(T0.U_ActualHCRecDate,'') != '' AND ISNULL(T0.U_DeliveryDateDTR,'') != '' THEN DATEDIFF(day, T0.U_ActualHCRecDate, DATEADD(day, CAST(ISNULL(T1.U_CDC,'0') AS int) + CAST(ISNULL(T0.U_HolidayOrWeekend,'0') AS int), T0.U_DeliveryDateDTR))
ELSE 0 END AS 'U_OverdueDays',

ISNULL(U_WaivedDays,'0') AS U_WaivedDays,
ISNULL(U_HolidayOrWeekend,'0') AS U_HolidayOrWeekend,


CASE 
WHEN ISNULL(T0.U_InitialHCRecDate,'') = '' AND ISNULL(T0.U_DeliveryDateDTR,'') != '' THEN 
(CASE WHEN DATEDIFF(day, GETDATE(), DATEADD(day, CAST(ISNULL(T1.U_CDC,'0') AS Float) , T0.U_DeliveryDateDTR)) BETWEEN -13 AND 0 THEN CAST(DATEDIFF(day, GETDATE(), DATEADD(day, CAST(ISNULL(T1.U_CDC,'0') AS Float) , T0.U_DeliveryDateDTR)) * 1000 AS FLOAT)ELSE 0 END)
WHEN ISNULL(T0.U_InitialHCRecDate,'') != '' AND ISNULL(T0.U_DeliveryDateDTR,'') != '' THEN 
(CASE WHEN DATEDIFF(day, T0.U_InitialHCRecDate, DATEADD(day, CAST(ISNULL(T1.U_CDC,'0') AS Float) , T0.U_DeliveryDateDTR)) BETWEEN -13 AND 0 THEN DATEDIFF(day, T0.U_InitialHCRecDate, DATEADD(day, CAST(ISNULL(T1.U_CDC,'0') AS Float) , T0.U_DeliveryDateDTR)) * 1000 ELSE 0 END)
ELSE 0 END AS U_InteluckPenaltyCalc,

ISNULL(CASE 
WHEN ISNULL(T0.U_InitialHCRecDate,'') = '' AND ISNULL(T0.U_DeliveryDateDTR,'') != '' THEN 
(CASE WHEN DATEDIFF(day, GETDATE(), DATEADD(day, CAST(ISNULL(T1.U_CDC,'0') AS Float) , T0.U_DeliveryDateDTR)) <= -13 THEN (CASE WHEN CAST(ISNULL(T0.U_TotalInitialTruckers,0) AS FLOAT) <> 0 THEN - CAST(CAST(T0.U_TotalInitialTruckers AS FLOAT) * 2 AS FLOAT) ELSE 0 END) END )
WHEN ISNULL(T0.U_InitialHCRecDate,'') != '' AND ISNULL(T0.U_DeliveryDateDTR,'') != '' THEN 
(CASE WHEN DATEDIFF(day, T0.U_InitialHCRecDate, DATEADD(day, CAST(ISNULL(T1.U_CDC,'0') AS Float) , T0.U_DeliveryDateDTR)) <= -13 THEN (CASE WHEN CAST(ISNULL(T0.U_TotalInitialTruckers,0) AS FLOAT) <> 0 THEN - CAST(CAST(T0.U_TotalInitialTruckers AS FLOAT) * 2 AS FLOAT) ELSE 0 END) END )
ELSE 0 END,0) AS U_LostPenaltyCalc,


   
   CAST(replace(U_TotalSubPenalties,',','') AS float) AS U_TotalSubPenalties,
   U_PenaltiesManual,
   CASE WHEN ISNULL(T0.U_Waived,'') = '' THEN 'N' 
   ELSE T0.U_Waived END AS U_Waived,
   U_PercPenaltyCharge,
   U_Approvedby,
   T0.U_ServiceType,
   T0.U_SINo,
   
   --CAST(replace(U_TotalPenaltyWaived,',','') AS float) AS U_TotalPenaltyWaived,
dbo.computeTotalPenaltyWaived(
   dbo.computeTotalSubPenalties(
	   dbo.computeClientPenaltyCalc(
		   dbo.computeClientSubOverdue(
			   T0.U_DeliveryDateDTR,
			   T0.U_ClientReceivedDate,
			   ISNULL(T0.U_WaivedDays, 0),
			   CAST(ISNULL(T1.U_DCD,0) as int)
		   )
	   ),
	   dbo.computeInteluckPenaltyCalc(
		   dbo.computePODStatusPayment(
			   dbo.computeOverdueDays(
				   T0.U_ActualHCRecDate,
				   dbo.computePODSubmitDeadline(
					   T0.U_DeliveryDateDTR,
					   ISNULL(T1.U_CDC,0)
				   ),
				   ISNULL(T0.U_HolidayOrWeekend, 0)
			   )
		   ),
		   dbo.computeOverdueDays(
			   T0.U_ActualHCRecDate,
			   dbo.computePODSubmitDeadline(
				   T0.U_DeliveryDateDTR,
				   ISNULL(T1.U_CDC,0)
			   ),
			   ISNULL(T0.U_HolidayOrWeekend, 0)
		   )
	   ),
	   dbo.computeLostPenaltyCalc(
		   dbo.computePODStatusPayment(
			   dbo.computeOverdueDays(
				   T0.U_ActualHCRecDate,
				   dbo.computePODSubmitDeadline(
					   T0.U_DeliveryDateDTR,
					   ISNULL(T1.U_CDC,0)
				   ),
				   ISNULL(T0.U_HolidayOrWeekend, 0)
			   )
		   ),
		   T0.U_InitialHCRecDate,
		   T0.U_DeliveryDateDTR,
		   T0.U_TotalInitialTruckers
	   ),
	   ISNULL(T0.U_PenaltiesManual,0)
   ),
   ISNULL(T0.U_PercPenaltyCharge,0)
) AS U_TotalPenaltyWaived,

   CAST(T0.U_PODDocNum AS  NVARCHAR(200)) AS U_DocNum, 

   --CONVERT(VARCHAR(10),T0.U_UpdateDate,23) AS U_UpdateDate,
   --CONVERT(VARCHAR(10),T0.U_CreateDate,23) AS U_CreateDate,
   CAST(U_Attachment AS NVARCHAR) AS U_Attachment,
   --U_Creator,
   U_TotalNoExceed,
   T0.U_TotalUsage,
   ISNULL(T1.U_DCD,0) AS U_ClientLeadTime,
   T0.U_TotalInitialTruckers,


   REPLACE(CAST(T0.U_DeliveryOrigin as NVARCHAR(200)), '%', ' ') AS U_DeliveryOrigin,
   REPLACE(CAST(T0.U_Destination as NVARCHAR(200)), '%', ' ') AS U_Destination,
   ISNULL(T1.U_CDC,'0') AS U_CDC,

   ISNULL(T0.U_ISLAND,'LUZON') AS U_ISLAND,
   ISNULL(T0.U_ISLAND_D,'LUZON') AS U_ISLAND_D,
   ISNULL(NULLIF(T0.U_IFINTERISLAND,''), 'No') AS U_IFINTERISLAND,
   T0.U_VERIFICATION_TAT,
   T0.U_POD_TAT,
   T0.U_ActualDateRec_Intitial



   FROM [dbo].[PCTP_UNIFIED] T0
   LEFT JOIN OCRD T1 ON U_SAPClient = T1.CardCode
   --LEFT JOIN [dbo].[@PCTP_PRICING] T2 ON T0.U_BookingNumber = T2.U_BookingId
   --LEFT JOIN [dbo].[@PCTP_BILLING] T3 ON T0.U_BookingNumber = T3.U_BookingId
   --LEFT JOIN [dbo].[@PCTP_TP] T4 ON T0.U_BookingNumber = T4.U_BookingId


		WHERE T0.U_BookingNumber = '$pid' ");


	$arr = array();
	while (odbc_fetch_row($qry)) 
	{
	
		// $data = array("valid"=>true, 
		// 			"msg"=>"Operation completed successfully - " .$docentry,
		// 			"docref"=>$docentry,
		// 			"docentry"=>$docentry);


		$arr = array( 

		"Code"=> odbc_result($qry, 'su_Code'),
		"Name"=> odbc_result($qry, 'po_Code'),
		"U_BookingDate"=> utf8_encode(odbc_result($qry, 'U_BookingDate')),
		"U_BookingNumber"=> utf8_encode(odbc_result($qry, 'U_BookingNumber')),
		"U_ClientName"=> utf8_encode(odbc_result($qry, 'U_ClientName')),
		"U_SAPClient"=> utf8_encode(odbc_result($qry, 'U_SAPClient')),
		"U_TruckerName"=> utf8_encode(odbc_result($qry, 'U_TruckerName')),
		"U_SAPTrucker"=> utf8_encode(odbc_result($qry, 'U_SAPTrucker')),
		"U_PlateNumber"=> utf8_encode(odbc_result($qry, 'U_PlateNumber')),
		"U_VehicleTypeCap"=> utf8_encode(odbc_result($qry, 'U_VehicleTypeCap')),
		"U_DeliveryOrigin"=>odbc_result($qry, 'U_DeliveryOrigin'),
		"U_Destination"=> utf8_encode(odbc_result($qry, 'U_Destination')),
		"U_DeliveryStatus"=> utf8_encode(odbc_result($qry, 'U_DeliveryStatus')),
		"U_DeliveryDateDTR"=> utf8_encode(odbc_result($qry, 'U_DeliveryDateDTR')),
		"U_DeliveryDatePOD"=> utf8_encode(odbc_result($qry, 'U_DeliveryDatePOD')),
		"U_NoOfDrops"=> utf8_encode(odbc_result($qry, 'U_NoOfDrops')),
		"U_TripType"=> utf8_encode(odbc_result($qry, 'U_TripType')),
		"U_Remarks"=> utf8_encode(odbc_result($qry, 'U_Remarks')),
		"U_TripTicketNo"=> utf8_encode(odbc_result($qry, 'U_TripTicketNo')),
		"U_WaybillNo"=> utf8_encode(odbc_result($qry, 'U_WaybillNo')),
		"U_ShipmentNo"=> utf8_encode(odbc_result($qry, 'U_ShipmentNo')),
		"U_DeliveryReceiptNo"=> utf8_encode(odbc_result($qry, 'U_DeliveryReceiptNo')),
		"U_SeriesNo"=> utf8_encode(odbc_result($qry, 'U_SeriesNo')),
		"U_OtherPODDoc"=> utf8_encode(odbc_result($qry, 'U_OtherPODDoc')),
		"U_RemarksPOD"=> utf8_encode(odbc_result($qry, 'U_RemarksPOD')),
		"U_Receivedby"=> utf8_encode(odbc_result($qry, 'U_Receivedby')),
		"U_ClientReceivedDate"=> utf8_encode(odbc_result($qry, 'U_ClientReceivedDate')),
		"U_InitialHCRecDate"=> utf8_encode(odbc_result($qry, 'U_InitialHCRecDate')),
		"U_ActualHCRecDate"=> utf8_encode(odbc_result($qry, 'U_ActualHCRecDate')),
		"U_DateReturned"=> utf8_encode(odbc_result($qry, 'U_DateReturned')),
		"U_PODinCharge"=> utf8_encode(odbc_result($qry, 'U_PODinCharge')),
		"U_VerifiedDateHC"=> utf8_encode(odbc_result($qry, 'U_VerifiedDateHC')),
		"U_PODStatusDetail"=> utf8_encode(odbc_result($qry, 'U_PODStatusDetail')),
		"U_PTFNo"=> utf8_encode(odbc_result($qry, 'U_PTFNo')),
		"U_DateForwardedBT"=> utf8_encode(odbc_result($qry, 'U_DateForwardedBT')),
		"U_BillingDeadline"=> utf8_encode(odbc_result($qry, 'U_BillingDeadline')),
		"U_BillingStatus"=> utf8_encode(odbc_result($qry, 'U_BillingStatus')),
		"U_ServiceType"=> utf8_encode(odbc_result($qry, 'U_ServiceType')),
		"U_SINo"=> utf8_encode(odbc_result($qry, 'U_SINo')),
		"U_BillingTeam"=> utf8_encode(odbc_result($qry, 'U_BillingTeam')),
		"U_BTRemarks"=> utf8_encode(odbc_result($qry, 'U_BTRemarks')),
		"U_SOBNumber"=> utf8_encode(odbc_result($qry, 'U_SOBNumber')),
		"U_OutletNo"=> utf8_encode(odbc_result($qry, 'U_OutletNo')),
		"U_CBM"=> utf8_encode(odbc_result($qry, 'U_CBM')),
		"U_SI_DRNo"=> utf8_encode(odbc_result($qry, 'U_SI_DRNo')),
		"U_DeliveryMode"=> utf8_encode(odbc_result($qry, 'U_DeliveryMode')),
		"U_SourceWhse"=> utf8_encode(odbc_result($qry, 'U_SourceWhse')),
		"U_DestinationClient"=> utf8_encode(odbc_result($qry, 'U_DestinationClient')),
		"U_TotalInvAmount"=> utf8_encode(odbc_result($qry, 'U_TotalInvAmount')),
		"U_SONo"=> utf8_encode(odbc_result($qry, 'U_SONo')),
		"U_NameCustomer"=> utf8_encode(odbc_result($qry, 'U_NameCustomer')),
		"U_CategoryDR"=> utf8_encode(odbc_result($qry, 'U_CategoryDR')),
		"U_ForwardLoad"=> utf8_encode(odbc_result($qry, 'U_ForwardLoad')),
		// "U_BackLoad"=> utf8_encode(odbc_result($qry, 'U_BackLoad')),
		"U_IDNumber"=> utf8_encode(odbc_result($qry, 'U_IDNumber')),
		"U_TypeOfAccessorial"=> utf8_encode(odbc_result($qry, 'U_TypeOfAccessorial')),
		"U_ApprovalStatus"=> utf8_encode(odbc_result($qry, 'U_ApprovalStatus')),
		"U_TimeInEmptyDem"=> utf8_encode(odbc_result($qry, 'U_TimeInEmptyDem')),
		"U_TimeOutEmptyDem"=> utf8_encode(odbc_result($qry, 'U_TimeOutEmptyDem')),
		"U_VerifiedEmptyDem"=> utf8_encode(odbc_result($qry, 'U_VerifiedEmptyDem')),
		"U_TimeInLoadedDem"=> utf8_encode(odbc_result($qry, 'U_TimeInLoadedDem')),
		"U_TimeOutLoadedDem"=> utf8_encode(odbc_result($qry, 'U_TimeOutLoadedDem')),
		"U_VerifiedLoadedDem"=> utf8_encode(odbc_result($qry, 'U_VerifiedLoadedDem')),
		"U_Remarks2"=> utf8_encode(odbc_result($qry, 'U_Remarks2')),
		"U_TimeInAdvLoading"=> utf8_encode(odbc_result($qry, 'U_TimeInAdvLoading')),
		"U_DayOfTheWeek"=> utf8_encode(odbc_result($qry, 'U_DayOfTheWeek')),
		"U_TimeIn"=> utf8_encode(odbc_result($qry, 'U_TimeIn')),
		"U_TimeOut"=> utf8_encode(odbc_result($qry, 'U_TimeOut')),
		"U_ODOIn"=> utf8_encode(odbc_result($qry, 'U_ODOIn')),
		"U_ODOOut"=> utf8_encode(odbc_result($qry, 'U_ODOOut')),
		"U_ClientSubStatus"=> utf8_encode(odbc_result($qry, 'U_ClientSubStatus')),
		"U_ClientSubOverdue"=> utf8_encode(odbc_result($qry, 'U_ClientSubOverdue')),
		"U_ClientPenaltyCalc"=> utf8_encode(odbc_result($qry, 'U_ClientPenaltyCalc')),
		"U_PODStatusPayment"=> utf8_encode(odbc_result($qry, 'U_PODStatusPayment')),
		"U_PODSubmitDeadline"=> utf8_encode(odbc_result($qry, 'U_PODSubmitDeadline')),
		"U_OverdueDays"=> utf8_encode(odbc_result($qry, 'U_OverdueDays')),
		"U_InteluckPenaltyCalc"=>number_format((odbc_result($qry, 'U_InteluckPenaltyCalc')),2),
		"U_WaivedDays"=> utf8_encode(odbc_result($qry, 'U_WaivedDays')),
		"U_HolidayOrWeekend"=> utf8_encode(odbc_result($qry, 'U_HolidayOrWeekend')),
		"U_LostPenaltyCalc"=> number_format((odbc_result($qry, 'U_LostPenaltyCalc')),2),
		"U_TotalSubPenalties"=> number_format((odbc_result($qry, 'U_TotalSubPenalties')),2),
		"U_Waived"=> utf8_encode(odbc_result($qry, 'U_Waived')),
		"U_PercPenaltyCharge"=> utf8_encode(odbc_result($qry, 'U_PercPenaltyCharge')),
		"U_Approvedby"=> utf8_encode(odbc_result($qry, 'U_Approvedby')),
		"U_TotalPenaltyWaived"=> number_format(odbc_result($qry, 'U_TotalPenaltyWaived'),2),
		"U_DocNum"=> utf8_encode(odbc_result($qry, 'U_DocNum')),
		// "U_UpdateDate"=> utf8_encode(odbc_result($qry, 'U_UpdateDate')),
		// "U_CreateDate"=> utf8_encode(odbc_result($qry, 'U_CreateDate')),
		"U_Attachment"=> utf8_encode(odbc_result($qry, 'U_Attachment')),
		// "U_Creator"=> utf8_encode(odbc_result($qry, 'U_Creator')),
		"U_TotalNoExceed"=> utf8_encode(odbc_result($qry, 'U_TotalNoExceed')),
		"U_TotalUsage"=> utf8_encode(odbc_result($qry, 'U_TotalUsage')),
		"U_ClientLeadTime"=> utf8_encode(odbc_result($qry, 'U_ClientLeadTime')),
		"U_TotalInitialTruckers"=> utf8_encode(odbc_result($qry, 'U_TotalInitialTruckers')),
		"U_PenaltiesManual"=> number_format((odbc_result($qry, 'U_PenaltiesManual')),2),

		"U_ISLAND"=> odbc_result($qry, 'U_ISLAND'),
		"U_ISLAND_D"=> odbc_result($qry, 'U_ISLAND_D'),
		"U_IFINTERISLAND"=> odbc_result($qry, 'U_IFINTERISLAND'),
		"U_VERIFICATION_TAT"=> utf8_encode(odbc_result($qry, 'U_VERIFICATION_TAT')),
		"U_POD_TAT"=> utf8_encode(odbc_result($qry, 'U_POD_TAT')),
		"U_ActualDateRec_Intitial"=> utf8_encode(odbc_result($qry, 'U_ActualDateRec_Intitial')),

		"DisableTableRow"=>odbc_result($qry, 'DisableTableRow'),
		"U_ServiceType"=>odbc_result($qry, 'U_ServiceType'),
    	"U_SINo"=>odbc_result($qry, 'U_SINo'),

	);
		
		//  echo print_r($arr);
	}
	
	
	if ($err == 0) 
	{


		echo json_encode( $arr);
		
		
	}
	else
	{
		echo 'FAILURE!';
	
	}

?>
	