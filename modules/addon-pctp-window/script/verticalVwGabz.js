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
            
            // Billingtabpane
            // billingtabpane
            // tptabpane
            // pricingtabpane
    
            
    

        })
    
        $(document.body).on('click', '#btnUpdatePricingRowNew', function () 
        {
    
            var err = 0;
            var errmsg = '';
            
            console.log(pid)
    
            let U_VehicleTypeCap = $('#modalVerticalBilling select#U_VehicleTypeCap').val()
            let Pricingstatus = $('#modalVerticalPricing select#U_PricingStatusDetail').val()
            console.log(U_VehicleTypeCap)
            console.log(Pricingstatus)
            if(U_VehicleTypeCap == ''){
                err = 1;
                errmsg = 'Vehicle Type Required!';
            }
    
            if(Pricingstatus == 'Verified'){
                $('#modalVerticalPricing select.Pricingstatusrequired, #modalVerticalPricing input.Pricingstatusrequired').each(function (i) 
                {
    
                    if(Pricingstatus == ''){
                        err += 1;
                        
                    }
                });
            }	
            if(Pricingstatus == 'OngoingVerification'){
                $('#modalVerticalPricing input.ongoingrequired').each(function (i) 
                {
    
                    if(Pricingstatus == ''){
                        err += 1;
                        
                    }
                });
            }	
            if(Pricingstatus == 'OnholdbyPricing'){
                $('#modalVerticalPricing input.onholdrequired').each(function (i) 
                {
    
                    if(Pricingstatus == ''){
                        err += 1;
                        
                    }
                });
            }	
            if(Pricingstatus == 'Returnedtotrucker'){
                $('#modalVerticalPricing input.returnrequired').each(function (i) 
                {
    
                    if(Pricingstatus == ''){
                        err += 1;
                        
                    }
                });
            }	
            if(Pricingstatus == 'PendingHardcopy'){
                $('#modalVerticalPricing input.pendingrequired').each(function (i) 
                {
    
                    if(Pricingstatus == ''){
                        err += 1;
                        
                    }
                });
            }
    
                
                // if($(this).find("td:eq(3)").text() != ''){
                // 	itArrRowsPricing.push('"' + 'U_BookingDate' + '"' + ":" + '"' + validDate($(this).find("td:eq(3)").text().replace(/,/g, '').replace(/"/g, '').replace(/(\r\n|\n|\r)/gm, '').replace(/\t/g, ' ').replace(/'/g,"''")) + '"')					
                // 	otArrPricingNotNullCellsTotal += 1;
                // 	notNullCouterRows += 1;
                // }
            let otArrPricing = []; 
            let itArrPricing = [];
            //alert($('#modalVerticalPricing input#U_DeliveryOrigin').val())
            $('#modalVerticalPricing input:not(.Pricingincharge,.amountNumber,.amount)').each(function (i) 
            {
    
                //if($(this).val() != ''){
                    console.log($(this).val())
                    itArrPricing.push('"' + $(this).attr('id') + '"' + ":" + '"' + $(this).val() + '"')	
    
                    
                //}
            });
            $('#modalVerticalPricing input.amountNumber').each(function (i) 
            {
    
                //if($(this).val() != ''){
                    console.log($(this).val())
                    itArrPricing.push('"' + $(this).attr('id') + '"' + ":" +  $(this).val().replace(/,/g, '') )	
    
                    
                //}
            });
            $('#modalVerticalPricing input.amount').each(function (i) 
            {
    
                //if($(this).val() != ''){
                    console.log($(this).val())
                    itArrPricing.push('"' + $(this).attr('id') + '"' + ":" +  '"' + $(this).val().replace(/,/g, '') + '"' )	
     
                    
                //}
            });
            $('#modalVerticalPricing textarea').each(function (i) 
            {
    
                //if($(this).val() != ''){
                    console.log($(this).val())
                    itArrPricing.push('"' + $(this).attr('id') + '"' + ":" + '"' + $(this).val().replace(/(\r\n|\n|\r)/gm, " ") + '"')	
    
                    
                //}
            });
            $('#modalVerticalPricing select').each(function (i) 
            {
    
                //if($(this).val() != ''){
                    console.log($(this).val())
                    itArrPricing.push('"' + $(this).attr('id') + '"' + ":" + '"' + $(this).val() + '"')	
    
                    
                //}
            });
            otArrPricing.push('{' + itArrBilling.join(',') + '}');
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
            //alert($('#modalVerticalBilling input#U_DeliveryOrigin').val())
            $('#modalVerticalBilling input.pricing').each(function (i) 
            {
    
                //if($(this).val() != ''){
                    console.log($(this).val())
                    itArrPRICING.push('"' + $(this).attr('id') + '"' + ":" + '"' + $(this).val() + '"')	
    
                    
                //}
            });
            $('#modalVerticalBilling textarea.pricing').each(function (i) 
            {
    
                //if($(this).val() != ''){
                    console.log($(this).val())
                    itArrPRICING.push('"' + $(this).attr('id') + '"' + ":" + '"' + $(this).val() + '"')	
    
                    
                //}
            });
            $('#modalVerticalBilling select.pricing').each(function (i) 
            {
    
                //if($(this).val() != ''){
                    console.log($(this).val())
                    itArrPRICING.push('"' + $(this).attr('id') + '"' + ":" + '"' + $(this).val() + '"')	
    
                    
                //}
            });
            otArrPRICING.push('{' + itArrPRICING.join(',') + '}');
    
            
            // console.log(err)
            // if(err == 0){	
    
                
            //     // alert(pid)
            //     // UPDATE FUNCTION BY GABZ
    
            //     let BookingId = $('#U_BookingId').val()
            //     let BookingDate =  $('#U_BookingDate').val()
            //     let BillingNum =  $('#U_BillingNum').val()
            //     let ClientTag =  $('#U_ClientTag').val()
            //     let CustomerName =  $('#U_CustomerName').val()
            //     let ClientProject =  $('#U_ClientProject').val()
            //     let TruckerTag =  $('#U_TruckerTag').val()
            //     let TruckerName =  $('#U_TruckerName').val()
            //     let VehicleTypeCap =  $('#U_VehicleTypeCap').val()
            //     let DeliveryOrigin =  $('#U_DeliveryOrigin').val()
            //     let ISLAND =  $('#U_ISLAND').val()
            //     let Destination =  $('#U_Destination').val()
            //     let IFINTERISLAND =  $('#U_IFINTERISLAND').val()
            //     let DeliveryStatus =  $('#U_DeliveryStatus').val()
            //     let TripType =  $('#U_TripType').val()
            //     let NoOfDrops =  $('#U_NoOfDrops').val()
            //     let RemarksDTR =  $('#U_RemarksDTR').val()
            //     let RemarksBilling =  $('#U_RemarksBilling').val()
            //     let GrossClientRates =  $('#U_GrossClientRates').val()
            //     let RateBasis =  $('#U_RateBasis').val()
            //     let TaxType =  $('#U_TaxType').val()
            //     let GrossTruckerRates =  $('#U_GrossTruckerRates').val()
            //     let GrossTruckerRatesTax =  $('#U_GrossTruckerRatesTax').val()
            //     let RateBasisT =  $('#U_RateBasisT').val()
            //     let TaxTypeT =  $('#U_TaxTypeT').val()
            //     let GrossProfitNet =  $('#U_GrossProfitNet').val()
            //     let Demurrage =  $('#U_Demurrage').val()
            //     let AddtlDrop =  $('#U_AddtlDrop').val()
            //     let BoomTruck =  $('#U_BoomTruck').val()
            //     let Manpower =  $('#U_Manpower').val()
            //     let PTFNo =  $('#U_PTFNo').val()
            //     let Backload =  $('#U_Backload').val()
            //     let TotalAddtlCharges =  $('#U_TotalAddtlCharges').val()
            //     let Demurrage4 =  $('#U_Demurrage4').val()
            //     let AddtlCharges2 =  $('#U_AddtlCharges2').val()
            //     let Demurrage2 =  $('#U_Demurrage2').val()
            //     let AddtlDrop2 =  $('#U_AddtlDrop2').val()
            //     let BoomTruck2 =  $('#U_BoomTruck2').val()
            //     let Manpower2 =  $('#U_Manpower2').val()
            //     let Backload2 =  $('#U_Backload2').val()
            //     let totalAddtlCharges2 =  $('#U_totalAddtlCharges2').val()
            //     let Demurrage3 =  $('#U_Demurrage3').val()
            //     let GrossProfit =  $('#U_GrossProfit').val()
            //     let TotalInitialClient =  $('#U_TotalInitialClient').val()
            //     let TotalInitialTruckers =  $('#U_TotalInitialTruckers').val()
            //     let TotalGrossProfit =  $('#U_TotalGrossProfit').val()
            //     let RowNoVertical =  $('#RowNoVertical').val()

                
            //     console.log(BookingId)
            //     console.log(BookingDate)
            //     console.log(BillingNum)
            //     console.log(ClientTag)
            //     console.log(CustomerName)
            //     console.log(ClientProject)
            //     console.log(TruckerTag)
            //     console.log(TruckerName)
            //     console.log(VehicleTypeCap)
            //     console.log(DeliveryOrigin)
            //     console.log(ISLAND)
            //     console.log(Destination)
            //     console.log(IFINTERISLAND)
            //     console.log(DeliveryStatus)
            //     console.log(TripType)
            //     console.log(NoOfDrops)
            //     console.log(RemarksDTR)
            //     console.log(RemarksBilling)
            //     console.log(GrossClientRates)
            //     console.log(RateBasis)
            //     console.log(TaxType)
            //     console.log(GrossTruckerRates)
            //     console.log(GrossTruckerRatesTax)
            //     console.log(RateBasisT)
            //     console.log(TaxTypeT)
            //     console.log(GrossProfitNet)
            //     console.log(Demurrage)
            //     console.log(AddtlDrop)
            //     console.log(BoomTruck)
            //     console.log(Manpower)
            //     console.log(PTFNo)
            //     console.log(Backload)
            //     console.log(TotalAddtlCharges)
            //     console.log(AddtlCharges2)
            //     console.log(Demurrage2)
            //     console.log(Demurrage4)
            //     console.log(AddtlDrop2)
            //     console.log(BoomTruck2)
            //     console.log(Manpower2)
            //     console.log(Backload2)
            //     console.log(totalAddtlCharges2)
            //     console.log(Demurrage3)
            //     console.log(GrossProfit)
            //     console.log(TotalInitialClient)
            //     console.log(TotalInitialTruckers)
            //     console.log(TotalGrossProfit)
            //     console.log(RowNoVertical)

            //     $.ajax({
            //                 type: 'POST',
            //                 url: '../proc/exec/exec_add_verticalVwGabz.php',
            //                 startTime: performance.now(),
            //         		data:{
                                
            //                     U_ClientReceivedDate : U_ClientReceivedDate ,
            //                     U_ActualDateRec_Intitial : U_ActualDateRec_Intitial,
            //                     U_InitialHCRecDate : U_InitialHCRecDate,
            //         			BookingId: BookingId,
            //                     BookingDate : BookingDate,
            //         			BillingNum : BillingNum,
            //         			ClientTag : ClientTag,
            //         			CustomerName : CustomerName,
            //         			ClientProject  : ClientProject,
            //         			TruckerTag  : TruckerTag,
            //         			TruckerName  : TruckerName,
            //         			VehicleTypeCap  : VehicleTypeCap,
            //         			DeliveryOrigin : DeliveryOrigin,
            //         			ISLAND : ISLAND,
            //         			Destination : Destination,
            //         			IFINTERISLAND : IFINTERISLAND,
            //         			DeliveryStatus : DeliveryStatus,
            //         			TripType : TripType,
            //         			NoOfDrops : NoOfDrops,
            //         			RemarksDTR : RemarksDTR,
            //         			RemarksBilling : RemarksBilling,
            //         			GrossClientRates : GrossClientRates,
            //         			RateBasis : RateBasis,
            //         			TaxType : TaxType,
            //         			GrossTruckerRates : GrossTruckerRates,
            //         			GrossTruckerRatesTax : GrossTruckerRatesTax,
            //         			RateBasisT : RateBasisT,
            //         			TaxTypeT : TaxTypeT,
            //         			GrossProfitNet : GrossProfitNet,
            //         			Demurrage : Demurrage,
            //         			AddtlDrop : AddtlDrop,
            //         			BoomTruck : BoomTruck,
            //         			Manpower : Manpower,
            //         			PTFNo : PTFNo,
            //         			Backload : Backload,
            //         			PTFNo : PTFNo,
            //         			TotalAddtlCharges : TotalAddtlCharges,
            //         			Demurrage4 : Demurrage4,
            //         			AddtlCharges2 : AddtlCharges2,
            //         			Demurrage2 : Demurrage2,
            //         			AddtlDrop2 : AddtlDrop2,
            //         			BoomTruck2 : BoomTruck2,
            //         			Manpower2 : Manpower2,
            //         			Backload2 : Backload2,
            //         			totalAddtlCharges2 : totalAddtlCharges2,
            //         			Demurrage3 : Demurrage3,
            //         			GrossProfit : GrossProfit,
            //         			TotalInitialClient : TotalInitialClient,
            //         			TotalInitialTruckers : TotalInitialTruckers,
            //         			TotalGrossProfit : TotalGrossProfit,
            //         			RowNoVertical : RowNoVertical
            //         		},
            //         		success: function (data){
            //         				console.log(data)	
    
            //         				var res = $.parseJSON(data);
            //         				// $('#btnfind').trigger('click');
            //         				console.log(data.BillingData)
            //         				if(res.valid == true)
            //         				{
    
            //         				// $('#modalVerticalBilling').modal('hide');
            //         				$('#messageBar2').addClass('d-none');
            //         				$('#messageBar3').removeClass('d-none');
            //         				$('#messageBar').text(res.msg).css({'background-color': '#00FF7F', 'color': 'black'});
                                    
                                    
            //         					setTimeout(function()
            //         					{
            //         						$('#messageBar').text('').css({'background-color': '', 'color': ''});	
                                            
            //         						//window.location.replace("../templates/delivery-document.php");
            //         					},3000)
            //         				}else{
    
            //         				}
            //                 },
            //                 complete: function (data) {
                                
                            
    
            //         				}
            //          		});
            //         	}else{
    
            //         	}



                        $(document.body).on('click', '#btnUpdatePricingRowNew', function () 
                        {
                    
                            var err = 0;
                            var errmsg = '';
                            let otArrPricing = []; 
                    
                    
                                
                            let itArrPricing = [];
                            $('#modalVerticalPricing select').each(function (i) 
                            {
                    
                                if($(this).val() != ''){
                                    console.log($(this).val())
                                    itArrPricing.push('"' + $(this).attr('id') + '"' + ":" + '"' + $(this).val() + '"')	
                    
                                    
                                }
                            });
                            $('#modalVerticalPricing input.pricingeditable').each(function (i) 
                            {
                    
                                if($(this).val() != ''){
                                    console.log($(this).val())
                                    itArrPricing.push('"' + $(this).attr('id') + '"' + ":" +  $(this).val().replace(/,/g, ''))	
                    
                                    
                                }
                            });
                            otArrPricing.push('{' + itArrPricing.join(',') + '}');
                    
                            
                            if(err == 0){
                                

                let BookingId = $('#U_BookingId').val()
                let BookingDate =  $('#U_BookingDate').val()
                let BillingNum =  $('#U_BillingNum').val()
                let ClientTag =  $('#U_ClientTag').val()
                let CustomerName =  $('#U_CustomerName').val()
                let ClientProject =  $('#U_ClientProject').val()
                let TruckerTag =  $('#U_TruckerTag').val()
                let TruckerName =  $('#U_TruckerName').val()
                let VehicleTypeCap =  $('#U_VehicleTypeCap').val()
                let DeliveryOrigin =  $('#U_DeliveryOrigin').val()
                let ISLAND =  $('#U_ISLAND').val()
                let Destination =  $('#U_Destination').val()
                let IFINTERISLAND =  $('#U_IFINTERISLAND').val()
                let DeliveryStatus =  $('#U_DeliveryStatus').val()
                let TripType =  $('#U_TripType').val()
                let NoOfDrops =  $('#U_NoOfDrops').val()
                let RemarksDTR =  $('#U_RemarksDTR').val()
                let RemarksBilling =  $('#U_RemarksBilling').val()
                let GrossClientRates =  $('#U_GrossClientRates').val()
                let RateBasis =  $('#U_RateBasis').val()
                let TaxType =  $('#U_TaxType').val()
                let GrossTruckerRates =  $('#U_GrossTruckerRates').val()
                let GrossTruckerRatesTax =  $('#U_GrossTruckerRatesTax').val()
                let RateBasisT =  $('#U_RateBasisT').val()
                let TaxTypeT =  $('#U_TaxTypeT').val()
                let GrossProfitNet =  $('#U_GrossProfitNet').val()
                let Demurrage =  $('#U_Demurrage').val()
                let AddtlDrop =  $('#U_AddtlDrop').val()
                let BoomTruck =  $('#U_BoomTruck').val()
                let Manpower =  $('#U_Manpower').val()
                let PTFNo =  $('#U_PTFNo').val()
                let Backload =  $('#U_Backload').val()
                let TotalAddtlCharges =  $('#U_TotalAddtlCharges').val()
                let Demurrage4 =  $('#U_Demurrage4').val()
                let AddtlCharges2 =  $('#U_AddtlCharges2').val()
                let Demurrage2 =  $('#U_Demurrage2').val()
                let AddtlDrop2 =  $('#U_AddtlDrop2').val()
                let BoomTruck2 =  $('#U_BoomTruck2').val()
                let Manpower2 =  $('#U_Manpower2').val()
                let Backload2 =  $('#U_Backload2').val()
                let totalAddtlCharges2 =  $('#U_totalAddtlCharges2').val()
                let Demurrage3 =  $('#U_Demurrage3').val()
                let GrossProfit =  $('#U_GrossProfit').val()
                let TotalInitialClient =  $('#U_TotalInitialClient').val()
                let TotalInitialTruckers =  $('#U_TotalInitialTruckers').val()
                let TotalGrossProfit =  $('#U_TotalGrossProfit').val()
                let RowNoVertical =  $('#RowNoVertical').val()

                
                console.log(BookingId)
                console.log(BookingDate)
                console.log(BillingNum)
                console.log(ClientTag)
                console.log(CustomerName)
                console.log(ClientProject)
                console.log(TruckerTag)
                console.log(TruckerName)
                console.log(VehicleTypeCap)
                console.log(DeliveryOrigin)
                console.log(ISLAND)
                console.log(Destination)
                console.log(IFINTERISLAND)
                console.log(DeliveryStatus)
                console.log(TripType)
                console.log(NoOfDrops)
                console.log(RemarksDTR)
                console.log(RemarksBilling)
                console.log(GrossClientRates)
                console.log(RateBasis)
                console.log(TaxType)
                console.log(GrossTruckerRates)
                console.log(GrossTruckerRatesTax)
                console.log(RateBasisT)
                console.log(TaxTypeT)
                console.log(GrossProfitNet)
                console.log(Demurrage)
                console.log(AddtlDrop)
                console.log(BoomTruck)
                console.log(Manpower)
                console.log(PTFNo)
                console.log(Backload)
                console.log(TotalAddtlCharges)
                console.log(AddtlCharges2)
                console.log(Demurrage2)
                console.log(Demurrage4)
                console.log(AddtlDrop2)
                console.log(BoomTruck2)
                console.log(Manpower2)
                console.log(Backload2)
                console.log(totalAddtlCharges2)
                console.log(Demurrage3)
                console.log(GrossProfit)
                console.log(TotalInitialClient)
                console.log(TotalInitialTruckers)
                console.log(TotalGrossProfit)
                console.log(RowNoVertical)

                $.ajax({
                            type: 'POST',
                            url: '../proc/exec/exec_add_verticalVwGabz.php',
                            startTime: performance.now(),
                    		data:{
                                
                                U_ClientReceivedDate : U_ClientReceivedDate ,
                                U_ActualDateRec_Intitial : U_ActualDateRec_Intitial,
                                U_InitialHCRecDate : U_InitialHCRecDate,
                    			BookingId: BookingId,
                                BookingDate : BookingDate,
                    			BillingNum : BillingNum,
                    			ClientTag : ClientTag,
                    			CustomerName : CustomerName,
                    			ClientProject  : ClientProject,
                    			TruckerTag  : TruckerTag,
                    			TruckerName  : TruckerName,
                    			VehicleTypeCap  : VehicleTypeCap,
                    			DeliveryOrigin : DeliveryOrigin,
                    			ISLAND : ISLAND,
                    			Destination : Destination,
                    			IFINTERISLAND : IFINTERISLAND,
                    			DeliveryStatus : DeliveryStatus,
                    			TripType : TripType,
                    			NoOfDrops : NoOfDrops,
                    			RemarksDTR : RemarksDTR,
                    			RemarksBilling : RemarksBilling,
                    			GrossClientRates : GrossClientRates,
                    			RateBasis : RateBasis,
                    			TaxType : TaxType,
                    			GrossTruckerRates : GrossTruckerRates,
                    			GrossTruckerRatesTax : GrossTruckerRatesTax,
                    			RateBasisT : RateBasisT,
                    			TaxTypeT : TaxTypeT,
                    			GrossProfitNet : GrossProfitNet,
                    			Demurrage : Demurrage,
                    			AddtlDrop : AddtlDrop,
                    			BoomTruck : BoomTruck,
                    			Manpower : Manpower,
                    			PTFNo : PTFNo,
                    			Backload : Backload,
                    			PTFNo : PTFNo,
                    			TotalAddtlCharges : TotalAddtlCharges,
                    			Demurrage4 : Demurrage4,
                    			AddtlCharges2 : AddtlCharges2,
                    			Demurrage2 : Demurrage2,
                    			AddtlDrop2 : AddtlDrop2,
                    			BoomTruck2 : BoomTruck2,
                    			Manpower2 : Manpower2,
                    			Backload2 : Backload2,
                    			totalAddtlCharges2 : totalAddtlCharges2,
                    			Demurrage3 : Demurrage3,
                    			GrossProfit : GrossProfit,
                    			TotalInitialClient : TotalInitialClient,
                    			TotalInitialTruckers : TotalInitialTruckers,
                    			TotalGrossProfit : TotalGrossProfit,
                    			RowNoVertical : RowNoVertical
                                            }
                                })


                            }
                        //     else{
                        //         $('#messageBar2').addClass('d-none');
                        //         $('#messageBar3').removeClass('d-none');
                        //         $('#messageBar').text(errmsg).css({'background-color': 'red', 'color': 'white'});
                                
                        //             setTimeout(function()
                        //             {
                        //                 $('#messageBar').text('').css({'background-color': '', 'color': ''});	
                        //                 $('#messageBar2').removeClass('d-none');
                        //             },5000)
                        //     }
                        
                    
                                        
                        })
                
                // ///////////////////////////////////////////////////////////////
    
    
    
                    // 	let BillingData = otArrBilling[0]
                    // 	let billingData = otArrBILLING[0]
                    // 	let tpData = otArrTP[0]
                    // 	let pricingData = otArrPRICING[0]
                    // 	console.log(BillingData)	
                    // 	console.log(billingData)	
                    // 	console.log(tpData)	
                    // 	console.log(pricingData)				
                    // 	if(otArrBilling.length != 0){
                    // 		$.ajax({
    
                    //         type: 'POST',
                    //         url: '../proc/exec/exec_update_pctpBillingRow.php',
                    //         startTime: performance.now(),
                    // 		data:{
                    // 			pid: pid,
                    // 			BillingData: BillingData,
                    // 			billingData: billingData,
                    // 			tpData: tpData,
                    // 			pricingData: pricingData
                                
                    // 		},
                    // 		success: function (data){
                    // 				console.log(data)	
    
                    // 				var res = $.parseJSON(data);
                    // 				// $('#btnfind').trigger('click');
                    // 				console.log(data.BillingData)
                    // 				if(res.valid == true)
                    // 				{
    
                    // 				// $('#modalVerticalBilling').modal('hide');
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

		$('#btnUpdateBillingRow').attr('disabled',false)
		$('#btnUpdateBILLINGRow').attr('disabled',false)
		$('#btnUpdateTPRow').attr('disabled',false)
		$('#btnUpdatePRICINGRow').attr('disabled',false)
	}

	function disableButtons(){
		$('#btnUpdateBillingRow').attr('disabled',true)
		$('#btnUpdateBILLINGRow').attr('disabled',true)
		$('#btnUpdateTPRow').attr('disabled',true)
		$('#btnUpdatePRICINGRow').attr('disabled',true)
	}
    
    });
    
    