<?php
session_start();
include_once('../../../config/config.php');



?>

<div class="">
	<table id="tblWTaxTable" class="table table-striped table-bordered table-sm detailsTable" cellspacing="0"  style="background-color: white; width:100% !important;"  cellspacing="0">
											  <thead   style="border-bottom: 0 !important; ">
											    <tr >
													<th class="text-right" style=" color: black; min-width:20px; " >#</th>
													<th style="color: black; min-width:150px;">Code</th>
													<th style="color: black; min-width:150px;">Name</th>
													<th style="color: black; min-width:250px;">Rate</th>
													<th style="color: black; min-width:150px;">Base Amount</th>
													<th style="color: black; min-width:150px;">Taxable Amount</th>
													<th style="color: black; min-width:100px;">WTax Amount</th>
													<th style="color: black; min-width:100px;">Account</th>
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
															 <td>
															 	<div class="input-group " >
																		<input type="text" class="form-control wtcode"   style="outline: none; border:none; " readonly/>
																	<button class="btn "  type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#WTaxModal" data-backdrop="false" >
																	<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue " ></i>
																  </button>
																</div>
															</td>
															 <td >
																<input type="text" class="form-control matrix-cell text-right wtname"  style="outline: none; border:none" maxlength="12" readonly/>
															  </td>
															   <td >
																<input type="text" class="form-control matrix-cell text-right rate"  style="outline: none; border:none" maxlength="12" readonly/>
															  </td>
															     <td >
																<input type="text" class="form-control matrix-cell text-right baseamount"   style="outline: none; border:none" maxlength="12" />
																
															  </td>
															   <td >
																<input type="text" class="form-control matrix-cell text-right taxableamount"  style="outline: none; border:none" maxlength="12" />
															  </td>
															  <td >
																<input type="text" class="form-control matrix-cell text-right wtaxamount"  style="outline: none; border:none" maxlength="12" />
															  </td>
															   <td >
																<input  type="number" class="form-control matrix-cell text-right glaccountwtax "  style="outline: none; border:none" readonly/>	
															  </td>
    												</tr>
											  </tbody>
											</table>
</div>




<script>$('#tblWTaxTable').dataTable({
 
		searching: false,
		ordering: false,
		bLengthChange: false,
		paging: false,
		info: false,
			
        });
</script>