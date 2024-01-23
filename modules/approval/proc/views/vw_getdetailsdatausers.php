<?php
session_start();
include_once('../../../../config/config.php');

$code = $_GET['code'];

?>
<div class="">
<table id="tblUsers" class="table table-striped table-bordered table-sm detailsTable" cellspacing="0"  style="background-color: white; width= 100%" cellspacing="0">
  <thead   style="border-bottom: 0 !important">
    <tr>
	  	<th class="text-right" style=" color: black; max-width:30px;" >#</th>
	  	<th style="color: black;  max-width:200px;" >Employee ID</th>
      <th style="color: black; min-width:300px;" >Employee Name</th>
    </tr>
  </thead>
  <tbody class="">
  

<?php
$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB2."];
	SELECT 
		T1.Code,
		T1.EmpId,
		T1.EmpName,
		T1.DocEntry,
		T1.LineNum
		
		
	FROM [@OAPR] T0 
	INNER JOIN [@APR1] T1 ON T0.Code = T1.Code

	WHERE T0.Code = '$code'
	ORDER BY T1.LineNum ASC");
$ctr = 1;

while (odbc_fetch_row($qry)) 
{
	
	$Code = odbc_result($qry, "Code");
	$EmpId = odbc_result($qry, "EmpId");
	$EmpName = odbc_result($qry, "EmpName");
	$DocEntry = odbc_result($qry, "DocEntry");
	$LineNum = odbc_result($qry, "LineNum");
    
	echo 
		'<tr style="background-color: white; "  >
	 		<td class="rowno text-right" style="background-color: lightgray;color:black; font-size:13px;">
				<span>'.$ctr.'</span>
				<button type="button" class="btn  btnrowfunctionsusers" data-toggle="dropdown" style="width:1px; padding-left: 0px !important;margin-left: 0px !important">
					<i class="fas fa-caret-down" ></i>
				</button>
				 	<ul class="dropdown-menu rowfunctions" role="menu" style="background-color: #fdfd96;">
						<li class="deleterowemployee" style="font-size:20px; color: black; font-weight:bold">Delete Row</a></li>
				  </ul>
	 		</td>
		  <td >
			<input type="text" class="form-control matrix-cell userid" style="outline: none; border:none" value="'.$EmpId.'" readonly/>
		  </td>
		  <td >
			<div class="input-group ">
					<input type="text" class="form-control matrix-cell username"  style="outline: none; border:none" value="'.$EmpName.'"  readonly/>
					  <button class="btn " type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#UseraApprovalStageModal" data-backdrop="false">
						<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue " ></i>
					  </button>
				</div>
		  </td>
    	</tr>';
			
	$ctr += 1;
				
	}
	?>
		<tr style="background-color: white; "  >
	 		<td class="rowno text-right" style="background-color: lightgray;color:black; font-size:13px;">
				<span><?php echo $ctr; ?></span>
				<button type="button" class="btn d-none btnrowfunctionsusers" data-toggle="dropdown" style="width:1px; padding-left: 0px !important;margin-left: 0px !important">
					<i class="fas fa-caret-down" ></i>
				</button>
				 	<ul class="dropdown-menu rowfunctions" role="menu" style="background-color: #fdfd96;">
						<li class="deleterowemployee" style="font-size:20px; color: black; font-weight:bold">Delete Row</a></li>
				  </ul>
	 		</td>
		  <td >
			<input type="text" class="form-control matrix-cell userid" style="outline: none; border:none"  readonly/>
		  </td>
		  <td >
			<div class="input-group ">
					<input type="text" class="form-control matrix-cell username"  style="outline: none; border:none"   readonly/>
					  <button class="btn " type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#UseraApprovalStageModal" data-backdrop="false">
						<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue " ></i>
					  </button>
				</div>
		  </td>
    	</tr>
	  </tbody>
</table>
</div>

<?php
odbc_free_result($qry);
odbc_close($MSSQL_CONN);

?>
