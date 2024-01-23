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
      <div id="content" style="background-color: white;">

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
                                    <h5 class="mt-2 font-weight-bold " style="color: black;">PTF Report</h5>
                                </div>

				                    </div>
                        </div>
                        <div class="card-body " id="window" style="background-color: #F5F5F5; border-right: 1px solid #A0A0A0">
                            <form class="user responsive " id="form"  width="100%">
                                <div class="form-group row my-1" >
                                
                                    <label for="inputEmail3" class="col-sm-1 col-form-label py-1 mt-2" style="color: black;" >PTF No:</label>
                                    <div class="col-sm-3" >
                                       <input type="text" class="form-control pod" id="U_PTFNo" placeholder="" >
                                    </div>
                                
                                </div>
                                <div class="form-group row my-1" >
                                
                                    <label for="inputEmail3" class="col-sm-1 col-form-label py-1 mt-2" style="color: black;" >PTF Year:</label>
                                    <div class="col-sm-3" >
                                       <input type="text" class="form-control pod" id="U_PTFYear" placeholder="" >
                                    </div>
                                
                                </div>
                                <div class="form-group row my-1" >
                                
                                    <label for="inputEmail3" class="col-sm-1 col-form-label py-1 mt-2" style="color: black;" >Date Forwarded:</label>
                                    <div class="col-sm-3" >
                                       <input type="date" id="U_DateForwardedBT" class="form-control "  value="<?php echo date('Y-m-d'); ?>" min="01-01-2018" max="12-31-2050" >
                                   </div>
                                
                                </div>
                                <div class="form-group row my-1" >
                                
                                    <label for="inputEmail3" class="col-sm-1 col-form-label py-1 mt-2" style="color: black;" >Prepared By:</label>
                                    <div class="col-sm-3" >
                                       <input type="text" class="form-control pod" id="U_PreparedBy" placeholder="" >
                                    </div>
                                
                                </div>
                                <div class="form-group row my-1" >
                                
                                    <label for="inputEmail3" class="col-sm-1 col-form-label py-1 mt-2" style="color: black;" >Forwarded By:</label>
                                    <div class="col-sm-3" >
                                       <input type="text" class="form-control pod" id="U_ForwardedBy" placeholder="" >
                                    </div>
                                
                                </div>
                                <div class="form-group row my-1" >
                                
                                    <label for="inputEmail3" class="col-sm-1 col-form-label py-1 mt-2" style="color: black;" >Received By:</label>
                                    <div class="col-sm-3" >
                                       <input type="text" class="form-control pod" id="U_ReceivedBy" placeholder="" >
                                    </div>
                                
                                </div>
                            </form>
                              <div  id="footerButtons" class="form-group row  mt-5 ">
                                <div class="col-lg-6 col-md-6 col-sm-6 text-left">
                                  <button type="button" id="btnPTFReportGenerate" class="  btn btn-warning btn-rounded " style="color: black; font-weight: bold; width:250px; background: linear-gradient(to bottom, #FCF6BA, #BF953F);" >Generate</button>
                                </div>
                                
                              </div>
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

  
<script src="../script/ptf.js"></script>
  

<?php
  include '../../bottom.php' ;

  ?>

<?php odbc_close($MSSQL_CONN); ?>
