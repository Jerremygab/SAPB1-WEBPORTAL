<?php
session_start();
include_once('../../../../config/config.php');
$itemCode = $_GET['itemCode'];
$whseCode = $_GET['whseCode'];

$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
	SELECT 
	T0.ItemCode,
	T1.ItemName, 
	T0.WhsCode, 
	T0.SysSerial,
	T0.SuppSerial,
	T0.IntrSerial,
	T2.CostTotal,
	CASE WHEN T0.Transfered = 'Y' THEN 'Yes'
	ELSE 'No' END AS Transfered


	FROM OSRI T0 
	LEFT JOIN OITM T1 ON T0.ItemCode = T1.ItemCode
	LEFT JOIN OSRN T2 ON T2.DistNumber = T0.IntrSerial

	
	
	WHERE T0.ItemCode = '$itemCode' AND T0.WhsCode = '$whseCode'  AND T0.Status = 0

	
	
	ORDER BY T0.SysSerial ASC");

$i = 1;
while (odbc_fetch_row($qry)) 
{
	$IntrSerial = odbc_result($qry, "IntrSerial");
	$ItemCode = odbc_result($qry, "ItemCode");
	$WhsCode = odbc_result($qry, "WhsCode");
	$SysSerial = odbc_result($qry, "SysSerial");
	$LastPurPrc = number_format(odbc_result($qry, "CostTotal"),0);
	$Transfered = odbc_result($qry, "Transfered");
					

	

	echo '
	<tr style="background-color: white; "  >
		<td class="rowno text-right" style="background-color: lightgray;color:black; font-size:13px;">
			<span>'.$i.'</span>
		</td>
		<td >
			<input type="text" class="form-control matrix-cell text-right batch"  aria-label="" aria-describedby="button-addon2" style="padding: 0px !important; outline: none; border:none; " maxlength="12" value="'.$IntrSerial.'" readonly/>	
			<input type="hidden" class="form-control matrix-cell text-right selectedqty"  aria-label="" aria-describedby="button-addon2" style="padding: 0px !important; outline: none; border:none; " maxlength="12" value="1" />	
	
		</td>
		
	
		
		<td >
			<input type="text" class="form-control matrix-cell text-right sysnumber"  aria-label="" aria-describedby="button-addon2" style="padding: 0px !important; outline: none; border:none; " maxlength="12" value="'.$Transfered.'" readonly/>	
		</td>
		
		<td >
			<input type="text" class="form-control matrix-cell text-right quantity"  aria-label="" aria-describedby="button-addon2" style="padding: 0px !important; outline: none; border:none; " maxlength="12" value="'.$LastPurPrc.'" readonly/>	
		</td>
		
	</tr>';
	$i++;
}
		?>



