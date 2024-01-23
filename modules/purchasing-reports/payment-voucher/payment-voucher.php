<?php
session_start();
include_once('../../../config/config.php');





$html = '';

$htmldetails='';
$htmldetailsFooter ='';

$BillingPeriod = $_GET['BillingPeriod'];
$PreparedBy = $_GET['PreparedBy'];
$ReviewedBy = $_GET['ReviewedBy'];
$U_DocNum = $_GET['U_DocNum'];

$totalU_GrossTruckerRates = 0;
$totalU_Addtlcharges = 0;
$totalU_TotalPenalty = 0;
$totalU_TotalPenaltyWaived = 0;
$totalTruckerShare = 0;
$totalU_TotalPayable = 0;
$U_PVNo = '';
$wt = 0;

	

$U_GrossTruckerRatesField = 0.00;
$U_ActualRates= 0.00;
$U_RateAdjustments= 0.00;
$U_AddtlCharges= 0.00;
$U_DemurrageN= 0.00;
$U_totalAddtlCharges2= 0.00;
$U_ActualDemurrage= 0.00;
$U_ActualCharges= 0.00;


$U_BoomTruck2= 0.00;
$U_OtherCharges= 0.00;


$params = $U_DocNum;

$Rates ='';
$stringRates = '';


$U_GrossTruckerRatesField = '0.00';
$U_ActualRates = '0.00';
$U_RateAdjustments = '0.00';
	

$qryRates = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 		
SELECT T0.U_Rates AS Name FROM [@RATESPERPV] T0

WHERE T0.Code LIKE '$U_DocNum'

 ");
while (odbc_fetch_row($qryRates)) {
										
	$Rates = odbc_result($qryRates, 'Name');

}	
$RatesArray = explode(",",$Rates);
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


$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 


SELECT DISTINCT
2 AS PVType,
T0.U_BookingId,
T0.Code,
T0.U_TripTicketNo,
T0.U_BookingDate,
T0.U_DeliveryDatePOD,
T1.U_ClientReceivedDate,


CASE
    WHEN T2.VatStatus = 'N' THEN 'Nonvat'
    ELSE 'Vat'

END AS IsVatOrNonVat,


CONVERT(VARCHAR(10),DATEADD(day, CAST(ISNULL(T3.U_CDC,0) AS INT), U_DeliveryDateDTR),23) AS U_PODSubmitDeadline,
T1.U_InitialHCRecDate,
CASE
    WHEN ISNULL( T2.VatStatus,'Y') = 'Y' THEN T4.U_GrossTruckerRates
    WHEN ISNULL(T2.VatStatus,'Y') = 'N' THEN (T4.U_GrossTruckerRates / 1.12)
END AS U_GrossTruckerRates,

   ISNULL(T0.U_ActualRates,0) AS U_ActualRates  ,

   ISNULL(T0.U_RateAdjustments,0) AS U_RateAdjustments,


CASE
    WHEN ISNULL(T2.VatStatus,'Y') = 'Y' THEN T4.U_Demurrage2
    WHEN ISNULL(T2.VatStatus,'Y') = 'N' THEN (T4.U_Demurrage2 / 1.12) END AS U_DemurrageN,

  ISNULL(CAST(T0.U_ActualCharges AS FLOAT),0)   AS U_totalAddtlCharges2,

  ISNULL(CAST(T0.U_ActualDemurrage AS FLOAT),0) AS U_ActualDemurrage,
  ISNULL(CAST(T0.U_ActualCharges AS FLOAT),0) AS U_ActualCharges,  
  ISNULL(NULLIF(T0.U_BoomTruck2,''),0) AS U_BoomTruck2,
  ISNULL(T0.U_OtherCharges,0) AS U_OtherCharges,
T0.U_TotalPenalty,


T0.U_TotalPayable,
T0.U_DocNum,
T0.U_PVNo,
T0.U_TruckerName,
T2.LicTradNum,


    --(ISNULL(T0.U_CAandDP,0) + ISNULL(T0.U_Interest,0) + 
    ISNULL(T0.U_OtherDeductions,0) AS U_TotalSubPenalty, 
    dbo.computeTotalPenaltyWaived(
        dbo.computeTotalSubPenalties(
            dbo.computeClientPenaltyCalc(
                dbo.computeClientSubOverdue(
                    T1.U_DeliveryDateDTR,
                    T1.U_ClientReceivedDate,
                    ISNULL(T1.U_WaivedDays, 0),
                    CAST(ISNULL(T3.U_DCD,0) as int)
                )
            ),
            dbo.computeInteluckPenaltyCalc(
                dbo.computePODStatusPayment(
                    dbo.computeOverdueDays(
                        T1.U_ActualHCRecDate,
                        dbo.computePODSubmitDeadline(
                            T1.U_DeliveryDateDTR,
                            ISNULL(T3.U_CDC,0)
                        ),
                        ISNULL(T1.U_HolidayOrWeekend, 0)
                    )
                ),
                dbo.computeOverdueDays(
                    T1.U_ActualHCRecDate,
                    dbo.computePODSubmitDeadline(
                        T1.U_DeliveryDateDTR,
                        ISNULL(T3.U_CDC,0)
                    ),
                    ISNULL(T1.U_HolidayOrWeekend, 0)
                )
            ),
            dbo.computeLostPenaltyCalc(
                dbo.computePODStatusPayment(
                    dbo.computeOverdueDays(
                        T1.U_ActualHCRecDate,
                        dbo.computePODSubmitDeadline(
                            T1.U_DeliveryDateDTR,
                            ISNULL(T3.U_CDC,0)
                        ),
                        ISNULL(T1.U_HolidayOrWeekend, 0)
                    )
                ),
                T1.U_InitialHCRecDate,
                T1.U_DeliveryDateDTR,
                T4.U_TotalInitialTruckers
            ),
            ISNULL(T1.U_PenaltiesManual,0)
        ),
        ISNULL(T1.U_PercPenaltyCharge,0)
    ) AS U_TotalPenaltyWaived




FROM [@PCTP_TP] T0
INNER JOIN [@PCTP_POD] T1 ON T0.U_BookingId = T1.U_BookingNumber
INNER JOIN OCRD T2 ON T1.U_SAPTrucker = T2.CardCode
INNER JOIN OCRD T3 ON U_SAPClient = T3.CardCode
INNER JOIN [dbo].[@PCTP_PRICING] T4 ON T0.U_BookingId = T4.U_BookingId
INNER JOIN [@RATESPERPV] T5 ON T5.Code LIKE '%$params%' 

WHERE T0.U_PVNo LIKE '%$params%' 


UNION ALL
SELECT DISTINCT
1 AS PVType,
T0.U_BookingId,
T0.Code,
T0.U_TripTicketNo,
T0.U_BookingDate,
T0.U_DeliveryDatePOD,
T1.U_ClientReceivedDate,


CASE
    WHEN T2.VatStatus = 'N' THEN 'Nonvat'
    ELSE 'Vat'

END AS IsVatOrNonVat,


CONVERT(VARCHAR(10),DATEADD(day, CAST(ISNULL(T3.U_CDC,0) AS INT), U_DeliveryDateDTR),23) AS U_PODSubmitDeadline,
T1.U_InitialHCRecDate,


CASE WHEN T5.U_Amount = 'NaN'  THEN 0 ELSE CAST (T5.U_Amount  AS FLOAT) END  AS U_GrossTruckerRates,
   ISNULL(T0.U_ActualRates,0) AS U_ActualRates  ,

   ISNULL(T0.U_RateAdjustments,0) AS U_RateAdjustments,


0  AS U_DemurrageN,

CASE WHEN T5.U_AddlAmount = 'NaN'  THEN 0 ELSE CAST (T5.U_AddlAmount  AS FLOAT) END AS U_totalAddtlCharges2,
  ISNULL(T0.U_ActualDemurrage,0) AS U_ActualDemurrage,
  ISNULL(T0.U_ActualCharges,0) AS U_ActualCharges, 
  ISNULL(NULLIF(T0.U_BoomTruck2,''),0) AS U_BoomTruck2,
  ISNULL(T0.U_OtherCharges,0) AS U_OtherCharges,
T0.U_TotalPenalty,


0 AS U_TotalPayable,
T0.U_DocNum,
T0.U_PVNo,
T1.U_TruckerName,
T2.LicTradNum,


 ABS(dbo.computeTotalSubPenalties(
        dbo.computeClientPenaltyCalc(
            dbo.computeClientSubOverdue(
                T1.U_DeliveryDateDTR,
                T1.U_ClientReceivedDate,
                ISNULL(T1.U_WaivedDays, 0),
                CAST(ISNULL(T3.U_DCD,0) as int)
            )
        ),
        dbo.computeInteluckPenaltyCalc(
            dbo.computePODStatusPayment(
                dbo.computeOverdueDays(
                    T1.U_ActualHCRecDate,
                    dbo.computePODSubmitDeadline(
                        T1.U_DeliveryDateDTR,
                        ISNULL(T3.U_CDC,0)
                    ),
                    ISNULL(T1.U_HolidayOrWeekend, 0)
                )
            ),
            dbo.computeOverdueDays(
                T1.U_ActualHCRecDate,
                dbo.computePODSubmitDeadline(
                    T1.U_DeliveryDateDTR,
                    ISNULL(T3.U_CDC,0)
                ),
                ISNULL(T1.U_HolidayOrWeekend, 0)
            )
        ),
        dbo.computeLostPenaltyCalc(
            dbo.computePODStatusPayment(
                dbo.computeOverdueDays(
                    T1.U_ActualHCRecDate,
                    dbo.computePODSubmitDeadline(
                        T1.U_DeliveryDateDTR,
                        ISNULL(T3.U_CDC,0)
                    ),
                    ISNULL(T1.U_HolidayOrWeekend, 0)
                )
            ),
            T1.U_InitialHCRecDate,
            T1.U_DeliveryDateDTR,
            T4.U_TotalInitialTruckers
        ),
        ISNULL(T1.U_PenaltiesManual,0)
    )) AS U_TotalSubPenalty,
    dbo.computeTotalPenaltyWaived(
        dbo.computeTotalSubPenalties(
            dbo.computeClientPenaltyCalc(
                dbo.computeClientSubOverdue(
                    T1.U_DeliveryDateDTR,
                    T1.U_ClientReceivedDate,
                    ISNULL(T1.U_WaivedDays, 0),
                    CAST(ISNULL(T3.U_DCD,0) as int)
                )
            ),
            dbo.computeInteluckPenaltyCalc(
                dbo.computePODStatusPayment(
                    dbo.computeOverdueDays(
                        T1.U_ActualHCRecDate,
                        dbo.computePODSubmitDeadline(
                            T1.U_DeliveryDateDTR,
                            ISNULL(T3.U_CDC,0)
                        ),
                        ISNULL(T1.U_HolidayOrWeekend, 0)
                    )
                ),
                dbo.computeOverdueDays(
                    T1.U_ActualHCRecDate,
                    dbo.computePODSubmitDeadline(
                        T1.U_DeliveryDateDTR,
                        ISNULL(T3.U_CDC,0)
                    ),
                    ISNULL(T1.U_HolidayOrWeekend, 0)
                )
            ),
            dbo.computeLostPenaltyCalc(
                dbo.computePODStatusPayment(
                    dbo.computeOverdueDays(
                        T1.U_ActualHCRecDate,
                        dbo.computePODSubmitDeadline(
                            T1.U_DeliveryDateDTR,
                            ISNULL(T3.U_CDC,0)
                        ),
                        ISNULL(T1.U_HolidayOrWeekend, 0)
                    )
                ),
                T1.U_InitialHCRecDate,
                T1.U_DeliveryDateDTR,
                T4.U_TotalInitialTruckers
            ),
            ISNULL(T1.U_PenaltiesManual,0)
        ),
        ISNULL(T1.U_PercPenaltyCharge,0)
    ) AS U_TotalPenaltyWaived




FROM [@PCTP_TP] T0
INNER JOIN [@PCTP_POD] T1 ON T0.U_BookingId = T1.U_BookingNumber
INNER JOIN OCRD T2 ON T1.U_SAPTrucker = T2.CardCode
INNER JOIN OCRD T3 ON T1.U_SAPClient = T3.CardCode
INNER JOIN [dbo].[@PCTP_PRICING] T4 ON T0.U_BookingId = T4.U_BookingId
INNER JOIN [@FirstratesTP] T5 ON T5.U_BN = T0.U_BookingId AND T5.U_PVNo LIKE '%$params%' 

WHERE T0.U_PVNo LIKE '%$params%' 







 ");





$no = 1;
while (odbc_fetch_row($qry)) {
						
		$PVType = odbc_result($qry, 'PVType');					
		$Code = odbc_result($qry, 'Code');
		$U_BookingId = odbc_result($qry, 'U_BookingId');
		$U_BookingDate = date("m/d/Y", strtotime(odbc_result($qry, 'U_BookingDate')));
		$U_DeliveryDatePOD = date("m/d/Y", strtotime(odbc_result($qry, 'U_DeliveryDatePOD')));
		$U_ClientReceivedDate = date("m/d/Y", strtotime(odbc_result($qry, 'U_ClientReceivedDate')));

        $IsVatOrNonVat = odbc_result($qry, 'IsVatOrNonVat');  

		$U_PODSubmitDeadline = date("m/d/Y", strtotime(odbc_result($qry, 'U_PODSubmitDeadline')));
		$U_InitialHCRecDate = date("m/d/Y", strtotime(odbc_result($qry, 'U_InitialHCRecDate')));
		$U_TripTicketNo = odbc_result($qry, 'U_TripTicketNo');
		$U_GrossTruckerRatesAmount = odbc_result($qry, 'U_GrossTruckerRates');
		$U_ActualRatesAmount  = odbc_result($qry, 'U_ActualRates');
		$U_RateAdjustmentsAmount  = odbc_result($qry, 'U_RateAdjustments');
		$U_AddtlChargesAmount = 0.00;
		$U_totalAddtlCharges2 = odbc_result($qry, 'U_totalAddtlCharges2'); 

		$U_TotalSubPenalty = odbc_result($qry, 'U_TotalSubPenalty'); 
		$U_TotalPenalty = odbc_result($qry, 'U_TotalSubPenalty'); 


		$U_DemurrageNAmount = odbc_result($qry, 'U_DemurrageN');
		$U_totalAddtlCharges2Amount = odbc_result($qry, 'U_totalAddtlCharges2');
		$U_ActualDemurrageAmount = odbc_result($qry, 'U_ActualDemurrage');
		$U_ActualChargesAmount = odbc_result($qry, 'U_ActualCharges');
		$U_BoomTruck2Amount = odbc_result($qry, 'U_BoomTruck2');
		$U_OtherChargesAmount = odbc_result($qry, 'U_OtherCharges');

		// $U_TotalPenalty = number_format(odbc_result($qry, 'U_TotalSubPenalty')- odbc_result($qry, 'U_TotalPenaltyWaived'),2);
		$U_TotalPenaltyWaived = number_format(odbc_result($qry, 'U_TotalPenaltyWaived'),2);
		$U_TotalPayable = number_format(odbc_result($qry, 'U_TotalPayable'),2);
		$U_DocNum = odbc_result($qry, 'U_DocNum');
		$U_PVNo = odbc_result($qry, 'U_PVNo');
		$U_TruckerName = odbc_result($qry, 'U_TruckerName');
		$LicTradNum = odbc_result($qry, 'LicTradNum');
		


if($PVType == 1){
	$U_GrossTruckerRatesField = $U_GrossTruckerRatesAmount;
	 $U_totalAddtlCharges2 = $U_totalAddtlCharges2;
}else{

if (in_array("U_GrossTruckerRates", $RatesArray)){
   $U_GrossTruckerRatesField = $U_GrossTruckerRatesAmount;
  }else{
   $U_GrossTruckerRatesField = '0.00';
  }


if (in_array("U_ActualRates", $RatesArray)){
   $U_ActualRates = $U_ActualRatesAmount ;
  }else{
   $U_ActualRates = '0.00';
  }


if (in_array("U_RateAdjustments", $RatesArray)){
   $U_RateAdjustments = $U_RateAdjustmentsAmount ;
  }else{
   $U_RateAdjustments = '0.00';
  }


if (in_array("U_AddtlCharges", $RatesArray)){
   $U_AddtlCharges = $U_AddtlChargesAmount ;
  }else{
   $U_AddtlCharges = '0.00';
  }
	

	if (in_array("U_DemurrageN", $RatesArray)){
   $U_DemurrageN = $U_DemurrageNAmount ;
  }else{
   $U_DemurrageN = '0.00';
  }

if (in_array("U_totalAddtlCharges2", $RatesArray)){
   $U_totalAddtlCharges2 = $U_totalAddtlCharges2Amount ;
  }else{
   $U_totalAddtlCharges2 = '0.00';
  }

if (in_array("U_ActualDemurrage", $RatesArray)){
   $U_ActualDemurrage = $U_ActualDemurrageAmount ;
  }else{
   $U_ActualDemurrage = '0.00';
  }
  
if (in_array("U_ActualCharges", $RatesArray)){
   $U_ActualCharges = $U_ActualChargesAmount ;
  }else{
   $U_ActualCharges = '0.00';
  }

  if (in_array("U_BoomTruck2", $RatesArray)){
   $U_BoomTruck2 = $U_BoomTruck2Amount ;
  }else{
   $U_BoomTruck2 = '0.00';
  }
  if (in_array("U_OtherCharges", $RatesArray)){
   $U_OtherCharges = $U_OtherChargesAmount ;
  }else{
   $U_OtherCharges = '0.00';
  }
}
// TRUCKER RATES


// ADDL CHARGES

// $U_DemurrageN
// $U_totalAddtlCharges2
// $U_ActualDemurrage
// $U_ActualCharges
// $U_BoomTruck2
// $U_OtherCharges


$U_GrossTruckerRatesTotal=(float)$U_GrossTruckerRatesField + (float)$U_ActualRates + (float)$U_RateAdjustments;
//+ (float)$U_AddtlChargesAmount;


$U_AddtlChargesAmountTotal=
		(float)$U_DemurrageN + 
		(float)$U_totalAddtlCharges2 + 
		(float)$U_ActualDemurrage +
		(float)$U_ActualCharges +
		(float)$U_BoomTruck2 +
		(float)$U_OtherCharges;


		$rowTotal = ($U_GrossTruckerRatesTotal+$U_AddtlChargesAmountTotal)-(odbc_result($qry, 'U_TotalSubPenalty')-odbc_result($qry, 'U_TotalPenaltyWaived'));
		$totalU_GrossTruckerRates += $U_GrossTruckerRatesTotal;
		$totalU_Addtlcharges += $U_AddtlChargesAmountTotal;
		$totalU_TotalPenalty += odbc_result($qry, 'U_TotalSubPenalty');
		$totalU_TotalPenaltyWaived += odbc_result($qry, 'U_TotalPenaltyWaived');
		$totalU_TotalPayable += $rowTotal;

		$htmldetails .= '<tr>
							<td align="center">&nbsp;&nbsp;'.$no.'</td>
							<td align="center">'.$U_BookingId.'</td>
							<td align="center">'.$U_TripTicketNo.'</td>
							<td align="center">'.$U_BookingDate.'</td>
							<td align="center">'.$U_DeliveryDatePOD.'</td>
							<td align="center">'.$U_ClientReceivedDate.'</td>
							<td align="center">'.$U_PODSubmitDeadline.'</td>
							<td align="center">'.$U_InitialHCRecDate.'</td>
							<td align="center">'.number_format($U_GrossTruckerRatesTotal,2).'</td>
							<td align="center">'.number_format($U_AddtlChargesAmountTotal,2).'</td>
							<td align="center">'.$U_TotalPenalty.'</td>
							<td align="center">'.$U_TotalPenaltyWaived.'</td>
							<td align="center">'.number_format($rowTotal,2).'</td>
						</tr>';
		$no++;

	
		
	}
	$totalU_TotalPayable2 = 0.00;
    if($IsVatOrNonVat != 'Vat'){
        $totalU_TotalPayable2 = $totalU_TotalPayable;
         // $totalU_TotalPayable2 = $totalU_TotalPayable / 1.12;
    }else{
          $totalU_TotalPayable2 =  $totalU_TotalPayable / 1.12;
         // $totalU_TotalPayable2 = $totalU_TotalPayable;
    }
	$wt = 0.00;
    if($IsVatOrNonVat != 'Vat'){
        $wt = $totalU_TotalPayable * 0.02;
         // $totalU_TotalPayable2 = $totalU_TotalPayable / 1.12;
    }else{
         $wt = $totalU_TotalPayable  / 1.12 * 0.02;
         // $totalU_TotalPayable2 = $totalU_TotalPayable;
    }
	$net = $totalU_TotalPayable - $wt;
		$htmldetailsFooter .= '<tr>
							<td align="center" colspan="8"><b>TOTAL AMOUNT</b></td>
							<td align="center"><b>'.number_format($totalU_GrossTruckerRates,2).'</b></td>
							<td align="center"><b>'.number_format($totalU_Addtlcharges,2).'</b></td>
							<td align="center"><b>'.number_format($totalU_TotalPenalty,2).'</b></td>
							<td align="center"><b>'.number_format($totalU_TotalPenaltyWaived,2).'</b></td>
							<td align="center"><b>'.number_format($totalU_TotalPayable,2).'</b></td>
						</tr>
						<tr>
							<td align="center" colspan="8"><b>LESS: 2% Creditable Withholding Tax</b></td>
							<td align="center"></td>
							<td align="center"></td>
							<td align="center"></td>
							<td align="center"></td>
							<td align="center"><b>'.number_format($wt,2).'</b></td>
						</tr>
						<tr>
							<td align="center" colspan="8"><b>NET AMOUNT</b></td>
							<td align="center"></td>
							<td align="center"></td>
							<td align="center"></td>
							<td align="center"></td>
							<td align="center"><b>'.number_format($net,2).'</b></td>
						</tr>';

		
$html = '<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<title>Payment Voucher Report</title>
<link rel="icon" href="../../img/logo-ico.ics">

<style>
body {font-family: Arial, Helvetica, sans-serif;zoom: 0.6; /* Other non-webkit browsers */
zoom: 60%; /* Webkit browsers */}

.main{
	border: 1px solid black;
  border-collapse: collapse;
}
</style>


</head>
<body>
		<div class="row m-5">
            <div class="col-lg-12">
				<table width="100%" border="0">
					<tbody>
							<tr>
								<td width="33%"><span style="color:black"></span></td>
								<td width="33%"><center><span style="color:black; ">INTELUCK CORPORATION<br/>POD Control and Trucker Payment</span></center></td>
								<td  width="33%" align="left"><img src="inteluck.logo.jpg" width="200" height="150"></td>
							</tr>
					</tbody>	
				</table>
				<br>
				
				<br>
				<table width="100%" border="0">
					<tbody>
							<tr>
								<td colspan="3">
									<h5 >
									Payee Name: '.$U_TruckerName.'
									</h5>
								</td>

								<td>
									<h5 >
									Check Voucher No.
									</h5>
								</td>
								 
							</tr>
							<tr>
								<td colspan="3">
									<h5><span style="color:black">
									Company Name: '.$U_TruckerName.'
									</h5>
								</td>

								<td>
									<h5><span style="color:black">
									Billing Period: '.$BillingPeriod.'
									</h5>
								</td>
							</tr>
							<tr>
								<td colspan="3">
									<h5><span style="color:black">
									TIN #: '.$LicTradNum.'
									</h5>
								</td>

								<td>
									<h5><span style="color:black">
									Billing Reference No.: '.$U_PVNo.'
									</h5>
								</td>
							</tr>
							<tr>
								<td>
								</td>
								<td>
								</td>
								<td>
								</td>
								<td>
								</td>
								<td>
								</td>
								 
							</tr>
					</tbody>	
				</table>
				
				<br>
				<table  width="100%" border=1> 
					<thead  >
						<tr  >
							<th max-width="10px" ><center><h5>No</h5></center></th>
							<th max-width="10px"><center><h5>Booking No</h5></center></th>
							<th max-width="10px"><center><h5>Trip Ticket No</h5></center></th>
							<th max-width="10px"><center><h5>Booking Date</h5></center></th>
							<th max-width="10px"><center><h5>Delivery Date</h5></center></th>
							<th max-width="10px"><center><h5>Client Received Date</h5></center></th>
							<th max-width="10px"><center><h5>POD Submit Deadline</h5></center></th>
							<th max-width="10px"><center><h5>Inteluck Received Date</h5></center></th>
							<th max-width="10px"><center><h5>Trucker Rates</h5></center></th>
							<th max-width="10px"><center><h5>Additional Charges</h5></center></th>
							<th max-width="10px"><center><h5>Total Penalty</h5></center></th>
							<div class="d-none"><th max-width="10px"><center><h5>Waived Penalties</h5></center></th></div>
							<th max-width="10px"><center><h5>Total Amount</h5></center></th>
						</tr>
					</thead>
					<tbody>
						'.$htmldetails.'
						'.$htmldetailsFooter.'
					</tbody>
					<tfooter>


					
					</tfooter>
				</table>
				<br>
				<table width="100%" border="0"> 
					<tbody>
						<tr>
							<td width="20%"><h5 style="font-weight: normal">PREPARED BY:</h5></td>
							<td width="20%">'.$PreparedBy.'<br/></td>
							<td width="20%">&nbsp;</td>
							<td width="20%">&nbsp;</td>
						</tr>
						<tr>
							<td width="20%"><h5 style="font-weight: normal">REVIEWED BY:</h5></td>
							<td width="20%">'.$ReviewedBy.'</td>
							<td width="20%">&nbsp;</td>
							<td width="20%">&nbsp;</td>
						</tr>
					</tbody>
				</table>
			</div>
				
			
			</div>
		</div>
	</body>
</html>		
		';

echo $html;

?>
