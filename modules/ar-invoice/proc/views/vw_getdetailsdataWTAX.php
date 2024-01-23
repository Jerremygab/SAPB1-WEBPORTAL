<?php
session_start();
include_once('../../../../config/config.php');

$docNum = $_GET['docNum'];


$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
	SELECT 
		T0.Absentry,
		T0.WTCode,
		T2.WTName,
		T0.Rate,
		T0.TaxbleAmnt,
		T0.WTAmnt,
		T0.Account
				
	FROM INV5 T0 
	INNER JOIN OINV T1 ON T0.Absentry = T1.DocEntry
	INNER JOIN OWHT T2 ON T2.WTCode = T0.WTCode

			WHERE T1.DocNum = $docNum
			");
$ctr = 1;

while (odbc_fetch_row($qry)) 
{
	
	$Absentry = odbc_result($qry, "Absentry");
	$WTCode = odbc_result($qry, "WTCode");
	$WTCode = odbc_result($qry, "WTCode");
	$WTName = odbc_result($qry, "WTName");
	
	
	$Rate = number_format(odbc_result($qry, "Rate"),2);
	$TaxbleAmnt = number_format(odbc_result($qry, "TaxbleAmnt"),2);
	$WTAmnt = number_format(odbc_result($qry, "WTAmnt"),2);
	

	$Account = odbc_result($qry, "Account");
	

	
	$readonly = '';
	$inputGroup = 'input-group';
	$buttonHide = '';
	$disabled = '';
	$hasBatchSerial = '';


			
					
			


   
					echo 
					' <tr style="background-color: white; "  >
						 <td class="rowno text-right" style="background-color: lightgray;color:black; font-size:13px;">
							<span>1</span>
						
						  </td>
						 <td>
							<input type="text" class="form-control wtcode"   style="outline: none; border:none; " value="'.$WTCode.'"readonly/>
						</td>
						 <td >
							<input type="text" class="form-control matrix-cell text-right wtname"  style="outline: none; border:none" maxlength="12"  value="'.$WTName.'" readonly/>
						  </td>
						   <td >
							<input type="text" class="form-control matrix-cell text-right rate"  style="outline: none; border:none" maxlength="12"  value="'.$Rate.'" readonly/>
						  </td>
						    <td >
							<input type="text" class="form-control matrix-cell text-right baseamount"   style="outline: none; border:none" maxlength="12"   value="'.$WTCode.'" readonly/>
							
						  </td>
						   <td >
							<input type="text" class="form-control matrix-cell text-right taxableamount"  style="outline: none; border:none" maxlength="12"  value="'.$TaxbleAmnt.'" readonly/>
						  </td>
						  <td >
							<input type="text" class="form-control matrix-cell text-right wtaxamount"  style="outline: none; border:none" maxlength="12"  value="'.$WTAmnt.'" readonly/>
						  </td>
						   <td >
							<input  type="number" class="form-control matrix-cell text-right glaccountwtax "  style="outline: none; border:none" value="'.$Account.'"  readonly/>	
						  </td>
						</tr>';
						
						$ctr += 1;
				
	}
odbc_free_result($qry);
odbc_close($MSSQL_CONN);

?>
