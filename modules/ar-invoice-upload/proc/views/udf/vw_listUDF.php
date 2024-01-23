<?php
session_start();
include('../../../../../config/config.php');

$table = $_GET['mainTable'];
$cast = 'CAST(';
$type = ' AS NVARCHAR(200))';
$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
			SELECT TOP 7 Column_Name
			FROM INFORMATION_SCHEMA.COLUMNS
			WHERE TABLE_NAME = '".$table."' AND LEFT(Column_Name,2) = 'U_'
			--AND DATA_TYPE != 'ntext'
				
			");

$arr = array();

while (odbc_fetch_row($qry)) 
{
	$arr[] = array(
		// "Column_Name" => $cast . odbc_result($qry,'Column_Name' ) . $type . ' AS ' . odbc_result($qry,'Column_Name' )
		// 		);

	"Column_Name" => odbc_result($qry,'Column_Name' ) 
				);
            
}
odbc_free_result($qry);
odbc_close($MSSQL_CONN);



echo json_encode($arr);

?>