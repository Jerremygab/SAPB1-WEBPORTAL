<?php
session_start();
include('../../../../config/config.php');

$objSession = json_decode($_SESSION['ARInvoiceArr']);

$transactType = $_POST['transactType'];
$docNum = $_POST['docNum'];

	$itemno = 1;
	$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
		SELECT
			DocNum,
			DocDate,
			CardName,
			PriceMode,
			Comments,
			DocDueDate
		FROM $transactType
		WHERE DocNum <> (CASE WHEN ObjType = $objSession->objectType THEN $docNum ELSE 0 END)
	");

	while (odbc_fetch_row($qry)) 
	{
		echo '<tr>
				<td style="width: 1%; white-space: nowrap;">'.$itemno.'</td>
				<td style="width: 2%;" class="docNum">'.odbc_result($qry, 'DocNum').'</td>
				<td style="width: 1%; white-space: nowrap;" class="docDate">'.date('Y-m-d' ,strtotime(odbc_result($qry, 'DocDate'))).'</td>
				<td style="width: 1%; white-space: nowrap;" class="cardName">'.odbc_result($qry, 'CardName').'</td>
				<td style="width: 1%;"" class="priceMode">'.odbc_result($qry, 'PriceMode').'</td>
				<td class="comments">'.odbc_result($qry, 'Comments').'</td>
				<td style="width: 1%; white-space: nowrap;" class="docDueDate">'.date('Y-m-d' ,strtotime(odbc_result($qry, 'DocDueDate'))).'</td>
			  </tr>';
		$itemno++;	  
	}
	
	odbc_free_result($qry);
	
?>