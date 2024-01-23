$(document).ready(function () {

const objTables = JSON.parse(sessionStorage.objectTablesArr);

const mainFileName = sessionStorage.mainFileName;
const objectTable = sessionStorage.objectTable;
const objectTableName = sessionStorage.objectTableName;
const objectType = parseInt(sessionStorage.objectType);
const childTable1 = sessionStorage.childTable1;
const childTable12 = sessionStorage.childTable12;
const childTable21 = sessionStorage.childTable21;
const SAPDateFormat = sessionStorage.SAPDateFormat;
const copyFromArr = JSON.parse(sessionStorage.copyFromArr);

let baseTableName;
let baseTable;
let baseType = -1;
let copyFromModal;
let copyFromModalTbl;

$(document.body).on('click', 'ul.copyFromList li', function(){
	copyFromArr.map(item => {
		if ($(this).find('button').text() == item.baseTableName){
			baseTableName = item.baseTableName;
			baseTable = item.baseTable;
			baseType = item.baseType;
			copyFromModal = item.copyFromModal;
			copyFromModalTbl = item.copyFromModalTbl;
			return false;
		}
	});

	let cardCode = $('#txtCardCode').val();
	let table = baseTable;
	
	if(cardCode == '')
	{
		
		$('#tbl'+copyFromModalTbl+' tbody').html('');
	}
	else
	{	
		$.ajax({
			type: 'POST',
			url: '../proc/views/vw_copyFrom.php',
			data: {
				cardCode : cardCode,
				table: table, 
				copyFromModalTbl: copyFromModalTbl
			},
			success: function (html) 
			{
				$('#'+copyFromModal+'Result').html(html);
			}
		});
	}
})



let refDocToArr = [];
let origRefDocToArr = [];

$('#pageTitle').text(`${objectTableName} | SAP B1`);
	let uniqueSerial = '';
		$.ajax({
			type: 'GET',
			url: '../proc/views/vw_unique-serial.php',
			success: function (data) 
			{
				uniqueSerial = data;
			}
		}); 
	setTimeout(function()
	{
		$('#txtPostingDate').trigger('change');
		$('#txtDeliveryDate').trigger('change');
		$('#txtDocumentDate').trigger('change');
	},1000);
// $(document.body).on('click', '#btnPrint', function () 
// 	{
// 		var docentry = $('#txtDocNum').val();
		
// 		if(docentry != '')
// 		{
// 			window.open("../forms/SOA-Red-Ribbon.php?docentry=" + docentry,"", "width=1130,height=550,left=220,top=110");
// 		}
// 	});
// $(document.body).on('click', '#btnPrint', function () 
// 	{
// 		alert(1)
// 		let layout = $('#layoutOptions').val();
// 		var docentry = $('#txtDocEntry').val();
		
// 		if(docentry != '')
//         {
//             window.open("../forms/form.php?layout=" + layout + "&docentry=" + encodeURI(docentry),"", "width=1130,height=550,left=220,top=110");
//         }


// 		// if(docentry != '')
// 		// { 
// 		// 	if(layout =='APInvoice'){
// 		// 		window.open("../forms/APInvoice.php?docentry=" + encodeURI(docentry),"", "width=1130,height=550,left=220,top=110");
// 		// 	}
// 		// 	else if(layout =='PaymentVoucherAPV'){
// 		// 		window.open("../forms/PaymentVoucherAPV.php?docentry=" + encodeURI(docentry),"", "width=1130,height=550,left=220,top=110");
// 		// 	}
// 		// 	else if(layout =='PaymentVoucherTransfer'){
// 		// 		window.open("../forms/PaymentVoucherTransfer.php?docentry=" + encodeURI(docentry),"", "width=1130,height=550,left=220,top=110");
// 		// 	}
// 		// 	else if(layout =='EWT2307'){
// 		// 		window.open("../forms/ewt2307.php?docentry=" + encodeURI(docentry),"", "width=1130,height=550,left=220,top=110");
// 		// 	}
			
// 		// }
	//});
	 $(document.body).on('click', '#btnPrint', function () {

        let layout = $('#layoutOptions').val();
        var docentry = $('#txtDocNum').val();
        console.log(layout + ":" + docentry)
        if(docentry != '')
        {
            window.open("../forms/form.php?layout=" + layout + "&docentry=" + encodeURI(docentry),"", "width=1130,height=550,left=220,top=110");
        }
    });
$(document.body).on('click', '#btnFirstRecord', function (){
	let table = objecTable;
	let docNum = '';t
	let objType = objectType;
	$.getJSON('../proc/views/vw_getFirstEntry.php?table=' + table, function (data){
		docNum = data;
		PreviewDoc(docNum,objType);
	});
});
$(document.body).on('click', '#btnPrevRecord', function (){
	let table = objectTable;
	let objType = objectType;
	let docNum = $('#txtDocNum').val();
	if(docNum != ''){
		$.getJSON('../proc/views/vw_getPrevEntry.php?table=' + table + '&docNum=' + docNum, function (data){
			docNum = data;
			PreviewDoc(docNum,objType);
		});
	}
	else{
			$.getJSON('../proc/views/vw_getLastEntry.php?table=' + table, function (data){
			docNum = data;
			PreviewDoc(docNum,objType);
		});
	}
});
$(document.body).on('click', '#btnNextRecord', function (){
	let table = objectTable;
	let objType = objectType;
	let docNum = $('#txtDocNum').val();
	if(docNum != ''){
		$.getJSON('../proc/views/vw_getNextEntry.php?table=' + table + '&docNum=' + docNum, function (data){
			docNum = data;
			PreviewDoc(docNum,objType);
		});
	}
	else{
			$.getJSON('../proc/views/vw_getFirstEntry.php?table=' + table, function (data){
			docNum = data;
			PreviewDoc(docNum,objType);
		});
	}
});
$(document.body).on('click', '#btnLastRecord', function (){
	let table = objectTable;
	let docNum = '';
	let objType = objectType;
	$.getJSON('../proc/views/vw_getLastEntry.php?table=' + table, function (data){
		docNum = data;
		PreviewDoc(docNum,objType);
	});
});
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
$(document.body).on('click', '#btnUDF', function () 
{
	if($('#containerUDF').hasClass('d-none') == false){
		$('#containerSystem').removeClass('col-lg-9');
		$('#containerUDF').removeClass('col-lg-3');
		$('#containerSystem').addClass('col-lg-12');
		$('#containerUDF').addClass('d-none');
		
		$('#bpCol').removeClass('col-lg-4');
		$('#midCol').removeClass('col-lg-4');
		$('#dateCol').removeClass('col-lg-4');
		
		$('#bpCol').addClass('col-lg-5');
		$('#midCol').addClass('col-lg-4');
		$('#dateCol').addClass('col-lg-3');
		
	}
	else{
		$('#containerSystem').removeClass('col-lg-12');
		$('#containerSystem').addClass('col-lg-9');
		$('#containerUDF').addClass('col-lg-3');
		$('#containerUDF').removeClass('d-none');
		
		$('#bpCol').removeClass('col-lg-5');
		$('#midCol').removeClass('col-lg-4');
		$('#dateCol').removeClass('col-lg-3');
		
		$('#bpCol').addClass('col-lg-5');
		$('#midCol').addClass('col-lg-3');
		$('#dateCol').addClass('col-lg-4');
		
	}
});
$(document.body).on('click','#btnNew',function()
{
	window.location.reload();
})
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
//delete row
var otArrLineNum = [];
$(document.body).on('click', '.deleterow', function () 
{
	let rowno = $('.selected-det').find('.rowno span').text();
	let lineno = $('.selected-det').find('.lineno').val();
	let itemcode = $('#tblDetails tbody tr:last').find('td.rowno span').text()
		if ($('.selected-det').find('input.lineno').val() != ''){
			otArrLineNum.push($('.selected-det').find('input.visorder').val());
		}
	otArrLineNum.join(",");
	
		$('.selected-det').remove();
		
		var rowno2 = 1;
		$('#tblDetails tbody tr').each(function () 
		{
			$(this).find('td.rowno span').text(rowno2);
			rowno2 += 1;
		});
			ComputeFooterTotalBeforeDiscount();
			ComputeFooterTaxAmount();
			ComputeTotal();
});
var otArrLineNum = [];
$(document.body).on('click', '.deleterowwtax', function () 
{
	let rowno = $('.selected-det-wtax').find('.rowno span').text();
	let lineno = $('.selected-det-wtax').find('.lineno').val();
	let itemcode = $('#tblWTaxTable tbody tr:last').find('td.rowno span').text()
		if ($('.selected-det-wtax').find('input.lineno').val() != ''){
			otArrLineNum.push($('.selected-det-wtax').find('input.visorder').val());
		}
	otArrLineNum.join(",");
	
		$('.selected-det-wtax').remove();
		
		var rowno2 = 1;
		$('#tblWTaxTable tbody tr').each(function () 
		{
			$(this).find('td.rowno span').text(rowno2);
			rowno2 += 1;
		});
			
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
	$('#contents-tab').load('../templates/' + mainFileName + '-lines.php?serviceType=' + serviceType), function (){
		
	};
	//Logistics
	$('#logistics-tab').load('../templates/' + mainFileName + '-logistics.php'), function(){
		
	};
	//Accounting
	$('#accounting-tab').load('../templates/' + mainFileName + '-accounting.php'), function(){
		
	};
	//WTAX Table
	$('#wTaxTableResult').load('../templates/wtaxtable-lines.php'), function (){
	};
	
//Matrix Cell Effects
	
	$(document.body).on('focus', 'input, select, textarea', function (){
		
		$(this).css({'outline': 'none', 'background-color': '#fdfd96'});
		//$(this).closest('td').css('background-color', '#fdfd96');
		$(this).closest('span').show();
	
		
	});
	$(document.body).on('blur', 'input, select, textarea', function (){
		$(this).css({'outline': 'none', 'background-color': ''});
		//$(this).closest('td').css('background-color', '');
		$(this).closest('span').hide();
		
	});
	$(document.body).on('click', 'button', function (){
		
		$(this).removeClass('d-none');
		$(this).siblings('input').focus();
	});
	
//Selecting Row
	$(document.body).on('click', '#tblDetails tbody > tr > td.rowno', function () 
	{
        if (window.event.ctrlKey) 
		{
			if ($(this).closest('tr').hasClass('selected-det')) 
			{
                $(this).closest('tr').css("background-color", "transparent");
                $(this).closest('tr').removeClass('selected-det');
            }
			else 
			{
                $(this).closest('tr').css("background-color", "lightgray");
                $(this).closest('tr').addClass('selected-det');
            }
        }
		else 
		{
            $('.selected-det').map(function () 
			{
				$(this).closest('tr').css("background-color", "transparent");
                $(this).removeClass('selected-det');
            })

            $('#tblDetails tbody > tr').css("background-color", "transparent");
			$(this).closest('tr').css("background-color", "lightgray");
            $(this).closest('tr').addClass('selected-det');
        }
		
    });
	$(document.body).on('click', '#tblDetails > tbody tr > td > div.input-group', function () 
	{
		$('input').css('background-color', '');
        $('.selected-det').map(function () 
		{
            $(this).removeClass('selected-det');
            $(this).css("background-color", "transparent");
        })
		
        $(this).closest('tr').css("background-color", "lightgray");
        $(this).closest('tr').addClass('selected-det');
		
		$(this).children('input').css('background-color', '#fdfd96');
		
    });
	$(document.body).on('focus', '#tblDetails input, #tblDetails select, #tblDetails textarea', function () 
	{
        if (window.event.ctrlKey) 
		{
            $(this).closest('tr').css("background-color", "lightgray");
            $(this).closest('tr').addClass('selected-det');
        }
		else
		{
            $('.selected-det').map(function () 
			{
                $(this).removeClass('selected-det');
            })

            $('#tblDetails tbody > tr').css("background-color", "transparent");
            $(this).closest('tr').css("background-color", "lightgray");
            $(this).closest('tr').addClass('selected-det');
        }
		
    });
	//WTAX
	//Selecting Row
	$(document.body).on('click', '#tblWTaxTable tbody > tr > td.rowno', function () 
	{
        if (window.event.ctrlKey) 
		{
			if ($(this).closest('tr').hasClass('selected-det-wtax')) 
			{
                $(this).closest('tr').css("background-color", "transparent");
                $(this).closest('tr').removeClass('selected-det-wtax');
            }
			else 
			{
                $(this).closest('tr').css("background-color", "lightgray");
                $(this).closest('tr').addClass('selected-det-wtax');
            }
        }
		else 
		{
            $('.selected-det-wtax').map(function () 
			{
				$(this).closest('tr').css("background-color", "transparent");
                $(this).removeClass('selected-det-wtax');
            })

            $('#tblWTaxTable tbody > tr').css("background-color", "transparent");
			$(this).closest('tr').css("background-color", "lightgray");
            $(this).closest('tr').addClass('selected-det-wtax');
        }
		
    });
	$(document.body).on('click', '#tblWTaxTable > tbody tr > td > div.input-group', function () 
	{
		$('input').css('background-color', '');
        $('.selected-det-wtax').map(function () 
		{
            $(this).removeClass('selected-det-wtax');
            $(this).css("background-color", "transparent");
        })
		
        $(this).closest('tr').css("background-color", "lightgray");
        $(this).closest('tr').addClass('selected-det-wtax');
		
		$(this).children('input').css('background-color', '#fdfd96');
		
    });
	$(document.body).on('focus', '#tblWTaxTable input, #tblWTaxTable select, #tblWTaxTable textarea', function () 
	{
        if (window.event.ctrlKey) 
		{
            $(this).closest('tr').css("background-color", "lightgray");
            $(this).closest('tr').addClass('selected-det-wtax');
        }
		else
		{
            $('.selected-det-wtax').map(function () 
			{
                $(this).removeClass('selected-det-wtax');
            })

            $('#tblWTaxTable tbody > tr').css("background-color", "transparent");
            $(this).closest('tr').css("background-color", "lightgray");
            $(this).closest('tr').addClass('selected-det-wtax');
        }
		
    });
	//Batch
	$(document.body).on('click', '#tblBatch tbody > tr > td', function () 
	{
		
        if (window.event.ctrlKey) 
		{
			if ($(this).closest('tr').hasClass('selected-item')) 
			{
                $(this).closest('tr').css("background-color", "white");
                $(this).closest('tr').removeClass('selected-item');
            }
			else 
			{
                $(this).closest('tr').css("background-color", "lightgray");
                $(this).closest('tr').addClass('selected-item');
            }
        }
		else 
		{
            $('.selected-item').map(function () 
			{
				$(this).closest('tr').css("background-color", "white");
                $(this).removeClass('selected-item');
            })

            $('#tblBatch tbody > tr').css("background-color", "white");
			$(this).closest('tr').css("background-color", "lightgray");
            $(this).closest('tr').addClass('selected-item');
        }
		
    });
//Serial	
	$(document.body).on('click', '#tblSerial tbody > tr > td', function () 
	{
		
        if (window.event.ctrlKey) 
		{
			if ($(this).closest('tr').hasClass('selected-item')) 
			{
                $(this).closest('tr').css("background-color", "white");
                $(this).closest('tr').removeClass('selected-item');
            }
			else 
			{
                $(this).closest('tr').css("background-color", "lightgray");
                $(this).closest('tr').addClass('selected-item');
            }
        }
		else 
		{
            $('.selected-item').map(function () 
			{
				$(this).closest('tr').css("background-color", "white");
                $(this).removeClass('selected-item');
            })

            $('#tblSerial tbody > tr').css("background-color", "white");
			$(this).closest('tr').css("background-color", "lightgray");
            $(this).closest('tr').addClass('selected-item');
        }
		
    });
	
	
//Double Clicks
	$(document.body).on('dblclick', '#tblDoc tbody > tr', function () 
	{
		
		var docNum = $(this).children('td.item-1').text();
		var objType = objectType;
        $('#documentModal').modal('hide');
		
		$('#txtDocNum').val(docNum);
		
		$('#btnAdd').addClass('d-none');
		$('#btnUpdate').removeClass('d-none');
		
		PreviewDoc(docNum, objType);
       
    });

	$(document.body).on('dblclick', '.copyFromTable tbody > tr', function () 
	{
		
		var docNum = $(this).children('td.item-1').text();
		var objType = baseType;
		
        $('#'+copyFromModal+'Modal').modal('hide');
		
		$('#txtBaseEntry').val(docNum);
		
		$('#btnAdd').removeClass('d-none');
		$('#btnUpdate').addClass('d-none');
		
		PreviewDoc(docNum, objType);
       
    });

	$(document.body).on('dblclick', '#tblBP tbody > tr', function () 
	{
		
		let cardCode = $(this).children('td.item-1').text();
        let cardName = $(this).children('td.item-2').text();
		let contactPerson = $(this).children('td.item-4').text();
		let paymentTermsCode = $(this).children('td.item-5').text();
		let paymentTermsName = $(this).children('td.item-6').text();
		let tinNumber = $(this).children('td.item-7').text();
		let contactPersonCode = $(this).children('td.item-8').text();
		txtCurrency = $(this).children('td.item-9').text();
		let addressID = '';
		let controlAccount = $(this).children('td.item-10').text();
		let controlAccountName = $(this).children('td.item-11').text();
		let wtaxliable = $(this).children('td.item-12').text();
		console.log(wtaxliable)
     

        $('#bpModal').modal('hide');
	
		$('#txtCardCode').val(cardCode).css({'background-color': '', 'border-radius': '0px'});
		$('#txtCardName').val(cardName).css('background-color', '');
		$('#txtContactPerson').val(contactPerson).css({'background-color': '', 'border-radius': '0px'});
		$('#txtContactPersonCode').val(contactPersonCode);
		$('#txtJournalMemo').val(`${objectTableName} - ` + cardCode);
		$('#txtPaymentTermsCode').val(paymentTermsCode);
		$('#txtPaymentTermsName').val(paymentTermsName);
		$('#txtTinNumber').val(tinNumber);
		$('#selCurrency').val('BP');
		$('#txtCurrency').val(txtCurrency);
		$('#txtControlAccountCode').val(controlAccount);
		$('#txtControlAccountName').val(controlAccount + ' - ' + controlAccountName);
		$('#txtControlAccountCodeDefault').val(controlAccount);
		$('#txtControlAccountNameDefault').val(controlAccount + ' - ' + controlAccountName);
		$('#txtWTliableBP').val(wtaxliable)

		$('#lnkCardCode').removeClass('d-none');
		$('#lnkContactPerson').removeClass('d-none');
		$('#contactPersonBtn').removeClass('d-none');
		
		$('#btnShipToDetails').removeClass('d-none');
		$('#btnBillToDetails').removeClass('d-none');
		
		$('#btnCopyFrom').prop('disabled',false);
		
		//Addresses
			$.ajax({
				type: 'GET',
				url: '../proc/views/vw_shipToAddressID.php',
				data: {cardCode : cardCode},
				success: function (html) 
				{
					$('#selShipToAddress').html(html);
				}
			}); 
			$.ajax({
				type: 'GET',
				url: '../proc/views/vw_billToAddressID.php',
				data: {cardCode : cardCode},
				success: function (html) 
				{
					$('#selBillToAddress').html(html);
				}
			});
			
			printCompanyAddress('#txtShipToAddressTextArea');

			$.ajax({
				type: 'POST',
				url: '../proc/views/vw_getShipToAddressComponents.php',
				data: {childTable12 : childTable12},
				success: function (data) 
				{
					let dataObj = JSON.parse(data);

					$('#txtStreetPOBoxS').val(dataObj.StreetS);
					$('#txtStreetNoS').val(dataObj.StreetNoS);
					$('#txtBlockS').val(dataObj.BlockS);
					$('#txtCityS').val(dataObj.CityS);
					$('#txtZipCodeS').val(dataObj.ZipCodeS);
					$('#txtCountyS').val(dataObj.CountyS);
					$('#txtCountrySName').val(dataObj.CountryName);
					$('#txtCountryS').val(dataObj.CountryCode);
					$('#txtBuildingS').val(dataObj.BuildingS);
					setStateList(dataObj.CountryCode);
					$('#txtStateSName').val(dataObj.StateName);
					$('#txtStateS').val(dataObj.StateCode);
					$('#txtAddress2S').val(dataObj.Address2S);
					$('#txtAddress3S').val(dataObj.Address3S);
					$('#txtGLNS').val(dataObj.GlbLocNumS);

					$('#txtShipArr').val(data);

				}
			});
			
			// $.getJSON('../proc/views/vw_shipToAddressDetails.php?cardCode=' + cardCode + '&address=' + addressID, function (data){
			// 	let shipArr = [];	
			// 	let shipArr2 = [];	
			// 	let shipList;
			// 	let shipList2;
				
			// 	$.each(data, function (key, val){
			// 		$('#selShipToAddress').val(val.Address);
			// 		$('#txtShipToAddressTextArea').val(val.Street + '\n' + '\n'  + val.ZipCode + ' ' + val.City + '\n'  + val.Country );
					
			// 				val.Street != '' ? shipArr.push('Street'): '';
			// 				val.StreetNo != '' ? shipArr.push('StreetNo'): '';
			// 				val.Block != '' ? shipArr.push('Block'): '';
			// 				val.ZipCode != '' ? shipArr.push('ZipCode'): '';
			// 				val.City != '' ? shipArr.push('City'): '';
			// 				val.County != '' ? shipArr.push('County'): '';
			// 				val.State != '' ? shipArr.push('State'): '';
			// 				val.Country != '' ? shipArr.push('Country'): '';
			// 				val.Building != '' ? shipArr.push('Building'): '';
							
			// 				val.CountryCode != '' ? shipArr.push('CountryCode'): '';
							
							
			// 				shipArr2.push(val.Street);
			// 				shipArr2.push(val.StreetNo);
			// 				shipArr2.push(val.Block);
			// 				shipArr2.push(val.ZipCode);
			// 				shipArr2.push(val.City);
			// 				shipArr2.push(val.County);
			// 				shipArr2.push(val.State);
			// 				shipArr2.push(val.Country);
			// 				shipArr2.push(val.Building);
							
			// 				shipArr2.push(val.CountryCode);
							
		
			// setTimeout(function () {
			// 	shipList = shipArr;
			// 	shipList2 = shipArr2;

			// 	$('#txtShipArr').val(shipList);			
			// 	$('#txtShipArr2').val(shipList2);			
			
			// 	}, 100) 
					
			// 	});
			// });

			$.getJSON('../proc/views/vw_billToAddressDetails.php?cardCode=' + cardCode + '&address=' + addressID, function (data){
				let billArr = [];	
				let billArr2 = [];	
				let billList;
				let billList2;
				$.each(data, function (key, val){
					$('#selBillToAddress').val(val.Address);
					$('#txtBillToAddressTextArea').val(val.Street + '\n' + '\n'  + val.ZipCode + ' ' + val.City + '\n'  + val.Country );
							val.Street != '' ? billArr.push('Street'): '';
							val.StreetNo != '' ? billArr.push('StreetNo'): '';
							val.Block != '' ? billArr.push('Block'): '';
							val.ZipCode != '' ? billArr.push('ZipCode'): '';
							val.City != '' ? billArr.push('City'): '';
							val.County != '' ? billArr.push('County'): '';
							val.State != '' ? billArr.push('State'): '';
							val.Country != '' ? billArr.push('Country'): '';
							val.Building != '' ? billArr.push('Building'): '';
							
							val.CountryCode != '' ? billArr.push('CountryCode'): '';
							
							
							billArr2.push(val.Street);
							billArr2.push(val.StreetNo);
							billArr2.push(val.Block);
							billArr2.push(val.ZipCode);
							billArr2.push(val.City);
							billArr2.push(val.County);
							billArr2.push(val.State);
							billArr2.push(val.Country);
							billArr2.push(val.Building);
							
							billArr2.push(val.CountryCode);
							
							setTimeout(function () {
							billList = billArr;
							billList2 = billArr2;
							$('#txtBillArr').val(billList);			
							$('#txtBillArr2').val(billList2);			
						
							}, 100) 
				
				});
			});	
			$.ajax({
				type: 'GET',
				url: '../proc/views/vw_shippingType.php',
				data: {cardCode : cardCode},
				success: function (html) 
				{	
					
					$('#selShippingType').html(html);
				}
			}); 

			$('#btnRefDoc').removeAttr('disabled');
		
	
       
    });
	$(document.body).on('dblclick', '#tblCntctPersons tbody > tr', function () 
	{
		
		var code = $(this).children('td.item-1').text();
        var name = $(this).children('td.item-2').text();
		
     

        $('#contactPersonModal').modal('hide');
	
		$('#txtContactPersonCode').val(code).css({'background-color': '', 'border-radius': '0px'});
		$('#txtContactPerson').val(name).css('background-color', '');
	
    });
	$(document.body).on('dblclick', '#tblSalesEmployee tbody > tr', function () 
	{
		
		var code = $(this).children('td.item-1').text();
        var name = $(this).children('td.item-2').text();
		
     

        $('#salesEmpModal').modal('hide');
	
		$('#txtSalesEmpCode').val(code).css({'background-color': '', 'border-radius': '0px'});
		$('#txtSalesEmpName').val(name).css('background-color', '');
	
    });
	$(document.body).on('dblclick', '#tblEmployee tbody > tr', function () 
	{
		
		var code = $(this).children('td.item-1').text();
        var name = $(this).children('td.item-2').text();
		
     

        $('#empModal').modal('hide');
	
		$('#txtOwnerCode').val(code).css({'background-color': '', 'border-radius': '0px'});
		$('#txtOwnerName').val(name).css({'background-color': '', 'border-radius': '0px'});
		
		
		$('#lnkEmployee').removeClass('d-none');
		
	
       
    });
	$(document.body).on('dblclick', '#tblPaymentTerms tbody > tr', function () 
	{
		
		var code = $(this).children('td.item-1').text();
        var name = $(this).children('td.item-2').text();
		
     

        $('#paymentTermsModal').modal('hide');
	
		$('#txtPaymentTermsCode').val(code);
		$('#txtPaymentTermsName').val(name);
	
       
    });
	$(document.body).on('dblclick', '#tblCountryS tbody > tr', function () 
	{
		
		var code = $(this).children('td.item-1').text();
        var name = $(this).children('td.item-2').text();
		
     

        $('#countryModalS').modal('hide');
	
		$('#txtCountryS').val(code);
		$('#txtCountrySName').val(name);
		$('.shipInputs').trigger('keyup');
	
       
    });
	$(document.body).on('dblclick', '#tblCountryB tbody > tr', function () 
	{
		
		var code = $(this).children('td.item-1').text();
        var name = $(this).children('td.item-2').text();
		
     

        $('#countryModalB').modal('hide');
	
		$('#txtCountryB').val(code);
		$('#txtCountryBName').val(name);
		$('.billInputs').trigger('keyup');
	
       
    });
	
	$(document.body).on('dblclick', '#tblItem tbody > tr', function () 
	{
		if($('#txtCardCode').val() == ''){
			$('#txtCardCode').focus();
			$('#messageBar2').addClass('d-none');
						$('#messageBar3').removeClass('d-none');
						$('#messageBar').text('Select Business Partner first!').css({'background-color': 'red', 'color': 'white'});
						
							setTimeout(function()
							{
								$('#messageBar').text('').css({'background-color': '', 'color': ''});	
								$('#messageBar2').removeClass('d-none');
							},5000)
							
		}else{
		var itemCode = $(this).children('td.item-1').text();
        var itemName = $(this).children('td.item-2').text();
		var uomGroup = $(this).children('td.item-5').text();
		var uomEntry = $(this).children('td.item-8').text();
		var uomName = $(this).children('td.item-10').text();
		var batchOrSerial = $(this).children('td.item-11').text();
		var price = $(this).children('td.item-6').text();
		var vendor = $(this).children('td.item-7').text();
		var whsCode = $(this).children('td.item-12').text();
		var whsName = $(this).children('td.item-13').text();
		
		
		$('.btnrowfunctions').removeClass('d-none');

        $('#itemModal').modal('hide');
	
		$('.selected-det').find('input.itemcode').val(itemCode);
        $('.selected-det').find('input.itemname').val(itemName);
		$('.selected-det').find('input.uomgroup').val(uomGroup);
		$('.selected-det').find('input.unitmsr').val(uomName);
		$('.selected-det').find('input.uomentry').val(uomEntry);
		$('.selected-det').find('input.price').val(price);
		$('.selected-det').find('input.cardcode').val(vendor);
		$('.selected-det').find('input.whsecode').val(whsCode);
		$('.selected-det').find('input.whsename').val(whsName);
		$('.selected-det').find('input.batchorserial').val(batchOrSerial);
		$('.selected-det').find('input.batchorserialcontainer').val('');
		$('.selected-det').find('input.batchorserialcontainer2').val('');
		
		AddRow();
		CheckCardCode(itemCode);
		CheckBatchSerial();
		}
   
    });
	
	$(document.body).on('dblclick', '#tblGL tbody > tr', function () 
	{
		
		var glCode = $(this).children('td.item-1').text();
        var glName = $(this).children('td.item-2').text();
	
		
		$('.btnrowfunctions').removeClass('d-none');
        $('#glModal').modal('hide');
	
		$('.selected-det').find('input.glaccount').val(glCode);
		$('.selected-det').find('input.glname').val(glName);
       
	   itemCode = glCode;
		AddRow();
		CheckCardCode(itemCode);
    });
      $(document.body).on('dblclick', '#tblWTax tbody > tr', function () 
	{
		
		var wtcode = $(this).children('td.item-2').text();
        var wtname = $(this).children('td.item-3').text();
        var rate = $(this).children('td.item-4').text();
        var account = $(this).children('td.item-5').text();
        let value = 0; 
		console.log(wtcode)
		$('.btnrowfunctions').removeClass('d-none');
        $('#WTaxModal').modal('hide');




		$('.selected-det-wtax').find('input.wtcode').val(wtcode);
		$('.selected-det-wtax').find('input.wtname').val(wtname);
		$('.selected-det-wtax').find('input.rate').val(rate);
		$('.selected-det-wtax').find('input.glaccountwtax').val(account);
		
       
	   itemCode = wtcode;
	   	ComputeWtaxPerRow();
		AddRowWTax();
		CheckCardCode(itemCode);
    });
	$(document.body).on('dblclick', '#tblUnit tbody > tr', function () 
	{
		
		var unitGroup = $(this).children('td.item-2').text();
        var unitName = $(this).children('td.item-3').text();
		var uomEntry = $(this).children('td.item-4').text();

        $('#uomModal').modal('hide');
	
		$('.selected-det').find('input.unitmsr').val(unitName);
		$('.selected-det').find('input.uomentry').val(uomEntry);
       
    });
	$(document.body).on('dblclick', '#tblWhse tbody > tr', function () 
	{
		
		var whseCode = $(this).children('td.item-1').text();
        var whseName = $(this).children('td.item-2').text();
		
        $('#whseModal').modal('hide');
	
		$('.selected-det').find('input.whsecode').val(whseCode);
		$('.selected-det').find('input.whsename').val(whseName);
       
    });
	let batchItemRowNo;
	let batchItemCode;
	let batchQuantity;
	let serialItemRowNo;
	let serialItemCode;
	let serailQuantity;
	$(document.body).on('click', '#tblBatch tbody > tr', function () 
	{
		let rowNo = 0;
		let itemCode = '';
		let batchQTYCreated = '';
		let whseCode = '';
		let batchrow =  $(this).find('td.tbldetailrowno').text();
		let batchItem =  $(this).find('td.itemcode').text()
		if($('#btnAdd').hasClass('d-none')){
				$('#batchModalTitle').text('Batches Number Transaction Report');	
				$('#batchTitle').text('Batches');	
				$('#batchTitle2').text('Transaction for Batch:');	
				let txtDocNum = $('#txtDocNum').val();
				let lineNo = $(this).find('td.doclineno').text();
				let itemCodeBatch = $(this).find('td.itemcode').text();
			
			
				
			
				$.ajax({
					type: 'GET',
					url: '../proc/views/vw_populate-batches-added-report.php',
					data: {
						txtDocNum : txtDocNum,
						lineNo : lineNo,
						itemCodeBatch : itemCodeBatch,
						objectTable : objectTable,
						objectType : objectType,
						childTable1 : childTable1,
						},
					success: function (html) 
					{
						$('#batchTableReport').html(html);
						
					}
				});
				
						 
				
			
	
			
			$('#tblBatch tbody tr').each(function()
			{	
				
				if(rowNo.toString() == $(this).find('td.tbldetailrowno').text() && itemCode == $(this).find('td.itemcode').text()){
					
					$(this).find('td').css("background-color", "lightgray");
					$(this).addClass("selected-item");
					
					
					
				}
				else{
					$(this).find('td').css("background-color", "transparent");
					$(this).removeClass("selected-item");
				}
				
			
			});		
		}
		else{
		
			
		$('#tblBatch tbody tr td').css("background-color", "transparent");
		batchItemRowNo = $(this).children('td.tbldetailrowno').text();
		batchItemCode = $(this).children('td.itemcode').text();
		batchQuantity = $(this).children('td.quantity').text();
		
        $('.selected-item').map(function () 
		{
            $(this).removeClass('selected-item');
            $(this).children('td').css("background-color", "transparent");
			
        })
		
		$(this).children('td').css("background-color", "lightgray");
        $(this).addClass('selected-item');
		
			
			$('#batchModalTitle').text('Batches - Setup');
			$('#batchTitle').text('Rows from Documents');	
			$('#batchTitle2').text('Created Batches');		
			let rowNo = 0;
			let itemCode = '';
			let batchData = '';
			let batchDataQTY = '';
			let batchQTYCreated = '';
			let batchExpDate = '';
			let batchMfrDate = '';
			let batchAdminDate = '';
			let batchLocation = '';
			let batchDetails = '';
			let batchUnitCost = '';
			
			$('#tblDetails tbody tr').each(function()
			{	
				
			if(batchItemRowNo == $(this).find('td.rowno span').text() && batchItemCode == $(this).find('input.itemcode').val()){
				rowNo = $(this).find('td.rowno span').text();
				itemCode = $(this).find('input.itemcode').val();
				let batch = $(this).find('input.batchorserialcontainer').val();
				let batchQTY = $(this).find('input.batchorserialquantity').val();
				let batchQTYCreated2 = $(this).find('input.batchorserialqtycreated').val();
				
				let batchExpDate2 = $(this).find('input.batchorserialexpdate').val();
				let batchMfrDate2 = $(this).find('input.batchorserialmfrdate').val();
				let batchAdminDate2 = $(this).find('input.batchorserialadmindate').val();
				let batchLocation2 = $(this).find('input.batchorseriallocation').val();
				let batchDetails2 = $(this).find('input.batchorserialdetails').val();
				let batchUnitCost2 = $(this).find('input.batchorserialunitcost').val();
				
				if(batch != ''){
					let batchPerItem = batch.split(',');
					let batchPerQTY = batchQTY.split(',');
					let batchPerQTYCreated = batchQTYCreated2.split(',');
					
					let batchExpDate3 = batchExpDate2.split(',');
					let batchMfrDate3 = batchMfrDate2.split(',');
					let batchAdminDate3 = batchAdminDate2.split(',');
					let batchLocation3 = batchLocation2.split(',');
					let batchDetails3 = batchDetails2.split(',');
					let batchUnitCost3 = batchUnitCost2.split(',');
					
					$('#tblBatchCreated tbody').html('');
					
				batchData = batchPerItem;
				batchDataQTY = batchPerQTY;
				batchQTYCreated = batchPerQTYCreated;
				
				batchExpDate = batchExpDate3;
				batchMfrDate = batchMfrDate3;
				batchAdminDate = batchAdminDate3;
				batchLocation = batchLocation3;
				batchDetails = batchDetails3;
				batchUnitCost = batchUnitCost3;
				}
				
			}
			});
			
			
			
			setTimeout(function(){
				//if(batchData != ''){
				$.ajax({
					type: 'GET',
					url: '../proc/views/vw_populate-batches.php',
					data: {
						rowNo : rowNo,
						batchData : batchData,
						batchDataQTY : batchDataQTY,
						batchExpDate : batchExpDate,
						batchMfrDate : batchMfrDate,
						batchAdminDate : batchAdminDate,
						batchLocation : batchLocation,
						batchDetails : batchDetails,
						batchUnitCost : batchUnitCost,
						
						},
					success: function (html) 
					{
						$('#tblBatchCreated tbody').html(html);
						
					}
				});
				//PopulateBatchCreated();
				//}				
			},1000)
			$('#tblBatch tbody tr').each(function()
			{	
				if(batchItemRowNo == $(this).find('td.tbldetailrowno').text() && batchItemCode == $(this).find('td.itemcode').text()){
					
					$(this).find('td').css("background-color", "lightgray");
					$(this).addClass("selected-item");
					$(this).find('td.totalcreated').text(isNaN(batchQTYCreated) ? 0 : batchQTYCreated);
					
					
				}
			
			});		
		}
    });
	
	$(document.body).on('click', '#tblSerial tbody > tr', function () 
	{
		let rowNo = 0;
		let itemCode = '';
		let serialQTYCreated = '';
		let whseCode = '';
		let serialrow =  $(this).find('td.tbldetailrowno').text();
		let serialItem =  $(this).find('td.itemcode').text()
		if($('#btnAdd').hasClass('d-none')){
				$('#tblDetails tbody tr').each(function()
				{	
					if($(this).find('td.rowno span').text() == serialrow && $(this).find('input.itemcode').val() == serialItem){
				
						rowNo = $(this).find('td.rowno span').text();
						itemCode = $(this).find('input.itemcode').val();
						
						whseCode = $(this).find('input.whsecode').val();
					}
					
					serialQTYCreated = $(this).find('input.quantity').val().replace(/,/g, '');
				});
			
			$('#serialModalTitle').text('Serial Number Transaction Report');	
			let txtDocNum = $('#txtDocNum').val();
			let ifserialed = $('#tblDetails tbody tr.selected-det').find('input.batchorserial').val();
			let lineNo = $(this).find('td.doclineno').text();
			let itemCodeSerial = $(this).find('td.itemcode').text();
			
				$.ajax({
					type: 'GET',
					url: '../proc/views/vw_populate-serial-added-report.php',
					data: {
						txtDocNum : txtDocNum,
						lineNo : lineNo,
						itemCodeSerial : itemCodeSerial,
						objectTable : objectTable,
						objectType : objectType,
						childTable1 : childTable1,
						},
					success: function (html) 
					{
						$('#serialTableReport').html(html);
						
					}
				});
		/* 	setTimeout(function(){
				if(ifserialed == 'B'){
				$.ajax({
					type: 'GET',
					url: '../proc/views/vw_populate-serials-added.php',
					data: {
						txtDocNum : txtDocNum,
						rowNo : rowNo,
						itemCode : itemCode,
						},
					success: function (html) 
					{
						$('#tblSerialCreated tbody').html(html);
						
					}
				});
				//PopulateserialCreated();
				}				
			},1000) */
			
			$('#tblSerial tbody tr').each(function()
			{	
				
				if(rowNo.toString() == $(this).find('td.tbldetailrowno').text() && itemCode == $(this).find('td.itemcode').text()){
					
					$(this).find('td').css("background-color", "lightgray");
					$(this).addClass("selected-item");
					
					
					
				}
				else{
					$(this).find('td').css("background-color", "transparent");
					$(this).removeClass("selected-item");
				}
				
			
			});		
		}
		else{
		
			
		$('#tblSerial tbody tr td').css("background-color", "transparent");
		serialItemRowNo = $(this).children('td.tbldetailrowno').text();
		serialItemCode = $(this).children('td.itemcode').text();
		serialQuantity = $(this).children('td.quantity').text();
		
        $('.selected-item').map(function () 
		{
            $(this).removeClass('selected-item');
            $(this).children('td').css("background-color", "transparent");
			
        })
		
		$(this).children('td').css("background-color", "lightgray");
        $(this).addClass('selected-item');
		
			
			$('#serialModalTitle').text('seriales - Setup');
			let rowNo = 0;
			let itemCode = '';
			let mfrSerialData = '';
			let serialData = '';
			let serialDataQTY = '';
			let serialQTYCreated = '';
			let serialExpDate = '';
			let serialMfrDate = '';
			let serialAdminDate = '';
			let serialLocation = '';
			let serialDetails = '';
			let serialUnitCost = '';
			
			$('#tblDetails tbody tr').each(function()
			{	
				
			if(serialItemRowNo == $(this).find('td.rowno span').text() && serialItemCode == $(this).find('input.itemcode').val()){
				rowNo = $(this).find('td.rowno span').text();
				itemCode = $(this).find('input.itemcode').val();
				let mfrSerial = $(this).find('input.batchorserialcontainer2').val();
				let serial = $(this).find('input.batchorserialcontainer').val();
				let serialQTY = $(this).find('input.batchorserialquantity').val();
				let serialQTYCreated2 = $(this).find('input.batchorserialqtycreated').val();
				
				let serialExpDate2 = $(this).find('input.batchorserialexpdate').val();
				let serialMfrDate2 = $(this).find('input.batchorserialmfrdate').val();
				let serialAdminDate2 = $(this).find('input.batchorserialadmindate').val();
				let serialLocation2 = $(this).find('input.batchorseriallocation').val();
				let serialDetails2 = $(this).find('input.batchorserialdetails').val();
				let serialUnitCost2 = $(this).find('input.batchorserialunitcost').val();
				
				if(serial != ''){
					let mfrSerialPerItem = mfrSerial.split(',');
					let serialPerItem = serial.split(',');
					let serialPerQTY = serialQTY.split(',');
					let serialPerQTYCreated = serialQTYCreated2.split(',');
					
					let serialExpDate3 = serialExpDate2.split(',');
					let serialMfrDate3 = serialMfrDate2.split(',');
					let serialAdminDate3 = serialAdminDate2.split(',');
					let serialLocation3 = serialLocation2.split(',');
					let serialDetails3 = serialDetails2.split(',');
					let serialUnitCost3 = serialUnitCost2.split(',');
					
					$('#tblSerialCreated tbody').html('');
					
				mfrSerialData = mfrSerialPerItem;
				serialData = serialPerItem;
				serialDataQTY = serialPerQTY;
				serialQTYCreated = serialPerQTYCreated;
				
				serialExpDate = serialExpDate3;
				serialMfrDate = serialMfrDate3;
				serialAdminDate = serialAdminDate3;
				serialLocation = serialLocation3;
				serialDetails = serialDetails3;
				serialUnitCost = serialUnitCost3;
				}
				
			}
			});
			
			
			
			setTimeout(function(){
				//if(serialData != ''){
				$.ajax({
					type: 'GET',
					url: '../proc/views/vw_populate-serials.php',
					data: {
						rowNo : rowNo,
						mfrSerialData: mfrSerialData,
						serialData : serialData,
						serialDataQTY : serialDataQTY,
						serialExpDate : serialExpDate,
						serialMfrDate : serialMfrDate,
						serialAdminDate : serialAdminDate,
						serialLocation : serialLocation,
						serialDetails : serialDetails,
						serialUnitCost : serialUnitCost,
						
						},
					success: function (html) 
					{
						$('#tblSerialCreated tbody').html(html);
						
					}
				});
				//PopulateserialCreated();
				//}				
			},1000)
			$('#tblSerial tbody tr').each(function()
			{	
				if(serialItemRowNo == $(this).find('td.tbldetailrowno').text() && serialItemCode == $(this).find('td.itemcode').text()){
					
					$(this).find('td').css("background-color", "lightgray");
					$(this).addClass("selected-item");
					$(this).find('td.totalcreated').text(isNaN(serialQTYCreated) ? 0 : serialQTYCreated);
					
					
				}
			
			});		
		}
    });
	
//Click
	
	$(document.body).on('focus', 'div.input-group', function () 
	{
		
		$(this).children('input').css('background-color', '#fdfd96');
	
    });
	$(document.body).on('blur', 'div.input-group', function () 
	{
		
		$(this).children('input').css('background-color', '');
    });
	$(document.body).on('click', '#drpSeries > div.dropdown-menu > option', function () 
	{
		
		let seriesName = $(this).val();
		$('#txtSeries').val(seriesName);
		
		setTimeout(function () 
			{
				$('#txtSeries').css('background-color', '');
				
            }, 100) 
			
    });
	$(document.body).on('click', '#drpTaxCode > div.dropdown-menu > option', function () 
	{
		
		let taxcode = $(this).val();
		let taxrate = $(this).attr('val-rate');
		$('.selected-det').find('.taxcode').val(taxcode);
		$('.selected-det').find('.taxcode').attr(taxrate);
		
		setTimeout(function () 
			{
				$('.selected-det').find('.taxcode').css('background-color', '');
				
            }, 100) 
    });
	
	$(document.body).on('click', '#btnUpdateBatch', function (e) 
	{
		let err = 0;
		let selectedRow;
		let selectedDocNum;
		let selectedItem;
		let selectedWhse;
		let selectedQtyNeeded;
		let selectedQtyCreated;
		
		
		$('#tblBatch tbody tr').each(function(i){
		
		if($(this).hasClass('selected-item')){
			 
			 selectedRow = $(this).find('td.tbldetailrowno').text();
			 selectedDocNum = $(this).find('td.docnumber').text();
			 selectedItem = $(this).find('td.itemcode').text();
			 selectedWhse = $(this).find('td.whsecode').text();
			 selectedQtyNeeded = $(this).find('td.quantity').text();
			 selectedQtyCreated = $(this).find('td.totalcreated').text();
		}
		
		})
		if(selectedQtyNeeded != ''){
			let quantity = 0.00;
			 $('#tblBatchCreated tbody tr').each(function(i) {
				
				if($(this).find('input.quantity').val() > 0){
					quantity += parseFloat($(this).find('input.quantity').val());
					
					 if(quantity > parseFloat(selectedQtyNeeded)){
						$(this).find('input.batch').val('');
						$(this).find('input.quantity').val('');
						$('#messageBar2').addClass('d-none');
							$('#messageBar3').removeClass('d-none');
							$('#messageBar').text('Quantity Exceed!').css({'background-color': 'red', 'color': 'white'});
							
								setTimeout(function()
								{
									$('#messageBar').text('').css({'background-color': '', 'color': ''});	
									$('#messageBar2').removeClass('d-none');
								},5000)
						err = 1;
					 }
					 else {
						$('#tblBatch tbody tr.selected-item').find('td.totalcreated').text(quantity.toString());
					 }
				} 
				 
				 
			});
			if(err == 0){
				SelectCreatedBatchPerItem(selectedRow,selectedDocNum,selectedItem,selectedWhse,selectedQtyNeeded,selectedQtyCreated);
			
			
				AddRowBatch();
			}
		}
		else{
			$('#messageBar2').addClass('d-none');
							$('#messageBar3').removeClass('d-none');
							$('#messageBar').text('Quantity Needed is empty!').css({'background-color': 'red', 'color': 'white'});
							
								setTimeout(function()
								{
									$('#messageBar').text('').css({'background-color': '', 'color': ''});	
									$('#messageBar2').removeClass('d-none');
								},5000)
		}
	});
	
	$(document.body).on('click', '#btnUpdateSerial', function (e) 
	{
		let err = 0;
		let err2 = 0;
		let selectedRow;
		let selectedDocNum;
		let selectedItem;
		let selectedWhse;
		let selectedQtyNeeded;
		let selectedQtyCreated;
		
		let uniqueSerial = '';
					$.ajax({
									type: 'GET',
									url: '../proc/views/vw_unique-serial.php',
									success: function (data) 
									{
										
										uniqueSerial = data;
									}
								}); 
								//alert(uniqueSerial)
		
		$('#tblSerial tbody tr').each(function(i){
		
		if($(this).hasClass('selected-item')){
			 selectedRow = $(this).find('td.tbldetailrowno').text();
			 selectedDocNum = $(this).find('td.docnumber').text();
			 selectedItem = $(this).find('td.itemcode').text();
			 selectedWhse = $(this).find('td.whsecode').text();
			 selectedQtyNeeded = $(this).find('td.quantity').text();
			 selectedQtyCreated = $(this).find('td.totalcreated').text();
		}
		
		})
		if(selectedQtyNeeded != ''){
			let quantity = 0.00;
			 $('#tblSerialCreated tbody tr').each(function(i) {
				if($(this).find('input.quantity').val() > 0){
					quantity += parseFloat($(this).find('input.quantity').val());
					
					 if(quantity > parseFloat(selectedQtyNeeded)){
						$(this).find('input.mfrserial').val('');
						$(this).find('input.serial').val('');
						$(this).find('input.quantity').val('');
						$('#messageBar2').addClass('d-none');
							$('#messageBar3').removeClass('d-none');
							$('#messageBar').text('Quantity Exceed!').css({'background-color': 'red', 'color': 'white'});
							
								setTimeout(function()
								{
									$('#messageBar').text('').css({'background-color': '', 'color': ''});	
									$('#messageBar2').removeClass('d-none');
								},5000)
						err = 1;
					 }
					 else {
						$('#tblSerial tbody tr.selected-item').find('td.totalcreated').text(quantity.toString());
					 }
				} 
				 
				 
			});
			if(err == 0){
				SelectCreatedSerialPerItem(selectedRow,selectedDocNum,selectedItem,selectedWhse,selectedQtyNeeded,selectedQtyCreated);
			
					
				if(uniqueSerial == '.mfrserial'){
				 $('#tblDetails tbody tr').each(function(i) {
					let mfrSerialArray = $(this).find('input.batchorserialcontainer2').val().split(',');
					let rowNo = $(this).find('td.rowno span').text();
					
					$('#tblSerialCreated tbody tr').each(function(i) 
					{
						if($(this).find('input.mfrserial').val() == mfrSerialArray[i] && $(this).find('input.tbldetailrowno').val() != rowNo){
							
							err2 = 1;
							$('#messageBar2').addClass('d-none');
							$('#messageBar3').removeClass('d-none');
							$('#messageBar').text(uniqueSerial + ' already exists in other rows').css({'background-color': 'red', 'color': 'white'});
							
								setTimeout(function()
								{
									$('#messageBar').text('').css({'background-color': '', 'color': ''});	
									$('#messageBar2').removeClass('d-none');
								},5000)
						}
							
					});
					 //alert($('#tblSerialCreated tbody tr').find('input.mfrserial').val() + ' ' +  $(this).find('input.batchorserialcontainer2').val());
					
				 });
				}
				else if(uniqueSerial == '.serial'){
					 $('#tblDetails tbody tr').each(function(i) {
					let serialArray = $(this).find('input.batchorserialcontainer').val().split(',');
					let rowNo = $(this).find('td.rowno span').text();
					
					$('#tblSerialCreated tbody tr').each(function(i) 
					{
						if($(this).find('input.serial').val() == serialArray[i] && $(this).find('input.tbldetailrowno').val() != rowNo){
							
							err2 = 1;
							$('#messageBar2').addClass('d-none');
							$('#messageBar3').removeClass('d-none');
							$('#messageBar').text(uniqueSerial + ' already exists in other rows').css({'background-color': 'red', 'color': 'white'});
							
								setTimeout(function()
								{
									$('#messageBar').text('').css({'background-color': '', 'color': ''});	
									$('#messageBar2').removeClass('d-none');
								},5000)
						}
							
					});
					 //alert($('#tblSerialCreated tbody tr').find('input.mfrserial').val() + ' ' +  $(this).find('input.batchorserialcontainer2').val());
					
				 });
				}
				
				if(err == 0){
					AddRowSerial();
				}
				
			}
			
			
		}
		else{
			$('#messageBar2').addClass('d-none');
							$('#messageBar3').removeClass('d-none');
							$('#messageBar').text('Quantity Needed is empty!').css({'background-color': 'red', 'color': 'white'});
							
								setTimeout(function()
								{
									$('#messageBar').text('').css({'background-color': '', 'color': ''});	
									$('#messageBar2').removeClass('d-none');
								},5000)
		}
	});
	
	$(document.body).on('change', '#selShipToAddress', function () 
	{

		printShipToAddress('#txtShipToAddressTextArea', $('#txtDocNum').val());

		$.ajax({
			type: 'POST',
			url: '../proc/views/vw_getShipToAddressComponents.php',
			data: {
				childTable12 : childTable12,
				docNum: $('#txtDocNum').val()
			},
			success: function (data) 
			{
				let dataObj = JSON.parse(data);

				$('#txtStreetPOBoxS').val(dataObj.StreetS);
				$('#txtStreetNoS').val(dataObj.StreetNoS);
				$('#txtBlockS').val(dataObj.BlockS);
				$('#txtCityS').val(dataObj.CityS);
				$('#txtZipCodeS').val(dataObj.ZipCodeS);
				$('#txtCountyS').val(dataObj.CountyS);
				$('#txtCountrySName').val(dataObj.CountryName);
				$('#txtCountryS').val(dataObj.CountryCode);
				$('#txtBuildingS').val(dataObj.BuildingS);
				setStateList(dataObj.CountryCode);
				$('#txtStateSName').val(dataObj.StateName);
				$('#txtStateS').val(dataObj.StateCode);
				$('#txtAddress2S').val(dataObj.Address2S);
				$('#txtAddress3S').val(dataObj.Address3S);
				$('#txtGLNS').val(dataObj.GlbLocNumS);

				$('#txtShipArr').val(data);

			}
		});
		
		// let addressID = $(this).val();
		// let cardCode = $('#txtCardCode').val();
		// let shipArr = [];	
		// let shipArr2 = [];	
		// let shipList;
		// let shipList2;
		// $('#selShipToAddress').val(addressID);
		// setTimeout(function () {
		// 		$('#textShipToAddress').css('background-color', '');
				
		// 		$.getJSON('../proc/views/vw_shipToAddressDetails.php?cardCode=' + cardCode + '&address=' + addressID, function (data){
		// 			$.each(data, function (key, val){
		// 				$('#selShipToAddress').val(val.Address);
		// 				$('#txtShipToAddressTextArea').val(val.Street + '\n' + '\n'  + val.ZipCode + ' ' + val.City + '\n'  + val.Country );
						
		// 					val.Street != '' ? shipArr.push('Street'): '';
		// 					val.StreetNo != '' ? shipArr.push('StreetNo'): '';
		// 					val.Block != '' ? shipArr.push('Block'): '';
		// 					val.ZipCode != '' ? shipArr.push('ZipCode'): '';
		// 					val.City != '' ? shipArr.push('City'): '';
		// 					val.County != '' ? shipArr.push('County'): '';
		// 					val.State != '' ? shipArr.push('State'): '';
		// 					val.Country != '' ? shipArr.push('Country'): '';
		// 					val.Building != '' ? shipArr.push('Building'): '';
		// 					val.CountryCode != '' ? shipArr.push('CountryCode'): '';
							
							
		// 					shipArr2.push(val.Street);
		// 					shipArr2.push(val.StreetNo);
		// 					shipArr2.push(val.Block);
		// 					shipArr2.push(val.ZipCode);
		// 					shipArr2.push(val.City);
		// 					shipArr2.push(val.County);
		// 					shipArr2.push(val.State);
		// 					shipArr2.push(val.Country);
		// 					shipArr2.push(val.Building);
		// 					shipArr2.push(val.CountryCode);
							
		
						
		// 			});
		// 		});
				
  //           }, 0) 
		// 	setTimeout(function () {
		// 		shipList = shipArr;
		// 		shipList2 = shipArr2;
		// 		$('#txtShipArr').val(shipList);			
		// 		$('#txtShipArr2').val(shipList2);			
				
		// 		}, 100) 
			
		
    });
	$(document.body).on('change', '#selSeries', function () 
	{
		let series = $(this).val()
		$.ajax({
				type: 'GET',
				url: '../proc/views/vw_getDocNumPerSeries.php',
				data: {
					series : series
				},
				success: function (data) 
				{
					console.log(data);
					$('#txtDocNum').val(data)
				}
			});
	})
    
	$(document.body).on('change', '#selBillToAddress', function () 
	{
		let addressID = $(this).val();
		let cardCode = $('#txtCardCode').val();
		let billArr = [];	
		let billArr2 = [];	
		let billList;
		let billList2;
		$('#selBillToAddress').val(addressID);
		setTimeout(function () 
			{
				$('#textBillToAddress').css('background-color', '');
				
				$.getJSON('../proc/views/vw_billToAddressDetails.php?cardCode=' + cardCode + '&address=' + addressID, function (data){
				$.each(data, function (key, val){
				$('#selBillToAddress').val(val.Address);
				$('#txtBillToAddressTextArea').val(val.Street + '\n' + '\n'  + val.ZipCode + ' ' + val.City + '\n'  + val.Country );
							val.Street != '' ? billArr.push('Street'): '';
							val.StreetNo != '' ? billArr.push('StreetNo'): '';
							val.Block != '' ? billArr.push('Block'): '';
							val.ZipCode != '' ? billArr.push('ZipCode'): '';
							val.City != '' ? billArr.push('City'): '';
							val.County != '' ? billArr.push('County'): '';
							val.State != '' ? billArr.push('State'): '';
							val.Country != '' ? billArr.push('Country'): '';
							val.Building != '' ? billArr.push('Building'): '';
							val.CountryCode != '' ? billArr.push('CountryCode'): '';
							
							billArr2.push(val.Street);
							billArr2.push(val.StreetNo);
							billArr2.push(val.Block);
							billArr2.push(val.ZipCode);
							billArr2.push(val.City);
							billArr2.push(val.County);
							billArr2.push(val.State);
							billArr2.push(val.Country);
							billArr2.push(val.CountryCode);
						
					});
				});
				
            }, 0) 
			setTimeout(function () {
				billList = billArr;
				billList2 = billArr2;
				$('#txtBillArr').val(billList);			
				$('#txtBillArr2').val(billList2);			
				
				}, 100) 
		
    });
//On Change
	/* $(document.body).on('change', 'input:not(#txtDocNum)', function () 
	{
		
		if(objectType = 22){
			$('#btnOk').addClass('d-none');
			$('#btnUpdate').removeClass('d-none');
		}
			
		
		
	}); */
	/* $(document.body).on('input', 'input:not(#txtDocNum)', function () 
	{
		
		if(objectType = 22){
			$('#btnOk').addClass('d-none');
			$('#btnUpdate').removeClass('d-none');
		}
			
		
		
	}); */
	
	$(document.body).on('change', '#txtDeliveryDate', function () 
	{
		$('#txtRequiredDate').val(SAPDateFormater($(this).val()).value);
		
	});
	$(document.body).on('change', '#txtPostingDate', function () 
	{
		$('#txtDocumentDate').val($(this).val());
		//2021-09-08
		let date = $(this).val();
		let month = date.substring(5, 7);
		let day = date.substring(8, 10);
		let year = date.substring(0, 4);
		let newdate = month + "." + day + "." + year;
		$('#txtPostingDate2').val(newdate);
	});
	

	$(document.body).on('change', '#txtDeliveryDate', function () 
	{
			//2021-09-08
			let date = $(this).val();
			let month = date.substring(5, 7);
			let day = date.substring(8, 10);
			let year = date.substring(0, 4);
			let newdate = month + "." + day + "." + year;
			$('#txtDeliveryDate2').val(newdate);
	});
	$(document.body).on('change', '#txtDocumentDate', function () 
	{
				//2021-09-08
				let date = $(this).val();
				let month = date.substring(5, 7);
				let day = date.substring(8, 10);
				let year = date.substring(0, 4);
				let newdate = month + "." + day + "." + year;
				$('#txtDocumentDate2').val(newdate);
	});

	/*UDF Date fields*/
	$(document.body).on('change', '.btnDateType', function () 
	{
		let id2 = $(this).attr('id2');

		if ($(this).parent().parent().parent().hasClass('selected-row')){
			$('.selected-row input.' + id2).val(SAPDateFormater($(this).val()).value);
			return false;
		}
		$('input.' + id2).val(SAPDateFormater($(this).val()).value);
	});

	$(document.body).on('change', '#selTransactionType', function () 
	{
		serviceType =  $(this).val();
		if (serviceType == 'S'){
			$('input.quantity').val(1);
		}
		$('#contents-tab').load('../templates/' + mainFileName + '-lines.php?serviceType=' + serviceType), function (){
			
		};
	});

//On Shown Modals

	/* $('#purchaseRequestModal').on('shown.bs.modal',function(){
		
		var cardCode = $('#txtCardCode').val();
		
		
		if(cardCode == '')
		{
			
			$('#tblPR tbody').html('');
		}
		else
		{	
			
			$.ajax({
				type: 'GET',
				url: '../proc/views/vw_copyFromPR.php',
				data: {cardCode : cardCode},
				success: function (html) 
				{
					$('#purchaseRequestModal').html(html);
				}
			});
		}
	}); */
	$('#'+copyFromModal+'Modal').on('shown.bs.modal',function(){
		
		var cardCode = $('#txtCardCode').val();
		var table = baseTable;
		
		console.log(copyFromModal, baseTable, copyFromModalTbl);
		
		if(cardCode == '')
		{
			
			$('#tbl'+copyFromModalTbl+' tbody').html('');
		}
		else
		{	
			$.ajax({
				type: 'GET',
				url: '../proc/views/vw_copyFrom.php',
				data: {
					cardCode : cardCode,
					table: table
				},
				success: function (html) 
				{
					console.log(html);
					$('#'+copyFromModal+'Result').html(html);
				}
			});
		}
	});
	$('#contactPersonModal').on('shown.bs.modal',function(){
		
		var cardCode = $('#txtCardCode').val();
		
		
		if(cardCode == '')
		{
			
			$('#tblCntctPersons tbody').html('');
		}
		else
		{	
			
			
			$.ajax({
				type: 'GET',
				url: '../proc/views/vw_contactPersons.php',
				data: {cardCode : cardCode},
				success: function (html) 
				{
					$('#contactPersonResult').html(html);
				}
			});
		}
	});
	$('#uomModal').on('shown.bs.modal',function(){
		
		var itemCode = $('.selected-det').find('input.itemcode').val();
		var uomGroup = $('.selected-det').find('input.uomgroup').val();
		
		if(itemCode == '')
		{
			
			$('#tblUom tbody').html('');
		}
		else
		{	
			
			
			$.ajax({
				type: 'GET',
				url: '../proc/views/vw_uomcode.php',
				data: {uomGroup : uomGroup},
				success: function (html) 
				{
					$('#uomModalResult').html(html);
				}
			});
		}
	});
	
	$('#shipToDetailsModal').on('shown.bs.modal',function(){
		
		let dataObj = JSON.parse($('#txtShipArr').val())
		$('#txtStreetPOBoxS').val(dataObj.StreetS);
		$('#txtStreetNoS').val(dataObj.StreetNoS);
		$('#txtBlockS').val(dataObj.BlockS);
		$('#txtCityS').val(dataObj.CityS);
		$('#txtZipCodeS').val(dataObj.ZipCodeS);
		$('#txtCountyS').val(dataObj.CountyS);
		$('#txtCountrySName').val(dataObj.CountryName);
		$('#txtBuildingS').val(dataObj.BuildingS);
		$('#txtCountryS').val(dataObj.CountryCode);
		setStateList(dataObj.CountryCode);
		$('#txtStateSName').val(dataObj.StateName);
		$('#txtStateS').val(dataObj.StateCode);
		$('#txtAddress2S').val(dataObj.Address2S);
		$('#txtAddress3S').val(dataObj.Address3S);
		$('#txtGLNS').val(dataObj.GlbLocNumS);

	});

	$('#billToDetailsModal').on('shown.bs.modal',function(){
		let billArrToChange =  $('#txtBillArr').val().split(',');
		let billArrToChange2 =  $('#txtBillArr2').val().split(',');
	
		
		$('#txtStreetPOBoxB').val(billArrToChange2[0]);
		$('#txtStreetNoB').val(billArrToChange2[1]);
		
		$('#txtBlockB').val(billArrToChange2[2]);
		$('#txtZipCodeB').val(billArrToChange2[3]);
		
		$('#txtCityB').val(billArrToChange2[4]);
		$('#txtCountyB').val(billArrToChange2[5]);
		$('#txtStateB').val(billArrToChange2[6]);
		$('#txtCountryBName').val(billArrToChange2[7]);
		$('#txtBuildingB').val(billArrToChange2[8]);
		$('#txtCountryB').val(billArrToChange2[9]);
	

		
	});
	$('#batchModal').on('shown.bs.modal',function(){
		let rowNo = 0;
		let itemCode = '';
		let batchQTYCreated = '';
		let whseCode = '';
		if($('#btnAdd').hasClass('d-none')){
			
		
			$('#batchModalTitle').text('Batches Number Transaction Report');	
			$('#batchTitle').text('Batches');	
			$('#batchTitle2').text('Transaction for Batch:');	
			let txtDocNum = $('#txtDocNum').val();
			let ifBatched = $('#tblDetails tbody tr.selected-det').find('input.batchorserial').val();
			let lineNo = $('#tblDetails tbody tr.selected-det').find('input.linenum').val();
			let itemCodeBatch = $('#tblDetails tbody tr.selected-det').find('input.itemcode').val();
			
			if(ifBatched == 'B'){
				$.ajax({
					type: 'GET',
					url: '../proc/views/vw_populate-batch-added-top.php',
					data: {
						txtDocNum : txtDocNum,
						lineNo: lineNo,
						objectTable : objectTable,
						objectType : objectType,
						childTable1 : childTable1,
						},
					success: function (html) 
					{
						$('#batchTable').html(html);
						
					}
				});
			
				$.ajax({
					type: 'GET',
					url: '../proc/views/vw_populate-batches-added-report.php',
					data: {
						txtDocNum : txtDocNum,
						lineNo : lineNo,
						itemCodeBatch : itemCodeBatch,
						objectTable : objectTable,
						objectType : objectType,
						childTable1 : childTable1,
						},
					success: function (html) 
					{
						$('#batchTableReport').html(html);
						
					}
				});
				
			}			 
				
			
			setTimeout(function(){
			$('#tblBatch tbody tr').each(function()
			{	
				if($(this).find('td.rowno span').text() == '1'){
					
					$(this).find('td').css("background-color", "lightgray");
					$(this).addClass("selected-item");
					
					
					
				}
			});		
			},1000)
		}
		else{
			$('#batchModalTitle').text('Batches - Setup');
			$('#batchTitle').text('Rows from Documents');	
			$('#batchTitle2').text('Created Batches');	
			GetAllItemWithBatchManagement();
			let rowNo = 0;
			let itemCode = '';
			let batchData = '';
			let batchDataQTY = '';
			let batchQTYCreated = '';
			let batchExpDate = '';
			let batchMfrDate = '';
			let batchAdminDate = '';
			let batchLocation = '';
			let batchDetails = '';
			let batchUnitCost = '';
			
			$('#tblDetails tbody tr.selected-det').each(function()
			{	
				rowNo = $(this).find('td.rowno span').text();
				itemCode = $(this).find('input.itemcode').val();
				let batch = $(this).find('input.batchorserialcontainer').val();
				let batchQTY = $(this).find('input.batchorserialquantity').val();
				let batchQTYCreated2 = $(this).find('input.batchorserialqtycreated').val();
				
				let batchExpDate2 = $(this).find('input.batchorserialexpdate').val();
				let batchMfrDate2 = $(this).find('input.batchorserialmfrdate').val();
				let batchAdminDate2 = $(this).find('input.batchorserialadmindate').val();
				let batchLocation2 = $(this).find('input.batchorseriallocation').val();
				let batchDetails2 = $(this).find('input.batchorserialdetails').val();
				let batchUnitCost2 = $(this).find('input.batchorserialunitcost').val();
				
				if(batch != ''){
					let batchPerItem = batch.split(',');
					let batchPerQTY = batchQTY.split(',');
					let batchPerQTYCreated = batchQTYCreated2.split(',');
					
					let batchExpDate3 = batchExpDate2.split(',');
					let batchMfrDate3 = batchMfrDate2.split(',');
					let batchAdminDate3 = batchAdminDate2.split(',');
					let batchLocation3 = batchLocation2.split(',');
					let batchDetails3 = batchDetails2.split(',');
					let batchUnitCost3 = batchUnitCost2.split(',');
					
					$('#tblBatchCreated tbody').html('');
					
				batchData = batchPerItem;
				batchDataQTY = batchPerQTY;
				batchQTYCreated = batchPerQTYCreated;
				
				batchExpDate = batchExpDate3;
				batchMfrDate = batchMfrDate3;
				batchAdminDate = batchAdminDate3;
				batchLocation = batchLocation3;
				batchDetails = batchDetails3;
				batchUnitCost = batchUnitCost3;
			
				}
			
			});
			$('#tblBatch tbody tr').each(function()
			{	
				if(rowNo.toString() == $(this).find('td.tbldetailrowno').text() && itemCode == $(this).find('td.itemcode').text()){
					
					$(this).find('td').css("background-color", "lightgray");
					$(this).addClass("selected-item");
					$(this).find('td.totalcreated').text(isNaN(batchQTYCreated) ? 0 : batchQTYCreated);
					
				}
			
			});
			
			setTimeout(function(){
				if(batchData != ''){
				$.ajax({
					type: 'GET',
					url: '../proc/views/vw_populate-batches.php',
					data: {
						rowNo : rowNo,
						batchData : batchData,
						batchDataQTY : batchDataQTY,
						batchExpDate : batchExpDate,
						batchMfrDate : batchMfrDate,
						batchAdminDate : batchAdminDate,
						batchLocation : batchLocation,
						batchDetails : batchDetails,
						batchUnitCost : batchUnitCost,
						
						},
					success: function (html) 
					{
						$('#tblBatchCreated tbody').html(html);
						
					}
				});
				//PopulateBatchCreated();
				}				
			},1000)
			
		}
	});
	
	$('#serialModal').on('shown.bs.modal',function(){
		let rowNo = 0;
		let itemCode = '';
		let serialQTYCreated = '';
		let whseCode = '';
		if($('#btnAdd').hasClass('d-none')){
			
				
			$('#serialModalTitle').text('Serial Number Transaction Report');
			$('#serialTitle').text('Serials');	
			$('#serialTitle2').text('Transaction for Serial Number:');	
			
			let txtDocNum = $('#txtDocNum').val();
			let ifBatched = $('#tblDetails tbody tr.selected-det').find('input.batchorserial').val();
			let itemCodeSerial = $('#tblDetails tbody tr.selected-det').find('input.itemcode').val();
			let lineNo = $('#tblDetails tbody tr.selected-det').find('input.linenum').val();
			if(ifBatched == 'S'){
				$.ajax({
					type: 'GET',
					url: '../proc/views/vw_populate-serials-added-top.php',
					data: {
						txtDocNum : txtDocNum,
						lineNo : lineNo,
						objectTable : objectTable,
						objectType : objectType,
						childTable1 : childTable1,
						},
					success: function (html) 
					{
						$('#serialTable').html(html);
						
					}
				});
				//PopulateBatchCreated();
				}				
			
			
				
				$.ajax({
					type: 'GET',
					url: '../proc/views/vw_populate-serial-added-report.php',
					data: {
						txtDocNum : txtDocNum,
						lineNo : lineNo,
						itemCodeSerial : itemCodeSerial,
						objectTable : objectTable,
						objectType : objectType,
						childTable1 : childTable1,
						},
					success: function (html) 
					{
						$('#serialTableReport').html(html);
						
					}
				});
				//PopulateBatchCreated();
							
			
			
			
			$('#tblSerial tbody tr').each(function()
			{	
				if($(this).find('td.rowno span').text() == '1'){
					
					$(this).find('td').css("background-color", "lightgray");
					$(this).addClass("selected-item");
					
					
					
				}
			});		
		}
		else{
			$('#serialModalTitle').text('Serial - Setup');
			$('#serialTitle').text('Rows from Documents');	
			$('#serialTitle2').text('Created Serial Numbers');	
			GetAllItemWithSerialManagement();
			let rowNo = 0;
			let itemCode = '';
			let mfrSerialData = '';
			let serialData = '';
			let serialDataQTY = '';
			let serialQTYCreated = '';
			let serialExpDate = '';
			let serialMfrDate = '';
			let serialAdminDate = '';
			let serialLocation = '';
			let serialDetails = '';
			let serialUnitCost = '';
			
			$('#tblDetails tbody tr.selected-det').each(function()
			{	
				
				rowNo = $(this).find('td.rowno span').text();
				itemCode = $(this).find('input.itemcode').val();
				let mfrSerial = $(this).find('input.batchorserialcontainer2').val();
				let serial = $(this).find('input.batchorserialcontainer').val();
				let serialQTY = $(this).find('input.batchorserialquantity').val();
				let serialQTYCreated2 = $(this).find('input.batchorserialqtycreated').val();
				
				let serialExpDate2 = $(this).find('input.batchorserialexpdate').val();
				let serialMfrDate2 = $(this).find('input.batchorserialmfrdate').val();
				let serialAdminDate2 = $(this).find('input.batchorserialadmindate').val();
				let serialLocation2 = $(this).find('input.batchorseriallocation').val();
				let serialDetails2 = $(this).find('input.batchorserialdetails').val();
				let serialUnitCost2 = $(this).find('input.batchorserialunitcost').val();
				if(serial != ''){
					let mfrSerialDataPerItem = mfrSerial.split(',');
					let serialPerItem = serial.split(',');
					let serialPerQTY = serialQTY.split(',');
					let serialPerQTYCreated = serialQTYCreated2.split(',');
					
					let serialExpDate3 = serialExpDate2.split(',');
					let serialMfrDate3 = serialMfrDate2.split(',');
					let serialAdminDate3 = serialAdminDate2.split(',');
					let serialLocation3 = serialLocation2.split(',');
					let serialDetails3 = serialDetails2.split(',');
					let serialUnitCost3 = serialUnitCost2.split(',');
					
					$('#tblSerialCreated tbody').html('');
				
				mfrSerialData = mfrSerialDataPerItem;			
				serialData = serialPerItem;
				serialDataQTY = serialPerQTY;
				serialQTYCreated = serialPerQTYCreated;
				
				serialExpDate = serialExpDate3;
				serialMfrDate = serialMfrDate3;
				serialAdminDate = serialAdminDate3;
				serialLocation = serialLocation3;
				serialDetails = serialDetails3;
				serialUnitCost = serialUnitCost3;
				}
			
			});
			
			$('#tblSerial tbody tr').each(function(){
				if(rowNo.toString() == $(this).find('td.tbldetailrowno').text() && itemCode == $(this).find('td.itemcode').text()){
					$(this).find('td').css("background-color", "lightgray");
					$(this).addClass("selected-item");
					$(this).find('td.totalcreated').text(isNaN(serialQTYCreated) ? 0 : serialQTYCreated);
					
				}
			
			});
			
			setTimeout(function(){
				if(serialData != ''){
				$.ajax({
					type: 'GET',
					url: '../proc/views/vw_populate-serials.php',
					data: {
						rowNo : rowNo,
						mfrSerialData : mfrSerialData,
						serialData : serialData,
						serialDataQTY : serialDataQTY,
						serialExpDate : serialExpDate,
						serialMfrDate : serialMfrDate,
						serialAdminDate : serialAdminDate,
						serialLocation : serialLocation,
						serialDetails : serialDetails,
						serialUnitCost : serialUnitCost,
						
						},
					success: function (html) 
					{
						$('#tblSerialCreated tbody').html(html);
						
					}
				});
				//PopulateBatchCreated();
				}				
			},1000)
			
		}
	});

$(document.body).on('click', '#btnWTLiableYes', function () 
{	
	$('#WTaxModal').modal('show');
	$('#WTLiableModal').modal('hide');
});

$('#WTaxModal').on('shown.bs.modal',function()
{
	var cardCodeWTLiable = $('#txtCardCode').val();
	let wtcodeArrayString = $('#txtWtLiableArray').val();
	let wtcodeArray = wtcodeArrayString.split(",");

	$.ajax({
			type: 'POST',
			url: '../proc/views/vw_withholdingTable.php',
			data: {
				cardCodeWTLiable : cardCodeWTLiable
			},
			success: function(html)
			{
				
				$('#wTaxTResult').html(html);

			}
		});
setTimeout(function(){
		$('#tblWTax tbody tr').each(function(){
			let wtcode = $(this).find('td.wtcode').text()
			let element = $(this)
			if ($.inArray(wtcode, wtcodeArray) != -1)
			{
			 	element.find('input.wtselected').prop('checked', true);
			 	
			}
		});
	},1000)
});


$('#WTaxTableModal').on('shown.bs.modal',function()
{
	//ComputeFooterTotalBeforeDiscountWTax();
	let baseamount = $('#txtDocTotal').val()

	$('#tblWTaxTable').find('input.baseamount').val(baseamount);
	ComputeTaxable();
	
	ComputeWtaxPerRow();
	ComputeTotal();
	
});
$('#WTaxTableModal').on('hidden.bs.modal',function()
{
	ComputeWtaxPerRowToFooter();
	ComputeTaxable();
	ComputeTotal();
});

$(document.body).on('change', 'select.selwt', function () 
{
	
	//	setTimeout(function () 
			//{
				 $('input[name=txtWTaxF]').trigger('keyup');
			//}, 1000)
			
				
});
$(document.body).on('click', '#btnUpdateWTLiable', function () 
{
		
	// 	var CodeArr = [];
	// 	var RateArr = [];
	// 	//var WTAcctCode = [];
	// 	var Rate = 0.00;
		
		
	// 	var tbl2 = $('#tblWTax tbody tr').each(function (i) 
	// 	{
	//         x = $(this).children();
	       
			
			
	// 		if ($(this).find('input.wtselected').prop('checked') == true)
	// 		{
				
	//             CodeArr.push($(this).find('td.item-2').text());
	//             RateArr.push($(this).find('td.item-4').text());
	// 			$('#txtWtLiableAcctCode').val($(this).find('td.item-5').text());
	//             Rate += parseFloat($(this).find('td.item-4').text());
				
				
			
	// 		} 
			
	// 	});
	
	// //$('#txtWTaxF').trigger('keyup');	
	// $('#txtWtLiableArray').val(CodeArr);
	// $('#txtWtLiableArray2').val(Rate);
	
	// $('input[name=txtWTaxF]').trigger('keyup');	
	
	// $('input[name=txtTotalPaymentDue]').trigger('keyup');	
	// ComputeFooterTotalBeforeDiscount();
		let wtaxsum = 0.00
		var tbl2 = $('#tblWTaxTable tbody tr').each(function (i) 
		{
	        x = $(this).children();
	       
			
			
			if ($(this).find('input.wtaxamount').val() != '')
			{
				
	            
	            wtaxsum += parseFloat($(this).find('input.wtaxamount').val());
			
				
			
			} 
			
		});
	
		$('#txtWTaxF').val(FormatMoney(wtaxsum));	
	$('#WTaxModal').modal('hide');	
});
	$('#journalEntryModal').on('shown.bs.modal',function(){
		var docNum = $('#txtDocNum').val();
		var currency = $('#txtCurrency').val();
		var objType = 13;

	
        $('#salesOrderModal').modal('hide');
				$('#txtBaseEntry').val(docNum);
				$('#btnAdd').removeClass('d-none');
				$('#btnUpdate').addClass('d-none');
		
				
		
		

		PreviewDocJournalEntry(docNum, objType, currency);
	});
//Submit
	//Add
	$(document.body).on('click', '#btnAdd', function () 
	{
		
		CheckBatchSerial();
		var err = 0;
        var errmsg = '';

		if($('#txtCardCode').val() == '' ){
			err = 1;
			$('#messageBar2').addClass('d-none');
						$('#messageBar3').removeClass('d-none');
						$('#messageBar').text('Select Business Partner first!').css({'background-color': 'red', 'color': 'white'});
						
							setTimeout(function()
							{
								$('#messageBar').text('').css({'background-color': '', 'color': ''});	
								$('#messageBar2').removeClass('d-none');
							},5000)
		}
		else if($('#tblDetails tbody tr').find('input.itemcode').val() == '' ){
			err = 1;
			$('#messageBar2').addClass('d-none');
						$('#messageBar3').removeClass('d-none');
						$('#messageBar').text('No item!').css({'background-color': 'red', 'color': 'white'});
						
							setTimeout(function()
							{
								$('#messageBar').text('').css({'background-color': '', 'color': ''});	
								$('#messageBar2').removeClass('d-none');
							},5000)
		}
		else if($('#tblDetails tbody tr').find('input.glaccount').val() == '' ){
			err = 1;
			$('#messageBar2').addClass('d-none');
						$('#messageBar3').removeClass('d-none');
						$('#messageBar').text('No GL Account!').css({'background-color': 'red', 'color': 'white'});
						
							setTimeout(function()
							{
								$('#messageBar').text('').css({'background-color': '', 'color': ''});	
								$('#messageBar2').removeClass('d-none');
							},5000)
		}
		else if ($('#txtOwnerCode').val() == ''){
			err = 1;
			$('#messageBar2').addClass('d-none');
						$('#messageBar3').removeClass('d-none');
						$('#messageBar').text('Please select owner!').css({'background-color': 'red', 'color': 'white'});
						
							setTimeout(function()
							{
								$('#messageBar').text('').css({'background-color': '', 'color': ''});	
								$('#messageBar2').removeClass('d-none');
							},5000)
		}
		if(err == 0){
		var udfJson = '{';
		var udfArr = [];
		$('.udfcode').each(function(i) {
			var udfDetails = [];
			if($(this).val() != ''){
				udfDetails.push('"' + $(this).val() + '"');
				udfDetails.push('"' + $(this).attr('id') + '"');
				
				udfArr.push('"' + i + '": [' + udfDetails.join(',') + ']'); 
			}
		});
		udfJson += udfArr.join(",") + '}';
       
		var txtCardCode = $('#txtCardCode').val();
		var txtPostingDate = $('#txtPostingDate').val();
		var txtDeliveryDate = $('#txtDeliveryDate').val();
		var txtDocumentDate = $('#txtDocumentDate').val();
		var txtContactPerson = $('#txtContactPersonCode').val();
		var txtCustomerRefNo = $('#txtCustomerRefNo').val();
	
		var txtSalesEmpCode = $('#txtSalesEmpCode').val();
		var txtOwnerCode = $('#txtOwnerCode').val();
		
		var txtRemarks = $('#txtRemarks').val();

		var selShipToAddress = $('#selShipToAddress').val();

		var selBillToAddress = $('#selBillToAddress').val();
		var txtJournalMemo = $('#txtJournalMemo').val();
		var txtPaymentTermsCode = $('#txtPaymentTermsCode').val();
		var txtTinNumber = $('#txtTinNumber').val();
		var txtControlAccountCode = $('#txtControlAccountCode').val();
		var txtFooterDiscountPercentage = $('#txtFooterDiscountPercentage').val();
		
		//Logistics
		var txtStreetPOBoxS = $('#txtStreetPOBoxS').val();
		var txtCityS = $('#txtCityS').val();
		var txtZipCodeS = $('#txtZipCodeS').val();
		var txtCountryS = $('#txtCountryS').val();

		
		var txtStreetPOBoxB = $('#txtStreetPOBoxB').val();
		var txtCityB = $('#txtCityB').val();
		var txtZipCodeB = $('#txtZipCodeB').val();
		var txtCountryB = $('#txtCountryB').val();
		
		var selShippingType = $('#selShippingType').val();

		var wtLiable = $('input[name=txtWtLiable]').val();
		
		var wtLiableCodeArr = $('input[name=txtWtLiableArray]').val();
		var wtLiableRateArr = $('input[name=txtWtLiableArray2]').val();
		var txtWtLiableAcctCode = $('input[name=txtWtLiableAcctCode]').val();
		let txtDocTotal2 = $('#txtDocTotal2').val();


		var json = '{';
        var otArr = [];
        var tbl = $('#tblDetails tbody tr').each(function (i) 
		{
            x = $(this).children();
            var itArr = [];
			if(serviceType == 'I'){
				if ($(this).find('input.itemcode').val() != ''){
					itArr.push('"' + $(this).find('input.itemcode').val() + '"');
					itArr.push('"' + $(this).find('input.price').val().replace(/,/g, '') + '"');
					itArr.push('"' + $(this).find('input.quantity').val().replace(/,/g, '') + '"')
					itArr.push('"' + $(this).find('input.uomentry').val().replace(/,/g, '') + '"')
					itArr.push('"' + $(this).find('input.discount').val().replace(/,/g, '') + '"');
					itArr.push('"' + $(this).find('select.taxcode').val() + '"');
					
					itArr.push('"' + $(this).find('input.baseentry').val() + '"');
					itArr.push('"' + $(this).find('input.linenum').val() + '"');
					
					itArr.push('"' + $(this).find('input.batchorserialcontainer').val() + '"');
					itArr.push('"' + $(this).find('input.batchorserialquantity').val() + '"');
					itArr.push('"' + $(this).find('input.batchorserialqtycreated').val() + '"');
					itArr.push('"' + $(this).find('input.batchorserialexpdate').val() + '"');
					itArr.push('"' + $(this).find('input.batchorserialmfrdate').val() + '"');
					itArr.push('"' + $(this).find('input.batchorserialadmindate').val() + '"');
					itArr.push('"' + $(this).find('input.batchorseriallocation').val() + '"');
					itArr.push('"' + $(this).find('input.batchorserialdetails').val() + '"');
					itArr.push('"' + $(this).find('input.batchorserialunitcost').val() + '"');
					
					itArr.push('"' + $(this).find('input.whsecode').val() + '"');
					itArr.push('"' + $(this).find('input.batchorserialcontainer2').val() + '"');
					itArr.push('"' + $(this).find('input.batchorserial').val() + '"');
					itArr.push('"' + $(this).find('select.selwt').val().replace(/,/g, '') + '"');
				otArr.push('"' + i + '": [' + itArr.join(',') + ']'); 
				
				}
			}
			else{
				if ($(this).find('input.glaccount').val() != ''){
					itArr.push('"' + $(this).find('input.gldescription').val() + '"');
					itArr.push('"' + $(this).find('input.glaccount').val() + '"');
					itArr.push('"' + $(this).find('input.price').val().replace(/,/g, '') + '"');
					itArr.push('"' + $(this).find('input.quantity').val().replace(/,/g, '') + '"')
					itArr.push('"' + $(this).find('input.discount').val().replace(/,/g, '') + '"');
					itArr.push('"' + $(this).find('select.taxcode').val() + '"');
					itArr.push('"' + $(this).find('select.selwt').val().replace(/,/g, '') + '"');
				
				otArr.push('"' + i + '": [' + itArr.join(',') + ']'); 
				}
			}
		});
		
		json += otArr.join(",") + '}';
		

		var jsonWTax = '{';
        var otArrWTax = [];
        var tbl = $('#tblWTaxTable tbody tr').each(function (i) 
		{
			// wtcode
			// wtname
			// rate
			// baseamount
			// taxableamount
			// wtaxamount
			// glaccountwtax

            x = $(this).children();
            var itArr = [];
				if ($(this).find('input.wtcode').val() != ''){
					itArr.push('"' + $(this).find('input.wtcode').val() + '"');
					itArr.push('"' + $(this).find('input.wtname').val()+ '"');
					itArr.push('"' + $(this).find('input.rate').val().replace(/,/g, '') + '"')
					itArr.push('"' + $(this).find('input.baseamount').val().replace(/,/g, '') + '"')
					itArr.push('"' + $(this).find('input.taxableamount').val().replace(/,/g, '') + '"');
					itArr.push('"' + $(this).find('input.wtaxamount').val().replace(/,/g, '') + '"');
					itArr.push('"' + $(this).find('input.glaccountwtax').val().replace(/,/g, '') + '"');
				
				otArrWTax.push('"' + i + '": [' + itArr.join(',') + ']'); 
				
			
			}
		});
		
		jsonWTax += otArrWTax.join(",") + '}';
		console.log(jsonWTax)


        if (err == 0) 
		{
			$('#loadModal').modal('show');
            $.ajax({
                type: 'POST',
                url: '../proc/exec/exec_add_' + mainFileName + '.php',
				data: 
				{
					json: json.replace(/(\r\n|\n|\r)/gm, '[newline]'),
					jsonWTax: jsonWTax.replace(/(\r\n|\n|\r)/gm, '[newline]'),
					udfJson: udfJson.replace(/(\r\n|\n|\r)/gm, '[newline]'),
					txtCardCode : txtCardCode,
					txtPostingDate : txtPostingDate,
					txtDeliveryDate : txtDeliveryDate,
					txtDocumentDate : txtDocumentDate,
					txtContactPerson : txtContactPerson,
					txtCustomerRefNo : txtCustomerRefNo,
					txtSalesEmpCode : txtSalesEmpCode,
					txtOwnerCode : txtOwnerCode,
					txtRemarks : txtRemarks,
					selShipToAddress : selShipToAddress,
					selBillToAddress : selBillToAddress,
					
					txtJournalMemo : txtJournalMemo,
					txtPaymentTermsCode : txtPaymentTermsCode,
					txtTinNumber : txtTinNumber,
					
					txtFooterDiscountPercentage : txtFooterDiscountPercentage,
					
					
					txtStreetPOBoxS:txtStreetPOBoxS,
					txtCityS:txtCityS,
					txtZipCodeS:txtZipCodeS,
					txtCountryS:txtCountryS,
					txtStreetPOBoxB:txtStreetPOBoxB,
					txtCityB:txtCityB,
					txtZipCodeB:txtZipCodeB,
					txtCountryB:txtCountryB,
					selShippingType:selShippingType,
					
					wtLiableCodeArr : wtLiableCodeArr,
					wtLiableRateArr : wtLiableRateArr,
					txtWtLiableAcctCode : txtWtLiableAcctCode,


					serviceType : serviceType,

					txtDocNum: $('#txtDocNum').val(),
					objectType: objectType,
					refDocToObj: JSON.stringify(getFinalRefDocToObj(origRefDocToArr, refDocToArr)),
					childTable21: childTable21,
					baseType: baseType
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
								
							window.location.replace("../templates/" + mainFileName + "-document.php");
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
		}
    });
//Update	
	$(document.body).on('click', '#btnUpdate', function () 
	{
		var err = 0;
        var errmsg = '';

		if($('#tblDetails tbody tr').find('input.itemcode').val() == '' ){
			err = 1;
			$('#messageBar2').addClass('d-none');
						$('#messageBar3').removeClass('d-none');
						$('#messageBar').text('No item!').css({'background-color': 'red', 'color': 'white'});
						
							setTimeout(function()
							{
								$('#messageBar').text('').css({'background-color': '', 'color': ''});	
								$('#messageBar2').removeClass('d-none');
							},5000)
		}
		else if($('#tblDetails tbody tr').find('input.glaccount').val() == '' ){
			err = 1;
			$('#messageBar2').addClass('d-none');
						$('#messageBar3').removeClass('d-none');
						$('#messageBar').text('No GL Account!').css({'background-color': 'red', 'color': 'white'});
						
							setTimeout(function()
							{
								$('#messageBar').text('').css({'background-color': '', 'color': ''});	
								$('#messageBar2').removeClass('d-none');
							},5000)
		}
		else if ($('#txtOwnerCode').val() == ''){
			err = 1;
			$('#messageBar2').addClass('d-none');
						$('#messageBar3').removeClass('d-none');
						$('#messageBar').text('Please select owner!').css({'background-color': 'red', 'color': 'white'});
						
							setTimeout(function()
							{
								$('#messageBar').text('').css({'background-color': '', 'color': ''});	
								$('#messageBar2').removeClass('d-none');
							},5000)
		}
		if(err == 0){
		var udfJson = '{';
		var udfArr = [];
		$('.udfcode').each(function(i) {

			var udfDetails = [];
			if($(this).val() != ''){
				udfDetails.push('"' + $(this).val() + '"');
				udfDetails.push('"' + $(this).attr('id') + '"');
				
				udfArr.push('"' + i + '": [' + udfDetails.join(',') + ']'); 
			}
		});

		udfJson += udfArr.join(",") + '}';
       
       var txtDocEntry = $('#txtDocEntry').val();
		var txtDocNum = $('#txtDocNum').val();
		var txtCardCode = $('#txtCardCode').val();
		var txtPostingDate = $('#txtPostingDate').val();
		var txtDeliveryDate = $('#txtDeliveryDate').val();
		var txtDocumentDate = $('#txtDocumentDate').val();
		var txtContactPerson = $('#txtContactPersonCode').val();
		var txtCustomerRefNo = $('#txtCustomerRefNo').val();
	
		var txtSalesEmpCode = $('#txtSalesEmpCode').val();
		var txtOwnerCode = $('#txtOwnerCode').val();
		var txtRemarks = $('#txtRemarks').val();
		
		var selShipToAddress = $('#selShipToAddress').val();
		var selBillToAddress = $('#selBillToAddress').val();
		var txtJournalMemo = $('#txtJournalMemo').val();
		var txtPaymentTermsCode = $('#txtPaymentTermsCode').val();
		// var txtCancellationDate = $('#txtCancellationDate').val();
		// var txtRequiredDate = $('#txtRequiredDate').val();
		var txtTinNumber = $('#txtTinNumber').val();
		
		var txtFooterDiscountPercentage = $('#txtFooterDiscountPercentage').val();
		
		//Logistics
		var txtStreetPOBoxS = $('#txtStreetPOBoxS').val();
		var txtCityS = $('#txtCityS').val();
		var txtZipCodeS = $('#txtZipCodeS').val();	
		var txtCountryS = $('#txtCountryS').val();
		var txtStreetPOBoxB = $('#txtStreetPOBoxB').val();
		var txtCityB = $('#txtCityB').val();
		var txtZipCodeB = $('#txtZipCodeB').val();
		var txtCountryB = $('#txtCountryB').val();
		
		var selShippingType = $('#selShippingType').val();
		var jsonDeleteRow = JSON.stringify(otArrLineNum);
		
		
		
		
		
	
		var json = '{';
        var otArr = [];
        var tbl = $('#tblDetails tbody tr').each(function (i) 
		{
            x = $(this).children();
            var itArr = [];
			if(serviceType == 'I'){
				if ($(this).find('input.itemcode').val() != ''){
					itArr.push('"' + $(this).find('input.itemcode').val() + '"');
					itArr.push('"' + $(this).find('input.price').val().replace(/,/g, '') + '"');
					itArr.push('"' + $(this).find('input.quantity').val().replace(/,/g, '') + '"')
					itArr.push('"' + $(this).find('input.uomentry').val().replace(/,/g, '') + '"')
					itArr.push('"' + $(this).find('input.discount').val().replace(/,/g, '') + '"');
					itArr.push('"' + $(this).find('select.taxcode').val() + '"');
				
				otArr.push('"' + i + '": [' + itArr.join(',') + ']'); 
				
				}
			}
			else{
				if ($(this).find('input.glaccount').val() != ''){
					itArr.push('"' + $(this).find('input.gldescription').val() + '"');
					itArr.push('"' + $(this).find('input.glaccount').val() + '"');
					itArr.push('"' + $(this).find('input.price').val().replace(/,/g, '') + '"');
					itArr.push('"' + $(this).find('input.quantity').val().replace(/,/g, '') + '"')
					itArr.push('"' + $(this).find('input.discount').val().replace(/,/g, '') + '"');
					itArr.push('"' + $(this).find('select.taxcode').val() + '"');
				
				otArr.push('"' + i + '": [' + itArr.join(',') + ']'); 
				}
			}
		});
		
		json += otArr.join(",") + '}';
		
	
        if (err == 0) 
		{
			
			
			$('#loadModal').modal('show');
            $.ajax({
                type: 'POST',
                url: '../proc/exec/exec_update_' + mainFileName + '.php',
				data: 
				{
					json: json.replace(/(\r\n|\n|\r)/gm, '[newline]'),
					udfJson: udfJson.replace(/(\r\n|\n|\r)/gm, '[newline]'),
					jsonDeleteRow : jsonDeleteRow,
					txtDocEntry:txtDocEntry,
					txtDocNum : txtDocNum,
					txtCardCode : txtCardCode,
					txtPostingDate : txtPostingDate,
					txtDeliveryDate : txtDeliveryDate,
					txtDocumentDate : txtDocumentDate,
					txtContactPerson : txtContactPerson,
					txtCustomerRefNo : txtCustomerRefNo,
					txtSalesEmpCode : txtSalesEmpCode,
					txtOwnerCode : txtOwnerCode,
					txtRemarks : txtRemarks,
					selShipToAddress : selShipToAddress,
					selBillToAddress : selBillToAddress,
					
					txtJournalMemo : txtJournalMemo,
					txtPaymentTermsCode : txtPaymentTermsCode,
					// txtCancellationDate : txtCancellationDate,
					// txtRequiredDate : txtRequiredDate,
					txtTinNumber : txtTinNumber,
					
					txtFooterDiscountPercentage : txtFooterDiscountPercentage,
					
					
					txtStreetPOBoxS:txtStreetPOBoxS,
					txtCityS:txtCityS,
					txtZipCodeS:txtZipCodeS,
					txtCountryS:txtCountryS,
					txtStreetPOBoxB:txtStreetPOBoxB,
					txtCityB:txtCityB,
					txtZipCodeB:txtZipCodeB,
					txtCountryB:txtCountryB,
					selShippingType:selShippingType,
					
					serviceType : serviceType,

					objectType: objectType,
					refDocToObj: JSON.stringify(getFinalRefDocToObj(origRefDocToArr, refDocToArr)),
					childTable21: childTable21
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
								
							window.location.replace("../templates/" + mainFileName + "-document.php");
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
		}
    });
	
	
/*Keyups*/
//Rows
	//Taxable Amount fro WTAX
	$(document.body).on('blur', '.taxableamount', function () 
	{
		ComputeWtaxPerRow();
		$(this).val(function(index, value) {
			value = value.replace(/,/g,'');
			return NumberWithCommas(value);
		});
	});
	//Taxable Amount fro WTAX
	$(document.body).on('blur', '.taxableamount', function () 
	{
		ComputeWtaxPerRow();
		$(this).val(function(index, value) {
			value = value.replace(/,/g,'');
			return NumberWithCommas(value);
		});
	});
	//WTaxable Amount fro WTAX
	$(document.body).on('blur', '.wtaxamount', function () 
	{

		
		$(this).val(function(index, value) {
			value = value.replace(/,/g,'');
			return FormatMoney(NumberWithCommas(value));
		});
		ComputeWtaxPerRowToFooter();
	});
	//Price
	$(document.body).on('keyup', '.price', function (e) 
	{
		
	
		
		
		
		
	});
	$(document.body).on('blur', '.price', function () 
	{
		let amount = $('.selected-det').find('input.price').val();
		$('.selected-det').find('input.price').val(FormatMoney(amount));
			CheckItemCode();
		let value = $(this).val();
		let price = $('.selected-det').find('input.price').val();
		let quantity = $('.selected-det').find('input.quantity').val();
		let discount = $('.selected-det').find('input.discount').val();
		let taxrate = $('.selected-det').find('option:selected').attr('val-rate');
			$(this).val(function(index, value) {
			value = value.replace(/,/g,'');
			return NumberWithCommas(value);
		});
		
		$('.selected-det').find('input.rowtotal').val(ComputeRowTotal(price,quantity,discount));
		ComputeRowGrossPrice();
		ComputeGrossTotal();
		
		ComputeFooterTotalBeforeDiscount();
		ComputeRowTaxAmount();
		ComputeFooterTaxAmount();
		ComputeTotal();

		$('txtFooterDiscountPercentage').trigger('blur');
		
	});
	//Quantity
	$(document.body).on('keyup', '.quantity', function (e) 
	{
		
		CheckItemCode();
		let price = $('.selected-det').find('input.price').val();
		let quantity = $('.selected-det').find('input.quantity').val();
		let discount = $('.selected-det').find('input.discount').val();
		let taxrate = $('.selected-det').find('option:selected').attr('val-rate');
		$('.selected-det').find('input.rowtotal').val(ComputeRowTotal(price,quantity,discount));
		ComputeRowGrossPrice();
		ComputeGrossTotal();
		ComputeFooterTotalBeforeDiscount();
		ComputeRowTaxAmount();
		ComputeFooterTaxAmount();
		ComputeTotal();
		
		$('txtFooterDiscountPercentage').trigger('blur');
		
	});
	$(document.body).on('blur', '.quantity', function () 
	{
		let amount = $('.selected-det').find('input.quantity').val();
		$('.selected-det').find('input.quantity').val(FormatQuantity(amount));
		
	});
	//Discount
	$(document.body).on('keyup', '.discount', function (e) 
	{
		CheckItemCode();
		if ($(this).val() > 100 
        && e.keyCode !== 46 // keycode for delete
        && e.keyCode !== 8 // keycode for backspace
		) {
		   e.preventDefault();
		   $(this).val(100);
		}
		let price = $('.selected-det').find('input.price').val();
		let quantity = $('.selected-det').find('input.quantity').val();
		let discount = $('.selected-det').find('input.discount').val();
		let taxrate = $('.selected-det').find('option:selected').attr('val-rate');
	
		$('.selected-det').find('input.rowtotal').val(ComputeRowTotal(price,quantity,discount));
		ComputeRowGrossPrice();
		ComputeGrossTotal();
		ComputeFooterTotalBeforeDiscount();
		ComputeRowTaxAmount();
		ComputeFooterTaxAmount();
		ComputeTotal();
		
		$('txtFooterDiscountPercentage').trigger('blur');
		
	});
	$(document.body).on('keyup', '.unitcost', function () 
	{
		$(this).val(function(index, value) {
			value = value.replace(/,/g,'');
			return NumberWithCommas(value);
		});
		
	});
	$(document.body).on('blur', '.unitcost', function () 
	{
		let amount = $(this).closest('tr').find('input.unitcost').val();
		$(this).closest('tr').find('input.unitcost').val(FormatMoney(amount));
		
	});
	$(document.body).on('blur', '.discount', function () 
	{
		let amount = $('.selected-det').find('input.discount').val();
		$('.selected-det').find('input.discount').val(FormatMoney(amount));
		
	});
	//Tax
	$(document.body).on('change','.taxcode',function()
	{
		
		let taxrate = $(this).find('option:selected').attr('val-rate');
		let total = $('.selected-det').find('input.rowtotal').val();
		let amount;
		if(taxrate != 0.00){
			amount = parseFloat((taxrate / 100) * total);
		
		}
		else{
			amount = 0.00;
		}
		$('.selected-det').find('input.taxcode').attr('val-rate',FormatMoney(taxrate));
		$('.selected-det').find('input.taxamount').val(FormatMoney(amount));
		
		ComputeRowGrossPrice();
		ComputeGrossTotal();
		
		ComputeTotal();
		ComputeRowTaxAmount();
		ComputeFooterTaxAmount();
		$('txtFooterDiscountPercentage').trigger('blur');
		
		
	})
	

//Footer
	$(document.body).on('keyup', '#txtFooterDiscountSum', function (e) 
	{
		let value = $(this).val();
		let discAmount = $(this).val();
		let totalBeforeDiscount = $('#txtTotalBeforeDiscount').val();
		let amount = parseFloat(discAmount/totalBeforeDiscount) * 100;
			$(this).val(function(index, value) {
			value = value.replace(/,/g,'');
			return NumberWithCommas(value);
		});
		
		ComputeTotal();
		
	});	
	$(document.body).on('blur', '#txtFooterDiscountSum', function (e) 
	{
		let amount = $(this).val();
		let discAmount = $(this).val();
		let totalBeforeDiscount = $('#txtTotalBeforeDiscount').val();
		$(this).val(FormatMoney(amount));
		ComputeDiscountPercentageFooter(discAmount,totalBeforeDiscount);
	});	
	$(document.body).on('keyup', '#txtFooterDiscountPercentage', function (e) 
	{
		if ($(this).val() > 100 
        && e.keyCode !== 46 // keycode for delete
        && e.keyCode !== 8 // keycode for backspace
		) {
		   e.preventDefault();
		   $(this).val(100);
		}
		let discPercentage = $(this).val();
		let totalBeforeDiscount = $('#txtTotalBeforeDiscount').val();
		let amount = parseFloat(discPercentage/100) * parseFloat(totalBeforeDiscount.replace(',', ''));
		$('#txtFooterDiscountSum').val(FormatMoney(amount));
		ComputeTotal();
		
	});	
	$(document.body).on('blur', '#txtFooterDiscountPercentage', function (e) 
	{
		let amount = $(this).val();
		let discPercentage = $(this).val();
		let totalBeforeDiscount = $('#txtTotalBeforeDiscount').val();
		$(this).val(FormatMoney(amount));
		ComputeDiscountAmountFooter(discPercentage,totalBeforeDiscount);
	});	
/*Batches*/
	$(document.body).on('input', '.batch', function () 
	{
		$('#btnOkBatch').addClass('d-none');
		$('#btnUpdateBatch').removeClass('d-none');
	});
	$(document.body).on('input', '.mfrserial', function () 
	{
		$('#btnOkSerial').addClass('d-none');
		$('#btnUpdateSerial').removeClass('d-none');
		
	
	});
	
	$(document.body).on('keyup', '.mfrserial', function () 
	{
		let that = $(this);
		let duplicate = $(this).val();
		let currentRowno = $(this).parents('tr').find('td.rowno span').text();
		$('#btnUpdateSerial').removeClass('d-none');
		$(this).css('border', '0px solid red');
		
		if(uniqueSerial == '.mfrserial'){
		 $('#tblSerialCreated tbody tr').each(function(i) {
				let mfrSerial = $(this).find('input.mfrserial').val();
				let rowNo = $(this).find('td.rowno span').text();
				let hasFocus = $('.mfrserial').is(':focus');
				
				if(mfrSerial == duplicate && rowNo != currentRowno){
					
					that.css('border', '1px solid red');
					$('#btnUpdateSerial').prop('disabled',true);
					
					$('#messageBar2').addClass('d-none');
					$('#messageBar3').removeClass('d-none');
					$('#messageBar').text(duplicate + ' already exists in this table!').css({'background-color': 'red', 'color': 'white'});
					
					$('#btnUpdateSerial').addClass('d-none');
					//$('#btnUpdateSerial').removeClass('d-none');
					
						setTimeout(function()
						{
							$('#messageBar').text('').css({'background-color': '', 'color': ''});	
							$('#messageBar2').removeClass('d-none');
						},5000)
					
					
				}
				else{
					$('#btnUpdateSerial').prop('disabled',false);
				}
		});
		}
	});
	$(document.body).on('keyup', '.serial', function () 
	{
		let that = $(this);
		let duplicate = $(this).val();
		let currentRowno = $(this).parents('tr').find('td.rowno span').text();
		$('#btnUpdateSerial').removeClass('d-none');
		$(this).css('border', '0px solid red');
		
		if(uniqueSerial == '.serial'){
		 $('#tblSerialCreated tbody tr').each(function(i) {
				let serial = $(this).find('input.serial').val();
				let rowNo = $(this).find('td.rowno span').text();
			
				if(serial == duplicate && rowNo != currentRowno){
					
					that.css('border', '1px solid red');
					$('#btnUpdateSerial').prop('disabled',true);
					
					$('#messageBar2').addClass('d-none');
					$('#messageBar3').removeClass('d-none');
					$('#messageBar').text(duplicate + ' already exists in this table!').css({'background-color': 'red', 'color': 'white'});
					
					$('#btnUpdateSerial').addClass('d-none');
					//$('#btnUpdateSerial').removeClass('d-none');
					
						setTimeout(function()
						{
							$('#messageBar').text('').css({'background-color': '', 'color': ''});	
							$('#messageBar2').removeClass('d-none');
						},5000)
					
					
				}
				else{
					$('#btnUpdateSerial').prop('disabled',false);
			}
							
		});
		}
	});
/*Logistics Tab*/
//Address
	$(document.body).on('keyup', '.shipInputs', function (e) 
	{
		$('#btnShipToAddressOk').addClass('d-none');
		$('#btnShipToAddressUpdate').removeClass('d-none');
	});
	$(document.body).on('keyup', '.billInputs', function (e) 
	{
		$('#btnBillToAddressOk').addClass('d-none');
		$('#btnBillToAddressUpdate').removeClass('d-none');
	});

	$(document.body).on('click', '#btnShipToAddressUpdate', function (e) 
	{
		let addressArr = [];
		let txtStreetPOBoxS = $('#txtStreetPOBoxS').val();
		addressArr.push(txtStreetPOBoxS);
		let txtStreetNoS = $('#txtStreetNoS').val();
		addressArr.push(txtStreetNoS);
		let txtBlockS = $('#txtBlockS').val();
		addressArr.push(txtBlockS);
		let txtCityS = $('#txtCityS').val();
		addressArr.push(txtCityS);
		let txtZipCodeS = $('#txtZipCodeS').val();
		addressArr.push(txtZipCodeS);
		let txtCountyS = $('#txtCountyS').val();
		addressArr.push(txtCountyS);
		let txtStateName = $('#txtStateSName').val();
		addressArr.push(txtStateName);
		let txtStateS = $('#txtStateS').val();
		addressArr.push(txtStateS);
		let txtCountrySName = $('#txtCountrySName').val();
		addressArr.push(txtCountrySName);
		let txtCountryS = $('#txtCountryS').val();
		addressArr.push(txtCountryS);
		let txtBuildingS = $('#txtBuildingS').val();
		addressArr.push(txtBuildingS);
		let txtAddress2S = $('#txtAddress2S').val();
		addressArr.push(txtAddress2S);
		let txtAddress3S = $('#txtAddress3S').val();
		addressArr.push(txtAddress3S);
		let txtGLNS = $('#txtGLNS').val();
		addressArr.push(txtGLNS);

		$('#txtShipToAddressTextArea').val(`/ ${txtStreetPOBoxS.toUpperCase()}\n${txtCityS.toUpperCase()} ${txtStateS.toUpperCase()} ${txtZipCodeS}\n${txtCountrySName.toUpperCase()}`);
		
		let dataObj = JSON.parse($('#txtShipArr').val());
		
		let i = 0;
		for (prop in dataObj) {
			if (dataObj[prop].toLowerCase() !== addressArr[i].toLowerCase()){
				dataObj[prop] = addressArr[i];
			}
			i++;
		}

		let dataStr = JSON.stringify(dataObj);
		$('#txtShipArr').val(dataStr);
		
	});

	$(document.body).on('click', '#btnBillToAddressUpdate', function (e) 
	{
		let txtStreetPOBoxB = $('#txtStreetPOBoxB').val();
		let txtStreetNoB = $('#txtStreetNoB').val();
		let txtBlockB = $('#txtBlockB').val();
		let txtCityB = $('#txtCityB').val();
		let txtZipCodeB = $('#txtZipCodeB').val();
		let txtCountyB = $('#txtCountyB').val();
		let txtStateB = $('#txtStateB').val();
		let txtCountryB = $('#txtCountryB').val();
		let txtCountryBName = $('#txtCountryBName').val();
		let txtBuildingB = $('#txtBuildingB').val();
		
		$('#txtBillToAddressTextArea').val(txtStreetPOBoxB + '\n' + '\n' + txtZipCodeB + ' ' + txtCityB + '\n'  + txtCountryBName);
		
		let billArr2 = [];	
		let billList2;
							billArr2.push(txtStreetPOBoxB);
							billArr2.push(txtStreetNoB);
							billArr2.push(txtBlockB);
							billArr2.push(txtZipCodeB);
							billArr2.push(txtCityB);
							billArr2.push(txtCountyB);
							billArr2.push(txtStateB);
							billArr2.push(txtCountryBName);
							billArr2.push(txtBuildingB);
							billArr2.push(txtCountryB);
							
			setTimeout(function () {
				billList2 = billArr2;	
				$('#txtBillArr2').val(billList2);			
			
				}, 100) 
	});

	/*Batch/Serial Validation and Info messages*/
	$(document.body).on('click', '#tblDetails tbody tr .btn-disabled', function(){
		let batchOrSerial = $('#tblDetails tbody tr').find('input.batchorserial').val();
		if (batchOrSerial == '-B' || batchOrSerial == '-S') {
			$('#messageBar2').addClass('d-none');
			$('#messageBar3').removeClass('d-none');
			$('#messageBar').text('Serial/Batch report can be viewed from base document only.').css({'background-color': 'lightblue', 'color': 'black'});
			
			setTimeout(function()
			{
				$('#messageBar').text('').css({'background-color': '', 'color': ''});	
				$('#messageBar2').removeClass('d-none');
			},5000)
		}
	})


    /*For Referenced Document Modal*/

    let currentRowNo, transactType, lastRowNo, isRefDocModalSetup = false;

    loadRefDocModal();

	$(document.body).on('click', '#tbldocRefTo tbody tr', function ()
    {
    	$('#tbldocRefTo tbody tr').each(function () 
		{
			$(this).removeClass('selected-row');
		});

    	currentRowNo = $(this).find('td.rowNo span').text();
    	transactType = $(this).find('td .txtTransactType').val();

		$(this).addClass('selected-row');

    });

	$(document.body).on('click', '.btnRefDocNum', function ()
    {
    	transactType = $(this).parent().parent().parent().children().find('div .txtTransactType').val();
		$('#transactTypeName').html(transactType);
		$.ajax({
			type: 'POST',
			url: '../proc/views/vw_getTransactTypeDocList.php',
			data: {
				transactType: tableNameToObj(objTables, transactType).objectTable,
				docNum: $('#txtDocNum').val()
			},
			success: function (html) 
			{
				if ($.fn.DataTable.isDataTable('#tblDocNum')) {
				 	$('#tblDocNum').DataTable().clear().destroy();
				}
				
				$('#tbodyDocNum').empty();

				$('#tblDocNum tbody').append(html);
				
				$('#tblDocNum').dataTable({"bLengthChange": false,});
			}
		});
    });

	$(document.body).on('dblclick', '#tblTransactType tbody > tr', function () 
	{	
		
		transactType = $(this).children().text();
	    $('#transactTypeModal').modal('hide');

		$('.selected-row td.rowNo, .selected-row .txtTransactType, .selected-row .txtRefDocExtDocNum, .selected-row .txtRefDocDate, .selected-row .txtRefDocRemarks').removeClass('text-primary');

		if (transactType == 'External Document') {
			$('.selected-row td.rowNo, .selected-row .txtTransactType, .selected-row .txtRefDocExtDocNum, .selected-row .txtRefDocDate, .selected-row .txtRefDocRemarks').addClass('text-primary');
			$('.selected-row .txtRefDocExtDocNum, .selected-row .txtRefDocDate, .selected-row .txtRefDocRemarks').removeAttr('disabled');
			$('.selected-row .btnRefDocDate').removeClass('d-none');
			$('.selected-row .txtRefDocNum').val('');
			$('.selected-row .btnRefDocNum').attr('disabled', true);
			$('.selected-row .txtRefDocDate').val('');
			$('.selected-row .txtRefDocRemarks').val('');
		} else {
			$('.selected-row .txtRefDocExtDocNum, .selected-row .txtRefDocDate, .selected-row .txtRefDocRemarks').attr('disabled', true);
			$('.selected-row .btnRefDocDate').addClass('d-none');
			$('.selected-row .txtRefDocNum').val('');
			$('.selected-row .btnRefDocNum').removeAttr('disabled');
			$('.selected-row .txtRefDocDate').val('');
			$('.selected-row .txtRefDocRemarks').val('');
		}

		$('.selected-row .txtTransactType').val(transactType);
		$('.selected-row .btnRowRefDocTo').removeClass('d-none');

		lastRowNo = $('#tbldocRefTo tbody tr:last').find('td.rowNo span').text();

		if (currentRowNo == lastRowNo){
			$('#rowLoader').load('../templates/' + mainFileName + '-doc-referenced-to.php?rowNo=' + lastRowNo, function (result) 
				{
					$('#tbldocRefTo tbody').append(result);
				}
			);
		}
    });

    $(document.body).on('dblclick', '#tblDocNum tbody > tr', function () 
	{
        $('#docNumModal').modal('hide');
        let transactType = $('.selected-row .txtTransactType').val();
        let docNum = $(this).children('.docNum').text();
        let currentLineNum = $('.selected-row td.rowNo span').text();
        let lineNum = hasDuplicateDoc(transactType, docNum, parseInt(currentLineNum))
        if (lineNum) {
        	portalMessage('Document ' + transactType + ' ' + docNum + ' is already selected in line ' + lineNum + '.', 'red', 'white');
        	$('.selected-row .txtRefDocNum').val('');
			$('.selected-row .txtRefDocDate').val('');
			$('.selected-row .txtRefDocRemarks').attr('disabled', true);
        } else {
        	$('.selected-row .txtRefDocNum').val($(this).children('.docNum').text());
			$('.selected-row .txtRefDocDate').val(SAPDateFormater($(this).children('.docDate').text()).value);
			$('.selected-row .txtRefDocRemarks').removeAttr('disabled');
        }
    });

	$(document.body).on('click', '.deleteRefDocTorow', function () 
	{

		$('.selected-row').remove();
		
		let rowNo = 1;
		$('#tbldocRefTo tbody tr').each(function () 
		{
			$(this).find('td.rowNo span').text(rowNo);
			rowNo += 1;
		});
	});

	$(document.body).on('click focus change keyup blur', '#tbldocRefTo, #tbldocRefTo tbody tr input.refDocToInput', function () 
	{
        if (!compareArrayOfObj(refDocToArr, getCurrentRefDocArray())) {
        	if (!$('#btnRefDocOk').hasClass('d-none')){
        		$('#btnRefDocOk').addClass('d-none');
	        	$('#btnRefDocUpdate').removeClass('d-none');
        	}
        } else {
        	if (!$('#btnRefDocUpdate').hasClass('d-none')){
        		$('#btnRefDocOk').removeClass('d-none');
        		$('#btnRefDocUpdate').addClass('d-none');
        	}
        }
    });

    $(document.body).on('click', '#btnRefDocUpdate', function () 
	{
		let dataObj = hasDuplicateExtDoc();
		if (dataObj.bool) {		
			portalMessage(dataObj.message, 'red', 'white');
			return false;
		}

		dataObj = hasMissingRequiredData();

		if (dataObj.bool) {
			portalMessage(dataObj.message, 'red', 'white');
		} else {
			refDocToArr = getCurrentRefDocArray();
			refDocToArr.length > 0 ? $('#txtNoOfRefDocTo').html(`(${refDocToArr.length})`) : $('#txtNoOfRefDocTo').html('');
			$('#btnRefDocOk').removeClass('d-none');
	        $('#btnRefDocUpdate').addClass('d-none');
	        $('#refDocModal').modal('hide');
		}
	});

	$(document.body).on('click', '#btnRefDocCancel, #btnCloseRefDocModal', function ()  {
		
	    if (!compareArrayOfObj(refDocToArr, getCurrentRefDocArray())) {

	    	setTimeout(function(){
	    		$('#tbodyStateS').empty();
				loadRefDocModal();

		    	let dataObj = refDocToArr;

		    	dataObj.length > 0 ? $('#txtNoOfRefDocTo').html(`(${dataObj.length})`) : $('#txtNoOfRefDocTo').html('');

				if (dataObj.length > 0) {
					for (var i = 0; i < dataObj.length; i++) {
						lastRowNo = i + 1
						$('#rowLoader').load('../templates/' + mainFileName + '-doc-referenced-to.php?rowNo=' + lastRowNo, function (result) 
							{
								$('#tbldocRefTo tbody').append(result);
							}
						);
					}
					setTimeout(function(){
						$('#tbldocRefTo tbody').find('tr').each(function(index) 
						{
							if (dataObj[index].RefTable == 'External Document') {
								$(this).find('td.rowNo, .txtTransactType, .txtRefDocExtDocNum, .txtRefDocDate, .txtRefDocRemarks').addClass('text-primary');
								$(this).find('.txtTransactType').val(dataObj[index].RefTable);
								$(this).find('.txtRefDocNum').val('');
								$(this).find('.btnRefDocNum').attr('disabled', true);
								$(this).find('.txtRefDocExtDocNum').val(dataObj[index].ExtDocNum);
								$(this).find('.txtRefDocDate').val(SAPDateFormater(dataObj[index].IssueDate).value);
								$(this).find('.txtRefDocDate').removeAttr('disabled');
								$(this).find('.txtRefDocExtDocNum').removeAttr('disabled');
								$(this).find('.btnRefDocDate').removeClass('d-none');
								$(this).find('.txtRefDocRemarks').val(dataObj[index].Remark);
								$(this).find('.txtRefDocRemarks').removeAttr('disabled');
								$(this).find('.btnRowRefDocTo').removeClass('d-none');
							} else {
								$(this).find('.txtTransactType').val(dataObj[index].RefTable);
								$(this).find('.txtRefDocNum').val(dataObj[index].RefDocNum);
								$(this).find('.btnRefDocNum').removeAttr('disabled');
								$(this).find('.txtRefDocExtDocNum').val(dataObj[index].ExtDocNum);
								$(this).find('.txtRefDocDate').val(SAPDateFormater(dataObj[index].IssueDate).value);
								$(this).find('.txtRefDocRemarks').val(dataObj[index].Remark);
								$(this).find('.txtRefDocRemarks').removeAttr('disabled');
								$(this).find('.btnRowRefDocTo').removeClass('d-none');
							}
							if (dataObj.length == index + 1) {
								return false;
							}
						});
					}, 200);
				}
	    	}, 200);
	    }
	    $('#btnRefDocOk').removeClass('d-none');
	    $('#btnRefDocUpdate').addClass('d-none');
	});

	$(document.body).on('keyup change', 'input.txtRefDocRemarks, input.btnRefDocDate, input.txtRefDocDate', function () 
	{
		let dataObj = hasDuplicateExtDoc($('.selected-row td.rowNo span').text());
		if (dataObj.bool) {		
			portalMessage(dataObj.message, 'red', 'white');
		}	
	});

	$(document.body).on('blur', 'input.txtRefDocDate', function () 
	{
		let dataObj = hasDuplicateExtDoc($('.selected-row td.rowNo span').text());
		if (dataObj.bool) {		
			portalMessage(dataObj.message, 'red', 'white');
		}	
	});

	/*****Formatting Date Fields*****/
	$(document.body).on('change', 'input.dateType', function () 
	{
		if ($(this).val() == '')
			return false;

		let currentVal = $(this).val();

		let dateObj = SAPDateFormater($(this).val(), true);
		if (dateObj.bool) {
			$(this).val(dateObj.value);
		} else {
			$(this).val('');
			portalMessage(dateObj.error, 'red', 'white');
		}
		
	});

//------------------------------------------------------------------------------------------------------------------------------------------------------------------		
/*Functions --------------------------------------------------------------------------------------------------------------------------------------------------------*/
//------------------------------------------------------------------------------------------------------------------------------------------------------------------		
	function AddRow(){
		
		var rowno = 0;
			rowno = ($('#tblDetails tbody tr:last').find('td.rowno span').text() == '') ? 1 : parseFloat($('#tblDetails tbody tr:last').find('td.rowno span').text()) + 1;
		var lastItem = $('#tblDetails tbody tr:last').find('input.itemcode').val()
		var wtliableyesorno = $('#txtWTliableBP').val();
		if(lastItem != ""){
		setTimeout(function () 
			{
					
						$('#rowLoader').load('../templates/' + mainFileName + '-lines-row.php?serviceType=' + serviceType, function (result) 
						{
							$('#tblDetails tbody').append(result);

							$('#tblDetails tbody tr:last').find('td.rowno span').text(rowno);
							$('#tblDetails tbody tr:last').find('td select.selwt').val(wtliableyesorno);
						})
			
							$(this).prop('disabled', false);
					
					
			}, 200)
		}
	}

	function AddRowBatch(){
		
		var rowno = 0;
			rowno = ($('#tblBatchCreated tbody tr:last').find('td.rowno span').text() == '') ? 1 : parseFloat($('#tblBatchCreated tbody tr:last').find('td.rowno span').text()) + 1;
		var lastItem = $('#tblBatchCreated tbody tr:last').find('input.batch').val()
		
		if(lastItem != ""){
		setTimeout(function () 
			{
					
						$('#rowLoader').load('../templates/' + mainFileName + '-batch-creation-lines.php', function (result) 
						{
							$('#tblBatchCreated tbody').append(result);

							$('#tblBatchCreated tbody tr:last').find('td.rowno span').text(rowno);
						})
			
							$(this).prop('disabled', false);
					
					
			}, 200)
		}
	}
	function AddRowSerial(){
		
		var rowno = 0;
			rowno = ($('#tblSerialCreated tbody tr:last').find('td.rowno span').text() == '') ? 1 : parseFloat($('#tblSerialCreated tbody tr:last').find('td.rowno span').text()) + 1;
		var lastItem = $('#tblSerialCreated tbody tr:last').find('input.batch').val()
		
		if(lastItem != ""){
		setTimeout(function () 
			{
					
						$('#rowLoader').load('../templates/' + mainFileName + '-serial-creation-lines.php', function (result) 
						{
							$('#tblSerialCreated tbody').append(result);

							$('#tblSerialCreated tbody tr:last').find('td.rowno span').text(rowno);
						})
			
							$(this).prop('disabled', false);
					
					
			}, 200)
		}
	}
	function AddRowBatchViewing(){
		
		var rowno = 0;
			rowno = ($('#tblBatchCreated tbody tr:last').find('td.rowno span').text() == '') ? 1 : parseFloat($('#tblBatchCreated tbody tr:last').find('td.rowno span').text()) + 1;
		var lastItem = $('#tblBatchCreated tbody tr:last').find('input.batch').val()
		
		setTimeout(function () 
			{
					
						$('#rowLoader').load('../templates/' + mainFileName + '-batch-creation-lines.php', function (result) 
						{
							$('#tblBatchCreated tbody').append(result);

							$('#tblBatchCreated tbody tr:last').find('td.rowno span').text(rowno);
						})
			
							$(this).prop('disabled', false);
					
					
			}, 200)
		
	}
	function AddRowSerialViewing(){
		
		var rowno = 0;
			rowno = ($('#tblSerialCreated tbody tr:last').find('td.rowno span').text() == '') ? 1 : parseFloat($('#tblSerialCreated tbody tr:last').find('td.rowno span').text()) + 1;
		var lastItem = $('#tblSerialCreated tbody tr:last').find('input.batch').val()
		
		setTimeout(function () 
			{
					
						$('#rowLoader').load('../templates/' + mainFileName + '-serial-creation-lines.php', function (result) 
						{
							$('#tblSerialCreated tbody').append(result);

							$('#tblSerialCreated tbody tr:last').find('td.rowno span').text(rowno);
						})
			
							$(this).prop('disabled', false);
					
					
			}, 200)
		
	}
	function AddRowWTax(){
		
		var rowno = 0;
			rowno = ($('#tblWTaxTable tbody tr:last').find('td.rowno span').text() == '') ? 1 : parseFloat($('#tblWTaxTable tbody tr:last').find('td.rowno span').text()) + 1;
		var lastItem = $('#tblWTaxTable tbody tr:last').find('input.wtcode').val()
		
		if(lastItem != ""){
		setTimeout(function () 
			{
					
						$('#rowLoader').load('../templates/wtaxtable-lines-rows.php', function (result) 
						{
							$('#tblWTaxTable tbody').append(result);

							$('#tblWTaxTable tbody tr:last').find('td.rowno span').text(rowno);
						})
			
							$(this).prop('disabled', false);
					
					
			}, 200)
		}
	}
	function PreviewDoc(docNum, objType){
		let docstatus = '';
		let docType ='';
		let docNumBuff;
		let table;

		if(objType == objectType){
			$('#btnAdd').addClass('d-none');
			//$('#btnOk').removeClass('d-none');
			$('#btnUpdate').removeClass('d-none');
			$('#btnCopyFrom').prop('disabled',true);
		}
		else{
			$('#btnAdd').removeClass('d-none');
			//$('#btnOk').addClass('d-none');
			$('#btnUpdate').addClass('d-none');
		}
        
		let trnspCode;
		$.getJSON('../proc/views/vw_getheaderdata.php?docNum=' + docNum + '&objType=' + objType, function (data){

            $.each(data, function (key, val){
				docType = val.DocType;
				docstatus = val.DocStatusFullText;
				//$('#txtDocNum').val(val.DocNum);
				trnspCode = val.TrnspCode;
				
				$('#txtCurrency').val(val.DocCur);
				
				if(objType == objectType){
					$('#txtCardCode').val(val.CardCode);
					$('#txtCardName').val(val.CardName);
					$('#txtDocNum').val(val.DocNum);
					$('#txtDocEntry').val(val.DocEntry);
					docNumBuff = val.DocNum;
				}
				else{
				//$('#txtDocNum').val("");
				}
				
				$('#txtStatus').val(val.DocStatusFullText);
				$('#txtCustomerRefNo').val(val.NumAtCard);
				$('#txtContactPersonCode').val(val.CntctCode);
				$('#txtContactPerson').val(val.ContactPerson);
				$('#selTransactionType').val(val.DocType);
				$('#txtWTaxF').val(val.WTSum);
				
				$('#txtPostingDate').val(val.DocDate);
				$('#txtDeliveryDate').val(val.DocDueDate);
				$('#txtDocumentDate').val(val.TaxDate);
				// val.CancelDate ? $('#txtCancellationDate').attr('type', 'date') : $('#txtCancellationDate').attr('type', 'text');
				// $('#txtCancellationDate').val(val.CancelDate);
				// $('#txtRequiredDate').val(val.ReqDate);
				if(objType == objectType){
					$('#txtFooterDiscountSum').val(val.DiscSum);
					$('#txtFooterDiscountPercentage').val(val.DiscPrcnt);
					$('#txtTotalBeforeDiscount').val(val.TotalBeforeDisc);
					$('#txtVatSum').val(val.VatSum);
					$('#txtDocTotal').val(val.DocCur + ' ' + val.DocTotal);
					$('#txtPaidToDate').val(val.PaidToDate != '0.00' ? val.DocCur + ' ' + val.PaidToDate : val.PaidToDate);
				}

				
				$('#txtBalancedDue').val(val.BalancedDue != '0.00' ? val.DocCur + ' ' + val.BalancedDue : val.BalancedDue);
				
				$('#txtSalesEmpCode').val(val.SlpCode);
				$('#txtSalesEmpName').val(val.SlpName);
				
				$('#txtOwnerCode').val(val.EmpID);
				$('#txtOwnerName').val(val.EmployeeName);
				if(objType == objectType){
					$('#txtRemarks').val(val.Comments);
					
					$('#txtJournalMemo').val(val.JrnlMemo);
					$('#txtPaymentTermsCode').val(val.GroupNum);
					$('#txtPaymentTermsName').val(val.PymntGroup);
					
					$('#txtTinNumber').val(val.LicTradNum);
					$('#selShipToAddress').val(val.ShipToCode);
					
					let cardCode = val.CardCode;
					$.ajax({
						type: 'GET',
						url: '../proc/views/vw_shipToAddressID.php',
						data: {cardCode : cardCode},
						success: function (html) 
						{
							$('#selShipToAddress').html(html);
							
						}
					});
					$.ajax({
						type: 'GET',
						url: '../proc/views/vw_billToAddressID.php',
						data: {cardCode : cardCode},
						success: function (html) 
						{
							
							$('#selBillToAddress').html(html);
							
						}
					});

					$.ajax({
						type: 'GET',
						url: '../proc/views/vw_shippingType.php',
						data: {cardCode : cardCode},
						success: function (html) 
						{
							
							$('#selShippingType').html(html);
						}
					}); 
					
					setTimeout(function () 
					{
						
						val.ShipToCode !== null ? $('#selShipToAddress').val(val.ShipToCode) : '';
						$('#selShipToAddress').trigger('change');
						$('#lnkCardCode').removeClass('d-none');
						$('#lnkContactPerson').removeClass('d-none');
						
						// $('#btnShipToDetails').removeClass('d-none');
						// $('#btnBillToDetails').removeClass('d-none');
						
						$('#txtCardCode').css({'background-color': '', 'border-radius': '0px'});
						$('#txtCardName').css('background-color', '');
						$('#txtContactPerson').css({'background-color': '', 'border-radius': '0px'});
					
					 }, 300) 
					setTimeout(function () 
					{
						$('#selBillToAddress').val(val.PayToCode);
						
						$('#selBillToAddress').trigger('change');
						$('#selShippingType').val(trnspCode)

					}, 500)

					$('#txtNoOfRefDocTo').html('');

					$.ajax({
						type: 'POST',
						url: '../proc/views/vw_getRefDocTo.php',
						data: {docNum: val.DocNum},
						success: function (data) 
						{
							let dataObj = JSON.parse(data);
							if (dataObj.length !== 0) {
								$('#txtNoOfRefDocTo').html(`(${dataObj.length})`);
							}
						}
					});

				}
				else{
				$('#txtRemarks').val(`Copied from ${baseTableName} # ` + val.DocNum );	
				}
			
			
				
				
				/* let docnum = val.DocNum;
				$.ajax({
					type: 'GET',
					url: '../proc/views/vw_series.php',
					data: {docnum : docnum},
					success: function (html) 
					{
						
						$('#selSeries').html(html);
						
					}
				}); */
				
				
				
				
				
			});
			
			$('#selTransactionType').trigger('change');
			setTimeout(function () 
			{
				
					
				PreviewRows(docNum, docType, objType,function () 
				{
					
				});
				PreviewRowsWTAX(docNum,function () 
				{
					
				});
				
				
				
            }, 700) 
			
			setTimeout(function () 
			{	
				if (objType == objectType) {
					if(docstatus != 'Open'){
						$('input, textarea, select').prop('disabled', true );
						
						$('.btnGroup').addClass('d-none');
						$('#btnShipToDetails').addClass('d-none');
						$('#btnBillToDetails').addClass('d-none');
						
						/* 
						$('#salesOrder button').addClass('d-none');
						 */ 
						$('#footerButtons').addClass('d-none');
						$('#layoutOptions').prop("disabled",false);
					} else {
						$('#udfResult input, #udfResult textarea, #udfResult select').prop('disabled', false );
						//$('input, textarea, select').prop('disabled', false );
						/* $('input, textarea').prop('disabled', false );
						$('select').prop('disabled', false );
						 */
						$('#footerButtons').removeClass('d-none');
						$('.btnGroup').removeClass('d-none');
						$('.btnrowfunctions').removeClass('d-none');
						
					}
					$('input.footer').prop('disabled', true );
				}
				
				// else
				// {
				// 	$('#footerButtons').removeClass('d-none');
				// 	$('.btnGroup').removeClass('d-none');
				// }

				$('#selTransactionType').prop('disabled', true);

				$.ajax({
					type: 'GET',
					url: '../proc/views/vw_shippingType.php',
					data: {cardCode : data[0].CardCode},
					success: function (html) 
					{	
						$('#selShippingType').html(html);
						$('#selShippingType').val(trnspCode);
					}
				});
			}, 900) 
		});
		setTimeout(function()
			{
				$('#txtPostingDate').trigger('change');
				$('#txtDeliveryDate').trigger('change');
				$('#txtDocumentDate').trigger('change');
			},1000);
		setTimeout(function () 
			{
				 PreviewUDF(docNum, objType);
				 	 $('#btnCardCode').addClass('d-none');
			}, 1100)

		getRefDocModalData(docNum, objType);

		$('#btnRefDoc').removeAttr('disabled'); 
		$('#btnPreviewJournalEntry').attr("disabled",false);
	}
	function PreviewRows(docNum, docType, objType,callback){
        $('#tblDetails tbody').load('../proc/views/vw_getdetailsdata.php?docNum=' + docNum + '&docType=' + docType + '&objType=' + objType, function (result) 
		{
			CheckBatchSerial();
			
			let val = $('#txtDocTotal').val().split(' ');

			if (objType == baseType && val[val.length - 1] == 0 && $('input.itemcode:first-child').val() != ''){
				ComputeFooterTotalBeforeDiscount();
				ComputeFooterTaxAmount();
				ComputeTotal();
			}
			
            callback();
		});
	}
	function PreviewUDF(docNum, objType){
		let mainTable;
		if (objType == objectType)
			mainTable = objectTable;
		else
			mainTable = baseTable;

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
								if (html !== '') {
									that.val(html);
									// let date = html
									// let month = date.substring(5, 7);
									// let day = date.substring(8, 10);
									// let year = date.substring(0, 4);
									// let newdate = month + "." + day + "." + year;
									$('input.' + id2).val(SAPDateFormater(html).value);
								} else {
									$('input.' + id2).val('');
								}
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
					
					else if(udfValues5[i] != 'null' ){
						$(this).val(udfValues5[i]);
					
						
					}
					
					else if($(this).attr('table') != ''){
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
					
					else
					{
						$(this).val('');

						if($(this).val() == 'null'){
							$(this).val('');
						}
					}
					
				});
			}); 
		
		});
	}
	function PreviewDocJournalEntry(docNum, objType, currency){
		let docstatus = '';
		let docType ='';
		let transID = '';
	
		$.getJSON('../proc/views/vw_getheaderdataJE.php?docNum=' + docNum + '&objType=' + objType, function (data){
			
			
            $.each(data, function (key, val){
				
				transID = val.TransId;
				
				$('#txtSeries').val(val.Series);
				$('#txtNumber').val(val.Number);
				$('#txtRefDate').val(val.RefDate);
				$('#txtDueDateJE').val(val.DueDate);
				$('#txtDocDateJE').val(val.TaxDate);
				$('#txtMemo').val(val.Memo);
				
				$('#txtOrigin').val('AR');
				$('#txtOriginNo').val(val.BaseRef);
				$('#txtTransNo').val(val.TransId);

				$('#txtRef1').val(val.Ref1);
				$('#txtRef2').val(val.Ref2);
				$('#txtRef3').val(val.Ref3);
				
			});
			
			setTimeout(function () 
			{
				
					
					PreviewRowsJE(transID, currency,function () 
					{
						///alert(transID)
					});
				
				
				
            }, 700) 
		});
	}
	function PreviewRowsJE(transID , currency, callback){
        $('#tblJE tbody').load('../proc/views/vw_getdetailsdataJE.php?transID=' + transID + '&currency=' + currency, function (result) 
		{
            callback();
		});
	}
	function PreviewRowsWTAX(docNum,callback){
        $('#tblWTaxTable tbody').load('../proc/views/vw_getdetailsdataWTAX.php?docNum=' + docNum, function (result) 
		{
			
			
            callback();
		});
	}
	function ComputeTaxable(){
		let amount = 0.00;

		$('#tblDetails tbody tr').each(function()
		{
			console.log($(this).find('select.taxcode').val())
			console.log($(this).find('input.taxamount').val())
			if($(this).find('select.taxcode').val() == 'OVAT-N' && $(this).find('select.selwt').val() == '1'){
				 if(isNaN(parseFloat($(this).find('.rowtotal').val().replace(/,/g,''))))
				{
					amount += 0;
			    }
				else
				{
					amount += parseFloat($(this).find('.rowtotal').val().replace(/,/g,''));
			    }
			}
			else if($(this).find('select.taxcode').val() == 'OVAT-S' && $(this).find('select.selwt').val() == '1'){
				 if(isNaN(parseFloat($(this).find('.rowtotal').val().replace(/,/g,''))))
				{
					amount += 0;
			    }
				else
				{
					amount += parseFloat($(this).find('.rowtotal').val().replace(/,/g,''));
			    }
			}else{
				 if(isNaN(parseFloat($(this).find('.rowtotal').val().replace(/,/g,''))))
				{
					amount += 0;
			    }
				else
				{
					amount += parseFloat($(this).find('.rowtotal').val().replace(/,/g,''));
			    }
			}
		   
	      console.log(amount)
		})
		console.log(amount)
		$('.taxableamount').val(FormatMoney(amount));
		
	}
	function ComputeWtaxPerRow(){
		let amount = 0.00;

		let taxable = $('.selected-det-wtax').find('.taxableamount').val().replace(/,/g,'');
		let rate = parseFloat($('.selected-det-wtax').find('.rate').val());
		let baseamount = $('.selected-det-wtax').find('.baseamount').val().replace(/,/g,'');
		let newBaseAmount = taxable * 1.12;
		let newRate = rate / 100;
		if($('#txtVatSum').val() > 0){
			amount = taxable * newRate;
			console.log()
			$('.selected-det-wtax').find('.wtaxamount').val(FormatMoney(amount));
			$('.selected-det-wtax').find('.baseamount').val(FormatMoney(newBaseAmount));
		}
		else{
			amount = taxable * newRate;
			console.log()
			$('.selected-det-wtax').find('.wtaxamount').val(FormatMoney(amount));
			$('.selected-det-wtax').find('.baseamount').val(FormatMoney(taxable));
		}
		
		
	}
	function ComputeWtaxPerRowToFooter(){
		let amount = 0.00;

			$('#tblWTaxTable tbody tr').each(function (i) 
			{
		        
				if ($(this).find('input.wtcode').val() != '')
				{
					console.log($(this).find('input.wtaxamount').val().replace(/,/g,''))
		            amount += parseFloat($(this).find('input.wtaxamount').val().replace(/,/g,''));
					
					
				
				} 
				
			});
		$('#txtWTaxF').val(FormatMoney(amount))
	}
	function ComputeRowTaxAmount(){
		
		let taxrate = $('.selected-det').find('select.taxcode').find('option:selected').attr('val-rate');
		let total = $('.selected-det').find('input.rowtotal').val();
		let taxrateFloat = isNaN(parseFloat(taxrate.replace(/,/g,'')))? 0: parseFloat(taxrate.replace(/,/g,''));
		let totalFloat = isNaN(parseFloat(total.replace(/,/g,'')))? 0: parseFloat(total.replace(/,/g,''));
		let amount;
		if(taxrateFloat != 0.00){
			amount = parseFloat((taxrateFloat / 100) * totalFloat);
			
		}
		else{
			amount = 0.00;
		}
		$('.selected-det').find('input.taxamount').val(FormatMoney(amount));
	}
	
	
	
	function ComputeRowTotal(price,quantity,discount){
		
		price = isNaN(parseFloat(price.replace(/,/g,'')))? 0: parseFloat(price.replace(/,/g,''));
		quantity = isNaN(parseFloat(quantity.replace(/,/g,'')))? 0: parseFloat(quantity.replace(/,/g,''));
		discount = isNaN(parseFloat(discount.replace(/,/g,'')))? 0: parseFloat(discount.replace(/,/g,''));
		
		let rowTotal = price * quantity;
		let discTotal = rowTotal * discount/100;
		let rowTotal2 = rowTotal - discTotal;
		
		
		
		let result = FormatMoney(rowTotal2);
			
		return result; 
	}
	
	function ComputeRowGrossPrice(){
		let rowPrice = $('.selected-det').find('input.price').val();
		let rowTax = $('.selected-det').find('select.taxcode').find('option:selected').attr('val-rate');
		let discount =  $('.selected-det').find('input.discount').val();
		
		let rowPriceFloat = isNaN(parseFloat(rowPrice.replace(/,/g,'')))? 0: parseFloat(rowPrice.replace(/,/g,''));
		let rowTaxFloat = isNaN(parseFloat(rowTax.replace(/,/g,'')))? 0: parseFloat(rowTax.replace(/,/g,''));
		let discountFloat = isNaN(parseFloat(discount.replace(/,/g,'')))? 0: parseFloat(discount.replace(/,/g,''));
		
		let discTotal = rowPriceFloat * discountFloat/100;
		let rowTotal2 = rowPriceFloat - discTotal;
		let rowTax2 = (rowTaxFloat / 100) * rowTotal2;
		let rowTotal3 = rowTotal2 + rowTax2;
		
		
		let result = rowTotal3;
		$('.selected-det').find('.grossprice').val(FormatMoney(result));  
	}
	
	function ComputeGrossTotal(){
		let rowPrice = $('.selected-det').find('input.price').val();
		let rowQuantity = $('.selected-det').find('input.quantity').val();
		let rowTax = $('.selected-det').find('select.taxcode').find('option:selected').attr('val-rate');
		let discount =  $('.selected-det').find('input.discount').val();
		
		let rowPriceFloat = isNaN(parseFloat(rowPrice.replace(/,/g,'')))? 0: parseFloat(rowPrice.replace(/,/g,''));
		let rowTaxFloat = isNaN(parseFloat(rowTax.replace(/,/g,'')))? 0: parseFloat(rowTax.replace(/,/g,''));
		let discountFloat = isNaN(parseFloat(discount.replace(/,/g,'')))? 0: parseFloat(discount.replace(/,/g,''));
		let rowQuantityFloat = isNaN(parseFloat(rowQuantity.replace(/,/g,'')))? 0: parseFloat(rowQuantity.replace(/,/g,''));
		
		let rowTotalFloat = rowPriceFloat * rowQuantityFloat;
		let discTotal = parseFloat(rowTotalFloat * discountFloat/100);
		let rowTotal2 = parseFloat(rowTotalFloat - discTotal);
		let rowTax2 = parseFloat((rowTaxFloat / 100) * rowTotal2);
		let rowTotal3 = parseFloat(rowTotal2 + rowTax2);
		
		let result = rowTotal3.toFixed(4);
		$('.selected-det').find('.grosstotal').val(FormatMoney(result)); 
	}
	
	function ComputeFooterTaxAmount(){
		let amount = 0.00;
		$('.taxamount').each(function()
		{
	    if(isNaN(parseFloat($(this).val().replace(/,/g,''))))
		{
			amount += 0;
	    }
		else
		{
			amount += parseFloat($(this).val().replace(/,/g,''));
	    }
	      
		})
		
		$('#txtVatSum').val(FormatMoney(amount));
		ComputeTotal();
	}
	
	function ComputeFooterTotalBeforeDiscount(){
		let amount = 0.00;
		$('.rowtotal').each(function()
		{
	    if(isNaN(parseFloat($(this).val().replace(/,/g,''))))
		{
			amount += 0;
	    }
		else
		{
			amount += parseFloat($(this).val().replace(/,/g,''));
	    }
	      
		})
		let wtax =  parseFloat($('#txtWTaxF').val().replace(/,/g,''));
		let total = 0.00;
		if(wtax > 0){
			
			total =   parseFloat(amount - wtax);	
				
			$('#txtTotalBeforeDiscount').val(FormatMoney(total))
		}else{
			total =   parseFloat(amount)
			$('#txtTotalBeforeDiscount').val(FormatMoney(total))
		}
	
		
		ComputeTotal();
	}
	function ComputeFooterTotalBeforeDiscountWTax(){
		let amount = 0.00;
		$('.rowtotal').each(function()
		{
			if($(this).closest('tr').find('select.selwt').val() == 'Y'){
					if(isNaN(parseFloat($(this).val().replace(/,/g,''))))
					{
						amount += 0;
				    }
					else
					{
						amount += parseFloat($(this).val().replace(/,/g,''));
				    }	
			}
		
	      
		})
		//if($('input.wtcode').val() != ''){
			$('input.baseamount').val(FormatMoney(amount))
		//}
		
	
		
		
	}
	function ComputeDiscountPercentageFooter(discAmount,totalBeforeDiscount){
		discAmount = isNaN(parseFloat(discAmount.replace(/,/g,'')))? 0: parseFloat(discAmount.replace(/,/g,''));
		totalBeforeDiscount = isNaN(parseFloat(totalBeforeDiscount.replace(/,/g,'')))? 0: parseFloat(totalBeforeDiscount.replace(/,/g,''));
		
		let amount = (discAmount * 100) / totalBeforeDiscount;
		$('#txtFooterDiscountPercentage').val(FormatMoney(amount));
		
	}
	function ComputeDiscountAmountFooter(discPercentage,totalBeforeDiscount){
		discPercentage = isNaN(parseFloat(discPercentage.replace(/,/g,'')))? 0: parseFloat(discPercentage.replace(/,/g,''));
		totalBeforeDiscount = isNaN(parseFloat(totalBeforeDiscount.replace(/,/g,'')))? 0: parseFloat(totalBeforeDiscount.replace(/,/g,''));
		
		let amount = (discPercentage / 100) * totalBeforeDiscount;
		$('#txtFooterDiscountSum').val(FormatMoney(amount));
		
	}
	function ComputeTotal(){
		let totalBeforeDiscount = $('#txtTotalBeforeDiscount').val();
		let totalTaxAmount = $('#txtVatSum').val();
		let totalDiscount = $('#txtFooterDiscountSum').val();
		let paidToDate = $('#txtPaidToDate').val();
		let totalWtax = $('#txtWTaxF').val().replace(/,/g,'');
		
		let totalBeforeDiscountFloat = isNaN(parseFloat(totalBeforeDiscount.replace(/,/g,'')))? 0: parseFloat(totalBeforeDiscount.replace(/,/g,''));
		let totalTaxAmountFloat = isNaN(parseFloat(totalTaxAmount.replace(/,/g,'')))? 0: parseFloat(totalTaxAmount.replace(/,/g,''));
		let totalDiscountFloat = isNaN(parseFloat(totalDiscount.replace(/,/g,'')))? 0: parseFloat(totalDiscount.replace(/,/g,''));
		let paidToDateFloat = isNaN(parseFloat(paidToDate.replace(/,/g,'')))? 0: parseFloat(paidToDate.replace(/,/g,''));
		let totalWtaxFloat = isNaN(parseFloat(totalWtax.replace(/,/g,'')))? 0: parseFloat(totalWtax.replace(/,/g,''));

		
		let amount = (totalBeforeDiscountFloat + totalTaxAmountFloat) - totalDiscountFloat;
		let amount2 = amount - totalWtax;
		
		$('#txtDocTotal').val(FormatMoneyWithCurrency(amount2));
		$('#txtBalancedDue').val(FormatMoneyWithCurrency(amount2 - paidToDateFloat));
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
	
	
	function SelectCreatedBatchPerItem(selectedRow,selectedDocNum,selectedItem,selectedWhse,selectedQtyNeeded,selectedQtyCreated){
		var json = '{';
		let tblDetailRowNo = [];	
		let batchCodeArray = [];	
		let batchQuantityArray = [];	
		let batchQuantityCreatedArray = [];	
		
		let batchExpDateArray = [];	
		let batchMfrDateArray = [];	
		let batchAdminArray = [];	
		
		let batchLocationArray = [];	
		let batchDetailsArray = [];	
		let batchUnitCostArray = [];	
		
        $('#tblBatchCreated tbody tr').each(function(i) {
		{
			let batchArrayChildren = [];
			if ($(this).find('input.batch').val() != ''){
				tblDetailRowNo.push($(this).find('input.tbldetailrowno').val(selectedRow));
				batchCodeArray.push($(this).find('input.batch').val());
				batchQuantityArray.push($(this).find('input.quantity').val());
				
				batchExpDateArray.push($(this).find('input.expdate').val());
				batchMfrDateArray.push($(this).find('input.mfrdate').val());
				batchAdminArray.push($(this).find('input.admindate').val());
				
				batchLocationArray.push($(this).find('input.location').val());
				batchDetailsArray.push($(this).find('input.details').val());
				batchUnitCostArray.push($(this).find('input.unitcost').val().replace(/,/g, ""));
				
				
					
				}
			}
		
		});
		
		 $('#tblBatch tbody tr.selected-item').each(function(i) {
		
			
				batchQuantityCreatedArray.push($(this).find('td.totalcreated').text());
			
		
		});
		
		//json += batchArrayParent.join(",") + '}';
		
		
		 $('#tblDetails tbody tr').each(function(i) {
			let rowNo = $(this).find('td.rowno span').text();
			let itemCode = $(this).find('input.itemcode').val();
			let quantity = $(this).find('input.quantity').val();
			let quantityCreated = $(this).find('input.batchorserialqtycreated').val();
			
			if(itemCode != '' &&  itemCode == selectedItem && rowNo == selectedRow){
				
				$(this).find('input.batchorserialcontainer').val(batchCodeArray);
				$(this).find('input.batchorserialquantity').val(batchQuantityArray);
				$(this).find('input.batchorserialqtycreated').val(batchQuantityCreatedArray);
				
				$(this).find('input.batchorserialexpdate').val(batchExpDateArray);
				$(this).find('input.batchorserialmfrdate').val(batchMfrDateArray);
				$(this).find('input.batchorserialadmindate').val(batchAdminArray);
				$(this).find('input.batchorseriallocation').val(batchLocationArray);
				$(this).find('input.batchorserialdetails').val(batchDetailsArray);
				$(this).find('input.batchorserialunitcost').val(batchUnitCostArray);
			}
			
		
		
		
		});
		
		
		
	}
	
	function SelectCreatedSerialPerItem(selectedRow,selectedDocNum,selectedItem,selectedWhse,selectedQtyNeeded,selectedQtyCreated){
		var json = '{';
		let tblDetailRowNo = [];	
		let mfrserialCodeArray = [];	
		let serialCodeArray = [];	
		let serialQuantityArray = [];	
		let serialQuantityCreatedArray = [];	
		
		let serialExpDateArray = [];	
		let serialMfrDateArray = [];	
		let serialAdminArray = [];	
		
		let serialLocationArray = [];	
		let serialDetailsArray = [];	
		let serialUnitCostArray = [];	
		
	
        $('#tblSerialCreated tbody tr').each(function(i) {
		{
			
			let serialArrayChildren = [];
			if ($(this).find('input.serial').val() != ''){
			
				tblDetailRowNo.push($(this).find('input.tbldetailrowno').val(selectedRow));
				mfrserialCodeArray.push($(this).find('input.mfrserial').val());
				serialCodeArray.push($(this).find('input.serial').val());
				serialQuantityArray.push($(this).find('input.quantity').val());
				
				serialExpDateArray.push($(this).find('input.expdate').val());
				serialMfrDateArray.push($(this).find('input.mfrdate').val());
				serialAdminArray.push($(this).find('input.admindate').val());
				
				serialLocationArray.push($(this).find('input.location').val());
				serialDetailsArray.push($(this).find('input.details').val());
				serialUnitCostArray.push($(this).find('input.unitcost').val().replace(/,/g, ""));
				
				
					
				}
			}
		
		});
		
		
		 $('#tblSerial tbody tr.selected-item').each(function(i) {
		
			
				serialQuantityCreatedArray.push($(this).find('td.totalcreated').text());
			
		
		});
		
		//json += batchArrayParent.join(",") + '}';
		
		
		 $('#tblDetails tbody tr').each(function(i) {
			let rowNo = $(this).find('td.rowno span').text();
			let itemCode = $(this).find('input.itemcode').val();
			let quantity = $(this).find('input.quantity').val();
			let quantityCreated = $(this).find('input.batchorserialqtycreated').val();
			if(itemCode != '' &&  itemCode == selectedItem && rowNo == selectedRow){
				$(this).find('input.batchorserialcontainer2').val(mfrserialCodeArray);
				$(this).find('input.batchorserialcontainer').val(serialCodeArray);
				$(this).find('input.batchorserialquantity').val(serialQuantityArray);
				$(this).find('input.batchorserialqtycreated').val(serialQuantityCreatedArray);
				
				$(this).find('input.batchorserialexpdate').val(serialExpDateArray);
				$(this).find('input.batchorserialmfrdate').val(serialMfrDateArray);
				$(this).find('input.batchorserialadmindate').val(serialAdminArray);
				$(this).find('input.batchorseriallocation').val(serialLocationArray);
				$(this).find('input.batchorserialdetails').val(serialDetailsArray);
				$(this).find('input.batchorserialunitcost').val(serialUnitCostArray);
			}
			
		
		
		
		});
		
		
		
	}
	
	function CheckBatchSerial(){
		$('#tblDetails tbody tr').each(function()
		{	
			if($(this).find('input.batchorserial').val() == 'B'){
				$(this).find('.btn-batch').removeClass('d-none');
				$(this).find('.btn-serial').addClass('d-none');
				$(this).find('.btn-disabled').addClass('d-none');
				
			}
			else if($(this).find('input.batchorserial').val() == 'S'){
				$(this).find('.btn-serial').removeClass('d-none');
				$(this).find('.btn-batch').addClass('d-none');
				$(this).find('.btn-disabled').addClass('d-none');
			}
			else{
				$(this).find('.btn-batch').addClass('d-none');
				$(this).find('.btn-serial').addClass('d-none');
				$(this).find('.btn-disabled').removeClass('d-none');
			}
		});
	}
	function GetAllItemWithBatchManagement(){
		let length = 0;
		let tblDetailRowNoArray = [];
		let docNum = $('#txtDocNum').val();
		let itemCodeArray = [];
		let itemNameArray = [];
		let qtyArray = [];
		let batchQtyCreatedArray = [];
		let whseArray = [];
		let qtyTotal = 0;
		
		$('#tblBatch tbody').html('');
		$('#tblDetails tbody tr').each(function()
		{	
			
			if($(this).find('input.batchorserial').val() == 'B'){
				length += 1;
				let tblDetailRowNo = $(this).find('td.rowno span').text();
				let itemCode = $(this).find('input.itemcode').val();
				let itemName = $(this).find('input.itemname').val();
				let qty = isNaN(parseInt($(this).find('input.quantity').val())) ? 0 : parseInt($(this).find('input.quantity').val());
				let batchQtyCreated = $(this).find('input.batchorserialqtycreated').val();
				
				let whseCode = $(this).find('input.whsecode').val();
				
				tblDetailRowNoArray.push(tblDetailRowNo);
				itemCodeArray.push(itemCode);
				itemNameArray.push(itemName);
				qtyArray.push(qty);
				batchQtyCreatedArray.push(batchQtyCreated);
				whseArray.push(whseCode);  
				
			}
		
		});
		
		for(let i = 0; i < length; i++){
			let no = i + 1;
			
			$('#tblBatch tbody').append('<tr><td class="tbldetailrowno d-none">'+tblDetailRowNoArray[i]+'</td><td class="rowcount">'+no+'</td><td class="docnumber">'+docNum+'</td><td class="itemcode">'+itemCodeArray[i]+'</td><td class="itemname">'+itemNameArray[i]+'</td><td class="whsecode">'+whseArray[i]+'</td><td class="quantity text-right">'+qtyArray[i]+'</td><td class="totalcreated text-right">'+batchQtyCreatedArray[i]+'</td></tr>');
			
		}	
		
		
			$('#tblBatchCreated > tbody').load('../templates/' + mainFileName + '-batch-creation-lines.php');
		
	}
	function GetAllItemWithBatchManagementAdded(){
		let length = 0;
		let tblDetailRowNoArray = [];
		let docNum = $('#txtDocNum').val();
		let itemCodeArray = [];
		let itemNameArray = [];
		let qtyArray = [];
		let batchQtyCreatedArray = [];
		let whseArray = [];
		let qtyTotal = 0;
		
		$('#tblBatch tbody').html('');
		$('#tblDetails tbody tr').each(function()
		{	
			
			if($(this).find('input.batchorserial').val() == 'B'){
				length += 1;
				let tblDetailRowNo = $(this).find('td.rowno span').text();
				let itemCode = $(this).find('input.itemcode').val();
				let itemName = $(this).find('input.itemname').val();
				let qty = isNaN(parseInt($(this).find('input.quantity').val())) ? 0 : parseInt($(this).find('input.quantity').val());
				let batchQtyCreated = $(this).find('input.batchorserialqtycreated').val();
				
				let whseCode = $(this).find('input.whsecode').val();
				
				tblDetailRowNoArray.push(tblDetailRowNo);
				itemCodeArray.push(itemCode);
				itemNameArray.push(itemName);
				qtyArray.push(qty);
				batchQtyCreatedArray.push(batchQtyCreated);
				whseArray.push(whseCode);
				
			}
		
		});
		
		for(let i = 0; i < length; i++){
			let no = i + 1;
			
			$('#tblBatch tbody').append('<tr><td class="tbldetailrowno d-none">'+tblDetailRowNoArray[i]+'</td><td class="rowcount">'+no+'</td><td class="docnumber">'+docNum+'</td><td class="itemcode">'+itemCodeArray[i]+'</td><td class="itemname">'+itemNameArray[i]+'</td><td class="whsecode">'+whseArray[i]+'</td><td class="quantity text-right">'+qtyArray[i]+'</td><td class="totalcreated text-right">'+qtyArray[i]+'</td></tr>');
			
		}	
		
		
			$('#tblBatchCreated > tbody').load('../templates/' + mainFileName + '-batch-creation-lines.php');
		
	}
	
	function GetAllItemWithSerialManagement(){
		let length = 0;
		let tblDetailRowNoArray = [];
		let docNum = $('#txtDocNum').val();
		let itemCodeArray = [];
		let itemNameArray = [];
		let qtyArray = [];
		let serialQtyCreatedArray = [];
		let whseArray = [];
		let qtyTotal = 0;
		
		$('#tblSerial tbody').html('');
		$('#tblDetails tbody tr').each(function()
		{	
			
			if($(this).find('input.batchorserial').val() == 'S'){
				length += 1;
				let tblDetailRowNo = $(this).find('td.rowno span').text();
				let itemCode = $(this).find('input.itemcode').val();
				let itemName = $(this).find('input.itemname').val();
				let qty = isNaN(parseInt($(this).find('input.quantity').val())) ? 0 : parseInt($(this).find('input.quantity').val());
				let batchQtyCreated = $(this).find('input.batchorserialqtycreated').val();
				
				let whseCode = $(this).find('input.whsecode').val();
				
				tblDetailRowNoArray.push(tblDetailRowNo);
				itemCodeArray.push(itemCode);
				itemNameArray.push(itemName);
				qtyArray.push(qty);
				serialQtyCreatedArray.push(batchQtyCreated);
				whseArray.push(whseCode);
				
			}
		
		});
		
		for(let i = 0; i < length; i++){
			let no = i + 1;
			$('#tblSerial tbody').append('<tr><td class="tbldetailrowno d-none">'+tblDetailRowNoArray[i]+'</td><td class="rowcount">'+no+'</td><td class="docnumber">'+docNum+'</td><td class="itemcode">'+itemCodeArray[i]+'</td><td class="itemname">'+itemNameArray[i]+'</td><td class="whsecode">'+whseArray[i]+'</td><td class="quantity text-right">'+qtyArray[i]+'</td><td class="totalcreated text-right">'+serialQtyCreatedArray[i]+'</td></tr>');
			
		}	
		
		
			$('#tblSerialCreated > tbody').load('../templates/' + mainFileName + '-serial-creation-lines.php');
		
	}
	function GetAllItemWithSerialManagementAdded(){
		let length = 0;
		let tblDetailRowNoArray = [];
		let docNum = $('#txtDocNum').val();
		let itemCodeArray = [];
		let itemNameArray = [];
		let qtyArray = [];
		let serialQtyCreatedArray = [];
		let whseArray = [];
		let qtyTotal = 0;
		
		$('#tblSerial tbody').html('');
		$('#tblDetails tbody tr').each(function()
		{	
			
			if($(this).find('input.batchorserial').val() == 'S'){
				length += 1;
				let tblDetailRowNo = $(this).find('td.rowno span').text();
				let itemCode = $(this).find('input.itemcode').val();
				let itemName = $(this).find('input.itemname').val();
				let qty = isNaN(parseInt($(this).find('input.quantity').val())) ? 0 : parseInt($(this).find('input.quantity').val());
				let batchQtyCreated = $(this).find('input.batchorserialqtycreated').val();
				
				let whseCode = $(this).find('input.whsecode').val();
				
				tblDetailRowNoArray.push(tblDetailRowNo);
				itemCodeArray.push(itemCode);
				itemNameArray.push(itemName);
				qtyArray.push(qty);
				serialQtyCreatedArray.push(batchQtyCreated);
				whseArray.push(whseCode);
				
			}
		
		});
		
		for(let i = 0; i < length; i++){
			let no = i + 1;
			$('#tblSerial tbody').append('<tr><td class="tbldetailrowno d-none">'+tblDetailRowNoArray[i]+'</td><td class="rowcount">'+no+'</td><td class="docnumber">'+docNum+'</td><td class="itemcode">'+itemCodeArray[i]+'</td><td class="itemname">'+itemNameArray[i]+'</td><td class="whsecode">'+whseArray[i]+'</td><td class="quantity text-right">'+qtyArray[i]+'</td><td class="totalcreated text-right">'+qtyArray[i]+'</td></tr>');
			
		}	
		
		
			$('#tblSerialCreated > tbody').load('../templates/' + mainFileName + '-serial-creation-lines.php');
		
	}
	
	function GetSumOfRows(){
		let baseAmount = 0.00;
	
		$('.selected-det-wtax').find('input.baseamount').val(ComputeRowTotal(price,quantity,discount));
		

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

    function printCompanyAddress(selector){
    	$.ajax({
			type: 'GET',
			url: '../proc/views/vw_getCompanyAddress.php',
			success: function (html) 
			{
				$(selector).val(html);
			}
		});
    }

    function printShipToAddress(selector, docNum){
    	$.ajax({
			type: 'POST',
			url: '../proc/views/vw_getCompanyAddress.php',
			data: {
				docNum: docNum
			},
			success: function (html) 
			{
				$(selector).val(html);
			}
		});
    }

    function setStateList(CountryCode){
			$.ajax({
				type: 'GET',
				url: '../proc/views/vw_getStateList.php',
				data: {CountryCode : CountryCode},
				success: function (html) 
				{
					$('#tbodyStateS').empty();
					return $('#tblStateS tbody').append(html);
				}
			});
	}

	/******Referenced Document Modal Functions******/
	function loadRefDocModal() {
		$('#docRefTo-tab').load('../templates/' + mainFileName + '-doc-referenced-to.php');
    	$('#docRefBy-tab').load('../templates/' + mainFileName + '-doc-referenced-by.php');

    	if ($.fn.DataTable.isDataTable('#tblTransactType')) {
		 	$('#tblTransactType').DataTable().clear().destroy();
		}

    	$('#tbodyTransactType').empty();

    	objTables.map(obj => {
    		$('#tblTransactType tbody').append(`<tr><td>${obj.tableName}</td></tr>`);
    	})

		$('#tblTransactType').dataTable({"bLengthChange": false,});
	}

	function getRefDocModalData(docNum, objType) {

		if (objType != objectType)
			return false;

		let lastRowNo;

		$('#tbodyDocRefTo').empty();
		$('#tbodyDocRefBy').empty();

		loadRefDocModal();

		$.ajax({
			type: 'POST',
			url: '../proc/views/vw_getRefDocTo.php',
			data: {docNum: docNum},
			success: function (data) 
			{
				let dataObj = JSON.parse(data);

				origRefDocToArr = dataObj.map(item => {
					item.RefTable = objTypeToTableName(objTables, item.RefTable);
					return item;
				});

				refDocToArr = origRefDocToArr;

				if (dataObj.length > 0) {
					for (var i = 0; i < dataObj.length; i++) {
						lastRowNo = i + 1
						$('#rowLoader').load('../templates/' + mainFileName + '-doc-referenced-to.php?rowNo=' + lastRowNo, function (result) 
							{
								$('#tbldocRefTo tbody').append(result);
							}
						);
					}
					setTimeout(function(){
						$('#tbldocRefTo tbody').find('tr').each(function(index) 
						{
							if (dataObj[index].RefTable == 'External Document') {
								$(this).find('td.rowNo, .txtTransactType, .txtRefDocExtDocNum, .txtRefDocDate, .txtRefDocRemarks').addClass('text-primary');
								$(this).find('.txtTransactType').val(dataObj[index].RefTable);
								$(this).find('.txtRefDocNum').val('');
								$(this).find('.btnRefDocNum').attr('disabled', true);
								$(this).find('.txtRefDocExtDocNum').val(dataObj[index].ExtDocNum);
								$(this).find('.txtRefDocDate').val(dataObj[index].IssueDate == '' ? '' : SAPDateFormater(dataObj[index].IssueDate).value);
								$(this).find('.txtRefDocDate').removeAttr('disabled');
								$(this).find('.txtRefDocExtDocNum').removeAttr('disabled');
								$(this).find('.btnRefDocDate').removeClass('d-none');
								$(this).find('.txtRefDocRemarks').val(dataObj[index].Remark);
								$(this).find('.txtRefDocRemarks').removeAttr('disabled');
								$(this).find('.btnRowRefDocTo').removeClass('d-none');
							} else {
								$(this).find('.txtTransactType').val(dataObj[index].RefTable);
								$(this).find('.txtRefDocNum').val(dataObj[index].RefDocNum);
								$(this).find('.btnRefDocNum').removeAttr('disabled');
								$(this).find('.txtRefDocExtDocNum').val(dataObj[index].ExtDocNum);
								$(this).find('.txtRefDocDate').val(SAPDateFormater(dataObj[index].IssueDate).value);
								$(this).find('.txtRefDocRemarks').val(dataObj[index].Remark);
								$(this).find('.txtRefDocRemarks').removeAttr('disabled');
								$(this).find('.btnRowRefDocTo').removeClass('d-none');
							}
							if (dataObj.length == index + 1) {
								return false;
							}
						});
					}, 100);
				}
			}
		});

		$.ajax({
			type: 'POST',
			url: '../proc/views/vw_getRefDocBy.php',
			data: {
				docNum: docNum,
				objType: objType
			},
			success: function (data) 
			{
				let dataObj = JSON.parse(data);
				if (dataObj.length > 0) {
					for (var i = 1; i < dataObj.length; i++) {
						lastRowNo = i + 1
						$('#rowLoader').load('../templates/' + mainFileName + '-doc-referenced-by.php?rowNo=' + lastRowNo, function (result) 
							{
								$('#tbldocRefBy tbody').append(result);
							}
						);
					}
					setTimeout(function(){
						$('#tbldocRefBy tbody').find('tr').each(function(index) 
						{
							$(this).find('.txtTransactType').val(dataObj[index].ObjectTableName);
							$(this).find('.txtRefDoc').val(dataObj[index].DocEntry);
							$(this).find('.txtRefDocDate').val(SAPDateFormater(dataObj[index].IssueDate).value);
							$(this).find('.txtRefAmount').val(dataObj[index].RefAmount);
							$(this).find('.txtRefDocRemarks').val(dataObj[index].Remark);
						});
					}, 100);
				}
			}
		});
	}

	function getCurrentRefDocArray(){
		let currentRefDocArr = [];
		$('#tbldocRefTo tbody').find('tr').each(function(){
			if ($(this).find('input.refDocToInput').hasClass('txtTransactType') &&
				$(this).find('input.refDocToInput').val() == '') {
				return false;
			}
			let obj = {
				LineNum: $(this).find('td.rowNo span').text(),
				RefTable: $(this).find('input.txtTransactType.refDocToInput').val(),
				RefDocNum: $(this).find('input.txtRefDocNum.refDocToInput').val(),
				ExtDocNum: $(this).find('input.txtRefDocExtDocNum.refDocToInput').val(),
				IssueDate: $(this).find('input.txtRefDocDate.refDocToInput').val(),
				Remark: $(this).find('input.txtRefDocRemarks.refDocToInput').val()
			}
			currentRefDocArr.push(obj);
		})
		return currentRefDocArr;
	}

	function hasMissingRequiredData(){
		let bool = false;
		let lineNum, message;
		$('#tbldocRefTo tbody').find('tr').each(function(){
			if ($(this).find('input.refDocToInput').hasClass('txtTransactType') &&
				$(this).find('input.refDocToInput').val() == 'External Document') {
				if ($(this).find('input.txtRefDocRemarks.refDocToInput').val() == '') {
					lineNum = $(this).find('td.rowNo span').text();
					message = 'Remark is mandatory for external documents. See line ' + lineNum + '.';
					bool = true;
					return false;
				}
			}
			if ($(this).find('input.refDocToInput').hasClass('txtTransactType') &&
				$(this).find('input.refDocToInput').val() != '' && 
				$(this).find('input.refDocToInput').val() != 'External Document') {
				if ($(this).find('input.txtRefDocNum.refDocToInput').val() == '') {
					lineNum = $(this).find('td.rowNo span').text();
					message = 'Document number is mandatory for chosen document in line ' + lineNum + '.';
					bool = true;
					return false;
				}
			}
		})
		return {bool: bool, message: message};
	}

	function hasDuplicateDoc(transactType, docNum, lineNum){
		let result = false;
		let currentRefDocArr = getCurrentRefDocArray();

		for (var i = 0; i < currentRefDocArr.length; i++) {
			if (currentRefDocArr[i].RefTable == transactType &&
				currentRefDocArr[i].RefDocNum == docNum && 
				i + 1 != lineNum) {
				result = i + 1;
			}
		}

		return result;
	}

	function hasDuplicateExtDoc(currentLineRow = 0){
		let bool = false;
		let lineNum, message;
		let currentRefDocArr = getCurrentRefDocArray();

		for (var i = 0; i < currentRefDocArr.length; i++) {
			for (var j = 0; j < currentRefDocArr.length; j++) {
				if (currentRefDocArr[i].RefTable == 'External Document' &&
					currentRefDocArr[i].LineNum != currentRefDocArr[j].LineNum && 
					currentRefDocArr[i].Remark != '' &&
					currentRefDocArr[i].RefTable == currentRefDocArr[j].RefTable && 
					currentRefDocArr[i].IssueDate == currentRefDocArr[j].IssueDate && 
					currentRefDocArr[i].IssueDate == currentRefDocArr[j].IssueDate && 
					currentRefDocArr[i].Remark == currentRefDocArr[j].Remark) {
					lineNum = currentRefDocArr[i].LineNum == currentLineRow ? currentRefDocArr[j].LineNum : currentRefDocArr[i].LineNum;
					message = 'External Document '+ currentRefDocArr[i].Remark +' is already selected in line ' + lineNum + '.';
					bool = true;
					return {bool: bool, message: message};
				}
			}
		}

		return {bool: bool, message: message};
	}

	function compareArrayOfObj(arr1, arr2){
		if (arr1.length !== arr2.length) {
			return false;
		}

		for (var i = 0; i < arr1.length; i++) {
			for(prop in arr1[i]){
				if(arr1[i][prop] !== arr2[i][prop]){
					return false;
				}
			}
		}
		return true;
	}

	function portalMessage(message, bgColor, textColor){
		$('#messageBar2').addClass('d-none');
		$('#messageBar3').removeClass('d-none');
		$('#messageBar').text(message).css({'background-color': bgColor, 'color': textColor});
		
		setTimeout(function()
		{
			$('#messageBar').text('').css({'background-color': '', 'color': ''});	
			$('#messageBar2').removeClass('d-none');
		},5000)
	}

	function getFinalRefDocToObj(origArr, currentArr){

		let baseArr = [].concat(origArr.map(item => Object.assign({}, item)));
		let currArr = [].concat(currentArr.map(item => Object.assign({}, item)));
		let updateArr = [];

		let iBuff = [];
		let jBuff = [];

		currArr = currArr.map(item => {
			item.IssueDate = SQLDateFormater(item.IssueDate);
			return item;
		});

		for (var i = 0; i < baseArr.length; i++) {
			for (var j = 0; j < currArr.length; j++) {
				let counter = 0;
				for(prop in baseArr[i]){
					if(baseArr[i][prop] === currArr[j][prop]){
						counter++;
					} else if (counter == 5 && prop == 'Remark') {
						if(baseArr[i][prop] !== currArr[j][prop]) {
							updateArr.push({
								LineNum: baseArr[i].LineNum,
								RefTable: tableNameToObj(objTables, baseArr[i].RefTable),
								RefDocNum: baseArr[i].RefDocNum,
								ExtDocNum: baseArr[i].ExtDocNum,
								IssueDate: baseArr[i].IssueDate,
								Remark: currArr[j].Remark
							})
							iBuff.push(i);
							jBuff.push(j);
						}
					}
				}
				if (counter == 6) {
					iBuff.push(i);
					jBuff.push(j);
				}
			}
		}

		iBuff.sort(function(a, b){return a - b}).reverse();
		jBuff.sort(function(a, b){return a - b}).reverse();

		for (var i = 0; i < iBuff.length; i++) {
			baseArr.splice(iBuff[i], 1);
		}

		for (var i = 0; i < jBuff.length; i++) {
			currArr.splice(jBuff[i], 1);
		}

		baseArr = baseArr.map(item => {
			item.RefTable = tableNameToObj(objTables, item.RefTable);
			return item;
		});

		currArr = currArr.map(item => {
			item.RefTable = tableNameToObj(objTables, item.RefTable);
			return item;
		});

		let obj = {
			delete: baseArr,
			add: currArr,
			updateRemarks: updateArr
		}
		return obj;
	}

	function tableNameToObj(objTables, tableName) {
		let obj = objTables.filter(table => table.tableName === tableName);
		return obj[0];
	}

	function objTypeToTableName(objTables, objType) {
		let obj = objTables.filter(table => table.objectType === parseInt(objType));
		return obj[0].tableName;
	}

	/******DateFormatting Function******/
	function SAPDateFormater(dateLiteral, checkDate = false) {
		
		let options = [
			{args: {year: '2-digit', month: '2-digit', day: '2-digit'}, order: [2,0,4]},
			{args: {year: 'numeric', month: '2-digit', day: '2-digit'}, order: [2,0,4]},
			{args: {year: '2-digit', month: '2-digit', day: '2-digit'}, order: [0,2,4]},
			{args: {year: 'numeric', month: '2-digit', day: '2-digit'}, order: [0,2,4]},
			{args: {year: 'numeric', month: '2-digit', day: '2-digit'}, order: [4,0,2]},
			{args: {year: 'numeric', month: 'long', day: '2-digit'}, order: [2,0,4]},
			{args: {year: '2-digit', month: '2-digit', day: '2-digit'}, order: [4,0,2]}
		];

		dateLiteral = SAPDateFormat == 6 && dateLiteral.length == 8 ? '20'+dateLiteral : dateLiteral;
		
		let dateObj;

		try {
			let passDate = new Date(dateLiteral);

			if (passDate == 'Invalid Date')
				throw {message: `Invalid date format. Cannot parse date value from string "${dateLiteral}"`};

			let minDate = new Date('01-01-2018');
			let maxDate = new Date('12-31-2050');

			if (checkDate) {
				if (passDate >= minDate && passDate <= maxDate) {
					dateObj = new Intl.DateTimeFormat('en-us', options[SAPDateFormat].args).formatToParts(passDate);
				} else {
					throw {message: `Out of valid date range. The date should be in the range of 01-01-2018 and 12-31-2050.`};
				}
			} else {
				dateObj = new Intl.DateTimeFormat('en-us', options[SAPDateFormat].args).formatToParts(passDate);
			}
			
		}
		catch(err) {
			return {bool: false, error: err.message};
		}
		let dateStr = `${dateObj[options[SAPDateFormat].order[0]].value}.${dateObj[options[SAPDateFormat].order[1]].value}.${dateObj[options[SAPDateFormat].order[2]].value}`;
		return {bool: true, value: dateStr};
	}

	function SQLDateFormater(dateLiteral) {
		if (dateLiteral == '') {
			return '';
		}

		let dateObj = new Intl.DateTimeFormat('en-us', {year: 'numeric', month: '2-digit', day: '2-digit'}).formatToParts(new Date(dateLiteral));

		return `${dateObj[4].value}-${dateObj[0].value}-${dateObj[2].value}`;
	}

});