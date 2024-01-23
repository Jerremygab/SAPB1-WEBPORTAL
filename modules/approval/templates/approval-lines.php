<?php
session_start();
include_once('../../../config/config.php');

?>

<div class="">
<table id="tblApproval" class="table table-striped table-bordered table-hover detailsTable"   style="background-color: white; width= 100%">
  <thead style="border-bottom: 0 !important">
    <tr>
	  	<th class="text-right" style=" color: black; max-width:30px;" >#</th>
      <th style="color: black; max-width:200px; ">Code</th>
      <th style="color: black; max-width:200px;" >Description</th>
      <th style="color: black; min-width:300px;">Modules</th>
	  	<th style="color: black; max-width:100px;">Status</th>
    </tr>
  </thead>
  <tbody class="">

<?php

$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
			SELECT 
					T0.Code,
					T0.Description,
					CAST(T0.Modules AS VARCHAR) AS Modules,
					T0.Inactive
			FROM [".$MSSQL_DB2."].[dbo].[@OAPR] T0
			
											
											");
			
$ctr=1;

while (odbc_fetch_row($qry)) 
{
	$Code = odbc_result($qry, "Code");
	$Description = odbc_result($qry, "Description");
	$Modules = odbc_result($qry, "Modules");
	$Active = odbc_result($qry, "Inactive");
	$Status = 'Inactive';
	$background = '';
	if($Active == 'Y'){
		$Status = 'Inactive';
		$background = '#FF7F7F';
	}
	else{
		$Status = 'Active';
		$background = '#90ee90';
		 
	}

	echo  '<tr style="background-color: white; "  >
		 		<td class="rowno text-right" style="background-color: lightgray;color:black; font-size:13px;">
					<span>'.$ctr.'</span>
	 			</td>
		    <td class="item-1">
					'.$Code.'
		  	</td>
			  <td >
					'.$Description.'
			  </td>
			  <td >
					'.$Modules.'
			  </td>
			  <td style="background-color: '.$background.'">
					'.$Status.'
			  </td>
    	</tr>';
     $ctr++;       
}
odbc_free_result($qry);
odbc_close($MSSQL_CONN);


?>
   
  </tbody>
</table>
</div>

<script>$('#tblApproval').dataTable({"bLengthChange": false,});</script>