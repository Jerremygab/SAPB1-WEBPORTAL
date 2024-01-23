<?php
session_start();
include('../../../../config/config.php');


	$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
		SELECT 
		T2.Code AS 'BranchCode',
		T2.Name AS 'BranchName'
		
		FROM OUBR T2 
		
		
		");
		
	while (odbc_fetch_row($qry)) 
		{
			echo '<option class="dropdown-item branchID" value="' . odbc_result($qry, "BranchCode") . '">' . odbc_result($qry, "BranchName") . '</option>';
			
		}
		odbc_free_result($qry);
?>
