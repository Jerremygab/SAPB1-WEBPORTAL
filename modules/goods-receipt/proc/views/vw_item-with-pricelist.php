<?php
session_start();
include('../../../../config/config.php');

$priceList = $_GET['priceList'];
$itemCode = $_GET['priceList'];
					

$itemno = 1;

$qryPrice = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
			SELECT
			T0.Price,T1.LastPurPrc
			FROM ITM1 T0
			INNER JOIN OITM T1 ON T0.ItemCode = T1.ItemCode
			WHERE T0.PriceList = $priceList AND T0.ItemCode = '$itemCode'
																	
		");

$Price = '0.00';
while (odbc_fetch_row($qryPrice)) 
{
			if($priceList != -1){
				$Price = number_format(odbc_result($qryPrice, 'Price'),2);
			}
			else{
				$Price = number_format(odbc_result($qryPrice, 'LastPurPrc'),2);
			}
			
			

}
odbc_free_result($qryPrice);




echo $Price;

?>
	
