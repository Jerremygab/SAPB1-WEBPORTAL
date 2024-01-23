<?php
	include '../../head.php' 
?>

  <!-- Page Wrapper -->
  <div id="wrapper">
  <?php
	include '../../sidebar.php';
	$UserCode = $_SESSION['SESS_USERCODE'];
	$UserName = $_SESSION['SESS_NAME'];
   ?>
 

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

       <?php
		include '../../topbar.php'
	   ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800" >Welcome, <?php echo $UserName ?></h1>
			<button class="btn " id="btnLogout"  type="button" data-mdb-ripple-color="dark"  style="width: 120px; height: 40px !important;  " title="Logout" >
							<div class="row">
								<i class="fas fa-sign-out-alt input-prefix nav-icon col-1 mr-1" tabindex=0 style="font-size: 25px !important "> </i>
								<h6 class="col-1 nav-icon" style="font-size: 20px !important ">Logout</h6>
							</div>
						</button>
          </div>
			
			
			
			<!-- Content Row -->
          <div class="row">

            <!-- Make Order -->
            <div class="col-xs-3 col-md-6 col-lg-2 mb-4" >
              <a class="btn card border-left-warning shadow h-100 py-3" id="makeOrder" style="background-color: #fff !important" >
                <div class="card-body " >
				  <div class="row text-left ">
                  <div class="col mr-2">
                      <div class=" font-weight-bold  text-uppercase " style="font-weight: bold; font-size: 20px !important; color: black">Make Order
					  </div>
                  </div>
				  <div class="col-auto">
                    <i class="fas fa-shopping-cart fa-2x    text-warning"></i>
                   </div>
					</div>
                </div>
              </a>
            </div>

             <!-- Invenory List -->
            <div class="col-xs-3 col-md-6 col-lg-2 mb-4" >
              <a class="btn card border-left-warning shadow h-100 py-3" id="inventoryList" style="background-color: #fff !important">
                <div class="card-body ">
				  <div class="row text-left ">
                  <div class="col mr-2">
                      <div class=" font-weight-bold  text-uppercase " style="font-weight: bold; font-size: 20px !important; color: black">Inventory List
					  </div>
                  </div>
				  <div class="col-auto">
                    <i class="fas fa-box fa-2x   text-warning"></i>
                   </div>
					</div>
                </div>
              </a>
            </div>
			
		</div>

          <!-- Content Row -->
		  
          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <a class="btn card border-left-warning shadow h-100 py-2" style="background-color: #fff !important" data-mdb-ripple-color="dark"  "  data-toggle="modal" data-target="#invoicesModal" data-backdrop="false">
                <div class="card-body">
                  <div class="row text-left align-items-center">
                    <div class="col mr-2">
                      <div class="text-md font-weight-bold text-uppercase mb-1" style="color: black !important">Account Balance</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800" style="color: black !important">PHP
						<?php
							
							$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT SUM(T0.DocTotal) AS 'AccountBalance'
																						FROM OINV T0 
																						WHERE T0.DocStatus = 'O' AND T0.CardCode = '$UserCode'
																					");
								while (odbc_fetch_row($qry)) 
								{
									echo number_format(odbc_result($qry, 'AccountBalance'),2); 
								}
								
								odbc_free_result($qry);
								?>
					  </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-warning"></i>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <a class="btn card border-left-warning shadow h-100 py-2" style="background-color: #fff !important">
                <div class="card-body">
                  <div class="row text-left align-items-center">
                    <div class="col mr-2">
                      <div class="text-md font-weight-bold text-uppercase mb-1" style="color: black !important">Order Balance</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800" style="color: black !important">PHP
						<?php
							
							$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT SUM(T0.DocTotal) AS 'AccountBalance'
																						FROM ORDR T0 
																						WHERE T0.DocStatus = 'O' AND T0.CardCode = '$UserCode'
																					");
								while (odbc_fetch_row($qry)) 
								{
									echo number_format(odbc_result($qry, 'AccountBalance'),2); 
								}
								
								odbc_free_result($qry);
								?>
					  </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-warning"></i>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>

          <!-- Content Row -->

          <div class="row">
            <!-- Area Chart -->
			 
            <div class="col-xl-12 col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
               <div class="card-header py-0"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
				<div class="row" id="window-header">
					<div class="col-lg-6 col-md-6 col-sm-6">
						<h5 class="mt-2 font-weight-bold " style="color: black;">Order History</h5>
					</div>
				</div>
				</div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                     <table class="table table-striped table-bordered table-hover" id="tblDoc" style="width:100%">
						<thead>
							<tr>
								<th style="min-width: 20px !important">#</th>
								<th>Document No.</th>
								<th class='d-none'>Doc Entry</th>
								<th class='d-none'>Doc Num Sys</th>
								<th>Document Date</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody>
						<?php
							$itemno = 1;
							$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT DISTINCT
																						T0.DocNum AS 'DocNumSys', 
																						T0.DocEntry,
																						
																						T0.DocDate, 
																						T0.Comments,
																						T0.DocTotal,
																						CASE WHEN 
																						T0.ObjType = 17 THEN CONCAT('SO#', T0.DocNum) END AS 'DocNumber'
																							
																						FROM ORDR T0
																						
																						WHERE T0.CardCode = '$UserCode'
																						
																						UNION ALL
																						
																				SELECT DISTINCT
																						T0.DocNum AS 'DocNumSys', 
																						T0.DocEntry,
																						
																						T0.DocDate, 
																						T0.Comments,
																						T0.DocTotal,
																						CASE WHEN 
																						T0.ObjType = 14 THEN CONCAT('RC#', T0.DocNum) END AS 'DocNumber'
																							
																						FROM ORIN T0
																						
																						
																						WHERE T0.CardCode = '$UserCode' 
																						
																						ORDER BY T0.DocDate DESC");
								while (odbc_fetch_row($qry)) 
								{
									echo '<tr class="">
												<td>'.$itemno.'</td>
												<td class="item-1">'.odbc_result($qry, 'DocNumber').'</td>
												<td class="item-2 d-none">'.odbc_result($qry, 'DocEntry').'</td>
												<td class="item-3 d-none">'.odbc_result($qry, 'DocNumSys').'</td>
												<td class="item-4 " >'.date("m/d/Y", strtotime(odbc_result($qry, 'DocDate'))).'</td>
												<td class="item-5 text-right" >'.number_format(odbc_result($qry, 'DocTotal'),2).'</td>
											  </tr>';
									$itemno++;	  
								}
								
								odbc_free_result($qry);
							

						?>
						</tbody>
					</table>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Content Row -->
          

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

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
   <div class="modal fade" id="salesOrderModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"   >
      <div class="modal-dialog" role="document" style="width:1500px !important; margin-right: 3000px !important; padding:0px !important" >
        <!--Content-->
        <div class=" modal-content"  style="width:2000px !important; margin-right: 3000px !important;  margin-left: 120px !important; padding:0px !important">
          <!--Header-->
          
          <!--Body-->
         
            <div id="salesOrder"  style="margin: 0px !important"></div>
          
          <!--Footer-->
          
        </div>
        <!--/.Content-->
      </div>
	   
    </div>
    <!-- Document Modal -->
    <div class="modal fade" id="invoicesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-dialog modal-xl" role="document" style="width:100%">
        <!--Content-->
        <div class="modal-content-full-width modal-content">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
            <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of Sales Invoice</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->
          <div class="modal-body">
            <table class="table table-striped table-bordered table-hover" id="tblDocInvoice" style="width:100%">
						<thead>
							<tr>
								<th >#</th>
								<th>Doc No.</th>
								<th class='d-none'>Doc Entry</th>
								<th>Posting Date</th>
								<th class='d-none'>Customer Code</th>
								<th >Customer Name</th>
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
																						
																							
																						FROM OINV T0
																						
																						WHERE T0.CardCode = '$UserCode'
																						
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
<script src="../script/home.js"></script>
<script>$('#tblDoc').dataTable({

"order": []});</script>
<script>$('#tblDocInvoice').dataTable({

"order": []});</script>
<script src="../script/sales-order-utilities.js"></script>

<script src="../script/udf.js"></script>
<script>$('#tblItem').dataTable({"bLengthChange": false,});</script>
<script>$('#tblBP').dataTable({"bLengthChange": false});</script>

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

<?php
	include '../../bottom.php' 
?>