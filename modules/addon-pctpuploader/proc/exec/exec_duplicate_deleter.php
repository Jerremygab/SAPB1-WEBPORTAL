<?php
session_start();
include('../../../../config/config.php');
include('../../../connect/connect.php');



$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
        EXEC [dbo].[USP_DELETE_DUPLICATE_BN]");

?>