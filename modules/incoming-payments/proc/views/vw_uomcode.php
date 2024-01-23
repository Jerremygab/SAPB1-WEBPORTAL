<?php
session_start();
include('../../../../config/config.php');

$uomGroup = $_GET['uomGroup'];

?>
						<table class="table table-striped table-bordered table-hover " id="tblUnit">
							<thead>
								<tr>
									<th>#</th>
									<th class="d-none">Code</th>
									<th class="">Unit Group</th>
									<th class="">Unit Name</th>
									<th class="d-none">Row Header</th>
								</tr>
							</thead>
							<tbody>
								
							
<?php
$itemno = 1;
$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT 
														T1.[UgpEntry], 
														T3.UomEntry,
														T3.[UomCode], 
														T3.[UomName]

														
														FROM [OUGP] T1
														INNER JOIN UGP1 T2 ON T1.[UgpEntry] = T2.[UgpEntry] 
														INNER JOIN OUOM T3 ON T2.UomEntry = T3.UomEntry		

														where T1.[UgpName] = '$uomGroup'");

	while (odbc_fetch_row($qry)) 
	{
		echo '<tr>
				<td>'.$itemno.'</td>
				<td class="item-1 d-none">'.odbc_result($qry, 'UgpEntry').'</td>
				<td class="item-2 ">'.odbc_result($qry, 'UomCode').'</td>
				<td class="item-3 ">'.odbc_result($qry, 'UomName').'</td>
				<td class="item-4 d-none">'.odbc_result($qry, 'UomEntry').'</td>
			
		
				
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
        $('#tblUnit').dataTable({
			"bLengthChange": false,
		});
	});
    </script>
