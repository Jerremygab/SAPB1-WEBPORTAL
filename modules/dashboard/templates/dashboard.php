<?php
	include '../../head.php' 
?>

  <!-- Page Wrapper -->
  <div id="wrapper">
  <?php
	include '../../sidebar.php';
	$UserName = $_SESSION['SESS_NAME'];
	$UserCode = $_SESSION['SESS_USERCODE'];
	$UserPassword = $_SESSION['SESS_USERPASS'];
	$Active = $_SESSION['SESS_ACTIVE'];
  $Theme = $_SESSION['SESS_THEME'];
   ?>
 

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column" style="background-color: transparent;">

      <!-- Main Content -->
      <div id="content">

       <?php
		include '../../topbar.php'
	   ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
      			<h1 class="h3 mb-0 text-gray-800 d-none" id="usercode"><?php echo $UserCode ?></h1>
      			<h1 class="h3 mb-0 text-gray-800 d-none" id="userpassword"><?php echo $UserPassword ?></h1>
      			<h1 class="h3 mb-0 text-gray-800 d-none" id="active"><?php echo $Active ?></h1>
            <h1 class="h3 mb-0 text-gray-800 d-none" id="theme"><?php echo $Theme ?></h1>
            <h1 class="h3 mb-0 text-gray-800" >Welcome, <?php echo $UserName ?></h1>
          </div>

         

      
            <div>
              <center>
                     <img src="../../../img/jcbalogohd-modified.png" alt="JCBA Logo" width="1200px" height="1200px">
              </center>
             
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5 d-none">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Dropdown Header:</div>
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-pie pt-4 pb-2">
                    <canvas id="myPieChart"></canvas>
                  </div>
                  <div class="mt-4 text-center small">
                    <span class="mr-2">
                      <i class="fas fa-circle text-primary"></i> Direct
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-success"></i> Social
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-info"></i> Referral
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Content Row -->
          <div class="row d-none">

            <!-- Content Column -->
            <div class="col-lg-6 mb-4">

              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                </div>
                <div class="card-body">
                  <h4 class="small font-weight-bold">Server Migration <span class="float-right">20%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Sales Tracking <span class="float-right">40%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Customer Database <span class="float-right">60%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Payout Details <span class="float-right">80%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Account Setup <span class="float-right">Complete!</span></h4>
                  <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>

              <!-- Color System -->
              <div class="row">
                <div class="col-lg-6 mb-4">
                  <div class="card bg-primary text-white shadow">
                    <div class="card-body">
                      Primary
                      <div class="text-white-50 small">#4e73df</div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-4">
                  <div class="card bg-success text-white shadow">
                    <div class="card-body">
                      Success
                      <div class="text-white-50 small">#1cc88a</div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-4">
                  <div class="card bg-info text-white shadow">
                    <div class="card-body">
                      Info
                      <div class="text-white-50 small">#36b9cc</div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-4">
                  <div class="card bg-warning text-white shadow">
                    <div class="card-body">
                      Warning
                      <div class="text-white-50 small">#f6c23e</div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-4">
                  <div class="card bg-danger text-white shadow">
                    <div class="card-body">
                      Danger
                      <div class="text-white-50 small">#e74a3b</div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-4">
                  <div class="card bg-secondary text-white shadow">
                    <div class="card-body">
                      Secondary
                      <div class="text-white-50 small">#858796</div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-4">
                  <div class="card bg-light text-black shadow">
                    <div class="card-body">
                      Light
                      <div class="text-black-50 small">#f8f9fc</div>
                    </div>
                  </div>
              </div>
              <div class="col-lg-6 mb-4">
                <div class="card bg-dark text-white shadow">
                  <div class="card-body">
                      Dark
                      <div class="text-white-50 small">#5a5c69</div>
                  </div>
                </div>
              </div>
            </div>
           
            </div>

            <div class="col-lg-6 mb-4">

              <!-- Illustrations -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Illustrations</h6>
                </div>
                <div class="card-body">
                  <div class="text-center">
                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="img/undraw_posting_photo.svg" alt="">
                  </div>
                  <p>Add some quality, svg illustrations to your project courtesy of <a target="_blank" rel="nofollow" href="https://undraw.co/">unDraw</a>, a constantly updated collection of beautiful svg images that you can use completely free and without attribution!</p>
                  <a target="_blank" rel="nofollow" href="https://undraw.co/">Browse Illustrations on unDraw &rarr;</a>
                </div>
              </div>

              <!-- Approach -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Development Approach</h6>
                </div>
                <div class="card-body">
                  <p>SB Admin 2 makes extensive use of Bootstrap 4 utility classes in order to reduce CSS bloat and poor page performance. Custom CSS classes are used to create custom components and custom utility classes.</p>
                  <p class="mb-0">Before working with this theme, you should become familiar with the Bootstrap framework, especially the utility classes.</p>
                </div>
              </div>

            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white d-none">
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
            <button type="button" id="btnCancelLogout" class="btn btn-secondary" data-dismiss="modal">No</button>
          </div>
        </div>
        <!--/.Content-->
      </div>
    </div>
  <!-- Logout Modal -->
  
  <!-- Continue Modal-->
    <div class="modal fade " id="continueModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false" style="margin-top: 300px !important;">
      <div class="modal-dialog modal-xl" role="document" style="width:100%">
        <!--Content-->
        <div class="modal-content-full-width modal-content">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e; ">
            <h4 class="modal-title " id="myModalLabel" style="color:black; font-size:25px !important;">Session expired! Do you want to continue?</h4>
           
          </div>
          <!--Body-->
          <div class="modal-body">
			<img src="../../../img/session_timeout_warning.jpg" alt="TimeOut Cutie" width="250px" class="d-none">
          </div>
          <!--Footer-->
          <div class="modal-footer"  style="background-color: none !important;">
			<button id="btnContinueConfirm" type="" class="btn btn-secondary" data-dismiss="modal">Yes</button>
            <button type="button" id="btnNotContinueConfirm"class="btn btn-secondary" data-dismiss="modal">No</button>
          </div>
        </div>
        <!--/.Content-->
      </div>
    </div>
  <!-- Continue Modal --> 
  <!-- Disconnected Modal-->
    <div class="modal fade " id="disconnectedModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false" style="margin-top: 300px !important;">
      <div class="modal-dialog modal-xl" role="document" style="width:100%">
        <!--Content-->
        <div class="modal-content-full-width modal-content">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e; ">
            <h4 class="modal-title " id="myModalLabel" style="color:black; font-size:25px !important;">You have been disconnected!</h4>
           
          </div>
          <!--Body-->
          <div class="modal-body">
			<img src="../../../img/session_timeout_warning.jpg" alt="TimeOut Cutie" width="250px" class="d-none">
          </div>
          <!--Footer-->
          <div class="modal-footer" id="discButtons" style="background-color: none !important;">
			<button id="btnContinueConfirm" type="" class="btn btn-secondary" data-dismiss="modal">Yes</button>
            <button type="button" id="btnNotContinueConfirm"class="btn btn-secondary" data-dismiss="modal">No</button>
          </div>
        </div>
        <!--/.Content-->
      </div>
    </div>
  <!-- Disconnected Modal --> 



  <!-- Business Partner Modal -->
    <div class="modal fade" id="bpModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-dialog modal-xl" role="document" style="width:100%">
        <!--Content-->
        <div class="modal-content-full-width modal-content">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
            <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of Customers</h4>
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
                <th>Customer Code</th>
                <th>Customer Name</th>
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
                                            
                                            WHERE T0.CardType = 'C'
                                            
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
      <!-- Branch Modal -->
    <div class="modal fade" id="branchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-dialog modal-xl" role="document" style="width:100%">
        <!--Content-->
        <div class="modal-content-full-width modal-content">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
            <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of Branch</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->
          <div class="modal-body">
            <table class="tblBP table table-striped table-bordered table-hover" id="tblBranch" style="width: 100%">
            <thead>
              <tr>
                <th >#</th>
                <th>Branch ID</th>
                <th>Branch Code</th>
              </tr>
            </thead>
            <tbody>
            <?php
              $itemno = 1;
              $qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
                                            SELECT 

                                              T0.BPLId,
                                              T0.BPLName
                                            FROM OBPL T0

                                            ORDER BY T0.BPLId ASC");
                while (odbc_fetch_row($qry)) 
                {
                  echo '<tr class="tableHover">
                          <td>'.$itemno.'</td>
                          <td class="item-1">'.odbc_result($qry, 'BPLId').'</td>
                          <td class="item-3">'.odbc_result($qry, 'BPLName').'</td>
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
    <!-- Branch Modal -->
<script src="../script/home.js"></script>

    

<script>$('#tblSalesData').dataTable({
    "searching": false, "paging": false, "info": false,
    "pageLength" : 31,
    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
  });
$('#tblBP').dataTable();
$('#tblBranch').dataTable();

</script>

<?php
	include '../../bottom.php' 
?>

