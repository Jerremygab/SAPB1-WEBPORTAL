$(document).ready(function () {
let mainTable = 'OJDT';
$('#pageTitle').text('Journal Entry | SAP B1');
//TopBar
setTimeout(function()
	{
		$('#txtPostingDate').trigger('change');
		$('#txtDeliveryDate').trigger('change');
		$('#txtDocumentDate').trigger('change');
	},1000);


$(document.body).on('click', '#btnFirstRecord', function (){
	let table = 'OJDT';
	let docNum = '';
	let objType = 30;
	$.getJSON('../proc/views/vw_getFirstEntry.php?table=' + table, function (data){
		docNum = data;
		PreviewDoc(docNum,objType);
	});
});
$(document.body).on('click', '#btnPrint', function () 
	{
		let layout = $('#layoutOptions').val();
		var docentry = $('#txtDocNum').val();
		
		if(docentry != '')
		{ 
			if(layout =='JournalVoucher'){
				window.open("../forms/JournalEntry.php?docentry=" + encodeURI(docentry),"", "width=1130,height=550,left=220,top=110");
			}
			else if(layout =='JournalEntryRowBranch'){
				window.open("../forms/JournalEntryRowBranch.php?docentry=" + encodeURI(docentry),"", "width=1130,height=550,left=220,top=110");
			}
			
			
		}
	});

	$(document.body).on('click', '#btnPrevRecord', function (){
	let table = 'OJDT';
	let objType = 30;
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
	let table = 'OJDT';
	let objType = 30;
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
	let table = 'OJDT';
	let docNum = '';
	let objType = 30;
	$.getJSON('../proc/views/vw_getLastEntry.php?table=' + table, function (data){
		docNum = data;
		PreviewDoc(docNum,objType);
	});
});
$(document).ready(function() {
    $('#btnPreviewJournalEntry').prop('disabled', true);
	
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
		$('#window').css('border-right', '');
		
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
		$('#window').css('border-right', '1px solid #A0A0A0');
		
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
let txtCurrency = 'PHP';	
var fadeDelay = 1000;
var fadeDuration = 1000;
	

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
var contextMenu = CtxMenu('#content');

 contextMenu.addItem("Item 1", function(){
  // fired on click
});

 
contextMenu.addSeparator();


var serviceType = 'S';
//Validations
	$('#txtCardCode').focus();

/*Load Tabs*/
	//Contents
	$('#contents-tab').load('../templates/journal-entry-lines.php?serviceType=' + serviceType), function (){
		
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
				console.log('1');
            }
			else 
			{
                $(this).closest('tr').css("background-color", "lightgray");
                $(this).closest('tr').addClass('selected-det');
				console.log('2');
            }
        }
		else 
		{
            $('.selected-det').map(function () 
			{
				$(this).closest('tr').css("background-color", "transparent");
                $(this).removeClass('selected-det');
				console.log('3');
            })

            $('#tblDetails tbody > tr').css("background-color", "transparent");
			$(this).closest('tr').css("background-color", "lightgray");
            $(this).closest('tr').addClass('selected-det');
			console.log('4');
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
	
//Double Clicks
 	$(document.body).on('dblclick', '#tblBranch tbody > tr', function () 
	{
		var id = $(this).children('td.item-1').text();
		var code = $(this).children('td.item-2').text();
        var name = $(this).children('td.item-3').text();

        $('#branchModal').modal('hide');

		$('#txtBPLId').val(id);
		$('#txtBranchCode').val(code).css({'background-color': '', 'border-radius': '0px'});
		$('#txtBranchName').val(name).css({'background-color': '', 'border-radius': '0px'});
		$('#tblDetails tbody > tr').find('.bplid').val(id);
		$('#tblDetails tbody > tr').find('.branchname').val(name);

    });
    $(document.body).on('dblclick', '#tblDepartment tbody > tr', function () 
	{
		var id = $(this).children('td.item-1').text();
		var code = $(this).children('td.item-2').text();

        $('#profitcodeModal').modal('hide');

		
		$('.selected-det').find('.department').val(id);

    });
    $(document.body).on('dblclick', '#tblBranchOcr2 tbody > tr', function () 
	{
		var id = $(this).children('td.item-1').text();
		var code = $(this).children('td.item-2').text();

        $('#branchocrcode2Modal').modal('hide');

		
		$('.selected-det').find('.branchocrcode2').val(id);

    });
    $(document.body).on('dblclick', '#tblBranchOcr3 tbody > tr', function () 
	{
		var id = $(this).children('td.item-1').text();
		var code = $(this).children('td.item-2').text();

        $('#employeeorccode3Modal').modal('hide');

		
		$('.selected-det').find('.employeeorccode3').val(id);

    });
	$(document.body).on('dblclick', '#tblDoc tbody > tr', function () 
	{
		
		var docNum = $(this).children('td.item-1').text();
		var objType = 30;
		
        $('#documentModal').modal('hide');
		
		$('#txtDocNum').val(docNum);
		
		
		
		PreviewDoc(docNum, objType);
       
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
	
	$(document.body).on('dblclick', '#tblGL tbody > tr', function () 
	{
		
		let code = $(this).children('td.item-1').text();
        let name = $(this).children('td.item-2').text();
        let currentTotal = $(this).children('td.item-3').text();
        let type = $(this).children('td.item-4').text();
        let controlAccount = $(this).children('td.item-5').text();
	
		if(type == 'ACCT'){
            $('.selected-det').find('input.glaccount').val(code);
            $('.selected-det').find('input.glname').val(name);
            $('.selected-det').find('input.controlaccount').val(controlAccount);
            $('.selected-det').find('button.btnaccount').prop('disabled', true); 
            $('.selected-det').find('input.controlaccount').prop('readonly', true); 
        }
        else{
            $('.selected-det').find('input.glaccount').val(code);
            $('.selected-det').find('input.glname').val(name);
            $('.selected-det').find('input.controlaccount').val(controlAccount);
            $('.selected-det').find('input.controlaccount').prop('readonly', false); 
			
        }
		$('.btnrowfunctions').removeClass('d-none');
        $('#glModal').modal('hide');
	
		
       
	   itemCode = code;
		AddRow();
		CheckCardCode(itemCode);
    });

//caModal
$(document.body).on('dblclick', '#tblControlAccount tbody > tr', function () 
		{
			
			var code = $(this).children('td.item-1').text();
			var name = $(this).children('td.item-2').text();
			
		 
	
			$('#controlAccountModal').modal('hide');
		
			$('#txtControlAccountCode').val(code);
			$('#txtControlAccountName').val(name);
		
		   
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
	$(document.body).on('click', '#btnMinimize', function () 
	{
		$('#minimizedContainer').append("<div class='col-lg-2' style='background-color:gray;height:30px;width:30px;color:black;font-weight:bold'>Sales Order<button id='max'>max</button></div>");
		

        $('#windowmain').addClass('d-none');
	
		 
	});
	$(document.body).on('click', '#max', function () 
	{
		$('#windowmain').removeClass('d-none');
	});
	/* $(document.body).on('click', '#bpMaster', function () 
	{
		var cardCode = $('#txtCardCode').val();
		if(cardCode != '')
		{
			window.open("../../master-data/templates/business-partner-master.php?cardCode=" + cardCode, " ", "width=1130,height=550,left=220,top=110");
		}
	}); */
	
	$(document.body).on('change', '#selShipToAddress', function () 
	{
		
		let addressID = $(this).val();
		let cardCode = $('#txtCardCode').val();
		let shipArr = [];	
		let shipArr2 = [];	
		let shipList;
		let shipList2;
		$('#selShipToAddress').val(addressID);
		setTimeout(function () {
				$('#textShipToAddress').css('background-color', '');
				
				$.getJSON('../proc/views/vw_shipToAddressDetails.php?cardCode=' + cardCode + '&address=' + addressID, function (data){
					$.each(data, function (key, val){
						$('#selShipToAddress').val(val.Address);
						$('#txtShipToAddressTextArea').val(val.Street + '\n' + '\n'  + val.ZipCode + ' ' + val.City + '\n'  + val.Country );
						
							val.Street != '' ? shipArr.push('Street'): '';
							val.StreetNo != '' ? shipArr.push('StreetNo'): '';
							val.Block != '' ? shipArr.push('Block'): '';
							val.ZipCode != '' ? shipArr.push('ZipCode'): '';
							val.City != '' ? shipArr.push('City'): '';
							val.County != '' ? shipArr.push('County'): '';
							val.State != '' ? shipArr.push('State'): '';
							val.Country != '' ? shipArr.push('Country'): '';
							val.Building != '' ? shipArr.push('Building'): '';
							val.CountryCode != '' ? shipArr.push('CountryCode'): '';
							
							
							shipArr2.push(val.Street);
							shipArr2.push(val.StreetNo);
							shipArr2.push(val.Block);
							shipArr2.push(val.ZipCode);
							shipArr2.push(val.City);
							shipArr2.push(val.County);
							shipArr2.push(val.State);
							shipArr2.push(val.Country);
							shipArr2.push(val.Building);
							shipArr2.push(val.CountryCode);
							
		
						
					});
				});
				
            }, 0) 
			setTimeout(function () {
				shipList = shipArr;
				shipList2 = shipArr2;
				$('#txtShipArr').val(shipList);			
				$('#txtShipArr2').val(shipList2);			
				ShipToAddressComponent();
				}, 100) 
			
		
    });
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
				BillToAddressComponent();
				}, 100) 
		
    });
//On Change
$(document.body).on('change', '#txtDeliveryDate', function () 
{
	$('#txtRequiredDate').val($(this).val());
	
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
//Blur Dates
	$(document.body).on('blur', '#txtPostingDate2', function(){
		if ($(this).val() == '')
			return false;

		let currentVal = $(this).val();

		let dateObj = SAPDateFormater($(this).val(), true);
		if (dateObj.bool) {
			$(this).val(dateObj.value);
			$('#txtPostingDate').val(SQLDateFormater($(this).val()))
		} else {
			$(this).val('');
			portalMessage(dateObj.error, 'red', 'white');
		}
	})
	$(document.body).on('blur', '#txtDeliveryDate2', function(){
		if ($(this).val() == '')
			return false;

		let currentVal = $(this).val();

		let dateObj = SAPDateFormater($(this).val(), true);
		if (dateObj.bool) {
			$(this).val(dateObj.value);
			$('#txtDeliveryDate').val(SQLDateFormater($(this).val()))
		} else {
			$(this).val('');
			portalMessage(dateObj.error, 'red', 'white');
		}
	})

	$(document.body).on('blur', '#txtDocumentDate2', function(){
			if ($(this).val() == '')
				return false;

			let currentVal = $(this).val();

			let dateObj = SAPDateFormater($(this).val(), true);
			if (dateObj.bool) {
				$(this).val(dateObj.value);
				$('#txtDocumentDate').val(SQLDateFormater($(this).val()))
			} else {
				$(this).val('');
			portalMessage(dateObj.error, 'red', 'white');
		}
	})


	$(document.body).on('change', '#selTransactionType', function () 
	{
		serviceType =  $(this).val();
		if (serviceType == 'S'){
			$('input.quantity').val(1);
		}
		$('#contents-tab').load('../templates/sales-order-lines.php?serviceType=' + serviceType), function (){
			
		};
	});
	
//On Shown Modals
	
	$('#salesQuotationModal').on('shown.bs.modal',function(){
		
		var cardCode = $('#txtCardCode').val();
		
		
		if(cardCode == '')
		{
			
			$('#tblSQ tbody').html('');
		}
		else
		{	
			
			$.ajax({
				type: 'GET',
				url: '../proc/views/vw_copyFromSQ.php',
				data: {cardCode : cardCode},
				success: function (html) 
				{
					$('#salesQuotationResult').html(html);
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
		let shipArrToChange =  $('#txtShipArr').val().split(',');
		let shipArrToChange2 =  $('#txtShipArr2').val().split(',');
		
		setTimeout(function () {
			$('#txtStreetPOBoxS').val(shipArrToChange2[0]);
			$('#txtStreetNoS').val(shipArrToChange2[1]);
			
			$('#txtBlockS').val(shipArrToChange2[2]);
			$('#txtZipCodeS').val(shipArrToChange2[3]);
			
			$('#txtCityS').val(shipArrToChange2[4]);
			$('#txtCountyS').val(shipArrToChange2[5]);
			$('#txtStateS').val(shipArrToChange2[6]);
			$('#txtCountrySName').val(shipArrToChange2[7]);
			$('#txtBuildingS').val(shipArrToChange2[8]);
			$('#txtCountryS').val(shipArrToChange2[9]);			
		}, 200) 
		
	

		
	});
	$('#billToDetailsModal').on('shown.bs.modal',function(){
		let billArrToChange =  $('#txtBillArr').val().split(',');
		let billArrToChange2 =  $('#txtBillArr2').val().split(',');
		
		setTimeout(function () {
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
		}, 200) 

		
	});
	
//Submit
	//Crystal
	$(document.body).on('click', '#btnCrystal', function () 
	{
		// //-Create new COM object-depends on your Crystal Report version 
		// $ObjectFactory= new COM("CrystalReports115.ObjectFactory.1") or die ("Error on load"); 

		// // call COM port 
		// $crapp = $ObjectFactory-> CreateObject("CrystalRuntime.Application.11"); 

		// // create an instance for Crystal 
		// $creport = $crapp->OpenReport($my_report, 1); // call rpt report


		$.ajax({
                type: 'POST',
                url: '../proc/exec/exec_print.php',
			    success: function (data) 
				{
					alert(data)
            	}
			});
	});
	//Add
	$(document.body).on('click', '#btnAdd', function () 
	{
		var err = 0;
        var errmsg = '';
        if($('#tblDetails tbody tr').find('input.glaccount').val() == '' ){
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
	
		else if ($('#txtDebitTotal').val() != $('#txtCreditTotal').val()){
			err = 1;
			$('#messageBar2').addClass('d-none');
						$('#messageBar3').removeClass('d-none');
						$('#messageBar').text('Debit and Credit not equal!').css({'background-color': 'red', 'color': 'white'});
						
							setTimeout(function()
							{
								$('#messageBar').text('').css({'background-color': '', 'color': ''});	
								$('#messageBar2').removeClass('d-none');
							},5000)
		}
		else
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
       
		var txtPostingDate = $('#txtPostingDate').val();
		var txtDeliveryDate = $('#txtDeliveryDate').val();
		var txtDocumentDate = $('#txtDocumentDate').val();
	
		
		var txtOwnerCode = $('#txtOwnerCode').val();
		var txtRemarks = $('#txtMemo').val();
		
		var txtMemo = $('#txtMemo').val();
		var txtJournalMemo = $('#txtJournalMemo').val();

		var txtTransNo = $('#txtTransNo').val();
		var txtRef1 = $('#txtRef1').val();
		var txtRef2 = $('#txtRef2').val();
		var txtRef3 = $('#txtRef3').val();
		
		
		



	

		var json = '{';
        var otArr = [];
        var tbl = $('#tblDetails tbody tr').each(function (i) 
		{
            x = $(this).children();
            var itArr = [];
			
				if ($(this).find('input.glaccount').val() != ''){
					itArr.push('"' + $(this).find('input.glaccount').val() + '"');
					itArr.push('"' + $(this).find('input.controlaccount').val() + '"');
					itArr.push('"' + $(this).find('input.debit').val().replace(/,/g, '') + '"');
					itArr.push('"' + $(this).find('input.credit').val().replace(/,/g, '') + '"');
					itArr.push('"' + $(this).find('select.bplid').val() + '"');
					
				
				otArr.push('"' + i + '": [' + itArr.join(',') + ']'); 
				}
			
		});
		
		json += otArr.join(",") + '}';
		
	
        if (err == 0) 
		{
			
			$('#loadModal').modal('show');
            $.ajax({
                type: 'POST',
                url: '../proc/exec/exec_add_journal-entry.php',
				data: 
				{
					json: json.replace(/(\r\n|\n|\r)/gm, '[newline]'),
					udfJson: udfJson.replace(/(\r\n|\n|\r)/gm, '[newline]'),
					txtPostingDate : txtPostingDate,
					txtDeliveryDate : txtDeliveryDate,
					txtDocumentDate : txtDocumentDate,
					txtOwnerCode : txtOwnerCode,
					txtRemarks : txtRemarks,
					txtMemo : txtMemo,
					txtJournalMemo : txtJournalMemo,
					txtTransNo : txtTransNo,
					txtRef1 : txtRef1,
					txtRef2 : txtRef2,
					txtRef3 : txtRef3,
					
                },
			    success: function (data) 
				{
					var res = $.parseJSON(data);
					let addedDocEntry = res.docentry;
					if(res.valid == true)
					{
						$('#messageBar2').addClass('d-none');
						$('#messageBar3').removeClass('d-none');
						$('#messageBar').text(res.msg).css({'background-color': '#00FF7F', 'color': 'black'});
						
						
							setTimeout(function()
							{
								$('#messageBar').text('').css({'background-color': '', 'color': ''});	
							PreviewDoc(addedDocEntry,serviceType)	
							window.location.replace("../templates/journal-entry-document.php");
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

		alert('UPDATE')
		var err = 0;
        var errmsg = '';
	
		var txtTransNo = $('#txtTransNo').val();
		var txtMemo = $('#txtMemo').val();
		var txtRef1 = $('#txtRef1').val();
		var txtRef2 = $('#txtRef2').val();
		var txtRef3 = $('#txtRef3').val();
		alert(txtMemo)
		alert(txtTransNo)
	
        if (err == 0) 
		{
			$('#loadModal').modal('show');
            $.ajax({
                type: 'POST',
                url: '../proc/exec/exec_update_journal-entry.php',
				data: 
				{
					txtTransNo : txtTransNo,
					txtMemo : txtMemo,
					txtRef1 : txtRef1,
					txtRef2 : txtRef2,
					txtRef3 : txtRef3,
					
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
								
							window.location.replace("../templates/journal-entry-document.php");
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
/*Keyups*/
//Rows
	//ItemCode
	$(document.body).on('paste', '.itemcode', function (e) 
	{
	
		var $this = $(this);
    $.each(e.originalEvent.clipboardData.items, function(i, v){
		
        if (v.type === 'text/plain'){
			
            v.getAsString(function(text){
				
                var x = $this.closest('td').index(),
                    y = $this.closest('tr').index(),
                    obj = {};
                text = text.trim('\r\n');
				text2 = text.split('\r\n')
				var textArr = [];
					textArr.push(text);
				var textArrLength = text2.length;
				var rows = $('#tblDetails tbody >tr');
				var rowsLength = rows.length;
				 
				for(var i = 0; i < textArrLength; i++){
					console.log(text2[i]);
									$('#rowLoader').load('../templates/sales-order-lines-row-excel.php?serviceType=' + serviceType + '&text2=' + text2, function (result) 
									{
										$('#tblDetails tbody').append(result);
									})
										$(this).prop('disabled', false);
			
				}
				
				setTimeout(function () {
					for(var i = 0 ; i < textArrLength; i++){
							
							$('#tblDetails tbody > tr:eq(' + i + ') td.rowno').text(i + 1);
							$('#tblDetails tbody > tr:eq(' + i + ') td input.itemcode').val(text2[i]);
							$('#tblDetails tbody > tr:last td.rowno').text(i + 2);
					
					}
				},1500)
			
				
              /*   $.each(text.split('\r\n'), function(i2, v2){
					
					setTimeout(function () {
						
					$(rows[i2]).find('td input.itemcode').val(v2);
					
			
				}, 1000)  
					
				
				
				});*/
                 
                });
            
        }
		  return false;
    });
	});
	//Price
	// debit
	// credit
	$(document.body).on('keyup', '.debit', function (e) 
	{
		CheckItemCode();
		let value = $(this).val();
		let debit = $('.selected-det').find('input.debit').val();
		
			$(this).val(function(index, value) {
			value = value.replace(/,/g,'');
			return NumberWithCommas(value);
		});
		
	});
	$(document.body).on('blur', '.debit', function () 
	{
			let amount = $('.selected-det').find('input.debit').val();
			$('.selected-det').find('input.debit').val(FormatMoney(amount));
			$('.selected-det').find('input.credit').prop('disabled', true);
			ComputeDebitTotal();
	
		if($(this).val() != '0.00'){
			$('.selected-det').find('input.credit').prop('disabled', true);
		}else{
			$('.selected-det').find('input.credit').prop('disabled', false);
		}
		
	
	});
	$(document.body).on('keyup', '.credit', function (e) 
	{
		CheckItemCode();
		let value = $(this).val();
		let debit = $('.selected-det').find('input.credit').val();
		
			$(this).val(function(index, value) {
			value = value.replace(/,/g,'');
			return NumberWithCommas(value);
		});
	
	});
	$(document.body).on('blur', '.credit', function () 
	{
		let amount = $('.selected-det').find('input.credit').val();
		$('.selected-det').find('input.credit').val(FormatMoney(amount));
		
		ComputeCreditTotal();
		if($(this).val() != '0.00'){
			$('.selected-det').find('input.debit').prop('disabled', true);
		}else{
			$('.selected-det').find('input.debit').prop('disabled', false);
		}
	});
	//Branch
	
	

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
		let amount = parseFloat(discPercentage/100) * totalBeforeDiscount;
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
		let txtStreetPOBoxS = $('#txtStreetPOBoxS').val();
		let txtStreetNoS = $('#txtStreetNoS').val();
		let txtBlockS = $('#txtBlockS').val();
		let txtCityS = $('#txtCityS').val();
		let txtZipCodeS = $('#txtZipCodeS').val();
		let txtCountyS = $('#txtCountyS').val();
		let txtStateS = $('#txtStateS').val();
		let txtCountryS = $('#txtCountryS').val();
		let txtCountrySName = $('#txtCountrySName').val();
		let txtBuildingS = $('#txtBuildingS').val();
		$('#txtShipToAddressTextArea').val(txtStreetPOBoxS + '\n' + '\n' + txtZipCodeS + ' ' + txtCityS + '\n'  + txtCountrySName);
		
		let shipArr2 = [];	
		let shipList2;
							shipArr2.push(txtStreetPOBoxS);
							shipArr2.push(txtStreetNoS);
							shipArr2.push(txtBlockS);
							shipArr2.push(txtZipCodeS);
							shipArr2.push(txtCityS);
							shipArr2.push(txtCountyS);
							shipArr2.push(txtStateS);
							shipArr2.push(txtCountrySName);
							shipArr2.push(txtBuildingS);
							shipArr2.push(txtCountryS);
							
			setTimeout(function () {
				shipList2 = shipArr2;	
				$('#txtShipArr2').val(shipList2);			
				ShipToAddressComponent();
				}, 100) 
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
				BillToAddressComponent();
				}, 100) 
	});
//------------------------------------------------------------------------------------------------------------------------------------------------------------------		
/*Functions --------------------------------------------------------------------------------------------------------------------------------------------------------*/
//------------------------------------------------------------------------------------------------------------------------------------------------------------------	
/* $('input.itemcode').on('paste', function(e){
    var $this = $(this);
	alert(1);
    $.each(e.originalEvent.clipboardData.items, function(i, v){
		alert(2);
        if (v.type === 'text/plain'){
			alert(3);
            v.getAsString(function(text){
				alert(4);
                var x = $this.closest('td').index(),
                    y = $this.closest('tr').index(),
                    obj = {};
                text = text.trim('\r\n');
                $.each(text.split('\r\n'), function(i2, v2){
					alert(5);
                    $.each(v2.split('\t'), function(i3, v3){
						alert(6);
                        var row = y+i2, col = x+i3;
                        obj['cell-'+row+'-'+col] = v3;
                        $this.closest('table').find('tr:eq('+row+') td:eq('+col+') input').val(v3);
                    });
                });
                $('div').text(JSON.stringify(obj));
            });
        }
    });
    return false;
   
}); */
	function AddRow(){
		
		var rowno = 0;
			rowno = ($('#tblDetails tbody tr:last').find('td.rowno span').text() == '') ? 1 : parseFloat($('#tblDetails tbody tr:last').find('td.rowno span').text()) + 1;
		var lastItem = $('#tblDetails tbody tr:last').find('input.itemcode').val()
		
		if(lastItem != ""){
		setTimeout(function () 
			{
					
						$('#rowLoader').load('../templates/journal-entry-lines-row.php?serviceType=' + serviceType, function (result) 
						{
							$('#tblDetails tbody').append(result);

							$('#tblDetails tbody tr:last').find('td.rowno span').text(rowno);
						})
			
							$(this).prop('disabled', false);
					
					
			}, 200)
		}
	}
	
	function PreviewDoc(docNum,objType){
	
		let docstatus = '';
		let docType ='';
		if(objType == 30){
			$('#btnAdd').addClass('d-none');
			$('#btnUpdate').removeClass('d-none');
		}
		else{
			$('#btnAdd').removeClass('d-none');
			$('#btnUpdate').addClass('d-none');
			
		}
		
		
		$.getJSON('../proc/views/vw_getheaderdata.php?docNum=' + docNum + '&objType=' + objType, function (data){
			
				
            $.each(data, function (key, val){
				
				
					$('input, textarea, select').prop('disabled', true );
					$('input#txtDocNum').val(val.Number);
					$('input#txtPostingDate').val(val.RefDate);
					$('input#txtDeliveryDate').val(val.DueDate);
					$('input#txtDocumentDate').val(val.TaxDate);
					$('input#txtOrigin').val(val.Origin);
					$('input#txtOriginNo').val(val.BaseRef);
					$('input#txtMemo').val(val.Memo).prop('disabled', false );;
					$('input#txtTransNo').val(val.Number);
					$('input#txtRef1').val(val.Ref1).prop('disabled', false );;
					$('input#txtRef2').val(val.Ref2).prop('disabled', false );;
					$('input#txtRef3').val(val.Ref3).prop('disabled', false );;	
					$('input#txtDebitTotal').val(val.LocTotal);	
					$('input#txtCreditTotal').val(val.LocTotal);	

					
					
					$('.btnGroup').addClass('d-none');
					$('#btnAdd').addClass('d-none');
					$('#btnUpdate').removeClass('d-none');
				
				
			});
			
			
			setTimeout(function () 
			{
				PreviewRows(docNum,  objType,function () 
				{
					
				});
            }, 500) 


			setTimeout(function () 
			{
				var branchCode = $('#tblDetails tbody').children('tr:first').find('input.branch').val();
				var branchName = $('#tblDetails tbody').children('tr:first').find('input.branchname').val();
				$('input#txtBranchCode').val(branchCode);
				$('input#txtBranchName').val(branchName);



            }, 700) 
		
		$('#layoutOptions').prop('disabled', false );
				
		});
		setTimeout(function()
					{
						$('#txtPostingDate').trigger('change');
						$('#txtDeliveryDate').trigger('change');
						$('#txtDocumentDate').trigger('change');
					},1000);
		setTimeout(function () 
			{
				 PreviewUDF(docNum);
				  
			}, 1100) 
	}
	function PreviewRows(docNum, objType,callback){
        $('#tblDetails tbody').load('../proc/views/vw_getdetailsdata.php?docNum=' + docNum +  '&objType=' + objType, function (result) 
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
	function ShipToAddressComponent(){
			let shipArrToChange =  $('#txtShipArr').val().split(',');
			let shipArrToChange2 =  $('#txtShipArr2').val().split(',');
			
			$('#txtStreetPOBoxS').val(shipArrToChange2[0]);
			$('#txtStreetNoS').val(shipArrToChange2[1]);
			
			$('#txtBlockS').val(shipArrToChange2[2]);
			$('#txtZipCodeS').val(shipArrToChange2[3]);
			
			$('#txtCityS').val(shipArrToChange2[4]);
			$('#txtCountyS').val(shipArrToChange2[5]);
			$('#txtStateS').val(shipArrToChange2[6]);
			$('#txtCountrySName').val(shipArrToChange2[7]);
			$('#txtBuildingS').val(shipArrToChange2[8]);
			$('#txtCountryS').val(shipArrToChange2[9]);
		

			
	}
	function BillToAddressComponent(){
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
	
	}
	
	function ComputeDebitTotal(){
		let amount = 0.00;
		$('.debit').each(function()
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

		$('#txtDebitTotal').val(FormatMoney(amount));
	}
	function ComputeCreditTotal(){
		let amount = 0.00;
		$('.credit').each(function()
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
		
		$('#txtCreditTotal').val(FormatMoney(amount));
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
		$('#txtTotalBeforeDiscount').val(FormatMoney(amount));
		ComputeTotal();
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
		
		let totalBeforeDiscountFloat = isNaN(parseFloat(totalBeforeDiscount.replace(/,/g,'')))? 0: parseFloat(totalBeforeDiscount.replace(/,/g,''));
		let totalTaxAmountFloat = isNaN(parseFloat(totalTaxAmount.replace(/,/g,'')))? 0: parseFloat(totalTaxAmount.replace(/,/g,''));
		let totalDiscountFloat = isNaN(parseFloat(totalDiscount.replace(/,/g,'')))? 0: parseFloat(totalDiscount.replace(/,/g,''));
	
		
		let amount = (totalBeforeDiscountFloat + totalTaxAmountFloat) - totalDiscountFloat;
		;
		$('#txtDocTotal').val(FormatMoneyWithCurrency(amount));
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
	function SQLDateFormater(dateLiteral) {
		if (dateLiteral == '') {
			return '';
		}

		let dateObj = new Intl.DateTimeFormat('en-us', {year: 'numeric', month: '2-digit', day: '2-digit'}).formatToParts(new Date(dateLiteral));

		return `${dateObj[4].value}-${dateObj[0].value}-${dateObj[2].value}`;
	}
	
});