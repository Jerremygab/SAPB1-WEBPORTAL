

<footer id="footer" class="page-footer center-on-small-only py-2 mt-2 fixed-bottom  mx-auto border-top" style="background-color: white; border-top:black; width:100%; padding-bottom:0">
	<!--Copyright-->
	<div class="" >
	
		<div class="container-fluid text-center" >
			<div class="form-group row" style="margin-bottom:0px !important">
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
							<div id="progressDiv" class="col p-0 d-none" style="position: relative; margin: 0px 12px 0px 13px; background-color: lightgrey;">
								<div id="progressBar" style="z-index:-1; width: 0%; height: 20px; background-color: green;">
									<div class="row d-flex align-items-center text-center" style="z-index:100; position: absolute; font-weight: bold; color: white; width: 100%; height: 20px; background-color: transparent;">
										<h5 id="progressText" style="font-weight: bold; width: 100%; color: white; margin: auto;" ></h5>		
									</div>	
								</div>
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
						<img src="../../../img/sapb1logo.jpg" alt="SAP girl" width="150px" >
					</div>	
				</div>
			</div>
		</div>
	</div>
	<!--/.Copyright-->
</footer>




