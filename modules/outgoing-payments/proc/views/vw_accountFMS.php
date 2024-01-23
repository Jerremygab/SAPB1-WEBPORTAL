<?php
session_start();
include('../../../../config/config.php');


$bankCode = $_GET['bankCode'];

?>
<table class="table table-striped table-bordered table-hover " id="tblAccountFMS">
    <thead>
        <tr>
            <th>#</th>
            <th>Account</th>
        </tr>
    </thead>
    <tbody>


        <?php
$itemno = 1;
$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
													SELECT DISTINCT 
													A.Account, 
													A.BankCode,
													A.GlAccount
													FROM DSC1 A


													WHERE A.BankCode = '$bankCode'");

	while (odbc_fetch_row($qry)) 
	{
		echo '<tr>
				<td>'.$itemno.'</td>
				<td class="item-1">'.odbc_result($qry, 'Account').'</td>

			
		
				
			</tr>';
		$itemno++;	  
	}

odbc_free_result($qry);


?>
    </tbody>
</table>
<script>
$(document).ready(function() {
    $('#tblAccountFMS').dataTable({
        "bLengthChange": false,
    });
});
</script>