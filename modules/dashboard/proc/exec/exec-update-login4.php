<?php
session_start();

include('../../../../config/config.php');

$err = 0;
$errmsg = '';

$MSSQL_DB2 = 'GSDC-COMMON-2';


	if($err == 0){
	$qryActiveUpdate = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB2."]; UPDATE [dbo].[@OUSR] SET Active = 0  ");
	}


?>