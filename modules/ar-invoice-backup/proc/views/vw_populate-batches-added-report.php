<?php
session_start();
include_once('../../../../config/config.php');
$txtDocNum = $_GET['txtDocNum'];
$lineNo = $_GET['lineNo'];
$itemCodeBatch = $_GET['itemCodeBatch'];
$objectTable = $_GET['objectTable'];
$objectType = $_GET['objectType'];
$childTable1 = $_GET['childTable1'];

?>

            <table class="table table-striped table-bordered table-hover" id="tblBatchCreated" style="width:100%;  ">
						<thead >
							<tr>
								<th style="  position: sticky;top: 0; min-width:30px!important;" >#</th>
								<th style="  position: sticky;top: 0; min-width:100px!important;" >Doc. No.</th>
								<th  style="  position: sticky;top: 0; min-width:200px!important ">Doc. Line</th>
								<th  style="  position: sticky;top: 0; min-width:200px!important ">Date</th>
								<th  style="  position: sticky;top: 0; min-width:200px!important  ">Whse</th>
								<th  style="  position: sticky;top: 0; min-width:200px!important  ">G/L Acct/ BP </th>
								<th  style="  position: sticky;top: 0; min-width:200px!important  ">Qty</th>
								<th  style="  position: sticky;top: 0; min-width:200px!important  ;">Allocated</th>
								<th  style="  position: sticky;top: 0; min-width:200px!important ">Direction</th>
							</tr>
						</thead>
						<tbody>
					
<?php
$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
	SELECT DISTINCT
	T0.[ItemCode], 
	T0.[ItemName], 
	T0.[BatchNum], 
	T0.[WhsCode], 
	T0.[Quantity], 
	CASE WHEN T0.[Direction]=0 THEN 'In' WHEN T0.[Direction]=1 THEN 'Out' END Direction, 
	CASE WHEN T1.[Status]=0 THEN 'Released' END Status,
	T0.BaseType,
	T0.BaseEntry,
	T0.BaseNum,
	T0.BaseLinNum + 1 AS BaseLinNum,
	T0.BaseLinNum,
	T2.DocDate,
	T2.CardName
	
	FROM IBT1 T0  
	
	INNER JOIN OIBT T1 ON T0.BatchNum = T1.Batchnum AND T0.Itemcode=T1.ItemCode 
	INNER JOIN $objectTable T2 ON T2.DocNum = T0.BaseNum 
	INNER JOIN $childTable1 T3 ON T3.LineNum = T0.BaseLinNum AND T3.DocEntry = T0.BaseEntry
	
	WHERE 
	T1.[ItemCode] = '$itemCodeBatch' 
	AND T0.BaseType = $objectType 
	AND T0.BaseEntry  = $txtDocNum 
	AND T0.BaseLinNum  = $lineNo 
	
	ORDER BY T0.BaseLinNum ASC");
$ctr = 1;

while (odbc_fetch_row($qry)) 
{
	$BaseNum = odbc_result($qry, "BaseNum");
	$BaseLinNum = odbc_result($qry, "BaseLinNum");
	$CardName = odbc_result($qry, "CardName");
	$Quantity = number_format(odbc_result($qry, "Quantity"),0);
	$WhsCode = odbc_result($qry, "WhsCode");
	$DocDate = SAPDateFormater(odbc_result($qry, 'DocDate'));
	$Allocated = 0;
    $Direction = odbc_result($qry, "Direction");
						

$i = 1;

	echo '
	<tr style="background-color: white; "  >
		<td class="tbldetailrowno ">'.$i.'</td>
		<td class="docnumber">PD '.$BaseNum.'</td>
		<td class="rowcount">'.$BaseLinNum.'</td>
		<td class="itemname">'.$DocDate.'</td>
		<td class="whsecode">'.$WhsCode.'</td>
		<td class="expdate">'.$CardName.'</td>
		
		<td class="quantity">'.$Quantity.'</td>
		<td class="quantity">'.$Allocated.'</td>
		<td class="admindate">'.$Direction.'</td>
		
	</tr>';
	$i++;
}
		
?>
	


