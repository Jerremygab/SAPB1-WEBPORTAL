<?php
session_start();
include('../../../../config/config.php');
include('../../../connect/connect.php');
$userid = $_SESSION['SESS_USERCODE'];
$err = 0;
$errmsg = '';
$docentry = 0;
$pid = '';
$ptfArray = '';
$year = '';
$nextPTFNo = '';
if((isset($_POST['ptfArray']))){
	$ptfArray = $_POST['ptfArray'];

}

$array = $ptfArray;
$in = '(' . implode(',', $array) . ')';



// for ($x = 0; $x <= count($ptfArray); $x++) {
//   echo "The number is: $x <br>";
// }
		
$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
	 SELECT
	 MAX(YEAR(T0.U_BookingDate)) AS Year

	 FROM [@PCTP_POD] T0

	 WHERE T0.U_BookingNumber IN $in  ");

	while (odbc_fetch_row($qry)) 
	{
		
		$year = odbc_result($qry, 'Year');

	}
	
$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
	SELECT
	MAX( SUBSTRING(LTRIM(T0.U_PTFNo),9,4)) + 1 AS  PTFNo

	 FROM [@PCTP_POD] T0 

	  WHERE U_PTFNo IS NOT NULL
	 AND LEN(SUBSTRING(T0.U_PTFNo,9,4)) = 4
	 ");

	while (odbc_fetch_row($qry)) 
	{
		
		$nextPTFNo = substr('000000000' .  odbc_result($qry, 'PTFNo'),-4);
	}			

$newPTFNo = 'PTF' . $year . '-' . $nextPTFNo;
$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 

	UPDATE [@PCTP_POD] SET U_PTFNo = '$newPTFNo'
	WHERE U_BookingNumber IN $in
	 ");
$qry2 = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 

	UPDATE [@PCTP_BILLING] SET U_PTFNo = '$newPTFNo'
	WHERE U_BookingId IN $in
	 ");


		

				
	if ($err == 0) 
	{
		$data = array("valid"=>true, 
							"loggedIn" => 'Logged In!',
							"msg" => "Operation completed successfully!",
							"result" => $newPTFNo,
							"nextPTFNo"=>$nextPTFNo
							

						);
		echo json_encode($data);
	}
	else
	{
		$data = array("valid"=>false, "msg"=>$errmsg);
		echo json_encode($data);
	}

?>