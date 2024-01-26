$(document).ready(function () {
	let mainTable = 'OVPM';
	let mainFileName = 'outgoing-payments'
	$('#pageTitle').text('Outgoing Payments | SAP B1');
	//TopBar
	setTimeout(function()
		{
			$('#txtPostingDate').trigger('change');
			$('#txtDeliveryDate').trigger('change');
			$('#txtDocumentDate').trigger('change');
		},1000);
	
	
	$(document.body).on('click', '#btnFirstRecord', function (){
		let table = 'OVPM';
		let docNum = '';
		let objType = 46;
		$.getJSON('../proc/views/vw_getFirstEntry.php?table=' + table, function (data){
			docNum = data;
			PreviewDoc(docNum,objType);
		});
	});
	$(document.body).on('click', '#btnPrint', function () 
		{
			let layout = $('#layoutOptions').val();
			var docentry = $('#txtDocEntry').val();
			
			if(docentry != '')
			{ 
				 if(layout =='PaymentVoucherAPVOVPM'){
					window.open("../forms/PaymentVoucherAPVOVPM.php?docentry=" + encodeURI(docentry),"", "width=1130,height=550,left=220,top=110");
				}
				else if(layout =='PaymentVoucherTransferOVPM'){
					window.open("../forms/PaymentVoucherTransferOVPM.php?docentry=" + encodeURI(docentry),"", "width=1130,height=550,left=220,top=110");
				}
				
			}
		});
	$(document.body).on('click', '#btnPrevRecord', function (){
		let table = 'OVPM';
		let objType = 46;
		let docNum = $('#txtDocEntry').val();
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
		let table = 'OVPM';
		let objType = 46;
		let docNum = $('#txtDocEntry').val();
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
		let table = 'OVPM';
		let docNum = '';
		let objType = 46;
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
	
	
	
	$(document.body).on('click', '#chkPayNoDoc', function () 
	{
		if($(this).prop('checked') == true){
			tblDetails
			txtGLCodePayNoDoc

			$('#txtNoDocSum').prop('readonly', false); 
			$('.paynodoc').removeClass('d-none');
	
		}
		else{
			$('#txtNoDocSum').prop('readonly', true);
			$('.paynodoc').addClass('d-none');
		}
		
	});
	$(document.body).on('click', '.chkBoxManualCheck', function () 
	{
		if($(this).prop('checked') == true){
			$(this).closest('tr').find('.checkno').prop('readonly', false);
		}
		else{
			$(this).closest('tr').find('.checkno').prop('readonly', true);
		}
		
	});
	$(document.body).on('click', '.chkboxInvoice', function () 
	{
			if($(this).prop('checked') == true){
				let payment = $(this).closest('tr').find('input.balancedue2').val()
				$(this).closest('tr').find('input.totalpayment').val(payment)
			}
			else{
				$(this).closest('tr').find('input.totalpayment').val(0.00)
			} 
	
		
			let value = $(this).val();
			let payment = $(this).closest('tr').find('input.totalpayment').val();
			let balance = $(this).closest('tr').find('input.balancedue2').val();
			
				$(this).val(function(index, value) {
				value = value.replace(/,/g,'');
				return NumberWithCommas(value);
	
			});
			
			$(this).closest('tr').find('input.totalpayment').trigger('blur');
			$(this).closest('tr').find('input.balancedue').val(ComputeBalanceDue(balance,payment));
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
	
	
		$('#txtCardCode').focus();
	
	var serviceType = 'S';
	//Validations
		$('#txtCardCode').focus();
	
	/*Load Tabs*/
		//Contents
		$('#contents-tab').load('../templates/outgoing-payments-lines.php?serviceType=' + serviceType), function (){
			
		};
		//Attachments
		$('#attachments-tab').load('../templates/' + mainFileName + '-attachments.php'), function(){

		};
		$('#checks-tab').load('../templates/outgoing-payments-check-lines.php'), function (){
			
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
	
	
		$(document.body).on('click', '#tblCheck tbody > tr > td.rowno', function () 
		{
			if (window.event.ctrlKey) 
			{
				if ($(this).closest('tr').hasClass('selected-det-check')) 
				{
					$(this).closest('tr').css("background-color", "transparent");
					$(this).closest('tr').removeClass('selected-det-check');
					console.log('1');
				}
				else 
				{
					$(this).closest('tr').css("background-color", "lightgray");
					$(this).closest('tr').addClass('selected-det-check');
					console.log('2');
				}
			}
			else 
			{
				$('.selected-det-check').map(function () 
				{
					$(this).closest('tr').css("background-color", "transparent");
					$(this).removeClass('selected-det-check');
					console.log('3');
				})
	
				$('#tblCheck tbody > tr').css("background-color", "transparent");
				$(this).closest('tr').css("background-color", "lightgray");
				$(this).closest('tr').addClass('selected-det-check');
				console.log('4');
			}
			
		});
		$(document.body).on('click', '#tblCheck > tbody tr > td > div.input-group', function () 
		{
			$('input').css('background-color', '');
			$('.selected-det-check').map(function () 
			{
				$(this).removeClass('selected-det-check');
				$(this).css("background-color", "transparent");
			})
			
			$(this).closest('tr').css("background-color", "lightgray");
			$(this).closest('tr').addClass('selected-det-check');
			
			$(this).children('input').css('background-color', '#fdfd96');
			
		});
		$(document.body).on('focus', '#tblCheck input, #tblCheck select, #tblCheck textarea', function () 
		{
			if (window.event.ctrlKey) 
			{
				$(this).closest('tr').css("background-color", "lightgray");
				$(this).closest('tr').addClass('selected-det-check');
			}
			else
			{
				$('.selected-det-check').map(function () 
				{
					$(this).removeClass('selected-det-check');
				})
	
				$('#tblCheck tbody > tr').css("background-color", "transparent");
				$(this).closest('tr').css("background-color", "lightgray");
				$(this).closest('tr').addClass('selected-det-check');
			}
			
		});
		
		$(document.body).on('click', '#tblAttachment tbody > tr > td.rowno', function () {
			if (window.event.ctrlKey) {
				if ($(this).closest('tr').hasClass('selected-det-attachment')) {
					$(this).closest('tr').css("background-color", "transparent");
					$(this).closest('tr').removeClass('selected-det-attachment');
				}
				else {
					$(this).closest('tr').css("background-color", "lightgray");
					$(this).closest('tr').addClass('selected-det-attachment');
				}
			}
			else {
				$('.selected-det-attachment').map(function () {
					$(this).closest('tr').css("background-color", "transparent");
					$(this).removeClass('selected-det-attachment');
				})
	
				$('#tblAttachment tbody > tr').css("background-color", "transparent");
				$(this).closest('tr').css("background-color", "lightgray");
				$(this).closest('tr').addClass('selected-det-attachment');
			}
	
		});
		$(document.body).on('click', '#tblAttachment > tbody tr > td > div.input-group', function () {
			$('input').css('background-color', '');
			$('.selected-det-attachment').map(function () {
				$(this).removeClass('selected-det-attachment');
				$(this).css("background-color", "transparent");
			})
	
			$(this).closest('tr').css("background-color", "lightgray");
			$(this).closest('tr').addClass('selected-det-attachment');
	
			$(this).children('input').css('background-color', '#fdfd96');
	
		});
		$(document.body).on('focus', '#tblAttachment input, #tblAttachment select, #tblAttachment textarea', function () {
			if (window.event.ctrlKey) {
				$(this).closest('tr').css("background-color", "lightgray");
				$(this).closest('tr').addClass('selected-det-attachment');
			}
			else {
				$('.selected-det-attachment').map(function () {
					$(this).removeClass('selected-det-attachment');
				})
	
				$('#tblAttachment tbody > tr').css("background-color", "transparent");
				$(this).closest('tr').css("background-color", "lightgray");
				$(this).closest('tr').addClass('selected-det-attachment');
			}
	
		});
		$(document.body).on('change', 'input.file', function (event) {


			let targetPath = 'C:/Users/Administrator/Desktop/JCBA/ATTACHMENTS/';
	
	
			// $('#tblAttachment > tbody tr').each(function(){
	
	
	
			// 	$(this).find('input.targetpath').val(targetPath);
	
			// 	// itemnameElement.value = fileName;
			// 	// alert(itemnameElement.value = fileName)
			// });
	
	
	
			// inputElement.click();
			AddRowAttachment();
		});


	//Double Clicks
		$(document.body).on('dblclick', '#tblDoc tbody > tr', function () 
		{
			
			var docNum = $(this).children('td.item-1').text();
			var docentry = $(this).children('td.item-2').text();
			var objType = 46;
			
			$('#documentModal').modal('hide');
			
			$('#txtDocNum').val(docNum);
			$('#txtDocEntry').val(docentry);
			
			
			
			PreviewDoc(docentry, objType);
		   
		});
		$(document.body).on('dblclick', '#tblBranch tbody > tr', function () 
		{
			var id = $(this).children('td.item-1').text();
			var code = $(this).children('td.item-2').text();
			var name = $(this).children('td.item-3').text();
			var series = $(this).children('td.item-4').text();
	
			$('#branchModal').modal('hide');
	
			
			$('#txtBranchCode').val(code).css({'background-color': '', 'border-radius': '0px'});
			$('#txtBranchName').val(name).css({'background-color': '', 'border-radius': '0px'});
			$('#txtSeriesOVPM').val(series);
			$('#txtSeriesNameOVPM').val(code);
			if($('#selTransactionType').val() == 'S'){
				generateRows();
			}else{
	
			}
		
		});
		//OcrCode Vendor Type
		$(document.body).on('dblclick', '#tblOcrCodeVendor tbody > tr', function () 
		{
			
			var code = $(this).children('td.item-1').text();
			var name = $(this).children('td.item-2').text();
	
			$('#ocrCodeModalVendorType').modal('hide');
		
			$('.selected-det').find('input.ocrcodevendor').val(code);
		});
		$(document.body).on('dblclick', '#tblOcrCode2Vendor tbody > tr', function () 
		{
			
			var code = $(this).children('td.item-1').text();
			var name = $(this).children('td.item-2').text();
	
			$('#ocrCode2ModalVendorType').modal('hide');
		
			$('.selected-det').find('input.ocrcode2vendor').val(code);
		});
		$(document.body).on('dblclick', '#tblOcrCode3Vendor tbody > tr', function () 
		{
			
			var code = $(this).children('td.item-1').text();
			var name = $(this).children('td.item-2').text();
	
			$('#ocrCode3ModalVendorType').modal('hide');
		
			$('.selected-det').find('input.ocrcode3vendor').val(code);
		});
		//OcrCode Account Type
		$(document.body).on('dblclick', '#tblOcrCodeAccount tbody > tr', function () 
		{
			
			var code = $(this).children('td.item-1').text();
			var name = $(this).children('td.item-2').text();
	
			$('#ocrCodeModalAcctType').modal('hide');
		
			$('.selected-det').find('input.ocrcode').val(code);
		});
		$(document.body).on('dblclick', '#tblOcrCode2Account tbody > tr', function () 
		{
			
			var code = $(this).children('td.item-1').text();
			var name = $(this).children('td.item-2').text();
	
			$('#ocrCode2ModalAcctType').modal('hide');
		
			$('.selected-det').find('input.ocrcode2').val(code);
		});
		$(document.body).on('dblclick', '#tblOcrCode3Account tbody > tr', function () 
		{
			
			var code = $(this).children('td.item-1').text();
			var name = $(this).children('td.item-2').text();
	
			$('#ocrCode3ModalAcctType').modal('hide');
		
			$('.selected-det').find('input.ocrcode3').val(code);
		});
	  
		$(document.body).on('dblclick', '#tblSQ tbody > tr', function () 
		{
			
			var docNum = $(this).children('td.item-1').text();
			var objType = 23;
			
			$('#salesQuotationModal').modal('hide');
			
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
			let controlacct = $(this).children('td.item-10').text();
			txtCurrency = $(this).children('td.item-9').text();
			let glCode = $(this).children('td.item-10').text();
			let glName = $(this).children('td.item-11').text();
			let addressID = '';
			
			
		 
			generateRows(cardCode); 
			$('#bpModal').modal('hide');
		
			$('#txtCardCode').val(cardCode).css({'background-color': '', 'border-radius': '0px'});
			$('#txtCardName').val(cardName).css('background-color', '');
			$('#txtContactPerson').val(contactPerson).css({'background-color': '', 'border-radius': '0px'});
			$('#txtContactPersonCode').val(contactPersonCode);
			$('#txtJournalMemo').val('Outgoing Payments - ' + cardCode);
			$('#txtGLCodePayNoDoc').val(controlacct);
			$('#txtPaymentTermsCode').val(paymentTermsCode);
			$('#txtPaymentTermsName').val(paymentTermsName);
			$('#txtTinNumber').val(tinNumber);
			$('#selCurrency').val('BP');
			$('#txtCurrency').val(txtCurrency);	
				
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
			
				$.getJSON('../proc/views/vw_shipToAddressDetails.php?cardCode=' + cardCode + '&address=' + addressID, function (data){
					let shipArr = [];	
					let shipArr2 = [];	
					let shipList;
					let shipList2;
					
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
								
			
				setTimeout(function () {
					shipList = shipArr;
					shipList2 = shipArr2;
					$('#txtShipArr').val(shipList);			
					$('#txtShipArr2').val(shipList2);
					ShipToAddressComponent();			
				
					}, 100) 
						
					});
				});
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
								BillToAddressComponent();
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
			
		
		   
		});
		$(document.body).on('dblclick', '#tblBP2 tbody > tr', function () 
		{
			
		//	let cardCode = $(this).children('td.item-1').text();
			let cardName = $(this).children('td.item-2').text();
		
			
			$('#txtToOrderOf').val(cardName).css({'background-color': '', 'border-radius': '0px'});
		 
		
			$('#bpModal2').modal('hide');
		
		
		   
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
			var price = $(this).children('td.item-6').text();
			var vendor = $(this).children('td.item-7').text();
			
			
			$('.btnrowfunctions').removeClass('d-none');
	
			$('#itemModal').modal('hide');
		
			$('.selected-det').find('input.itemcode').val(itemCode);
			$('.selected-det').find('input.itemname').val(itemName);
			$('.selected-det').find('input.uomgroup').val(uomGroup);
			$('.selected-det').find('input.unitmsr').val(uomName);
			$('.selected-det').find('input.uomentry').val(uomEntry);
			$('.selected-det').find('input.price').val(price);
			$('.selected-det').find('input.cardcode').val(vendor);
			
			AddRow();
			CheckCardCode(itemCode);
			}
	   
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
		$(document.body).on('dblclick', '#tblGLCash tbody > tr', function () 
		{
			
			var glCode = $(this).children('td.item-1').text();
			var glName = $(this).children('td.item-2').text();
		
			
			$('#glModalCash').modal('hide');
		
			$('#txtCashGLCode').val(glCode);
			$('#txtCashGLName').val(glName);
		   
		   itemCode = glCode;
			CheckCardCode(itemCode);
		});
		$(document.body).on('dblclick', '#tblGLTransfer tbody > tr', function () 
		{
			
			var glCode = $(this).children('td.item-1').text();
			var glName = $(this).children('td.item-2').text();
		
			
			$('#glModalTransfer').modal('hide');
		
			$('#txtTransferGLCode').val(glCode);
			$('#txtTransferGLName').val(glCode + ' - ' + glName);
		   
			  itemCode = glCode;
			CheckCardCode(itemCode);
		});
		$(document.body).on('dblclick', '#tblGLPayNoDoc tbody > tr', function () 
		{
			
			var glCode = $(this).children('td.item-1').text();
			var glName = $(this).children('td.item-2').text();
		
	
			$('#glModalPayNoDoc').modal('hide');
		
			$('#txtGLCodePayNoDoc').val(glCode);
			$('#txtGLNamePayNoDoc').val(glName);
		   
			   itemCode = glCode;
			CheckCardCode(itemCode);
		});
		$(document.body).on('dblclick', '#tblAccountFMS tbody > tr', function () 
		{
			
			var account = $(this).children('td.item-1').text();
			var glAccount = $(this).children('td.item-2').text();
	
			$('#acctFMSModal').modal('hide');
			$('.selected-det-check').find('input.account').val(account);
			$('.selected-det-check').find('input.glAcctCheck').val(glAccount);
	
	
	
		   
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
			$('#txtDocumentDate2').val(newdate);
		});
		
		$(document.body).on('change', '#txtDueDate1', function () 
		{
			$('#txtDueDate1').val($(this).val());
			//2021-09-08
			let date = $(this).val();
			let month = date.substring(5, 7);
			let day = date.substring(8, 10);
			let year = date.substring(0, 4);
			let newdate = month + "." + day + "." + year;
			$('#txtDueDate1').val(newdate);
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
		$(document.body).on('change', '.duedate', function () 
		{
			
			//2021-09-08
			let date = $(this).val();
			let month = date.substring(5, 7);
			let day = date.substring(8, 10);
			let year = date.substring(0, 4);
			let newdate = month + "." + day + "." + year;
			$('.selected-det-check').find('.duedate2').val(newdate);
		});
		function duedateChange(){
			//2021-09-08
			$('.duedate').each(function(i) {
				let date = $(this).val();
				let month = date.substring(5, 7);
				let day = date.substring(8, 10);
				let year = date.substring(0, 4);
				let newdate = month + "." + day + "." + year;
				$(this).closest('tr').find('.duedate2').val(newdate);
			});
			
			
		}
			
		
		$(document.body).on('change', '#txtTransferDate', function () 
		{
			//2021-09-08
			let date = $(this).val();
			let month = date.substring(5, 7);
			let day = date.substring(8, 10);
			let year = date.substring(0, 4);
			let newdate = month + "." + day + "." + year;
			$('#txtTransferDate2').val(newdate);
		});
		$(document.body).on('change', '#selTransactionType', function () 
		{
			serviceType =  $(this).val();
			if (serviceType == 'S'){
				$('input.quantity').val(1);
				$('.vendor').removeClass('d-none');
				$('.account').addClass('d-none');
			}
			else{
				$('.vendor').addClass('d-none');
				$('.account').removeClass('d-none');
			}
			$('#txtDocTotal').val('0.00');
			$('#contents-tab').load('../templates/outgoing-payments-lines.php?serviceType=' + serviceType), function (){
				
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
		$('#acctFMSModal').on('shown.bs.modal',function(){
			
			var bankCode = $('.selected-det-check').find('select.bankcode').val();
			var bplId = $('#txtBPLId').val();
			console.log(bankCode)
			
			if(bankCode == '')
			{
				
				$('#acctFMSModal').html('');
			}
			else
			{	
				
				
				$.ajax({
					type: 'GET',
					url: '../proc/views/vw_accountFMS.php',
					data: {
						bplId : bplId,
						bankCode : bankCode
	
						},
					success: function (html) 
					{
						$('#AccountFMS').html(html);
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
		//Search
		let previousValue = '';
		$(document.body).on('click', '#btnDocumentSearch', function () {
		var txtDocumentSearch = $('#txtDocumentSearch').val();
		if(txtDocumentSearch != '' ){
			if(previousValue == txtDocumentSearch){
				
			}else{
				previousValue = txtDocumentSearch
				$.ajax({
					type: 'GET',
					url: '../proc/views/utilities/vw_documentsearch.php',
					data:
					{
						txtDocumentSearch: txtDocumentSearch,
						
					},
					success: function (data) {
						$('#tblDoc').html(data)
		
						// $('#loadModal').modal('hide');
					}
				});
				}
			}
		});
		$(document.body).on('click', '#btnCardCodeSearch', function () {

			var txtCardCodeSearch = $('#txtCardCodeSearch').val();
			// $('#loadModal').modal('show');
			$.ajax({
				type: 'GET',
				url: '../proc/views/utilities/vw_cardcodesearch.php',
				data:
				{
					txtCardCodeSearch: txtCardCodeSearch,
					
				},
				success: function (data) {
					$('#tblBP').html(data)

					// $('#loadModal').modal('hide');
				}
			});
		
		});
		//Add
		$(document.body).on('click', '#btnAdd', function () 
		{
			var err = 0;
			var errmsg = '';
			let objectType = 18;
			let docentryAttachment = '';
			let lineno = '';
			let filename = '';
			let filelocation = '';
			let user = '';

			if($('#txtBPLId').val() == '' ){
					err = 1;
					$('#messageBar2').addClass('d-none');
								$('#messageBar3').removeClass('d-none');
								$('#messageBar').text('Select Branch!').css({'background-color': 'red', 'color': 'white'});
								
									setTimeout(function()
									{
										$('#messageBar').text('').css({'background-color': '', 'color': ''});	
										$('#messageBar2').removeClass('d-none');
									},5000)
				}
	
			   if($('#selTransactionType').val() == 'S'){
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
			}
			else{
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
			}

			// ====================================== //
			let formData = new FormData();
			let docentry = '';
			
			formData.append('type', 'add');
			formData.append('atcentry', '');
			


			formData.append('fileToUpload[]', $('#tblAttachment tbody tr:first input.file')[0].files[0]);
			$('#tblAttachment tbody tr').each(function (i) {
				x = $(this).children();

				if ($(this).find('.file').val() != '') {
					let file = $(this).find('.file')[0].files[0]
					let attachmentdate = $(this).find('.attachmentdate').val()
					let freetext = $(this).find('.freetext').val()

					console.log(file);
					console.log(freetext);
					console.log($(this).find('.file').val());
					
					formData.append('fileToUpload[]', file);
					formData.append('attachmentdate', attachmentdate);
					formData.append('freetext', freetext);
				}
			});
	


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
	
			let txtSeriesOVPM = $('#txtSeriesOVPM').val();
			let txtBPLId = $('#txtBPLId').val();
			let txtCardCode = $('#txtCardCode').val();
			let txtCashGLCode = $('#txtCashGLCode').val();
			let txtCashAmount = $('#txtCashAmount').val();
			let txtTransferGLCode = $('#txtTransferGLCode').val();
			let txtTransferDate = $('#txtTransferDate').val();
			let txtTransferRef = $('#txtTransferRef').val();
			let txtTransferAmount = $('#txtTransferAmount').val();
			let txtPostingDate = $('#txtPostingDate').val();
			let txtDeliveryDate = $('#txtDeliveryDate').val();
			let txtDocumentDate = $('#txtDocumentDate').val();
			let txtReference = $('#txtReference').val();
			let txtToOrderOf = $('#txtToOrderOf').val();
			let txtPayTo = $('#txtPayTo').val();
			let txtRemarks = $('#txtRemarks').val();
			let selTransactionType = $('#selTransactionType').val();
			let chkPayNoDoc = $('#chkPayNoDoc').val();
			let txtPayNoDoc = 'N';
			let txtGLCodePayNoDoc = $('#txtGLCodePayNoDoc').val();
			let txtCheckAmountTotal = $('#txtCheckAmountTotal').val();
		   
			if($('#chkPayNoDoc').prop('checked') == true){
				txtPayNoDoc = 'Y';
			}
			else{
				txtPayNoDoc = 'N';
			}
	
			var json = '{';
			var otArr = [];
	
				
					if(selTransactionType == 'S'){
					
						$('#tblDetails tbody tr').each(function (i) 
						{
							var itArr = [];
							if ($(this).find('input.chkboxInvoice').prop('checked') == true){
	
								itArr.push('"' + $(this).find('input.docnum').val() + '"');
								itArr.push('"' + $(this).find('input.totalpayment').val() + '"');
								itArr.push('"' + $(this).find('input.documenttype').val() + '"');
								itArr.push('"' + $(this).find('input.ocrcodevendor').val() + '"');
								itArr.push('"' + $(this).find('input.ocrcode2vendor').val() + '"');
								itArr.push('"' + $(this).find('input.ocrcode3vendor').val() + '"');
								
								otArr.push('"' + i + '": [' + itArr.join(',') + ']');
								
							}
						});
	
					}
					else{
						$('#tblDetails tbody tr').each(function (i) 
						{
							var itArr = [];	
							if ($(this).find('input.glaccount').val() != ''){
								itArr.push('"' + $(this).find('input.glaccount').val() + '"');
								itArr.push('"' + $(this).find('input.docremarks').val().replace(/,/g, '') + '"');
								itArr.push('"' + $(this).find('input.price').val().replace(/,/g, '') + '"');
								itArr.push('"' + $(this).find('select.taxcode').val() + '"');
								itArr.push('"' + $(this).find('input.grossprice').val() + '"');
								itArr.push('"' + $(this).find('input.ocrcode').val() + '"');
								itArr.push('"' + $(this).find('input.ocrcode2').val() + '"');
								itArr.push('"' + $(this).find('input.ocrcode3').val() + '"');
								itArr.push('"' + $(this).find('input.taxamount').val().replace(/,/g, '') + '"');
	
								otArr.push('"' + i + '": [' + itArr.join(',') + ']'); 
							}
						});
					}
				
			  var jsonCheck = '{';
			var otArrCheck = [];  		
		 $('#tblCheck tbody tr').each(function (i) 
			{
				var itArr = [];
				if ($(this).find('input.checkamount').val() != ''  && $(this).find('input.checkno').val() != ''){
	
				
	
					itArr.push('"' + $(this).find('input.duedate').val() + '"');
					itArr.push('"' + $(this).find('input.checkamount').val() + '"');
					itArr.push('"' + $(this).find('select.bankcode').val() + '"');
					itArr.push('"' + $(this).find('input.branch').val() + '"');
					itArr.push('"' + $(this).find('input.account').val() + '"');
					itArr.push('"' + $(this).find('input.checkno').val() + '"');
					itArr.push('"' + $(this).find('input.glAcctCheck').val() + '"');
					
					otArrCheck.push('"' + i + '": [' + itArr.join(',') + ']');
					
				}
			});
					
			 
			json += otArr.join(",") + '}';	
			jsonCheck += otArrCheck.join(",") + '}';	
			if (err == 0) 
			{
				console.log(txtGLCodePayNoDoc)
				$('#loadModal').modal('show');
				$.ajax({
					type: 'POST',
					url: '../proc/exec/exec_add_outgoing-payments.php',
					data: 
					{
						json: json.replace(/(\r\n|\n|\r)/gm, '[newline]'),
						jsonCheck: jsonCheck.replace(/(\r\n|\n|\r)/gm, '[newline]'),
						udfJson: udfJson.replace(/(\r\n|\n|\r)/gm, '[newline]'),
						txtSeriesOVPM : txtSeriesOVPM,
						txtBPLId : txtBPLId,
						txtCardCode : txtCardCode,
						txtCashGLCode : txtCashGLCode,
						txtCashAmount : txtCashAmount,
						txtTransferGLCode : txtTransferGLCode,
						txtTransferDate : txtTransferDate,
						txtTransferRef : txtTransferRef,
						txtTransferAmount : txtTransferAmount,
						txtPostingDate : txtPostingDate,
						txtDeliveryDate : txtDeliveryDate,
						txtDocumentDate : txtDocumentDate,
						txtReference : txtReference,
						txtToOrderOf : txtToOrderOf,
						txtPayTo : txtPayTo,
						txtRemarks : txtRemarks,
						txtPayNoDoc : txtPayNoDoc,
						txtGLCodePayNoDoc : txtGLCodePayNoDoc,
						txtCheckAmountTotal : txtCheckAmountTotal,
						selTransactionType : selTransactionType
						
					},
					success: function (data) 
					{
						var res = $.parseJSON(data);
						
						if(res.valid == true)
						{
							$('#messageBar2').addClass('d-none');
							$('#messageBar3').removeClass('d-none');
							$('#messageBar').text(res.msg).css({'background-color': '#00FF7F', 'color': 'black'});
							docentry = res.docentry
							
								setTimeout(function()
								{
									$('#messageBar').text('').css({'background-color': '', 'color': ''});	
									
									window.location.replace("../templates/" + mainFileName + "-document.php");
								},5000)
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


				setTimeout(function () {
					formData.append('objectType', 46);
					formData.append('docentryAttachment', docentry);
					formData.append('lineno', 0); 
					console.log(docentry + '/DocEntry here')
					console.log(formData)
					$.ajax({
						url: '../proc/views/vw_uploadFile.php',
						type: 'post',
						data: formData


						 ,
						contentType: false,
						processData: false,
						success: function (data) {
							console.log(data)
							var res = $.parseJSON(data);


							console.log(res.a)
							console.log(res.b)
							console.log(res.c)
						},
					});
				}, 2000)
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
			let objectType = 18;
			let docentryAttachment = '';
			let lineno = '';
			let filename = '';
			let filelocation = '';
			let user = '';
			
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
		   
			let txtDocEntry = $('#txtDocEntry').val();
			let txtDocNum = $('#txtDocNum').val();
			let txtAtcEntry = $('#txtAtcEntry').val();
			let txtRemarks = $('#txtRemarks').val();
			let txtJournalMemo = $('#txtJournalMemo').val();
			let txtPayTo = $('#txtPayTo').val();
			let txtReference = $('#txtReference').val();	
			let txtPayNoDoc = 'N';
			let txtGLCodePayNoDoc = $('#txtGLCodePayNoDoc').val();
			if($('#chkPayNoDoc').prop('checked') == true){
				txtPayNoDoc = 'Y';
			}
			else{
				txtPayNoDoc = 'N';
			}
			let selTransactionType = $('#selTransactionType').val();
	
		
			let formData = new FormData();
			let docentry = '';
			
		
			formData.append('type', 'update');
			formData.append('atcentry', txtAtcEntry);
			


			formData.append('fileToUpload[]', $('#tblAttachment tbody tr input.file-from-update')[0].files[0]);
			$('#tblAttachment tbody tr').each(function (i) {
				x = $(this).children();

				if ($(this).find('.targetpath').val() == '') {
					let file = $(this).find('.file')[0].files[0]
					let attachmentdate = $(this).find('.attachmentdate').val()
					let freetext = $(this).find('.freetext').val()

					console.log(file);
					console.log(freetext);
					console.log($(this).find('.file').val());
					
					formData.append('fileToUpload[]', file);
					formData.append('attachmentdate', attachmentdate);
					formData.append('freetext', freetext);
				}
			});

			
			if (err == 0) 
			{
				
				$('#loadModal').modal('show');
				$.ajax({
					type: 'POST',
					url: '../proc/exec/exec_update_' + mainFileName + '.php',
					data:
					{
						
						udfJson: udfJson.replace(/(\r\n|\n|\r)/gm, '[newline]'),
						txtDocEntry: txtDocEntry,
						txtDocNum: txtDocNum,
						txtAtcEntry:txtAtcEntry,
						txtRemarks: txtRemarks,
						txtJournalMemo: txtJournalMemo,
						txtPayTo: txtPayTo,
						txtReference: txtReference,
						txtPayNoDoc: txtPayNoDoc,
						txtGLCodePayNoDoc: txtGLCodePayNoDoc


					},
					success: function (data) {
						var res = $.parseJSON(data);

						if (res.valid == true) {
							$('#messageBar2').addClass('d-none');
							$('#messageBar3').removeClass('d-none');
							$('#messageBar').text(res.msg).css({ 'background-color': '#00FF7F', 'color': 'black' });
							docentry = res.docentry

						
						}
						else {
							$('#messageBar2').addClass('d-none');
							$('#messageBar3').removeClass('d-none');
							$('#messageBar').text(res.msg).css({ 'background-color': 'red', 'color': 'white' });

							setTimeout(function () {
								$('#messageBar').text('').css({ 'background-color': '', 'color': '' });

							}, 5000)
						}

						$('#loadModal').modal('hide');
					}
				});


				
					formData.append('objectType', 18);
					formData.append('docentryAttachment', txtDocEntry);
					formData.append('lineno', 0);

					console.log(formData)
					
					$.ajax({
						url: '../proc/views/vw_uploadFile.php',
						type: 'post',
						data: formData,
						contentType: false,
						processData: false,
						success: function (data) {
							console.log(data)
							
								$('#messageBar2').addClass('d-none');
								$('#messageBar3').removeClass('d-none');
								$('#messageBar').text('Operation completed successfully -' + txtDocEntry).css({'background-color': '#00FF7F', 'color': 'black'});
									
								
								$('#loadModal').modal('hide');
								
							
							setTimeout(function () {
								window.location.replace("../templates/" + mainFileName + "-document.php");
							}, 3000)
						},
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
										$('#rowLoader').load('../templates/outgoing-payments-lines-row-excel.php?serviceType=' + serviceType + '&text2=' + text2, function (result) 
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
		//Payment
		$(document.body).on('keyup', '.totalpayment', function (e) 
		{
			let value = $(this).val();
			let payment = $('.selected-det').find('input.totalpayment').val();
			let balance = $('.selected-det').find('input.balancedue2').val();
			
				$(this).val(function(index, value) {
				value = value.replace(/,/g,'');
				return NumberWithCommas(value);
			});
		
			$(this).closest('tr').find('input.balancedue').val(ComputeBalanceDue(balance,payment));
			
		});
		$(document.body).on('blur', '.totalpayment', function () 
		{
			let payment = $('.selected-det').find('input.totalpayment').val();
			let balance = $('.selected-det').find('input.balancedue2').val();
			$('.selected-det').find('input.totalpayment').val(FormatMoney(payment));
			$(this).closest('tr').find('input.balancedue').val(ComputeBalanceDue(balance,payment));
	
			ComputePayment();
			ComputeBalance()
			
		});
	
	
		//Price
		$(document.body).on('blur', '#txtNoDocSum', function (e) 
		{
			let value = $(this).val();	
			$(this).val(function(index, value) {
				value = value.replace(/,/g,'');
				return FormatMoney(NumberWithCommas(value));
			});
		
			
			$('#txtDocTotal').val(FormatMoney(value));
			ComputeBalance();
		});
		$(document.body).on('keyup', '.price', function (e) 
		{
			
			CheckItemCode();
			
			let price = $('.selected-det').find('input.price').val();
			let quantity = $('.selected-det').find('input.quantity').val();
			let discount = $('.selected-det').find('input.discount').val(); 
			let taxrate = $('.selected-det').find('option:selected').attr('val-rate');
			let value = $(this).val();
				$(this).val(function(index, value) {
				value = value.replace(/,/g,'');
				return NumberWithCommas(value);
			});
			
			$('.selected-det').find('input.rowtotal').val(ComputeRowTotal(price,quantity,discount));
	
			ComputeRowGrossPrice();
			ComputeRowTaxAmount();
	
	
			ComputeGrossTotal();
			ComputeFooterTaxAmount();
	
			ComputeFooterTotalBeforeDiscount();
			
		
			ComputeTotal();
			ComputeBalance()
			
			$('txtFooterDiscountPercentage').trigger('blur');
			
		});
		$(document.body).on('blur', '.price', function () 
		{
			let amount = $('.selected-det').find('input.price').val();
			$('.selected-det').find('input.price').val(FormatMoney(amount));
			
		});
		$(document.body).on('blur', '.checkamount', function () 
		{
			let amount = $(this).closest('tr').find('input.checkamount').val();
			$(this).closest('tr').find('input.checkamount').val(FormatMoney(amount));
			if(amount != '0.00'){
				AddRowCheck();
				ComputeTotalCheckAmount()
				ComputeBalance()
			}
		});
		$(document.body).on('keyup', '.taxamount', function (e) 
		{
			
			CheckItemCode();
			
			let price = $('.selected-det').find('input.price').val();
			let quantity = $('.selected-det').find('input.quantity').val();
			let discount = $('.selected-det').find('input.discount').val(); 
			let taxrate = $(this).val();
			let value = $(this).val();
				$(this).val(function(index, value) {
				value = value.replace(/,/g,'');
				return NumberWithCommas(value);
			});
			
			$('.selected-det').find('input.rowtotal').val(ComputeRowTotal(price,quantity,discount));
	
			ComputeRowGrossPrice();
			//ComputeRowTaxAmount();
	
	
			ComputeGrossTotal();
			ComputeFooterTaxAmount();
	
			ComputeFooterTotalBeforeDiscount();
			
		
			ComputeTotal();
			ComputeBalance()
			
			$('txtFooterDiscountPercentage').trigger('blur');
			
		});
		$(document.body).on('blur', '.taxamount', function () 
		{
			let amount = $('.selected-det').find('input.taxamount').val();
			$('.selected-det').find('input.taxamount').val(FormatMoney(amount));
			
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
			ComputeBalance();
			ComputeTotal();
			
			$('txtFooterDiscountPercentage').trigger('blur');
			
		});
		$(document.body).on('paste', '.quantity', function (e) 
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
					
					
					setTimeout(function () {
						for(var i = 0 ; i < textArrLength; i++){
								
							
								$('#tblDetails tbody > tr:eq(' + i + ') td input.quantity').val(text2[i]);
								
						
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
		$(document.body).on('blur', '.discount', function () 
		{
			let amount = $('.selected-det').find('input.discount').val();
			$('.selected-det').find('input.discount').val(FormatMoney(amount));
			
		});
	
		$(document.body).on('change','#txtReference',function()
		{
			if($('#btnAdd').hasClass('d-none')){
				$('#btnUpdate').removeClass('d-none');
				$('#btnOk').addClass('d-none');
			}
		});
		$(document.body).on('change','#txtJournalMemo',function()
		{
			if($('#btnAdd').hasClass('d-none')){
				$('#btnUpdate').removeClass('d-none');
				$('#btnOk').addClass('d-none');
			}
		});
		$(document.body).on('change','#txtPayTo',function()
		{
			if($('#btnAdd').hasClass('d-none')){
				$('#btnUpdate').removeClass('d-none');
				$('#btnOk').addClass('d-none');
			}
		});
		$(document.body).on('change','#txtRemarks',function()
		{
			if($('#btnAdd').hasClass('d-none')){
				$('#btnUpdate').removeClass('d-none');
				$('#btnOk').addClass('d-none');
			}
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
			
			
		});
		
	//Payment
	$(document.body).on('keyup', '#txtCashAmount', function (e) 
		{
			let value = $(this).val();
			
				$(this).val(function(index, value) {
				value = value.replace(/,/g,'');
				return NumberWithCommas(value);
			});
			ComputeBalance();
			
			
		});	
		$(document.body).on('keyup', '#txtTransferAmount', function (e) 
		{
			let value = $(this).val();
		
				$(this).val(function(index, value) {
				value = value.replace(/,/g,'');
				return NumberWithCommas(value);
			});
			ComputeBalance();
			
			
		});	
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
						
							$('#rowLoader').load('../templates/outgoing-payments-lines-row.php?serviceType=' + serviceType, function (result) 
							{
								$('#tblDetails tbody').append(result);
	
								$('#tblDetails tbody tr:last').find('td.rowno span').text(rowno);
							})
				
								$(this).prop('disabled', false);
						
						
				}, 200)
			}
		}
		function AddRowAttachment() {


			var rowno = 0;
			rowno = ($('#tblAttachment tbody tr:last').find('td.rowno span').text() == '') ? 1 : parseFloat($('#tblAttachment tbody tr:last').find('td.rowno span').text()) + 1;
			var lastItem = $('#tblAttachment tbody tr:last').find('input.file').val()
	
			// if(lastItem != ""){
			setTimeout(function () {
	
				$('#rowLoader').load('../templates/' + mainFileName + '-lines-row-attachments.php?', function (result) {
					$('#tblAttachment tbody').append(result);
	
	
					$('#tblAttachment tbody tr:last').find('td.rowno span').text(rowno)
				})
	
				$(this).prop('disabled', false);
	
	
			}, 200)
			// }
		}
		function AddRowCheck(){
			
			var rowno = 0;
				rowno = ($('#tblCheck tbody tr:last').find('td.rowno span').text() == '') ? 1 : parseFloat($('#tblCheck tbody tr:last').find('td.rowno span').text()) + 1;
			var lastItem = $('#tblCheck tbody tr:last').find('input.itemcode').val()
			
			if(lastItem != ""){
			setTimeout(function () 
				{
						
							$('#rowLoader').load('../templates/outgoing-payments-check-lines-row.php', function (result) 
							{
								$('#tblCheck tbody').append(result);
	
								$('#tblCheck tbody tr:last').find('td.rowno span').text(rowno);
							})
				
								$(this).prop('disabled', false);
						
						
				}, 200)
			}
		} 
		
		function PreviewDoc(docNum,objType){
		
			let docstatus = '';
			let docType ='';
			let payNoDoc ='';
			if(objType == 46){
				$('#btnAdd').addClass('d-none');
				$('#btnOk').addClass('d-none');
				$('#btnUpdate').removeClass('d-none');
				$('#btnCopyFrom').prop('disabled',false);
			}
			else{
				$('#btnAdd').removeClass('d-none');
				$('#btnOk').addClass('d-none');
				$('#btnUpdate').removeClass('d-none');
				$('#btnCopyFrom').prop('disabled',false);
			}
			
			
			$.getJSON('../proc/views/vw_getheaderdata.php?docNum=' + docNum + '&objType=' + objType, function (data){
				
					
				$.each(data, function (key, val){
					
				
					docstatus = val.DocStatusFullText;
					docType = val.DocType;
					payNoDoc = val.PayNoDoc;
					$('#txtDocTotal').addClass('d-none');
					$('#txtDocTotal2').removeClass('d-none');
					$('#txtTotalBeforeDiscount').addClass('d-none');
					$('#txtTotalBeforeDiscount2').removeClass('d-none');
					$('#txtTotalBeforeDiscount2').val(val.NetTotal);
					$('#txtDocTotal2').val(val.DocTotal);
					$('#txtOpenBalance').val(val.OpenBal);
	
					
					if(objType == 46){
					$('#txtDocNum').val(val.DocNum);
					$('#txtDocEntry').val(val.DocEntry);
					$('#txtAtcEntry').val(val.AtcEntry);
					}
					else{
					//$('#txtDocNum').val("");
					}
					$('#txtCurrency').val(val.DocCur);
					
					$('#txtCardCode').val(val.CardCode);
					$('#txtCardName').val(val.CardName);
					$('#txtStatus').val(val.DocStatusFullText);
					$('#txtCustomerRefNo').val(val.NumAtCard);
					$('#txtContactPersonCode').val(val.CntctCode);
					$('#txtContactPerson').val(val.ContactPerson);
					$('#selTransactionType').val(val.DocType);
					if(val.NoDocSum != '0.0000'){
						$('#chkPayNoDoc').prop('checked', true);
					}
					$('#txtToOrderOf').val(val.CardName);
					$('#txtPayTo').val(val.Address);
					$('#txtBranchCode').val(val.U_BranchCode)
					$('#txtSeriesNameOVPM').val(val.U_BranchCode)
					$('#txtReference').val(val.CounterRef)
					
					
					$('#txtPostingDate').val(val.DocDate);
					$('#txtDeliveryDate').val(val.DocDueDate);
					$('#txtDocumentDate').val(val.TaxDate);
					$('#txtCancellationDate').val(val.CancelDate);
					$('#txtRequiredDate').val(val.ReqDate);
					
					$('#txtFooterDiscountSum').val(val.DiscSum);
					$('#txtFooterDiscountPercentage').val(val.DiscPrcnt);
					$('#txtTotalBeforeDiscount').val(val.TotalBeforeDisc);
					
					$('#txtVatSum').val(val.VatSum);
					$('#txtNoDocSum').val(val.NoDocSum);
	
				
					$('#txtCashAmount').val(val.CashSum);
					$('#txtCashGLCode').val(val.CashAcct);
					$('#txtCashGLName').val(val.CashGLName);
	
					$('#txtTransferAmount').val(val.TrsfrSum);
					$('#txtTransferGLCode').val(val.TrsfrAcct);
					$('#txtTransferGLName').val(val.TrsfrGLName);
					$('#txtTransferDate').val(val.TrsfrDate);
					$('#txtTransferRef').val(val.TrsfrRef);
	
					$('#txtSalesEmpCode').val(val.SlpCode);
					$('#txtSalesEmpName').val(val.SlpName);
					
					$('#txtOwnerCode').val(val.EmpID);
					$('#txtOwnerName').val(val.EmployeeName);
					
					if(objType == 46){
					$('#txtRemarks').val(val.Comments);
					}
					else{
					$('#txtRemarks').val("Copied from Purchase Request # " + val.DocNum );	
					}
					$('#selShipToAddress').val(val.ShipToCode);
				
					$('#selTransactionType').trigger('change')
					
					$('#txtJournalMemo').val(val.JrnlMemo);
					$('#txtPaymentTermsCode').val(val.GroupNum);
					$('#txtPaymentTermsName').val(val.PymntGroup);
					$('#txtGLNamePayNoDoc').val(val.ControlAccount)
	
					$('#txtTinNumber').val(val.LicTradNum);
				
					
					
					
					
					let docnum = val.DocEntry;
					$.ajax({
						type: 'GET',
						url: '../proc/views/vw_series.php',
						data: {docnum : docnum},
						success: function (html) 
						{
							
							$('#selSeries').html(html);
							
						}
					});
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
					
			console.log(docNum + '/' + docType + '/' + objType + '/' + payNoDoc)
					setTimeout(function () 
					{
						
						$('#selShipToAddress').val(val.ShipToCode);
						$('#selShipToAddress').trigger('change');
						$('#lnkCardCode').removeClass('d-none');
						$('#lnkContactPerson').removeClass('d-none');
						$('#contactPersonBtn').removeClass('d-none');
						$('#btnShipToDetails').removeClass('d-none');
						$('#btnBillToDetails').removeClass('d-none');
						
						$('#txtCardCode').css({'background-color': '', 'border-radius': '0px'});
						$('#txtCardName').css('background-color', '');
						$('#txtContactPerson').css({'background-color': '', 'border-radius': '0px'});
					
					 }, 500) 
					setTimeout(function () 
					{
						$('#selBillToAddress').val(val.PayToCode);
						
						$('#selBillToAddress').trigger('change');
					}, 300) 
					
					
					
				});
				
				$('#selTransactionType').trigger('change');
				setTimeout(function () 
				{
					// alert(docNum)
					// alert(docType)
					// alert(objType)
					// alert(payNoDoc)

						PreviewRows(docNum, docType , objType, payNoDoc,function () 
						{

							
						});
						PreviewRowsAttachments(docNum, docType, objType, function () {

						});	
						PreviewCheckRows(docNum,function () 
						{
							
						});
					
				
					
				}, 500) 
				
				
				setTimeout(function () 
				{	
					if(docstatus != 'Open'){
						$('input, textarea, select').prop('disabled', true );
						
						$('.btnGroup').addClass('d-none');
						$('#btnShipToDetails').addClass('d-none');
						$('#btnBillToDetails').addClass('d-none');
						
						$('input.file').prop('disabled',false);
						$('input.freetext').prop('disabled',false);
						$('#txtRemarks').prop('disabled',false);
						$('#txtJournalMemo').prop('disabled',false);
						$('#txtPayTo').prop('disabled',false);
						$('#txtReference').prop('disabled',false);
					}
					else{
						$('input, textarea, select').prop('disabled', false );
						
						$('.btnGroup').removeClass('d-none');
						
					}
					$('#selTransactionType').prop('disabled', true);
					$('#layoutOptions').prop('disabled', false );
				}, 700) 
					
			});
			setTimeout(function()
						{
							$('#txtPostingDate').trigger('change');
							$('#txtDeliveryDate').trigger('change');
							$('#txtDocumentDate').trigger('change');
							$('#txtTransferDate').trigger('change');
							$('.duedate').trigger('change');
	
						},1000);
			setTimeout(function () 
				{
					 PreviewUDF(docNum);
						  $('#btnCardCode').addClass('d-none');
					 
				}, 1100) 
	
			
		}
	
		function PreviewRows(docNum, docType, objType, payNoDoc,callback){
			$('#contents-tab').load('../proc/views/vw_getdetailsdata.php?docNum=' + docNum + '&docType=' + docType + '&objType=' + objType + '&payNoDoc=' + payNoDoc, function (result) 
			{
				// $('#contents-tab').append(result)
				callback();
			});
			
					
		}
		function PreviewRowsAttachments(docNum, docType, objType, callback) {
			$('#tblAttachment tbody').load('../proc/views/vw_getdetailsdataattachments.php?docNum=' + docNum + '&docType=' + docType + '&objType=' + objType, function (result) {
				
	
				callback();
			});
		}
		function PreviewCheckRows(docNum, docType, objType, payNoDoc,callback){
			$('#checks-tab').load('../proc/views/vw_getdetailsdata-check.php?docNum=' + docNum, function (result) 
			{
				duedateChange();
				ComputeTotalCheckAmount();
			   // callback();
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
		function generateRows(cardCode){
			let presentdate = new Date().toISOString().split('T')[0];
			let docudate = document.querySelector("#txtDocumentDate").value;
			let serviceType = $('#selTransactionType').val();
			$('#contents-tab').load('../proc/views/vw_getInvoices.php?cardcode=' + cardCode + '&serviceType=' + serviceType + '&documentdate=' + docudate + '&presentdate=' + presentdate), function (data){
				console.log(data)
					
			};
	}
		function ComputeBalanceDue(balance, payment){
			
			balance = isNaN(parseFloat(balance.replace(/,/g,'')))? 0: parseFloat(balance.replace(/,/g,''));
			payment = isNaN(parseFloat(payment.replace(/,/g,'')))? 0: parseFloat(payment.replace(/,/g,''));
			
			let rowTotal = balance - payment;
			
			let result = FormatMoney(rowTotal);
				
			return result; 
		}
	
		function ComputePayment(){
			let amount = 0.00;
			$('.totalpayment').each(function()
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
			
			$('#txtDocTotal').val(FormatMoney(amount));
			ComputeBalance();
	
		}	
		function ComputeBalance(){
	
			let checkSum = $('#txtCheckAmountTotal').val();
			let cashSum = $('#txtCashAmount').val();
			let transferSum = $('#txtTransferAmount').val();
			let payNoDocSum = $('#txtNoDocSum').val();
			let docTotal = $('#txtDocTotal').val();
	
			checkSum = isNaN(parseFloat(checkSum.replace(/,/g,'')))? 0: parseFloat(checkSum.replace(/,/g,''));
			cashSum = isNaN(parseFloat(cashSum.replace(/,/g,'')))? 0: parseFloat(cashSum.replace(/,/g,''));
			transferSum = isNaN(parseFloat(transferSum.replace(/,/g,'')))? 0: parseFloat(transferSum.replace(/,/g,''));
			payNoDocSum = isNaN(parseFloat(payNoDocSum.replace(/,/g,'')))? 0: parseFloat(payNoDocSum.replace(/,/g,''));
			docTotal = isNaN(parseFloat(docTotal.replace(/,/g,'')))? 0: parseFloat(docTotal.replace(/,/g,''));
	
			let payment = checkSum + cashSum + transferSum;
			let openBalance = docTotal - payment;
			
			$('#txtOpenBalance').val(FormatMoney(openBalance));
	
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
			let rowTaxAmount = $('.selected-det').find('input.taxamount').val();
			let rowTax = $('.selected-det').find('select.taxcode').find('option:selected').attr('val-rate');
			let discount =  $('.selected-det').find('input.discount').val();
			
			let rowPriceFloat = isNaN(parseFloat(rowPrice.replace(/,/g,'')))? 0: parseFloat(rowPrice.replace(/,/g,''));
			let rowTaxAmountFloat = isNaN(parseFloat(rowTaxAmount.replace(/,/g,'')))? 0: parseFloat(rowTaxAmount.replace(/,/g,''));
			let rowTaxFloat = isNaN(parseFloat(rowTax.replace(/,/g,'')))? 0: parseFloat(rowTax.replace(/,/g,''));
			let discountFloat = isNaN(parseFloat(discount.replace(/,/g,'')))? 0: parseFloat(discount.replace(/,/g,''));
			
			let discTotal = rowPriceFloat * discountFloat/100;
			let rowTotal2 = rowPriceFloat - discTotal;
			let rowTax2 = rowTaxAmountFloat + rowTotal2;
			let rowTotal3 = rowTax2;
			
			
			let result = rowTotal3;
			$('.selected-det').find('.grossprice').val(FormatMoney(result));  
		}
		
		function ComputeGrossTotal(){
			let rowPrice = $('.selected-det').find('input.price').val();
			let rowTaxAmount = $('.selected-det').find('input.taxamount').val();
			let rowQuantity = $('.selected-det').find('input.quantity').val();
			let rowTax = $('.selected-det').find('select.taxcode').find('option:selected').attr('val-rate');
			let discount =  $('.selected-det').find('input.discount').val();
			
			let rowPriceFloat = isNaN(parseFloat(rowPrice.replace(/,/g,'')))? 0: parseFloat(rowPrice.replace(/,/g,''));
			let rowTaxAmountFloat = isNaN(parseFloat(rowTaxAmount.replace(/,/g,'')))? 0: parseFloat(rowTaxAmount.replace(/,/g,''));
			let rowTaxFloat = isNaN(parseFloat(rowTax.replace(/,/g,'')))? 0: parseFloat(rowTax.replace(/,/g,''));
			let discountFloat = isNaN(parseFloat(discount.replace(/,/g,'')))? 0: parseFloat(discount.replace(/,/g,''));
			let rowQuantityFloat = isNaN(parseFloat(rowQuantity.replace(/,/g,'')))? 0: parseFloat(rowQuantity.replace(/,/g,''));
			
			let rowTotalFloat = rowPriceFloat * rowQuantityFloat;
			let discTotal = parseFloat(rowTotalFloat * discountFloat/100);
			let rowTotal2 = parseFloat(rowTotalFloat - discTotal);
			let rowTax2 = rowTaxAmountFloat + rowTotal2;
			let rowTotal3 = parseFloat(rowTax2);
			console.log(1)
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
			 console.log(amount) 
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
			// let payNoDocSum = $('#txtNoDocSum').val();
			
			let totalBeforeDiscountFloat = isNaN(parseFloat(totalBeforeDiscount.replace(/,/g,'')))? 0: parseFloat(totalBeforeDiscount.replace(/,/g,''));
			let totalTaxAmountFloat = isNaN(parseFloat(totalTaxAmount.replace(/,/g,'')))? 0: parseFloat(totalTaxAmount.replace(/,/g,''));
			let totalDiscountFloat = isNaN(parseFloat(totalDiscount.replace(/,/g,'')))? 0: parseFloat(totalDiscount.replace(/,/g,''));
			// let payNoDocSumFloat = isNaN(parseFloat(payNoDocSum.replace(/,/g,'')))? 0: parseFloat(payNoDocSum.replace(/,/g,''));
			
			let amount = (totalBeforeDiscountFloat + totalTaxAmountFloat) - totalDiscountFloat;
			
			$('#txtDocTotal').val(FormatMoneyWithCurrency(amount));
		}
		function ComputeTotalCheckAmount(){
			let amount = 0.00;
			$('.checkamount').each(function()
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
			$('#txtCheckAmountTotal').val(FormatMoney(amount));
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