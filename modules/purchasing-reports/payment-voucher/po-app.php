<?php
session_start();
include_once('../../../config/config.php');

include("../../../mpdf/mpdf.php");

$docentry = $_GET['docentry'];

$mpdf = new mPDF('c'); 

$mpdf->mirrorMargins = 0.5;   // Use different Odd/Even headers and footers and mirror margins

$mpdf->defaultheaderfontsize = 10;  /* in pts */

$mpdf->defaultheaderline = 0;   /* 1 to include line below header/above footer */

$mpdf->defaultfooterfontsize = 12;  /* in pts */

$mpdf->defaultfooterline = 1;   /* 1 to include line below header/above footer */

$date = date('m-d-Y');
$htmlheader = '';
$htmldetails = '';
$remarks = '';
$a = 0;
$TotalQty = 0;
$TotalPriceBefDi = 0;
$TotalLineTotal = 0;

$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
		SELECT T0.DocEntry,
					T0.DocNum,
					CASE WHEN T0.DocStatus = 'O' THEN 'Open'
					ELSE 
						CASE WHEN T0.CANCELED = 'Y' THEN 'Cancelled' 
						ELSE 'Closed' END
					END AS DocStatus,
					T0.DocType,
					T0.DocDate,
					T0.DocDueDate,
					T0.CardCode,
					T0.CardName,
					T0.Comments,
					T0.OwnerCode,
					T0.U_AppStatus,
					T0.GroupNum,
					T0.U_POref,
					T0.VatSum as TotalTax,
					(T0.DocTotal - T0.VatSum + T0.DiscSum) As TotBefDisc,
					T0.DiscPrcnt AS TotalDiscount,
					T0.DiscSum,
					T0.DocTotal,
					CONCAT(T10.firstName, ' ', T10.middleName, ' ', T10.lastName) AS OwnerName,
					CONCAT(T11.firstName, ' ', T11.middleName, ' ', T11.lastName) AS ApprovedBy,
					T0.U_Site,
					T0.U_Source AS SourceCode,
					T9.Name AS SourceName,
					T0.U_POTranType,
					T0.U_CustPONo,
					T0.U_ContactPerson,
					T0.U_ContactNo,
					T0.U_POTotal, 
					T0.U_DiscountPercentage, 
					T0.U_DiscountAmount, 
					T0.U_TotalDiscount, 
					T0.U_TaxableAmount,
					T0.U_ContactPerson,
					T0.U_ContactNo,
					T1.ItemCode,
					T1.Dscription,
					T1.Quantity,
					T1.GPBefDisc,
					T1.PriceBefDi,
					T1.PriceAfVAT,
					T1.VatSum,
					T1.VatGroup,
					T1.VatPrcnt,
					T1.GTotal,
					T1.LineTotal,
					T1.unitMsr,
					T1.UomCode,
					T1.UomEntry,
					T2.UgpEntry,
					T1.LineNum,
					T1.VisOrder,
					T0.DocType,
					T3.ItmsGrpNam,
					T1.DiscPrcnt,
					T1.U_SosNum,
					T1.U_DiscAmt,
					FORMAT (T1.U_DateWithdrawn, 'yyyy-MM-dd') AS U_DateWithdrawn,
					(T1.Quantity * T1.GPBefDisc) * (T1.DiscPrcnt / 100) AS DiscAmt,
					T8.U_DocUom,
					(T6.BaseQty * T1.U_QtyOrder) AS PCS,
					CASE WHEN T8.U_DocUom = 'PIECE' THEN (T6.BaseQty * T1.U_QtyOrder) ELSE  (T1.U_QtyOrder / T6.BaseQty) END AS StockBackOrder,
					T9.Code AS SourceCode,
					T9.Name AS SourceName,
					T12.PymntGroup,
					T1.Text AS ItemRemarks
			FROM OPOR T0
			INNER JOIN POR1 T1 ON T0.DocEntry = T1.DocEntry
			INNER JOIN OITM T2 ON T1.ItemCode = T2.ItemCode
			INNER JOIN OITB T3 ON T2.ItmsGrpCod = T3.ItmsGrpCod
			INNER JOIN UGP1 T6 ON T1.UomEntry = T6.UomEntry
			LEFT JOIN [dbo].[@UOM] T8 ON T1.UomCode = T8.Code
			LEFT JOIN [dbo].[@SOURCE] T9 ON T1.U_Source = T9.Code
			LEFT JOIN OHEM T10 ON T0.OwnerCode = T10.empID
			LEFT JOIN OHEM T11 ON T0.U_ApprovedBy = T11.empID
			INNER JOIN OCTG T12 ON T0.GroupNum = T12.GroupNum
			WHERE T0.DocEntry = $docentry
			ORDER BY T1.VisOrder ASC");
			
			
		$no = 1;
		while (odbc_fetch_row($qry)) 
			{
				
				if(odbc_result($qry, 'DocEntry') == 0)
				{
					
				}
				else
				{
						
					$CardName = odbc_result($qry, 'CardName');
					$DocDate = date('M d, Y' ,strtotime(odbc_result($qry, 'DocDate')));
					$DocDueDate = date('M d, Y' ,strtotime(odbc_result($qry, 'DocDueDate')));
					$DocStatus = odbc_result($qry, 'DocStatus');
					$Site = odbc_result($qry, 'U_Site');
					$U_POref = odbc_result($qry, 'U_POref');
					$Comments = odbc_result($qry, 'Comments');
					$U_AppStatus = odbc_result($qry, 'U_AppStatus');
					$TotBefDisc = number_format(odbc_result($qry, 'TotBefDisc'),2);
					$DiscSum = number_format(odbc_result($qry, 'DiscSum'),2);
					$VatSum = number_format(odbc_result($qry, 'VatSum'),2);
					$DocTotal = number_format(odbc_result($qry, 'DocTotal'),2);
					$U_TotalDiscount = number_format(odbc_result($qry, 'U_TotalDiscount'),2);
					$DiscPrcnt = number_format(odbc_result($qry, 'DiscPrcnt'),2);
					$U_DiscAmt = number_format(odbc_result($qry, 'U_DiscAmt'),2);
					$U_POTotal = number_format(odbc_result($qry, 'U_POTotal'),2);
					$U_TaxableAmount = number_format(odbc_result($qry, 'U_TaxableAmount'),2);
					$TotalTax = number_format(odbc_result($qry, 'TotalTax'),2);
					
					$U_ContactPerson = strtoupper(odbc_result($qry, 'U_ContactPerson'));
					$U_ContactNo = odbc_result($qry, 'U_ContactNo');
					$SourceName = odbc_result($qry, 'SourceName');
					$PymntGroup = odbc_result($qry, 'PymntGroup');
					$U_CustPONo = odbc_result($qry, 'U_CustPONo');
					
					$DiscountAmount = "";
					$DiscountPercentage = "";
						
					if($U_DiscAmt == 0 || $U_DiscAmt == 0.000000 || $U_DiscAmt == 0.00)
					{
						$DiscountPercentage = number_format($DiscPrcnt,2) . '%';
					}
					else
					{
						$DiscountAmount = $U_DiscAmt;
						$DiscountPercentage = "";
					}
					
					if($DiscPrcnt == 0)
					{
						$DiscountPercentage = "";
					}
					
					
					$OwnerName = strtoupper(odbc_result($qry, 'OwnerName'));
					$ApprovedBy = strtoupper(odbc_result($qry, 'ApprovedBy'));
					$htmldetails .= '<tr>
														<td><center>'.$no.'</center></td>
														<td>'.odbc_result($qry, 'U_SosNum').'</td>
														<td>'.odbc_result($qry, 'Dscription').'</td>
														
														<td align="center">'.number_format(odbc_result($qry, 'Quantity'),2).'</td>
														<td align="center">'.odbc_result($qry, 'unitMsr').'</td>
														<td align="right">'.number_format(odbc_result($qry, 'GPBefDisc'),2).'</td>
														<td align="right">'.$DiscountAmount.'</td>
														<td align="right">'.$DiscountPercentage.'</td>
														<td align="right">'.number_format(odbc_result($qry, 'GTotal'),2).'</td>
														
													</tr>';
					$TotalQty += odbc_result($qry, 'Quantity');								
					$TotalPriceBefDi += odbc_result($qry, 'GPBefDisc');								
					$TotalLineTotal += odbc_result($qry, 'GTotal');								
				}
				$no++;
			}

$html .= '
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<title>Great Sierra Development Corp</title>
<link rel="icon" href="../../img/logo-ico.ico">
</head>
<body>
		<div class="row">
            <div class="col-lg-12">
				<table width="100%" border="0">
					<tbody>
							<tr>
								<td  width="25%" align="right"><img src="../../img/logo.png" width="25" height="20"></td>
								<td  width="75%" align="left" align="top"><span style="font-size: 14pt">GREAT SIERRA  DEVELOPMENT CORPORATION</span><br>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lot 2, Block 1, Grand Industrial Estate Subdivision<br>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bo. Parulan Plaridel, Bulacan</td>
							</tr>
					</tbody>	
				</table>
				<table width="100%" border="0">
					<tbody>
							<tr>
								<td width="33%"><span style="color:black"></span></td>
								<td width="33%"><center><span style="color:black; font-weight:bold;">PURCHASE ORDER FORM</span></center></td>
								<td width="33%" align="right"><span style="color:black">&nbsp;</span></td>
							</tr>
					</tbody>	
				</table>
				<br>
				<table width="100%" border="1"> 
					<tbody>
						<tr>
							<td width="25%"><center>VENDOR</center></td>
							<td width="25%"><center>SOURCE</center></td>
							<td width="50%"><center>TRANSACTION INFORMATION</center></td>
						</tr>
						<tr>
							<td width="25%"><center><span style="font-weight:bold;">'.strtoupper($CardName).'</span></center></td>
							<td width="25%"><center><span style="font-weight:bold;">'.strtoupper($SourceName).'</span></center></td>
							<td width="50%">
								&nbsp; PO NO :  <b>'.$U_POref.'</b><br>
								&nbsp; PO DATE :  <b>'.$DocDate.'</b><br>
								&nbsp; TERMS :  <b>'.$PymntGroup.'</b><br>
								&nbsp; CONTRACT NO :  <b>'.$U_ContactNo.'</b><br>
								&nbsp; CUSTOMER PO NO :  <b>'.$U_CustPONo.'</b><br>
								&nbsp; APPROVAL STATUS :  <b>'.$U_AppStatus.'</b><br>
								&nbsp; PO STATUS : <b>'.$DocStatus.'</b></td>
						</tr>
					</tbody>
				</table>
				<br>
				<table width="100%" border="1"> 
					<thead>
						<tr>
							<th width="3%"><center>#</center></th>
							<th width="18%"><center>SOS REF NO</center></th>
							<th width="6%"><center>ITEM DESCRIPTION</center></th>
							<th width="8%"><center>PO QTY</center></th>
							<th width="9%"><center>UNIT</center></th>
							<th width="9%"><center>UNIT<br>PRICE</center></th>
							<th width="9%"><center>DISC.<br>AMT</center></th>
							<th width="9%"><center>DISC. %</center></th>
							<th width="9%"><center>TOTAL COST</center></th>
						</tr>
					</thead>
					<tbody>
						'.$htmldetails.'
					</tbody>
				</table>
				<br>
				<table width="100%" border="0"> 
					<tbody>
						<tr>
							<td width="70%" rowspan="5" valign="top">REMARKS :</td>
							<td width="30%">SUB TOTAL : <b>'.$U_POTotal.'</td>
						</tr>
						<tr>
							<td width="30%">TAXABLE : <b>'.$U_TaxableAmount.'</b></td>
						</tr>
						<tr>
							<td width="30%">TAX : <b>'.$TotalTax.'</b></td>
						</tr>
						<tr>
							<td width="30%">DISCOUNT : <b>'.$U_TotalDiscount.'</b></td>
						</tr>
						<tr>
							<td width="30%">TOTAL : <b>'.$DocTotal.'</b></td>
						</tr>
					</tbody>
				</table>
				<br>
				<table width="100%" border="0"> 
					<tbody>
						<tr>
							<td width="100%" colspan="5" style="border-top: 1px solid black; ">&nbsp;</td>
						</tr>
						<tr>
							<td width="25%"><b>PREPARED BY:</b></td>
							<td width="10%"></td>
							<td width="25%"><b>CHECKED BY:</b></td>
							<td width="10%"></td>
							<td width="25%"><b>APPROVED BY:</b></td>
						</tr>
						<tr>
							<td width="25%">&nbsp;</td>
							<td width="10%"></td>
							<td width="25%"></td>
							<td width="10%"></td>
							<td width="25%"></td>
						</tr>
						<tr>
							<td width="25%">&nbsp;</td>
							<td width="10%"></td>
							<td width="25%"></td>
							<td width="10%"></td>
							<td width="25%"></td>
						</tr>
						<tr>
							<td width="25%" style="border-top: 1px solid black; "><center>'.$OwnerName.'</center></td>
							<td width="10%"></td>
							<td width="25%" style="border-top: 1px solid black; "></td>
							<td width="10%"></td>
							<td width="25%" style="border-top: 1px solid black; "><center>'.$ApprovedBy.'</center></td>
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

$mpdf->WriteHTML(utf8_encode($html));
$file_name = '';
$file_name = $U_POref . '.pdf';
$mpdf->Output($file_name,'I');

//$mpdf->Output();
exit;

?>