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
        WHEN (SELECT DISTINCT COUNT(*) FROM OPCH H LEFT JOIN PCH1 L ON H.DocEntry = L.DocEntry WHERE L.ItemCode = T0.U_BookingId AND H.CANCELED = 'N') > 1
        THEN 'Y'
        ELSE 'N'
    	END AS DisableTableRow,

		T0.su_Code,
		T0.po_Code,
		T0.U_BookingId,
		CONVERT(VARCHAR(10),T0.U_BookingDate,23) AS U_BookingDate,
		T0.U_ClientName,
		T0.U_TruckerName,
		T0.U_SAPTrucker AS U_TruckerSAP,
		T0.U_DeliveryStatus,
		CONVERT(VARCHAR(10),T0.U_DeliveryDatePOD,23) AS U_DeliveryDatePOD,
		T0.U_TripTicketNo,
		CAST(T0.U_WaybillNo as nvarchar(1000)) AS U_WaybillNo,
		CAST(T0.U_ShipmentNo as nvarchar(1000)) AS U_ShipmentManifestNo,
		CAST(T0.U_DeliveryReceiptNo as nvarchar(1000)) AS U_DeliveryReceiptNo,
		CAST(T0.U_SeriesNo as nvarchar(1000)) AS U_SeriesNo,
		T0.U_SeriesNo,
		  CASE 
		WHEN substring(T0.U_PVNo, 1, 2) <> ' ,'
		  THEN T0.U_PVNo
		ELSE substring(T0.U_PVNo, 3, 100)
		END AS U_PVNo,
		T0.U_TPStatus,
		 CONVERT(VARCHAR(10), DATEADD(day, 1,T0.U_BookingDate),23) AS U_Aging,

		T0.U_GrossTruckerRates AS U_GrossTruckerRates,
    	T0.U_RateBasisT AS U_RateBasis,
    
	 	CASE
	        WHEN ISNULL(T3.VatStatus,'Y') = 'Y' THEN ISNULL(T0.U_GrossTruckerRates, 0)
	        WHEN ISNULL(T3.VatStatus,'Y') = 'N' THEN (CAST(ISNULL(T0.U_GrossTruckerRates, 0) AS FLOAT) / 1.12)
    	END AS 'U_GrossTruckerRatesN',


		--T0.U_RateBasis,
		CASE
       		WHEN ISNULL(T3.VatStatus,'Y') = 'Y' THEN 'VAT' ELSE 'NONVAT'
    	END AS 'U_TaxType',
		ISNULL(NULLIF(T0.tp_U_BoomTruck2,''),0) AS U_BoomTruck2,
		T0.tp_U_Manpower,
		T0.tp_U_BackLoad,
		T0.tp_U_Addtlcharges,
		
		T0.U_Demurrage2 AS U_Demurrage,
	    T0.U_AddtlDrop2 AS U_AddtlDrop,
	    T0.tp_U_BoomTruck2 AS U_BoomTruck,
	    T0.tp_U_BoomTruck2,
	    T0.U_Manpower2 AS U_Manpower,
	    T0.U_Backload2 AS U_BackLoad,
	    T0.U_AddtlDrop2 + T0.tp_U_BoomTruck2 + T0.U_Manpower2 + T0.U_Backload2 AS U_Addtlcharges,

		CASE
	        WHEN ISNULL(T3.VatStatus,'Y') = 'Y' THEN (T0.U_AddtlDrop2 + T0.tp_U_BoomTruck2 + T0.U_Manpower2 + T0.U_Backload2)
	        WHEN ISNULL(T3.VatStatus,'Y') = 'N' THEN ((CAST(T0.U_AddtlDrop2 AS FLOAT) + CAST(T0.tp_U_BoomTruck2 AS FLOAT) + CAST(T0.U_Manpower2 AS FLOAT) + CAST(T0.U_Backload2 AS FLOAT)) / 1.12)
    	END AS U_AddtlChargesN,


		T0.U_ActualRates,
		T0.tp_U_RateAdjustments,
		T0.tp_U_ActualDemurrage,
		T0.U_ActualCharges,
		ISNULL(NULLIF(T0.tp_U_BoomTruck2,''),0) AS U_BoomTruck,
		T0.U_OtherCharges,

		----ABS(REPLACE(T2.U_TotalSubPenalties, ',', '')) AS U_TotalSubPenalty,
	 --   --ABS(REPLACE(T2.U_TotalPenaltyWaived, ',', '')) AS U_TotalPenaltyWaived,

  --  	--ABS(REPLACE(T2.U_TotalSubPenalties, ',', '')) -    ABS(REPLACE(T2.U_TotalPenaltyWaived, ',', '')) 

  --  	--ISNULL(TF.U_TotalSubPenalty, 0) AS U_TotalPenalty,

    	TF.U_TotalPenalty,
    	TF.U_TotalSubPenalty,
    	TF.U_TotalPenaltyWaived,
		
		
		ISNULL(  CASE
        WHEN ISNULL(T3.VatStatus,'Y') = 'Y' THEN T0.U_GrossTruckerRates
        WHEN ISNULL(T3.VatStatus,'Y') = 'N' THEN (CAST(T0.U_GrossTruckerRates AS FLOAT) / 1.12)
    END,0) + 
		ISNULL(CASE
	         WHEN ISNULL(T3.VatStatus,'Y') = 'Y' THEN T0.U_Demurrage2
	         WHEN ISNULL(T3.VatStatus,'Y') = 'N' THEN (CAST(T0.U_Demurrage2 AS FLOAT)/ 1.12)
    	END ,0) + 
		ISNULL(T0.U_AddtlChargesN,0) +
		ISNULL(T0.U_ActualRates,0) + 
		ISNULL(T0.tp_U_RateAdjustments,0) + 
		ISNULL(T0.tp_U_ActualDemurrage,0) + 
		ISNULL(T0.U_ActualCharges,0) + 
		ISNULL(NULLIF(T0.tp_U_BoomTruck2,''),0) + 
		ISNULL(T0.U_OtherCharges,0) 

		 AS U_TotalPayable,
		T0.U_EWT2307,
		T0.U_TotalPayableRec,
		--T0.U_PaymentVoucherNo,
		--U_ORRefNo,

		 CAST(SUBSTRING((
        SELECT
            CONCAT(', ', CAST(T0.TrsfrDate AS DATE)) AS [text()]
	        FROM OVPM T0 WITH (NOLOCK)
	        INNER JOIN VPM2 T1 ON T1.DocNum = T0.DocEntry
	        LEFT JOIN VPM1 T2 ON T1.DocNum = T2.DocNum
	        LEFT JOIN OPCH T3 ON T1.DocEntry = T3.DocEntry
	        WHERE T0.Canceled <> 'Y' AND T3.DocNum IN (SELECT RTRIM(LTRIM(value)) AS DocNum FROM STRING_SPLIT(TF.U_Paid, ','))
	        FOR XML PATH (''), TYPE).value('text()[1]','nvarchar(max)'), 2, 1000
	    ) as nvarchar) AS U_ActualPaymentDate,
	    CAST(SUBSTRING((
	        SELECT
	            CONCAT(', ', T0.TrsfrRef) AS [text()]
	        FROM OVPM T0 WITH (NOLOCK)
	        INNER JOIN VPM2 T1 ON T1.DocNum = T0.DocEntry
	        LEFT JOIN VPM1 T2 ON T1.DocNum = T2.DocNum
	        LEFT JOIN OPCH T3 ON T1.DocEntry = T3.DocEntry
	        WHERE T0.Canceled <> 'Y' AND T3.DocNum IN (SELECT RTRIM(LTRIM(value)) AS DocNum FROM STRING_SPLIT(TF.U_Paid, ','))
	        FOR XML PATH (''), TYPE).value('text()[1]','nvarchar(max)'), 2, 1000
	    ) as nvarchar) AS U_PaymentReference,
	    CAST(SUBSTRING((
	        SELECT
	            CONCAT(', ', 
	            CASE 
	                WHEN T3.PaidSum - T3.DocTotal <= 0 THEN 'Paid'
	                ELSE 'Unpaid' 
	            END
	            ) AS [text()]
	        FROM OVPM T0 WITH (NOLOCK)
	        INNER JOIN VPM2 T1 ON T1.DocNum = T0.DocEntry
	        LEFT JOIN VPM1 T2 ON T1.DocNum = T2.DocNum
	        LEFT JOIN OPCH T3 ON T1.DocEntry = T3.DocEntry
	        WHERE T0.Canceled <> 'Y' AND T3.DocNum IN (SELECT RTRIM(LTRIM(value)) AS DocNum FROM STRING_SPLIT(TF.U_Paid, ','))
	        FOR XML PATH (''), TYPE).value('text()[1]','nvarchar(max)'), 2, 1000
	    ) as nvarchar) AS U_PaymentStatus,
		
		--T0.U_UpdateDate,
		--T0.U_CreateDate,
		T0.tp_U_PODNum,
		T0.U_PODSONum,
		T0.U_DocNum,
		CAST(T0.U_OtherPODDoc as nvarchar(1000)) AS U_OtherPODDoc,


	    CAST(T0.U_Remarks as nvarchar) AS U_Remarks,

		T0.U_TPincharge,
		ISNULL(T0.U_CAandDP,0) AS U_CAandDP,
		ISNULL(T0.U_Interest,0) AS U_Interest,
		ISNULL(T0.U_OtherDeductions,0) AS U_OtherDeductions,


		--(ISNULL(U_TotalPenalty,0) + ISNULL(U_CAandDP,0) + ISNULL(U_Interest,0) + ISNULL(U_OtherDeductions,0)  ) AS 


		CAST(ISNULL(TF.U_TotalSubPenalty, 0) AS  decimal) - CAST(ISNULL(TF.U_TotalPenaltyWaived, 0) AS Decimal) AS U_TOTALDEDUCTIONS,
		T0.U_REMARKS1,


		T0.U_RateBasisT AS U_RateBasisPricing,
		CASE WHEN T3.VatStatus = 'Y' THEN 'VAT' ELSE 'NONVAT' END AS U_TaxTypePricing,
		T0.tp_U_BoomTruck2 AS U_BoomTruckPricing,
		T0.U_Manpower2 AS U_ManpowerPricing,
		T0.U_BackLoad2 AS U_BackLoadPricing,
		T0.U_totalAddtlCharges2 AS U_AddtlChargesPricing,
		T0.U_Demurrage2 AS U_Demurrage,
		T0.U_AddtlDrop2 AS U_AddtlDrop,

	

		CASE
	        WHEN ISNULL(T3.VatStatus,'Y') = 'Y' THEN T0.U_Demurrage2
	        WHEN ISNULL(T3.VatStatus,'Y') = 'N' THEN (CAST(T0.U_Demurrage2 AS FLOAT)/ 1.12)
    	END AS U_DemurrageN,

		CASE WHEN T3.VatStatus = 'Y' THEN T0.U_totalAddtlCharges2  ELSE T0.U_totalAddtlCharges2 / 1.12 END AS U_AddtlChargesPricingN,


		 -- or REPLACE(REPLACE(RTRIM(LTRIM(T0.U_PVNo)), ' ', ''), ',', '') LIKE '%' + RTRIM(LTRIM(header.U_PVNo)) + '%')) AS U_TotalAP,
    CASE
        WHEN EXISTS(
            SELECT 1 
            FROM OPCH header
            LEFT JOIN PCH1 line ON header.DocEntry = line.DocEntry
            WHERE header.CANCELED = 'N' AND line.ItemCode = T0.U_BookingId
        ) THEN (
            SELECT
                SUM(line.PriceAfVAT)
            FROM OPCH header
            LEFT JOIN PCH1 line ON header.DocEntry = line.DocEntry
            WHERE header.CANCELED = 'N' AND line.ItemCode = T0.U_BookingId
        ) ELSE T0.U_TotalPayable
    END AS U_TotalAP,

    -- (SELECT
    --     CV.U_TotalAP
    -- FROM ConcatenatedValued CV
    -- WHERE CV.U_BookingId = T0.U_BookingId) AS U_TotalAP,

    CASE
        WHEN EXISTS(
            SELECT 1 
            FROM OPCH header
            LEFT JOIN PCH1 line ON header.DocEntry = line.DocEntry
            WHERE header.CANCELED = 'N' AND line.ItemCode = T0.U_BookingId
        ) THEN (
        SELECT
            SUM(line.PriceAfVAT)
        FROM OPCH header
        LEFT JOIN PCH1 line ON header.DocEntry = line.DocEntry
        WHERE header.CANCELED = 'N' AND line.ItemCode = T0.U_BookingId
        ) ELSE T0.U_TotalPayable
    END - (CAST(T0.U_TotalPayable AS FLOAT) + CAST(T0.U_CAandDP AS FLOAT) + CAST(T0.U_Interest AS FLOAT) + CAST(T0.U_OtherDeductions AS FLOAT)) AS U_VarTP,

	SUBSTRING((
        SELECT
			CONCAT(', ', T0.U_OR_Ref) AS [text()]
		FROM OPCH T0 WITH (NOLOCK)
		WHERE T0.Canceled <> 'Y' AND T0.DocNum IN (SELECT RTRIM(LTRIM(value)) AS DocNum FROM STRING_SPLIT(TF.U_Paid, ','))
		FOR XML PATH (''), TYPE).value('text()[1]','nvarchar(max)'), 2, 1000
    ) AS U_ORRefNo



		FROM [dbo].[PCTP_UNIFIED] T0
		--INNER JOIN [dbo].[@PCTP_PRICING] T1 ON T0.U_BookingId = T1.U_BookingId
		--INNER JOIN [dbo].[@PCTP_POD] T2 ON T2.U_BookingNumber = T0.U_BookingId
		LEFT JOIN [dbo].[OCRD] T3 ON T3.CardCode = T0.U_SAPTrucker
		LEFT JOIN TP_EXTRACT TF ON RTRIM(LTRIM(TF.U_BookingId)) = RTRIM(LTRIM(T0.U_BookingId))


		WHERE T0.U_BookingId = '$pid' ");


	$arr = array();
	while (odbc_fetch_row($qry)) 
	{
		
		$arr = array( 

		"Code"=> odbc_result($qry, 'su_Code'),
		"Name"=> odbc_result($qry, 'po_Code'),
		"U_BookingId"=> utf8_encode(odbc_result($qry, 'U_BookingId')),
		"U_BookingDate"=> utf8_encode(odbc_result($qry, 'U_BookingDate')),
		"U_ClientName"=> utf8_encode(odbc_result($qry, 'U_ClientName')),
		"U_TruckerName"=> utf8_encode(odbc_result($qry, 'U_TruckerName')),
		"U_TruckerSAP"=> utf8_encode(odbc_result($qry, 'U_TruckerSAP')),
		"U_DeliveryStatus"=> utf8_encode(odbc_result($qry, 'U_DeliveryStatus')),
		"U_DeliveryDatePOD"=> utf8_encode(odbc_result($qry, 'U_DeliveryDatePOD')),
		"U_TripTicketNo"=> utf8_encode(odbc_result($qry, 'U_TripTicketNo')),
		"U_WaybillNo"=> utf8_encode(odbc_result($qry, 'U_WaybillNo')),
		"U_ShipmentManifestNo"=> utf8_encode(odbc_result($qry, 'U_ShipmentManifestNo')),
		"U_DeliveryReceiptNo"=> utf8_encode(odbc_result($qry, 'U_DeliveryReceiptNo')),
		"U_SeriesNo"=> utf8_encode(odbc_result($qry, 'U_SeriesNo')),
		"U_OtherPODDoc"=> utf8_encode(odbc_result($qry, 'U_OtherPODDoc')),
		"U_TPStatus"=> utf8_encode(odbc_result($qry, 'U_TPStatus')),
		"U_Aging"=> utf8_encode(odbc_result($qry, 'U_Aging')),
		"U_GrossTruckerRates"=> utf8_encode(number_format(odbc_result($qry, 'U_GrossTruckerRates'),2)),
		"U_GrossTruckerRatesN"=> utf8_encode(number_format(odbc_result($qry, 'U_GrossTruckerRatesN'),2)),
		// "U_RateBasis"=> utf8_encode(odbc_result($qry, 'U_RateBasis')),
		"U_TaxType"=> utf8_encode(odbc_result($qry, 'U_TaxType')),
		// "U_Demurrage"=> utf8_encode(number_format(odbc_result($qry, 'tp_U_Demurrage'),2)),
		// "U_AddtlDrop"=> utf8_encode(number_format(odbc_result($qry, 'tp_U_AddtlDrop'),2)),
		// "U_BoomTruck"=> utf8_encode(number_format(odbc_result($qry, 'tp_U_BoomTruck'),2)),
		"U_Manpower"=> utf8_encode(number_format(odbc_result($qry, 'tp_U_Manpower'),2)),
		"U_BackLoad"=> utf8_encode(number_format(odbc_result($qry, 'tp_U_BackLoad'),2)),
		"U_Addtlcharges"=> utf8_encode(number_format(odbc_result($qry, 'tp_U_Addtlcharges'),2)),
		
		"U_AddtlChargesN"=> utf8_encode(number_format(odbc_result($qry, 'U_AddtlChargesN'),2)),
		"U_ActualRates"=> utf8_encode(number_format(odbc_result($qry, 'U_ActualRates'),2)),
		"U_RateAdjustments"=> utf8_encode(number_format(odbc_result($qry, 'tp_U_RateAdjustments'),2)),
		"U_ActualDemurrage"=> utf8_encode(number_format(odbc_result($qry, 'tp_U_ActualDemurrage'),2)),
		"U_ActualCharges"=> utf8_encode(number_format(odbc_result($qry, 'U_ActualCharges'),2)),
		"U_BoomTruck2"=> utf8_encode(number_format(odbc_result($qry, 'tp_U_BoomTruck2'),2)),
		"U_OtherCharges"=> utf8_encode(number_format(odbc_result($qry, 'U_OtherCharges'),2)),
		"U_TotalSubPenalty"=> utf8_encode(number_format(odbc_result($qry, 'U_TotalSubPenalty'),2)),
		"U_TotalPenaltyWaived"=> utf8_encode(number_format(odbc_result($qry, 'U_TotalPenaltyWaived'),2)),
		"U_TotalPenalty"=> utf8_encode(number_format(odbc_result($qry, 'U_TotalPenalty'),2)),
		"U_TotalPayable"=> utf8_encode(number_format(odbc_result($qry, 'U_TotalPayable'),2)),
		"U_EWT2307"=> utf8_encode(number_format(odbc_result($qry, 'U_EWT2307'),2)),
		"U_TotalPayableRec"=> utf8_encode(number_format(odbc_result($qry, 'U_TotalPayableRec'),2)),
		// "U_PaymentVoucherNo"=> utf8_encode(odbc_result($qry, 'U_PaymentVoucherNo')),
		// "U_ORRefNo"=> utf8_encode(odbc_result($qry, 'U_ORRefNo')),
		"U_ActualPaymentDate"=> utf8_encode(odbc_result($qry, 'U_ActualPaymentDate')),
		"U_PaymentReference"=> utf8_encode(odbc_result($qry, 'U_PaymentReference')),
		"U_PaymentStatus"=> utf8_encode(odbc_result($qry, 'U_PaymentStatus')),
		"U_Remarks"=> utf8_encode(odbc_result($qry, 'U_Remarks')),
		// "U_UpdateDate"=> utf8_encode(odbc_result($qry, 'U_UpdateDate')),
		// "U_CreateDate"=> utf8_encode(odbc_result($qry, 'U_CreateDate')),
		"U_PODNum"=> utf8_encode(odbc_result($qry, 'tp_U_PODNum')),
		"U_PODSONum"=> utf8_encode(odbc_result($qry, 'U_PODSONum')),
		"U_DocNum"=> utf8_encode(odbc_result($qry, 'U_DocNum')),
		"U_PVNo"=> odbc_result($qry, 'U_PVNo'),
		"U_TPincharge"=> utf8_encode(odbc_result($qry, 'U_TPincharge')),
		"U_CAandDP"=> utf8_encode(number_format(odbc_result($qry, 'U_CAandDP'),2)),
		"U_Interest"=> utf8_encode(number_format(odbc_result($qry, 'U_Interest'),2)),
		"U_OtherDeductions"=> utf8_encode(number_format(odbc_result($qry, 'U_OtherDeductions'),2)),
		"U_TOTALDEDUCTIONS"=> utf8_encode(number_format(odbc_result($qry, 'U_TOTALDEDUCTIONS'),2)),
		"U_REMARKS1"=> utf8_encode(odbc_result($qry, 'U_REMARKS1')),


		"U_RateBasisPricing"=> utf8_encode(odbc_result($qry, 'U_RateBasisPricing')),
		"U_TaxTypePricing"=> utf8_encode(odbc_result($qry, 'U_TaxTypePricing')),
		"U_BoomTruckPricing"=> utf8_encode(number_format(odbc_result($qry, 'U_BoomTruckPricing'),2)),
		"U_ManpowerPricing"=> utf8_encode(number_format(odbc_result($qry, 'U_ManpowerPricing'),2)),
		"U_BackLoadPricing"=> utf8_encode(number_format(odbc_result($qry, 'U_BackLoadPricing'),2)),
		"U_AddtlChargesPricing"=> utf8_encode(number_format(odbc_result($qry, 'U_AddtlChargesPricing'),2)),
		"U_AddtlChargesPricingN"=> utf8_encode(number_format(odbc_result($qry, 'U_AddtlChargesPricingN'),2)),
		"U_DemurrageN"=> utf8_encode(number_format(odbc_result($qry, 'U_DemurrageN'),2)),
		"DisableTableRow"=> utf8_encode(odbc_result($qry, 'DisableTableRow')),
		"U_TotalAP"=> utf8_encode(number_format(odbc_result($qry, 'U_TotalAP'),2)),
		"U_VarTP"=> utf8_encode(number_format(odbc_result($qry, 'U_VarTP'),2)),


		








		
		
		
		
		
		
						

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
	