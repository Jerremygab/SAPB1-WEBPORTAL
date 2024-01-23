<?php
session_start();
include('../../../../config/config.php');
include('../../../connect/connect.php');
$userid = $_SESSION['SESS_USERCODE'];
$err = 0;
$errmsg = '';
$docentry = 0;
$pid = '';
$apvArray = '';
$sapAPArray = [];



$PVTruckerRate = [];
$PVAddlChrgeRate = [];
$BNRate = [];

$pvno = '';
$year = '';
$nextPVNo = '';
if((isset($_POST['apvArray']))){
	$apvArray = $_POST['apvArray'];

}
if((isset($_POST['pvno']))){
	$pvno = $_POST['pvno'];

}
if((isset($_POST['sapAPArray']))){
	$sapAPArray = $_POST['sapAPArray'];

}
$array = $apvArray;
$in = '(' . implode(',', $array) . ')';


if((isset($_POST['PVTruckerRate']))){
	$PVTruckerRate = $_POST['PVTruckerRate'];

}
if((isset($_POST['PVAddlChrgeRate']))){
	$PVAddlChrgeRate = $_POST['PVAddlChrgeRate'];

}
if((isset($_POST['BNRate']))){
	$BNRate = $_POST['BNRate'];

}
// for ($x = 0; $x <= count($ptfArray); $x++) {
//   echo "The number is: $x <br>";
// }
		
$year = substr(date("Y"),2);
	
$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
	
 SELECT 
     ISNULL(MAX( SUBSTRING(Split.a.value('.', 'VARCHAR(100)'),5,5)),0) + 1 AS PVNo  
 FROM  (SELECT U_PVNo,  
         CAST ('<M>' + REPLACE(U_PVNo, ',', '</M><M>') + '</M>' AS XML) AS PVNo  
     FROM  [@PCTP_TP]
	 
	 WHERE U_PVNo IS NOT NULL
	 AND LEN(SUBSTRING(U_PVNo,5,5)) = 5
	 
	 ) 
	 AS A CROSS APPLY PVNo.nodes ('/M') AS Split(a); 

	 ");

	while (odbc_fetch_row($qry)) 
	{
		
		$nextPVNo = substr('000000000' .  odbc_result($qry, 'PVNo'),-5);
	}			

$nextPVNo = 'PV' . $year . $nextPVNo;

if(count($sapAPArray) == 0){
	$nextPVNo2 = $nextPVNo;

}else{
	if($pvno != ''){
		$nextPVNo2 = $pvno . ',' .$nextPVNo;
	}else{
		$nextPVNo2 = $nextPVNo;
	}
}


$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 

	UPDATE [@PCTP_TP] SET U_PVNo = '$nextPVNo2'
	WHERE U_BookingId IN $in
	 ");

// PVTruckerRate
// PVAddlChrgeRate
// BNRate
for ($x = 0; $x < count($PVTruckerRate); $x++) {

	$Bn = $BNRate[$x];
	$Pv = $PVTruckerRate[$x];
	$Add = $PVAddlChrgeRate[$x];
	 $qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 

		INSERT INTO [@FIRSTRATESTP] (U_PVNo,U_Amount,U_AddlAmount,U_BN)
		VALUES ('$nextPVNo2','$Pv','$Add','$Bn')
	 ");
}			

				
	if ($err == 0) 
	{
		$data = array("valid"=>true, 
							"loggedIn" => 'Logged In!',
							"msg" => "Operation completed successfully!",
							"result" =>$nextPVNo,
							"nextPVNo"=>$nextPVNo
							

						);
		echo json_encode($data);
	}
	else
	{
		$data = array("valid"=>false, "msg"=>$errmsg);
		echo json_encode($data);
	}

?>