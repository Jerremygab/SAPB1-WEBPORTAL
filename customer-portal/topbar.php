
 <!-- Topbar -->
        <nav class="navbar navbar-expand topbar mb-2  static-top  " style=" height: 10px !important">
		
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
	
				<div class="row d-none">
					<div class="col-lg-6">
						<button  id="sideBarToggle" class="btn mr-1 col-lg-1 " type="button" data-mdb-ripple-color="dark"  style="width: 100px; height: 40px !important;"  title="Toggle Side Menu">
							<i id="iconArrowRight" class="fas fa-angle-double-right input-prefix nav-icon d-none " tabindex=0 style="font-size: 25px !important;"></i>
							<i id="iconArrowLeft" class="fas fa-angle-double-left input-prefix nav-icon" tabindex=0 style="font-size: 25px !important;"></i>
						</button>
						<button  id="sideBarToggleOff" class="btn mr-1 col-lg-1 d-none" type="button" data-mdb-ripple-color="dark"  style=" width: 100px; height: 40px !important;"  >
							<i class="fas fa-angle-double-left input-prefix nav-icon" tabindex=0 style="font-size: 25px !important;"></i>
						</button>
					
						<button class="btn mr-1  col-lg-1" id="btnUDF" type="button" data-mdb-ripple-color="dark"  style="width: 100px; height: 40px !important; " title="User Defined Fields" >
							<i class="fas fa-chalkboard-teacher input-prefix nav-icon"  tabindex=0 style="font-size: 25px !important " ></i>
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
						<button class="btn mr-1 col-lg-1 btndisabled" id=""  type="button" data-mdb-ripple-color="dark"  style="width: 100px; height: 40px !important;  "  disabled>
						</button>
						<button class="btn mr-1 col-lg-1 btndisabled" id=""  type="button" data-mdb-ripple-color="dark"  style="width: 100px; height: 40px !important;  "  disabled>
						</button>
					</div>
					<div class="col-lg-6">
						<button class="btn mr-1 col-lg-1 btndisabled" id=""  type="button" data-mdb-ripple-color="dark"  style="width: 100px; height: 40px !important;  "  disabled>
						</button>
						<button class="btn mr-1 col-lg-1 btndisabled" id=""  type="button" data-mdb-ripple-color="dark"  style="width: 100px; height: 40px !important;  "  disabled>
						</button>
						<button class="btn mr-1 col-lg-1 btndisabled" id=""  type="button" data-mdb-ripple-color="dark"  style="width: 100px; height: 40px !important;  "  disabled>
						</button>
						<button class="btn mr-1 col-lg-1 btndisabled" id=""  type="button" data-mdb-ripple-color="dark"  style="width: 100px; height: 40px !important;  "  disabled>
						</button>
						<button class="btn mr-1 col-lg-1 btndisabled" id=""  type="button" data-mdb-ripple-color="dark"  style="width: 100px; height: 40px !important;  "  disabled>
						</button>
						<button class="btn mr-1 col-lg-1 btndisabled" id=""  type="button" data-mdb-ripple-color="dark"  style="width: 100px; height: 40px !important;  "  disabled>
						</button>
						<button class="btn mr-1 col-lg-1 btndisabled" id=""  type="button" data-mdb-ripple-color="dark"  style="width: 100px; height: 40px !important;  "  disabled>
						</button>
						<button class="btn mr-1 col-lg-1 btndisabled" id=""  type="button" data-mdb-ripple-color="dark"  style="width: 100px; height: 40px !important;  "  disabled>
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