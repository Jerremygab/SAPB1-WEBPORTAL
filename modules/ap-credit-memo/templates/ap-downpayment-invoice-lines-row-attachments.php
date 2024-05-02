<?php
session_start();
include_once('../../../config/config.php');



?>

 <tr style="background-color: white; "  >
		<td class="rowno text-right" style="background-color: lightgray;color:black; font-size:13px;">
			<span>1</span>
			<ul class="dropdown-menu rowfunctions" role="menu" style="background-color: #fdfd96;">
				<li class="deleterow" style="font-size:20px; color: black; font-weight:bold">Delete Row</a></li>
				<li class="duplicaterow"style="font-size:20px; color: black; font-weight:bold">Duplicate Row</a></li>
			</ul>
	  </td>
	 <td >
			<div class="input-group " >
				<input type="text" class="form-control matrix-cell targetpath"  aria-label="File Name" aria-describedby="button-addon2" style="outline: none; border:none" readonly/>
				
			</div>
	  </td>
	  <td >
			<div class="input-group ">
			<input type="file" class="form-control matrix-cell file" name="file"  aria-label="File Name" aria-describedby="button-addon2" style="outline: none; border:none" readonly/>
			</div>
	  </td>
	  <td >
			<div class="input-group ">
				<input type="date" id="txtAttachmentDate" value="<?php  echo str_replace('/','-',date("Y/m/d")); ?>" min="01-01-2018" max="12-31-2050" class="form-control matrix-cell attachmentdate"  aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none" readonly/>	
			</div>
	  </td>
	  <td>
			<div class="input-group ">
				<input type="text" class="form-control matrix-cell freetext" aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none;" />
			</div>
	  </td>
 </tr>
<?php


