-- Executed on 2024-01-17 09:53:12pm 
DECLARE @BookingIdsCSV NVARCHAR(MAX);
SET @BookingIdsCSV = SUBSTRING((
    SELECT  
        CONCAT(', ', T0.U_BookingNumber) AS [text()]
    FROM [dbo].[@PCTP_POD] T0  WITH (NOLOCK)
    WHERE T0.U_BookingNumber IN ('I23404214AFK')
    FOR XML PATH (''), TYPE).value('text()[1]','nvarchar(max)'), 2, 10000000
);

UPDATE [@FirstratesTP] 
SET U_Amount = NULL
WHERE U_Amount = 'NaN' AND U_BN IN ('I23404214AFK');

UPDATE [@FirstratesTP] 
SET U_AddlAmount = NULL
WHERE U_AddlAmount = 'NaN' AND U_BN IN ('I23404214AFK');

DELETE FROM PCTP_UNIFIED WHERE U_BookingNumber IN ('I23404214AFK');

INSERT INTO PCTP_UNIFIED
SELECT su_Code, po_Code, bi_Code, tp_Code, pr_Code, po_DisableTableRow, bi_DisableTableRow, tp_DisableTableRow, bi_DisableSomeFields, tp_DisableSomeFields, pr_DisableSomeFields, pr_DisableSomeFields2, U_BookingDate, 
        U_BookingNumber, bi_U_PODNum, tp_U_PODNum, pr_U_PODNum, U_PODSONum, U_CustomerName, U_GrossClientRates, U_GrossInitialRate, U_Demurrage, tp_U_Demurrage, tp_U_AddtlDrop, pr_U_AddtlDrop, 
        tp_U_BoomTruck, pr_U_BoomTruck, tp_U_BoomTruck2, pr_U_BoomTruck2, U_TPBoomTruck2, tp_U_Manpower, pr_U_Manpower, po_U_BackLoad, tp_U_BackLoad, pr_U_BackLoad, U_TotalAddtlCharges, U_Demurrage2, U_AddtlDrop2, 
        U_Manpower2, U_Backload2, U_totalAddtlCharges2, U_Demurrage3, U_GrossProfit, tp_U_Addtlcharges, pr_U_Addtlcharges, U_DemurrageN, U_AddtlChargesN, U_ActualRates, tp_U_RateAdjustments, bi_U_RateAdjustments, 
        U_TPRateAdjustments, bi_U_ActualDemurrage, tp_U_ActualDemurrage, U_TPActualDemurrage, U_ActualCharges, U_OtherCharges, U_AddCharges, U_ActualBilledRate, U_BillingRateAdjustments, U_BillingActualDemurrage, 
        U_ActualAddCharges, U_GrossClientRatesTax, U_GrossTruckerRates, tp_U_RateBasis, pr_U_RateBasis, U_GrossTruckerRatesN, tp_U_TaxType, pr_U_TaxType, U_GrossTruckerRatesTax, U_RateBasisT, U_TaxTypeT, U_Demurrage4, 
        U_AddtlCharges2, U_GrossProfitC, U_GrossProfitNet, U_TotalInitialClient, U_TotalInitialTruckers, U_TotalGrossProfit, U_ClientTag2, U_ClientName, U_SAPClient, U_ClientTag, U_ClientProject, U_ClientVatStatus, U_TruckerName, 
        U_TruckerSAP, U_TruckerTag, U_TruckerVatStatus, U_TPStatus, U_Aging, U_ISLAND, U_ISLAND_D, U_IFINTERISLAND, U_VERIFICATION_TAT, U_POD_TAT, U_ActualDateRec_Intitial, U_SAPTrucker, U_PlateNumber, U_VehicleTypeCap, 
        U_DeliveryStatus, U_DeliveryDateDTR, U_DeliveryDatePOD, U_NoOfDrops, U_TripType, U_Receivedby, U_ClientReceivedDate, U_InitialHCRecDate, U_ActualHCRecDate, U_DateReturned, U_PODinCharge, U_VerifiedDateHC, U_PTFNo, 
        U_DateForwardedBT, U_BillingDeadline, U_BillingStatus, U_SINo, bi_U_BillingTeam, U_BillingTeam, U_SOBNumber, U_ForwardLoad, U_TypeOfAccessorial, U_TimeInEmptyDem, U_TimeOutEmptyDem, U_VerifiedEmptyDem, 
        U_TimeInLoadedDem, U_TimeOutLoadedDem, U_VerifiedLoadedDem, U_TimeInAdvLoading, U_PenaltiesManual, U_DayOfTheWeek, U_TimeIn, U_TimeOut, U_TotalExceed, U_TotalNoExceed, U_ODOIn, U_ODOOut, U_TotalUsage, 
        U_ClientSubStatus, U_ClientSubOverdue, U_ClientPenaltyCalc, U_PODStatusPayment, U_ProofOfPayment, U_TotalRecClients, U_CheckingTotalBilled, U_Checking, U_CWT2307, U_SOLineNum, U_ARInvLineNum, U_TotalPayable, 
        U_TotalSubPenalty, U_PVNo, U_TPincharge, U_CAandDP, U_Interest, U_OtherDeductions, U_TOTALDEDUCTIONS, U_REMARKS1, U_TotalAR, U_VarAR, U_TotalAP, U_VarTP, U_APInvLineNum, U_PODSubmitDeadline, U_OverdueDays, 
        U_InteluckPenaltyCalc, U_WaivedDays, U_HolidayOrWeekend, U_EWT2307, U_LostPenaltyCalc, U_TotalSubPenalties, U_Waived, U_PercPenaltyCharge, U_Approvedby, U_TotalPenaltyWaived, U_TotalPenalty, U_TotalPayableRec, 
        su_U_APDocNum, pr_U_APDocNum, U_ServiceType, U_InvoiceNo, U_ARDocNum, po_U_DocNum, tp_U_DocNum, U_DocNum, U_Paid, U_ORRefNo, U_ActualPaymentDate, U_PaymentReference, U_PaymentStatus, U_Remarks, 
        tp_U_Remarks, U_GroupProject, U_Attachment, U_DeliveryOrigin, U_Destination, U_OtherPODDoc, U_RemarksPOD, U_PODStatusDetail, U_BTRemarks, U_DestinationClient, U_Remarks2, U_TripTicketNo, U_WaybillNo, U_ShipmentNo, 
        U_ShipmentManifestNo, U_DeliveryReceiptNo, U_SeriesNo, U_OutletNo, U_CBM, U_SI_DRNo, U_DeliveryMode, U_SourceWhse, U_SONo, U_NameCustomer, U_CategoryDR, U_IDNumber, U_ApprovalStatus, U_Status, U_RemarksDTR, 
        U_TotalInvAmount, U_PODDocNum, U_BookingId
FROM     dbo.fetchGenericPctpDataRows(@BookingIdsCSV) AS X