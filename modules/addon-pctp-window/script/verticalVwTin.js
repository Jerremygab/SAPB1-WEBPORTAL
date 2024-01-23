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
            
            // Pricingtabpane
            // billingtabpane
            // tptabpane
            // pricingtabpane
    
            if(tabId == 'Billingtabpane'){
                $('#modalVerticalBilling').modal('show')
                $('#modalVerticalBilling input#RowNoVertical').val(row)	
            }
    

        })
    
        $(document.body).on('click', '#btnUpdateBILLINGRowNew', function () 
        {
    
            var err = 0;
            var errmsg = '';
            
            console.log(pid)
    
            let U_VehicleTypeCap = $('#modalVerticalBilling select#U_VehicleTypeCap').val()
            let Billingstatus = $('#modalVerticalBilling select#U_BillingStatusDetail').val()
            console.log(U_VehicleTypeCap)
            console.log(Billingstatus)
            if(U_VehicleTypeCap == ''){
                err = 1;
                errmsg = 'Vehicle Type Required!';
            }
    
            if(Billingstatus == 'Verified'){
                $('#modalVerticalBilling select.Billingstatusrequired, #modalVerticalBilling input.Billingstatusrequired').each(function (i) 
                {
    
                    if(Billingstatus == ''){
                        err += 1;
                        
                    }
                });
            }	
            if(Billingstatus == 'OngoingVerification'){
                $('#modalVerticalBilling input.ongoingrequired').each(function (i) 
                {
    
                    if(Billingstatus == ''){
                        err += 1;
                        
                    }
                });
            }	
            if(Billingstatus == 'OnholdbyBilling'){
                $('#modalVerticalBilling input.onholdrequired').each(function (i) 
                {
    
                    if(Billingstatus == ''){
                        err += 1;
                        
                    }
                });
            }	
            if(Billingstatus == 'Returnedtotrucker'){
                $('#modalVerticalBilling input.returnrequired').each(function (i) 
                {
    
                    if(Billingstatus == ''){
                        err += 1;
                        
                    }
                });
            }	
            if(Billingstatus == 'PendingHardcopy'){
                $('#modalVerticalBilling input.pendingrequired').each(function (i) 
                {
    
                    if(Billingstatus == ''){
                        err += 1;
                        
                    }
                });
            }
    
                
                // if($(this).find("td:eq(3)").text() != ''){
                // 	itArrRowsBilling.push('"' + 'U_BookingDate' + '"' + ":" + '"' + validDate($(this).find("td:eq(3)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")) + '"')					
                // 	otArrBillingNotNullCellsTotal += 1;
                // 	notNullCouterRows += 1;
                // }
            let otArrBilling = []; 
            let itArrBilling = [];
            //alert($('#modalVerticalBilling input#U_DeliveryOrigin').val())
            $('#modalVerticalBilling input:not(.Billingincharge,.amountNumber,.amount)').each(function (i) 
            {
    
                //if($(this).val() != ''){
                    console.log($(this).val())
                    itArrBilling.push('"' + $(this).attr('id') + '"' + ":" + '"' + $(this).val() + '"')	
    
                    
                //}
            });
            $('#modalVerticalBilling input.amountNumber').each(function (i) 
            {
    
                //if($(this).val() != ''){
                    console.log($(this).val())
                    itArrBilling.push('"' + $(this).attr('id') + '"' + ":" +  $(this).val().replace(/,/g, '') )	
    
                    
                //}
            });
            $('#modalVerticalBilling input.amount').each(function (i) 
            {
    
                //if($(this).val() != ''){
                    console.log($(this).val())
                    itArrBilling.push('"' + $(this).attr('id') + '"' + ":" +  '"' + $(this).val().replace(/,/g, '') + '"' )	
     
                    
                //}
            });
            $('#modalVerticalBilling textarea').each(function (i) 
            {
    
                //if($(this).val() != ''){
                    console.log($(this).val())
                    itArrBilling.push('"' + $(this).attr('id') + '"' + ":" + '"' + $(this).val().replace(/(\r\n|\n|\r)/gm, " ") + '"')	
    
                    
                //}
            });
            $('#modalVerticalBilling select').each(function (i) 
            {
    
                //if($(this).val() != ''){
                    console.log($(this).val())
                    itArrBilling.push('"' + $(this).attr('id') + '"' + ":" + '"' + $(this).val() + '"')	
    
                    
                //}
            });
            otArrBilling.push('{' + itArrBilling.join(',') + '}');
            let otArrBILLING = [];
            let itArrBILLING = [];
            $('#modalVerticalBilling input.billing').each(function (i) 
            {
    
                if($(this).val() != ''){
                    console.log($(this).val())
                    itArrBILLING.push('"' + $(this).attr('id') + '"' + ":" + '"' + $(this).val() + '"')	
    
                    
                }
            });
            $('#modalVerticalBilling select.billing').each(function (i) 
            {
    
                if($(this).val() != ''){
                    console.log($(this).val())
                    itArrBILLING.push('"' + $(this).attr('id') + '"' + ":" + '"' + $(this).val() + '"')	
    
                    
                }
            });
            otArrBILLING.push('{' + itArrBILLING.join(',') + '}');
            let otArrTP = [];
            let itArrTP = [];
            $('#modalVerticalBilling input.tp').each(function (i) 
            {
    
                if($(this).val() != ''){
                    console.log($(this).val())
                    itArrTP.push('"' + $(this).attr('id') + '"' + ":" + '"' + $(this).val() + '"')	
    
                    
                }
            });
            $('#modalVerticalBilling select.tp').each(function (i) 
            {
    
                if($(this).val() != ''){
                    console.log($(this).val())
                    itArrTP.push('"' + $(this).attr('id') + '"' + ":" + '"' + $(this).val() + '"')	
    
                    
                }
            });
            otArrTP.push('{' + itArrTP.join(',') + '}');
            let otArrPRICING = []; 
            let itArrPRICING = [];
            //alert($('#modalVerticalPricing input#U_DeliveryOrigin').val())
            $('#modalVerticalBILLING input.pricing').each(function (i) 
            {
    
                //if($(this).val() != ''){
                    console.log($(this).val())
                    itArrPRICING.push('"' + $(this).attr('id') + '"' + ":" + '"' + $(this).val() + '"')	
    
                    
                //}
            });
            $('#modalVerticalBILLING textarea.pricing').each(function (i) 
            {
    
                //if($(this).val() != ''){
                    console.log($(this).val())
                    itArrPRICING.push('"' + $(this).attr('id') + '"' + ":" + '"' + $(this).val() + '"')	
    
                    
                //}
            });
            $('#modalVerticalBILLING select.pricing').each(function (i) 
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
                // UPDATE FUNCTION BY TIN

                let BookingId = $('#modalVerticalBILLING input#U_BookingId').val()
                let BookingDate = $('#modalVerticalBILLING input#U_BookingDate').val()
                let CustomerName = $('#modalVerticalBILLING input#U_CustomerName').val()
                let SAPClient = $('#modalVerticalBILLING input#U_SAPClient').val()
                let GroupProject = $('#modalVerticalBILLING input#U_GroupProject').val()
                let PlateNumber = $('#modalVerticalBILLING input#U_PlateNumber').val()
                let VehicleTypeCap = $('#modalVerticalBILLING input#U_VehicleTypeCap').val()
                let DeliveryOrigin = $('#modalVerticalBILLING textarea#U_DeliveryOrigin').val()
                let Destination = $('#modalVerticalBILLING textarea#U_Destination').val()
                let DeliveryStatus = $('#modalVerticalBILLING input#U_DeliveryStatus').val()
                let DeliveryDatePOD = $('#modalVerticalBILLING input#U_DeliveryDatePOD').val()
                let TripType =  $('#modalVerticalBILLING input#U_TripType').val()
                let TripTicketNo = $('#modalVerticalBILLING input#U_TripTicketNo').val()
                let WayBillNo =  $('#modalVerticalBILLING input#U_WaybillNo').val()
                let ShipmentManifestNo = $('#modalVerticalBILLING input#U_ShipmentManifestNo').val()
                let DeliveryReceiptNo =  $('#modalVerticalBILLING input#U_DeliveryReceiptNo').val()
                let SeriesNo =  $('#modalVerticalBILLING input#U_SeriesNo').val()
                let OtherPODDoc =  $('#modalVerticalBILLING textarea#U_OtherPODDoc').val()
                let RemarksPOD =  $('#modalVerticalBILLING textarea#U_RemarksPOD').val()
                // let txtStreetPOBoxB = $('#txtStreetPOBoxB').val()
                let ActualHCRecDate = $('#modalVerticalBILLING input#U_ActualHCRecDate').val()
                let PODinCharge =  $('#modalVerticalBILLING input#U_PODinCharge').val()
                let VerifiedDateHC =  $('#modalVerticalBILLING input#U_VerifiedDateHC').val()
                let PODStatusDetail =  $('#modalVerticalBILLING input#U_PODStatusDetail').val()
                let PTFNo =  $('#modalVerticalBILLING input#U_PTFNo').val()
                let DateForwardedBT = $('#modalVerticalBILLING input#U_DateForwardedBT').val()
                let BillingDeadline =  $('#modalVerticalBILLING input#U_BillingDeadline').val()
                let BillingStatus =  $('#modalVerticalBILLING select#U_BillingStatus').val()
                let ServiceType =  $('#modalVerticalBILLING input#U_ServiceType').val()
                let SINo =  $('#modalVerticalBILLING input#U_SINo').val()
                let BillingTeam =  $('#modalVerticalBILLING input#U_BillingTeam').val()
                let BTRemarks =  $('#modalVerticalBILLING textarea#U_BTRemarks').val()
                let GrossInitialRate = $('#modalVerticalBILLING input#U_GrossInitialRate').val()
                let Demurrage = $('#modalVerticalBILLING input#U_Demurrage').val()
                let AddCharges = $('#modalVerticalBILLING input#U_AddCharges').val()
                let ActualBilledRate = $('#modalVerticalBILLING input#U_ActualBilledRate').val()
                let RateAdjustments = $('#modalVerticalBILLING input#U_RateAdjustments').val()
                let ActualDemurrage = $('#modalVerticalBILLING input#U_ActualDemurrage').val()
                let ActualAddCharges = $('#modalVerticalBILLING input#U_ActualAddCharges').val()
                let TotalRecClients = $('#modalVerticalBILLING input#U_TotalRecClients').val()
                let CWT2307 = $('#modalVerticalBILLING input#U_CWT2307').val()
                let TotalAR = $('#modalVerticalBILLING input#U_TotalAR').val()
                let VarAR = $('#modalVerticalBILLING input#U_VarAR').val()
                let OutletNo = $('#modalVerticalBILLING input#U_OutletNo').val()
                let CBM = $('#modalVerticalBILLING input#U_CBM').val()
                let SI_DRNo = $('#modalVerticalBILLING input#U_SI_DRNo').val()
                let DeliveryMode = $('#modalVerticalBILLING input#U_DeliveryMode').val()
                let SourceWhse = $('#modalVerticalBILLING input#U_SourceWhse').val()
                let DestinationClient = $('#modalVerticalBILLING textarea#U_DestinationClient').val()
                let TotalInvAmount = $('#modalVerticalBILLING input#U_TotalInvAmount').val()
                let SONo = $('#modalVerticalBILLING input#U_SONo').val()
                let NameCustomer = $('#modalVerticalBILLING input#U_NameCustomer').val()
                let CategoryDR =  $('#modalVerticalBILLING input#U_CategoryDR').val()
                let ForwardLoadNo = $('#modalVerticalBILLING input#U_ForwardLoad').val()
                let BackLoad = $('#modalVerticalBILLING input#U_BackLoad').val()
                let IDNumber =  $('#modalVerticalBILLING input#U_IDNumber').val()
                let TypeOfAccessorial = $('#modalVerticalBILLING input#U_TypeOfAccessorial').val()
                let Status = $('#modalVerticalBILLING input#U_Status').val()
                let TimeInEmptyDem = $('#modalVerticalBILLING input#U_TimeInEmptyDem').val()
                let TimeOutEmptyDem = $('#modalVerticalBILLING input#U_TimeOutEmptyDem').val()
                let VerifiedEmptyDem = $('#modalVerticalBILLING input#U_VerifiedEmptyDem').val()
                let Remarks = $('#modalVerticalBILLING textarea#U_Remarks').val()
                let TimeInAdvLoading = $('#modalVerticalBILLING input#U_TimeInAdvLoading').val()
                let DayOfTheWeek = $('#modalVerticalBILLING input#U_DayOfTheWeek').val()
                let TimeIn = $('#modalVerticalBILLING input#U_TimeIn').val()
                let TimeOut = $('#modalVerticalBILLING input#U_TimeOut').val()
                let TotalExceed = $('#modalVerticalBILLING input#U_TotalExceed').val()
                let ODOIn = $('#modalVerticalBILLING input#U_ODOIn').val()
                let ODOOut = $('#modalVerticalBILLING input#U_ODOOut').val()
                let TotalUsage = $('#modalVerticalBILLING input#U_TotalUsage').val()
                let RowNoVertical = $('#modalVerticalBILLING input#RowNoVertical').val()
                
                console.log(BookingId)
                console.log(BookingDate)
                console.log(CustomerName)
                console.log(SAPClient)
                console.log(GroupProject)
                console.log(PlateNumber)
                console.log(VehicleTypeCap)
                console.log(DeliveryOrigin)
                console.log(Destination)
                console.log(DeliveryStatus)
                console.log(DeliveryDatePOD)
                console.log(TripType)
                console.log(TripTicketNo)
                console.log(WayBillNo)
                console.log(ShipmentManifestNo)
                console.log(DeliveryReceiptNo)
                console.log(SeriesNo)
                console.log(OtherPODDoc)
                console.log(RemarksPOD)
                console.log(ActualHCRecDate)
                console.log(PODinCharge)
                console.log(VerifiedDateHC)
                console.log(PODStatusDetail)
                console.log(PTFNo)
                console.log(DateForwardedBT)
                console.log(BillingStatus)
                console.log(ServiceType)
                console.log(SINo)
                console.log(BillingTeam)
                console.log(BTRemarks)
                console.log(GrossInitialRate)
                console.log(Demurrage)
                console.log(AddCharges)
                console.log(ActualBilledRate)
                console.log(RateAdjustments)
                console.log(ActualDemurrage)
                console.log(ActualAddCharges)
                console.log(TotalRecClients)
                console.log(CWT2307)
                console.log(VarAR)
                console.log(OutletNo)
                console.log(CBM)
                console.log(SI_DRNo)
                console.log(DeliveryMode)
                console.log(SourceWhse)
                console.log(DestinationClient)
                console.log(TotalInvAmount)
                console.log(SONo)
                console.log(NameCustomer)
                console.log(CategoryDR)
                console.log(ForwardLoadNo)
                console.log(BackLoad)
                console.log(IDNumber)
                console.log(TypeOfAccessorial)
                console.log(Status)
                console.log(TimeInEmptyDem)
                console.log(Remarks)
                console.log(TimeInAdvLoading)
                console.log(DayOfTheWeek)
                console.log(TimeIn)
                console.log(TimeOut)
                console.log(TotalExceed)
                console.log(ODOIn)
                console.log(ODOIn)
                console.log(ODOOut)
                console.log(TotalUsage)
                console.log(RowNoVertical)

                $.ajax({
                    type: 'POST',
                    url: '../proc/exec/exec_add_verticalVwTin.php',
                    startTime: performance.now(),
                    data:{
                                BookingId : BookingId ,
                                BookingDate : BookingDate ,
                                CustomerName : CustomerName ,
                                SAPClient : SAPClient ,
                                GroupProject : GroupProject,
                                PlateNumber : PlateNumber,
                                VehicleTypeCap : VehicleTypeCap,
                                DeliveryOrigin : DeliveryOrigin,
                                Destination : Destination,
                                DeliveryStatus : DeliveryStatus,
                                DeliveryDatePOD : DeliveryDatePOD,
                                TripType : TripType,
                                TripTicketNo : TripTicketNo,
                                WayBillNo : WayBillNo,
                                ShipmentManifestNo : ShipmentManifestNo,
                                DeliveryReceiptNo : DeliveryReceiptNo,
                                SeriesNo  : SeriesNo,
                                OtherPODDoc  : OtherPODDoc,
                                RemarksPOD : RemarksPOD,
                                ActualHCRecDate : ActualHCRecDate,
                                PODinCharge : PODinCharge,
                                VerifiedDateHC : VerifiedDateHC,
                                PODStatusDetail : PODStatusDetail,
                                PTFNo : PTFNo,
                                DateForwardedBT : DateForwardedBT,
                                BillingDeadline : BillingDeadline,
                                BillingStatus : BillingStatus,
                                ServiceType : ServiceType,
                                SINo : SINo,
                                BillingTeam : BillingTeam,
                                BTRemarks : BTRemarks,
                                GrossInitialRate : GrossInitialRate,
                                Demurrage : Demurrage,
                                AddCharges: AddCharges,
                                ActualBilledRate : ActualBilledRate,
                                RateAdjustments : RateAdjustments,
                                ActualDemurrage : ActualDemurrage,
                                ActualAddCharges : ActualAddCharges,
                                TotalRecClients : TotalRecClients,
                                CWT2307 : CWT2307,
                                TotalAR : TotalAR,
                                VarAR : VarAR,
                                OutletNo : OutletNo,
                                CBM : CBM,
                                SI_DRNo : SI_DRNo,
                                DeliveryMode : DeliveryMode,
                                SourceWhse : SourceWhse, 
                                DestinationClient : DestinationClient,
                                TotalInvAmount : TotalInvAmount,
                                SONo : SONo,
                                NameCustomer : NameCustomer,
                                CategoryDR : CategoryDR,
                                ForwardLoadNo : ForwardLoadNo,
                                BackLoad : BackLoad,
                                IDNumber : IDNumber,
                                TypeOfAccessorial :  TypeOfAccessorial,
                                Status : Status,
                                TimeInEmptyDem : TimeInEmptyDem  ,
                                TimeOutEmptyDem : TimeOutEmptyDem,
                                VerifiedEmptyDem : VerifiedEmptyDem,
                                Remarks : Remarks,
                                TimeInAdvLoading : TimeInAdvLoading,
                                DayOfTheWeek : DayOfTheWeek,
                                TimeIn : TimeIn ,
                                TimeOut : TimeOut,
                                TotalExceed : TotalExceed,
                                ODOIn : ODOIn,
                                ODOOut : ODOOut,
                                TotalUsage : TotalUsage,
                                RowNoVertical : RowNoVertical, 
                            },
                    		success: function (data){
                    				console.log(data)
                                    
                                    // alert(data)
    
                    				var res = $.parseJSON(data);
                    				// $('#btnfind').trigger('click');
                    				console.log(data.BillingData)
                    				if(res.valid == true)
                    				{
    
                    				// $('#modalVerticalPricing').modal('hide');
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
    
    
    
                    // 	let PricingData = otArrPricing[0]
                    // 	let billingData = otArrBILLING[0]
                    // 	let tpData = otArrTP[0]
                    // 	let pricingData = otArrPRICING[0]
                    // 	console.log(PricingData)	
                    // 	console.log(billingData)	
                    // 	console.log(tpData)	
                    // 	console.log(pricingData)				
                    // 	if(otArrPricing.length != 0){
                    // 		$.ajax({
    
                    //         type: 'POST',
                    //         url: '../proc/exec/exec_update_pctpPricingRow.php',
                    //         startTime: performance.now(),
                    // 		data:{
                    // 			pid: pid,
                    // 			PricingData: PricingData,
                    // 			billingData: billingData,
                    // 			tpData: tpData,
                    // 			pricingData: pricingData
                                
                    // 		},
                    // 		success: function (data){
                    // 				console.log(data)	
    
                    // 				var res = $.parseJSON(data);
                    // 				// $('#btnfind').trigger('click');
                    // 				console.log(data.PricingData)
                    // 				if(res.valid == true)
                    // 				{
    
                    // 				// $('#modalVerticalPricing').modal('hide');
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

		$('#btnUpdatePricingRow').attr('disabled',false)
		$('#btnUpdateBILLINGRow').attr('disabled',false)
		$('#btnUpdateTPRow').attr('disabled',false)
		$('#btnUpdatePRICINGRow').attr('disabled',false)
	}

	function disableButtons(){
		$('#btnUpdatePricingRow').attr('disabled',true)
		$('#btnUpdateBILLINGRow').attr('disabled',true)
		$('#btnUpdateTPRow').attr('disabled',true)
		$('#btnUpdatePRICINGRow').attr('disabled',true)
	}
    
    });
    
    