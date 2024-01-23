<?php
session_start();
include('../../../../config/config.php');

$whsCode = $_GET['whsCode'];

?>
						<table class="table table-striped table-bordered table-hover " id="tblITR">
							<thead>
								<tr>
									<th>#</th>
									<th class="">Doc No.</th>
									<th class="">Doc Date</th>
									<th class="">From Warehouse</th>
									<th class="">Remarks</th>
								</tr>
							</thead>
							<tbody>
								
							
<?php
$itemno = 1;
$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT 
														T0.DocNum,
														T0.DocDate,
														T0.Filler,
														T0.Comments
														
														FROM OWTR T0

														WHERE T0.Filler = '$whsCode' AND T0.DocStatus = 'O'
														
														ORDER BY T0.DocNum");

	while (odbc_fetch_row($qry)) 
	{
		echo '<tr>
				<td>'.$itemno.'</td>
				<td class="item-1 ">'.odbc_result($qry, 'DocNum').'</td>
				<td class="item-2 ">'.date('Y-m-d' ,strtotime(odbc_result($qry, 'DocDate'))).'</td>
				<td class="item-3 ">'.odbc_result($qry, 'Filler').'</td>
				<td class="item-4 ">'.odbc_result($qry, 'Comments').'</td>
			</tr>';
		$itemno++;	  
	}

odbc_free_result($qry);
odbc_close($MSSQL_CONN);

?>
		</tbody>
	</table>
	<script>
    $(document).ready(function() 
	{
        $('#tblITR').dataTable({
			"bLengthChange": false,
		});
	});
    </script>
