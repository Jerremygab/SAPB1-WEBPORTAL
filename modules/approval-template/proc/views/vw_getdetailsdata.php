<?php
session_start();
include_once('../../../../config/config.php');

$docNum = $_GET['docNum'];



$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB2."];
	SELECT 
		T0.Code,
		T1.EmpId,
		T1.EmpName,
		T1.LineNum
		
	FROM [USER-COMMON].[dbo].[@OAPT] T0
	INNER JOIN [USER-COMMON].[dbo].[@APT1] T1 ON T0.DocEntry = T1.DocEntry

	WHERE T0.DocEntry = $docNum
	ORDER BY T1.LineNum ASC");
$ctr = 1;

while (odbc_fetch_row($qry)) 
{
	
	$Code = odbc_result($qry, "Code");
	$EmpId = odbc_result($qry, "EmpId");
	$EmpName = odbc_result($qry, "EmpName");
	$LineNum = odbc_result($qry, "LineNum");

			echo 
				'<tr style="background-color: white; "  >
				  <td class="rowno text-right" style="background-color: lightgray;color:black;">
					<span>'.$ctr.'</span>
						<button type="button" class="btn" data-toggle="dropdown" style="width:1px; padding-left: 0px !important;margin-left: 0px !important">
							<i class="fas fa-caret-down" ></i>
						</button>
						<ul class="dropdown-menu rowfunctions" role="menu" style="background-color: #fdfd96;">
							<li class="deleterow" style="font-size:20px; color: black; font-weight:bold">Delete Row</a></li>
						</ul>
				  </td>
				  <td >
					<input type="text" class="form-control itemcode"  style="outline: none; border:none; " readonly value="'.$EmpId.'" />
				
				  </td>
					<td >
					<input type="text" class="form-control itemcode"  style="outline: none; border:none; " readonly value="'.$EmpName.'" />
				
				  </td>
					<td >
					<input type="hidden" class="form-control linenum"  style="outline: none; border:none; " readonly value="'.$LineNum.'" />
				
				  </td>
				</tr>'
					;
			
					$ctr += 1;
				}
			
odbc_free_result($qry);
odbc_close($MSSQL_CONN);

?>
