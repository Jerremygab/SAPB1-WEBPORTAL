<?php
session_start();
include_once('../../../../config/config.php');

$cardCode = $_GET['cardCode'];
$address = $_GET['address'];
$addressCondition = '';
if($address == ''){
	$addressCondition = "T0.Address = T2.ShipToDef  AND";
}
else{
	$addressCondition = "T0.Address = '$address' AND" ;
}

$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
			SELECT 
				ISNULL(T0.Address,'') AS Address,
				ISNULL(T0.Street,'') AS Street,
				ISNULL(T0.StreetNo,'') AS StreetNo,
				ISNULL(T0.Block,'') AS Block,
				ISNULL(T0.ZipCode,'') AS ZipCode,
				ISNULL(T0.City,'') AS City,
				ISNULL(T0.County,'') AS County,
				ISNULL(T0.State,'') AS State,
				ISNULL(T0.Country,'') AS CountryCode,
				ISNULL(T1.Name,'') AS Country,
				ISNULL(T0.Building,'') AS Building
				
			FROM CRD1 T0
			LEFT JOIN OCRY T1 ON T0.Country = T1.Code
			INNER JOIN OCRD T2 ON T2.CardCode = T0.CardCode 

			WHERE ". $addressCondition ." T0.CardCode = '$cardCode'  and AdresType = 'S' 

			");

$arr = array();

while (odbc_fetch_row($qry)) 
{
	$arr[] = array(
				"Address" => odbc_result($qry, 'Address'),
				"Street" => odbc_result($qry, 'Street'),
				"StreetNo" => odbc_result($qry, 'StreetNo'),
				"Block" => odbc_result($qry, 'Block'),
				"ZipCode" => odbc_result($qry, 'ZipCode'),
				"City" => odbc_result($qry, 'City'),
				"County" => odbc_result($qry, 'County'),
				"State" => odbc_result($qry, 'State'),
				"CountryCode" => odbc_result($qry, 'CountryCode'),
				"Country" => odbc_result($qry, 'Country'),
				"Building" => odbc_result($qry, 'Building')
				
				
				);
            
}
odbc_free_result($qry);




echo json_encode($arr);

?>