<?php
session_start();
include_once('../../../../config/config.php');

$docNum = $_GET['docNum'];


?>


<div class="">
<table id="tblCheck" class="table table-striped table-bordered table-sm detailsTable" cellspacing="0"  style="background-color: white; width:100% !important;"  cellspacing="0">
  <thead   style="border-bottom: 0 !important; ">
    <tr >
			<th class="text-right" style=" color: black;">#</th>
			<th style="color: black; min-width:120px;">Due Date</th>
			<th style="color: black; min-width:150px;">Amount</th>
			<th style="color: black; min-width:250px;">Bank Name</th>
			<th style="color: black; min-width:150px;">Branch</th>
			<th style="color: black; min-width:150px;">Account</th>
			<th style="color: black; min-width:100px;">Manual Check</th>
			<th style="color: black; min-width:150px;">Check No.</th>
			<th style="color: black; min-width:150px;">GL Account</th>
    </tr>
  </thead>

  <tbody class="">
<?php



	$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
SELECT 

T0.DocNum,
T0.DocEntry,
T1.DueDate,
T1.CheckSum,
T1.BankCode,
T1.Branch,
T1.AcctNum,
T1.ManualChk,
T1.CheckNum,
T1.CheckAct,
T2.BankName


FROM OVPM T0
INNER JOIN VPM1 T1 ON T1.DocNum = T0.DocEntry
INNER JOIN ODSC T2 ON T2.BankCode = T1.BankCode


WHERE T0.DocEntry = $docNum


ORDER BY T1.LineId");
$ctr = 1;

while (odbc_fetch_row($qry)) 
{
	
	$DocNum = odbc_result($qry, 'DocNum');
	$DocEntry = odbc_result($qry, 'DocEntry');
	$DueDate = date('Y-m-d' ,strtotime(odbc_result($qry, 'DueDate')));
	$CheckSum = number_format(odbc_result($qry, 'CheckSum'),2);
	$BankCode = odbc_result($qry, 'BankCode');
	$Branch = odbc_result($qry, 'Branch');
	$AcctNum = odbc_result($qry, 'AcctNum');
	$ManualChk = odbc_result($qry, 'ManualChk');
	$CheckNum = odbc_result($qry, 'CheckNum');
	$CheckAct = odbc_result($qry, 'CheckAct');
	$BankName = odbc_result($qry, 'BankName');

	$checked = '';
	if($ManualChk == 'Y'){
		$checked = 'checked';
	}
	else{
		$checked = '';
	}
	
	echo 	' <tr style="background-color: white; "  >
															 <td class="rowno text-right" style="background-color: lightgray;color:black; font-size:13px;">
																<span>1</span>
															
															  </td>
															 <td class="row">
																	<input type="text" class="form-control  matrix-cell duedate2 col-12" style="outline: none; border:none;" readonly/>
																	<input type="date" class="form-control  matrix-cell duedate col-3 d-none" style="outline: none; border:none;" value="'.$DueDate.'"/>
																  </td>
															    <td >
																<input type="text" class="form-control matrix-cell text-right checkamount"  style="outline: none; border:none" maxlength="12"  readonly value="'.$CheckSum.'"/>
																
															  </td>
															    <td >
																<input type="text" class="form-control matrix-cell bankcode"   style="outline: none; border:none" maxlength="8"  readonly value="'.$BankName.'"/>
																
															  </td>
															     <td >
																<input type="text" class="form-control matrix-cell text-right branch"   style="outline: none; border:none" maxlength="12" readonly  value="'.$Branch.'"/>
																
															  </td>
															  <td >
																	<input type="text" class="form-control matrix-cell text-right account"  style="outline: none; border:none" maxlength="12" readonly  value="'.$AcctNum.'"/>
															  </td>
															  <td >
																	<center>
																		<input type="checkbox" style=" height:20px ; width:20px " class="form-control matrix-cell chkBoxManualCheck " '.$checked.'>
																	</center>	
															  </td>
															   <td >
																<input  type="number" class="form-control matrix-cell text-right checkno "  style="outline: none; border:none" readonly/  value="'.$CheckNum.'">	
															  </td>
															   <td >
																<input  type="text" class="form-control matrix-cell text-right glAcctCheck " style="outline: none; border:none" readonly/  value="'.$CheckAct.'">	
															  </td>
    												</tr>'	;
			
					$ctr += 1;
				}

			


odbc_free_result($qry);
odbc_close($MSSQL_CONN);
?>
 </tbody>
  <tfoot style="z-index: 999;  background-color: lightgray; " class="d-none">
		<tr style="background-color: lightgray; z-index: 999">
		<th class="text-right" style=" color: black;">#</th>
		<th style="color: black; min-width:120px;">Due Date</th>
	    <th style="color: black; min-width:150px;">Amount</th>
		<th style="color: black; min-width:250px;">Bank Name</th>
	    <th style="color: black; min-width:150px;">Branch</th>
		<th style="color: black; min-width:150px;">Account</th>
		<th style="color: black; min-width:100px;">Manual Check</th>
	    <th style="color: black; min-width:150px;">Check No.</th>
	    <th style="color: black; min-width:150px;">GL Account</th>
  	 	</tr>
	  </tfoot>
</table>				