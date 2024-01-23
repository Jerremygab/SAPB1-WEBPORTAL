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
			<input type="text" class="form-control mfrserial"  aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none; " />
			<input type="hidden" class="form-control baseentry"  aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none; " readonly/>
			<input type="hidden" class="form-control linenum"  aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none; " readonly/>
			<input type="hidden" class="form-control tbldetailrowno"  aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none; " />
		</td>
		<td >
			<input type="text" class="form-control serial"  aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none; " />
			<input type="hidden" class="form-control matrix-cell text-right quantity"  aria-label="" aria-describedby="button-addon2" style="outline: none; border:none" maxlength="12" value=1 />	
			
		</td>
		<td >
			<input type="date" class="form-control  matrix-cell expdate" style="outline: none; border:none;" placeholder="" aria-label="Username" aria-describedby="basic-addon1" value="" min="2018-01-01" max="2050-12-31">						
		</td>
		<td >
			<input type="date" class="form-control  matrix-cell mfrdate" style="outline: none; border:none;" placeholder="" aria-label="Username" aria-describedby="basic-addon1" value="" min="2018-01-01" max="2050-12-31">						
		</td>
		<td >
			<input type="date" class="form-control  matrix-cell admindate" style="outline: none; border:none;" placeholder="" aria-label="Username" aria-describedby="basic-addon1" value="<?php echo date('Y-m-d'); ?>" min="2018-01-01" max="2050-12-31">						
		</td>
	    <td >
			<input type="text" class="form-control matrix-cell text-right location"   style="outline: none; border:none" maxlength="8"/>
		</td>
		<td >
			<input type="text" class="form-control text-right details"   style="outline: none; border:none" maxlength="8"/>
		</td>
		<td >
			<input type="text" class="form-control matrix-cell text-right unitcost"   aria-label="" aria-describedby="button-addon2" style="outline: none; border:none" maxlength="12" />
		</td>
    </tr>



