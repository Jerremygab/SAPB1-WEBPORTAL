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
								<th>Service Invoice No.</th>
								<th>Approval Status</th>
							</tr>
						</thead>
						<tbody>
						
						<?php


// Service Invoice No. 
// Customer sap code
// Group Project/ Location
// Customer sap name
							$itemno = 1;
							$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 		SELECT DISTINCT
							T0.DocNum, 
							T0.DocEntry,
							T0.CardCode, 
							T0.CardName,
							T0.Comments,
							T0.DocDate, 
							T0.DocDueDate, 
							T0.DocTotal,
							T0.U_InvoiceNo,
							'POSTED' AS DocApprovalStat
																												
																													
							FROM OINV T0
																												
							WHERE CAST(T0.DocNum AS NVARCHAR(100)) = '$txtDocumentSearch'
						
							UNION ALL
																												
							SELECT DISTINCT
							T0.DocNum, 
							T0.DocEntry,
							T0.CardCode, 
							T0.CardName,
							T0.Comments,
							T0.DocDate, 
							T0.DocDueDate, 
							T0.DocTotal,
							T0.U_InvoiceNo,
							'POSTED' AS DocApprovalStat
																												
																													
							FROM OINV T0
																												
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
							T0.DocTotal,
							T0.U_InvoiceNo,
							'POSTED' AS DocApprovalStat
																												
																													
							FROM OINV T0
																												
							WHERE T0.CardName = '$txtDocumentSearch'
						
							UNION ALL
																												
							SELECT DISTINCT
							T0.DocNum, 
							T0.DocEntry,
							T0.CardCode, 
							T0.CardName,
							T0.Comments,
							T0.DocDate, 
							T0.DocDueDate, 
							T0.DocTotal,
							T0.U_InvoiceNo,
							'POSTED' AS DocApprovalStat
																												
																													
							FROM OINV T0
																												
							WHERE T0.U_InvoiceNo = '$txtDocumentSearch'
						
							UNION ALL
																												
							SELECT DISTINCT
							T0.DocNum, 
							T0.DocEntry,
							T0.CardCode, 
							T0.CardName,
							T0.Comments,
							T0.DocDate, 
							T0.DocDueDate, 
							T0.DocTotal,
							T0.U_InvoiceNo,
							'POSTED' AS DocApprovalStat
																												
																													
							FROM OINV T0
							INNER JOIN OCRD T1 ON T0.CardCode = T1.CardCode
							WHERE T1.U_GroupLocation = '$txtDocumentSearch'
						
							UNION ALL
						
							SELECT DISTINCT
							T0.DocEntry AS DocNum, 
							T0.DocEntry,
							T0.CardCode, 
							T0.CardName,
							T0.Comments,
							T0.DocDate, 
							T0.DocDueDate, 
							T0.DocTotal,
							T0.U_InvoiceNo,
							'DRAFT' AS DocApprovalStat
																												
																													
							FROM ODRF T0
																												
							WHERE CAST(T0.DocEntry AS NVARCHAR(100)) = '$txtDocumentSearch'
							AND T0.ObjType = 13
						
							UNION ALL
																												
							SELECT DISTINCT
							T0.DocEntry AS DocNum, 
							T0.DocEntry,
							T0.CardCode, 
							T0.CardName,
							T0.Comments,
							T0.DocDate, 
							T0.DocDueDate, 
							T0.DocTotal,
							T0.U_InvoiceNo,
							'DRAFT' AS DocApprovalStat
																												
																													
							FROM ODRF T0
																												
							WHERE T0.CardCode = '$txtDocumentSearch'
							AND T0.ObjType = 13
						
							UNION ALL
																												
							SELECT DISTINCT
							T0.DocEntry AS DocNum, 
							T0.DocEntry,
							T0.CardCode, 
							T0.CardName,
							T0.Comments,
							T0.DocDate, 
							T0.DocDueDate, 
							T0.DocTotal,
							T0.U_InvoiceNo,
							'DRAFT' AS DocApprovalStat
																												
																													
							FROM ODRF T0
																												
							WHERE T0.CardName = '$txtDocumentSearch'
							AND T0.ObjType = 13
						
							UNION ALL
																												
							SELECT DISTINCT
							T0.DocEntry AS DocNum, 
							T0.DocEntry,
							T0.CardCode, 
							T0.CardName,
							T0.Comments,
							T0.DocDate, 
							T0.DocDueDate, 
							T0.DocTotal,
							T0.U_InvoiceNo,
							'DRAFT' AS DocApprovalStat
																												
																													
							FROM ODRF T0
																												
							WHERE T0.U_InvoiceNo = '$txtDocumentSearch'
							AND T0.ObjType = 13
						
							UNION ALL
																												
							SELECT DISTINCT
							T0.DocEntry AS DocNum, 
							T0.DocEntry,
							T0.CardCode, 
							T0.CardName,
							T0.Comments,
							T0.DocDate, 
							T0.DocDueDate, 
							T0.DocTotal,
							T0.U_InvoiceNo,
							'DRAFT' AS DocApprovalStat
																												
																													
							FROM ODRF T0
							INNER JOIN OCRD T1 ON T0.CardCode = T1.CardCode
							AND T0.ObjType = 13
							WHERE T1.U_GroupLocation = '$txtDocumentSearch'																	
						
							ORDER BY T0.DocNum ASC");



								while (odbc_fetch_row($qry)) 
								{
									$backgroundColor = '#90EE90';
									if( odbc_result($qry, 'DocApprovalStat') == 'DRAFT'){
										$backgroundColor = '#FFD580';
									}
									echo '<tr class="">
												<td>'.$itemno.'</td>
												<td class="item-1">'.odbc_result($qry, 'DocNum').'</td>
												<td class="item-2 d-none">'.odbc_result($qry, 'DocEntry').'</td>
												<td class="item-4 " >'.SAPDateFormater(odbc_result($qry, 'DocDate')).'</td>
												<td class="item-3 d-none" >'.odbc_result($qry, 'CardCode').'</td>
												<td class="item-6 " >'.odbc_result($qry, 'CardName').'</td>
												<td class="item-10 " style="width: 160px;" >'.odbc_result($qry, 'Comments').'</td>
												<td class="item-9 " >'.SAPDateFormater(odbc_result($qry, 'DocDueDate')).'</td>
												<td class="item-5 text-right" >'.number_format(odbc_result($qry, 'DocTotal'),2).'</td>
												<td class="item-7 " >'.odbc_result($qry, 'U_InvoiceNo').'</td>
												<td class="item-8 " style="background-color: '.$backgroundColor.'" >'.odbc_result($qry, 'DocApprovalStat').'</td>
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
	<?php
	odbc_free_result($qry);
	
?>