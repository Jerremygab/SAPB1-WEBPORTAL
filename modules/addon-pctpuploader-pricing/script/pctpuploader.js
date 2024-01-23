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

$('#pageTitle').text('PCTP Uploader Pricing | SAP B1');	
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
					$('.clientoverall').text(jsonData.ClientTotal);
					$('.truckeroverall').text(jsonData.TruckerTotal);



					



			    console.log(jsonData)
			  $('#tblMain').DataTable({
			    data  :  jsonData.table,
		    	columns :  [
			      { data : "rowNumber" },
			      { data : "ErrorMessage" },
			      { data : "UploadStatus" },

			      { data : "BookingNumber" },


			      { data : "GROSSClientRates" },
			      { data : "RateBasis" },


			      { data : "GROSSTruckerrates" },
			     	{ data : "RateBasisTrucker" },


			      { data : "DemurrageClient" },
			      { data : "AddtlDropClient" },
			      { data : "BoomTruckClient" },
			      { data : "ManpowerClient" },
			      { data : "BackloadClient" },


			      { data : "DemurrageTrucker"},
			      { data : "AddtlDropTrucker"},
			      { data : "BoomTruckTrucker"},
			      { data : "ManpowerTrucker"},
			      { data : "BackloadTrucker"},




			     ],
			     columnDefs: [
			     	// { defaultContent: "-" ,"targets": "_all"},
			     	//VALIDATOR
			     	 {"defaultContent": "-",
				    "targets": "_all"},

			     	{ className: "rowno", "targets": [0] },
			     	{ className: "error-message", "targets": [2] },
			

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

		console.log(otArrRowsPricing)
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
		
		$('.countloading').removeClass('d-none')
		$('.clientloading').removeClass('d-none')
		$('.truckerloading').removeClass('d-none')
		


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
   

   	if(otArrRowsPricing.length != 0){
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
		    let notNullCells = otArrPRICINGNotNullCellsTotal;
		    
		    // console.log(itemData);
		    // console.log(podData);
				// console.log(billingData);
				// console.log(tpData);
				console.log(pricingData);
		    // console.log(notNullCells);


	    	$.ajax({
	        type: 'POST',
	        url: '../proc/exec/exec_update_pctpItemAndPODNew.php',
	        startTime: performance.now(),
					data:{
						pricingData: pricingData,
						notNullCells: notNullCells

						
					},
				  success: function (data){
						console.log(data)
						let res = $.parseJSON(data)
        		// // console.log(res)
					
	
						let PODPosted = $.parseJSON(res.PODPosted)

					
			
						console.log(PODPosted)
						console.log(res.podData)
						$('.poduploaded').text(PODPosted)
						$('.clientuploaded').text(res.ClientTotalUploaded)
						$('.truckeruploaded').text(res.TruckerTotalUploaded)
						
						
						$('.podloading').addClass('d-none')
		    		console.log('NEW POD ADDED')
		    		$('.countuploaded').text(otArrPRICINGNotNullCellsTotal)
		    		$('.countloading').addClass('d-none')
		    		$('.clientloading').addClass('d-none')
		    		$('.truckerloading').addClass('d-none')

		
						
	        	
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
											
												$('.podloading').addClass('d-none')
												$('#btnPost').prop('disabled',true);	
												return false;
												
								
									
							
							},1000)

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

				
				itArrRowsBN.push($(this).find("td:eq(3)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") )					
				

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



				// BILLING



// PRICING
			if($(this).find("td:eq(0)").text() != '-' && $(this).find("td:eq(2) span").text() == 'SUCCESS'){

if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsPricing.push('"' + 'U_BookingId' + '"' + ":" + '"' + $(this).find("td:eq(3)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')					
    otArrPRICINGNotNullCellsTotal += 1;
    notNullCouterRows+=1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsPricing.push('"' + 'U_GrossClientRates' + '"' + ":" + $(this).find("td:eq(4)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")	)		
    otArrPRICINGNotNullCellsTotal += 1;
    notNullCouterRows+=1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsPricing.push('"' + 'U_RateBasis' + '"' + ":" + '"' +  $(this).find("td:eq(5) select option:selected").attr('data-code') + '"')		
    otArrPRICINGNotNullCellsTotal += 1;
    notNullCouterRows+=1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsPricing.push('"' + 'U_GrossTruckerRates' + '"' + ":" + $(this).find("td:eq(6)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")	)				
    otArrPRICINGNotNullCellsTotal += 1;
    notNullCouterRows+=1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsPricing.push('"' + 'U_RateBasisT' + '"' + ":" + '"' + $(this).find("td:eq(7) select option:selected").attr('data-code') +	 '"')		
    otArrPRICINGNotNullCellsTotal += 1;
    notNullCouterRows+=1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsPricing.push('"' + 'U_Demurrage' + '"' + ":" + $(this).find("td:eq(8)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")	)				
    otArrPRICINGNotNullCellsTotal += 1;
    notNullCouterRows+=1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsPricing.push('"' + 'U_AddtlDrop' + '"' + ":" + $(this).find("td:eq(9)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")	)				
    otArrPRICINGNotNullCellsTotal += 1;
    notNullCouterRows+=1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsPricing.push('"' + 'U_BoomTruck' + '"' + ":" + $(this).find("td:eq(10)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")	)			
    otArrPRICINGNotNullCellsTotal += 1;
    notNullCouterRows+=1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsPricing.push('"' + 'U_Manpower' + '"' + ":" + $(this).find("td:eq(11)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")	)				
    otArrPRICINGNotNullCellsTotal += 1;
    notNullCouterRows+=1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsPricing.push('"' + 'U_Backload' + '"' + ":" + $(this).find("td:eq(12)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")	)				
    otArrPRICINGNotNullCellsTotal += 1;
    notNullCouterRows+=1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsPricing.push('"' + 'U_Demurrage2' + '"' + ":" + $(this).find("td:eq(13)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")	)				
    otArrPRICINGNotNullCellsTotal += 1;
    notNullCouterRows+=1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsPricing.push('"' + 'U_AddtlDrop2' + '"' + ":" + $(this).find("td:eq(14)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")	)			
    otArrPRICINGNotNullCellsTotal += 1;
    notNullCouterRows+=1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsPricing.push('"' + 'U_BoomTruck2' + '"' + ":" + $(this).find("td:eq(15)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")	)			
    otArrPRICINGNotNullCellsTotal += 1;
    notNullCouterRows+=1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsPricing.push('"' + 'U_Manpower2' + '"' + ":" + $(this).find("td:eq(16)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")	)			
    otArrPRICINGNotNullCellsTotal += 1;
    notNullCouterRows+=1;
}if($(this).find("td:eq(3)").text() != ''  && $(this).find("td:eq(2) span").text() == 'SUCCESS'){
    itArrRowsPricing.push('"' + 'U_Backload2' + '"' + ":" + $(this).find("td:eq(17)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")	)		
    otArrPRICINGNotNullCellsTotal += 1;
    notNullCouterRows+=1;
}

			otArrRowsPricing.push('{' + itArrRowsPricing.join(',') + '}'); 
				otArrPODNotNullCellsRow.push(notNullCouterRows)
				rowInArray+=1
				console.log(rowInArray)
			
}


		});
   	$('.podoverall').text(otArrRowsPricing.length)
		$('.countoverall').text(otArrPRICINGNotNullCellsTotal)
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