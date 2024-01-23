<?php
session_start();
include_once('../../../config/config.php');



?>

 <tr style="background-color: white; "  >
	  <td class="rowno text-right" style="background-color: lightgray;color:black; font-size:13px;">
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
		<div class="input-group " >
		<input type="text" class="form-control itemcode"  aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none; " readonly/>
		
		
		  <input type="hidden" class="form-control matrix-cell uomgroup"  aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none" readonly/>
		</div>
	  </td>
	  <td >
		<div class="input-group ">
		<input type="text" class="form-control matrix-cell filename"  aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none" readonly/>
		  
		<input type="hidden" class="form-control matrix-cell uomgroup"  aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none" readonly/>
		</div>
	  </td>
	  <td >
		<div class="input-group ">
		<input type="text" class="form-control matrix-cell unitmsr"  aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none" readonly/>
		  
		<input type="hidden" class="form-control matrix-cell uomentry"  aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none"/>
		</div>
	  </td>
	   <td >
		<div class="input-group ">
		<input type="text" class="form-control matrix-cell whsecode"  aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none" readonly/>
		  
		<input type="hidden" class="form-control matrix-cell whsename"  aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none"/>
		</div>
	  </td>
	  

      
    </tr>



