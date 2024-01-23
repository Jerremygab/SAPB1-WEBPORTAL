<?php
session_start();
include_once('../../../../config/config.php');


$UserCode = $_SESSION['SESS_USERCODE'];


$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
			SELECT DISTINCT
				T0.CardCode, 
				T0.CardName,
				
				T3.CntctCode,
				T0.CntctPrsn,
				T0.LicTradNum,
				T0.GroupNum,
				T0.Currency,
				T2.PymntGroup
				
				
				
				FROM OCRD T0
				INNER JOIN CRD1 T1 ON T0.CardCode = T1.CardCode 
				INNER JOIN OCTG T2 ON T2.GroupNum = T0.GroupNum
				LEFT JOIN OCPR T3 ON T3.Name = T0.CntctPrsn AND T0.CardCode = T3.CardCode 
				
				WHERE T0.CardType = 'C' AND T0.CardCode = '$UserCode'
				
				ORDER BY T0.CardCode ASC
			");

$arr = array();

while (odbc_fetch_row($qry)) 
{
	$arr[] = array(
				"CardCode" => odbc_result($qry, 'CardCode'),
				"CardName" => odbc_result($qry, 'CardName'),
			
				"CntctCode" => odbc_result($qry, 'CntctCode'),
				"CntctPrsn" => odbc_result($qry, 'CntctPrsn'),
				"LicTradNum" => odbc_result($qry, 'LicTradNum'),
				
				"GroupNum" => odbc_result($qry, 'GroupNum'),
				"Currency" => odbc_result($qry, 'Currency'),
				"PymntGroup" => odbc_result($qry, 'PymntGroup'),
			
			
				);
            
}
odbc_free_result($qry);
odbc_close($MSSQL_CONN);



echo json_encode($arr);

?>