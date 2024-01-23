<?php
session_start();
include('../../../../config/config.php');

$cardCode = $_GET['cardCode'];

?>
						<table class="table table-striped table-bordered table-hover " id="tblCntctPersons">
							<thead>
								<tr>
									<th>#</th>
									<th class="d-none">Code</th>
									<th class="">Name</th>
									<th class="">Position</th>
									<th class="">Telephone No.</th>
								</tr>
							</thead>
							<tbody>
								
							
<?php
$itemno = 1;
$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT 
														T1.CardCode,
														T1.CntctCode,
														T1.Name,
														T1.Position,
														ISNULL(T1.Tel1, Tel2) AS TelephoneNo
														
														FROM OCRD T0
														INNER JOIN OCPR T1 ON T1.CardCode = T0.CardCode 
														

														where T1.CardCode = '$cardCode'");

	while (odbc_fetch_row($qry)) 
	{
		echo '<tr>
				<td>'.$itemno.'</td>
				<td class="item-1 d-none">'.odbc_result($qry, 'CntctCode').'</td>
				<td class="item-2 ">'.odbc_result($qry, 'Name').'</td>
				<td class="item-3 ">'.odbc_result($qry, 'Position').'</td>
				<td class="item-4 ">'.odbc_result($qry, 'TelephoneNo').'</td>
			
		
				
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
        $('#tblCntctPersons').dataTable({
			"bLengthChange": false,
		});
	});
    </script>
