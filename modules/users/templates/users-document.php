<?php

	include '../../head.php' ;




	// if(isset($_POST['submit'])) {
	// 	$target_dir = "/Users/Administrator/Desktop/JCBA/ATTACHMENTS/"; // directory where uploaded files will be saved
	// 	$target_file = $target_dir . basename($_FILES["getFile"]["name"]); // full path of uploaded file
	// 	$uploadOk = 1; // flag to indicate whether the file was uploaded successfully
		
	// 	// Check if file already exists
	// 	if (file_exists($target_file)) {
	// 		echo "Sorry, file already exists.";
	// 		$uploadOk = 0;
	// 	}
		
	// 	// Check file size
	// 	if ($_FILES["getFile"]["size"] > 500000) { // 500KB limit
	// 		echo "Sorry, your file is too large.";
	// 		$uploadOk = 0;
	// 	}
		
	// 	// Allow certain file formats
	// 	$allowedExtensions = array("jpg", "jpeg", "png", "gif");
	// 	$fileExtension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	// 	if (!in_array($fileExtension, $allowedExtensions)) {
	// 		echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	// 		$uploadOk = 0;
	// 	}
		
	// 	// Check if $uploadOk is set to 0 by an error
	// 	if ($uploadOk == 0) {
	// 		echo "Sorry, your file was not uploaded.";
	// 	// If everything is ok, try to upload file
	// 	} else {
	// 		if (move_uploaded_file($_FILES["getFile"]["tmp_name"], $target_file)) {
	// 			echo "The file ". htmlspecialchars( basename( $_FILES["getFile"]["name"])). " has been uploaded.";
	// 		} else {
	// 			echo "Sorry, there was an error uploading your file.";
	// 		}
	// 	}
	// 	}

?>

  <!-- Page Wrapper -->
  <div id="wrapper">
	<?php
	include '../../sidebar.php';
	
	
	$UserId = $_SESSION['SESS_USERID'];
	$UserCode = $_SESSION['SESS_USERCODE'];
	$UserName = $_SESSION['SESS_NAME'];
	$Theme = $_SESSION['SESS_THEME'];
	?>
	

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
    	<h1 class="h3 mb-0 text-gray-800 d-none" id="theme"><?php echo $Theme ?></h1>
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
						<h5 class="mt-2 font-weight-bold " style="color: black;">User Management</h5>
					</div>

				</div>
            </div>
            <div class="card-body " style="background-color: #F5F5F5">
			<form class="user responsive " id="salesOrder"  width="100%">
			<div class="col-lg-12 pb-2  "  width="100%" id="midCol">
						<ul class="nav nav-tabs pt-2" id="myTab" role="tablist">
						  <li class="nav-item " style="">
							<a class="nav-link active " id="" data-toggle="tab" href="#userContainer" role="tab" aria-controls="contents"
							  aria-selected="true" style="color: black; font-weight:bold">Users</a>
						  </li>
						   <li class="nav-item d-none" style="">
							<a class="nav-link " id="" data-toggle="tab" href="#customers" role="tab" aria-controls="contents"
							  aria-selected="true" style="color: black; font-weight:bold">Customers</a>
						  </li>
						</ul>
				<div class="tab-content" id="myTabContent" style="padding-top: 10px;">
<!-- ///////////////////////////////////////////////////////////////USER SIDE///////////////////////////////////////////////////////////////////////////////////////// -->
	
				<div class="tab-pane fade show active" id="userContainer" role="tabpanel" aria-labelledby="contents">
					<div class="row pr-0 "  width="100%">
				<div class="col-lg-4 pb-2" id="bpCol">
						<div class="form-group row  py-0 my-0">
						<div class="col-sm-3" >
						<label for="inputEmail3" class=" col-form-label " style="color: black;" >Superuser</label>
						</div>
							<div class="col-sm-9" >
								<div class="input-group mb-1 ">
								    <input  type="checkbox" id="chkAdmin" class="" style="width:30px ; height:30px" >
								</div>
							</div>
						</div>
						<div class="form-group row py-0 my-0" >
							<div class="col-sm-3" >
							<label for="inputEmail3" class=" col-form-label " style="color: black;" >User Code</label>
							</div>
								<div class="col-sm-9 ">
									<div class="input-group mb-1">
									<input id="txtUserId" class="d-none"></input>
										<input type="text" id="txtUserCode" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1 " style="border-bottom-left-radius:5px; border-top-left-radius:5px;" >	
									</div>
								</div>
						</div>	 
						<div class="form-group row  py-0 my-0 d-none">
						<div class="col-sm-3" >
						<label for="inputEmail3" class=" col-form-label " style="color: black;" >User Name</label>
						</div>
							<div class="col-sm-9" >
								  <div class="input-group mb-1">
								    <input  type="text" id="txtUserName" class="form-control" placeholder="" >
									
									</div>
							</div>
						</div>	  
						<div class="form-group row  py-0 my-0">
						<div class="col-sm-3" >
						<label for="inputEmail3" class=" col-form-label " style="color: black;" >Password</label>
						</div>
							<div class="col-sm-9" >
								<div class="input-group mb-1">
								    <input  type="password" id="txtPassword" class="form-control" placeholder="" maxlength=20>
								</div>
							</div>
						</div>	  	
						<div class="form-group row py-0 my-0" >
						<div class="col-sm-3" >
						<label for="inputEmail3" class=" col-form-label " style="color: black;" >Employee</label>
						</div>
							<div class="col-sm-9" >
								<div class="input-group mb-1">
									<div class="input-group-prepend d-none" id="lnkCardCode" >
										<button  class="btn"  type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6;"  data-toggle="modal" data-target="#bpMasterModal" data-backdrop="false">
											<i class="fas fa-arrow-right  " style="color: #FFD700; font-size:20px"></i>
										</button>
									</div>
									<input readonly type="text" id="txtEmpCode" class="form-control d-none" placeholder="" aria-label="Username" aria-describedby="basic-addon1 " style="border-bottom-left-radius:5px; border-top-left-radius:5px;">
									<input readonly type="text" id="txtEmpName" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1 " style="border-bottom-left-radius:5px; border-top-left-radius:5px;">
								
									<div class="input-group-append">
										<button id="btnCardCode" class="btn btnGroup" type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#empModal" data-backdrop="false" >
											<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue "></i>
										</button>
									</div>
								</div>
							</div>
						</div>	 
						<div class="form-group row  py-0 my-0">
						<div class="col-sm-3" >
						<label for="inputEmail3" class=" col-form-label " style="color: black;" >Locked</label>
						</div>
							<div class="col-sm-9" >
								<div class="input-group mb-1 ">
								    <input  type="checkbox" id="chkLocked" class="" style="width:30px ; height:30px" >
								</div>
							</div>
						</div>
							
						
					</div>	
					<div class="col-lg-8 pb-2  "  width="100%" id="midCol">
						<ul class="nav nav-tabs pt-2" id="myTab" role="tablist">
						  <li class="nav-item " style="">
							<a class="nav-link active " id="" data-toggle="tab" href="#contents" role="tab" aria-controls="contents"
							  aria-selected="true" style="color: black; font-weight:bold">Access</a>
						  </li>
						  <li class="nav-item " style="">
							<a class="nav-link " id="" data-toggle="tab" href="#pctp" role="tab" aria-controls="pctp"
							  aria-selected="true" style="color: black; font-weight:bold">PCTP</a>
						  </li>
						  
						</ul>
						<div class="tab-content" id="myTabContent" style="padding-top: 10px;">
							<div class="tab-pane fade show active" id="contents" role="tabpanel" aria-labelledby="contents">

								<div id="contentContainer"class="table-responsive" style="width:100%; padding-bottom:20px; padding-left:10px;  overflow-x:hidden;  overflow-y:hidden;" >
									<div class="row"  >
											<div class="col-lg-6"  >
												<div class="row users" style="padding-top:10px; margin-left:5px ">
													<div class="col-lg-12" style="background-color:#A8A8A8 !important; margin:5px !important">
														<div class="form-group row py-2 my-2" id="">	
															<div class="col-8" >
																<label for="inputEmail3" class=" col-form-label " style="color: black; font-size:20px !important" >General Settings</label>
															</div>
															<div class="col-4 text-right"  >
																<div class="input-group mb-1 ">
																	<button class="btn btnGroup ml-1 mainModule" type="button"  id="GenSet" style="background-color: white ;width:40px  !important; height:40px !important "   >
																		<i class="checked d-none fas fa-check input-prefix"  style="color:blue " val="hehe"></i>
																		<i class="indetermine d-none fas fa-minus input-prefix"  style="color:blue "></i>
																		<i class="unchecked d-none fas input-prefix"  style="color:blue "></i>
																	</button>
																	
																	<button class="btn btnGroup ml-1" type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6;width:40px  !important; height:40px !important "  data-toggle="collapse" data-target="#generalSettings"  >
																		<i class="fas fa-plus input-prefix" tabindex=0 style="color:blue "></i>
																	</button>
																	
																</div>
															</div>
															<div class="col-12 " style="background-color:#E8E8E8  !important;">				
																<div class="collapse ml-2 mt-3"  id="generalSettings">
																   <div class="row ">
																		<div class="col-7" >
																			<label for="inputEmail3" class=" col-form-label " style="color: black;" >Cancellation of Document</label>
																		</div>
																		<button class="btn btn-sm btnGroup ml-1 gensub subModule" type="button"  id="CANCEL" style="background-color: white ;width:30px  !important; height:30px !important "   >
																			<i class="checked-sub d-none fas fa-check input-prefix"  style="color:blue "></i>
																			<i class="unchecked-sub d-none fas input-prefix"  style="color:blue "></i>
																		</button>
																	</div>
																	<div class="row" >
																		<div class="col-7" >
																			<label for="inputEmail3" class=" col-form-label " style="color: black;" >Manual Closing</label>
																		</div>
																		<button class="btn btn-sm btnGroup ml-1 gensub subModule" type="button"  id="CLOSING" style="background-color: white ;width:30px  !important; height:30px !important "   >
																			<i class="checked-sub d-none fas fa-check input-prefix"  style="color:blue "></i>
																			<i class="unchecked-sub d-none fas input-prefix"  style="color:blue "></i>
																		</button>
																	</div>
																	<div class="row" >
																		<div class="col-7" >
																			<label for="inputEmail3" class=" col-form-label " style="color: black;" >Add On</label>
																		</div>
																		<button class="btn btn-sm btnGroup ml-1 gensub subModule" type="button"  id="ADDON" style="background-color: white ;width:30px  !important; height:30px !important "   >
																			<i class="checked-sub d-none fas fa-check input-prefix"  style="color:blue "></i>
																			<i class="unchecked-sub d-none fas input-prefix"  style="color:blue "></i>
																		</button>
																	</div>
																	<div class="row" >
																		<div class="col-7" >
																			<label for="inputEmail3" class=" col-form-label " style="color: black;" >Approval Template</label>
																		</div>
																		<button class="btn btn-sm btnGroup ml-1 gensub subModule" type="button"  id="APPT" style="background-color: white ;width:30px  !important; height:30px !important "   >
																			<i class="checked-sub d-none fas fa-check input-prefix"  style="color:blue "></i>
																			<i class="unchecked-sub d-none fas input-prefix"  style="color:blue "></i>
																		</button>
																	</div>
																	<div class="row" >
																		<div class="col-7" >
																			<label for="inputEmail3" class=" col-form-label " style="color: black;" >Approval</label>
																		</div>
																		<button class="btn btn-sm btnGroup ml-1 gensub subModule" type="button"  id="APPR" style="background-color: white ;width:30px  !important; height:30px !important "   >
																			<i class="checked-sub d-none fas fa-check input-prefix"  style="color:blue "></i>
																			<i class="unchecked-sub d-none fas input-prefix"  style="color:blue "></i>
																		</button>
																	</div>


																
																</div>
															</div>	
														</div>
													</div>
													<div class="col-lg-12" style="background-color:#A8A8A8 !important; margin:5px !important">
														<div class="form-group row py-2 my-2" >
															<div class="col-8" >
																<label for="inputEmail3" class=" col-form-label " style="color: black; font-size:20px !important" >Financials Module</label>
															</div>
															<div class="col-4 text-right"  >
																<div class="input-group mb-1 ">
																	<input  type="checkbox" id="" name="chkMainModule[]" class="d-none" style="width:40px ; height:40px"  value="Fin">
																	<button class="btn btnGroup ml-1 mainModule" type="button"  id="Fin" style="background-color: white ;width:40px  !important; height:40px !important "   >
																		<i class="checked d-none fas fa-check input-prefix"  style="color:blue "></i>
																		<i class="indetermine d-none fas fa-minus input-prefix"  style="color:blue "></i>
																		<i class="unchecked d-none fas input-prefix"  style="color:blue "></i>
																	</button>
																	<button class="btn btnGroup ml-1" type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6;width:40px  !important; height:40px !important "  data-toggle="collapse" data-target="#financialsModule"  >
																		<i class="fas fa-plus input-prefix" tabindex=0 style="color:blue "></i>
																	</button>
																</div>
															</div>
														
															<div class="col-12 " style="background-color:#E8E8E8  !important;">				
																<div class="collapse ml-2 mt-3"  id="financialsModule">
																   <div class="row">
																		<div class="col-7" >
																			<label for="inputEmail3" class=" col-form-label " style="color: black;" >Journal Entry</label>
																		</div>
																		<button class="btn btn-sm btnGroup ml-1 finsub subModule" type="button"  id="OJDT" style="background-color: white ;width:30px  !important; height:30px !important "   >
																			<i class="checked-sub d-none fas fa-check input-prefix"  style="color:blue "></i>
																			<i class="unchecked-sub d-none fas input-prefix"  style="color:blue "></i>
																		</button>
																	</div>
																</div>
															</div>	
														</div>
													</div>
													<div class="col-lg-12" style="background-color:#A8A8A8 !important; margin:5px !important">
														<div class="form-group row py-2 my-2" >
															<div class="col-8" >
																<label for="inputEmail3" class=" col-form-label " style="color: black; font-size:20px !important" >Inventory Module</label>
															</div>
															<div class="col-4 text-right"  >
																<div class="input-group mb-1 ">
																	<input  type="checkbox" id="" name="chkMainModule[]" class="d-none" style="width:40px ; height:40px"  value="Inv">
																	<button class="btn btnGroup ml-1 mainModule" type="button"  id="Inv" style="background-color: white ;width:40px  !important; height:40px !important "   >
																		<i class="checked d-none fas fa-check input-prefix"  style="color:blue "></i>
																		<i class="indetermine d-none fas fa-minus input-prefix"  style="color:blue "></i>
																		<i class="unchecked d-none fas input-prefix"  style="color:blue "></i>
																	</button>
																	<button class="btn btnGroup ml-1" type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6;width:40px  !important; height:40px !important "  data-toggle="collapse" data-target="#inventoryModule"  >
																		<i class="fas fa-plus input-prefix" tabindex=0 style="color:blue "></i>
																	</button>
																</div>
															</div>
														
															<div class="col-12 " style="background-color:#E8E8E8  !important;">				
																<div class="collapse ml-2 mt-3"  id="inventoryModule">
																   <div class="row">
																		<div class="col-7" >
																			<label for="inputEmail3" class=" col-form-label " style="color: black;" >Goods Receipt</label>
																		</div>
																		<button class="btn btn-sm btnGroup ml-1 invsub subModule" type="button"  id="OIGN" style="background-color: white ;width:30px  !important; height:30px !important "   >
																			<i class="checked-sub d-none fas fa-check input-prefix"  style="color:blue "></i>
																			<i class="unchecked-sub d-none fas input-prefix"  style="color:blue "></i>
																		</button>
																	</div>
																	<div class="row">
																		<div class="col-7" >
																			<label for="inputEmail3" class=" col-form-label " style="color: black;" >Goods Issue</label>
																		</div>
																		<button class="btn btn-sm btnGroup ml-1 invsub subModule" type="button"  id="OIGE" style="background-color: white ;width:30px  !important; height:30px !important "   >
																			<i class="checked-sub d-none fas fa-check input-prefix"  style="color:blue "></i>
																			<i class="unchecked-sub d-none fas input-prefix"  style="color:blue "></i>
																		</button>
																	</div>
																	<div class="row">
																		<div class="col-7" >
																			<label for="inputEmail3" class=" col-form-label " style="color: black;" >Inventory Transfer</label>
																		</div>
																		<button class="btn btn-sm btnGroup ml-1 invsub subModule" type="button"  id="OWTR" style="background-color: white ;width:30px  !important; height:30px !important "   >
																			<i class="checked-sub d-none fas fa-check input-prefix"  style="color:blue "></i>
																			<i class="unchecked-sub d-none fas input-prefix"  style="color:blue "></i>
																		</button>
																	</div>
																</div>
															</div>	
														</div>
													</div>
													<div class="col-lg-12" style="background-color:#A8A8A8 !important; margin:5px !important">
														<div class="form-group row py-2 my-2" >
															<div class="col-8" >
																<label for="inputEmail3" class=" col-form-label " style="color: black; font-size:20px !important" >Sales Module</label>
															</div>
															<div class="col-4 text-right"  >
																<div class="input-group mb-1 ">
																	<input  type="checkbox" id=""class="d-none" style="width:40px ; height:40px"  value="Sales">
																	<button class="btn btnGroup ml-1 mainModule" type="button"  id="Sales"  style="background-color: white ;width:40px  !important; height:40px !important "   >
																		<i class="checked d-none fas fa-check input-prefix"  style="color:blue "></i>
																		<i class="indetermine d-none fas fa-minus input-prefix"  style="color:blue "></i>
																		<i class="unchecked d-none fas input-prefix"  style="color:blue "></i>
																	</button>
																	<button class="btn btnGroup ml-1" type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6;width:40px  !important; height:40px !important "  data-toggle="collapse" data-target="#salesModule"  >
																		<i class="fas fa-plus input-prefix" tabindex=0 style="color:blue "></i>
																	</button>
																</div>
															</div>
															<div class="col-12 " style="background-color:#E8E8E8 !important;">				
																<div class="collapse ml-2 mt-3" id="salesModule">
																   <div class="row ">
																		<div class="col-7" >
																			<label for="inputEmail3" class=" col-form-label " style="color: black;" >Sales Quotation</label>
																		</div>
																		<button class="btn btn-sm btnGroup ml-1 salessub subModule" type="button"  id="OQUT" style="background-color: white ;width:30px  !important; height:30px !important "   >
																			<i class="checked-sub d-none fas fa-check input-prefix"  style="color:blue "></i>
																			<i class="unchecked-sub d-none fas input-prefix"  style="color:blue "></i>
																		</button>
																	</div>
																	<div class="row">
																		<div class="col-7" >
																			<label for="inputEmail3" class=" col-form-label " style="color: black;" >Sales Order</label>
																		</div>
																		<button class="btn btn-sm btnGroup ml-1 salessub subModule" type="button"  id="ORDR" style="background-color: white ;width:30px  !important; height:30px !important "   >
																			<i class="checked-sub d-none fas fa-check input-prefix"  style="color:blue "></i>
																			<i class="unchecked-sub d-none fas input-prefix"  style="color:blue "></i>
																		</button>
																	</div>
																	<div class="row">
																		<div class="col-7" >
																			<label for="inputEmail3" class=" col-form-label " style="color: black;" >Delivery</label>
																		</div>
																		<button class="btn btn-sm btnGroup ml-1 salessub subModule" type="button"  id="ODLN" style="background-color: white ;width:30px  !important; height:30px !important "   >
																			<i class="checked-sub d-none fas fa-check input-prefix"  style="color:blue "></i>
																			<i class="unchecked-sub d-none fas input-prefix"  style="color:blue "></i>
																		</button>
																	</div>
																	<div class="row">
																		<div class="col-7" >
																			<label for="inputEmail3" class=" col-form-label " style="color: black;" >AR Invoice</label>
																		</div>
																		<button class="btn btn-sm btnGroup ml-1 salessub subModule" type="button"  id="OINV" style="background-color: white ;width:30px  !important; height:30px !important "   >
																			<i class="checked-sub d-none fas fa-check input-prefix"  style="color:blue "></i>
																			<i class="unchecked-sub d-none fas input-prefix"  style="color:blue "></i>
																		</button>
																	</div>
																</div>
															</div>	
														</div>
													</div>
													<div class="col-lg-12" style="background-color:#A8A8A8 !important; margin:5px !important">
														<div class="form-group row py-2 my-2" >
															<div class="col-8" >
																<label for="inputEmail3" class=" col-form-label " style="color: black; font-size:20px !important" >Purchase Module</label>
															</div>
															<div class="col-4 text-right"  >
																<div class="input-group mb-1 ">
																	<input  type="checkbox" id="" name="chkMainModule[]" class="d-none" style="width:40px ; height:40px"  value="Purch">
																	<button class="btn btnGroup ml-1 mainModule" type="button"  id="Purch" style="background-color: white ;width:40px  !important; height:40px !important "   >
																		<i class="checked d-none fas fa-check input-prefix"  style="color:blue "></i>
																		<i class="indetermine d-none fas fa-minus input-prefix"  style="color:blue "></i>
																		<i class="unchecked d-none fas input-prefix"  style="color:blue "></i>
																	</button>
																	<button class="btn btnGroup ml-1" type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6;width:40px  !important; height:40px !important "  data-toggle="collapse" data-target="#purchaseModule"  >
																		<i class="fas fa-plus input-prefix" tabindex=0 style="color:blue "></i>
																	</button>
																</div>
															</div>
														
															<div class="col-12 " style="background-color:#E8E8E8 !important;">				
																<div class="collapse ml-2 mt-3" id="purchaseModule">
																  <div class="row">
																		<div class="col-7" >
																			<label for="inputEmail3" class=" col-form-label " style="color: black;" >Purchase Request</label>
																		</div>	
																		<button class="btn btn-sm btnGroup ml-1 purchsub subModule" type="button"  id="OPRQ" style="background-color: white ;width:30px  !important; height:30px !important "   >
																			<i class="checked-sub d-none fas fa-check input-prefix"  style="color:blue "></i>
																			<i class="unchecked-sub d-none fas input-prefix"  style="color:blue "></i>
																		</button>
																	</div>
																	<div class="row">
																		<div class="col-7" >
																			<label for="inputEmail3" class=" col-form-label " style="color: black;" >Purchase Order</label>
																		</div>
																		<button class="btn btn-sm btnGroup ml-1 purchsub subModule" type="button"  id="OPOR" style="background-color: white ;width:30px  !important; height:30px !important "   >
																			<i class="checked-sub d-none fas fa-check input-prefix"  style="color:blue "></i>
																			<i class="unchecked-sub d-none fas input-prefix"  style="color:blue "></i>
																		</button>
																	</div>
																	<div class="row">
																		<div class="col-7" >
																			<label for="inputEmail3" class=" col-form-label " style="color: black;" >Goods Receipt PO</label>
																		</div>
																		<button class="btn btn-sm btnGroup ml-1 purchsub subModule" type="button"  id="OPDN" style="background-color: white ;width:30px  !important; height:30px !important "   >
																			<i class="checked-sub d-none fas fa-check input-prefix"  style="color:blue "></i>
																			<i class="unchecked-sub d-none fas input-prefix"  style="color:blue "></i>
																		</button>
																	</div>
																	<div class="row">
																		<div class="col-7" >
																			<label for="inputEmail3" class=" col-form-label " style="color: black;" >AP Invoice</label>
																		</div>
																		<button class="btn btn-sm btnGroup ml-1 purchsub subModule" type="button"  id="OPCH" style="background-color: white ;width:30px  !important; height:30px !important "   >
																			<i class="checked-sub d-none fas fa-check input-prefix"  style="color:blue "></i>
																			<i class="unchecked-sub d-none fas input-prefix"  style="color:blue "></i>
																		</button>
																	</div>

																	<div class="row">
																		<div class="col-7" >
																			<label for="inputEmail3" class=" col-form-label " style="color: black;" >AP Downpayment Invoice</label>
																		</div>
																		<button class="btn btn-sm btnGroup ml-1 purchsub subModule" type="button"  id="OPDI" style="background-color: white ;width:30px  !important; height:30px !important "   >
																			<i class="checked-sub d-none fas fa-check input-prefix"  style="color:blue "></i>
																			<i class="unchecked-sub d-none fas input-prefix"  style="color:blue "></i>
																		</button>
																	</div>

																	<div class="row">
																		<div class="col-7" >
																			<label for="inputEmail3" class=" col-form-label " style="color: black;" >AP Credit Memo</label>
																		</div>
																		<button class="btn btn-sm btnGroup ml-1 purchsub subModule" type="button"  id="OPCM" style="background-color: white ;width:30px  !important; height:30px !important "   >
																			<i class="checked-sub d-none fas fa-check input-prefix"  style="color:blue "></i>
																			<i class="unchecked-sub d-none fas input-prefix"  style="color:blue "></i>
																		</button>
																	</div>
																	
																	
																</div>
															</div>	
														</div>
													</div>
													<div class="col-lg-12" style="background-color:#A8A8A8 !important; margin:5px !important">
														<div class="form-group row py-2 my-2" >
															<div class="col-8" >
																<label for="inputEmail3" class=" col-form-label " style="color: black; font-size:20px !important" >Banking Module</label>
															</div>
															<div class="col-4 text-right"  >
																<div class="input-group mb-1 ">
																	<input  type="checkbox" id="" name="chkMainModule[]" class="d-none" style="width:40px ; height:40px"  value="Bank">
																	<button class="btn btnGroup ml-1 mainModule" type="button"  id="Bank" style="background-color: white ;width:40px  !important; height:40px !important "   >
																		<i class="checked d-none fas fa-check input-prefix"  style="color:blue "></i>
																		<i class="indetermine d-none fas fa-minus input-prefix"  style="color:blue "></i>
																		<i class="unchecked d-none fas input-prefix"  style="color:blue "></i>
																	</button>
																	<button class="btn btnGroup ml-1" type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6;width:40px  !important; height:40px !important "  data-toggle="collapse" data-target="#bankingModule"  >
																		<i class="fas fa-plus input-prefix" tabindex=0 style="color:blue "></i>
																	</button>
																</div>
															</div>
														
															<div class="col-12 " style="background-color:#E8E8E8 !important;">				
																<div class="collapse ml-2 mt-3" id="bankingModule">
																  <div class="row">
																		<div class="col-7" >
																			<label for="inputEmail3" class=" col-form-label " style="color: black;" >Incoming Payment</label>
																		</div>	
																		<button class="btn btn-sm btnGroup ml-1 banksub subModule" type="button"  id="ORCT" style="background-color: white ;width:30px  !important; height:30px !important "   >
																			<i class="checked-sub d-none fas fa-check input-prefix"  style="color:blue "></i>
																			<i class="unchecked-sub d-none fas input-prefix"  style="color:blue "></i>
																		</button>
																	</div>
																	<div class="row">
																		<div class="col-7" >
																			<label for="inputEmail3" class=" col-form-label " style="color: black;" >Outgoing Payment</label>
																		</div>
																		<button class="btn btn-sm btnGroup ml-1 banksub subModule" type="button"  id="OVPM" style="background-color: white ;width:30px  !important; height:30px !important "   >
																			<i class="checked-sub d-none fas fa-check input-prefix"  style="color:blue "></i>
																			<i class="unchecked-sub d-none fas input-prefix"  style="color:blue "></i>
																		</button>
																	</div>
																</div>
															</div>	
														</div>
													</div>
											</div>
										</div>
										<div class="col-lg-3" >
												<div class="row " style="padding-top:10px; margin-left:5px ">
													
											</div>
										</div>
										</div>
									<hr/>
								</div>
							</div>
						
							<div class="tab-pane fade " id="pctp" role="tabpanel" aria-labelledby="pctp">
								<div id="contentContainer"class="table-responsive" style="width:100%; padding-bottom:20px; padding-left:10px;  overflow-x:hidden;  overflow-y:hidden;" >
									<div class="row"  >
											<div class="col-lg-6"  >
												<div class="row users" style="padding-top:10px; margin-left:5px ">
													<div class="col-lg-12" style="background-color:#A8A8A8 !important; margin:5px !important">
														<div class="form-group row py-2 my-2" id="">	
															<div class="col-8" >
																<label for="inputEmail3" class=" col-form-label " style="color: black; font-size:20px !important" >PCTP TABS</label>
															</div>
															<div class="col-4 text-right"  >
																<div class="input-group mb-1 ">
																	<button class="btn btnGroup ml-1 mainModule d-none" type="button"  id="PCTPAccess" style="background-color: white ;width:40px  !important; height:40px !important "   >
																		<i class="checked d-none fas fa-check input-prefix"  style="color:blue " val="hehe"></i>
																		<i class="indetermine d-none fas fa-minus input-prefix"  style="color:blue "></i>
																		<i class="unchecked d-none fas input-prefix"  style="color:blue "></i>
																	</button>
																	
																	<button class="btn btnGroup ml-1" type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6;width:40px  !important; height:40px !important "  data-toggle="collapse" data-target="#generalSettings"  >
																		<i class="fas fa-plus input-prefix" tabindex=0 style="color:blue "></i>
																	</button>
																	
																</div>
															</div>
															<div class="col-12 " style="background-color:#E8E8E8  !important;">				
																<div class="collapse ml-2 mt-3"  id="generalSettings">
																	<div class="row ">
																		<div class="col-7" >
																			<label for="inputEmail3" class=" col-form-label " style="color: black;" >SUMMARY</label>
																		</div>

																		<select type="text" class="form-control billInputs col-5" id="SUMMARY" placeholder="" >
																  		<option value="Full">Full</option>
																			<option value="View">View</option>
																			<option value="None">None</option>
																		</select>
																	</div>
																	<div class="row ">
																		<div class="col-7" >
																			<label for="inputEmail3" class=" col-form-label " style="color: black;" >POD</label>
																		</div>

																		<select type="text" class="form-control billInputs col-5" id="POD" placeholder="" >
																  		<option value="Full">Full</option>
																			<option value="View">View</option>
																			<option value="None">None</option>
																		</select>
																	</div>
																   <div class="row ">
																		<div class="col-7" >
																			<label for="inputEmail3" class=" col-form-label " style="color: black;" >BILLING</label>
																		</div>
																		<select type="text" class="form-control billInputs col-5" id="BILLING" placeholder="" >
																  		<option value="Full">Full</option>
																			<option value="View">View</option>
																			<option value="None">None</option>
																		</select>
																	</div>
																	<div class="row" >
																		<div class="col-7" >
																			<label for="inputEmail3" class=" col-form-label " style="color: black;" >TP</label>
																		</div>
																		<select type="text" class="form-control billInputs col-5" id="TP" placeholder="" >
																  		<option value="Full">Full</option>
																			<option value="View">View</option>
																			<option value="None">None</option>
																		</select>
																	</div>
																	<div class="row" >
																		<div class="col-7" >
																			<label for="inputEmail3" class=" col-form-label " style="color: black;" >PRICING</label>
																		</div>
																		<select type="text" class="form-control billInputs col-5" id="PRICING" placeholder="" >
																  		<option value="Full">Full</option>
																			<option value="View">View</option>
																			<option value="None">None</option>
																		</select>
																	</div>
																	<div class="row ">
																		<div class="col-7" >
																			<label for="inputEmail3" class=" col-form-label " style="color: black;" >TREASURY</label>
																		</div>

																		<select type="text" class="form-control billInputs col-5" id="TREASURY" placeholder="" >
																  		<option value="Full">Full</option>
																			<option value="View">View</option>
																			<option value="None">None</option>
																		</select>
																	</div>
																</div>
															</div>	
														</div>
													</div>
													
													
														</div>
													</div>
											</div>
										</div>
										<div class="col-lg-3" >
												<div class="row " style="padding-top:10px; margin-left:5px ">
													
											</div>
										</div>
										</div>
							</div>
							<div class="tab-pane fade " id="accounting" role="tabpanel" aria-labelledby="accounting">
								<div id="contentContainer"class="table-responsive" style="width:100%; padding-bottom:20px; padding-left:10px; padding-right:10px;  overflow-x:hidden;  overflow-y:hidden;">
									<div id="accounting-tab" >
									</div>
									<hr/>
								</div>
							</div>
							<div class="tab-pane fade " id="attachments" role="tabpanel" aria-labelledby="attachments">
								<div id="contentContainer"class="table-responsive" style="width:100%; padding-bottom:20px; padding-left:10px; padding-right:10px;  overflow-x:hidden;  overflow-y:hidden;">
									<div id="attachments-tab" >
									</div>
									<hr/>
								</div>
							</div>
						</div>
					</div>
					
				</div>
				<div id="userContainer"class="table-responsive" style="width:100%; padding-bottom:20px; padding-left:10px;  overflow-x:hidden;  overflow-y:hidden;" >
								
								
								
							
				
          
	
	
        <!-- /.container-fluid -->


				<div  id="footerButtons" class="form-group row  mt-5 ">
					<div class="col-lg-6 col-md-6 col-sm-6 text-left">
						<button type="button" id="btnAddUser"  class="  btn btn-warning btn-rounded " style="color: black; font-weight: bold; width:250px; background: linear-gradient(to bottom, #FCF6BA, #BF953F);" >Add</button>
						<button type="button" id="btnUpdateUser" class="  btn btn-warning btn-rounded d-none" style="color:black; font-weight: bold; black;width:250px; background: linear-gradient(to bottom, #FCF6BA, #BF953F);" >Update</button>
						<button type="button" id="btnOkUser" class="  btn btn-warning btn-rounded d-none" style="color:black; font-weight: bold; black;width:250px; background: linear-gradient(to bottom, #FCF6BA, #BF953F);" >Ok</button>
						
						<button type="button" id="btnCancelUser" class=" btn btn-warning btn-rounded ml-5" style="color: black;width:250px; font-weight: bold; background: linear-gradient(to bottom, #FCF6BA, #BF953F);">Cancel</button>
					</div>
				</div>
            </form>
				
				</div>
				</div>
	<!-- ///////////////////////////////////////////////////////////////CUSTOMER SIDE///////////////////////////////////////////////////////////////////////////////////////// -->
				<div class="tab-pane fade d-none " id="customers" role="tabpanel" aria-labelledby="contents">
					<div class="row pr-0 "  width="100%">
				<div class="col-lg-4 pb-2" id="bpCol">
						
						<div class="form-group row py-0 my-0" >
							<div class="col-sm-3" >
							<label for="inputEmail3" class=" col-form-label " style="color: black;" >Customer Code</label>
							</div>
								<div class="col-sm-9 ">
									<div class="input-group mb-1">
									<input id="txtCustId" class="d-none"></input>
										<input type="text" id="txtCustCode" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1 " style="border-bottom-left-radius:5px; border-top-left-radius:5px;" readonly>	
										<div class="input-group-append">
										<button id="btnCardCode" class="btn btnGroup" type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#custModal" data-backdrop="false" >
											<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue "></i>
										</button>
										</div>
									</div>
								</div>
						</div>	 
						<div class="form-group row  py-0 my-0">
						<div class="col-sm-3" >
						<label for="inputEmail3" class=" col-form-label " style="color: black;" >Customer Name</label>
						</div>
							<div class="col-sm-9" >
								  <div class="input-group mb-1">
								    <input  type="text" id="txtCustName" class="form-control" placeholder="" readonly>
									
									</div>
							</div>
						</div>	  
						<div class="form-group row  py-0 my-0">
						<div class="col-sm-3" >
						<label for="inputEmail3" class=" col-form-label " style="color: black;" >Password</label>
						</div>
							<div class="col-sm-9" >
								<div class="input-group mb-1">
								    <input  type="password" id="txtCustPassword" class="form-control" placeholder="" maxlength=12>
								</div>
							</div>
						</div>	  	
						 
						<div class="form-group row  py-0 my-0">
						<div class="col-sm-3" >
						<label for="inputEmail3" class=" col-form-label " style="color: black;" >Locked</label>
						</div>
							<div class="col-sm-9" >
								<div class="input-group mb-1 ">
								    <input  type="checkbox" id="chkLocked" class="" style="width:30px ; height:30px" >
								</div>
							</div>
						</div>
							
						
					</div>	
					<div>
					
				</div>
				<div id="userContainer"class="table-responsive" style="width:100%; padding-bottom:20px; padding-left:10px;  overflow-x:hidden;  overflow-y:hidden;" >
								
								
								
							
				
          
	
	
        <!-- /.container-fluid -->


				<div  id="footerButtons" class="form-group row  mt-5 ">
					<div class="col-lg-6 col-md-6 col-sm-6 text-left">
						<button type="button" id="btnAddCust" class="  btn btn-warning btn-rounded " style="color: black; font-weight: bold; width:250px; background: linear-gradient(to bottom, #FCF6BA, #BF953F);" >Add</button>
						<button type="button" id="btnUpdateCust" class="  btn btn-warning btn-rounded d-none" style="color:black; font-weight: bold; black;width:250px; background: linear-gradient(to bottom, #FCF6BA, #BF953F);" >Update</button>
						<button type="button" id="btnOkCust" class="  btn btn-warning btn-rounded d-none" style="color:black; font-weight: bold; black;width:250px; background: linear-gradient(to bottom, #FCF6BA, #BF953F);" >Ok</button>
						
						<button type="button" id="btnCancelCust" class=" btn btn-warning btn-rounded ml-5" style="color: black;width:250px; font-weight: bold; background: linear-gradient(to bottom, #FCF6BA, #BF953F);">Cancel</button>
					</div>
				</div>
            </form>
				
				</div>
				
				</div>
		
				
          
	
	
        <!-- /.container-fluid -->


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
  
  <!-- Document Modal -->
    <div class="modal fade" id="documentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-dialog modal-xl" role="document" style="width:100%">
        <!--Content-->
        <div class="modal-content-full-width modal-content">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
            <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of Users</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->
          <div class="modal-body">
            <table class="table table-striped table-bordered table-hover" id="tblDoc" style="width:100%">
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
											LEFT JOIN OHEM T1 ON t1.EmpId = T0.EmpID");
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
	

    
	
  <!-- Employee Modal -->
    <div class="modal fade" id="empModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-dialog modal-xl" role="document" style="width:100%">
        <!--Content-->
        <div class="modal-content-full-width modal-content">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
            <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of Employees</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->
          <div class="modal-body">
            <table class="tblBP table table-striped table-bordered table-hover" id="tblEmployee" style="width: 100%">
						<thead>
							<tr>
								<th >#</th>
								<th>Employee Code</th>
								<th>Employee Name</th>
								<th>Job Title</th>
								<th class="d-none">Department Code</th>
								<th class="d-none">Branch Code</th>
								<th>Department</th>
								<th>Branch</th>
								
							</tr>
						</thead>
						<tbody>
						<?php
							$itemno = 1;
							$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT DISTINCT
																						T0.EmpId, 
																						CONCAT(T0.LastName, ', ', T0.FirstName, ' ',T0.MiddleName) AS FullName,
																						T0.JobTitle,
																						T0.Dept,
																						T0.Branch,
																						T1.Name AS DeptName,
																						T2.Name AS BranchName
																						
																						FROM OHEM T0
																						LEFT JOIN OUDP T1 ON T0.dept = T1.Code 
																						LEFT JOIN OUBR T2 ON T0.branch = T2.Code
																						
																						ORDER BY T0.EmpId ASC");
								while (odbc_fetch_row($qry)) 
								{
									echo '<tr class="tableHover">
												<td>'.$itemno.'</td>
												<td class="item-1">'.odbc_result($qry, 'EmpId').'</td>
												<td class="item-2">'.odbc_result($qry, 'FullName').'</td>
												<td class="item-3">'.odbc_result($qry, 'JobTitle').'</td>
												<td class="item-4 d-none">'.odbc_result($qry, 'Dept').'</td>
												<td class="item-5 d-none">'.odbc_result($qry, 'Branch').'</td>
												<td class="item-6">'.odbc_result($qry, 'DeptName').'</td>
												<td class="item-7">'.odbc_result($qry, 'BranchName').'</td>
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
    <!-- Employee Modal -->
    
    
	

	 <!-- UDF Modal -->
    <div class="modal fade" id="udfModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-dialog modal-xl" role="document" style="width:100%">
        <!--Content-->
        <div class="modal-content-full-width modal-content">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
            <h4 id="udfModalTitle" class="modal-title w-100" id="myModalLabel" style="color:black"></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->
          <div class="modal-body">
			<div id="udfModalResult"></div>
						
          </div>
          <!--Footer-->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!--/.Content-->
      </div>
    </div>
    <!-- UDF -->

<script src="../script/users.js"></script>
<script src="../../style.js"></script>

<script>$('#tblDoc').dataTable({"bLengthChange": false,});</script>
<script>$('#tblEmployee').dataTable({"bLengthChange": false,});</script>


<?php
	include '../../bottom.php' 
?>
