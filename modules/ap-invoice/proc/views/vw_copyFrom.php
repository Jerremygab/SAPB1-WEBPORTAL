<?php
session_start();
include('../../../../config/config.php');

$cardCode = $_POST['cardCode'];
$table = $_POST['table'];
$_SESSION['copyFromModalTbl'] = $_POST['copyFromModalTbl'];

?>
						<table class="table table-striped table-bordered table-hover copyFromTable" id="tbl<?php echo $_SESSION['copyFromModalTbl']; ?>">
							<thead>
								<tr>
									<th>#</th>
									<th class="">Doc No.</th>
									<th class="">Posting Date</th>
									<th class="">Due Date</th>
									<th class="">Customer Name</th>
									<th class="" style="min-width:200px">Remarks</th>
									
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
														
														FROM $table T0

														WHERE T0.CardCode = '$cardCode' AND T0.DocStatus = 'O'");

	while (odbc_fetch_row($qry)) 
	{
		echo '<tr>
				<td>'.$itemno.'</td>
				<td class="item-1 ">'.odbc_result($qry, 'DocNum').'</td>
				<td class="item-2 ">'.SAPDateFormater(odbc_result($qry, 'DocDate')).'</td>
				<td class="item-5 ">'.SAPDateFormater(odbc_result($qry, 'DocDueDate')).'</td>
				<td class="item-3 ">'.odbc_result($qry, 'CardName').'</td>
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
        $('#tbl<?php echo $_SESSION['copyFromModalTbl']; ?>').dataTable({
			"bLengthChange": false,
		});
	});
    </script>
