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
          <div class="card shadow mb-4"  id="windowmain" style="background-color:#E8E8E8 !important; border: none !important" >
		   <div class="row pr-0 "  width="100%">
			<div class="col-lg-9" id="containerSystem" style="margin-right: 0px !important; padding-right: 0px !important; "  >
            <div class="card-header py-0" style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6">
						<h5 class="mt-2 font-weight-bold " style="color: black;">Inventory Transfer</h5>
					</div>
				</div>
            </div>
            <div class="card-body " id="window" style="background-color: #F5F5F5; border-right: 1px solid #A0A0A0">
			<form class="user responsive " id="salesOrder"  width="100%">
				<div class="row pr-0 "  width="100%">
				<div class="col-lg-4 pb-2" id="bpCol">
					<div class="form-group row py-0 my-0" >
						<div class="col-sm-3" >
						<label for="inputEmail3" class=" col-form-label " style="color: black;" >Business Partner</label>
						</div>
							<div class="col-sm-9" >
								<div class="input-group mb-1">
									<div class="input-group-prepend d-none" id="lnkCardCode" >
										<button  class="btn"  type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6;"  data-toggle="modal" data-target="#bpMasterModal" data-backdrop="false">
											<i class="fas fa-arrow-right  " style="color: #FFD700; font-size:20px"></i>
										</button>
									</div>
									<input readonly type="text" id="txtCardCode" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1 " style="border-bottom-left-radius:5px; border-top-left-radius:5px;">
									<div class="input-group-append">
										<button id="btnCardCode" class="btn" type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#bpModal" data-backdrop="false" >
											<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue "></i>
										</button>
									</div>
								</div>
							</div>
					</div>	 
						<div class="form-group row  py-0 my-0">
						<div class="col-sm-3" >
						<label for="inputEmail3" class=" col-form-label " style="color: black;" >Name</label>
						</div>
							<div class="col-sm-9" >
								  <div class=" mb-1">
								    <input  type="text" id="txtCardName" class="form-control" placeholder="" readonly>
									
									</div>
							</div>
						</div>	  
						<div class="form-group row  py-0 my-0" >
						<label for="inputEmail3" class="col-sm-3 col-form-label " style="color: black;" >Contact Person</label>
							<div class="col-sm-9 " >
							 <div class="input-group mb-1">
							
								<input type="text" class="form-control d-none" id="txtContactPersonCode" placeholder="" readonly style="border-bottom-left-radius:5px; border-top-left-radius:5px;">
							  <input type="text" class="form-control" id="txtContactPerson" placeholder="" readonly style="border-bottom-left-radius:5px; border-top-left-radius:5px; border-bottom-right-radius:5px; border-top-right-radius:5px;">
							  <div id="contactPersonBtn" class="input-group-append d-none">
										<button class="btn"   type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#contactPersonModal" data-backdrop="false">
											<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue "></i>
										</button>
									</div>
									</div>
							</div>
						</div>		
						<div class="form-group row  py-0 my-0">
						<label class="col-sm-3 col-form-label " style="color: black;" >Ship To</label>
						<div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
							<div class=" mb-1">
										<input type="text" class="form-control d-none" id="txtShipArr"  readonly>
										<input type="text" class="form-control d-none" id="txtShipArr2"   class="d-none" readonly>
										
										<select id="selShipToAddress" class="col-sm-12 form-control mdb-select md-form text-left"  style=" !important;outline:none; border-color: #D0D0D0;">
										</select>
							</div>
							<div class="">
								<textarea class="form-control " id="txtShipToAddressTextArea" style="height:150px;  resize: none;" readonly></textarea>
							</div>
							
						</div>
						</div>
						
					</div>	
					<div class="col-lg-4 pb-2  "  width="100%" id="midCol">
						
					</div>
					<div class="col-lg-4 pb-2 " id="dateCol">
						<div class="form-group row  py-0 my-0 mb-1" >
						<label for="inputEmail3" class="col-sm-2 col-form-label " style="color: black;" >No.</label>
							<div class="col-sm-4" >
								<select type="text" class="form-control " id="selSeries" placeholder=""    >
									
									<?php
										$itemno = 1;
										$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT DISTINCT
																								T0.SeriesName
																								
																								FROM NNM1 T0
																								WHERE T0.SeriesName = 'Primary' AND ObjectCode = 67
																								ORDER BY T0.SeriesName ASC");
										while (odbc_fetch_row($qry)) 
										{
											echo '<option class=" series" value='. odbc_result($qry, "SeriesName").'>'. odbc_result($qry, "SeriesName") .'</option>';
											$itemno++;	  
										}
										$itemno2 = 1;
										$qry1 = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT DISTINCT
																								T0.SeriesName
																								
																								FROM NNM1 T0
																								WHERE T0.SeriesName != 'Primary' AND ObjectCode = 67
																								ORDER BY T0.SeriesName ASC");
										while (odbc_fetch_row($qry1)) 
										{
											echo '<option class=" series" value='. odbc_result($qry1, "SeriesName").'>'. odbc_result($qry1, "SeriesName") .'</option>';
											$itemno2++;	  
										}
										$itemno3 = 1;
										$qry2 = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT DISTINCT
																								T0.SeriesName
																								
																								FROM NNM1 T0
																								WHERE T0.SeriesName = 'Manual' 
																								ORDER BY T0.SeriesName ASC");
										while (odbc_fetch_row($qry2)) 
										{
											echo '<option class=" series" value='. odbc_result($qry2, "SeriesName").'>'. odbc_result($qry2, "SeriesName") .'</option>';
											$itemno3++;	  
										}
										
										odbc_free_result($qry);
										odbc_free_result($qry1);
										odbc_free_result($qry2);
									?>
								</select>
							</div>
							<div class="col-sm-6" >
							  <input type="text" class="form-control " id="txtDocNum" placeholder="" 
							  value=<?php
											$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT 
																									MAX(T0.DocNum) + 1 AS NextDocNum
																								FROM OWTR T0
																											");
													while (odbc_fetch_row($qry)) 
													{
														echo odbc_result($qry, "NextDocNum");
														  
													}
								?> readonly >
							</div>
						</div>	 
						<div class="form-group row  py-0 my-0 mb-1" >
						<label for="inputEmail3" class="col-sm-5 col-form-label " style="color: black;" >Status</label>
							<div class="col-sm-1 " >
							</div>
							<div class="col-sm-6" >
							  <input type="email" class="form-control" id="txtStatus" placeholder=""  value="Open" readonly>
							</div>
						</div>	
						<div class="form-group row  py-0 my-0" >
						<label for="inputEmail3" class="col-sm-5 col-form-label " style="color: black;" >Posting Date</label>
							<div class="col-sm-1 " >
							</div>
							<div class="col-sm-6 input-group mb-1">
								<input type="date" id="txtPostingDate" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1" value="<?php echo date('Y-m-d'); ?>" min="2018-01-01" max="2050-12-31">
							</div>
						</div>		  
						
						<div class="form-group row  py-0 my-0  d-none" >
						<label for="inputEmail3" class="col-sm-5 col-form-label " style="color: black;" >Delivery Date</label>
							<div class="col-sm-1 " >
							</div>
							<div class="col-sm-6 input-group mb-1">
								<input type="date" id="txtDeliveryDate" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1" value="<?php echo date('Y-m-d'); ?>" min="2018-01-01" max="2050-12-31">
							</div>
						</div>	
						<div class="form-group row  py-0 my-0" >
						<label for="inputEmail3" class="col-sm-5 col-form-label " style="color: black; font-size:15px" >Document Date</label>
							<div class="col-sm-1 " >
							</div>
							<div class="col-sm-6 input-group mb-1">
								<input type="date"  id="txtDocumentDate" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1" value="<?php echo date('Y-m-d'); ?>" min="2018-01-01" max="2050-12-31">
							</div>
						</div>
						<div class="form-group row py-0 my-0 " >
						<div class="col-sm-5 mt-10" >
						<label for="inputEmail3" class=" col-form-label " style="color: black;" >From Warehouse</label>
						</div>
							<div class="col-sm-1 " >
							</div>
							<div class="col-sm-6" >
								<div class="input-group mb-1">
									<div class="input-group-prepend d-none" id="lnkCardCode" >
										<button  class="btn"  type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6;"  data-toggle="modal" data-target="#fromWhseMasterModal" data-backdrop="false">
											<i class="fas fa-arrow-right  " style="color: #FFD700; font-size:20px"></i>
										</button>
									</div>
									<input readonly type="text" id="txtFromWSHECode" class="form-control d-none" placeholder=""  style="border-bottom-left-radius:5px; border-top-left-radius:5px;">
									<input readonly type="text" id="txtFromWSHEName" class="form-control" placeholder=""  style="border-bottom-left-radius:5px; border-top-left-radius:5px;">
									<div class="input-group-append">
										<button id="btnFromWHSE" class="btn" type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#fromWhseModal" data-backdrop="false" >
											<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue "></i>
										</button>
									</div>
								</div>
							</div>
						</div>	 
						<div class="form-group row py-0 my-0" >
							<div class="col-sm-5" >
							<label for="inputEmail3" class=" col-form-label " style="color: black;" >To Warehouse</label>
							</div>
							<div class="col-sm-1 " >
							</div>
								<div class="col-sm-6" >
									<div class="input-group mb-1">
										<div class="input-group-prepend d-none" id="lnkCardCode" >
											<button  class="btn"  type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6;"  data-toggle="modal" data-target="#toWhseMasterModal" data-backdrop="false">
												<i class="fas fa-arrow-right  " style="color: #FFD700; font-size:20px"></i>
											</button>
										</div>
										<input readonly type="text" id="txtToWHSECode" class="form-control d-none" placeholder=""  style="border-bottom-left-radius:5px; border-top-left-radius:5px;">
										<input readonly type="text" id="txtToWHSEName" class="form-control" placeholder=""  style="border-bottom-left-radius:5px; border-top-left-radius:5px;">
										<div class="input-group-append">
											<button id="btnToWHSE" class="btn" type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#toWhseModal" data-backdrop="false" >
												<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue "></i>
											</button>
										</div>
									</div>
								</div>
						</div>	 
					</div>	
				</div>
          
	
	<ul class="nav nav-tabs pt-2" id="myTab" role="tablist">
  <li class="nav-item " style="">
    <a class="nav-link active " id="" data-toggle="tab" href="#contents" role="tab" aria-controls="contents"
      aria-selected="true" style="color: black; font-weight:bold">Contents</a>
  </li>
  <li class="nav-item d-none">
    <a class="nav-link" id="" data-toggle="tab" href="#logistics" role="tab" aria-controls="logistics"
      aria-selected="false" style="color: black; font-weight:bold">Logistics</a>
  </li>
  <li class="nav-item d-none">
    <a class="nav-link" id="" data-toggle="tab" href="#accounting" role="tab" aria-controls="contact"
      aria-selected="false"  style="color: black; font-weight:bold">Accounting</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="" data-toggle="tab" href="#attachments" role="tab" aria-controls="contact"
      aria-selected="false"  style="color: black; font-weight:bold">Attachments</a>
  </li>
</ul>

<div class="tab-content" id="myTabContent" style="padding-top: 10px;">
	<div class="tab-pane fade show active" id="contents" role="tabpanel" aria-labelledby="contents">
	<div class="form-group row  mb-0 d-none" >
		<div class="col-sm-4 row">
		<label for="inputEmail3" class="col-sm-4 col-form-label pr-0" style="color: black; font-size:15px" >Item/Service Type</label>
			<select id="selTransactionType" class="col-sm-3 form-control-sm mdb-select md-form text-left" searchable="Search here.." style=" !important;outline:none; border-color: #D0D0D0;">
				<option class="text-center" value="I" >Item</option>
				<option class="text-center" value="S" >Service</option>
				<input type="hidden" id="rowLoader" name="rowLoader" class="form-control input-sm">
			</select>
		</div>
	</div>
		<div id="contentContainer"class="table-responsive" style="width:100%; padding-bottom:20px; padding-left:10px; overflow-x:hidden;  overflow-y:hidden;" >
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
        <!-- /.container-fluid -->


				<div class="row pr-0 "  width="100%">
					<div class="col-lg-5 pb-2" >
						<div class="form-group row  py-0 my-0">
						<div class="col-sm-3" >
						<label for="inputEmail3" class=" col-form-label " style="color: black;" >Sales Employee</label>
						</div>
							<div class="col-sm-9" >
								  <div class="input-group mb-1">
									<input readonly type="text" id="txtSalesEmpCode" class="form-control d-none" placeholder="" aria-label="Username" aria-describedby="basic-addon1" value="1">
									<input readonly type="text" id="txtSalesEmpName" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1" style="border-bottom-left-radius:5px; border-top-left-radius:5px;" value="-No Sales Employee-">
									<div class="input-group-append">
										<button class="btn"   type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; hover:"  data-toggle="modal" data-target="#salesEmpModal" data-backdrop="false">
											<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue "></i>
										</button>
									</div>
									</div>
							</div>
						</div>	  
						<div class="form-group row  py-0 my-0 " >
						<label  class="col-sm-3 col-form-label " style="color: black;" >Owner</label>
							<div class="col-sm-9 " >
							<div class="input-group mb-1">
								<div class="input-group-prepend " id="lnkEmployee">
									<button class="btn" type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; hover:"  data-toggle="modal" data-target="#" data-backdrop="false">
										<i class="fas fa-arrow-right  " style="color: #FFD700; font-size:20px"></i>
									</button>
								</div>
							  <input readonly type="text" class="form-control d-none" id="txtOwnerCode" value="<?php echo $UserId?>">
							  <input readonly type="text" class="form-control " id="txtOwnerName" style="border-bottom-left-radius:5px; border-top-left-radius:5px;" value="<?php echo $UserName?>">
							  <div class="input-group-append">
										<button class="btn"   type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; hover:"  data-toggle="modal" data-target="#empModal" data-backdrop="false">
											<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue "></i>
										</button>
									</div>
							</div>
							</div>
						</div>	
						<div class="row" style="padding-top:10px">
							<div class="col-lg-12">
								<div class="form-group row py-0 my-0" >
									<div class="col-sm-3" >
										<label class=" col-form-label " style="color: black;" >Journal Memo</label>
									</div>
									<div class="col-sm-9" >
										<div class=" mb-1">
											<input readonly type="text" id="txtJournalMemo" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1 " style="border-bottom-left-radius:5px; border-top-left-radius:5px;">
										</div>
									</div>
								</div>	
							</div>
						</div>
					</div>	
			
					<div class="col-lg-3 pb-2  "  width="100%">
						
					</div>
					<div class="col-lg-4 pb-2 " >
						<div class="form-group row  py-0 my-0" >
							<label class="col-sm-3 col-form-label " style="color: black;" >Remarks</label>
							<div class="col-sm-9 " >
							  <textarea  type="text" class="form-control " id="txtRemarks" placeholder="" resize='false' maxlength="254"></textarea>	
							</div>
						</div>	
						<div class="form-group row  py-0 my-0 d-none" >
						<label for="inputEmail3" class="col-sm-4 col-form-label " style="color: black;" >Total Before Discount</label>
							<div class="col-sm-8 input-group mb-1">
								<input type="text" id="txtTotalBeforeDiscount" class="form-control text-right"  readonly value=0.00>
							</div>
						</div>		
						<div class="form-group row  py-0 my-0 mb-1 d-none" >
							<label for="inputEmail3" class="col-sm-2 col-form-label " style="color: black;" >Disc</label>
							<div class="col-sm-3" >
							  <input type="text" id="txtFooterDiscountPercentage" class="form-control text-right"  maxlength="15">
							</div>
							<label for="inputEmail3" class="col-sm-1 col-form-label " style="color: black;" >%</label>
							<div class="col-sm-6" >
							  <input type="text" id="txtFooterDiscountSum" class="form-control text-right" maxlength="7">
							</div>
						</div>
						<div class="form-group row  py-0 my-0 d-none" >
						<label for="inputEmail3" class="col-sm-4 col-form-label " style="color: black;" >Tax</label>
							<div class="col-sm-8 input-group mb-1">
								<input type="text" id="txtVatSum" class="form-control text-right" readonly value=0.00>
							</div>
						</div>	
						<div class="form-group row  py-0 my-0 d-none" >
						<label for="inputEmail3" class="col-sm-4 col-form-label " style="color: black;" >Total</label>
							<div class="col-sm-8 input-group mb-1">
								<input type="text" id="txtDocTotal" class="form-control text-right" readonly value=0.00>
							</div>
						</div>	
						
					</div>	
				</div>
				
				<div  id="footerButtons" class="form-group row  mt-5 ">
					<div class="col-lg-6 col-md-6 col-sm-6 text-left">
						<button type="button" id="btnAdd" class="  btn btn-warning btn-rounded " style="color: black; font-weight: bold; width:250px; background: linear-gradient(to bottom, #FCF6BA, #BF953F);" >Add</button>
						<button type="button" id="btnUpdate" class="  btn btn-warning btn-rounded d-none" style="color:black; font-weight: bold; black;width:250px; background: linear-gradient(to bottom, #FCF6BA, #BF953F);" >Update</button>
						<button type="button" id="btnCancel" class=" btn btn-warning btn-rounded ml-5" style="color: black;width:250px; font-weight: bold; background: linear-gradient(to bottom, #FCF6BA, #BF953F);">Cancel</button>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 text-right d-none">
								<span class="dropdown mr-5">
								<button type="button" id="btnCopyFrom" disabled="disabled" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle  btn btn-warning btn-rounded dropdown-toggle" style="color: black; font-weight: bold; width:250px; background: linear-gradient(to bottom, #FCF6BA, #BF953F);" >Copy From</button>			
								  <ul class="dropdown-menu " aria-labelledby="btnCopyFrom" style="color: black; font-weight: bold; width:250px; background-color: #fdfd96;">
									<li><button type="button" id="btnCopyFromITR" class="dropdown-item" style="color: black; font-weight: bold; font-size:15px;" data-toggle="modal" data-target="#inventoryTransferRequestModal" data-backdrop="false">Inventory Transfer Request</button></li>
								  </ul>
								</span>
					</div>
					
				</div>
            </form>

      </div>
      <!-- End of Main Content -->
	  </div>
	  <div class="col-lg-3 py-3"  id="containerUDF" style="background-color: #F5F5F5; ">
			<select type="text" class="form-control " id="selCurrency" placeholder=""   readonly >
				<option value='All'>All Categories</option>
			</select>
        <div class="card-body " >
		<div id="udfvalueloader" class="d-none"></div>
		<div class="form-group  px-0 mx-0" style="width:100% !important; overflow-y: scroll !important; overflow-x: hidden; height: 800px;" id="udfResult">
		
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
            <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of Inventory Transfer</h4>
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
								<th class='d-none'>Business Partner Code</th>
								<th>Business Partner Name</th>
								
								<th>From Warehouse</th>
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
																						T0.DocDate,
																						T0.Filler
																						
																							
																						FROM OWTR T0
																						
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
												<td class="item-5 " >'.odbc_result($qry, 'Filler').'</td>
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
	
	<!-- Copy From ITR Modal -->
    <div class="modal fade" id="inventoryTransferRequestModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-dialog modal-xl" role="document" style="width:100%">
        <!--Content-->
        <div class="modal-content-full-width modal-content">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
            <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of Inventory Transfer Request</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->
			<div class="modal-body">
				<div id="inventoryRequestResult"></div>
			</div>
          <!--Footer-->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!--/.Content-->
      </div>
    </div>
    <!-- Copy From ITR Modal -->
	
  <!-- Business Partner Modal -->
    <div class="modal fade" id="bpModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-dialog modal-xl" role="document" style="width:100%">
        <!--Content-->
        <div class="modal-content-full-width modal-content">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
            <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of Business Partners</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->
          <div class="modal-body">
            <table class="tblBP table table-striped table-bordered table-hover" id="tblBP" style="width: 100%">
						<thead>
							<tr>
								<th >#</th>
								<th>Vendor Code</th>
								<th>Vendor Name</th>
								<th>Balance</th>
								<th>Contact Person</th>
								<th class="d-none">Payment Terms Code</th>
								<th class="d-none">Payment Terms Name</th>
								<th class="d-none">Tin Number</th>
								<th class="d-none">Contact Person Code</th>
								<th class="d-none">Currency</th>
								
							</tr>
						</thead>
						<tbody>
						<?php
							$itemno = 1;
							$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT DISTINCT
																						T0.CardCode, 
																						T0.CardName,
																						T0.Balance,
																						T3.CntctCode,
																						T0.CntctPrsn,
																						T0.LicTradNum,
																						T0.GroupNum,
																						T0.Currency,
																						T2.PymntGroup
																						
																						
																						
																						FROM OCRD T0
																						INNER JOIN CRD1 T1 ON T0.CardCode = T1.CardCode 
																						INNER JOIN OCTG T2 ON T2.GroupNum = T0.GroupNum
																						LEFT JOIN OCPR T3 ON T3.Name = T0.CntctPrsn AND T0.CardCode = T3.CardCode 
																						
																						
																						
																						ORDER BY T0.CardCode ASC");
								while (odbc_fetch_row($qry)) 
								{
									echo '<tr class="tableHover">
												<td>'.$itemno.'</td>
												<td class="item-1">'.odbc_result($qry, 'CardCode').'</td>
												<td class="item-2">'.odbc_result($qry, 'CardName').'</td>
												<td class="item-3 text-right">'.number_format(odbc_result($qry, 'Balance'),2).'</td>
												<td class="item-4">'.odbc_result($qry, 'CntctPrsn').'</td>
												<td class="item-5 d-none">'.odbc_result($qry, 'GroupNum').'</td>
												<td class="item-6 d-none">'.odbc_result($qry, 'PymntGroup').'</td>
												<td class="item-7 d-none">'.odbc_result($qry, 'LicTradNum').'</td>
												<td class="item-8 d-none">'.odbc_result($qry, 'CntctCode').'</td>
												<td class="item-9 d-none">'.odbc_result($qry, 'Currency').'</td>
												
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
    <!-- Business Partner Modal -->
	
	<!-- From Warehouse Modal -->
    <div class="modal fade" id="fromWhseModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-dialog modal-xl" role="document" style="width:100%">
        <!--Content-->
        <div class="modal-content-full-width modal-content">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
            <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of Warehouse</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->
          <div class="modal-body">
            <table class="tblBP table table-striped table-bordered table-hover" id="tblFromWHSE" style="width: 100%">
						<thead>
							<tr>
								<th >#</th>
								<th>Warehouse Code</th>
								<th>Warehouse Name</th>
							
								
							</tr>
						</thead>
						<tbody>
						<?php
							$itemno = 1;
							$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT DISTINCT
																						T0.WhsCode, 
																						T0.WhsName
																						
																						FROM OWHS T0
																						
																						ORDER BY T0.WhsCode ASC");
								while (odbc_fetch_row($qry)) 
								{
									echo '<tr class="tableHover">
												<td>'.$itemno.'</td>
												<td class="item-1">'.odbc_result($qry, 'WhsCode').'</td>
												<td class="item-2">'.odbc_result($qry, 'WhsName').'</td>
												
												
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
    <!-- From Warehouse Modal -->
	
	<!-- To Warehouse Modal -->
    <div class="modal fade" id="toWhseModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-dialog modal-xl" role="document" style="width:100%">
        <!--Content-->
        <div class="modal-content-full-width modal-content">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
            <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of Warehouse</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->
          <div class="modal-body">
            <table class="tblBP table table-striped table-bordered table-hover" id="tblToWHSE" style="width: 100%">
						<thead>
							<tr>
								<th >#</th>
								<th>Warehouse Code</th>
								<th>Warehouse Name</th>
							
								
							</tr>
						</thead>
						<tbody>
						<?php
							$itemno = 1;
							$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT DISTINCT
																						T0.WhsCode, 
																						T0.WhsName
																						
																						FROM OWHS T0
																						
																						ORDER BY T0.WhsCode ASC");
								while (odbc_fetch_row($qry)) 
								{
									echo '<tr class="tableHover">
												<td>'.$itemno.'</td>
												<td class="item-1">'.odbc_result($qry, 'WhsCode').'</td>
												<td class="item-2">'.odbc_result($qry, 'WhsName').'</td>
												
												
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
    <!-- To Warehouse Modal -->
	
	<!-- From Warehouse Modal Row -->
    <div class="modal fade" id="fromWhseModalRow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-dialog modal-xl" role="document" style="width:100%">
        <!--Content-->
        <div class="modal-content-full-width modal-content">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
            <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of Warehouse</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->
          <div class="modal-body">
            <table class="tblBP table table-striped table-bordered table-hover" id="tblFromWHSERow" style="width: 100%">
						<thead>
							<tr>
								<th >#</th>
								<th>Warehouse Code</th>
								<th>Warehouse Name</th>
							
								
							</tr>
						</thead>
						<tbody>
						<?php
							$itemno = 1;
							$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT DISTINCT
																						T0.WhsCode, 
																						T0.WhsName
																						
																						FROM OWHS T0
																						
																						ORDER BY T0.WhsCode ASC");
								while (odbc_fetch_row($qry)) 
								{
									echo '<tr class="tableHover">
												<td>'.$itemno.'</td>
												<td class="item-1">'.odbc_result($qry, 'WhsCode').'</td>
												<td class="item-2">'.odbc_result($qry, 'WhsName').'</td>
												
												
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
    <!-- From Warehouse Modal Row  -->
	
	<!-- To Warehouse Modal Row -->
    <div class="modal fade" id="toWhseModalRow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-dialog modal-xl" role="document" style="width:100%">
        <!--Content-->
        <div class="modal-content-full-width modal-content">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
            <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of Warehouse</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->
          <div class="modal-body">
            <table class="tblBP table table-striped table-bordered table-hover" id="tblToWHSERow" style="width: 100%">
						<thead>
							<tr>
								<th >#</th>
								<th>Warehouse Code</th>
								<th>Warehouse Name</th>
							
								
							</tr>
						</thead>
						<tbody>
						<?php
							$itemno = 1;
							$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT DISTINCT
																						T0.WhsCode, 
																						T0.WhsName
																						
																						FROM OWHS T0
																						
																						ORDER BY T0.WhsCode ASC");
								while (odbc_fetch_row($qry)) 
								{
									echo '<tr class="tableHover">
												<td>'.$itemno.'</td>
												<td class="item-1">'.odbc_result($qry, 'WhsCode').'</td>
												<td class="item-2">'.odbc_result($qry, 'WhsName').'</td>
												
												
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
    <!-- To Warehouse Modal Row  -->
	
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
								<th>Item Code</th>
								<th>Item Name</th>
								<th>Foreign Name</th>
								<th>UoM Group</th>
								<th>Inventory UoM</th>
								<th class="d-none">Price</th>
								<th class="d-none">UoM Code</th>
								<th class="d-none">UoM Name</th>
								
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
																						T1.ItmsGrpNam,
																						CASE WHEN T2.Price = 0 THEN '' END AS Price,
																						T4.UgpCode, 
																						T4.UgpName
																						
																						
																							
																						FROM OITM T0
																						INNER JOIN OITB T1 ON T0.ItmsGrpCod = T1.ItmsGrpCod
																						INNER JOIN ITM1 T2 ON T2.ItemCode = T0.ItemCode
																						LEFT JOIN OPLN T3 ON T3.ListNum = T2.PriceList
																						INNER JOIN OUGP T4 ON T0.UgpEntry = T4.UgpEntry
																						
																						WHERE T0.InvntItem = 'Y'
																						
																						ORDER BY T0.ItemName ASC");
								while (odbc_fetch_row($qry)) 
								{
									echo '<tr class="">
												<td>'.$itemno.'</td>
												<td class="item-1">'.odbc_result($qry, 'ItemCode').'</td>
												<td class="item-2">'.odbc_result($qry, 'ItemName').'</td>
												<td class="item-3 " >'.odbc_result($qry, 'FrgnName').'</td>
												<td class="item-4 " >'.odbc_result($qry, 'ItmsGrpNam').'</td>
												<td class="item-5 " >'.odbc_result($qry, 'InvntryUom').'</td>
												<td class="item-6 hidden" >'.odbc_result($qry, 'Price').'</td>
												<td class="item-7 hidden" >'.odbc_result($qry, 'UgpCode').'</td>
												<td class="item-8 hidden" >'.odbc_result($qry, 'UgpName').'</td>
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
							<button class="btn" type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#stateModalS" data-backdrop="false">
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
							<button class="btn" type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#countryModalS" data-backdrop="false">
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
							<button class="btn" type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#stateModalB" data-backdrop="false">
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
							<button class="btn" type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#countryModalB" data-backdrop="false">
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
	
	<!-- Change From Warehouse Modal -->
    <div class="modal fade" id="changeFromWhseModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false" style="margin-top: 300px !important;">
      <div class="modal-dialog modal-xl" role="document" style="width:100%">
        <!--Content-->
        <div class="modal-content-full-width modal-content">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
            <h4 class="modal-title w-100" id="myModalLabel" style="color:black">Inventory Transfer</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->
          <div class="modal-body">
          <h6 class="modal-title w-100" id="myModalLabel" style="color:black">Do you want to update the existing table rows with the new warehouse?</h6>
          </div>
          <!--Footer-->
          <div class="modal-footer">
			<button id="btnChangeFromWhse" type="button" class="btn btn-secondary" data-dismiss="modal">Yes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
          </div>
        </div>
        <!--/.Content-->
      </div>
    </div>
	<!-- Change From Warehouse Modal -->
	
	<!-- Change To Warehouse Modal -->
    <div class="modal fade" id="changeToWhseModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false" style="margin-top: 300px !important;">
      <div class="modal-dialog modal-xl" role="document" style="width:100%">
        <!--Content-->
        <div class="modal-content-full-width modal-content">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
            <h4 class="modal-title w-100" id="myModalLabel" style="color:black">Inventory Transfer</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->
          <div class="modal-body">
          <h6 class="modal-title w-100" id="myModalLabel" style="color:black">Do you want to update the existing table rows with the new warehouse?</h6>
          </div>
          <!--Footer-->
          <div class="modal-footer">
			<button id="btnChangeToWhse" type="button" class="btn btn-secondary" data-dismiss="modal">Yes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
          </div>
        </div>
        <!--/.Content-->
      </div>
    </div>
	<!-- Change To Warehouse Modal -->

<script src="../script/inventory-transfer.js"></script>
<script src="../script/udf.js"></script>

<script>$('#tblItem').dataTable({"bLengthChange": false,});</script>
<script>$('#tblBP').dataTable({"bLengthChange": false});</script>
<script>$('#tblDoc').dataTable({"bLengthChange": false,});</script>
<script>$('#tblSalesEmployee').dataTable({"bLengthChange": false,});</script>
<script>$('#tblEmployee').dataTable({"bLengthChange": false,});</script>
<script>$('#tblPaymentTerms').dataTable({"bLengthChange": false,});</script>
<script>$('#tblCountry').dataTable({"bLengthChange": false,});</script>
<script>$('#tblStates').dataTable({"bLengthChange": false,});</script>
<script>$('#tblFromWHSE').dataTable({"bLengthChange": false,});</script>
<script>$('#tblToWHSE').dataTable({"bLengthChange": false,});</script>
<script>$('#tblFromWHSERow').dataTable({"bLengthChange": false,});</script>
<script>$('#tblToWHSERow').dataTable({"bLengthChange": false,});</script>

<script>$('#tblGL').dataTable({ 
			scrollY: 100,
            scrollX: true,
            scroller: true});
</script>

<?php
	include '../../bottom.php' 
?>
