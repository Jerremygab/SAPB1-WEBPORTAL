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
	WHEN (SELECT DISTINCT COUNT(*) FROM OINV H LEFT JOIN INV1 L ON H.DocEntry = L.DocEntry WHERE L.ItemCode = T0.U_BookingId AND H.CANCELED = 'N') > 0
	THEN 'DisableFieldsForBilling'
	ELSE ''
	END AS DisableSomeFields, 
	CASE
		WHEN EXISTS(
			SELECT 1 
			FROM OPCH H, PCH1 L 
			WHERE H.DocEntry = L.DocEntry AND H.CANCELED = 'N' 
			AND (L.ItemCode = T0.U_BookingId
			OR (REPLACE(REPLACE(RTRIM(LTRIM(T0.U_PVNo)), ' ', ''), ',', '') LIKE '%' + RTRIM(LTRIM(H.U_PVNo)) + '%')))
		THEN 'DisableFieldsForTp'
		ELSE ''
	END AS DisableSomeFields2,
	T0.su_Code,
	T0.po_Code,
	T0.U_BookingId,

	CONVERT(VARCHAR(10),T0.U_BookingDate,23) AS U_BookingDate,

	T1.CardName AS U_CustomerName,
	T0.U_SAPClient AS U_ClientTag,
	ISNULL(T1.U_GroupLocation, T0.U_ClientProject) U_ClientProject,
	T2.CardName AS U_TruckerName,
	T0.U_SAPTrucker AS U_TruckerTag,
	T0.U_VehicleTypeCap,


	T0.U_DeliveryStatus,
	T0.U_TripType,
	T0.U_NoOfDrops,

	U_GrossClientRates,

	
	CASE
		WHEN ISNULL(T1.VatStatus,'Y') = 'Y' THEN T0.U_GrossClientRates
		WHEN ISNULL(T1.VatStatus,'Y') = 'N' THEN (CAST(T0.U_GrossClientRatesTax AS FLOAT) / 1.12)
	END AS 'U_GrossClientRatesTax',
	
	--T0.U_RateBasis,
	CASE WHEN T1.VatStatus = 'Y' THEN 'VAT' ELSE 'NONVAT' END AS U_TaxType,
	U_GrossProfitNet,
	U_TotalAddtlCharges,
	U_totalAddtlCharges2,
	T0.pr_U_Addtlcharges,
	U_GrossProfit,
	U_TotalInitialClient,
	U_TotalInitialTruckers,
	U_TotalGrossProfit,
	U_ClientTag2,
	--T0.U_UpdateDate,
	--T0.U_CreateDate,
	T0.pr_U_PODNum,

	T0.U_GrossTruckerRates,
	
	CASE
		WHEN ISNULL(T2.VatStatus,'Y') = 'Y' THEN T0.U_GrossTruckerRates
		WHEN ISNULL(T2.VatStatus,'Y') = 'N' THEN (CAST(T0.U_GrossTruckerRatesTax AS FLOAT) / 1.12)
	END AS 'U_GrossTruckerRatesTax',
	U_RateBasisT,
	CASE WHEN T2.VatStatus = 'Y' THEN 'VAT' ELSE 'NONVAT' END AS U_TaxTypeT,
	U_Demurrage4,
	U_AddtlCharges2,
	U_GrossProfitC,
	T0.U_Demurrage,
	T0.pr_U_AddtlDrop,
	T0.pr_U_BoomTruck,
	T0.pr_U_Manpower,
	T0.pr_U_BackLoad,
	U_Demurrage2,
	U_AddtlDrop2,
	T0.pr_U_BoomTruck2,
	U_Manpower2,
	U_Backload2,
	U_Demurrage3,

	CAST(T0.U_DeliveryOrigin as nvarchar(200)) AS U_DeliveryOrigin,
	CAST(T0.U_Destination as nvarchar(200)) AS U_Destination,

	CAST(T0.U_RemarksPOD as nvarchar(200)) AS U_RemarksPOD,
	CAST(U_RemarksDTR as nvarchar(200)) AS U_RemarksDTR,

	T1.ECVatGroup,
	T2.ECVatGroup AS ECVatGroupS,

	T0.U_ISLAND,
	T0.U_ISLAND_D,
	ISNULL(T0.U_IFINTERISLAND, 'No') AS U_IFINTERISLAND,


	
	
	CAST( (
        SELECT TOP 1
        header.DocNum
    FROM ORDR header
        LEFT JOIN RDR1 line ON line.DocEntry = header.DocEntry
    WHERE line.ItemCode = T0.U_BookingId
        AND header.CANCELED = 'N'
    ) as nvarchar) AS U_PODSONum,

	CAST(CAST((
        SELECT DISTINCT
        SUBSTRING(
                (
                    SELECT CONCAT(', ', header.DocNum)  AS [text()]
        FROM INV1 line
            LEFT JOIN OINV header ON header.DocEntry = line.DocEntry
        WHERE line.ItemCode = T0.U_BookingId
            AND header.CANCELED = 'N'
        FOR XML PATH (''), TYPE
                ).value('text()[1]','nvarchar(max)'), 2, 1000) DocEntry
    FROM OINV header
        LEFT JOIN INV1 line ON line.DocEntry = header.DocEntry
    WHERE line.ItemCode = T0.U_BookingId
        AND header.CANCELED = 'N') as nvarchar(max)
    )  as nvarchar) AS U_ARDocNum,
	
	CAST(ISNULL(T0.U_ActualBilledRate,0) as nvarchar) AS U_ActualBilledRate
	--CAST(ISNULL(T0.U_RateAdjustments,0) as nvarchar) AS U_RateAdjustments



	FROM [dbo].[PCTP_UNIFIED] T0

	--LEFT JOIN [dbo].[@PCTP_POD] T3 ON T3.U_BookingNumber = T0.U_BookingId
	--LEFT JOIN [dbo].[@PCTP_TP] T4 ON T0.U_BookingId = T4.U_BookingId
	--LEFT JOIN [dbo].[@PCTP_BILLING] T5 ON T0.U_BookingId = T5.U_BookingId

	LEFT JOIN OCRD T1 ON T1.CardCode = T0.U_SAPClient
	LEFT JOIN OCRD T2 ON T2.CardCode = T0.U_SAPTrucker

WHERE T0.U_BookingId = '$pid' ");


	$arr = array();
	while (odbc_fetch_row($qry)) 
	{
		
		$arr = array( 
"Code"=> odbc_result($qry, 'su_Code'),
"Name"=> odbc_result($qry, 'po_Code'),
"U_BookingId"=> utf8_encode(odbc_result($qry, 'U_BookingId')),
"U_BookingDate"=> utf8_encode(odbc_result($qry, 'U_BookingDate')),
"U_CustomerName"=> utf8_encode(odbc_result($qry, 'U_CustomerName')),
"U_ClientTag"=> utf8_encode(odbc_result($qry, 'U_ClientTag')),
"U_ClientProject"=> utf8_encode(odbc_result($qry, 'U_ClientProject')),
"U_TruckerName"=> utf8_encode(odbc_result($qry, 'U_TruckerName')),
"U_TruckerTag"=> utf8_encode(odbc_result($qry, 'U_TruckerTag')),
"U_VehicleTypeCap"=> utf8_encode(odbc_result($qry, 'U_VehicleTypeCap')),
"U_DeliveryOrigin"=> utf8_encode(odbc_result($qry, 'U_DeliveryOrigin')),
"U_Destination"=> utf8_encode(odbc_result($qry, 'U_Destination')),
"U_DeliveryStatus"=> utf8_encode(odbc_result($qry, 'U_DeliveryStatus')),
"U_TripType"=> utf8_encode(odbc_result($qry, 'U_TripType')),
"U_NoOfDrops"=> utf8_encode(odbc_result($qry, 'U_NoOfDrops')),
"U_RemarksDTR"=> utf8_encode(odbc_result($qry, 'U_RemarksDTR')),
"U_GrossClientRates"=> number_format(odbc_result($qry, 'U_GrossClientRates'),2),
"U_GrossClientRatesTax"=> number_format(odbc_result($qry, 'U_GrossClientRatesTax'),2),
// "U_RateBasis"=> utf8_encode(odbc_result($qry, 'U_RateBasis')),
"U_TaxType"=> utf8_encode(odbc_result($qry, 'U_TaxType')),
"U_GrossProfitNet"=> number_format(odbc_result($qry, 'U_GrossProfitNet'),2),
"U_TotalAddtlCharges"=> number_format(odbc_result($qry, 'U_TotalAddtlCharges'),2),
"U_totalAddtlCharges2"=> number_format(odbc_result($qry, 'U_totalAddtlCharges2'),2),
"U_AddtlCharges"=> number_format(odbc_result($qry, 'pr_U_AddtlCharges'),2),
"U_GrossProfit"=> number_format(odbc_result($qry, 'U_GrossProfit'),2),
"U_TotalInitialClient"=> number_format(odbc_result($qry, 'U_TotalInitialClient'),2),
"U_TotalInitialTruckers"=> number_format(odbc_result($qry, 'U_TotalInitialTruckers'),2),
"U_TotalGrossProfit"=> number_format(odbc_result($qry, 'U_TotalGrossProfit'),2),
"U_ClientTag2"=> utf8_encode(odbc_result($qry, 'U_ClientTag2')),
// "U_UpdateDate"=> utf8_encode(odbc_result($qry, 'U_UpdateDate')),
// "U_CreateDate"=> utf8_encode(odbc_result($qry, 'U_CreateDate')),
"U_PODNum"=> utf8_encode(odbc_result($qry, 'pr_U_PODNum')),
"U_GrossTruckerRates"=> number_format(odbc_result($qry, 'U_GrossTruckerRates'),2),
"U_GrossTruckerRatesTax"=> number_format(odbc_result($qry, 'U_GrossTruckerRatesTax'),2),
"U_RateBasisT"=> utf8_encode(odbc_result($qry, 'U_RateBasisT')),
"U_TaxTypeT"=> utf8_encode(odbc_result($qry, 'U_TaxTypeT')),
"U_Demurrage4"=> number_format(odbc_result($qry, 'U_Demurrage4'),2),
"U_AddtlCharges2"=> number_format(odbc_result($qry, 'U_AddtlCharges2'),2),
"U_GrossProfitC"=> number_format(odbc_result($qry, 'U_GrossProfitC'),2),
"U_Demurrage"=> number_format(odbc_result($qry, 'U_Demurrage'),2),
"U_AddtlDrop"=> number_format(odbc_result($qry, 'pr_U_AddtlDrop'),2),
"U_BoomTruck"=> number_format(odbc_result($qry, 'pr_U_BoomTruck'),2),
"U_Manpower"=> number_format(odbc_result($qry, 'pr_U_Manpower'),2),
"U_Backload"=> number_format(odbc_result($qry, 'pr_U_Backload'),2),
"U_Demurrage2"=> number_format(odbc_result($qry, 'U_Demurrage2'),2),
"U_AddtlDrop2"=> number_format(odbc_result($qry, 'U_AddtlDrop2'),2),
"U_BoomTruck2"=> number_format(odbc_result($qry, 'pr_U_BoomTruck2'),2),
"U_Manpower2"=> number_format(odbc_result($qry, 'U_Manpower2'),2),
"U_Backload2"=> number_format(odbc_result($qry, 'U_Backload2'),2),
"U_Demurrage3"=> number_format(odbc_result($qry, 'U_Demurrage3'),2),
"ECVatGroup"=>utf8_encode(odbc_result($qry, 'ECVatGroup')),
"ECVatGroupS"=>utf8_encode(odbc_result($qry, 'ECVatGroupS')),
"U_ISLAND"=> odbc_result($qry, 'U_ISLAND'),
"U_ISLAND_D"=> odbc_result($qry, 'U_ISLAND_D'),
"U_IFINTERISLAND"=> odbc_result($qry, 'U_IFINTERISLAND'),
"DisableSomeFields"=> odbc_result($qry, 'DisableSomeFields'),
"DisableSomeFields2"=> odbc_result($qry, 'DisableSomeFields2'),

"U_PODSONum"=> odbc_result($qry, 'U_PODSONum'),
"U_ARDocNum"=> odbc_result($qry, 'U_ARDocNum'),
"U_ActualBilledRate"=> odbc_result($qry, 'U_ActualBilledRate'),
// "U_RateAdjustments"=> odbc_result($qry, 'U_RateAdjustments'),


	);
		
		
	}
	// echo print_r($arr);
	
	if ($err == 0) 
	{

		
		echo json_encode($arr);
		
		
	}
	else
	{
		echo 'FAILURE!';
	
	}

?>
	