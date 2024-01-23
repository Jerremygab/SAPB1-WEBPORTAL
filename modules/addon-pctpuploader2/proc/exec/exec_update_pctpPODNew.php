<?php
session_start();
include('../../../../config/config.php');
include('../../../connect/connect.php');
$userid = '';
$err = 0;
$errmsg = '';
$docentry = 0;
$rowdata = '';

$podData = '';
$creator = $_SESSION['SESS_NAME'];



if((isset($_POST['podData']))){
	$podData = $_POST['podData'];

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
// POD ------------------------------------------------------------------------------------------------------------
	$ctr = 0;
	$ctr2 = 0;

	

		if((isset($_POST['podData']))){

		$curl3 = curl_init();
		curl_setopt($curl3, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl3, CURLOPT_HEADER, 0);
		curl_setopt($curl3, CURLOPT_URL, $http . $host . ":" . $port . "/b1s/v1/U_PCTP_POD");
		curl_setopt($curl3, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl3, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl3, CURLOPT_VERBOSE, 1);
		curl_setopt($curl3, CURLOPT_POST, true);
		curl_setopt($curl3, CURLOPT_POSTFIELDS, str_replace('}',',"U_CreateDate": "'.date("Y-m-d").'"}',stripslashes($podData)));


		$response3 = curl_exec($curl3);

		$ctr2++;

	}


			
		
		


		

	




if ($err == 0) 
{
	$data = array("valid"=>true, 
						"loggedIn" => 'Logged In!',
						"msg" => "Operation completed successfully!",
						"result" => $response,
						"result3" => $response3,
						"ctr2"=>$ctr2
					);
	echo json_encode($data);
}
else
{
	$data = array("valid"=>false, "msg"=>$errmsg);
	echo json_encode($data);
}

?>