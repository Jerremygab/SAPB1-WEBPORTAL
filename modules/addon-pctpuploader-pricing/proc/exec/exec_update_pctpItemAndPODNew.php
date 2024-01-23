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
$ClientTotalUploaded=0;
$TruckerTotalUploaded=0;
$existingItem = 0;
$existingPOD = 0;
$PODCode = 'None';
$creator = $_SESSION['SESS_NAME'];


$itemDataEach = '';

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




if((isset($_POST['pricingData']))){
	foreach ($pricingData as $key => $value) {
			$value1 = json_decode($value);
	   	$value = get_object_vars($value1); // convert object to array
	  

	

$U_BookingId=$value["U_BookingId"];


$U_GrossClientRates=$value["U_GrossClientRates"];
$U_RateBasis=$value["U_RateBasis"];
$U_GrossTruckerRates=$value["U_GrossTruckerRates"];
$U_RateBasisT=$value["U_RateBasisT"];
$U_Demurrage=$value["U_Demurrage"];
$U_AddtlDrop=$value["U_AddtlDrop"];
$U_BoomTruck=$value["U_BoomTruck"];
$U_Manpower=$value["U_Manpower"];
$U_Backload=$value["U_Backload"];

$U_Demurrage2=$value["U_Demurrage2"];
$U_AddtlDrop2=$value["U_AddtlDrop2"];
$U_BoomTruck2=$value["U_BoomTruck2"];
$U_Manpower2=$value["U_Manpower2"];
$U_Backload2=$value["U_Backload2"];



$qry5PODCode = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
	SELECT Code FROM [@PCTP_POD] WHERE U_BookingNumber = '$U_BookingId'");
	while (odbc_fetch_row($qry5PODCode)) 
		{
			$PODNum = odbc_result($qry5PODCode, "Code");
			
		}





try{



$qry5 = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 




BEGIN
 

UPDATE [@PCTP_PRICING] 

SET 



U_GrossClientRates=$U_GrossClientRates,
U_RateBasis='$U_RateBasis',
U_GrossTruckerRates=$U_GrossTruckerRates,
U_RateBasisT='$U_RateBasisT',
U_Demurrage=$U_Demurrage,
U_AddtlDrop=$U_AddtlDrop,
U_BoomTruck=$U_BoomTruck,
U_Manpower=$U_Manpower,
U_Backload=$U_Backload,

U_Demurrage2=$U_Demurrage2,
U_AddtlDrop2=$U_AddtlDrop2,
U_BoomTruck2=$U_BoomTruck2,
U_Manpower2=$U_Manpower2,
U_Backload2=$U_Backload2




WHERE 

U_BookingId	=	'$U_BookingId'

END
				 	

					");


$PODPosted +=1;
$ClientTotalUploaded+=empty($U_GrossClientRates) ? 0 : str_replace(',', '', $U_GrossClientRates);
$TruckerTotalUploaded+=empty($U_GrossTruckerRates) ? 0 : str_replace(',', '', $U_GrossTruckerRates);				
				
			}
		 catch (Exception $e) {

		
			
			}
			
		}

	}


	odbc_free_result($qry5);
	odbc_close($MSSQL_CONN);


		// if($existingItem == 1 && $existingPOD == 0){
			
		// }


				
	if ($err == 0) 
	{
		$data = array("valid"=>true, 
							"loggedIn" => 'Logged In!',
							"msg" => "Operation completed successfully!",
							
							"PODPosted"=>$PODPosted,
							"ClientTotalUploaded"=>number_format($ClientTotalUploaded,2),
							"TruckerTotalUploaded"=>number_format($TruckerTotalUploaded,2),

						);
		echo json_encode($data);
	}
	else
	{
		$data = array("valid"=>false, "msg"=>$errmsg);
		echo json_encode($data);
	}

?>