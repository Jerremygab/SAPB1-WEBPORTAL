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
          <div class="card shadow mb-4 "  id="windowmain" style="background-color:#E8E8E8 !important; border: none !important" >
		  <div class="row pr-0 "  width="100%">
			<div class="col-lg-12" id="containerSystem" style="margin-right: 0px !important; padding-right: 0px !important; "  >
            <div class="card-header py-0" style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6">
						<h5 class="mt-2 font-weight-bold " style="color: black;">Connected Clients</h5>
					</div>

				</div>
            </div>
            <div class="card-body " style="background-color: #F5F5F5">
			<form class="user responsive " id="salesOrder"  width="100%">
			<div class="col-lg-12 pb-2  "  width="100%" id="midCol">
				<div class="tab-content " id="myTabContent" style="padding-top: 50px;width:100%;margin-left:3in !important" >
					<div class="" id="" style="height:700px !important;width:1500px !important;overflow-y: scroll" >
<!-- ///////////////////////////////////////////////////////////////USER SIDE///////////////////////////////////////////////////////////////////////////////////////// -->
				 <table class="table table-striped table-bordered table-hover" id="tblConnected" style="width:100%;">
						<thead>
							<tr>
								<tr>
								<th >#</th>
								<th class="d-none">User ID</th>
								<th>User Code</th>
								<th>Name</th>
								<th>Super User</th>
							</tr>
							</tr>
						</thead>
						<tbody>
						<?php
							$no = 1;
							$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
													SELECT 
													T0.UserId,
													T0.UserCode,
													T0.Name,
													T0.EmpId,
													T0.SuperUser,
													CONCAT(T1.LastName, ', ', T1.FirstName, ' ', T1.MiddleName) AS Name
													
													
											FROM [".$MSSQL_DB2."].[dbo].[@OUSR] T0
											INNER JOIN OHEM T1 ON t1.EmpId = T0.EmpID
											
											WHERE T0.Active = '1'");
							while (odbc_fetch_row($qry)) 
							{
								echo '<tr class="srch">
												<td>'.$no.'</td>
												<td class="item-1 hidden">'.odbc_result($qry, 'UserId').'</td>
												<td class="item-2">'.odbc_result($qry, 'UserCode').'</td>
												<td class="item-4">'.odbc_result($qry, 'Name').'</td>
												<td class="item-5">'.odbc_result($qry, 'SuperUser').'</td>
									
										  </tr>';
								$no++;	  
							}
							odbc_free_result($qry);
						?>
						</tbody>
					</table>
				
	<!-- ///////////////////////////////////////////////////////////////CUSTOMER SIDE///////////////////////////////////////////////////////////////////////////////////////// -->
			</div>	
			
		</div>
		
		<div  id="footerButtons" class="form-group row  mt-5 ">
					<div class="col-lg-6 col-md-6 col-sm-6 text-left">
						<button type="button" id="btnDisconnect" class="  btn btn-warning btn-rounded " style="color: black; font-weight: bold; width:250px; background: linear-gradient(to bottom, #FCF6BA, #BF953F);" >Disconnect</button>
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
  
  
	
	

<script src="../script/connected-clients.js"></script>
<script src="../script/udf.js"></script>

<script>$('tblDoc').dataTable({searching: false, paging: false, info: false});</script>

<?php
	include '../../bottom.php' 
?>
