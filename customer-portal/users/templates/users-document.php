<?php

	include '../../head.php' ;

?>

  <!-- Page Wrapper -->
  <div id="wrapper">
	<?php
	include '../../sidebar.php';
	
	
	$UserId = $_SESSION['SESS_USERID'];
	$UserCode = $_SESSION['SESS_USERCODE'];
	$UserName = $_SESSION['SESS_NAME'];
	?>
	

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content" >

       <?php
		include '../../topbar.php';
	   ?>
	    <!-- Begin Page Content -->
        <div class="container-fluid" style="margin-left: 1px !important; padding-left: 1px !important;">
          <!-- Page Heading -->
         

          <!-- DataTales Example -->
          <div class="card shadow mb-4 "  id="windowmain" style="background-color:#E8E8E8 !important; border: none !important" >
		  <div class="row pr-0 "  width="100%">
			<div class="col-lg-12" id="containerSystem" style="margin-right: 0px !important; padding-right: 0px !important; "  >
            <div class="card-header py-0" style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6">
						<h5 class="mt-2 font-weight-bold " style="color: black;">User Management</h5>
					</div>

				</div>
            </div>
            <div class="card-body " style="background-color: #F5F5F5">
			<form class="user responsive " id="salesOrder"  width="100%">
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
						</ul>
						<div class="tab-content" id="myTabContent" style="padding-top: 10px;">
							<div class="tab-pane fade show active" id="contents" role="tabpanel" aria-labelledby="contents">

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
      <!-- End of Main Content -->
	  </div>
					
		</div>
		</div>
		</div>
      

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

<!-- Logout Modal-->
    <div class="modal fade " id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false" style="margin-top: 300px !important;">
      <div class="modal-dialog modal-xl" role="document" style="width:100%">
        <!--Content-->
        <div class="modal-content-full-width modal-content">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e; ">
            <h4 class="modal-title w-100" id="myModalLabel" style="color:black; font-size:15px !important;">Logout</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->
          <div class="modal-body">
          <h6 class="modal-title w-100" id="myModalLabel" style="color:black">Do you want to logout?</h6>
          </div>
          <!--Footer-->
          <div class="modal-footer"  style="background-color: none !important;">
			<button id="btnLogoutConfirm" type="button" class="btn btn-secondary" data-dismiss="modal">Yes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
          </div>
        </div>
        <!--/.Content-->
      </div>
    </div>
  <!-- Logout Modal --> 
  
<!-- Loading Modal -->
    <div class="modal fade" id="loadModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false" >
      <div class="modal-dialog modal-xl" role="document" style="width:400px !important;" >
        <!--Content-->
        <div class=" modal-content" >
          <!--Header-->
          <div class="modal-header "  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
          </div>
          <!--Body-->
		
				<div class="text-center  " >
					<div class="row ">	
						<div class="col-12" >
							<img src="../../../img/wait.gif" width=400 height=100 style=" background-color: none !important;margin-top:0px !important">
						</div>	
					</div>	
				<!--<img src="https://media.giphy.com/media/XpgOZHuDfIkoM/source.gif">-->
				<!--<img src="https://media.giphy.com/media/veAy5UOhBdS3C/source.gif" width='1200px' height="800px">-->
				</div>	
		
          <!--Footer-->
          <div class="modal-footer"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e; padding: 7px !important">
          </div> 
        
        <!--/.Content-->
      </div>
    </div>
	</div>
    <!-- Loading Modal -->
  
  <!-- Document Modal -->
    <div class="modal fade" id="documentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-dialog modal-xl" role="document" style="width:100%">
        <!--Content-->
        <div class="modal-content-full-width modal-content">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
            <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of Users</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->
          <div class="modal-body">
            <table class="table table-striped table-bordered table-hover" id="tblDoc" style="width:100%">
						<thead>
							<tr>
								<tr>
								<th >#</th>
								<th class="d-none">User ID</th>
								<th>User Code</th>
								<th>Name</th>
								<th>Super User</th>
							</tr>
							</tr>
						</thead>
						<tbody>
						<?php
							$no = 1;
							$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
													SELECT 
													T0.UserId,
													T0.UserCode,
													T0.Name,
													T0.EmpId,
													T0.SuperUser,
													CONCAT(T1.LastName, ', ', T1.FirstName, ' ', T1.MiddleName) AS Name
													
													
											FROM [".$MSSQL_DB2."].[dbo].[@OUSR] T0
											INNER JOIN OHEM T1 ON t1.EmpId = T0.EmpID");
							while (odbc_fetch_row($qry)) 
							{
								echo '<tr class="srch">
												<td>'.$no.'</td>
												<td class="item-1 hidden">'.odbc_result($qry, 'UserId').'</td>
												<td class="item-2">'.odbc_result($qry, 'UserCode').'</td>
												<td class="item-4">'.odbc_result($qry, 'Name').'</td>
												<td class="item-5">'.odbc_result($qry, 'SuperUser').'</td>
									
										  </tr>';
								$no++;	  
							}
							odbc_free_result($qry);
						?>
						</tbody>
					</table>
          </div>
          <!--Footer-->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!--/.Content-->
      </div>
    </div>
    <!-- Document Modal -->
	
	<!-- Copy From PR Modal -->
    <div class="modal fade" id="purchaseRequestModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-dialog modal-xl" role="document" style="width:100%">
        <!--Content-->
        <div class="modal-content-full-width modal-content">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
            <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of Purchase Request</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->
			<div class="modal-body">
				<table class="table table-striped table-bordered table-hover " id="tblPR">
								<thead>
									<tr>
										<th>#</th>
										<th class="">Doc No.</th>
										<th class="">Doc Date</th>
										<th class="">Vendor Name</th>
										<th class="">Remarks</th>
										<th class="">Due Date</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$itemno = 1;
									$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT 
																							T0.DocNum,
																							T0.DocDate,
																							T0.CardName,
																							T0.Comments,
																							T0.DocDueDate
																							
																							FROM OPRQ T0

																							WHERE T0.DocStatus = 'O'
																							
																							ORDER BY T0.DocNum");

										while (odbc_fetch_row($qry)) 
										{
											echo '<tr>
													<td>'.$itemno.'</td>
													<td class="item-1 ">'.odbc_result($qry, 'DocNum').'</td>
													<td class="item-2 ">'.date('Y-m-d' ,strtotime(odbc_result($qry, 'DocDate'))).'</td>
													<td class="item-3 ">'.odbc_result($qry, 'CardName').'</td>
													<td class="item-4 ">'.odbc_result($qry, 'Comments').'</td>
													<td class="item-5 ">'.date('Y-m-d' ,strtotime(odbc_result($qry, 'DocDueDate'))).'</td>
												</tr>';
											$itemno++;	  
										}

									odbc_free_result($qry);
									

									?>
					</tbody>
				</table>
			</div>
          <!--Footer-->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!--/.Content-->
      </div>
    </div>
    <!-- Copy From PR Modal -->
	
  <!-- Employee Modal -->
    <div class="modal fade" id="empModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-dialog modal-xl" role="document" style="width:100%">
        <!--Content-->
        <div class="modal-content-full-width modal-content">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
            <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of Employees</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->
          <div class="modal-body">
            <table class="tblBP table table-striped table-bordered table-hover" id="tblEmployee" style="width: 100%">
						<thead>
							<tr>
								<th >#</th>
								<th>Employee Code</th>
								<th>Employee Name</th>
								<th>Job Title</th>
								<th class="d-none">Department Code</th>
								<th class="d-none">Branch Code</th>
								<th>Department</th>
								<th>Branch</th>
								
							</tr>
						</thead>
						<tbody>
						<?php
							$itemno = 1;
							$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT DISTINCT
																						T0.EmpId, 
																						CONCAT(T0.LastName, ', ', T0.FirstName, ' ',T0.MiddleName) AS FullName,
																						T0.JobTitle,
																						T0.Dept,
																						T0.Branch,
																						T1.Name AS DeptName,
																						T2.Name AS BranchName
																						
																						FROM OHEM T0
																						LEFT JOIN OUDP T1 ON T0.dept = T1.Code 
																						LEFT JOIN OUBR T2 ON T0.branch = T2.Code
																						
																						ORDER BY T0.EmpId ASC");
								while (odbc_fetch_row($qry)) 
								{
									echo '<tr class="tableHover">
												<td>'.$itemno.'</td>
												<td class="item-1">'.odbc_result($qry, 'EmpId').'</td>
												<td class="item-2">'.odbc_result($qry, 'FullName').'</td>
												<td class="item-3">'.odbc_result($qry, 'JobTitle').'</td>
												<td class="item-4 d-none">'.odbc_result($qry, 'Dept').'</td>
												<td class="item-5 d-none">'.odbc_result($qry, 'Branch').'</td>
												<td class="item-6">'.odbc_result($qry, 'DeptName').'</td>
												<td class="item-7">'.odbc_result($qry, 'BranchName').'</td>
										</tr>';
									$itemno++;	  
								}
								
								odbc_free_result($qry);
							

						?>
						</tbody>
					</table>
          </div>
          <!--Footer-->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!--/.Content-->
      </div>
    </div>
    <!-- Employee Modal -->
	
	 <!-- Contact Person Modal -->
    <div class="modal fade" id="contactPersonModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-dialog modal-xl" role="document" style="width:100%">
        <!--Content-->
        <div class="modal-content-full-width modal-content">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
            <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of Contact Persons</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->
          <div class="modal-body">
			<div id="contactPersonResult"></div>
						
          </div>
          <!--Footer-->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!--/.Content-->
      </div>
    </div>
    <!-- Contact Person Modal -->
	
	<!-- Sales Employee Modal -->
    <div class="modal fade" id="salesEmpModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-dialog modal-xl" role="document" style="width:100%">
        <!--Content-->
        <div class="modal-content-full-width modal-content">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
            <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of Sales Employee</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->
          <div class="modal-body">
            <table class="table table-striped table-bordered table-hover" id="tblSalesEmployee" style="width:100%">
						<thead>
							<tr>
								<th >#</th>
								<th class="d-none">Sales Employee Code</th>
								<th>Sales Employee Name</th>
								<th>Remarks</th>
								
							</tr>
						</thead>
						<tbody>
						<?php
							$itemno = 1;
							$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT DISTINCT
																						T0.SlpCode, 
																						T0.SlpName,
																						T0.Memo
																						
																						
																						FROM OSLP T0
																						
																						ORDER BY T0.SlpCode ASC");
								while (odbc_fetch_row($qry)) 
								{
									echo '<tr class="">
												<td>'.$itemno.'</td>
												<td class="item-1 d-none">'.odbc_result($qry, 'SlpCode').'</td>
												<td class="item-2">'.odbc_result($qry, 'SlpName').'</td>
												<td class="item-3">'.odbc_result($qry, 'Memo').'</td>
											  </tr>';
									$itemno++;	  
								}
								
								odbc_free_result($qry);
							

						?>
						</tbody>
					</table>
          </div>
          <!--Footer-->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!--/.Content-->
      </div>
    </div>
    <!-- Sales Employee Modal -->
	
	<!-- Employee Modal -->
    <div class="modal fade" id="empModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-dialog modal-xl" role="document" style="width:100%">
        <!--Content-->
        <div class="modal-content-full-width modal-content">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
            <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of Employee</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->
          <div class="modal-body">
            <table class="table table-striped table-bordered table-hover" id="tblEmployee" style="width:100%">
						<thead>
							<tr>
								<th >#</th>
								<th class="d-none">Employee Code</th>
								<th>Employee Name</th>
								
							</tr>
						</thead>
						<tbody>
						<?php
							$itemno = 1;
							$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT DISTINCT
																						T0.EmpId, 
																						T0.LastName + ', ' + T0.FirstName AS Name
																						
																						
																						FROM OHEM T0
																						
																						ORDER BY T0.EmpId ASC");
								while (odbc_fetch_row($qry)) 
								{
									echo '<tr class="">
												<td>'.$itemno.'</td>
												<td class="item-1 d-none">'.odbc_result($qry, 'EmpId').'</td>
												<td class="item-2">'.odbc_result($qry, 'Name').'</td>
											  </tr>';
									$itemno++;	  
								}
								
								odbc_free_result($qry);
							

						?>
						</tbody>
					</table>
          </div>
          <!--Footer-->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!--/.Content-->
      </div>
    </div>
    <!-- Employee Modal -->
	
	<!-- Payment Terms Modal -->
    <div class="modal fade" id="paymentTermsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-dialog modal-xl" role="document" style="width:100%">
        <!--Content-->
        <div class="modal-content-full-width modal-content">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
            <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of Payment Terms</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->
          <div class="modal-body">
            <table class="table table-striped table-bordered table-hover" id="tblPaymentTerms" style="width:100%">
						<thead>
							<tr>
								<th >#</th>
								<th class="d-none">Payment Code</th>
								<th>Payment Name</th>
								
							</tr>
						</thead>
						<tbody>
						<?php
							$itemno = 1;
							$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT DISTINCT
																						T0.GroupNum,
																						T0.PymntGroup
																						
																						FROM OCTG T0
																						
																						ORDER BY T0.GroupNum ASC");
								while (odbc_fetch_row($qry)) 
								{
									echo '<tr class="">
												<td>'.$itemno.'</td>
												<td class="item-1 d-none">'.odbc_result($qry, 'GroupNum').'</td>
												<td class="item-2">'.odbc_result($qry, 'PymntGroup').'</td>
											  </tr>';
									$itemno++;	  
								}
								
								odbc_free_result($qry);
							

						?>
						</tbody>
					</table>
          </div>
          <!--Footer-->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!--/.Content-->
      </div>
    </div>
    <!-- payment Terms Modal -->
	
   <!-- Item Code Modal -->
    <div class="modal fade" id="itemModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-dialog modal-xl" role="document" style="width:100%">
        <!--Content-->
        <div class="modal-content-full-width modal-content">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
            <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of Items</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->
          <div class="modal-body">
           <table class="table table-striped table-bordered table-hover" id="tblItem" style="width:100%">
						<thead>
							<tr>
								<th >#</th>
								<th >Item Code</th>
								<th >Item Name</th>
								<th>Foreign Name</th>
								<th>UoM Group</th>
								<th>Inventory UoM</th>
								<th class="d-none">Price</th>
								<th class="d-none">Vendor</th>
								<th class="d-none">UGP Entry</th>
								<th class="d-none">UGP Code</th>
								<th class="d-none">UGP Name</th>
							</tr>
						</thead>
						<tbody>
						<?php
							$itemno = 1;
							$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT DISTINCT
																						T0.ItemCode, 
																						T0.ItemName, 
																						T0.FrgnName,
																						T0.InvntryUom, 
																						T0.CardCode, 
																						T1.ItmsGrpNam,
																						CASE WHEN T2.Price = 0 THEN '' END AS Price,
																						T4.UomEntry,
																						T4.UomCode,
																						T4.UomName
																						
																						
																							
																						FROM OITM T0
																						INNER JOIN OITB T1 ON T0.ItmsGrpCod = T1.ItmsGrpCod
																						INNER JOIN ITM1 T2 ON T2.ItemCode = T0.ItemCode
																						LEFT JOIN OPLN T3 ON T3.ListNum = T2.PriceList
																						INNER JOIN OUOM T4 ON T4.UomEntry = T0.IUoMEntry
																						
																						WHERE T0.PrchseItem = 'Y'
																						
																						
																						ORDER BY T0.ItemName ASC");
								while (odbc_fetch_row($qry)) 
								{
									echo '<tr class="">
												<td>'.$itemno.'</td>
												<td class="item-1">'.odbc_result($qry, 'ItemCode').'</td>
												<td class="item-2" >'.odbc_result($qry, 'ItemName').'</td>
												<td class="item-3 " >'.odbc_result($qry, 'FrgnName').'</td>
												<td class="item-4 " >'.odbc_result($qry, 'ItmsGrpNam').'</td>
												<td class="item-5 " >'.odbc_result($qry, 'InvntryUom').'</td>
												<td class="item-6 hidden" >'.odbc_result($qry, 'Price').'</td>
												<td class="item-7 hidden" >'.odbc_result($qry, 'CardCode').'</td>
												<td class="item-8 hidden" >'.odbc_result($qry, 'UomEntry').'</td>
												<td class="item-9 hidden" >'.odbc_result($qry, 'UomCode').'</td>
												<td class="item-10 hidden" >'.odbc_result($qry, 'UomName').'</td>
											  </tr>';
									$itemno++;	  
								}
								
								odbc_free_result($qry);
							

						?>
						</tbody>
					</table>
          </div>
          <!--Footer-->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!--/.Content-->
      </div>
    </div>
    <!-- Item Code Modal -->
	

	<!-- Unit of Measure Modal -->
    <div class="modal fade" id="uomModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-dialog modal-xl" role="document" style="width:100%">
        <!--Content-->
        <div class="modal-content-full-width modal-content">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
            <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of Unit of Measure</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->
          <div class="modal-body">
           <div id="uomModalResult"></div>
          </div>
          <!--Footer-->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!--/.Content-->
      </div>
    </div>
    <!-- Unit of Measure Modal -->
	
	 <!-- GL Modal -->
    <div class="modal fade" id="glModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-dialog modal-xl" role="document" style="width:100%">
        <!--Content-->
        <div class="modal-content-full-width modal-content">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
            <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of G/L Accounts</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->
          <div class="modal-body">
            <table class="table table-striped table-bordered table-hover" id="tblGL">
						<thead>
							<tr>
								<th >#</th>
								<th>Account Number</th>
								<th>Account Name</th>
								<th>Account Balance</th>
								
							</tr>
						</thead>
						<tbody>
						<?php
							$itemno = 1;
							$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT DISTINCT
																						T0.AcctCode, 
																						T0.AcctName, 
																						T0.CurrTotal
																						
																						FROM OACT T0
																						
																						ORDER BY T0.AcctCode ASC");
								while (odbc_fetch_row($qry)) 
								{
									echo '<tr class="">
												<td>'.$itemno.'</td>
												<td class="item-1">'.odbc_result($qry, 'AcctCode').'</td>
												<td class="item-2">'.odbc_result($qry, 'AcctName').'</td>
												<td class="item-3 " >'.odbc_result($qry, 'CurrTotal').'</td>
												
											  </tr>';
									$itemno++;	  
								}
								
								odbc_free_result($qry);
							

						?>
						</tbody>
					</table>
          </div>
          <!--Footer-->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!--/.Content-->
      </div>
    </div>
    <!-- GL Modal -->
	
	<!-- Ship To Details Modal -->
    <div class="modal fade" id="shipToDetailsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document" style="width:100%; ">
        <!--Content-->
        <div class="modal-content-full-width modal-content" style="height: 500px;">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
            <h4 class="modal-title w-100" id="myModalLabel" style="color:black">Address Component</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->
          <div class="modal-body" >
			<div class="form-group row my-1" >
				<label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2" style="color: black;" >Street / PO Box</label>
				<div class="col-sm-9" >
					 <input type="text" class="form-control shipInputs" id="txtStreetPOBoxS" placeholder="" >
				</div>
			</div>	
			<div class="form-group row  my-1" >
				<label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2" style="color: black;" >Street No.</label>
				<div class="col-sm-9" >
					 <input type="text" class="form-control shipInputs" id="txtStreetNoS" placeholder="" >
				</div>
			</div>	
			<div class="form-group row   my-1" >
				<label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2" style="color: black;" >Block</label>
				<div class="col-sm-9" >
					 <input type="text" class="form-control shipInputs" id="txtBlockS" placeholder="" >
				</div>
			</div>	
			<div class="form-group row   my-1" >
				<label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2" style="color: black;" >City</label>
				<div class="col-sm-9" >
					 <input type="text" class="form-control shipInputs" id="txtCityS" placeholder=""  autocomplete=false>
				</div>
			</div>	
			<div class="form-group row   my-1" >
				<label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2" style="color: black;" >Zip Code</label>
				<div class="col-sm-9" >
					 <input type="text" class="form-control shipInputs" id="txtZipCodeS" placeholder="" >
				</div>
			</div>	
			<div class="form-group row   my-1" >
				<label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2" style="color: black;" >County</label>
				<div class="col-sm-9" >
					 <input type="text" class="form-control shipInputs" id="txtCountyS" placeholder="">
				</div>	
			</div>	
			<div class="form-group row   my-1" >
				<label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2" style="color: black;" >State</label>
				<div class="input-group mb-1 col-sm-9">
						<input  type="text" id="txtStateS" class="form-control shipInputs d-none" placeholder="" >
						<input  type="text" id="txtStateSName" class="form-control shipInputs" placeholder="" readonly>
						<div class="input-group-append">
							<button class="btn btnGroup" type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#stateModalS" data-backdrop="false">
								<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue "></i>
							</button>
						</div>
				</div>
			</div>	
			<div class="form-group row   my-1" >
				<label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2" style="color: black;" >Country</label>
					<div class="input-group mb-1 col-sm-9">
						<input  type="text" id="txtCountryS" class="form-control shipInputs d-none" placeholder="" readonly>
						<input  type="text" id="txtCountrySName" class="form-control shipInputs" placeholder="" readonly>
						<div class="input-group-append">
							<button class="btn btnGroup" type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#countryModalS" data-backdrop="false">
								<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue "></i>
							</button>
						</div>
					</div>
			</div>	
		
			<div class="form-group row   my-1" >
				<label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2" style="color: black;" >Building / Floor / Room</label>
				<div class="col-sm-9" >
					 <input type="text" class="form-control shipInputs" id="txtBuildingS" placeholder="" >
				</div>
			</div>	
			<div class="form-group row   my-1" >
				<label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2" style="color: black;" >Address Name 2</label>
				<div class="col-sm-9" >
					 <input type="text" class="form-control shipInputs" id="txtAdress2" placeholder="" >
				</div>
			</div>
			<div class="form-group row   my-1" >
				<label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2" style="color: black;" >Address Name 3</label>
				<div class="col-sm-9" >
					 <input type="text" class="form-control shipInputs" id="txtAdress3" placeholder="" >
				</div>
			</div>
			<div class="form-group row   my-1" >
				<label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2" style="color: black;" >GLN</label>
				<div class="col-sm-9" >
					 <input type="text" class="form-control shipInputs" id="txtGLNS" placeholder="" >
				</div>
			</div>
			
          </div>
          <!--Footer-->
          <div class="modal-footer">
			<button type="button" id="btnShipToAddressOk" class="btn btn-secondary " data-dismiss="modal">Ok</button>
			<button type="button" id="btnShipToAddressUpdate" class="btn btn-secondary d-none" data-dismiss="modal">Update</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!--/.Content-->
      </div>
    </div>
    <!-- Ship To Details Modal -->
	
	
	
	<!-- Bill To Details Modal -->
    <div class="modal fade" id="billToDetailsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document" style="width:100%; ">
        <!--Content-->
        <div class="modal-content-full-width modal-content" style="height: 500px;">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
            <h4 class="modal-title w-100" id="myModalLabel" style="color:black">Address Component</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->
          <div class="modal-body" >
			<div class="form-group row my-1" >
				<label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2" style="color: black;" >Street / PO Box</label>
				<div class="col-sm-9" >
					 <input type="text" class="form-control billInputs" id="txtStreetPOBoxB" placeholder="" >
				</div>
			</div>	
			<div class="form-group row  my-1" >
				<label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2" style="color: black;" >Street No.</label>
				<div class="col-sm-9" >
					 <input type="text" class="form-control billInputs" id="txtStreetNoB" placeholder="" >
				</div>
			</div>	
			<div class="form-group row   my-1" >
				<label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2" style="color: black;" >Block</label>
				<div class="col-sm-9" >
					 <input type="text" class="form-control billInputs" id="txtBlockB" placeholder="" >
				</div>
			</div>	
			<div class="form-group row   my-1" >
				<label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2" style="color: black;" >City</label>
				<div class="col-sm-9" >
					 <input type="text" class="form-control billInputs" id="txtCityB" placeholder=""  autocomplete=false>
				</div>
			</div>	
			<div class="form-group row   my-1" >
				<label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2" style="color: black;" >Zip Code</label>
				<div class="col-sm-9" >
					 <input type="text" class="form-control billInputs" id="txtZipCodeB" placeholder="" >
				</div>
			</div>	
			<div class="form-group row   my-1" >
				<label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2" style="color: black;" >County</label>
				<div class="col-sm-9" >
					 <input type="text" class="form-control billInputs" id="txtCountyB" placeholder="">
				</div>	
			</div>	
			<div class="form-group row   my-1" >
				<label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2" style="color: black;" >State</label>
				<div class="input-group mb-1 col-sm-9">
						<input  type="text" id="txtStateB" class="form-control billInputs d-none" placeholder="" >
						<input  type="text" id="txtStateBName" class="form-control billInputs" placeholder="" readonly>
						<div class="input-group-append">
							<button class="btn btnGroup" type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#stateModalB" data-backdrop="false">
								<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue "></i>
							</button>
						</div>
				</div>
			</div>	
			<div class="form-group row   my-1" >
				<label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2" style="color: black;" >Country</label>
					<div class="input-group mb-1 col-sm-9">
						<input  type="text" id="txtCountryB" class="form-control billInputs d-none" placeholder="" readonly>
						<input  type="text" id="txtCountryBName" class="form-control billInputs" placeholder="" readonly>
						<div class="input-group-append">
							<button class="btn btnGroup" type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#countryModalB" data-backdrop="false">
								<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue "></i>
							</button>
						</div>
					</div>
			</div>		
		
			<div class="form-group row   my-1" >
				<label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2" style="color: black;" >Building / Floor / Room</label>
				<div class="col-sm-9" >
					 <input type="text" class="form-control billInputs" id="txtBuildingB" placeholder="" >
				</div>
			</div>	
			<div class="form-group row   my-1" >
				<label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2" style="color: black;" >Address Name 2</label>
				<div class="col-sm-9" >
					 <input type="text" class="form-control billInputs" id="txtAdressB" placeholder="" >
				</div>
			</div>
			<div class="form-group row   my-1" >
				<label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2" style="color: black;" >Address Name 3</label>
				<div class="col-sm-9" >
					 <input type="text" class="form-control billInputs" id="txtAdressB" placeholder="" >
				</div>
			</div>
			<div class="form-group row   my-1" >
				<label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2" style="color: black;" >GLN</label>
				<div class="col-sm-9" >
					 <input type="text" class="form-control billInputs" id="txtGLNB" placeholder="" >
				</div>
			</div>
			
          </div>
          <!--Footer-->
          <div class="modal-footer">
			<button type="button" id="btnBillToAddressOk" class="btn btn-secondary " data-dismiss="modal">Ok</button>
			<button type="button" id="btnBillToAddressUpdate" class="btn btn-secondary d-none" data-dismiss="modal">Update</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!--/.Content-->
      </div>
    </div>
    <!-- Bill To Details Modal -->
	
	<!-- Country Modal to Ship -->
    <div class="modal fade" id="countryModalS" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-dialog modal-xl" role="document" style="width:100%">
        <!--Content-->
        <div class="modal-content-full-width modal-content">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
            <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of Countries</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->
          <div class="modal-body">
            <table class="table table-striped table-bordered table-hover" id="tblCountryS" style="width:100%">
						<thead>
							<tr>
								<th >#</th>
								<th>Country Code</th>
								<th>Country Name</th>
								
							</tr>
						</thead>
						<tbody>
						<?php
							$itemno = 1;
							$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT DISTINCT
																						T0.Code, 
																						T0.Name
																						
																						
																						FROM OCRY T0
																						
																						ORDER BY T0.Code ASC");
								while (odbc_fetch_row($qry)) 
								{
									echo '<tr class="">
												<td>'.$itemno.'</td>
												<td class="item-1">'.odbc_result($qry, 'Code').'</td>
												<td class="item-2">'.odbc_result($qry, 'Name').'</td>
											  </tr>';
									$itemno++;	  
								}
								
								odbc_free_result($qry);
							

						?>
						</tbody>
					</table>
          </div>
          <!--Footer-->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!--/.Content-->
      </div>
    </div>
    <!-- Country Modal to Ship -->
	
	<!-- Country Modal to Bill -->
    <div class="modal fade" id="countryModalB" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-dialog modal-xl" role="document" style="width:100%">
        <!--Content-->
        <div class="modal-content-full-width modal-content">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
            <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of Countries</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->
          <div class="modal-body">
            <table class="table table-striped table-bordered table-hover" id="tblCountryB" style="width:100%">
						<thead>
							<tr>
								<th >#</th>
								<th>Country Code</th>
								<th>Country Name</th>
								
							</tr>
						</thead>
						<tbody>
						<?php
							$itemno = 1;
							$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT DISTINCT
																						T0.Code, 
																						T0.Name
																						
																						
																						FROM OCRY T0
																						
																						ORDER BY T0.Code ASC");
								while (odbc_fetch_row($qry)) 
								{
									echo '<tr class="">
												<td>'.$itemno.'</td>
												<td class="item-1">'.odbc_result($qry, 'Code').'</td>
												<td class="item-2">'.odbc_result($qry, 'Name').'</td>
											  </tr>';
									$itemno++;	  
								}
								
								odbc_free_result($qry);
							

						?>
						</tbody>
					</table>
          </div>
          <!--Footer-->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!--/.Content-->
      </div>
    </div>
    <!-- Country Modal to Bill -->
	
	<!-- State Modal -->
    <div class="modal fade" id="stateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-dialog modal-xl" role="document" style="width:100%">
        <!--Content-->
        <div class="modal-content-full-width modal-content">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
            <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of States</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->
          <div class="modal-body">
            <table class="table table-striped table-bordered table-hover" id="tblStates" style="width:100%">
						<thead>
							<tr>
								<th >#</th>
								<th>State Code</th>
								<th>State Name</th>
								
							</tr>
						</thead>
						<tbody>
						<?php
							$itemno = 1;
							$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT DISTINCT
																						T0.Code, 
																						T0.Name
																						
																						
																						FROM OCST T0
																						
																						ORDER BY T0.Code ASC");
								while (odbc_fetch_row($qry)) 
								{
									echo '<tr class="">
												<td>'.$itemno.'</td>
												<td class="item-1">'.odbc_result($qry, 'Code').'</td>
												<td class="item-2">'.odbc_result($qry, 'Name').'</td>
											  </tr>';
									$itemno++;	  
								}
								
								odbc_free_result($qry);
							

						?>
						</tbody>
					</table>
          </div>
          <!--Footer-->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!--/.Content-->
      </div>
    </div>
	
	<div style="display:none;height:200px;width:200px;border:3px solid green;" id="popup">Hi</div>
    <!-- State Modal -->
	
	 <!-- UDF Modal -->
    <div class="modal fade" id="udfModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-dialog modal-xl" role="document" style="width:100%">
        <!--Content-->
        <div class="modal-content-full-width modal-content">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
            <h4 id="udfModalTitle" class="modal-title w-100" id="myModalLabel" style="color:black"></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->
          <div class="modal-body">
			<div id="udfModalResult"></div>
						
          </div>
          <!--Footer-->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!--/.Content-->
      </div>
    </div>
    <!-- UDF -->

<script src="../script/users.js"></script>
<script src="../script/udf.js"></script>

<script>$('#tblItem').dataTable({"bLengthChange": false,});</script>
<script>$('#tblBP').dataTable({"bLengthChange": false});</script>
<script>$('#tblDoc').dataTable({"bLengthChange": false,});</script>
<script>$('#tblSalesEmployee').dataTable({"bLengthChange": false,});</script>
<script>$('#tblEmployee').dataTable({"bLengthChange": false,});</script>
<script>$('#tblPaymentTerms').dataTable({"bLengthChange": false,});</script>
<script>$('#tblCountry').dataTable({"bLengthChange": false,});</script>
<script>$('#tblStates').dataTable({"bLengthChange": false,});</script>
<script>$('#tblGL').dataTable({ 
			scrollY: 100,
            scrollX: true,
            scroller: true});
</script>
<script>$('#tblPR').dataTable({"bLengthChange": false,});</script>


<?php
	include '../../bottom.php' 
?>
