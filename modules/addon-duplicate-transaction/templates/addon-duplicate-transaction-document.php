<?php

	include '../../head.php' ;

?>

  <!-- Page Wrapper -->
  <div id="wrapper">
	<?php
	include '../../sidebar.php';
	
	$EmpId = $_SESSION['SESS_EMP'];
	$UserId = $_SESSION['SESS_USERID'];
	$UserCode = $_SESSION['SESS_USERCODE'];
	$UserName = $_SESSION['SESS_NAME'];
	?>

<?php
	$ARInvoiceArr = array(
		"cardType" => "C",
		"taxCodeCategory" => "O",
		"mainFileName" => "addon-duplicate-transaction",
		"objectTableName" => "",
		"objectTable" => "OINV",
		"objectType" => 13,
		"childTable1" => "INV1",
		"childTable12" => "INV12",
		"childTable21" => "INV21",
		"copyFromArr" => array(
			array(
				"baseTableName" => "",
				"baseTable" => "OQUT",
				"baseChildTable1" => "QUT1",
				"baseType" => 23,
				"copyFromModal" => '',
				"copyFromModalTbl" => 'SQ'
			),
			array(
				"baseTableName" => "",
				"baseTable" => "ORDR",
				"baseChildTable1" => "RDR1",
				"baseType" => 17,
				"copyFromModal" => '',
				"copyFromModalTbl" => 'SO'
			),
			array(
				"baseTableName" => "",
				"baseTable" => "ODLN",
				"baseChildTable1" => "DLN1",
				"baseType" => 15,
				"copyFromModal" => '',
				"copyFromModalTbl" => 'DR'
			)
		)
	);

	$_SESSION['ARInvoiceArr'] = json_encode($ARInvoiceArr);

	$_SESSION['cardType'] = $ARInvoiceArr['cardType'];
	$_SESSION['mainFileName'] = $ARInvoiceArr['mainFileName'];
	$_SESSION['objectTableName'] = $ARInvoiceArr['objectTableName'];
	$_SESSION['objectTable'] = $ARInvoiceArr['objectTable'];
	$_SESSION['objectType'] = $ARInvoiceArr['objectType'];
?>

	<script type="text/javascript">
		let obj = JSON.parse('<?php echo $_SESSION['ARInvoiceArr']; ?>');

		sessionStorage.clear();

		sessionStorage.setItem('SAPDateFormat', '<?php echo $_SESSION['SAPDateFormat']; ?>');
		sessionStorage.setItem('mainFileName', obj.mainFileName);
		sessionStorage.setItem('objectTable', obj.objectTable);
		sessionStorage.setItem('objectTableName', obj.objectTableName);
		sessionStorage.setItem('objectType', obj.objectType);
		sessionStorage.setItem('childTable1', obj.childTable1);
		sessionStorage.setItem('childTable12', obj.childTable12);
		sessionStorage.setItem('childTable21', obj.childTable21);
		sessionStorage.setItem('copyFromArr', JSON.stringify(obj.copyFromArr));
		sessionStorage.setItem('objectTablesArr', '<?php echo $_SESSION['objectTablesArr']; ?>');
	</script>	
	

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
			<div class="col-lg-12" id="containerSystem" style="margin-right: 0px !important; padding-right: 0px !important; "  >
            <div class="card-header py-0" style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6">
					<h5 class="mt-2 font-weight-bold " style="color: black;">Duplicate Transaction Cancellation</h5>
					</div>

				</div>
            </div>
			<div class="card-body " id="window" style="background-color: #F5F5F5; border-right: 1px solid #A0A0A0">
			<form class="user responsive " id="form"  width="100%">
				<div class="row pr-0 "  width="100%">
				<div class="col-lg-4 pb-2" id="bpCol">
					<div class="form-group row py-0 my-0" >
						<div class="col-sm-3" >
						<label for="inputEmail3" class=" col-form-label " style="color: black;" >Module</label>
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
										<button id="btnCardCode" class="btn btnGroup" type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#bpModal" data-backdrop="false" >
											<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue "></i>
										</button>
									</div>
								</div>
							</div>
					</div>	 
					<br>
					<br>
						
					</div>	
					<div class="col-lg-4 pb-2  "  width="100%" id="midCol">
						
					</div>
					<div class="col-lg-4 pb-2 " id="dateCol">
						
					</div>
				</div>
          
	
	<ul class="nav nav-tabs pt-2" id="myTab" role="tablist">
  <li class="nav-item ">
    <a class="nav-link active " id="" data-toggle="tab" href="#contents" role="tab" aria-controls="contents"
      aria-selected="true" style="color: black; font-weight:bold">Contents</a>
  </li>
 
</ul>

<div class="tab-content" id="myTabContent" style="padding-top: 10px;">
	<div class="tab-pane fade show active" id="contents" role="tabpanel" aria-labelledby="contents">
	<div class="form-group row  mb-0" >
	</div>
		<div id="contentContainer"class="table-responsive" style="width:100%; padding-bottom:20px; padding-left:10px;  overflow-x:hidden;  overflow-y:hidden;" >
			<div id="contents-tab">
			</div>
			<hr/>
		</div>
		
	</div>
</div>
				
				<div  id="footerButtons" class="form-group row  mt-5 ">
					<div class="col-lg-6 col-md-6 col-sm-6 text-left">
						<button type="button" id="btnAdd" class="  btn btn-warning btn-rounded " style="color: black; font-weight: bold; width:250px; background: linear-gradient(to bottom, #FCF6BA, #BF953F);" >Delete</button>
						<button type="button" id="btnUpdate" class="  btn btn-warning btn-rounded d-none" style="color:black; font-weight: bold; width:250px; background: linear-gradient(to bottom, #FCF6BA, #BF953F);" >Update</button>
						<button type="button" id="btnOk" class="  btn btn-warning btn-rounded d-none" style="color:black; font-weight: bold; width:250px; background: linear-gradient(to bottom, #FCF6BA, #BF953F);" >Ok</button>
						
						<button type="button" id="btnCancel" class=" btn btn-warning btn-rounded ml-5" style="color: black;width:250px; font-weight: bold; background: linear-gradient(to bottom, #FCF6BA, #BF953F);">Cancel</button>
					</div>
					
					
				</div>
            </form>

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
	
  <!-- Business Partner Modal -->
  <div class="modal fade" id="bpModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-dialog modal-xl" role="document" style="width:100%">
        <!--Content-->
        <div class="modal-content-full-width modal-content">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
            <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of Modules</h4>
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
								<th>Category</th>
								<th>Module</th>
								
							</tr>
						</thead>
						<tbody>
					
								<tr class="tableHover">
									<td>1</td>
									<td class="item-1">Financials</td>
									<td class="item-2">Journal Entry</td>
								</tr>
								<tr class="tableHover">
									<td>2</td>
									<td class="item-1">Sales</td>
									<td class="item-2">Sales Quotation</td>
								</tr>
								<tr class="tableHover">
									<td>3</td>
									<td class="item-1">Sales</td>
									<td class="item-2">Sales Order</td>
								</tr>
								<tr class="tableHover">
									<td>4</td>
									<td class="item-1">Sales</td>
									<td class="item-2">Delivery</td>
								</tr>
								<tr class="tableHover">
									<td>5</td>
									<td class="item-1">Sales</td>
									<td class="item-2">A/R Invoice</td>
								</tr>
								<tr class="tableHover">
									<td>6</td>
									<td class="item-1">Sales</td>
									<td class="item-2">A/R DP Request</td>
								</tr>
								<tr class="tableHover">
									<td>7</td>
									<td class="item-1">Sales</td>
									<td class="item-2">A/R DP Invoice</td>
								</tr>
								<tr class="tableHover">
									<td>8</td>
									<td class="item-1">Purchasing</td>
									<td class="item-2">Purchase Request</td>
								</tr>
								<tr class="tableHover">
									<td>9</td>
									<td class="item-1">Purchasing</td>
									<td class="item-2">Purchase Order</td>
								</tr>
								<tr class="tableHover">
									<td>10</td>
									<td class="item-1">Purchasing</td>
									<td class="item-2">Goods Receipt PO</td>
								</tr>
								<tr class="tableHover">
									<td>11</td>
									<td class="item-1">Purchasing</td>
									<td class="item-2">A/P Invoice</td>
								</tr>
								<tr class="tableHover">
									<td>12</td>
									<td class="item-1">Purchasing</td>
									<td class="item-2">A/P DP Request</td>
								</tr>
								<tr class="tableHover">
									<td>13</td>
									<td class="item-1">Purchasing</td>
									<td class="item-2">A/P DP Invoice</td>
								</tr>	
								
						</tbody>
					</table>
          </div>
          <!--Footer-->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!--Content-->
      </div>
    </div>
    <!-- Business Partner Modal -->


<script src="../script/<?php echo $_SESSION['mainFileName']; ?>.js"></script>

<script>$('#tblBP').dataTable({"bLengthChange": false});</script>

<?php
	include '../../bottom.php' 
?>
