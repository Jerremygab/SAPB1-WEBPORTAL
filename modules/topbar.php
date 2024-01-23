<?php 
		$UserId = $_SESSION['SESS_USERID'];
		$UserCode = $_SESSION['SESS_USERCODE'];
		$UserName = $_SESSION['SESS_NAME'];
		$Theme = $_SESSION['SESS_THEME'];
?>
 <!-- Topbar -->
        <nav class="navbar navbar-expand topbar mb-3 static-top  " style=" height: 40px !important; background-color:white">
		
		<div class="row d-none" id="topBarToggle">
			<div class="col-lg-12 mr-5">
				<div id="topBarCompanyName" class="sidebar-brand-text mx-3  " style="font-weight:bold; color: Black;">
								<?php 
									$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
											SELECT CompnyName FROM OADM");
													
									while (odbc_fetch_row($qry)) 
									{
										echo odbc_result($qry, 'CompnyName');
									}
									odbc_free_result($qry);
									
									?>
									<br/>
									<?php
									echo $_SESSION['SESS_SAPUSER']
									?>
				</div>
			</div>
		</div>
	
				<div class="row">
					<div class="col-lg-6">
						<button  id="sideBarToggle" class="btn mr-1 col-lg-1 " type="button" data-mdb-ripple-color="dark"  style="width: 100px; height: 40px !important;"  title="Toggle Side Menu">
							<i id="iconArrowRight" class="fas fa-angle-double-right input-prefix nav-icon d-none " tabindex=0 style="font-size: 25px !important;"></i>
							<i id="iconArrowLeft" class="fas fa-angle-double-left input-prefix nav-icon" tabindex=0 style="font-size: 25px !important;"></i>
						</button>
						<button  id="sideBarToggleOff" class="btn mr-1 col-lg-1 d-none" type="button" data-mdb-ripple-color="dark"  style=" width: 100px; height: 40px !important;"  >
							<i class="fas fa-angle-double-left input-prefix nav-icon" tabindex=0 style="font-size: 25px !important;"></i>
						</button>
					
					<!-- 	<button class="btn mr-1 col-lg-1" id="btnPrint"  type="button" data-mdb-ripple-color="dark"  style="width: 100px; height: 40px !important;  "  title="Print">
							<i class="fas fa-print input-prefix " tabindex=0 style="font-size: 25px !important; color:	#404040 !important"></i>
						</button> -->
							<button class="btn mr-1 col-lg-1" id="btnPrintChoices"  type="button" data-mdb-ripple-color="dark"  style="width: 100px; height: 40px !important;  "  data-toggle="modal" data-target="#layoutsModal" data-backdrop="false" title="Print">
							<i class="fas fa-print input-prefix " tabindex=0 style="font-size: 25px !important; color:	#404040 !important"></i>
						</button>
						<button class="btn mr-1  col-lg-1" id="btnUDF" type="button" data-mdb-ripple-color="dark"  style="width: 100px; height: 40px !important; " title="User Defined Fields" >
							<i class="fas fa-chalkboard-teacher input-prefix "  tabindex=0 style="font-size: 25px !important; color: #505050 !important" ></i>
						</button>
						<button class="btn mr-1  col-lg-1"   type="button" data-mdb-ripple-color="dark"  style="width: 100px; height: 40px !important; " data-toggle="modal" data-target="#documentModal" data-backdrop="false" title="Find Document">
							<i class="fas fa-binoculars input-prefix nav-icon"  tabindex=0 style="font-size: 25px !important " ></i>
						</button>
						<button class="btn mr-1  col-lg-1" id="btnNew" type="button" data-mdb-ripple-color="dark"  style="width: 100px; height: 40px !important;"  title="New Document">
							<i class="far fa-file-alt input-prefix nav-icon"  tabindex=0 style="font-size: 25px !important "></i>
						</button>
					
						<button class="btn mr-1  col-lg-1"  id="btnFirstRecord"  type="button" data-mdb-ripple-color="dark"  style="width: 100px; height: 40px !important; " title="First Record" >
							<i class="fas fa-grip-lines-vertical" style="color:green;font-size: 25px !important"></i><i class="fas fa-arrow-alt-circle-left input-prefix"  tabindex=0 style="color:green;font-size: 25px !important "></i>
						</button>
						<button class="btn mr-1  col-lg-1" id="btnPrevRecord" type="button" data-mdb-ripple-color="dark"  style="width: 100px; height: 40px !important; "  title="Previous Record">
							<i class="fas fa-arrow-alt-circle-left input-prefix"  tabindex=0 style="color:green;font-size: 25px !important "></i>
						</button>
						<button class="btn mr-1 col-lg-1" id="btnNextRecord" type="button" data-mdb-ripple-color="dark"  style="width: 100px; height: 40px !important;  "  title="Next Record">
							<i class="fas fa-arrow-alt-circle-right input-prefix"  tabindex=0 style="color:green;font-size: 25px !important "></i>
						</button>
						<button class="btn mr-1 col-lg-1" id="btnLastRecord"  type="button" data-mdb-ripple-color="dark"  style="width: 100px; height: 40px !important;  "  title="Last Record">
							<i class="fas fa-arrow-alt-circle-right input-prefix"  tabindex=0 style="color:green;font-size: 25px !important "></i><i class="fas fa-grip-lines-vertical" style="color:green;font-size: 25px !important"></i>
						</button>
						<button class="btn mr-1 col-lg-1" id="btnPreviewJournalEntry" disabled="disabled" type="button" data-mdb-ripple-color="dark"  style="width: 100px; height: 40px !important;  " data-toggle="modal" data-target="#journalEntryModal" data-backdrop="false"  title="Preview Journal Entry">
							<i class="fas fa-book input-prefix nav-icon" tabindex=0 style="font-size: 25px !important "  ></i>
						</button>
						
					</div>
					<div class="col-lg-6">
						<button class="btn mr-1 col-lg-1 " id="pop"  type="button" data-mdb-ripple-color="dark"  style="width: 100px; height: 40px !important;  "  >
							
						</button>
						<button class="btn mr-1 col-lg-1 " id="showSessionId"  type="button" data-mdb-ripple-color="dark"  style="width: 100px; height: 40px !important;  "  >
						
						</button>
						<button class="btn mr-1 col-lg-1 " id="showSessionLoop"  type="button" data-mdb-ripple-color="dark"  style="width: 100px; height: 40px !important;  "  >
					
						</button>
						<button class="btn mr-1 col-lg-1 btndisabled" id=""  type="button" data-mdb-ripple-color="dark"  style="width: 100px; height: 40px !important;  "  disabled>
						</button>
						<button class="btn mr-1 col-lg-1 btndisabled" id=""  type="button" data-mdb-ripple-color="dark"  style="width: 100px; height: 40px !important;  "  disabled>
						</button>
						<button class="btn mr-1 col-lg-1 btndisabled" id=""  type="button" data-mdb-ripple-color="dark"  style="width: 100px; height: 40px !important;  "  disabled>
						</button>
						<button class="btn mr-1 col-lg-1 btndisabled" id=""  type="button" data-mdb-ripple-color="dark"  style="width: 100px; height: 40px !important;  "  disabled>
						</button>
						<button class="btn mr-1 col-lg-1 btndisabled" id=""  type="button" data-mdb-ripple-color="dark"  style="width: 100px; height: 40px !important;  "  >
							<i class="fas fa-user-cog input-prefix nav-icon" data-toggle="modal" data-target="#userSettingsModal" data-backdrop="false" tabindex=0 style="font-size: 25px !important "  ></i>
						</button>
						
						<button class="btn col-lg-2" id="btnLogout"  type="button" data-mdb-ripple-color="dark"  style="width: 120px; height: 40px !important;  " title="Logout" >
							<div class="row">
								<i class="fas fa-sign-out-alt input-prefix nav-icon col-1 mr-1" tabindex=0 style="font-size: 25px !important "> </i>
								<h6 class="col-1 nav-icon" style="font-size: 20px !important ">Logout</h6>
							</div>
						</button>
					
					</div>
				</div>
        </nav>
        <!-- End of Topbar -->
		
		<!-- Journal Entry Modal -->
    <div class="modal fade" id="journalEntryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document" style="width:100%; ">
        <!--Content-->
        <div class="modal-content-full-width modal-content" style="height:1200px; width:1800px !important; margin-bottom:50px; ">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
            <h4 class="modal-title w-100" id="" style="color:black">Journal Entry</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->
          <div class="modal-body" style="overflow-x: hidden;overflow-y: hidden;">
		  <p  id="batchTitle" style="color:black; font-weight:bold"></p>
		 
			<div class="form-group row  py-0 my-0">
					<div class="col-sm-2" style="margin: 0px!important">
						<label for="inputEmail3" class=" col-form-label " style="color: black;" >Series</label>
						<div class="input-group mb-1">
							<input  type="text" id="txtSeries" class="form-control" placeholder="" readonly>
						</div>
					</div>
					<div class="col-sm-2" style="margin: 0px!important">
							<label for="inputEmail3" class=" col-form-label " style="color: black;" >Number</label>
							<div class="input-group mb-1">
								<input  type="text" id="txtNumber" class="form-control" placeholder="" readonly >
							</div>
					</div>
					<div class="col-sm-1" style="margin: 0px!important">
							<label for="inputEmail3" class=" col-form-label " style="color: black;" >Posting Date</label>
							<div class="input-group mb-1">
								<input  type="text" id="txtRefDate" class="form-control" placeholder="" readonly>
							</div>
					</div>
					<div class="col-sm-1" style="margin: 0px!important">
							<label for="inputEmail3" class=" col-form-label " style="color: black;" >Due Date</label>
							<div class="input-group mb-1">
								<input  type="text" id="txtDueDateJE" class="form-control" placeholder="" readonly>
							</div>
					</div>
					<div class="col-sm-1" style="margin: 0px!important">
							<label for="inputEmail3" class=" col-form-label " style="color: black;" >Doc. Date</label>
							<div class="input-group mb-1">
								<input  type="text" id="txtDocDateJE" class="form-control" placeholder="" readonly>
							</div>
					</div>
					<div class="col-sm-5" style="margin: 0px!important">
							<label for="inputEmail3" class=" col-form-label " style="color: black;" >Remarks</label>
							<div class="input-group mb-1">
								<input  type="text" id="txtMemo" class="form-control" placeholder="" readonly>
							</div>
					</div>
				
			</div>
			<div class="form-group row  py-0 my-0" >
					<div class="col-sm-1" style="margin: 0px!important">
						<label for="inputEmail3" class=" col-form-label " style="color: black;" >Origin</label>
						<div class="input-group mb-1">
							<input  type="text" id="txtOrigin" class="form-control" placeholder="" readonly>
						</div>
					</div>
					<div class="col-sm-1" style="margin: 0px!important">
						<label for="inputEmail3" class=" col-form-label " style="color: black;" >Origin No.</label>
						<div class="input-group mb-1">
							<input  type="text" id="txtOriginNo" class="form-control" placeholder="" readonly>
						</div>
					</div>
					<div class="col-sm-2" style="margin: 0px!important">
							<label for="inputEmail3" class=" col-form-label " style="color: black;" >Trans No.</label>
							<div class="input-group mb-1">
								<input  type="text" id="txtTransNo" class="form-control" placeholder="" readonly >
							</div>
					</div>
					
				
			</div>
			<div class="form-group row  py-0 my-0" style="margin-bottom: 20px !important">
					<div class="col-sm-2" style="margin: 0px!important">
						<label for="inputEmail3" class=" col-form-label " style="color: black;" >Ref 1</label>
						<div class="input-group mb-1">
							<input  type="text" id="txtRef1" class="form-control" placeholder="" readonly>
						</div>
					</div>
					<div class="col-sm-2" style="margin: 0px!important">
						<label for="inputEmail3" class=" col-form-label " style="color: black;" >Ref 2</label>
						<div class="input-group mb-1">
							<input  type="text" id="txtRef2" class="form-control" placeholder="" readonly>
						</div>
					</div>
					<div class="col-sm-2" style="margin: 0px!important">
							<label for="inputEmail3" class=" col-form-label " style="color: black;" >Ref 3</label>
							<div class="input-group mb-1">
								<input  type="text" id="txtRef3" class="form-control" placeholder="" readonly >
							</div>
					</div>
					
				
			</div>
			 <div id="" class="table-responsive mb-3" style="width:100%; padding-bottom:20px; padding-left:10px; overflow-x: hidden;" >
			<table class="table table-striped table-bordered table-hover" id="tblJE" style="width:100%; margin-top:100px !important">
				<thead>
					<tr>
						<th style="min-width=2% !important" class="text-right">#</th>
						<th style="min-width=12% !important">GL Account/ BP Code</th>
						<th style="min-width=12% !important">GL Account/ BP Name</th>
						<th style="min-width=12% !important">Control Acct</th>
						<th style="min-width=12% !important">Debit</th>
						<th style="min-width=12% !important">Credit</th>
						<th style="min-width=15% !important">Remarks Template</th>
					</tr>
				</thead>
				<tbody>
						
				</tbody>
			</table>
			</div>
			
          </div>
			
			
          <!--Footer-->
          <div class="modal-footer">
			<button type="button" id="btnUpdateBatch" class="btn btn-secondary d-none" >Update</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!--/.Content-->
      </div>
    </div>
    <!-- Journal Entry Modal -->


		<!-- User Settings Modal -->
    <div class="modal fade" id="userSettingsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document" style="width:100%; ">
        <!--Content-->
        <div class="modal-content-full-width modal-content" style="height:700px; width:800px !important; margin-bottom:50px; ">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
            <h4 class="modal-title w-100" id="" style="color:black">Style Settings</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->
          <div class="modal-body" style="overflow-x: hidden;overflow-y: hidden;">
		 				<p  id="txtUserName" style="color:black; font-weight:bold; font-size:20px">Username: <?php echo $UserName ?></p>
						 
							<div class="form-group row  py-0 my-0">
									<div class="col-lg-12 pb-2  "  width="100%" id="midCol">
										<div class="form-group row  py-0 my-0 mb-1" >
										<label for="inputEmail3" class="col-sm-2 col-form-label " style="color: black;" >Series</label>
											<div class="col-sm-4" >
												<select type="text" class="form-control " id="selSeries" placeholder=""    >
													
													<?php
														$itemno = 1;
														$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT DISTINCT
																												T0.SeriesName
																												
																												FROM NNM1 T0
																												WHERE T0.SeriesName = 'Primary' AND ObjectCode = 59
																												ORDER BY T0.SeriesName ASC");
														while (odbc_fetch_row($qry)) 
														{
															echo '<option class=" series" value='. odbc_result($qry, "SeriesName").'>'. odbc_result($qry, "SeriesName") .'</option>';
															$itemno++;	  
														}
														
														
														odbc_free_result($qry);
													?>
												</select>
											</div>
										
										</div>	
									</div>
							</div>
								
							</div>
		
			
         
			
          <!--Footer-->
          <div class="modal-footer">
						<button type="button" id="btnUpdateBatch" class="btn btn-secondary d-none" >Update</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!--/.Content-->
      </div>
    </div>
    
		<!-- User Settings Modal -->

		
		<!--Layouts Modal -->
    <div class="modal fade" id="layoutsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document" style="width:100%; ">
        <!--Content-->
        <div class="modal-content-full-width modal-content" style="height:400px; width:600px !important; margin-bottom:50px; ">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
            <h4 class="modal-title w-100" id="" style="color:black">Layouts</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->
          <div class="modal-body" style="overflow-x: hidden;overflow-y: hidden;">
		 	
							<div class="form-group row  py-0 my-0">
									<div class="col-lg-12 pb-2  "  width="100%" id="midCol">
										<div class="form-group row  py-0 my-0 mb-1" >
										<label for="inputEmail3" class="col-sm-2 col-form-label " style="color: black;" >Layouts</label>
											<div class="col-sm-4" >
												<select type="text" class="form-control " id="layoutOptions" placeholder=""    >
													
											<?php

											if($_SESSION['objectType'] == 13) {
	echo

	'<option class="series" value="Service_Invoice" id="ServiceInvoice">Service Invoice </option>
	<option class="series" value="Service_Invoice_Test_VATInc" id="ServiceInvoiceTest">SI = Vat Inc</option>
	<option class="series" value="Service_Invoice_Test_VATEx" id="ServiceInvoiceTest">SI = Vat Ex</option>

	<option class="series" value="Service_Invoice_Live_VATInc" id="ServiceInvoiceLive">LIVE SI = Vat Inc</option>
	<option class="series" value="Service_Invoice_Live_VATIncV2" id="ServiceInvoiceLiveV2">LIVE SI V2 = Vat Inc</option>
	<option class="series" value="Service_Invoice_Live_VATIncV3" id="ServiceInvoiceLiveV3">LIVE SI V3 = Vat Inc</option>
	<option class="series" value="Service_Invoice_Live_VATIncV4" id="ServiceInvoiceLiveV4">LIVE SI V4 = Vat Inc</option>

	<option class="series" value="Service_Invoice_Live_VATEx" id="ServiceInvoiceLive">LIVE SI = Vat Ex</option>

	<option class="series" value="Carrier1" id="Carrier1"> Carrier1 </option>
	<option class="series" value="Cola_Warehouse1" id="ColaWarehouse1"> Cola Warehouse1 </option>
	<option class="series" value="Default" id="Default"> Default </option>
	<option class="series" value="Enerlife" id="Enerlife"> Enerlife </option>
	<option class="series" value="Enerlife_Services_Label" id="EnerlifeServicesLabel"> Enerlife Services Label </option>
	<option class="series" value="FBH_ANCHOR" id="FBHANCHOR"> FBH Anchor </option>
	<option class="series" value="FBH_BOOMTRUCK" id="FBHBOOMTRUCK"> FBH Boomtruck </option>
	<option class="series" value="FBH_Container_Van" id="FBHContainerVan"> FBH Container Van </option>
	<option class="series" value="FBH_Fuel" id="FBHFuel"> FBH Fuel </option>
	<option class="series" value="FBH_Nearshore" id="FBHNearshore"> FBH Nearshore </option>
	<option class="series" value="FBH_Speedboat" id="FBHSpeedboat"> FBH Speedboat </option>
	<option class="series" value="FIBERHOME_DOMESTIC" id="FIBERHOMEDOMESTIC"> Fiberhome Domestic </option>
	<option class="series" value="FIBERHOME_DOMESTIC_V2" id="FIBERHOMEDOMESTIC_V2"> Fiberhome Domestic V2</option>
	<option class="series" value="Masuma" id="Masuma"> Masuma </option>
	<option class="series" value="UCCSatellite" id="UCCSatellite"> NFH-Import Services </option>
	<option class="series" value="FBH_Export" id="FBH_Export"> FBH Export </option>
	<option class="series" value="FMS1" id="FMS1"> FMS 1 </option>
	<option class="series" value="FMS2" id="FMS2"> FMS 2 </option>
	<option class="series" value="AP_Voucher" id="APVoucher"> AP Voucher </option>
	<option class="series" value="Payment_Voucher_TH" id="PaymentVoucherTH"> Payment Voucher TH </option>
	<option class="series" value="FBH_IMPORT_REIM_Label" id="FBHIMPORTREIMLabel"> FBH IMPORT Reim Label </option>
	<option class="series" value="FBH_IMPORT_Services_Label" id="FBHIMPORTServicesLabel"> FBH Import Services Label </option>
	<option class="series" value="FBH_Warehouse" id="FBHWarehouse"> FBH Warehouse </option>
	<option class="series" value="FMS" id="FMS"> FMS </option>
	<option class="series" value="I_ENG_REIM_LABEL" id="IENGREIMLABEL"> I ENG Reim Label </option>
	<option class="series" value="I_ENG_SERVICES_LABEL" id="IENGSERVICESLABEL"> I ENG Services Label </option>
	<option class="series" value="Nokia_Reim_Label" id="NokiaReimLabel"> Nokia Reim Label </option>
	<option class="series" value="Nokia_Services_Label" id="NokiaServicesLabel"> Nokia Services Label </option>
	<option class="series" value="P_G_LABEL" id="PGLABEL"> PG Label </option>
	<option class="series" value="STAR_PAPER" id="STARPAPER"> STAR PAPER </option>'
	; 
}else if($_SESSION['objectType'] == 18) {
	echo '<option class="series" value="AP_Form_Default" id="APFormDefault">AP Invoice</option>
		  <option class="series" value="AP_Form_Default_Live" id="APFormDefaultLive">AP Invoice Live</option>';


}


	
												
											?>

												</select>
											</div>
										 	<button type="button" id="btnPrint" class="  btn btn-warning btn-rounded " style="color: black; font-weight: bold; width:250px; background: linear-gradient(to bottom, #FCF6BA, #BF953F);" >Print</button>
										</div>	
									</div>
							</div>
								
							</div>
		
			
         
			
          <!--Footer-->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!--/.Content-->
      </div>
    </div>
    
    