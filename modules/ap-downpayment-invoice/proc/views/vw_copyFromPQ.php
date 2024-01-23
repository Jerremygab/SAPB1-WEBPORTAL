<?php
session_start();
include('../../../../config/config.php');

$cardCode = $_GET['cardCode'];

?>
						<table class="table table-striped table-bordered table-hover " id="tblPQ">
							<thead>
								<tr>
									<th>#</th>
									<th class="">Doc No.</th>
									<th class="">Doc Date</th>
									<th class="">Vendor Name</th>
									<th class="">Remarks</th>
									<th class="">Due Date</th>
								</tr>
							</thead>
							<tbody>
								
							
<?php
$itemno = 1;
$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT 
														T0.DocNum,
														T0.DocDate,
														T0.CardName,
														T0.Comments,
														T0.DocDueDate
														
														FROM OPQT T0

														WHERE T0.CardCode = '$cardCode' AND T0.DocStatus = 'O'
														
														ORDER BY T0.DocNum");

	while (odbc_fetch_row($qry)) 
	{
		echo '<tr>
				<td>'.$itemno.'</td>
				<td class="item-1 ">'.odbc_result($qry, 'DocNum').'</td>
				<td class="item-2 ">'.date('Y-m-d' ,strtotime(odbc_result($qry, 'DocDate'))).'</td>
				<td class="item-3 ">'.odbc_result($qry, 'CardName').'</td>
				<td class="item-4 ">'.odbc_result($qry, 'Comments').'</td>
				<td class="item-5 ">'.date('Y-m-d' ,strtotime(odbc_result($qry, 'DocDueDate'))).'</td>
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
        $('#tblPQ').dataTable({
			"bLengthChange": false,
		});
	});
    </script>
