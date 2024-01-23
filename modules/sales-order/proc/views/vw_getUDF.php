<?php
session_start();
include('../../../../config/config.php');

$udfJson = $_GET['udfJson'];
$docNum = $_GET['docNum'];
//$udfJsonNames = $_GET['udfJsonNames'];
$countUDF = 0;

		 if($udfJson != ''){
				$udfList = json_decode(stripslashes($udfJson));
				$string = implode(",",$udfList);
				$string2 = trim($string,'"');
				/* $udfListName = json_decode(stripslashes($udfJsonNames));
				$stringName = implode(",",$udfListName);
				$stringName2 = trim($stringName,'"'); */
			
			}
		
	
		$qryCount = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
			SELECT COUNT(Column_Name) AS 'Count'
			FROM INFORMATION_SCHEMA.COLUMNS
			WHERE TABLE_NAME = 'ORDR' AND LEFT(Column_Name,2) = 'U_'
			");
		while (odbc_fetch_row($qryCount)) 
		{
			$countUDF += odbc_result($qryCount, 'Count');
		}	

		
	 $qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
					SELECT 
					 ". $string2 ."
					FROM ORDR WHERE Docnum = $docNum
					
					");
	$arr=array();

	while (odbc_fetch_row($qry)) 
	{ 
		for ($i = 0; $i < $countUDF; $i++) {
			array_push($arr,odbc_result($qry, $udfList[$i]));
		}
	
	}
	
	echo json_encode($arr);

//odbc_free_result($qry); 





//echo json_encode($arr);

?>

<?php
/* session_start();
include('../../../../config/config.php');

$udfJson = $_GET['udfJson'];
$countUDF = 0;
$arr = array();
		 if($udfJson != ''){
				$udfList = json_decode(stripslashes($udfJson));
				$string = implode(",",$udfList);
				$string2 = trim($string,'"');
			
			}
		$qryCount = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
			SELECT COUNT(Column_Name) AS 'Count'
			FROM INFORMATION_SCHEMA.COLUMNS
			WHERE TABLE_NAME = 'OPRQ' AND LEFT(Column_Name,2) = 'U_'
			");
		while (odbc_fetch_row($qryCount)) 
		{
			$countUDF += odbc_result($qryCount, 'Count');
		}	

	
		
		 $qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
						SELECT 
						 ". $string2 ."
						FROM OPRQ WHERE Docnum = 620");
		
		while (odbc_fetch_row($qry)) 
		{ 
			foreach ($arr as $value) {
			
			}			
				for ($i = 1; $i < $countUDF; $i++) {
				echo'<div class="form-group row  py-0 my-0" id="udfList">
						<label for="inputEmail3" class="col-sm-5 col-form-label " style="color: black; font-size:15px" >'. odbc_result($qry, $udfList[$i]) .'</label>
						<div class="col-sm-7 input-group mb-1">
							<input type="text"  class="form-control inputUdf " value="'. odbc_result($qry, $udfList[$i]) .'">
						</div>
					</div>';
					
				}
			
		}

//odbc_free_result($qry); 





//echo json_encode($arr); */

?>