<?php
session_start();
include_once('../../../../config/config.php');

$userid = '';
$err = 0;
$errmsg = '';
$docentry = 0;
$message = '';

//http prefix
$http = 'https://';
// Host name
$host = "juswa";

// Port
$port = 50000;

// Login credentials
$params = [

	"CompanyDB" => "EBI_LIVEDB_20220530",
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




$select = '?$select=CardCode,CardName,CardType,Address,City,Country,ZipCode';

$result = curl_setopt($curl, CURLOPT_URL, $http . $host . ":" . $port . "/b1s/v1/BusinessPartners" . $select);


echo $result;
// if ($err == 0) 
// {
// 	$data = array("valid"=>true, 
// 						"msg"=>"Operation completed successfully - " .$response,
// 						"name"=>$message);
// 	echo json_encode($data);
// }
// else
// {
// 	$data = array("valid"=>false, "msg"=>$response);
// 	echo json_encode($data);
// }



?>