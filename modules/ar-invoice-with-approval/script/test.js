let trnspCode;
		$.getJSON('../proc/views/vw_getheaderdata.php?docNum=' + docNum + '&objType=' + objType + '&postedorDraft=' + postedorDraft, function (data) {
			
			$.each(data, function (key, val) {
				docType = val.DocType;
				docstatus = val.DocStatusFullText;
				//$('#txtDocNum').val(val.DocNum);
				trnspCode = val.TrnspCode;
				$('#txtCurrency').val(val.DocCur);

				if (objType == objectType) {
					$('#txtCardCode').val(val.CardCode);
					$('#txtCardName').val(val.CardName);
					$('#txtDocNum').val(val.DocNum);
					$('#txtDocEntry').val(val.DocEntry);
					$('#txtAtcEntry').val(val.AtcEntry);
					$('#txtApprovalStatus').val(postedorDraft);
					docNumBuff = val.DocNum;
					// alert(postedorDraft)
					if (postedorDraft == 'DRAFT'){
						$('#txtApprovalStatus').css({ 'background-color': '#f0ad4e'});
						
					} else if (postedorDraft == 'REJECTED'){
						$('#txtApprovalStatus').css({ 'background-color': '#FF7276'});
					} else {
						$('#txtApprovalStatus').css({ 'background-color': '#90ee90'});
					}

				}
				else {
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
				$('#txtExtraMonths').val(val.ExtraMonth);
				$('#txtExtraDays').val(val.ExtraDays);

				// FMS_DueDateBasedOnCRD();

				// val.CancelDate ? $('#txtCancellationDate').attr('type', 'date') : $('#txtCancellationDate').attr('type', 'text');
				// $('#txtCancellationDate').val(val.CancelDate);
				// $('#txtRequiredDate').val(val.ReqDate);
				if (objType == objectType) {
					$('#txtFooterDiscountSum').val(val.DiscSum);
					$('#txtFooterDiscountPercentage').val(val.DiscPrcnt);
					$('#txtTotalBeforeDiscount').val(val.TotalBeforeDisc);
					$('#txtVatSum').val(val.VatSum);
					$('#txtDocTotal').val(val.DocCur + ' ' + val.DocTotal);
					$('#txtPaidToDate').val(val.PaidToDate != '0.00' ? val.DocCur + ' ' + val.PaidToDate : val.PaidToDate);
				}
				// DITO DITO 

				$('#txtBalancedDue').val(val.BalancedDue != '0.00' ? val.DocCur + ' ' + val.BalancedDue : val.BalancedDue);

				$('#txtSalesEmpCode').val(val.SlpCode);
				$('#txtSalesEmpName').val(val.SlpName);

				$('#txtOwnerCode').val(val.EmpID);
				$('#txtOwnerName').val(val.EmployeeName);
				if (objType == objectType) {
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
						data: { cardCode: cardCode },
						success: function (html) {
							$('#selShipToAddress').html(html);

						}
					});
					$.ajax({
						type: 'GET',
						url: '../proc/views/vw_billToAddressID.php',
						data: { cardCode: cardCode },
						success: function (html) {

							$('#selBillToAddress').html(html);

						}
					});

					setTimeout(function () {

						val.ShipToCode !== null ? $('#selShipToAddress').val(val.ShipToCode) : '';
						$('#selShipToAddress').trigger('change');
						$('#lnkCardCode').removeClass('d-none');
						$('#lnkContactPerson').removeClass('d-none');

						// $('#btnShipToDetails').removeClass('d-none');
						// $('#btnBillToDetails').removeClass('d-none');

						$('#txtCardCode').css({ 'background-color': '', 'border-radius': '0px' });
						$('#txtCardName').css('background-color', '');
						$('#txtContactPerson').css({ 'background-color': '', 'border-radius': '0px' });

					}, 300)
					setTimeout(function () {
						$('#selBillToAddress').val(val.PayToCode);

						$('#selBillToAddress').trigger('change');
					}, 500)

					$('#txtNoOfRefDocTo').html('');

					$.ajax({
						type: 'POST',
						url: '../proc/views/vw_getRefDocTo.php',
						data: { docNum: val.DocNum },
						success: function (data) {
							let dataObj = JSON.parse(data);
							if (dataObj.length !== 0) {
								$('#txtNoOfRefDocTo').html(`(${dataObj.length})`);
							}
						}
					});

				}
				else {
					$('#txtRemarks').val(`Copied from ${baseTableName} # ` + val.DocNum);

					$('#txtPostingDate').val(val.DocDate).prop("disabled", true);
					$('#txtPostingDate2').prop("disabled", true);
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
			setTimeout(function () {

				PreviewRows(docNum, docType, objType, postedorDraft, function () {

				});
				PreviewRowsAttachments(docNum, docType, objType, function () {

				});
				PreviewRowsWTAX(docNum, function () {

				});



			}, 700)

			setTimeout(function () {
				if (objType == objectType) {
					if (docstatus != 'Open') {
						$('input, textarea, select').prop('disabled', true);

						$('.btnGroup').addClass('d-none');
						$('#btnShipToDetails').addClass('d-none');
						$('#btnBillToDetails').addClass('d-none');

						/* 
						$('#salesOrder button').addClass('d-none');
						 */
						$('#footerButtons').addClass('d-none');
						$('#layoutOptions').prop("disabled", false);
					} else {
						$('#udfResult input, #udfResult textarea, #udfResult select').prop('disabled', false);
						//$('input, textarea, select').prop('disabled', false );
						/* $('input, textarea').prop('disabled', false );
						$('select').prop('disabled', false );
						 */
						$('#footerButtons').removeClass('d-none');
						$('.btnGroup').removeClass('d-none');
						$('.btnrowfunctions').removeClass('d-none');

					}
					$('input.footer').prop('disabled', true);
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
					data: { cardCode: data[0].CardCode },
					success: function (html) {
						$('#selShippingType').html(html);
						$('#selShippingType').val(trnspCode);
					}
				});
			}, 900)
		});