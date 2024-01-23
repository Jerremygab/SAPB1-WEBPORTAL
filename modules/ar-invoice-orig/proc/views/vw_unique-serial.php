<?php
session_start();
include_once('../../../../config/config.php');



$qrySerial = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
			SELECT
			CASE 
			WHEN SriUniqFld = 2 THEN '.mfrserial'
			WHEN SriUniqFld = 3 THEN '.serial'
			WHEN SriUniqFld = 4 THEN '.lotnumber'
			END AS SriUniqFld
			
			FROM OADM
																	
		");


while (odbc_fetch_row($qrySerial)) 
{

				$UniqueSerial = odbc_result($qrySerial, 'SriUniqFld');
			
			

}
odbc_free_result($qrySerial);




echo $UniqueSerial;

?>