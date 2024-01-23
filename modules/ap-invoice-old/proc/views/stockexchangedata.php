
<table class="table table-striped table-bordered table-hover" id="tblDoc" style="width:100%">
						<thead>
							<tr>
								<th >#</th>
								<th>Doc No.</th>
								<th class='d-none'>Doc Entry</th>
								<th class='d-none'>Vendor Code</th>
								<th >Vendor Name</th>
								<th>Posting Date</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody>
<?php
session_start(); 
include_once('../../../../config/config.php');	

$objSession = json_decode($_SESSION['APInvoiceArr']);

$table = $_POST["table"];
$table = $objSession->objectTable;

							$itemno = 1;
							$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT DISTINCT
																						T0.DocNum, 
																						T0.DocEntry,
																						T0.CardCode, 
																						T0.CardName,
																						T0.DocDate, 
																						T0.DocTotal
																						
																							
																						FROM ".$table." T0
																						
																						ORDER BY T0.DocNum DESC");
								while (odbc_fetch_row($qry)) 
								{
									echo '<tr class="">
												<td>'.$itemno.'</td>
												<td class="item-1">'.odbc_result($qry, 'DocNum').'</td>
												<td class="item-2 d-none">'.odbc_result($qry, 'DocEntry').'</td>
												<td class="item-3 d-none" >'.odbc_result($qry, 'CardCode').'</td>
												<td class="item-6 " >'.odbc_result($qry, 'CardName').'</td>
												<td class="item-4 " >'.date("m/d/Y", strtotime(odbc_result($qry, 'DocDate'))).'</td>
												<td class="item-5 " >'.odbc_result($qry, 'DocTotal').'</td>
											  </tr>';
									$itemno++;	  
								}
								
								odbc_free_result($qry);
							

						?>
							</tbody>
					</table>