<?php
session_start();
include_once('../../../../../config/config.php');



         $itemno = 1;
              $qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];  
						     SELECT DISTINCT
								Year(T0.DocDate) AS Years
							FROM OINV T0
					
                                            
                                            ");
                while (odbc_fetch_row($qry)) 
                {
                	$year = '<option value='.odbc_result($qry, 'Years').'>'.odbc_result($qry, 'Years').'</option>';
                 
                 }
                  
                
echo $year;
              
odbc_free_result($qry);
odbc_close($MSSQL_CONN);

?>
