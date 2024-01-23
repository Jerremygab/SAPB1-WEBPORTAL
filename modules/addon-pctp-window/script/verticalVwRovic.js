$(() => {

    console.log('vertical working')
    
        let dateFormat = 'YYYY-MM-DD'
        
        
        let PricingU_TotalInitialTruckers = 0;
        let pid = '';
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
            tabId = $(".tab-pane:visible").attr("id")
            console.log(pid)
            console.log($('.detailsTable').attr('id'))
            console.log($(".tab-pane:visible").attr("id"))
            console.log(row)
            
            // podtabpane
            // billingtabpane
            // tptabpane
            // pricingtabpane
    
            if(tabId == 'podtabpane'){
                $('#modalVerticalPOD').modal('show')
                $('#modalVerticalPOD input#RowNoVertical').val(row)	
            }
    

        })
    
        $(document.body).on('click', '#btnUpdatePODRowNew', function () 
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
    
            
            // console.log(err)
            if(err == 0){	
    
                
                // alert(pid)
                // UPDATE FUNCTION BY ROVIC
    
                let BookingId = $('#U_BookingNumber').val()
                let BookingDate =  $('#U_BookingDate').val()
                let ClientName =  $('#U_ClientName').val()
                let SapClient =  $('#U_SAPClient').val()
                let TruckerName =  $('#U_TruckerName').val()
                let SapTrucker =  $('#U_SAPTrucker').val()
                let PlateNumber =  $('#U_PlateNumber').val()
                let Vehicletype =  $('#U_VehicleTypeCap').val()
                let DeliveryOrigin =  $('#U_DeliveryOrigin').val()
                let Destination =  $('#U_Destination').val()
                let InterIsland =  $('#U_IFINTERISLAND').val()
                let DeliveryStatus =  $('#U_DeliveryStatus').val()
                let DeliveryDateDTR =  $('#U_DeliveryDateDTR').val()
                let DeliveryDatePOD =  $('#U_DeliveryDatePOD').val()
                let NoOfDrops =  $('#U_NoOfDrops').val()
                let TripType =  $('#U_TripType').val()
                let Remarks =  $('#U_Remarks').val()
                let DocNum =  $('#U_DocNum').val()
                let TripTicketNo =  $('#U_TripTicketNo').val()
                let ShipmentNo =  $('#U_ShipmentNo').val()
                let WayBillNo =  $('#U_WaybillNo').val()
                let DeliveryReceiptNo =  $('#U_DeliveryReceiptNo').val()
                let SeriesNo =  $('#U_SeriesNo').val()
                let OtherPODDoc =  $('#U_OtherPODDoc').val()
                let RemarksPOD =  $('#U_RemarksPOD').val()
                let Receivedby =  $('#U_Receivedby').val()
                let ActualHCRecDate =  $('#U_ActualHCRecDate').val()
                let DateReturned =  $('#U_DateReturned').val()
                let PODinCharge =  $('#U_PODinCharge').val()
                let VerifiedDateHC =  $('#U_VerifiedDateHC').val()
                let ShiPODStatusDetailpmentNo =  $('#U_PODStatusDetail').val()
                let PTFNo =  $('#U_PTFNo').val()
                let DateForwardedBT =  $('#U_DateForwardedBT').val()
                let VERIFICATION_TAT =  $('#U_VERIFICATION_TAT').val()
                let POD_TAT =  $('#U_POD_TAT').val()
                let BillingDeadline =  $('#U_BillingDeadline').val()
                let BillingStatus =  $('#U_BillingStatus').val()
                let TypeOfAccessorial =  $('#U_TypeOfAccessorial').val()
                let ServiceType =  $('#U_ServiceType').val()
                let SINo =  $('#U_SINo').val()
                let BillingTeam =  $('#U_BillingTeam').val()
                let BTRemarks =  $('#U_BTRemarks').val()
                let SOBNumber =  $('#U_SOBNumber').val()
                let OutletNo =  $('#U_OutletNo').val()
                let CBM =  $('#U_CBM').val()
                let SI_DRNo =  $('#U_SI_DRNo').val()
                let DeliveryMode =  $('#U_DeliveryMode').val()
                let SourceWhse =  $('#U_SourceWhse').val()
                let TotalInvAmount =  $('#U_TotalInvAmount').val()
                let NameCustomer =  $('#U_NameCustomer').val()
                let CategoryDR =  $('#U_CategoryDR').val()
                let ForwardLoadNo =  $('#U_ForwardLoad').val()
                let SONo =  $('#U_SONo').val()
                let BackLoad =  $('#U_BackLoad').val()
                let IDNumber =  $('#U_IDNumber').val()
                let ApprovalStatus =  $('#U_ApprovalStatus').val()
                let TimeInEmptyDem =  $('#U_TimeInEmptyDem').val()
                let TimeOutEmptyDem =  $('#U_TimeOutEmptyDem').val()
                let VerifiedEmptyDem =  $('#U_VerifiedEmptyDem').val()
                let Remarks2 =  $('#U_Remarks2').val()
                let TimeInAdvLoading =  $('#U_TimeInAdvLoading').val()
                let DayOfTheWeek =  $('#U_DayOfTheWeek').val()
                let TimeIn =  $('#U_TimeIn').val()
                let TimeOut =  $('#U_TimeOut').val()
                let TotalNoExceed =  $('#U_TotalNoExceed').val()
                let ODOIn =  $('#U_ODOIn').val()
                let ODOOut =  $('#U_ODOOut').val()
                let TotalUsage =  $('#U_TotalUsage').val()
                let ClientSubStatus =  $('#U_ClientSubStatus').val()
                let ClientSubOverdue =  $('#U_ClientSubOverdue').val()
                let ClientPenaltyCalc =  $('#U_ClientPenaltyCalc').val()
                let PODStatusPayment =  $('#U_PODStatusPayment').val()
                let PODSubmitDeadline =  $('#U_PODSubmitDeadline').val()
                let OverdueDays =  $('#U_OverdueDays').val()
                let InteluckPenaltyCalc =  $('#U_InteluckPenaltyCalc').val()
                let WaivedDays =  $('#U_WaivedDays').val()
                let HolidayOrWeekend =  $('#U_HolidayOrWeekend').val()
                let LostPenaltyCalc =  $('#U_LostPenaltyCalc').val()
                let PenaltiesManual =  $('#U_PenaltiesManual').val()
                let TotalSubPenalties =  $('#U_TotalSubPenalties').val()
                let Waived =  $('#U_Waived').val()
                let PercPenaltyCharge =  $('#U_PercPenaltyCharge').val()
                let Approvedby =  $('#U_Approvedby').val()
                let TotalPenaltyWaived =  $('#U_TotalPenaltyWaived').val()
                let RowNoVertical =  $('#RowNoVertical').val()
                let U_ClientReceivedDate = $('#U_ClientReceivedDate').val()
                let U_ActualDateRec_Intitial = $('#U_ActualDateRec_Intitial').val()
                let U_InitialHCRecDate = $('#U_InitialHCRecDate').val()
                let DestinationClient = $('#U_DestinationClient').val()
                let ISLAND = $('#U_ISLAND').val()
                // let DestinationClient = $('#U_DestinationClient').val()

                

                

                // alert(BillingStatus)
                // alert(U_ActualDateRec_Intitial)     
                // alert(U_InitialHCRecDate)     
                // alert(U_ClientReceivedDate)  
                // alert(ActualHCRecDate)  
                // alert(DateReturned)  
                alert(InterIsland)
                console.log(U_ClientReceivedDate)
                console.log(ISLAND)
                console.log(U_ActualDateRec_Intitial)
                console.log(U_InitialHCRecDate)
                console.log(BookingId)
                console.log(BookingDate)
                console.log(ClientName)
                console.log(SapClient)
                console.log(TruckerName)
                console.log(SapTrucker)
                console.log(PlateNumber)
                console.log(Vehicletype)
                console.log(DeliveryOrigin)
                console.log(DeliveryDatePOD)
                console.log(Destination)
                console.log(InterIsland)
                console.log(DeliveryStatus)
                console.log(DeliveryDateDTR)
                console.log(NoOfDrops)
                console.log(TripType)
                console.log(Remarks)
                console.log(DocNum)
                console.log(TripTicketNo)
                console.log(ShipmentNo)
                console.log(WayBillNo)
                console.log(DeliveryReceiptNo)
                console.log(SeriesNo)
                console.log(OtherPODDoc)
                console.log(RemarksPOD)
                console.log(Receivedby)
                console.log(ActualHCRecDate)
                console.log(DateReturned)
                console.log(PODinCharge)
                console.log(VerifiedDateHC)
                console.log(ShiPODStatusDetailpmentNo)
                console.log(PTFNo)
                console.log(DateForwardedBT)
                console.log(VERIFICATION_TAT)
                console.log(POD_TAT)
                console.log(TypeOfAccessorial)
                console.log(BillingDeadline)
                console.log(BillingStatus)
                console.log(ServiceType)
                console.log(SINo)
                console.log(BillingTeam)
                console.log(BTRemarks)
                console.log(SOBNumber)
                console.log(OutletNo)
                console.log(CBM)
                console.log(SI_DRNo)
                console.log(DeliveryMode)
                console.log(SourceWhse)
                console.log(DestinationClient)
                console.log(TotalInvAmount)
                console.log(NameCustomer)
                console.log(CategoryDR)
                console.log(ForwardLoadNo)
                console.log(SONo)
                console.log(BackLoad)
                console.log(IDNumber)
                console.log(ApprovalStatus)
                console.log(TimeInEmptyDem)
                console.log(TimeOutEmptyDem)
                console.log(VerifiedEmptyDem)
                console.log(Remarks2)
                console.log(TimeInAdvLoading)
                console.log(DayOfTheWeek)
                console.log(TimeIn)
                console.log(TimeOut)
                console.log(TotalNoExceed)
                console.log(ODOIn)
                console.log(ODOOut)
                console.log(TotalUsage)
                console.log(ClientSubStatus)
                console.log(ClientSubOverdue)
                console.log(ClientPenaltyCalc)
                console.log(PODStatusPayment)
                console.log(PODSubmitDeadline)
                console.log(OverdueDays)
                console.log(InteluckPenaltyCalc)
                console.log(WaivedDays)
                console.log(HolidayOrWeekend)
                console.log(LostPenaltyCalc)
                console.log(PenaltiesManual)
                console.log(TotalSubPenalties)
                console.log(Waived)
                console.log(PercPenaltyCharge)
                console.log(Approvedby)
                console.log(TotalPenaltyWaived)
                console.log(RowNoVertical)

                
                $.ajax({
                            type: 'POST',
                            url: '../proc/exec/exec_add_verticalVw.php',
                            startTime: performance.now(),
                    		data:{
                                
                                U_ClientReceivedDate : U_ClientReceivedDate ,
                                ISLAND : ISLAND ,
                                TypeOfAccessorial : TypeOfAccessorial ,
                                U_ActualDateRec_Intitial : U_ActualDateRec_Intitial,
                                U_InitialHCRecDate : U_InitialHCRecDate,
                    			BookingId: BookingId,
                                DeliveryDateDTR : DeliveryDateDTR,
                                DeliveryDatePOD : DeliveryDatePOD,
                    			BookingDate : BookingDate ,
                    			ClientName : ClientName ,
                    			SapClient : SapClient ,
                    			TruckerName  : TruckerName  ,
                    			SapTrucker  : SapTrucker  ,
                    			PlateNumber  : PlateNumber  ,
                    			Vehicletype  : Vehicletype  ,
                    			DeliveryOrigin   : DeliveryOrigin   ,
                    			Destination   : Destination   ,
                    			InterIsland   : InterIsland   ,
                    			DeliveryStatus   : DeliveryStatus   ,
                    			NoOfDrops   : NoOfDrops   ,
                    			TripType   : TripType   ,
                    			Remarks   : Remarks   ,
                    			DocNum   : DocNum   ,
                    			BackLoad   : BackLoad   ,
                    			TripTicketNo   : TripTicketNo   ,
                    			ShipmentNo   : ShipmentNo   ,
                    			WayBillNo   : WayBillNo   ,
                    			DeliveryReceiptNo   : DeliveryReceiptNo   ,
                    			SeriesNo   : SeriesNo   ,
                    			OtherPODDoc   : OtherPODDoc   ,
                    			RemarksPOD   : RemarksPOD   ,
                    			Receivedby   : Receivedby   ,
                    			ActualHCRecDate   : ActualHCRecDate   ,
                    			DateReturned   : DateReturned   ,
                    			PODinCharge   : PODinCharge   ,
                    			VerifiedDateHC   : VerifiedDateHC   ,
                    			ShiPODStatusDetailpmentNo   : ShiPODStatusDetailpmentNo   ,
                    			PTFNo   : PTFNo   ,
                    			DateForwardedBT   : DateForwardedBT   ,
                    			VERIFICATION_TAT   : VERIFICATION_TAT   ,
                    			POD_TAT    : POD_TAT    ,
                    			BillingDeadline    : BillingDeadline    ,
                    			BillingStatus    : BillingStatus    ,
                    			ServiceType    : ServiceType    ,
                    			SINo    : SINo    ,
                    			BillingTeam    : BillingTeam    ,
                    			BTRemarks    : BTRemarks    ,
                    			SOBNumber    : SOBNumber    ,
                    			OutletNo    : OutletNo    ,
                    			CBM    : CBM    ,
                    			SI_DRNo    : SI_DRNo    ,
                    			DeliveryMode    : DeliveryMode    ,
                    			SourceWhse    : SourceWhse    ,
                    			DestinationClient    : DestinationClient    ,
                    			TotalInvAmount    : TotalInvAmount    ,
                    			NameCustomer    : NameCustomer    ,
                    			CategoryDR    : CategoryDR    ,
                    			ForwardLoadNo    : ForwardLoadNo    ,
                    			SONo    : SONo    ,
                    			IDNumber    : IDNumber    ,
                    			ApprovalStatus    : ApprovalStatus    ,
                    			TimeInEmptyDem    : TimeInEmptyDem    ,
                    			TimeOutEmptyDem    : TimeOutEmptyDem    ,
                    			VerifiedEmptyDem    : VerifiedEmptyDem    ,
                    			Remarks2    : Remarks2    ,
                    			TimeInAdvLoading    : TimeInAdvLoading    ,
                    			DayOfTheWeek    : DayOfTheWeek    ,
                    			TimeIn    : TimeIn    ,
                                TimeOut    : TimeOut    ,
                    			TotalNoExceed     : TotalNoExceed     ,
                    			ODOIn     : ODOIn     ,
                    			ODOOut     : ODOOut     ,
                    			TotalUsage     : TotalUsage     ,
                    			ClientSubStatus     : ClientSubStatus     ,
                    			ClientSubOverdue     : ClientSubOverdue     ,
                    			ClientPenaltyCalc     : ClientPenaltyCalc     ,
                    			PODStatusPayment     : PODStatusPayment     ,
                    			PODSubmitDeadline     : PODSubmitDeadline     ,
                    			OverdueDays     : OverdueDays     ,
                    			InteluckPenaltyCalc     : InteluckPenaltyCalc     ,
                    			WaivedDays     : WaivedDays     ,
                    			HolidayOrWeekend     : HolidayOrWeekend     ,
                    			LostPenaltyCalc     : LostPenaltyCalc     ,
                    			PenaltiesManual     : PenaltiesManual     ,
                    			TotalSubPenalties     : TotalSubPenalties     ,
                    			Waived     : Waived     ,
                    			PercPenaltyCharge      : PercPenaltyCharge      ,
                    			Approvedby      : Approvedby      ,
                    			TotalPenaltyWaived      : TotalPenaltyWaived      ,
                    			RowNoVertical      : RowNoVertical      , 
                    		},
                    		success: function (data){
                    				console.log(data)	
    
                    				var res = $.parseJSON(data);
                    				// $('#btnfind').trigger('click');
                    				console.log(data.podData)
                    				if(res.valid == true)
                    				{
    
                    				// $('#modalVerticalPOD').modal('hide');
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



                        
                
                // ///////////////////////////////////////////////////////////////
    
    
    
                    // 	let podData = otArrPOD[0]
                    // 	let billingData = otArrBILLING[0]
                    // 	let tpData = otArrTP[0]
                    // 	let pricingData = otArrPRICING[0]
                    // 	console.log(podData)	
                    // 	console.log(billingData)	
                    // 	console.log(tpData)	
                    // 	console.log(pricingData)				
                    // 	if(otArrPOD.length != 0){
                    // 		$.ajax({
    
                    //         type: 'POST',
                    //         url: '../proc/exec/exec_update_pctpPODRow.php',
                    //         startTime: performance.now(),
                    // 		data:{
                    // 			pid: pid,
                    // 			podData: podData,
                    // 			billingData: billingData,
                    // 			tpData: tpData,
                    // 			pricingData: pricingData
                                
                    // 		},
                    // 		success: function (data){
                    // 				console.log(data)	
    
                    // 				var res = $.parseJSON(data);
                    // 				// $('#btnfind').trigger('click');
                    // 				console.log(data.podData)
                    // 				if(res.valid == true)
                    // 				{
    
                    // 				// $('#modalVerticalPOD').modal('hide');
                    // 				$('#messageBar2').addClass('d-none');
                    // 				$('#messageBar3').removeClass('d-none');
                    // 				$('#messageBar').text(res.msg).css({'background-color': '#00FF7F', 'color': 'black'});
                                    
                                    
                    // 					setTimeout(function()
                    // 					{
                    // 						$('#messageBar').text('').css({'background-color': '', 'color': ''});	
                                            
                    // 						//window.location.replace("../templates/delivery-document.php");
                    // 					},3000)
                    // 				}else{
    
                    // 				}
                    //         },
                    //         complete: function (data) {
                                
                            
    
                    // 				}
                    //  		});
                    // 	}else{
    
                    // 	}
        //     }else{
                
        //             $('#messageBar2').addClass('d-none');
        //                     $('#messageBar3').removeClass('d-none');
        //                     $('#messageBar').text('Input Required Fields').css({'background-color': 'red', 'color': 'white'});
                            
        //                         setTimeout(function()
        //                         {
        //                             $('#messageBar').text('').css({'background-color': '', 'color': ''});	
        //                             $('#messageBar2').removeClass('d-none');
        //                         },5000)
        //     }
    
            
                        
        })
    
      
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
    
    });
    
    