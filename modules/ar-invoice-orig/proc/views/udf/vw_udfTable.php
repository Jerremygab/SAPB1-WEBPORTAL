<?php
session_start();
include('../../../../../config/config.php');

$udfTable = $_GET['udfTable'];


?>
						<table class="table table-striped table-bordered table-hover " id="tblUdf">
							<thead>
								<tr>
									<th>#</th>
									<th >Code</th>
									<th >Name</th>
								</tr>
							</thead>
							<tbody>
								
							
<?php
$itemno = 1;
$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT 
														T0.Code,
														T0.Name
													
														FROM [@".$udfTable."] T0
														
														");

	while (odbc_fetch_row($qry)) 
	{
		echo '<tr>
				<td>'.$itemno.'</td>
				<td class="item-1 ">'.odbc_result($qry, 'Code').'</td>
				<td class="item-2 ">'.odbc_result($qry, 'Name').'</td>
				
			
		
				
			</tr>';
		$itemno++;	  
	}

odbc_free_result($qry);


?>
		</tbody>
	</table>
	<script>
    $(document).ready(function() 
	{
        $('#tblUdf').dataTable({
			"bLengthChange": false,
		});
	});
    </script>
