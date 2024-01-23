<?php
session_start();
include_once('../../../../config/config.php');

$docNum = $_GET['docNum'];
$objType = $_GET['objType'];

$table = '';
$table2 = '';
if($objType == 30){
	$table = 'OJDT';
	$table2 = 'JDT1';
}




$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
	SELECT

		T0.Number,
		T0.TransId,

		T1.Line_ID,
		T1.Account,
		T1.Debit,
		T1.Credit,
		T1.ShortName,
		T1.ContraAct,
		T1.LineMemo,
		T1.BPLId,
		T1.ProfitCode,
		T1.OcrCode2,
		T1.OcrCode3,
		T2.AcctName,

		T3.Bplname
		
	FROM " . $table . " T0 
	INNER JOIN " . $table2 . " T1 ON T0.TransId = T1.TransId
	INNER JOIN OACT T2 ON T1.Account = T2.AcctCode
	LEFT JOIN OBPL T3 ON T1.BplId = T3.BPLId


			WHERE T0.Number = $docNum
			ORDER BY T1.Line_ID ASC");
$ctr = 1;

while (odbc_fetch_row($qry)) 
{
	
	$Number = odbc_result($qry, "Number");
	$TransId = odbc_result($qry, "TransId");
	$Line_ID = odbc_result($qry, "Line_ID");
	$Account = odbc_result($qry, "Account");
	$ShortName = odbc_result($qry, "ShortName");
	$AcctName = odbc_result($qry, "AcctName");
	$BPLId = odbc_result($qry, "BPLId");
	$Bplname = odbc_result($qry, "Bplname");
	$ContraAct = odbc_result($qry, "ContraAct");

	$Debit = number_format(odbc_result($qry, "Debit"),2);
	$Credit = number_format(odbc_result($qry, "Credit"),2);

	$ProfitCode = odbc_result($qry, "ProfitCode");
	$OcrCode2 = odbc_result($qry, "OcrCode2");
	$OcrCode3 = odbc_result($qry, "OcrCode3");

	$DebitNoZero = ($Debit == 0.00 ? '' : $Debit);
	$CreditNoZero = ($Credit == 0.00 ? '' : $Credit);
	echo '
		<tr style="background-color: white; "  >
			<td class="rowno text-right" style="background-color: lightgray;color:black; font-size:13px;">
				<span>'.$ctr.'</span>
				<button type="button" class="btn d-none btnrowfunctions" data-toggle="dropdown" style="width:1px; padding-left: 0px !important;margin-left: 0px !important">
				<i class="fas fa-caret-down" ></i>
				</button>
			</td>
			<td>
				<div class="">
					<input type="text" class="form-control matrix-cell glaccount" style="outline: none; border:none" readonly 
					value="'.$Account.'"/>
				</div>
			</td>
			<td >
				<input type="text" class="form-control matrix-cell glname"  style="outline: none; border:none" maxlength="12" readonly 
				value="'.$AcctName.'"/>
			</td>
			<td >
				<div class="" >
					<input type="text" class="form-control matrix-cell text-left controlaccount"    style="outline: none; border:none" maxlength="12" readonly value="'.$ContraAct.'"/>
				</div>
			</td>
			<td >
				<input type="text" class="form-control matrix-cell text-right debit"    maxlength="12" style="outline: none; border:none" maxlength="12" readonly value="'.$DebitNoZero.'"/>
			</td>
			<td >
				<input type="text" class="form-control matrix-cell text-right credit"    maxlength="12" style="outline: none; border:none" maxlength="12" readonly value="'.$CreditNoZero.'"/>
			</td>
			
	
		</tr>';
   $ctr++;
}

odbc_free_result($qry);
odbc_close($MSSQL_CONN);

?>
