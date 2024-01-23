<?php
session_start();
include_once('../../../../config/config.php');

$cardcode = $_GET['cardcode'];
$serviceType = $_GET['serviceType'];
$docudate = $_GET['documentdate'];
$presentdate = $_GET['presentdate'];
?>
<table id="tblDetails" class="table table-striped table-bordered table-sm detailsTable table-responsive" cellspacing="0"  style="background-color: white; overflow-x:scroll !important;  overflow-y:hidden ; width:100% !important;"  cellspacing="0">
  <thead   style="border-bottom: 0 !important; ">
    <tr >
		<th class="text-right" style=" color: black;">#</th>
		<th style="color: black; min-width:100px; ">Select</th>
	    <th style="color: black; min-width:150px; ">Document No.</th>
	    <th style="color: black; min-width:150px;" >Document Type</th>
		
		<th style="color: black; min-width:150px; ">Customer Ref No.</th>
	    <th style="color: black; min-width:150px;">Date</th>
		<th style="color: black; min-width:150px;" >Due Date</th>
		<th style="color: black; min-width:150px;">Total</th>
		<th style="color: black; min-width:150px;">Balance Due</th>
	    <th style="color: black; min-width:150px;">Total Payment</th>
	    <th style="color: black; min-width:150px;">WTax Amount</th>
	    <th style="color: black; min-width:150px;">Doc. Remarks</th>
		<th style="color: black; min-width:100px;">Service Invoice No.</th>
    </tr>
  </thead>
  <tbody class="">


<?php



$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
	SELECT DISTINCT
		T0.BPLId ,
		CASE 
			WHEN T0.ObjType = 13 THEN 'IN'
			WHEN T0.ObjType = 14 THEN 'CN'
			WHEN T0.ObjType = 30 THEN 'JE'
		END AS ObjType,
		T0.DocDate,
		T0.DocDueDate,
		T0.DocNum,
		T0.DocEntry,
		T0.CardCode,
		T0.CardName,
		T0.NumAtCard,
		CASE 
			WHEN T2.Category IS NULL THEN
			T0.DocTotal - T0.PaidSum - T0.WTSum 
			WHEN T2.Category = 'P' THEN
			T0.DocTotal - T0.PaidSum - T0.WTSum 
			ELSE 
			T0.DocTotal - T0.PaidSum 
		END AS Balance,
		T0.DocTotal,
		CASE 
			WHEN T2.Category IS NULL THEN
			T0.WTSum
			WHEN T2.Category = 'P' THEN
			T0.WTSum
			ELSE 
			0
		END AS WTApplied,
		T0.Comments,

		CASE 
		WHEN U_InvoiceNo IS NOT NULL THEN U_InvoiceNo
		END AS U_InvoiceNo
	FROM OINV T0
	LEFT JOIN OBPL T1 ON T1.BPLId = T0.BPLId
	LEFT JOIN INV5 T2 ON T0.DocEntry = T2.AbsEntry
	WHERE T0.CardCode = '$cardcode' AND T0.DocStatus = 'O' 
	
		
	UNION ALL


	SELECT DISTINCT
		T0.BPLId ,
		CASE 
			WHEN T0.ObjType = 13 THEN 'IN'
			WHEN T0.ObjType = 14 THEN 'CN'
			WHEN T0.ObjType = 30 THEN 'JE'
		END AS ObjType,
		T0.DocDate,
		T0.DocDueDate,
		T0.DocNum,
		T0.DocEntry,
		T0.CardCode,
		T0.CardName,
		T0.NumAtCard,
		CASE 
			WHEN T3.Category IS NULL THEN
			T0.DocTotal - T0.PaidSum - T0.WTSum 
			WHEN T3.Category = 'P' THEN
			T0.DocTotal - T0.PaidSum - T0.WTSum 
			ELSE 
			T0.DocTotal - T0.PaidSum 
		END AS Balance,
		T0.DocTotal,
		CASE 
			WHEN T3.Category IS NULL THEN
			T0.WTSum
			WHEN T3.Category = 'P' THEN
			T0.WTSum
			ELSE 
			0
		END AS WTApplied,
		T0.Comments,

		CASE 
		WHEN U_InvoiceNo IS NOT NULL THEN U_InvoiceNo
		END AS U_InvoiceNo
	FROM OINV T0
	INNER JOIN OCRD T2 ON T0.CardCode = T2.CardCode
	LEFT JOIN OBPL T1 ON T1.BPLId = T0.BPLId
	LEFT JOIN INV5 T3 ON T0.DocEntry = T3.AbsEntry
	WHERE T2.FatherCard = '$cardcode' AND T0.DocStatus = 'O' 

	
	UNION ALL




	SELECT DISTINCT
		T0.BPLId ,
		CASE 
			WHEN T0.ObjType = 13 THEN 'IN'
			WHEN T0.ObjType = 14 THEN 'CN'
			WHEN T0.ObjType = 30 THEN 'JE'
		END AS ObjType,
		T0.DocDate,
		T0.DocDueDate,
		T0.DocNum,
		T0.DocEntry,
		T0.CardCode,
		T0.CardName,
		T0.NumAtCard,
		(T0.DocTotal - T0.PaidSum -  T0.WTSum) * - 1 AS Balance,
		T0.DocTotal * -1,
		T0.WTSum AS WTApplied,
		T0.Comments,

		CASE 
		WHEN U_InvoiceNo IS NOT NULL THEN U_InvoiceNo
		END AS U_InvoiceNo

	FROM ORIN T0
	LEFT JOIN OBPL T1 ON T1.BPLId = T0.BPLId	
	WHERE T0.CardCode = '$cardcode' AND T0.DocStatus = 'O' 
	


	ORDER BY T0.DocNum");
$ctr = 1;

while (odbc_fetch_row($qry)) 
{
	
	$bplid2 = odbc_result($qry, 'BPLId');
	$ObjType = odbc_result($qry, 'ObjType');
	$DocDate = date('Y-m-d' ,strtotime(odbc_result($qry, 'DocDate')));
	$DocDueDate = date('Y-m-d' ,strtotime(odbc_result($qry, 'DocDueDate')));
	$DocNum = odbc_result($qry, 'DocNum');
	$DocEntry = odbc_result($qry, 'DocEntry');
	$CardCode = odbc_result($qry, 'CardCode');
	$CardName = odbc_result($qry, 'CardName');
	$NumAtCard = odbc_result($qry, 'NumAtCard');
	$Balance = number_format(odbc_result($qry, 'Balance'),2);
	$WTApplied = number_format(odbc_result($qry, 'WTApplied'),2);
	$DocTotal = number_format(odbc_result($qry, 'DocTotal'),2);
	$Comments = odbc_result($qry, 'Comments');
	$ServiceInvoice = odbc_result($qry, 'U_InvoiceNo');

	
				if($serviceType == 'C'){
   
					echo 
					'               <tr style="background-color: white; "  >
					<td class="rowno text-right" style="background-color: lightgray;color:black; ">
					  <span>'.$ctr.'</span>
				  
					</td>
					   <td style="min-width:50px">
							  <input type="checkbox" style=" height:20px; width:20px; margin: auto; margin-top: 10px; text-align:center;" class="form-control matrix-cell chkboxInvoice "s>
						  
					  </td>
				  <td >
						  <input type="text" class="form-control docnum d-none"  aria-label="" aria-describedby="button-addon2" style="outline: none; border:none; " readonly value="'. $DocEntry .'"/>
						  <input type="text" class="form-control docnum2"  aria-label="" aria-describedby="button-addon2" style="outline: none; border:none; " readonly value="'. $DocNum .'"/>

					</td>
					<td >
						  <input type="text" class="form-control matrix-cell documenttype"  style="outline: none; border:none" readonly value="'. $ObjType .'"/>
					</td>
					<td >
					<input type="text" class="form-control matrix-cell customrefno"  aria-label=" aria-describedby="button-addon2" style="outline: none; border:none" readonly value="'. $NumAtCard .'"/>

					  </td>
					<td >
						  <input type="text" class="form-control matrix-cell date"  aria-label="" aria-describedby="button-addon2" style="outline: none; border:none" readonly value="'. $DocDate .'"/>
					</td>
					<td >
						  <input type="text" class="form-control matrix-cell duedate"  aria-label="" aria-describedby="button-addon2" style="outline: none; border:none" readonly value="'. $DocDueDate .'"/>
					</td>
					<td >
						  <input type="text" class="form-control matrix-cell text-right total"   aria-label="" aria-describedby="button-addon2" style="outline: none; border:none" maxlength="12" readonly  value="'. $DocTotal .'" />
					</td>
					<td >
						  <input type="text" class="form-control matrix-cell text-right balancedue"   style="outline: none; border:none" maxlength="8" readonly value="'. $Balance .'"/>
						  <input type="text" class="form-control matrix-cell text-right balancedue2 d-none"   style="outline: none; border:none" maxlength="8" readonly value="'. $Balance .'"/>
					  
					</td>
					
					<td >
						  <input type="text" class="form-control matrix-cell text-right totalpayment" aria-label="" maxlength="12" />
					</td>
					<td >
						  <input type="text" class="form-control matrix-cell text-right wtaxamount"   aria-label="" aria-describedby="button-addon2" style="outline: none; border:none" maxlength="12" readonly value="'. $WTApplied .'" />
					</td>
					 <td >
						  <input type="text" class="form-control matrix-cell comments"  style="outline: none; border:none" readonly value="'. $Comments .'"/>
					</td>
					 <td >
						  <input type="text" class="form-control matrix-cell serviceinvoice"  style="outline: none; border:none" value="'. $ServiceInvoice .'"/>
					</td>
				  </tr>'
					;
			
					$ctr += 1;
				}
				else{
				
				}
				
				
}

?>
  </tbody>
  <tfoot style="z-index: 999;  background-color: lightgray; " class="d-none">
		<tr style="background-color: lightgray; z-index: 999">
		<th class="text-right" style=" color: black">#</th>
		<th style="color: black; min-width:50px; ">Select</th>
		<th style="color: black; min-width:50px; ">Select</th>
	    <th style="color: black; min-width:150px; ">Document No.</th>
	    <th style="color: black; min-width:150px;" >Document Type</th>
		<th style="color: black; min-width:150px; ">Customer Ref No.</th>
	    <th style="color: black; min-width:150px;">Date</th>
		<th style="color: black; min-width:150px;">Overdue Days</th>
		<th style="color: black; min-width:300px;">Total</th>
	    <th style="color: black; min-width:300px;">Total Payment</th>
		<th style="color: black; min-width:300px;">Balance Due</th>
	    <th style="color: black; min-width:300px;">WTax Amount</th>
		<th style="color: black; min-width:100px;">Service Invoice No.</th>
		</tr>
	  </tfoot>
</table>
<script>
$('#tblDetails').dataTable({"bLengthChange": false, "searching": false, "pageLength": 3000});
</script>
<?php

odbc_free_result($qry);
odbc_close($MSSQL_CONN);

?>
