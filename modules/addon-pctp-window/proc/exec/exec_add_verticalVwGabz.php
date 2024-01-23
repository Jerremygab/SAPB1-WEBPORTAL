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
$PODNum=utf8_decode($_POST["PODNum"]);

$ClientTag=utf8_decode($_POST["ClientTag"]);
$CustomerName=utf8_decode($_POST["CustomerName"]);
$ClientProject=utf8_decode($_POST["ClientProject"]);
$TruckerTag=utf8_decode($_POST["TruckerTag"]);
$TruckerName=utf8_decode($_POST["TruckerName"]);
$VehicleTypeCap=utf8_decode($_POST["VehicleTypeCap"]);


$DeliveryOrigin=utf8_decode($_POST["DeliveryOrigin"]);


$ISLAND=utf8_decode($_POST["ISLAND"]);
$Destination=utf8_decode($_POST["Destination"]);

$IFINTERISLAND=utf8_decode($_POST["IFINTERISLAND"]);
$DeliveryStatus=utf8_decode($_POST["DeliveryStatus"]);
$TripType=utf8_decode($_POST["TripType"]);
$NoOfDrops=utf8_decode($_POST["NoOfDrops"]);
$RemarksDTR=utf8_decode($_POST["RemarksDTR"]);

$RemarksPOD=utf8_decode($_POST["RemarksPOD"]);

$GrossClientRates=utf8_decode($_POST["GrossClientRates"]);

$RateBasis=utf8_decode($_POST["RateBasis"]);
$TaxType=utf8_decode($_POST["TaxType"]);
$GrossTruckerRates=utf8_decode($_POST["GrossTruckerRates"]);
$GrossTruckerRatesTax=utf8_decode($_POST["GrossTruckerRatesTax"]);
$RateBasisT=utf8_decode($_POST["RateBasisT"]);
$TaxTypeT=utf8_decode($_POST["TaxTypeT"]);


$GrossProfitNet=utf8_decode($_POST["GrossProfitNet"]);
$Demurrage=utf8_decode($_POST["Demurrage"]);
$AddtlDrop=utf8_decode($_POST["AddtlDrop"]);
$BoomTruck=utf8_decode($_POST["BoomTruck"]);
$Manpower=utf8_decode($_POST["Manpower"]);
$PTFNo=utf8_decode($_POST["PTFNo"]);
$TotalAddtlCharges=utf8_decode($_POST["TotalAddtlCharges"]);
$Demurrage4=utf8_decode($_POST["Demurrage4"]);
$AddtlCharges2=utf8_decode($_POST["AddtlCharges2"]);
$Demurrage2=utf8_decode($_POST["Demurrage2"]);
$AddtlDrop2=utf8_decode($_POST["AddtlDrop2"]);




$BoomTruck2=utf8_decode($_POST["BoomTruck2"]);
$Manpower2=utf8_decode($_POST["Manpower2"]);
$Backload2=utf8_decode($_POST["Backload2"]);
$totalAddtlCharges2=utf8_decode($_POST["totalAddtlCharges2"]);
$Demurrage3=utf8_decode($_POST["Demurrage3"]);
$GrossProfit=utf8_decode($_POST["GrossProfit"]);
$TotalInitialClient=utf8_decode($_POST["TotalInitialClient"]);
$TotalInitialTruckers=utf8_decode($_POST["TotalInitialTruckers"]);
$TotalGrossProfit=utf8_decode($_POST["TotalGrossProfit"]);
$RowNoVertical=utf8_decode($_POST["RowNoVertical"]);






					try{

					$PODNum = '';


				$qry2 = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 


						UPDATE [dbo].[@PCTP_PRICING] SET 

						
						U_BookingId = '$BookingId',
						U_ClientReceivedDate   = '$ClientReceivedDate',
						U_ActualDateRec_Intitial  = '$ActualDateRec_Intitial',
						U_InitialHCRecDate  = '$InitialHCRecDate',
						U_BookingDate = '$BookingDate',
						U_PODNum = '$PODNum',
						U_ClientTag = '$ClientTag',
						U_CustomerName = '$CustomerName',
						
						U_ClientProject = '$ClientProject',
						U_TruckerTag = '$TruckerTag',
						U_TruckerName = '$TruckerName',
						U_VehicleTypeCap = '$VehicleTypeCap',
						U_DeliveryOrigin = '$DeliveryOrigin',

						U_ISLAND = '$ISLAND',
						U_Destination = '$Destination',
						U_IFINTERISLAND = '$IFINTERISLAND',
						U_DeliveryStatus = $DeliveryStatus,
						U_TripType = '$TripType',
						U_NoOfDrops = '$NoOfDrops',
						U_RemarksDTR = '$RemarksDTR',
						U_RemarksPOD = '$RemarksPOD',
						U_GrossClientRates = '$GrossClientRates',
						U_RateBasis = '$RateBasis',
						U_TaxType = '$TaxType',

						U_GrossTruckerRates = '$GrossTruckerRates',
						U_GrossTruckerRatesTax = '$GrossTruckerRatesTax',
						U_RateBasisT = '$RateBasisT',
						U_TaxTypeT = '$TaxTypeT',
						U_GrossProfitNet = '$GrossProfitNet',
						U_Demurrage = '$Demurrage',
						U_AddtlDrop = '$AddtlDrop',
						U_BoomTruck = '$BoomTruck',
						U_Manpower = '$Manpower',
						U_PTFNo = '$PTFNo',
						U_Backload = '$Backload',
						U_TotalAddtlCharges = $TotalAddtlCharges,
						U_Demurrage4 = $Demurrage4,
						U_AddtlCharges2 = '$AddtlCharges2',
						U_Demurrage2 = '$Demurrage2',
						U_AddtlDrop2 = '$AddtlDrop2',
						U_BoomTruck2 = '$BoomTruck2',
						U_Manpower2 = '$Manpower2',
						U_Backload2 = '$Backload2',
						U_totalAddtlCharges2 = '$totalAddtlCharges2',
						U_Demurrage3 = '$Demurrage3',
						U_GrossProfit = '$GrossProfit',
						U_TotalInitialClient = '$TotalInitialClient',
						U_TotalInitialTruckers = '$TotalInitialTruckers',
						U_TotalGrossProfit = '$TotalGrossProfit',
						U_DestinationClient = '$DestinationClient',
						RowNoVertical = '$RowNoVertical'

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