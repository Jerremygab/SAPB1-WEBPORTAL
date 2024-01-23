<?php
session_start();

$rowNo = $_GET['rowNo'];
$mfrSerialData = $_GET['mfrSerialData'];
$serialData = $_GET['serialData'];
$serialDataQTY = $_GET['serialDataQTY'];
$serialExpDate = $_GET['serialExpDate'];
$serialMfrDate = $_GET['serialMfrDate'];
$serialAdminDate = $_GET['serialAdminDate'];
$serialLocation = $_GET['serialLocation'];
$serialDetails = $_GET['serialDetails'];
$serialUnitCost = $_GET['serialUnitCost'];
	$i = 1;					
if($serialData != ''){
	$serialCode = $serialData;

	if($serialDataQTY != ''){
		$serialQTY = $serialDataQTY;
	}
	if($serialUnitCost != ''){
		$serialUnitCost = $serialUnitCost;
	}
	else{
		$serialUnitCost = '0';
	}
	if($serialExpDate != ''){
		$serialExpDate = $serialExpDate;
	}
	else{
		$serialExpDate = '';
	}
	if($serialMfrDate != ''){
		$serialMfrDate = $serialMfrDate;
	}
	else{
		$serialMfrDate = '';
	}
	if($serialAdminDate != ''){
		$serialAdminDate = $serialAdminDate;
	}
	else{
		$serialAdminDate = '';
	}
	
	foreach ($serialCode as $data){
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
				<input type="text" class="form-control mfrserial"   aria-describedby="button-addon2" style="outline: none; border:none; " value="'.$mfrSerialData[$i-1].'" />
				<input type="hidden" class="form-control baseentry"  style="outline: none; border:none; " readonly/>
				<input type="hidden" class="form-control linenum"   style="outline: none; border:none; " readonly/>
				<input type="hidden" class="form-control tbldetailrowno"   style="outline: none; border:none; " value="'.$rowNo.'"/>
			</td>
			<td >
				<input type="text" class="form-control serial"   aria-describedby="button-addon2" style="outline: none; border:none; " value="'.$serialData[$i-1].'"/>
				<input type="hidden" class="form-control matrix-cell text-right quantity"  aria-label="" aria-describedby="button-addon2" style="outline: none; border:none" maxlength="12" value="'.'1'.'"/>	
			
			</td>
				
			<td >
				<input type="date" class="form-control  matrix-cell expdate" style="outline: none; border:none;" placeholder="" aria-label="Username" aria-describedby="basic-addon1" value="'.$serialExpDate[$i-1].'" min="2018-01-01" max="2050-12-31">						
			</td>
			<td >
				<input type="date" class="form-control  matrix-cell mfrdate" style="outline: none; border:none;" placeholder="" aria-label="Username" aria-describedby="basic-addon1" value="'.$serialMfrDate[$i-1].'"  min="2018-01-01" max="2050-12-31">						
			</td>
			<td >
				<input type="date" class="form-control  matrix-cell admindate" style="outline: none; border:none;" placeholder="" aria-label="Username" aria-describedby="basic-addon1" value="'.$serialAdminDate[$i-1].'"  min="2018-01-01" max="2050-12-31">						
			</td>
			<td >
				<input type="text" class="form-control matrix-cell text-right location"   style="outline: none; border:none" maxlength="8" value="'.$serialLocation[$i-1].'"/>
			</td>
			<td >
				<input type="text" class="form-control text-right details"   style="outline: none; border:none" maxlength="8" value="'.$serialDetails[$i-1].'"/>
			</td>
			<td >
				<input type="text" class="form-control matrix-cell text-right unitcost"   aria-label="" aria-describedby="button-addon2" style="outline: none; border:none" maxlength="12" value="'.$serialUnitCost[$i-1].'"/>
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
				<input type="text" class="form-control mfrserial"   aria-describedby="button-addon2" style="outline: none; border:none; " />
				<input type="hidden" class="form-control baseentry"  style="outline: none; border:none; " readonly/>
				<input type="hidden" class="form-control linenum"   style="outline: none; border:none; " readonly/>
			</td>
			<td >
				<input type="text" class="form-control serial"   aria-describedby="button-addon2" style="outline: none; border:none; " />
				<input type="hidden" class="form-control matrix-cell text-right quantity"  aria-label="" aria-describedby="button-addon2" style="outline: none; border:none" maxlength="12" value="'.'1'.'"/>	
			
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
				<input type="text" class="form-control mfrserial"   aria-describedby="button-addon2" style="outline: none; border:none; " />
				<input type="hidden" class="form-control baseentry"  style="outline: none; border:none; " readonly/>
				<input type="hidden" class="form-control linenum"   style="outline: none; border:none; " readonly/>
			</td>
			<td >
				<input type="text" class="form-control serial"   aria-describedby="button-addon2" style="outline: none; border:none; " />
				<input type="hidden" class="form-control matrix-cell text-right quantity"  aria-label="" aria-describedby="button-addon2" style="outline: none; border:none" maxlength="12" value="'.'1'.'"/>	
			
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



