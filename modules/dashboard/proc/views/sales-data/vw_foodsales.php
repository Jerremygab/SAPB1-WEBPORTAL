<?php
session_start();
include_once('../../../../../config/config.php');

$branch = $_GET['branch'];
$day = $_GET['day'];
$month = $_GET['month'];
$year = $_GET['year'];

//		AND  T1.U_DISCCODE != '5' AND T1.ItemCode != 'SC'AND T1.ItemCode != 'FD'

         $itemno = 1;
              $qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];  
					     SELECT DISTINCT
					    

					     SUM(T1.Gtotal) AS FoodSales

					     FROM OINV T0
					     INNER JOIN INV1 T1 ON T1.DocEntry = T0.DocEntry

						WHERE T0.BPLId = $branch AND Month(T0.DocDate) = '$month' AND Year(T0.DocDate) = '$year' and Day(T0.DocDate) = '$day'
				
						AND T1.ItemCode NOT IN ('SC', 'DISC')
						AND T1.Dscription NOT LIKE 'DELIVERY%'  
                                            
                                            ");
                while (odbc_fetch_row($qry)) 
                {
                	if( number_format(odbc_result($qry, 'FoodSales'),2) != 0){
                		$foodsales = 'PHP '. number_format(odbc_result($qry, 'FoodSales'),2);
                	}
                	else{
                		$foodsales = '-';
                	}
                 
                 }
                  
                
echo $foodsales;
              
odbc_free_result($qry);
odbc_close($MSSQL_CONN);

?>
