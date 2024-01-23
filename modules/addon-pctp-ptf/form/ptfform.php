<?php
session_start();
include_once('../../../config/config.php');


$html = '';

$htmldetails='';

$U_PTFNo = $_GET['U_PTFNo'];
$U_PTFYear = $_GET['U_PTFYear'];
$U_DateForwardedBT = $_GET['U_DateForwardedBT'];
$U_PreparedBy = $_GET['U_PreparedBy'];
$U_ForwardedBy = $_GET['U_ForwardedBy'];
$U_ReceivedBy = $_GET['U_ReceivedBy'];
		

		



								
$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
		
SELECT
T0.U_DeliveryDatePOD,
T0.U_BookingNumber,
T0.U_BookingDate,
T0.Code,
T0.U_SAPClient,
T1.CardName AS U_ClientName,
T2.CardName AS U_TruckerName,
CAST(T0.U_DocNum AS NVARCHAR) AS U_DocNum,
CAST(T0.U_PODStatusDetail AS NVARCHAR) AS U_PODStatusDetail,
CAST(T0.U_TripTicketNo AS NVARCHAR) AS U_TripTicketNo,
CAST(T0.U_WaybillNo AS NVARCHAR) AS U_WaybillNo,
CAST(T0.U_ShipmentNo AS NVARCHAR) AS U_ShipmentNo,
CAST(T0.U_DeliveryReceiptNo AS NVARCHAR) AS U_DeliveryReceiptNo,
CAST(T0.U_SeriesNo AS NVARCHAR) AS U_SeriesNo,
T0.U_PTFNo,
T0.U_DateForwardedBT,
REPLACE(CAST(T0.U_OtherPODDoc AS NVARCHAR(max)),'/', '<br>') AS U_OtherPODDoc

FROM [@PCTP_POD] T0
LEFT JOIN OCRD T1 ON T0.U_SAPClient = T1.CardCode
LEFT JOIN OCRD T2 ON T0.U_SAPTrucker = T2.CardCode


WHERE T0.U_PODStatusDetail LIKE 'Verified'
AND U_PTFNo LIKE '%$U_PTFYear' + '-' + '$U_PTFNo'


ORDER BY T0.U_BookingDate ASC


 ");
			$no = 1;
			while (odbc_fetch_row($qry)) 
									{
										
										$Code = odbc_result($qry, 'Code');
										$U_BookingNumber = odbc_result($qry, 'U_BookingNumber');
										$U_DeliveryDatePOD = date("m/d/Y", strtotime(odbc_result($qry, 'U_BookingDate')));
										$U_SAPClient = odbc_result($qry, 'U_SAPClient');
										$U_ClientName = odbc_result($qry, 'U_ClientName');
										$U_TruckerName = odbc_result($qry, 'U_TruckerName');
										$U_DocNum = odbc_result($qry, 'U_DocNum');
										$U_PODStatusDetail = odbc_result($qry, 'U_PODStatusDetail');
										$U_TripTicketNo = odbc_result($qry, 'U_TripTicketNo');
										$U_WaybillNo = odbc_result($qry, 'U_WaybillNo');
										$U_ShipmentNo = odbc_result($qry, 'U_ShipmentNo');
										$U_DeliveryReceiptNo = odbc_result($qry, 'U_DeliveryReceiptNo');
										$U_SeriesNo = odbc_result($qry, 'U_SeriesNo');
										$U_PTFNo = odbc_result($qry, 'U_PTFNo');
										// $U_DateForwardedBT = date("m/d/Y", strtotime(odbc_result($qry, 'U_DateForwardedBT')));
										$U_OtherPODDoc = odbc_result($qry, 'U_OtherPODDoc');
										


										$htmldetails .= '<tr>
														<td align="center">&nbsp;&nbsp;'.$no.'</td>
														<td align="center">'.$U_DeliveryDatePOD.'</td>
														<td align="center">'.$U_BookingNumber.'</td>
														<td align="center">'.$U_ClientName.'</td>
														<td align="center">'.$U_TruckerName.'</td>
														<td align="center">'.$U_TripTicketNo.'</td>
														<td align="center">'.$U_WaybillNo.'</td>
														<td align="center">'.$U_ShipmentNo.'</td>
														<td align="center">'.$U_DeliveryReceiptNo.'</td>
														<td align="center">'.$U_SeriesNo.'</td>
														<td align="center">'.$U_OtherPODDoc.'</td>
														
														
													</tr>';
										$no++;;
										
									}

		
$html = '<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<title>PTF</title>
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
								<h5 >
								PTF No.: '.$U_PTFNo.'
								</h5>
								 
							</tr>
							<tr>
								<h5><span style="color:black">
								Date Forwarded: '.$U_DateForwardedBT.'
								
								</h5>
							</tr>
							<tr>
								<h5><span style="color:black">
								Forwarded Via:
								
								</h5>
							</tr>
					</tbody>	
				</table>
				<br>
				<table  width="100%" border=1> 
					<thead  >
						<tr  >
							<th max-width="10px" ><center><h5>No</h5></center></th>
							<th max-width="10px"><center><h5>Delivery Date</h5></center></th>
							<th max-width="10px"><center><h5>Booking No</h5></center></th>
							<th max-width="10px"><center><h5>Client Name</h5></center></th>
							<th max-width="10px"><center><h5>Trucker Name</h5></center></th>
							<th max-width="10px"><center><h5>Trip Ticket No</h5></center></th>
							<th max-width="10px"><center><h5>Waybill No</h5></center></th>
							<th max-width="10px"><center><h5>Shipment No</h5></center></th>
							<th max-width="10px"><center><h5>Delivery Receipt No</h5></center></th>
							<th max-width="10px"><center><h5>Series Number</h5></center></th>
							<th max-width="10px"><center><h5>Other POD Doc</h5></center></th>
						</tr>
					</thead>
					<tbody>
						'.$htmldetails.'
					</tbody>
					<tfooter>


					
					</tfooter>
				</table>
				<br>
				<table width="100%" border="0"> 
					<tbody>
						<tr>
							<td width="20%"><h5 style="font-weight: normal">PREPARED BY:</h5></td>
							<td width="20%">'.$U_PreparedBy.'<br/></td>
							<td width="20%">&nbsp;</td>
							<td width="20%">&nbsp;</td>
						</tr>
						<tr>
							<td width="20%">&nbsp;</td>
							<td width="20%" style="border-top: 1px solid black">POD Team</td>
							<td width="20%">&nbsp;</td>
							<td width="20%">&nbsp;</td>
						</tr>
						<tr>
							<td width="20%"><h5 style="font-weight: normal">FORWARDED BY:</h5></td>
							<td width="20%">'.$U_ForwardedBy.'</td>
							<td width="20%">&nbsp;</td>
							<td width="20%">&nbsp;</td>
						</tr>
						<tr>
							<td width="20%">&nbsp;</td>
							<td width="20%" style="border-top: 1px solid black">POD Team</td>
							<td width="20%">&nbsp;</td>
							<td width="20%">&nbsp;</td>
						</tr>
						<tr>
							<td width="20%"><h5 style="font-weight: normal">RECEIVED BY:</h5></td>
							<td width="20%">'.$U_ReceivedBy.'</td>
							<td width="20%">&nbsp;</td>
							<td width="20%">&nbsp;</td>
						</tr>
						<tr>
							<td width="20%">&nbsp;</td>
							<td width="20%" style="border-top: 1px solid black">Billing Team</td>
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
