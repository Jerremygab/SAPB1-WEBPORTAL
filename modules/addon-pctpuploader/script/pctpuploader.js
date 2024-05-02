$(document).ready(function () {
let mainTable = '';
let objectType = 0;
let codeofapp = '';
let viewing = 0;

let otArrItem = [];
let otArrPOD = [];   		 

let otArrRowsItem = [];
let otArrRowsItemCode = [];
let otArrRowsPOD = [];
let otArrRowsBilling = [];
let otArrRowsTP = [];
let otArrRowsPricing= [];

let otArrChecker = [];
let otArrChecker2 = [];
let otItemCount = 0;
let otArrPODNotNullCells = [];
let otArrPODNotNullCellsRow = [];
let otArrPODNotNullCellsTotal = 0;
let otArrPODNotNullCellsTotalWithFailed = 0;
let notNullCouterRows = 0;
let otArrPODNotNullCellsRowButFailed = [];


let otArrBILLINGNotNullCellsTotal = 0;
let otArrTPNotNullCellsTotal = 0;

$('#pageTitle').text('PCTP Uploader 1 | SAP B1');	
setTimeout(function()
	{
		$('#txtPostingDate').trigger('change');
		$('#txtDeliveryDate').trigger('change');
		$('#txtDocumentDate').trigger('change');
	},1000);
$(document.body).on('click', '#sideBarToggle', function () 
{
	if($('#sideBarMenu').hasClass('d-none') == false){
		$('#sideBarMenu').addClass('d-none');
		$('#topBarToggle').removeClass('d-none');
		$('#iconArrowRight').removeClass('d-none');
		$('#iconArrowLeft').addClass('d-none');
	}
	else{
		$('#sideBarMenu').removeClass('d-none');
		$('#topBarToggle').addClass('d-none');
		$('#iconArrowRight').addClass('d-none');
		$('#iconArrowLeft').removeClass('d-none');
	}
});

$(document.body).on('click','#btnCancel',function()
{
	window.location.replace('../../dashboard/templates/dashboard.php')

})
$(document.body).on('click', '#btnLogout', function () 
{
	$('#logoutModal').modal('show');
});
$(document.body).on('click', '#btnLogoutConfirm', function () 
{
	$('#logoutModal').modal('hide');
	$.ajax({
		type: 'GET',
		url: '../proc/views/utilities/vw_logout.php',
		success: function (html) 
		{
			window.location.reload();
		}
	}); 
});

$(document.body).on('click', '#btnBrowse', function(){
	
	$("#txtFile1").trigger('click');
	
});
$(document.body).on('change', '#txtFile1', function(){
		
		let file = $("#txtFile1").val();
		let fileTrimmed = file.substr(0, file.indexOf('h')); 
		
		$("#txtFiletoUpload").val(file);
		$('#btnUpload3').removeAttr('disabled');
});	
$("#tblMain tbody tr").hover(function () {
    $(this).css('background-color: #C0C0C0');
});
function move() {
$('#uploadProgress').removeClass('d-none')
  if (i == 0) {
    i = 1;
    var elem = document.getElementById("myBar");
    var width = 0;
    var id = setInterval(frame, 10);
    function frame() {
      if (width >= 100) {
        clearInterval(id);
        $('#uploadProgress').addClass('d-none')
        i = 0;
      } else {
        width++;
        elem.style.width =  width + "%";
        elem.innerHTML = 'Uploading: ' + width + "%";
      }
    }
  }
}

$("#btnUpload3").on("click", function (e) 
{			



	 otArrItem = [];
	 otArrPOD = [];   		 

	 otArrRowsItem = [];
	 otArrRowsItemCode = [];
	 otArrRowsPOD = [];
	 otArrRowsBILL = [];
	 otArrRowsTP = [];
	 otArrRowsPricing = [];

	 otArrChecker = [];
	 otArrChecker2 = [];
	 otItemCount = 0;
	 otArrPODNotNullCells = [];
	 otArrPODNotNullCellsRow = [];
	 otArrPODNotNullCellsRowButFailed = [];
	 otArrPODNotNullCellsTotal = 0;
	 otArrPODNotNullCellsTotalWithFailed = 0;


		$('#modal-load-init').modal('show');
		
		var i = 0;

		$("#tblMain").dataTable().fnDestroy();
		$('#btnUpload3').prop('disabled',true);
		$("#uploadProgress").removeClass("d-none");
    var elem = document.getElementById("myBar");
    var width = 1;
           
    if(i == 0){
        var id = setInterval(frame, 10);
        function frame() {
        i = 1;
        if (width <= 50) {
            width++;
          //   elem.style.width = width + "%";
        	// elem.innerHTML = 'Uploading: ' + width + "%";
        } 
    
        }
    }


			$('#tblUploadResult tbody').empty();	
			
			var input = document.getElementById("txtFile1");

			file = input.files[0];
			formData= new FormData();
			formData.append("txtFile1", file);
			
			 //event.preventDefault();


			  $.ajax({

			   url:'../proc/views/vw_upload.php',
			   method:"POST",
			   data: formData,
			   dataType:'json',
			  	
			   contentType:false,
			   cache:false,
			   processData:false,

			   success:function(jsonData)
			   {

			   	$('#tblMain tbody').html('');
			  	



			  	$('#requiredErrors').text(jsonData.generalRequiredErrors);
			  	$('#invalidValue').text(jsonData.generalInvalidValueErrors);
			  	$('#invalidDate').text(jsonData.generalDateFormatError);
					$('#existingBookingNumber').text(jsonData.existingBookingNumberCount);
					$('#newBookingNumber').text(jsonData.newBookingNumberCount);
					$('#podPostedInPODCount').text(jsonData.podPostedInPODCount);
					$('#podPostedInBillingCount').text(jsonData.podPostedInBILLINGCount);
					
					$('#podPostedInSoCount').text(jsonData.podPostedInSoCount);
					$('#podPostedInARCount').text(jsonData.podPostedInARCount);
					$('#podPostedInAPCount').text(jsonData.podPostedInAPCount);
					$('#PCTPReadyCount').text(jsonData.PCTPReadyCount);
					$('#SAPReadyCount').text(jsonData.SAPReadyCount);

					



			    console.log(jsonData)
			  $('#tblMain').DataTable({
			    data  :  jsonData.table,
		    	columns :  [
			      { data : "rowNumber" },
			      { data : "ErrorMessage" },
			      { data : "UploadStatus" },

			      { data : "BookingDate" },
			      { data : "BookingNumber" },
			      { data : "ClientName" },
			      { data : "SAPClientCode" },
			     
			      { data : "TruckerName" },
			      { data : "SAPVendorCode" },
			     
			      { data : "PlateNumber" },

			      { data : "VehicleType" },
			      { data : "DeliveryOrigin" },
			      { data : "IslandOrigin"},
			      { data : "Destination" },
			      { data : "IslandDestination" },
			      { data : "IfInterIsland" },
			      { data : "DeliveryStatus" },
			      { data : "DeliveryCompletionDate" },
			      { data : "DeliveryCompleteDatePERPOD" },

			      { data : "NoOfDropsOnTripTicket" },
			      { data : "TripType" },
			      { data : "RemarksPOD" },
			      { data : "DocumentNumber" },
			      { data : "TripTicketNo" },
			      { data : "WayBillNo" },
			      { data : "ShipNoManifestNo" },
			      { data : "DeliveryReceiptNo" },
			      { data : "SeriesNo" },
			      { data : "OtherPODDocument" },
			      { data : "Remarks" },
			      { data : "ReceivedBy" },
			      { data : "ClientReceivedDate" },
			      { data : "ActualDateRecievedSoftCopyInitial" },
			      { data : "InitialHCInteluckReceivedDate" },
			      { data : "ActualHC" },
			      { data : "DateReturn" },
			      { data : "PODincharge" },
			      { data : "VERIFIEDDATEHardCopyGOOD" },
			      { data : "PODstatusdetail" },
			      { data : "PTFPODTransmittalFormNo" },
			      { data : "Date" },
			      { data : "PODTurnAround" },
			      { data : "BILLINGSTATUS" },
			      { data : "SERVICETYPE" },
			      { data : "SINo" },
			      { data : "BillingTeamInCharge" },
			      { data : "BTRemarks" },
			      { data : "SOBNumber" },
			      { data : "OutletNoCriteriaforGetColaRates" },
			      { data : "SalesInvoiceNoDeliveryReceiptNo" },
			      { data : "CBMCubicmeterBasedonSIDR" },
			      { data : "DeliveryModeAlwaysLANDTRIP" },
			      { data : "SourceWhseBasedonDTTstamp" },
			      { data : "DestinationClientsCustomer" },
			      { data : "TotalInvoiceAmount" },
			      { data : "SONolistedonDeliveryReceipt" },
			      { data : "NameofCustomer" },
			      { data : "CategorylistedonDeliveryReceipt" },
			      { data : "ForwardLoadtotalthequantitylistedonHTT" },
			      { data : "BackLoadtotalthequantitylistedonHTT" },
			      { data : "IDNumber" },
			      { data : "TYPEOFACCESSORIAL" },
			      { data : "STATUS" },
			      { data : "TIMEINEmptyDemurrage" },
			      { data : "TIMEOUTEmptyDemurrage" },
			      { data : "VERIFIEDEMPTYDEMURRAGE" },
			      { data : "TIMEINLoadedDemurrage" },
			      { data : "TIMEOUTLoadedDemurrage" },
			      { data : "VERIFIEDLOADEDDEMURRAGE" },
			      { data : "Remarks2" },
			      { data : "TIMEINAdvanceloading" },
			      { data : "DAYOFTHEWEEK" },
			      { data : "TIMEIN" },
			      { data : "TIMEOUT" },
			      { data : "TOTALNOEXCEEDOvertime" },
			      { data : "ODOIN" },
			      { data : "ODOOUT" },
			      { data : "TOTALUSAGE" },
			      { data : "NAMEOFDRIVER" },
			      { data : "ISSUESENCOUNTERED" },
			      { data : "ACTIONTAKENPLAN" },
			      { data : "STATUS" },
			      { data : "CLIENTSUBMISSIONSTATUS" },
			      { data : "ClientSubmissionOverdueDay" },
			      { data : "CPenaltyCaculation" },
			      { data : "PODSTATUSforPaymentprocessing" },
			      { data : "PODSUBMITDEADLINE" },
			      { data : "OVERDUEDAYS" },
			      { data : "IPennaltyCaculation" },
			      { data : "WaiveddaysLatePODresponse" },
			      { data : "HolidayorWeekend" },
			      { data : "LostPennaltyCaculation" },
			      { data : "TOTALSUBMISSIONPENALTIES" },
			      { data : "WAIVEDIFYAddherereferenceIfNAddhereBSDapprover" },
			      { data : "PENALTYCHARGED" },
			      { data : "Approvedby" },
			      { data : "TOTALPENALTYWAIVED" },
			      { data : "GROSSClientRates" },
			      { data : "GROSSClientratesCONSIDERINGNONVATRATEIFFORMULA" },
			      { data : "RateBasis" },
			      { data : "TAXTYPEVATNONVAT" },
			      { data : "GROSSTruckerrates" },
			      { data : "GROSSTruckerratesCONSIDERINGNONVATRATEIFFORMULA" },
			      { data : "RateBasis" },
			      { data : "TAXTYPEVATNONVAT2" },
			      { data : "DemurrageClient" },
			      { data : "AddtlDropClient" },
			      { data : "BoomTruckClient" },
			      { data : "ManpowerClient" },
			      { data : "BackloadClient" },
			      { data : "TotalAdditionalChargesClient" },
			      { data : "DemurrageCONSIDERINGNONVATRATE" },
			      { data : "AdditionalChargesCONSIDERINGNONVATRATE" },
			      { data : "DemurrageTrucker" },
			      { data : "AddtlDropTrucker" },
			      { data : "BoomTruckTrucker" },
			      { data : "ManpowerTrucker" },
			      { data : "BackloadTrucker" },
			      { data : "TotalAdditionalChargesTrucker" },
			      { data : "DemurrageCONSIDERINGNONVATRATE" },
			      { data : "AdditionalChargesCONSIDERINGNONVATRATE" },
			      { data : "TOTALINITIALClientRates" },
			      { data : "TOTALInitialTruckersRates" },
			      { data : "TOTALGROSSPROFIT" },
			      { data : "ActualBilledamountPerServiceinvoiceMAINRATE" },
			      { data : "RateAdjustmentsOtherthancolDVDW" },
			      { data : "ActualDemurrage" },
			      { data : "ActualadditionalchargesBackloadsdrops" },
			      { data : "TotalReceivablefromClientsperSIreconwithBR" },
			      { data : "CWT2307" },
			      { data : "Collectedamount" },
			      { data : "Actualrateschargedbytrucker" },
			      { data : "RateAdjustments" },
			      { data : "ActualApprovedDemurrage" },
			      { data : "ActualadditionalchargesBackloadsdrops2" },
			      { data : "BoomTruck" },
			      { data : "OtherChargesChargedtointeluckasCompanyexpenses" },
			      { data : "TotalPenalty" },
			      { data : "TotalPayabletoTruckers" },
			      { data : "EWT2307" },
			      { data : "TOTALPAYABLERECEIVABLEfromTrucker" },
			      { data : "ActualPaymentDate" },
			      { data : "PaymentReference" },
			      { data : "ORreferencenumber" },
			      { data : "PaymentVoucherNumber" },
			      { data : "PaymentStatus" },
			     ],
			     columnDefs: [
			     	// { defaultContent: "-" ,"targets": "_all"},
			     	//VALIDATOR
			     	 {"defaultContent": "-",
				    "targets": "_all"},

			     	{ className: "rowno", "targets": [0] },
			     	{ className: "error-message", "targets": [2] },
			     	//ALL
				    //{ className: "all", "targets": [5] },
				    //POD
				    { className: "pod", "targets": [15,17,19,20,21,22,23,24,25,26,27,28,30,31,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71] },
						{ className: "booking-date", "targets": [3]},
				    { className: "booking-number", "targets": [4]},
				    { className: "sap-client-code", "targets": [5]},

				 ],
				
			     responsive: true, 
			     pageLength: 10,
		    	 bPaginate	: true,
					 bLengthChange	: false,
					 bFilter	: true,
					 bInfo	: true,
					 bAutoWidth	: false,
					 scrollX: true,
					 scrollY: false,

			    });

				validateRows();
				removeClassOnHeaders();
				validatePOSTSAP();
				makeArraysOfRows();
				makeArraysOfBookingNumber();
				$('#tblMain tbody').children('tr:first').addClass('d-none');

				 var id = setInterval(frame, 10);
				        function frame() {
				            if (width >= 100) {
				                clearInterval(id);
				                i = 0;
				                $("#uploadProgress").addClass("d-none");
				                $('#btnPost').prop('disabled',false);
				            
				            } else {
				                width++;
				            }
				        }

				}	,
				  error: function( e ) {
				  	  console.log(e)
                        console.log(e.responseText)
                }


		
	});
			
                  	
});
function removeClassOnHeaders(){
	$('#tblMain thead th').removeClass('text-success')
}
function validateRows(){
	var dataTable = $('#tblMain').dataTable()
 	$(dataTable.fnGetNodes()).each(function(i)
   	{
   		var errorMessage = '';
   		var outerThis = this;
 
   	});	
 	$('#tblMain tbody tr td').css('vertical-align','top');

}
//Submit
	//Add
	$(document.body).on('click', '#btnPost', function () 
	{
		var i = 0;

		console.log(otArrRowsPOD)
		$('#btnBrowse').prop('disabled',true);
		$('#btnPost').prop('disabled',true);	
	


		var err = 0;
		var elem = document.getElementById("myBar2");
		var width = 1;
	

		// NEW ITEMS=======================================================

		$('#postingSAP').text('Posting...').removeClass('d-none')
		$('.sapposting').removeClass('d-none')
		$('#postedSAP').text('Posted!').addClass('d-none')
		$('.podloading').removeClass('d-none');
		$('.itemloading').removeClass('d-none');
		$('.countloading').removeClass('d-none')
		


		var dataTable = $('#tblMain').dataTable()
    var rows = $("#tblMain").dataTable().fnGetNodes();
    let rowsTotal = dataTable.fnSettings().fnRecordsTotal() - 1;
    let rowsTotal2 = dataTable.fnSettings().f;
    let cellTotal = rowsTotal * 15;
    console.log(rowsTotal)
    console.log(cellTotal)
		let ctrItem = 0;
		let ctrPOD = 0;
		let ctrPosted = 0;
		let oldItemValue = 0
		let oldPODValue = 0;
		let ctrUploadedItem = 0;
		let ctrUploadedPOD = 0;
		let ctrUploadedTP = 0;

	

		countPosted = 0;
		
		
   	console.log('------------------------------------')
		console.log(otArrRowsItemCode.length)
		console.log(otArrRowsItem.length)
		console.log(otArrRowsPOD.length)
		console.log(otArrPODNotNullCellsTotal)
   	console.log('------------------------------------')
   

   	if(otArrRowsItem.length != 0){
   		// for(let i = 0; i < otArrRowsItem.length; i++) {

   			
   			ctrPosted += 1;
				ctrItem += 1;	
				ctrPOD += 1;
		  	let itemCode = otArrRowsItemCode[i]
		    let itemData = otArrRowsItem;
		    let podData = otArrRowsPOD;
		    let billingData = otArrRowsBilling;
		    let tpData = otArrRowsTP;
		    let pricingData = otArrRowsPricing; 
		    let notNullCells = otArrPODNotNullCellsTotal;
		    otArrPODNotNullCellsTotal
		    console.log(itemData);
		    console.log(podData);
				console.log(billingData);
				console.log(tpData);
				console.log(pricingData);
		    console.log(notNullCells);


	    	$.ajax({
	        type: 'POST',
	        url: '../proc/exec/exec_update_pctpItemAndPODNew.php',
	        startTime: performance.now(),
					data:{
						itemCode: itemCode,
						itemData: itemData,
						podData: podData,
						billingData: billingData,
						tpData: tpData,
						pricingData: pricingData,
						notNullCells: notNullCells

						
					},
				  success: function (data){
						console.log(data)
						let res = $.parseJSON(data)
        		// // console.log(res)
					
						let ItemPosted = $.parseJSON(res.ItemPosted)
						let PODPosted = $.parseJSON(res.PODPosted)

					
						console.log(ItemPosted)
						console.log(PODPosted)
						console.log(res.podData)
				
	        	
						$('.itemsuploaded').text(ItemPosted)
					
						$('.itemloading').addClass('d-none')
		    		console.log('NEW ITEMS ADDED')
						$('.poduploaded').text(PODPosted)
					
						$('.podloading').addClass('d-none')
		    		console.log('NEW POD ADDED')
		    		$('.countuploaded').text(otArrPODNotNullCellsTotal)
		    		$('.countloading').addClass('d-none')

		
						
	        	
	        },
	        complete: function (data) {
	        	console.log(data)
					
					
	        		setTimeout(function()
					{
					console.log(ctrPosted , ctrUploadedItem)
		
						console.log('finished')
						$('#tblMain').dataTable().fnDestroy();
						$('#btnUpload3').trigger('click')
						$('#postingSAP').text('Posting...').addClass('d-none')
						$('.sapposting').addClass('d-none')
						$('#postedSAP').text('Posted!').removeClass('d-none')
						$('.countloading').addClass('d-none')
						$('.itemloading').addClass('d-none')
						$('.podloading').addClass('d-none')
						$('#btnPost').prop('disabled',true);	
						return false;
								
					},1000)
	        		setTimeout(function()
					{
						$.ajax({
							type: 'POST',
							url: '../proc/exec/exec_duplicate_deleter.php',
							startTime: performance.now(),
									
							});
								
					},500)

					}
     		});
			// }		
   	}else{
			$('#postingSAP').text('Posting...').addClass('d-none')
			$('.sapposting').addClass('d-none')
			$('.itemloading').addClass('d-none')
			$('.podloading').addClass('d-none')
			$('#postedSAP').text('No Posted!').removeClass('d-none')
			$('.countloading').addClass('d-none')
			return false;
   	}


	

    });

$(document.body).on('click', '#btnCreateSalesOrder', function () 
{
	PostSalesOrder();
});
$(document.body).on('click', '#btnCreateBilling', function () 
{
	PostBilling();
});
$(document.body).on('click', '#btnCreateARInvoice', function () 
{
	PostARInvoice();
});
$(document.body).on('click', '#btnCreateAPInvoice', function () 
{
	PostAPInvoice();
});
function PostSalesOrder(){

	
	$('#btnPostSAPARInvoice').prop('disabled',true);
	$('#btnPostSAPAPInvoice').prop('disabled',true)

	$('#postingSAP').text('Posting Sales Orders...').removeClass('d-none')
	$('.sapposting').removeClass('d-none')
	$('#postedSAP').text('Sales Orders Posted Successfully!').addClass('d-none')
	$('.soloading').removeClass('d-none');
                	

  var dataTable = $('#tblMain').dataTable();

  var rows = $("#tblMain").dataTable().fnGetNodes();
  
  let rowsTotal = dataTable.fnSettings().fnRecordsTotal();
  console.log(rowsTotal)
  var err = '';
  var ctrSO =0;
	var ctrUploadedSO  =0;
	var otArrPctpChecker = [];
 	$(dataTable.fnGetNodes()).each(function(i)
 	{

		var jsonSAP = '{';
		var otArrPctpRow = [];
		var otArrPctpRowBookingNumbers = [];
		var docLines = [];
 		itArr= [];
		itArr2= [];

    if($(this).find("td:eq(0)").text() != '-' && $(this).find("td:eq(2) span").hasClass('text-success') && $(this).find("td:eq(4) i").hasClass('text-primary') && !$(this).find("td:eq(1) i").hasClass('sonum') && $(this).find("td:eq(1) i").hasClass('sapready') ){

    	console.log('TRYING TO POST SALES ORDER')
			let d = new Date();
			var postingdate =  (d.getMonth()+1) + "/" +  d.getDate() + "/" + d.getFullYear()
			let unitprice = 1;
			let qty = 1;
			// 
			// let acctcode = "5-001";
			console.log(validDate(postingdate))

			itArr.push('"' +'CardCode'+ '"' + ":" + '"' + $(this).find("td:eq(6)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')

			itArr.push('"' +'DocDate'+ '"' + ":" + '"' + validDate($(this).find("td:eq(3)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")) + '"')
			
			itArr.push('"' +'DocDueDate'+ '"' + ":" + '"' + validDate($(this).find("td:eq(3)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")) + '"')


			
			itArr2.push('"' +'ItemCode'+ '"' + ":" + '"' + $(this).find("td:eq(4)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
			itArr2.push('"' +'UnitPrice'+ '"' + ":" +  $(this).find("td:eq(51)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''"))
			itArr2.push('"' +'Quantity'+ '"' + ":" + qty)
			// itArr2.push('"' +'AccountCode'+ '"' + ":" +  '"' + acctcode + '"') 
			docLines.push('"' +'DocumentLines'+ '"' + ":" + '[' + '{' + itArr2.join(',') + '}]' );			

			itArr.push(docLines)


			otArrPctpRow.push('{' + itArr.join(',') + '}'); 	
			otArrPctpChecker.push('{' + itArr.join(',') + '}'); 	

			otArrPctpRowBookingNumbers.push($(this).find("td:eq(4)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''"))
			
				if (err == 0) 
				{
					if(otArrPctpRow.length != 0){

					  $.ajax({
					    type: 'POST',
					    url: '../proc/exec/exec_add_pctpSAPSalesOrder.php',
					    startTime: performance.now(),
							data:{
								otArrPctpRow: otArrPctpRow,
								otArrPctpRowBookingNumbers: otArrPctpRowBookingNumbers
					    },
						  success: function (data){
								console.log(data)
								//let res = $.parseJSON(data)
								//console.log(res.result)
								console.log('-----------------------------------')
								//let res2 = $.parseJSON(res.result)
								//console.log(res2)
							},
					    complete: function (data) {
					    	console.log('SUCCESSFUL POSTED SALES ORDER')
					    	ctrUploadedSO+=1;
									$('.souploaded').text(ctrUploadedSO)
									$('.sooverall').text(rowsTotal)
								
					    	
					    		if(ctrSO == ctrUploadedSO){
					    				$('.soloading').addClass('d-none')
					    		}	
					    		if(ctrSO == ctrUploadedSO){
					    			$('#btnUpload3').trigger('click')
					    			setTimeout(function()
										{
												$('#postingSAP').text('Posting...').addClass('d-none')
												$('.sapposting').addClass('d-none')
												$('#postedSAP').text('Posted!').removeClass('d-none')
												$('#CreateBilling').modal('show')
										},1000)
					    		}

					    

							}
					  });

					}
				}
		
  	}else{
					setTimeout(function()
										{
			if(otArrPctpChecker.length == 0){
						
										$('#postingSAP').text('Posting...').addClass('d-none')
												$('.sapposting').addClass('d-none')
												$('#postedSAP').text('No Posted!').removeClass('d-none')
												$('.soloading').addClass('d-none')
												$('#CreateBilling').modal('show')
									
			}
				},2000)
			}

  	console.log(otArrPctpRow)
		console.log(otArrPctpRowBookingNumbers)
		
  });


}

function PostBilling(){
	var i = 0;
		$('.billingloading').removeClass('d-none');
		$('#postingSAP').text('Posting Billing...').removeClass('d-none')
		$('.sapposting').removeClass('d-none')
		$('#postedSAP').text('Billing Posted Successfully!').addClass('d-none')
		
		$('#btnBrowse').prop('disabled',true);


		var err = 0;
		var elem = document.getElementById("myBar2");
		var width = 1;
		var dataTable = $('#tblMain').dataTable()

	
    var rows = $("#tblMain").dataTable().fnGetNodes();
    let rowsTotal = dataTable.fnSettings().fnRecordsTotal();
    console.log(rowsTotal)
		let ctrBilling = 0;
		let ctrUploadedBilling = 0;
		let otArrBillingChecker = [];
   	$(dataTable.fnGetNodes()).each(function(i)
   	{


			if($(this).find("td:eq(0)").text() != '-' && $(this).find("td:eq(2) span").hasClass('text-success')  && $(this).find("td:eq(1) i").hasClass('text-secondary') && $(this).find("td:eq(1) i").hasClass('text-info')  && !$(this).find("td:eq(1) i").hasClass('billingnum')){

					var jsonBilling = '{';
					var otArrBilling = [];
					var itArr = [];
					itArr.push('"' +'U_BookingDate'+ '"' + ":" + '"' + validDate($(this).find("td:eq(3)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")) + '"')
					itArr.push('"' +'U_BookingId'+ '"' + ":" + '"' + $(this).find("td:eq(4)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_CustomerName'+ '"' + ":" + '"' + $(this).find("td:eq(5)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_SAPClient'+ '"' + ":" + '"' + $(this).find("td:eq(6)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_PlateNumber'+ '"' + ":" + '"' + $(this).find("td:eq(12)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' + 'U_VehicleTypeCap' + '"' + ":" + '"' + $(this).find("td:eq(13) select").val().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_DeliveryOrigin'+ '"' + ":" + '"' + $(this).find("td:eq(14)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_Destination'+ '"' + ":" + '"' + $(this).find("td:eq(15)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_DeliveryStatus'+ '"' + ":" + '"' + $(this).find("td:eq(16)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_DeliveryDatePOD'+ '"' + ":" + '"' + validDate($(this).find("td:eq(18)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")) + '"')
					itArr.push('"' +'U_NoOfDrops'+ '"' + ":" + '"' + $(this).find("td:eq(19)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_TripType'+ '"' + ":" + '"' + $(this).find("td:eq(20)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_Remarks'+ '"' + ":" + '"' + $(this).find("td:eq(21)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_WaybillNo'+ '"' + ":" + '"' + $(this).find("td:eq(23)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_ShipmentManifestNo'+ '"' + ":" + '"' + $(this).find("td:eq(24)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_DeliveryReceiptNo'+ '"' + ":" + '"' + $(this).find("td:eq(25)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_SeriesNo'+ '"' + ":" + '"' + $(this).find("td:eq(26)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_SeriesNo'+ '"' + ":" + '"' + $(this).find("td:eq(27)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_RemarksPOD'+ '"' + ":" + '"' + $(this).find("td:eq(28)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_ClientReceivedDate'+ '"' + ":" + '"' + validDate($(this).find("td:eq(30)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")) + '"')
					itArr.push('"' +'U_ActualHCRecDate'+ '"' + ":" + '"' + validDate($(this).find("td:eq(32)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")) + '"')
					itArr.push('"' +'U_PODinCharge'+ '"' + ":" + '"' + $(this).find("td:eq(34)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_VerifiedDateHC'+ '"' + ":" + '"' + validDate($(this).find("td:eq(35)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")) + '"')
					itArr.push('"' +'U_PODStatusDetail'+ '"' + ":" + '"' + $(this).find("td:eq(36)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_PTFNo'+ '"' + ":" + '"' + $(this).find("td:eq(37)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_DateForwardedBT'+ '"' + ":" + '"' + validDate($(this).find("td:eq(38)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")) + '"')
					itArr.push('"' +'U_BillingStatus'+ '"' + ":" + '"' + $(this).find("td:eq(39)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_ServiceType'+ '"' + ":" + '"' + $(this).find("td:eq(40)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_SINo'+ '"' + ":" + '"' + $(this).find("td:eq(41)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_BillingTeam'+ '"' + ":" + '"' + $(this).find("td:eq(42)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_BTRemarks'+ '"' + ":" + '"' + $(this).find("td:eq(43)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_SOBNumber'+ '"' + ":" + '"' + $(this).find("td:eq(44)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_OutletNo'+ '"' + ":" + '"' + $(this).find("td:eq(45)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					//itArr.push('"' +'U_SI_DRNo'+ '"' + ":" + '"' + $(this).find("td:eq(46)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_CBM'+ '"' + ":" + '"' + $(this).find("td:eq(47)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_DeliveryMode'+ '"' + ":" + '"' + $(this).find("td:eq(48)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_SourceWhse'+ '"' + ":" + '"' + $(this).find("td:eq(49)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_DestinationClient'+ '"' + ":" + '"' + $(this).find("td:eq(50)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_TotalInvAmount'+ '"' + ":" + '"' + $(this).find("td:eq(51)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_SONo'+ '"' + ":" + '"' + $(this).find("td:eq(52)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_NameCustomer'+ '"' + ":" + '"' + $(this).find("td:eq(53)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_CategoryDR'+ '"' + ":" + '"' + $(this).find("td:eq(54)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_ForwardLoad'+ '"' + ":" + '"' + $(this).find("td:eq(55)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_BackLoad'+ '"' + ":" + '"' + $(this).find("td:eq(56)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_IDNumber'+ '"' + ":" + '"' + $(this).find("td:eq(57)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_TypeOfAccessorial'+ '"' + ":" + '"' + $(this).find("td:eq(58)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_TimeInEmptyDem'+ '"' + ":" + '"' + $(this).find("td:eq(60)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_TimeOutEmptyDem'+ '"' + ":" + '"' + $(this).find("td:eq(61)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_VerifiedEmptyDem'+ '"' + ":" + '"' + $(this).find("td:eq(62)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_TimeInLoadedDem'+ '"' + ":" + '"' + $(this).find("td:eq(63)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_TimeOutLoadedDem'+ '"' + ":" + '"' + $(this).find("td:eq(64)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_VerifiedLoadedDem'+ '"' + ":" + '"' + $(this).find("td:eq(65)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_TimeInAdvLoading'+ '"' + ":" + '"' + $(this).find("td:eq(67)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_DayOfTheWeek'+ '"' + ":" + '"' + $(this).find("td:eq(68)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_TimeIn'+ '"' + ":" + '"' + $(this).find("td:eq(69)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_TimeOut'+ '"' + ":" + '"' + $(this).find("td:eq(70)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_ODOIn'+ '"' + ":" + '"' + $(this).find("td:eq(72)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_ODOOut'+ '"' + ":" + '"' + $(this).find("td:eq(73)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_TotalUsage'+ '"' + ":" + '"' + $(this).find("td:eq(74)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_Status'+ '"' + ":" + '"' + $(this).find("td:eq(78)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_BackLoad'+ '"' + ":" + '"' + $(this).find("td:eq(120)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_ActualBilledRate'+ '"' + ":" + '"' + $(this).find("td:eq(135)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_RateAdjustments'+ '"' + ":" + '"' + $(this).find("td:eq(136)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_ActualDemurrage'+ '"' + ":" + '"' + $(this).find("td:eq(137)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_ActualAddCharges'+ '"' + ":" +  $(this).find("td:eq(138)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") )
					itArr.push('"' +'U_TotalRecClients'+ '"' + ":" + '"' + $(this).find("td:eq(139)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					// itArr.push('"' +'U_CollectedAmount'+ '"' + ":" +  $(this).find("td:eq(142)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") )
					itArr.push('"' +'U_RateAdjustments'+ '"' + ":" + '"' + $(this).find("td:eq(143)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					itArr.push('"' +'U_ActualDemurrage'+ '"' + ":" + '"' + $(this).find("td:eq(144)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')

					otArrBilling.push('{' + itArr.join(',') + '}');
					otArrBillingChecker.push('{' + itArr.join(',') + '}');
					ctrBilling+=1;

		


					if (err == 0) 
					{
						
						if(otArrBilling.length != 0){
							$.ajax({
				        type: 'POST',
				        url: '../proc/exec/exec_update_pctpBILLINGNew.php',
				        startTime: performance.now(),
								data:{
									otArrBilling: otArrBilling
									
								},
							  success: function (data){
									
				        },
				        complete: function (data) {
				        	ctrUploadedBilling+=1;
									$('.billinguploaded').text(ctrUploadedBilling)
									$('.billingoverall').text(rowsTotal)
								
					    		console.log('NEW BILLING ADDED')
					    	
					    		if(ctrBilling == ctrUploadedBilling){
					    				$('#postingSAP').text('Posting...').addClass('d-none')
											$('.sapposting').addClass('d-none')
											$('#postedSAP').text('Posted!').removeClass('d-none')
					    				$('.billingloading').addClass('d-none')
					    		}	
					    

								}
			     		});
						}else{

						}

					}
		     
		   
      console.log(otArrBilling)
		}else{
					setTimeout(function()
										{
			if(otArrBillingChecker.length == 0){
						
									$('#postingSAP').text('Posting...').addClass('d-none')
									$('.billingloading').addClass('d-none')
									$('.sapposting').addClass('d-none')
									$('#postedSAP').text('No Posted!').removeClass('d-none')
									
			}
				},2000)
			}



     //******************* END POD



		     
     



		});
}

function PostARInvoice(){

	$('#btnBrowse').prop('disabled',true);
	$('#btnPostSAPARInvoice').prop('disabled',true);
	$('#btnPostSAPAPInvoice').prop('disabled',true)


	$('#postingSAP').text('Posting A/R Invoices...').removeClass('d-none')
	$('.sapposting').removeClass('d-none')
	$('#postedSAP').text('A/R Invoices Posted Successfully!').addClass('d-none')
	$('.arloading').removeClass('d-none');
                	
	var jsonSAP = '{';
  var otArrPctpRow = [];
  var otArrPctpRowBookingNumbers = [];
  var docLines = [];
  var otArrPctpRowAP = [];
	var docLinesAP = [];
	
	var elem = document.getElementById("myBar2");
	var width = 1;
  var rows = $("#tblMain").dataTable().fnGetNodes();
  var dataTable = $('#tblMain').dataTable();
  var err = '';

 	$(dataTable.fnGetNodes()).each(function(i)
 	{
 		itArr= [];
		itArr2= [];
		itArr2Ap= [];
    if($(this).find("td:eq(0)").text() != '-' && $(this).find("td:eq(2) span").hasClass('text-success') && $(this).find("td:eq(4) i").hasClass('text-primary') && !$(this).find("td:eq(1) i").hasClass('arnum') && $(this).find("td:eq(1) i").hasClass('sapready') ){

    	console.log('TRYING TO POST A/R INVOICES')
			let d = new Date();
			var postingdate =  (d.getMonth()+1) + "/" +  d.getDate() + "/" + d.getFullYear()
			let unitprice = 1;
			let qty = 1;
			// 
			let acctcode = "5-001";
			console.log(validDate(postingdate))

			itArr.push('"' +'CardCode'+ '"' + ":" + '"' + $(this).find("td:eq(6)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')

			itArr.push('"' +'DocDate'+ '"' + ":" + '"' + validDate($(this).find("td:eq(3)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")) + '"')
			
			itArr.push('"' +'DocDueDate'+ '"' + ":" + '"' + validDate($(this).find("td:eq(3)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")) + '"')


			
			itArr2.push('"' +'ItemCode'+ '"' + ":" + '"' + $(this).find("td:eq(4)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
			itArr2.push('"' +'UnitPrice'+ '"' + ":" +  $(this).find("td:eq(51)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''"))
			itArr2.push('"' +'Quantity'+ '"' + ":" + qty)
			itArr2.push('"' +'AccountCode'+ '"' + ":" +  '"' + acctcode + '"') 


			itArr2.push('"' +'BaseType'+ '"' + ":" +  17) 
			itArr2.push('"' +'BaseEntry'+ '"' + ":" +  $(this).find("td:eq(4) i").attr('data-so-num'))
			itArr2.push('"' +'BaseLine'+ '"' + ":" +  0) 


			docLines.push('"' +'DocumentLines'+ '"' + ":" + '[' + '{' + itArr2.join(',') + '}]' );			

			itArr.push(docLines)


			otArrPctpRow.push('{' + itArr.join(',') + '}'); 	
			

		// 	itArrAP.push('"' +'CardCode'+ '"' + ":" + '"' + $(this).find("td:eq(10)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')

		// 	itArrAP.push('"' +'DocDate'+ '"' + ":" + '"' + validDate(postingdate) + '"')

		// 	itArrAP.push('"' +'DocDueDate'+ '"' + ":" + '"' + validDate(postingdate) + '"')



		// 	itArr2Ap.push('"' +'ItemCode'+ '"' + ":" + '"' + $(this).find("td:eq(4)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
		// 	itArr2Ap.push('"' +'UnitPrice'+ '"' + ":" +  $(this).find("td:eq(51)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''"))
		// 	itArr2Ap.push('"' +'Quantity'+ '"' + ":" + qty)
		// 	// itArr2Ap.push('"' +'UoMEntry'+ '"' + ":" + uomentry)
		// 	// itArr2Ap.push('"' +'UoMCode'+ '"' + ":" + '"' + uomcode + '"')
		// 	itArr2Ap.push('"' +'AccountCode'+ '"' + ":" +  '"' + acctcode + '"') 

		// // "BaseType": -1,
		// // "BaseEntry": null,
		// // "BaseLine": null,

		// 	docLinesAP.push('"' +'DocumentLines'+ '"' + ":" + '[' + '{' + itArr2Ap.join(',') + '}]' );			

		// 	itArrAP.push(docLinesAP)


		// 	otArrPctpRowAP.push('{' + itArrAP.join(',') + '}'); 		
			


			otArrPctpRowBookingNumbers.push($(this).find("td:eq(4)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''"))
			
		
  	}

		
  });
	console.log(otArrPctpRow)
	console.log(otArrPctpRowAP)
	console.log(otArrPctpRowBookingNumbers)
	if (err == 0) 
	{
		if(otArrPctpRow.length != 0){

		  $.ajax({
		    type: 'POST',
		    url: '../proc/exec/exec_add_pctpSAPARInvoice.php',
		    startTime: performance.now(),
				data:{
					otArrPctpRow: otArrPctpRow,
					otArrPctpRowAP: otArrPctpRowAP,
					otArrPctpRowBookingNumbers: otArrPctpRowBookingNumbers
		    },
			  success: function (data){
					console.log(data)
					//let res = $.parseJSON(data)
					//console.log(res.result)
					console.log('-----------------------------------')
					//let res2 = $.parseJSON(res.result)
					//console.log(res2)
				},
		    complete: function (data) {
		    	console.log('SUCCESSFUL POSTED AR INVOICES')
		    	elem.style.width = 1;
		    	
	    		setTimeout(function()
					{
							$('#myBar2').removeClass('d-none')
					  	elem.style.width = '25' + "%";	
					},1000)
					setTimeout(function()
					{
					  	elem.style.width = '50' + "%";	
					},2000)
					setTimeout(function()
					{
					  	elem.style.width = '75' + "%";	
					},3000)
					setTimeout(function()
					{
					  	elem.style.width = '100' + "%";	
					},4000)
					setTimeout(function()
					{
			  	 	$('.arloading').addClass('d-none')
		    		$('.archeck').removeClass('d-none')
		    		console.log('NEW AR INVOICE ADDED')

			    	$('#postingSAP').addClass('d-none')
			    	$('.sapposting').addClass('d-none')
			    	$('#postedSAP').removeClass('d-none')
			    	
			    	$('#myBar2').addClass('d-none')
			    	$('#btnUpload3').trigger('click')
					},5000)


					setTimeout(function()
					{
						$('#CreateAPInvoice').modal('show')
						$('#btnPost').prop('disabled',true);
						$('#btnBrowse').prop('disabled',true);
						$('#btnPostSAPSalesOrder').prop('disabled',true);
						$('#btnPostSAPARInvoice').prop('disabled',true);
					},7000)
		    	
				}
		  });

		}else{
				console.log('NO NEW AR INVOICE ADDED')
				$('.arloading').addClass('d-none')
				$('.arfail').removeClass('d-none')
				$('#postedSAP').text('No Posted AR Invoice!').addClass('d-none')
				$('#postingSAP').addClass('d-none')
				$('.sapposting').addClass('d-none')
				$('#postedSAP').removeClass('d-none')
				elem.style.width = '100' + "%";	
				
				setTimeout(function()
				{
	  	 		$('#CreateAPInvoice').modal('show')
					$('#btnPost').prop('disabled',true);
					$('#btnBrowse').prop('disabled',true);
					$('#btnPostSAPSalesOrder').prop('disabled',true);
					$('#btnPostSAPARInvoice').prop('disabled',true);
				},1000)
		}
	}
}

function PostAPInvoice(){

	
	$('#postingSAP').text('Posting A/P Invoices...').removeClass('d-none')
	$('.sapposting').removeClass('d-none')
	$('#postedSAP').text('A/P Invoices Posted Successfully!').addClass('d-none')
	$('.aploading').removeClass('d-none');
                	
	$('#btnPost').prop('disabled',true);
	$('#btnBrowse').prop('disabled',true);
	$('#btnPostSAPSalesOrder').prop('disabled',true);
	$('#btnPostSAPARInvoice').prop('disabled',true);
	$('#btnPostSAPAPInvoice').prop('disabled',true)
							
	var jsonSAP = '{';
  var otArrPctpRowBookingNumbers = [];
  var otArrPctpRowAP = [];
	var docLinesAP = [];
	
	var elem = document.getElementById("myBar2");
	var width = 1;
  var rows = $("#tblMain").dataTable().fnGetNodes();
  var dataTable = $('#tblMain').dataTable();
  var err = '';

 	$(dataTable.fnGetNodes()).each(function(i)
 	{
 		itArrAp= [];
		itArr2Ap= [];
    if($(this).find("td:eq(0)").text() != '-' && $(this).find("td:eq(2) span").hasClass('text-success') && $(this).find("td:eq(4) i").hasClass('text-primary') && !$(this).find("td:eq(1) i").hasClass('apnum') && $(this).find("td:eq(1) i").hasClass('sapready') ){

    	console.log('TRYING TO POST A/P INVOICES')
			let d = new Date();
			var postingdate =  (d.getMonth()+1) + "/" +  d.getDate() + "/" + d.getFullYear()
			let unitprice = 1;
			let qty = 1;
			// 
			let acctcode = "5-001";
			console.log(validDate(postingdate))

			itArrAp.push('"' +'CardCode'+ '"' + ":" + '"' + $(this).find("td:eq(10)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')

			itArrAp.push('"' +'DocDate'+ '"' + ":" + '"' + validDate($(this).find("td:eq(3)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")) + '"')
			
			itArrAp.push('"' +'DocDueDate'+ '"' + ":" + '"' + validDate($(this).find("td:eq(3)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")) + '"')


			
			itArr2Ap.push('"' +'ItemCode'+ '"' + ":" + '"' + $(this).find("td:eq(4)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
			itArr2Ap.push('"' +'UnitPrice'+ '"' + ":" +  $(this).find("td:eq(51)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''"))
			itArr2Ap.push('"' +'Quantity'+ '"' + ":" + qty)
			itArr2Ap.push('"' +'AccountCode'+ '"' + ":" +  '"' + acctcode + '"') 


			// itArr2Ap.push('"' +'BaseType'+ '"' + ":" +  17) 
			// itArr2Ap.push('"' +'BaseEntry'+ '"' + ":" +  $(this).find("td:eq(4) i").attr('data-so-num'))
			// itArr2Ap.push('"' +'BaseLine'+ '"' + ":" +  0) 


			docLinesAP.push('"' +'DocumentLines'+ '"' + ":" + '[' + '{' + itArr2Ap.join(',') + '}]' );			

			itArrAp.push(docLinesAP)


			otArrPctpRowAP.push('{' + itArrAp.join(',') + '}'); 	
			

		// 	itArrAP.push('"' +'CardCode'+ '"' + ":" + '"' + $(this).find("td:eq(10)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')

		// 	itArrAP.push('"' +'DocDate'+ '"' + ":" + '"' + validDate(postingdate) + '"')

		// 	itArrAP.push('"' +'DocDueDate'+ '"' + ":" + '"' + validDate(postingdate) + '"')



		// 	itArr2Ap.push('"' +'ItemCode'+ '"' + ":" + '"' + $(this).find("td:eq(4)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
		// 	itArr2Ap.push('"' +'UnitPrice'+ '"' + ":" +  $(this).find("td:eq(51)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''"))
		// 	itArr2Ap.push('"' +'Quantity'+ '"' + ":" + qty)
		// 	// itArr2Ap.push('"' +'UoMEntry'+ '"' + ":" + uomentry)
		// 	// itArr2Ap.push('"' +'UoMCode'+ '"' + ":" + '"' + uomcode + '"')
		// 	itArr2Ap.push('"' +'AccountCode'+ '"' + ":" +  '"' + acctcode + '"') 

		// // "BaseType": -1,
		// // "BaseEntry": null,
		// // "BaseLine": null,

		// 	docLinesAP.push('"' +'DocumentLines'+ '"' + ":" + '[' + '{' + itArr2Ap.join(',') + '}]' );			

		// 	itArrAP.push(docLinesAP)


		// 	otArrPctpRowAP.push('{' + itArrAP.join(',') + '}'); 		
			


			otArrPctpRowBookingNumbers.push($(this).find("td:eq(4)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''"))
			
		
  	}

		
  });
	console.log(otArrPctpRowAP)
	console.log(otArrPctpRowBookingNumbers)
	if (err == 0) 
	{
		if(otArrPctpRowAP.length != 0){

		  $.ajax({
		    type: 'POST',
		    url: '../proc/exec/exec_add_pctpSAPAPInvoice.php',
		    startTime: performance.now(),
				data:{
					otArrPctpRowAP: otArrPctpRowAP,
					otArrPctpRowBookingNumbers: otArrPctpRowBookingNumbers
		    },
			  success: function (data){
					console.log(data)
					//let res = $.parseJSON(data)
					//console.log(res.result)
					console.log('-----------------------------------')
					//let res2 = $.parseJSON(res.result)
					//console.log(res2)
				},
		    complete: function (data) {
		    		console.log('SUCCESSFUL POSTED AP INVOICES')
			    	elem.style.width = 1;
			    	
		    		setTimeout(function()
						{
								$('#myBar2').removeClass('d-none')
						  	elem.style.width = '25' + "%";	
						},1000)
						setTimeout(function()
						{
						  	elem.style.width = '50' + "%";	
						},2000)
						setTimeout(function()
						{
						  	elem.style.width = '75' + "%";	
						},3000)
						setTimeout(function()
						{
						  	elem.style.width = '100' + "%";	
						},4000)
						setTimeout(function()
						{
				  	 	$('.aploading').addClass('d-none')
			    		$('.apcheck').removeClass('d-none')
			    		console.log('NEW AP INVOICE ADDED')

				    	$('#postingSAP').addClass('d-none')
				    	$('.sapposting').addClass('d-none')
				    	$('#postedSAP').removeClass('d-none')
				    	
				    	$('#myBar2').addClass('d-none')
				    	$('#btnUpload3').trigger('click')
						},5000)

						setTimeout(function()
						{
				  	 	$('#btnPost').prop('disabled',true);
						},7000)


			    	
				}
		  });

		}else{
				console.log('NO NEW AP INVOICE ADDED')
	  		
						$('.aploading').addClass('d-none')
    				$('.apfail').removeClass('d-none')
    				$('#postedSAP').text('No Posted AP Invoice!').addClass('d-none')
  					$('#postingSAP').addClass('d-none')
						$('.sapposting').addClass('d-none')
						$('#postedSAP').removeClass('d-none')
						$('#myBar2').addClass('d-none')
				  	elem.style.width = '100' + "%";	
			
				setTimeout(function()
				{
		  	 	$('#btnPost').prop('disabled',true);
					$('#btnPostSAPSalesOrder').prop('disabled',true);
					$('#btnPostSAPARInvoice').prop('disabled',true);
					$('#btnPostSAPAPInvoice').prop('disabled',true);
				},1000)
		
		}
	}
}

   
	

//SO AR AP =====================================================
$(document.body).on('click', '#btnPostSAPTransaction', function () 
{
		$('postingSAP').removeClass('d-none')
		$('sapposting').removeClass('d-none')
		$('postedSAP').addClass('d-none')

                	
		var jsonSAP = '{';
        var otArrPctpRow = [];
        var docLines = [];
        var otArrPctpRowAP = [];
        var docLinesAP = [];

        var rows = $("#tblMain").dataTable().fnGetNodes();
        var dataTable = $('#tblMain').dataTable()
        var err = '';
       	$(dataTable.fnGetNodes()).each(function(i)
       	{
       		itArr= [];
			itArr2= [];

			itArrAP= [];
			itArr2Ap= [];
     		//console.log($(this).find("td:eq(4)").contents().get(0))
	        if($(this).find("td:eq(0)").text() != '-' && $(this).find("td:eq(2)").text() == 'SUCCESS'){
	   
			
	        let d = new Date();
	        var postingdate =  (d.getMonth()+1) + "/" +  d.getDate() + "/" + d.getFullYear()
		 	let unitprice = 1;
		 	let qty = 1;
		  	let uomentry = -1;
			let uomcode = "Manual";
			let acctcode = "5-001";
			console.log(validDate(postingdate))

			itArr.push('"' +'CardCode'+ '"' + ":" + '"' + $(this).find("td:eq(6)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
	
			itArr.push('"' +'DocDate'+ '"' + ":" + '"' + validDate(postingdate) + '"')
			
			itArr.push('"' +'DocDueDate'+ '"' + ":" + '"' + validDate(postingdate) + '"')


			
			itArr2.push('"' +'ItemCode'+ '"' + ":" + '"' + $(this).find("td:eq(4)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
			itArr2.push('"' +'UnitPrice'+ '"' + ":" + unitprice)
			itArr2.push('"' +'Quantity'+ '"' + ":" + qty)
			// itArr2.push('"' +'UoMEntry'+ '"' + ":" + uomentry)
			// itArr2.push('"' +'UoMCode'+ '"' + ":" + '"' + uomcode + '"')
			itArr2.push('"' +'AccountCode'+ '"' + ":" +  '"' + acctcode + '"') 
			docLines.push('"' +'DocumentLines'+ '"' + ":" + '[' + '{' + itArr2.join(',') + '}]' );			

			itArr.push(docLines)
	

			otArrPctpRow.push('{' + itArr.join(',') + '}'); 	


			itArrAP.push('"' +'CardCode'+ '"' + ":" + '"' + $(this).find("td:eq(10)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
	
			itArrAP.push('"' +'DocDate'+ '"' + ":" + '"' + validDate(postingdate) + '"')
			
			itArrAP.push('"' +'DocDueDate'+ '"' + ":" + '"' + validDate(postingdate) + '"')


			
			itArr2Ap.push('"' +'ItemCode'+ '"' + ":" + '"' + $(this).find("td:eq(4)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
			itArr2Ap.push('"' +'UnitPrice'+ '"' + ":" + unitprice)
			itArr2Ap.push('"' +'Quantity'+ '"' + ":" + qty)
			// itArr2Ap.push('"' +'UoMEntry'+ '"' + ":" + uomentry)
			// itArr2Ap.push('"' +'UoMCode'+ '"' + ":" + '"' + uomcode + '"')
			itArr2Ap.push('"' +'AccountCode'+ '"' + ":" +  '"' + acctcode + '"') 
			docLinesAP.push('"' +'DocumentLines'+ '"' + ":" + '[' + '{' + itArr2Ap.join(',') + '}]' );			

			itArrAP.push(docLinesAP)
	

			otArrPctpRowAP.push('{' + itArrAP.join(',') + '}'); 		
			
	        }

			
        });
      	console.log(otArrPctpRow)
      	console.log(otArrPctpRowAP)

        if (err == 0) 
		{
			
		
		if(otArrPctpRow.length != 0){

         $.ajax({
                type: 'POST',
                url: '../proc/exec/exec_add_pctpSAPTransaction.php',
                startTime: performance.now(),
				data: 
				{
					
					otArrPctpRow: otArrPctpRow,
					otArrPctpRowAP: otArrPctpRowAP,
				
                },
			    success: function (data) 
				{
        				console.log(data)
                	let res = $.parseJSON(data)
                	console.log(res.result)
			
                },
                complete: function (data) {
                	$('postingSAP').addClass('d-none')
                	$('sapposting').addClass('d-none')
                	$('postedSAP').removeClass('d-none')
					
					
								     
			     }
            });


		}else{
		
		}


	}
});
//select pctp row
var jsonPctpRow = '{';
var otArrPctpRow = [];
var docLines = [];
$(document.body).on('change', '.selector-row', function () 
{
	let itemCode = $(this).closest('tr').find('td.booking-number').text();
	let errorMessage =  $(this).closest('tr').find('td.error-message').text();
	let cardCode =  $(this).closest('tr').find('td.sap-client-code').text();
	let bookingDate =  $(this).closest('tr').find('td.booking-date').text();
	console.log(cardCode)
	itArr= [];
	itArr2= [];
 // "CardCode": "C20000",
 // "DocDate": "2022-04-01",
 // "DocDueDate": "2022-04-01",
 // "DocumentLines": [
 // "ItemCode": "A00006",
 //    "UnitPrice": 100,
 //    "Quantity": 2,
 //    "TaxCode": "C1",
 //    "UoMEntry": -1,
 //    "UoMCode": "Manual"
 	let unitprice = 1;
 	let qty = 1;
  	let uomentry = -1;
	let uomcode = "Manual";

 	itArr.push('"' +'CardCode'+ '"' + ":" + '"' + cardCode.replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
	
	itArr.push('"' +'DocDate'+ '"' + ":" + '"' + validDate(bookingDate.replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")) + '"')
	
	itArr.push('"' +'DocDueDate'+ '"' + ":" + '"' + validDate(bookingDate.replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")) + '"')



	
	itArr2.push('"' +'ItemCode'+ '"' + ":" + '"' + itemCode + '"')
	itArr2.push('"' +'UnitPrice'+ '"' + ":" + unitprice)
	itArr2.push('"' +'Quantity'+ '"' + ":" + qty)
	itArr2.push('"' +'UoMEntry'+ '"' + ":" + uomentry)
	itArr2.push('"' +'UoMCode'+ '"' + ":" + '"' + uomcode + '"')
	
	docLines.push('"' +'DocumentLines'+ '"' + ":" + '[' + '{' + itArr2.join(',') + '}]' );			

	itArr.push(docLines)
	

otArrPctpRow.push('{' + itArr.join(',') + '}'); 			
console.log(otArrPctpRow)

});

var fadeDelay = 1000;
var fadeDuration = 1000;
	

   
	
var contextMenu = CtxMenu('#content');

 contextMenu.addItem("Item 1", function(){
  // fired on click
});

 
contextMenu.addSeparator();



/*Load Tabs*/
//Contents
let status = 'All';
$('#contents-tab').load('../templates/pctp-pod-lines.php'), function (){
	
};

	



	
//Matrix Cell Effects
	
	
    

//Click
	//Check / Uncheck
	
	

//Update	
	$(document.body).on('click', '#btnUpdate', function () 
	{
		var err = 0;
        var errmsg = '';
		if($('#txtCode').val() == '' ){
			err = 1;
			$('#messageBar2').addClass('d-none');
						$('#messageBar3').removeClass('d-none');
						$('#messageBar').text('Input Approval Code').css({'background-color': 'red', 'color': 'white'});
						
							setTimeout(function()
							{
								$('#messageBar').text('').css({'background-color': '', 'color': ''});	
								$('#messageBar2').removeClass('d-none');
							},5000)
		}
		else if($('#txtDescription').val() == '' ){
			err = 1;
			$('#messageBar2').addClass('d-none');
						$('#messageBar3').removeClass('d-none');
						$('#messageBar').text('Input Approval Description').css({'background-color': 'red', 'color': 'white'});
						
							setTimeout(function()
							{
								$('#messageBar').text('').css({'background-color': '', 'color': ''});	
								$('#messageBar2').removeClass('d-none');
							},5000)
		}
	
		

		
		var txtCode = $('#txtCode').val();
		var txtDescription = $('#txtDescription').val();
		var chkActive = '';
		
		if($('#chkActive').is(':checked')) {
			chkActive = 'Y';
		}
		else{
			chkActive = 'N';
		}
	
		


		var chkModule = new Array();
		$('.subModule').each(function() 
		{
		
			if(!$(this).find(".checked-sub").hasClass('d-none')){
				chkModule.push($(this).attr('id'));
			}
			else{
				
			}
			
		});
		
		var jsonQuery = '{';
        var otArrQuery = [];
        var tbl = $('#tblQueries tbody tr').each(function (i) 
		{
            x = $(this).children();
            var itArr = [];
			

				if ($(this).find('input.qname').val() != ''){
					itArr.push('"' + $(this).find('td.rowno span').text() + '"');
					itArr.push('"' + $(this).find('input.intrnalkey').val() + '"');
					itArr.push('"' + $(this).find('input.qname').val() + '"');
				
				otArrQuery.push('"' + i + '": [' + itArr.join(',') + ']'); 
				}
			
		});
		
		jsonQuery += otArrQuery.join(",") + '}';

		var jsonUser = '{';
        var otArrUser = [];
        var tbl = $('#tblUsers tbody tr').each(function (i) 
		{
            x = $(this).children();
            var itArr = [];

				if ($(this).find('input.userid').val() != ''){
					itArr.push('"' + $(this).find('td.rowno span').text() + '"');
					itArr.push('"' + $(this).find('input.userid').val() + '"');
					itArr.push('"' + $(this).find('input.username').val() + '"');
				
				otArrUser.push('"' + i + '": [' + itArr.join(',') + ']'); 
				}
			
		});
		
		jsonUser += otArrUser.join(",") + '}';

		var jsonTemplate = '{';
        var otArrTemplate = [];
        var tbl = $('#tblTemplate tbody tr').each(function (i) 
		{
            x = $(this).children();

            var itArr = [];
				if ($(this).find('input.approvalstageid').val() != ''){
					itArr.push('"' + $(this).find('td.rowno span').text() + '"');
					itArr.push('"' + $(this).find('input.approvalstageid').val() + '"');
					itArr.push('"' + $(this).find('input.approvalstagename').val() + '"');
				
				otArrTemplate.push('"' + i + '": [' + itArr.join(',') + ']'); 
				}
			
		});
		
		jsonTemplate += otArrTemplate.join(",") + '}';


		console.log(jsonQuery)
		console.log(jsonUser)
		console.log(jsonTemplate)

		if (err == 0) 
		{
			
			$('#loadModal').modal('show');
            $.ajax({
                type: 'POST',
                url: '../proc/exec/exec_update_approval.php',
				data: 
				{
					jsonQuery: jsonQuery.replace(/(\r\n|\n|\r)/gm, '[newline]'),
					jsonUser: jsonUser.replace(/(\r\n|\n|\r)/gm, '[newline]'),
					jsonTemplate: jsonTemplate.replace(/(\r\n|\n|\r)/gm, '[newline]'),
					txtCode : txtCode,
					txtDescription : txtDescription,
					chkActive : chkActive,
					chkModule : chkModule
				
                },
			    success: function (data) 
				{
					var res = $.parseJSON(data);
					
					if(res.valid == true)
					{
						$('#messageBar2').addClass('d-none');
						$('#messageBar3').removeClass('d-none');
						$('#messageBar').text(res.msg).css({'background-color': '#00FF7F', 'color': 'black'});
						
						
							setTimeout(function()
							{
								$('#messageBar').text('').css({'background-color': '', 'color': ''});	
								
							window.location.replace("../templates/approval-document.php");
							},3000)
					}
					else
					{
						$('#messageBar2').addClass('d-none');
						$('#messageBar3').removeClass('d-none');
						$('#messageBar').text(res.msg).css({'background-color': 'red', 'color': 'white'});
						
							setTimeout(function()
							{
								$('#messageBar').text('').css({'background-color': '', 'color': ''});	
								
							},5000)
					}
					$('#loadModal').modal('hide');
                }
            });
        }
		else 
		{
			$('#messageBar').val('Out of bounds').css({'background-color': 'red', 'color': 'white'});
				setTimeout(function()
				{
					$('#messageBar').val('').css({'background-color': '', 'color': ''});	
				},5000)
        }


    });


//Footer
	
//------------------------------------------------------------------------------------------------------------------------------------------------------------------		
/*Functions --------------------------------------------------------------------------------------------------------------------------------------------------------*/
//------------------------------------------------------------------------------------------------------------------------------------------------------------------		
		//BN ARRAY FOR BENEDICT 
function makeArraysOfBookingNumber(){

	var dataTable = $('#tblMain').dataTable()
	var rowInArray = 0;
	let itArrRowsBN = [];
	$(dataTable.fnGetNodes()).each(function(i)
  {

    	
		

			if($(this).find("td:eq(0)").text() != '-' && $(this).find("td:eq(2) span").text() == 'SUCCESS'){

				
				itArrRowsBN.push($(this).find("td:eq(4)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") )					
				

				}
		})

console.log(itArrRowsBN)
$.post('../../addon-pctp-window/res/action.php', { action: 'refreshExtractTables', data: { bookingIds: itArrRowsBN } }).then(res => console.log(res)).catch(err => console.log(err))

}

	function makeArraysOfRows(){

	var dataTable = $('#tblMain').dataTable()
	var rowInArray = 0;


otArrPODNotNullCellsTotal = 0;
otArrBILLINGNotNullCellsTotal = 0;
otArrTPNotNullCellsTotal  = 0;
otArrPRICINGNotNullCellsTotal  = 0;

	$(dataTable.fnGetNodes()).each(function(i)
  {

    	
			let itArrItem = [];
			let itArrPOD = [];

			// console.log($(this).find("td:eq("+i+")").text())
			let itItemRowsCode = [];
			let itArrRowsItem = [];
			let itArrRowsPOD = [];
			let itArrRowsBilling = [];
			let itArrRowsTP = [];
			let itArrRowsPricing = [];
			
			notNullCouterRows = 0;
			notNullCouterRowsButFailed = 0;
			let notNullCouter = 0;


				if($(this).find("td:eq(0)").text() != '-' && $(this).find("td:eq(2) span").text() == 'SUCCESS'){

				itItemRowsCode.push($(this).find("td:eq(4)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''"))
				otArrRowsItemCode.push(itItemRowsCode.join(',')); 

				console.log($(this).find("td:eq(2) span").text())
				itArrRowsItem.push('"' + 'ItemCode' + '"' + ":" + '"' + $(this).find("td:eq(4)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
				itArrRowsItem.push('"' + 'ItemName' + '"' + ":" + '"' + $(this).find("td:eq(4)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
				itArrRowsItem.push('"' + 'InventoryItem' + '"' + ":" + '"' + 'tNO' + '"')					
				itArrRowsItem.push('"' + 'ItemsGroupCode' + '"' + ":" + 103)					


				otArrRowsItem.push('{' + itArrRowsItem.join(',') + '}'); 


				if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
					itArrRowsPOD.push('"' + 'U_BookingDate' + '"' + ":" + '"' + $(this).find("td:eq(3)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
					otArrPODNotNullCellsTotal += 1;
					notNullCouterRows += 1;
				}
				if($(this).find("td:eq(4)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
					itArrRowsPOD.push('"' + 'U_BookingNumber' + '"' + ":" + '"' + $(this).find("td:eq(4)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					otArrPODNotNullCellsTotal += 1;
					notNullCouterRows += 1;
				}
				if($(this).find("td:eq(5)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
					itArrRowsPOD.push('"' + 'U_ClientName' + '"' + ":" + '"' + $(this).find("td:eq(5)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					otArrPODNotNullCellsTotal += 1;
					notNullCouterRows += 1;
				}
				if($(this).find("td:eq(6)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
						itArrRowsPOD.push('"' + 'U_SAPClient' + '"' + ":" + '"' + $(this).find("td:eq(6)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					otArrPODNotNullCellsTotal += 1;
					notNullCouterRows += 1;
				}
				if($(this).find("td:eq(7)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
					itArrRowsPOD.push('"' + 'U_TruckerName' + '"' + ":" + '"' + $(this).find("td:eq(7)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					otArrPODNotNullCellsTotal += 1;
					notNullCouterRows += 1;
				}
				if($(this).find("td:eq(8)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
					itArrRowsPOD.push('"' + 'U_SAPTrucker' + '"' + ":" + '"' + $(this).find("td:eq(8)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					otArrPODNotNullCellsTotal += 1;
					notNullCouterRows += 1;
				}
				if($(this).find("td:eq(9)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
					itArrRowsPOD.push('"' + 'U_PlateNumber' + '"' + ":" + '"' + $(this).find("td:eq(9)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
				
					otArrPODNotNullCellsTotal += 1;
					notNullCouterRows += 1;
				}
				if($(this).find("td:eq(10) div").hasClass('valid') ){
					itArrRowsPOD.push('"' + 'U_VehicleTypeCap' + '"' + ":" + '"' + $(this).find("td:eq(10) select option:selected").attr('data-code') + '"')
					otArrPODNotNullCellsTotal += 1;
					notNullCouterRows += 1;
				}
				if($(this).find("td:eq(11)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
					itArrRowsPOD.push('"' + 'U_DeliveryOrigin' + '"' + ":" + '"' + $(this).find("td:eq(11)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					otArrPODNotNullCellsTotal += 1;
					notNullCouterRows += 1;
				}
				if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
						itArrRowsPOD.push('"' + 'U_ISLAND' + '"' + ":" + '"' + $(this).find("td:eq(12)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					otArrPODNotNullCellsTotal += 1;
					notNullCouterRows += 1;
				}
				if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
					itArrRowsPOD.push('"' + 'U_Destination' + '"' + ":" + '"' + $(this).find("td:eq(13)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					otArrPODNotNullCellsTotal += 1;
					notNullCouterRows += 1;
				}
				if( $(this).find("td:eq(2) span").text() == 'SUCCESS'){
					itArrRowsPOD.push('"' + 'U_ISLAND_D' + '"' + ":" + '"' + $(this).find("td:eq(14)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')			
					otArrPODNotNullCellsTotal += 1;
					notNullCouterRows += 1;
				}
				if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
					itArrRowsPOD.push('"' + 'U_IFINTERISLAND' + '"' + ":" + '"' +   $(this).find("td:eq(15)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					otArrPODNotNullCellsTotal += 1;
					notNullCouterRows += 1;
				}
				if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
					itArrRowsPOD.push('"' + 'U_DeliveryStatus' + '"' + ":" + '"' + $(this).find("td:eq(16) select option:selected").attr('data-code') + '"')
					notNullCouterRows += 1;
				}
				if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
					itArrRowsPOD.push('"' + 'U_DeliveryDateDTR' + '"' + ":" + '"' + $(this).find("td:eq(17)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					otArrPODNotNullCellsTotal += 1;
					notNullCouterRows += 1;
				}
				if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
					itArrRowsPOD.push('"' + 'U_DeliveryDatePOD' + '"' + ":" + '"' + $(this).find("td:eq(18)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					otArrPODNotNullCellsTotal += 1;
					notNullCouterRows += 1;
				}
                if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
					itArrRowsPOD.push('"' + 'U_NoOfDrops' + '"' + ":" + '"' + $(this).find("td:eq(19)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					otArrPODNotNullCellsTotal += 1;
					notNullCouterRows += 1;
				}
                if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
					itArrRowsPOD.push('"' + 'U_TripType' + '"' + ":" + '"' + $(this).find("td:eq(20) select").val() + '"')
					otArrPODNotNullCellsTotal += 1;
					notNullCouterRows += 1;
				}
                if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
					itArrRowsPOD.push('"' + 'U_Remarks' + '"' + ":" + '"' + $(this).find("td:eq(21)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					otArrPODNotNullCellsTotal += 1;
					notNullCouterRows += 1;
				}   if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
					itArrRowsPOD.push('"' + 'U_DocNum' + '"' + ":" + '"' + $(this).find("td:eq(22)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					otArrPODNotNullCellsTotal += 1;
					notNullCouterRows += 1;
				}   if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
					itArrRowsPOD.push('"' + 'U_TripTicketNo' + '"' + ":" + '"' + $(this).find("td:eq(23)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					otArrPODNotNullCellsTotal += 1;
					notNullCouterRows += 1;
				}   if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
				itArrRowsPOD.push('"' + 'U_WaybillNo' + '"' + ":" + '"' + $(this).find("td:eq(24)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
				otArrPODNotNullCellsTotal += 1;
				notNullCouterRows += 1;
        }   if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
						itArrRowsPOD.push('"' + 'U_ShipmentNo' + '"' + ":" + '"' + $(this).find("td:eq(25)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
						otArrPODNotNullCellsTotal += 1;
						notNullCouterRows += 1;
        }   if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_DeliveryReceiptNo' + '"' + ":" + '"' + $(this).find("td:eq(26)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }   if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_SeriesNo' + '"' + ":" + '"' + $(this).find("td:eq(27)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }   if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_OtherPODDoc' + '"' + ":" + '"' + $(this).find("td:eq(28)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }   if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_RemarksPOD' + '"' + ":" + '"' + $(this).find("td:eq(29)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }   if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_Receivedby' + '"' + ":" + '"' + $(this).find("td:eq(30)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }   if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_ClientReceivedDate' + '"' + ":" + '"' + $(this).find("td:eq(31)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_ActualDateRec_Intitial' + '"' + ":" + '"' + $(this).find("td:eq(32)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_InitialHCRecDate' + '"' + ":" + '"' + $(this).find("td:eq(33)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_ActualHCRecDate' + '"' + ":" + '"' + $(this).find("td:eq(34)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_DateReturned' + '"' + ":" + '"' + $(this).find("td:eq(35)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_PODinCharge' + '"' + ":" + '"' + $(this).find("td:eq(36)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_VerifiedDateHC' + '"' + ":" + '"' + $(this).find("td:eq(37)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_PODStatusDetail' + '"' + ":" + '"' + $(this).find("td:eq(38)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_PTFNo' + '"' + ":" + '"' + $(this).find("td:eq(39)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_DateForwardedBT' + '"' + ":" + '"' + $(this).find("td:eq(40)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_POD_TAT' + '"' + ":" + $(this).find("td:eq(41)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") )
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_BillingStatus' + '"' + ":" + '"' + $(this).find("td:eq(42)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_ServiceType' + '"' + ":" + '"' + $(this).find("td:eq(43)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_SINo' + '"' + ":" + '"' + $(this).find("td:eq(44)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_BillingTeam' + '"' + ":" + '"' + $(this).find("td:eq(45)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_BTRemarks' + '"' + ":" + '"' + $(this).find("td:eq(46)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_SOBNumber' + '"' + ":" + '"' + $(this).find("td:eq(47)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_OutletNo' + '"' + ":" + '"' + $(this).find("td:eq(48)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }
        if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_SI_DRNo' + '"' + ":" + '"' + $(this).find("td:eq(49)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_CBM' + '"' + ":" + '"' + $(this).find("td:eq(50)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_DeliveryMode' + '"' + ":" + '"' + $(this).find("td:eq(51)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_SourceWhse' + '"' + ":" + '"' + $(this).find("td:eq(52)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_DestinationClient' + '"' + ":" + '"' + $(this).find("td:eq(53)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_TotalInvAmount' + '"' + ":" +  '"'  + $(this).find("td:eq(54)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }
        if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_SONo' + '"' + ":" + '"' + $(this).find("td:eq(55)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_NameCustomer' + '"' + ":" + '"' + $(this).find("td:eq(56)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_CategoryDR' + '"' + ":" + '"' + $(this).find("td:eq(57)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_ForwardLoad' + '"' + ":" + '"' + $(this).find("td:eq(58)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_BackLoad' + '"' + ":" + '"' + $(this).find("td:eq(59)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_IDNumber' + '"' + ":" + '"' + $(this).find("td:eq(60)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_TypeOfAccessorial' + '"' + ":" + '"' + $(this).find("td:eq(61)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_ApprovalStatus' + '"' + ":" + '"' + $(this).find("td:eq(62)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_TimeInEmptyDem' + '"' + ":" + '"' + $(this).find("td:eq(63)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_TimeOutEmptyDem' + '"' + ":" + '"' + $(this).find("td:eq(64)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_VerifiedEmptyDem' + '"' + ":" + '"' + $(this).find("td:eq(65)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_TimeInLoadedDem' + '"' + ":" + '"' + $(this).find("td:eq(66)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_TimeOutLoadedDem' + '"' + ":" + '"' + $(this).find("td:eq(67)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_VerifiedLoadedDem' + '"' + ":" + '"' + $(this).find("td:eq(68)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_Remarks2' + '"' + ":" + '"' + $(this).find("td:eq(69)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_TimeInAdvLoading' + '"' + ":" + '"' + $(this).find("td:eq(70)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_DayOfTheWeek' + '"' + ":" +  $(this).find("td:eq(71)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") )
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_TimeIn' + '"' + ":" + '"' + $(this).find("td:eq(72)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_TimeOut' + '"' + ":" + '"' + $(this).find("td:eq(73)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_TotalNoExceed' + '"' + ":" +  $(this).find("td:eq(74)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") )
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_ODOIn' + '"' + ":" +  $(this).find("td:eq(75)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") )
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_ODOOut' + '"' + ":" +  $(this).find("td:eq(76)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") )
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_TotalUsage' + '"' + ":" +  $(this).find("td:eq(77)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") )
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_ClientSubStatus' + '"' + ":" + '"' + $(this).find("td:eq(82)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_ClientSubOverdue' + '"' + ":" + '"' + $(this).find("td:eq(83)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_ClientPenaltyCalc' + '"' + ":" + '"' + $(this).find("td:eq(84)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_PODStatusPayment' + '"' + ":" + '"' + $(this).find("td:eq(85)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_PODSubmitDeadline' + '"' + ":" + '"' + $(this).find("td:eq(86)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_OverdueDays' + '"' + ":" + $(this).find("td:eq(87)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''"))
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_InteluckPenaltyCalc' + '"' + ":" + '"' + $(this).find("td:eq(88)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_WaivedDays' + '"' + ":" + '"' + $(this).find("td:eq(89)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_HolidayOrWeekend' + '"' + ":" + '"' + $(this).find("td:eq(90)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_LostPenaltyCalc' + '"' + ":" + '"' + $(this).find("td:eq(91)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_TotalSubPenalties' + '"' + ":" + '"' + $(this).find("td:eq(92)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_Waived' + '"' + ":" + '"' + $(this).find("td:eq(93)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_PercPenaltyCharge' + '"' + ":" + '"' + $(this).find("td:eq(94)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_Approvedby' + '"' + ":" + '"' + $(this).find("td:eq(95)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;
        }if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
            itArrRowsPOD.push('"' + 'U_TotalPenaltyWaived' + '"' + ":" + '"' + $(this).find("td:eq(96)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
            otArrPODNotNullCellsTotal += 1;
            notNullCouterRows += 1;

           }
				//NAME

				// alert( $(this).find("td:eq(94)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''"))
				itArrRowsPOD.push('"' + 'Name' + '"' + ":" + '"' + $(this).find("td:eq(4)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
				
				otArrRowsPOD.push('{' + itArrRowsPOD.join(',') + '}'); 
		
				otArrPODNotNullCellsRow.push(notNullCouterRows)


				console.log(otArrRowsPOD)

				// BILLING


if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_BookingDate' + '"' + ":" + '"' + $(this).find("td:eq(3)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_BookingId' + '"' + ":" + '"' + $(this).find("td:eq(4)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_CustomerName' + '"' + ":" + '"' + $(this).find("td:eq(5)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_SAPClient' + '"' + ":" + '"' + $(this).find("td:eq(6)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_PlateNumber' + '"' + ":" + '"' + $(this).find("td:eq(9)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_VehicleTypeCap' + '"' + ":" + '"' + $(this).find("td:eq(10) select option:selected").attr('data-code') + '"')
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_DeliveryOrigin' + '"' + ":" + '"' + $(this).find("td:eq(11)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
					itArrRowsBilling.push('"' + 'U_Destination' + '"' + ":" + '"' + $(this).find("td:eq(13)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
					otArrBILLINGNotNullCellsTotal += 1;
				
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_DeliveryStatus' + '"' + ":" + '"' + $(this).find("td:eq(16) select option:selected").attr('data-code') + '"')
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_DeliveryDatePOD' + '"' + ":" + '"' + $(this).find("td:eq(18)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_NoOfDrops' + '"' + ":" +  $(this).find("td:eq(19)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") )					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_TripType' + '"' + ":" + '"' + $(this).find("td:eq(20) select").val() + '"')
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_Remarks' + '"' + ":" + '"' + $(this).find("td:eq(21)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_DocNum' + '"' + ":" + '"' + $(this).find("td:eq(22)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_WaybillNo' + '"' + ":" + '"' + $(this).find("td:eq(24)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_ShipmentManifestNo' + '"' + ":" + '"' + $(this).find("td:eq(25)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_DeliveryReceiptNo' + '"' + ":" + '"' + $(this).find("td:eq(26)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_SeriesNo' + '"' + ":" + '"' + $(this).find("td:eq(27)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_OtherPODDoc' + '"' + ":" + '"' + $(this).find("td:eq(28)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_RemarksPOD' + '"' + ":" + '"' + $(this).find("td:eq(29)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_ClientReceivedDate' + '"' + ":" + '"' + $(this).find("td:eq(31)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_ActualHCRecDate' + '"' + ":" + '"' + $(this).find("td:eq(34)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}
if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_PODinCharge' + '"' + ":" + '"' + $(this).find("td:eq(36)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_VerifiedDateHC' + '"' + ":" + '"' + $(this).find("td:eq(37)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_PODStatusDetail' + '"' + ":" + '"' + $(this).find("td:eq(38)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_PTFNo' + '"' + ":" + '"' + $(this).find("td:eq(39)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_DateForwardedBT' + '"' + ":" + '"' + $(this).find("td:eq(40)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_BillingStatus' + '"' + ":" + '"' + $(this).find("td:eq(42)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_ServiceType' + '"' + ":" + '"' + $(this).find("td:eq(43)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_SINo' + '"' + ":" + '"' + $(this).find("td:eq(44)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_BillingTeam' + '"' + ":" + '"' + $(this).find("td:eq(45)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_BTRemarks' + '"' + ":" + '"' + $(this).find("td:eq(46)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_SOBNumber' + '"' + ":" + '"' + $(this).find("td:eq(47)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_OutletNo' + '"' + ":" + '"' + $(this).find("td:eq(48)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_SI_DRNo' + '"' + ":" + '"' + $(this).find("td:eq(49)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_CBM' + '"' + ":" + '"' + $(this).find("td:eq(50)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_DeliveryMode' + '"' + ":" + '"' + $(this).find("td:eq(51)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_SourceWhse' + '"' + ":" + '"' + $(this).find("td:eq(52)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_DestinationClient' + '"' + ":" + '"' + $(this).find("td:eq(53)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_TotalInvAmount' + '"' + ":" + '"' + $(this).find("td:eq(54)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_SONo' + '"' + ":" + '"' + $(this).find("td:eq(55)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_NameCustomer' + '"' + ":" + '"' + $(this).find("td:eq(56)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_CategoryDR' + '"' + ":" + '"' + $(this).find("td:eq(57)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_ForwardLoad' + '"' + ":" + '"' + $(this).find("td:eq(58)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_BackLoad' + '"' + ":" + '"' + $(this).find("td:eq(59)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_IDNumber' + '"' + ":" + '"' + $(this).find("td:eq(60)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_TypeOfAccessorial' + '"' + ":" + '"' + $(this).find("td:eq(61)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_Status' + '"' + ":" + '"' + $(this).find("td:eq(62)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_TimeInEmptyDem' + '"' + ":" + '"' + $(this).find("td:eq(63)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_TimeOutEmptyDem' + '"' + ":" + '"' + $(this).find("td:eq(64)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_VerifiedEmptyDem' + '"' + ":" + '"' + $(this).find("td:eq(65)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_TimeInLoadedDem' + '"' + ":" + '"' + $(this).find("td:eq(66)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_TimeOutLoadedDem' + '"' + ":" + '"' + $(this).find("td:eq(67)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_VerifiedLoadedDem' + '"' + ":" + '"' + $(this).find("td:eq(68)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_Remarks' + '"' + ":" + '"' + $(this).find("td:eq(69)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_TimeInAdvLoading' + '"' + ":" + '"' + $(this).find("td:eq(70)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_DayOfTheWeek' + '"' + ":" + '"' + $(this).find("td:eq(71)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_TimeIn' + '"' + ":" + '"' + $(this).find("td:eq(72)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_TimeOut' + '"' + ":" + '"' + $(this).find("td:eq(73)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_TotalExceed' + '"' + ":" +  $(this).find("td:eq(74)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") )					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_ODOIn' + '"' + ":" + '"' + $(this).find("td:eq(75)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_ODOOut' + '"' + ":" + '"' + $(this).find("td:eq(76)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_TotalUsage' + '"' + ":" +  $(this).find("td:eq(77)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") )					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_Demurrage' + '"' + ":" +  $(this).find("td:eq(105)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") )					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_AddCharges' + '"' + ":" + $(this).find("td:eq(112)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") )					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_ActualBilledRate' + '"' + ":" +  $(this).find("td:eq(124)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''"))					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_RateAdjustments' + '"' + ":" +  $(this).find("td:eq(125)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''"))					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_ActualDemurrage' + '"' + ":" +  $(this).find("td:eq(126)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''"))					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_ActualAddCharges' + '"' + ":" +  $(this).find("td:eq(127)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''"))					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_TotalRecClients' + '"' + ":" +  $(this).find("td:eq(128)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''"))					
    otArrBILLINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsBilling.push('"' + 'U_CWT2307' + '"' + ":" +  $(this).find("td:eq(129)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''"))					
    otArrBILLINGNotNullCellsTotal += 1;
}
	itArrRowsBilling.push('"' + 'Name' + '"' + ":" + '"' + $(this).find("td:eq(4)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
				
				otArrRowsBilling.push('{' + itArrRowsBilling.join(',') + '}'); 
		


//TP


if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsTP.push('"' + 'U_BookingDate' + '"' + ":" + '"' + $(this).find("td:eq(3)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrTPNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsTP.push('"' + 'U_BookingId' + '"' + ":" + '"' + $(this).find("td:eq(4)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrTPNotNullCellsTotal += 1;  
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsTP.push('"' + 'U_ClientName' + '"' + ":" + '"' + $(this).find("td:eq(5)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrTPNotNullCellsTotal += 1; 
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsTP.push('"' + 'U_TruckerName' + '"' + ":" + '"' + $(this).find("td:eq(7)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrTPNotNullCellsTotal += 1; 
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsTP.push('"' + 'U_TruckerSAP' + '"' + ":" + '"' + $(this).find("td:eq(8)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrTPNotNullCellsTotal += 1; 
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsTP.push('"' + 'U_DeliveryStatus' + '"' + ":" + '"' + $(this).find("td:eq(16) select option:selected").attr('data-code') + '"')
    otArrTPNotNullCellsTotal += 1; 
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsTP.push('"' + 'U_DeliveryDatePOD' + '"' + ":" + '"' + $(this).find("td:eq(18)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrTPNotNullCellsTotal += 1;  
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsTP.push('"' + 'U_Remarks' + '"' + ":" + '"' + $(this).find("td:eq(21)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrTPNotNullCellsTotal += 1;  
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsTP.push('"' + 'U_DocNum' + '"' + ":" + '"' + $(this).find("td:eq(22)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrTPNotNullCellsTotal += 1;  
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsTP.push('"' + 'U_TripTicketNo' + '"' + ":" + '"' + $(this).find("td:eq(23)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrTPNotNullCellsTotal += 1;  
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsTP.push('"' + 'U_WaybillNo' + '"' + ":" + '"' + $(this).find("td:eq(24)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrTPNotNullCellsTotal += 1;  
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsTP.push('"' + 'U_ShipmentManifestNo' + '"' + ":" + '"' + $(this).find("td:eq(25)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrTPNotNullCellsTotal += 1;  
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsTP.push('"' + 'U_DeliveryReceiptNo' + '"' + ":" + '"' + $(this).find("td:eq(26)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrTPNotNullCellsTotal += 1;  
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsTP.push('"' + 'U_SeriesNo' + '"' + ":" + '"' + $(this).find("td:eq(27)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrTPNotNullCellsTotal += 1; 
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsTP.push('"' + 'U_OtherPODDoc' + '"' + ":" + '"' + $(this).find("td:eq(28)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrTPNotNullCellsTotal += 1; 
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsTP.push('"' + 'U_REMARKS1' + '"' + ":" + '"' + $(this).find("td:eq(29)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrTPNotNullCellsTotal += 1;
}
if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsTP.push('"' + 'U_TPStatus' + '"' + ":" + '"' + $(this).find("td:eq(81)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrTPNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsTP.push('"' + 'U_TotalSubPenalty' + '"' + ":" +  $(this).find("td:eq(92)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") )					
    otArrTPNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsTP.push('"' + 'U_TotalPenaltyWaived' + '"' + ":" +  $(this).find("td:eq(96)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") )					
    otArrTPNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsTP.push('"' + 'U_GrossTruckerRates' + '"' + ":" +  $(this).find("td:eq(101)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") )					
    otArrTPNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsTP.push('"' + 'U_GrossTruckerRatesN' + '"' + ":" +  $(this).find("td:eq(102)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") )					
    otArrTPNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsTP.push('"' + 'U_RateBasis' + '"' + ":" + '"' + $(this).find("td:eq(103) select option:selected").attr('data-code')  + '"')					
    otArrTPNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsTP.push('"' + 'U_TaxType' + '"' + ":" + '"' + $(this).find("td:eq(104)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrTPNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsTP.push('"' + 'U_Demurrage' + '"' + ":" + '"' + $(this).find("td:eq(113)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrTPNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsTP.push('"' + 'U_AddtlDrop' + '"' + ":" + '"' + $(this).find("td:eq(114)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrTPNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsTP.push('"' + 'U_BoomTruck' + '"' + ":" + '"' + $(this).find("td:eq(115)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrTPNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsTP.push('"' + 'U_Manpower' + '"' + ":" + '"' + $(this).find("td:eq(116)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrTPNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsTP.push('"' + 'U_BackLoad' + '"' + ":" + '"' + $(this).find("td:eq(117)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrTPNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsTP.push('"' + 'U_Addtlcharges' + '"' + ":" + $(this).find("td:eq(118)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''"))					
    otArrTPNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsTP.push('"' + 'U_DemurrageN' + '"' + ":" + '"' + $(this).find("td:eq(119)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrTPNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsTP.push('"' + 'U_AddtlChargesN' + '"' + ":" + '"' + $(this).find("td:eq(120)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrTPNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsTP.push('"' + 'U_ActualDemurrage' + '"' + ":" + '"' + $(this).find("td:eq(126)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrTPNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsTP.push('"' + 'U_ActualCharges' + '"' + ":" + $(this).find("td:eq(127)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") )					
    otArrTPNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsTP.push('"' + 'U_ActualRates' + '"' + ":" + $(this).find("td:eq(131)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") )					
    otArrTPNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsTP.push('"' + 'U_RateAdjustments' + '"' + ":" + $(this).find("td:eq(132)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") )					
    otArrTPNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsTP.push('"' + 'U_BoomTruck2' + '"' + ":" + '"' + $(this).find("td:eq(135)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrTPNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsTP.push('"' + 'U_OtherCharges' + '"' + ":" + $(this).find("td:eq(136)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") )					
    otArrTPNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsTP.push('"' + 'U_TotalPenalty' + '"' + ":" + $(this).find("td:eq(137)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") )					
    otArrTPNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsTP.push('"' + 'U_TotalPayable' + '"' + ":" + $(this).find("td:eq(138)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") )					
    otArrTPNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsTP.push('"' + 'U_EWT2307' + '"' + ":" + $(this).find("td:eq(139)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") )					
    otArrTPNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsTP.push('"' + 'U_TotalPayableRec' + '"' + ":" + $(this).find("td:eq(140)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''"))					
    otArrTPNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsTP.push('"' + 'U_ActualPaymentDate' + '"' + ":" + '"' + $(this).find("td:eq(141)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrTPNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsTP.push('"' + 'U_PaymentReference' + '"' + ":" + '"' + $(this).find("td:eq(142)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrTPNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsTP.push('"' + 'U_ORRefNo' + '"' + ":" + '"' + $(this).find("td:eq(143)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrTPNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsTP.push('"' + 'U_PaymentVoucherNo' + '"' + ":" + '"' + $(this).find("td:eq(144)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrTPNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsTP.push('"' + 'U_PaymentStatus' + '"' + ":" + '"' + $(this).find("td:eq(145)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrTPNotNullCellsTotal += 1;
}

	itArrRowsTP.push('"' + 'Name' + '"' + ":" + '"' + $(this).find("td:eq(4)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
				
				otArrRowsTP.push('{' + itArrRowsTP.join(',') + '}'); 


// PRICING

if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsPricing.push('"' + 'U_BookingDate' + '"' + ":" + '"' + $(this).find("td:eq(3)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrPRICINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsPricing.push('"' + 'U_BookingId' + '"' + ":" + '"' + $(this).find("td:eq(4)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrPRICINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsPricing.push('"' + 'U_CustomerName' + '"' + ":" + '"' + $(this).find("td:eq(5)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrPRICINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsPricing.push('"' + 'U_TruckerName' + '"' + ":" + '"' + $(this).find("td:eq(7)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrPRICINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsPricing.push('"' + 'U_VehicleTypeCap' + '"' + ":" + '"' + $(this).find("td:eq(10) select option:selected").attr('data-code') + '"')
    otArrPRICINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsPricing.push('"' + 'U_DeliveryOrigin' + '"' + ":" + '"' + $(this).find("td:eq(11)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrPRICINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsPricing.push('"' + 'U_Destination' + '"' + ":" + '"' + $(this).find("td:eq(13)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrPRICINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsPricing.push('"' + 'U_DeliveryStatus' + '"' + ":" + '"' + $(this).find("td:eq(16) select option:selected").attr('data-code') + '"')
    otArrPRICINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsPricing.push('"' + 'U_NoOfDrops' + '"' + ":" +  $(this).find("td:eq(19)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") )					
    otArrPRICINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsPricing.push('"' + 'U_TripType' + '"' + ":" + '"' + $(this).find("td:eq(20) select").val() + '"')
    otArrPRICINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsPricing.push('"' + 'U_RemarksPOD' + '"' + ":" + '"' + $(this).find("td:eq(29)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrPRICINGNotNullCellsTotal += 1;
}


if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsPricing.push('"' + 'U_GrossClientRates' + '"' + ":" + $(this).find("td:eq(97)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")	)		
    otArrPRICINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsPricing.push('"' + 'U_GrossClientRatesTax' + '"' + ":" + $(this).find("td:eq(98)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")	)				
    otArrPRICINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsPricing.push('"' + 'U_RateBasis' + '"' + ":" + '"' + $(this).find("td:eq(99) select option:selected").attr('data-code') + '"')					
    otArrPRICINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsPricing.push('"' + 'U_TaxType' + '"' + ":" + '"' + $(this).find("td:eq(100)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrPRICINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsPricing.push('"' + 'U_GrossTruckerRates' + '"' + ":" + $(this).find("td:eq(101)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")	)				
    otArrPRICINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsPricing.push('"' + 'U_GrossTruckerRatesTax' + '"' + ":" + $(this).find("td:eq(102)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")	)				
    otArrPRICINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsPricing.push('"' + 'U_RateBasisT' + '"' + ":" + '"' + $(this).find("td:eq(103) select option:selected").attr('data-code') + '"')					
    otArrPRICINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsPricing.push('"' + 'U_TaxTypeT' + '"' + ":" + '"' + $(this).find("td:eq(104)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrPRICINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsPricing.push('"' + 'U_Demurrage' + '"' + ":" + $(this).find("td:eq(105)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")	)				
    otArrPRICINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsPricing.push('"' + 'U_AddtlDrop' + '"' + ":" + $(this).find("td:eq(106)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")	)				
    otArrPRICINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsPricing.push('"' + 'U_BoomTruck' + '"' + ":" + $(this).find("td:eq(107)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")	)			
    otArrPRICINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsPricing.push('"' + 'U_Manpower' + '"' + ":" + $(this).find("td:eq(108)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")	)				
    otArrPRICINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsPricing.push('"' + 'U_Backload' + '"' + ":" + $(this).find("td:eq(109)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")	)				
    otArrPRICINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsPricing.push('"' + 'U_TotalAddtlCharges' + '"' + ":" + $(this).find("td:eq(110)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")	)			
    otArrPRICINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsPricing.push('"' + 'U_AddtlCharges' + '"' + ":" + $(this).find("td:eq(112)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")	)				
    otArrPRICINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsPricing.push('"' + 'U_Demurrage2' + '"' + ":" + $(this).find("td:eq(113)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")	)				
    otArrPRICINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsPricing.push('"' + 'U_AddtlDrop2' + '"' + ":" + $(this).find("td:eq(114)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")	)			
    otArrPRICINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsPricing.push('"' + 'U_BoomTruck2' + '"' + ":" + $(this).find("td:eq(115)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")	)			
    otArrPRICINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsPricing.push('"' + 'U_Manpower2' + '"' + ":" + $(this).find("td:eq(116)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")	)			
    otArrPRICINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsPricing.push('"' + 'U_Backload2' + '"' + ":" + $(this).find("td:eq(117)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")	)		
    otArrPRICINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsPricing.push('"' + 'U_totalAddtlCharges2' + '"' + ":" + $(this).find("td:eq(118)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")	)				
    otArrPRICINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsPricing.push('"' + 'U_AddtlCharges2' + '"' + ":" + $(this).find("td:eq(120)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")	)			
    otArrPRICINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsPricing.push('"' + 'U_TotalInitialClient' + '"' + ":" + $(this).find("td:eq(121)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")	)			
    otArrPRICINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsPricing.push('"' + 'U_TotalInitialTruckers' + '"' + ":" + $(this).find("td:eq(122)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''"))
    otArrPRICINGNotNullCellsTotal += 1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsPricing.push('"' + 'U_TotalGrossProfit' + '"' + ":" + $(this).find("td:eq(123)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")	)				
    otArrPRICINGNotNullCellsTotal += 1;
}

itArrRowsPricing.push('"' + 'Name' + '"' + ":" + '"' + $(this).find("td:eq(4)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
				
				otArrRowsPricing.push('{' + itArrRowsPricing.join(',') + '}'); 

				rowInArray+=1
				console.log(rowInArray)
			}



		});
		$('.itemsoverall').text(otArrRowsItem.length)
   	$('.podoverall').text(otArrRowsPOD.length)
		$('.countoverall').text(otArrPODNotNullCellsTotal)
}
	


	function FormatMoney(amount){
		let preAmount = accounting.formatMoney(amount, "", 2);
		
		
		return preAmount;
	} 
	function FormatQuantity(amount){
		let preAmount = accounting.formatMoney(amount, "", 2);
		
		
		return preAmount;
	}
	function FormatMoneyWithCurrency(amount){
		let preAmount = accounting.formatMoney(amount, txtCurrency + " " , 2);
		
		
		return preAmount;
	} 
	
	function NumberWithCommas(value) 
	{
		var parts = value.toString().split(".");
		parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
		return parts.join(".");
	}
	
	function IsNumberKey(e)
    {
		
        var charCode = (e.which) ? e.which : e.keyCode;
        if (charCode != 46 && charCode > 31 
			&& (charCode < 48 || charCode > 57))
          return false;

        return true;
    }
  function resetFieldsCreation(){
  	$('input').val('')
  	$('.checked-sub').addClass('d-none');
	$('.subModule').css('background-color','white');

  }
	function validatePOSTSAP(){
		var dataTable = $('#tblMain').dataTable()
      var err = '';
     	$(dataTable.fnGetNodes()).each(function(i)
     	{
     		if($(this).find("td:eq(2)").text() == 'FAILED'){
     			$('#btnPostSAPTransaction').prop('disabled',true)
     		}
     	})
	}
	function validDate(string){
		if(string.length == 10){
			let month = string.substr(-10, 2);
			let month2 = string.substr(-10, 1);
			let month3 = string.substr(-9, 1);
			if(string.substr(-10, 1) == ' '){
				month = '0' + month3;
			}
			//console.log(month2)
			let firstSlash = string.substr(-5, 1);
			let day = string.substr(-7, 2);
			let day2 = string.substr(-7, 1);
			let day3 = string.substr(-6, 1);
			if(string.substr(-7, 1) == ' '){
				day = '0' + day3;
			}
			let secondSlash = string.substr(-8, 1);
			let year = string.substr(-4, 4);


			result = year + '-' + month + '-' + day;
			//console.log(result)
			return result;
		}
		else{
			result = '2000-01-01';
			//console.log(result)
			return result;
		}
		
		
	}
	
});