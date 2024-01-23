<?php
session_start();
include_once('../../../../config/config.php');
$txtDocNum = $_GET['txtDocNum'];
$lineNo = $_GET['lineNo'];
$objectTable = $_GET['objectTable'];
$objectType = $_GET['objectType'];
$childTable1 = $_GET['childTable1'];

?>

            <table class="table table-striped table-bordered table-hover" id="tblSerial" style="width:100%;  ">
						<thead >
							<tr>
								<th style="  position: sticky;top: 0; min-width:30px!important;" >#</th>
								<th style="  position: sticky;top: 0; min-width:30px!important;" class="d-none" >DocLineNo</th>
								<th  style="  position: sticky;top: 0; min-width:200px!important ">Item Code</th>
								<th  style="  position: sticky;top: 0; min-width:200px!important ">Item Name</th>
								<th  style="  position: sticky;top: 0; min-width:200px!important  ">Mfr Serial No</th>
								<th  style="  position: sticky;top: 0;  min-width:200px!important ">Serial Number</th>
								<th  style="  position: sticky;top: 0; min-width:200px!important  ">Lot Number</th>
								<th  style="  position: sticky;top: 0; min-width:200px!important  ">Expiration Date</th>
								<th  style="  position: sticky;top: 0; min-width:200px!important  ;">Mfr Date</th>
								<th  style="  position: sticky;top: 0; min-width:200px!important ">Admission Date</th>
								<th  style="  position: sticky;top: 0;min-width:200px!important  ">Whse Code</th>
								<th  style="  position: sticky;top: 0;min-width:200px!important  ">Location</th>
							</tr>
						</thead>
						<tbody>
					
					
<?php
$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
SELECT
	T0.DocNum, 
	T0.CardCode,
	T0.CardName,
	T1.ItemCode,
	T1.Dscription, 
	T1.WhsCode,
	T1.Quantity,
	T1.LineNum,
	T7.SysNumber,
	T7.MnfSerial,
	T7.DistNumber,
	T7.LotNumber,
	T7.Quantity,
	T7.ExpDate,
	T7.MnfDate,
	T7.InDate,
	T7.Location,
	T7.CostTotal

	FROM $objectTable T0 
	INNER JOIN $childTable1 T1 ON T0.DocEntry = T1.DocEntry
	INNER join OITL T5 on T1.docentry = T5.DocEntry AND T1.LineNum = T5.ApplyLine AND T5.[ApplyType] = $objectType 
	INNER JOIN ITL1 T6 ON T5.LogEntry = T6.LogEntry
	INNER join OSRN T7 on T6.[ItemCode] = T6.[ItemCode] and T6.[MdAbsEntry] = t7.[absentry] 
	INNER JOIN OITM T8 ON T8.ItemCode = T1.ItemCode
	
	WHERE 
	T0.DocNum = $txtDocNum 
	AND T5.DocLine = $lineNo
	AND 
	T8.ManSerNum = 'Y'
	
	UNION ALL
	
	SELECT
	T0.DocNum, 
	T0.CardCode,
	T0.CardName,
	T1.ItemCode,
	T1.Dscription, 
	T1.WhsCode,
	T1.Quantity,
	T1.LineNum,
	T7.SysNumber,
	T7.MnfSerial,
	T7.DistNumber,
	T7.LotNumber,
	T7.Quantity,
	T7.ExpDate,
	T7.MnfDate,
	T7.InDate,
	T7.Location,
	T7.CostTotal

	FROM $objectTable T0 
	INNER JOIN $childTable1 T1 ON T0.DocEntry = T1.DocEntry
	INNER join OITL T5 on T1.docentry = T5.DocEntry  AND T1.LineNum = T5.ApplyLine AND T5.[ApplyType] = $objectType 
	INNER JOIN ITL1 T6 ON T5.LogEntry = T6.LogEntry
	INNER join OSRN T7 on T6.[ItemCode] = T6.[ItemCode] and T6.[MdAbsEntry] = t7.[absentry] 
	INNER JOIN OITM T8 ON T8.ItemCode = T1.ItemCode
	  
	WHERE 
	T0.DocNum = $txtDocNum 
	AND T5.DocLine != $lineNo
	AND 
	T8.ManSerNum = 'Y'
	
	ORDER BY T1.LineNum ASC");
$ctr = 1;

while (odbc_fetch_row($qry)) 
{
	$LineNum = odbc_result($qry, "LineNum");
	$ItemCode = odbc_result($qry, "ItemCode");
	$Dscription = odbc_result($qry, "Dscription");
	$WhsCode = odbc_result($qry, "WhsCode");
	$MnfSerial = odbc_result($qry, "MnfSerial");
	$DistNumber = odbc_result($qry, "DistNumber");
	$LotNumber = odbc_result($qry, "LotNumber");
	$Quantity = number_format(odbc_result($qry, "Quantity"),0);
	$ExpDate = is_null(odbc_result($qry, 'ExpDate')) ? '' : SAPDateFormater(odbc_result($qry, 'ExpDate'));
	$MnfDate = is_null(odbc_result($qry, 'MnfDate')) ? '' : SAPDateFormater(odbc_result($qry, 'MnfDate'));
	$InDate = SAPDateFormater(odbc_result($qry, 'InDate'));
	
    $Location = odbc_result($qry, "Location");
	$Notes = 'hey';
	$CostTotal = number_format(odbc_result($qry, "CostTotal"),2);

	echo '
	<tr style="background-color: white; "  >
		<td class="rowno text-right" style="background-color: lightgray;color:black; font-size:13px;">
			<span>'.$ctr.'</span>
		</td>
		<td class="doclineno d-none" >'.$LineNum.'</td>
		<td class="itemcode"    >'.$ItemCode.'</td>
		<td class="itemname"   >'.$Dscription.'</td>
		<td class="mnfserial"    >'.$MnfSerial.'</td>
		<td class="serial"  >'.$DistNumber.'</td>
		<td class="lotnumber"   >'.$LotNumber.'</td>
		<td class="expdate"    >'.$ExpDate.'</td>
		<td class="mnfdate"    >'.$MnfDate.'</td>
		<td class="admindate"  >'.$InDate.'</td>
		<td class="whscode"  >'.$WhsCode.'</td>
		<td class="location"  >'.$Location.'</td>
	</tr>';
	$ctr++;
		}
		
?>

	
						</tbody>
					</table>
					
					
					
	


