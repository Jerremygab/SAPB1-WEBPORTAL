<?php
session_start();
include_once('../../../../config/config.php');

$docNum = $_GET['docNum'];

$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
			SELECT DISTINCT
				T0.DocNum,
				T0.DocEntry,
				T0.DocStatus,
				T0.Series,
				T0.DocType,
				
				CASE 
					WHEN T0.DocStatus = 'O' THEN 'Open' 
					WHEN T0.DocStatus = 'C' AND T0.Canceled = 'C' THEN 'Canceled' 
					WHEN T0.DocStatus = 'C' AND T0.Canceled = 'N' THEN 'Closed' 
				END AS 'DocStatusFullText',
				T0.CardCode,
				T0.CardName,
				T0.DocDate,
				
				T0.TaxDate,
			
				
				T0.Comments,

				T0.ShipToCode,
				
				T0.JrnlMemo,
				
				
				T0.ToWhsCode,
				T0.Filler,
			

				T1.SeriesName,
				T2.CntctCode,
				T2.Name AS 'ContactPerson',
				T3.SlpCode,
				T3.SlpName,
				

				CAST(ISNULL(T6.Address,'') AS VARCHAR) AS Address,
				CAST(ISNULL(T6.Street,'') AS VARCHAR) AS Street,
				CAST(ISNULL(T6.StreetNo,'') AS VARCHAR) AS StreetNo,
				CAST(ISNULL(T6.Block,'') AS VARCHAR) AS Block,
				CAST(ISNULL(T6.ZipCode,'') AS VARCHAR) AS ZipCode,
				CAST(ISNULL(T6.City,'') AS VARCHAR) AS City,
				CAST(ISNULL(T6.County,'') AS VARCHAR) AS County,
				CAST(ISNULL(T6.State,'') AS VARCHAR) AS State,
				CAST(ISNULL(T6.Country,'') AS VARCHAR) AS CountryCode,
				CAST(ISNULL(T7.Name,'') AS VARCHAR) AS Country,
				CAST(ISNULL(T6.Building,'') AS VARCHAR) AS Building,

				CAST(ISNULL(T8.Address,'') AS VARCHAR) AS Address2,
				CAST(ISNULL(T8.Street,'') AS VARCHAR) AS Street2,
				CAST(ISNULL(T8.StreetNo,'') AS VARCHAR) AS StreetNo2,
				CAST(ISNULL(T8.Block,'') AS VARCHAR) AS Block2,
				CAST(ISNULL(T8.ZipCode,'') AS VARCHAR) AS ZipCode2,
				CAST(ISNULL(T8.City,'') AS VARCHAR) AS City2,
				CAST(ISNULL(T8.County,'') AS VARCHAR) AS County2,
				CAST(ISNULL(T8.State,'') AS VARCHAR) AS State2,
				CAST(ISNULL(T8.Country,'') AS VARCHAR) AS CountryCode2,
				CAST(ISNULL(T9.Name,'') AS VARCHAR) AS Country2,
				CAST(ISNULL(T8.Building,'') AS VARCHAR) AS Building2,

				T10.PymntGroup,
				T11.WhsName AS FromWhsName,
				T12.WhsName AS ToWhsName
				
			

				FROM OWTR T0
				LEFT JOIN NNM1 T1 ON T0.Series= T1.Series
				LEFT JOIN OCPR T2 ON T0.CntctCode = T2.CntctCode
				LEFT JOIN OSLP T3 ON T0.SlpCode = T3.SlpCode
				LEFT JOIN OHEM T4 ON T0.OwnerCode = T4.empID
				LEFT JOIN OCRD T5 ON T5.CardCode = T0.CardCode
				LEFT JOIN CRD1 T6 ON T6.CardCode = T5.CardCode AND T6.AdresType = 'S' AND T6.Address = T0.ShipToCode
				LEFT JOIN OCRY T7 ON T6.Country = T7.Code
				LEFT JOIN CRD1 T8 ON T8.CardCode = T5.CardCode AND T8.AdresType = 'B' AND T8.Address = T0.PayToCode
				LEFT JOIN OCRY T9 ON T8.Country = T9.Code
				LEFT JOIN OCTG T10 ON T0.GroupNum = T10.GroupNum
				LEFT JOIN OWHS T11 ON T11.WhsCode = T0.Filler
				LEFT JOIN OWHS T12 ON T12.WhsCode = T0.ToWhsCode
																	
			WHERE T0.DocNum = $docNum
		
		
		
			ORDER BY T0.DocNum");

$arr = array();

while (odbc_fetch_row($qry)) 
{
	$arr[] = array(
				"DocNum" => odbc_result($qry, 'DocNum'),
				"DocStatus" => odbc_result($qry, 'DocStatus'),
				"DocStatusFullText" => odbc_result($qry, 'DocStatusFullText'),
				"Series" => odbc_result($qry, 'Series'),
			
				"DocType" => odbc_result($qry, 'DocType'),
				
				
				
				"DocDate" => date('Y-m-d' ,strtotime(odbc_result($qry, 'DocDate'))),
			
				"TaxDate" => date('Y-m-d' ,strtotime(odbc_result($qry, 'TaxDate'))),
				
				
				
				
				"CardCode" => odbc_result($qry, 'CardCode'),
				"CardName" => odbc_result($qry, 'CardName'),
				
				
				
			
				"Comments" => odbc_result($qry, 'Comments'),
				"ShipToCode" => odbc_result($qry, 'ShipToCode'),
				
				
				
				"JrnlMemo" => odbc_result($qry, 'JrnlMemo'),
				
				
				"SeriesName" => odbc_result($qry, 'SeriesName'),
				"CntctCode" => odbc_result($qry, 'CntctCode'),
				"ContactPerson" => odbc_result($qry, 'ContactPerson'),
				"SlpCode" => odbc_result($qry, 'SlpCode'),
				"SlpName" => odbc_result($qry, 'SlpName'),
				
				"ToWhsCode" => odbc_result($qry, 'ToWhsCode'),
				"ToWhsName" => odbc_result($qry, 'ToWhsName'),
				"Filler" => odbc_result($qry, 'Filler'),
				"FromWhsName" => odbc_result($qry, 'FromWhsName')
				
				
				
			
				
			
				);
            
}
odbc_free_result($qry);
odbc_close($MSSQL_CONN);



echo json_encode($arr);

?>