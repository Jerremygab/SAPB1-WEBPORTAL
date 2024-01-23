<?php
session_start();
include_once('../../../config/config.php');
?>
<div class="row pr-0 "  width="100%">
				<div class="col-lg-4 pb-2" id="bpCol">
						
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
						<label for="inputEmail3" class=" col-form-label " style="color: black;" >Customer</label>
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
							<a class="nav-link active " id="" data-toggle="tab" href="#contents2" role="tab" aria-controls="contents"
							  aria-selected="true" style="color: black; font-weight:bold">Access</a>
						  </li>
						</ul>
						<div class="tab-content" id="myTabContent" style="padding-top: 10px;">
							<div class="tab-pane fade show active" id="contents2" role="tabpanel" aria-labelledby="contents">

								<div id="contentContainer"class="table-responsive" style="width:100%; padding-bottom:20px; padding-left:10px;  overflow-x:hidden;  overflow-y:hidden;" >
									<div id="contents-tab">
									</div>
									<hr/>
								</div>
								
							</div>
							<div class="tab-pane fade " id="logistics" role="tabpanel" aria-labelledby="logistics">
								<div id="contentContainer"class="table-responsive" style="width:100%; padding-bottom:20px; padding-left:10px; overflow-x:hidden;  overflow-y:hidden;">
									<div id="logistics-tab" >
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
				