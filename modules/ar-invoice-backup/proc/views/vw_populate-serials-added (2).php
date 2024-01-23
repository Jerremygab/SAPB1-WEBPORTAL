<?php
session_start();
include_once('../../../../config/config.php');
$txtDocNum = $_GET['txtDocNum'];
$rowNo = $_GET['rowNo'];
$itemCode = $_GET['itemCode'];
$objectTable = $_GET['objectTable'];
$objectType = $_GET['objectType'];
$childTable1 = $_GET['childTable1'];

$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
SELECT
	T0.DocNum, 
	T0.CardCode,
	T0.CardName,
	T1.ItemCode,
	T1.Dscription, 
	T7.SysNumber,
	T7.MnfSerial,
	T7.DistNumber,
	T7.Quantity,
	T7.ExpDate,
	T7.MnfDate,
	T7.InDate,
	T7.Location,
	T7.CostTotal

	FROM $objectTable T0 
	INNER JOIN $childTable1 T1 ON T0.DocEntry = T1.DocEntry
	INNER join OITL T5 on T1.docentry = T5.DocEntry and T1.[LineNum] = T5.DocLine and T5.[ApplyType] = $objectType AND T5.ItemCode = T1.ItemCode
	INNER JOIN ITL1 T6 ON T5.LogEntry = T6.LogEntry
	INNER join OSRN T7 on T6.[ItemCode] = T6.[ItemCode] and T6.[MdAbsEntry] = t7.[absentry] 
	  
	WHERE 
	T0.DocNum = $txtDocNum 
	AND T1.LineNum + 1 = $rowNo
	AND T1.ItemCode = '$itemCode'
	
	ORDER BY T1.LineNum ASC");
$ctr = 1;

while (odbc_fetch_row($qry)) 
{
	$MnfSerial = odbc_result($qry, "MnfSerial");
	$DistNumber = odbc_result($qry, "DistNumber");
	$Quantity = number_format(odbc_result($qry, "Quantity"),0);
	$ExpDate = is_null(odbc_result($qry, 'ExpDate')) ? '' : date('Y-m-d' ,strtotime(odbc_result($qry, 'ExpDate')));
	$MnfDate = is_null(odbc_result($qry, 'MnfDate')) ? '' : date('Y-m-d' ,strtotime(odbc_result($qry, 'MnfDate')));
	$InDate = date('Y-m-d' ,strtotime(odbc_result($qry, 'InDate')));
	
    $Location = odbc_result($qry, "Location");
	$Notes = 'hey';
	$CostTotal = number_format(odbc_result($qry, "CostTotal"),2);
						

$i = 1;

	echo '
	<tr style="background-color: white; "  >
		<td class="rowno text-right" style="background-color: lightgray;color:black; font-size:13px;">
			<span>'.$i.'</span>
			
		</td>
		<td >
			<input type="text" class="form-control mfrserial"   aria-describedby="button-addon2" style="outline: none; border:none; " value="'.$MnfSerial.'" readonly/>
			<input type="hidden" class="form-control baseentry"  style="outline: none; border:none; " readonly/>
			<input type="hidden" class="form-control linenum"   style="outline: none; border:none; " readonly/>
			<input type="hidden" class="form-control tbldetailrowno"   style="outline: none; border:none; " value="'.$rowNo.'"/>
		</td>
		<td class="">
			<input type="text" class="form-control matrix-cell text-right serial"  aria-label="" aria-describedby="button-addon2" style="outline: none; border:none" maxlength="12" value="'.$DistNumber.'" readonly/>	
		</td>
		<td >
			<input type="date" class="form-control  matrix-cell expdate" style="outline: none; border:none;" placeholder="" aria-label="Username" aria-describedby="basic-addon1" value="'.$ExpDate.'" min="2018-01-01" max="2050-12-31" readonly>						
		</td>
		<td >
			<input type="date" class="form-control  matrix-cell mfrdate" style="outline: none; border:none;" placeholder="" aria-label="Username" aria-describedby="basic-addon1" value="'.$MnfDate.'"  min="2018-01-01" max="2050-12-31" readonly>						
		</td>
		<td >
			<input type="date" class="form-control  matrix-cell admindate" style="outline: none; border:none;" placeholder="" aria-label="Username" aria-describedby="basic-addon1" value="'.$InDate.'"  min="2018-01-01" max="2050-12-31" readonly>						
		</td>
		<td >
			<input type="text" class="form-control matrix-cell text-right location"   style="outline: none; border:none" maxlength="8" value="'.$Location.'" readonly/>
		</td>
		<td >
			<input type="text" class="form-control text-right details"   style="outline: none; border:none" maxlength="8" value="'.$Notes.'" readonly/>
		</td>
		<td >
			<input type="text" class="form-control matrix-cell text-right unitcost"   aria-label="" aria-describedby="button-addon2" style="outline: none; border:none" maxlength="12" value="'.$CostTotal.'" readonly/>
		</td>
	</tr>';
	$i++;
		}
		
?>
	


