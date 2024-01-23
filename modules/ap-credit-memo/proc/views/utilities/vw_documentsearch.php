<?php
session_start();
include('../../../../../config/config.php');

$txtDocumentSearch = $_GET['txtDocumentSearch'];


    ?>
  	<thead>
							<tr>
								<th >#</th>
								<th>Doc No.</th>
								<th class='d-none'>Doc Entry</th>
								<th>Posting Date</th>
								<th class='d-none'>Customer Code</th>
								<th >Customer Name</th>
								<th>Remarks</th>
								<th>Due Date</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody>
						<?php
							$itemno = 1;
							$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT DISTINCT
																						T0.DocNum, 
																						T0.DocEntry,
																						T0.CardCode, 
																						T0.CardName,
																						T0.Comments,
																						T0.DocDate, 
																						T0.DocDueDate, 
																						T0.DocTotal
																						
																							
																						FROM ORPC T0


																						WHERE CAST(T0.DocNum AS NVARCHAR) = '$txtDocumentSearch'

																						UNION ALL

																					SELECT DISTINCT
																						T0.DocNum, 
																						T0.DocEntry,
																						T0.CardCode, 
																						T0.CardName,
																						T0.Comments,
																						T0.DocDate, 
																						T0.DocDueDate, 
																						T0.DocTotal
																						
																							
																						FROM ORPC T0


																						WHERE T0.CardCode = '$txtDocumentSearch'

																						UNION ALL

																						SELECT DISTINCT  
																						T0.DocNum, 
																						T0.DocEntry,
																						T0.CardCode, 
																						T0.CardName,
																						T0.Comments,
																						T0.DocDate, 
																						T0.DocDueDate, 
																						T0.DocTotal
																						
																							
																						FROM ORPC T0


																						WHERE T0.CardName = '$txtDocumentSearch'

																						
																						ORDER BY T0.DocNum ASC");
								while (odbc_fetch_row($qry)) 
								{
									echo '<tr class="">
												<td>'.$itemno.'</td>
												<td class="item-1">'.odbc_result($qry, 'DocNum').'</td>
												<td class="item-2 d-none">'.odbc_result($qry, 'DocEntry').'</td>
												<td class="item-4 " >'.SAPDateFormater(odbc_result($qry, 'DocDate')).'</td>
												<td class="item-3 d-none" >'.odbc_result($qry, 'CardCode').'</td>
												<td class="item-6 " >'.odbc_result($qry, 'CardName').'</td>
												<td class="item-8 " style="width: 160px;" >'.odbc_result($qry, 'Comments').'</td>
												<td class="item-9 " >'.SAPDateFormater(odbc_result($qry, 'DocDueDate')).'</td>
												<td class="item-5 text-right" >'.number_format(odbc_result($qry, 'DocTotal'),2).'</td>
											  </tr>';
									$itemno++;	  
								}
								
								odbc_free_result($qry);
							

						?>
						</tbody>
						<script>
							// var table = $('#myTable').DataTable();
							if ($.fn.dataTable.isDataTable('#tblDoc')) {
								$('#tblDoc').dataTable({"bLengthChange": true, "searching": false});
							
							}
							else {	
							
							$('#tblDoc').dataTable({"bLengthChange": false, "searching": false});
						
								}
									</script>
	odbc_free_result($qry);
	
?>