<?php
session_start();
include_once('../../../../config/config.php');

$docNum = $_GET['docNum'];


$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
			SELECT 
													T0.UserId,
													T0.UserCode,
													T0.Name,
													T0.EmpId,
													T0.SuperUser,
													T0.Locked,
													CONCAT(T1.LastName, ', ', T1.FirstName, ' ', T1.MiddleName) AS EmpName,
													T0.MainModule,
													T0.Module,
													T0.SUMMARY,
													T0.POD,
													T0.BILLING,
													T0.TP,
													T0.PRICING,
													T0.TREASURY
													
													FROM [".$MSSQL_DB2."].[dbo].[@OUSR] T0
													LEFT JOIN OHEM T1 ON t1.EmpId = T0.EmpID
													
													WHERE T0.UserId = $docNum
											
											");
			
$arr = array();

while (odbc_fetch_row($qry)) 
{
	$arr[] = array(
				"DocNum" => odbc_result($qry, 'UserId'),
				"UserCode" => odbc_result($qry, 'UserCode'),
				"Name" => odbc_result($qry, 'Name'),
				"EmpId" => odbc_result($qry, 'EmpId'),
				"EmpName" => odbc_result($qry, 'EmpName'),
				"SuperUser" => odbc_result($qry, 'SuperUser'),
				"Locked" => odbc_result($qry, 'Locked'),
				"MainModule" => odbc_result($qry, 'MainModule'),
				"Module" => odbc_result($qry, 'Module'),
				"SUMMARY" => odbc_result($qry, 'SUMMARY'),
				"POD" => odbc_result($qry, 'POD'),
				"BILLING" => odbc_result($qry, 'BILLING'),
				"TP" => odbc_result($qry, 'TP'),
				"PRICING" => odbc_result($qry, 'PRICING'),
				"TREASURY" => odbc_result($qry, 'TREASURY')


			
				);
            
}
odbc_free_result($qry);
odbc_close($MSSQL_CONN);



echo json_encode($arr);

?>