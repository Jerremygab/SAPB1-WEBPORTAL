<?php
session_start();
include_once('../../../config/config.php');
$serviceType = $_GET['serviceType'];

if ($serviceType == 'I'){
?>


<?php
}

else{
?>
<div class="">
<table id="tblDetails" class="table table-striped table-bordered table-sm detailsTable" cellspacing="0"  style="background-color: white">
  <thead style="z-index: 999;  background-color: lightgray  !important;" class="thead-fixed ">
    <tr style="background-color: lightgray; z-index: 999 !important;">
		  <th class="text-right" style="color: black;">#</th>
	    <th style="color: black; min-width:300px;">G/L Account</th>
		  <th style="color: black; min-width:400px;" >G/L Name</th>
		  <th style="color: black; min-width:150px;">Control Account</th>
		  <th style="color: black; min-width:150px;">Debit</th>
	    <th style="color: black; min-width:150px;">Credit</th>
	

  	</tr>
  </thead>
  <tbody class="">
    <tr style="background-color: white; "  >
		 	<td class="rowno text-center" style="background-color: lightgray;color:black; font-size:13px;">
			<span>1</span>
			<button type="button" class="btn d-none btnrowfunctions" data-toggle="dropdown" style="width: 1px; padding-left: 0px !important;margin-left: 0px !important">
				<i class="fas fa-caret-down" ></i>
			</button>
			 <ul class="dropdown-menu rowfunctions" role="menu" style="background-color: #fdfd96;">
				<li class="deleterow" style="font-size:20px; color: black; font-weight:bold">Delete Row</a></li>
				<li class="duplicaterow"style="font-size:20px; color: black; font-weight:bold">Duplicate Row</a></li>
			  </ul>
		  </td>
		  <td>
				<div class="input-group ">
					<input type="text" class="form-control matrix-cell glaccount"  aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none" readonly/>
				  <button class="btn btnGroup"   type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#glModal" data-backdrop="false">
					<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue " ></i>
				  </button>
				</div>
		  </td>
		  <td >
				<input type="text" class="form-control matrix-cell glname"  aria-label="" aria-describedby="button-addon2" style="outline: none; border:none" maxlength="12" readonly/>
				<input type="hidden" class="form-control matrix-cell text-right quantity"  aria-label="" aria-describedby="button-addon2" style="outline: none; border:none" maxlength="12" value="1" />
		  </td>
		  <td >
		  	<div class="input-group " >
					<input type="text" class="form-control matrix-cell text-right controlaccount"   aria-label="" aria-describedby="button-addon2" style="outline: none; border:none" maxlength="12" />
				  <button class="btn btnaccount btnGroup"   type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#controlAccountModal" data-backdrop="false">
					<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue " ></i>
				  </button>
				</div>
		  </td>

		  

		  <td >
				<input type="text" class="form-control matrix-cell text-right debit"    maxlength="12" style="outline: none; border:none" maxlength="12" />
		  </td>
		  <td >
				<input type="text" class="form-control matrix-cell text-right credit"    maxlength="12" style="outline: none; border:none" maxlength="12" />
		  </td>
		  
    </tr>
  </tbody>
</table>

</div>


<?php
}
?>
<script>$('#tblDetails').dataTable({
           //* scrollY: 300,
           //* scrollX: true,
		
           //* scroller: true,
			searching: false,
			ordering: false,
			bLengthChange: false,
			paging: false,
			info: false,
			
        });
</script>