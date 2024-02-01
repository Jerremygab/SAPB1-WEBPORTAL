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
	$Theme = $_SESSION['SESS_THEME'];
	$_SESSION['objectType'] = 24;
	?>


    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <h1 class="h3 mb-0 text-gray-800 d-none" id="theme"><?php echo $Theme ?></h1>
        <!-- Main Content -->
        <div id="content">

            <?php
		include '../../topbar.php';
		
	   ?>
            <!-- Begin Page Content -->
            <div class="container-fluid" style="margin-left: 1px !important; padding-left: 1px !important;">
                <!-- Page Heading -->


                <!-- DataTales Example -->
                <div class="card shadow mb-4" id="windowmain"
                    style="background-color:#E8E8E8 !important; border: none !important">
                    <div class="row pr-0 " width="100%">
                        <div class="col-lg-9" id="containerSystem"
                            style="margin-right: 0px !important; padding-right: 0px !important; ">
                            <div class="card-header py-0"
                                style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
                                <div class="row" id="window-header">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <h5 class="mt-2 font-weight-bold " style="color: black;">Incoming Payments</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body " id="window"
                                style="background-color: #F5F5F5; border-right: 1px solid #A0A0A0">

                                <form class="user responsive " id="form" width="100%">

                                    <div class="row pr-0 " width="100%">
                                        <div class="col-lg-4 pb-2" id="bpCol">
                                            <div class="form-group row py-0 my-0 vendor">
                                                <div class="col-sm-3">
                                                    <label for="inputEmail3" class=" col-form-label "
                                                        style="color: black;">Code</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="input-group mb-1">
                                                        <div class="input-group-prepend d-none" id="lnkCardCode">
                                                            <button ID="bpMaster" class="btn" type="button"
                                                                data-mdb-ripple-color="dark"
                                                                style="background-color: #ADD8E6;">
                                                                <i class="fas fa-arrow-right  "
                                                                    style="color: #FFD700; font-size:20px"></i>
                                                            </button>
                                                        </div>
                                                        <input readonly type="text" id="txtCardCode"
                                                            class="form-control inputRadius" placeholder=""
                                                            aria-label="Username" aria-describedby="basic-addon1 "
                                                            style="border-bottom-left-radius:5px; border-top-left-radius:5px;">
                                                        <div class="input-group-append">

                                                            <button id="btnCardCode" class="btn btnGroup" type="button"
                                                                data-mdb-ripple-color="dark"
                                                                style="background-color: #ADD8E6; " data-toggle="modal"
                                                                data-target="#bpModal" data-backdrop="false">
                                                                <i class="fas fa-list-ul input-prefix" tabindex=0
                                                                    style="color:blue "></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row  py-0 my-0 vendor">
                                                <div class="col-sm-3">
                                                    <label for="inputEmail3" class=" col-form-label "
                                                        style="color: black;">Name</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="input-group mb-1">
                                                        <input type="text" id="txtCardName"
                                                            class="form-control inputRadius" placeholder="" readonly>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row  py-0 my-0 account d-none">
                                                <div class="col-sm-3">
                                                    <label for="inputEmail3" class=" col-form-label "
                                                        style="color: black;">To Order of</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="input-group mb-1">
                                                        <input type="text" id="txtToOrderOf"
                                                            class="form-control inputRadius" placeholder=""
                                                            aria-label="Username" aria-describedby="basic-addon1 "
                                                            style="border-bottom-left-radius:5px; border-top-left-radius:5px;">
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row  py-0 my-0 account d-none">
                                                <div class="col-sm-3">
                                                    <label for="inputEmail3" class=" col-form-label "
                                                        style="color: black;">Pay To</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="input-group mb-1">
                                                        <textarea type="text" id="txtPayTo"
                                                            class="form-control inputRadius" placeholder=""> </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row  py-0 my-0 vendor">
                                                <label for="inputEmail3" class="col-sm-3 col-form-label "
                                                    style="color: black;">Contact Person</label>
                                                <div class="col-sm-9 ">
                                                    <div class="input-group mb-1">

                                                        <input type="text" class="form-control d-none inputRadius"
                                                            id="txtContactPersonCode" placeholder="" readonly
                                                            style="border-bottom-left-radius:5px; border-top-left-radius:5px;">
                                                        <input type="text" class="form-control" id="txtContactPerson"
                                                            placeholder="" readonly
                                                            style="border-bottom-left-radius:5px; border-top-left-radius:5px; border-bottom-right-radius:5px; border-top-right-radius:5px;">
                                                        <div id="contactPersonBtn" class="input-group-append d-none">
                                                            <button class="btn btnGroup" type="button"
                                                                data-mdb-ripple-color="dark"
                                                                style="background-color: #ADD8E6; " data-toggle="modal"
                                                                data-target="#contactPersonModal" data-backdrop="false">
                                                                <i class="fas fa-list-ul input-prefix" tabindex=0
                                                                    style="color:blue "></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 pb-2  " width="100%" id="midCol">
                                            <div class="form-group row  mb-0 ">
                                                <div class="col-sm-12 row">
                                                    <select id="selTransactionType"
                                                        class="col-sm-6 form-control-sm mdb-select md-form text-left"
                                                        searchable="Search here.."
                                                        style=" outline:none; border-color: #D0D0D0;">
                                                        <option class="text-center" value="C">Customer</option>
                                                        <option class="text-center" value="A">Account</option>
                                                        <input type="hidden" id="rowLoader" name="rowLoader"
                                                            class="form-control input-sm">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 pb-2 " id="dateCol">
                                            <div class="form-group row  py-0 my-0 mb-1">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label "
                                                    style="color: black;">No.</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control  d-none" id="txtSeriesOVPM"
                                                        placeholder="" readonly>
                                                    <input type="text" class="form-control" id="txtSeriesNameOVPM"
                                                        placeholder="" readonly>
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control d-none" id="txtAtcEntry" placeholder="" />
                                                    <input type="text" class="form-control d-none" id="txtDocEntry"
                                                        placeholder="" value=<?php
														$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT 
																												ISNULL(MAX(T0.DocEntry),0) + 1 AS NextDocEntry
																											FROM ORCT T0
																														");
																while (odbc_fetch_row($qry)) 
																{
																	echo odbc_result($qry, "NextDocEntry");
																	  
																}
											?> readonly>
                                                    <input type="text" class="form-control " id="txtDocNum"
                                                        placeholder="" value=<?php
											$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT 
																									ISNULL(MAX(T0.DocNum),0) + 1 AS NextDocNum
																								FROM ORCT T0
																											");
													while (odbc_fetch_row($qry)) 
													{
														echo odbc_result($qry, "NextDocNum");
														  
													}
								?> readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row  py-0 my-0 mb-1">
                                                <label for="inputEmail3" class="col-sm-5 col-form-label "
                                                    style="color: black;">Status</label>
                                                <div class="col-sm-1 ">
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="email" class="form-control" id="txtStatus"
                                                        placeholder="" value="Open" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row  py-0 my-0">
                                                <label for="inputEmail3" class="col-sm-5 col-form-label "
                                                    style="color: black;">Posting Date</label>
                                                <div class="col-sm-1 ">
                                                </div>
                                                <div class="col-sm-6 input-group mb-1 ">
                                                    <input type="text" id="txtPostingDate2" class="form-control col-10"
                                                        value="" min="01-01-2018" max="12-31-2050">
                                                    <input type="date" id="txtPostingDate"
                                                        class="form-control col-2 postingdate"
                                                        value="<?php echo date('Y-m-d'); ?>" min="01-01-2018"
                                                        max="12-31-2050" style="color:transparent !important; ">

                                                </div>

                                            </div>

                                            <div class="form-group row  py-0 my-0">
                                                <label for="inputEmail3" class="col-sm-5 col-form-label "
                                                    style="color: black;">Due Date</label>
                                                <div class="col-sm-1 ">
                                                </div>
                                                <div class="col-sm-6 input-group mb-1">
                                                    <input type="text" id="txtDeliveryDate2" class="form-control col-10"
                                                        value="" min="01-01-2018" max="12-31-2050">
                                                    <input type="date" id="txtDeliveryDate" class="form-control col-2 "
                                                        value="<?php echo date('Y-m-d'); ?>" min="01-01-2018"
                                                        max="12-31-2050" style="color:transparent !important">

                                                </div>
                                            </div>
                                            <div class="form-group row  py-0 my-0">
                                                <label for="inputEmail3" class="col-sm-5 col-form-label "
                                                    style="color: black; font-size:15px">Document Date</label>
                                                <div class="col-sm-1 ">
                                                </div>
                                                <div class="col-sm-6 input-group mb-1">
                                                    <input type="text" id="txtDocumentDate2" class="form-control col-10"
                                                        value="" min="01-01-2018" max="12-31-2050">
                                                    <input type="date" id="txtDocumentDate" class="form-control col-2"
                                                        value="<?php echo date('Y-m-d'); ?>" min="01-01-2018"
                                                        max="12-31-2050" style="color:transparent !important">
                                                </div>
                                            </div>
                                            <div class="form-group row  py-0 my-0 mb-1">
                                                <label for="inputEmail3" class="col-sm-3 col-form-label "
                                                    style="color: black;">Reference</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control " id="txtReference"
                                                        placeholder="" maxlength="27">
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <ul class="nav nav-tabs pt-2" id="myTab" role="tablist">
                                        <li class="nav-item ">
                                            <a class="nav-link active " id="" data-toggle="tab" href="#contents"
                                                role="tab" aria-controls="contents" aria-selected="true"
                                                style="color: black; font-weight:bold">Contents</a>
                                                <li class="nav-item " >
                                            <a class="nav-link " id="" data-toggle="tab" href="#attachments"
                                                role="tab" aria-controls="attachments" aria-selected="true"
                                                style="color: black; font-weight:bold">Attachments</a>
                                        </li>
                                        </li>


                                    </ul>

                                    <div class="tab-content" id="myTabContent" style="padding-top: 10px;">
                                        <div class="tab-pane fade show active" id="contents" role="tabpanel"
                                            aria-labelledby="contents">

                                            <div id="contentContainer" class="table-responsive"
                                                style="width:100%; padding-bottom:20px; padding-left:10px; overflow-x:hidden;  overflow-y:hidden;">
                                                <div id="contents-tab"> 
                                               
                                                  </div>

                                                <hr />
                                            </div>

                                        </div>

                                        <div class="tab-pane fade " id="attachments" role="tabpanel"
                                            aria-labelledby="attachments">
                                            <div id="contentContainer" class="table-responsive"
                                                style="width:100%; padding-bottom:20px; padding-left:10px; padding-right:10px;  overflow-x:hidden;  overflow-y:hidden;">
                                                <div id="attachments-tab">
                                                </div>
                                                <hr />
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.container-fluid -->


                                    <div class="row pr-0 " width="100%">
                                        <div class="col-lg-5 pb-2">
                                            <div class="form-group row  py-0 my-0 d-none">
                                                <div class="col-sm-3">
                                                    <label for="inputEmail3" class=" col-form-label "
                                                        style="color: black;">Sales Employee</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="input-group mb-1">
                                                        <input readonly type="text" id="txtSalesEmpCode"
                                                            class="form-control d-none" placeholder=""
                                                            aria-label="Username" aria-describedby="basic-addon1"
                                                            value="1">
                                                        <input readonly type="text" id="txtSalesEmpName"
                                                            class="form-control inputRadius" placeholder=""
                                                            aria-label="Username" aria-describedby="basic-addon1"
                                                            style="border-bottom-left-radius:5px; border-top-left-radius:5px;"
                                                            value="-No Sales Employee-">
                                                        <div class="input-group-append">
                                                            <button class="btn btnGroup" type="button"
                                                                data-mdb-ripple-color="dark"
                                                                style="background-color: #ADD8E6; "
                                                                data-toggle="modal" data-target="#salesEmpModal"
                                                                data-backdrop="false">
                                                                <i class="fas fa-list-ul input-prefix" tabindex=0
                                                                    style="color:blue "></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row  py-0 my-0">
                                                <label class="col-sm-3 col-form-label "
                                                    style="color: black;">Owner</label>
                                                <div class="col-sm-9 ">
                                                    <div class="input-group mb-1">
                                                        <div class="input-group-prepend " id="lnkEmployee">
                                                            <button class="btn" type="button"
                                                                data-mdb-ripple-color="dark"
                                                                style="background-color: #ADD8E6; "
                                                                data-toggle="modal" data-target="#"
                                                                data-backdrop="false">
                                                                <i class="fas fa-arrow-right  "
                                                                    style="color: #FFD700; font-size:20px"></i>
                                                            </button>
                                                        </div>
                                                        <input readonly type="text" class="form-control d-none"
                                                            id="txtOwnerCode" value="<?php echo $UserId?>">
                                                        <input readonly type="text" class="form-control inputRadius"
                                                            id="txtOwnerName"
                                                            style="border-bottom-left-radius:5px; border-top-left-radius:5px;"
                                                            value="<?php echo $UserName?>">
                                                        <div class="input-group-append">
                                                            <button class="btn btnGroup" type="button"
                                                                data-mdb-ripple-color="dark"
                                                                style="background-color: #ADD8E6; "
                                                                data-toggle="modal" data-target="#empModal"
                                                                data-backdrop="false">
                                                                <i class="fas fa-list-ul input-prefix" tabindex=0
                                                                    style="color:blue "></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row  py-0 my-0">
                                                <label class="col-sm-3 col-form-label "
                                                    style="color: black;">Remarks</label>
                                                <div class="col-sm-9 ">
                                                    <textarea type="text" class="form-control " id="txtRemarks"
                                                        placeholder="" resize='false' maxlength="254"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row  py-1 my-0">
                                                <label class="col-sm-3 col-form-label " style="color: black;">Journal
                                                    Memo</label>
                                                <div class="col-sm-9 ">
                                                    <textarea type="text" class="form-control " id="txtJournalMemo"
                                                        placeholder="" resize='false' maxlength="254"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row  py-0 my-0 paynodoc d-none">
                                                <label class="col-sm-3 col-form-label " style="color: black;">Control
                                                    Account</label>
                                                <div class="col-sm-9 input-group">
                                                    <input readonly type="text" id="txtGLCodePayNoDoc"
                                                        class="form-control inputRadius " placeholder=""
                                                        aria-label="Username" aria-describedby="basic-addon1 "
                                                        style="border-bottom-left-radius:5px; border-top-left-radius:5px;">
                                                    <input readonly type="text" id="txtGLNamePayNoDoc"
                                                        class="form-control inputRadius d-none" placeholder=""
                                                        aria-label="Username" aria-describedby="basic-addon1 "
                                                        style="border-bottom-left-radius:5px; border-top-left-radius:5px;">
                                                    <div class="input-group-append">
                                                        <button id="btnCardCode" class="btn btnGroup" type="button"
                                                            data-mdb-ripple-color="dark"
                                                            style="background-color: #ADD8E6; " data-toggle="modal"
                                                            data-target="#glModalPayNoDoc" data-backdrop="false">
                                                            <i class="fas fa-list-ul input-prefix" tabindex=0
                                                                style="color:blue "></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 pb-2  " width="100%">

                                        </div>
                                        <div class="col-lg-4 pb-2 ">
                                            <div class="form-group row  py-0 my-0 vendor">
                                                <label class="col-sm-4 col-form-label " style="color: black;">Payment On
                                                    Account</label>
                                                <div class="col-sm-1 input-group mb-1">
                                                    <input type="checkbox" id="chkPayNoDoc"
                                                        style=" height:20px ; width:20px "
                                                        class="form-control matrix-cell ">
                                                </div>
                                                <div class="col-sm-7 input-group mb-1">
                                                    <input type="text" id="txtNoDocSum" class="form-control text-right"
                                                        readonly value=0.00>
                                                </div>
                                            </div>
                                            <div class="form-group row  py-0 my-0 vendor">
                                                <label for="inputEmail3" class="col-sm-4 col-form-label "
                                                    style="color: black;">WTax Amount</label>
                                                <div class="col-sm-8 input-group mb-1">
                                                    <input type="text" id="txtWTaxAmount"
                                                        class="form-control text-right" readonly value=0.00>
                                                </div>
                                            </div>
                                            <div class="form-group row  py-0 my-0 account d-none">
                                                <label for="inputEmail3" class="col-sm-4 col-form-label "
                                                    style="color: black;">Net Total</label>
                                                <div class="col-sm-8 input-group mb-1">
                                                    <input type="text" id="txtTotalBeforeDiscount"
                                                        class="form-control text-right" readonly value=0.00>
                                                    <input type="text" id="txtTotalBeforeDiscount2"
                                                        class="form-control text-right d-none" readonly value=0.00>
                                                </div>
                                            </div>
                                            <div class="form-group row  py-0 my-0 account d-none">
                                                <label for="inputEmail3" class="col-sm-4 col-form-label "
                                                    style="color: black;">Total Tax</label>
                                                <div class="col-sm-8 input-group mb-1">
                                                    <input type="text" id="txtVatSum" class="form-control text-right"
                                                        readonly value=0.00>
                                                </div>
                                            </div>
                                            <div class="form-group row  py-0 my-0">
                                                <label for="inputEmail3" class="col-sm-4 col-form-label "
                                                    style="color: black;">Total Amount Due</label>
                                                <div class="col-sm-8 input-group mb-1">
                                                    <div class="input-group-prepend">

                                                        <button id="btnPayment" class="btn" type="button"
                                                            data-mdb-ripple-color="dark"
                                                            style="background-color: #ADD8E6; " data-toggle="modal"
                                                            data-target="#paymentModal" data-backdrop="false">
                                                            <i class="fas fa-list-ul input-prefix" tabindex=0
                                                                style="color:blue "></i>
                                                        </button>
                                                    </div>
                                                    <input type="text" id="txtDocTotal" class="form-control text-right"
                                                        readonly value=0.00>
                                                    <input type="text" id="txtDocTotal2"
                                                        class="form-control text-right d-none" readonly value=0.00>
                                                </div>

                                            </div>
                                            <div class="form-group row  py-0 my-0 vendor">
                                                <label for="inputEmail3" class="col-sm-4 col-form-label "
                                                    style="color: black;">Open Balance</label>
                                                <div class="col-sm-8 input-group mb-1">
                                                    <input type="text" id="txtOpenBalance"
                                                        class="form-control text-right" readonly>
                                                    <input type="text" id="txtFooterDiscountPercentage"
                                                        class="form-control text-right d-none" readonly value=0.00>
                                                    <input type="text" id="txtFooterDiscountSum"
                                                        class="form-control text-right d-none" readonly value=0.00>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div id="footerButtons" class="form-group row  mt-5 ">
                                        <div class="col-lg-6 col-md-6 col-sm-6 text-left">
                                            <button type="button" id="btnAdd" class="  btn btn-warning btn-rounded "
                                                style="color: black; font-weight: bold; width:250px; background: linear-gradient(to bottom, #FCF6BA, #BF953F);">Add</button>
                                            <button type="button" id="btnOk"
                                                class="  btn btn-warning btn-rounded d-none"
                                                style="color:black; font-weight: bold; width:250px; background: linear-gradient(to bottom, #FCF6BA, #BF953F);">Ok</button>
                                            <button type="button" id="btnUpdate"
                                                class="  btn btn-warning btn-rounded d-none"
                                                style="color:black; font-weight: bold; width:250px; background: linear-gradient(to bottom, #FCF6BA, #BF953F);">Update</button>
                                            <button type="button" id="btnCancel"
                                                class=" btn btn-warning btn-rounded ml-5"
                                                style="color: black;width:250px; font-weight: bold; background: linear-gradient(to bottom, #FCF6BA, #BF953F);">Cancel</button>
                                        </div>

                                    </div>

                                </form>

                            </div>
                            <!-- End of Main Content -->
                        </div>
                        <div class="col-lg-3 py-3" id="containerUDF" style="background-color: #F5F5F5; ">
                            <select type="text" class="form-control " id="selCurrency" placeholder="" readonly>
                                <option value='All'>All Categories</option>
                            </select>
                            <div class="card-body ">
                                <div id="udfvalueloader" class="d-none"></div>
                                <div class="form-group  px-0 mx-0"
                                    style="width:100% !important; overflow-y: scroll !important; overflow-x: hidden; height: 800px;"
                                    id="udfResult">

                                </div>
                            </div>
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
    <div class="modal fade " id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true" data-backdrop="false" style="margin-top: 300px !important;">
        <div class="modal-dialog modal-xl" role="document" style="width:100%">
            <!--Content-->
            <div class="modal-content-full-width modal-content">
                <!--Header-->
                <div class="modal-header"
                    style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e; ">
                    <h4 class="modal-title w-100" id="myModalLabel" style="color:black; font-size:15px !important;">
                        Logout</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body">
                    <h6 class="modal-title w-100" id="myModalLabel" style="color:black">Do you want to logout?</h6>
                </div>
                <!--Footer-->
                <div class="modal-footer" style="background-color: none !important;">
                    <button id="btnLogoutConfirm" type="button" class="btn btn-secondary"
                        data-dismiss="modal">Yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>
    <!-- Logout Modal -->

    <!-- Loading Modal -->
    <div class="modal fade" id="loadModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
        data-backdrop="false">
        <div class="modal-dialog modal-xl" role="document" style="width:400px !important;">
            <!--Content-->
            <div class=" modal-content">
                <!--Header-->
                <div class="modal-header "
                    style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
                </div>
                <!--Body-->

                <div class="text-center  ">
                    <div class="row ">
                        <div class="col-12">
                            <img src="../../../img/wait.gif" width=400 height=100
                                style=" background-color: none !important;margin-top:0px !important">
                        </div>
                    </div>
                    <!--<img src="https://media.giphy.com/media/XpgOZHuDfIkoM/source.gif">-->
                    <!--<img src="https://media.giphy.com/media/veAy5UOhBdS3C/source.gif" width='1200px' height="800px">-->
                </div>

                <!--Footer-->
                <div class="modal-footer"
                    style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e; padding: 7px !important">
                </div>

                <!--/.Content-->
            </div>
        </div>
    </div>
    <!-- Loading Modal -->

    <!-- Document Modal -->
    <div class="modal fade" id="documentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document" style="width:100%">
            <!--Content-->
            <div class="modal-content-full-width modal-content">
                <!--Header-->
                <div class="modal-header"
                    style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
                    <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of Incoming Payments</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body">
                    <div class="row mb-3">
						<div class="col-sm-2" >
							<label for="inputEmail3" class=" col-form-label " style="color: black;" >Search</label>
						</div>
						<div class="col-4">					
							<div class="input-group mb-1">
								<input type="text" id="txtDocumentSearch" class="form-control" placeholder="" style="border-bottom-left-radius:5px; border-top-left-radius:5px;">
								<div class="input-group-append">
									<button id="btnDocumentSearch" class="btn btnGroup" type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  >
										<i class="fa fa-search" tabindex=0 style="color:blue "></i>
									</button>
								</div>
							</div>
						</div>
					</div>
                    <table class="table table-striped table-bordered table-hover" id="tblDoc" style="width:100%">
                        
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

    <!-- Copy From SQ Modal -->
    <div class="modal fade" id="salesQuotationModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document" style="width:100%">
            <!--Content-->
            <div class="modal-content-full-width modal-content">
                <!--Header-->
                <div class="modal-header"
                    style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
                    <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of Sales Quotation</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body">
                    <div id="salesQuotationResult"></div>
                </div>
                <!--Footer-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>
    <!-- Copy From SQ Modal -->

    <!-- Business Partner Modal -->
    <div class="modal fade" id="bpModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document" style="width:100%">
            <!--Content-->
            <div class="modal-content-full-width modal-content">
                <!--Header-->
                <div class="modal-header"
                    style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
                    <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of Customer</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body">
                    <div class="row mb-3">
						<div class="col-sm-2" >
							<label for="inputEmail3" class=" col-form-label " style="color: black;" >Search</label>
						</div>
						<div class="col-4">					
							<div class="input-group mb-1">
								<input type="text" id="txtCardCodeSearch" class="form-control" placeholder="" style="border-bottom-left-radius:5px; border-top-left-radius:5px;">
								<div class="input-group-append">
									<button id="btnCardCodeSearch" class="btn btnGroup" type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  >
										<i class="fa fa-search" tabindex=0 style="color:blue "></i>
									</button>
								</div>
							</div>
						</div>
					</div>
                    <table class="tblBP table table-striped table-bordered table-hover" id="tblBP" style="width: 100%">
                        
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
    <!-- Business Partner Modal -->
    <div class="modal fade" id="bpModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document" style="width:100%">
           
            <div class="modal-content-full-width modal-content">
               
                <div class="modal-header"
                    style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
                    <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of Vendors</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <table class="tblBP table table-striped table-bordered table-hover" id="tblBP2" style="width: 100%">
                     
                    </table>
                </div>
               
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
           
        </div>
    </div> 
    <!-- Business Partner Modal -->

    <!-- Contact Person Modal -->
    <div class="modal fade" id="contactPersonModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document" style="width:100%">
            <!--Content-->
            <div class="modal-content-full-width modal-content">
                <!--Header-->
                <div class="modal-header"
                    style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
                    <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of Contact Persons</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body">
                    <div id="contactPersonResult"></div>

                </div>
                <!--Footer-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>
    <!-- Contact Person Modal -->

<!-- Employee Modal -->
<div class="modal fade" id="empModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-dialog modal-xl" role="document" style="width:100%">
        <!--Content-->
        <div class="modal-content-full-width modal-content">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
            <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of Employee</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->
          <div class="modal-body">
            <table class="table table-striped table-bordered table-hover" id="tblEmployee" style="width:100%">
						<thead>
							<tr>
								<th >#</th>
								<th class="d-none">Employee Code</th>
								<th>Employee Name</th>
								
							</tr>
						</thead>
						<tbody>
						<?php
							$itemno = 1;
							$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT DISTINCT
																						T0.EmpId, 
																						T0.LastName + ', ' + T0.FirstName AS Name
																						
																						
																						FROM OHEM T0
																						
																						ORDER BY T0.EmpId ASC");
								while (odbc_fetch_row($qry)) 
								{
									echo '<tr class="">
												<td>'.$itemno.'</td>
												<td class="item-1 d-none">'.odbc_result($qry, 'EmpId').'</td>
												<td class="item-2">'.odbc_result($qry, 'Name').'</td>
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
    <!-- Payment Terms Modal -->
    <div class="modal fade" id="paymentTermsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document" style="width:100%">
            <!--Content-->
            <div class="modal-content-full-width modal-content">
                <!--Header-->
                <div class="modal-header"
                    style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
                    <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of Payment Terms</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body">
                    <table class="table table-striped table-bordered table-hover" id="tblPaymentTerms"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="d-none">Payment Code</th>
                                <th>Payment Name</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
							$itemno = 1;
							$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT DISTINCT
																						T0.GroupNum,
																						T0.PymntGroup
																						
																						FROM OCTG T0
																						
																						ORDER BY T0.GroupNum ASC");
								while (odbc_fetch_row($qry)) 
								{
									echo '<tr class="">
												<td>'.$itemno.'</td>
												<td class="item-1 d-none">'.odbc_result($qry, 'GroupNum').'</td>
												<td class="item-2">'.odbc_result($qry, 'PymntGroup').'</td>
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
    <!-- payment Terms Modal -->

    


    <!-- Unit of Measure Modal -->
    <div class="modal fade" id="uomModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document" style="width:100%">
            <!--Content-->
            <div class="modal-content-full-width modal-content">
                <!--Header-->
                <div class="modal-header"
                    style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
                    <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of Unit of Measure</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body">
                    <div id="uomModalResult"></div>
                </div>
                <!--Footer-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>
    <!-- Unit of Measure Modal -->

    <!-- GL Modal -->
    <div class="modal fade" id="glModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document" style="width:100%">
            <!--Content-->
            <div class="modal-content-full-width modal-content">
                <!--Header-->
                <div class="modal-header"
                    style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
                    <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of G/L Accounts</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body">
                    <table class="table table-striped table-bordered table-hover" id="tblGL">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Account Number</th>
                                <th>Account Name</th>
                                <th>Account Balance</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
							$itemno = 1;
							$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT DISTINCT
																						T0.AcctCode, 
																						T0.AcctName, 
																						T0.CurrTotal
																						
																						FROM OACT T0 
																						WHERE T0.Postable = 'Y' AND T0.LocManTran = 'Y'
																						


																						ORDER BY T0.AcctCode ASC");
								while (odbc_fetch_row($qry)) 
								{
									echo '<tr class="">
												<td>'.$itemno.'</td>
												<td class="item-1">'.odbc_result($qry, 'AcctCode').'</td>
												<td class="item-2">'.odbc_result($qry, 'AcctName').'</td>
												<td class="item-3 " >'.odbc_result($qry, 'CurrTotal').'</td>
												
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
    <!-- GL Modal -->

    <!-- Ship To Details Modal -->
    <div class="modal fade" id="shipToDetailsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document"
            style="width:100%; ">
            <!--Content-->
            <div class="modal-content-full-width modal-content" style="height: 500px;">
                <!--Header-->
                <div class="modal-header"
                    style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
                    <h4 class="modal-title w-100" id="myModalLabel" style="color:black">Address Component</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body">
                    <div class="form-group row my-1">
                        <label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2" style="color: black;">Street
                            / PO Box</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control shipInputs" id="txtStreetPOBoxS" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row  my-1">
                        <label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2" style="color: black;">Street
                            No.</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control shipInputs" id="txtStreetNoS" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row   my-1">
                        <label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2"
                            style="color: black;">Block</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control shipInputs" id="txtBlockS" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row   my-1">
                        <label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2"
                            style="color: black;">City</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control shipInputs" id="txtCityS" placeholder=""
                                autocomplete=false>
                        </div>
                    </div>
                    <div class="form-group row   my-1">
                        <label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2" style="color: black;">Zip
                            Code</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control shipInputs" id="txtZipCodeS" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row   my-1">
                        <label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2"
                            style="color: black;">County</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control shipInputs" id="txtCountyS" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row   my-1">
                        <label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2"
                            style="color: black;">State</label>
                        <div class="input-group mb-1 col-sm-9">
                            <input type="text" id="txtStateS" class="form-control shipInputs d-none" placeholder="">
                            <input type="text" id="txtStateSName" class="form-control shipInputs" placeholder=""
                                readonly>
                            <div class="input-group-append">
                                <button class="btn btnGroup" type="button" data-mdb-ripple-color="dark"
                                    style="background-color: #ADD8E6; " data-toggle="modal" data-target="#stateModalS"
                                    data-backdrop="false">
                                    <i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue "></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row   my-1">
                        <label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2"
                            style="color: black;">Country</label>
                        <div class="input-group mb-1 col-sm-9">
                            <input type="text" id="txtCountryS" class="form-control shipInputs d-none" placeholder=""
                                readonly>
                            <input type="text" id="txtCountrySName" class="form-control shipInputs" placeholder=""
                                readonly>
                            <div class="input-group-append">
                                <button class="btn btnGroup" type="button" data-mdb-ripple-color="dark"
                                    style="background-color: #ADD8E6; " data-toggle="modal" data-target="#countryModal"
                                    data-backdrop="false">
                                    <i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue "></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row   my-1">
                        <label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2"
                            style="color: black;">Building / Floor / Room</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control shipInputs" id="txtBuildingS" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row   my-1">
                        <label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2" style="color: black;">Address
                            Name 2</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control shipInputs" id="txtAdress2" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row   my-1">
                        <label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2" style="color: black;">Address
                            Name 3</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control shipInputs" id="txtAdress3" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row   my-1">
                        <label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2"
                            style="color: black;">GLN</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control shipInputs" id="txtGLNS" placeholder="">
                        </div>
                    </div>

                </div>
                <!--Footer-->
                <div class="modal-footer">
                    <button type="button" id="btnShipToAddressOk" class="btn btn-secondary "
                        data-dismiss="modal">Ok</button>
                    <button type="button" id="btnShipToAddressUpdate" class="btn btn-secondary d-none"
                        data-dismiss="modal">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>
    <!-- Ship To Details Modal -->



    <!-- Bill To Details Modal -->
    <div class="modal fade" id="billToDetailsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document"
            style="width:100%; ">
            <!--Content-->
            <div class="modal-content-full-width modal-content" style="height: 500px;">
                <!--Header-->
                <div class="modal-header"
                    style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
                    <h4 class="modal-title w-100" id="myModalLabel" style="color:black">Address Component</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body">
                    <div class="form-group row my-1">
                        <label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2" style="color: black;">Street
                            / PO Box</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control billInputs" id="txtStreetPOBoxB" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row  my-1">
                        <label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2" style="color: black;">Street
                            No.</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control billInputs" id="txtStreetNoB" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row   my-1">
                        <label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2"
                            style="color: black;">Block</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control billInputs" id="txtBlockB" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row   my-1">
                        <label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2"
                            style="color: black;">City</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control billInputs" id="txtCityB" placeholder=""
                                autocomplete=false>
                        </div>
                    </div>
                    <div class="form-group row   my-1">
                        <label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2" style="color: black;">Zip
                            Code</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control billInputs" id="txtZipCodeB" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row   my-1">
                        <label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2"
                            style="color: black;">County</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control billInputs" id="txtCountyB" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row   my-1">
                        <label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2"
                            style="color: black;">State</label>
                        <div class="input-group mb-1 col-sm-9">
                            <input type="text" id="txtStateB" class="form-control billInputs d-none" placeholder="">
                            <input type="text" id="txtStateBName" class="form-control billInputs" placeholder=""
                                readonly>
                            <div class="input-group-append btnGroup">
                                <button class="btn" type="button" data-mdb-ripple-color="dark"
                                    style="background-color: #ADD8E6; " data-toggle="modal" data-target="#stateModalB"
                                    data-backdrop="false">
                                    <i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue "></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row   my-1">
                        <label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2"
                            style="color: black;">Country</label>
                        <div class="input-group mb-1 col-sm-9">
                            <input type="text" id="txtCountryB" class="form-control billInputs d-none" placeholder=""
                                readonly>
                            <input type="text" id="txtCountryBName" class="form-control billInputs" placeholder=""
                                readonly>
                            <div class="input-group-append btnGroup">
                                <button class="btn" type="button" data-mdb-ripple-color="dark"
                                    style="background-color: #ADD8E6; " data-toggle="modal" data-target="#countryModal"
                                    data-backdrop="false">
                                    <i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue "></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row   my-1">
                        <label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2"
                            style="color: black;">Building / Floor / Room</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control billInputs" id="txtBuildingB" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row   my-1">
                        <label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2" style="color: black;">Address
                            Name 2</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control billInputs" id="txtAdressB" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row   my-1">
                        <label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2" style="color: black;">Address
                            Name 3</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control billInputs" id="txtAdressB" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row   my-1">
                        <label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2"
                            style="color: black;">GLN</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control billInputs" id="txtGLNB" placeholder="">
                        </div>
                    </div>

                </div>
                <!--Footer-->
                <div class="modal-footer">
                    <button type="button" id="btnBillToAddressOk" class="btn btn-secondary "
                        data-dismiss="modal">Ok</button>
                    <button type="button" id="btnBillToAddressUpdate" class="btn btn-secondary d-none"
                        data-dismiss="modal">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>
    <!-- Bill To Details Modal -->

    <!-- Country Modal to Ship -->
    <div class="modal fade" id="countryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document" style="width:100%">
            <!--Content-->
            <div class="modal-content-full-width modal-content">
                <!--Header-->
                <div class="modal-header"
                    style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
                    <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of Countries</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body">
                    <table class="table table-striped table-bordered table-hover" id="tblCountryS" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Country Code</th>
                                <th>Country Name</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
							$itemno = 1;
							$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT DISTINCT
																						T0.Code, 
																						T0.Name
																						
																						
																						FROM OCRY T0
																						
																						ORDER BY T0.Code ASC");
								while (odbc_fetch_row($qry)) 
								{
									echo '<tr class="">
												<td>'.$itemno.'</td>
												<td class="item-1">'.odbc_result($qry, 'Code').'</td>
												<td class="item-2">'.odbc_result($qry, 'Name').'</td>
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
    <!-- Country Modal to Ship -->

    <!-- State Modal -->
    <div class="modal fade" id="stateModalS" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document" style="width:100%">
            <!--Content-->
            <div class="modal-content-full-width modal-content">
                <!--Header-->
                <div class="modal-header"
                    style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
                    <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of States</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body">
                    <table class="table table-striped table-bordered table-hover" id="tblStates" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>State Code</th>
                                <th>State Name</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
							$itemno = 1;
							$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT DISTINCT
																						T0.Code, 
																						T0.Name
																						
																						
																						FROM OCST T0
																						
																						ORDER BY T0.Code ASC");
								while (odbc_fetch_row($qry)) 
								{
									echo '<tr class="">
												<td>'.$itemno.'</td>
												<td class="item-1">'.odbc_result($qry, 'Code').'</td>
												<td class="item-2">'.odbc_result($qry, 'Name').'</td>
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

    <div style="display:none;height:200px;width:200px;border:3px solid green;" id="popup">Hi</div>
    <!-- State Modal -->
    <!-- Payment Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document"
            style="width:100%; ">
            <!--Content-->
            <div class="modal-content-full-width modal-content" style="height: 1000px; width: 1800px;">
                <!--Header-->
                <div class="modal-header"
                    style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
                    <h4 class="modal-title w-100" id="myModalLabel" style="color:black">Payment Means</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body">
                    <ul class="nav nav-tabs pt-2" id="myTab" role="tablist">
                        <li class="nav-item " >
                            <a class="nav-link  active" id="" data-toggle="tab" href="#check" role="tab"
                                aria-controls="contents" aria-selected="true"
                                style="color: black; font-weight:bold">Check</a>
                        </li>
                        <li class="nav-item " >
                            <a class="nav-link  " id="" data-toggle="tab" href="#transfer" role="tab"
                                aria-controls="contents" aria-selected="true"
                                style="color: black; font-weight:bold">Bank Transfer</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link  " id="" data-toggle="tab" href="#cash" role="tab"
                                aria-controls="contents" aria-selected="true"
                                style="color: black; font-weight:bold">Cash</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent" style="padding-top: 10px;">
                        <div class="tab-pane fade show active" id="check" role="tabpanel" aria-labelledby="attachments">
                            <div id="contentContainer" class="table-responsive"
                                style="width:100%; padding-bottom:20px; padding-left:10px; padding-right:10px;  overflow-x:hidden;  overflow-y:hidden;">
                                <div id="checks-tab" class="py-5">

                                </div>
                                <hr />
                                <label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-5"
                                    style="color: black;">Total Check Amount</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control billInputs text-right"
                                        id="txtCheckAmountTotal" placeholder="" value=0.00>
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane fade " id="cash" role="tabpanel" aria-labelledby="contents">
                            <div id="contentContainer" class="table-responsive"
                                style="width:100%; padding-bottom:20px; padding-left:10px; overflow-x:hidden;  overflow-y:hidden;">
                                <div id="cash-tab">
                                    <div class="form-group row   my-1">
                                        <div class="col-sm-6">
                                            <label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2"
                                                style="color: black;">G/L Account</label>
                                            <div class="input-group mb-1 col-sm-9">
                                                <input type="text" id="txtCashGLCode" class="form-control billInputs"
                                                    placeholder="" readonly>
                                                <div class="input-group-append btnGroup">
                                                    <button class="btn" type="button" data-mdb-ripple-color="dark"
                                                        style="background-color: #ADD8E6; " data-toggle="modal"
                                                        data-target="#glModalCash" data-backdrop="false">
                                                        <i class="fas fa-list-ul input-prefix" tabindex=0
                                                            style="color:blue "></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2"
                                                style="color: black;">G/L Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control billInputs" id="txtCashGLName"
                                                    placeholder="" readonly>
                                            </div>
                                            <label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2"
                                                style="color: black;">Overall Amount</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control billInputs  text-right"
                                                    id="txtOverallAmount" placeholder="" value=0.00 readonly>
                                            </div>
                                            <label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2"
                                                style="color: black;">Balance Due</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control billInputs  text-right"
                                                    id="txtBalanceAmount" placeholder="" value=0.00 readonly>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2"
                                                style="color: black;">Total</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control billInputs  text-right"
                                                    id="txtCashAmount" placeholder="" value=0.00>
                                            </div>
                                            <label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2"
                                                style="color: black;">Bank Charge</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control billInputs  text-right"
                                                    id="txtChargeAmount" placeholder="" value=0.00 >
                                            </div>
                                            <label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2"
                                                style="color: black;" readonly>Paid</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control billInputs  text-right"
                                                    id="txtPaidAmount" placeholder="" value=0.00 readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <hr />
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane fade " id="transfer" role="tabpanel" aria-labelledby="attachments">
                            <div id="contentContainer" class="table-responsive"
                                style="width:100%; padding-bottom:20px; padding-left:10px; padding-right:10px;  overflow-x:hidden;  overflow-y:hidden;">
                                <div id="transfer-tab">
                                    <div class="form-group row   my-1">
                                        <div class="col-sm-6">
                                            <label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2"
                                                style="color: black;">G/L Account</label>
                                            <div class="input-group mb-1 col-sm-9">
                                                <input type="text" id="txtTransferGLCode"
                                                    class="form-control billInputs" placeholder="" readonly>
                                                <div class="input-group-append btnGroup">
                                                    <button class="btn" type="button" data-mdb-ripple-color="dark"
                                                        style="background-color: #ADD8E6; " data-toggle="modal"
                                                        data-target="#glModalTransfer" data-backdrop="false">
                                                        <i class="fas fa-list-ul input-prefix" tabindex=0
                                                            style="color:blue "></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2"
                                                style="color: black;">G/L Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control billInputs"
                                                    id="txtTransferGLName" placeholder="" readonly>
                                            </div>
                                            <label for="inputEmail3" class="col-sm-3 col-form-label "
                                                style="color: black;">Transfer Date</label>
                                            <div class="col-sm-1 ">
                                            </div>
                                            <div class="col-sm-9 input-group mb-1 ">
                                                <input type="text" id="txtTransferDate2" class="form-control col-10"
                                                    value="" min="01-01-2018" max="12-31-2050">
                                                <input type="date" id="txtTransferDate"
                                                    class="form-control col-2 transferdate"
                                                    value="" min="01-01-2018"
                                                    max="12-31-2050" style="color:transparent !important; ">

                                            </div>


                                            <label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2"
                                                style="color: black;">Transfer Ref</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control billInputs" id="txtTransferRef"
                                                    placeholder="">
                                            </div>
                                            <label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2"
                                                style="color: black;">Transfer Sum</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control billInputs text-right"
                                                    id="txtTransferAmount" placeholder="" value=0.00>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <hr />
                            </div>
                        </div>


                    </div>
                </div>
                <!--Footer-->
                <div class="modal-footer">
                    <button type="button" id="btnShipToAddressOk" class="btn btn-secondary "
                        data-dismiss="modal">Ok</button>
                    <button type="button" id="btnShipToAddressUpdate" class="btn btn-secondary d-none"
                        data-dismiss="modal">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>
    <!-- Ship To Details Modal -->
    <!-- GL Modal -->
    <div class="modal fade" id="glModalCash" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document" style="width:100%">
            <!--Content-->
            <div class="modal-content-full-width modal-content">
                <!--Header-->
                <div class="modal-header"
                    style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
                    <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of G/L Accounts</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body">
                    <table class="table table-striped table-bordered table-hover" id="tblGLCash">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Account Number</th>
                                <th>Account Name</th>
                                <th>Account Balance</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
							$itemno = 1;
							$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT DISTINCT
																						T0.AcctCode, 
																						T0.AcctName, 
																						T0.CurrTotal
																						
																						FROM OACT T0
																					
																						ORDER BY T0.AcctCode ASC");
								while (odbc_fetch_row($qry)) 
								{
									echo '<tr class="">
												<td>'.$itemno.'</td>
												<td class="item-1">'.odbc_result($qry, 'AcctCode').'</td>
												<td class="item-2">'.odbc_result($qry, 'AcctName').'</td>
												<td class="item-3 " >'.odbc_result($qry, 'CurrTotal').'</td>
												
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
    <!-- GL Modal -->
    <!-- GL Modal -->
    <div class="modal fade" id="glModalTransfer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document" style="width:100%">
            <!--Content-->
            <div class="modal-content-full-width modal-content">
                <!--Header-->
                <div class="modal-header"
                    style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
                    <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of G/L Accounts</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body">
                    <table class="table table-striped table-bordered table-hover" id="tblGLTransfer">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Account Number</th>
                                <th>Account Name</th>
                                <th>Account Balance</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
							$itemno = 1;
							$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT DISTINCT
																						T0.AcctCode, 
																						T0.AcctName, 
																						T0.CurrTotal
																						
																						FROM OACT T0
																						WHERE T0.Finanse = 'Y' AND T0.Postable = 'Y'
																						ORDER BY T0.AcctCode ASC");
								while (odbc_fetch_row($qry)) 
								{
									echo '<tr class="">
												<td>'.$itemno.'</td>
												<td class="item-1">'.odbc_result($qry, 'AcctCode').'</td>
												<td class="item-2">'.odbc_result($qry, 'AcctName').'</td>
												<td class="item-3 " >'.odbc_result($qry, 'CurrTotal').'</td>
												
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
    <!-- GL Modal -->
    <!-- GL Modal -->
    <div class="modal fade" id="glModalPayNoDoc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document" style="width:100%">
            <!--Content-->
            <div class="modal-content-full-width modal-content">
                <!--Header-->
                <div class="modal-header"
                    style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
                    <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of G/L Accounts</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body">
                    <table class="table table-striped table-bordered table-hover" id="tblGLPayNoDoc">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Account Number</th>
                                <th>Account Name</th>
                                <th>Account Balance</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
							$itemno = 1;
							$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT DISTINCT
																						T0.AcctCode, 
																						T0.AcctName, 
																						T0.CurrTotal
																						
																						FROM OACT T0
																						WHERE T0.Postable = 'Y' AND T0.LocManTran = 'Y'
																						ORDER BY T0.AcctCode ASC");
								while (odbc_fetch_row($qry)) 
								{
									echo '<tr class="">
												<td>'.$itemno.'</td>
												<td class="item-1">'.odbc_result($qry, 'AcctCode').'</td>
												<td class="item-2">'.odbc_result($qry, 'AcctName').'</td>
												<td class="item-3 " >'.odbc_result($qry, 'CurrTotal').'</td>
												
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
    <!-- GL Modal -->
    <!-- OcrCode Vendor Modal -->
    <div class="modal fade" id="ocrCodeModalVendorType" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document" style="width:100%">
            <!--Content-->
            <div class="modal-content-full-width modal-content">
                <!--Header-->
                <div class="modal-header"
                    style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
                    <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of G/L Accounts</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body">
                    <table class="table table-striped table-bordered table-hover" id="tblOcrCodeVendor">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Account Number</th>
                                <th>Account Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
							$itemno = 1;
							$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
																						SELECT 
																								T0.OcrCode,
																								T0.OcrName
																								FROM OOCR T0
																						ORDER BY T0.OcrCode ASC");
								while (odbc_fetch_row($qry)) 
								{
									echo '<tr class="">
												<td>'.$itemno.'</td>
												<td class="item-1">'.odbc_result($qry, 'OcrCode').'</td>
												<td class="item-2">'.odbc_result($qry, 'OcrName').'</td>
												
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
    <!-- OcrCode Vendor Modal -->
    <!-- OcrCode2 Vendor Modal -->
    <div class="modal fade" id="ocrCode2ModalVendorType" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document" style="width:100%">
            <!--Content-->
            <div class="modal-content-full-width modal-content">
                <!--Header-->
                <div class="modal-header"
                    style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
                    <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of G/L Accounts</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body">
                    <table class="table table-striped table-bordered table-hover" id="tblOcrCode2Vendor">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Account Number</th>
                                <th>Account Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
							$itemno = 1;
							$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
																						SELECT 
																								T0.OcrCode,
																								T0.OcrName
																								FROM OOCR T0
																						ORDER BY T0.OcrCode ASC");
								while (odbc_fetch_row($qry)) 
								{
									echo '<tr class="">
												<td>'.$itemno.'</td>
												<td class="item-1">'.odbc_result($qry, 'OcrCode').'</td>
												<td class="item-2">'.odbc_result($qry, 'OcrName').'</td>
												
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
    <!-- OcrCode2 Vendor Modal -->
    <!-- OcrCode3 Vendor Modal -->
    <div class="modal fade" id="ocrCode3ModalVendorType" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document" style="width:100%">
            <!--Content-->
            <div class="modal-content-full-width modal-content">
                <!--Header-->
                <div class="modal-header"
                    style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
                    <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of G/L Accounts</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body">
                    <table class="table table-striped table-bordered table-hover" id="tblOcrCode3Vendor">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Account Number</th>
                                <th>Account Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
							$itemno = 1;
							$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
																						SELECT 
																								T0.OcrCode,
																								T0.OcrName
																								FROM OOCR T0
																						ORDER BY T0.OcrCode ASC");
								while (odbc_fetch_row($qry)) 
								{
									echo '<tr class="">
												<td>'.$itemno.'</td>
												<td class="item-1">'.odbc_result($qry, 'OcrCode').'</td>
												<td class="item-2">'.odbc_result($qry, 'OcrName').'</td>
												
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
    <!-- Ocr3Code Vendor Modal -->
    <!-- OcrCode Modal -->
    <div class="modal fade" id="ocrCodeModalAcctType" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document" style="width:100%">
            <!--Content-->
            <div class="modal-content-full-width modal-content">
                <!--Header-->
                <div class="modal-header"
                    style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
                    <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of G/L Accounts</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body">
                    <table class="table table-striped table-bordered table-hover" id="tblOcrCodeAccount">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Account Number</th>
                                <th>Account Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
							$itemno = 1;
							$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
																						SELECT 
																								T0.OcrCode,
																								T0.OcrName
																								FROM OOCR T0

																								WHERE T0.DimCode = 1
																						ORDER BY T0.OcrCode ASC");
								while (odbc_fetch_row($qry)) 
								{
									echo '<tr class="">
												<td>'.$itemno.'</td>
												<td class="item-1">'.odbc_result($qry, 'OcrCode').'</td>
												<td class="item-2">'.odbc_result($qry, 'OcrName').'</td>
												
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
    <!-- OcrCode Modal -->
    <!-- OcrCode2 Modal -->
    <div class="modal fade" id="ocrCode2ModalAcctType" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document" style="width:100%">
            <!--Content-->
            <div class="modal-content-full-width modal-content">
                <!--Header-->
                <div class="modal-header"
                    style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
                    <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of G/L Accounts</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body">
                    <table class="table table-striped table-bordered table-hover" id="tblOcrCode2Account">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Account Number</th>
                                <th>Account Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
							$itemno = 1;
							$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
																						SELECT 
																								T0.OcrCode,
																								T0.OcrName
																								FROM OOCR T0

																								WHERE T0.DimCode = 2
																						ORDER BY T0.OcrCode ASC");
								while (odbc_fetch_row($qry)) 
								{
									echo '<tr class="">
												<td>'.$itemno.'</td>
												<td class="item-1">'.odbc_result($qry, 'OcrCode').'</td>
												<td class="item-2">'.odbc_result($qry, 'OcrName').'</td>
												
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
    <!-- OcrCode2 Modal -->
    <!-- OcrCode3 Modal -->
    <div class="modal fade" id="ocrCode3ModalAcctType" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document" style="width:100%">
            <!--Content-->
            <div class="modal-content-full-width modal-content">
                <!--Header-->
                <div class="modal-header"
                    style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
                    <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of G/L Accounts</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body">
                    <table class="table table-striped table-bordered table-hover" id="tblOcrCode3Account">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Account Number</th>
                                <th>Account Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
							$itemno = 1;
							$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
																						SELECT 
																								T0.OcrCode,
																								T0.OcrName
																								FROM OOCR T0

																								WHERE T0.DimCode = 3
																						ORDER BY T0.OcrCode ASC");
								while (odbc_fetch_row($qry)) 
								{
									echo '<tr class="">
												<td>'.$itemno.'</td>
												<td class="item-1">'.odbc_result($qry, 'OcrCode').'</td>
												<td class="item-2">'.odbc_result($qry, 'OcrName').'</td>
												
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
    <!-- Ocr3Code Modal -->
    <!-- Account FMS Modal -->
    <div class="modal fade" id="acctFMSModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document" style="width:100%">
            <!--Content-->
            <div class="modal-content-full-width modal-content">
                <!--Header-->
                <div class="modal-header"
                    style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
                    <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of G/L Accounts</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body">
                    <div id="AccountFMS">
                    </div>
                </div>
                <!--Footer-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>
    <!-- GL Modal -->
    <!-- UDF Modal -->
    <div class="modal fade" id="udfModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document" style="width:100%">
            <!--Content-->
            <div class="modal-content-full-width modal-content">
                <!--Header-->
                <div class="modal-header"
                    style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
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
    <script src="../script/incoming-payments-utilities.js"></script>
    <script src="../script/incoming-payments.js"></script>
    <script src="../script/udf.js"></script>
    <script src="../../style.js"></script>

    <script>
    $('#tblItem').dataTable({
        "bLengthChange": false,
    });
    </script>
 

    <script>
    $('#tblSalesEmployee').dataTable({
        "bLengthChange": false,
    });
    </script>
    <script>
    $('#tblEmployee').dataTable({
        "bLengthChange": false,
    });
    </script>
    <script>
    $('#tblPaymentTerms').dataTable({
        "bLengthChange": false,
    });
    </script>
    <script>
    $('#tblCountry').dataTable({
        "bLengthChange": false,
    });
    </script>
    <script>
    $('#tblStates').dataTable({
        "bLengthChange": false,
    });
    </script>

    <script>
    $('#tblGLCash').dataTable({
        "bLengthChange": false,
    });
    </script>

    <script>
    $('#tblGLTransfer').dataTable({
        "bLengthChange": false,
    });
    </script>

    <script>
    $('#tblGL').dataTable({
        "bLengthChange": false,
    });
    </script>
    <script>
    $('#tblAccountFMS').dataTable({
        "bLengthChange": false,
    });
    </script>

    <script>
    $('#tblOcrCodeVendor').dataTable({
        "bLengthChange": false,
    });
    </script>
    <script>
    $('#tblOcrCode2Vendor').dataTable({
        "bLengthChange": false,
    });
    </script>
    <script>
    $('#tblOcrCode3Vendor').dataTable({
        "bLengthChange": false,
    });
    </script>
    <script>
    $('#tblOcrCodeAccount').dataTable({
        "bLengthChange": false,
    });
    </script>
    <script>
    $('#tblOcrCode2Account').dataTable({
        "bLengthChange": false,
    });
    </script>
    <script>
    $('#tblOcrCode3Account').dataTable({
        "bLengthChange": false,
    });
    $('#tblGLPayNoDoc').dataTable({
        "bLengthChange": false,
    });
    </script>








    <?php
	include '../../bottom.php' 
?>