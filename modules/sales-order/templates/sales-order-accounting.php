<?php
session_start();
include_once('../../../config/config.php');
?>
<div class="row">
<div class="col-lg-4" >
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
<div class="row" style="padding-top:80px">	
<div class="col-lg-12">
	<div class="form-group row py-0 my-0" >
						<div class="col-sm-3" >
						<label class=" col-form-label " style="color: black;" >Payment Terms</label>
						</div>
							<div class="col-sm-9" >
								<div class="input-group mb-1">
									<div class="input-group-prepend d-none" id="lnkCardCode" >
										<button  class="btn"  type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6;"  data-toggle="modal" data-target="#bpMasterModal" data-backdrop="false">
											<i class="fas fa-arrow-right  " style="color: #FFD700; font-size:20px"></i>
										</button>
									</div>
									<input readonly type="text" id="txtPaymentTermsCode" class="form-control d-none" placeholder="" aria-label="Username" aria-describedby="basic-addon1 " style="border-bottom-left-radius:5px; border-top-left-radius:5px;">
									<input readonly type="text" id="txtPaymentTermsName" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1 " style="border-bottom-left-radius:5px; border-top-left-radius:5px;">
									<div class="input-group-append">
										<button id="btnPaymentTerms" class="btn" type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#paymentTermsModal" data-backdrop="false" >
											<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue "></i>
										</button>
									</div>
								</div>
							</div>
						</div>	
</div>
</div>
</div>
<div class="col-lg-4" >
</div>
<div class="col-lg-4" >
<div class="row" style="padding-top:10px">
	<div class="col-lg-12">
<div class="form-group row  py-0 my-0" >
						<label class="col-sm-3 col-form-label " style="color: black;" >Cancellation Date</label>
							<div class="col-sm-9 input-group mb-1">
								<input type="date" id="txtCancellationDate" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1" value="<?php 
																																											
																																											$date=date_create(date('Y-m-d'));
																																											date_add($date,date_interval_create_from_date_string("1 month"));
																																											echo date_format($date,"Y-m-d");
																																											
																																										?>" min="2018-01-01" max="2050-12-31">
							</div>
						</div>		  
						
						<div class="form-group row  py-0 my-0" >
						<label class="col-sm-3 col-form-label " style="color: black;" >Required Date</label>
							<div class="col-sm-9 input-group mb-1">
								<input type="date" id="txtRequiredDate" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1"  value="<?php echo date('Y-m-d'); ?>" min="2018-01-01" max="2050-12-31">
							</div>
						</div>	
						
						<div class="form-group row  py-0 my-0" >
						<label class="col-sm-3 col-form-label " style="color: black;" >Federal Tax ID</label>
							<div class="col-sm-9 input-group mb-1">
								<input type="text" id="txtTinNumber" class="form-control" >
							</div>
						</div>	
						</div>
						</div>
</div>
</div>
