$(document).ready(function () {

$('#pageTitle').text('User Management | SAP B1');	

//TopBar
$(document.body).on('click', '#btnFirstRecord', function (){
	
	let docNum = '';
	
	$.getJSON('../proc/views/vw_getFirstEntry.php', function (data){
		docNum = data;
		PreviewDoc(docNum);
	});
});
$(document.body).on('click', '#btnPrevRecord', function (){
	
	let docNum = $('#txtUserId').val();
	
	if(docNum != ''){
		$.getJSON('../proc/views/vw_getPrevEntry.php?docNum=' + docNum, function (data){
			docNum = data;
			PreviewDoc(docNum);
		});
	}
	else{
			$.getJSON('../proc/views/vw_getLastEntry.php', function (data){
			docNum = data;
			PreviewDoc(docNum);
		});
	}
});
$(document.body).on('click', '#btnNextRecord', function (){
	
	let docNum = $('#txtUserId').val();
	
	if(docNum != ''){
		$.getJSON('../proc/views/vw_getNextEntry.php?docNum=' + docNum, function (data){
			docNum = data;
			PreviewDoc(docNum);
		});
	}
	else{
			$.getJSON('../proc/views/vw_getFirstEntry.php', function (data){
			docNum = data;
			PreviewDoc(docNum);
		});
	}
});
$(document.body).on('click', '#btnLastRecord', function (){
	
	let docNum = '';
	$.getJSON('../proc/views/vw_getLastEntry.php', function (data){
		docNum = data;
		PreviewDoc(docNum);
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
	
	/* $('#users-tab').load('../templates/users-users.php'), function (){
			$('#contents-tab').load('../templates/users-access.php'), function (){
		
	};
	
	};
	$('#customers-tab').load('../templates/users-customers.php'), function (){
		$('#contents-tab2').load('../templates/users-access-customers.php'), function (){
		
	}; 
	}; */



	
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
//Click
	//Check / Uncheck
	$(document.body).on('click', '#GenSet', function () 
	{
		$('#GenSet > .indetermine').addClass('d-none');
		if($('#GenSet > .checked').hasClass('d-none')){
			$('#GenSet > .checked').removeClass('d-none');
			$(this).css('background-color','#ADD8E6');
			
			$('.gensub > .checked-sub').removeClass('d-none');
			$('.gensub').css('background-color','#ADD8E6');
		
		}else{
			$('#GenSet > .checked').addClass('d-none');
			$('#GenSet > .indetermine').addClass('d-none');
			$('.gensub > .checked-sub').addClass('d-none');
			$('.gensub > .checked-sub').addClass('d-none');
			
			
			$(this).css('background-color','white');
			$('.gensub').css('background-color','white');
		}
	});
	//Check / Uncheck
	$(document.body).on('click', '#Fin', function () 
	{
		$('#Fin > .indetermine').addClass('d-none');
		if($('#Fin > .checked').hasClass('d-none')){
			$('#Fin > .checked').removeClass('d-none');
			$(this).css('background-color','#ADD8E6');
			
			$('.finsub > .checked-sub').removeClass('d-none');
			$('.finsub').css('background-color','#ADD8E6');
		
		}else{
			$('#Fin > .checked').addClass('d-none');
			$('#Fin > .indetermine').addClass('d-none');
			$('.finsub > .checked-sub').addClass('d-none');
			$('.finsub > .checked-sub').addClass('d-none');
			
			
			$(this).css('background-color','white');
			$('.finsub').css('background-color','white');
		}
	});
	//Check / Uncheck
	$(document.body).on('click', '#Inv', function () 
	{
		$('#Inv > .indetermine').addClass('d-none');
		if($('#Inv > .checked').hasClass('d-none')){
			$('#Inv > .checked').removeClass('d-none');
			$(this).css('background-color','#ADD8E6');
			
			$('.invsub > .checked-sub').removeClass('d-none');
			$('.invsub').css('background-color','#ADD8E6');
		
		}else{
			$('#Inv > .checked').addClass('d-none');
			$('#Inv > .indetermine').addClass('d-none');
			$('.invsub > .checked-sub').addClass('d-none');
			$('.invsub > .checked-sub').addClass('d-none');
			
			
			$(this).css('background-color','white');
			$('.invsub').css('background-color','white');
		}
	});
	//Check / Uncheck
	$(document.body).on('click', '#Sales', function () 
	{
		$('#Sales > .indetermine').addClass('d-none');
		if($('#Sales > .checked').hasClass('d-none')){
			$('#Sales > .checked').removeClass('d-none');
			$(this).css('background-color','#ADD8E6');
			
			$('.salessub > .checked-sub').removeClass('d-none');
			$('.salessub').css('background-color','#ADD8E6');
		
		}else{
			$('#Sales > .checked').addClass('d-none');
			$('#Sales > .indetermine').addClass('d-none');
			$('.salessub > .checked-sub').addClass('d-none');
			$('.salessub > .checked-sub').addClass('d-none');
			
			
			$(this).css('background-color','white');
			$('.salessub').css('background-color','white');
		}
	});
	//Check / Uncheck
	$(document.body).on('click', '#Purch', function () 
	{
		$('#Purch > .indetermine').addClass('d-none');
		if($('#Purch > .checked').hasClass('d-none')){
			$('#Purch > .checked').removeClass('d-none');
			$(this).css('background-color','#ADD8E6');
			
			$('.purchsub > .checked-sub').removeClass('d-none');
			$('.purchsub').css('background-color','#ADD8E6');
		
		}else{
			$('#Purch > .checked').addClass('d-none');
			$('#Purch > .indetermine').addClass('d-none');
			$('.purchsub > .checked-sub').addClass('d-none');
			$('.purchsub > .checked-sub').addClass('d-none');
			
			
			$(this).css('background-color','white');
			$('.purchsub').css('background-color','white');
		}
	});
	//Check / Uncheck
	$(document.body).on('click', '#Bank', function () 
	{
		$('#Bank > .indetermine').addClass('d-none');
		if($('#Bank > .checked').hasClass('d-none')){
			$('#Bank > .checked').removeClass('d-none');
			$(this).css('background-color','#ADD8E6');
			
			$('.banksub > .checked-sub').removeClass('d-none');
			$('.banksub').css('background-color','#ADD8E6');
		
		}else{
			$('#Bank > .checked').addClass('d-none');
			$('#Bank > .indetermine').addClass('d-none');
			$('.banksub > .checked-sub').addClass('d-none');
			$('.banksub > .checked-sub').addClass('d-none');
			
			
			$(this).css('background-color','white');
			$('.banksub').css('background-color','white');
		}
	});
	//GenSet Sub
	$(document.body).on('click', '#CANCEL', function () 
	{

		if($('#CANCEL > .checked-sub').hasClass('d-none')){
			$('#CANCEL > .checked-sub').removeClass('d-none');
			$(this).css('background-color','#ADD8E6');
			GenSetCheckBoxChecked();
			
		
		}
		
		else{
			$('#CANCEL > .checked-sub').addClass('d-none');
			$('#CANCEL > .checked-sub').addClass('d-none');
			$(this).css('background-color','white');
			GenSetCheckBoxChecked();
		}
	
	});
	$(document.body).on('click', '#CLOSING', function () 
	{
		if($('#CLOSING > .checked-sub').hasClass('d-none')){
			$('#CLOSING > .checked-sub').removeClass('d-none');
			$(this).css('background-color','#ADD8E6');
			GenSetCheckBoxChecked();
			
		
		}
		
		else{
			$('#CLOSING > .checked-sub').addClass('d-none');
			$('#CLOSING > .checked-sub').addClass('d-none');
			$(this).css('background-color','white');
			GenSetCheckBoxChecked();
		}
	
	});
	$(document.body).on('click', '#ADDON', function () 
	{
		if($('#ADDON > .checked-sub').hasClass('d-none')){
			$('#ADDON > .checked-sub').removeClass('d-none');
			$(this).css('background-color','#ADD8E6');
			GenSetCheckBoxChecked();
			
		
		}
		
		else{
			$('#ADDON > .checked-sub').addClass('d-none');
			$('#ADDON > .checked-sub').addClass('d-none');
			$(this).css('background-color','white');
			GenSetCheckBoxChecked();
		}
	
	});
	$(document.body).on('click', '#APPT', function () 
	{
		if($('#APPT > .checked-sub').hasClass('d-none')){
			$('#APPT > .checked-sub').removeClass('d-none');
			$(this).css('background-color','#ADD8E6');
			GenSetCheckBoxChecked();
			
		
		}
		
		else{
			$('#APPT > .checked-sub').addClass('d-none');
			$('#APPT > .checked-sub').addClass('d-none');
			$(this).css('background-color','white');
			GenSetCheckBoxChecked();
		}
	
	});
	$(document.body).on('click', '#APPR', function () 
	{
		if($('#APPR > .checked-sub').hasClass('d-none')){
			$('#APPR > .checked-sub').removeClass('d-none');
			$(this).css('background-color','#ADD8E6');
			GenSetCheckBoxChecked();
			
		
		}
		
		else{
			$('#APPR > .checked-sub').addClass('d-none');
			$('#APPR > .checked-sub').addClass('d-none');
			$(this).css('background-color','white');
			GenSetCheckBoxChecked();
		}
	
	});
	//Fin Sub
	$(document.body).on('click', '#OJDT', function () 
	{
		if($('#OJDT > .checked-sub').hasClass('d-none')){
			$('#OJDT > .checked-sub').removeClass('d-none');
			$(this).css('background-color','#ADD8E6');
			InvCheckBoxChecked();
			
		
		}
		
		else{
			$('#OJDT > .checked-sub').addClass('d-none');
			$('#OJDT > .checked-sub').addClass('d-none');
			$(this).css('background-color','white');
			InvCheckBoxChecked();
		}
	
	});
	//Inv Sub
	$(document.body).on('click', '#OIGN', function () 
	{
		if($('#OIGN > .checked-sub').hasClass('d-none')){
			$('#OIGN > .checked-sub').removeClass('d-none');
			$(this).css('background-color','#ADD8E6');
			InvCheckBoxChecked();
			
		
		}
		
		else{
			$('#OIGN > .checked-sub').addClass('d-none');
			$('#OIGN > .checked-sub').addClass('d-none');
			$(this).css('background-color','white');
			InvCheckBoxChecked();
		}
	
	});
	$(document.body).on('click', '#OIGE', function () 
	{
		if($('#OIGE > .checked-sub').hasClass('d-none')){
			$('#OIGE > .checked-sub').removeClass('d-none');
			$(this).css('background-color','#ADD8E6');
			InvCheckBoxChecked();
			
		
		}
		
		else{
			$('#OIGE > .checked-sub').addClass('d-none');
			$('#OIGE > .checked-sub').addClass('d-none');
			$(this).css('background-color','white');
			InvCheckBoxChecked();
		}
	
	});
	$(document.body).on('click', '#OWTR', function () 
	{
		if($('#OWTR > .checked-sub').hasClass('d-none')){
			$('#OWTR > .checked-sub').removeClass('d-none');
			$(this).css('background-color','#ADD8E6');
			InvCheckBoxChecked();
			
		
		}
		
		else{
			$('#OWTR > .checked-sub').addClass('d-none');
			$('#OWTR > .checked-sub').addClass('d-none');
			$(this).css('background-color','white');
			InvCheckBoxChecked();
		}
	
	});
	//Sales Sub
	$(document.body).on('click', '#OQUT', function () 
	{
		if($('#OQUT > .checked-sub').hasClass('d-none')){
			$('#OQUT > .checked-sub').removeClass('d-none');
			$(this).css('background-color','#ADD8E6');
			SalesCheckBoxChecked();
			
		
		}
		
		else{
			$('#OQUT > .checked-sub').addClass('d-none');
			$('#OQUT > .checked-sub').addClass('d-none');
			$(this).css('background-color','white');
			SalesCheckBoxChecked();
		}
	
	});
	$(document.body).on('click', '#ORDR', function () 
	{
		if($('#ORDR > .checked-sub').hasClass('d-none')){
			$('#ORDR > .checked-sub').removeClass('d-none');
			$(this).css('background-color','#ADD8E6');
			SalesCheckBoxChecked();
			
		
		}
		
		else{
			$('#ORDR > .checked-sub').addClass('d-none');
			$('#ORDR > .checked-sub').addClass('d-none');
			$(this).css('background-color','white');
			SalesCheckBoxChecked();
		}
	
	});
	$(document.body).on('click', '#ODLN', function () 
	{
		if($('#ODLN > .checked-sub').hasClass('d-none')){
			$('#ODLN > .checked-sub').removeClass('d-none');
			$(this).css('background-color','#ADD8E6');
			SalesCheckBoxChecked();
			
		
		}
		
		else{
			$('#ODLN > .checked-sub').addClass('d-none');
			$('#ODLN > .checked-sub').addClass('d-none');
			$(this).css('background-color','white');
			SalesCheckBoxChecked();
		}
	
	});
	$(document.body).on('click', '#OINV', function () 
	{
		if($('#OINV > .checked-sub').hasClass('d-none')){
			$('#OINV > .checked-sub').removeClass('d-none');
			$(this).css('background-color','#ADD8E6');
			SalesCheckBoxChecked();
			
		
		}
		
		else{
			$('#OINV > .checked-sub').addClass('d-none');
			$('#OINV > .checked-sub').addClass('d-none');
			$(this).css('background-color','white');
			SalesCheckBoxChecked();
		}
	
	});
	
	//Purchase Sub
	$(document.body).on('click', '#OPRQ', function () 
	{
		if($('#OPRQ > .checked-sub').hasClass('d-none')){
			$('#OPRQ > .checked-sub').removeClass('d-none');
			$(this).css('background-color','#ADD8E6');
			PurchCheckBoxChecked();
			
		
		}
		
		else{
			$('#OPRQ > .checked-sub').addClass('d-none');
			$('#OPRQ > .checked-sub').addClass('d-none');
			$(this).css('background-color','white');
			PurchCheckBoxChecked();
		}
	
	});
	$(document.body).on('click', '#OPOR', function () 
	{
		if($('#OPOR > .checked-sub').hasClass('d-none')){
			$('#OPOR > .checked-sub').removeClass('d-none');
			$(this).css('background-color','#ADD8E6');
			PurchCheckBoxChecked();
			
		
		}
		
		else{
			$('#OPOR > .checked-sub').addClass('d-none');
			$('#OPOR > .checked-sub').addClass('d-none');
			$(this).css('background-color','white');
			PurchCheckBoxChecked();
		}
	
	});
	$(document.body).on('click', '#OPDN', function () 
	{
		if($('#OPDN > .checked-sub').hasClass('d-none')){
			$('#OPDN > .checked-sub').removeClass('d-none');
			$(this).css('background-color','#ADD8E6');
			PurchCheckBoxChecked();
			
		
		}
		
		else{
			$('#OPDN > .checked-sub').addClass('d-none');
			$('#OPDN > .checked-sub').addClass('d-none');
			$(this).css('background-color','white');
			PurchCheckBoxChecked();
		}
	
	});
	$(document.body).on('click', '#OPCH', function () 
	{
		if($('#OPCH > .checked-sub').hasClass('d-none')){
			$('#OPCH > .checked-sub').removeClass('d-none');
			$(this).css('background-color','#ADD8E6');
			PurchCheckBoxChecked();
			
		
		}
		
		else{
			$('#OPCH > .checked-sub').addClass('d-none');
			$('#OPCH > .checked-sub').addClass('d-none');
			$(this).css('background-color','white');
			PurchCheckBoxChecked();
		}
	
	});
	$(document.body).on('click', '#OPDI', function () 
	{
		if($('#OPDI > .checked-sub').hasClass('d-none')){
			$('#OPDI > .checked-sub').removeClass('d-none');
			$(this).css('background-color','#ADD8E6');
			PurchCheckBoxChecked();
			
		
		}
		
		else{
			$('#OPDI > .checked-sub').addClass('d-none');
			$('#OPDI > .checked-sub').addClass('d-none');
			$(this).css('background-color','white');
			PurchCheckBoxChecked();
		}
	
	});
	$(document.body).on('click', '#OPCM', function () 
	{
		if($('#OPCM > .checked-sub').hasClass('d-none')){
			$('#OPCM > .checked-sub').removeClass('d-none');
			$(this).css('background-color','#ADD8E6');
			PurchCheckBoxChecked();
			
		
		}
		
		else{
			$('#OPCM > .checked-sub').addClass('d-none');
			$('#OPCM > .checked-sub').addClass('d-none');
			$(this).css('background-color','white');
			PurchCheckBoxChecked();
		}
	
	});

	//Banking Module
	$(document.body).on('click', '#ORCT', function () 
	{
		if($('#ORCT > .checked-sub').hasClass('d-none')){
			$('#ORCT > .checked-sub').removeClass('d-none');
			$(this).css('background-color','#ADD8E6');
			BankCheckBoxChecked();
			
		
		}
		
		else{
			$('#ORCT > .checked-sub').addClass('d-none');
			$('#ORCT > .checked-sub').addClass('d-none');
			$(this).css('background-color','white');
			BankCheckBoxChecked();
		}
	
	});
	$(document.body).on('click', '#OVPM', function () 
	{
		if($('#OVPM > .checked-sub').hasClass('d-none')){
			$('#OVPM > .checked-sub').removeClass('d-none');
			$(this).css('background-color','#ADD8E6');
			BankCheckBoxChecked();
			
		
		}
		
		else{
			$('#OVPM > .checked-sub').addClass('d-none');
			$('#OVPM > .checked-sub').addClass('d-none');
			$(this).css('background-color','white');
			BankCheckBoxChecked();
		}
	
	});
	//Double Clicks
	$(document.body).on('dblclick', '#tblDoc tbody > tr', function () 
	{
		
		var docNum = $(this).children('td.item-1').text();
	
        $('#documentModal').modal('hide');
		
		$('#txtUserId').val(docNum);
		
		
		PreviewDoc(docNum);
       
    });
	$(document.body).on('dblclick', '#tblPR tbody > tr', function () 
	{
		
		var docNum = $(this).children('td.item-1').text();
		var objType = 1470000113;
		
        $('#purchaseRequestModal').modal('hide');
		
		$('#txtBaseEntry').val(docNum);
		
		$('#btnAdd').removeClass('d-none');
		$('#btnUpdate').addClass('d-none');
		
		PreviewDoc(docNum, objType);
       
    });
	

	$(document.body).on('dblclick', '#tblEmployee tbody > tr', function () 
	{
		
		var code = $(this).children('td.item-1').text();
        var name = $(this).children('td.item-2').text();
		
     

        $('#empModal').modal('hide');
	
		$('#txtEmpCode').val(code).css({'background-color': '', 'border-radius': '0px'});
		$('#txtEmpName').val(name).css({'background-color': '', 'border-radius': '0px'});
		
		
	
       
    });
	$(document.body).on('dblclick', '#tblCustomer tbody > tr', function () 
	{
		
		var code = $(this).children('td.item-5').text();
        var name = $(this).children('td.item-2').text();
		
     

        $('#custModal').modal('hide');
	
		$('#txtCustCode').val(code).css({'background-color': '', 'border-radius': '0px'});
		$('#txtCustName').val(name).css({'background-color': '', 'border-radius': '0px'});
		
		
	
       
    });
	
//On Change

	
	$(document.body).on('change', '#txtDeliveryDate', function () 
	{
		$('#txtRequiredDate').val($(this).val());
		
	});
	$(document.body).on('change', '#txtPostingDate', function () 
	{
		$('#txtDocumentDate').val($(this).val());
		
	});
	$(document.body).on('change', '#selTransactionType', function () 
	{
		serviceType =  $(this).val();
		if (serviceType == 'S'){
			$('input.quantity').val(1);
		}
		$('#contents-tab').load('../templates/purchase-order-lines.php?serviceType=' + serviceType), function (){
			
		};
	});

//On Shown Modals

	//Main Modules
	$(document.body).on('change', '#GenSet', function () 
	{	if(this.checked) {
			
			$('#CANCEL').prop('checked', true);
			$('#CLOSE').prop('checked', true);
		}
		else{
			
			$('#CANCEL').prop('checked', false);
			$('#CLOSE').prop('checked', false);
		}
	});
	$(document.body).on('change', '#Inv', function () 
	{	if(this.checked) {
			
			$('#OWTR').prop('checked', true);
		}
		else{
			
			$('#OWTR').prop('checked', false);
		}
	});
	$(document.body).on('change', '#Sales', function () 
	{	if(this.checked) {
			
			$('#OQUT').prop('checked', true);
			$('#ORDR').prop('checked', true);
		}
		else{
			
			$('#OQUT').prop('checked', false);
			$('#ORDR').prop('checked', false);
		}
	});
	$(document.body).on('change', '#Purch', function () 
	{	if(this.checked) {
			
			$('#OPRQ').prop('checked', true);
			$('#OPOR').prop('checked', true);
		}
		else{
			
			$('#OPRQ').prop('checked', false);
			$('#OPOR').prop('checked', false);
		}
	});
	//Sub Modules
	$(document.body).on('change', '.GenSetSubModule', function () 
	{	if(this.checked) {
			
			$('#GenSet').prop('checked', true);
		}
		else{
			
			$('#GenSet').prop('checked', false);
		}
	});
	$(document.body).on('change', '.InvSubModule', function () 
	{	if(this.checked) {
			
			$('#Inv').prop('checked', true);
		}
		else{
			
			$('#Inv').prop('checked', false);
		}
	});
	$(document.body).on('change', '.SalesSubModule', function () 
	{	if(this.checked) {
			
			$('#Sales').prop('checked', true);
		}
		else{
			
			$('#Sales').prop('checked', false);
		}
	});
	$(document.body).on('change', '.PurchSubModule', function () 
	{	if(this.checked) {
			
			$('#Purch').prop('checked', true);
		}
		else{
			
			$('#Purch').prop('checked', false);
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
	

	
//Submit
	//Add User
	$(document.body).on('click', '#btnAddUser', function () 
	{
		
		var err = 0;
        var errmsg = '';
		if($('#txtEmpCode').val() == '' ){
			err = 1;
			$('#messageBar2').addClass('d-none');
						$('#messageBar3').removeClass('d-none');
						$('#messageBar').text('Select Employee first!').css({'background-color': 'red', 'color': 'white'});
						
							setTimeout(function()
							{
								$('#messageBar').text('').css({'background-color': '', 'color': ''});	
								$('#messageBar2').removeClass('d-none');
							},5000)
		}
		
		var txtEmpCode = $('#txtEmpCode').val();
		var txtUserCode = $('#txtUserCode').val();
		var txtEmpName = $('#txtEmpName').val();
		var txtPassword = $('#txtPassword').val();
		var chkAdmin = '';
		var chkLocked = '';
		// PCTP ACCESS

		var SUMMARY = $('#SUMMARY').val();
		var POD = $('#POD').val();
		var BILLING = $('#BILLING').val();
		var TP = $('#TP').val();
		var PRICING = $('#PRICING').val();
		var TREASURY = $('#TREASURY').val();

		
		if($('#chkAdmin').is(':checked')) {
			chkAdmin = 'Y';
		}
		else{
			chkAdmin = 'N';
		}
		if($('#chkLocked').is(':checked')) {
			chkLocked = 'Y';
		}
		else{
			chkLocked = 'N';
		}
		
		
		var chkMainModule = new Array();
		$('.mainModule').each(function() 
		{
		
			if(!$(this).find(".checked").hasClass('d-none') || !$(this).find(".indetermine").hasClass('d-none')){
				chkMainModule.push($(this).attr('id'));
			}
			
			else{
				
			}
			
		});
		
    	var chkModule = new Array();
		$('.subModule').each(function() 
		{
		
			if(!$(this).find(".checked-sub").hasClass('d-none')){
				chkModule.push($(this).attr('id'));
			}
			else{
				
			}
			
		});
		
        if (err == 0) 
		{
			
			$('#loadModal').modal('show');
            $.ajax({
                type: 'POST',
                url: '../proc/exec/exec_add_user.php',
				data: 
				{
					txtEmpCode : txtEmpCode,
					txtUserCode : txtUserCode,
					txtEmpName : txtEmpName,
					txtPassword : txtPassword,
					chkAdmin : chkAdmin,
					chkLocked: chkLocked,
					chkMainModule : chkMainModule,
					chkModule : chkModule,
					SUMMARY:SUMMARY,
					POD:POD,
					BILLING:BILLING,
					TP:TP,
					PRICING:PRICING,
					TREASURY:TREASURY
				
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
								
							window.location.replace("../templates/users-document.php");
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
//Update	
	$(document.body).on('click', '#btnUpdateUser', function () 
	{
		var err = 0;
        var errmsg = '';
		if($('#txtEmpCode').val() == '' ){
			err = 1;
			$('#messageBar2').addClass('d-none');
						$('#messageBar3').removeClass('d-none');
						$('#messageBar').text('Select Employee first!').css({'background-color': 'red', 'color': 'white'});
						
							setTimeout(function()
							{
								$('#messageBar').text('').css({'background-color': '', 'color': ''});	
								$('#messageBar2').removeClass('d-none');
							},5000)
		}
		
		var txtUserId = $('#txtUserId').val();
		var txtEmpCode = $('#txtEmpCode').val();
		var txtUserCode = $('#txtUserCode').val();
		var txtEmpName = $('#txtEmpName').val();
		var txtPassword = $('#txtPassword').val();

		// PCTP ACCESS

		var SUMMARY = $('#SUMMARY').val();
		var POD = $('#POD').val();
		var BILLING = $('#BILLING').val();
		var TP = $('#TP').val();
		var PRICING = $('#PRICING').val();
		var TREASURY = $('#TREASURY').val();

		var chkAdmin = '';
		var chkLocked = '';
		
		if($('#chkAdmin').is(':checked')) {
			chkAdmin = 'Y';
		}
		else{
			chkAdmin = 'N';
		}
		if($('#chkLocked').is(':checked')) {
			chkLocked = 'Y';
		}
		else{
			chkLocked = 'N';
		}
		
		
		var chkMainModule = new Array();
		$('.mainModule').each(function() 
		{
		
			if(!$(this).find(".checked").hasClass('d-none') || !$(this).find(".indetermine").hasClass('d-none')){
				chkMainModule.push($(this).attr('id'));
			}
			
			else{
				
			}
			
		});
		
    	var chkModule = new Array();
		$('.subModule').each(function() 
		{
		
			if(!$(this).find(".checked-sub").hasClass('d-none')){
				chkModule.push($(this).attr('id'));
			}
			else{
				
			}
			
		});
		
        if (err == 0) 
		{
			
			$('#loadModal').modal('show');
            $.ajax({
                type: 'POST',
                url: '../proc/exec/exec_update_user.php',
				data: 
				{
					txtUserId : txtUserId,
					txtEmpCode : txtEmpCode,
					txtUserCode : txtUserCode,
					txtEmpName : txtEmpName,
					txtPassword : txtPassword,
					chkAdmin : chkAdmin,
					chkLocked : chkLocked,
					chkMainModule : chkMainModule,
					chkModule : chkModule,
					SUMMARY:SUMMARY,
					POD:POD,
					BILLING:BILLING,
					TP:TP,
					PRICING:PRICING,
					TREASURY:TREASURY
				
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
								
							window.location.replace("../templates/users-document.php");
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

//Add Customer
	$(document.body).on('click', '#btnAddCust', function () 
	{
		
		var err = 0;
        var errmsg = '';
		if($('#txtCustCode').val() == '' ){
			err = 1;
			$('#messageBar2').addClass('d-none');
						$('#messageBar3').removeClass('d-none');
						$('#messageBar').text('Select Customer first!').css({'background-color': 'red', 'color': 'white'});
						
							setTimeout(function()
							{
								$('#messageBar').text('').css({'background-color': '', 'color': ''});	
								$('#messageBar2').removeClass('d-none');
							},5000)
		}
		
		var txtEmpCode = $('#txtCustCode').val();
		var txtUserCode = $('#txtCustCode').val();
		var txtUserName = $('#txtCustName').val();
		var txtPassword = $('#txtCustPassword').val();
		var chkAdmin = '';
		var chkLocked = '';
		
	
		if($('#chkLocked').is(':checked')) {
			chkLocked = 'Y';
		}
		else{
			chkLocked = 'N';
		}
		
		
		var chkMainModule = new Array();
		$('input[name="chkMainModule[]"]:checked').each(function() 
		{
			chkMainModule.push($(this).val());
		});
		
    	var chkModule = new Array();
		$('input[name="chkModule[]"]:checked').each(function() 
		{
			chkModule.push($(this).val());
		});
		
        if (err == 0) 
		{
			
			$('#loadModal').modal('show');
            $.ajax({
                type: 'POST',
                url: '../proc/exec/exec_add_cust.php',
				data: 
				{
					txtEmpCode : txtEmpCode,
					txtUserCode : txtUserCode,
					txtUserName : txtUserName,
					txtPassword : txtPassword,
					
					chkLocked: chkLocked,
					chkMainModule : chkMainModule,
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
								
							window.location.replace("../templates/users-document.php");
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

//------------------------------------------------------------------------------------------------------------------------------------------------------------------		
/*Functions --------------------------------------------------------------------------------------------------------------------------------------------------------*/
//------------------------------------------------------------------------------------------------------------------------------------------------------------------		
	function AddRow(){
		
		var rowno = 0;
			rowno = ($('#tblDetails tbody tr:last').find('td.rowno span').text() == '') ? 1 : parseFloat($('#tblDetails tbody tr:last').find('td.rowno span').text()) + 1;
		var lastItem = $('#tblDetails tbody tr:last').find('input.itemcode').val()
		
		if(lastItem != ""){
		setTimeout(function () 
			{
					
						$('#rowLoader').load('../templates/purchase-order-lines-row.php?serviceType=' + serviceType, function (result) 
						{
							$('#tblDetails tbody').append(result);

							$('#tblDetails tbody tr:last').find('td.rowno span').text(rowno);
						})
			
							$(this).prop('disabled', false);
					
					
			}, 200)
		}
	}
	
	function PreviewDoc(docNum){
		$('input').prop('checked', false);
		$.getJSON('../proc/views/vw_getheaderdata.php?docNum=' + docNum, function (data){
			
				$.each(data, function (key, val){
					$('#txtUserId').val(val.DocNum);
					$('#txtUserCode').val(val.UserCode);
					$('#txtUserName').val(val.Name);
					$('#txtEmpCode').val(val.EmpId);
					$('#txtEmpName').val(val.EmpName);
					$('#SUMMARY').val(val.SUMMARY);
					$('#POD').val(val.POD);
					$('#BILLING').val(val.BILLING);
					$('#TP').val(val.TP);
					$('#PRICING').val(val.PRICING);
					$('#TREASURY').val(val.TREASURY);

					if(val.SuperUser == 'Y'){
						$('#chkAdmin').prop('checked', true);
					}
					else{
						$('#chkAdmin').prop('checked', false);
					}
					if(val.Locked == 'Y'){
						$('#chkLocked').prop('checked', true);
					}
					else{
						$('#chkLocked').prop('checked', false);
					}
					var MainModule = val.MainModule.split(', ');
					
				 	
					var Module = val.Module.split(', ');
				
							var fLen, i;
							fLen = Module.length;
							for (i = 0; i < fLen; i++) 
							{
								$('#'+Module[i]+'').find('.checked-sub').removeClass('d-none');
								$('#'+Module[i]+'').css('background-color','#ADD8E6');
							}
							GenSetCheckBoxChecked();
							FinCheckBoxChecked();
							InvCheckBoxChecked();
							SalesCheckBoxChecked();
							PurchCheckBoxChecked();
							BankCheckBoxChecked();
							
				
					$('#btnAddUser').addClass('d-none');
					$('#btnUpdateUser').removeClass('d-none');
		
				});
			});
	}
	function PreviewRows(docNum, docType, objType,callback){
        $('#tblDetails tbody').load('../proc/views/vw_getdetailsdata.php?docNum=' + docNum + '&docType=' + docType + '&objType=' + objType, function (result) 
		{
            callback();
		});
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
		console.log(amount);
		$('.selected-det').find('input.taxamount').val(FormatMoney(amount));
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
	
});