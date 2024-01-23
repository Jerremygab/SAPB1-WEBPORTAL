<?php
session_start();
include_once('../../../../config/config.php');


$docNum = $_GET['docNum'];
?>
			
				<table id="tblDownPaymentTable" class="table table-striped table-bordered table-sm detailsTable" cellspacing="0"  style="background-color: white; width:100% !important;"  cellspacing="0">
					<thead   style="border-bottom: 0 !important; ">
						<tr >
							<th class="text-right" style=" color: black; min-width:20px; " >#</th>
							<th style="color: black; min-width:200px;">Document Number</th>
							<th style="color: black; min-width:150px;">Remarks</th>
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
                                            SELECT  DISTINCT

                                            T0.BaseDocNum,

                                            T0.BsComments,

                                            T0.DrawnSum,
                                            T0.Vat,
                                            T0.Gross,
                                            T0.DrawnSumSc,
                                            T0.VatSc,
                                            T0.GrossSc,
                                            T0.BsDocDate


                                            FROM PCH9 T0
                                            WHERE T0.DocEntry = '$docNum'
										");
$ctr = 1;

while (odbc_fetch_row($qry)) 
{
	
	$DocNum = odbc_result($qry, 'BaseDocNum');

	$Remarks = odbc_result($qry, 'BsComments');
	$NetAmount = odbc_result($qry, 'DrawnSum');
	$TaxAmount = odbc_result($qry, 'Vat');
	$GrossAmount = odbc_result($qry, 'Gross');
	$OpenNetAmount = odbc_result($qry, 'DrawnSumSc');
	$OpenTaxAmount = odbc_result($qry, 'VatSc');
	$OpenGrossAmount = odbc_result($qry, 'GrossSc');
	$DocDate = odbc_result($qry, 'BsDocDate');
	
	
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
							<td>
								<input type="text" class="form-control DPdocnum"   style="outline: none; border:none; " value="'.$DocNum.'"readonly/>
							</td>
							<td >
								<input type="text" class="form-control matrix-cell text-right DPremarks"  style="outline: none; border:none" maxlength="12"  value="'.$Remarks.'" readonly/>
							</td>
							<td >
								<input type="text" class="form-control matrix-cell text-right DPnetamount"  style="outline: none; border:none" maxlength="12"  value="'.$NetAmount.'" readonly/>
							</td>
							<td >
								<input type="text" class="form-control matrix-cell text-right DPtaxamount"  style="outline: none; border:none" maxlength="12"  value="'.$TaxAmount.'" readonly/>
							</td>
							<td >
								<input  type="number" class="form-control matrix-cell text-right DPgrossamount "  style="outline: none; border:none" value="'.$GrossAmount.'"  readonly/>	
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
		<th style="color: black; min-width:150px;">Remarks</th>
		<th style="color: black; min-width:250px;">Net Amount to Draw</th>
		<th style="color: black; min-width:250px;">Tax Amount to Draw</th>
		<th style="color: black; min-width:250px;">Gross Amount to Draw</th>
		<th style="color: black; min-width:250px;">Open Net Amount</th>
		<th style="color: black; min-width:250px;">Open Tax Amount</th>
		<th style="color: black; min-width:250px;">Open Gross Amount</th>
		<th style="color: black; min-width:250px;">Document Date</th>
	</tfoot>
</table>