<!-- <?php
session_start();
include_once('../../../config/config.php');



?>

<div class="">
	<table id="tblDownPaymentTable" class="table table-striped table-bordered table-sm detailsTable" cellspacing="0"  style="background-color: white; width:100% !important;"  cellspacing="0">
											  <thead   style="border-bottom: 0 !important; ">
											    <tr >
													<th class="text-right" style=" color: black; min-width:20px; " >#</th>
													<th style="color: black; min-width:100px;">Select</th>
													<th style="color: black; min-width:200px;">Document Number</th>
													<th style="color: black; min-width:250px;">Document Type</th>
													<th style="color: black; min-width:150px;">Remarks</th>
													<th style="color: black; min-width:150px;">Tax Code</th>
													<th style="color: black; min-width:250px;">Net Amount to Draw</th>
													<th style="color: black; min-width:250px;">Tax Amount to Draw</th>
													<th style="color: black; min-width:250px;">Gross Amount to Draw</th>
													<th style="color: black; min-width:250px;">Open Net Amount</th>
													<th style="color: black; min-width:250px;">Open Tax Amount</th>
													<th style="color: black; min-width:250px;">Open Gross Amount</th>
													<th style="color: black; min-width:100px;">Document Date</th>
											    </tr>
											  </thead>
											  <tbody class="">
											  	 <tr style="background-color: white; "  >
															  <td class="rowno text-right" style="background-color: lightgray;color:black; font-size:13px;">
																<span>1</span>
																<button type="button" class="btn d-none btnrowfunctions" data-toggle="dropdown" style="width:1px; padding-left: 0px !important;margin-left: 0px !important">
																	<i class="fas fa-caret-down" ></i>
																</button>
																
															
																 <ul class="dropdown-menu rowfunctions" role="menu" style="background-color: #fdfd96;">
																	<li class="deleterowwtax" style="font-size:20px; color: black; font-weight:bold">Delete Row</a></li>
																
																  </ul>
																
															  </td>
                                                              <td style="min-width:50px">
                                                                        <input type="checkbox" style=" height:20px ; width:20px; display: flex; margin:auto;" class="form-control matrix-cell chkboxInvoice ">
                                                                </td>
															 <td >
																<input type="number" class="form-control matrix-cell text-right docnum"  style="outline: none; border:none" maxlength="12" readonly/>
															  </td>
															   <td >
																<input type="text" class="form-control matrix-cell text-right doctype"  style="outline: none; border:none" maxlength="12" readonly/>
															  </td>
															     <td >
																<input type="text" class="form-control matrix-cell text-right remarks"   style="outline: none; border:none" maxlength="12" readonly/>
																
															  </td>
															   <td >
																<input type="text" class="form-control matrix-cell text-right taxcode"  style="outline: none; border:none" maxlength="12" readonly/>
															  </td>
															  <td >
																<input type="number" class="form-control matrix-cell text-right netamount"  style="outline: none; border:none" maxlength="12" />
															  </td>
															   <td >
																<input  type="number" class="form-control matrix-cell text-right taxamount "  style="outline: none; border:none" readonly/>	
															  </td>
															   <td >
																<input  type="number" class="form-control matrix-cell text-right grossamount "  style="outline: none; border:none" />	
															  </td>
															   <td >
																<input  type="number" class="form-control matrix-cell text-right opennetamount "  style="outline: none; border:none" readonly/>	
															  </td>
															   <td >
																<input  type="number" class="form-control matrix-cell text-right opentaxamount "  style="outline: none; border:none" readonly/>	
															  </td>
															   <td >
																<input  type="number" class="form-control matrix-cell text-right opengrossamount "  style="outline: none; border:none" readonly/>	
															  </td>
															   <td >
																<input  type="date" class="form-control matrix-cell text-right docdate "  style="outline: none; border:none" readonly/>	
															  </td>
    												</tr>
											  </tbody>
											</table>
</div>




<script>$('#tblDownPaymentTable').dataTable({
 
		searching: false,
		ordering: false,
		bLengthChange: false,
		paging: false,
		info: false,
			
        });
</script> -->