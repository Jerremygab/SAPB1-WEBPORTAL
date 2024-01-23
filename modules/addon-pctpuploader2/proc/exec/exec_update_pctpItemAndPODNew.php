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

$existingItem = 0;
$existingPOD = 0;
$PODCode = 'None';
$creator = $_SESSION['SESS_NAME'];


$itemDataEach = '';

if((isset($_POST['itemCode']))){
	$itemCode = $_POST['itemCode'];

}
if((isset($_POST['itemData'])) ) 
{  
  $itemData  = $_POST['itemData'];
}
if((isset($_POST['podData']))){
	$podData = $_POST['podData'];

}
if((isset($_POST['billingData']))){
	$billingData = $_POST['billingData'];

}
if((isset($_POST['tpData']))){
	$tpData = $_POST['tpData'];

}
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



//http prefix
$http = 'https://';
// Host name
$host = $server;

// Port
$port = 50000;

// Login credentials
$params = [

	"CompanyDB" => $CompanyDB,
    "UserName" => "manager",
    "Password" => "sapb1",
   
    
];


$curl = curl_init();
curl_setopt($curl, CURLOPT_HEADER, 0);
curl_setopt($curl, CURLOPT_URL, $http . $host . ":" . $port . "/b1s/v1/Login");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_VERBOSE, 1);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($params));

$response = curl_exec($curl);
$response2 = '';
$response3 = '';
$response4 = '';
$jObj = json_decode($response);
$sessionId = $jObj->SessionId;
$routeId = ".node0";
$headers[] = "Cookie: B1SESSION=" . $sessionId . "; ROUTEID=" . $routeId . ";";
$PODNum = '';
$tester = '1212';
// ITEM 

// 	$params1 = [

// 		"ItemCode" => 'atemCode111',
// 		"ItemName" => 'atemName111',
// 		"ItemsGroupCode" => 103
   
    
// ];
// if((isset($_POST['itemData']))){

// 						$curl2 = curl_init();
// 						curl_setopt($curl2, CURLOPT_HTTPHEADER, $headers);
// 						curl_setopt($curl2, CURLOPT_HEADER, 0);
// 						curl_setopt($curl2, CURLOPT_URL, $http . $host . ":" . $port . "/b1s/v1/Items");
// 						curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);
// 						curl_setopt($curl2, CURLOPT_SSL_VERIFYPEER, false);
// 						curl_setopt($curl2, CURLOPT_VERBOSE, 1);
// 						curl_setopt($curl2, CURLOPT_POST, true);
// 						curl_setopt($curl2, CURLOPT_POSTFIELDS,  json_encode($params1));


// 						$response2 = curl_exec($curl2);

// 						$ctr++;

// 					}

		// ------------------------------------------------------------------------------------------------------------

	
 foreach ($itemData as $key => $value) {
	$value1 = json_decode($value);

	$value = get_object_vars($value1); // convert object to array
   




			$ItemCode = $value["ItemCode"];
			$ItemName = $value["ItemName"];
			$ItmsGrpCod = 103;


	$params1 = [

		"ItemCode" => $ItemCode,
		"ItemName" => $ItemName,
		"InventoryItem" => "tNO",
		"ItemsGroupCode" => 103
   
    
];

	$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
		SELECT 

		COUNT(ItemCode) AS Count
		
		FROM OITM T0

		WHERE T0.ItemCode = '$ItemCode'");

		while (odbc_fetch_row($qry)) 
		{
				if(odbc_result($qry, 'Count') != 0){

					$existingItem += 1;
					$response2 = json_encode(array("ItemCode"=>'Existing'));
					$ctr++;
				}else{
					if((isset($_POST['itemData']))){

						$curl2 = curl_init();
						curl_setopt($curl2, CURLOPT_HTTPHEADER, $headers);
						curl_setopt($curl2, CURLOPT_HEADER, 0);
						curl_setopt($curl2, CURLOPT_URL, $http . $host . ":" . $port . "/b1s/v1/Items");
						curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);
						curl_setopt($curl2, CURLOPT_SSL_VERIFYPEER, false);
						curl_setopt($curl2, CURLOPT_VERBOSE, 1);
						curl_setopt($curl2, CURLOPT_POST, true);
						curl_setopt($curl2, CURLOPT_POSTFIELDS, json_encode($params1));


						$response2 = curl_exec($curl2);
						$ItemPosted +=1;
						$ctr++;

					}
				}
				 
		}
		odbc_free_result($qry);

}
// if((isset($_POST['itemData']))){
// foreach ($itemData as $key => $value) {
// 		$value1 = json_decode($value);
//    	$value = get_object_vars($value1); // convert object to array
   

// 		 if((isset($value["ItemCode"]))){


// 			$ItemCode = $value["ItemCode"];
// 			$ItemName = $value["ItemName"];
// 			$ItmsGrpCod = 103;


// 	try{
// 					$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
					   

// 							BEGIN
// 							   IF NOT EXISTS (SELECT * FROM [OITM]
// 							                   WHERE ItemCode = '$ItemCode')
// 							   BEGIN
							       
						       

// INSERT INTO [OITM]

// (

// Series,
// ItemCode,
// ItemName,
// ItmsGrpCod,
// VatGourpSa,
// VatGroupPu, 
// UgpEntry,
// InvntItem,
// NumInSale,
// SalPackUn,
// SalFactor1,
// SalFactor2,
// SalFactor3,
// SalFactor4,
// NumInBuy,
// PurPackUn,
// PurFactor1,
// PurFactor2,
// PurFactor3,
// PurFactor4,
// Onhand,
// GLMethod,
// IUoMEntry
// )

// VALUES 
// (
// 		3,
// 		'$ItemCode',
// 		'$ItemName',
// 		103,
// 		'OVAT-N',
// 		'IVAT-N',
// 		'-1',
// 		'N',
// 		1,
// 		1,
// 		1,
// 		1,
// 		1,
// 		1,
// 		1,
// 		1,
// 		1,
// 		1,
// 			1,
// 		1,
		
// 		0.00,
// 		'C',
// 		-1

// )

// 							   END

// 							END");

// 	$qryAA = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
					   

// 							BEGIN
// 							   IF NOT EXISTS (SELECT * FROM [OITW]
// 							                   WHERE ItemCode = '$ItemCode')
// 							   BEGIN
// INSERT INTO OITW

// (
// ItemCode,
// WhsCode
// )
// values(
// '$ItemCode',
// '01'
// )




// 			   END

// 							END");


// 		$qryBB = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
					   

// 							BEGIN
// 							   IF NOT EXISTS (SELECT * FROM [ITM1]
// 							                   WHERE ItemCode = '$ItemCode')
// 							   BEGIN

// INSERT INTO ITM1 



// (
// ItemCode,
// PriceList
// )

// VALUES 
// (
// '$ItemCode',
// 1
// ),
// (
// '$ItemCode',
// 2
// ),
// (
// '$ItemCode',
// 3
// ),
// (
// '$ItemCode',
// 4
// ),
// (
// '$ItemCode',
// 5
// ),
// (
// '$ItemCode',
// 6
// ),
// (
// '$ItemCode',
// 7
// ),
// (
// '$ItemCode',
// 8
// ),
// (
// '$ItemCode',
// 9
// ),
// (
// '$ItemCode',
// 10
// )

// 			   END

// 							END");

				



	
// 					$ItemPosted +=1;
// 					$msgItem = 'Item Posted';
// 				}
// 			 catch (Exception $e) {

// 			 	 	$msgItem = 'Item Not Posted';
			
// 			}	
// 		}

// 	}

// }


if((isset($_POST['podData']))){
	foreach ($podData as $key => $value) {
			$value1 = json_decode($value);
	   	$value = get_object_vars($value1); // convert object to array
	  
	   	
		
				  $U_BookingDate = $value["U_BookingDate"];

					$U_BookingNumber =  $value["U_BookingNumber"];   
					$U_ClientName =  $value["U_ClientName"];
					$U_SAPClient =  $value["U_SAPClient"];
					$U_TruckerName =  utf8_encode($value["U_TruckerName"]);
					$U_SAPTrucker =  $value["U_SAPTrucker"];    
					$U_PlateNumber =  $value["U_PlateNumber"];
					$U_VehicleTypeCap =  $value["U_VehicleTypeCap"];
					$U_DeliveryOrigin =  !is_null($value["U_DeliveryOrigin"]) ? utf8_encode($value["U_DeliveryOrigin"]) : $value["U_DeliveryOrigin"];
					$U_Destination =   !is_null($value["U_Destination"]) ? utf8_encode($value["U_Destination"]) : $value["U_Destination"];
				
					$U_DeliveryStatus =  $value["U_DeliveryStatus"];

					$U_DeliveryDateDTR = $value["U_DeliveryDateDTR"];

					$U_NoOfDrops =  $value["U_NoOfDrops"];
					$U_DocNum =  $value["U_DocNum"];
					$U_Remarks = $value["U_Remarks"];
					$Name =  $value["Name"];

					try{

					$PODNum = '';

				  $qry2 = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 




					BEGIN
					   IF NOT EXISTS (SELECT * FROM [@PCTP_POD]
					                   WHERE U_BookingNumber = '$U_BookingNumber')
					   BEGIN
					       

								INSERT INTO [@PCTP_POD]

								(
									U_BookingDate,
									U_BookingNumber,
									U_ClientName,
									U_SAPClient,
									U_TruckerName,
									U_SAPTrucker,
									U_PlateNumber,
									U_VehicleTypeCap,
									U_DeliveryOrigin,
									U_Destination,
									U_DeliveryStatus,
									U_DeliveryDateDTR,
									U_NoOfDrops,
									U_DocNum,
									U_Remarks,
									Name
								)
								OUTPUT INSERTED.Code
								VALUES 
								(
									'$U_BookingDate',
									'$U_BookingNumber',
									'$U_ClientName',
									'$U_SAPClient',
									'$U_TruckerName',
									'$U_SAPTrucker',
									'$U_PlateNumber',
									'$U_VehicleTypeCap',
									'$U_DeliveryOrigin',
									'$U_Destination',
									'$U_DeliveryStatus',
									'$U_DeliveryDateDTR',
									 $U_NoOfDrops,
									'$U_DocNum',
									'$U_Remarks',
									'$Name'
								)


					   END

						 ELSE 

						 BEGIN 

						 UPDATE [@PCTP_POD] 

						 SET 

						 U_BookingDate = '$U_BookingDate',

						U_ClientName	=	'$U_ClientName',	
						U_SAPClient	=	'$U_SAPClient',	
						U_TruckerName	=	'$U_TruckerName',	
						U_SAPTrucker	=	'$U_SAPTrucker',	
						U_PlateNumber	=	'$U_PlateNumber',	
						U_VehicleTypeCap	=	'$U_VehicleTypeCap',	
						U_DeliveryOrigin	=	'$U_DeliveryOrigin',	
						U_Destination	=	'$U_Destination',	
						U_DeliveryStatus	=	'$U_DeliveryStatus',	
						U_DeliveryDateDTR	=	'$U_DeliveryDateDTR',	
						U_NoOfDrops	=	 $U_NoOfDrops,	
						U_DocNum	=	'$U_DocNum',	
						U_Remarks	=	'$U_Remarks',	
						Name	=	'$Name'	

						OUTPUT INSERTED.Code

						WHERE 

						 U_BookingNumber	=	'$U_BookingNumber'


						 END



					END

				 	

					");
		while (odbc_fetch_row($qry2)) 
		{
			// $PODNum = odbc_result($qry2, "Code");
			
		}
				$PODPosted +=1;
				$msgPOD = 'POD Not Posted';
			}
		 catch (Exception $e) {

			 	$msgPOD = 'POD Not Posted';
			
			}
			
		}

	}



if((isset($_POST['billingData']))){
	foreach ($billingData as $key => $value) {
			$value1 = json_decode($value);
	   	$value = get_object_vars($value1); // convert object to array
	  

	
				  $U_BookingDate = $value["U_BookingDate"];

					$U_BookingNumber =  $value["U_BookingId"];   
					$U_ClientName =  $value["U_CustomerName"];
					$U_SAPClient =  $value["U_SAPClient"];
				
					$U_PlateNumber =  $value["U_PlateNumber"];
					$U_VehicleTypeCap =  $value["U_VehicleTypeCap"];
					$U_DeliveryOrigin =   !is_null($value["U_DeliveryOrigin"]) ? utf8_encode($value["U_DeliveryOrigin"]) : $value["U_DeliveryOrigin"];
					$U_Destination =   !is_null($value["U_DeliveryOrigin"]) ? utf8_encode($value["U_DeliveryOrigin"]) : $value["U_Destination"];
					$U_DeliveryStatus =  $value["U_DeliveryStatus"];

					$U_DeliveryDateDTR = $value["U_DeliveryDatePOD"];

					$Name =  $value["Name"];



$qry3PODCode = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
	SELECT Code FROM [@PCTP_POD] WHERE U_BookingNumber = '$U_BookingNumber'");
	while (odbc_fetch_row($qry3PODCode)) 
		{
			$PODNum = odbc_result($qry3PODCode, "Code");
			
		}

					try{



				  $qry3 = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 




					BEGIN
					   IF NOT EXISTS (SELECT * FROM [@PCTP_BILLING]
					                   WHERE U_BookingId = '$U_BookingNumber')
					   BEGIN
					       

							INSERT INTO [@PCTP_BILLING]

								(
									U_BookingDate,
									U_BookingId,
									U_CustomerName,
									U_SAPClient,
									U_PlateNumber,
									U_VehicleTypeCap,
									U_DeliveryOrigin,
									U_Destination,
									U_DeliveryStatus,
									U_DeliveryDatePOD,
									U_PODNum,
									Name
								)

								VALUES 
								(
									'$U_BookingDate',
									'$U_BookingNumber',
									'$U_ClientName',
									'$U_SAPClient',
									'$U_PlateNumber',
									'$U_VehicleTypeCap',
									'$U_DeliveryOrigin',
									'$U_Destination',
									'$U_DeliveryStatus',
									'$U_DeliveryDateDTR',
									'$PODNum',
									'$Name'
								)


					   END
					   ELSE
					   BEGIN 

						 UPDATE [@PCTP_BILLING] 

						 SET 

						 	U_BookingDate	=		'$U_BookingDate',	
							U_BookingId	=		'$U_BookingNumber',	
							U_CustomerName	=		'$U_ClientName',	
							U_SAPClient	=		'$U_SAPClient',	
							U_PlateNumber	=		'$U_PlateNumber',	
							U_VehicleTypeCap	=		'$U_VehicleTypeCap',	
							U_DeliveryOrigin	=		'$U_DeliveryOrigin',	
							U_Destination	=		'$U_Destination',	
							U_DeliveryStatus	=		'$U_DeliveryStatus',	
							U_DeliveryDatePOD	=		'$U_DeliveryDateDTR',	
							U_PODNum = '$PODNum',
							Name	=		'$Name'	



							WHERE 

							 U_BookingId	=	'$U_BookingNumber'


						 END
					END

				 	

					");
			
			}
		 catch (Exception $e) {

			 	
			
			}
			
		}

	}



if((isset($_POST['tpData']))){
	foreach ($tpData as $key => $value) {
			$value1 = json_decode($value);
	   	$value = get_object_vars($value1); // convert object to array
	  

	
				  $U_BookingDate = $value["U_BookingDate"];

					$U_BookingNumber =  $value["U_BookingId"];   
					$U_ClientName =  $value["U_ClientName"];
					$U_TruckerName =  utf8_encode($value["U_TruckerName"]);
					$U_SAPTrucker =  $value["U_TruckerSAP"];    
				
					$U_DeliveryStatus =  $value["U_DeliveryStatus"];

					$U_DeliveryDateDTR = $value["U_DeliveryDatePOD"];

					$Name =  $value["Name"];


$qry4PODCode = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
	SELECT Code FROM [@PCTP_POD] WHERE U_BookingNumber = '$U_BookingNumber'");
	while (odbc_fetch_row($qry4PODCode)) 
		{
			$PODNum = odbc_result($qry4PODCode, "Code");
			
		}

					try{



				  $qry4 = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 




					BEGIN
					   IF NOT EXISTS (SELECT * FROM [@PCTP_TP]
					                   WHERE U_BookingId = '$U_BookingNumber')
					   BEGIN
					       

							INSERT INTO [@PCTP_TP]

								(
										U_BookingDate,
										U_BookingId,
										U_ClientName,
										U_TruckerName,
										U_TruckerSAP,
										U_DeliveryStatus,
										U_DeliveryDatePOD,
										U_PODNum,
										Name
											
								)

								VALUES 
								(
									'$U_BookingDate',
									'$U_BookingNumber',
									'$U_ClientName',
									'$U_TruckerName',
									'$U_SAPTrucker',
									'$U_DeliveryStatus',
									'$U_DeliveryDateDTR',
									'$PODNum',
									'$Name'
								)


					   END
					      ELSE
					   BEGIN 

						 UPDATE [@PCTP_TP] 

						 SET 

							U_BookingDate	=	'$U_BookingDate',
							U_BookingId	=	'$U_BookingNumber',
							U_ClientName	=	'$U_ClientName',
							U_TruckerName	=	'$U_TruckerName',
							U_TruckerSAP	=	'$U_SAPTrucker',
							U_DeliveryStatus	=	'$U_DeliveryStatus',
							U_DeliveryDatePOD	=	'$U_DeliveryDateDTR',
							U_PODNum = '$PODNum',
							Name	=	'$Name'




							WHERE 

							 U_BookingId	=	'$U_BookingNumber'


						 END
					END

				 	

					");
				
			}
		 catch (Exception $e) {

			 	
			
			}
			
		}

	}


if((isset($_POST['pricingData']))){
	foreach ($pricingData as $key => $value) {
			$value1 = json_decode($value);
	   	$value = get_object_vars($value1); // convert object to array
	  

	
				  $U_BookingDate = $value["U_BookingDate"];

					$U_BookingNumber =  $value["U_BookingId"];   
					$U_ClientName =  $value["U_CustomerName"];

					$U_ClientTag =  $value["U_ClientTag"];


					$U_TruckerName =  utf8_encode($value["U_TruckerName"]);
					$U_TruckerTag =  $value["U_TruckerTag"];    
					

					$U_VehicleTypeCap =  $value["U_VehicleTypeCap"];
					$U_DeliveryOrigin =  $value["U_DeliveryOrigin"];
					$U_Destination =  $value["U_Destination"];
					$U_RemarksPOD =  $value["U_RemarksPOD"];

					$Name =  $value["Name"];


$qry5PODCode = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
	SELECT Code FROM [@PCTP_POD] WHERE U_BookingNumber = '$U_BookingNumber'");
	while (odbc_fetch_row($qry5PODCode)) 
		{
			$PODNum = odbc_result($qry5PODCode, "Code");
			
		}
					try{



				  $qry5 = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 




					BEGIN
					   IF NOT EXISTS (SELECT * FROM [@PCTP_PRICING]
					                   WHERE U_BookingId = '$U_BookingNumber')
					   BEGIN
					       

							INSERT INTO [@PCTP_PRICING]

								(
										U_BookingDate,
										U_BookingId,
										U_CustomerName,
										U_ClientTag,
										U_TruckerName,
										U_TruckerTag,
										U_VehicleTypeCap,
										U_DeliveryOrigin,
										U_Destination,
										U_RemarksPOD,
										U_PODNum,
										Name
											
								)

								VALUES 
								(
									'$U_BookingDate',
									'$U_BookingNumber',
									'$U_ClientName',
									'$U_ClientTag',
									'$U_TruckerName',
									'$U_TruckerTag',
									'$U_VehicleTypeCap',
									'$U_DeliveryOrigin',
									'$U_Destination',
									'$U_RemarksPOD',
									'$PODNum',
									'$Name'
								)


					   END
					   ELSE
					   BEGIN 

						 UPDATE [@PCTP_PRICING] 

						 SET 

							U_BookingDate	=	'$U_BookingDate',	
							U_BookingId	=	'$U_BookingNumber',	
							U_CustomerName	=	'$U_ClientName',	
							U_ClientTag	=	'$U_ClientTag',	
							U_TruckerName	=	'$U_TruckerName',	
							U_TruckerTag	=	'$U_TruckerTag',	
							U_VehicleTypeCap	=	'$U_VehicleTypeCap',	
							U_DeliveryOrigin	=	'$U_DeliveryOrigin',	
							U_Destination	=	'$U_Destination',	
							U_RemarksPOD	=	'$U_RemarksPOD',	
							U_PODNum = '$PODNum',
							Name	=	'$Name'	




							WHERE 

							 U_BookingId	=	'$U_BookingNumber'


						 END
					END

				 	

					");
				
			}
		 catch (Exception $e) {

		
			
			}
			
		}

	}


// odbc_free_result($qry);
// odbc_free_result($qryAA);
// odbc_free_result($qryBB);
odbc_free_result($qry2);
odbc_free_result($qry3);
odbc_free_result($qry4);
odbc_free_result($qry5);
odbc_close($MSSQL_CONN);


		// if($existingItem == 1 && $existingPOD == 0){
			
		// }


				
	if ($err == 0) 
	{
		$data = array("valid"=>true, 
							"loggedIn" => 'Logged In!',
							"msg" => json_encode($params),
							"ItemPosted"=>$ItemPosted,
							"PODPosted"=>$PODPosted

						);
		echo json_encode($data);
	}
	else
	{
		$data = array("valid"=>false, "msg"=>$errmsg);
		echo json_encode($data);
	}

?>