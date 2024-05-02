<?php
session_start();
include_once('../../../../config/config.php');

$docNum = $_GET['docNum'];
$docType = $_GET['docType'];
$objType = $_GET['objType'];
$payNoDoc = $_GET['payNoDoc'];
// $cardCode = $_GET['cardCode'];
$table = '';
$table2 = '';


//Letter C for Incoming, Letter S for Outgoing
if($docType == 'C'){

?>


<table id="tblDetails2" class="table table-striped table-bordered table-sm detailsTable" cellspacing="0"  style="background-color: white; width:100% !important;"  cellspacing="0">
  <thead   style="border-bottom: 0 !important; ">
    <tr >
		<th class="text-right" style=" color: black; max-width:50px;">#</th>
		<th style="color: black; max-width:50px;">Select</th>
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
	    <!-- 
	    <th style="color: black; min-width:150px;">Department</th>
	    <th style="color: black; min-width:150px;">Branch</th>
	    <th style="color: black; min-width:150px;">Employee</th> 
	  	-->
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
        T0.DocTotal - T0.PaidSum AS Balance,
        T0.DocTotal,
        T0.WTApplied,
        T2.PaidSum,
        T2.SumApplied,

        T2.OcrCode,
        T2.OcrCode2,
        T2.OcrCode3,
        T0.Comments,


		CASE 
		WHEN U_InvoiceNo IS NOT NULL THEN U_InvoiceNo
		END AS U_InvoiceNo

    FROM OINV T0

    LEFT JOIN RCT2 T2 ON T0.DocEntry = T2.DocEntry

    LEFT JOIN ORCT T3 ON T3.DocEntry = T2.DocNum
    WHERE T3.DocEntry = $docNum 

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
        T0.DocTotal - T0.PaidSum AS Balance,
        T0.DocTotal,
        T0.WTApplied,
        T2.PaidSum,
        T2.SumApplied,

        T2.OcrCode,
        T2.OcrCode2,
        T2.OcrCode3,
        T0.Comments,


		CASE 
		WHEN U_InvoiceNo IS NOT NULL THEN U_InvoiceNo
		END AS U_InvoiceNo


    FROM ORIN T0

    LEFT JOIN RCT2 T2 ON T0.DocEntry = T2.DocEntry
    LEFT JOIN ORCT T3 ON T3.DocEntry = T2.DocNum
    WHERE T3.DocEntry = $docNum 


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
	$Balance = number_format(odbc_result($qry, 'Balance'),6);
	$WTApplied = number_format(odbc_result($qry, 'WTApplied'),6);
	$DocTotal = number_format(odbc_result($qry, 'DocTotal'),6);
	$SumApplied = number_format(odbc_result($qry, 'SumApplied'),6);

	$OcrCode = odbc_result($qry, 'OcrCode');
	$OcrCode2 = odbc_result($qry, 'OcrCode2');
	$OcrCode3 = odbc_result($qry, 'OcrCode3');
	$Comments = odbc_result($qry, 'Comments');
	$ServiceInvoice = odbc_result($qry, 'U_InvoiceNo');

	echo 	'<tr style="background-color: white; "  >
					  <td class="rowno text-right" style="background-color: lightgray;color:black;">
						<span>'.$ctr.'</span>
					
					  </td>
					 	<td >
					  	<center>
								<input type="checkbox" checked style=" height:30px ; width:30px ; margin: auto; margin-top: 10px;" class="form-control matrix-cell chkboxInvoice ">
							</center>
						</td>
				    	<td >
						<input type="text" class="form-control docnum d-none"  aria-label=" aria-describedby="button-addon2" style="outline: none; border:none; " readonly value="'. $DocEntry .'"/>
							<input type="text" class="form-control docnum2"  aria-label=" aria-describedby="button-addon2" style="outline: none; border:none; " readonly value="'. $DocNum .'"/>

					  </td>
					  <td >
						<input type="text" class="form-control matrix-cell documenttype"  style="outline: none; border:none" readonly value="'. $ObjType .'"/>

					  </td>
					  <td >
					<input type="text" class="form-control matrix-cell customrefno"  aria-label=" aria-describedby="button-addon2" style="outline: none; border:none" readonly value="'. $NumAtCard .'"/>

					  </td>
					  <td >
						<input type="text" class="form-control matrix-cell date"  aria-label=" aria-describedby="button-addon2" style="outline: none; border:none" readonly value="'. $DocDate .'"/>
					  </td>
					  <td >
						<input type="text" class="form-control matrix-cell duedate"  aria-label=" aria-describedby="button-addon2" style="outline: none; border:none" readonly value="'. $DocDueDate .'"/>
					  </td>
					  <td >
						<input type="text" class="form-control matrix-cell text-right total"   aria-label="" aria-describedby="button-addon2" style="outline: none; border:none" maxlength="12" readonly/  value="'. $DocTotal .'">
					  </td>
					  <td >
						<input type="text" class="form-control matrix-cell text-right balancedue"   style="outline: none; border:none" maxlength="8" readonly value="'. $Balance .'"/>
						<input type="text" class="form-control matrix-cell text-right balancedue2 d-none"   style="outline: none; border:none" maxlength="8" readonly value="'. $Balance .'"/>
						
					  </td>
					  <td >
							<input type="text" class="form-control matrix-cell text-right totalpayment"   style="outline: none; border:none" maxlength="8" value="'.$SumApplied.'"/>
					  </td>
					 
					   <td >
						<input type="text" class="form-control matrix-cell text-right wtaxamount"   aria-label="" aria-describedby="button-addon2" style="outline: none; border:none" maxlength="12" readonly/ value="'. $WTApplied .'">
						
					  </td>
						<td >
						<input type="text" class="form-control matrix-cell comments"  style="outline: none; border:none" readonly value="'. $Comments .'"/>

					  </td>
					   <td >
						  <input type="text" class="form-control matrix-cell serviceinvoice"  style="outline: none; border:none" value="'. $ServiceInvoice .'"/>
					</td>
					  
					</tr>'	;
			
					$ctr += 1;
				}

			


odbc_free_result($qry);
odbc_close($MSSQL_CONN);
?>
 </tbody>
  <tfoot style="z-index: 999;  background-color: lightgray; " class="d-none">
		<th class="text-right" style=" color: black; max-width:50px;">#</th>
		<th style="color: black; max-width:50px;">Select</th>
	    <th style="color: black; min-width:150px; ">Document No.</th>
	    <th style="color: black; min-width:150px;" >Document Type</th>
		<th style="color: black; min-width:150px;" >Document Type</th>
		<th style="color: black; min-width:150px; ">Customer Ref No.</th>
	    <th style="color: black; min-width:150px;">Date</th>
		<th style="color: black; min-width:150px;">Total</th>
		<th style="color: black; min-width:150px;">Balance Due</th>
	    <th style="color: black; min-width:150px;">Total Payment</th>
	    <th style="color: black; min-width:150px;">WTax Amount</th>
	    <th style="color: black; min-width:150px;">Doc. Remarks</th>
	    <!-- 
	    <th style="color: black; min-width:150px;">Department</th>
	    <th style="color: black; min-width:150px;">Branch</th>
	    <th style="color: black; min-width:150px;">Employee</th> 
	  	-->
	  </tfoot>
</table>				

<?php				
}

else if($docType == 'A'){
?>
<table id="tblDetails" class="table table-striped table-bordered table-sm detailsTable" cellspacing="0"  style="background-color: white">
  <thead style="z-index: 999;  background-color: lightgra  !important" class="thead-fixed " >
    <tr style="background-color: lightgray; z-index: 999 !important">
			<th class="text-right" style="color: black">#</th>
			<th style="color: black; min-width:300px;">G/L Account</th>
			<th style="color: black; min-width:400px;" >G/L Name</th>
			<th style="color: black; min-width:150px;">Doc. Remarks</th>
			<th style="color: black; min-width:150px;">Tax Definition</th>
			<th style="color: black; min-width:100px;">Net Amount</th>
			<!--
			<th style="color: black; min-width:150px;">Tax Amount</th>
			<th style="color: black; min-width:150px;">Gross Amount</th>
			<th style="color: black; min-width:150px;">Department</th>
			<th style="color: black; min-width:150px;">Branch</th>
			<th style="color: black; min-width:150px;">Employee</th>
			-->
	    
	    
    </tr>
  </thead>
  <tbody class="">

<?php
$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
SELECT 
	T0.DocNum,
	T0.DocEntry,
	T1.AcctCode,
	T1.AcctName,
	T1.Descrip,
	T1.VatGroup,
	T1.SumApplied,
	T1.VatAmnt,
	T1.GrossAmnt,
	T1.OcrCode,
	T1.OcrCode2,
	T1.OcrCode3

FROM ORCT T0
INNER JOIN RCT4 T1 ON T1.DocNum = T0.DocEntry
INNER JOIN OACT T2 ON T1.AcctCode = T2.AcctCode	

WHERE T0.DocEntry = $docNum



ORDER BY T1.LineId");
$ctr = 1;

while (odbc_fetch_row($qry)) 
{
	
	$DocNum = odbc_result($qry, 'DocNum');
	$DocEntry = odbc_result($qry, 'DocEntry');
	$AcctCode = odbc_result($qry, 'AcctCode');
	$AcctName = odbc_result($qry, 'AcctName');
	$Descrip = odbc_result($qry, 'Descrip');
	$VatGroup = odbc_result($qry, 'VatGroup');

	$SumApplied = number_format(odbc_result($qry, 'SumApplied'),6);
	$VatAmnt = number_format(odbc_result($qry, 'VatAmnt'),6);
	$GrossAmnt = number_format(odbc_result($qry, 'GrossAmnt'),6);

	$OcrCode = odbc_result($qry, 'OcrCode');
	$OcrCode2 = odbc_result($qry, 'OcrCode2');
	$OcrCode3 = odbc_result($qry, 'OcrCode3');




echo
     '<tr style="background-color: white; "  >
	 	<td class="rowno text-right" style="background-color: lightgray;color:black; font-size:13px;">
		<span>'.$ctr.'</span>
		<button type="button" class="btn d-none btnrowfunctions" data-toggle="dropdown" style="width:1px; padding-left: 0px !important;margin-left: 0px !important">
			<i class="fas fa-caret-down" ></i>
		</button>
		
		 <ul class="dropdown-menu rowfunctions" role="menu" style="background-color: #fdfd96;">
			<li class="deleterow" style="font-size:20px; color: black; font-weight:bold">Delete Row</a></li>
			<li class="duplicaterow"style="font-size:20px; color: black; font-weight:bold">Duplicate Row</a></li>
		  </ul>
		
	  </td>
	  <td >
		<div>
		<input type="text" class="form-control matrix-cell glaccount"  style="outline: none; border:none" readonly value="'. $AcctCode .'"/>
		</div>
	  </td>
	   <td >
		<input type="text" class="form-control matrix-cell glname"  aria-label="" aria-describedby="button-addon2" style="outline: none; border:none" maxlength="12" readonly value="'. $AcctName .'"/>
	  </td>
	  <td >
		<input type="text" class="form-control matrix-cell text-right docremarks"   aria-label="" aria-describedby="button-addon2" style="outline: none; border:none" maxlength="12" value="'. $Descrip .'"/>
	  </td>
	  <td >
			<div class="input-group ">
				<input type="text" class="form-control matrix-cell text-right quantity d-none"  aria-label="" aria-describedby="button-addon2" style="outline: none; border:none" maxlength="12" value="1"/>
					
				<input type="text" class="form-control matrix-cell text-right discount d-none"   style="outline: none; border:none" maxlength="8" value=0/>

				<input type="text" class="form-control matrix-cell text-right rowtotal d-none"   style="outline: none; border:none" maxlength="8" value=0/>
				<input type="text" class="form-control taxcode"  placeholder=""   readonly  value="'. $VatGroup .'"/>
			</div>
		<td >
		<input type="text" class="form-control matrix-cell text-right price"   style="outline: none; border:none" maxlength="8" value="'. $SumApplied .'"/>
	  </td>
	  </td>
	   <td >
		<input type="text" class="form-control matrix-cell text-right taxamount"    maxlength="12" readonly value="'. $VatAmnt .'"/>
	  </td>
	  <td >
		<input type="text" class="form-control matrix-cell text-right grossprice"    maxlength="12" readonly value="'. $GrossAmnt .'"/>
		<input type="text" class="form-control matrix-cell text-right grosstotal d-none"    maxlength="12" readonly/>	
	  </td>
    <td >
			<input type="text" class="form-control matrix-cell ocrcode"  style="outline: none; border:none" readonly value="'. $OcrCode .'"/>
	  </td>
	  <td >
			<input type="text" class="form-control matrix-cell ocrcode2"   style="outline: none; border:none" readonly value="'. $OcrCode2 .'"/>
	  </td>
	  <td >
			<input type="text" class="form-control matrix-cell ocrcode3"  style="outline: none; border:none" readonly value="'. $OcrCode3 .'"/>
	  </td>
    </tr>';
	


}
?>
  </tbody>
  <tfoot style="z-index: 999;  background-color: lightgray; " class="d-none">
  			<th class="text-right" style="color: black">#</th>
			<th style="color: black; min-width:300px;">G/L Account</th>
			<th style="color: black; min-width:400px;" >G/L Name</th>
			<th style="color: black; min-width:150px;">Doc. Remarks</th>
			<th style="color: black; min-width:150px;">Tax Definition</th>
			<th style="color: black; min-width:100px;">Net Amount</th>
	
	  </tfoot>
</table>

<?php
}

?>
<script>$('#tblDetails2').dataTable({
            scrollY: 300,
            scrollX: true,
		
            scroller: true,
			searching: false,
			ordering: false,
			bLengthChange: false,
			paging: false,
			info: false,
			
        });
</script>