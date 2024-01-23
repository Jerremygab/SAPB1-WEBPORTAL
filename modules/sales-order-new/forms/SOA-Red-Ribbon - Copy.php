<?php
session_start();
include_once('../../../config/config.php');


$html = '';
require_once __DIR__ . '/../../../mpdf/vendor/autoload.php';

//$mpdf = new \Mpdf\Mpdf();


$mpdf = new \Mpdf\Mpdf(['tempDir' => __DIR__ . '/../../../mpdf/custom/temp/dir/path']);

$mpdf->mirrorMargins = 0.5;
$mpdf->defaultheaderfontsize = 10;
$mpdf->AddPageByArray([
    'margin-left' => 3,
    'margin-right' => 3,
    'margin-top' => 3,
    'margin-bottom' => 3,
]);




										
	$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
			SELECT
			A.DocNum,
			A.DocEntry,
			A.DocDate,
			A.CardCode,
			A.CardName,
			A.Address,
			A.LicTradNum,
			B.Dscription,
			(B.Quantity * B.PriceAfVAT) AS GrossTotal,
			(A.DocTotal + A.DiscSum) - A.VatSum AS TotalBeforeDiscount,
			A.VatSum,
			A.DocTotal
		FROM OINV A
	LEFT JOIN INV1 B ON A.DocEntry = B.DocEntry

	WHERE A.DocEntry = 1 ");
			$no = 1;
			while (odbc_fetch_row($qry)) 
									{
										
										$DocNum = odbc_result($qry, 'DocNum');
										$DocEntry = odbc_result($qry, 'DocEntry');
										$DocDate = date("m/d/Y", strtotime(odbc_result($qry, 'DocDate')));
										$CardCode = odbc_result($qry, 'CardCode');
										$CardName = odbc_result($qry, 'CardName');
										$Address = odbc_result($qry, 'Address');
										$LicTradNum = odbc_result($qry, 'LicTradNum');
										$Dscription = odbc_result($qry, 'Dscription');


										$GrossTotal = number_format(odbc_result($qry, 'GrossTotal'),2);
										$TotalBeforeDiscount = number_format(odbc_result($qry, 'TotalBeforeDiscount'),2);
										$VatSum = number_format(odbc_result($qry, 'VatSum'),2);
										$DocTotal = number_format(odbc_result($qry, 'DocTotal'),2);

										$htmldetails .= '<tr>
														<td align="center"></td>
														<td align="center" colspan="4">'.$Dscription.'</td>
														<td align="right">'.number_format(odbc_result($qry, 'GrossTotal'),2).'</td>
														
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
<title>SOA Red Ribbon</title>
<link rel="icon" href="../../img/logo-ico.ics">
</head>
<body>
		<div class="row">
            <div class="col-lg-12">
				<table width="100%" border="0">
					<tbody>
							<tr>
								<td width="33%"><span style="color:black"></span></td>
								<td width="33%"><center><span style="color:black; ">STATEMENT OF ACCOUNT</span></center></td>
								<td  width="33%" align="left"><img src="logo.jpg" width="150" height="80"></td>
							</tr>
					</tbody>	
				</table>
				<br>
				<table width="100%" border="0" >
					<tbody>
							<tr>
								<td width="33%"><h5><center><span style="color:black;font-weight:bold;">&nbsp;&nbsp;ESPINOSA BUSINESS INCORPORATED</span></center></h5></td>
								<td width="33%"><center><span style="color:black; font-weight:bold;"></span></center></td>
								
								<td width="33%" align="left"><h5><span style="color:black">&nbsp;No.: '.$DocNum.'</span></h5></td>
							</tr>
							<tr>
								<td width="33%" >
								<h5 style="font-weight:normal"><center><span  ><p >
								&nbsp;&nbsp;Alabang, Zapote Rd., cor. Gemini St., Pamplona<br/>
								&nbsp;&nbsp;Las Piñas City <br/>
								&nbsp;&nbsp;VAT REG. TIN: 209-650-485-000</p>
								</span>
								</center>
								</h5>
								</td>


								<td width="33%"><center><span style="color:black; ">
								</span></center></td>
								<td width="33%" align="left"><h5><span style="color:black">&nbsp;Date: '.$DocDate.'</span></h5></td>
							</tr>
					</tbody>	
				</table>
				<br>
				<table width="100%" border="0">
					<tbody>
							<tr>
								<td width="100%" ><h5 >
								BILLED TO:
								<span >
								'.$CardName.'
								</span>
								</h5></td>
								 
							</tr>
							<tr>
								<td width="100%"><h5><span style="color:black">
								ADDRESS:
								<span >
								'.$Address.'
								</span>
								</h5></td>
							</tr>
							<tr>
								<td width="100%"><h5><span style="color:black">
								BUSINESS STYLE: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								TIN: <span >
								'.$LicTradNum.'
								</span>
								</h5></td>
								</span></h5></td>
							</tr>
					</tbody>	
				</table>
				<br>
				<table width="100%" border="1"> 
					<thead>
						<tr>
							<th width="18%"><center><h5>DATE</h5></center></th>
							<th width="6%" colspan="4"><h5><center>DESCRIPTION</h5></center></th>
							<th width="8%"><center><h5>AMOUNT</h5></center></th>
						</tr>
					</thead>
					<tbody>
						'.$htmldetails.'
					</tbody>
					<tfooter>


						<tr>
							<td width="18%"><center></center></td>
							<th width="6%" colspan="4"><center><h5>Total Before Discount</h5></center></th>
							<td width="8%" align="right">'.$TotalBeforeDiscount.'</td>
						</tr>
						<tr>
							<td width="18%"><center></center></td>
							<th width="6%"  colspan="4"><center><h5>12% VAT</h5></center></th>
							<td width="8%" align="right">'.$VatSum.'</td>
						</tr>
						<tr>
							<td width="18%"><center></center></td>
							<th width="6%"  colspan="4"><center><h5>Total Amount</h5></center></th>
							<td width="8%" align="right">'.$DocTotal.'</td>
						</tr>
						<tr>
							<td width="18%"><center></center></td>
							<td width="6%"  colspan="4"><center>&nbsp;</center></td>
							<td width="8%"><center></center></td>
						</tr>
						<tr>
							<td width="18%"><center></center></td>
							<th width="6%"  colspan="4"><center><h5>Total Amount Due</h5></center></th>
							<td width="8%" align="right">'.$DocTotal.'</td>
						</tr>
						<tr>
							<td width="18%"><center></center></td>
							<td width="6%"  colspan="4"><center>&nbsp;</center></td>
							<td width="8%"><center></center></td>
						</tr>
						<tr>
							<td width="18%" rowspan="2"><center>CURRENT</center></td>
							<td ><center>&nbsp;1-30 Days</center></td>
							<td ><center>&nbsp;31-60 Days</center></td>
							<td ><center>&nbsp;61-90 Days</center></td>
							<td ><center>&nbsp;over 90 Days</center></td>
							<td width="18%" rowspan="2"><center>AMOUNT</center></td>
						</tr>
						<tr>
							
							<td width="8%" colspan="4"><center>&nbsp;</center></td>
							
							
						</tr>
					</tfooter>
				</table>
				<br>
				<table width="100%" border="0"> 
					<tbody>
						<tr>
							<td width="100%" colspan="5" >&nbsp;</td>
						</tr>
						<tr>
							<td width="25%" ><h5 style="font-weight: normal"><center>PREPARED BY:</center></h5></td>
							<td width="10%"></td>
							<td width="25%" ><h5 style="font-weight: normal"><center>CHECKED BY:</center></h5></td>
							<td width="10%"></td>
							<td width="25%"><h5 style="font-weight: normal"><center>NOTED BY:</center></h5></td>
						</tr>
						<tr>
							<td width="25%">&nbsp;</td>
							<td width="10%"></td>
							<td width="25%"></td>
							<td width="10%"></td>
							<td width="25%"></td>
						</tr>
						<tr>
							<td width="25%" ><center></center></td>
							<td width="10%"></td>
							<td width="25%" ></td>
							<td width="10%"></td>
							<td width="25%" ><center></center></td>
						</tr>
						<tr>
							<td width="25%" style="border-top: 1px solid black; "><h5 style="font-weight: normal"><center>Accounting Staff</center></h5></td>
							<td width="10%"></td>
							<td width="25%" style="border-top: 1px solid black; "><h5 style="font-weight: normal"><center>Accounting Staff</center></h5></td>
							<td width="10%"></td>
							<td width="25%" style="border-top: 1px solid black; "><h5 style="font-weight: normal"><center><center>Accounting Head</center></h5></td>
						</tr>
						<tr>
							<tr>
							<td width="25%">&nbsp;</td>
							<td width="10%"></td>
							<td width="25%"></td>
							<td width="10%"></td>
							<td width="25%"></td>
						</tr>
						<tr>
							<td width="25%" ></td>
							<td width="10%"></td>
							<td width="25%" ></td>
							<td width="10%"></td>
							<td width="25%"><h5 style="font-weight: normal"><center><center>Received By:</center></h5></td>
						</tr>
						<tr>
							<tr>
							<td width="25%">&nbsp;</td>
							<td width="10%"></td>
							<td width="25%"></td>
							<td width="10%"></td>
							<td width="25%"></td>
						</tr>
						<tr>
							<td width="25%" ></td>
							<td width="10%"></td>
							<td width="25%" ></td>
							<td width="10%"></td>
							<td width="25%" style="border-top: 1px solid black; "><h5 style="font-weight: normal"><center><center>Signature Over Printed Name</center></h5></td>
						</tr>
						<tr>
							<tr>
							<td width="25%">&nbsp;</td>
							<td width="10%"></td>
							<td width="25%"></td>
							<td width="10%"></td>
							<td width="25%"></td>
						</tr>
						<tr>
							<td width="100%" colspan="5" style="border:  1px solid black;">Please see attached for detailed description/breakdown summary & copy of Original Receipts</td>
						
						
						</tr>
						<tr>
							<tr>
							<td width="25%">&nbsp;</td>
							<td width="10%"></td>
							<td width="25%"></td>
							<td width="10%"></td>
							<td width="25%"></td>
						</tr>
						<tr>
							<tr>
							<td width="10%"><center>&nbsp;Printing <br/>
												Company <br/>
												[LOGO] <br/></center></td>
							<td width="20%"><center>[Printing Company] <br/>
													BIR Authority to Print No. <br/>
													Date Issued: </center></td>
							<td width="30%"></td>
							<td width="20%"></td>
							<td width="20%"><center> Address <br/>
													TIN <br/>
													Printer&#39;s Accreditation No.
							</center></td>
						</tr>
						<tr>
							<tr>
							<td width="25%">&nbsp;</td>
							<td width="10%"></td>
							<td width="25%"></td>
							<td width="10%"></td>
							<td width="25%"></td>
						</tr>
						<tr>
							<td width="100%" colspan="5" ><center><b>This Document is Not Valid for Claim of Input TAX</b></center></td>
						
						</tr>
						<tr>
							<tr>
							<td width="25%">&nbsp;</td>
							<td width="10%"></td>
							<td width="25%"></td>
							<td width="10%"></td>
							<td width="25%"></td>
						</tr>
						<tr>
							<td width="100%" colspan="5" ><center>THIS STATEMENT OF ACCOUNT SHALL BE VALID FOR FIVE (5) YEARS FROM DATE OF ATP</center></td>
						
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</body>
</html>		
		';

$mpdf->SetWatermarkText('');
$mpdf->watermark_font = 'DejaVuSansCondensed';
$mpdf->showWatermarkText = true;

$stylesheet = file_get_contents('../../mpdf/mpdf_css/pr_app-report.css');
$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML($html);
$mpdf->Output();

?>
