<?php
session_start();
include_once('../../../config/config.php');



?>


    <tr style="background-color: white; "  >
	 		<td class="rowno text-right" style="background-color: lightgray;color:black; font-size:13px;">
				<span>1</span>
				<button type="button" class="btn d-none btnrowfunctionsusers" data-toggle="dropdown" style="width:1px; padding-left: 0px !important;margin-left: 0px !important">
					<i class="fas fa-caret-down" ></i>
				</button>
				 	<ul class="dropdown-menu rowfunctions" role="menu" style="background-color: #fdfd96;">
						<li class="deleterowemployee" style="font-size:20px; color: black; font-weight:bold">Delete Row</a></li>
				  </ul>
	 		</td>
     
		  <td >
			<input type="text" class="form-control matrix-cell userid"  aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none" readonly/>
		  </td>
		  <td >
			<div class="input-group ">
					<input type="text" class="form-control matrix-cell username"  aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none" readonly/>
					  <button class="btn " type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#UseraApprovalStageModal" data-backdrop="false">
						<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue " ></i>
					  </button>
				</div>
		  </td>
    </tr>
