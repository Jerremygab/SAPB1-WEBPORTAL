<?php

	include '../../head.php' ;

?>
<style>
	#myBar, #myBar2 {
  width: 1%;
  height: 30px;
  background-color: #04AA6D;
  text-align: center; /* To center it horizontally (if you want) */
  line-height: 30px; /* To center it vertically */
  color: white;
}

.body-custom{
  zoom: 0.7; /* Other non-webkit browsers */
  zoom: 70%; /* Webkit browsers */
}

</style>
  <!-- Page Wrapper -->
  <div id="wrapper">
	<?php
	include '../../sidebar.php';

	$EmpId = $_SESSION['SESS_EMP'];
	$UserId = $_SESSION['SESS_USERID'];
	$UserCode = $_SESSION['SESS_USERCODE'];
	$UserName = $_SESSION['SESS_NAME'];
	$Theme = $_SESSION['SESS_THEME'];
	$hidden = '';
	$hidden2 = '';

	?>
	

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column body-custom">
    	<h1 class="h3 mb-0 text-gray-800 d-none" id="theme"><?php echo  $Theme ?></h1>
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
							<h5 class="mt-2 font-weight-bold " style="color: black;">PCTP Uploader <?php echo $_SESSION['MSSQL_DB'] ?></h5>
						</div>
					</div>
				</div>
		 <div class="card-body " id="window" style="background-color: #F5F5F5; ">
		<form class="user responsive " id="form"  width="100%">
			<div class="row pr-0 pb-2"  width="100%">
				<div class="col-4">
					<div class="row">
						<div class="col-12">
							<div class="form-group row d-flex align-items-center py-0 my-0" >
								<div class="col-sm-2" >
									<label for="txtFiletoUpload" class=" col-form-label " style="color: black;" >File to Upload</label>
								</div>
								<div class="col-sm-9" >
									<div class="row">
										<div class="col-10">
											<div class="input-group mb-1">
												<input readonly type="text" id="txtFiletoUpload"  class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1 " style="border-bottom-left-radius:5px; border-top-left-radius:5px;">
												<input readonly type="file" id="txtFile1"  class="form-control d-none" placeholder="" aria-label="Username" aria-describedby="basic-addon1 " style="border-bottom-left-radius:5px; border-top-left-radius:5px;">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-4 ml-auto d-none">
					<div class="row">
						<div class="col-12">
							<div class="form-group row d-flex align-items-center py-0 my-0" >
								<div class="col-12">
									<div class="row">
										<div class="col-2">
											<label for="txtFileReportValidation" class="col-form-label " style="color: black;" >File Validation</label>
										</div>
										<div class="col-10">
											<div class="row">
												<div class="col-9">
													<div class="input-group mb-1">
														<input readonly type="text" id="txtFileReportValidation" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1 " style="border-bottom-left-radius:5px; border-top-left-radius:5px; text-align: center;">
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							
							</div>
						</div>
					</div>
				</div>

				<div class="col-3 ml-auto">
					<div class="row form-group justify-content-center">
						<div class="col-5">
							<button type="button" id="btnBrowse" class="  btn btn-warning btn-rounded " style="color: black; font-weight: bold; width:100%; background: linear-gradient(to bottom, #FCF6BA, #BF953F);">Browse</button>
							<input class="d-none" type="file" id="chooseFile" name="files[]" accept=".csv">
						</div>
						<div class="col-5">
							<button type="button" id="btnUpload3" class="  btn btn-warning btn-rounded " style="color: black; font-weight: bold; width:100%; background: linear-gradient(to bottom, #FCF6BA, #BF953F);" disabled>Upload</button>
						</div>
					</div>
				</div>
				<div class="col-12 ml-auto">
					<h6 style="color: black; font-weight: bold;">Legends:</h6>
				</div>
				<div class="col-3 ml-auto">
					
					<span style="color: black; font-weight:bold"><i class="fa fa-exclamation-triangle text-danger"  style="color: #BF40BF;font-size: 30px !important" aria-hidden="true"></i>&nbsp;Input Value - Required Field! &nbsp;&nbsp;</span><span id="requiredErrors"  style="color: #BF40BF;font-size: 30px !important"></span><br/>
					<span style="color: black; font-weight:bold"><i class="fa fa-exclamation-triangle "  style="color: #964B00 ;font-size: 30px !important" aria-hidden="true"></i>&nbsp;Invalid Value! &nbsp;&nbsp;</span><span id="invalidValue"  style="color: #BF40BF;font-size: 30px !important"></span><br/>
					<span style="color: black; font-weight:bold"><i class="fa fa-exclamation-triangle text-warning"  style="color: #FF00FF;font-size: 30px !important" aria-hidden="true"></i>&nbsp;Invalid Date Format, must be MM/DD/YYYY! &nbsp;&nbsp;</span><span id="invalidDate"  style="color: #BF40BF;font-size: 30px !important"></span><br/>
				</div>
				<div class="col-3 ml-auto">
					<span style="color: black; font-weight:bold"><i class="fa fa-exclamation-triangle text-primary"  style="font-size: 30px !important" aria-hidden="true"></i>&nbsp;Existing In Item Master Data! &nbsp;&nbsp;</span><span id="existingBookingNumber"  style="color: #BF40BF;font-size: 30px !important"></span><br/>
					<span style="color: black; font-weight:bold"><i class="fa fa-exclamation-triangle text-secondary"  style="font-size: 30px !important" aria-hidden="true"></i>&nbsp;Existing In POD! &nbsp;&nbsp;</span><span id="podPostedInPODCount"  style="color: #BF40BF;font-size: 30px !important"></span><br/>
					<span style="color: black; font-weight:bold"><i class="fa fa-exclamation-triangle duplicate"  style="font-size: 30px !important; color:black" aria-hidden="true"></i>&nbsp;Duplicate Booking Number! &nbsp;&nbsp;</span><span id="duplicateErrors"  style="color: #BF40BF;font-size: 30px !important"></span><br/>

				</div>
				<div class="col-3 ml-auto">
					
				</div>
				<div class="col-3 ml-auto">
				</div>
				<div class="col-12 ml-auto my-3 text-center">
					<span class="col-2 " style="color: black; font-weight:bold; font-size: 40px; border-right: 1px solid black;">ITEM
						<span id="" class="text-success" style="font-size: 20px ">
							<div class="spinner-border text-primary itemloading mb-2 d-none" role="status">
							  <span class="sr-only">Loading...</span>
							</div>
							<span class="itemcheck d-none" style="font-size: 30px "><i class="fa fa-check"  ></i></span>
							<span class="itemsuploaded " style="font-size: 30px ">0</span> /
							<span class="itemsoverall " style="font-size: 30px ">0</span>
						</span>
					</span>
					<span class="col-2 " style="color: black; font-weight:bold; font-size: 40px; border-right: 1px solid black;">POD
						<span id="" class="text-success" style="font-size: 20px ">
							<div class="spinner-border text-primary podloading mb-2 d-none" role="status">
							  <span class="sr-only">Loading...</span>
							</div>
							<span class="podcheck d-none" style="font-size: 30px "><i class="fa fa-check"  ></i></span>
							<span class="poduploaded " style="font-size: 30px ">0</span> /
							<span class="podoverall " style="font-size: 30px ">0</span>
						</span>
					</span>
					<span class="col-2 " style="color: black; font-weight:bold; font-size: 40px; ">COUNT
						<span id="" class="text-success" style="font-size: 20px ">
							<div class="spinner-border text-primary countloading mb-2 d-none" role="status">
							  <span class="sr-only">Loading...</span>
							</div>
							<span class="countcheck d-none" style="font-size: 30px "><i class="fa fa-check"  ></i></span>
							<span class="countuploaded " style="font-size: 30px ">0</span> /
							<span class="countoverall " style="font-size: 30px ">0</span>
						</span>
					</span>
				</div>
				<div class="col-12 ml-auto text-center">
					<span id="collectingrows" class="d-none" style="color: black; font-weight:bold; font-size: 30px ">Posting rows...</span>
					<span id="collectedrows" class="d-none" style="color: black; font-weight:bold; font-size: 30px ">Rows posted!</span>
					<div>
							<span id="postingSAP" class="d-none" style="color: black; font-weight:bold; font-size: 30px "></span>
							<div class="spinner-border text-primary sapposting mb-2 d-none" role="status">
									  <span class="sr-only">Loading...</span>
							</div>
							<span id="postedSAP" class="d-none" style="color: black; font-weight:bold; font-size: 30px "></span>
					</div>
					
				</div>

			</div>

	
			<ul class="nav nav-tabs pt-2 " id="myTab" role="tablist">
				 <li class="nav-item " style="">
			    <a class="nav-link active " id="" data-toggle="tab" href="#contents" role="tab" aria-controls="contents"
			      aria-selected="true" style="color: black; font-weight:bold">Contents</a>
			  </li>
			  <li class="nav-item d-none" style="">
			    <a class="nav-link " id="" data-toggle="tab" href="#pod" role="tab" aria-controls="pod"
			      aria-selected="true" style="color: black; font-weight:bold">POD</a>
			  </li>
			  <li class="nav-item d-none">
			    <a class="nav-link" id="" data-toggle="tab" href="#billing" role="tab" aria-controls="billing"
			      aria-selected="false" style="color: black; font-weight:bold">Billing</a>
			  </li>
			  <li class="nav-item d-none">
			    <a class="nav-link" id="" data-toggle="tab" href="#tp" role="tab" aria-controls="tp"
			      aria-selected="false"  style="color: black; font-weight:bold">TP</a>
			  </li>
			  <li class="nav-item d-none">
			    <a class="nav-link" id="" data-toggle="tab" href="#collection" role="tab" aria-controls="contact"
			      aria-selected="false"  style="color: black; font-weight:bold">Collection</a>
			  </li>
			  <li class="nav-item d-none">
			    <a class="nav-link" id="" data-toggle="tab" href="#pricing" role="tab" aria-controls="contact"
			      aria-selected="false"  style="color: black; font-weight:bold">Pricing</a>
			  </li>
			  <li class="nav-item d-none">
			    <a class="nav-link" id="" data-toggle="tab" href="#treasury" role="tab" aria-controls="contact"
			      aria-selected="false"  style="color: black; font-weight:bold">Treasury</a>
			  </li>
			 
			</ul>
				<div class="card-body " id="window" style="background-color: #F5F5F5; ">
						
						<div class="tab-content "  id="myTabContent" style="padding-top: 10px;">
							<div class="tab-pane fade show active" id="contents" role="tabpanel" aria-labelledby="contents">
								<div id="contentContainer"class="table-responsive" style="padding-bottom:20px; padding-left:10px; overflow-x:hidden;  ">
									<div id="contents-tab">
												
									</div>
									<hr/>
								</div>
							</div>
							<div class="tab-pane fade show d-none d-none" id="pod" role="tabpanel" aria-labelledby="pod">
								<div id="contentContainer"class="table-responsive" style="padding-bottom:20px; padding-left:10px; overflow-x:hidden;  ">
									<div id="pod-tab">
											
									</div>
									<hr/>
								</div>
							</div>
							<div class="tab-pane fade show d-none " id="billing" role="tabpanel" aria-labelledby="billing">
								<div id="contentContainer"class="table-responsive" style="padding-bottom:20px; padding-left:10px;">
									<div id="billing-tab">
										
									</div>
									<hr/>
								</div>
							</div>
							<div class="tab-pane fade show d-none " id="tp" role="tabpanel" aria-labelledby="tp">
								<div id="contentContainer"class="table-responsive" style="padding-bottom:20px; padding-left:10px;">
									<div id="tp-tab">
										
									</div>
									<hr/>
								</div>
							</div>
							<div class="tab-pane fade show d-none " id="collection" role="tabpanel" aria-labelledby="collection">
								<div id="contentContainer"class="table-responsive" style="padding-bottom:20px; padding-left:10px;">
									<div id="collection-tab">
										
									</div>
									<hr/>
								</div>
							</div>
							<div class="tab-pane fade show d-none " id="pricing" role="tabpanel" aria-labelledby="pricing">
								<div id="contentContainer"class="table-responsive" style="padding-bottom:20px; padding-left:10px;">
									<div id="pricing-tab">
										
									</div>
									<hr/>
								</div>
							</div>
							<div class="tab-pane fade show d-none " id="treasury" role="tabpanel" aria-labelledby="treasury">
								<div id="contentContainer"class="table-responsive" style="padding-bottom:20px; padding-left:10px;">
									<div id="treasury-tab">
										
									</div>
									<hr/>
								</div>
							</div>
						</div>

					
				    <!-- /.container-fluid -->
						<div  id="footerButtons" class="form-group row  mt-5 ">
							<div class="col-lg-6 col-md-6 col-sm-6 text-left">
								<button type="button" id="btnPost" class="btn btn-warning btn-rounded " style="color: black; font-weight: bold; width:250px; background: linear-gradient(to bottom, #FCF6BA, #BF953F);" >Post</button>
							</div>
						</div>
        
      	</div>
    	</form>
			</div>
		</div>
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
<!-- Create SO Modal-->
    <div class="modal fade " id="CreateSalesOrder" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false" style="margin-top: 300px !important;">
      <div class="modal-dialog modal-xl" role="document" style="width:100%">
        <!--Content-->
        <div class="modal-content-full-width modal-content">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e; ">
            <h4 class="modal-title w-100" id="myModalLabel" style="color:black; font-size:15px !important;">Notice!</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->
          <div class="modal-body">
          <h6 class="modal-title w-100" id="myModalLabel" style="color:black">Do you want to Create Sales Order?</h6>
          </div>
          <!--Footer-->
          <div class="modal-footer"  style="background-color: none !important;">
					<button id="btnCreateSalesOrder" type="button" class="btn btn-secondary" data-dismiss="modal">Yes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
          </div>
        </div>
        <!--/.Content-->
      </div>
    </div>
  <!-- Create SO Modal -->
   <!-- Create Billing Modal-->
    <div class="modal fade " id="CreateBilling" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false" style="margin-top: 300px !important;">
      <div class="modal-dialog modal-xl" role="document" style="width:100%">
        <!--Content-->
        <div class="modal-content-full-width modal-content">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e; ">
            <h4 class="modal-title w-100" id="myModalLabel" style="color:black; font-size:15px !important;">Notice!</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->
          <div class="modal-body">
          <h6 class="modal-title w-100" id="myModalLabel" style="color:black">Do you want to Create Billing?</h6>
          </div>
          <!--Footer-->
          <div class="modal-footer"  style="background-color: none !important;">
					<button id="btnCreateBilling" type="button" class="btn btn-secondary" data-dismiss="modal">Yes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
          </div>
        </div>
        <!--/.Content-->
      </div>
    </div>
  <!-- Create Billing Modal -->
  <!-- Create AR Modal-->
    <div class="modal fade " id="CreateARInvoice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false" style="margin-top: 300px !important;">
      <div class="modal-dialog modal-xl" role="document" style="width:100%">
        <!--Content-->
        <div class="modal-content-full-width modal-content">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e; ">
            <h4 class="modal-title w-100" id="myModalLabel" style="color:black; font-size:15px !important;">Notice!</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->
          <div class="modal-body">
          <h6 class="modal-title w-100" id="myModalLabel" style="color:black">Do you want to Create AR Invoice?</h6>
          </div>
          <!--Footer-->
          <div class="modal-footer"  style="background-color: none !important;">
					<button id="btnCreateARInvoice" type="button" class="btn btn-secondary" data-dismiss="modal">Yes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
          </div>
        </div>
        <!--/.Content-->
      </div>
    </div>
  <!-- Create AR Modal -->
    <!-- Create AR Modal-->
    <div class="modal fade " id="CreateAPInvoice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false" style="margin-top: 300px !important;">
      <div class="modal-dialog modal-xl" role="document" style="width:100%">
        <!--Content-->
        <div class="modal-content-full-width modal-content">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e; ">
            <h4 class="modal-title w-100" id="myModalLabel" style="color:black; font-size:15px !important;">Notice!</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->
          <div class="modal-body">
          <h6 class="modal-title w-100" id="myModalLabel" style="color:black">Do you want to Create AP Invoice?</h6>
          </div>
          <!--Footer-->
          <div class="modal-footer"  style="background-color: none !important;">
					<button id="btnCreateAPInvoice" type="button" class="btn btn-secondary" data-dismiss="modal">Yes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
          </div>
        </div>
        <!--/.Content-->
      </div>
    </div>
  <!-- Create AR Modal -->
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
<script src="../script/pctpuploader.js"></script>




<?php
	include '../../bottom.php' 
?>
