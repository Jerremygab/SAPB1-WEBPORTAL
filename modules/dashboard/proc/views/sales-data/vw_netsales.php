<?php
session_start();
include_once('../../../../../config/config.php');

$branch = $_GET['branch'];
$day = $_GET['day'];
$month = $_GET['month'];
$year = $_GET['year'];


              $qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];  
					     SELECT DISTINCT
					    

					    
                         CASE WHEN SUM(T1.Gtotal) < 0
                           THEN
                           SUM(T1.Gtotal) * -1
                           ELSE 
                            SUM(T1.Gtotal) * 1 END AS FoodSales

					     FROM OINV T0
					     INNER JOIN INV1 T1 ON T1.DocEntry = T0.DocEntry

						WHERE T0.BPLId = $branch AND Month(T0.DocDate) = '$month' AND Year(T0.DocDate) = '$year' and Day(T0.DocDate) = '$day'
				
						AND T1.ItemCode NOT IN ('SC', 'DISC')
						AND T1.Dscription NOT LIKE 'DELIVERY%'  
                                            
                                            ");
                while (odbc_fetch_row($qry)) 
                {
                	if( number_format(odbc_result($qry, 'FoodSales'),2) != 0){
                		$foodsales =odbc_result($qry, 'FoodSales');
                	}
                	else{
                		$foodsales = 0;
                	}
                 
                 }

              $qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];  
					     SELECT DISTINCT
					    

					     CASE WHEN SUM(T1.Gtotal) < 0
                           THEN
                           SUM(T1.Gtotal) * -1
                           ELSE 
                            SUM(T1.Gtotal) * 1 END AS SCDiscount

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
                		$SCDiscount = odbc_result($qry, 'SCDiscount');
                	}
                	else{
                		$SCDiscount = 0;
                	}
                 
                 
                 }

                 $qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];  
                        SELECT DISTINCT
                        

                         CASE WHEN SUM(T1.Gtotal) < 0
                           THEN
                           SUM(T1.Gtotal) * -1
                           ELSE 
                            SUM(T1.Gtotal) * 1
                          END AS PWDDiscount

                                     FROM OINV T0
                                     INNER JOIN INV1 T1 ON T1.DocEntry = T0.DocEntry

                                    WHERE T0.BPLId = $branch AND Month(T0.DocDate) = '$month' AND Year(T0.DocDate) = '$year' and Day(T0.DocDate) = $day
                                AND T1.ItemCode = 'DISC'
                      AND T1.U_DISCCODE = 'AA'
                      AND T0.U_TransType_AR <> 'TransOut'
                                            
                                            ");
                while (odbc_fetch_row($qry)) 
                {
                    if( number_format(odbc_result($qry, 'PWDDiscount'),2) != 0){
                        $PWDDiscount = odbc_result($qry, 'PWDDiscount');
                    }
                    else{
                        $PWDDiscount = 0;
                    }
                 
                 
                 }

              $qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];  
					     SELECT DISTINCT
					    

					     CASE WHEN SUM(T1.Gtotal) < 0
                           THEN
                           SUM(T1.Gtotal) * -1
                           ELSE 
                            SUM(T1.Gtotal) * 1 END AS OtherDiscount

					     FROM OINV T0
					     INNER JOIN INV1 T1 ON T1.DocEntry = T0.DocEntry

						WHERE T0.BPLId = $branch AND Month(T0.DocDate) = '$month' AND Year(T0.DocDate) = '$year' and Day(T0.DocDate) = $day
						AND T1.ItemCode = 'DISC'
						AND REPLACE(T1.U_DISCCODE, '0', '') <> '5'
						AND T1.U_DISCCODE <> 'AA'
						AND T0.U_TransType_AR <> 'TransOut'
					
                                            
                                            ");
                while (odbc_fetch_row($qry)) 
                {
                	if( number_format(odbc_result($qry, 'OtherDiscount'),2) != 0){
                		$OtherDiscount = odbc_result($qry, 'OtherDiscount');
                	}
                	else{
                		$OtherDiscount = 0;
                	}
                 
                 
                 }

     
              $qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];  
					     SELECT DISTINCT
					    

					     CASE WHEN SUM(T1.Gtotal) < 0
                           THEN
                           SUM(T1.Gtotal) * -1
                           ELSE 
                            SUM(T1.Gtotal) * 1 END AS DeliveryCharge

					     FROM OINV T0
					     INNER JOIN INV1 T1 ON T1.DocEntry = T0.DocEntry

						WHERE T0.BPLId = $branch AND Month(T0.DocDate) = '$month' AND Year(T0.DocDate) = '$year' and Day(T0.DocDate) = $day
						AND T1.Dscription LIKE 'DELIVERY%'
						AND T1.ItemCode = 'SC'
						AND T0.U_TransType_AR <> 'TransOut'
					
                                            
                                            ");
                while (odbc_fetch_row($qry)) 
                {
                	if( number_format(odbc_result($qry, 'DeliveryCharge'),2) != 0){
                		$DeliveryCharge = odbc_result($qry, 'DeliveryCharge');
                	}
                	else{
                		$DeliveryCharge = 0;
                	}
                 
                 }
    
                  


$Less = $SCDiscount + $PWDDiscount + $OtherDiscount + $DeliveryCharge;
$NetSales = $foodsales - $Less;
echo  'PHP '. number_format($NetSales,2);
              
odbc_free_result($qry);
odbc_close($MSSQL_CONN);

?>
