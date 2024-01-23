$(() => {

console.log('vertical working')

	let dateFormat = 'YYYY-MM-DD'
	
	
	let PricingU_TotalInitialTruckers = 0;
	let pid = '';
	let pid2 = '';
	let code = '';
	let ECVatGroup = '';
	let ECVatGroupS = '';
	let row = '';
	let taxType = ''; 
	let taxTypeT = ''; 

	let ptfArray = [];
	let apvArray = [];
	let sapAPArray = [];

	let oldPVRates = [];

	let ratesPerPV = [];

	let BNRate = [];
	let PVTruckerRate = [];
	let PVAddlChrgeRate = [];

	
	$(document.body).on('click', 'button[name="btnaddupdate"]', function () 
	{
		console.log('Tested')
		 ptfArray = [];
		 apvArray = [];
		 sapAPArray = [];

		 oldPVRates = [];

		 ratesPerPV = [];

		 BNRate = [];
		 PVTruckerRate = [];
		 PVAddlChrgeRate = [];
	});
	$(document.body).on('dblclick', '.detailsTable tbody > tr', function () 
	{
		enableButtons()
		row = $(this).find('td:eq(0)').text();
		pid = $(this).find('td:eq(5)').text();
		pid2 = $(this).find('td:eq(3)').text();
		tabId = $(".tab-pane:visible").attr("id")
		// console.log(pid)
		// console.log($('.detailsTable').attr('id'))
		// console.log($(".tab-pane:visible").attr("id"))
		// console.log(row)
		
		// podtabpane
		// billingtabpane
		// tptabpane
		// pricingtabpane

		if(tabId == 'podtabpane'){
			$('#modalVerticalPOD').modal('show')
			$('#modalVerticalPOD input#RowNoVertical').val(row)	
		}

		if(tabId == 'billingtabpane'){
			$('#modalVerticalBILLING').modal('show')
			$('#modalVerticalBILLING input#RowNoVertical').val(row)	
			$.ajax({

		        type: 'GET',
		        url: '../proc/views/vertical/vw_BILLING.php?pid=',
		        startTime: performance.now(),
				data:{
					pid: pid.trim()
				},
				success: function (data){

					var val = $.parseJSON(data);
					let inputID = $(this).attr('id')

						$('#modalVerticalBILLING').find('#Code').val(val.Code);
						$('#modalVerticalBILLING').find('#Name').val(val.Name);
						$('#modalVerticalBILLING').find('#U_BookingDate').val(val.U_BookingDate);
						$('#modalVerticalBILLING').find('#U_BookingId').val(val.U_BookingId);
						$('#modalVerticalBILLING').find('#U_CustomerName').val(val.U_CustomerName);
						$('#modalVerticalBILLING').find('#U_GroupProject').val(val.U_GroupProject);
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
						$('#modalVerticalBILLING').find('#U_ShipmentManifestNo').val(val.U_ShipmentManifestNo);
						$('#modalVerticalBILLING').find('#U_DeliveryReceiptNo').val(val.U_DeliveryReceiptNo);
						$('#modalVerticalBILLING').find('#U_SeriesNo').val(val.U_SeriesNo);
						$('#modalVerticalBILLING').find('#U_OtherPODDoc').val(val.U_OtherPODDoc);
						$('#modalVerticalBILLING').find('#U_RemarksPOD').val(val.U_RemarksPOD);
						$('#modalVerticalBILLING').find('#U_Receivedby').val(val.U_Receivedby);

						// alert(val.U_ClientReceivedDate.substring(0, 4))
						if(val.U_ClientReceivedDate.substring(0, 4) != '1900'){
							$('#modalVerticalBILLING').find('#U_ClientReceivedDate').val(val.U_ClientReceivedDate);
						
						}
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
						$('#modalVerticalBILLING').find('#U_Status').val(val.U_Status);
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
						$('#modalVerticalBILLING').find('#U_TripTicketNo').val(val.U_TripTicketNo);
						$('#modalVerticalBILLING').find('#U_AddCharges').val(val.U_AddCharges);
						$('#modalVerticalBILLING').find('#U_Demurrage').val(val.U_Demurrage);
						$('#modalVerticalBILLING').find('#U_GrossInitialRate').val(val.U_GrossInitialRate);
						$('#modalVerticalBILLING').find('#U_ActualBilledRate').val(val.U_ActualBilledRate);
						$('#modalVerticalBILLING').find('#U_RateAdjustments').val(val.U_RateAdjustments);
						$('#modalVerticalBILLING').find('#U_ActualDemurrage').val(val.U_ActualDemurrage);
						$('#modalVerticalBILLING').find('#U_ActualAddCharges').val(val.U_ActualAddCharges);
						$('#modalVerticalBILLING').find('#U_TotalRecClients').val(val.U_TotalRecClients);
						$('#modalVerticalBILLING').find('#U_TotalAR').val(val.U_TotalAR);


						$('#modalVerticalBILLING').find('#U_VarAR').val(FormatMoney(parseFloat(val.U_TotalAR.replace(/,/g, '')) - parseFloat(val.U_TotalRecClients.replace(/,/g, ''))) );

								

						// console.log(val.DisableTableRow)
						// console.log(val.DisableSomeFields)
							if(val.DisableTableRow == 'Y'){
							$('#modalVerticalBILLING input').attr('disabled',true)
							$('#modalVerticalBILLING select').attr('disabled',true)
							$('#modalVerticalBILLING textarea').attr('disabled',true)
						}else{
							$('#modalVerticalBILLING input#U_ActualBilledRate').attr('disabled',false)	
							$('#modalVerticalBILLING input#U_RateAdjustments').attr('disabled',false)	
							$('#modalVerticalBILLING input#U_ActualDemurrage').attr('disabled',false)	
							$('#modalVerticalBILLING input#U_ActualAddCharges').attr('disabled',false)	
							

 

						}
				

				
						
					// });

				}
			});
		}

		if(tabId == 'tptabpane'){
			$('#modalVerticalTP').modal('show')
			$('#modalVerticalTP input#RowNoVertical').val(row)	
			// alert(pid)
			
				$.ajax({

					type: 'GET',
					url: '../proc/views/vertical/vw_TP.php?pid=',
					startTime: performance.now(),
					data:{
						pid: pid.trim()
					},

					success: function (data){

					var val = $.parseJSON(data);
					let inputID = $(this).attr('id')
					// alert(1)
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
						$('#modalVerticalTP').find('#U_PVNo').val(val.U_PVNo);
						$('#modalVerticalTP').find('#U_TPincharge').val(val.U_TPincharge);
						$('#modalVerticalTP').find('#U_CAandDP').val(val.U_CAandDP);
						$('#modalVerticalTP').find('#U_Interest').val(val.U_Interest);
						$('#modalVerticalTP').find('#U_OtherDeductions').val(val.U_OtherDeductions);
						$('#modalVerticalTP').find('#U_TOTALDEDUCTIONS').val(val.U_TOTALDEDUCTIONS);
						$('#modalVerticalTP').find('#U_REMARKS1').val(val.U_REMARKS1);


						// $('#modalVerticalTP').find('#U_RateBasisPricing').val(val.U_RateBasisPricing);
						// $('#modalVerticalTP').find('#U_TaxTypePricing').val(val.U_TaxTypePricing);
						// $('#modalVerticalTP').find('#U_BoomTruckPricing').val(val.U_BoomTruckPricing);
						// $('#modalVerticalTP').find('#U_ManpowerPricing').val(val.U_ManpowerPricing);
						// $('#modalVerticalTP').find('#U_BackLoadPricing').val(val.U_BackLoadPricing);
						// $('#modalVerticalTP').find('#U_AddtlChargesPricing').val(val.U_AddtlChargesPricing);
						// $('#modalVerticalTP').find('#U_DemurrageN').val(val.U_DemurrageN);
						// $('#modalVerticalTP').find('#U_AddtlChargesN').val(val.U_AddtlChargesN);	
						// $('#modalVerticalTP').find('#U_Demurrage').val(val.U_Demurrage);
						// $('#modalVerticalTP').find('#U_AddtlDrop').val(val.U_AddtlDrop);
						// $('#modalVerticalTP').find('#U_TotalAP').val(val.U_TotalAP);



						// $('#modalVerticalTP').find('#U_VarTP').val(val.U_TotalAP.replace(/,/g, '') - val.U_TotalPayableRec.replace(/,/g, '') );


						$('#modalVerticalTP').find('#U_VarTP').val(FormatMoney(parseFloat(val.U_TotalAP.replace(/,/g, '')) - parseFloat(val.U_TotalPayable.replace(/,/g, ''))) );

						

						

						// computeTotalDeductionsTP()
						computeTotalPayableTP()
						
						// console.log(val.DisableTableRow)
							if(val.DisableTableRow == 'Y'){
							$('#modalVerticalTP input').attr('disabled',true)
							$('#modalVerticalTP select').attr('disabled',true)
							$('#modalVerticalTP textarea').attr('disabled',true)
						}

						// alert(val.U_TotalPenalty)
					// });
					}
				});
		}
		if(tabId == 'pricingtabpane'){
			$('#modalVerticalPRICING').modal('show')
			$('#modalVerticalPRICING input#RowNoVertical').val(row)	

			$.ajax({

		        type: 'GET',
		        url: '../proc/views/vertical/vw_PRICING.php?pid=',
		        startTime: performance.now(),
				data:{
					pid: pid2.trim()
				},
				success: function (data){
					// alert(data)
					console.log(data)

					var val = $.parseJSON(data);
					let inputID = $(this).attr('id')

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
					$('#modalVerticalPRICING').find('#U_VehicleTypeCap').val(val.U_VehicleTypeCap);
					$('#modalVerticalPRICING').find('#U_ISLAND').val(val.U_ISLAND);
					$('#modalVerticalPRICING').find('#U_ISLAND_D').val(val.U_ISLAND_D);
					$('#modalVerticalPRICING').find('#U_IFINTERISLAND').val(val.U_IFINTERISLAND);	

					$('#modalVerticalPRICING').find('#U_PODSONum').val(val.U_PODSONum);	
					$('#modalVerticalPRICING').find('#U_ARDocNum').val(val.U_ARDocNum);	
					$('#modalVerticalPRICING').find('#U_ActualBilledRate').val(val.U_ActualBilledRate);	
					$('#modalVerticalPRICING').find('#U_RateAdjustments').val(val.U_RateAdjustments);	

					computeTotalChargesClient()
					computeTotalChargesTrucker()
					computeGrossProfit()
					// console.log(computeTotalChargesClient)
					// console.log(computeTotalChargesTrucker)
					// console.log(computeGrossProfit)

					// console.log(val.DisableTableRow)
					if(val.DisableSomeFields != '' && val.DisableSomeFields2 != ''){
						$('#modalVerticalPRICING input').attr('disabled',true)
						$('#modalVerticalPRICING select').attr('disabled',true)
						$('#modalVerticalPRICING textarea').attr('disabled',true)
					}
					else if(val.DisableSomeFields != '' && val.DisableSomeFields2 == ''){
						$('#modalVerticalPRICING').find('#U_GrossClientRates').attr('disabled',true)
						$('#modalVerticalPRICING').find('#U_GrossClientRatesTax').attr('disabled',true)
						$('#modalVerticalPRICING').find('#U_RateBasis').attr('disabled',true)
						$('#modalVerticalPRICING').find('#U_Demurrage').attr('disabled',true)
						$('#modalVerticalPRICING').find('#U_AddtlDrop').attr('disabled',true)
						$('#modalVerticalPRICING').find('#U_BoomTruck').attr('disabled',true)
						$('#modalVerticalPRICING').find('#U_Manpower').attr('disabled',true)
						$('#modalVerticalPRICING').find('#U_Backload').attr('disabled',true)

					}else if(val.DisableSomeFields == '' && val.DisableSomeFields2 != ''){
						$('#modalVerticalPRICING').find('#U_GrossTruckerRates').attr('disabled',true)
						$('#modalVerticalPRICING').find('#U_GrossTruckerRatesTax').attr('disabled',true)
						$('#modalVerticalPRICING').find('#U_RateBasisT').attr('disabled',true)
						$('#modalVerticalPRICING').find('#U_Demurrage2').attr('disabled',true)
						$('#modalVerticalPRICING').find('#U_AddtlDrop2').attr('disabled',true)
						$('#modalVerticalPRICING').find('#U_BoomTruck2').attr('disabled',true)
						$('#modalVerticalPRICING').find('#U_Manpower2').attr('disabled',true)
						$('#modalVerticalPRICING').find('#U_Backload2').attr('disabled',true)
					}
				

				
						
					// });

				}
			});
		}

		


	  
	       
    });
	$(document.body).on('change', '#modalVerticalPOD select#U_DeliveryStatus', function () 
	{
		var U_DeliveryStatus = $(this).val();
			if(U_DeliveryStatus == 'Delivered' || U_DeliveryStatus == 'Irregular'){
				$('#modalVerticalPOD .editable').attr('disabled',false)
				$('#modalVerticalPOD select#U_PODStatusDetail').attr('disabled',false)
			}else if(U_DeliveryStatus == 'Cancelled'){
				$('#modalVerticalPOD input').attr('disabled',true)
				$('#modalVerticalPOD select:not(#U_DeliveryStatus)').attr('disabled',true)
				$('#modalVerticalPOD textarea').attr('disabled',true)
			}else{
				$('#modalVerticalPOD .editable').attr('disabled',false)
				$('#modalVerticalPOD select#U_PODStatusDetail').attr('disabled',true)
		
			}
	});
	$(document.body).on('change', '#modalVerticalPOD select#U_PODStatusDetail', function () 
	{
		var err2 = 0;
        var errmsg2 = '';
		
        console.log(pid)

		let U_VehicleTypeCap = $('#modalVerticalPOD select#U_VehicleTypeCap').val()
		let podstatus = $('#modalVerticalPOD select#U_PODStatusDetail').val()
		console.log(U_VehicleTypeCap)
		console.log(podstatus)
		if(U_VehicleTypeCap == ''){
			err2 = 1;
			$('#messageBar2').addClass('d-none');
			$('#messageBar3').removeClass('d-none');
			$('#messageBar').text('Input Required Fields').css({'background-color': 'red', 'color': 'white'});

			setTimeout(function()
			{
				$('#messageBar').text('').css({'background-color': '', 'color': ''});	
				$('#messageBar2').removeClass('d-none');
			},5000)
		}

		if(podstatus == 'Verified'){
			$('#modalVerticalPOD select.podstatusrequired, #modalVerticalPOD input.podstatusrequired').each(function (i) 
			{

				if($(this).val() == ''){
					err2 += 1;
					$('#messageBar2').addClass('d-none');
					$('#messageBar3').removeClass('d-none');
					$('#messageBar').text('Input Required Fields').css({'background-color': 'red', 'color': 'white'});

					setTimeout(function()
					{
					$('#messageBar').text('').css({'background-color': '', 'color': ''});	
					$('#messageBar2').removeClass('d-none');
					},5000)
				}
			});
		}	
		if(podstatus == 'OngoingVerification'){
			$('#modalVerticalPOD input.ongoingrequired').each(function (i) 
			{

				if($(this).val() == ''){
					err2 += 1;
					$('#messageBar2').addClass('d-none');
					$('#messageBar3').removeClass('d-none');
					$('#messageBar').text('Input Required Fields').css({'background-color': 'red', 'color': 'white'});

					setTimeout(function()
					{
					$('#messageBar').text('').css({'background-color': '', 'color': ''});	
					$('#messageBar2').removeClass('d-none');
					},5000)
					
				}
			});
		}	
		if(podstatus == 'OnholdbyPOD'){
			$('#modalVerticalPOD input.onholdrequired').each(function (i) 
			{

				if($(this).val() == ''){
					err2 += 1;
					$('#messageBar2').addClass('d-none');
					$('#messageBar3').removeClass('d-none');
					$('#messageBar').text('Input Required Fields').css({'background-color': 'red', 'color': 'white'});

					setTimeout(function()
					{
					$('#messageBar').text('').css({'background-color': '', 'color': ''});	
					$('#messageBar2').removeClass('d-none');
					},5000)
					
				}
			});
		}	
		if(podstatus == 'Returnedtotrucker'){
			$('#modalVerticalPOD input.returnrequired').each(function (i) 
			{

				if($(this).val() == ''){
					err2 += 1;
					$('#messageBar2').addClass('d-none');
					$('#messageBar3').removeClass('d-none');
					$('#messageBar').text('Input Required Fields').css({'background-color': 'red', 'color': 'white'});

					setTimeout(function()
					{
					$('#messageBar').text('').css({'background-color': '', 'color': ''});	
					$('#messageBar2').removeClass('d-none');
					},5000)
					
				}
			});
		}	
		if(podstatus == 'PendingHardcopy'){
			$('#modalVerticalPOD input.pendingrequired').each(function (i) 
			{

				if($(this).val() == ''){
					err2 += 1;
					$('#messageBar2').addClass('d-none');
					$('#messageBar3').removeClass('d-none');
					$('#messageBar').text('Input Required Fields').css({'background-color': 'red', 'color': 'white'});

					setTimeout(function()
					{
					$('#messageBar').text('').css({'background-color': '', 'color': ''});	
					$('#messageBar2').removeClass('d-none');
					},5000)
				}
			});
		}
	})

	$(document.body).on('click', '#btnUpdatePODRow', function () 
	{

		var err = 0;
        var errmsg = '';
		
        console.log(pid)

		let U_VehicleTypeCap = $('#modalVerticalPOD select#U_VehicleTypeCap').val()
		let podstatus = $('#modalVerticalPOD select#U_PODStatusDetail').val()
		console.log(U_VehicleTypeCap)
		console.log(podstatus)
		if(U_VehicleTypeCap == ''){
			err = 1;
			errmsg = 'Vehicle Type Required!';
		}

		if(podstatus == 'Verified'){
			$('#modalVerticalPOD select.podstatusrequired, #modalVerticalPOD input.podstatusrequired').each(function (i) 
			{

				if(podstatus == ''){
					err += 1;
					
				}
			});
		}	
		if(podstatus == 'OngoingVerification'){
			$('#modalVerticalPOD input.ongoingrequired').each(function (i) 
			{

				if(podstatus == ''){
					err += 1;
					
				}
			});
		}	
		if(podstatus == 'OnholdbyPOD'){
			$('#modalVerticalPOD input.onholdrequired').each(function (i) 
			{

				if(podstatus == ''){
					err += 1;
					
				}
			});
		}	
		if(podstatus == 'Returnedtotrucker'){
			$('#modalVerticalPOD input.returnrequired').each(function (i) 
			{

				if(podstatus == ''){
					err += 1;
					
				}
			});
		}	
		if(podstatus == 'PendingHardcopy'){
			$('#modalVerticalPOD input.pendingrequired').each(function (i) 
			{

				if(podstatus == ''){
					err += 1;
					
				}
			});
		}

			
			// if($(this).find("td:eq(3)").text() != ''){
			// 	itArrRowsPOD.push('"' + 'U_BookingDate' + '"' + ":" + '"' + validDate($(this).find("td:eq(3)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")) + '"')					
			// 	otArrPODNotNullCellsTotal += 1;
			// 	notNullCouterRows += 1;
			// }
		let otArrPOD = []; 
		let itArrPOD = [];
		//alert($('#modalVerticalPOD input#U_DeliveryOrigin').val())
		$('#modalVerticalPOD input:not(.podincharge,.amountNumber,.amount)').each(function (i) 
		{

			//if($(this).val() != ''){
				console.log($(this).val())
				itArrPOD.push('"' + $(this).attr('id') + '"' + ":" + '"' + $(this).val() + '"')	

				
			//}
		});
		$('#modalVerticalPOD input.amountNumber').each(function (i) 
		{

			//if($(this).val() != ''){
				console.log($(this).val())
				itArrPOD.push('"' + $(this).attr('id') + '"' + ":" +  $(this).val().replace(/,/g, '') )	

				
			//}
		});
		$('#modalVerticalPOD input.amount').each(function (i) 
		{

			//if($(this).val() != ''){
				console.log($(this).val())
				itArrPOD.push('"' + $(this).attr('id') + '"' + ":" +  '"' + $(this).val().replace(/,/g, '') + '"' )	
 
				
			//}
		});
		$('#modalVerticalPOD textarea').each(function (i) 
		{

			//if($(this).val() != ''){
				console.log($(this).val())
				itArrPOD.push('"' + $(this).attr('id') + '"' + ":" + '"' + $(this).val().replace(/(\r\n|\n|\r)/gm, " ") + '"')	

				
			//}
		});
		$('#modalVerticalPOD select').each(function (i) 
		{

			//if($(this).val() != ''){
				console.log($(this).val())
				itArrPOD.push('"' + $(this).attr('id') + '"' + ":" + '"' + $(this).val() + '"')	

				
			//}
		});
		otArrPOD.push('{' + itArrPOD.join(',') + '}');
		let otArrBILLING = [];
		let itArrBILLING = [];
		$('#modalVerticalPOD input.billing').each(function (i) 
		{

			if($(this).val() != ''){
				console.log($(this).val())
				itArrBILLING.push('"' + $(this).attr('id') + '"' + ":" + '"' + $(this).val() + '"')	

				
			}
		});
		$('#modalVerticalPOD select.billing').each(function (i) 
		{

			if($(this).val() != ''){
				console.log($(this).val())
				itArrBILLING.push('"' + $(this).attr('id') + '"' + ":" + '"' + $(this).val() + '"')	

				
			}
		});
		otArrBILLING.push('{' + itArrBILLING.join(',') + '}');
		let otArrTP = [];
		let itArrTP = [];
		$('#modalVerticalPOD input.tp').each(function (i) 
		{

			if($(this).val() != ''){
				console.log($(this).val())
				itArrTP.push('"' + $(this).attr('id') + '"' + ":" + '"' + $(this).val() + '"')	

				
			}
		});
		$('#modalVerticalPOD select.tp').each(function (i) 
		{

			if($(this).val() != ''){
				console.log($(this).val())
				itArrTP.push('"' + $(this).attr('id') + '"' + ":" + '"' + $(this).val() + '"')	

				
			}
		});
		otArrTP.push('{' + itArrTP.join(',') + '}');
		let otArrPRICING = []; 
		let itArrPRICING = [];
		//alert($('#modalVerticalPOD input#U_DeliveryOrigin').val())
		$('#modalVerticalPOD input.pricing').each(function (i) 
		{

			//if($(this).val() != ''){
				console.log($(this).val())
				itArrPRICING.push('"' + $(this).attr('id') + '"' + ":" + '"' + $(this).val() + '"')	

				
			//}
		});
		$('#modalVerticalPOD textarea.pricing').each(function (i) 
		{

			//if($(this).val() != ''){
				console.log($(this).val())
				itArrPRICING.push('"' + $(this).attr('id') + '"' + ":" + '"' + $(this).val() + '"')	

				
			//}
		});
		$('#modalVerticalPOD select.pricing').each(function (i) 
		{

			//if($(this).val() != ''){
				console.log($(this).val())
				itArrPRICING.push('"' + $(this).attr('id') + '"' + ":" + '"' + $(this).val() + '"')	

				
			//}
		});
		otArrPRICING.push('{' + itArrPRICING.join(',') + '}');

		// alert(pid)
		// console.log(err)
		if(err == 0){	

			// UPDATE FUNCTION BY ROVIC

			let bookingId = $('#U_BookingNumber').val()
			// ///////////////////////////////////////////////////////////////

			

					let podData = otArrPOD[0]

					ptfArrayForSeparateTable = [];


					let billingData = otArrBILLING[0]
					let tpData = otArrTP[0]
					let pricingData = otArrPRICING[0]
					console.log(podData)	
					console.log(billingData)	
					console.log(tpData)	
					console.log(pricingData)				
					if(otArrPOD.length != 0){
						$.ajax({

				        type: 'POST',
				        url: '../proc/exec/exec_update_pctpPODRow.php',
				        startTime: performance.now(),
						data:{
							pid: pid,
							podData: podData,
							billingData: billingData,
							tpData: tpData,
							pricingData: pricingData
							
						},
						success: function (data){
								console.log(data)	

								var res = $.parseJSON(data);
								// $('#btnfind').trigger('click');
								console.log(data.podData)
								ptfArrayForSeparateTable.push(pid2);
								console.log(res.result)
								if(res.valid == true)
								{

								// $('#modalVerticalPOD').modal('hide');
								$('#messageBar2').addClass('d-none');
								$('#messageBar3').removeClass('d-none');
								$('#messageBar').text(res.msg).css({'background-color': '#00FF7F', 'color': 'black'});
								
								
									setTimeout(function()
									{
										$('#messageBar').text('').css({'background-color': '', 'color': ''});	
										window.location.reload();
										//window.location.replace("../templates/delivery-document.php");
									},1000)



								p.actionAjax('refreshExtractTables', { bookingIds: ptfArrayForSeparateTable }).then(res => console.log('refreshExtractTables', res))

								}else{

								}
				        },
				        complete: function (data) {
							
							// p.actionAjax('refreshExtractTables', { caller: "console", bookingIds: ['I23302635TVU'] }).then(res =>console.log(res))

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
		let otArrBILLING = []; 


			
		let itArrBILLING = [];
		$('#modalVerticalBILLING select').each(function (i) 
		{

			if($(this).val() != ''){
				console.log($(this).val())
				itArrBILLING.push('"' + $(this).attr('id') + '"' + ":" + '"' + $(this).val() + '"')	

				
			}
		});
		$('#modalVerticalBILLING input.billingeditable').each(function (i) 
		{

			if($(this).val() != ''){
				console.log($(this).val())
				itArrBILLING.push('"' + $(this).attr('id') + '"' + ":" +  $(this).val().replace(/,/g, ''))	

				
			}
		});
		otArrBILLING.push('{' + itArrBILLING.join(',') + '}');

		
		if(err == 0){
			let billingData = otArrBILLING[0]
			ptfArrayForSeparateTable = [];
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
						ptfArrayForSeparateTable.push(pid2);
						var res = $.parseJSON(data);
						$('#btnfind').trigger('click');
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
							p.actionAjax('refreshExtractTables', { bookingIds: ptfArrayForSeparateTable }).then(res => console.log('refreshExtractTables', res))
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

		
		let otArrTP = []; 
			
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
		$('#modalVerticalTP input.editable.text, #modalVerticalTP input.editable.amount,  #modalVerticalTP textarea.editable').each(function (i) 
		{

			if($(this).val() != ''){
				console.log($(this).val())
				itArrTP.push('"' + $(this).attr('id') + '"' + ":" + '"' + $(this).val().replace(/,/g, '') + '"')	

				
			}
		});
		$('#modalVerticalTP input.editable.amountNumber').each(function (i) 
		{

			if($(this).val() != ''){
				console.log($(this).val())
				itArrTP.push('"' + $(this).attr('id') + '"' + ":" + $(this).val().replace(/,/g, ''))	

				
			}
		});
		otArrTP.push('{' + itArrTP.join(',') + '}');

		

		let tpData = otArrTP[0]
		ptfArrayForSeparateTable = [];
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
					ptfArrayForSeparateTable.push(pid2);
					var res = $.parseJSON(data);
					$('#btnfind').trigger('click');
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
						p.actionAjax('refreshExtractTables', { bookingIds: ptfArrayForSeparateTable }).then(res => console.log('refreshExtractTables', res))
					}else{

					}
	        },
	        complete: function (data) {
	        	
		    

					}
	 		});
		}else{
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
	$(document.body).on('click', '#btnUpdatePRICINGRow', function () 
	{


	let U_RateBasis = $('#modalVerticalPRICING').find('#U_RateBasis').val();
	let ratebasiserror = 0;
	if (U_RateBasis != ''){

		enableButtons()
		
	}else{
		ratebasiserror += 1;
			$('#messageBar2').addClass('d-none');
			$('#messageBar3').removeClass('d-none');
			$('#messageBar').text('Rate Basis is required').css({'background-color': 'red', 'color': 'white'});

			setTimeout(function()
			{
				$('#messageBar').text('').css({'background-color': '', 'color': ''});	
				$('#messageBar2').removeClass('d-none');
			},5000)
			
			
		}

	let U_RateBasisT = $('#modalVerticalPRICING').find('#U_RateBasisT').val();
	if (U_RateBasisT != ''){
		enableButtons()
	}
	else{

		ratebasiserror += 1;
			$('#messageBar2').addClass('d-none');
			$('#messageBar3').removeClass('d-none');
			$('#messageBar').text('Rate Basis is required').css({'background-color': 'red', 'color': 'white'});

			setTimeout(function()
			{
				$('#messageBar').text('').css({'background-color': '', 'color': ''});	
				$('#messageBar2').removeClass('d-none');
			},5000)

			
		
		}

		if(ratebasiserror == 0){


		// alert($('#U_GrossTruckerRatesTax').val())
		let otArrPRICING = [];

		let itArrPRICING = [];
		$('#modalVerticalPRICING select:not(.podonly)').each(function (i) 
		{

			if($(this).val() != ''){
				console.log($(this).val())
				itArrPRICING.push('"' + $(this).attr('id') + '"' + ":" + '"' + $(this).val() + '"')	

				
			}
		});
		$('#modalVerticalPRICING input.editable').each(function (i) 
		{
			if($(this).hasClass('amount') ){
				if($(this).val() != '' || $(this).val() == '.000000' ){
					console.log($(this).val())
					itArrPRICING.push('"' + $(this).attr('id') + '"' + ":" +  $(this).val().replace(/,/g, ''))	

					
					}
			}else{
				if($(this).val() != ''){
				console.log($(this).val())
				itArrPRICING.push('"' + $(this).attr('id') + '"' + ":" +  $(this).val().replace(/,/g, ''))	

				
				}	
			}

		});
		otArrPRICING.push('{' + itArrPRICING.join(',') + '}');

		
		// alert(pid)
		let pricingData = otArrPRICING[0]
		ptfArrayForSeparateTable = [];
		console.log(pricingData)		
		// alert(otArrPRICING.length)			
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
					ptfArrayForSeparateTable.push(pid2);
					var res = $.parseJSON(data);
					$('#btnfind').trigger('click');
					if(res.valid == true)
					{

					// $('#modalVerticalPRICING').modal('hide');
					$('#messageBar2').addClass('d-none');
					$('#messageBar3').removeClass('d-none');
					$('#messageBar').text(res.msg).css({'background-color': '#00FF7F', 'color': 'black'});
					
					
						setTimeout(function()
						{
							$('#messageBar').text('').css({'background-color': '', 'color': ''});	
							
							//window.location.replace("../templates/delivery-document.php");
						},3000)
						p.actionAjax('refreshExtractTables', { bookingIds: ptfArrayForSeparateTable }).then(res => console.log('refreshExtractTables', res))
					}else{

					}
	        },
	        complete: function (data) {
	        	
		    

					}
	 		});
		}else{
			$('#messageBar2').addClass('d-none');
			$('#messageBar3').removeClass('d-none');
			$('#messageBar').text(errmsg).css({'background-color': 'red', 'color': 'white'});
			
				setTimeout(function()
				{
					$('#messageBar').text('').css({'background-color': '', 'color': ''});	
					$('#messageBar2').removeClass('d-none');
				},5000)
		}
		}
					
	})

	$(document.body).on('dblclick', '#tblCustomer tbody > tr', function () 
	{
		
		let cardCode = $(this).children('td.item-1').text();
        let cardName = $(this).children('td.item-2').text();
        let ecvatgroup = $(this).children('td.item-3').text();
     	ECVatGroup = ecvatgroup

        $('#customerModal').modal('hide');
	

	
		$('#U_SAPClient').val(cardCode);
		$('#U_ClientName').val(cardName);
		

	});
	$(document.body).on('dblclick', '#tblVendor tbody > tr', function () 
	{
		
		let cardCode = $(this).children('td.item-1').text();
        let cardName = $(this).children('td.item-2').text();
     	let ecvatgroup = $(this).children('td.item-3').text();
     	ECVatGroupS = ecvatgroup

        $('#vendorModal').modal('hide');

	
		$('#U_SAPTrucker').val(cardCode);
		$('#U_TruckerName').val(cardName);
		

	});

	//----------------------------------------------------------------------------------------------------------------------------
	// POD FORMULA
	$(document.body).on('blur', '#modalVerticalPOD input#U_WaybillNo', function () 
	{	
		let value = $(this).val();
		let id = $(this).attr('id')

		if($(this).val() != 0){
			$.ajax({

		        type: 'GET',
		        url: '../proc/views/vertical/vw_uniqueWaybillandTripTicketNo.php',
				data:{
					id:id,
					value: value,
					pid: pid,
				},
				success: function (data){
					if(data > 0){
						$('#U_WaybillNo').focus()
						disableButtons()

						$('#messageBar2').addClass('d-none');
						$('#messageBar3').removeClass('d-none');
						$('#messageBar').text('Value already existing!').css({'background-color': 'red', 'color': 'white'});
						
							setTimeout(function()
							{
								$('#messageBar').text('').css({'background-color': '', 'color': ''});	
								
							},5000)
					}
					else{
						enableButtons()
					}
				}
			})

			
		}
		else{
			// alert(value)
		}
	});
	$(document.body).on('blur', '#modalVerticalPOD input#U_TripTicketNo', function () 
	{	
		let value = $(this).val();
		let id = $(this).attr('id')
		let myarray = ['0','n/a','']

		if(jQuery.inArray(value, myarray) === -1){
			$.ajax({

		        type: 'GET',
		        url: '../proc/views/vertical/vw_uniqueWaybillandTripTicketNo.php',
				data:{
					id:id,
					value: value,
					pid: pid,
				},
				success: function (data){
					if(data > 0){
						$('#U_TripTicketNo').focus()
						disableButtons()

						$('#messageBar2').addClass('d-none');
						$('#messageBar3').removeClass('d-none');
						$('#messageBar').text('Value already existing!').css({'background-color': 'red', 'color': 'white'});
						
							setTimeout(function()
							{
								$('#messageBar').text('').css({'background-color': '', 'color': ''});	
								
							},5000)
					}
					else{
						enableButtons()
					}
				}
			})

			
		}
		else{
			// alert(value)
		}
	});
	
	// $(document.body).on('blur', '#modalVerticalPOD input.general-required-date', function () 
	// {	
	// 	let date = new Date($(this).val())
	// 	if($(this).val() != ''){


	// 		if(date != 'Invalid Date'){
	// 			$('btnUpdatePODRow').attr('disabled',false)
	// 			$('btnUpdateBILLINGRow').attr('disabled',false)
	// 			$('btnUpdateTPRow').attr('disabled',false)
	// 			$('btnUpdatePRICINGRow').attr('disabled',false)
					
	// 		}else{
	// 			$(this).focus()
	// 			$('btnUpdatePODRow').attr('disabled',true)
	// 			$('btnUpdateBILLINGRow').attr('disabled',true)
	// 			$('btnUpdateTPRow').attr('disabled',true)
	// 			$('btnUpdatePRICINGRow').attr('disabled',true)
	// 			$('#messageBar2').addClass('d-none');
	// 			$('#messageBar3').removeClass('d-none');
	// 			$('#messageBar').text('Invalid Date').css({'background-color': 'red', 'color': 'white'});
				
	// 				setTimeout(function()
	// 				{
	// 					$('#messageBar').text('').css({'background-color': '', 'color': ''});	
						
	// 				},5000)
	// 		}
			
	// 	}else{
	// 		$(this).focus()
	// 			$('btnUpdatePODRow').attr('disabled',true)
	// 			$('btnUpdateBILLINGRow').attr('disabled',true)
	// 			$('btnUpdateTPRow').attr('disabled',true)
	// 			$('btnUpdatePRICINGRow').attr('disabled',true)
	// 			$('#messageBar2').addClass('d-none');
	// 			$('#messageBar3').removeClass('d-none');
	// 			$('#messageBar').text('Invalid Date').css({'background-color': 'red', 'color': 'white'});
				
	// 				setTimeout(function()
	// 				{
	// 					$('#messageBar').text('').css({'background-color': '', 'color': ''});	
						
	// 				},5000)
	// 	}
	// });
	// $(document.body).on('blur', '#modalVerticalPOD input.date', function () 
	// {	
	// 	let date = new Date($(this).val())
	// 	if($(this).val() != ''){


	// 		if(date != 'Invalid Date'){
	// 			$('btnUpdatePODRow').attr('disabled',false)
	// 			$('btnUpdateBILLINGRow').attr('disabled',false)
	// 			$('btnUpdateTPRow').attr('disabled',false)
	// 			$('btnUpdatePRICINGRow').attr('disabled',false)
					
	// 		}else{
	// 			$(this).focus()
	// 			$('btnUpdatePODRow').attr('disabled',true)
	// 			$('btnUpdateBILLINGRow').attr('disabled',true)
	// 			$('btnUpdateTPRow').attr('disabled',true)
	// 			$('btnUpdatePRICINGRow').attr('disabled',true)
	// 			$('#messageBar2').addClass('d-none');
	// 			$('#messageBar3').removeClass('d-none');
	// 			$('#messageBar').text('Invalid Date').css({'background-color': 'red', 'color': 'white'});
				
	// 				setTimeout(function()
	// 				{
	// 					$('#messageBar').text('').css({'background-color': '', 'color': ''});	
						
	// 				},5000)
	// 		}
			
	// 	}
	// });
	// $(document.body).on('blur', '#modalVerticalPOD input.delivereddate', function () 
	// {	

	// 	let bookingDate = new Date($('#modalVerticalPOD input#U_BookingDate').val())
	// 	let date = new Date($(this).val())
	// 	if($(this).val() != ''){


	// 		if(date != 'Invalid Date'){
	// 			if(date < bookingDate){
	// 				$(this).focus()
	// 				disableButtons()
	// 				$('#messageBar2').addClass('d-none');
	// 				$('#messageBar3').removeClass('d-none');
	// 				$('#messageBar').text('Date should not be earlier than Booking Date').css({'background-color': 'red', 'color': 'white'});
					
	// 					setTimeout(function()
	// 					{
	// 						$('#messageBar').text('').css({'background-color': '', 'color': ''});	
							
	// 					},5000)	
	// 			}else{
	// 				enableButtons();
	// 			}
	// 		}else{
	// 			$(this).focus()
	// 			disableButtons()
	// 			$('#messageBar2').addClass('d-none');
	// 			$('#messageBar3').removeClass('d-none');
	// 			$('#messageBar').text('Invalid Date').css({'background-color': 'red', 'color': 'white'});
				
	// 				setTimeout(function()
	// 				{
	// 					$('#messageBar').text('').css({'background-color': '', 'color': ''});	
						
	// 				},5000)
	// 		}
			
	// 	}
	// });
	// $(document.body).on('blur', '#modalVerticalPOD input.inteluckdate, #modalVerticalPOD input.notearlythandeldate', function () {
	// 	let deliveredDate = moment($('#modalVerticalPOD input#U_DeliveryDateDTR').val(), 'YYYY-MM-DD');
	// 	let deliveredDatePOD = moment($('#modalVerticalPOD input#U_DeliveryDatePOD').val(), 'YYYY-MM-DD');
	// 	let date = moment($(this).val(), 'YYYY-MM-DD');
	  
	// 	if ($(this).val() !== '') {
	// 	  if (date.isValid()) {
	// 		if (date.isBefore(deliveredDate) || date.isBefore(deliveredDatePOD)) {
	// 		  $(this).focus();
	// 		  disableButtons();
	// 		  $('#messageBar2').addClass('d-none');
	// 		  $('#messageBar3').removeClass('d-none');
	// 		  $('#messageBar').text('Date should not be earlier than Delivered Date').css({'background-color': 'red', 'color': 'white'});
	  
	// 		  setTimeout(function () {
	// 			$('#messageBar').text('').css({'background-color': '', 'color': ''});
	// 		  }, 5000);
	// 		} else {
	// 		  $('btnUpdatePODRow').attr('disabled', false);
	// 		  $('btnUpdateBILLINGRow').attr('disabled', false);
	// 		  $('btnUpdateTPRow').attr('disabled', false);
	// 		  $('btnUpdatePRICINGRow').attr('disabled', false);
	// 		}
	// 	  } else {
	// 		$(this).focus();
	// 		disableButtons();
	// 		$('#messageBar2').addClass('d-none');
	// 		$('#messageBar3').removeClass('d-none');
	// 		$('#messageBar').text('Invalid Date').css({'background-color': 'red', 'color': 'white'});
	  
	// 		setTimeout(function () {
	// 		  $('#messageBar').text('').css({'background-color': '', 'color': ''});
	// 		}, 5000);
	// 	  }
	// 	}
	//   });
	  

	

	$(document.body).on('change', '#modalVerticalPOD select#U_BillingStatus', function () 
	{
		const U_BillingStatus = $(this).val()
		const U_PTFNo = $('#modalVerticalPOD input#U_PTFNo').val()
		if(U_BillingStatus == 'SenttoBT'){
			if(U_PTFNo == ''){
				disableButtons()
				$('#messageBar2').addClass('d-none');
				$('#messageBar3').removeClass('d-none');
				$('#messageBar').text('PTF required!').css({'background-color': 'red', 'color': 'white'});
				
					setTimeout(function()
					{
						$('#messageBar').text('').css({'background-color': '', 'color': ''});	
						
					},5000)
			}else{
				enableButtons()
			}
		}else{
			enableButtons()
		}

	})

	// $(document.body).on('change', '#modalVerticalPOD input#U_ClientReceivedDate', function () 
	// {
	// 	console.log($(this).val())
	// 	if($(this).val() == ''){
	// 		$('#modalVerticalPOD input#U_ClientSubStatus').val('PENDING')
	// 	}else{
	// 		let date = new Date($(this).val())
	// 		if(date != 'Invalid Date'){
	// 			console.log(date)
	// 			$('#modalVerticalPOD input#U_ClientSubStatus').val('SUBMITTED')
	// 		}else{
				
	// 		}
			
	// 	}

	// 	$('#modalVerticalPOD input#U_DeliveryDateDTR').trigger('blur')
	// })
	// $(document.body).on('blur', '#modalVerticalPOD input#U_DeliveryDateDTR', function () 
	// {
	// 	let dtrDate =  new Date($('#modalVerticalPOD input#U_DeliveryDateDTR').val())
	// 	let clientRecDate = $('#modalVerticalPOD input#U_ClientReceivedDate').val();
	// 	let clientLeadTime = $('#modalVerticalPOD input#U_ClientLeadTime').val();
	// 	let waivedDays = $('#modalVerticalPOD input#U_WaivedDays').val();
	// 	let holidayorWeekend = $('#modalVerticalPOD input#U_HolidayOrWeekend').val();
	


	// 	var start = new Date($('#modalVerticalPOD input#U_DeliveryDateDTR').val());
	// 	var end = new Date(clientRecDate);
	// 	if(clientRecDate != ''){
	// 		start.setDate(start.getDate() + parseInt(clientLeadTime));
	// 		// end - start returns difference in milliseconds 
		
	// 		var diff = Math.floor((start - end) / (1000 * 60 * 60 * 24));

	// 		var newDays2 = diff + parseInt(waivedDays);
			

			
	// 		$('#modalVerticalPOD input#U_ClientSubOverdue').val(newDays2);
	// 		if(newDays2 < 0){
	// 			$('#modalVerticalPOD input#U_ClientPenaltyCalc').val(FormatMoney(parseFloat(newDays2 * 200)));
	// 		}
	// 		else{
	// 			$('#modalVerticalPOD input#U_ClientPenaltyCalc').val(FormatMoney(0));
			
	// 		}
	// 	}

		
		
		

	// })
	// $(document.body).on('blur', '#modalVerticalPOD input#U_VerifiedDateHC', function () 
	// {
	// 	if($(this).val() == ''){
	// 		$('#U_VERIFICATION_TAT').val('0');
	// 		$('#U_POD_TAT').val('0');
	// 	}else{
	// 		var start = new Date($('#modalVerticalPOD input#U_ActualHCRecDate').val());
	// 		var end = new Date($(this).val());
			
	// 			var diff = new Date(end - start);
				
	// 			var days2 = diff/1000/60/60/24;
	// 			console.log(days2)

	// 			if (!isNaN(days2)) {
	// 			    $('#U_VERIFICATION_TAT').val(days2);
	// 			  }
				

	// 		var start2 = new Date($('#modalVerticalPOD input#U_DeliveryDateDTR').val());
	// 		var end2 = new Date($(this).val());
			
	// 			var diff2 = new Date(end2 - start2);
				
	// 			var days3 = diff2/1000/60/60/24;
	// 			console.log(days3)
				
	// 			if (!isNaN(days2)) {
	// 			   $('#U_POD_TAT').val(days3);
	// 			  }
	// 	}

	// })
	
	// $(document.body).on('blur', '#modalVerticalPOD input.time', function () 
	// {
	// 	let id = $(this).attr('id');
	// 	let value = $(this).val();
	// 	let hours = $(this).val().substring(0,2)
	// 	let minutes = $(this).val().substring(3,5)
	// 	let separator = $(this).val().substring(3,2)
	// 	if(value != ''){
	// 		checkTimeFormat(id,value,hours,minutes,separator)
	// 	}
		


	// })
	$(document.body).on('blur', '#modalVerticalPOD input#U_PercPenaltyCharge', function () 
	{

		U_PercPenaltyCharge = $('#modalVerticalPOD input#U_PercPenaltyCharge').val().replace(/,/g, '');
		U_TotalSubPenalties = $('#modalVerticalPOD input#U_TotalSubPenalties').val().replace(/,/g, '') - (U_PercPenaltyCharge * $('#modalVerticalPOD input#U_TotalSubPenalties').val().replace(/,/g, ''))
		console.log(U_PercPenaltyCharge)
		console.log(U_TotalSubPenalties)
		$('#modalVerticalPOD input#U_TotalPenaltyWaived').val(FormatMoney(U_TotalSubPenalties)) 
		

	})
	$(document.body).on('blur', '#modalVerticalPOD input#U_ActualHCRecDate', function () 
	{

		computeOverdueDays();
		$('#modalVerticalPOD input#U_DeliveryDateDTR').trigger('blur')

		computeTotalSubPenaltiesPOD();

	})
	// $(document.body).on('blur', '#modalVerticalPOD input#', function () 
	// {

	// 	computeOverdueDays();
	// 	$('#modalVerticalPOD input#U_DeliveryDateDTR').trigger('blur')
	// 	computeTotalSubPenaltiesPOD();

	// })
	$(document.body).on('blur', '#modalVerticalPOD input#U_WaivedDays', function () 
	{

		computeOverdueDays();
		$('#modalVerticalPOD input#U_DeliveryDateDTR').trigger('blur')


		computeTotalSubPenaltiesPOD();

	})
	$(document.body).on('blur', '#modalVerticalPOD input#U_HolidayOrWeekend', function () 
	{

		computeOverdueDays();
		$('#modalVerticalPOD input#U_DeliveryDateDTR').trigger('blur')


		computeTotalSubPenaltiesPOD();

	})

// 	if 'initial inteluck received date' is blank, then ('POD Submit Deadline' minus 'todays date') plus 'Waived Days (Late POD Response)' plus 'Holiday or Weekend'

// if 'initial inteluck received date' is NOT blank, then ('POD Submit deadline' minus 'initial inteluck received date') plus 'Waived Days (Late POD Response)' plus 'Holiday or Weekend'



	 $('#modalVerticalPOD').on('shown.bs.modal',function()
	 {


	 	enableButtons()
	 	console.log(pid)

	 		$.ajax({

		        type: 'GET',
		        url: '../proc/views/vertical/vw_POD.php',
		        startTime: performance.now(),
				data:{
					pid: pid.trim()
				},
				success: function (data){

					// alert(data)
					console.log(data)

					var val = $.parseJSON(data);
					console.log(val.Code)
					let inputID = $(this).attr('id')
					console.log(val.U_PODStatusDetail)
					console.log(val.U_TotalSubPenalties)
						if(val.U_PODStatusDetail == 'Verified' && val.U_PTFNo == ''){		
								console.log(1)

										$('#modalVerticalPOD input:not(.verifiededitable)').attr('disabled',true)
										$('#modalVerticalPOD select:not(.verifiededitable)').attr('disabled',true)
										$('#modalVerticalPOD textarea:not(.verifiededitable)').attr('disabled',true)

						}else if(val.U_PODStatusDetail == 'Verified' && val.U_PTFNo != ''){
								console.log(2)
										$('#modalVerticalPOD input:not(.verifiededitable)').attr('disabled',true)
										$('#modalVerticalPOD select:not(.verifiededitable)').attr('disabled',true)
										$('#modalVerticalPOD textarea:not(.verifiededitable)').attr('disabled',true)
										$('#modalVerticalPOD select#U_BillingStatus').attr('disabled',false);
						}	
						else{
								console.log(3)
								$('#modalVerticalPOD input:not(.verifiededitable)').attr('disabled',false);
								$('#modalVerticalPOD select:not(.verifiededitable)').attr('disabled',false);
								$('#modalVerticalPOD textarea:not(.verifiededitable)').attr('disabled',false);
								$('#modalVerticalPOD input, #modalVerticalPOD select, #modalVerticalPOD textarea').attr('disabled',false)
								$('#modalVerticalPOD select#U_PODStatusDetail').attr('disabled',false);
								$('#modalVerticalPOD select#U_PODStatusDetail').attr('readonly',false);
					
						}

						
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


						
						if(val.U_ClientReceivedDate.substring(0, 8) != '1900'){
							$('#modalVerticalPOD').find('#U_ClientReceivedDate').val(val.U_ClientReceivedDate);
							
						}if(val.U_ActualHCRecDate.substring(0, 8) != '1900'){
							$('#modalVerticalPOD').find('#U_ActualHCRecDate').val(val.U_ActualHCRecDate);
							
						}if(val.U_InitialHCRecDate.substring(0, 8) != '1900'){
							$('#modalVerticalPOD').find('#U_InitialHCRecDate').val(val.U_InitialHCRecDate);
							
						}if(val.U_ActualDateRec_Intitial.substring(0, 8) != '1900'){
							$('#modalVerticalPOD').find('#U_ActualDateRec_Intitial').val(val.U_ActualDateRec_Intitial);
							
						}if(val.U_DateReturned.substring(0, 8) != '1900'){
							$('#modalVerticalPOD').find('#U_DateReturned').val(val.U_DateReturned);
							
						}if(val.U_VerifiedDateHC.substring(0, 8) != '1900'){
							$('#modalVerticalPOD').find('#U_VerifiedDateHC').val(val.U_VerifiedDateHC);
							
						}if(val.U_DateForwardedBT.substring(0, 8) != '1900'){
							$('#modalVerticalPOD').find('#U_DateForwardedBT').val(val.U_DateForwardedBT);
							
						}if(val.U_BillingDeadline.substring(0, 8) != '1900'){
							$('#modalVerticalPOD').find('#U_BillingDeadline').val(val.U_BillingDeadline);
							
						}
						// $('#modalVerticalPOD').find('#U_ClientReceivedDate').val(val.U_ClientReceivedDate);
						// $('#modalVerticalPOD').find('#U_InitialHCRecDate').val(val.U_InitialHCRecDate);
						// $('#modalVerticalPOD').find('#U_ActualHCRecDate').val(val.U_ActualHCRecDate);
						// $('#modalVerticalPOD').find('#U_DateReturned').val(val.U_DateReturned);
						$('#modalVerticalPOD').find('#U_PODinCharge').val(val.U_PODinCharge);
						// $('#modalVerticalPOD').find('#U_VerifiedDateHC').val(val.U_VerifiedDateHC);
						$('#modalVerticalPOD').find('#U_PODStatusDetail').val(val.U_PODStatusDetail);
						$('#modalVerticalPOD').find('#U_PTFNo').val(val.U_PTFNo);
						// $('#modalVerticalPOD').find('#U_DateForwardedBT').val(val.U_DateForwardedBT);
						// $('#modalVerticalPOD').find('#U_BillingDeadline').val(val.U_BillingDeadline);
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
						$('#modalVerticalPOD').find('#U_OverdueDays').val(parseFloat(val.U_OverdueDays) + parseFloat(val.U_WaivedDays)+ parseFloat(val.U_HolidayOrWeekend));
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
						$('#modalVerticalPOD').find('#U_ClientLeadTime').val(val.U_ClientLeadTime);
						$('#modalVerticalPOD').find('#U_PenaltiesManual').val(val.U_PenaltiesManual);

						$('#modalVerticalPOD').find('#U_ISLAND').val(val.U_ISLAND);
						$('#modalVerticalPOD').find('#U_ISLAND_D').val(val.U_ISLAND_D);
						$('#modalVerticalPOD').find('#U_IFINTERISLAND').val(val.U_IFINTERISLAND);

						$('#modalVerticalPOD').find('#U_VERIFICATION_TAT').val(val.U_VERIFICATION_TAT);
						$('#modalVerticalPOD').find('#U_POD_TAT').val(val.U_POD_TAT);
						$('#modalVerticalPOD').find('#U_ActualDateRec_Intitial').val(val.U_ActualDateRec_Intitial);

						$('#modalVerticalPOD').find('#U_ServiceType').val(val.U_ServiceType);
						$('#modalVerticalPOD').find('#U_SINo').val(val.U_SINo);
						

						console.log(val.U_ISLAND)
						console.log(val.U_DocNum +'Docnum')

						



						PricingU_TotalInitialTruckers = val.U_TotalInitialTruckers
						console.log(val.U_ClientPenaltyCalc)
						console.log(val.U_TotalPenaltyWaived)
						console.log(val.U_InteluckPenaltyCalc)
						console.log(val.U_TotalInitialTruckers)
						console.log('TESTING '+ val.U_PODStatusPayment)
						if(val.U_PODStatusPayment == 'Ontime'){
							$('#modalVerticalPOD input#U_InteluckPenaltyCalc').val(FormatMoney(val.U_InteluckPenaltyCalc))
							$('#modalVerticalPOD input#U_LostPenaltyCalc').val(FormatMoney(val.U_LostPenaltyCalc))
						}else if(val.U_PODStatusPayment == 'Late'){
							console.log('10101')
							$('#modalVerticalPOD input#U_InteluckPenaltyCalc').val(FormatMoney(val.U_InteluckPenaltyCalc))
							$('#modalVerticalPOD input#U_LostPenaltyCalc').val('0.00')
						}else if(val.U_PODStatusPayment == 'Lost'){
							console.log('LOST')
							$('#modalVerticalPOD input#U_InteluckPenaltyCalc').val('0.00')
							$('#modalVerticalPOD input#U_LostPenaltyCalc').val(FormatMoney(val.U_LostPenaltyCalc))
							
						}
						console.log(val.U_DeliveryStatus)
						if(val.U_DeliveryStatus == 'Delivered' || val.U_DeliveryStatus == 'Irregular'){
							$('#modalVerticalPOD select#U_PODStatusDetail').attr('disabled',false)
						}else if(val.U_DeliveryStatus == 'Cancelled'){
							$('#modalVerticalPOD input').attr('disabled',true)
							$('#modalVerticalPOD select:not(#U_DeliveryStatus)').attr('disabled',true)
							$('#modalVerticalPOD textarea').attr('disabled',true)
						}else{
							$('#modalVerticalPOD select#U_PODStatusDetail').attr('disabled',true)
					
						}
						console.log(val.U_PenaltiesManual) 
						console.log(val.U_InteluckPenaltyCalc)
						console.log(val.U_LostPenaltyCalc)
						console.log(val.U_ClientPenaltyCalc)

						console.log(parseFloat(val.U_PenaltiesManual) 
													+ parseFloat(val.U_InteluckPenaltyCalc) 
													+ parseFloat(val.U_LostPenaltyCalc) 
													+ parseFloat(val.U_ClientPenaltyCalc))

						$('#modalVerticalPOD').find('#U_TotalSubPenalties').val(parseFloat(val.U_PenaltiesManual) 
													+ parseFloat(val.U_InteluckPenaltyCalc) 
													+ parseFloat(val.U_LostPenaltyCalc) 
													+ parseFloat(val.U_ClientPenaltyCalc))						
									
						$('#modalVerticalPOD input#U_WaivedDays').trigger('blur')
						$('#modalVerticalPOD input#U_HolidayOrWeekend').trigger('blur')
						$('#modalVerticalPOD input#U_VerifiedDateHC').trigger('blur')

						

		$('#modalVerticalPOD select#U_PODStatusDetail').attr('disabled',false);
		$('#modalVerticalPOD select#U_PODStatusDetail').attr('readonly',false);


		if(val.DisableTableRow == 'Y'){
							$('#modalVerticalPOD input').attr('disabled',true)
							$('#modalVerticalPOD select').attr('disabled',true)
							$('#modalVerticalPOD textarea').attr('disabled',true)
						}
				}

				
			})


			// $.getJSON('../proc/views/vertical/vw_POD.php?pid=' + pid, function (data){
			


			// })






	})

$(document.body).on('blur', '#modalVerticalPOD input#U_PenaltiesManual', function () 
{
	let amount = $(this).val()
	$(this).val(FormatMoney(amount))
	computeTotalSubPenaltiesPOD()


})
function computeTotalSubPenaltiesPOD(){
	 U_TotalSubPenalties =    parseFloat($('#modalVerticalPOD input#U_PenaltiesManual').val().replace(/,/g, '')) + parseFloat($('#modalVerticalPOD input#U_ClientPenaltyCalc').val().replace(/,/g, '')) + parseFloat($('#modalVerticalPOD input#U_InteluckPenaltyCalc').val().replace(/,/g, '')) + parseFloat($('#modalVerticalPOD input#U_LostPenaltyCalc').val().replace(/,/g, ''))
	console.log(U_TotalSubPenalties)
	// alert(U_TotalSubPenalties)
	$('#modalVerticalPOD input#U_TotalSubPenalties').val(FormatMoney(U_TotalSubPenalties))


     U_TotalSubPenalties = $('#modalVerticalPOD input#U_TotalSubPenalties').val().replace(/,/g, '') - ($('#modalVerticalPOD input#U_PercPenaltyCharge').val().replace(/,/g, '') * $('#modalVerticalPOD input#U_TotalSubPenalties').val().replace(/,/g, ''))
	$('#modalVerticalPOD input#U_TotalPenaltyWaived').val(FormatMoney(U_TotalSubPenalties)) 
	computeOverdueDays();
	$('#modalVerticalPOD input#U_DeliveryDateDTR').trigger('blur')

}
//PRICING
$(document.body).on('blur', '#modalVerticalPRICING input#U_GrossClientRates', function () 
{
	console.log(ECVatGroup)
	let amount = $(this).val()
	
	let taxType = $('#modalVerticalPRICING').find('#U_TaxType').val();
	console.log('STOP')
		
		$(this).val(FormatMoney(amount))
		if(taxType != 'NONVAT' ){
				$('#modalVerticalPRICING input#U_GrossClientRatesTax').val(FormatMoney(amount.replace(/,/g, '')))
				console.log(FormatMoney(amount.replace(/,/g, '')))
		}else{
			$('#modalVerticalPRICING input#U_GrossClientRatesTax').val(FormatMoney(amount.replace(/,/g, '')/1.12))
			console.log(FormatMoney(amount.replace(/,/g, '')/1.12))
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
	
	let taxTypeT = $('#modalVerticalPRICING').find('#U_TaxTypeT').val();
	console.log('STOP')

	
		$(this).val(FormatMoney(amount))
		if(taxTypeT != 'NONVAT' ){
			$('#modalVerticalPRICING input#U_GrossTruckerRatesTax').val(FormatMoney(amount.replace(/,/g, '')))
		}else{
			$('#modalVerticalPRICING input#U_GrossTruckerRatesTax').val(FormatMoney(amount.replace(/,/g, '')/1.12))
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
	let taxType = $('#modalVerticalPRICING').find('#U_TaxType').val();
	console.log('STOP')
	$(this).val(FormatMoney(amount.replace(/,/g, '')))
	if(taxType != 'NONVAT' ){
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

	let taxTypeT = $('#modalVerticalPRICING').find('#U_TaxTypeT').val();
	console.log('STOP')
	$(this).val(FormatMoney(amount.replace(/,/g, '')))
	if(taxTypeT != 'NONVAT' ){
			$('#modalVerticalPRICING input#U_Demurrage3').val(FormatMoney(amount.replace(/,/g, '')))
	}else{
		$('#modalVerticalPRICING input#U_Demurrage3').val(FormatMoney(amount.replace(/,/g, '')/1.12))
	}

	

	 
});
$(document.body).on('blur', '#modalVerticalPRICING input#U_AddtlDrop', function () 
{
	console.log(ECVatGroup)
	let amount = $(this).val()
	

	computeTotalChargesClient();
	$(this).val(FormatMoney(amount.replace(/,/g, '')))
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
	

	computeTotalChargesTrucker();
	$(this).val(FormatMoney(amount.replace(/,/g, '')))
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

		let taxType = $('#modalVerticalPRICING').find('#U_TaxType').val();
	
		if(taxType != 'NONVAT' ){
				$('#modalVerticalPRICING input#U_AddtlCharges2').val(FormatMoney(amount))
		}else{
			$('#modalVerticalPRICING input#U_AddtlCharges2').val(FormatMoney(amount/1.12))
		}

	


		computeGrossProfit()
		
	}  

	function computeTotalChargesTrucker(){
		
		let U_AddtlDrop = $('#modalVerticalPRICING input#U_AddtlDrop2').val().replace(/,/g, '')
		let U_BoomTruck = $('#modalVerticalPRICING input#U_BoomTruck2').val().replace(/,/g, '')
		let U_Manpower = $('#modalVerticalPRICING input#U_Manpower2').val().replace(/,/g, '')
		let U_Backload = $('#modalVerticalPRICING input#U_Backload2').val().replace(/,/g, '')

		let amount = parseFloat(U_AddtlDrop) +  parseFloat(U_BoomTruck) +  parseFloat(U_Manpower) +  parseFloat(U_Backload);
		

		$('#modalVerticalPRICING input#U_totalAddtlCharges2').val(FormatMoney(amount))

		let taxTypeT = $('#modalVerticalPRICING').find('#U_TaxTypeT').val();
		if(taxTypeT != 'NONVAT' ){
				$('#modalVerticalPRICING input#U_AddtlCharges').val(FormatMoney(amount))
		}else{
			$('#modalVerticalPRICING input#U_AddtlCharges').val(FormatMoney(amount/1.12))
		}

			computeGrossProfit()
			
		}  

	function computeGrossProfit(){
		
		// Client
		let U_GrossClientRates = $('#modalVerticalPRICING input#U_GrossClientRates').val().replace(/,/g, '')
		let U_GrossClientRatesTax = $('#modalVerticalPRICING input#U_GrossClientRatesTax').val().replace(/,/g, '')
		let U_TotalAddtlCharge = $('#modalVerticalPRICING input#U_TotalAddtlCharges').val().replace(/,/g, '')
		let U_Demurrage4 = $('#modalVerticalPRICING input#U_Demurrage4').val().replace(/,/g, '')
		let U_AddtlCharges2 = $('#modalVerticalPRICING input#U_AddtlCharges2').val().replace(/,/g, '')

		// Trucker
		let U_GrossTruckerRates = $('#modalVerticalPRICING input#U_GrossTruckerRates').val().replace(/,/g, '')
		let U_GrossTruckerRatesTax = $('#modalVerticalPRICING input#U_GrossTruckerRatesTax').val().replace(/,/g, '')
		let U_totalAddtlCharges2 = $('#modalVerticalPRICING input#U_totalAddtlCharges2').val().replace(/,/g, '')
		let U_Demurrage3 = $('#modalVerticalPRICING input#U_Demurrage3').val().replace(/,/g, '')
		let U_AddtlCharges = $('#modalVerticalPRICING input#U_AddtlCharges').val().replace(/,/g, '')
		


		let ClientRates =  parseFloat(U_GrossClientRates) + parseFloat(U_TotalAddtlCharge) +  parseFloat(U_Demurrage4)
		let TruckerRates =  parseFloat(U_GrossTruckerRates) + parseFloat(U_totalAddtlCharges2) +  parseFloat(U_Demurrage3)
		let ClientRatesTax =  parseFloat(U_GrossClientRatesTax) + parseFloat(U_TotalAddtlCharge) + parseFloat(U_Demurrage4)
		let TruckerRatesTax =  parseFloat(U_GrossTruckerRatesTax) + parseFloat(U_AddtlCharges) +  parseFloat(U_Demurrage3)
		// console.log(U_GrossTruckerRates)
		// console.log(U_AddtlCharges)
		// console.log(U_Demurrage3)
		let grossProfit = ClientRates - TruckerRates;
		let grossProfitNet = ClientRatesTax - TruckerRatesTax;
		let totalGrossProfit = ClientRatesTax = TruckerRatesTax;
		let grossProfitWithoutOther = parseFloat(U_GrossClientRatesTax) - parseFloat(U_GrossTruckerRatesTax)
		let U_GrossProfit = (parseFloat(U_Demurrage4) + parseFloat(U_AddtlCharges2)) - (parseFloat(U_Demurrage3) + parseFloat(U_AddtlCharges))
		
		let U_GrossProfitPositive = (U_GrossProfit >= 0) ? U_GrossProfit : U_GrossProfit * -1;
		let totalGrossProfitPositive = (totalGrossProfit >= 0) ? totalGrossProfit : totalGrossProfit * -1;

		$('#modalVerticalPRICING input#U_GrossProfitNet').val(FormatMoney(grossProfitWithoutOther))
		$('#modalVerticalPRICING input#U_GrossProfit').val(FormatMoney(U_GrossProfit))
		$('#modalVerticalPRICING input#U_TotalInitialClient').val(FormatMoney(parseFloat(U_GrossClientRatesTax) + parseFloat(U_TotalAddtlCharge) + parseFloat(U_Demurrage4)))
		$('#modalVerticalPRICING input#U_TotalInitialTruckers').val(FormatMoney( parseFloat(U_GrossTruckerRatesTax) + parseFloat(U_AddtlCharges) +  parseFloat(U_Demurrage3)))

		$('#modalVerticalPRICING input#U_TotalGrossProfit').val(FormatMoney((parseFloat(U_GrossClientRatesTax) + parseFloat(U_TotalAddtlCharge) + parseFloat(U_Demurrage4)) - (parseFloat(U_GrossTruckerRatesTax) + parseFloat(U_AddtlCharges) +  parseFloat(U_Demurrage3))))

		
	}
	// 	if 'initial inteluck received date' is blank, 
	// then ('POD Submit Deadline' minus 'todays date') 
	// plus 'Waived Days (Late POD Response)' plus 'Holiday or Weekend'

	// if 'initial inteluck received date' is NOT blank, 
	// then ('POD Submit deadline' minus 'initial inteluck received date') 
	// plus 'Waived Days (Late POD Response)' plus 'Holiday or Weekend'

	function computeOverdueDays(){
		let U_ActualHCRecDate = $('#modalVerticalPOD input#U_ActualHCRecDate').val();
		let U_PODSubmitDeadline = $('#modalVerticalPOD input#U_PODSubmitDeadline').val();
		let U_WaivedDays = $('#modalVerticalPOD input#U_WaivedDays').val();
		let U_HolidayOrWeekend = $('#modalVerticalPOD input#U_HolidayOrWeekend').val();
		
		let todayDate =  new Date()
		let todayDateDays = todayDate.getDate();
		var U_PODSubmitDeadlineDate = new Date(U_PODSubmitDeadline);
		var U_ActualHCRecDateDate = new Date(U_ActualHCRecDate);
		
		

		
		if(U_ActualHCRecDate == ''){
			var start = new Date($('#modalVerticalPOD input#U_PODSubmitDeadline').val());
			var end = new Date();

			// end - start returns difference in milliseconds 
			var diff = new Date(start - end);
			var days2 = diff/1000/60/60/24;

			var U_WaivedDays2 = (U_WaivedDays != '') ? U_WaivedDays : 0;
			var U_HolidayOrWeekend2 = (U_HolidayOrWeekend != '') ? U_HolidayOrWeekend : 0;

			overDueDays = parseInt(days2) + parseInt(U_WaivedDays2) + parseInt(U_HolidayOrWeekend2);
			$('#modalVerticalPOD input#U_OverdueDays').val(overDueDays)
			if(overDueDays < 0){
				$('#modalVerticalPOD input#U_InteluckPenaltyCalc').val(overDueDays * 200)
			}else if (overDueDays >= 0){
				$('#modalVerticalPOD input#U_InteluckPenaltyCalc').val('0.00')
			}
			

			computeU_PODStatusPayment()
		}
		else{
			var start = new Date($('#modalVerticalPOD input#U_PODSubmitDeadline').val());
			var end = new Date($('#modalVerticalPOD input#U_ActualHCRecDate').val());
			

			// end - start returns difference in milliseconds 
			var diff = new Date(start - end);
			var days2 = diff/1000/60/60/24;

			var U_WaivedDays2 = (U_WaivedDays != '') ? U_WaivedDays : 0;
			var U_HolidayOrWeekend2 = (U_HolidayOrWeekend != '') ? U_HolidayOrWeekend : 0;

			overDueDays = parseInt(days2) + parseInt(U_WaivedDays2) + parseInt(U_HolidayOrWeekend2);
			$('#modalVerticalPOD input#U_OverdueDays').val(overDueDays)
			if(overDueDays < 0){
				$('#modalVerticalPOD input#U_InteluckPenaltyCalc').val(overDueDays * 200)
			}else if (overDueDays >= 0){
				$('#modalVerticalPOD input#U_InteluckPenaltyCalc').val('0.00')
			}
			computeU_PODStatusPayment()
		}

	}
	function computeU_PODStatusPayment(){


		U_InitialHCRecDate = $('#modalVerticalPOD').find('#U_InitialHCRecDate').val();
		U_DeliveryDateDTR = $('#modalVerticalPOD').find('#U_DeliveryDateDTR').val();
		U_ClientLeadTime = $('#modalVerticalPOD').find('#U_ClientLeadTime').val();
		U_OverdueDays = $('#modalVerticalPOD').find('#U_OverdueDays').val();

		console.log(U_OverdueDays)
		if(U_OverdueDays >= 0){
			$('#modalVerticalPOD input#U_PODStatusPayment').val('Ontime')
		}else if(U_OverdueDays >= -13 && U_OverdueDays <= 0){
			$('#modalVerticalPOD input#U_PODStatusPayment').val('Late')
		}else if(U_OverdueDays <= -13 && U_OverdueDays <= 0){
			$('#modalVerticalPOD input#U_PODStatusPayment').val('Lost')
		}


	

		if(U_OverdueDays >= 0){
					// $('#modalVerticalPOD input#U_InteluckPenaltyCalc').val('0')
		}else if(U_OverdueDays >= -13 && U_OverdueDays <= 0){
					console.log('10101')
					// $('#modalVerticalPOD input#U_InteluckPenaltyCalc').val(FormatMoney(U_InteluckPenaltyCalc))
		}else if(U_OverdueDays <= -13 && U_OverdueDays <= 0){
					console.log('LOST')

					console.log('----------------------')
					console.log($('#U_TotalInitialTruckers').val())
					$('#modalVerticalPOD input#U_InteluckPenaltyCalc').val('0')
					if($('#U_TotalInitialTruckers').val() != ''){
								$('#modalVerticalPOD input#U_LostPenaltyCalc').val(FormatMoney(parseFloat($('#U_TotalInitialTruckers').val()) * 2))
				
					}
				}
				if(U_DeliveryStatus == 'Delivered' || U_DeliveryStatus == 'Irregular'){
					$('#modalVerticalPOD select#U_PODStatusDetail').attr('disabled',false)
				}else{
					$('#modalVerticalPOD select#U_PODStatusDetail').attr('disabled',false)
			
				}
	}
	function checkTimeFormat(id,value,hours,minutes,separator){

		if(value.length != 5){
			$('#' + id).focus()
			disableButtons()
						$('#messageBar2').addClass('d-none');
						$('#messageBar3').removeClass('d-none');
						$('#messageBar').text('Format must be HH:MM').css({'background-color': 'red', 'color': 'white'});
			
				setTimeout(function()
				{
					$('#messageBar').text('').css({'background-color': '', 'color': ''});	
					
				},5000)
			}else{
				if(hours.length != 2){
					$('#' + id).focus()
					disableButtons()
					$('#messageBar2').addClass('d-none');
					$('#messageBar3').removeClass('d-none');
					$('#messageBar').text('Format must be HH:MM').css({'background-color': 'red', 'color': 'white'});
					
						setTimeout(function()
						{
							$('#messageBar').text('').css({'background-color': '', 'color': ''});	
							
						},5000)
				}else if(parseInt(hours) < 0 || parseInt(hours) > 24){
					$('#' + id).focus()
					disableButtons()
					$('#messageBar2').addClass('d-none');
					$('#messageBar3').removeClass('d-none');
					$('#messageBar').text('Hours must be between 00 and 24').css({'background-color': 'red', 'color': 'white'});
					
						setTimeout(function()
						{
							$('#messageBar').text('').css({'background-color': '', 'color': ''});	
							
						},5000)
				}else{
					enableButtons()
				}

				if(minutes.length != 2){
					$('#' + id).focus()
					disableButtons()
					$('#messageBar2').addClass('d-none');
					$('#messageBar3').removeClass('d-none');
					$('#messageBar').text('Format must be HH:MM').css({'background-color': 'red', 'color': 'white'});
					
						setTimeout(function()
						{
							$('#messageBar').text('').css({'background-color': '', 'color': ''});	
							
						},5000)
				}else if(parseInt(minutes) < 0 || parseInt(minutes) > 59){
					$('#' + id).focus()
					disableButtons()
					$('#messageBar2').addClass('d-none');
					$('#messageBar3').removeClass('d-none');
					$('#messageBar').text('Minutes must be between 00 and 24').css({'background-color': 'red', 'color': 'white'});
					
						setTimeout(function()
						{
							$('#messageBar').text('').css({'background-color': '', 'color': ''});	
							
						},5000)
				}else{
					enableButtons()
				}

				if(separator != ':'){
					$('#' + id).focus()
					disableButtons()
					$('#messageBar2').addClass('d-none');
					$('#messageBar3').removeClass('d-none');
					$('#messageBar').text('Format must be HH:MM').css({'background-color': 'red', 'color': 'white'});
					
						setTimeout(function()
						{
							$('#messageBar').text('').css({'background-color': '', 'color': ''});	
							
						},5000)
				}else{
					enableButtons()
				}
		}
		
	}

	// TP
	$(document.body).on('blur', '#modalVerticalTP input.amount', function () 
	{
		let amount = $(this).val();
		$(this).val(FormatMoney(amount))
	})
	$(document.body).on('blur', '#modalVerticalTP input.amountNumber', function () 
	{
		let amount = $(this).val();
		$(this).val(FormatMoney(amount))
	})
	$(document.body).on('blur', '#modalVerticalTP input.totalpayablemember', function () 
	{
		computeTotalPayableTP()
	})
	$(document.body).on('blur', '#modalVerticalTP input.deductions', function () 
	{
		
		computeTotalDeductionsTP()
	})
	$(document.body).on('blur', '#modalVerticalTP input.deductions', function () 
	{
		
		computeTotalDeductionsTP()
	})
	function computeTotalPayableTP(){
		let amount = 0.00;

		let deductions = parseFloat($('#modalVerticalTP input#U_TOTALDEDUCTIONS').val().replace(/,/g, ''))

		
		$('#modalVerticalTP input.totalpayablemember').each(function (i) {

				amount += parseFloat($(this).val().replace(/,/g, ''))

		});
		console.log(amount + '/' +  deductions)
		$('#modalVerticalTP input#U_TotalPayable').val(FormatMoney(amount - deductions))

	}	
	function computeTotalDeductionsTP(){
		let amount = 0.00;
		$('#modalVerticalTP input.deductions').each(function (i) {

				amount += parseFloat($(this).val().replace(/,/g, ''))

		});
		console.log(amount)
		$('#modalVerticalTP input#U_TOTALDEDUCTIONS').val(FormatMoney(amount))

	}	

	// BILLING
	$(document.body).on('blur', '#modalVerticalBILLING input.amount', function () 
	{
		let amount = $(this).val();
		$(this).val(FormatMoney(amount))
	})
	$(document.body).on('blur', '#modalVerticalBILLING input.totalreceivablemember', function () 
	{
		computeTotalReceivableBILLING()
	})

	function computeTotalReceivableBILLING(){
		let amount = 0.00;
		$('#modalVerticalBILLING input.totalreceivablemember').each(function (i) {
			console.log($(this).attr('id') + ":" + $(this).val())
				amount += parseFloat($(this).val().replace(/,/g, ''))

		});

		$('#modalVerticalBILLING input#U_TotalRecClients').val(FormatMoney(amount))

		let totalAr = parseFloat($('#modalVerticalBILLING input#U_TotalAR').val().replace(/,/g, ''))
		$('#modalVerticalBILLING input#U_VarAR').val(FormatMoney(totalAr-amount))

	}	

	function enableButtons(){

		$('#btnUpdatePODRow').attr('disabled',false)
		$('#btnUpdateBILLINGRow').attr('disabled',false)
		$('#btnUpdateTPRow').attr('disabled',false)
		$('#btnUpdatePRICINGRow').attr('disabled',false)
	}

	function disableButtons(){
		$('#btnUpdatePODRow').attr('disabled',true)
		$('#btnUpdateBILLINGRow').attr('disabled',true)
		$('#btnUpdateTPRow').attr('disabled',true)
		$('#btnUpdatePRICINGRow').attr('disabled',true)
	}


	//PTF GENERATION -	------------------------------

	
	$("#generatedPVorPTF").on('hide.bs.modal', function(){
		 $('#btnfind').trigger('click');
	});
	// $(document.body).on('change', '.detailsTable tbody tr td', function () 
	// {
	// })
	$(document.body).on('click', '.detailsTable tbody tr td', function () 
	{
		
		

				var col_index = $(this).index();
				// console.log(col_index)
				// console.log($(this).text())
				// console.log($(this).find('select').val())



	});
	$(document.body).on('click', '.detailsTable tbody tr td input[type="checkbox"]', function () 
	{
		// let totalTrucker = 0.00;
		// let totalAddlChrg = 0.00

		// // apvArray = [];
		// // sapAPArray = [];
		// // PVTruckerRate = [];
		// // PVAddlChrgeRate = [];
		// // BNRate = [];
		// // $('.detailsTable tbody tr').each(function (i) 
		// // {
			
		// 	if($(this).closest('tr').find('td:eq(1) input').is(":checked")){

		// 		var col_index = $(this).index();
		// 		console.log(col_index)
		// 		row = $(this).closest('tr').find('td:eq(0)').text();
		// 		pid = "'" + $(this).closest('tr').find('td:eq(5)').text().trim() + "'";
		// 		bn = $(this).closest('tr').find('td:eq(5)').text().trim();
		// 		console.log($(this).closest('tr').find('td:eq(41) select').val())
		// 		console.log($(this).closest('tr').find('td:eq(38)').text())
		// 		sapAP = $(this).closest('tr').find('td:eq(8)').text().trim();
		// 		sapAP_Paid = $(this).closest('tr').find('td:eq(9)').text().trim();
		// 		pvno = $(this).closest('tr').find('td:eq(75)').text().trim();


		// 		console.log(sapAP)
		// 		console.log(sapAP_Paid)


		// 		if($(this).closest('tr').find('td:eq(42)').text().trim() == '' && $(this).closest('tr').find('td:eq(41) select').val() == 'Verified'){
		// 			ptfArray.push(pid);
		// 			console.log(ptfArray)
		// 		}
		// 		if($(this).closest('tr').find('td:eq(47)').text().trim() == 'ReturntoPOD' && $(this).closest('tr').find('td:eq(41) select').val() == 'Verified'){
		// 			ptfArray.push(pid);
					
		// 		}
		// 		console.log($(this).closest('tr').find('td:eq(41) select').length)
		// 		if($(this).closest('tr').find('td:eq(41) select').length > 0){



		// 			if($(this).closest('tr').find('td:eq(41) select').val().trim() == 'For Payment' && $(this).closest('tr').find('td:eq(70)').text().trim() != '0.00' && sapAP == '' && sapAP_Paid == ''){
		// 				var index2 = apvArray.indexOf($(this).closest('tr').find('td:eq(5)').text().trim());
		// 				var indexBN = BNRate.indexOf(parseInt($(this).closest('tr').find('td:eq(4)').text()));
		// 				var indexRate = PVTruckerRate.indexOf(parseInt(totalTrucker));
		// 				var indexAddl = PVAddlChrgeRate.indexOf(parseInt(totalAddlChrg));
		// 				if (index2 !== -1) {
		// 					  apvArray.splice(index2, 1);
		// 					  sapAPArray.splice(index2, 1);
		// 					  BNRate.splice(indexBN, 1);
		// 					  PVTruckerRate.splice(indexRate, 1);
		// 					  PVAddlChrgeRate.splice(indexAddl, 1);
		// 					  console.log(apvArray)
		// 					  console.log(sapAPArray)
		// 						console.log(BNRate)
		// 						console.log(PVTruckerRate)
		// 						console.log(PVAddlChrgeRate)
		// 					}


		// 				apvArray.push(pid);
		// 				totalTrucker = 
		// parseFloat($(this).closest('tr').find('td:eq(45)').text().trim().replace(/,/g, ''))   +
							
		// // parseFloat($(this).closest('tr').find('td:eq(55)').text().trim().replace(/,/g, ''))  +
					
		// parseFloat($(this).closest('tr').find('td:eq(56) input').val().replace(/,/g, '')) +
							
		// parseFloat($(this).closest('tr').find('td:eq(57) input').val().replace(/,/g, '')) ;
						
		// 			totalAddlChrg = 
		// parseFloat($(this).closest('tr').find('td:eq(54)').text().trim().replace(/,/g, ''))   +
						
		// parseFloat($(this).closest('tr').find('td:eq(55)').text().trim().replace(/,/g, ''))   +
					
		// parseFloat($(this).closest('tr').find('td:eq(58) input').val().replace(/,/g, '')) +
							
		// parseFloat($(this).closest('tr').find('td:eq(59) input').val().replace(/,/g, '')) +
						
		// // parseFloat($(this).closest('tr').find('td:eq(60) input').val().replace(/,/g, '')) == null ? 0.00 : parseFloat($(this).closest('tr').find('td:eq(60) input').val().replace(/,/g, '')) +
		// parseFloat($(this).closest('tr').find('td:eq(60) input').val().replace(/,/g, '')) +
		// parseFloat($(this).closest('tr').find('td:eq(61) input').val().replace(/,/g, '')) ;
							
		
		// 				PVTruckerRate.push(totalTrucker.toFixed(6));
		// 				PVAddlChrgeRate.push(totalAddlChrg.toFixed(6));
		// 				BNRate.push(bn)
		// 				console.log(BNRate)
		// 				console.log(PVTruckerRate)
		// 				console.log(PVAddlChrgeRate)

		// 				// sapAPArray.push(sapAP);
		// 			// }else if($(this).closest('tr').find('td:eq(21) select').val().trim() == 'For Payment' && $(this).closest('tr').find('td:eq(50)').text().trim() != '0.00' && sapAP != '' && sapAP_Paid == ''){
		// 			// 	// apvArray.push(pid);
		// 			// 	// sapAPArray.push(sapAP);
		// 		}
		// 		}else{
		// 			if($(this).closest('tr').find('td:eq(41)').text().trim() == 'For Payment' && $(this).closest('tr').find('td:eq(70)').text().trim() != '0.00' && sapAP == '' && sapAP_Paid != '' && pvno != ''){
		// 				apvArray.push(pid);
		// 				sapAPArray.push(sapAP_Paid);
					
		// 			}else if($(this).closest('tr').find('td:eq(41) select').val().trim() == 'For Payment' && $(this).closest('tr').find('td:eq(70)').text().trim() != '0.00' && sapAP == '' && sapAP_Paid != '' && pvno != ''){
		// 				apvArray.push(pid);
		// 				sapAPArray.push(sapAP_Paid);
					
		// 			}

		// 		}


		// 	}else{
		// 		var index = ptfArray.indexOf($(this).closest('tr').find('td:eq(5)').text());
		// 		var index2 = apvArray.indexOf($(this).closest('tr').find('td:eq(5)').text());
		// 		var indexBN = BNRate.indexOf(parseInt($(this).closest('tr').find('td:eq(4)').text()));
		// 		var indexRate = PVTruckerRate.indexOf(parseInt(totalTrucker));
		// 		var indexAddl = PVAddlChrgeRate.indexOf(parseInt(totalAddlChrg));
		// 			if (index !== -1) {
		// 			  ptfArray.splice(index, 1);
		// 			  console.log(ptfArray)
		// 			}
		// 			if (index2 !== -1) {
		// 			  apvArray.splice(index2, 1);
		// 			  sapAPArray.splice(index2, 1);
		// 			  BNRate.splice(indexBN, 1);
		// 			  PVTruckerRate.splice(indexRate, 1);
		// 			  PVAddlChrgeRate.splice(indexAddl, 1);
		// 			  console.log(apvArray)
		// 			  console.log(sapAPArray)
		// 				console.log(BNRate)
		// 				console.log(PVTruckerRate)
		// 				console.log(PVAddlChrgeRate)
		// 			}
					
		// 	}
		// 	console.log(ptfArray)
		// 	console.log(apvArray)
		// 	console.log(sapAPArray)
		// })
		
	});
	$(document.body).on('click', '#PTFGenerator', function () 
	{
		console.log('test')
		ptfArray = [];
		ptfArrayForSeparateTable = [];
		
		console.log(ptfArray)

		var dataTable = $('#tabtblpod').dataTable()
		
		$(dataTable.fnGetNodes()).each(function(i)
		{


			

			if($(this).find("td:eq(1) input").is(":checked")){	
			pid = "'" + $(this).closest('tr').find('td:eq(5)').text().trim() + "'";	
			pid2 = $(this).closest('tr').find('td:eq(5)').text().trim();	
				if($(this).find('td:eq(42)').text().trim() == '' && $(this).find('td:eq(41) select').val() == 'Verified'){
					ptfArray.push(pid);
					ptfArrayForSeparateTable.push(pid2);
					console.log(ptfArray)
					console.log($(this).find("td:eq(5)").text())
				}
				if($(this).find('td:eq(47) select').val() == 'ReturntoPOD' && $(this).find('td:eq(41) select').val() == 'Verified'){
					ptfArray.push(pid);
					ptfArrayForSeparateTable.push(pid2);
					console.log($(this).find("td:eq(5)").text())
					
				}
				
				}
		});


		if(ptfArray.length > 0){

			
			$.ajax({

		        type: 'POST',
		        url: '../proc/exec/exec_update_PTFGenerator.php',
		        startTime: performance.now(),
				data:{
					ptfArray: ptfArray
				},
				success: function (data){
						console.log(data)	

						var res = $.parseJSON(data);
						//
						if(res.valid == true)
						{

						$('#messageBar2').addClass('d-none');
						$('#messageBar3').removeClass('d-none');
						$('#messageBar').text(res.msg).css({'background-color': '#00FF7F', 'color': 'black'});
						$('#generatedPVorPTF').modal('show')	
						$('#myModalLabelGenerated').text('PTF No. Generated: ' + res.result)
						
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

				// alert(ptfArray)
				console.log(ptfArrayForSeparateTable)
				p.actionAjax('refreshExtractTables', { bookingIds: ptfArrayForSeparateTable }).then(res => console.log('refreshExtractTables', res))


		}else{
			$('#messageBar2').addClass('d-none');
			$('#messageBar3').removeClass('d-none');
			$('#messageBar').text('No Row to Generate PTF No!').css({'background-color': 'red', 'color': 'white'});

			setTimeout(function()
			{
				$('#messageBar').text('').css({'background-color': '', 'color': ''});	
				$('#messageBar2').removeClass('d-none');
			},5000)
		}
		
	


	})

	$(document.body).on('click', '#voucherNoGenerator', function () 
	{

		let error = 0;
		console.log('test')
		let totalTrucker = 0.00;
		let totalAddlChrg = 0.00


		apvArray = [];
		apvArrayForExtraction = [];
		sapAPArray = [];
		PVTruckerRate = [];
		PVAddlChrgeRate = [];
		BNRate = [];

		var dataTable = $('#tabtbltp').dataTable()
		
		$(dataTable.fnGetNodes()).each(function(i)
		{

		if($(this).find("td:eq(1) input").is(":checked")){
			if($(this).find('td:eq(41) select').val() == undefined && $(this).find('td:eq(41)').text().trim() !== undefined && $(this).find('td:eq(41)').text().trim() != 'For Payment' ){

				$('#notValidBNForPV').modal('show')
				$('#bnError').text($(this).find('td:eq(5)').text().trim() + ' This BN is not For Payment')
				error += 1;
				return false;
			
			}

			else if($(this).find('td:eq(41)').text() == undefined && $(this).find('td:eq(41) select').val() !== undefined && $(this).find('td:eq(41) select').val().trim() != 'For Payment'){
				$('#notValidBNForPV').modal('show')
				$('#bnError').text($(this).find('td:eq(5)').text().trim() + ' This BN is not For Payment')
				error += 1;
				return false;
			}
			else{
				
					var col_index = $(this).index();
					console.log(col_index)
					row = $(this).find('td:eq(0)').text();
					pid = "'" + $(this).find('td:eq(5)').text().trim() + "'";
					pid2 = $(this).find('td:eq(5)').text().trim();
					bn = $(this).find('td:eq(5)').text().trim();
					console.log($(this).find('td:eq(41) select').val())
					console.log($(this).find('td:eq(38)').text())
					sapAP = $(this).find('td:eq(8)').text().trim();
					sapAP_Paid = $(this).find('td:eq(9)').text().trim();
					pvno = $(this).find('td:eq(75)').text().trim();

				// console.log($(this).find('td:eq(41) select').val())
				if($(this).find('td:eq(41) select').val() == 'For Payment' ){
					console.log('For Payment tong BN na to')
				}
				if($(this).find('td:eq(41) select').val() !== undefined && $(this).find('td:eq(41) select').val().trim() == 'For Payment' && $(this).find('td:eq(70)').text().trim() != '0.00' && sapAP == '' && sapAP_Paid == ''){

				console.log('1st PV')

					if($(this).find('td:eq(41) select').val().trim() == 'For Payment' && $(this).find('td:eq(70)').text().trim() != '0.00' && sapAP == '' && sapAP_Paid == ''){
						var index2 = apvArray.indexOf($(this).find('td:eq(5)').text().trim());
						var indexExtraction = apvArrayForExtraction.indexOf($(this).find('td:eq(5)').text().trim());
						var indexBN = BNRate.indexOf(parseInt($(this).find('td:eq(4)').text()));
						var indexRate = PVTruckerRate.indexOf(parseInt(totalTrucker));
						var indexAddl = PVAddlChrgeRate.indexOf(parseInt(totalAddlChrg));
						if (index2 !== -1) {
							  apvArray.splice(index2, 1);
							  apvArrayForExtraction.splice(indexExtraction, 1);
							  sapAPArray.splice(index2, 1);
							  BNRate.splice(indexBN, 1);
							  PVTruckerRate.splice(indexRate, 1);
							  PVAddlChrgeRate.splice(indexAddl, 1);
							  console.log(apvArray)
							  console.log(sapAPArray)
								console.log(BNRate)
								console.log(PVTruckerRate)
								console.log(PVAddlChrgeRate)
							}


						apvArray.push(pid);
						apvArrayForExtraction.push(pid2);
						totalTrucker = 
						parseFloat($(this).find('td:eq(45)').text().trim().replace(/,/g, ''))   +
											
						// parseFloat($(this).find('td:eq(55)').text().trim().replace(/,/g, ''))  +
									
						parseFloat($(this).find('td:eq(56) input').val().replace(/,/g, '')) +
											
						parseFloat($(this).find('td:eq(57) input').val().replace(/,/g, '')) ;
										
									totalAddlChrg = 
						parseFloat($(this).find('td:eq(54)').text().trim().replace(/,/g, ''))   +
										
						parseFloat($(this).find('td:eq(55)').text().trim().replace(/,/g, ''))   +
									
						parseFloat($(this).find('td:eq(58) input').val().replace(/,/g, '')) +
											
						parseFloat($(this).find('td:eq(59) input').val().replace(/,/g, '')) +
										
						// parseFloat($(this).find('td:eq(60) input').val().replace(/,/g, '')) == null ? 0.00 : parseFloat($(this).find('td:eq(60) input').val().replace(/,/g, '')) +
						parseFloat($(this).find('td:eq(60) input').val().replace(/,/g, '')) +
						parseFloat($(this).find('td:eq(61) input').val().replace(/,/g, '')) ;
							
		
						PVTruckerRate.push(totalTrucker.toFixed(6));
						PVAddlChrgeRate.push(totalAddlChrg.toFixed(6));
						BNRate.push(bn)
						console.log(BNRate)
						console.log(PVTruckerRate)
						console.log(PVAddlChrgeRate)
				}
				}
				else{

					console.log('2nd PV')
					console.log($(this).find('td:eq(70)').text().trim())
					console.log(sapAP)
					console.log(sapAP_Paid)
					console.log(pvno)




					if($(this).find('td:eq(41)').text().trim() !== undefined && $(this).find('td:eq(41)').text().trim() == 'For Payment' && $(this).find('td:eq(70)').text().trim() != '0.00' && sapAP == '' && sapAP_Paid != '' && pvno != ''){
						apvArray.push(pid);
						apvArrayForExtraction.push(pid2);
						sapAPArray.push(sapAP_Paid);
					
					}else if($(this).find('td:eq(41) select').val() !== undefined && $(this).find('td:eq(41) select').val().trim() == 'For Payment' && $(this).find('td:eq(70)').text().trim() != '0.00' && sapAP == '' && sapAP_Paid != '' && pvno != ''){
						apvArray.push(pid);
						apvArrayForExtraction.push(pid2);
						sapAPArray.push(sapAP_Paid);
					
					}

				}
			}

		
		}
	});
		console.log(apvArray.length)
		console.log(sapAPArray.length)
		console.log(error)
	
		if(error == 0){

		if(apvArray.length > 0 && sapAPArray.length == 0){

// U_GrossTruckerRates
// U_AddtlCharges
// U_RateAdjustments
// U_totalAddtlCharges2
// U_OtherCharges
// U_TotalPenalty
// U_DemurrageN
// U_ActualRates
// U_ActualDemurrage
// U_BoomTruck2
// U_TotalPenaltyWaived
			console.log(apvArray)
			console.log(PVTruckerRate)
			console.log(PVAddlChrgeRate)

			$.ajax({

		        type: 'POST',
		        url: '../proc/exec/exec_update_APVGenerator.php',
		        startTime: performance.now(),
				data:{
					apvArray: apvArray,
					pvno: pvno,
					sapAPArray:sapAPArray,
					PVTruckerRate:PVTruckerRate,
					PVAddlChrgeRate:PVAddlChrgeRate,
					BNRate:BNRate
				},
				success: function (data){
						console.log(data)	

						var res = $.parseJSON(data);
						$('#btnfind').trigger('click');
						if(res.valid == true)
						{

						$('#messageBar2').addClass('d-none');
						$('#messageBar3').removeClass('d-none');
						$('#messageBar').text(res.msg).css({'background-color': '#00FF7F', 'color': 'black'});
						$('#generatedPVorPTF').modal('show')	
						$('#myModalLabelGenerated').text('PV No. Generated: ' + res.result)
						
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

				// apvArrayForExtraction.push(pid2);
				console.log(apvArrayForExtraction)
				p.actionAjax('refreshExtractTables', { bookingIds: apvArrayForExtraction })
		
	}else if(apvArray.length > 0  && sapAPArray.length > 0){
		$('#rateSelectionModal').modal('show')
		$('.ratesoptions').removeAttr('checked');	
	}
	else{
		console.log('error')
		console.log(apvArray)
		console.log(sapAPArray)
	}
}else{
			$('#messageBar2').addClass('d-none');
			$('#messageBar3').removeClass('d-none');
			$('#messageBar').text('No Row to Generate Voucher No!!!!!').css({'background-color': 'red', 'color': 'white'});

			setTimeout(function()
			{
				$('#messageBar').text('').css({'background-color': '', 'color': ''});	
				$('#messageBar2').removeClass('d-none');
			},5000)
		}
		
	})

	$(document.body).on('click', '.ratesoptions', function () 
	{
		
		if($(this).is(":checked")){
			rates = $(this).attr('id');
			
				ratesPerPV.push(rates);
				
		}else{
			var index = ratesPerPV.indexOf($(this).attr('id'));
				if (index !== -1) {
				  ratesPerPV.splice(index, 1);
				  console.log(ratesPerPV)
				}
		}
		console.log(ratesPerPV)
		// alert(objType)

	});
	$(document.body).on('click', '#btnSelectRatePerPV', function () 
	{	
		
		if(ratesPerPV.length > 0){
			console.log(apvArray)
			console.log(pvno)
			console.log(sapAPArray)
			console.log(ratesPerPV)

			
			$.ajax({

		        type: 'POST',
		        url: '../proc/exec/exec_update_APVGenerator_RatesPerPV.php',
		        startTime: performance.now(),
				data:{
					apvArray: apvArray,
					pvno: pvno,
					sapAPArray:sapAPArray,
					ratesPerPV:ratesPerPV
				},
				success: function (data){
						console.log(data)	

						var res = $.parseJSON(data);
						$('#btnfind').trigger('click');
						if(res.valid == true)
						{

						$('#messageBar2').addClass('d-none');
						$('#messageBar3').removeClass('d-none');
						$('#messageBar').text(res.msg).css({'background-color': '#00FF7F', 'color': 'black'});
						$('#generatedPVorPTF').modal('show')	
						$('#myModalLabelGenerated').text('PV No. Generated: ' + res.result)
						
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

			console.log(apvArrayForExtraction)
			p.actionAjax('refreshExtractTables', { bookingIds: apvArrayForExtraction })
		}else{
			$('#messageBar2').addClass('d-none');
			$('#messageBar3').removeClass('d-none');
			$('#messageBar').text('No Row to Generate Voucher No!').css({'background-color': 'red', 'color': 'white'});

			setTimeout(function()
			{
				$('#messageBar').text('').css({'background-color': '', 'color': ''});	
				$('#messageBar2').removeClass('d-none');
			},5000)
		}
	});

	

});

