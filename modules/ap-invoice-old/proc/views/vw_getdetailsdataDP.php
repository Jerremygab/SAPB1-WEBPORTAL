<?php
session_start();
include_once('../../../../config/config.php');

$cardcode = $_GET['cardCode'];
?>
			
				<table id="tblDownPaymentTable" class="table table-striped table-bordered table-sm detailsTable" cellspacing="0"  style="background-color: white; width:100% !important;"  cellspacing="0">
					<thead   style="border-bottom: 0 !important; ">
						<tr >
							<th class="text-right" style=" color: black; min-width:20px; " >#</th>
							<th style="color: black; min-width:100px;">Select</th>
							<th style="color: black; min-width:200px;">Document Number</th>
							<th style="color: black; min-width:250px;">Document Type</th>
							<th style="color: black; min-width:150px;">Remarks</th>
							<th style="color: black; min-width:150px;">Tax Code</th>
							<th style="color: black; min-width:250px;">Net Amount to Draw</th>
							<th style="color: black; min-width:250px;">Tax Amount to Draw</th>
							<th style="color: black; min-width:250px;">Gross Amount to Draw</th>
							<th style="color: black; min-width:250px;">Open Net Amount</th>
							<th style="color: black; min-width:250px;">Open Tax Amount</th>
							<th style="color: black; min-width:250px;">Open Gross Amount</th>
							<th style="color: black; min-width:250px;">Document Date</th>
						</tr>
					</thead>
					<tbody class="">

<?php
$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
										SELECT 

										T0.CardCode,
										T0.DocNum,
										T0.DocType,

										T0.Comments,

										T0.DpmAmnt,
										T0.VatSum,
										T0.DocTotal,
										T0.DpmAmntSC,
										T0.VatSumSy,
										T0.DocTotalSy,
										T0.DocDate


										FROM ODPO T0
										WHERE T0.CardCode = '$cardcode'
										AND T0.DocStatus = 'C'
										");
$ctr = 1;

while (odbc_fetch_row($qry)) 
{
	
	$DocNum = odbc_result($qry, 'DocNum');
	$DocType = odbc_result($qry, 'DocType');
	$Remarks = odbc_result($qry, 'Comments');
	$NetAmount = odbc_result($qry, 'DpmAmnt');
	$TaxAmount = odbc_result($qry, 'VatSum');
	$GrossAmount = odbc_result($qry, 'DocTotal');
	$OpenNetAmount = odbc_result($qry, 'DpmAmntSC');
	$OpenTaxAmount = odbc_result($qry, 'VatSumSy');
	$OpenGrossAmount = odbc_result($qry, 'DocTotalSy');
	$DocDate = odbc_result($qry, 'DocDate');
	
	
	$readonly = '';
	$inputGroup = 'input-group';
	$buttonHide = '';
	$disabled = '';
	$hasBatchSerial = '';

					echo 
					' <tr style="background-color: white; "  >
							<td class="rowno text-right" style="background-color: lightgray;color:black; font-size:13px;">
								<span>'.$ctr.'</span>
							
							</td>
							<td style="min-width:50px">
								<input type="checkbox" style=" height:20px ; width:20px; display: flex; margin:auto;" class="form-control matrix-cell chkboxInvoice">
							</td>
							<td>
								<input type="text" class="form-control docnum"   style="outline: none; border:none; " value="'.$DocNum.'"readonly/>
							</td>
							<td >
								<input type="text" class="form-control matrix-cell text-right DPdoctype"  style="outline: none; border:none" maxlength="12"  value="'.$DocType.'" readonly/>
							</td>
							<td >
								<input type="text" class="form-control matrix-cell text-right DPremarks"  style="outline: none; border:none" maxlength="12"  value="'.$Remarks.'" readonly/>
							</td>
								<td >
								<input type="text" class="form-control matrix-cell text-right DPtaxcode"   style="outline: none; border:none" maxlength="12"   value="" readonly/>
								
							</td>
							<td >
								<input type="text" class="form-control matrix-cell text-right DPnetamount"  style="outline: none; border:none" maxlength="12"  value="'.$NetAmount.'" />
							</td>
							<td >
								<input type="text" class="form-control matrix-cell text-right DPtaxamount"  style="outline: none; border:none" maxlength="12"  value="'.$TaxAmount.'" readonly/>
							</td>
							<td >
								<input  type="number" class="form-control matrix-cell text-right DPgrossamount "  style="outline: none; border:none" value="'.$GrossAmount.'"  />	
							</td>
							<td >
								<input  type="number" class="form-control matrix-cell text-right DPopennetamount "  style="outline: none; border:none" value="'.$OpenNetAmount.'"  readonly/>	
							</td>
							<td >
								<input  type="number" class="form-control matrix-cell text-right DPopentaxamount "  style="outline: none; border:none" value="'.$OpenTaxAmount.'"  readonly/>	
							</td>
							<td >
								<input  type="number" class="form-control matrix-cell text-right DPopengrossamount "  style="outline: none; border:none" value="'.$OpenGrossAmount.'"  readonly/>	
							</td>
							<td >
								<input  type="text" class="form-control matrix-cell text-right DPdocdate "  style="outline: none; border:none" value="'.$DocDate.'"  readonly/>	
							</td>
							</tr>';
						
						$ctr += 1;
				
	}
odbc_free_result($qry);
odbc_close($MSSQL_CONN);

?>
 </tbody>
  	<tfoot style="z-index: 999;  background-color: lightgray; " class="d-none">
		<th class="text-right" style=" color: black; min-width:20px; " >#</th>
		<th style="color: black; min-width:100px;">Select</th>
		<th style="color: black; min-width:200px;">Document Number</th>
		<th style="color: black; min-width:250px;">Document Type</th>
		<th style="color: black; min-width:150px;">Remarks</th>
		<th style="color: black; min-width:150px;">Tax Code</th>
		<th style="color: black; min-width:250px;">Net Amount to Draw</th>
		<th style="color: black; min-width:250px;">Tax Amount to Draw</th>
		<th style="color: black; min-width:250px;">Gross Amount to Draw</th>
		<th style="color: black; min-width:250px;">Open Net Amount</th>
		<th style="color: black; min-width:250px;">Open Tax Amount</th>
		<th style="color: black; min-width:250px;">Open Gross Amount</th>
		<th style="color: black; min-width:250px;">Document Date</th>
	</tfoot>
</table>