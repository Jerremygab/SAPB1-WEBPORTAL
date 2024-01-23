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
U_ClientTag,
U_ClientProject,
U_TruckerName,
T0.U_TruckerTag,
U_VehicleTypeCap,


U_DeliveryStatus,
U_TripType,
U_NoOfDrops,


U_GrossClientRates,
U_GrossClientRatesTax,
U_RateBasis,
U_TaxType,
U_GrossProfitNet,
U_TotalAddtlCharges,
U_totalAddtlCharges2,
U_AddtlCharges,
U_GrossProfit,
U_TotalInitialClient,
U_TotalInitialTruckers,
U_TotalGrossProfit,
U_ClientTag2,
U_UpdateDate,
U_CreateDate,
U_PODNum,
U_GrossTruckerRates,
U_GrossTruckerRatesTax,
U_RateBasisT,
U_TaxTypeT,
U_Demurrage4,
U_AddtlCharges2,
U_GrossProfitC,
U_Demurrage,
U_AddtlDrop,
U_BoomTruck,
U_Manpower,
U_Backload,
U_Demurrage2,
U_AddtlDrop2,
U_BoomTruck2,
U_Manpower2,
U_Backload2,
U_Demurrage3,

CAST(U_DeliveryOrigin as nvarchar) AS U_DeliveryOrigin,
CAST(U_Destination as nvarchar) AS U_Destination,

CAST(U_RemarksPOD as nvarchar) AS U_RemarksPOD,
CAST(U_RemarksDTR as nvarchar) AS U_RemarksDTR,

T1.ECVatGroup,
T2.ECVatGroup AS ECVatGroupS



FROM [dbo].[@PCTP_PRICING] T0
INNER JOIN OCRD T1 ON T1.CardCode = U_ClientTag
INNER JOIN OCRD T2 ON T2.CardCode = T0.U_TruckerTag

WHERE U_PODNum = $pid ");


	$arr = array();
	while (odbc_fetch_row($qry)) 
	{
		
		$arr[] = array( 
"Code"=> odbc_result($qry, 'Code'),
"Name"=> odbc_result($qry, 'Name'),
"U_BookingId"=> odbc_result($qry, 'U_BookingId'),
"U_BookingDate"=> odbc_result($qry, 'U_BookingDate'),
"U_CustomerName"=> odbc_result($qry, 'U_CustomerName'),
"U_ClientTag"=> odbc_result($qry, 'U_ClientTag'),
"U_ClientProject"=> odbc_result($qry, 'U_ClientProject'),
"U_TruckerName"=> odbc_result($qry, 'U_TruckerName'),
"U_TruckerTag"=> odbc_result($qry, 'U_TruckerTag'),
"U_VehicleTypeCap"=> odbc_result($qry, 'U_VehicleTypeCap'),
"U_DeliveryOrigin"=> odbc_result($qry, 'U_DeliveryOrigin'),
"U_Destination"=> odbc_result($qry, 'U_Destination'),
"U_DeliveryStatus"=> odbc_result($qry, 'U_DeliveryStatus'),
"U_TripType"=> odbc_result($qry, 'U_TripType'),
"U_NoOfDrops"=> odbc_result($qry, 'U_NoOfDrops'),
"U_RemarksDTR"=> odbc_result($qry, 'U_RemarksDTR'),
"U_RemarksPOD"=> odbc_result($qry, 'U_RemarksPOD'),
"U_GrossClientRates"=> odbc_result($qry, 'U_GrossClientRates'),
"U_GrossClientRatesTax"=> odbc_result($qry, 'U_GrossClientRatesTax'),
"U_RateBasis"=> odbc_result($qry, 'U_RateBasis'),
"U_TaxType"=> odbc_result($qry, 'U_TaxType'),
"U_GrossProfitNet"=> odbc_result($qry, 'U_GrossProfitNet'),
"U_TotalAddtlCharges"=> odbc_result($qry, 'U_TotalAddtlCharges'),
"U_totalAddtlCharges2"=> odbc_result($qry, 'U_totalAddtlCharges2'),
"U_AddtlCharges"=> odbc_result($qry, 'U_AddtlCharges'),
"U_GrossProfit"=> odbc_result($qry, 'U_GrossProfit'),
"U_TotalInitialClient"=> odbc_result($qry, 'U_TotalInitialClient'),
"U_TotalInitialTruckers"=> odbc_result($qry, 'U_TotalInitialTruckers'),
"U_TotalGrossProfit"=> odbc_result($qry, 'U_TotalGrossProfit'),
"U_ClientTag2"=> odbc_result($qry, 'U_ClientTag2'),
"U_UpdateDate"=> odbc_result($qry, 'U_UpdateDate'),
"U_CreateDate"=> odbc_result($qry, 'U_CreateDate'),
"U_PODNum"=> odbc_result($qry, 'U_PODNum'),
"U_GrossTruckerRates"=> odbc_result($qry, 'U_GrossTruckerRates'),
"U_GrossTruckerRatesTax"=> odbc_result($qry, 'U_GrossTruckerRatesTax'),
"U_RateBasisT"=> odbc_result($qry, 'U_RateBasisT'),
"U_TaxTypeT"=> odbc_result($qry, 'U_TaxTypeT'),
"U_Demurrage4"=> odbc_result($qry, 'U_Demurrage4'),
"U_AddtlCharges2"=> odbc_result($qry, 'U_AddtlCharges2'),
"U_GrossProfitC"=> odbc_result($qry, 'U_GrossProfitC'),
"U_Demurrage"=> odbc_result($qry, 'U_Demurrage'),
"U_AddtlDrop"=> odbc_result($qry, 'U_AddtlDrop'),
"U_BoomTruck"=> odbc_result($qry, 'U_BoomTruck'),
"U_Manpower"=> odbc_result($qry, 'U_Manpower'),
"U_Backload"=> odbc_result($qry, 'U_Backload'),
"U_Demurrage2"=> odbc_result($qry, 'U_Demurrage2'),
"U_AddtlDrop2"=> odbc_result($qry, 'U_AddtlDrop2'),
"U_BoomTruck2"=> odbc_result($qry, 'U_BoomTruck2'),
"U_Manpower2"=> odbc_result($qry, 'U_Manpower2'),
"U_Backload2"=> odbc_result($qry, 'U_Backload2'),
"U_Demurrage3"=> odbc_result($qry, 'U_Demurrage3'),
"ECVatGroup"=>odbc_result($qry, 'ECVatGroup'),
"ECVatGroupS"=>odbc_result($qry, 'ECVatGroupS')
					
			
					


					
				

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
	