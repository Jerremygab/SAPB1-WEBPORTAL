<?php
session_start();
include('../../../../../config/config.php');

$txtCardCodeSearch = $_GET['txtCardCodeSearch'];


    ?>
		<thead>
							<tr>
								<th >#</th>
								<th>Customer Code</th>
								<th>Customer Name</th>
								<th>Balance</th>
								<th>Contact Person</th>
								<th>Group Projct / Location</th>
								<th class="d-none">Payment Terms Code</th>
								<th class="d-none">Payment Terms Name</th>
								<th class="d-none">Tin Number</th>
								<th class="d-none">Contact Person Code</th>
								<th class="d-none">Currency</th>
								
							</tr>
						</thead>
						<tbody>
						<?php
							$itemno = 1;
							$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT DISTINCT
																						T0.CardCode, 
																						T0.CardName,
																						T0.Balance,
																						T3.CntctCode,
																						T0.CntctPrsn,
																						T0.LicTradNum,
																						T0.GroupNum,
																						T0.Currency,
																						T0.U_GroupLocation,
																						T2.PymntGroup
																						
																						
																						
																						FROM OCRD T0
																						LEFT JOIN CRD1 T1 ON T0.CardCode = T1.CardCode 
																						LEFT JOIN OCTG T2 ON T2.GroupNum = T0.GroupNum
																						LEFT JOIN OCPR T3 ON T3.Name = T0.CntctPrsn AND T0.CardCode = T3.CardCode 
																						
																						WHERE T0.CardType = 'C'
																						
																						AND T0.CardCode = '$txtCardCodeSearch'

																						UNION ALL

																						SELECT DISTINCT
																						T0.CardCode, 
																						T0.CardName,
																						T0.Balance,
																						T3.CntctCode,
																						T0.CntctPrsn,
																						T0.LicTradNum,
																						T0.GroupNum,
																						T0.Currency,
																						T0.U_GroupLocation,
																						T2.PymntGroup
																						
																						
																						
																						FROM OCRD T0
																						LEFT JOIN CRD1 T1 ON T0.CardCode = T1.CardCode 
																						LEFT JOIN OCTG T2 ON T2.GroupNum = T0.GroupNum
																						LEFT JOIN OCPR T3 ON T3.Name = T0.CntctPrsn AND T0.CardCode = T3.CardCode 
																						
																						WHERE T0.CardType = 'C'
																						
																						AND T0.CardName = '$txtCardCodeSearch'

																						ORDER BY T0.CardCode ASC");
								while (odbc_fetch_row($qry)) 
								{
									echo '<tr class="tableHover">
												<td>'.$itemno.'</td>
												<td class="item-1">'.odbc_result($qry, 'CardCode').'</td>
												<td class="item-2">'.odbc_result($qry, 'CardName').'</td>
												<td class="item-3 text-right">'.number_format(odbc_result($qry, 'Balance'),2).'</td>
												<td class="item-4">'.odbc_result($qry, 'CntctPrsn').'</td>
												<td class="item-10">'.odbc_result($qry, 'U_GroupLocation').'</td>
												<td class="item-5 d-none">'.odbc_result($qry, 'GroupNum').'</td>
												<td class="item-6 d-none">'.odbc_result($qry, 'PymntGroup').'</td>
												<td class="item-7 d-none">'.odbc_result($qry, 'LicTradNum').'</td>
												<td class="item-8 d-none">'.odbc_result($qry, 'CntctCode').'</td>
												<td class="item-9 d-none">'.odbc_result($qry, 'Currency').'</td>
												
											  </tr>';
									$itemno++;	  
								}
								
								odbc_free_result($qry);
							

						?>
						</tbody>
						<script>$('#tblBP').dataTable({"bLengthChange": false, "searching": false});</script>

	<?php
	odbc_free_result($qry);
	
?>