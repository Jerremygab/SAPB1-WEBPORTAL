<?php
session_start();
include_once('../../../config/config.php');
?>
<div class="row"  >
	<div class="col-lg-6"  >
		<div class="row " style="padding-top:10px; margin-left:5px ">
			<div class="col-lg-12" style="background-color:#A8A8A8 !important; margin:5px !important">
				<div class="form-group row py-2 my-2" id="">	
					<div class="col-8" >
						<label for="inputEmail3" class=" col-form-label " style="color: black; font-size:20px !important" >General Settings</label>
					</div>
					<div class="col-4 text-right"  >
						<div class="input-group mb-1 ">
							<input  type="checkbox" id="GenSet" name="chkMainModule[]" class="" style="width:40px ; height:40px" value="GenSet" >
							
							<button class="btn btnGroup ml-1" type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6;width:40px  !important; height:40px !important "  data-toggle="collapse" data-target="#generalSettings"  >
								<i class="fas fa-plus input-prefix" tabindex=0 style="color:blue "></i>
							</button>
							
						</div>
					</div>
					<div class="col-12 " style="background-color:#E8E8E8  !important;">				
						<div class="collapse ml-2 mt-3"  id="generalSettings">
						   <div class="row ">
								<div class="col-7" >
									<label for="inputEmail3" class=" col-form-label " style="color: black;" >Cancellation of Document</label>
								</div>
								<div class="col-5" >
									<div class="input-group mb-1 ">
										<input  type="checkbox" id="CANCEL" name="chkModule[]" class="GenSetSubModule" style="width:30px ; height:30px" value="CANCEL" >
									</div>
								</div>
							</div>
							<div class="row" >
								<div class="col-7" >
									<label for="inputEmail3" class=" col-form-label " style="color: black;" >Manual Closing</label>
								</div>
								<div class="col-5" >
									<div class="input-group mb-1 ">
										<input  type="checkbox" id="CLOSE" class="" name="chkModule[]" class="GenSetSubModule" style="width:30px ; height:30px"  value="CLOSE">
									</div>
								</div>	
							</div>
						</div>
					</div>	
				</div>
			</div>
			<div class="col-lg-12" style="background-color:#A8A8A8 !important; margin:5px !important">
				<div class="form-group row py-2 my-2" >
					<div class="col-8" >
						<label for="inputEmail3" class=" col-form-label " style="color: black; font-size:20px !important" >Inventory Module</label>
					</div>
					<div class="col-4 text-right"  >
						<div class="input-group mb-1 ">
							<input  type="checkbox" id="Inv" name="chkMainModule[]" class="" style="width:40px ; height:40px"  value="Inv">
							
							<button class="btn btnGroup ml-1" type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6;width:40px  !important; height:40px !important "  data-toggle="collapse" data-target="#inventoryModule"  >
								<i class="fas fa-plus input-prefix" tabindex=0 style="color:blue "></i>
							</button>
							
						</div>
					</div>
				
					<div class="col-12 " style="background-color:#E8E8E8  !important;">				
						<div class="collapse ml-2 mt-3"  id="inventoryModule">
						   <div class="row">
								<div class="col-7" >
									<label for="inputEmail3" class=" col-form-label " style="color: black;" >Inventory Transfer</label>
								</div>
								<div class="col-5" >
									<div class="input-group mb-1 ">
										<input  type="checkbox" id="OWTR" name="chkModule[]"  class="InvSubModule" style="width:30px ; height:30px" value="OWTR" >
									</div>
								</div>
							</div>
						</div>
					</div>	
				</div>
			</div>
			<div class="col-lg-12" style="background-color:#A8A8A8 !important; margin:5px !important">
				<div class="form-group row py-2 my-2" >
					<div class="col-8" >
						<label for="inputEmail3" class=" col-form-label " style="color: black; font-size:20px !important" >Sales Module</label>
					</div>
					<div class="col-4 text-right"  >
						<div class="input-group mb-1 ">
							<input  type="checkbox" id="Sales" name="chkMainModule[]" class="" style="width:40px ; height:40px"  value="Sales">
							
							<button class="btn btnGroup ml-1" type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6;width:40px  !important; height:40px !important "  data-toggle="collapse" data-target="#salesModule"  >
								<i class="fas fa-plus input-prefix" tabindex=0 style="color:blue "></i>
							</button>
						</div>
					</div>
					<div class="col-12 " style="background-color:#E8E8E8 !important;">				
						<div class="collapse ml-2 mt-3" id="salesModule">
						   <div class="row ">
								<div class="col-7" >
									<label for="inputEmail3" class=" col-form-label " style="color: black;" >Sales Quotation</label>
								</div>
								<div class="col-5" >
									<div class="input-group mb-1 ">
										<input  type="checkbox" id="OQUT" name="chkModule[]" class="SalesSubModule" style="width:30px ; height:30px" value="OQUT">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-7" >
									<label for="inputEmail3" class=" col-form-label " style="color: black;" >Sales Order</label>
								</div>
								<div class="col-5" >
									<div class="input-group mb-1 ">
										<input  type="checkbox" id="ORDR" name="chkModule[]" class="SalesSubModule" style="width:30px ; height:30px"  value="ORDR">
									</div>
								</div>	
							</div>
							<div class="row">
								<div class="col-7" >
									<label for="inputEmail3" class=" col-form-label " style="color: black;" >Delivery</label>
								</div>
								<div class="col-5" >
									<div class="input-group mb-1 ">
										<input  type="checkbox" id="ODLN" name="chkModule[]" class="SalesSubModule" style="width:30px ; height:30px"  value="ODLN">
									</div>
								</div>	
							</div>
						</div>
					</div>	
				</div>
			</div>
			<div class="col-lg-12" style="background-color:#A8A8A8 !important; margin:5px !important">
				<div class="form-group row py-2 my-2" >
					<div class="col-8" >
						<label for="inputEmail3" class=" col-form-label " style="color: black; font-size:20px !important" >Purchase Module</label>
					</div>
					<div class="col-4 text-right"  >
						<div class="input-group mb-1 ">
							<input  type="checkbox" id="Purch" name="chkMainModule[]" class="d-none" style="width:40px ; height:40px"  value="Purch">
							<button class="btn btnGroup ml-1" type="button"  id="Purch" style="background-color: white ;width:40px  !important; height:40px !important "   >
								<i class="checked d-none fas fa-check input-prefix"  style="color:blue "></i>
								<i class="indetermine d-none fas fa-minus input-prefix"  style="color:blue "></i>
								<i class="unchecked d-none fas input-prefix"  style="color:blue "></i>
							</button>
							<button class="btn btnGroup ml-1" type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6;width:40px  !important; height:40px !important "  data-toggle="collapse" data-target="#purchaseModule"  >
								<i class="fas fa-plus input-prefix" tabindex=0 style="color:blue "></i>
							</button>
						</div>
					</div>
				
					<div class="col-12 " style="background-color:#E8E8E8 !important;">				
						<div class="collapse ml-2 mt-3" id="purchaseModule">
						  <div class="row">
								<div class="col-7" >
									<label for="inputEmail3" class=" col-form-label " style="color: black;" >Purchase Request</label>
								</div>
								<div class="col-5" >
									<div class="input-group mb-1 ">
										<input  type="checkbox" id="OPRQ" name="chkModule[]" class="PurchSubModule" style="width:30px ; height:30px" value="OPRQ" >
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-7" >
									<label for="inputEmail3" class=" col-form-label " style="color: black;" >Purchase Order</label>
								</div>
								<div class="col-5" >
									<div class="input-group mb-1 ">
										<input  type="checkbox" id="OPOR" name="chkModule[]" class="PurchSubModule" style="width:30px ; height:30px"  value="OPOR">
									</div>
								</div>	
							</div>
							<div class="row">
								<div class="col-7" >
									<label for="inputEmail3" class=" col-form-label " style="color: black;" >Goods Receipt PO</label>
								</div>
								<div class="col-5" >
									<div class="input-group mb-1 ">
										<input  type="checkbox" id="OPDN" name="chkModule[]" class="PurchSubModule" style="width:30px ; height:30px"  value="OPDN">
									</div>
								</div>	
							</div>
						</div>
					</div>	
				</div>
			</div>
	</div>
</div>
<div class="col-lg-3" >
		<div class="row " style="padding-top:10px; margin-left:5px ">
			
	</div>
</div>
</div>