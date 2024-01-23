<?php 
session_start();
include('../../../../../config/config.php');

	$err = 0;
	$errmsg = '';
	$ItemCode = '';

	$pid = $_GET["pid"];


	// -- U_WaybillNo
	// -- U_ShipmentManifestNo
	// -- U_DeliveryReceiptNo
	// -- U_SeriesNo
	$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
	SELECT 

	CASE
	WHEN (SELECT DISTINCT COUNT(*) FROM OINV H LEFT JOIN INV1 L ON H.DocEntry = L.DocEntry WHERE L.ItemCode = T0.U_BookingId AND H.CANCELED = 'N') > 1
	THEN 'Y'
	ELSE 'N'
END AS DisableTableRow,
CASE
	WHEN (SELECT DISTINCT COUNT(*) FROM OINV H LEFT JOIN INV1 L ON H.DocEntry = L.DocEntry WHERE L.ItemCode = T0.U_BookingId AND H.CANCELED = 'N') = 1
	THEN 'DisableSomeFields'
	ELSE ''
END AS DisableSomeFields,

	T0.su_Code,
	T0.po_Code,
	T0.U_BookingId,
	
	T2.CardName AS U_CustomerName,
	T0.U_SAPClient,
	ISNULL(T2.U_GroupLocation, T0.U_GroupProject) U_GroupProject,
	T0.U_PlateNumber,
	T0.U_VehicleTypeCap,
	

	
	T0.U_DeliveryStatus,
	CONVERT(VARCHAR(10),T0.U_DeliveryDatePOD,23) AS U_DeliveryDatePOD,

	T0.U_TripType,

	CAST(T0.U_WaybillNo as nvarchar(200)) U_WaybillNo,
	CAST(T0.U_ShipmentNo as nvarchar(200)) U_ShipmentManifestNo,
	CAST(T0.U_DeliveryReceiptNo as nvarchar(200)) U_DeliveryReceiptNo,
	CAST(T0.U_SeriesNo as nvarchar(200)) U_SeriesNo,
	
	CONVERT(VARCHAR(10),T0.U_BookingDate,23) U_BookingDate,
	CONVERT(VARCHAR(10),T0.U_ClientReceivedDate,23) U_ClientReceivedDate,
	CONVERT(VARCHAR(10),T0.U_ActualHCRecDate,23) U_ActualHCRecDate,
	CONVERT(VARCHAR(10),T0.U_VerifiedDateHC,23) U_VerifiedDateHC,
	CONVERT(VARCHAR(10),T0.U_DateForwardedBT,23) U_DateForwardedBT,
	CONVERT(VARCHAR(10),T0.U_BillingDeadline,23) U_BillingDeadline,
	
	
	
	T0.U_PODinCharge,
	

	T0.U_PTFNo,
	
	T0.U_BillingStatus,
	T0.U_ServiceType,
	 CAST((
	SELECT DISTINCT
		SUBSTRING(
			(
				SELECT 
				CASE
					WHEN header.U_InvoiceNo = '' OR header.U_InvoiceNo IS NULL THEN ''
					ELSE CONCAT(', ', header.U_InvoiceNo)
				END AS [text()]
				FROM INV1 line
				LEFT JOIN OINV header ON header.DocEntry = line.DocEntry
				WHERE line.ItemCode = T0.U_BookingId
				AND header.CANCELED = 'N'
				FOR XML PATH (''), TYPE
			).value('text()[1]','nvarchar(max)'), 2, 1000) DocEntry
	FROM OINV header
	LEFT JOIN INV1 line ON line.DocEntry = header.DocEntry
	WHERE line.ItemCode = T0.U_BookingId
	AND header.CANCELED = 'N') as nvarchar(200)
) AS  U_SINo,
	T0.U_BillingTeam,


	



	ISNULL(T0.U_GrossClientRates,0) AS U_GrossInitialRate,
	ISNULL(T0.U_ActualBilledRate,0) AS U_ActualBilledRate,
	--ISNULL(T0.U_RateAdjustments,0) AS U_RateAdjustments,
	--ISNULL(T0.U_ActualDemurrage,0) AS U_ActualDemurrage,
	ISNULL(T0.U_ActualAddCharges,0) AS U_ActualAddCharges,

	ISNULL(T0.U_GrossClientRates,0) +
	ISNULL(T0.U_Demurrage,0) +
	(	ISNULL(T0.pr_U_AddtlDrop,0) + 
	ISNULL(T0.pr_U_BoomTruck,0) + 
	ISNULL(T0.pr_U_Manpower,0) + 
	ISNULL(T0.pr_U_BackLoad,0) ) +
	ISNULL(T0.U_ActualBilledRate,0) +
	--ISNULL(T0.U_RateAdjustments,0) +
	--ISNULL(T0.U_ActualDemurrage,0) +
	ISNULL(T0.U_ActualAddCharges,0)  AS U_TotalRecClients,
	T0.U_CheckingTotalBilled,
	T0.U_Checking,
	T0.U_SOBNumber,
	T0.U_OutletNo,
	T0.U_CBM,
	CAST(T0.U_SI_DRNo as nvarchar(200)) U_SI_DRNo,
	T0.U_DeliveryMode,
	T0.U_SourceWhse,
	
	T0.U_TotalInvAmount,
	T0.U_SONo,
	T0.U_NameCustomer,
	T0.U_CategoryDR,
	T0.U_ForwardLoad,
	T0.pr_U_BackLoad,
	T0.U_IDNumber,
	T0.U_TypeOfAccessorial,
	T0.U_Status,
	T0.U_TimeInEmptyDem,
	T0.U_TimeOutEmptyDem,
	T0.U_VerifiedEmptyDem,
	T0.U_TimeInLoadedDem,
	T0.U_TimeOutLoadedDem,
	T0.U_VerifiedLoadedDem,
	
	T0.U_TimeInAdvLoading,
	T0.U_DayOfTheWeek,
	T0.U_TimeIn,
	T0.U_TimeOut,
	T0.U_ODOIn,
	T0.U_ODOOut,
	CAST(T0.U_DocNum as nvarchar(200)) U_DocNum,
	T0.pr_U_PODNum,
	T0.U_PODSONum,
	--T0.U_UpdateDate,
	--T0.U_CreateDate,
	--T0.U_UpdateTime,
	ISNULL(T0.U_Demurrage,0) AS U_Demurrage,

	ISNULL(T0.pr_U_AddtlDrop,0) + 
ISNULL(T0.pr_U_BoomTruck,0) + 
ISNULL(T0.pr_U_Manpower,0) + 
ISNULL(T0.pr_U_Backload,0)  AS U_AddCharges,
	--ISNULL(T0.U_AddCharges,0) AS U_AddCharges,
	T0.U_CWT2307,
	T0.U_TotalExceed,
	T0.U_TotalUsage,
	T0.U_NoOfDrops,


	
	CAST(T0.U_DeliveryOrigin as nvarchar(200)) U_DeliveryOrigin,
	CAST(T0.U_Destination as nvarchar(200)) U_Destination,

	CAST(T0.U_Remarks as nvarchar(200)) U_Remarks,
	CAST(T0.U_OtherPODDoc as nvarchar(1000)) U_OtherPODDoc,
	CAST(T0.U_RemarksPOD as nvarchar(200)) U_RemarksPOD,
	CAST(T0.U_PODStatusDetail as nvarchar(200)) U_PODStatusDetail,
	CAST(T0.U_BTRemarks as nvarchar(200)) U_BTRemarks,

	CAST(T0.U_TripTicketNo as nvarchar(200)) U_TripTicketNo,

	 --(
--     SELECT DISTINCT
--         CASE 
--             WHEN EXISTS (
--                 SELECT Code
--                 FROM [@BILLINGSTATUS]
--                 WHERE Code = header.U_BillingStatus
--             ) THEN header.U_BillingStatus
--             ELSE NULL 
--         END
--     FROM OINV header
--     LEFT JOIN INV1 line ON line.DocEntry = header.DocEntry
--     WHERE line.ItemCode = T0.U_BookingId
--     AND header.CANCELED = 'N'
-- ) AS U_BillingStatus,


T0.U_BillingStatus,

  CAST((
	SELECT DISTINCT
		SUBSTRING(
			(
				SELECT CONCAT(', ', header.U_ServiceType)  AS [text()]
				FROM INV1 line
				LEFT JOIN OINV header ON header.DocEntry = line.DocEntry
				WHERE line.ItemCode = T0.U_BookingId
				AND header.U_ServiceType IS NOT NULL
				AND header.CANCELED = 'N'
				FOR XML PATH (''), TYPE
			).value('text()[1]','nvarchar(max)'), 2, 1000) DocEntry
	FROM OINV header
	LEFT JOIN INV1 line ON line.DocEntry = header.DocEntry
	WHERE line.ItemCode = T0.U_BookingId
	AND header.U_ServiceType IS NOT NULL
	AND header.CANCELED = 'N'
	) as nvarchar(200)
) AS U_ServiceType,


  (SELECT
	SUM(L.PriceAfVAT)
FROM OINV H
LEFT JOIN INV1 L ON H.DocEntry = L.DocEntry
WHERE H.CANCELED = 'N' AND L.ItemCode = T0.U_BookingId) AS U_TotalAR,
(SELECT
	SUM(L.PriceAfVAT)
FROM OINV H
LEFT JOIN INV1 L ON H.DocEntry = L.DocEntry
WHERE H.CANCELED = 'N' AND L.ItemCode = T0.U_BookingId) - T0.U_TotalRecClients AS U_VarAR


	FROM [dbo].[PCTP_UNIFIED] T0
	--INNER JOIN [dbo].[@PCTP_POD] T1 ON T0.U_BookingId = T1.U_BookingNumber
	INNER JOIN OCRD T2 ON T2.CardCode = T0.U_SAPClient

	--INNER JOIN [dbo].[@PCTP_PRICING] T3 ON T3.U_BookingId = T0.U_BookingId

	--WHERE T0.U_BookingId = 'I23330197MSH' 
	WHERE T0.U_BookingId = '$pid' ");


	$arr = array();
	while (odbc_fetch_row($qry)) 
	{
		
		$arr[] = array( 

		"Code"=> odbc_result($qry, 'su_Code'),
		"Name"=> odbc_result($qry, 'po_Code'),
		"U_BookingId"=> utf8_encode(odbc_result($qry, 'U_BookingId')),
		"U_BookingDate"=> utf8_encode(odbc_result($qry, 'U_BookingDate')),
		"U_CustomerName"=> utf8_encode(odbc_result($qry, 'U_CustomerName')),
		"U_SAPClient"=> utf8_encode(odbc_result($qry, 'U_SAPClient')),
		"U_GroupProject"=> utf8_encode(odbc_result($qry, 'U_GroupProject')),
		"U_PlateNumber"=> utf8_encode(odbc_result($qry, 'U_PlateNumber')),
		"U_VehicleTypeCap"=> utf8_encode(odbc_result($qry, 'U_VehicleTypeCap')),
		"U_DeliveryOrigin"=> utf8_encode(odbc_result($qry, 'U_DeliveryOrigin')),
		"U_Destination"=> utf8_encode(odbc_result($qry, 'U_Destination')),
		"U_DeliveryStatus"=> utf8_encode(odbc_result($qry, 'U_DeliveryStatus')),
		"U_DeliveryDatePOD"=> utf8_encode(odbc_result($qry, 'U_DeliveryDatePOD')),
		"U_TripType"=> utf8_encode(odbc_result($qry, 'U_TripType')),
		"U_WaybillNo"=> utf8_encode(odbc_result($qry, 'U_WaybillNo')),
		"U_ShipmentManifestNo"=> utf8_encode(odbc_result($qry, 'U_ShipmentManifestNo')),
		"U_DeliveryReceiptNo"=> utf8_encode(odbc_result($qry, 'U_DeliveryReceiptNo')),
		"U_SeriesNo"=> utf8_encode(odbc_result($qry, 'U_SeriesNo')),
		"U_OtherPODDoc"=> utf8_encode(odbc_result($qry, 'U_OtherPODDoc')),
		"U_RemarksPOD"=> utf8_encode(odbc_result($qry, 'U_RemarksPOD')),
		"U_ClientReceivedDate"=> utf8_encode(odbc_result($qry, 'U_ClientReceivedDate')),
		"U_ActualHCRecDate"=> utf8_encode(odbc_result($qry, 'U_ActualHCRecDate')),
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
		"U_GrossInitialRate"=>number_format(odbc_result($qry, 'U_GrossInitialRate'),2),
		"U_ActualBilledRate"=>number_format(odbc_result($qry, 'U_ActualBilledRate'),2),
		// "U_RateAdjustments"=>number_format(odbc_result($qry, 'U_RateAdjustments'),2),
		// "U_ActualDemurrage"=>number_format(odbc_result($qry, 'U_ActualDemurrage'),2),
		"U_ActualAddCharges"=>number_format(odbc_result($qry, 'U_ActualAddCharges'),2),
		"U_TotalRecClients"=> utf8_encode(number_format(odbc_result($qry, 'U_TotalRecClients'),2)),
		"U_CheckingTotalBilled"=> utf8_encode(odbc_result($qry, 'U_CheckingTotalBilled')),
		"U_Checking"=> utf8_encode(odbc_result($qry, 'U_Checking')),
		"U_SOBNumber"=> utf8_encode(odbc_result($qry, 'U_SOBNumber')),
		"U_OutletNo"=> utf8_encode(odbc_result($qry, 'U_OutletNo')),
		"U_CBM"=> utf8_encode(odbc_result($qry, 'U_CBM')),
		"U_SI_DRNo"=> utf8_encode(odbc_result($qry, 'U_SI_DRNo')),
		"U_DeliveryMode"=> utf8_encode(odbc_result($qry, 'U_DeliveryMode')),
		"U_SourceWhse"=> utf8_encode(odbc_result($qry, 'U_SourceWhse')),
		
		"U_TotalInvAmount"=> utf8_encode(odbc_result($qry, 'U_TotalInvAmount')),
		"U_SONo"=> utf8_encode(odbc_result($qry, 'U_SONo')),
		"U_NameCustomer"=> utf8_encode(odbc_result($qry, 'U_NameCustomer')),
		"U_CategoryDR"=> utf8_encode(odbc_result($qry, 'U_CategoryDR')),
		"U_ForwardLoad"=> utf8_encode(odbc_result($qry, 'U_ForwardLoad')),
		"U_BackLoad"=> utf8_encode(odbc_result($qry, 'pr_U_BackLoad')),
		"U_IDNumber"=> utf8_encode(odbc_result($qry, 'U_IDNumber')),
		"U_TypeOfAccessorial"=> utf8_encode(odbc_result($qry, 'U_TypeOfAccessorial')),
		"U_Status"=> utf8_encode(odbc_result($qry, 'U_Status')),
		"U_TimeInEmptyDem"=> utf8_encode(odbc_result($qry, 'U_TimeInEmptyDem')),
		"U_TimeOutEmptyDem"=> utf8_encode(odbc_result($qry, 'U_TimeOutEmptyDem')),
		"U_VerifiedEmptyDem"=> utf8_encode(odbc_result($qry, 'U_VerifiedEmptyDem')),
		"U_TimeInLoadedDem"=> utf8_encode(odbc_result($qry, 'U_TimeInLoadedDem')),
		"U_TimeOutLoadedDem"=> utf8_encode(odbc_result($qry, 'U_TimeOutLoadedDem')),
		"U_VerifiedLoadedDem"=> utf8_encode(odbc_result($qry, 'U_VerifiedLoadedDem')),
		"U_Remarks"=> utf8_encode(odbc_result($qry, 'U_Remarks')),
		"U_TimeInAdvLoading"=> utf8_encode(odbc_result($qry, 'U_TimeInAdvLoading')),
		"U_DayOfTheWeek"=> utf8_encode(odbc_result($qry, 'U_DayOfTheWeek')),
		"U_TimeIn"=> utf8_encode(odbc_result($qry, 'U_TimeIn')),
		"U_TimeOut"=> utf8_encode(odbc_result($qry, 'U_TimeOut')),
		"U_ODOIn"=> utf8_encode(odbc_result($qry, 'U_ODOIn')),
		"U_ODOOut"=> utf8_encode(odbc_result($qry, 'U_ODOOut')),
		"U_DocNum"=> utf8_encode(odbc_result($qry, 'U_DocNum')),
		"U_PODNum"=> utf8_encode(odbc_result($qry, 'pr_U_PODNum')),
		"U_PODSONum"=> utf8_encode(odbc_result($qry, 'U_PODSONum')),
		// "U_UpdateDate"=> utf8_encode(odbc_result($qry, 'U_UpdateDate')),
		// "U_CreateDate"=> utf8_encode(odbc_result($qry, 'U_CreateDate')),
		// "U_UpdateTime"=> utf8_encode(odbc_result($qry, 'U_UpdateTime')),
		"U_Demurrage"=> number_format(odbc_result($qry, 'U_Demurrage'),2),
		// "U_AddCharges"=> number_format(odbc_result($qry, 'U_AddCharges'),2),
		"U_CWT2307"=> utf8_encode(odbc_result($qry, 'U_CWT2307')),
		"U_TotalExceed"=> utf8_encode(odbc_result($qry, 'U_TotalExceed')),
		"U_TotalUsage"=> utf8_encode(odbc_result($qry, 'U_TotalUsage')),
		"U_NoOfDrops"=> utf8_encode(odbc_result($qry, 'U_NoOfDrops')),
		"U_TripTicketNo"=> utf8_encode(odbc_result($qry, 'U_TripTicketNo')),
		"DisableTableRow"=> utf8_encode(odbc_result($qry, 'DisableTableRow')),
		"DisableSomeFields"=> utf8_encode(odbc_result($qry, 'DisableSomeFields')),
		"U_TotalAR"=> utf8_encode(number_format(odbc_result($qry, 'U_TotalAR'),2)),
		"U_VarAR"=> utf8_encode(number_format(odbc_result($qry, 'U_VarAR'),2)),
	
	);
		
		 echo printr($arr);
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
	