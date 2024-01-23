<?php
session_start();
include('../../../../config/config.php');
?>

			
<?php	
	$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
		SELECT 
		'U_' + T0.AliasID AS 'AliasID',
		T0.Descr,
		T0.TypeID,
		T0.EditType,
		T0.SizeID
	
		FROM CUFD T0
		WHERE T0.TableID = 'ORDR'
		");
		
	while (odbc_fetch_row($qry)) 
		{
			$inputID = odbc_result($qry, 'AliasID');
			$typeID = odbc_result($qry, 'TypeID');
			$editType = odbc_result($qry, 'EditType');
			$sizeID = odbc_result($qry, 'SizeID');
			$inputType = 'text';
			$amount = '';
			$value = '';
			$textPosition = 'text-left';
			$typeID == 'A' ? $inputType = 'text' : '';
			$typeID == 'N' ? $inputType = 'number' : '';
			$typeID == 'N' ? $textPosition = 'text-right' : '';
			$typeID == 'D' ? $inputType = 'date' : '';
			$typeID == 'D' ? $value = date("Y-m-d") : '';
			$typeID == 'B' ? $amount = 'amount' : '';
			$typeID == 'B' ? $textPosition = 'text-right' : '';
			
			echo '
						<div class="form-group row  py-0 my-0" id="udfList">
						<label for="inputEmail3" class="col-sm-5 col-form-label " style="color: black; font-size:15px" class="labeludf" >'.odbc_result($qry, 'Descr').'</label>
							<div class="col-sm-7 input-group mb-1">
								<input type="'.$inputType.'"  id="'.$inputID.'" class="form-control '.$textPosition.' inputUdf '.$amount.'" value="' . $value .'" min="2018-01-01" max="2050-12-31">
							</div>
						</div>
				';
		}
		odbc_free_result($qry);
?>
