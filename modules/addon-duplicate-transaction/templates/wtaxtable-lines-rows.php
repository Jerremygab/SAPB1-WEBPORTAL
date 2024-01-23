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
							<li class="	<li class="duplicaterow"style="font-size:20px; color: black; font-weight:bold">Duplicate Row</a></li>" style="font-size:20px; color: black; font-weight:bold">Delete Row</a></li>
						
						  </ul>
						
					  </td>
			 <td>
			 	<div class="input-group " >
						<input type="text" class="form-control wtcode"   style="outline: none; border:none; " readonly/>
					<button class="btn "  type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#WTaxModal" data-backdrop="false" >
					<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue " ></i>
				  </button>
				</div>
			</td>
			 <td >
				<input type="text" class="form-control matrix-cell text-right wtname"  style="outline: none; border:none" maxlength="12" readonly/>
			  </td>
			   <td >
				<input type="text" class="form-control matrix-cell text-right rate"  style="outline: none; border:none" maxlength="12" readonly/>
			  </td>
			     <td >
				<input type="text" class="form-control matrix-cell text-right baseamount"   style="outline: none; border:none" maxlength="12" />
				
			  </td>
			   <td >
				<input type="text" class="form-control matrix-cell text-right taxableamount"  style="outline: none; border:none" maxlength="12" />
			  </td>
			  <td >
				<input type="text" class="form-control matrix-cell text-right wtaxamount"  style="outline: none; border:none" maxlength="12" />
			  </td>
			   <td >
				<input  type="number" class="form-control matrix-cell text-right glaccountwtax "  style="outline: none; border:none" readonly/>	
			  </td>
			  
	</tr>
				

