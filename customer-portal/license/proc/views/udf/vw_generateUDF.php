<?php
session_start();
include('../../../../../config/config.php');

$table = $_GET['mainTable'];
	
	$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
		SELECT 
		'U_' + T0.AliasID AS 'AliasID',
		T0.Descr,
		T0.TypeID,
		T0.EditType,
		T0.SizeID,
		T0.EditSize,
		T0.Dflt,
		T0.RTable,
		T0.RelUdo,
		T0.FieldId,
		T0.tableId,
		MAX(T1.IndexID) AS ValidValues,
		T2.Descr AS DescDflt
		
	
	
		FROM CUFD T0
		LEFT JOIN UFD1 T1 ON T0.tableId = T1.tableId AND T0.FieldId = T1.FieldId 
		LEFT JOIN UFD1 T2 ON T0.Dflt = T2.FldValue AND T0.FieldId = T2.FieldId 
		
		WHERE T0.tableId = '".$table."'
		
		GROUP BY
		T0.AliasID,
		T0.Descr,
		T0.TypeID,
		T0.EditType,
		T0.SizeID,
		T0.EditSize,
		T0.Dflt,
		T0.RTable,
		T0.RelUdo,
		T0.FieldId,
		T0.TableId,
		T2.Descr
		
		ORDER BY T0.FieldId

		");
		
	while (odbc_fetch_row($qry)) 
		{
			
			$validValues = odbc_result($qry, 'ValidValues');
			$fieldId = odbc_result($qry, 'FieldId');
			$tableId = odbc_result($qry, 'TableId');
			$default = odbc_result($qry, 'Dflt');
			$descDflt  = odbc_result($qry, 'DescDflt');
			
			$inputID = odbc_result($qry, 'AliasID');
			$typeID = odbc_result($qry, 'TypeID');
			$editType = odbc_result($qry, 'EditType');
			$sizeID = odbc_result($qry, 'SizeID');
			$rTable = odbc_result($qry, 'RTable');
			$inputType = 'text';
			$amount = '';
			$value = '';
			$amountDecimal = '';
			$linked = 'd-none';
			$readonly = '';
			$textPosition = 'text-left';
			$typeID == 'A' ? $inputType = 'text' : '';
			$typeID == 'N' ? $inputType = 'text' : '';
			$typeID == 'N' ? $textPosition = 'text-right' : '';
			$typeID == 'D' ? $inputType = 'date' : '';
			$typeID == 'D' ? $value = date("Y-m-d") : '';
			$typeID == 'B' ? $amount = 'amount' : '';
			
			$typeID == 'B' ? $textPosition = 'text-right' : '';
			$rTable != NULL ? $linked = '' : '';
			$rTable != NULL ? $readonly = 'readonly' : '';
			
			if($default != NULL){
				$value = $default;
				$descDflt = $descDflt;
			}
			else{
				
				$descDflt = 'Select Option';
			} 
			if($validValues == NULL){
				echo ' 
						<div class="form-group row  py-0 my-0" id="udfList">
						<label for="inputEmail3" class="col-sm-4 col-form-label " style="color: black; font-size:15px" class="labeludf" >'.odbc_result($qry, 'Descr').'</label>
							<div  class="col-sm-8 input-group mb-1 udfdiv">
								<input type="'.$inputType.'" id="'.$inputID.'" class="form-control udfcode d-none" value="' . $value .'" min="2018-01-01" max="2050-12-31">
								<input type="'.$inputType.'" validValues="'.$validValues.'" fieldId="" tableId="'.$tableId.'" table="'.$rTable.'" id2="'.$inputID.'" class="form-control '.$textPosition.' inputUdf '.$amount.' udfname" value="' . $value .'" min="2018-01-01" max="2050-12-31" "'.$readonly.'">
									<div class="input-group-append '.$linked.'">
										<button class="btn btnGroup" type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#udfModal" data-backdrop="false" >
											<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue "></i>
										</button>
									</div>
							</div>
						</div>
				';
			}
			else{
				echo ' <div class="form-group row  py-0 my-0" id="udfList">
						<label for="inputEmail3" class="col-sm-4 col-form-label " style="color: black; font-size:15px" class="labeludf" >'.odbc_result($qry, 'Descr').'</label>
							<div  class="col-sm-8 input-group mb-1 udfdiv">
								<input type="hidden" id="'.$inputID.'" class="form-control udfcode" value="' . $value .'" min="2018-01-01" max="2050-12-31">
								<select type="'.$inputType.'" validValues="'.$validValues.'" fieldId="'.$fieldId.'" default="'.$default.'" tableId="'.$tableId.'" table="" id2="'.$inputID.'" class="form-control inputUdf udfname selectUdf"  >
										
									<option value="'.$value.'" class="defaultOption">'.$descDflt.'</option>
									
								</select>
									
							</div>
						</div>
				';
			}
		}
		odbc_free_result($qry);
		odbc_close($MSSQL_CONN);
?>
