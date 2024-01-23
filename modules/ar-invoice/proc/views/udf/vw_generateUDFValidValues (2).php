<?php
session_start();
include('../../../../../config/config.php');

$fieldId = $_GET["fieldId"];
$table = $_GET['mainTable'];

?>

			
<?php	
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
		T1.FieldId,
		T1.IndexID,
		T1.FldValue,
		T1.Descr AS DescrValidValue
	
	
		FROM CUFD T0
		LEFT JOIN UFD1 T1 ON T0.TableID = T1.TableID AND T0.FieldId = T1.FieldId 
		
		WHERE T0.TableID = '".$table."' AND T1.FieldId = '$fieldId' AND ISNULL(T0.Dflt,'') <> T1.FldValue


		");
		
	while (odbc_fetch_row($qry)) 
		{
			$indexID = odbc_result($qry, 'IndexID');
			$fieldId = odbc_result($qry, 'FieldId');
			$fldValue = odbc_result($qry, 'FldValue');
			$descr = odbc_result($qry, 'DescrValidValue');
			
			$inputID = odbc_result($qry, 'AliasID');
			$typeID = odbc_result($qry, 'TypeID');
			$editType = odbc_result($qry, 'EditType');
			$sizeID = odbc_result($qry, 'SizeID');
			$rTable = odbc_result($qry, 'RTable');
			$inputType = 'text';
			$amount = '';
			$value = '';
			$linked = 'd-none';
			$textPosition = 'text-left';
			$typeID == 'A' ? $inputType = 'text' : '';
			$typeID == 'N' ? $inputType = 'number' : '';
			$typeID == 'N' ? $textPosition = 'text-right' : '';
			$typeID == 'D' ? $inputType = 'date' : '';
			$typeID == 'D' ? $value = date("Y-m-d") : '';
			$typeID == 'B' ? $amount = 'amount' : '';
			$typeID == 'B' ? $textPosition = 'text-right' : '';
			$rTable != NULL ? $linked = '' : '';
			
			
				echo ' 
						<option value="'.$fldValue.'">'.$descr.'</option>
				';
			
		}
		odbc_free_result($qry);
		odbc_close($MSSQL_CONN);
?>
