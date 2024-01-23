<?php
session_start();
include_once('../../../../config/config.php');
$txtDocNum = $_GET['txtDocNum'];
$lineNo = $_GET['lineNo'];
?>

            <table class="table table-striped table-bordered table-hover" id="tblBatch" style="width:100%;  ">
						<thead >
							<tr>
								<th style="  position: sticky;top: 0; min-width:30px!important;" >#</th>
								<th style="  position: sticky;top: 0; min-width:30px!important;" class="d-none" >DocLineNo</th>
								<th  style="  position: sticky;top: 0; min-width:200px!important ">Item Code</th>
								<th  style="  position: sticky;top: 0; min-width:200px!important ">Item Name</th>
								<th  style="  position: sticky;top: 0; min-width:200px!important  ">Batch</th>
								<th  style="  position: sticky;top: 0;  min-width:200px!important ">Whse Code</th>
								<th  style="  position: sticky;top: 0; min-width:200px!important  ">Quantity</th>
								<th  style="  position: sticky;top: 0; min-width:200px!important  ">Expiration Date</th>
								<th  style="  position: sticky;top: 0; min-width:200px!important  ;">Mfr Date</th>
								<th  style="  position: sticky;top: 0; min-width:200px!important ">Admission Date</th>
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
	T1.LineNum,
	T7.SysNumber,
	T7.DistNumber,
	T6.Quantity,
	T7.ExpDate,
	T7.MnfDate,
	T7.InDate,
	T7.Location,
	T7.CostTotal

	FROM OPDN T0 
	INNER JOIN PDN1 T1 ON T0.DocEntry = T1.DocEntry
	INNER JOIN OITL T5 ON T1.docentry = T5.[ApplyEntry] AND T1.[LineNum] = T5.[ApplyLine] AND T5.[ApplyType] = 20 
	INNER JOIN ITL1 T6 ON T5.LogEntry = T6.LogEntry
	INNER JOIN OBTN T7 ON T6.[ItemCode] = T6.[ItemCode] AND T6.[MdAbsEntry] = t7.[absentry] 
	INNER JOIN OITM T8 ON T8.ItemCode = T1.ItemCode
	  
	WHERE 
	T0.DocNum = $txtDocNum 
	AND T8.ManBtchNum = 'Y'
	AND T5.DocLine = $lineNo
	
UNION ALL

SELECT
	T0.DocNum, 
	T0.CardCode,
	T0.CardName,
	T1.ItemCode,
	T1.Dscription, 
	T1.WhsCode,
	T1.LineNum,
	T7.SysNumber,
	T7.DistNumber,
	T6.Quantity,
	T7.ExpDate,
	T7.MnfDate,
	T7.InDate,
	T7.Location,
	T7.CostTotal

	FROM OPDN T0 
	INNER JOIN PDN1 T1 ON T0.DocEntry = T1.DocEntry
	INNER JOIN OITL T5 ON T1.docentry = T5.[ApplyEntry] AND T1.[LineNum] = T5.[ApplyLine] AND T5.[ApplyType] = 20 
	INNER JOIN ITL1 T6 ON T5.LogEntry = T6.LogEntry
	INNER JOIN OBTN T7 ON T6.[ItemCode] = T6.[ItemCode] AND T6.[MdAbsEntry] = t7.[absentry] 
	INNER JOIN OITM T8 ON T8.ItemCode = T1.ItemCode
	  
	WHERE 
	T0.DocNum = $txtDocNum 
	AND T8.ManBtchNum = 'Y'
	AND T5.DocLine != $lineNo
	
	ORDER BY T1.LineNum ASC");
$ctr = 1;

while (odbc_fetch_row($qry)) 
{
	$LineNum = odbc_result($qry, "LineNum");
	$ItemCode = odbc_result($qry, "ItemCode");
	$Dscription = odbc_result($qry, "Dscription");
	$WhsCode = odbc_result($qry, "WhsCode");
	$DistNumber = odbc_result($qry, "DistNumber");
	$Quantity = number_format(odbc_result($qry, "Quantity"),0);
	$ExpDate = date('Y-m-d' ,strtotime(odbc_result($qry, 'ExpDate')));
	$MnfDate = date('Y-m-d' ,strtotime(odbc_result($qry, 'MnfDate')));
	$InDate = date('Y-m-d' ,strtotime(odbc_result($qry, 'InDate')));
	
    $Location = odbc_result($qry, "Location");
	$Notes = 'hey';
	$CostTotal = number_format(odbc_result($qry, "CostTotal"),2);

	echo '
	<tr style="background-color: white; "  >
		<td class="rowno text-right" style="background-color: lightgray;color:black; font-size:13px;">
			<span>'.$ctr.'</span>
		</td>
		<td class="itemcode"    >'.$ItemCode.'</td>
		<td class="doclineno d-none" >'.$LineNum.'</td>
		<td class="itemname"   >'.$Dscription.'</td>
		<td class="batch"  >'.$DistNumber.'</td>
		<td class="whsecode"   >'.$WhsCode.'</td>
		<td class="quantity"   >'.$Quantity.'</td>
		<td class="expdate"    >'.$ExpDate.'</td>
		<td class="mnfdate"    >'.$MnfDate.'</td>
		<td class="admindate"  >'.$InDate.'</td>
		<td class="location"  >'.$Location.'</td>
	</tr>';
	$ctr++;
		}
		
?>

	
						</tbody>
					</table>
					
					
					
	


