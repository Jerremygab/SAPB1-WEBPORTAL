<?php
session_start();
include_once('../../../../config/config.php');

$transID = $_GET['transID'];
$currency = $_GET['currency'];

$counter = 0;
$defaultRows = 13;
$blankrows = 0;
$DebitSum = 0;
$CreditSum = 0;
$Currency = '';
$qryCtr = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
	SELECT COUNT(T1.Line_ID) AS Counter
	FROM JDT1 T1 

	WHERE T1.TransID = $transID
		");

while (odbc_fetch_row($qryCtr)) 
{
	$counter = odbc_result($qryCtr, "Counter");
}
$blankrows = $defaultRows - $counter;

$qrySum = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
	SELECT 
		SUM(T1.Debit) AS DebitSum,
		SUM(T1.Credit) AS CreditSum
	FROM JDT1 T1 

	WHERE T1.TransID = $transID
		");

while (odbc_fetch_row($qrySum)) 
{
	$DebitSum = number_format(odbc_result($qrySum, "DebitSum"),2);
	$CreditSum = number_format(odbc_result($qrySum, "CreditSum"),2);
}


$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
	SELECT

	T0.TransID,
	T1.Account,
	T1.ShortName,
	T1.ContraAct,
	T1.Debit,
	T1.Credit,
	T1.FCDebit,
	T1.FCCredit,
	T1.LineMemo,
	T1.RmrkTmpt,

	T2.AcctName


	FROM OJDT T0 
	INNER JOIN JDT1 T1 ON T0.TransID = T1.TransID
	INNER JOIN OACT T2 ON T2.AcctCode = T1.ShortName


	WHERE T0.TransID = $transID
	ORDER BY T1.Line_ID ASC");
$ctr = 1;



while (odbc_fetch_row($qry)) 
{
	
	$Account = odbc_result($qry, "Account");
	$ShortName = odbc_result($qry, "ShortName");
	$ContraAct = odbc_result($qry, "ContraAct");
	
	$RmrkTmpt = odbc_result($qry, "RmrkTmpt");
	
	$AcctName = odbc_result($qry, "AcctName");
	$LineMemo = odbc_result($qry, "LineMemo");
	
	$Debit = number_format(odbc_result($qry, "Debit"),2);
	$Credit = number_format(odbc_result($qry, "Credit"),2);
	$DebitWithCurr = '';
	$CreditWithCurr = '';
	if($Debit > 0){
		$DebitWithCurr = $currency . ' ' . $Debit;
	}
	if($Credit > 0){
		$CreditWithCurr = $currency . ' ' . $Credit;
	}
	
	
	
   
					echo 
					'<tr style="background-color: white; min-width:2%"  >
					  <td class="rowno text-right" style="background-color: lightgray;color:black; padding-top:0px !important;padding-bottom:0px !important;">
						<span>'.$ctr.'</span>
						
					  </td>
						<td style=" padding-top:0px !important;padding-bottom:0px !important;">
							'.$ShortName.'
						</td>
						<td style=" padding-top:0px !important;padding-bottom:0px !important;">
							'.$AcctName.'
						</td>
						<td style=" padding-top:0px !important;padding-bottom:0px !important;">
							'.$Account.'
						</td>
						<td class="text-right" style=" padding-top:0px !important;padding-bottom:0px !important;">
							'.$DebitWithCurr.'	
						</td>
						<td class="text-right" style=" padding-top:0px !important;padding-bottom:0px !important;">
							'.$CreditWithCurr.'
						</td>
						<td style=" padding-top:0px !important;padding-bottom:0px !important;">
							'.$RmrkTmpt.'	
						</td>
					 
					</tr>'
					;
			
					$ctr += 1;
				
	}
odbc_free_result($qry);
odbc_close($MSSQL_CONN);

$counter2 = $counter + 1;
for ($x = 1; $x <= $blankrows; $x++) {
	
  echo 
					'<tr style="background-color: white; "  >
					  <td class="rowno text-right" style="background-color: lightgray;color:black; padding-top:0px !important;padding-bottom:0px !important;">
						<span class="">'.$counter2.'</span>
						
					  </td>
						<td style=" padding-top:0px !important;padding-bottom:0px !important;">
							
						</td>
						<td style=" padding-top:0px !important;padding-bottom:0px !important;">
							
						</td>
						<td style=" padding-top:0px !important;padding-bottom:0px !important;">
							
						</td>
						<td class="text-right" style=" padding-top:0px !important;padding-bottom:0px !important;">
							
						</td>
						<td class="text-right" style=" padding-top:0px !important;padding-bottom:0px !important;">
							
						</td>
						<td style=" padding-top:0px !important;padding-bottom:0px !important;">
							
						</td>
					 
					</tr>'
					;
					$counter2 += 1;
}

  echo 
					'<tr style="background-color: white; "  >
					  <td class="rowno text-right" style="background-color: lightgray;color:black; padding-top:0px !important;padding-bottom:0px !important;">
						<span class=""></span>
						
					  </td>
						<td style=" padding-top:0px !important;padding-bottom:0px !important;">
							
						</td>
						<td style=" padding-top:0px !important;padding-bottom:0px !important;">
							
						</td>
						<td style=" padding-top:0px !important;padding-bottom:0px !important;">
							
						</td>
						<td class="text-right" style=" padding-top:0px !important;padding-bottom:0px !important; background-color: lightgray; ">
							'.$currency . ' ' .$DebitSum.'
						</td>
						<td class="text-right" style=" padding-top:0px !important;padding-bottom:0px !important; background-color: lightgray; ">
							'.$currency . ' ' .$CreditSum.'
						</td>
						<td style=" padding-top:0px !important;padding-bottom:0px !important;">
							
						</td>
					 
					</tr>'
?>
