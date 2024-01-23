<?php
session_start();
include_once('../../../config/config.php');



?>

<div class="">
    <table id="tblCheck" class="table table-striped table-bordered table-sm detailsTable" cellspacing="0"
        style="background-color: white; width:100% !important;" cellspacing="0">
        <thead style="border-bottom: 0 !important; ">
            <tr>
                <th class="text-right" style=" color: black;">#</th>
                <th style="color: black; min-width:120px; ">Due Date</th>
                <th style="color: black; min-width:150px; ">Amount</th>
                <th style="color: black; min-width:250px;">Bank Name</th>
                <th style="color: black; min-width:150px;">Branch</th>
                <th style="color: black; min-width:150px;">Account</th>
                <th style="color: black; min-width:100px;">Manual Check</th>
                <th style="color: black; min-width:150px;">Check No.</th>
                <th style="color: black; min-width:150px;">GL Account</th>
            </tr>
        </thead>

        <tbody class="">
            <tr style="background-color: white; ">
                <td class="rowno text-right" style="background-color: lightgray;color:black; font-size:13px;">
                    <span>1</span>

                </td>
                <td class="row">
                    <input type="text" value="<?php echo date('m.d.Y'); ?>" class="form-control  matrix-cell duedate2 col-9"
                        style="outline: none; border:none;">
                    <input type="date" class="form-control  matrix-cell duedate col-3"
                        style="outline: none; border:none;" placeholder="" aria-label="Username"
                        aria-describedby="basic-addon1" value="<?php echo date('Y-m-d'); ?>" min="2018-01-01"
                        max="2050-12-31">

                </td>

                <td>
                    <input type="text" class="form-control matrix-cell text-right checkamount"
                        style="outline: none; border:none" maxlength="12" value="0.00"/>

                </td>
                <td>
                    <select type="text" class="form-control matrix-cell bankcode" style="outline: none; border:none"
                        maxlength="8">
                        <?php
																			$itemno = 1;
																			$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
																							SELECT 
																							T0.BankCode,
																							T0.BankName

																							FROM ODSC	T0
																							
																							ORDER BY T0.BankCode ASC");
																				while (odbc_fetch_row($qry)) 
																				{
																					$bankCode = odbc_result($qry, 'BankCode');
																					$bankName = odbc_result($qry, 'BankName');

																					echo '<option value="'.$bankCode.'">'.$bankCode.' - '.$bankName.'</option>';
																					$itemno++;	  
																				}
																				
																				odbc_free_result($qry);

																		?>

                    </select>

                </td>
                <td>
                    <input type="text" class="form-control matrix-cell text-right branch"
                        style="outline: none; border:none" maxlength="12" readonly />

                </td>
                <td>
                <div class="input-group">
			    <input type="text" class="form-control matrix-cell text-right account"   aria-label="" aria-describedby="button-addon2" style="outline: none; border:none" maxlength="12" readonly/>
		        <button class="btn "   type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#acctFMSModal" data-backdrop="false">
			    <i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue " ></i>
		        </button>
		
                        <!--<button class="btn " type="button" data-mdb-ripple-color="dark"
                            style="background-color: #ADD8E6; " data-toggle="modal" data-target="#acctFMSModal"
                            data-backdrop="false">
                            <i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue "></i>
                        </button>-->
                    </div>
                </td>
                <td>
                    
                <input type="checkbox" style=" height:20px ; width:20px ; margin: auto; margin-top: 10px; " 
                class="form-control matrix-cell chkBoxManualCheck ">
                    
                </td>
                <td>
                    <input type="number" class="form-control matrix-cell text-right checkno "
                        style="outline: none; border:none" readonly />
                </td>
                <td>
                    <input type="text" class="form-control matrix-cell text-right glAcctCheck "
                        style="outline: none; border:none" readonly />
                </td>
            </tr>
        </tbody>
    </table>
</div>




<script>
$('#tblCheck').dataTable({

    searching: false,
    ordering: false,
    bLengthChange: false,
    paging: false,
    info: false,

});
</script>