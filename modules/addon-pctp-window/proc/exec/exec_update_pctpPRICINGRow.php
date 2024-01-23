<?php
session_start();
include('../../../../config/config.php');
include('../../../connect/connect.php');
$userid = '';
$err = 0;
$errmsg = '';
$docentry = 0;
$pid = '';
$pricingData = '';
if((isset($_POST['pid']))){
	$pid = trim($_POST['pid']);

}
if((isset($_POST['pricingData']))){
	$pricingData = $_POST['pricingData'];

}



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
// ITEM ------------------------------------------------------------------------------------------------------------
	$ctr = 0;
	$ctr2 = 0;
	
$qry2 = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
	 SELECT
	 T0.Code
	 FROM [@PCTP_PRICING] T0
	 INNER JOIN [@PCTP_POD] T1 ON T0.U_BookingID = T1.U_BookingNumber

	 WHERE T1.U_BookingNumber =  '$pid'");

	while (odbc_fetch_row($qry2)) 
	{
			if(odbc_result($qry2, 'Code') != 0){
	
				$ExistingCode = odbc_result($qry2, 'Code');
	
		if((isset($_POST['pricingData']))){

					
									$curl3 = curl_init();
									curl_setopt($curl3, CURLOPT_HTTPHEADER, $headers);
									curl_setopt($curl3, CURLOPT_HEADER, 0);
									curl_setopt($curl3, CURLOPT_URL, $http . $host . ":" . $port . "/b1s/v1/U_PCTP_PRICING(" . $ExistingCode . ")");
									curl_setopt($curl3, CURLOPT_RETURNTRANSFER, true);
									curl_setopt($curl3, CURLOPT_SSL_VERIFYPEER, false);
									curl_setopt($curl3, CURLOPT_VERBOSE, 1);
									curl_setopt($curl3, CURLOPT_CUSTOMREQUEST, 'PATCH');
									curl_setopt($curl3, CURLOPT_POSTFIELDS, stripslashes($pricingData));

									$response3 = curl_exec($curl3);

			}
		}
	}

					

				
	if ($err == 0) 
	{
		$data = array("valid"=>true, 
							"loggedIn" => 'Logged In!',
							"msg" => "Operation completed successfully!",
							"result" => $response3,
							

						);
		echo json_encode($data);
	}
	else
	{
		$data = array("valid"=>false, "msg"=>$errmsg);
		echo json_encode($data);
	}

?>