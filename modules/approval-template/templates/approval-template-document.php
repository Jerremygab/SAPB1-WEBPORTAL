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
	$Theme = $_SESSION['SESS_THEME'];
	?>
	

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
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
			<div class="col-lg-12" id="containerSystem" style="margin-right: 0px !important; padding-right: 0px !important; "  >
        <div class="card-header py-0" style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6">
							<h5 class="mt-2 font-weight-bold " style="color: black;">Approval Template</h5>
						</div>
					</div>
				</div>
				<div class="card-body " id="window" style="background-color: #F5F5F5; border-right: 1px solid #A0A0A0">
					<form class="user responsive " id="form"  width="100%">
						<div class="form-group row py-0 my-0 mb-2" >
								<div class="col-sm-1" >
								<label for="inputEmail3" class=" col-form-label " style="color: black;" >Code</label>
								</div>
								<div class="col-sm-2" >
										<input type="text" id="txtApprovalTemplateCode" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1 " style="border-bottom-left-radius:5px; border-top-left-radius:5px;">
									 <input type="hidden" class="form-control " id="txtDocNum" placeholder="" 
									  value=<?php
													$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB2."]; SELECT 
																											ISNULL(MAX(T0.DocEntry),0) + 1 AS NextDocNum
																										FROM [@OAPT] T0
																													");
															while (odbc_fetch_row($qry)) 
															{
																echo odbc_result($qry, "NextDocNum");
																  
															}
										?> readonly >
									</div>
								<div class="col-sm-2" >
								<label for="inputEmail3" class=" col-form-label " style="color: black;" >Inactive</label>
								</div>
									<div class="col-sm-1" >
											<input readonly type="checkbox" id="chkActive" class="form-control" placeholder=""  style="border-bottom-left-radius:5px; border-top-left-radius:5px;">
										</div>
							</div>
							<div class="form-group row py-0 my-0" >
								<div class="col-sm-1" >
								<label for="inputEmail3" class=" col-form-label " style="color: black;" >Description</label>
								</div>
									<div class="col-sm-2" >
											<input type="text" id="txtApprovalTemplateName" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1 " style="border-bottom-left-radius:5px; border-top-left-radius:5px;">
										</div>
							</div>
						
						<div class="tab-content" id="myTabContent" style="padding-top: 10px;">
							<div class="tab-pane fade show active" id="contents" role="tabpanel" aria-labelledby="contents">
							<div class="form-group row  mb-0" >
							
							</div>
								<div id="contentContainer"class="table-responsive" style="width:40%; padding-bottom:20px; padding-left:10px;  overflow-x:hidden;  overflow-y:hidden;" >
									<div id="contents-tab">
									</div>
									<hr/>
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
            <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of Approval Templates</h4>
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
								<th>Code</th>
								<th class='d-none'>Doc Entry</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody>
						<?php
							$itemno = 1;
							$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB2."]; SELECT DISTINCT
																						T0.Code, 
																						T0.DocEntry,
																						T0.Description
																						
																						FROM [@OAPT] T0
																						WHERE T0.Active = 'N'
																						ORDER BY T0.DocEntry ASC");
								while (odbc_fetch_row($qry)) 
								{
									echo '<tr class="">
												<td>'.$itemno.'</td>
												<td class="item-1">'.odbc_result($qry, 'Code').'</td>
												<td class="item-2 d-none">'.odbc_result($qry, 'DocEntry').'</td>
												<td class="item-3 " >'.odbc_result($qry, 'Description').'</td>
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
	<!-- Employee Modal -->
    <div class="modal fade" id="ApproverModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
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
            <table class="table table-striped table-bordered table-hover" id="tblApprover" style="width:100%">
						<thead>
							<tr>
								<th >#</th>
								<th>Employee Code</th>
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
												<td class="item-1 ">'.odbc_result($qry, 'EmpId').'</td>
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

<script src="../script/approval-template.js"></script>


<script>$('#tblApprover').dataTable({"bLengthChange": false,});</script>


<?php
	include '../../bottom.php' 
?>
