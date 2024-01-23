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
		U_BookingDate,
		U_CustomerName,
		U_SAPClient,
		U_GroupProject,
		U_PlateNumber,
		U_VehicleTypeCap,
		
	
		U_DeliveryStatus,
		U_DeliveryDatePOD,
		U_TripType,
		U_WaybillNo,
		U_ShipmentManifestNo,
		U_DeliveryReceiptNo,
		U_SeriesNo,
		
		
		U_ClientReceivedDate,
		U_ActualHCRecDate,
		U_PODinCharge,
		U_VerifiedDateHC,
	
		U_PTFNo,
		U_DateForwardedBT,
		U_BillingDeadline,
		U_BillingStatus,
		U_ServiceType,
		U_SINo,
		U_BillingTeam,

		U_GrossInitialRate,
		U_ActualBilledRate,
		U_RateAdjustments,
		U_ActualDemurrage,
		U_ActualAddCharges,
		U_TotalRecClients,
		U_CheckingTotalBilled,
		U_Checking,
		U_SOBNumber,
		U_OutletNo,
		U_CBM,
		U_SI_DRNo,
		U_DeliveryMode,
		U_SourceWhse,
		
		U_TotalInvAmount,
		U_SONo,
		U_NameCustomer,
		U_CategoryDR,
		U_ForwardLoad,
		U_BackLoad,
		U_IDNumber,
		U_TypeOfAccessorial,
		U_Status,
		U_TimeInEmptyDem,
		U_TimeOutEmptyDem,
		U_VerifiedEmptyDem,
		U_TimeInLoadedDem,
		U_TimeOutLoadedDem,
		U_VerifiedLoadedDem,
		
		U_TimeInAdvLoading,
		U_DayOfTheWeek,
		U_TimeIn,
		U_TimeOut,
		U_ODOIn,
		U_ODOOut,
		U_DocNum,
		U_PODNum,
		U_PODSONum,
		U_UpdateDate,
		U_CreateDate,
		U_UpdateTime,
		U_Demurrage,
		U_AddCharges,
		U_CWT2307,
		U_TotalExceed,
		U_TotalUsage,
		U_NoOfDrops,

	
		CAST(U_DeliveryOrigin as nvarchar) AS U_DeliveryOrigin,
		CAST(U_Destination as nvarchar) AS U_Destination,
		CAST(U_Remarks as nvarchar) AS U_Remarks,
		CAST(U_OtherPODDoc as nvarchar) AS U_OtherPODDoc,
		CAST(U_RemarksPOD as nvarchar) AS U_RemarksPOD,
		CAST(U_PODStatusDetail as nvarchar) AS U_PODStatusDetail,
		CAST(U_BTRemarks as nvarchar) AS U_BTRemarks
		

			
			





		FROM [dbo].[@PCTP_BILLING] WHERE U_PODNum = $pid ");


	$arr = array();
	while (odbc_fetch_row($qry)) 
	{
		
		$arr[] = array( 

		"Code"=> odbc_result($qry, 'Code'),
		"Name"=> odbc_result($qry, 'Name'),
		"U_BookingId"=> odbc_result($qry, 'U_BookingId'),
		"U_BookingDate"=> odbc_result($qry, 'U_BookingDate'),
		"U_CustomerName"=> odbc_result($qry, 'U_CustomerName'),
		"U_SAPClient"=> odbc_result($qry, 'U_SAPClient'),
		"U_GroupProject"=> odbc_result($qry, 'U_GroupProject'),
		"U_PlateNumber"=> odbc_result($qry, 'U_PlateNumber'),
		"U_VehicleTypeCap"=> odbc_result($qry, 'U_VehicleTypeCap'),
		"U_DeliveryOrigin"=> odbc_result($qry, 'U_DeliveryOrigin'),
		"U_Destination"=> odbc_result($qry, 'U_Destination'),
		"U_DeliveryStatus"=> odbc_result($qry, 'U_DeliveryStatus'),
		"U_DeliveryDatePOD"=> odbc_result($qry, 'U_DeliveryDatePOD'),
		"U_TripType"=> odbc_result($qry, 'U_TripType'),
		"U_WaybillNo"=> odbc_result($qry, 'U_WaybillNo'),
		"U_ShipmentManifestNo"=> odbc_result($qry, 'U_ShipmentManifestNo'),
		"U_DeliveryReceiptNo"=> odbc_result($qry, 'U_DeliveryReceiptNo'),
		"U_SeriesNo"=> odbc_result($qry, 'U_SeriesNo'),
		"U_OtherPODDoc"=> odbc_result($qry, 'U_OtherPODDoc'),
		"U_RemarksPOD"=> odbc_result($qry, 'U_RemarksPOD'),
		"U_ClientReceivedDate"=> odbc_result($qry, 'U_ClientReceivedDate'),
		"U_ActualHCRecDate"=> odbc_result($qry, 'U_ActualHCRecDate'),
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
		"U_GrossInitialRate"=> odbc_result($qry, 'U_GrossInitialRate'),
		"U_ActualBilledRate"=> odbc_result($qry, 'U_ActualBilledRate'),
		"U_RateAdjustments"=> odbc_result($qry, 'U_RateAdjustments'),
		"U_ActualDemurrage"=> odbc_result($qry, 'U_ActualDemurrage'),
		"U_ActualAddCharges"=> odbc_result($qry, 'U_ActualAddCharges'),
		"U_TotalRecClients"=> odbc_result($qry, 'U_TotalRecClients'),
		"U_CheckingTotalBilled"=> odbc_result($qry, 'U_CheckingTotalBilled'),
		"U_Checking"=> odbc_result($qry, 'U_Checking'),
		"U_SOBNumber"=> odbc_result($qry, 'U_SOBNumber'),
		"U_OutletNo"=> odbc_result($qry, 'U_OutletNo'),
		"U_CBM"=> odbc_result($qry, 'U_CBM'),
		"U_SI_DRNo"=> odbc_result($qry, 'U_SI_DRNo'),
		"U_DeliveryMode"=> odbc_result($qry, 'U_DeliveryMode'),
		"U_SourceWhse"=> odbc_result($qry, 'U_SourceWhse'),
		
		"U_TotalInvAmount"=> odbc_result($qry, 'U_TotalInvAmount'),
		"U_SONo"=> odbc_result($qry, 'U_SONo'),
		"U_NameCustomer"=> odbc_result($qry, 'U_NameCustomer'),
		"U_CategoryDR"=> odbc_result($qry, 'U_CategoryDR'),
		"U_ForwardLoad"=> odbc_result($qry, 'U_ForwardLoad'),
		"U_BackLoad"=> odbc_result($qry, 'U_BackLoad'),
		"U_IDNumber"=> odbc_result($qry, 'U_IDNumber'),
		"U_TypeOfAccessorial"=> odbc_result($qry, 'U_TypeOfAccessorial'),
		"U_Status"=> odbc_result($qry, 'U_Status'),
		"U_TimeInEmptyDem"=> odbc_result($qry, 'U_TimeInEmptyDem'),
		"U_TimeOutEmptyDem"=> odbc_result($qry, 'U_TimeOutEmptyDem'),
		"U_VerifiedEmptyDem"=> odbc_result($qry, 'U_VerifiedEmptyDem'),
		"U_TimeInLoadedDem"=> odbc_result($qry, 'U_TimeInLoadedDem'),
		"U_TimeOutLoadedDem"=> odbc_result($qry, 'U_TimeOutLoadedDem'),
		"U_VerifiedLoadedDem"=> odbc_result($qry, 'U_VerifiedLoadedDem'),
		"U_Remarks"=> odbc_result($qry, 'U_Remarks'),
		"U_TimeInAdvLoading"=> odbc_result($qry, 'U_TimeInAdvLoading'),
		"U_DayOfTheWeek"=> odbc_result($qry, 'U_DayOfTheWeek'),
		"U_TimeIn"=> odbc_result($qry, 'U_TimeIn'),
		"U_TimeOut"=> odbc_result($qry, 'U_TimeOut'),
		"U_ODOIn"=> odbc_result($qry, 'U_ODOIn'),
		"U_ODOOut"=> odbc_result($qry, 'U_ODOOut'),
		"U_DocNum"=> odbc_result($qry, 'U_DocNum'),
		"U_PODNum"=> odbc_result($qry, 'U_PODNum'),
		"U_PODSONum"=> odbc_result($qry, 'U_PODSONum'),
		"U_UpdateDate"=> odbc_result($qry, 'U_UpdateDate'),
		"U_CreateDate"=> odbc_result($qry, 'U_CreateDate'),
		"U_UpdateTime"=> odbc_result($qry, 'U_UpdateTime'),
		"U_Demurrage"=> odbc_result($qry, 'U_Demurrage'),
		"U_AddCharges"=> odbc_result($qry, 'U_AddCharges'),
		"U_CWT2307"=> odbc_result($qry, 'U_CWT2307'),
		"U_TotalExceed"=> odbc_result($qry, 'U_TotalExceed'),
		"U_TotalUsage"=> odbc_result($qry, 'U_TotalUsage'),
		"U_NoOfDrops"=> odbc_result($qry, 'U_NoOfDrops')

					

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
	