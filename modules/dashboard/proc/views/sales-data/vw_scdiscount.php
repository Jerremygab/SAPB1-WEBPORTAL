<?php
session_start();
include_once('../../../../../config/config.php');


$branch = $_GET['branch'];
$day = $_GET['day'];
$month = $_GET['month'];
$year = $_GET['year'];

//	AND  T1.U_DISCCODE = '5'
         $itemno = 1;
              $qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];  
					     SELECT DISTINCT
					    
               CASE WHEN SUM(T1.Gtotal) < 0
               THEN
					     SUM(T1.Gtotal) * -1
               ELSE 
              SUM(T1.Gtotal) * 1
              END AS SCDiscount

					     FROM OINV T0
					     INNER JOIN INV1 T1 ON T1.DocEntry = T0.DocEntry

						WHERE T0.BPLId = $branch AND Month(T0.DocDate) = '$month' AND Year(T0.DocDate) = '$year' and Day(T0.DocDate) = $day
					
						AND T1.ItemCode = 'DISC'
						AND REPLACE(T1.U_DISCCODE, '0', '') = '5'
						AND T0.U_TransType_AR <> 'TransOut'
                                            
                                            ");
                while (odbc_fetch_row($qry)) 
                {
                	if( number_format(odbc_result($qry, 'SCDiscount'),2) != 0){
                		$SCDiscount = 'PHP '. number_format(odbc_result($qry, 'SCDiscount'),2);
                	}
                	else{
                		$SCDiscount = '-';
                	}
                 
                 
                 }
                  
                
echo $SCDiscount;
              
odbc_free_result($qry);
odbc_close($MSSQL_CONN);

?>
