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
            
            // Tptabpane
            // billingtabpane
            // tptabpane
            // pricingtabpane
    
            if(tabId == 'Tptabpane'){
                $('#modalVerticalTP').modal('show')
                $('#modalVerticalTP input#RowNoVertical').val(row)	
            }
    

        })
    
        $(document.body).on('click', '#btnUpdateTPRowNew', function () 
        {
    
            var err = 0;
            var errmsg = '';
            
            console.log(pid)
    
            let VehicleTypeCap = $('#modalVerticalTP select#U_VehicleTypeCap').val()
            let TPStatus = $('#modalVerticalTP select#U_tpstatusDetail').val()
            console.log(U_VehicleTypeCap)
            console.log(TPStatus)
            if(U_VehicleTypeCap == ''){
                err = 1;
                errmsg = 'Vehicle Type Required!';
                
            }
    
            if(TPStatus == 'Verified'){
                $('#modalVerticalTP select.Tpstatusrequired, #modalVerticalTP input.Tpstatusrequired').each(function (i) 
                {
    
                    if(TPStatus == ''){
                        err += 1;
                        
                    }
                });
            }	
            if(TPStatus == 'OngoingVerification'){
                $('#modalVerticalTP input.ongoingrequired').each(function (i) 
                {
    
                    if(TPStatus == ''){
                        err += 1;
                        
                    }
                });
            }	
            if(TPStatus == 'OnholdbyTp'){
                $('#modalVerticalTP input.onholdrequired').each(function (i) 
                {
    
                    if(Tpstatus == ''){
                        err += 1;
                        
                    }
                });
            }	
            if(TPStatus == 'Returnedtotrucker'){
                $('#modalVerticalTP input.returnrequired').each(function (i) 
                {
    
                    if(Tpstatus == ''){
                        err += 1;
                        
                    }
                });
            }	
            if(TPStatus == 'PendingHardcopy'){
                $('#modalVerticalTP input.pendingrequired').each(function (i) 
                {
    
                    if(TPStatus == ''){
                        err += 1;
                        
                    }
                });
            }
    
                
                // if($(this).find("td:eq(3)").text() != ''){
                // 	itArrRowsTp.push('"' + 'U_BookingDate' + '"' + ":" + '"' + validDate($(this).find("td:eq(3)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")) + '"')					
                // 	otArrTpNotNullCellsTotal += 1;
                // 	notNullCouterRows += 1;
                // }
            let otArrTp = []; 
            let itArrTp = [];
            //alert($('#modalVerticalTP input#U_DeliveryOrigin').val())
            $('#modalVerticalTP input:not(.Tpincharge,.amountNumber,.amount)').each(function (i) 
            {
    
                //if($(this).val() != ''){
                    console.log($(this).val())
                    itArrTp.push('"' + $(this).attr('id') + '"' + ":" + '"' + $(this).val() + '"')	
    
                    
                //}
            });
            $('#modalVerticalTP input.amountNumber').each(function (i) 
            {
    
                //if($(this).val() != ''){
                    console.log($(this).val())
                    itArrTp.push('"' + $(this).attr('id') + '"' + ":" +  $(this).val().replace(/,/g, '') )	
    
                    
                //}
            });
            $('#modalVerticalTP input.amount').each(function (i) 
            {
    
                //if($(this).val() != ''){
                    console.log($(this).val())
                    itArrTp.push('"' + $(this).attr('id') + '"' + ":" +  '"' + $(this).val().replace(/,/g, '') + '"' )	
     
                    
                //}
            });
            $('#modalVerticalTP textarea').each(function (i) 
            {
    
                //if($(this).val() != ''){
                    console.log($(this).val())
                    itArrTp.push('"' + $(this).attr('id') + '"' + ":" + '"' + $(this).val().replace(/(\r\n|\n|\r)/gm, " ") + '"')	
    
                    
                //}
            });
            $('#modalVerticalTP select').each(function (i) 
            {
    
                //if($(this).val() != ''){
                    console.log($(this).val())
                    itArrTp.push('"' + $(this).attr('id') + '"' + ":" + '"' + $(this).val() + '"')	
    
                    
                //}
            });
            otArrTp.push('{' + itArrTp.join(',') + '}');
            let otArrBILLING = [];
            let itArrBILLING = [];
            $('#modalVerticalTP input.billing').each(function (i) 
            {
    
                if($(this).val() != ''){
                    console.log($(this).val())
                    itArrBILLING.push('"' + $(this).attr('id') + '"' + ":" + '"' + $(this).val() + '"')	
    
                    
                }
            });
            $('#modalVerticalTP select.billing').each(function (i) 
            {
    
                if($(this).val() != ''){
                    console.log($(this).val())
                    itArrBILLING.push('"' + $(this).attr('id') + '"' + ":" + '"' + $(this).val() + '"')	
    
                    
                }
            });
            otArrBILLING.push('{' + itArrBILLING.join(',') + '}');
            let otArrTP = [];
            let itArrTP = [];
            $('#modalVerticalTP input.tp').each(function (i) 
            {
    
                if($(this).val() != ''){
                    console.log($(this).val())
                    itArrTP.push('"' + $(this).attr('id') + '"' + ":" + '"' + $(this).val() + '"')	
    
                    
                }
            });
            $('#modalVerticalTP select.tp').each(function (i) 
            {
    
                if($(this).val() != ''){
                    console.log($(this).val())
                    itArrTP.push('"' + $(this).attr('id') + '"' + ":" + '"' + $(this).val() + '"')	
    
                    
                }
            });
            otArrTP.push('{' + itArrTP.join(',') + '}');
            let otArrPRICING = []; 
            let itArrPRICING = [];
            //alert($('#modalVerticalTP input#U_DeliveryOrigin').val())
            $('#modalVerticalTP input.pricing').each(function (i) 
            {
    
                //if($(this).val() != ''){
                    console.log($(this).val())
                    itArrPRICING.push('"' + $(this).attr('id') + '"' + ":" + '"' + $(this).val() + '"')	
    
                    
                //}
            });
            $('#modalVerticalTP textarea.pricing').each(function (i) 
            {
    
                //if($(this).val() != ''){
                    console.log($(this).val())
                    itArrPRICING.push('"' + $(this).attr('id') + '"' + ":" + '"' + $(this).val() + '"')	
    
                    
                //}
            });
            $('#modalVerticalTP select.pricing').each(function (i) 
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
                

                
                let OtherPODDoc = $('#modalVerticalTP textarea#U_OtherPODDoc').val()
                let BookingId = $('#modalVerticalTP input#U_BookingId').val()
                let BookingDate =  $('#U_BookingDate').val()
                let ClientName =  $('#U_ClientName').val()
                let TruckerName =  $('#U_TruckerName').val()
                let TruckerSAP =  $('#U_TruckerSAP').val()
                let DeliveryStatus =  $('#U_DeliveryStatus').val()
                // let txtStreetPOBoxB =  $('#txtStreetPOBoxB').val()
                let WaybillNo =  $('#U_WaybillNo').val()
                let ShipmentManifestNo =  $('#U_ShipmentManifestNo').val()
                let DeliveryReceiptNo =  $('#U_DeliveryReceiptNo').val()
                let SeriesNo =  $('#U_SeriesNo').val()
                let TPincharge =  $('#U_TPincharge').val()
                let Aging =  $('#U_Aging').val()
                let DeliveryDatePOD =  $('#U_DeliveryDatePOD').val()
                let GrossTruckerRates =  $('#U_GrossTruckerRates').val()
                let GrossTruckerRatesN =  $('#U_GrossTruckerRatesN').val()
                let RateBasis =  $('#U_RateBasis').val()
                let TaxType =  $('#U_TaxType').val()
                let Demurrage =  $('#U_Demurrage').val() 
                let AddtlDrop =  $('#U_AddtlDrop').val()
                let BoomTruck =  $('#U_BoomTruck').val()
                let Manpower =  $('#U_Manpower').val()
                let BackLoad =  $('#U_BackLoad').val()
                let Addtlcharges =  $('#U_Addtlcharges').val()
                let DemurrageN =  $('#U_DemurrageN').val()
                let AddtlChargesN =  $('#U_AddtlChargesN').val()
                let ActualRates =  $('#U_ActualRates').val()
                let RateAdjustments =  $('#U_RateAdjustments').val()
                let ActualDemurrage =  $('#U_ActualDemurrage').val()
                let ActualCharges =  $('#U_ActualCharges').val()
                let BoomTruck2 =  $('#U_BoomTruck2').val()
                let OtherCharges =  $('#U_OtherCharges').val()
                let TotalSubPenalty =  $('#U_TotalSubPenalty').val()
                let TotalPenaltyWaived =  $('#U_TotalPenaltyWaived').val()
                let TotalPenalty =  $('#U_TotalPenalty').val()
                let CAandDP =  $('#U_CAandDP').val()
                let Interest =  $('#U_Interest').val()
                let OtherDeductions =  $('#U_OtherDeductions').val()
                let TOTALDEDUCTIONS =  $('#U_TOTALDEDUCTIONS').val()
                let REMARKS1 =  $('#U_REMARKS1').val()
                let TotalPayable =  $('#U_TotalPayable').val()
                let EWT2307 =  $('#U_EWT2307').val()
                let TotalAP =  $('#U_TotalAP').val()
                let VarTP =  $('#U_VarTP').val()
                let TotalPayableRec =  $('#U_TotalPayableRec').val()
                let PVNo =  $('#U_PVNo').val()
                let ORRefNo =  $('#U_ORRefNo').val()
                let ActualPaymentDate =  $('#U_ActualPaymentDate').val()
                let PaymentReference =  $('#U_PaymentReference').val()
                let PaymentStatus =  $('#U_PaymentStatus').val()
                let Remarks =  $('#U_Remarks').val()
                let RowNoVertical =  $('#RowNoVertical').val()
                let TPStatus =  $('#U_TPStatus').val()
                


                // alert(REMARKS1)
                // alert(BookingId)
                console.log(BookingId)
                console.log(BookingDate)
                console.log(ClientName)
                console.log(TruckerName)
                console.log(TruckerSAP)
                console.log(DeliveryStatus)
                // console.log(txtStreetPOBoxB)
                console.log(OtherPODDoc)
                console.log(WaybillNo) 
                console.log(ShipmentManifestNo)
                console.log(DeliveryReceiptNo)
                console.log(SeriesNo)
                console.log(TPincharge)
                console.log(Aging)
                console.log(GrossTruckerRates)
                console.log(GrossTruckerRatesN)
                console.log(RateBasis)
                console.log(TaxType)
                console.log(Demurrage)
                console.log(AddtlDrop)
                console.log(BoomTruck)
                console.log(Manpower)
                console.log(BackLoad)
                console.log(Addtlcharges)
                console.log(DemurrageN)
                console.log(AddtlChargesN)
                console.log(ActualRates)
                console.log(RateAdjustments)
                console.log(ActualDemurrage)
                console.log(ActualCharges)
                console.log(BoomTruck2)
                console.log(OtherCharges)
                console.log(TotalSubPenalty)
                console.log(TotalPenaltyWaived)
                console.log(TotalPenalty)
                console.log(CAandDP)
                console.log(Interest)
                console.log(OtherDeductions)
                console.log(TOTALDEDUCTIONS)
                console.log(REMARKS1)
                console.log(TotalPayable)
                console.log(EWT2307)
                console.log(DeliveryDatePOD)
                console.log(TotalAP)
                console.log(VarTP)
                console.log(TotalPayableRec)
                console.log(PVNo)
                console.log(ORRefNo)
                console.log(ActualPaymentDate)
                console.log(PaymentReference)
                console.log(PaymentStatus)
                console.log(Remarks)
                console.log(RowNoVertical)
                console.log(TPStatus)




                $.ajax({
                            type: 'POST',
                            url: '../proc/exec/exec_add_verticalVw_Karl.php',
                            startTime: performance.now(),
                    		data:{
                                
                              
                    			BookingId : BookingId,
                                BookingDate : BookingDate,
                                ClientName : ClientName,
                                TruckerName : TruckerName,
                                TruckerSAP :TruckerSAP,
                                DeliveryStatus : DeliveryStatus,
                                // txtStreetPOBoxB : txtStreetPOBoxB,
                                
                                WaybillNo : WaybillNo,
                                ShipmentManifestNo : ShipmentManifestNo,
                                DeliveryReceiptNo : DeliveryReceiptNo,
                                SeriesNo : SeriesNo,
                                TPincharge : TPincharge,
                                OtherPODDoc : OtherPODDoc,
                                Aging : Aging,
                                GrossTruckerRates : GrossTruckerRates,
                                GrossTruckerRatesN : GrossTruckerRatesN,
                                RateBasis : RateBasis,
                                DeliveryDatePOD : DeliveryDatePOD,
                                TaxType : TaxType,
                                Demurrage : Demurrage,
                                AddtlDrop : AddtlDrop,
                                BoomTruck : BoomTruck,
                                Manpower : Manpower,
                                BackLoad : BackLoad,
                                Addtlcharges : Addtlcharges,
                                DemurrageN : DemurrageN,
                                AddtlChargesN : AddtlChargesN,
                                ActualRates : ActualRates,
                                RateAdjustments : RateAdjustments,
                                ActualDemurrage : ActualDemurrage,
                                ActualCharges : ActualCharges,
                                BoomTruck2 : BoomTruck2,
                                OtherCharges : OtherCharges,
                                TotalSubPenalty : TotalSubPenalty,
                                TotalPenaltyWaived : TotalPenaltyWaived,
                                TotalPenalty : TotalPenalty,
                                CAandDP : CAandDP,
                                Interest : Interest,
                                OtherDeductions : OtherDeductions,
                                TOTALDEDUCTIONS : TOTALDEDUCTIONS,
                                REMARKS1 : REMARKS1,
                                TotalPayable : TotalPayable,
                                EWT2307 : EWT2307,
                                TotalAP : TotalAP,
                                VarTP : VarTP,
                                TotalPayableRec : TotalPayableRec,
                                PVNo : PVNo,
                                ORRefNo : ORRefNo,
                                ActualPaymentDate : ActualPaymentDate,
                                PaymentReference : PaymentReference,
                                PaymentStatus : PaymentStatus,
                                Remarks : Remarks,
                                RowNoVertical : RowNoVertical,
                                TPStatus : TPStatus,
                    		},
                    		success: function (data){
                    				console.log(data)	
    
                    				var res = $.parseJSON(data);
                    				// $('#btnfind').trigger('click');
                    				console.log(data.TPData)
                    				if(res.valid == true)
                    				{
    
                    				// $('#modalVerticalTP').modal('hide');
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
    
    
    
                    // 	let TpData = otArrTp[0]
                    // 	let billingData = otArrBILLING[0]
                    // 	let tpData = otArrTP[0]
                    // 	let pricingData = otArrPRICING[0]
                    // 	console.log(TpData)	
                    // 	console.log(billingData)	
                    // 	console.log(tpData)	
                    // 	console.log(pricingData)				
                    // 	if(otArrTp.length != 0){
                    // 		$.ajax({
    
                    //         type: 'POST',
                    //         url: '../proc/exec/exec_update_pctpTpRow.php',
                    //         startTime: performance.now(),
                    // 		data:{
                    // 			pid: pid,
                    // 			TpData: TpData,
                    // 			billingData: billingData,
                    // 			tpData: tpData,
                    // 			pricingData: pricingData
                                
                    // 		},
                    // 		success: function (data){
                    // 				console.log(data)	
    
                    // 				var res = $.parseJSON(data);
                    // 				// $('#btnfind').trigger('click');
                    // 				console.log(data.TpData)
                    // 				if(res.valid == true)
                    // 				{
    
                    // 				// $('#modalVerticalTP').modal('hide');
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

		$('#btnUpdateTpRow').attr('disabled',false)
		$('#btnUpdateBILLINGRow').attr('disabled',false)
		$('#btnUpdateTPRow').attr('disabled',false)
		$('#btnUpdatePRICINGRow').attr('disabled',false)
	}

	function disableButtons(){
		$('#btnUpdateTpRow').attr('disabled',true)
		$('#btnUpdateBILLINGRow').attr('disabled',true)
		$('#btnUpdateTPRow').attr('disabled',true)
		$('#btnUpdatePRICINGRow').attr('disabled',true)
	}
    
    });
    
    