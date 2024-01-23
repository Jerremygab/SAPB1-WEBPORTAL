<?php
session_start();
include('../../../../config/config.php');

$cardCode = $_GET['cardCode'];
$table = $_GET['table'];
$fatherCard = '';
$objSession = json_decode($_SESSION['ARInvoiceArr']);

// $qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT 
// 														T0.CardCode
														
// 														FROM OCRD T0

// 														WHERE T0.FatherCard = '$cardCode'");

// 	while (odbc_fetch_row($qry)) 
// 	{
		
// 		$fatherCard = odbc_result($qry, 'CardCode');
// 	}

?>
						<table class="table table-striped table-bordered table-hover " id="tbl<?php echo $objSession->copyFromModalTbl1; ?>">
							<thead>
								<tr>
									<th>#</th>
									<th class="">Doc No.</th>
									<th class="">Posting Date</th>
									<th class="">Due Date</th>
									<th class="">Vendor Name</th>
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
														
														FROM ODLN T0
														INNER JOIN OCRD T1 ON T0.CardCode = T1.CardCode

														WHERE T1.FatherCard =  '152.00-C1' AND T0.DocStatus = 'O'");

	while (odbc_fetch_row($qry)) 
	{
		echo '<tr>
				<td>'.$itemno.'</td>
				<td class="item-1 ">'.odbc_result($qry, 'DocNum').'</td>
				<td class="item-2 ">'.date('Y-m-d' ,strtotime(odbc_result($qry, 'DocDate'))).'</td>
				<td class="item-5 ">'.date('Y-m-d' ,strtotime(odbc_result($qry, 'DocDueDate'))).'</td>
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
        $('#tbl<?php echo $objSession->copyFromModalTbl1; ?>').dataTable({
			"bLengthChange": false,
		});
	});
    </script>
