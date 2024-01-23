<?php
session_start();
include('../../../../config/config.php');


	$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
		SELECT 
		T2.Code AS 'DepartmentCode',
		T2.Name AS 'DepartmentName'
		
		FROM OUDP T2 
		
		
		");
		
	while (odbc_fetch_row($qry)) 
		{
			echo '<option class="dropdown-item deptID" value="' . odbc_result($qry, "DepartmentCode") . '">' . odbc_result($qry, "DepartmentName") . '</option>';
			
		}
		odbc_free_result($qry);
?>
