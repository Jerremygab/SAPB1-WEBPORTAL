<?php
session_start();

$rowNo = $_GET['rowNo'];
$batchData = $_GET['batchData'];
$batchDataQTY = $_GET['batchDataQTY'];
$batchExpDate = $_GET['batchExpDate'];
$batchMfrDate = $_GET['batchMfrDate'];
$batchAdminDate = $_GET['batchAdminDate'];
$batchLocation = $_GET['batchLocation'];
$batchDetails = $_GET['batchDetails'];
$batchUnitCost = $_GET['batchUnitCost'];
	$i = 1;					
if($batchData != ''){
	$batchCode = $batchData;

	if($batchDataQTY != ''){
		$batchQTY = $batchDataQTY;
	}
	if($batchUnitCost != ''){
		$batchUnitCost = $batchUnitCost;
	}
	else{
		$batchUnitCost = '0';
	}
	if($batchExpDate != ''){
		$batchExpDate = $batchExpDate;
	}
	else{
		$batchExpDate = '';
	}
	if($batchMfrDate != ''){
		$batchMfrDate = $batchMfrDate;
	}
	else{
		$batchMfrDate = '';
	}
	if($batchAdminDate != ''){
		$batchAdminDate = $batchAdminDate;
	}
	else{
		$batchAdminDate = '';
	}
	
	foreach ($batchCode as $data){
		echo '
		<tr style="background-color: white; "  >
			<td class="rowno text-right" style="background-color: lightgray;color:black; font-size:13px;">
				<span>'.$i.'</span>
				<button type="button" class="btn d-none btnrowfunctions" data-toggle="dropdown" style="width:1px; padding-left: 0px !important;margin-left: 0px !important">
					<i class="fas fa-caret-down" ></i>
				</button>
				<ul class="dropdown-menu rowfunctions" role="menu" style="background-color: #fdfd96;">
					<li class="deleterow" style="font-size:20px; color: black; font-weight:bold">Delete Row</a></li>
					<li class="duplicaterow"style="font-size:20px; color: black; font-weight:bold">Duplicate Row</a></li>
				</ul>
			</td>
			<td >
				<input type="text" class="form-control batch"   aria-describedby="button-addon2" style="outline: none; border:none; " value="'.$batchCode[$i-1].'"/>
				<input type="hidden" class="form-control baseentry"  style="outline: none; border:none; " readonly/>
				<input type="hidden" class="form-control linenum"   style="outline: none; border:none; " readonly/>
				<input type="hidden" class="form-control tbldetailrowno"   style="outline: none; border:none; " value="'.$rowNo.'"/>
			</td>
			<td >
				<input type="text" class="form-control matrix-cell text-right quantity"  aria-label="" aria-describedby="button-addon2" style="outline: none; border:none" maxlength="12" value="'.$batchQTY[$i-1].'"/>	
			</td>
			<td >
				<input type="date" class="form-control  matrix-cell expdate" style="outline: none; border:none;" placeholder="" aria-label="Username" aria-describedby="basic-addon1" value="'.$batchExpDate[$i-1].'" min="2018-01-01" max="2050-12-31">						
			</td>
			<td >
				<input type="date" class="form-control  matrix-cell mfrdate" style="outline: none; border:none;" placeholder="" aria-label="Username" aria-describedby="basic-addon1" value="'.$batchMfrDate[$i-1].'"  min="2018-01-01" max="2050-12-31">						
			</td>
			<td >
				<input type="date" class="form-control  matrix-cell admindate" style="outline: none; border:none;" placeholder="" aria-label="Username" aria-describedby="basic-addon1" value="'.$batchAdminDate[$i-1].'"  min="2018-01-01" max="2050-12-31">						
			</td>
			<td >
				<input type="text" class="form-control matrix-cell text-right location"   style="outline: none; border:none" maxlength="8" value="'.$batchLocation[$i-1].'"/>
			</td>
			<td >
				<input type="text" class="form-control text-right details"   style="outline: none; border:none" maxlength="8" value="'.$batchDetails[$i-1].'"/>
			</td>
			<td >
				<input type="text" class="form-control matrix-cell text-right unitcost"   aria-label="" aria-describedby="button-addon2" style="outline: none; border:none" maxlength="12" value="'.$batchUnitCost[$i-1].'"/>
			</td>
		</tr>';
		$i++;
			}
			
			echo '
		<tr style="background-color: white; "  >
			<td class="rowno text-right" style="background-color: lightgray;color:black; font-size:13px;">
				<span>'.$i.'</span>
				<button type="button" class="btn d-none btnrowfunctions" data-toggle="dropdown" style="width:1px; padding-left: 0px !important;margin-left: 0px !important">
					<i class="fas fa-caret-down" ></i>
				</button>
				<ul class="dropdown-menu rowfunctions" role="menu" style="background-color: #fdfd96;">
					<li class="deleterow" style="font-size:20px; color: black; font-weight:bold">Delete Row</a></li>
					<li class="duplicaterow"style="font-size:20px; color: black; font-weight:bold">Duplicate Row</a></li>
				</ul>
			</td>
			<td >
				<input type="text" class="form-control batch"   aria-describedby="button-addon2" style="outline: none; border:none; " />
				<input type="hidden" class="form-control baseentry"  style="outline: none; border:none; " readonly/>
				<input type="hidden" class="form-control linenum"   style="outline: none; border:none; " readonly/>
			</td>
			<td >
				<input type="text" class="form-control matrix-cell text-right quantity"  aria-label="" aria-describedby="button-addon2" style="outline: none; border:none" maxlength="12"/>	
			</td>
			<td >
				<input type="date" class="form-control  matrix-cell expdate" style="outline: none; border:none;" placeholder="" aria-label="Username" aria-describedby="basic-addon1" value="'.date('Y-m-d').'" min="2018-01-01" max="2050-12-31">						
			</td>
			<td >
				<input type="date" class="form-control  matrix-cell mfrdate" style="outline: none; border:none;" placeholder="" aria-label="Username" aria-describedby="basic-addon1" value="'.date('Y-m-d').'" min="2018-01-01" max="2050-12-31">						
			</td>
			<td >
				<input type="date" class="form-control  matrix-cell admindate" style="outline: none; border:none;" placeholder="" aria-label="Username" aria-describedby="basic-addon1" value="'.date('Y-m-d').'" min="2018-01-01" max="2050-12-31">						
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
		</tr>';
		
}

else{
		echo '
		<tr style="background-color: white; "  >
			<td class="rowno text-right" style="background-color: lightgray;color:black; font-size:13px;">
				<span>'.$i.'</span>
				<button type="button" class="btn d-none btnrowfunctions" data-toggle="dropdown" style="width:1px; padding-left: 0px !important;margin-left: 0px !important">
					<i class="fas fa-caret-down" ></i>
				</button>
				<ul class="dropdown-menu rowfunctions" role="menu" style="background-color: #fdfd96;">
					<li class="deleterow" style="font-size:20px; color: black; font-weight:bold">Delete Row</a></li>
					<li class="duplicaterow"style="font-size:20px; color: black; font-weight:bold">Duplicate Row</a></li>
				</ul>
			</td>
			<td >
				<input type="text" class="form-control batch"   aria-describedby="button-addon2" style="outline: none; border:none; " />
				<input type="hidden" class="form-control baseentry"  style="outline: none; border:none; " readonly/>
				<input type="hidden" class="form-control linenum"   style="outline: none; border:none; " readonly/>
			</td>
			<td >
				<input type="text" class="form-control matrix-cell text-right quantity"  aria-label="" aria-describedby="button-addon2" style="outline: none; border:none" maxlength="12"/>	
			</td>
			<td >
				<input type="date" class="form-control  matrix-cell expdate" style="outline: none; border:none;" placeholder="" aria-label="Username" aria-describedby="basic-addon1" value="'.date('Y-m-d').'" min="2018-01-01" max="2050-12-31">						
			</td>
			<td >
				<input type="date" class="form-control  matrix-cell mfrdate" style="outline: none; border:none;" placeholder="" aria-label="Username" aria-describedby="basic-addon1" value="'.date('Y-m-d').'" min="2018-01-01" max="2050-12-31">						
			</td>
			<td >
				<input type="date" class="form-control  matrix-cell admindate" style="outline: none; border:none;" placeholder="" aria-label="Username" aria-describedby="basic-addon1" value="'.date('Y-m-d').'" min="2018-01-01" max="2050-12-31">						
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
		</tr>';
}
		?>



