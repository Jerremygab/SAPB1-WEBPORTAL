<?php
session_start();
include('../../../../config/config.php');

$cardCode = $_GET['cardCode'];
	$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
	SELECT T0.UserId,
	T0.UserCode,
	T2.Code AS 'BranchCode',
	T2.Name AS 'BranchName',
	T3.Code AS 'DepartmentCode',
	T3.Name AS 'DepartmentName',
	
	CONCAT(T1.firstName, ' ',T1.lastName) AS Name
	
	
	FROM [". $MSSQL_DB2 ."].[dbo].[@OUSR] T0
	LEFT JOIN OHEM T1 ON T0.empid = T1.empID
	LEFT JOIN OUBR T2 ON T1.Branch = T2.Code 
	LEFT JOIN OUDP T3 ON T1.Dept = T3.Code
	
		
		WHERE T0.EmpId = '$cardCode'");
		$arr = array();
	while (odbc_fetch_row($qry)) 
		{
			$arr[] = array(
				"BranchCode" => odbc_result($qry, 'BranchCode'),
				"BranchName" => odbc_result($qry, 'BranchName'),
				);
		}
		odbc_free_result($qry);




echo json_encode($arr);
?>
