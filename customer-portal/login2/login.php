<?php session_start(); 
$MSSQL_USER = 'sa';
$MSSQl_PASSWORD = 'P@ssw0rd1';
$MSSQL_SERVER = 'BENNIE';
$MSSQL_DB = 'SBO-COMMON';

$MSSQL_CONN = odbc_connect("Driver={SQL Server Native Client 11.0};Server=$MSSQL_SERVER;", $MSSQL_USER, $MSSQl_PASSWORD) or 
die('Could not open database!');

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SAP Business One | Login</title>

  <!-- Custom fonts for this template-->
  <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="" style=" -moz-transform: scale(0.7, 0.7); /* Moz-browsers */
    zoom: 0.7; /* Other non-webkit browsers */
    zoom: 70%; /* Webkit browsers */
">

		
		
	  <div class="container">

		<!-- Outer Row -->
		<div class="row justify-content-center">

		  <div class="col-xl-8 col-lg-8 col-md-8 " style="margin-top: 150px;">
			
			<div class="card o-hidden border border-primary shadow-lg m-10 ">
			  <div class="card-body " >
				<!-- Nested Row within Card Body -->
				<div class="row ">
				  <div class="col-lg-4 col-sm-5 d-flex align-items-center-cente justify-content-center">
					<img src="../../img/login.png" alt="SAP girl" width="250px">
				  </div>
					
				  <div class="col-lg-8 col-sm-7">
					<div class="px-0">
						<img src="../../img/sapb1logo.jpg" alt="SAP girl" width="200px" >
					</div>
					<div class="pt-5 px-5">
				
					  <!-- Default horizontal form -->
						<form onsubmit="return false">
						<!-- Grid row -->
						  <div class="form-group row">
							<!-- Default input -->
							<label for="inputEmail3" class="col-lg-5 col-md-12 col-sm-12 col-form-label">Company Name</label>
							<div class="col-lg-7 col-sm-12">
							  <select type="text" class="form-control " id="selCompany" placeholder=""   readonly >
									
									<?php
												$itemno = 1;
												$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT dbName, cmpName from SRGC");
													while (odbc_fetch_row($qry)) 
													{
														echo '<option class=" series" value='. odbc_result($qry, "dbName").'>'. odbc_result($qry, "cmpName") .'</option>';
														$itemno++;	  
													}
													
											?>
								</select>
							</div>
						  </div>
						  <!-- Grid row -->
						  <!-- Grid row -->
						  <div class="form-group row">
							<!-- Default input -->
							<label for="txtUserName" class="col-lg-5 col-md-12 col-sm-12 col-form-label">User ID</label>
							<div class="col-lg-7 col-sm-12">
							  <input type="text" class="form-control" id="txtUsername" name="txtUsername" placeholder="" required autocomplete="off">
							</div>
						  </div>
						  <!-- Grid row -->

						  <!-- Grid row -->
						  <div class="form-group row">
							<!-- Default input -->
							<label for="txtPassword" class="col-lg-5 col-md-12 col-sm-12 col-form-label">Password</label>
							<div class="col-lg-7 col-sm-12">
							  <input type="password" class="form-control" id="txtPassword" name="txtPassword" placeholder="" required autocomplete="off">
							</div>
						  </div>
						  <!-- Grid row -->
						
						  <div  class="form-group row  mt-5 ml-5 ">
							<button type="submit" id="btnLogin" class=" col-lg-4 col-sm-12 btn btn-warning btn-rounded  " style="color: black; background: linear-gradient(to bottom, #FCF6BA, #BF953F)" >Ok</button>
							<button type="button" id="btnExit" class="col-lg-4 col-sm-12 btn btn-warning btn-rounded ml-5" style="color: black; background: linear-gradient(to bottom, #FCF6BA, #BF953F)"  >Exit</button>
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

	  </div>
  

<footer id="footer" class="page-footer center-on-small-only py-2 mt-2 fixed-bottom  mx-auto border-top" style="background-color: white; border-top:black; width:100%; padding-bottom:0">
	<!--Copyright-->
	<div class="" >
	
		<div class="container-fluid text-center" >
			<div class="form-group row" >
				<div class="col-xl-10 col-lg-10 col-md-10 col-sm-0">
						<div class="row">
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
								<input type="text" class="form-control p-2" id="txtUserName" placeholder="" style="height: 20px" readonly>
							</div>
							<div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
							<?php 
								echo  date("m.d.Y");
							?>
							</div>
							<div  class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
								<input type="text" class="form-control p-2" id="txtUserName" placeholder="" style="height: 20px" readonly>
							</div>
							<div  class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
								<input type="text" class="form-control p-2" id="txtUserName" placeholder="" style="height: 20px" readonly>
							</div>
						</div>
						<div class="row"  >
							<div id="messageBar3" class="col-xl-12 col-lg-12 col-md-12 col-sm-12 d-none" > 
								<h5 id="messageBar"  >
									
								</h5>
							</div>
							<div  id="messageBar2" class="col-xl-12 col-lg-12 col-md-12 col-sm-12" >
								<div class="row d-none"  >
									<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 " >
									<input type="text"  class="form-control p-2"  placeholder="" style="height: 20px" readonly>
									
									</div>
								</div>
								<div class="row">
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 " >
									<input type="text"  class="form-control p-2"  placeholder="" style="height: 20px" readonly>
									
									</div>
									<div class="col-xl-2 col-lg-2 col-md-2 col-sm-2" >
									<?php 
										$h = date("h") + 7;
										echo date($h.":i:a");
									?>
									
									</div>
									<div  class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
										<input type="text" class="form-control p-2" id="txtUserName" placeholder="" style="height: 20px" readonly>
									</div>
									<div  class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
										<input type="text" class="form-control p-2" id="txtUserName" placeholder="" style="height: 20px" readonly>
									</div>
								</div>
							</div>
					
						</div>
					
				</div>
				<div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
					<div class="px-0">
						<img src="../../img/sapb1logo.jpg" alt="SAP girl" width="150px" >
					</div>	
				</div>
			</div>
		</div>
	</div>
	<!--/.Copyright-->
</footer>

 <!-- Bootstrap core JavaScript-->
  <script src="../../vendor/jquery/jquery.min.js"></script>
  <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../../js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="../../vendor/chart.js/Chart.min.js"></script>

 <!-- Own Scripts -->
  <script src="script/login.js"></script>

</body>

</html>

