$(() => {

console.log('vertical working')

	let dateFormat = 'YYYY-MM-DD'
	let otArrPOD = []; 
	let otArrBILLING = []; 
	let otArrTP = []; 
	let otArrPRICING = [];
	let PricingU_TotalInitialTruckers = 0;
	let pid = '';
	let ECVatGroup = '';
	let ECVatGroupS = '';

	$(document.body).on('dblclick', '.detailsTable tbody > tr', function () 
	{
		
		pid = $(this).find('td:eq(3)').text();
		tabId = $(".tab-pane:visible").attr("id")
		console.log(pid)
		console.log($('.detailsTable').attr('id'))
		console.log($(".tab-pane:visible").attr("id"))


		// podtabpane
		// billingtabpane
		// tptabpane
		// pricingtabpane

		if(tabId == 'podtabpane'){
			$('#modalVerticalPOD').modal('show')

		}

		if(tabId == 'billingtabpane'){
			$('#modalVerticalBILLING').modal('show')


			$.getJSON('../proc/views/vertical/vw_BILLING.php?pid=' + pid, function (data){
			
					
					let inputID = $(this).attr('id')
					$.each(data, function (key, val){
						console.log(key + "/" + val[inputID])
						// if(inputID == val.inputID)
						// console.log(key + '/' + val.inputID)

						$('#modalVerticalBILLING').find('#Code').val(val.Code);
						$('#modalVerticalBILLING').find('#Name').val(val.Name);
						$('#modalVerticalBILLING').find('#U_BookingDate').val(val.U_BookingDate);
						$('#modalVerticalBILLING').find('#U_BookingId').val(val.U_BookingId);
						$('#modalVerticalBILLING').find('#U_ClientName').val(val.U_ClientName);
						$('#modalVerticalBILLING').find('#U_SAPClient').val(val.U_SAPClient);
						$('#modalVerticalBILLING').find('#U_TruckerName').val(val.U_TruckerName);
						$('#modalVerticalBILLING').find('#U_SAPTrucker').val(val.U_SAPTrucker);
						$('#modalVerticalBILLING').find('#U_PlateNumber').val(val.U_PlateNumber);
						$('#modalVerticalBILLING').find('#U_VehicleTypeCap').val(val.U_VehicleTypeCap);
						$('#modalVerticalBILLING').find('#U_DeliveryOrigin').val(val.U_DeliveryOrigin);
						$('#modalVerticalBILLING').find('#U_Destination').val(val.U_Destination);
						$('#modalVerticalBILLING').find('#U_DeliveryStatus').val(val.U_DeliveryStatus);
						$('#modalVerticalBILLING').find('#U_DeliveryDateDTR').val(val.U_DeliveryDateDTR);
						$('#modalVerticalBILLING').find('#U_DeliveryDatePOD').val(val.U_DeliveryDatePOD);
						$('#modalVerticalBILLING').find('#U_NoOfDrops').val(val.U_NoOfDrops);
						$('#modalVerticalBILLING').find('#U_TripType').val(val.U_TripType);
						$('#modalVerticalBILLING').find('#U_Remarks').val(val.U_Remarks);
						$('#modalVerticalBILLING').find('#U_TripTicketNo').val(val.U_TripTicketNo);
						$('#modalVerticalBILLING').find('#U_WaybillNo').val(val.U_WaybillNo);
						$('#modalVerticalBILLING').find('#U_ShipmentNo').val(val.U_ShipmentNo);
						$('#modalVerticalBILLING').find('#U_DeliveryReceiptNo').val(val.U_DeliveryReceiptNo);
						$('#modalVerticalBILLING').find('#U_SeriesNo').val(val.U_SeriesNo);
						$('#modalVerticalBILLING').find('#U_OtherPODDoc').val(val.U_OtherPODDoc);
						$('#modalVerticalBILLING').find('#U_RemarksPOD').val(val.U_RemarksPOD);
						$('#modalVerticalBILLING').find('#U_Receivedby').val(val.U_Receivedby);
						$('#modalVerticalBILLING').find('#U_ClientReceivedDate').val(val.U_ClientReceivedDate);
						$('#modalVerticalBILLING').find('#U_InitialHCRecDate').val(val.U_InitialHCRecDate);
						$('#modalVerticalBILLING').find('#U_ActualHCRecDate').val(val.U_ActualHCRecDate);
						$('#modalVerticalBILLING').find('#U_DateReturned').val(val.U_DateReturned);
						$('#modalVerticalBILLING').find('#U_PODinCharge').val(val.U_PODinCharge);
						$('#modalVerticalBILLING').find('#U_VerifiedDateHC').val(val.U_VerifiedDateHC);
						$('#modalVerticalBILLING').find('#U_PODStatusDetail').val(val.U_PODStatusDetail);
						$('#modalVerticalBILLING').find('#U_PTFNo').val(val.U_PTFNo);
						$('#modalVerticalBILLING').find('#U_DateForwardedBT').val(val.U_DateForwardedBT);
						$('#modalVerticalBILLING').find('#U_BillingDeadline').val(val.U_BillingDeadline);
						$('#modalVerticalBILLING').find('#U_BillingStatus').val(val.U_BillingStatus);
						$('#modalVerticalBILLING').find('#U_ServiceType').val(val.U_ServiceType);
						$('#modalVerticalBILLING').find('#U_SINo').val(val.U_SINo);
						$('#modalVerticalBILLING').find('#U_BillingTeam').val(val.U_BillingTeam);
						$('#modalVerticalBILLING').find('#U_BTRemarks').val(val.U_BTRemarks);
						$('#modalVerticalBILLING').find('#U_SOBNumber').val(val.U_SOBNumber);
						$('#modalVerticalBILLING').find('#U_OutletNo').val(val.U_OutletNo);
						$('#modalVerticalBILLING').find('#U_CBM').val(val.U_CBM);
						$('#modalVerticalBILLING').find('#U_SI_DRNo').val(val.U_SI_DRNo);
						$('#modalVerticalBILLING').find('#U_DeliveryMode').val(val.U_DeliveryMode);
						$('#modalVerticalBILLING').find('#U_SourceWhse').val(val.U_SourceWhse);
						$('#modalVerticalBILLING').find('#U_DestinationClient').val(val.U_DestinationClient);
						$('#modalVerticalBILLING').find('#U_TotalInvAmount').val(val.U_TotalInvAmount);
						$('#modalVerticalBILLING').find('#U_SONo').val(val.U_SONo);
						$('#modalVerticalBILLING').find('#U_NameCustomer').val(val.U_NameCustomer);
						$('#modalVerticalBILLING').find('#U_CategoryDR').val(val.U_CategoryDR);
						$('#modalVerticalBILLING').find('#U_ForwardLoad').val(val.U_ForwardLoad);
						$('#modalVerticalBILLING').find('#U_BackLoad').val(val.U_BackLoad);
						$('#modalVerticalBILLING').find('#U_IDNumber').val(val.U_IDNumber);
						$('#modalVerticalBILLING').find('#U_TypeOfAccessorial').val(val.U_TypeOfAccessorial);
						$('#modalVerticalBILLING').find('#U_ApprovalStatus').val(val.U_ApprovalStatus);
						$('#modalVerticalBILLING').find('#U_TimeInEmptyDem').val(val.U_TimeInEmptyDem);
						$('#modalVerticalBILLING').find('#U_TimeOutEmptyDem').val(val.U_TimeOutEmptyDem);
						$('#modalVerticalBILLING').find('#U_VerifiedEmptyDem').val(val.U_VerifiedEmptyDem);
						$('#modalVerticalBILLING').find('#U_TimeInLoadedDem').val(val.U_TimeInLoadedDem);
						$('#modalVerticalBILLING').find('#U_TimeOutLoadedDem').val(val.U_TimeOutLoadedDem);
						$('#modalVerticalBILLING').find('#U_VerifiedLoadedDem').val(val.U_VerifiedLoadedDem);
						$('#modalVerticalBILLING').find('#U_Remarks2').val(val.U_Remarks2);
						$('#modalVerticalBILLING').find('#U_TimeInAdvLoading').val(val.U_TimeInAdvLoading);
						$('#modalVerticalBILLING').find('#U_DayOfTheWeek').val(val.U_DayOfTheWeek);
						$('#modalVerticalBILLING').find('#U_TimeIn').val(val.U_TimeIn);
						$('#modalVerticalBILLING').find('#U_TimeOut').val(val.U_TimeOut);
						$('#modalVerticalBILLING').find('#U_ODOIn').val(val.U_ODOIn);
						$('#modalVerticalBILLING').find('#U_ODOOut').val(val.U_ODOOut);
						$('#modalVerticalBILLING').find('#U_ClientSubStatus').val(val.U_ClientSubStatus);
						$('#modalVerticalBILLING').find('#U_ClientSubOverdue').val(val.U_ClientSubOverdue);
						$('#modalVerticalBILLING').find('#U_ClientPenaltyCalc').val(val.U_ClientPenaltyCalc);
						$('#modalVerticalBILLING').find('#U_PODStatusPayment').val(val.U_PODStatusPayment);
						$('#modalVerticalBILLING').find('#U_PODSubmitDeadline').val(val.U_PODSubmitDeadline);
						$('#modalVerticalBILLING').find('#U_OverdueDays').val(val.U_OverdueDays);
						$('#modalVerticalBILLING').find('#U_InteluckPenaltyCalc').val(val.U_InteluckPenaltyCalc);
						$('#modalVerticalBILLING').find('#U_WaivedDays').val(val.U_WaivedDays);
						$('#modalVerticalBILLING').find('#U_HolidayOrWeekend').val(val.U_HolidayOrWeekend);
						$('#modalVerticalBILLING').find('#U_LostPenaltyCalc').val(val.U_LostPenaltyCalc);
						$('#modalVerticalBILLING').find('#U_TotalSubPenalties').val(val.U_TotalSubPenalties);
						$('#modalVerticalBILLING').find('#U_Waived').val(val.U_Waived);
						$('#modalVerticalBILLING').find('#U_PercPenaltyCharge').val(val.U_PercPenaltyCharge);
						$('#modalVerticalBILLING').find('#U_Approvedby').val(val.U_Approvedby);
						$('#modalVerticalBILLING').find('#U_TotalPenaltyWaived').val(val.U_TotalPenaltyWaived);
						$('#modalVerticalBILLING').find('#U_DocNum').val(val.U_DocNum);
						$('#modalVerticalBILLING').find('#U_UpdateDate').val(val.U_UpdateDate);
						$('#modalVerticalBILLING').find('#U_CreateDate').val(val.U_CreateDate);
						$('#modalVerticalBILLING').find('#U_Attachment').val(val.U_Attachment);
						$('#modalVerticalBILLING').find('#U_Creator').val(val.U_Creator);
						$('#modalVerticalBILLING').find('#U_TotalNoExceed').val(val.U_TotalNoExceed);
						$('#modalVerticalBILLING').find('#U_TotalUsage').val(val.U_TotalUsage);

						
					});


			});
		}

		if(tabId == 'tptabpane'){
			$('#modalVerticalTP').modal('show')


				$.getJSON('../proc/views/vertical/vw_TP.php?pid=' + pid, function (data){
			
					
					let inputID = $(this).attr('id')
					$.each(data, function (key, val){
						console.log(key + "/" + val.U_TPStatus)
						// if(inputID == val.inputID)
						// console.log(key + '/' + val.inputID)
						$('#modalVerticalTP').find('#Code').val(val.Code);
						$('#modalVerticalTP').find('#Name').val(val.Name);
						$('#modalVerticalTP').find('#U_BookingId').val(val.U_BookingId);
						$('#modalVerticalTP').find('#U_BookingDate').val(val.U_BookingDate);
						$('#modalVerticalTP').find('#U_ClientName').val(val.U_ClientName);
						$('#modalVerticalTP').find('#U_TruckerName').val(val.U_TruckerName);
						$('#modalVerticalTP').find('#U_TruckerSAP').val(val.U_TruckerSAP);
						$('#modalVerticalTP').find('#U_DeliveryStatus').val(val.U_DeliveryStatus);
						$('#modalVerticalTP').find('#U_DeliveryDatePOD').val(val.U_DeliveryDatePOD);
						$('#modalVerticalTP').find('#U_TripTicketNo').val(val.U_TripTicketNo);
						$('#modalVerticalTP').find('#U_WaybillNo').val(val.U_WaybillNo);
						$('#modalVerticalTP').find('#U_ShipmentManifestNo').val(val.U_ShipmentManifestNo);
						$('#modalVerticalTP').find('#U_DeliveryReceiptNo').val(val.U_DeliveryReceiptNo);
						$('#modalVerticalTP').find('#U_SeriesNo').val(val.U_SeriesNo);
						$('#modalVerticalTP').find('#U_OtherPODDoc').val(val.U_OtherPODDoc);
						$('#modalVerticalTP').find('#U_TPStatus').val(val.U_TPStatus);
						$('#modalVerticalTP').find('#U_Aging').val(val.U_Aging);
						$('#modalVerticalTP').find('#U_GrossTruckerRates').val(val.U_GrossTruckerRates);
						$('#modalVerticalTP').find('#U_GrossTruckerRatesN').val(val.U_GrossTruckerRatesN);
						$('#modalVerticalTP').find('#U_RateBasis').val(val.U_RateBasis);
						$('#modalVerticalTP').find('#U_TaxType').val(val.U_TaxType);
						$('#modalVerticalTP').find('#U_Demurrage').val(val.U_Demurrage);
						$('#modalVerticalTP').find('#U_AddtlDrop').val(val.U_AddtlDrop);
						$('#modalVerticalTP').find('#U_BoomTruck').val(val.U_BoomTruck);
						$('#modalVerticalTP').find('#U_Manpower').val(val.U_Manpower);
						$('#modalVerticalTP').find('#U_BackLoad').val(val.U_BackLoad);
						$('#modalVerticalTP').find('#U_Addtlcharges').val(val.U_Addtlcharges);
						$('#modalVerticalTP').find('#U_DemurrageN').val(val.U_DemurrageN);
						$('#modalVerticalTP').find('#U_AddtlChargesN').val(val.U_AddtlChargesN);
						$('#modalVerticalTP').find('#U_ActualRates').val(val.U_ActualRates);
						$('#modalVerticalTP').find('#U_RateAdjustments').val(val.U_RateAdjustments);
						$('#modalVerticalTP').find('#U_ActualDemurrage').val(val.U_ActualDemurrage);
						$('#modalVerticalTP').find('#U_ActualCharges').val(val.U_ActualCharges);
						$('#modalVerticalTP').find('#U_BoomTruck2').val(val.U_BoomTruck2);
						$('#modalVerticalTP').find('#U_OtherCharges').val(val.U_OtherCharges);
						$('#modalVerticalTP').find('#U_TotalSubPenalty').val(val.U_TotalSubPenalty);
						$('#modalVerticalTP').find('#U_TotalPenaltyWaived').val(val.U_TotalPenaltyWaived);
						$('#modalVerticalTP').find('#U_TotalPenalty').val(val.U_TotalPenalty);
						$('#modalVerticalTP').find('#U_TotalPayable').val(val.U_TotalPayable);
						$('#modalVerticalTP').find('#U_EWT2307').val(val.U_EWT2307);
						$('#modalVerticalTP').find('#U_TotalPayableRec').val(val.U_TotalPayableRec);
						$('#modalVerticalTP').find('#U_PaymentVoucherNo').val(val.U_PaymentVoucherNo);
						$('#modalVerticalTP').find('#U_ORRefNo').val(val.U_ORRefNo);
						$('#modalVerticalTP').find('#U_ActualPaymentDate').val(val.U_ActualPaymentDate);
						$('#modalVerticalTP').find('#U_PaymentReference').val(val.U_PaymentReference);
						$('#modalVerticalTP').find('#U_PaymentStatus').val(val.U_PaymentStatus);
						$('#modalVerticalTP').find('#U_Remarks').val(val.U_Remarks);
						$('#modalVerticalTP').find('#U_UpdateDate').val(val.U_UpdateDate);
						$('#modalVerticalTP').find('#U_CreateDate').val(val.U_CreateDate);
						$('#modalVerticalTP').find('#U_PODNum').val(val.U_PODNum);
						$('#modalVerticalTP').find('#U_PODSONum').val(val.U_PODSONum);
						$('#modalVerticalTP').find('#U_DocNum').val(val.U_DocNum);
					

					});

				});
		}if(tabId == 'pricingtabpane'){
			$('#modalVerticalPRICING').modal('show')
			pid = $(this).find('td:eq(2)').text();
			console.log(pid)
				$.getJSON('../proc/views/vertical/vw_PRICING.php?pid=' + pid, function (data){
			
					
					let inputID = $(this).attr('id')
					$.each(data, function (key, val){
						console.log(key + "/" + val.ECVatGroup)
						ECVatGroup = val.ECVatGroup;
						ECVatGroupS = val.ECVatGroupS;
						// if(inputID == val.inputID)
						// console.log(key + '/' + val.inputID)
						$('#modalVerticalPRICING').find('#Code').val(val.Code);
						$('#modalVerticalPRICING').find('#Name').val(val.Name);
						$('#modalVerticalPRICING').find('#U_BookingId').val(val.U_BookingId);
						$('#modalVerticalPRICING').find('#U_BookingDate').val(val.U_BookingDate);
						$('#modalVerticalPRICING').find('#U_CustomerName').val(val.U_CustomerName);
						$('#modalVerticalPRICING').find('#U_ClientTag').val(val.U_ClientTag);
						$('#modalVerticalPRICING').find('#U_ClientProject').val(val.U_ClientProject);
						$('#modalVerticalPRICING').find('#U_TruckerName').val(val.U_TruckerName);
						$('#modalVerticalPRICING').find('#U_TruckerTag').val(val.U_TruckerTag);
						$('#modalVerticalPRICING').find('#U_VehicleTypeCap').val(val.U_VehicleTypeCap);
						$('#modalVerticalPRICING').find('#U_DeliveryOrigin').val(val.U_DeliveryOrigin);
						$('#modalVerticalPRICING').find('#U_Destination').val(val.U_Destination);
						$('#modalVerticalPRICING').find('#U_DeliveryStatus').val(val.U_DeliveryStatus);
						$('#modalVerticalPRICING').find('#U_TripType').val(val.U_TripType);
						$('#modalVerticalPRICING').find('#U_NoOfDrops').val(val.U_NoOfDrops);
						$('#modalVerticalPRICING').find('#U_RemarksDTR').val(val.U_RemarksDTR);
						$('#modalVerticalPRICING').find('#U_RemarksPOD').val(val.U_RemarksPOD);
						$('#modalVerticalPRICING').find('#U_GrossClientRates').val(val.U_GrossClientRates);
						$('#modalVerticalPRICING').find('#U_GrossClientRatesTax').val(val.U_GrossClientRatesTax);
						$('#modalVerticalPRICING').find('#U_RateBasis').val(val.U_RateBasis);
						$('#modalVerticalPRICING').find('#U_TaxType').val(val.U_TaxType);
						$('#modalVerticalPRICING').find('#U_GrossProfitNet').val(val.U_GrossProfitNet);
						$('#modalVerticalPRICING').find('#U_TotalAddtlCharges').val(val.U_TotalAddtlCharges);
						$('#modalVerticalPRICING').find('#U_totalAddtlCharges2').val(val.U_totalAddtlCharges2);
						$('#modalVerticalPRICING').find('#U_AddtlCharges').val(val.U_AddtlCharges);
						$('#modalVerticalPRICING').find('#U_GrossProfit').val(val.U_GrossProfit);
						$('#modalVerticalPRICING').find('#U_TotalInitialClient').val(val.U_TotalInitialClient);
						$('#modalVerticalPRICING').find('#U_TotalInitialTruckers').val(val.U_TotalInitialTruckers);
						$('#modalVerticalPRICING').find('#U_TotalGrossProfit').val(val.U_TotalGrossProfit);
						$('#modalVerticalPRICING').find('#U_ClientTag2').val(val.U_ClientTag2);
						$('#modalVerticalPRICING').find('#U_UpdateDate').val(val.U_UpdateDate);
						$('#modalVerticalPRICING').find('#U_CreateDate').val(val.U_CreateDate);
						$('#modalVerticalPRICING').find('#U_PODNum').val(val.U_PODNum);
						$('#modalVerticalPRICING').find('#U_GrossTruckerRates').val(val.U_GrossTruckerRates);
						$('#modalVerticalPRICING').find('#U_GrossTruckerRatesTax').val(val.U_GrossTruckerRatesTax);
						$('#modalVerticalPRICING').find('#U_RateBasisT').val(val.U_RateBasisT);
						$('#modalVerticalPRICING').find('#U_TaxTypeT').val(val.U_TaxTypeT);
						$('#modalVerticalPRICING').find('#U_Demurrage4').val(val.U_Demurrage4);
						$('#modalVerticalPRICING').find('#U_AddtlCharges2').val(val.U_AddtlCharges2);
						$('#modalVerticalPRICING').find('#U_GrossProfitC').val(val.U_GrossProfitC);
						$('#modalVerticalPRICING').find('#U_Demurrage').val(val.U_Demurrage);
						$('#modalVerticalPRICING').find('#U_AddtlDrop').val(val.U_AddtlDrop);
						$('#modalVerticalPRICING').find('#U_BoomTruck').val(val.U_BoomTruck);
						$('#modalVerticalPRICING').find('#U_Manpower').val(val.U_Manpower);
						$('#modalVerticalPRICING').find('#U_Backload').val(val.U_Backload);
						$('#modalVerticalPRICING').find('#U_Demurrage2').val(val.U_Demurrage2);
						$('#modalVerticalPRICING').find('#U_AddtlDrop2').val(val.U_AddtlDrop2);
						$('#modalVerticalPRICING').find('#U_BoomTruck2').val(val.U_BoomTruck2);
						$('#modalVerticalPRICING').find('#U_Manpower2').val(val.U_Manpower2);
						$('#modalVerticalPRICING').find('#U_Backload2').val(val.U_Backload2);
						$('#modalVerticalPRICING').find('#U_Demurrage3').val(val.U_Demurrage3);




					

					});

				});
		}
		


	  
	       
    });


	$(document.body).on('click', '#btnUpdatePODRow', function () 
	{

		var err = 0;
        var errmsg = '';
		


		let U_VehicleTypeCap = $('#modalVerticalPOD select#U_VehicleTypeCap').val()
		let podstatus = $('#modalVerticalPOD select#U_PODStatusDetail').val()
		
		if(U_VehicleTypeCap == ''){
			err = 1;
			errmsg = 'Vehicle Type Required!';
		}
		if(podstatus == 'Verified'){
			$('#modalVerticalPOD select.podstatusrequired, #modalVerticalPOD input.podstatusrequired').each(function (i) 
			{

				if($(this).val() == ''){
					err += 1;
					
				}
			});
		}	
		if(podstatus == 'OngoingVerification'){
			$('#modalVerticalPOD input.ongoingrequired').each(function (i) 
			{

				if($(this).val() == ''){
					err += 1;
					
				}
			});
		}	
		if(podstatus == 'OnholdbyPOD'){
			$('#modalVerticalPOD input.onholdrequired').each(function (i) 
			{

				if($(this).val() == ''){
					err += 1;
					
				}
			});
		}	
		if(podstatus == 'Returnedtotrucker'){
			$('#modalVerticalPOD input.returnrequired').each(function (i) 
			{

				if($(this).val() == ''){
					err += 1;
					
				}
			});
		}	
		if(podstatus == 'PendingHardcopy'){
			$('#modalVerticalPOD input.pendingrequired').each(function (i) 
			{

				if($(this).val() == ''){
					err += 1;
					
				}
			});
		}

			
			// if($(this).find("td:eq(3)").text() != ''){
			// 	itArrRowsPOD.push('"' + 'U_BookingDate' + '"' + ":" + '"' + validDate($(this).find("td:eq(3)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")) + '"')					
			// 	otArrPODNotNullCellsTotal += 1;
			// 	notNullCouterRows += 1;
			// }
		let itArrPOD = [];
		$('#modalVerticalPOD input:not(.podincharge), #modalVerticalPOD select').each(function (i) 
		{

			if($(this).val() != ''){
				console.log($(this).val())
				itArrPOD.push('"' + $(this).attr('id') + '"' + ":" + '"' + $(this).val() + '"')	

				
			}
		});
		otArrPOD.push('{' + itArrPOD.join(',') + '}');

		
		console.log(err)
		if(err == 0){	
			let podData = otArrPOD[0]
			console.log(podData)					
			if(otArrPOD.length != 0){
				$.ajax({

		        type: 'POST',
		        url: '../proc/exec/exec_update_pctpPODRow.php',
		        startTime: performance.now(),
				data:{
					pid: pid,
					podData: podData
					
				},
				success: function (data){
						console.log(data)	

						var res = $.parseJSON(data);
						
						if(res.valid == true)
						{

						$('#modalVerticalPOD').modal('hide');
						$('#messageBar2').addClass('d-none');
						$('#messageBar3').removeClass('d-none');
						$('#messageBar').text(res.msg).css({'background-color': '#00FF7F', 'color': 'black'});
						
						
							setTimeout(function()
							{
								$('#messageBar').text('').css({'background-color': '', 'color': ''});	
								
								//window.location.replace("../templates/delivery-document.php");
							},3000)
						}else{

						}
		        },
		        complete: function (data) {
		        	
			    

						}
		 		});
			}else{

			}
		}else{
			
				$('#messageBar2').addClass('d-none');
						$('#messageBar3').removeClass('d-none');
						$('#messageBar').text('Input Required Fields').css({'background-color': 'red', 'color': 'white'});
						
							setTimeout(function()
							{
								$('#messageBar').text('').css({'background-color': '', 'color': ''});	
								$('#messageBar2').removeClass('d-none');
							},5000)
		}

		
					
	})

	$(document.body).on('click', '#btnUpdateBILLINGRow', function () 
	{

		var err = 0;
        var errmsg = '';
		


			
		let itArrBILLING = [];
		$('#modalVerticalBILLING select').each(function (i) 
		{

			if($(this).val() != ''){
				console.log($(this).val())
				itArrBILLING.push('"' + $(this).attr('id') + '"' + ":" + '"' + $(this).val() + '"')	

				
			}
		});
		$('#modalVerticalBILLING input.podincharg').each(function (i) 
		{

			if($(this).val() != ''){
				console.log($(this).val())
				itArrTP.push('"' + $(this).attr('id') + '"' + ":" + '"' + $(this).val() + '"')	

				
			}
		});
		otArrBILLING.push('{' + itArrBILLING.join(',') + '}');

		
		if(err == 0){
			let billingData = otArrBILLING[0]
			console.log(billingData)					
			if(otArrBILLING.length != 0){
				$.ajax({

		        type: 'POST',
		        url: '../proc/exec/exec_update_pctpBILLINGRow.php',
		        startTime: performance.now(),
				data:{
					pid: pid,
					billingData: billingData
					
				},
				success: function (data){
						console.log(data)	

						var res = $.parseJSON(data);
						
						if(res.valid == true)
						{

						$('#modalVerticalBILLING').modal('hide');
						$('#messageBar2').addClass('d-none');
						$('#messageBar3').removeClass('d-none');
						$('#messageBar').text(res.msg).css({'background-color': '#00FF7F', 'color': 'black'});
						
						
							setTimeout(function()
							{
								$('#messageBar').text('').css({'background-color': '', 'color': ''});	
								
								//window.location.replace("../templates/delivery-document.php");
							},3000)
						}else{

						}
		        },
		        complete: function (data) {
		        	
			    

						}
		 		});
			}else{

			}
		}
		else{
			$('#messageBar2').addClass('d-none');
			$('#messageBar3').removeClass('d-none');
			$('#messageBar').text(errmsg).css({'background-color': 'red', 'color': 'white'});
			
				setTimeout(function()
				{
					$('#messageBar').text('').css({'background-color': '', 'color': ''});	
					$('#messageBar2').removeClass('d-none');
				},5000)
		}
	

					
	})
	$(document.body).on('click', '#btnUpdateTPRow', function () 
	{

		

			
			// if($(this).find("td:eq(3)").text() != ''){
			// 	itArrRowsPOD.push('"' + 'U_BookingDate' + '"' + ":" + '"' + validDate($(this).find("td:eq(3)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")) + '"')					
			// 	otArrPODNotNullCellsTotal += 1;
			// 	notNullCouterRows += 1;
			// }
		let itArrTP = [];
		$('#modalVerticalTP select').each(function (i) 
		{

			if($(this).val() != ''){
				console.log($(this).val())
				itArrTP.push('"' + $(this).attr('id') + '"' + ":" + '"' + $(this).val() + '"')	

				
			}
		});
		$('#modalVerticalTP input.editable').each(function (i) 
		{

			if($(this).val() != ''){
				console.log($(this).val())
				itArrTP.push('"' + $(this).attr('id') + '"' + ":" + '"' + $(this).val() + '"')	

				
			}
		});
		otArrTP.push('{' + itArrTP.join(',') + '}');

		

		let tpData = otArrTP[0]
		console.log(tpData)					
		if(otArrTP.length != 0){
			$.ajax({

	        type: 'POST',
	        url: '../proc/exec/exec_update_pctpTPRow.php',
	        startTime: performance.now(),
			data:{
				pid: pid,
				tpData: tpData
				
			},
			success: function (data){
					console.log(data)	

					var res = $.parseJSON(data);
					
					if(res.valid == true)
					{

					$('#modalVerticalTP').modal('hide');
					$('#messageBar2').addClass('d-none');
					$('#messageBar3').removeClass('d-none');
					$('#messageBar').text(res.msg).css({'background-color': '#00FF7F', 'color': 'black'});
					
					
						setTimeout(function()
						{
							$('#messageBar').text('').css({'background-color': '', 'color': ''});	
							
							//window.location.replace("../templates/delivery-document.php");
						},3000)
					}else{

					}
	        },
	        complete: function (data) {
	        	
		    

					}
	 		});
		}else{

		}

					
	})
	$(document.body).on('click', '#btnUpdatePRICINGRow', function () 
	{

		

		let itArrPRICING = [];
		$('#modalVerticalPRICING select').each(function (i) 
		{

			if($(this).val() != ''){
				console.log($(this).val())
				itArrPRICING.push('"' + $(this).attr('id') + '"' + ":" + '"' + $(this).val() + '"')	

				
			}
		});
		$('#modalVerticalPRICING input.editable').each(function (i) 
		{

			if($(this).val() != ''){
				console.log($(this).val())
				itArrPRICING.push('"' + $(this).attr('id') + '"' + ":" + '"' + $(this).val() + '"')	

				
			}
		});
		otArrPRICING.push('{' + itArrPRICING.join(',') + '}');

		

		let pricingData = otArrPRICING[0]
		console.log(pricingData)					
		if(otArrPRICING.length != 0){
			$.ajax({

	        type: 'POST',
	        url: '../proc/exec/exec_update_pctpPRICINGRow.php',
	        startTime: performance.now(),
			data:{
				pid: pid,
				pricingData: pricingData
				
			},
			success: function (data){
					console.log(data)	

					var res = $.parseJSON(data);
					
					if(res.valid == true)
					{

					$('#modalVerticalPRICING').modal('hide');
					$('#messageBar2').addClass('d-none');
					$('#messageBar3').removeClass('d-none');
					$('#messageBar').text(res.msg).css({'background-color': '#00FF7F', 'color': 'black'});
					
					
						setTimeout(function()
						{
							$('#messageBar').text('').css({'background-color': '', 'color': ''});	
							
							//window.location.replace("../templates/delivery-document.php");
						},3000)
					}else{

					}
	        },
	        complete: function (data) {
	        	
		    

					}
	 		});
		}else{

		}

					
	})

	$(document.body).on('dblclick', '#tblCustomer tbody > tr', function () 
	{
		
		let cardCode = $(this).children('td.item-1').text();
        let cardName = $(this).children('td.item-2').text();
     

        $('#customerModal').modal('hide');
	

	
		$('#U_SAPClient').val(cardCode);
		$('#U_ClientName').val(cardName);
		

	});
	$(document.body).on('dblclick', '#tblVendor tbody > tr', function () 
	{
		
		let cardCode = $(this).children('td.item-1').text();
        let cardName = $(this).children('td.item-2').text();
     

        $('#vendorModal').modal('hide');

	
		$('#U_SAPTrucker').val(cardCode);
		$('#U_TruckerName').val(cardName);
		

	});

	//----------------------------------------------------------------------------------------------------------------------------
	// POD FORMULA
	$(document.body).on('blur', '#modalVerticalPOD input.date', function () 
	{	
		let date = new Date($(this).val())
			if(date != 'Invalid Date'){
				
			}else{
				$(this).focus()
				$('#messageBar2').addClass('d-none');
				$('#messageBar3').removeClass('d-none');
				$('#messageBar').text('Invalid Date').css({'background-color': 'red', 'color': 'white'});
				
					setTimeout(function()
					{
						$('#messageBar').text('').css({'background-color': '', 'color': ''});	
						
					},5000)
			}
			
		
	});
	$(document.body).on('change', '#modalVerticalPOD input#U_ClientReceivedDate', function () 
	{
		console.log($(this).val())
		if($(this).val() == ''){
			$('#modalVerticalPOD input#U_ClientSubStatus').val('PENDING')
		}else{
			let date = new Date($(this).val())
			if(date != 'Invalid Date'){
				console.log(date)
				$('#modalVerticalPOD input#U_ClientSubStatus').val('SUBMITTED')
			}else{
				
			}
			
		}
	})
	$(document.body).on('blur', '#modalVerticalPOD input#U_DeliveryDateDTR', function () 
	{
		let dtrDate =  new Date($(this).val())
		let clientRecDate = $('#modalVerticalPOD input#U_ClientReceivedDate').val();
	

		var start = new Date($(this).val());
		var end = new Date(clientRecDate);

		// end - start returns difference in milliseconds 
		var diff = new Date(end - start);
		var days2 = diff/1000/60/60/24;
		$('#modalVerticalPOD input#U_ClientSubOverdue').val(days2 + 2);
		if((days2 + 2) > 0){
			$('#modalVerticalPOD input#U_ClientPenaltyCalc').val(parseFloat((days2 + 2) * 200))
		}
		

	})
	$(document.body).on('blur', '#modalVerticalPOD input#U_PercPenaltyCharge', function () 
	{

		U_PercPenaltyCharge = $('#modalVerticalPOD input#U_PercPenaltyCharge').val().replace(/,/g, '') / $('#modalVerticalPOD input#U_TotalSubPenalties').val().replace(/,/g, '');
		U_TotalSubPenalties = $('#modalVerticalPOD input#U_TotalSubPenalties').val().replace(/,/g, '') - (U_PercPenaltyCharge * $('#modalVerticalPOD input#U_TotalSubPenalties').val().replace(/,/g, ''))
		console.log(U_PercPenaltyCharge)
		console.log(U_TotalSubPenalties)
		$('#modalVerticalPOD input#U_TotalPenaltyWaived').val(FormatMoney(U_TotalSubPenalties)) 
		

	})
	// $(document.body).on('input', '#modalVerticalPOD input#U_PODStatusPayment', function () 
	// {

	 $('#modalVerticalPOD').on('shown.bs.modal',function()
	 {


			$.getJSON('../proc/views/vertical/vw_POD.php?pid=' + pid, function (data){
			
					
					let inputID = $(this).attr('id')
					$.each(data, function (key, val){
						console.log(key + "/" + val.U_TotalInitialTruckers)
						// if(inputID == val.inputID)
						// console.log(key + '/' + val.inputID)

						$('#modalVerticalPOD').find('#Code').val(val.Code);
						$('#modalVerticalPOD').find('#Name').val(val.Name);
						$('#modalVerticalPOD').find('#U_BookingDate').val(val.U_BookingDate);
						$('#modalVerticalPOD').find('#U_BookingNumber').val(val.U_BookingNumber);
						$('#modalVerticalPOD').find('#U_ClientName').val(val.U_ClientName);
						$('#modalVerticalPOD').find('#U_SAPClient').val(val.U_SAPClient);
						$('#modalVerticalPOD').find('#U_TruckerName').val(val.U_TruckerName);
						$('#modalVerticalPOD').find('#U_SAPTrucker').val(val.U_SAPTrucker);
						$('#modalVerticalPOD').find('#U_PlateNumber').val(val.U_PlateNumber);
						$('#modalVerticalPOD').find('#U_VehicleTypeCap').val(val.U_VehicleTypeCap);
						$('#modalVerticalPOD').find('#U_DeliveryOrigin').val(val.U_DeliveryOrigin);
						$('#modalVerticalPOD').find('#U_Destination').val(val.U_Destination);
						$('#modalVerticalPOD').find('#U_DeliveryStatus').val(val.U_DeliveryStatus);
						$('#modalVerticalPOD').find('#U_DeliveryDateDTR').val(val.U_DeliveryDateDTR);
						$('#modalVerticalPOD').find('#U_DeliveryDatePOD').val(val.U_DeliveryDatePOD);
						$('#modalVerticalPOD').find('#U_NoOfDrops').val(val.U_NoOfDrops);
						$('#modalVerticalPOD').find('#U_TripType').val(val.U_TripType);
						$('#modalVerticalPOD').find('#U_Remarks').val(val.U_Remarks);
						$('#modalVerticalPOD').find('#U_TripTicketNo').val(val.U_TripTicketNo);
						$('#modalVerticalPOD').find('#U_WaybillNo').val(val.U_WaybillNo);
						$('#modalVerticalPOD').find('#U_ShipmentNo').val(val.U_ShipmentNo);
						$('#modalVerticalPOD').find('#U_DeliveryReceiptNo').val(val.U_DeliveryReceiptNo);
						$('#modalVerticalPOD').find('#U_SeriesNo').val(val.U_SeriesNo);
						$('#modalVerticalPOD').find('#U_OtherPODDoc').val(val.U_OtherPODDoc);
						$('#modalVerticalPOD').find('#U_RemarksPOD').val(val.U_RemarksPOD);
						$('#modalVerticalPOD').find('#U_Receivedby').val(val.U_Receivedby);
						$('#modalVerticalPOD').find('#U_ClientReceivedDate').val(val.U_ClientReceivedDate);
						$('#modalVerticalPOD').find('#U_InitialHCRecDate').val(val.U_InitialHCRecDate);
						$('#modalVerticalPOD').find('#U_ActualHCRecDate').val(val.U_ActualHCRecDate);
						$('#modalVerticalPOD').find('#U_DateReturned').val(val.U_DateReturned);
						$('#modalVerticalPOD').find('#U_PODinCharge').val(val.U_PODinCharge);
						$('#modalVerticalPOD').find('#U_VerifiedDateHC').val(val.U_VerifiedDateHC);
						$('#modalVerticalPOD').find('#U_PODStatusDetail').val(val.U_PODStatusDetail);
						$('#modalVerticalPOD').find('#U_PTFNo').val(val.U_PTFNo);
						$('#modalVerticalPOD').find('#U_DateForwardedBT').val(val.U_DateForwardedBT);
						$('#modalVerticalPOD').find('#U_BillingDeadline').val(val.U_BillingDeadline);
						$('#modalVerticalPOD').find('#U_BillingStatus').val(val.U_BillingStatus);
						$('#modalVerticalPOD').find('#U_ServiceType').val(val.U_ServiceType);
						$('#modalVerticalPOD').find('#U_SINo').val(val.U_SINo);
						$('#modalVerticalPOD').find('#U_BillingTeam').val(val.U_BillingTeam);
						$('#modalVerticalPOD').find('#U_BTRemarks').val(val.U_BTRemarks);
						$('#modalVerticalPOD').find('#U_SOBNumber').val(val.U_SOBNumber);
						$('#modalVerticalPOD').find('#U_OutletNo').val(val.U_OutletNo);
						$('#modalVerticalPOD').find('#U_CBM').val(val.U_CBM);
						$('#modalVerticalPOD').find('#U_SI_DRNo').val(val.U_SI_DRNo);
						$('#modalVerticalPOD').find('#U_DeliveryMode').val(val.U_DeliveryMode);
						$('#modalVerticalPOD').find('#U_SourceWhse').val(val.U_SourceWhse);
						$('#modalVerticalPOD').find('#U_DestinationClient').val(val.U_DestinationClient);
						$('#modalVerticalPOD').find('#U_TotalInvAmount').val(val.U_TotalInvAmount);
						$('#modalVerticalPOD').find('#U_SONo').val(val.U_SONo);
						$('#modalVerticalPOD').find('#U_NameCustomer').val(val.U_NameCustomer);
						$('#modalVerticalPOD').find('#U_CategoryDR').val(val.U_CategoryDR);
						$('#modalVerticalPOD').find('#U_ForwardLoad').val(val.U_ForwardLoad);
						$('#modalVerticalPOD').find('#U_BackLoad').val(val.U_BackLoad);
						$('#modalVerticalPOD').find('#U_IDNumber').val(val.U_IDNumber);
						$('#modalVerticalPOD').find('#U_TypeOfAccessorial').val(val.U_TypeOfAccessorial);
						$('#modalVerticalPOD').find('#U_ApprovalStatus').val(val.U_ApprovalStatus);
						$('#modalVerticalPOD').find('#U_TimeInEmptyDem').val(val.U_TimeInEmptyDem);
						$('#modalVerticalPOD').find('#U_TimeOutEmptyDem').val(val.U_TimeOutEmptyDem);
						$('#modalVerticalPOD').find('#U_VerifiedEmptyDem').val(val.U_VerifiedEmptyDem);
						$('#modalVerticalPOD').find('#U_TimeInLoadedDem').val(val.U_TimeInLoadedDem);
						$('#modalVerticalPOD').find('#U_TimeOutLoadedDem').val(val.U_TimeOutLoadedDem);
						$('#modalVerticalPOD').find('#U_VerifiedLoadedDem').val(val.U_VerifiedLoadedDem);
						$('#modalVerticalPOD').find('#U_Remarks2').val(val.U_Remarks2);
						$('#modalVerticalPOD').find('#U_TimeInAdvLoading').val(val.U_TimeInAdvLoading);
						$('#modalVerticalPOD').find('#U_DayOfTheWeek').val(val.U_DayOfTheWeek);
						$('#modalVerticalPOD').find('#U_TimeIn').val(val.U_TimeIn);
						$('#modalVerticalPOD').find('#U_TimeOut').val(val.U_TimeOut);
						$('#modalVerticalPOD').find('#U_ODOIn').val(val.U_ODOIn);
						$('#modalVerticalPOD').find('#U_ODOOut').val(val.U_ODOOut);
						$('#modalVerticalPOD').find('#U_ClientSubStatus').val(val.U_ClientSubStatus);
						$('#modalVerticalPOD').find('#U_ClientSubOverdue').val(val.U_ClientSubOverdue);
						$('#modalVerticalPOD').find('#U_ClientPenaltyCalc').val(val.U_ClientPenaltyCalc);
						$('#modalVerticalPOD').find('#U_PODStatusPayment').val(val.U_PODStatusPayment);
						$('#modalVerticalPOD').find('#U_PODSubmitDeadline').val(val.U_PODSubmitDeadline);
						$('#modalVerticalPOD').find('#U_OverdueDays').val(val.U_OverdueDays);
						$('#modalVerticalPOD').find('#U_InteluckPenaltyCalc').val(val.U_InteluckPenaltyCalc);
						$('#modalVerticalPOD').find('#U_WaivedDays').val(val.U_WaivedDays);
						$('#modalVerticalPOD').find('#U_HolidayOrWeekend').val(val.U_HolidayOrWeekend);
						//$('#modalVerticalPOD').find('#U_LostPenaltyCalc').val(val.U_LostPenaltyCalc);
						$('#modalVerticalPOD').find('#U_TotalSubPenalties').val(val.U_TotalSubPenalties);
						$('#modalVerticalPOD').find('#U_Waived').val(val.U_Waived);
						$('#modalVerticalPOD').find('#U_PercPenaltyCharge').val(val.U_PercPenaltyCharge);
						$('#modalVerticalPOD').find('#U_Approvedby').val(val.U_Approvedby);
						$('#modalVerticalPOD').find('#U_TotalPenaltyWaived').val(val.U_TotalPenaltyWaived);
						$('#modalVerticalPOD').find('#U_DocNum').val(val.U_DocNum);
						$('#modalVerticalPOD').find('#U_UpdateDate').val(val.U_UpdateDate);
						$('#modalVerticalPOD').find('#U_CreateDate').val(val.U_CreateDate);
						$('#modalVerticalPOD').find('#U_Attachment').val(val.U_Attachment);
						$('#modalVerticalPOD').find('#U_Creator').val(val.U_Creator);
						$('#modalVerticalPOD').find('#U_TotalNoExceed').val(val.U_TotalNoExceed);
						$('#modalVerticalPOD').find('#U_TotalUsage').val(val.U_TotalUsage);

						PricingU_TotalInitialTruckers = val.U_TotalInitialTruckers

						
						if(val.U_PODStatusPayment == 'Ontime'){
							$('#modalVerticalPOD input#U_InteluckPenaltyCalc').val('0')
						}else if(val.U_PODStatusPayment == 'Late'){
							$('#modalVerticalPOD input#U_InteluckPenaltyCalc').val(pasreFloat($('#modalVerticalPOD input#U_OverdueDays').val()) * 200)
						}else if(val.U_PODStatusPayment == 'Lost'){
							console.log('LOST')
							$('#modalVerticalPOD input#U_InteluckPenaltyCalc').val('0')
							$('#modalVerticalPOD input#U_LostPenaltyCalc').val(FormatMoney(val.U_TotalInitialTruckers * 3))
							
						}
					

						U_TotalSubPenalties =  $('#modalVerticalPOD input#U_ClientPenaltyCalc').val() + $('#modalVerticalPOD input#U_InteluckPenaltyCalc').val() + $('#modalVerticalPOD input#U_LostPenaltyCalc').val()
					
						$('#modalVerticalPOD input#U_TotalSubPenalties').val(FormatMoney(U_TotalSubPenalties))


						U_TotalSubPenalties = $('#modalVerticalPOD input#U_TotalSubPenalties').val().replace(/,/g, '') - ($('#modalVerticalPOD input#U_PercPenaltyCharge').val().replace(/,/g, '') * $('#modalVerticalPOD input#U_TotalSubPenalties').val().replace(/,/g, ''))
						$('#modalVerticalPOD input#U_TotalPenaltyWaived').val(FormatMoney(U_TotalSubPenalties)) 

					});


			});




		


	})

//PRICING
$(document.body).on('blur', '#modalVerticalPRICING input#U_GrossClientRates', function () 
{
	console.log(ECVatGroup)
	let amount = $(this).val()

	$(this).val(FormatMoney(amount))
	if(ECVatGroup == 'OVAT-S' || ECVatGroup == 'OVAT-N'){
			$('#modalVerticalPRICING input#U_GrossClientRatesTax').val(FormatMoney(amount.replace(/,/g, '')))
	}else{
		$('#modalVerticalPRICING input#U_GrossClientRatesTax').val(FormatMoney(amount.replace(/,/g, '')/1.12))
	}

	let grossClientRate = $(this).val().replace(/,/g, '')
	let grossTruckerRate = $('#modalVerticalPRICING input#U_GrossTruckerRates').val().replace(/,/g, '')
	let U_GrossProfit =grossTruckerRate - grossClientRate
	computeTotalChargesClient()
computeGrossProfit()

	 
});

$(document.body).on('blur', '#modalVerticalPRICING input#U_GrossTruckerRates', function () 
{
	console.log(ECVatGroupS)
	let amount = $(this).val()


	$(this).val(FormatMoney(amount))
	if(ECVatGroupS == 'OVAT-S' ){
			$('#modalVerticalPRICING input#U_GrossTruckerRatesTax').val(FormatMoney(amount.replace(/,/g, '')))
	}else if( ECVatGroup == 'OVAT-N'){
		$('#modalVerticalPRICING input#U_GrossClientRatesTax').val(FormatMoney(amount.replace(/,/g, '')/1.12))
	}

	let grossClientRate = $('#modalVerticalPRICING input#U_GrossClientRates').val().replace(/,/g, '')
	let grossTruckerRate = $(this).val().replace(/,/g, '') 
	let U_GrossProfit =grossTruckerRate - grossClientRate
	computeTotalChargesTrucker()
computeGrossProfit()
});

$(document.body).on('blur', '#modalVerticalPRICING input#U_Demurrage', function () 
{
	console.log(ECVatGroup)
	let amount = $(this).val()
	computeTotalChargesClient()

	$(this).val(FormatMoney(amount.replace(/,/g, '')))
	if(ECVatGroup == 'OVAT-S' || ECVatGroup == 'OVAT-N'){
			$('#modalVerticalPRICING input#U_Demurrage4').val(FormatMoney(amount.replace(/,/g, '')))
	}else{
		$('#modalVerticalPRICING input#U_Demurrage4').val(FormatMoney(amount.replace(/,/g, '')/1.12))
	}

	

	 
});
$(document.body).on('blur', '#modalVerticalPRICING input#U_Demurrage2', function () 
{
	console.log(ECVatGroup)
	let amount = $(this).val()
	computeTotalChargesTrucker()

	$(this).val(FormatMoney(amount.replace(/,/g, '')))
	if(ECVatGroup == 'OVAT-S' || ECVatGroup == 'OVAT-N'){
			$('#modalVerticalPRICING input#U_Demurrage3').val(FormatMoney(amount.replace(/,/g, '')))
	}else{
		$('#modalVerticalPRICING input#U_Demurrage3').val(FormatMoney(amount.replace(/,/g, '')/1.12))
	}

	

	 
});
$(document.body).on('blur', '#modalVerticalPRICING input#U_AddtlDrop', function () 
{
	console.log(ECVatGroup)
	let amount = $(this).val()
	computeTotalChargesClient()

	$(this).val(FormatMoney(amount.replace(/,/g, '')))
	if(ECVatGroup == 'OVAT-S' || ECVatGroup == 'OVAT-N'){
			$('#modalVerticalPRICING input#U_AddtlCharges2').val(FormatMoney(amount.replace(/,/g, '')))
	}else{
		$('#modalVerticalPRICING input#U_AddtlCharges2').val(FormatMoney(amount.replace(/,/g, '')/1.12))
	}

	
	computeGrossProfit()
	 
});
$(document.body).on('blur', '#modalVerticalPRICING input#U_BoomTruck', function () 
{
	console.log(ECVatGroup)
	let amount = $(this).val()

	computeTotalChargesClient()
	$(this).val(FormatMoney(amount.replace(/,/g, '')))
	computeGrossProfit() 
});
$(document.body).on('blur', '#modalVerticalPRICING input#U_Manpower', function () 
{
	console.log(ECVatGroup)
	let amount = $(this).val()

	computeTotalChargesClient()
	$(this).val(FormatMoney(amount.replace(/,/g, '')))
	computeGrossProfit()
});
$(document.body).on('blur', '#modalVerticalPRICING input#U_Backload', function () 
{
	console.log(ECVatGroup)
	let amount = $(this).val()

	computeTotalChargesClient()
	$(this).val(FormatMoney(amount.replace(/,/g, '')))
	computeGrossProfit()
});



$(document.body).on('blur', '#modalVerticalPRICING input#U_AddtlDrop2', function () 
{
	console.log(ECVatGroup)
	let amount = $(this).val()

	$(this).val(FormatMoney(amount))
	if(ECVatGroup == 'OVAT-S' || ECVatGroup == 'OVAT-N'){
			$('#modalVerticalPRICING input#U_AddtlCharges').val(FormatMoney(amount.replace(/,/g, '')))
	}else{
		$('#modalVerticalPRICING input#U_AddtlCharges').val(FormatMoney(amount.replace(/,/g, '')/1.12))
	}

	computeGrossProfit()

	 
});
$(document.body).on('blur', '#modalVerticalPRICING input#U_BoomTruck2', function () 
{
	console.log(ECVatGroup)
	let amount = $(this).val()

	computeTotalChargesTrucker()
	$(this).val(FormatMoney(amount.replace(/,/g, '')))
	computeGrossProfit()
});
$(document.body).on('blur', '#modalVerticalPRICING input#U_Manpower2', function () 
{
	console.log(ECVatGroup)
	let amount = $(this).val()

	computeTotalChargesTrucker()
	$(this).val(FormatMoney(amount.replace(/,/g, '')))
	computeGrossProfit()
});
$(document.body).on('blur', '#modalVerticalPRICING input#U_Backload2', function () 
{
	console.log(ECVatGroup)
	let amount = $(this).val()

	computeTotalChargesTrucker()
	$(this).val(FormatMoney(amount.replace(/,/g, '')))
	computeGrossProfit()
});
	function FormatMoney(amount){
		let preAmount = accounting.formatMoney(amount, "", 2);
		
		
		return preAmount;
	}

	function computeTotalChargesClient(){
		
		let U_AddtlDrop = $('#modalVerticalPRICING input#U_AddtlDrop').val().replace(/,/g, '')
		let U_BoomTruck = $('#modalVerticalPRICING input#U_BoomTruck').val().replace(/,/g, '')
		let U_Manpower = $('#modalVerticalPRICING input#U_Manpower').val().replace(/,/g, '')
		let U_Backload = $('#modalVerticalPRICING input#U_Backload').val().replace(/,/g, '')

		let amount = parseFloat(U_AddtlDrop) +  parseFloat(U_BoomTruck) +  parseFloat(U_Manpower) +  parseFloat(U_Backload);
		

		$('#modalVerticalPRICING input#U_TotalAddtlCharges').val(FormatMoney(amount))
		computeGrossProfit()
		
	}  

	function computeTotalChargesTrucker(){
		
		let U_AddtlDrop = $('#modalVerticalPRICING input#U_AddtlDrop2').val().replace(/,/g, '')
		let U_BoomTruck = $('#modalVerticalPRICING input#U_BoomTruck2').val().replace(/,/g, '')
		let U_Manpower = $('#modalVerticalPRICING input#U_Manpower2').val().replace(/,/g, '')
		let U_Backload = $('#modalVerticalPRICING input#U_Backload2').val().replace(/,/g, '')

		let amount = parseFloat(U_AddtlDrop) +  parseFloat(U_BoomTruck) +  parseFloat(U_Manpower) +  parseFloat(U_Backload);
		

		$('#modalVerticalPRICING input#U_totalAddtlCharges2').val(FormatMoney(amount))
		computeGrossProfit()
		
	}  

	function computeGrossProfit(){
		
		let U_GrossClientRatesTax = $('#modalVerticalPRICING input#U_GrossClientRatesTax').val().replace(/,/g, '')
		let U_TotalAddtlCharge = $('#modalVerticalPRICING input#U_TotalAddtlCharges').val().replace(/,/g, '')
		let U_Demurrage4 = $('#modalVerticalPRICING input#U_Demurrage4').val().replace(/,/g, '')

		
		let U_GrossTruckerRatesTax = $('#modalVerticalPRICING input#U_GrossTruckerRatesTax').val().replace(/,/g, '')
		let U_totalAddtlCharges2 = $('#modalVerticalPRICING input#U_totalAddtlCharges2').val().replace(/,/g, '')
		let U_Demurrage3 = $('#modalVerticalPRICING input#U_Demurrage3').val().replace(/,/g, '')

		let ClientRates =  parseFloat(U_GrossClientRatesTax) + parseFloat(U_TotalAddtlCharge) +  parseFloat(U_Demurrage4)
		let TruckerRates =  parseFloat(U_GrossTruckerRatesTax) + parseFloat(U_totalAddtlCharges2) +  parseFloat(U_Demurrage3)
		
		let grossProfit = ClientRates - TruckerRates;
		let totalGrossProfit = ClientRates - TruckerRates;



		$('#modalVerticalPRICING input#U_GrossProfit').val(FormatMoney(grossProfit))
		$('#modalVerticalPRICING input#U_TotalInitialClient').val(FormatMoney(ClientRates))
		$('#modalVerticalPRICING input#U_TotalInitialTruckers').val(FormatMoney(TruckerRates))

		$('#modalVerticalPRICING input#U_TotalGrossProfit').val(FormatMoney(totalGrossProfit))

		
	}

		
	

});

