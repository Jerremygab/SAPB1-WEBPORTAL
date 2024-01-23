<?php 
session_start();
include('../../../../../config/config.php');

	$err = 0;
	$errmsg = '';
	$ItemCode = '';

	$id = $_GET["id"];
	$value = $_GET["value"];
	$pid = $_GET["pid"];
	$result = '';

	if($id == 'U_WaybillNo'){

		if($value != 'n/a'){


			$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
			SELECT COUNT(U_WaybillNo) AS Counter FROM [@PCTP_POD] WHERE Code != $pid AND  U_WaybillNo = '$value'
			");


			while (odbc_fetch_row($qry)) 
			{
				
				
				$result = odbc_result($qry, 'Counter');
						
				
			}	
		}
	}else if($id == 'U_TripTicketNo'){
		$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
		SELECT COUNT(U_TripTicketNo) AS Counter FROM [@PCTP_POD] WHERE Code != $pid AND U_TripTicketNo = '$value'
		");


		while (odbc_fetch_row($qry)) 
		{
			
			
			$result = odbc_result($qry, 'Counter');
					
			
		}
	}
	
	
	
	if ($err == 0) 
	{

		
		echo $result;
		
		
	}
	else
	{
		echo 'FAILURE!';
	
	}

?>
	