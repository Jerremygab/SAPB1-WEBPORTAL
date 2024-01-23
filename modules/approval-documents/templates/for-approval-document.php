<?php

	include '../../head.php' ;

?>

  <!-- Page Wrapper -->
  <div id="wrapper">
	<?php
	include '../../sidebar.php';

	$ApprovalTemplateCode = $_SESSION['ApprovalTemplateCode']; 
	$OriginatorEmpId = $_SESSION['OriginatorEmpId']; 
	$ApprovalStageCode = $_SESSION['ApprovalStageCode']; 
	$ApproverEmpId = $_SESSION['ApproverEmpId']; 
	$ApprovalModules = $_SESSION['ApprovalModules']; 
	$NoOfApprovals = $_SESSION['NoOfApprovals']; 
	$NoOfDisapprovals = $_SESSION['NoOfDisapprovals'];
	// $ApproverEmpId = implode(', ', $_SESSION['ApproverEmpId']);
	
	$Approver = $_SESSION['SESS_APPROVER'];
	
	$EmpId = $_SESSION['SESS_EMP'];
	$UserId = $_SESSION['SESS_USERID'];
	$UserCode = $_SESSION['SESS_USERCODE'];
	$UserName = $_SESSION['SESS_NAME'];
	$Theme = $_SESSION['SESS_THEME'];
	$hidden = '';
	$hidden2 = '';
	// if($Approver != '' ){
	// 	$hidden = '';
	// 	$hidden2 = 'd-none';
	// }else{
	// 	$hidden = 'd-none';	
	// 	$hidden2 = '';
	// }
	?>
	

    <!-- Content Wrapper -->
    <div id="content-wrapper d-none" class="d-flex flex-column">
    	<h1 class="h3 mb-0 text-gray-800 d-none" id="theme"><?php echo $Theme ?></h1>
      <!-- Main Content -->
      <div id="content" >

       <?php
		include '../../topbar.php';
	   ?>
	    <!-- Begin Page Content -->
        <div class="container-fluid" style="margin-left: 1px !important; padding-left: 1px !important;">
          <!-- Page Heading -->
          <input type="hidden" id="rowLoader" name="rowLoader" class="form-control input-sm">

          <!-- DataTales Example -->
          <div class="card shadow mb-4"  id="windowmain" style="background-color:#E8E8E8 !important; border: none !important" >
		  <div class="row pr-0 "  width="100%">
			<div class="col-lg-12" style="margin-right: 0px !important; padding-right: 0px !important; "  >
        		<div class="card-header py-0" style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6">
							<h5 class="mt-2 font-weight-bold " style="color: black;">Approval</h5>
						</div>
					</div>
				</div>
				<div class="card-body " id="window" style="background-color: #F5F5F5; border-right: 1px solid #A0A0A0">
					<form class="user responsive " id="form"  width="100%">
						<div class="tab-content" id="myTabContent" style="padding-top: 10px;">
							<div class="tab-pane fade show active" id="contents" role="tabpanel" aria-labelledby="contents">
								<h5 class="mt-2 font-weight-bold " style="color: black;">My Documents for approval</h5>
								<div class="input-group col-sm-3">
								  <select type="text" class="form-control " id="selStatus" placeholder=""   readonly >
									<option value='All'>All</option>
									<option value='Pending'>Pending</option>
									<option value='Approved'>Approved</option>
									<option value='Rejected'>Rejected</option>
								</select>
							
							</div>
								<div id="contentContainer"class="table-responsive ' <?php  echo $hidden  ?> '" style="width:100%; padding-bottom:20px; padding-left:10px;  overflow-x:hidden;  overflow-y:hidden;" >
									<div id="contents-tab">
										

									</div>
									<hr/>
								</div>
								
							</div>

							<div class="tab-pane fade show active" id="contents" role="tabpanel" aria-labelledby="contents">
							<h5 class="mt-2 font-weight-bold " style="color: black;">Documents for my approval</h5>
								<div class="input-group col-sm-3">
								  <select type="text" class="form-control " id="selStatus" placeholder=""   readonly >
									<option value='All'>All</option>
									<option value='Pending'>Pending</option>
									<option value='Approved'>Approved</option>
									<option value='Rejected'>Rejected</option>
								</select>
							
							</div>
								<div id="contentContainer"class="table-responsive ' <?php  echo $hidden  ?> '" style="width:100%; padding-bottom:20px; padding-left:10px;  overflow-x:hidden;  overflow-y:hidden;" >
									<div id="contents-tab-forapproval">
										

									</div>
									<hr/>
								</div>
								
							</div>
						</div>
				    <!-- /.container-fluid -->
						<div  id="footerButtons" class="form-group row  mt-5 ">
							<div class="col-lg-6 col-md-6 col-sm-6 text-left">
								<button type="button" class="btn btn-secondary" id="btnTest"><?php echo $EmpId; ?></button>
								<a href="../proc/exec/exec_add_approval_test.php">111</a>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 text-right">
										
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
 
  
 
  
  <!-- Document Modal -->
    <div class="modal fade" id="documentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-dialog modal-xl" role="document" style="width:100%">
        <!--Content-->
        <div class="modal-content-full-width modal-content">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
            <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of Purchase Order</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <!--Body-->
          <div class="modal-body">
            <table class="table table-striped table-bordered table-hover" id="tblDoc" style="width:100%">
						<thead>
							<tr>
								<th >#</th>
								<th>Doc No.</th>
								<th class='d-none'>Doc Entry</th>
								<th>Posting Date</th>
								<th class='d-none'>Vendor Code</th>
								<th >Vendor Name</th>
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
																						
																							
																						FROM OPOR T0
																						
																						ORDER BY T0.DocNum ASC");
								while (odbc_fetch_row($qry)) 
								{
									echo '<tr class="">
												<td>'.$itemno.'</td>
												<td class="item-1">'.odbc_result($qry, 'DocNum').'</td>
												<td class="item-2 d-none">'.odbc_result($qry, 'DocEntry').'</td>
												<td class="item-4 " >'.date("m/d/Y", strtotime(odbc_result($qry, 'DocDate'))).'</td>
												<td class="item-3 d-none" >'.odbc_result($qry, 'CardCode').'</td>
												<td class="item-6 " >'.odbc_result($qry, 'CardName').'</td>
												<td class="item-8 " >'.odbc_result($qry, 'Comments').'</td>
												<td class="item-9 " >'.date("m/d/Y", strtotime(odbc_result($qry, 'DocDueDate'))).'</td>
												<td class="item-5 text-right" >'.number_format(odbc_result($qry, 'DocTotal'),2).'</td>
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
    <!-- Document Modal -->
	

	
	<!-- Approval Modal Creation -->
    <div class="modal fade" id="approvalModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-dialog modal-xl" role="document" style="width:100%">
        <!--Content-->
        <div class="modal-content-full-width modal-content" style="height:1200px; width:1500px !important; margin-bottom:50px">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
            <h4 class="modal-title w-100" id="myModalLabelApproval" style="color:black">Approval Creation</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->
          <div class="modal-body">
          	<form id="modalCreation">
          	<div>
	          	<br/>
	            <div class="form-group row py-0 my-0 mb-2" >
								<div class="col-sm-1" >
								<label for="inputEmail3" class=" col-form-label " style="color: black;" >Code</label>
								</div>
								<div class="col-sm-6" >
										<input type="text" id="txtCode" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1 " style="border-bottom-left-radius:5px; border-top-left-radius:5px;">
									</div>
								<div class="col-sm-2" >
								<label for="inputEmail3" class=" col-form-label " style="color: black;" >Inactive</label>
								</div>
									<div class="col-sm-1" >
											<input  type="checkbox" id="chkActive" class="form-control" placeholder=""  style="border-bottom-left-radius:5px; border-top-left-radius:5px;">
										</div>
							</div>
							<div class="form-group row py-0 my-0" >
								<div class="col-sm-1" >
								<label for="inputEmail3" class=" col-form-label " style="color: black;" >Description</label>
								</div>
									<div class="col-sm-6" >
											<input  type="text" id="txtDescription" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1 " style="border-bottom-left-radius:5px; border-top-left-radius:5px;">
										</div>
							</div>
							<ul class="nav nav-tabs pt-5" id="myTab2" role="tablist">
							  <li class="nav-item " style="">
							    <a class="nav-link active " id="" data-toggle="tab" href="#modules" role="tab" aria-controls="modules"
							      aria-selected="true" style="color: black; font-weight:bold">Modules</a>
							  </li>
							  <li class="nav-item">
							    <a class="nav-link" id="" data-toggle="tab" href="#conditions" role="tab" aria-controls="conditions"
							      aria-selected="false" style="color: black; font-weight:bold">Conditions</a>
							  </li>
							  <li class="nav-item">
							    <a class="nav-link" id="" data-toggle="tab" href="#approvalstages" role="tab" aria-controls="approvalstages"
							      aria-selected="false"  style="color: black; font-weight:bold">Approval Stages</a>
							  </li>
							</ul>
							<div class="tab-content" id="myTabContent" style="padding-top: 10px;">
								<div class="tab-pane fade show active" id="modules" role="tabpanel" aria-labelledby="contents">
									<div class="form-group row  mb-0" >
									</div>
									<div id="contentContainer2"class="table-responsive" style="width:100%; padding-bottom:20px; padding-left:10px;  overflow-x:hidden;  overflow-y:hidden; background-color:#E8E8E8 !important;">
											<div id="modules-tab" >
												<div class="row">
														<div class="col-sm-5 ml-5 mt-3">
															<h3>Sales</h3>
															<hr/>
																 <div class="row ">
																		<div class="col-7" >
																			<label for="inputEmail3" class=" col-form-label " style="color: black;" >Sales Quotation</label>
																		</div>
																		<button class="btn btn-sm btnGroup ml-1 salessub subModule" type="button"  id="OQUT" style="background-color: white ;width:30px  !important; height:30px !important "   >
																			<i class="checked-sub d-none fas fa-check input-prefix"  style="color:blue "></i>
																			<i class="unchecked-sub d-none fas input-prefix"  style="color:blue "></i>
																		</button>
																	</div>
																	<div class="row">
																		<div class="col-7" >
																			<label for="inputEmail3" class=" col-form-label " style="color: black;" >Sales Order</label>
																		</div>
																		<button class="btn btn-sm btnGroup ml-1 salessub subModule" type="button"  id="ORDR" style="background-color: white ;width:30px  !important; height:30px !important "   >
																			<i class="checked-sub d-none fas fa-check input-prefix"  style="color:blue "></i>
																			<i class="unchecked-sub d-none fas input-prefix"  style="color:blue "></i>
																		</button>
																	</div>
																	<div class="row">
																		<div class="col-7" >
																			<label for="inputEmail3" class=" col-form-label " style="color: black;" >Delivery</label>
																		</div>
																		<button class="btn btn-sm btnGroup ml-1 salessub subModule" type="button"  id="ODLN" style="background-color: white ;width:30px  !important; height:30px !important "   >
																			<i class="checked-sub d-none fas fa-check input-prefix"  style="color:blue "></i>
																			<i class="unchecked-sub d-none fas input-prefix"  style="color:blue "></i>
																		</button>
																	</div>
																	<div class="row">
																		<div class="col-7" >
																			<label for="inputEmail3" class=" col-form-label " style="color: black;" >AR Invoice</label>
																		</div>
																		<button class="btn btn-sm btnGroup ml-1 salessub subModule" type="button"  id="OINV" style="background-color: white ;width:30px  !important; height:30px !important "   >
																			<i class="checked-sub d-none fas fa-check input-prefix"  style="color:blue "></i>
																			<i class="unchecked-sub d-none fas input-prefix"  style="color:blue "></i>
																		</button>
																	</div>
														</div>
														<div class="col-sm-5 ml-5 mt-3">
															<h3>Purchasing</h3>
															<hr/>
																<div class="row">
																		<div class="col-7" >
																			<label for="inputEmail3" class=" col-form-label " style="color: black;" >Purchase Request</label>
																		</div>	
																		<button class="btn btn-sm btnGroup ml-1 purchsub subModule" type="button"  id="OPRQ" style="background-color: white ;width:30px  !important; height:30px !important "   >
																			<i class="checked-sub d-none fas fa-check input-prefix"  style="color:blue "></i>
																			<i class="unchecked-sub d-none fas input-prefix"  style="color:blue "></i>
																		</button>
																	</div>
																	<div class="row">
																		<div class="col-7" >
																			<label for="inputEmail3" class=" col-form-label " style="color: black;" >Purchase Order</label>
																		</div>
																		<button class="btn btn-sm btnGroup ml-1 purchsub subModule" type="button"  id="OPOR" style="background-color: white ;width:30px  !important; height:30px !important "   >
																			<i class="checked-sub d-none fas fa-check input-prefix"  style="color:blue "></i>
																			<i class="unchecked-sub d-none fas input-prefix"  style="color:blue "></i>
																		</button>
																	</div>
																	<div class="row">
																		<div class="col-7" >
																			<label for="inputEmail3" class=" col-form-label " style="color: black;" >Goods Receipt PO</label>
																		</div>
																		<button class="btn btn-sm btnGroup ml-1 purchsub subModule" type="button"  id="OPDN" style="background-color: white ;width:30px  !important; height:30px !important "   >
																			<i class="checked-sub d-none fas fa-check input-prefix"  style="color:blue "></i>
																			<i class="unchecked-sub d-none fas input-prefix"  style="color:blue "></i>
																		</button>
																	</div>
														</div>
														<div class="col-sm-5 ml-5 mt-3">
															<h3>Inventory</h3>
															<hr/>
															
															<div class="row">
																	<div class="col-7" >
																		<label for="inputEmail3" class=" col-form-label " style="color: black;" >Inventory Transfer</label>
																	</div>
																		<button class="btn btn-sm btnGroup ml-1 invsub subModule" type="button"  id="OWTR" style="background-color: white ;width:30px  !important; height:30px !important "   >
																			<i class="checked-sub d-none fas fa-check input-prefix"  style="color:blue "></i>
																			<i class="unchecked-sub d-none fas input-prefix"  style="color:blue "></i>
																		</button>
																</div>
														
														</div>
												</div>
												
													
											
											</div>
										</div>
										<hr/>
									</div>
									
									<div class="tab-pane fade  " id="conditions" role="tabpanel" aria-labelledby="contents">
									<div class="form-group row  mb-0" >
									</div>
									<div id="contentContainer3"class="table-responsive" style="width:100%; padding-bottom:20px; padding-left:10px;  overflow-x:hidden;  overflow-y:hidden;" >
										<div id="conditions-tab">
											<div class="form-group row py-0 my-0 mb-2" >
												<div class="col-sm-5" >
													<label for="inputEmail3" class=" col-form-label " style="color: black;" >All Transaction</label>
												</div>
												<div class="col-sm-2" >
															<input  type="checkbox" id="chkAllTransaction" class="form-control" placeholder=""  style="border-bottom-left-radius:5px; border-top-left-radius:5px;" checked>
												</div>
											</div>
											<div class="form-group row py-0 my-0 mb-2 d-none">
												<div class="col-sm-5" >
													<label for="inputEmail3" class=" col-form-label " style="color: black;" >Query</label>
												</div>
												<div class="col-sm-2" >
															<input  type="checkbox" id="chkQuery" class="form-control" placeholder=""  style="border-bottom-left-radius:5px; border-top-left-radius:5px;">
												</div>
											</div>
											<div id="contentContainer"class="table-responsive  d-none" style="width:50%; padding-bottom:20px; padding-left:10px;  overflow-x:hidden;  overflow-y:hidden;" >
												<div id="queries-tab">
												</div>
												<hr/>
											</div>
										</div>
										<hr/>
									</div>
									</div>
									<div class="tab-pane fade  " id="approvalstages" role="tabpanel" aria-labelledby="contents">
									<div class="form-group row  mb-0" >
									</div>
									<div id="contentContainer2"class="table-responsive" style="width:100%; padding-bottom:20px; padding-left:10px;  overflow-x:hidden;  overflow-y:hidden;" >
										<div id="approval-tab">
											<div class="row">
												<div class="col-6">
													<label for="inputEmail3" class=" col-form-label " style="color: black;" >Users</label>
													<div id="contentContainer"class="table-responsive" style="width:100%; padding-bottom:20px; padding-left:10px;  overflow-x:hidden;  overflow-y:hidden;" >
													<div id="users-tab">
													</div>
													<hr/>
												</div>
											</div>
											<div class="col-6">
													<label for="inputEmail3" class=" col-form-label " style="color: black;" >Approval Template</label>
													<div id="contentContainer"class="table-responsive" style="width:100%; padding-bottom:20px; padding-left:10px;  overflow-x:hidden;  overflow-y:hidden;" >
													<div id="approval-template-tab">
													</div>
													<hr/>
												</div>
											</div>
											</div>
											
										</div>
										<hr/>
									</div>
									</div>
								</div>
						</div>
					</form>
					</div>
          <!--Footer-->
          <div class="modal-footer">
          	<button type="button" class="btn btn-secondary" id="btnAdd">Add</button>
          	<button type="button" class="btn btn-secondary d-none" id="btnUpdate">Update</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!--/.Content-->
      </div>
    </div>
    <!-- Approval Modal Creation -->
	
		
	<!-- User Approval Modal -->
    <div class="modal fade" id="UseraApprovalStageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
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
            <table class="table table-striped table-bordered table-hover" id="tblUserApproval" style="width:100%">
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
   <!-- User Approval Modal -->
	
	<!-- Template Approval Modal -->
    <div class="modal fade" id="ApprovalStageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-dialog modal-xl" role="document" style="width:100%">
        <!--Content-->
        <div class="modal-content-full-width modal-content">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
            <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of Template</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->
          <div class="modal-body">
            <table class="table table-striped table-bordered table-hover" id="tblTemplateApproval" style="width:100%">
						<thead>
							<tr>
								<th >#</th>
								<th>Template Code</th>
								<th>Template Description</th>
								
							</tr>
						</thead>
						<tbody>
						<?php
							$itemno = 1;
							$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB2."]; SELECT 
																						T0.Code,
																						T0.Description
																						
																						FROM [@OAPT] T0
																						
																						ORDER BY T0.DocEntry ASC");
								while (odbc_fetch_row($qry)) 
								{
									echo '<tr class="">
												<td>'.$itemno.'</td>
												<td class="item-1">'.odbc_result($qry, 'Code').'</td>
												<td class="item-2">'.odbc_result($qry, 'Description').'</td>
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
   <!-- Template Approval Modal -->
	
   <!-- Query Modal -->
    <div class="modal fade" id="queryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-dialog modal-xl" role="document" style="width:100%">
        <!--Content-->
        <div class="modal-content-full-width modal-content">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
            <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of Query</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->
          <div class="modal-body">
            <table class="table table-striped table-bordered table-hover" id="tblQuery">
						<thead>
							<tr>
								<th >#</th>
								<th>Query ID</th>
								<th>Query Name</th>
								<th>Query Type</th>
								<th>Update Date</th>
							
							</tr>
						</thead>
						<tbody>
						<?php
							$itemno = 1;
							$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT 
																						T0.IntrnalKey,
																						T0.QName,
																						T0.QType,
																						T0.UpdateDate,
																						T0.QString
																					
																						
																						FROM OUQR T0
																						WHERE T0.QCategory = -1
																						ORDER BY T0.Qname ASC");
								while (odbc_fetch_row($qry)) 
								{
									echo '<tr class="">
												<td>'.$itemno.'</td>
													<td class="item-1">'.odbc_result($qry, 'IntrnalKey').'</td>
													<td class="item-2">'.odbc_result($qry, 'QName').'</td>
													<td class="item-4 ">'.odbc_result($qry, 'QType').'</td>
													<td class="item-5 ">'.odbc_result($qry, 'UpdateDate').'</td>
												
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
    <!-- Query Modal -->
	
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


	<!-- Approve Modal-->
    <div class="modal fade " id="forapprover" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false" style="margin-top: 300px !important;">
      <div class="modal-dialog modal-xl" role="document" style="width:100%">
        <!--Content-->
        <div class="modal-content-full-width modal-content">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e; ">
            <h4 class="modal-title w-100" id="myModalLabel" style="color:black; font-size:15px !important;">Approve</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->
          <div class="modal-body">
          <h6 class="modal-title w-100" id="myModalLabel" style="color:black">Do you want to Approve this Document?</h6>
          </div>
          <!--Footer-->
          <div class="modal-footer"  style="background-color: none !important;">
			<button id="btnforapproverYes" type="button" class="btn btn-secondary" data-dismiss="modal">Approve</button>
            <button id="btnforapproverNo"type="button" class="btn btn-secondary" data-dismiss="modal">Disapprove</button>
          </div>
        </div>
        <!--/.Content-->
      </div>
    </div>
  <!-- Approve Modal -->


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
<script src="../script/approval.js"></script>




<?php
	include '../../bottom.php' 
?>
