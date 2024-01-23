<?php
session_start();
include_once('../../../config/config.php');

?>

<div class="">
<table id="tblDetails" class="table table-striped table-bordered table-sm detailsTable" cellspacing="0"  style="background-color: white; width: 100%;" cellspacing="0">
  <thead   style="border-bottom: 0 !important">
    <tr>
			<th class="text-right" style=" color: black;max-width:5px;">#</th>
			<th style="color: black; max-width:50px; ">Select</th>
			<th style="color: black; min-width:200px;">Customer Code</th>
			<th style="color: black; min-width:200px;">Reference No.</th>
			<th style="color: black; min-width:200px;">Document Date</th>
			<th style="color: black; min-width:100px;">Item Code</th>
			<th style="color: black; min-width:100px;">Quantity</th>
			<th style="color: black; min-width:100px;">Gross Total</th>
    </tr>
  </thead>
  <tbody class="">
    <tr style="background-color: white; "  >
	 <td class="rowno text-right" style="background-color: lightgray;color:black; font-size:5px;">
		<span>1</span>
		<button type="button" class="btn d-none btnrowfunctions" data-toggle="dropdown" style="width:1px; padding-left: 0px !important;margin-left: 0px !important">
			<i class="fas fa-caret-down" ></i>
		</button>
		
	
		 <ul class="dropdown-menu rowfunctions" role="menu" style="background-color: #fdfd96;">
			<li class="deleterow" style="font-size:20px; color: black; font-weight:bold">Delete Row</a></li>
			<li class="duplicaterow"style="font-size:20px; color: black; font-weight:bold">Duplicate Row</a></li>
		  </ul>
		
	  </td>
      
	  <td >
	  	<div class="input-group ">
			<input type="checkbox" style="height: 20px; width: 20px; margin: auto; text-align: center; outline: none;" class="form-control matrix-cell chkboxInvoice " s="">
		</div>
	  </td>
	  <td >
		<div class="input-group ">
			<input type="text" class="form-control matrix-cell customercode" aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none;" readonly/>
		</div>
	  </td>
	  <td >
	  
		<div class="input-group ">
			<input type="text" class="form-control matrix-cell referenceno" aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none;" readonly/>
		</div>
	  </td>
	  <td >
	  
	  <div class="input-group ">
	  	<input type="text" class="form-control matrix-cell docdate" aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none;" readonly/>
	  </div>
	</td>
	    <td >
		<input type="text" class="form-control matrix-cell itemcode" aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none;" readonly/>
		
	  </td>
	    <td >
		<input type="text" class="form-control matrix-cell quantityy" aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none;" readonly/>
		
	  </td>
	    <td >
		<input type="text" class="form-control matrix-cell grosstotal" aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none;" readonly/>
		
	  </td>
	   

      
    </tr>
	
  </tbody>
  <tfoot style="z-index: 999;  background-color: lightgray; " class="d-none">
		<tr style="background-color: lightgray; z-index: 999">
		<th class="text-right" style=" color: black;max-width:5px;">#</th>
			<th style="color: black; max-width:50px; ">Select</th>
			<th style="color: black; min-width:200px;">Customer Code</th>
			<th style="color: black; min-width:200px;">Reference No.</th>
			<th style="color: black; min-width:200px;">Document Date</th>
			<th style="color: black; min-width:100px;">Item Code</th>
			<th style="color: black; min-width:100px;">Quantity</th>
			<th style="color: black; min-width:100px;">Gross Total</th>
		</tr>
	  </tfoot>
</table>
</div>


<script>$('#tblDetails').dataTable({
            scrollY: 300,
            scrollX: true,
            scroller: true,
			searching: false,
			ordering: false,
			bLengthChange: false,
			paging: false,
			info: false,
			
        });
</script>



