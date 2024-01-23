<?php
session_start();
include_once('../../../../config/config.php');
$itemCode = $_GET['itemCode'];
$whseCode = $_GET['whseCode'];

$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
	SELECT 
	T0.ItemCode, 
	(T0.Quantity-T0.CommitQty) 'AvailableQty', 
	T0.WhsCode, 
	T3.ItmsGrpNam, 
	T1.DistNumber,
	T2.LastPurPrc,
	T0.SysNumber



	FROM OBTQ T0
	INNER JOIN OBTN T1 ON T0.AbsEntry = T1.AbsEntry
	INNER JOIN OITM T2 ON T0.ItemCode = T2.ItemCode
	INNER JOIN OITB T3 ON T2.ItmsGrpCod = T3.ItmsGrpCod
	
	WHERE T2.ItemCode = '$itemCode' AND T0.WhsCode = '$whseCode'  AND (T0.Quantity-T0.CommitQty) > 0

	
	
	ORDER BY T0.SysNumber ASC");

$i = 1;
while (odbc_fetch_row($qry)) 
{
	$DistNumber = odbc_result($qry, "DistNumber");
	$ItemCode = odbc_result($qry, "ItemCode");
	$AvailableQty = number_format(odbc_result($qry, "AvailableQty"),0);
	$LastPurPrc = number_format(odbc_result($qry, "LastPurPrc"),2);
	$WhsCode = odbc_result($qry, "WhsCode");
    $ItmsGrpNam = odbc_result($qry, "ItmsGrpNam");
	$SysNumber = number_format(odbc_result($qry, "SysNumber"),0);
						

	

	echo '
	<tr style="background-color: white; "  >
		<td class="rowno text-right" style="background-color: lightgray;color:black; font-size:13px;">
			<span>'.$i.'</span>
		</td>
		<td >
			<input type="text" class="form-control matrix-cell text-right batch"  aria-label="" aria-describedby="button-addon2" style="padding: 0px !important; outline: none; border:none; " maxlength="12" value="'.$DistNumber.'" readonly/>	
		</td>
		<td >
			<input type="hidden" class="form-control matrix-cell text-right availableqtyhidden"  aria-label="" aria-describedby="button-addon2" style="padding: 0px !important; outline: none; border:none; " maxlength="12" value="'.$AvailableQty.'" readonly/>	
		
			<input type="text" class="form-control matrix-cell text-right availableqty"  aria-label="" aria-describedby="button-addon2" style="padding: 0px !important; outline: none; border:none; " maxlength="12" value="'.$AvailableQty.'" readonly/>	
		</td>
		<td >
			<input type="text" class="form-control matrix-cell text-right selectedqty"  aria-label="" aria-describedby="button-addon2" style="padding: 0px !important; outline: none; border:none; " maxlength="12" />	
		</td>
		<td >
			<input type="text" class="form-control matrix-cell text-right quantity"  aria-label="" aria-describedby="button-addon2" style="padding: 0px !important; outline: none; border:none; " maxlength="12" readonly/>	
		</td>
		<td >
			<input type="text" class="form-control matrix-cell text-right sysnumber"  aria-label="" aria-describedby="button-addon2" style="padding: 0px !important; outline: none; border:none; " maxlength="12" value="'.$SysNumber.'" readonly/>	
		</td>
		
		<td >
			<input type="text" class="form-control matrix-cell text-right quantity"  aria-label="" aria-describedby="button-addon2" style="padding: 0px !important; outline: none; border:none; " maxlength="12" value="'.$LastPurPrc.'" readonly/>	
		</td>
		
	</tr>';
	$i++;
}
		?>



