<?php
session_start();
include('../../../../config/config.php');

$cardCodeWTLiable = $_POST['cardCodeWTLiable'];
?>
			<table class="table table-striped table-bordered table-hover table-blue" id="tblWTax">
						<thead>
							<tr class="bg-primary">
								<th>#</th>
								<th>WT Code</th>
								<th>WT Name</th>
								<th>Rate</th>
								<th>Account</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$itemno = 1;
								
								$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
								Select 
								T0.WTCode, 
								T0.WTName, 
								T0.Rate,
								T0.Account
								
								FROM OWHT T0
								INNER JOIN CRD4 T1 ON T1.WTCode = T0.WTCode

								WHERE T1.CardCode = '$cardCodeWTLiable'");
								while (odbc_fetch_row($qry)) 
								{
									echo '<tr class="srch">
												<td>'.$itemno.'</td>
												<td class="item-2 wtcode">'.odbc_result($qry, 'WTCode').'</td>
												<td class="item-3">'.odbc_result($qry, 'WTName').'</td>
												<td class="item-4">'.number_format(odbc_result($qry, 'Rate'),2).'</td>
												<td class="item-5">'.odbc_result($qry, 'Account').'</td>
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
        $('#tblWTax').dataTable();
		$('div.dataTables_filter input').focus();
	});
    </script>					