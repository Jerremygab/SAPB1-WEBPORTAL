<?php
session_start();
include_once('../../../../../config/config.php');

$branch = $_GET['branch'];
$day = $_GET['day'];
$month = $_GET['month'];
$year = $_GET['year'];


         $itemno = 1;
              $qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];  
					     SELECT DISTINCT
					    

					      CASE WHEN SUM(T1.Gtotal) < 0
               THEN
               SUM(T1.Gtotal) * -1
               ELSE 
                 SUM(T1.Gtotal) * 1
              END AS DeliveryCharge

					     FROM OINV T0
					     INNER JOIN INV1 T1 ON T1.DocEntry = T0.DocEntry

						WHERE T0.BPLId = '$branch' AND Month(T0.DocDate) = '$month' AND Year(T0.DocDate) = '$year' and Day(T0.DocDate) = $day
						AND T1.Dscription LIKE 'DELIVERY%'
						AND T1.ItemCode = 'SC'
						AND T0.U_TransType_AR <> 'TransOut'
					
                                            
                                            ");
                while (odbc_fetch_row($qry)) 
                {
                	if( number_format(odbc_result($qry, 'DeliveryCharge'),2) != 0){
                		$DeliveryCharge = 'PHP '. number_format(odbc_result($qry, 'DeliveryCharge'),2);
                	}
                	else{
                		$DeliveryCharge = '-';
                	}
                 
                 }
                  
                
echo $DeliveryCharge;
              
odbc_free_result($qry);
odbc_close($MSSQL_CONN);

?>
