<?php
session_start();
include('../../../../config/config.php');

$table = $_POST['childTable12'];

if (isset($_POST['docEntry'])) {
	$docEntry = $_GET['docNum'];
	$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
		SELECT
			ISNULL(T0.StreetS, '') AS StreetS,
			ISNULL(T0.StreetNoS, '') AS StreetNoS,
			ISNULL(T0.BlockS, '') AS BlockS,
			ISNULL(T0.CityS, '') AS CityS,
			ISNULL(T0.ZipCodeS, '') AS ZipCodeS,
			ISNULL(T0.CountyS, '') AS CountyS,
			ISNULL(T0.StateS, '') AS StateCode,
			ISNULL(T2.Name, '') AS StateName,
			ISNULL(T1.Name, '') AS CountryName,
			ISNULL(T1.Code, '') AS CountryCode,
			ISNULL(NULLIF(CAST(T0.BuildingS AS VARCHAR),''), '') AS BuildingS,
			ISNULL(T0.Address2S, '') AS Address2S,
			ISNULL(T0.Address3S, '') AS Address3S,
			ISNULL(T0.GlbLocNumS, '') AS GlbLocNumS
		FROM $table T0
			LEFT JOIN OCRY T1 ON T0.CountryS = T1.Code
			LEFT JOIN OCST T2 ON T0.StateS = T2.Code
		WHERE DocEntry = $docEntry
	");
} else {
	$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
		SELECT TOP 1
			ISNULL(T0.StreetS, '') AS StreetS,
			ISNULL(T0.StreetNoS, '') AS StreetNoS,
			ISNULL(T0.BlockS, '') AS BlockS,
			ISNULL(T0.CityS, '') AS CityS,
			ISNULL(T0.ZipCodeS, '') AS ZipCodeS,
			ISNULL(T0.CountyS, '') AS CountyS,
			ISNULL(T0.StateS, '') AS StateCode,
			ISNULL(T2.Name, '') AS StateName,
			ISNULL(T1.Name, '') AS CountryName,
			ISNULL(T1.Code, '') AS CountryCode,
			ISNULL(NULLIF(CAST(T0.BuildingS AS VARCHAR),''), '') AS BuildingS,
			ISNULL(T0.Address2S, '') AS Address2S,
			ISNULL(T0.Address3S, '') AS Address3S,
			ISNULL(T0.GlbLocNumS, '') AS GlbLocNumS
		FROM $table T0
			LEFT JOIN OCRY T1 ON T0.CountryS = T1.Code
			LEFT JOIN OCST T2 ON T0.StateS = T2.Code
	");
}


	$data = array();
		
	while (odbc_fetch_row($qry)) {
		$data['StreetS'] = odbc_result($qry, "StreetS");
		$data['StreetNoS'] = odbc_result($qry, "StreetNoS");
		$data['BlockS'] = odbc_result($qry, "BlockS");
		$data['CityS'] = odbc_result($qry, "CityS");
		$data['ZipCodeS'] = odbc_result($qry, "ZipCodeS");
		$data['CountyS'] = odbc_result($qry, "CountyS");
		$data['StateName'] = odbc_result($qry, "StateName");
		$data['StateCode'] = odbc_result($qry, "StateCode");
		$data['CountryName'] = odbc_result($qry, "CountryName");
		$data['CountryCode'] = odbc_result($qry, "CountryCode");
		$data['BuildingS'] = odbc_result($qry, "BuildingS");
		$data['Address2S'] = odbc_result($qry, "Address2S");
		$data['Address3S'] = odbc_result($qry, "Address3S");
		$data['GlbLocNumS'] = odbc_result($qry, "GlbLocNumS");

		$_SESSION['CountryCode'] = odbc_result($qry, "CountryCode");

	}

	odbc_free_result($qry);
	echo json_encode($data);
?>