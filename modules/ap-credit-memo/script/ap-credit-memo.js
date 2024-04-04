$(document).ready(function () {
	let mainTable = 'ORPC';
	const mainFileName = 'ap-credit-memo'
	let objectType = 0;
	$('#pageTitle').text('A/P Credit Memo | SAP B1');	
	setTimeout(function()
		{
			$('#txtPostingDate').trigger('change');
			$('#txtDeliveryDate').trigger('change');
			$('#txtDocumentDate').trigger('change');
		},1000);
	//TopBar
	$(document.body).on('click', '#btnFirstRecord', function (){
		let table = 'ORPC';
		let docNum = '';
		let objType = 19;
		$.getJSON('../proc/views/vw_getFirstEntry.php?table=' + table, function (data){
			docNum = data;
			PreviewDoc(docNum,objType);
		});
	});
	$(document.body).on('click', '#btnPrevRecord', function (){
		let table = 'ORPC';
		let objType = 19;
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
		let table = 'ORPC';
		let objType = 19;
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
		let table = 'ORPC';
		let docNum = '';
		let objType = 19;
		$.getJSON('../proc/views/vw_getLastEntry.php?table=' + table, function (data){
			docNum = data;
			PreviewDoc(docNum,objType);
			$('#txtPostingDate').prop('readonly',true);
			$('#txtDeliveryDate').prop('disabled',true);
			$('#txtDocumentDate').prop('readonly',true);

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
		$('#contents-tab').load('../templates/ap-credit-memo-lines.php?serviceType=' + serviceType), function (){
			
		};
		//Logistics
		$('#logistics-tab').load('../templates/ap-credit-memo-logistics.php'), function(){
			
		};
		//Accounting
		$('#accounting-tab').load('../templates/ap-credit-memo-accounting.php'), function(){
			
		};
		//Attachments
		$('#attachments-tab').load('../templates/' + mainFileName + '-attachments.php'), function(){

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
		//ATTACHMENT
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
		$(document.body).on('click', '.pdf', function (event) 
		{
			 event.preventDefault();
			window.open($(this).attr('href'),'_blank');
		})

	//Double Clicks
		$(document.body).on('dblclick', '#tblDoc tbody > tr', function () 
		{
			
			var docNum = $(this).children('td.item-1').text();
			var objType = 19;
			$('#documentModal').modal('hide');
			
			$('#txtDocNum').val(docNum);
			
			$('#btnAdd').addClass('d-none');
			$('#btnUpdate').removeClass('d-none');
			
			PreviewDoc(docNum, objType);
		   
		});
		$(document.body).on('dblclick', '#tblAPI tbody > tr', function () 
		{
			
			var docNum = $(this).children('td.item-1').text();
			var objType = 18;
			
			$('#apInvoiceModal').modal('hide');
			
			$('#txtBaseEntry').val(docNum);
			
			$('#btnAdd').removeClass('d-none');
			$('#btnUpdate').addClass('d-none');
			
			PreviewDoc(docNum, objType);
		   
		});
		$(document.body).on('dblclick', '#tblAPD tbody > tr', function () 
		{
			
			var docNum = $(this).children('td.item-1').text();
			var objType = 204;
			
			$('#apDownpaymentModal').modal('hide');
			
			$('#txtBaseEntry').val(docNum);
			
			$('#btnAdd').removeClass('d-none');
			$('#btnUpdate').addClass('d-none');
			
			PreviewDoc(docNum, objType);
		   
		});
		$(document.body).on('dblclick', '#tblOcr1 tbody > tr', function () 
		{
			
			var OcrCode1 = $(this).children('td.item-1').text();
			var OcrName1 = $(this).children('td.item-2').text();
			
			$('#Ocr1Modal').modal('hide');
		
			$('.selected-det').find('input.ocrcode1').val(OcrCode1);
			$('.selected-det').find('input.ocrname1').val(OcrName1);
		   
		});
		$(document.body).on('dblclick', '#tblOcr2 tbody > tr', function () 
		{
			
			var OcrCode2 = $(this).children('td.item-1').text();
			var OcrName2 = $(this).children('td.item-2').text();
			
			$('#Ocr2Modal').modal('hide');
		
			$('.selected-det').find('input.ocrcode2').val(OcrCode2);
			$('.selected-det').find('input.ocrname2').val(OcrName2);
		   
		});
		$(document.body).on('dblclick', '#tblOcr3 tbody > tr', function () 
		{
			
			var OcrCode3 = $(this).children('td.item-1').text();
			var OcrName3 = $(this).children('td.item-2').text();
			
			$('#Ocr3Modal').modal('hide');
		
			$('.selected-det').find('input.ocrcode3').val(OcrCode3);
			$('.selected-det').find('input.ocrname3').val(OcrName3);
		   
		});
		$(document.body).on('dblclick', '#tblOcr4 tbody > tr', function () 
		{
			
			var OcrCode4 = $(this).children('td.item-1').text();
			var OcrName4 = $(this).children('td.item-2').text();
			
			$('#Ocr4Modal').modal('hide');
		
			$('.selected-det').find('input.ocrcode4').val(OcrCode4);
			$('.selected-det').find('input.ocrname4').val(OcrName4);
		   
		});
		$(document.body).on('dblclick', '#tblBP tbody > tr', function () 
		{
			
			let cardCode = $(this).children('td.item-1').text();
			let cardName = $(this).children('td.item-2').text();
			let contactPerson = $(this).children('td.item-4').text();
			let paymentTermsCode = $(this).children('td.item-5').text();
			let paymentTermsName = $(this).children('td.item-6').text();
			let controlAccount = $(this).children('td.item-10').text();
			let controlAccountName = $(this).children('td.item-11').text();
			let tinNumber = $(this).children('td.item-7').text();
			let contactPersonCode = $(this).children('td.item-8').text();
			txtCurrency = $(this).children('td.item-9').text();
			let addressID = '';
	
			$('#bpModal').modal('hide');
		
			$('#txtCardCode').val(cardCode).css({'background-color': '', 'border-radius': '0px'});
			$('#txtCardName').val(cardName).css('background-color', '');
			$('#txtContactPerson').val(contactPerson).css({'background-color': '', 'border-radius': '0px'});
			$('#txtContactPersonCode').val(contactPersonCode);
			$('#txtJournalMemo').val('Purchase Orders - ' + cardCode);
			$('#txtControlAccountCode').val(controlAccount);
			$('#txtControlAccountName').val(controlAccount + ' - ' + controlAccountName);
			$('#txtControlAccountCodeDefault').val(controlAccount);
			$('#txtControlAccountNameDefault').val(controlAccount + ' - ' + controlAccountName);
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
							
								}, 100) 
					
					});
				});	
				
					//alert(cardCode)
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
		$(document.body).on('dblclick', '#tblStatesS tbody > tr', function () 
		{
	
			var code = $(this).children('td.item-1').text();
			var name = $(this).children('td.item-2').text();
			
		 
	
			$('#stateModalS').modal('hide');
		
			$('#txtStatesS').val(code);
			$('#txtStateSName').val(name);
			$('.shipInputs').trigger('keyup');       
		});
		$(document.body).on('dblclick', '#tblStatesB tbody > tr', function () 
		{
			
			var code = $(this).children('td.item-1').text();
			var name = $(this).children('td.item-2').text();
			
		 
	
			$('#stateModalB').modal('hide');
		
			$('#txtStatesB').val(code);
			$('#txtStateBName').val(name);
			$('.billInputs').trigger('keyup');       
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
		$(document.body).on('dblclick', '#tblControlAccount tbody > tr', function () 
		{
			
			var code = $(this).children('td.item-1').text();
			var name = $(this).children('td.item-2').text();
			
		 
	
			$('#controlAccountModal').modal('hide');
		
			$('#txtControlAccountCode').val(code);
			$('#txtControlAccountName').val(name);
		
		   
		});
		$(document.body).on('dblclick', '#tblUnit tbody > tr', function () 
		{
			
			var unitGroup = $(this).children('td.item-2').text();
			var unitName = $(this).children('td.item-3').text();
			var uomEntry = $(this).children('td.item-4').text();
			
	
			$('#uomModal').modal('hide');
			$('.selected-det').find('input.unitgrp').val(unitGroup);
			$('.selected-det').find('input.unitmsr').val(unitName);
			$('.selected-det').find('input.uomentry').val(uomEntry);
		   
		});
		$(document.body).on('change', 'input.file', function (event) {


			let targetPath = 'C:/Users/Administrator/Desktop/JCBA/ATTACHMENTS/';
			AddRowAttachment();
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
					
					}, 100) 
			
		});
	//On Change
		/* $(document.body).on('change', 'input:not(#txtDocNum)', function () 
		{
			
			if(objectType = 19){
				$('#btnOk').addClass('d-none');
				$('#btnUpdate').removeClass('d-none');
			}
				
			
			
		}); */
		/* $(document.body).on('input', 'input:not(#txtDocNum)', function () 
		{
			
			if(objectType = 19){
				$('#btnOk').addClass('d-none');
				$('#btnUpdate').removeClass('d-none');
			}
				
			
			
		}); */
		
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
		$(document.body).on('change', '#selTransactionType', function () 
		{
			serviceType =  $(this).val();
			if (serviceType == 'S'){
				$('input.quantity').val(1);
			}
			$('#contents-tab').load('../templates/ap-credit-memo-lines.php?serviceType=' + serviceType), function (){
				
			};
		});
	
	//On Shown Modals
	
		$('#apInvoiceModal').on('shown.bs.modal',function(){
			
			var cardCode = $('#txtCardCode').val();
			
			
			if(cardCode == '')
			{
				
				$('#tblAPI tbody').html('');
			}
			else
			{	
				
				$.ajax({
					type: 'GET',
					url: '../proc/views/vw_copyFromAPI.php',
					data: {cardCode : cardCode},
					success: function (html) 
					{
						$('#apInvoiceResult').html(html);
					}
				});
			}
		}); 
		$('#apDownpaymentModal').on('shown.bs.modal',function(){
			
			var cardCode = $('#txtCardCode').val();
			
			
			if(cardCode == '')
			{
				
				$('#tblAPD tbody').html('');
			}
			else
			{	
				
				$.ajax({
					type: 'GET',
					url: '../proc/views/vw_copyFromAPD.php',
					data: {cardCode : cardCode},
					success: function (html) 
					{
						$('#apDownpaymentResult').html(html);
					}
				});
			}
		}); 
		/* $('#apInvoiceModal').on('shown.bs.modal',function(){
			
			var cardCode = $('#txtCardCode').val();
			
			
			if(cardCode == '')
			{
				
				$('#tblSQ tbody').html('');
			}
			else
			{	
				
				$.ajax({
					type: 'GET',
					url: '../proc/views/vw_copyFromPR.php',
					data: {cardCode : cardCode},
					success: function (html) 
					{
						$('#salesQuotationResult').html(html);
					}
				});
			}
		}); */
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
					data: {itemCode : itemCode},
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
		$(document.body).on('click', '#btnItemSearch', function () {

			var txtItemSearch = $('#txtItemSearch').val();
			// $('#loadModal').modal('show');
			$.ajax({
				type: 'GET',
				url: '../proc/views/utilities/vw_itemsearch.php',
				data:
				{
					txtItemSearch: txtItemSearch,
					
				},
				success: function (data) {
					$('#tblItem').html(data)

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
			var txtControlAccountCode = $('#txtControlAccountCode').val();
		
			var txtSalesEmpCode = $('#txtSalesEmpCode').val();
			var txtOwnerCode = $('#txtOwnerCode').val();
			var txtRemarks = $('#txtRemarks').val();
			
			var selShipToAddress = $('#selShipToAddress').val();
			var selBillToAddress = $('#selBillToAddress').val();
			var txtJournalMemo = $('#txtJournalMemo').val();
			var txtPaymentTermsCode = $('#txtPaymentTermsCode').val();
			var txtCancellationDate = $('#txtCancellationDate').val();
			var txtRequiredDate = $('#txtRequiredDate').val();
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
						itArr.push('"' + $(this).find('input.ocrcode1').val() + '"');
						itArr.push('"' + $(this).find('input.ocrcode2').val() + '"');
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
						itArr.push('"' + $(this).find('input.ocrcode1').val() + '"');
						itArr.push('"' + $(this).find('input.ocrcode2').val() + '"');
					
					otArr.push('"' + i + '": [' + itArr.join(',') + ']'); 
					}
				}
			});
			
			json += otArr.join(",") + '}';
			
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
			

			if (err == 0) 
			{
				
				$('#loadModal').modal('show');
				$.ajax({
					type: 'POST',
					url: '../proc/exec/exec_add_ap-credit-memo.php',
					data: 
					{
						json: json.replace(/(\r\n|\n|\r)/gm, '[newline]'),
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
						txtControlAccountCode : txtControlAccountCode,
						txtPaymentTermsCode : txtPaymentTermsCode,
						txtCancellationDate : txtCancellationDate,
						txtRequiredDate : txtRequiredDate,
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
						
						
						serviceType : serviceType
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
									
								window.location.replace("../templates/ap-credit-memo-document.php");
								},9000)

								if(docentry != ''){
								setTimeout(function () {
									formData.append('objectType', 19);
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
											setTimeout(function () {
												$('#messageBar').text('').css({ 'background-color': '', 'color': '' });

												 window.location.replace("../templates/" + mainFileName + "-document.php");
											}, 5000)
										},
									});
								}, 2000)
							}
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
			let objectType = 19;
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
			var txtDocNum = $('#txtDocNum').val();
			let txtAtcEntry = $('#txtAtcEntry').val();
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
			var txtCancellationDate = $('#txtCancellationDate').val();
			var txtRequiredDate = $('#txtRequiredDate').val();
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
					url: '../proc/exec/exec_update_ap-credit-memo.php',
					data: 
					{
						json: json.replace(/(\r\n|\n|\r)/gm, '[newline]'),
						udfJson: udfJson.replace(/(\r\n|\n|\r)/gm, '[newline]'),
						txtDocEntry:txtDocEntry,
						jsonDeleteRow : jsonDeleteRow,
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
						txtCancellationDate : txtCancellationDate,
						txtRequiredDate : txtRequiredDate,
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
						
						
						serviceType : serviceType
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
									
								window.location.replace("../templates/ap-credit-memo-document.php");
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
							setTimeout(function () {
								$('#messageBar').text('').css({ 'background-color': '', 'color': '' });

								 window.location.replace("../templates/" + mainFileName + "-document.php");
							}, 10000)
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
	/*Keyups*/
	//Rows
		//Price
		$(document.body).on('keyup', '.price', function (e) 
		{
			
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
		$(document.body).on('blur', '.price', function () 
		{
			let amount = $('.selected-det').find('input.price').val();
			$('.selected-det').find('input.price').val(FormatMoney(amount));
			
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
			ComputeTotal();
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
			ComputeTotal();
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
				
					}, 100) 
		});
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
						
							$('#rowLoader').load('../templates/ap-credit-memo-lines-row.php?serviceType=' + serviceType, function (result) 
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
		function PreviewDoc(docNum, objType){
			let docstatus = '';
			let docType ='';
			if(objType == 19){
				objectType = 19;
				$('#btnAdd').addClass('d-none');
				//$('#btnOk').removeClass('d-none');
				$('#btnUpdate').removeClass('d-none');
				$('#btnCopyFrom').prop('disabled',false);
			}
			else{
				$('#btnAdd').removeClass('d-none');
				//$('#btnOk').addClass('d-none');
				$('#btnUpdate').addClass('d-none');
				$('#btnCopyFrom').prop('disabled',false);
			}
			
			$.getJSON('../proc/views/vw_getheaderdata.php?docNum=' + docNum + '&objType=' + objType, function (data){
				
				
				$.each(data, function (key, val){
					docType = val.DocType;
					docstatus = val.DocStatusFullText;
					//$('#txtDocNum').val(val.DocNum);
					
					$('#txtCurrency').val(val.DocCur);
					
					if(objType == 19){
						$('#txtCardCode').val(val.CardCode);
						$('#txtCardName').val(val.CardName);
						$('#txtDocNum').val(val.DocNum);
						$('#txtDocEntry').val(val.DocEntry);
						$('#txtAtcEntry').val(val.AtcEntry);
						$('#txtOwnerCode').val(val.EmpID);
						$('#txtOwnerName').val(val.EmployeeName);
					}
					else{
					//$('#txtDocNum').val("");
					}
					
					$('#txtStatus').val(val.DocStatusFullText);
					$('#txtCustomerRefNo').val(val.NumAtCard);
					$('#txtContactPersonCode').val(val.CntctCode);
					$('#txtContactPerson').val(val.ContactPerson);
					$('#selTransactionType').val(val.DocType);
					
					
					
					
					$('#txtPostingDate').val(val.DocDate);
					$('#txtDeliveryDate').val(val.DocDueDate);
					$('#txtDocumentDate').val(val.TaxDate);
					$('#txtCancellationDate').val(val.CancelDate);
					$('#txtRequiredDate').val(val.ReqDate);
					
					$('#txtFooterDiscountSum').val(val.DiscSum);
					$('#txtFooterDiscountPercentage').val(val.DiscPrcnt);
					$('#txtTotalBeforeDiscount').val(val.TotalBeforeDisc);
					
					$('#txtVatSum').val(val.VatSum);
					$('#txtDocTotal').val(val.DocCur + ' ' + val.DocTotal);
					
					$('#txtSalesEmpCode').val(val.SlpCode);
					$('#txtSalesEmpName').val(val.SlpName);
					
					
					if(objType == 19){
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
							
							$('#selShipToAddress').val(val.ShipToCode);
							$('#selShipToAddress').trigger('change');
							$('#lnkCardCode').removeClass('d-none');
							$('#lnkContactPerson').removeClass('d-none');
							
							$('#btnShipToDetails').removeClass('d-none');
							$('#btnBillToDetails').removeClass('d-none');
							
							$('#txtCardCode').css({'background-color': '', 'border-radius': '0px'});
							$('#txtCardName').css('background-color', '');
							$('#txtContactPerson').css({'background-color': '', 'border-radius': '0px'});
						
						 }, 300) 
						setTimeout(function () 
						{
							$('#selBillToAddress').val(val.PayToCode);
							
							$('#selBillToAddress').trigger('change');
							$('#selShippingType').val(val.TrnspCode);
						}, 500) 
					
					}
					else{
					$('#txtRemarks').val("Copied from A/P Invoice # " + val.DocNum );	
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
						PreviewRowsAttachments(docNum, docType, objType, function () {

						});
					
					
					
				}, 700) 
				
				setTimeout(function () 
				{	
					if(docstatus != 'Open'){
						$('input, textarea, select').prop('disabled', true );
						
						$('.btnGroup').addClass('d-none');
						$('#btnShipToDetails').addClass('d-none');
						$('#btnBillToDetails').addClass('d-none');
						
						/* 
						$('#salesOrder button').addClass('d-none');
						 */ 
						$('#footerButtons').addClass('d-none');
					}
					else{
						$('input, textarea, select').prop('disabled', false );
						/* $('input, textarea').prop('disabled', false );
						$('select').prop('disabled', false );
						 */
						$('#footerButtons').removeClass('d-none');
						$('.btnGroup').removeClass('d-none');
						
					}
					$('#selTransactionType').prop('disabled', true);
	
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
					 PreviewUDF(docNum);
						  $('#btnCardCode').addClass('d-none');
				}, 1100) 
		}
		function PreviewRows(docNum, docType, objType,callback){
			$('#tblDetails tbody').load('../proc/views/vw_getdetailsdata.php?docNum=' + docNum + '&docType=' + docType + '&objType=' + objType, function (result) 
			{
				callback();
			});
		}
		function PreviewRowsAttachments(docNum, docType, objType, callback) {
			$('#tblAttachment tbody').load('../proc/views/vw_getdetailsdataattachments.php?docNum=' + docNum + '&docType=' + docType + '&objType=' + objType, function (result) {
				
	
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