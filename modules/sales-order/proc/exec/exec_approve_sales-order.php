<?php
$err = 0;
$errmsg = '';
$successmsg = '';
session_start();
include('../../../../config/config.php');

$docentry = '';
$txtDocEntry = $_POST['txtDocEntry'];
$txtDocNum = $_POST['txtDocNum'];


	$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
	UPDATE ODRF SET U_ApprovalCodes = 'Approved' WHERE DocNum = $txtDocNum AND DocEntry = $txtDocEntry ");



		


if ($err == 0) 
{
	$data = array("valid"=>true, 
						"msg"=>"Operation completed successfully - " .$txtDocNum,
						"docref"=>$txtDocNum,
						"docentry"=>$txtDocNum);
	echo json_encode($data);
}
else
{
	$data = array("valid"=>false, "msg"=>$errmsg);
	echo json_encode($data);
}



?>