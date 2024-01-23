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
let otArrRowsPricing = [];

let otArrChecker = [];
let otArrChecker2 = [];
let otItemCount = 0;
let otArrPODNotNullCells = [];
let otArrPODNotNullCellsRow = [];
let otArrPODNotNullCellsTotal = 0;
let otArrPODNotNullCellsTotalWithFailed = 0;
let notNullCouterRows = 0;
let otArrPODNotNullCellsRowButFailed = [];
$('#pageTitle').text('PCTP Uploader 2 | SAP B1');	
setTimeout(function()
	{
		$('#txtPostingDate').trigger('change');
		$('#txtDeliveryDate').trigger('change');
		$('#txtDocumentDate').trigger('change');
	},1000);
//TopBar

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
	//$("#chooseFile").val('');
	//$("#chooseFile").trigger('click');
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
	 otArrRowsBilling = [];
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
			$('#btnPost').prop('disabled',true);
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

			   success:function(jsonData){

				   	$('#tblMain tbody').html('');
				  	$('#requiredErrors').text(jsonData.generalRequiredErrors);
				  	$('#invalidValue').text(jsonData.generalInvalidValueErrors);
				  	$('#invalidDate').text(jsonData.generalDateFormatError);
						$('#existingBookingNumber').text(jsonData.existingBookingNumberCount);
						$('#duplicateErrors').text(jsonData.generalDuplicateError);
						$('#podPostedInPODCount').text(jsonData.podPostedInPODCount);
						console.log(jsonData.cardCode)
						console.log(jsonData.cardName)

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
					      { data : "Destination" },
					      { data : "DeliveryStatus" },
					      { data : "DeliveryCompletionDate" },
					      { data : "NoOfDropsOnTripTicket" },
					      { data : "TripType" },
					      { data : "Remarks" },
					      { data : "DocNum" },
					      
					     ],
					     columnDefs: [
					     	// { defaultContent: "-" ,"targets": "_all"},
					     	//VALIDATOR
					     	 {"defaultContent": "-",
						    "targets": "_all"},

					     	{ className: "rowno", "targets": [0] },
					     	{ className: "error-icons", "targets": [1] },
					     	{ className: "error-message", "targets": [2] },
					     	//ALL
						    //{ className: "all", "targets": [5] },
						    //POD
						 

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

							validateRows()
							removeClassOnHeaders();
							validatePOSTSAP()
							makeArraysOfRows()
							makeArraysOfBookingNumber()
							$('#tblMain tbody').children('tr:first').addClass('d-none');

							setTimeout(function(){
									
									$('#btnPost').prop('disabled',false);
									
							
							},5000)


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
				  error: function(e){
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
   	
    	// console.log($(this).find("td:eq(1)").closest('i.required').text())
    	// console.log($(this).find("td:eq(1)").html())

 
   	});	
 	$('#tblMain tbody tr td').css('vertical-align','top');

}

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
						itArrRowsPOD.push('"' + 'U_Destination' + '"' + ":" + '"' + $(this).find("td:eq(12)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					otArrPODNotNullCellsTotal += 1;
					notNullCouterRows += 1;
				}
				if($(this).find("td:eq(13) div").hasClass('valid') ){
					itArrRowsPOD.push('"' + 'U_DeliveryStatus' + '"' + ":" + '"' + $(this).find("td:eq(13) select option:selected").attr('data-code') + '"')
					otArrPODNotNullCellsTotal += 1;
					notNullCouterRows += 1;
				}
				if( $(this).find("td:eq(2) span").text() == 'SUCCESS'){
					itArrRowsPOD.push('"' + 'U_DeliveryDateDTR' + '"' + ":" + '"' + $(this).find("td:eq(14)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')			
					otArrPODNotNullCellsTotal += 1;
					notNullCouterRows += 1;
				}
				if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
					itArrRowsPOD.push('"' + 'U_NoOfDrops' + '"' + ":" +  $(this).find("td:eq(15)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") )
					otArrPODNotNullCellsTotal += 1;
					notNullCouterRows += 1;
				}
				if($(this).find("td:eq(16) div").hasClass('valid') ){
					itArrRowsPOD.push('"' + 'U_TripType' + '"' + ":" + '"' + $(this).find("td:eq(16) select").val() + '"')
					otArrPODNotNullCellsTotal += 1;
					notNullCouterRows += 1;
				}
				if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
					itArrRowsPOD.push('"' + 'U_Remarks' + '"' + ":" + '"' + $(this).find("td:eq(17)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					otArrPODNotNullCellsTotal += 1;
					notNullCouterRows += 1;
				}
				if($(this).find("td:eq(2) span").text() == 'SUCCESS'){
					itArrRowsPOD.push('"' + 'U_DocNum' + '"' + ":" + '"' + $(this).find("td:eq(18)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					otArrPODNotNullCellsTotal += 1;
					notNullCouterRows += 1;
				}


				//NAME
				itArrRowsPOD.push('"' + 'Name' + '"' + ":" + '"' + $(this).find("td:eq(4)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
				
				otArrRowsPOD.push('{' + itArrRowsPOD.join(',') + '}'); 
		
				otArrPODNotNullCellsRow.push(notNullCouterRows)



				itArrRowsBilling.push('"' +'U_BookingDate'+ '"' + ":" + '"' + validDate($(this).find("td:eq(3)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")) + '"')
				itArrRowsBilling.push('"' +'U_BookingId'+ '"' + ":" + '"' + $(this).find("td:eq(4)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
				itArrRowsBilling.push('"' +'U_CustomerName'+ '"' + ":" + '"' + $(this).find("td:eq(5)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
				itArrRowsBilling.push('"' +'U_SAPClient'+ '"' + ":" + '"' + $(this).find("td:eq(6)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
				itArrRowsBilling.push('"' +'U_PlateNumber'+ '"' + ":" + '"' + $(this).find("td:eq(9)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
				itArrRowsBilling.push('"' + 'U_VehicleTypeCap' + '"' + ":" + '"' + $(this).find("td:eq(10) select option:selected").attr('data-code').replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
				itArrRowsBilling.push('"' +'U_DeliveryOrigin'+ '"' + ":" + '"' + $(this).find("td:eq(11)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
				itArrRowsBilling.push('"' +'U_Destination'+ '"' + ":" + '"' + $(this).find("td:eq(12)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
				itArrRowsBilling.push('"' +'U_DeliveryStatus'+ '"' + ":" + '"' + $(this).find("td:eq(13) select  option:selected").attr('data-code') + '"')
				itArrRowsBilling.push('"' +'U_DeliveryDatePOD'+ '"' + ":" + '"' + validDate($(this).find("td:eq(14)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")) + '"')
				itArrRowsBilling.push('"' + 'Name' + '"' + ":" + '"' + $(this).find("td:eq(4)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					
				otArrRowsBilling.push('{' + itArrRowsBilling.join(',') + '}'); 


				itArrRowsTP.push('"' +'U_BookingDate'+ '"' + ":" + '"' + validDate($(this).find("td:eq(3)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")) + '"')
				itArrRowsTP.push('"' +'U_BookingId'+ '"' + ":" + '"' + $(this).find("td:eq(4)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
				itArrRowsTP.push('"' +'U_ClientName'+ '"' + ":" + '"' + $(this).find("td:eq(5)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
				itArrRowsTP.push('"' +'U_TruckerName'+ '"' + ":" + '"' + $(this).find("td:eq(7)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
				itArrRowsTP.push('"' +'U_TruckerSAP'+ '"' + ":" + '"' + $(this).find("td:eq(8)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
				itArrRowsTP.push('"' +'U_DeliveryStatus'+ '"' + ":" + '"' + $(this).find("td:eq(13) select option:selected").attr('data-code') + '"')
				itArrRowsTP.push('"' +'U_DeliveryDatePOD'+ '"' + ":" + '"' + validDate($(this).find("td:eq(14)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")) + '"')
			
				itArrRowsTP.push('"' + 'Name' + '"' + ":" + '"' + $(this).find("td:eq(4)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
					
				otArrRowsTP.push('{' + itArrRowsTP.join(',') + '}'); 



				itArrRowsPricing.push('"' +'U_BookingDate'+ '"' + ":" + '"' + validDate($(this).find("td:eq(3)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")) + '"')
				itArrRowsPricing.push('"' +'U_BookingId'+ '"' + ":" + '"' + $(this).find("td:eq(4)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
				itArrRowsPricing.push('"' +'U_CustomerName'+ '"' + ":" + '"' + $(this).find("td:eq(5)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
				itArrRowsPricing.push('"' +'U_ClientTag'+ '"' + ":" + '"' + $(this).find("td:eq(6)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
				itArrRowsPricing.push('"' +'U_TruckerName'+ '"' + ":" + '"' + $(this).find("td:eq(7)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
				itArrRowsPricing.push('"' +'U_TruckerTag'+ '"' + ":" + '"' + $(this).find("td:eq(8)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
				itArrRowsPricing.push('"' + 'U_VehicleTypeCap' + '"' + ":" + '"' + $(this).find("td:eq(10) select option:selected").attr('data-code').replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
				itArrRowsPricing.push('"' +'U_DeliveryOrigin'+ '"' + ":" + '"' + $(this).find("td:eq(11)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
				itArrRowsPricing.push('"' +'U_Destination'+ '"' + ":" + '"' + $(this).find("td:eq(12)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
				itArrRowsPricing.push('"' +'U_DeliveryStatus'+ '"' + ":" + '"' + $(this).find("td:eq(13) select option:selected").attr('data-code') + '"')
				itArrRowsPricing.push('"' +'U_RemarksPOD'+ '"' + ":" + '"' + $(this).find("td:eq(17)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''") + '"')
				
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
$(document.body).on('change', 'select', function () 
{	
	
	let validError = $(this).closest('tr').find("td.error-icons span.validerror").text();
	let validErrorRemaining = parseInt(validError) - 1;

	if($(this).closest('div').find("i").hasClass('validerrorpercell') && !$(this).closest('tr').find("td.error-icons").hasClass('text-danger') && !$(this).closest('tr').find("td.error-icons").hasClass('validError')){
		$(this).closest('div').find("i").removeClass('validerrorpercell').addClass('d-none')
		$(this).closest('tr').find("td.error-icons span.validerror").text(validErrorRemaining);
		$(this).closest('div').find("option.wrongvalue").addClass('d-none')
		if(validErrorRemaining == 0){
			$(this).closest('tr').find("td.error-icons i.validerroricon").remove();
			$(this).closest('tr').find("td.error-icons span.validerror").remove();


			if($(this).closest('tr').find("td.error-icons span.duplicate").length == 0 && $(this).closest('tr').find("td.error-icons span.validerror").length == 0 && $(this).closest('tr').find("td.error-icons span.requirederror").length == 0 && $(this).closest('tr').find("td.error-icons span.dateformaterror").length == 0){
					$(this).closest('tr').find("td.error-message span").text('SUCCESS').addClass('text-success').removeClass('text-danger');
		}
	}


		console.log(validErrorRemaining)

	}

})
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
				
				
						// oldItemValue = ctrUploadedItem;
						// oldPODValue = ctrUploadedPOD;

						// if(typeof res2.ItemCode !== "undefined" ) {
						//     ctrUploadedItem += parseInt(res.ctr)	
						//     oldItemValue += parseInt(res.ctr);
						// }
						// if(typeof res3.Code !== "undefined") {
						//     ctrUploadedPOD += parseInt(res.ctr2);
						//     countPosted += parseInt(otArrPODNotNullCellsRow[i]);
						//     oldPODValue += parseInt(res.ctr2);
						// }
					
	        	
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


   	// if(otArrItem.length != 0){
   	// 	for(let i = 0; i < otArrItem.length; i++) {
   	// 		ctrPosted += 1;
		// 		ctrItem += 1;	
			
		//     console.log(otArrItem[i].length);
		  
		//     let itemData = otArrItem[i];
		 


		//     console.log(otArrItem)
	  //   	$.ajax({
	  //       type: 'POST',
	  //       url: '../proc/exec/exec_update_pctpItem.php',
	  //       startTime: performance.now(),
		// 			data:{
		// 				itemData: itemData,
						
		// 			},
		// 		  success: function (data){
		// 				// console.log(data)
		// 				let res = $.parseJSON(data)
    //     		console.log(res)
					
		// 				// console.log(res.result2)
		// 				// console.log(res.result3)
		// 				let res2 = $.parseJSON(res.result2)
					
		// 				console.log(res2.ItemCode)
						
					

		// 				oldItemValue = ctrUploadedItem;


		// 				if(typeof res2.ItemCode !== "undefined") {
		// 				    ctrUploadedItem += parseInt(res.ctr)	
		// 				    oldItemValue += parseInt(res.ctr);
		// 				}
					
					
	        	
		// 				$('.itemsuploaded').text(ctrUploadedItem)
		// 				$('.itemsoverall').text(rowsTotal)
		//     		// console.log('NEW ITEMS ADDED')
		//     		// console.log('NEW POD ADDED')
		//     		if(ctrItem == ctrUploadedItem){
		//     				$('.itemloading').addClass('d-none')
		//     		}
		    	
					
		//     		console.log(ctrItem + ':' + ctrUploadedItem + '/' + ctrPOD + ':' + ctrUploadedPOD)
		//     		// if(ctrItem == ctrUploadedItem && ctrPOD == ctrUploadedPOD){
		    		
		    		
		//     		// }else{

		//     		// }
		    		
						
	        	
	  //       },
	  //       complete: function (data) {
	  //       	console.log(data)
	  //       		setTimeout(function()
		// 					{
		// 						console.log(ctrPosted , otArrItem.length)
		// 							if(ctrPosted == otArrItem.length){
		// 										// $('#tblMain').dataTable().fnDestroy();
		// 										// $('#btnUpload3').trigger('click')
		// 										$('#postingSAP').text('Posting...').addClass('d-none')
		// 										$('.sapposting').addClass('d-none')
		// 										$('#postedSAP').text('Posted!').removeClass('d-none')
		// 										$('.countloading').addClass('d-none')
		// 										$('.itemloading').addClass('d-none')
		// 										$('.podloading').addClass('d-none')
		// 										$('#btnPost').prop('disabled',true);	
												
		// 							}

									
							
		// 					},5000)

		// 			}
    //  		});
		// 	}		
   	// }

   	// if(otArrPOD.length != 0){
   	// 	for(let i = 0; i < otArrPOD.length; i++) {
   	// 		ctrPosted += 1;
		// 		ctrPOD ++;
		//     console.log(otArrPOD[i].length);
		//     let podData = otArrPOD[i];

		//     console.log(otArrPOD)
	  //   	$.ajax({
	  //       type: 'POST',
	  //       url: '../proc/exec/exec_update_pctpPODNew.php',
	  //       startTime: performance.now(),
		// 			data:{
		// 				podData: podData
						
		// 			},
		// 		  success: function (data){
		// 				// console.log(data)
		// 				let res = $.parseJSON(data)
    //     		console.log(res)
					
		// 				let res3 = $.parseJSON(res.result3)
		// 				console.log(res2.ItemCode)
		// 				console.log(res3.Code)
		// 				console.log(res.ctr2)

		// 				oldPODValue = ctrUploadedPOD;

		// 				if(typeof res3.Code !== "undefined") {
		// 				    ctrUploadedPOD += parseInt(res.ctr2);
		// 				    countPosted += parseInt(otArrPODNotNullCells[i]);
		// 				    oldPODValue += parseInt(res.ctr2);
		// 				}
					
	        	
		    	
		// 				$('.poduploaded').text(ctrUploadedPOD)
		// 				$('.podoverall').text(rowsTotal)
		// 				$('.countuploaded').text(countPosted)
		//     		if(ctrPOD == ctrUploadedPOD){
		//     				$('.podloading').addClass('d-none')
		//     		}	
		//     		console.log(ctrItem + ':' + ctrUploadedItem + '/' + ctrPOD + ':' + ctrUploadedPOD)
		   			
	        	
	  //       },
	  //       complete: function (data) {
	  //       	console.log(data)

		// 				if(ctrItem == ctrUploadedItem && ctrPOD == ctrUploadedPOD){
		// 						$('#tblMain').dataTable().fnDestroy();
		// 						$('#btnUpload3').trigger('click')
		// 						setTimeout(function()
		// 						{
		// 							console.log(ctrPosted , otArrItem.length)
													
		// 											$('#postingSAP').text('Posting...').addClass('d-none')
		// 											$('.sapposting').addClass('d-none')
		// 											$('#postedSAP').text('Posted!').removeClass('d-none')
		// 											$('.countloading').addClass('d-none')
		// 											$('.itemloading').addClass('d-none')
		// 											$('.podloading').addClass('d-none')
		// 											$('#btnPost').prop('disabled',true);	
												
										
								
		// 						},5000)

		// 				}else{

		// 				}

	        		

		// 			}
    //  		});
		// 	}		
   	// }






   	// else{
		// 	$('#postingSAP').text('Posting...').addClass('d-none')
		// 	$('.sapposting').addClass('d-none')
		// 	$('.itemloading').addClass('d-none')
		// 	$('.podloading').addClass('d-none')
		// 	$('#postedSAP').text('No Posted!').removeClass('d-none')
		// 	$('.countloading').addClass('d-none')
		// 	return false;
   	// }
		


  
			// $('.countoverall').text(countOverAll)
			console.log(otArrItem.length)
			console.log(otArrItem)
			console.log(otArrPOD)
			console.log(otArrPOD.length)

		
    });


$(document.body).on('click', '#btnPost2', function () 
{
	
})

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
				},5000)
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
//delete row
var otArrLineNumEmp = [];
$(document.body).on('click', '.deleterowemployee', function () 
{
	let rowno = $('#tblUsers tbody tr.selected-det').find('.rowno span').text();
	let lineno = $('#tblUsers tbody tr.selected-det').find('.lineno').val();
	let itemcode = $('#tblUsers tbody tr:last').find('td.rowno span').text()
		if ($('#tblUsers tbody tr.selected-det').find('input.lineno').val() != ''){
			otArrLineNumEmp.push($('#tblUsers tbody tr.selected-det').find('input.visorder').val());
		}
	otArrLineNumEmp.join(",");
	
		$('#tblUsers tbody tr.selected-det').remove();
		
		var rowno2 = 1;
		$('#tblUsers tbody tr').each(function () 
		{
			$(this).find('td.rowno span').text(rowno2);
			rowno2 += 1;
		});
			ComputeFooterTotalBeforeDiscount();
			ComputeFooterTaxAmount();
			ComputeTotal();
});
var otArrLineNumApprover = [];
$(document.body).on('click', '.deleterowapprover', function () 
{
	let rowno = $('#tblTemplate tbody tr.selected-det').find('.rowno span').text();
	let lineno = $('#tblTemplate tbody tr.selected-det').find('.lineno').val();
	let itemcode = $('#tblTemplate tbody tr:last').find('td.rowno span').text()
		if ($('#tblTemplate tbody tr.selected-det').find('input.lineno').val() != ''){
			otArrLineNumApprover.push($('#tblTemplate tbody tr.selected-det').find('input.visorder').val());
		}
	otArrLineNumApprover.join(",");
	
		$('#tblTemplate tbody tr.selected-det').remove();
		
		var rowno2 = 1;
		$('#tblTemplate tbody tr').each(function () 
		{
			$(this).find('td.rowno span').text(rowno2);
			rowno2 += 1;
		});
			ComputeFooterTotalBeforeDiscount();
			ComputeFooterTaxAmount();
			ComputeTotal();
});
var otArrLineNumQuery = [];
$(document.body).on('click', '.deleterowquery', function () 
{
	let rowno = $('#tblQueries tbody tr.selected-det').find('.rowno span').text();
	let lineno = $('#tblQueries tbody tr.selected-det').find('.lineno').val();
	let itemcode = $('#tblQueries tbody tr:last').find('td.rowno span').text()
		if ($('#tblQueries tbody tr.selected-det').find('input.lineno').val() != ''){
			otArrLineNumQuery.push($('#tblQueries tbody tr.selected-det').find('input.visorder').val());
		}
	otArrLineNumQuery.join(",");
	
		$('#tblQueries tbody tr.selected-det').remove();
		
		var rowno2 = 1;
		$('#tblQueries tbody tr').each(function () 
		{
			$(this).find('td.rowno span').text(rowno2);
			rowno2 += 1;
		});
			ComputeFooterTotalBeforeDiscount();
			ComputeFooterTaxAmount();
			ComputeTotal();
});

let txtCurrency = 'PHP';	
var fadeDelay = 1000;
	var fadeDuration = 1000;
	

   
	
var contextMenu = CtxMenu('#content');

 contextMenu.addItem("Item 1", function(){
  // fired on click
});

 
contextMenu.addSeparator();

var serviceType = 'I';
//Validations
	$('#txtCardCode').focus();

var serviceType = 'I';
//Validations
	$('#txtCardCode').focus();

/*Load Tabs*/
	//Contents
	let status = 'All';
	$('#contents-tab').load('../templates/pctp-pod-lines.php'), function (){
		
	};
	// $('#pod-tab').load('../templates/pctp-pod-lines.php'), function (){
		
	// };
	// $('#billing-tab').load('../templates/pctp-billing-lines.php'), function (){
		
	// };
	// $('#tp-tab').load('../templates/pctp-tp-lines.php'), function (){
		
	// };
	// $('#collection-tab').load('../templates/pctp-collection-lines.php'), function (){
		
	// };
	// $('#pricing-tab').load('../templates/pctp-pricing-lines.php'), function (){
		
	// };
	// $('#treasury-tab').load('../templates/pctp-treasury-lines.php'), function (){
		
	// };

	



	
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
	function AddRowTemplate(){
		
		var rowno = 0;
			rowno = ($('#tblTemplate tbody tr:last').find('td.rowno span').text() == '') ? 1 : parseFloat($('#tblTemplate tbody tr:last').find('td.rowno span').text()) + 1;
		var lastItem = $('#tblTemplate tbody tr:last').find('input.approvalstageid').val()
		
		if(lastItem != ""){
		setTimeout(function () 
			{
					
						$('#rowLoader').load('../templates/approval-template-stage-lines-row.php', function (result) 
						{
							$('#tblTemplate tbody').append(result);

							$('#tblTemplate tbody tr:last').find('td.rowno span').text(rowno);
						})
			
							$(this).prop('disabled', false);
					
					
			}, 200)
		}
	}
	function AddRowUser(){
		
		var rowno = 0;
			rowno = ($('#tblUsers tbody tr:last').find('td.rowno span').text() == '') ? 1 : parseFloat($('#tblUsers tbody tr:last').find('td.rowno span').text()) + 1;
		var lastItem = $('#tblUsers tbody tr:last').find('input.userid').val()
		
		if(lastItem != ""){
		setTimeout(function () 
			{
					
						$('#rowLoader').load('../templates/approval-user-stage-lines-row.php', function (result) 
						{
							$('#tblUsers tbody').append(result);

							$('#tblUsers tbody tr:last').find('td.rowno span').text(rowno);
						})
			
							$(this).prop('disabled', false);
					
					
			}, 200)
		}
	}
	function AddRowQuery(){
		
		var rowno = 0;
			rowno = ($('#tblQueries tbody tr:last').find('td.rowno span').text() == '') ? 1 : parseFloat($('#tblQueries tbody tr:last').find('td.rowno span').text()) + 1;
		var lastItem = $('#tblQueries tbody tr:last').find('input.intrnalkey').val()
		
		if(lastItem != ""){
		setTimeout(function () 
			{
					
						$('#rowLoader').load('../templates/approval-queries-lines-row.php', function (result) 
						{
							$('#tblQueries tbody').append(result);

							$('#tblQueries tbody tr:last').find('td.rowno span').text(rowno);
						})
			
							$(this).prop('disabled', false);
					
					
			}, 200)
		}
	}

	
	function PreviewDoc(code){
		
		
		$.getJSON('../proc/views/vw_getheaderdata.php?code=' + code, function (data){
			
				$('.subModule').each(function (i) 
				{
					$(this).find('.checked-sub').addClass('d-none');
					$(this).css('background-color','white');
				});
			
            $.each(data, function (key, val){
            		console.log(val.Code)
				setTimeout(function()	{
					
					$('#myModalLabelApproval').text('Approval Properties');
					$('#txtCode').val(val.Code).attr('readonly', 'readonly');
					$('#txtDescription').val(val.Description).attr('readonly', 'readonly');
					if(val.Active == 'Y'){
						$('#chkActive').attr('checked', 'checked')
					}
					$('#btnAdd').addClass('d-none');
					$('#btnUpdate').removeClass('d-none');
					var Modules = val.Modules.split(', ');
					
				 	
					var Module = val.Modules.split(', ');
				
							var fLen, i;
							fLen = Module.length;
							for (i = 0; i < fLen; i++) 
							{
								$('#'+Module[i]+'').find('.checked-sub').removeClass('d-none');
								$('#'+Module[i]+'').css('background-color','#ADD8E6');
							}

				},100)
				
				setTimeout(function () 
				{
					
						
						PreviewRowsUsers(code,function () 
						{
							
						});
						PreviewRowsTemplate(code,function () 
						{
							
						});
					
					
					
					
	            }, 500) 
				
				
			});
		});
	
			
	}
	function PreviewRowsUsers(code,callback){
        $('#users-tab').load('../proc/views/vw_getdetailsdatausers.php?code=' + code, function (result) 
		{
            callback();
		});
    }
	function PreviewRowsTemplate(code,callback){
        $('#approval-template-tab').load('../proc/views/vw_getdetailsdatatemplate.php?code=' + code, function (result) 
		{
            callback();
		});
	}
	function PreviewUDF(docNum){
		let udfJsonNames = '';
		$.getJSON('../proc/views/udf/vw_listUDFDescr.php?mainTable=' + mainTable, function (data){
			var udfArr = [];
			$.each(data, function (key, val){
					udfArr.push(val.Descr);
					udfArr.join(','); 
			});		
			udfJsonNames = JSON.stringify(udfArr);
		});
		$.getJSON('../proc/views/udf/vw_listUDF.php?mainTable=' + mainTable, function (data){
			
			var udfArr = [];
			$.each(data, function (key, val){
					udfArr.push(val.Column_Name);
					udfArr.join(','); 
			});		
			let udfJson = JSON.stringify(udfArr);
			let udfJson2 = udfJson.replace(/(\r\n|\n|\r)/gm, '[newline]');
			
			$('#udfvalueloader').load('../proc/views/udf/vw_getUDF.php?udfJson=' + udfJson + '&docNum=' + docNum + '&mainTable=' + mainTable,function (){
			
				let udfValues = $('#udfvalueloader').text();
				let udfValues2 = udfValues.replace(/['"]+/g, '');
				let udfValues3 = udfValues2.replace('[','');
				let udfValues4 = udfValues3.replace(']','');
				let udfValues5 = udfValues4.split(',');
				
				$('.inputUdf').each(function (i) 
				{
					
					
					if($(this).attr('type') == 'date'){
						//(udfValues5[i] != 'null') ? $(this).val(date) :'';
						let id2 = $(this).attr('id2');
						let that = $(this);
					
						$.ajax({
							type: 'GET',
							url: '../proc/views/udf/vw_getUDFDate.php?mainTable=' + mainTable,
							data: {
									id2 : id2,
									docNum : docNum
									},
							success: function (html) 
							{
							
								that.val(html);
							}
						}); 
					}
					else if($(this).hasClass('amount')){
						if(udfValues5[i] == '.000000' ){
							$(this).val('0.00');
						}
						else if(udfValues5[i] != 'null' ){
							$(this).val(udfValues5[i]);
						}
						
					}
					
					else{
						if(udfValues5[i] != 'null' ){
							$(this).val(udfValues5[i]);
						}
						
					}
					
					if($(this).attr('table') != ''){
						let value = $(this).val();
						let table = $(this).attr('table');
						
						let that = $(this);
						$.ajax({
							type: 'GET',
							url: '../proc/views/udf/vw_getUDFNameWithTable.php',
							data: {
									value : value,
									table : table
									
									},
							success: function (html) 
							{
								that.val(html);
							}
						}); 
					}
					
					$('.inputUdf').each(function (i) 
					{
						if($(this).val() == 'null'){
							$(this).val('');
						}
					});
					
				});
			}); 
		
		});
	}
	

	
	function CheckItemCode(){
		if($('.selected-det').find('input.itemcode').val() == '')
		{
			$('.selected-det').find('input.price').val('');
			$('.selected-det').find('input.quantity').val('');
			$('.selected-det').find('input.discount').val('');
			$('.selected-det').find('input.itemcode').focus();
			$('#messageBar').val('Enter Item!').css({'background-color': 'red', 'color': 'white'});
				setTimeout(function()	{
					$('#messageBar').val('').css({'background-color': '', 'color': ''});	
				},5000)
		}
	}
	
	function CheckCardCode(value){
		if($('#txtCardCode').val() != ''){
			value = '';
		}
		return value;
	}
	
	function CheckItemCode(){
		if($('.selected-det').find('input.itemcode').val() == '')
		{
			$('.selected-det').find('input.price').val('');
			$('.selected-det').find('input.quantity').val('');
			$('.selected-det').find('input.discount').val('');
			$('.selected-det').find('input.itemcode').focus();
			$('#messageBar').val('Enter Item!').css({'background-color': 'red', 'color': 'white'});
				setTimeout(function()	{
					$('#messageBar').val('').css({'background-color': '', 'color': ''});	
				},5000)
		}
	}

	function GenSetCheckBoxChecked(){
		//All are unchecked
		if($('.gensub > .checked-sub').length == $('.gensub > .checked-sub.d-none').length && $('.gensub > .checked-sub.d-none').length > 0) {
				$('#GenSet > .checked').addClass('d-none');
				$('#GenSet > .indetermine').addClass('d-none');
				$('#GenSet').css('background-color','white');
		}
		//All are checked
		else if($('.gensub > .checked-sub').length != $('.gensub > .checked-sub.d-none').length && $('.gensub > .checked-sub.d-none').length == 0) {
				$('#GenSet > .checked').removeClass('d-none');
				$('#GenSet > .indetermine').addClass('d-none');
				$('#GenSet').css('background-color','#ADD8E6');
		}
		//Not all are checked
		else if($('.gensub > .checked-sub').length != $('.gensub > .checked-sub.d-none').length){
				$('#GenSet > .checked').addClass('d-none');
				$('#GenSet > .indetermine').removeClass('d-none');
				$('#GenSet').css('background-color','#ADD8E6');
		}
		
	}
	function FinCheckBoxChecked(){
		//All are unchecked
		if($('.finsub > .checked-sub').length == $('.finsub > .checked-sub.d-none').length && $('.finsub > .checked-sub.d-none').length > 0) {
				$('#Fin > .checked').addClass('d-none');
				$('#Fin > .indetermine').addClass('d-none');
				$('#Fin').css('background-color','white');
		}
		//All are checked
		else if($('.finsub > .checked-sub').length != $('.finsub > .checked-sub.d-none').length && $('.finsub > .checked-sub.d-none').length == 0) {
				$('#Fin > .checked').removeClass('d-none');
				$('#Fin > .indetermine').addClass('d-none');
				$('#Fin').css('background-color','#ADD8E6');
		}
		//Not all are checked
		else if($('.finsub > .checked-sub').length != $('.finsub > .checked-sub.d-none').length){
				$('#Fin > .checked').addClass('d-none');
				$('#Fin > .indetermine').removeClass('d-none');
				$('#Fin').css('background-color','#ADD8E6');
		}
		
	}
	function InvCheckBoxChecked(){
		//All are unchecked
		if($('.invsub > .checked-sub').length == $('.invsub > .checked-sub.d-none').length && $('.invsub > .checked-sub.d-none').length > 0) {
				$('#Inv > .checked').addClass('d-none');
				$('#Inv > .indetermine').addClass('d-none');
				$('#Inv').css('background-color','white');
		}
		//All are checked
		else if($('.invsub > .checked-sub').length != $('.invsub > .checked-sub.d-none').length && $('.invsub > .checked-sub.d-none').length == 0) {
				$('#Inv > .checked').removeClass('d-none');
				$('#Inv > .indetermine').addClass('d-none');
				$('#Inv').css('background-color','#ADD8E6');
		}
		//Not all are checked
		else if($('.invsub > .checked-sub').length != $('.invsub > .checked-sub.d-none').length){
				$('#Inv > .checked').addClass('d-none');
				$('#Inv > .indetermine').removeClass('d-none');
				$('#Inv').css('background-color','#ADD8E6');
		}
		
	}
	function SalesCheckBoxChecked(){
		//All are unchecked
		if($('.salessub > .checked-sub').length == $('.salessub > .checked-sub.d-none').length && $('.salessub > .checked-sub.d-none').length > 0) {
				$('#Sales > .checked').addClass('d-none');
				$('#Sales > .indetermine').addClass('d-none');
				$('#Sales').css('background-color','white');
		}
		//All are checked
		else if($('.salessub > .checked-sub').length != $('.salessub > .checked-sub.d-none').length && $('.salessub > .checked-sub.d-none').length == 0) {
				$('#Sales > .checked').removeClass('d-none');
				$('#Sales > .indetermine').addClass('d-none');
				$('#Sales').css('background-color','#ADD8E6');
		}
		//Not all are checked
		else if($('.salessub > .checked-sub').length != $('.salessub > .checked-sub.d-none').length){
				$('#Sales > .checked').addClass('d-none');
				$('#Sales > .indetermine').removeClass('d-none');
				$('#Sales').css('background-color','#ADD8E6');
		}
		
	}
	function PurchCheckBoxChecked(){
		//All are unchecked
		if($('.purchsub > .checked-sub').length == $('.purchsub > .checked-sub.d-none').length && $('.purchsub > .checked-sub.d-none').length > 0) {
				$('#Purch > .checked').addClass('d-none');
				$('#Purch > .indetermine').addClass('d-none');
				$('#Purch').css('background-color','white');
		}
		//All are checked
		else if($('.purchsub > .checked-sub').length != $('.purchsub > .checked-sub.d-none').length && $('.purchsub > .checked-sub.d-none').length == 0) {
				$('#Purch > .checked').removeClass('d-none');
				$('#Purch > .indetermine').addClass('d-none');
				$('#Purch').css('background-color','#ADD8E6');
		}
		//Not all are checked
		else if($('.purchsub > .checked-sub').length != $('.purchsub > .checked-sub.d-none').length){
				$('#Purch > .checked').addClass('d-none');
				$('#Purch > .indetermine').removeClass('d-none');
				$('#Purch').css('background-color','#ADD8E6');
		}
		
	}
	function BankCheckBoxChecked(){
		//All are unchecked
		if($('.banksub > .checked-sub').length == $('.banksub > .checked-sub.d-none').length && $('.banksub > .checked-sub.d-none').length > 0) {
				$('#Bank > .checked').addClass('d-none');
				$('#Bank > .indetermine').addClass('d-none');
				$('#Bank').css('background-color','white');
		}
		//All are checked
		else if($('.banksub > .checked-sub').length != $('.banksub > .checked-sub.d-none').length && $('.banksub > .checked-sub.d-none').length == 0) {
				$('#Bank > .checked').removeClass('d-none');
				$('#Bank > .indetermine').addClass('d-none');
				$('#Bank').css('background-color','#ADD8E6');
		}
		//Not all are checked
		else if($('.banksub > .checked-sub').length != $('.banksub > .checked-sub.d-none').length){
				$('#Bank > .checked').addClass('d-none');
				$('#Bank > .indetermine').removeClass('d-none');
				$('#Bank').css('background-color','#ADD8E6');
		}
		
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