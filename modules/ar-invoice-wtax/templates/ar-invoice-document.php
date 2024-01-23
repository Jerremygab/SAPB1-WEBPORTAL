<?php

	include '../../head.php' ;

?>

<!-- Page Wrapper -->
<div id="wrapper">
    <?php
	include '../../sidebar.php';
	
	$EmpId = $_SESSION['SESS_EMP'];
	$UserId = $_SESSION['SESS_USERID'];
	$UserCode = $_SESSION['SESS_USERCODE'];
	$UserName = $_SESSION['SESS_NAME'];
	?>

    <?php
	$ARInvoiceArr = array(
		"cardType" => "C",
		"taxCodeCategory" => "O",
		"mainFileName" => "ar-invoice",
		"objectTableName" => "A/R Invoice",
		"objectTable" => "OINV",
		"objectType" => 13,
		"childTable1" => "INV1",
		"childTable12" => "INV12",
		"childTable21" => "INV21",
		"copyFromArr" => array(
			array(
				"baseTableName" => "Sales Quotation",
				"baseTable" => "OQUT",
				"baseChildTable1" => "QUT1",
				"baseType" => 23,
				"copyFromModal" => 'salesQuotation',
				"copyFromModalTbl" => 'SQ'
			),
			array(
				"baseTableName" => "Sales Order",
				"baseTable" => "ORDR",
				"baseChildTable1" => "RDR1",
				"baseType" => 17,
				"copyFromModal" => 'salesOrder',
				"copyFromModalTbl" => 'SO'
			),
			array(
				"baseTableName" => "Delivery",
				"baseTable" => "ODLN",
				"baseChildTable1" => "DLN1",
				"baseType" => 15,
				"copyFromModal" => 'delivery',
				"copyFromModalTbl" => 'DR'
			)
		)
	);

	$_SESSION['ARInvoiceArr'] = json_encode($ARInvoiceArr);

	$_SESSION['cardType'] = $ARInvoiceArr['cardType'];
	$_SESSION['mainFileName'] = $ARInvoiceArr['mainFileName'];
	$_SESSION['objectTableName'] = $ARInvoiceArr['objectTableName'];
	$_SESSION['objectTable'] = $ARInvoiceArr['objectTable'];
	$_SESSION['objectType'] = $ARInvoiceArr['objectType'];
?>

    <script type="text/javascript">
    let obj = JSON.parse('<?php echo $_SESSION['ARInvoiceArr']; ?>');

    sessionStorage.clear();

    sessionStorage.setItem('SAPDateFormat', '<?php echo $_SESSION['SAPDateFormat']; ?>');
    sessionStorage.setItem('mainFileName', obj.mainFileName);
    sessionStorage.setItem('objectTable', obj.objectTable);
    sessionStorage.setItem('objectTableName', obj.objectTableName);
    sessionStorage.setItem('objectType', obj.objectType);
    sessionStorage.setItem('childTable1', obj.childTable1);
    sessionStorage.setItem('childTable12', obj.childTable12);
    sessionStorage.setItem('childTable21', obj.childTable21);
    sessionStorage.setItem('copyFromArr', JSON.stringify(obj.copyFromArr));
    sessionStorage.setItem('objectTablesArr', '<?php echo $_SESSION['objectTablesArr']; ?>');
    </script>


    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

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
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <h5 class="mt-2 font-weight-bold " style="color: black;">
                                            <?php echo $_SESSION['objectTableName']; ?></h5>
                                    </div>

                                </div>
                            </div>
                            <div class="card-body " id="window"
                                style="background-color: #F5F5F5; border-right: 1px solid #A0A0A0">
                                <form class="user responsive " id="form" width="100%">
                                    <div class="row pr-0 " width="100%">
                                        <div class="col-lg-4 pb-2" id="bpCol">
                                            <div class="form-group row py-0 my-0">
                                                <div class="col-sm-3">
                                                    <label for="inputEmail3" class=" col-form-label "
                                                        style="color: black;">Customer</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="input-group mb-1">
                                                        <div class="input-group-prepend d-none" id="lnkCardCode">
                                                            <button class="btn" type="button"
                                                                data-mdb-ripple-color="dark"
                                                                style="background-color: #ADD8E6;" data-toggle="modal"
                                                                data-target="#bpMasterModal" data-backdrop="false">
                                                                <i class="fas fa-arrow-right  "
                                                                    style="color: #FFD700; font-size:20px"></i>
                                                            </button>
                                                        </div>
                                                        <input readonly type="text" id="txtCardCode"
                                                            class="form-control" placeholder="" aria-label="Username"
                                                            aria-describedby="basic-addon1 "
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
                                            <div class="form-group row  py-0 my-0">
                                                <div class="col-sm-3">
                                                    <label for="inputEmail3" class=" col-form-label "
                                                        style="color: black;">Name</label>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="input-group mb-1">
                                                        <input type="text" id="txtCardName" class="form-control"
                                                            placeholder="" readonly>
                                                        <input type="hidden" class="form-control input-sm "
                                                            id="txtWtLiableArray" name="txtWtLiableArray" value=""
                                                            readonly="readonly">
                                                        <input type="hidden" class="form-control input-sm "
                                                            id="txtWtLiableArray2" name="txtWtLiableArray2" value=""
                                                            readonly="readonly">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row  py-0 my-0">
                                                <label for="inputEmail3" class="col-sm-3 col-form-label "
                                                    style="color: black;">Contact Person</label>
                                                <div class="col-sm-9 ">
                                                    <div class="input-group mb-1">

                                                        <input type="text" class="form-control d-none"
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
                                            <div class="form-group row  py-0 my-0 mb-1">
                                                <label for="inputEmail3" class="col-sm-3 col-form-label "
                                                    style="color: black;">Customer Ref. No.</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control " id="txtCustomerRefNo"
                                                        placeholder="" maxlength="100">
                                                </div>
                                            </div>
                                            <div class="form-group row  py-0 my-0 ">

                                                <div class="input-group col-sm-3">
                                                    <select type="text" class="form-control " id="selCurrency"
                                                        placeholder="" readonly>
                                                        <option value='Local'>Local Currency</option>
                                                        <option value='System'>System Currency</option>
                                                        <option value='BP'>BP Currency</option>
                                                    </select>
                                                </div>

                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control " id="txtCurrency"
                                                        placeholder="" style="color: black;" readonly>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="col-lg-4 pb-2  " width="100%" id="midCol">

                                        </div>
                                        <div class="col-lg-4 pb-2 " id="dateCol">
                                            <div class="form-group row  py-0 my-0 mb-1">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label "
                                                    style="color: black;">No.</label>
                                                <div class="col-sm-4 ">
                                                    <select type="text" class="form-control " id="selSeries"
                                                        placeholder="">

                                                        <?php
												$itemno = 1;
												$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT DISTINCT
																											T0.SeriesName
																											
																											FROM NNM1 T0
																											WHERE T0.SeriesName = 'Primary' AND ObjectCode = ".$_SESSION['objectType']."
																											ORDER BY T0.SeriesName ASC");
													while (odbc_fetch_row($qry)) 
													{
														echo '<option class=" series" value='. odbc_result($qry, "SeriesName").'>'. odbc_result($qry, "SeriesName") .'</option>';
														$itemno++;	  
													}
												$itemno2 = 1;
												$qry1 = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT DISTINCT
																											T0.SeriesName
																											
																											FROM NNM1 T0
																											WHERE T0.SeriesName != 'Primary' AND ObjectCode = ".$_SESSION['objectType']."
																											ORDER BY T0.SeriesName ASC");
													while (odbc_fetch_row($qry1)) 
													{
														echo '<option class=" series" value='. odbc_result($qry1, "SeriesName").'>'. odbc_result($qry1, "SeriesName") .'</option>';
														$itemno2++;	  
													}
												$itemno3 = 1;
												$qry2 = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT DISTINCT
																										T0.SeriesName
																										
																										FROM NNM1 T0
																										WHERE T0.SeriesName = 'Manual' 
																										ORDER BY T0.SeriesName ASC");
												while (odbc_fetch_row($qry2)) 
												{
													echo '<option class=" series" value='. odbc_result($qry2, "SeriesName").'>'. odbc_result($qry2, "SeriesName") .'</option>';
													$itemno3++;	  
												}
												
												odbc_free_result($qry);
												odbc_free_result($qry1);
												odbc_free_result($qry2);
											?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control d-none" id="txtDocEntry"
                                                        placeholder="" />
                                                    <input type="text" class="form-control " id="txtDocNum"
                                                        placeholder="" value=<?php
											$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT 
																									ISNULL(MAX(T0.DocNum),0) + 1 AS NextDocNum
																								FROM ".$_SESSION['objectTable']." T0 
																								INNER JOIN NNM1 T1 ON T0.Series = T1.Series

																								WHERE SeriesName = 'Primary'
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
                                             <!--   <input type="text" id="txtPostingDate2" class="form-control col-10"
                                                        value="" min="01-01-2018" max="12-31-2050"> -->
                                                        
                                                    <input type="date" id="txtPostingDate"
                                                        class="form-control col-12 postingdate"
                                                        value="<?php echo date('Y-m-d'); ?>" min="01-01-2018" max="12-31-2050">
                                                </div> 
                                            </div>

                                            <div class="form-group row  py-0 my-0">
                                                <label for="inputEmail3" class="col-sm-5 col-form-label "
                                                    style="color: black;">Due Date</label>
                                                <div class="col-sm-1 ">
                                                </div>
                                            <!--   <div class="col-sm-6 input-group mb-1">
                                                    <input type="text" id="txtDeliveryDate2" class="form-control col-10"
                                                        value="" min="01-01-2018" max="12-31-2050">
                                                    <input type="date" id="txtDeliveryDate" class="form-control col-2 "
                                                        value="<?php echo date('Y-m-d'); ?>" min="01-01-2018"
                                                        max="12-31-2050" style="color:transparent !important">
                                                </div>  -->
                                                <div class="col-sm-6 input-group mb-1">
                                                    <input type="date" id="txtDeliveryDate" class="form-control col-12 "
                                                        value="<?php echo date('Y-m-d'); ?>" min="01-01-2018"
                                                        max="12-31-2050">
                                                </div>
                                            </div>

                                            <div class="form-group row  py-0 my-0">
                                                <label for="inputEmail3" class="col-sm-5 col-form-label "
                                                    style="color: black; font-size:15px">Document Date</label>
                                                <div class="col-sm-1 ">
                                                </div>
                                           <!-- <div class="col-sm-6 input-group mb-1">
                                                    <input type="text" id="txtDocumentDate2" class="form-control col-10"
                                                        value="" min="01-01-2018" max="12-31-2050">
                                                    <input type="date" id="txtDocumentDate" class="form-control col-2"
                                                        value="<?php echo date('Y-m-d'); ?>" min="01-01-2018"
                                                        max="12-31-2050" style="color:transparent !important">
                                                </div> -->
                                                <div class="col-sm-6 input-group mb-1">
                                                    <input type="date" id="txtDocumentDate" class="form-control col-12"
                                                        value="<?php echo date('Y-m-d'); ?>" min="01-01-2018"
                                                        max="12-31-2050">
                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                    <ul class="nav nav-tabs pt-2" id="myTab" role="tablist">
                                        <li class="nav-item " style="">
                                            <a class="nav-link active " id="" data-toggle="tab" href="#contents"
                                                role="tab" aria-controls="contents" aria-selected="true"
                                                style="color: black; font-weight:bold">Contents</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="" data-toggle="tab" href="#logistics" role="tab"
                                                aria-controls="logistics" aria-selected="false"
                                                style="color: black; font-weight:bold">Logistics</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="" data-toggle="tab" href="#accounting" role="tab"
                                                aria-controls="contact" aria-selected="false"
                                                style="color: black; font-weight:bold">Accounting</a>
                                        </li>

                                    </ul>

                                    <div class="tab-content" id="myTabContent" style="padding-top: 10px;">
                                        <div class="tab-pane fade show active" id="contents" role="tabpanel"
                                            aria-labelledby="contents">
                                            <div class="form-group row  mb-0">
                                                <div class="col-sm-4 row">
                                                    <label for="inputEmail3" class="col-sm-4 col-form-label pr-0"
                                                        style="color: black; font-size:15px">Item/Service Type</label>
                                                    <select id="selTransactionType"
                                                        class="col-sm-3 form-control-sm mdb-select md-form text-left"
                                                        searchable="Search here.."
                                                        style=" !important;outline:none; border-color: #D0D0D0;">
                                                        <option class="text-center" value="I">Item</option>
                                                        <option class="text-center" value="S">Service</option>
                                                        <input type="hidden" id="rowLoader" name="rowLoader"
                                                            class="form-control input-sm">
                                                    </select>
                                                </div>
                                            </div>
                                            <div id="contentContainer" class="table-responsive"
                                                style="width:100%; padding-bottom:20px; padding-left:10px;  overflow-x:hidden;  overflow-y:hidden;">
                                                <div id="contents-tab">
                                                </div>
                                                <hr />
                                            </div>

                                        </div>
                                        <div class="tab-pane fade " id="logistics" role="tabpanel"
                                            aria-labelledby="logistics">
                                            <div id="contentContainer" class="table-responsive"
                                                style="width:100%; padding-bottom:20px; padding-left:10px; overflow-x:hidden;  overflow-y:hidden;">
                                                <div id="logistics-tab">
                                                </div>
                                                <hr />
                                            </div>
                                        </div>
                                        <div class="tab-pane fade " id="accounting" role="tabpanel"
                                            aria-labelledby="accounting">
                                            <div id="contentContainer" class="table-responsive"
                                                style="width:100%; padding-bottom:20px; padding-left:10px; padding-right:10px;  overflow-x:hidden;  overflow-y:hidden;">
                                                <div id="accounting-tab">
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
                                            <div class="form-group row  py-0 my-0">
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
                                                            class="form-control" placeholder="" aria-label="Username"
                                                            aria-describedby="basic-addon1"
                                                            style="border-bottom-left-radius:5px; border-top-left-radius:5px;"
                                                            value="-No Sales Employee-">
                                                        <div class="input-group-append">
                                                            <button class="btn btnGroup" type="button"
                                                                data-mdb-ripple-color="dark"
                                                                style="background-color: #ADD8E6; hover:"
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
                                                                style="background-color: #ADD8E6; hover:"
                                                                data-toggle="modal" data-target="#"
                                                                data-backdrop="false">
                                                                <i class="fas fa-arrow-right  "
                                                                    style="color: #FFD700; font-size:20px"></i>
                                                            </button>
                                                        </div>
                                                        <input readonly type="text" class="form-control d-none"
                                                            id="txtOwnerCode" value="<?php echo $EmpId; ?>">
                                                        <input readonly type="text" class="form-control "
                                                            id="txtOwnerName"
                                                            style="border-bottom-left-radius:5px; border-top-left-radius:5px;"
                                                            value="<?php echo $UserName?>">
                                                        <div class="input-group-append">
                                                            <button class="btn btnGroup" type="button"
                                                                data-mdb-ripple-color="dark"
                                                                style="background-color: #ADD8E6; hover:"
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
                                        </div>

                                        <div class="col-lg-3 pb-2  " width="100%">

                                        </div>
                                        <div class="col-lg-4 pb-2 ">
                                            <div class="form-group row  py-0 my-0">
                                                <label for="inputEmail3" class="col-sm-4 col-form-label "
                                                    style="color: black;">Total Before Discount</label>
                                                <div class="col-sm-8 input-group mb-1">
                                                    <input type="text" id="txtTotalBeforeDiscount"
                                                        class="form-control text-right" readonly value=0.00>
                                                </div>
                                            </div>
                                            <div class="form-group row  py-0 my-0 mb-1">
                                                <label for="inputEmail3" class="col-sm-2 col-form-label "
                                                    style="color: black;">Disc</label>
                                                <div class="col-sm-3">
                                                    <input type="text" id="txtFooterDiscountPercentage"
                                                        class="form-control text-right footer" maxlength="15">
                                                </div>
                                                <label for="inputEmail3" class="col-sm-1 col-form-label "
                                                    style="color: black;">%</label>
                                                <div class="col-sm-6">
                                                    <input type="text" id="txtFooterDiscountSum"
                                                        class="form-control text-right footer" maxlength="7">
                                                </div>
                                            </div>
                                            <div class="form-group row  py-0 my-0">
                                                <label for="inputEmail3" class="col-sm-4 col-form-label "
                                                    style="color: black;">Tax</label>
                                                <div class="col-sm-8 input-group mb-1">
                                                    <input type="text" id="txtVatSum" class="form-control text-right"
                                                        readonly value=0.00>
                                                </div>
                                            </div>
                                            <div class="form-group row py-0 my-0">
                                                <label for="inputEmail3" class="col-sm-4 col-form-label "
                                                    style="color: black;">WTax Amount</label>
                                                <div class="col-sm-8 input-group mb-1">
                                                    <div class="input-group-append">
                                                        <button id="btnWTax" class="btn btnGroup" type="button"
                                                            data-mdb-ripple-color="dark"
                                                            style="background-color: #ADD8E6; " data-toggle="modal"
                                                            data-target="#WTaxTableModal" data-backdrop="false">
                                                            <i class="fas fa-list-ul input-prefix" tabindex=0
                                                                style="color:blue "></i>
                                                        </button>
                                                    </div>
                                                    <input readonly type="text" id="txtWTaxF" name="txtWTaxF"
                                                        class="form-control text-right" placeholder=""
                                                        aria-label="Username" aria-describedby="basic-addon1 "
                                                        style="border-bottom-left-radius:5px; border-top-left-radius:5px;"
                                                        value=0.00>
                                                </div>
                                            </div>
                                            <div class="form-group row  py-0 my-0">
                                                <label for="inputEmail3" class="col-sm-4 col-form-label "
                                                    style="color: black;">Total Payment Due</label>
                                                <div class="col-sm-8 input-group mb-1">
                                                    <input type="text" id="txtDocTotal" class="form-control text-right"
                                                        readonly value=0.00>
                                                </div>
                                            </div>
                                            <div class="form-group row  py-0 my-0">
                                                <label for="inputEmail3" class="col-sm-4 col-form-label "
                                                    style="color: black;">Applied Amount</label>
                                                <div class="col-sm-8 input-group mb-1">
                                                    <input type="text" id="txtPaidToDate"
                                                        class="form-control text-right" readonly value=0.00>
                                                </div>
                                            </div>
                                            <div class="form-group row  py-0 my-0">
                                                <label for="inputEmail3" class="col-sm-4 col-form-label "
                                                    style="color: black;">Balanced Due</label>
                                                <div class="col-sm-8 input-group mb-1">
                                                    <input type="text" id="txtBalancedDue"
                                                        class="form-control text-right" readonly value=0.00>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div id="footerButtons" class="form-group row  mt-5 ">
                                        <div class="col-lg-6 col-md-6 col-sm-6 text-left">
                                            <button type="button" id="btnAdd" class="  btn btn-warning btn-rounded "
                                                style="color: black; font-weight: bold; width:250px; background: linear-gradient(to bottom, #FCF6BA, #BF953F);">Add</button>
                                            <button type="button" id="btnUpdate"
                                                class="  btn btn-warning btn-rounded d-none"
                                                style="color:black; font-weight: bold; black;width:250px; background: linear-gradient(to bottom, #FCF6BA, #BF953F);">Update</button>
                                            <button type="button" id="btnOk"
                                                class="  btn btn-warning btn-rounded d-none"
                                                style="color:black; font-weight: bold; black;width:250px; background: linear-gradient(to bottom, #FCF6BA, #BF953F);">Ok</button>

                                            <button type="button" id="btnCancel"
                                                class=" btn btn-warning btn-rounded ml-5"
                                                style="color: black;width:250px; font-weight: bold; background: linear-gradient(to bottom, #FCF6BA, #BF953F);">Cancel</button>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 text-right">
                                            <span class="dropdown mr-5">
                                                <button type="button" id="btnCopyFrom" disabled="disabled"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                    class="dropdown-toggle  btn btn-warning btn-rounded dropdown-toggle"
                                                    style="color: black; font-weight: bold; width:250px; background: linear-gradient(to bottom, #FCF6BA, #BF953F);">Copy
                                                    From</button>
                                                <ul class="dropdown-menu copyFromList" aria-labelledby="btnCopyFrom"
                                                    style="color: black; font-weight: bold; width:250px; background-color: #fdfd96;">
                                                    <?php
								  		$objSession = json_decode($_SESSION['ARInvoiceArr']); 
								  		foreach ($objSession->copyFromArr as $item) {
								  			echo '<li>
								  							<button type="button" id="btnCopyFrom'.$item->copyFromModalTbl.'" class="dropdown-item" style="color: black; font-weight: bold; font-size:15px;" data-toggle="modal" data-target="#'.$item->copyFromModal.'Modal" data-backdrop="false">'.$item->baseTableName.'</button>
								  						</li>';
								  		}
								  	?>
                                                </ul>
                                            </span>
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
                    <h4 class="modal-title w-100" id="myModalLabel" btnAddstyle="color:black">List of
                        <?php echo $_SESSION['objectTableName']; ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body">
                    <table class="table table-striped table-bordered table-hover" id="tblDoc" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Doc No.</th>
                                <th class='d-none'>Doc Entry</th>
                                <th>Posting Date</th>
                                <th class='d-none'>Customer Code</th>
                                <th>Customer Name</th>
                                <th>Remarks</th>
                                <th>Due Date</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
							$itemno = 1;
							$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT DISTINCT
																						T0.DocNum, 
																						T0.DocEntry,
																						T0.CardCode, 
																						T0.CardName,
																						T0.Comments,
																						T0.DocDate, 
																						T0.DocDueDate, 
																						T0.DocTotal
																						
																							
																						FROM ".$_SESSION['objectTable']." T0
																						
																						ORDER BY T0.DocNum ASC");
								while (odbc_fetch_row($qry)) 
								{
									echo '<tr class="">
												<td>'.$itemno.'</td>
												<td class="item-1">'.odbc_result($qry, 'DocNum').'</td>
												<td class="item-2 d-none">'.odbc_result($qry, 'DocEntry').'</td>
												<td class="item-4 " >'.SAPDateFormater(odbc_result($qry, 'DocDate')).'</td>
												<td class="item-3 d-none" >'.odbc_result($qry, 'CardCode').'</td>
												<td class="item-6 " >'.odbc_result($qry, 'CardName').'</td>
												<td class="item-8 " style="width: 160px;" >'.odbc_result($qry, 'Comments').'</td>
												<td class="item-9 " >'.SAPDateFormater(odbc_result($qry, 'DocDueDate')).'</td>
												<td class="item-5 text-right" >'.number_format(odbc_result($qry, 'DocTotal'),2).'</td>
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
    <!-- Document Modal -->

    <!-- Copy From Modals -->
    <?php
			$objSession = json_decode($_SESSION['ARInvoiceArr']); 
  		foreach ($objSession->copyFromArr as $item) {
  			echo '<div class="modal fade" id="'.$item->copyFromModal.'Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
					      <div class="modal-dialog modal-xl" role="document" style="width:100%">
					        <!--Content-->
					        <div class="modal-content-full-width modal-content">
					          <!--Header-->
					          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
					            <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of '.$item->baseTableName.'</h4>
					            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					              <span aria-hidden="true">&times;</span>
					            </button>
					          </div>
					          <!--Body-->
								 <div class="modal-body">
									<div id="'.$item->copyFromModal.'Result"></div>
								</div>
					          <!--Footer-->
					          <div class="modal-footer">
					            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					          </div>
					        </div>
					        <!--/.Content-->
					      </div>
					    </div>';
  		}
  	?>
    <!-- Copy From Modals -->

    <!-- Business Partner Modal -->
    <div class="modal fade" id="bpModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document" style="width:100%">
            <!--Content-->
            <div class="modal-content-full-width modal-content">
                <!--Header-->
                <div class="modal-header"
                    style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
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
                                <th>#</th>
                                <th>Customer Code</th>
                                <th>Customer Name</th>
                                <th>Balance</th>
                                <th>Contact Person</th>
                                <th>Group Projct / Location</th>
                                <th class="d-none">Payment Terms Code</th>
                                <th class="d-none">Payment Terms Name</th>
                                <th class="d-none">Tin Number</th>
                                <th class="d-none">Contact Person Code</th>
                                <th class="d-none">Currency</th>
                                <th class="d-none">Control Account</th>
                                <th class="d-none">Control Account Name</th>
                                <th class="d-none">Control Account Name</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
							$itemno = 1;
							$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
																						SELECT DISTINCT
																						T0.CardCode, 
																						T0.CardName,
																						T0.Balance,
																						T3.CntctCode,
																						T0.CntctPrsn,
																						T0.LicTradNum,
																						T0.GroupNum,
																						T0.Currency,
																						T2.PymntGroup,
																						T0.DebPayAcct,
																						T4.AcctName,
																						CASE WHEN
																						T0.Wtliable = 'Y' THEN 1
																						WHEN T0.Wtliable = 'N' THEN 0
																						END AS Wtliable


																																											
																																											
																																											
																						FROM OCRD T0
																						LEFT JOIN CRD1 T1 ON T0.CardCode = T1.CardCode 
																						LEFT JOIN OCTG T2 ON T2.GroupNum = T0.GroupNum
																						LEFT JOIN OCPR T3 ON T3.Name = T0.CntctPrsn AND T0.CardCode = T3.CardCode 
																						LEFT JOIN OACT T4 ON T4.AcctCode = T0.DebPayAcct
																						
																						WHERE T0.CardType = '".$_SESSION['cardType']."'
																						
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
												<td class="item-10 d-none">'.odbc_result($qry, 'DebPayAcct').'</td>
												<td class="item-11 d-none">'.odbc_result($qry, 'AcctName').'</td>
												<td class="item-12 d-none">'.odbc_result($qry, 'Wtliable').'</td>
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

    <!-- Sales Employee Modal -->
    <div class="modal fade" id="salesEmpModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document" style="width:100%">
            <!--Content-->
            <div class="modal-content-full-width modal-content">
                <!--Header-->
                <div class="modal-header"
                    style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
                    <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of Sales Employee</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body">
                    <table class="table table-striped table-bordered table-hover" id="tblSalesEmployee"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="d-none">Sales Employee Code</th>
                                <th>Sales Employee Name</th>
                                <th>Remarks</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
							$itemno = 1;
							$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT DISTINCT
																						T0.SlpCode, 
																						T0.SlpName,
																						T0.Memo
																						
																						
																						FROM OSLP T0
																						
																						ORDER BY T0.SlpCode ASC");
								while (odbc_fetch_row($qry)) 
								{
									echo '<tr class="">
												<td>'.$itemno.'</td>
												<td class="item-1 d-none">'.odbc_result($qry, 'SlpCode').'</td>
												<td class="item-2">'.odbc_result($qry, 'SlpName').'</td>
												<td class="item-3">'.odbc_result($qry, 'Memo').'</td>
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
    <!-- Sales Employee Modal -->

    <!-- Employee Modal -->
    <div class="modal fade" id="empModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document" style="width:100%">
            <!--Content-->
            <div class="modal-content-full-width modal-content">
                <!--Header-->
                <div class="modal-header"
                    style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
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
                                <th>#</th>
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

    <!-- Item Code Modal -->
    <div class="modal fade" id="itemModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document" style="width:100%">
            <!--Content-->
            <div class="modal-content-full-width modal-content">
                <!--Header-->
                <div class="modal-header"
                    style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
                    <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of Items</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body">
                    <table class="table table-striped table-bordered table-hover" id="tblItem" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Item Code</th>
                                <th>Item Name</th>
                                <th>Foreign Name</th>
                                <th>UoM Group</th>
                                <th>Inventory UoM</th>
                                <th class="d-none">Whse Code</th>
                                <th class="d-none">Whse Name</th>
                                <th class="d-none">Price</th>
                                <th class="d-none">Vendor</th>
                                <th class="d-none">UGP Entry</th>
                                <th class="d-none">UGP Code</th>
                                <th class="d-none">UGP Name</th>
                                <th class="d-none">Batch / Serial</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
							$itemno = 1;
							$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT DISTINCT
																						T0.ItemCode, 
																						T0.ItemName, 
																						T0.FrgnName,
																						T0.InvntryUom, 
																						T0.CardCode, 
																						T0.ManBtchNum,
																						T0.ManSerNum,
																						T1.ItmsGrpNam,
																						CASE WHEN T2.Price = 0 THEN '' END AS Price,
																						T4.UomEntry,
																						T4.UomCode,
																						T4.UomName,
																						
																						T0.DfltWH,
																						T5.WhsName
																						
																						
																							
																						FROM OITM T0
																						INNER JOIN OITB T1 ON T0.ItmsGrpCod = T1.ItmsGrpCod
																						INNER JOIN ITM1 T2 ON T2.ItemCode = T0.ItemCode
																						LEFT JOIN OPLN T3 ON T3.ListNum = T2.PriceList
																						INNER JOIN OUOM T4 ON T4.UomEntry = T0.IUoMEntry
																						LEFT JOIN OWHS T5 ON T5.WhsCode = T0.DfltWH
																						
																						WHERE T0.PrchseItem = 'Y' AND T0.FrozenFor = 'N'
																						
																						
																						ORDER BY T0.ItemName ASC");
								while (odbc_fetch_row($qry)) 
								{
									$BatchSerial = '';
									if(odbc_result($qry, 'ManBtchNum') == 'Y'){
										$BatchSerial = 'B';
									}
									else if(odbc_result($qry, 'ManSerNum') == 'Y'){
										$BatchSerial = 'S';
									}
									else{
										$BatchSerial = 'N';
									}
									echo '<tr class="">
												<td>'.$itemno.'</td>
												<td class="item-1">'.odbc_result($qry, 'ItemCode').'</td>
												<td class="item-2" >'.odbc_result($qry, 'ItemName').'</td>
												<td class="item-3 " >'.odbc_result($qry, 'FrgnName').'</td>
												<td class="item-4 " >'.odbc_result($qry, 'ItmsGrpNam').'</td>
												<td class="item-5 " >'.odbc_result($qry, 'InvntryUom').'</td>
												<td class="item-6 hidden" >'.odbc_result($qry, 'Price').'</td>
												<td class="item-7 hidden" >'.odbc_result($qry, 'CardCode').'</td>
												<td class="item-8 hidden" >'.odbc_result($qry, 'UomEntry').'</td>
												<td class="item-9 hidden" >'.odbc_result($qry, 'UomCode').'</td>
												<td class="item-10 hidden" >'.odbc_result($qry, 'UomName').'</td>
												<td class="item-11 hidden" >'.$BatchSerial.'</td>
												<td class="item-12 hidden" >'.odbc_result($qry, 'DfltWH').'</td>
												<td class="item-13 hidden" >'.odbc_result($qry, 'WhsName').'</td>
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
    <!-- Item Code Modal -->


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

    <!-- WHSE Modal -->
    <div class="modal fade" id="whseModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document" style="width:100%">
            <!--Content-->
            <div class="modal-content-full-width modal-content">
                <!--Header-->
                <div class="modal-header"
                    style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
                    <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of Warehouse</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body">
                    <table class="table table-striped table-bordered table-hover" id="tblWhse" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>WHSE Code</th>
                                <th>WHSE Name</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
							$itemno = 1;
							$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT DISTINCT
																						T0.WhsCode, 
																						T0.WhsName 
																						
																						
																							
																						FROM OWHS T0
																						
																						
																						
																						ORDER BY T0.WhsCode ASC");
								while (odbc_fetch_row($qry)) 
								{
									
									echo '<tr class="">
												<td>'.$itemno.'</td>
												<td class="item-1">'.odbc_result($qry, 'WhsCode').'</td>
												<td class="item-2" >'.odbc_result($qry, 'WhsName').'</td>
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
    <!-- WHSE Modal -->

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
																						
																						ORDER BY T0.AcctCode ASC");
								while (odbc_fetch_row($qry)) 
								{
									echo '<tr class="">
												<td>'.$itemno.'</td>
												<td class="item-1" style="width: 20%;">'.odbc_result($qry, 'AcctCode').'</td>
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
                                    style="background-color: #ADD8E6; " data-toggle="modal" data-target="#countryModalS"
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
                            <input type="text" class="form-control shipInputs" id="txtAddress2S" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row   my-1">
                        <label for="inputEmail3" class="col-sm-3 col-form-label py-1 mt-2" style="color: black;">Address
                            Name 3</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control shipInputs" id="txtAddress3S" placeholder="">
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
                            <div class="input-group-append">
                                <button class="btn btnGroup" type="button" data-mdb-ripple-color="dark"
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
                            <div class="input-group-append">
                                <button class="btn btnGroup" type="button" data-mdb-ripple-color="dark"
                                    style="background-color: #ADD8E6; " data-toggle="modal" data-target="#countryModalB"
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
    <div class="modal fade" id="countryModalS" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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

    <!-- State Modal to Ship -->
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
                    <table class="table table-striped table-bordered table-hover" id="tblStateS" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>State Code</th>
                                <th>State Name</th>

                            </tr>
                        </thead>
                        <tbody id="tbodyStateS">

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
    <!-- State Modal to Ship -->



    <!-- Country Modal to Bill -->
    <div class="modal fade" id="countryModalB" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
                    <table class="table table-striped table-bordered table-hover" id="tblCountryB" style="width:100%">
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
    <!-- Country Modal to Bill -->

    <!-- State Modal -->
    <div class="modal fade" id="stateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
    <!-- WTax Table Modal -->
    <div class="modal fade" id="WTaxTableModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document"
            style="width:100%; ">
            <!--Content-->
            <div class="modal-content-full-width modal-content" style="height: 1000px; width: 1800px;">
                <!--Header-->
                <div class="modal-header"
                    style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
                    <h4 class="modal-title w-100" id="myModalLabel" style="color:black">WTax</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body">
                    <div id="wTaxTableResult" class="mt-5"></div>
                </div>
                <!--Footer-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary d-none" id="">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        id="btnUpdateWTLiable">Close</button>
                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>
    <!-- WTax Table Modal -->
    <!-- WTax Modal -->
    <div class="modal fade" id="WTaxModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document" style="width:100%">
            <!--Content-->
            <div class="modal-content-full-width modal-content">
                <!--Header-->
                <div class="modal-header"
                    style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
                    <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of WTax</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body">
                    <div id="wTaxTResult"></div>
                </div>
                <!--Footer-->
                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>
    <!-- WTax Modal -->
    <!-- Batch Modal -->
    <div class="modal fade" id="batchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document"
            style="width:100%; ">
            <!--Content-->
            <div class="modal-content-full-width modal-content"
                style="height:1200px; width:1400px !important; margin-bottom:50px">
                <!--Header-->
                <div class="modal-header"
                    style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
                    <h4 class="modal-title w-100" id="batchModalTitle" style="color:black"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body ">
                    <p id="batchTitle" style="color:black; font-weight:bold"></p>
                    <div id="batchTable" class="table-responsive mb-3"
                        style="width:100%; height:300px !important; padding-bottom:20px; padding-left:10px;  overflow:scroll;">


                        <table class="table table-striped table-bordered table-hover" id="tblBatch"
                            style="width:100%;  ">
                            <thead>
                                <tr>
                                    <th style="  position: sticky;top: 0; ">#</th>
                                    <th style="  position: sticky;top: 0; ">Doc No.</th>
                                    <th style="  position: sticky;top: 0; ">Item Code</th>
                                    <th style="  position: sticky;top: 0; ">Item Name</th>
                                    <th style="  position: sticky;top: 0;  ">Whse Code</th>
                                    <th style="  position: sticky;top: 0;  ;">Total Needed</th>
                                    <th style="  position: sticky;top: 0; ">Total Created</th>

                                </tr>
                            </thead>
                            <tbody>
                                <div id="batchItems"></div>
                            </tbody>
                        </table>
                    </div>
                    <p id="batchTitle2" style="color:black; font-weight:bold"></p>
                    <div id="batchTableReport" class="table-responsive"
                        style="width:100%; height:300px !important; padding-bottom:20px; padding-left:10px;  overflow:scroll;">


                        <table id="tblBatchCreated" class="table table-striped table-bordered table-sm detailsTable"
                            cellspacing="0" style="background-color: white; width= 100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="min-width:20px;position: sticky;top: 0; ">#</th>
                                    <th style="min-width:250px;position: sticky;top: 0; ">Batch</th>
                                    <th style="min-width:150px;position: sticky;top: 0; ">Qty</th>
                                    <th style="min-width:100px;position: sticky;top: 0; ">Expiration Date</th>
                                    <th style="min-width:100px;position: sticky;top: 0;  ">Mfr Date</th>
                                    <th style="min-width:100px;position: sticky;top: 0;  ;">Admission Date</th>
                                    <th style="min-width:300px;position: sticky;top: 0; ">Location</th>
                                    <th style="min-width:300px;position: sticky;top: 0; ">Details</th>
                                    <th style="min-width:300px;position: sticky;top: 0; ">Unit Cost</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!--Footer-->
                <div class="modal-footer">
                    <button type="button" id="btnOkBatch" class="btn btn-secondary " data-dismiss="modal">Ok</button>
                    <button type="button" id="btnUpdateBatch" class="btn btn-secondary d-none">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>
    <!-- Batch Modal -->


    <!-- Serial Modal -->
    <div class="modal fade" id="serialModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document"
            style="width:100%; ">
            <!--Content-->
            <div class="modal-content-full-width modal-content"
                style="height:1200px; width:1400px !important; margin-bottom:50px">
                <!--Header-->
                <div class="modal-header"
                    style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
                    <h4 class="modal-title w-100" id="serialModalTitle" style="color:black"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body ">
                    <p id="serialTitle" style="color:black; font-weight:bold"></p>
                    <div id="serialTable" class="table-responsive mb-3"
                        style="width:100%; height:300px !important; padding-bottom:20px; padding-left:10px;  overflow:scroll;">


                        <table class="table table-striped table-bordered table-hover" id="tblSerial"
                            style="width:100%;  ">
                            <thead>
                                <tr>
                                    <th style="  position: sticky;top: 0; ">#</th>
                                    <th style="  position: sticky;top: 0; ">Doc No.</th>
                                    <th style="  position: sticky;top: 0; ">Item Code</th>
                                    <th style="  position: sticky;top: 0; ">Item Name</th>
                                    <th style="  position: sticky;top: 0;  ">Whse Code</th>
                                    <th style="  position: sticky;top: 0;  ;">Total Needed</th>
                                    <th style="  position: sticky;top: 0; ">Total Created</th>

                                </tr>
                            </thead>
                            <tbody>
                                <div id="serialItems"></div>
                            </tbody>
                        </table>
                    </div>
                    <p id="serialTitle2" style="color:black; font-weight:bold"></p>
                    <div id="serialTableReport" class="table-responsive"
                        style="width:100%; height:300px !important; padding-bottom:20px; padding-left:10px;  overflow:scroll;">


                        <table id="tblSerialCreated" class="table table-striped table-bordered table-sm detailsTable"
                            cellspacing="0" style="background-color: white; width= 100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="min-width:20px;position: sticky;top: 0; ">#</th>
                                    <th style="min-width:250px;position: sticky;top: 0; ">Mfr Serial No.</th>
                                    <th style="min-width:150px;position: sticky;top: 0; ">Serial Number</th>
                                    <th style="min-width:100px;position: sticky;top: 0; ">Expiration Date</th>
                                    <th style="min-width:100px;position: sticky;top: 0;  ">Mfr Date</th>
                                    <th style="min-width:100px;position: sticky;top: 0;  ;">Admission Date</th>
                                    <th style="min-width:300px;position: sticky;top: 0; ">Location</th>
                                    <th style="min-width:300px;position: sticky;top: 0; ">Details</th>
                                    <th style="min-width:300px;position: sticky;top: 0; ">Unit Cost</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>

                <!--Footer-->
                <div class="modal-footer">
                    <button type="button" id="btnOkSerial" class="btn btn-secondary " data-dismiss="modal">Ok</button>
                    <button type="button" id="btnUpdateSerial" class="btn btn-secondary d-none">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>
    <!-- Serial Modal -->

    <!-- Referenced Document Modal -->
    <div class="modal fade" id="refDocModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document"
            style="width:100%; ">
            <!--Content-->
            <div class="modal-content-full-width modal-content" style="height: 500px; width: 1300px;">
                <!--Header-->
                <div class="modal-header"
                    style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
                    <h4 class="modal-title w-100" id="myModalLabel" style="color:black">Reference Information</h4>
                    <button type="button" id="btnCloseRefDocModal" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body" style="padding-bottom: 0px;">
                    <ul class="nav nav-tabs pt-2" id="myTab" role="tablist">
                        <li class="nav-item " style="">
                            <a class="nav-link active " id="" data-toggle="tab" href="#docRefTo" role="tab"
                                aria-controls="docRefTo" aria-selected="true"
                                style="color: black; font-weight:bold">Document Referenced to</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="" data-toggle="tab" href="#docRefBy" role="tab"
                                aria-controls="docRefBy" aria-selected="false"
                                style="color: black; font-weight:bold">Document Referenced by</a>
                        </li>

                    </ul>

                    <div class="tab-content" id="myTabContent" style="padding-top: 10px;">
                        <div class="tab-pane fade show active" id="docRefTo" role="tabpanel" aria-labelledby="docRefTo">
                            <div id="contentContainer" class="table-responsive"
                                style="width:100%; padding-bottom:20px; padding-left:10px;  overflow-x:hidden;  overflow-y:hidden;">
                                <div id="docRefTo-tab" style="width: 100%; height: 210px; overflow: auto; margin: 0px;">

                                </div>
                                <hr />
                                <div style="margin: 0px; padding-bottom: 0px;">
                                    <input type="checkbox" id="chkFlagVar" name="flagVar" value=""
                                        style="width: 20px; height: 20px;">
                                    <label for="flagVar" style="font-size: ;"> Only Reference Business Partner on Main
                                        Document</label>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade " id="docRefBy" role="tabpanel" aria-labelledby="docRefBy">
                            <div id="contentContainer" class="table-responsive"
                                style="width:100%; padding-bottom:20px; padding-left:10px; overflow-x:hidden;  overflow-y:hidden;">
                                <div id="docRefBy-tab" style="width: 100%; height: 210px; overflow: auto; margin: 0px;">

                                </div>
                                <hr />
                            </div>
                        </div>
                    </div>
                </div>
                <!--Footer-->
                <div class="modal-footer">
                    <button type="button" id="btnRefDocOk" class="btn btn-secondary " data-dismiss="modal">Ok</button>
                    <button type="button" id="btnRefDocUpdate" class="btn btn-secondary d-none">Update</button>
                    <button type="button" id="btnRefDocCancel" class="btn btn-secondary"
                        data-dismiss="modal">Cancel</button>
                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>
    <!-- Referenced Document Modal -->

    <!-- Transact. Type Modal -->
    <div class="modal fade" id="transactTypeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document" style="width:100%">
            <!--Content-->
            <div class="modal-content-full-width modal-content" style="width: 500px; margin: 0 auto;">
                <!--Header-->
                <div class="modal-header"
                    style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
                    <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of Transaction Type</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body">
                    <table class="table table-striped table-bordered table-hover" id="tblTransactType"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>Transaction Type</th>
                            </tr>
                        </thead>
                        <tbody id="tbodyTransactType">

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
    <!-- Transact. Type Modal -->

    <!-- DocNumber Modal -->
    <div class="modal fade" id="docNumModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document" style="width:100%">
            <!--Content-->
            <div class="modal-content-full-width modal-content">
                <!--Header-->
                <div class="modal-header"
                    style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
                    <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of <span
                            id="transactTypeName"></span>s</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body">
                    <table class="table table-striped table-bordered table-hover" id="tblDocNum" style="width:100%">
                        <thead>
                            <tr>
                                <th style="  position: sticky;top: 0;">#</th>
                                <th style="  position: sticky;top: 0;">Doc. No.</th>
                                <th style="  position: sticky;top: 0;">Date</th>
                                <th style="  position: sticky;top: 0;">Customer</th>
                                <th style="  position: sticky;top: 0;">Price Mode</th>
                                <th style="  position: sticky;top: 0;">Remarks</th>
                                <th style="  position: sticky;top: 0;">Due date</th>
                            </tr>
                        </thead>
                        <tbody id="tbodyDocNum">

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
    <!-- DocNumber Modal -->

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

    <script src="../script/<?php echo $_SESSION['mainFileName']; ?>.js"></script>
    <script src="../script/udf.js"></script>

    <script>
    $('#tblItem').dataTable({
        "bLengthChange": false,
    });
    </script>
    <script>
    $('#tblBP').dataTable({
        "bLengthChange": false
    });
    </script>
    <script>
    $('#tblDoc').dataTable({
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
    $('#tblGL').dataTable({
        "bLengthChange": false,
    });
    </script>
    <script>
    $('#tblWhse').dataTable({
        "bLengthChange": false,
    });
    </script>

    <?php
	include '../../bottom.php' 
?>