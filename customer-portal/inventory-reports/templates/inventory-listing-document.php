<?php
	include '../../head.php' 
?>

  <!-- Page Wrapper -->
  <div id="wrapper">
  <?php
	include '../../sidebar.php';
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
             <h1 class="h3 mb-0 text-gray-800" >
				<span>	
					<button class="btn " id="btnBack"  type="button" data-mdb-ripple-color="dark"  style="width: 50px; height: 40px !important;  " title="Logout" >
						<div class="row">
							<i class="fa fa-home input-prefix nav-icon col-1 mr-1 " tabindex=0 style="font-size: 25px !important "> </i>
						</div>
					</button>
				</span>
				Welcome, <?php echo $UserName ?>
			</h1>
			<button class="btn " id="btnLogout"  type="button" data-mdb-ripple-color="dark"  style="width: 120px; height: 40px !important;  " title="Logout" >
							<div class="row">
								<i class="fas fa-sign-out-alt input-prefix nav-icon col-1 mr-1" tabindex=0 style="font-size: 25px !important "> </i>
								<h6 class="col-1 nav-icon" style="font-size: 20px !important ">Logout</h6>
							</div>
						</button>
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
						<h5 class="mt-2 font-weight-bold " style="color: black;">Inventory Listing</h5>
					</div>
				</div>
				</div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                     <table class="table table-striped table-bordered table-hover" id="tblDoc" style="width:100%">
						<thead>
							<tr>
								<th style="min-width: 10px !important">#</th>
								<th>Item Code</th>
								<th>Item Name</th>
								<th>Available</th>
							</tr>
						</thead>
						<tbody>
						<?php
							$itemno = 1;
							$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT DISTINCT 
																					T0.ItemCode, 
																					T0.ItemName, 
																					CASE 
																					WHEN T1.OnHand - T1.IsCommited  < 1 THEN 0
																					ELSE T1.OnHand - T1.IsCommited
																					END AS 'InStock'
																																			
																					FROM OITM T0
																					INNER JOIN OITW T1 ON T1.ItemCode = T0.ItemCode
																					
																					WHERE T0.FrozenFor = 'N' AND T0.SellItem = 'Y'");
								while (odbc_fetch_row($qry)) 
								{
									echo '<tr class="">
												<td>'.$itemno.'</td>
												<td class="item-1">'.odbc_result($qry, 'ItemCode').'</td>
												<td class="item-2">'.odbc_result($qry, 'ItemName').'</td>
												<td class="item-3 text-right" >'.number_format(odbc_result($qry, 'InStock'),2).'</td>
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
<script src="../script/inventory-listing.js"></script>
<script>$('#tblDoc').dataTable({

"order": []});</script>
<script src="../script/sales-order-utilities.js"></script>
<script src="../script/sales-order.js"></script>
<script src="../script/udf.js"></script>


<?php
	include '../../bottom.php' 
?>