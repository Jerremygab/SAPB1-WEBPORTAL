<?php
session_start();
include_once('../../../../config/config.php');


$err = 0;
$errmsg = '';


$json = $_POST['json'];


if(json_decode($json) != null) 
			{
				$json = json_decode($json, true);
				//$ctr = -1;
				//$a = 0;
				foreach ($json as $key => $value) 
				{
					
					$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB2."]; UPDATE [dbo].[@OUSR] SET Active = 0 WHERE UserCode = '$value[0]' ");
					if(!$qry)
					{
						$err += 1;
						$errmsg .= 'Error Inserting User (Error Code: '.odbc_error().') - '.odbc_errormsg();
					}	
						
						
							
						
					
					
				}
			} 


if ($err == 0) 
{
	$data = array("valid"=>true, 
						"msg"=>"Operation completed successfully");
	echo json_encode($data);
}
else
{
	$data = array("valid"=>false, "msg"=>$errmsg);
	echo json_encode($data);
}

?>