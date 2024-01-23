<?php 
session_start();
include('../../../../config/config.php');

$objSession = json_decode($_SESSION['APInvoiceArr']);

$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT Code,Name,Rate FROM OVTG WHERE Inactive = 'N' AND Category='$objSession->taxCodeCategory' ORDER BY CASE WHEN Code = 'IVAT-N' THEN '1' ELSE Code END ASC");
while (odbc_fetch_row($qry)) 
{
	//echo odbc_result($qry, 'NextNumber');
	echo '<option val-rate="' . number_format(odbc_result($qry, "Rate"), 2, '.', '.') . '" value="' . odbc_result($qry, "Code") . '">' . odbc_result($qry, "Code") . '</option>';
}
odbc_free_result($qry);


?>