<?php
session_start();
include_once('../../../config/config.php');
//echo substr("Hello world",6);
$date = date('Y-m-d');
$month = substr($date,5, 2);
$day = substr($date,8, 2);
$year = substr($date,0, 4);
$newdate = $month . "." . $day . "." . $year;
?>
	<tr style="background-color: white; "  >
		<td class="rowno text-right" style="background-color: lightgray;color:black; font-size:13px;">
			<span>1</span>
			<button type="button" class="btn btnrowfunctions" data-toggle="dropdown" style="width:1px; padding-left: 0px !important;margin-left: 0px !important">
				<i class="fas fa-caret-down" ></i>
			</button>
			<ul class="dropdown-menu rowfunctions" role="menu" style="background-color: #fdfd96;">
				<li class="deleterowbatch" style="font-size:20px; color: black; font-weight:bold">Delete Row</a></li>
			</ul>
		</td>
		<td >
			<input type="text" class="form-control batch"  aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none; " />
			<input type="hidden" class="form-control baseentry"  aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none; " readonly/>
			<input type="hidden" class="form-control linenum"  aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none; " readonly/>
			<input type="hidden" class="form-control tbldetailrowno"  aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none; " />
		</td>
		<td >
			<input type="number" class="form-control matrix-cell text-right quantity"  style="outline: none; border:none" maxlength="12"/>	
		</td>
		 <td >
		 <div class="col-sm-12 input-group " style="padding:0px !important">
			<input type="text" class="form-control  matrix-cell expdate2 col-9" style="outline: none; border:none;" readonly>
			<input type="date" class="form-control  matrix-cell expdate col-3" style="outline: none; border:none;"  min="2018-01-01" max="2050-12-31">
					</div>		
	 	 </td>
		 <td> 
		 <div class="col-sm-12 input-group" style="padding:0px !important">
			<input type="text" class="form-control  matrix-cell mfrdate2 col-9" style="outline: none; border:none;" readonly>
			<input type="date" class="form-control  matrix-cell mfrdate col-3" style="outline: none; border:none;"   min="2018-01-01" max="2050-12-31">
					</div>		
	 	 </td>
		<td >
		 <div class="col-sm-12 input-group" style="padding:0px !important">
			<input type="text" class="form-control  matrix-cell admindate2 col-9" style="outline: none; border:none;" value="<?php echo $newdate ?>" readonly>
			<input type="date" class="form-control  matrix-cell admindate col-3" style="outline: none; border:none;"  value="<?php echo date('Y-m-d'); ?>" min="2018-01-01" max="2050-12-31">
					</div>						
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


