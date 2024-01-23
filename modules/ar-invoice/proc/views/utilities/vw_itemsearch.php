<?php
session_start();
include('../../../../../config/config.php');

$txtItemSearch = $_GET['txtItemSearch'];


    ?>
    <thead>
        <tr>
            <th >#</th>
            <th >Item Code</th>
            <th >Item Name</th>
            <th>Foreign Name</th>
            <th>UoM Group</th>
            <th>Inventory UoM</th>
            <th class="d-none">Price</th>
            <th class="d-none">Vendor</th>
            <th class="d-none">UGP Entry</th>
            <th class="d-none">UGP Code</th>
            <th class="d-none">UGP Name</th>
            <th class="d-none">Batch / Serial</th>
            <th class="d-none">Whse Code</th>
            <th class="d-none">Whse Name</th>
        </tr>
    </thead>
    <tbody>



						<?php
							$itemno = 1;
							$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT DISTINCT
																						T0.ItemCode, 
																						T0.ItemName, 
																						T0.FrgnName,
																						T0.InvntryUom, 
																						T0.CardCode, 
																						T0.ManBtchNum,
																						T0.ManSerNum,
																						T1.ItmsGrpNam,
																						CASE WHEN T2.Price = 0 THEN '' END AS Price,
																						T4.UomEntry,
																						T4.UomCode,
																						T4.UomName,
																						
																						T0.DfltWH,
																						T5.WhsName
																						
																						
																							
																						FROM OITM T0
																						INNER JOIN OITB T1 ON T0.ItmsGrpCod = T1.ItmsGrpCod
																						INNER JOIN ITM1 T2 ON T2.ItemCode = T0.ItemCode
																						LEFT JOIN OPLN T3 ON T3.ListNum = T2.PriceList
																						INNER JOIN OUOM T4 ON T4.UomEntry = T0.IUoMEntry
																						LEFT JOIN OWHS T5 ON T5.WhsCode = T0.DfltWH
																						
																						WHERE T0.SellItem = 'Y' AND T0.FrozenFor = 'N'
                                                                                        AND T0.ItemCode = '$txtItemSearch'

                                                                                        
																						
																						
																						ORDER BY T0.ItemName ASC");
								while (odbc_fetch_row($qry)) 
								{
									$BatchSerial = '';
									if(odbc_result($qry, 'ManBtchNum') == 'Y'){
										$BatchSerial = 'B';
									}
									else if(odbc_result($qry, 'ManSerNum') == 'Y'){
										$BatchSerial = 'S';
									}
									else{
										$BatchSerial = 'N';
									}
									echo '<tr class="">
												<td>'.$itemno.'</td>
												<td class="item-1">'.odbc_result($qry, 'ItemCode').'</td>
												<td class="item-2" >'.odbc_result($qry, 'ItemName').'</td>
												<td class="item-3 " >'.odbc_result($qry, 'FrgnName').'</td>
												<td class="item-4 " >'.odbc_result($qry, 'ItmsGrpNam').'</td>
												<td class="item-5 " >'.odbc_result($qry, 'InvntryUom').'</td>
												<td class="item-6 hidden" >'.odbc_result($qry, 'Price').'</td>
												<td class="item-7 hidden" >'.odbc_result($qry, 'CardCode').'</td>
												<td class="item-8 hidden" >'.odbc_result($qry, 'UomEntry').'</td>
												<td class="item-9 hidden" >'.odbc_result($qry, 'UomCode').'</td>
												<td class="item-10 hidden" >'.odbc_result($qry, 'UomName').'</td>
												<td class="item-11 hidden" >'.$BatchSerial.'</td>
												<td class="item-12 hidden" >'.odbc_result($qry, 'DfltWH').'</td>
												<td class="item-13 hidden" >'.odbc_result($qry, 'WhsName').'</td>
											  </tr>';
									$itemno++;	  
								}
								
								odbc_free_result($qry);
							

						?>
						</tbody>
						<script>



						</script>
	<?php
	odbc_free_result($qry);
	
?>