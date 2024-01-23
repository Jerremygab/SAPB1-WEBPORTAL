<?php
session_start();
include_once('../../../config/config.php');
?>
<div style="padding-top:10px;" id="logistics">
	<div class="row" style="padding-bottom:10px;">
		<div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
			<label class="col-sm-4 col-form-label " style="color: black;" >Ship To:</label>
			<div class="input-group ">
					
					<input type="text" class="form-control d-none" id="txtShipArr"  readonly>
					<input type="text" class="form-control d-none" id="txtShipArr2"   class="d-none" readonly>
					
					<select id="selShipToAddress" class="col-sm-12 form-control mdb-select md-form text-left"  style=" !important;outline:none; border-color: #D0D0D0;">
					</select>
				</div>
		</div>
		<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3">
			<textarea class="form-control " id="txtShipToAddressTextArea" style="height:150px;  resize: none;" readonly></textarea>
		</div>
		<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3" style="margin-top:120px;">
			<button type="button" id="btnShipToDetails" class="  btn btn-warning btn-rounded d-none"  data-mdb-ripple-color="dark"   data-toggle="modal" data-target="#shipToDetailsModal" data-backdrop="false" style="color: black;width:50px; background: linear-gradient(to bottom, #FCF6BA, #BF953F); font-weight: bold; font-size: 10px; " ><i class="fas fa-ellipsis-h"></i></button>
		</div>
		
	</div>
	<div class="row">
		<div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
			<label class="col-sm-4 col-form-label " style="color: black;" >Bill To:</label>
			<div class="input-group ">
					<input type="text" class="form-control d-none" id="txtBillArr"  readonly>
					<input type="text" class="form-control d-none" id="txtBillArr2"   class="d-none" readonly>
					<select id="selBillToAddress" class="col-sm-12 form-control mdb-select md-form text-left"  style=" !important;outline:none; border-color: #D0D0D0;">
					</select>
				</div>
		</div>
		<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3">
			<textarea class="form-control " id="txtBillToAddressTextArea" style="height:150px;  resize: none;" readonly></textarea>
		</div>
		<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3" style="margin-top:120px;">
			<button type="button" id="btnBillToDetails" class="btn btn-warning btn-rounded d-none" data-mdb-ripple-color="dark"   data-toggle="modal" data-target="#billToDetailsModal" data-backdrop="false" style="color: black;width:50px; background: linear-gradient(to bottom, #FCF6BA, #BF953F); font-weight: bold; font-size: 10px; " ><i class="fas fa-ellipsis-h"></i></button>
		</div>
	</div>
	
	<div class="row">
		<div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
			<label class="col-lg-6 col-form-label pt-1" style="color: black;" >Shipping Type</label>
		</div>
		<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 py-2">
								 <select id="selShippingType" class="col-sm-12 form-control mdb-select md-form text-left"  style=" !important;outline:none; border-color: #D0D0D0;">
									
								</select>
												
		</div>
	</div>
</div>


