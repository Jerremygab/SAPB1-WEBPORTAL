<?php
session_start();
include_once('../../../config/config.php');
?>
<div class="row pr-0 "  width="100%">
				<div class="col-lg-4 pb-2" id="bpCol">
						<div class="form-group row  py-0 my-0">
						<div class="col-sm-3" >
						<label for="inputEmail3" class=" col-form-label " style="color: black;" >Superuser</label>
						</div>
							<div class="col-sm-9" >
								<div class="input-group mb-1 ">
								    <input  type="checkbox" id="chkAdmin" class="" style="width:30px ; height:30px" >
								</div>
							</div>
						</div>
						<div class="form-group row py-0 my-0" >
							<div class="col-sm-3" >
							<label for="inputEmail3" class=" col-form-label " style="color: black;" >User Code</label>
							</div>
								<div class="col-sm-9 ">
									<div class="input-group mb-1">
									<input id="txtUserId" class="d-none"></input>
										<input type="text" id="txtUserCode" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1 " style="border-bottom-left-radius:5px; border-top-left-radius:5px;" >	
									</div>
								</div>
						</div>	 
						<div class="form-group row  py-0 my-0">
						<div class="col-sm-3" >
						<label for="inputEmail3" class=" col-form-label " style="color: black;" >User Name</label>
						</div>
							<div class="col-sm-9" >
								  <div class="input-group mb-1">
								    <input  type="text" id="txtUserName" class="form-control" placeholder="" >
									
									</div>
							</div>
						</div>	  
						<div class="form-group row  py-0 my-0">
						<div class="col-sm-3" >
						<label for="inputEmail3" class=" col-form-label " style="color: black;" >Password</label>
						</div>
							<div class="col-sm-9" >
								<div class="input-group mb-1">
								    <input  type="password" id="txtPassword" class="form-control" placeholder="" maxlength=12>
								</div>
							</div>
						</div>	  	
						<div class="form-group row py-0 my-0" >
						<div class="col-sm-3" >
						<label for="inputEmail3" class=" col-form-label " style="color: black;" >Employee</label>
						</div>
							<div class="col-sm-9" >
								<div class="input-group mb-1">
									<div class="input-group-prepend d-none" id="lnkCardCode" >
										<button  class="btn"  type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6;"  data-toggle="modal" data-target="#bpMasterModal" data-backdrop="false">
											<i class="fas fa-arrow-right  " style="color: #FFD700; font-size:20px"></i>
										</button>
									</div>
									<input readonly type="text" id="txtEmpCode" class="form-control d-none" placeholder="" aria-label="Username" aria-describedby="basic-addon1 " style="border-bottom-left-radius:5px; border-top-left-radius:5px;">
									<input readonly type="text" id="txtEmpName" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1 " style="border-bottom-left-radius:5px; border-top-left-radius:5px;">
								
									<div class="input-group-append">
										<button id="btnCardCode" class="btn btnGroup" type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#empModal" data-backdrop="false" >
											<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue "></i>
										</button>
									</div>
								</div>
							</div>
						</div>	 
						<div class="form-group row  py-0 my-0">
						<div class="col-sm-3" >
						<label for="inputEmail3" class=" col-form-label " style="color: black;" >Locked</label>
						</div>
							<div class="col-sm-9" >
								<div class="input-group mb-1 ">
								    <input  type="checkbox" id="chkLocked" class="" style="width:30px ; height:30px" >
								</div>
							</div>
						</div>
							
						
					</div>	
					<div class="col-lg-8 pb-2  "  width="100%" id="midCol">
						<ul class="nav nav-tabs pt-2" id="myTab" role="tablist">
						  <li class="nav-item " style="">
							<a class="nav-link active " id="" data-toggle="tab" href="#contents" role="tab" aria-controls="contents"
							  aria-selected="true" style="color: black; font-weight:bold">Access</a>
						  </li>
						  <li class="nav-item " style="">
							<a class="nav-link " id="" data-toggle="tab" href="#logistics" role="tab" aria-controls="contents"
							  aria-selected="true" style="color: black; font-weight:bold">Access2</a>
						  </li>
						</ul>
						<div class="tab-content" id="myTabContent" style="padding-top: 10px;">
							<div class="tab-pane fade show active" id="contents" role="tabpanel" aria-labelledby="contents">

								<div id="contentContainer"class="table-responsive" style="width:100%; padding-bottom:20px; padding-left:10px;  overflow-x:hidden;  overflow-y:hidden;" >
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
									<label for="inputEmail3" class=" col-form-label " style="color: black;" >Goods Receipt</label>
								</div>
								<div class="col-5" >
									<div class="input-group mb-1 ">
										<input  type="checkbox" id="OIGN" name="chkModule[]"  class="InvSubModule" style="width:30px ; height:30px" value="OWTR" >
									</div>
								</div>
								
							</div>
							 <div class="row">
								<div class="col-7" >
									<label for="inputEmail3" class=" col-form-label " style="color: black;" >Goods Issue</label>
								</div>
								<div class="col-5" >
									<div class="input-group mb-1 ">
										<input  type="checkbox" id="OIGE" name="chkModule[]"  class="InvSubModule" style="width:30px ; height:30px" value="OWTR" >
									</div>
								</div>
								
							</div>
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
							<div class="row">
								<div class="col-7" >
									<label for="inputEmail3" class=" col-form-label " style="color: black;" >AP Invoice</label>
								</div>
								<div class="col-5" >
									<div class="input-group mb-1 ">
										<input  type="checkbox" id="OPCH" name="chkModule[]" class="PurchSubModule" style="width:30px ; height:30px"  value="OPCH">
									</div>
								</div>	
							</div>
							<div class="row">
								<div class="col-7" >
									<label for="inputEmail3" class=" col-form-label " style="color: black;" >AP Downpayment Invoice</label>
								</div>
								<div class="col-5" >
									<div class="input-group mb-1 ">
										<input  type="checkbox" id="OPDI" name="chkModule[]" class="PurchSubModule" style="width:30px ; height:30px"  value="OPDI">
									</div>
								</div>	
							</div>
							<div class="row">
								<div class="col-7" >
									<label for="inputEmail3" class=" col-form-label " style="color: black;" >AP Credit Memo</label>
								</div>
								<div class="col-5" >
									<div class="input-group mb-1 ">
										<input  type="checkbox" id="OPCM" name="chkModule[]" class="PurchSubModule" style="width:30px ; height:30px"  value="OPCM">
									</div>
								</div>	
							</div>
							<div class="row">
								<div class="col-7" >
									<label for="inputEmail3" class=" col-form-label " style="color: black;" >Purchasing Reports</label>
								</div>
								<div class="col-5" >
									<div class="input-group mb-1 ">
										<input  type="checkbox" id="PurchasingReports" name="chkModule[]" class="PurchSubModule" style="width:30px ; height:30px"  value="Purchase">
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
						<label for="inputEmail3" class=" col-form-label " style="color: black; font-size:20px !important" >Banking</label>
					</div>
					<div class="col-4 text-right"  >
						<div class="input-group mb-1 ">
							<input  type="checkbox" id="Bank" name="chkMainModule[]" class="d-none" style="width:40px ; height:40px"  value="Bank">
							<button class="btn btnGroup ml-1" type="button"  id="Bank" style="background-color: white ;width:40px  !important; height:40px !important "   >
								<i class="checked d-none fas fa-check input-prefix"  style="color:blue "></i>
								<i class="indetermine d-none fas fa-minus input-prefix"  style="color:blue "></i>
								<i class="unchecked d-none fas input-prefix"  style="color:blue "></i>
							</button>
							<button class="btn btnGroup ml-1" type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6;width:40px  !important; height:40px !important "  data-toggle="collapse" data-target="#bankingModule"  >
								<i class="fas fa-plus input-prefix" tabindex=0 style="color:blue "></i>
							</button>
						</div>
					</div>
				
					<div class="col-12 " style="background-color:#E8E8E8 !important;">				
						<div class="collapse ml-2 mt-3" id="bankingModule">
						  <div class="row">
								<div class="col-7" >
									<label for="inputEmail3" class=" col-form-label " style="color: black;" >Incoming Payments</label>
								</div>
								<div class="col-5" >
									<div class="input-group mb-1 ">
										<input  type="checkbox" id="ORCT" name="chkModule[]" class="BankSubModule" style="width:30px ; height:30px" value="ORCT" >
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-7" >
									<label for="inputEmail3" class=" col-form-label " style="color: black;" >Outgoing Payments</label>
								</div>
								<div class="col-5" >
									<div class="input-group mb-1 ">
										<input  type="checkbox" id="OVPM" name="chkModule[]" class="BankSubModule" style="width:30px ; height:30px"  value="OVPM">
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
									<hr/>
								</div>
								
							</div>
							<div class="tab-pane fade " id="logistics" role="tabpanel" aria-labelledby="logistics">
								<div id="contentContainer"class="table-responsive" style="width:100%; padding-bottom:20px; padding-left:10px; overflow-x:hidden;  overflow-y:hidden;">
									<div class="row"  >
	<div class="col-lg-6"  >
		<div class="row " style="padding-top:10px; margin-left:5px ">
			<div class="col-lg-12" style="background-color:#A8A8A8 !important; margin:5px !important">
				<div class="form-group row py-2 my-2" id="">	
					<div class="col-8" >
						<label for="inputEmail3" class=" col-form-label " style="color: black; font-size:20px !important" >General Settings1</label>
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
									<hr/>
								</div>
							</div>
							<div class="tab-pane fade " id="accounting" role="tabpanel" aria-labelledby="accounting">
								<div id="contentContainer"class="table-responsive" style="width:100%; padding-bottom:20px; padding-left:10px; padding-right:10px;  overflow-x:hidden;  overflow-y:hidden;">
									<div id="accounting-tab" >
									</div>
									<hr/>
								</div>
							</div>
							<div class="tab-pane fade " id="attachments" role="tabpanel" aria-labelledby="attachments">
								<div id="contentContainer"class="table-responsive" style="width:100%; padding-bottom:20px; padding-left:10px; padding-right:10px;  overflow-x:hidden;  overflow-y:hidden;">
									<div id="attachments-tab" >
									</div>
									<hr/>
								</div>
							</div>
						</div>
					</div>
					
				</div>
				<div id="userContainer"class="table-responsive" style="width:100%; padding-bottom:20px; padding-left:10px;  overflow-x:hidden;  overflow-y:hidden;" >
								
								
								
							
				
          
	
	
        <!-- /.container-fluid -->


				<div  id="footerButtons" class="form-group row  mt-5 ">
					<div class="col-lg-6 col-md-6 col-sm-6 text-left">
						<button type="button" id="btnAdd" class="  btn btn-warning btn-rounded " style="color: black; font-weight: bold; width:250px; background: linear-gradient(to bottom, #FCF6BA, #BF953F);" >Add</button>
						<button type="button" id="btnUpdate" class="  btn btn-warning btn-rounded d-none" style="color:black; font-weight: bold; black;width:250px; background: linear-gradient(to bottom, #FCF6BA, #BF953F);" >Update</button>
						<button type="button" id="btnOk" class="  btn btn-warning btn-rounded d-none" style="color:black; font-weight: bold; black;width:250px; background: linear-gradient(to bottom, #FCF6BA, #BF953F);" >Ok</button>
						
						<button type="button" id="btnCancel" class=" btn btn-warning btn-rounded ml-5" style="color: black;width:250px; font-weight: bold; background: linear-gradient(to bottom, #FCF6BA, #BF953F);">Cancel</button>
					</div>
				</div>
            </form>
				
				</div>
				
				