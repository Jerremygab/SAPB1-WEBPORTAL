<?php 
session_start();
include('../../../../../config/config.php');

	$err = 0;
	$errmsg = '';
	$ItemCode = '';

	$pid = $_GET["pid"];


	$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
		SELECT 
 

		Code,
		Name,
		U_BookingId,
		CONVERT(VARCHAR(10),U_BookingDate,23) AS U_BookingDate,
		U_ClientName,
		U_TruckerName,
		U_TruckerSAP,
		U_DeliveryStatus,
		CONVERT(VARCHAR(10),U_DeliveryDatePOD,23) AS U_DeliveryDatePOD,
		U_TripTicketNo,
		U_WaybillNo,
		U_ShipmentManifestNo,
		U_DeliveryReceiptNo,
		U_SeriesNo,
		 
		U_TPStatus,
		 CONVERT(VARCHAR(10), DATEADD(day, 1,U_BookingDate),23) AS U_Aging,

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
		U_ActualRates,
		U_RateAdjustments,
		U_ActualDemurrage,
		U_ActualCharges,
		U_BoomTruck2,
		U_OtherCharges,
		U_TotalSubPenalty,
		U_TotalPenaltyWaived,
		U_TotalPenaltyWaived - U_TotalSubPenalty AS U_TotalPenalty,
		U_TotalPayable,
		U_EWT2307,
		U_TotalPayableRec,
		U_PaymentVoucherNo,
		U_ORRefNo,
		U_ActualPaymentDate,
		U_PaymentReference,
		U_PaymentStatus,
		
		U_UpdateDate,
		U_CreateDate,
		U_PODNum,
		U_PODSONum,
		U_DocNum,
		CAST(U_OtherPODDoc as nvarchar) AS U_OtherPODDoc,


	    CAST(U_Remarks as nvarchar) AS U_Remarks

		FROM [dbo].[@PCTP_TP] 


		WHERE U_PODNum = $pid ");


	$arr = array();
	while (odbc_fetch_row($qry)) 
	{
		
		$arr[] = array( 

		"Code"=> odbc_result($qry, 'Code'),
		"Name"=> odbc_result($qry, 'Name'),
		"U_BookingId"=> odbc_result($qry, 'U_BookingId'),
		"U_BookingDate"=> odbc_result($qry, 'U_BookingDate'),
		"U_ClientName"=> odbc_result($qry, 'U_ClientName'),
		"U_TruckerName"=> odbc_result($qry, 'U_TruckerName'),
		"U_TruckerSAP"=> odbc_result($qry, 'U_TruckerSAP'),
		"U_DeliveryStatus"=> odbc_result($qry, 'U_DeliveryStatus'),
		"U_DeliveryDatePOD"=> odbc_result($qry, 'U_DeliveryDatePOD'),
		"U_TripTicketNo"=> odbc_result($qry, 'U_TripTicketNo'),
		"U_WaybillNo"=> odbc_result($qry, 'U_WaybillNo'),
		"U_ShipmentManifestNo"=> odbc_result($qry, 'U_ShipmentManifestNo'),
		"U_DeliveryReceiptNo"=> odbc_result($qry, 'U_DeliveryReceiptNo'),
		"U_SeriesNo"=> odbc_result($qry, 'U_SeriesNo'),
		"U_OtherPODDoc"=> odbc_result($qry, 'U_OtherPODDoc'),
		"U_TPStatus"=> odbc_result($qry, 'U_TPStatus'),
		"U_Aging"=> odbc_result($qry, 'U_Aging'),
		"U_GrossTruckerRates"=> odbc_result($qry, 'U_GrossTruckerRates'),
		"U_GrossTruckerRatesN"=> odbc_result($qry, 'U_GrossTruckerRatesN'),
		"U_RateBasis"=> odbc_result($qry, 'U_RateBasis'),
		"U_TaxType"=> odbc_result($qry, 'U_TaxType'),
		"U_Demurrage"=> odbc_result($qry, 'U_Demurrage'),
		"U_AddtlDrop"=> odbc_result($qry, 'U_AddtlDrop'),
		"U_BoomTruck"=> odbc_result($qry, 'U_BoomTruck'),
		"U_Manpower"=> odbc_result($qry, 'U_Manpower'),
		"U_BackLoad"=> odbc_result($qry, 'U_BackLoad'),
		"U_Addtlcharges"=> odbc_result($qry, 'U_Addtlcharges'),
		"U_DemurrageN"=> odbc_result($qry, 'U_DemurrageN'),
		"U_AddtlChargesN"=> odbc_result($qry, 'U_AddtlChargesN'),
		"U_ActualRates"=> odbc_result($qry, 'U_ActualRates'),
		"U_RateAdjustments"=> odbc_result($qry, 'U_RateAdjustments'),
		"U_ActualDemurrage"=> odbc_result($qry, 'U_ActualDemurrage'),
		"U_ActualCharges"=> odbc_result($qry, 'U_ActualCharges'),
		"U_BoomTruck2"=> odbc_result($qry, 'U_BoomTruck2'),
		"U_OtherCharges"=> odbc_result($qry, 'U_OtherCharges'),
		"U_TotalSubPenalty"=> odbc_result($qry, 'U_TotalSubPenalty'),
		"U_TotalPenaltyWaived"=> odbc_result($qry, 'U_TotalPenaltyWaived'),
		"U_TotalPenalty"=> odbc_result($qry, 'U_TotalPenalty'),
		"U_TotalPayable"=> odbc_result($qry, 'U_TotalPayable'),
		"U_EWT2307"=> odbc_result($qry, 'U_EWT2307'),
		"U_TotalPayableRec"=> odbc_result($qry, 'U_TotalPayableRec'),
		"U_PaymentVoucherNo"=> odbc_result($qry, 'U_PaymentVoucherNo'),
		"U_ORRefNo"=> odbc_result($qry, 'U_ORRefNo'),
		"U_ActualPaymentDate"=> odbc_result($qry, 'U_ActualPaymentDate'),
		"U_PaymentReference"=> odbc_result($qry, 'U_PaymentReference'),
		"U_PaymentStatus"=> odbc_result($qry, 'U_PaymentStatus'),
		"U_Remarks"=> odbc_result($qry, 'U_Remarks'),
		"U_UpdateDate"=> odbc_result($qry, 'U_UpdateDate'),
		"U_CreateDate"=> odbc_result($qry, 'U_CreateDate'),
		"U_PODNum"=> odbc_result($qry, 'U_PODNum'),
		"U_PODSONum"=> odbc_result($qry, 'U_PODSONum'),
		"U_DocNum"=> odbc_result($qry, 'U_DocNum')
						

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
	