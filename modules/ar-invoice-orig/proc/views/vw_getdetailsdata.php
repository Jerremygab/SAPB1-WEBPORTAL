<?php
session_start();
include_once('../../../../config/config.php');

$docNum = $_GET['docNum'];
$docType = $_GET['docType'];
$objType = $_GET['objType'];

$table = '';
$table2 = '';
$isBaseType = false;

$objSession = json_decode($_SESSION['ARInvoiceArr']);

if($objType == $objSession->objectType){
	$table = $objSession->objectTable;
	$table2 = $objSession->childTable1;
}
else{
	foreach ($objSession->copyFromArr as $item) {
		if ($objType == $item->baseType) {
			$table = $item->baseTable;
			$table2 = $item->baseChildTable1;
			$isBaseType = true;
			break;
		}
	}
}


if($objType == 17){
	$table = 'ORDR';
	$table2 = 'RDR1';
}else if($objType == 15){
	$table = 'ODLN';
	$table2 = 'DLN1';
}
$taxcode2 = "";
$rate = 0;

$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT Code, Name, Rate FROM OVTG WHERE Inactive = 'N' AND Category='$objSession->taxCodeCategory'");

while (odbc_fetch_row($qry)) 
{
    $taxcode2 .= '<option val' . odbc_result($qry, "Code") . ' val-rate="' . number_format(odbc_result($qry, "Rate"), 6, '.', '.') . '" value="' . odbc_result($qry, "Code") . '">' . odbc_result($qry, "Code") .'</option>';
	$rate = number_format(odbc_result($qry, "Rate"), 6, '.', '.');
}

$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
	SELECT 
		T0.DocEntry,
		T0.DocNum,
		T0.DocStatus,
		T0.ObjType,
		T1.TargetType,
		T1.TrgetEntry,
		T1.LineStatus,
		T1.BaseType,
		T1.ItemCode,
		T1.Dscription,
		T1.AcctCode,
		
		T1.Quantity,
		T1.PriceAfVat,
		T1.Price,
		T1.DiscPrcnt,
		
		(T1.DiscPrcnt/100) * T1.price AS 'DiscSum',
		T1.Price * T1.Quantity AS 'RowTotal',
		T1.PriceAfVat * T1.Quantity AS 'GrossTotal',
		(T1.PriceAfVat * T1.Quantity) - (T1.Price * T1.Quantity) AS 'TaxAmount',
		
		(T1.DiscPrcnt/100) * T1.price AS 'DiscSum2',
		T1.Price  AS 'RowTotal2',
		T1.PriceAfVat  AS 'GrossTotal2',
		(T1.PriceAfVat) - (T1.Price) AS 'TaxAmount2',
		
		T1.UoMEntry,
		T1.VatGroup,
		T1.GTotal,
		T1.LineNum,
		T1.VisOrder,
		
		T1.WhsCode,
		T5.WhsName,
		
		CASE 
		WHEN T1.UomEntry = '-1' THEN 'Manual'
		ELSE T1.UnitMsr 
		END AS UnitMsr,
		
		T2.UomCode,
		T3.AcctName,
		
		T4.ManBtchNum,
		T4.ManSerNum
		
	FROM " . $table . " T0 
	INNER JOIN " . $table2 . " T1 ON T0.DocEntry = T1.DocEntry
	LEFT JOIN OUOM T2 ON T1.UoMEntry = T2.UoMEntry
	LEFT JOIN OACT T3 ON T1.AcctCode = T3.AcctCode
	LEFT JOIN OITM T4 ON T4.ItemCode = T1.ItemCode
	LEFT JOIN OWHS T5 ON T5.WhsCode = T1.WhsCode

			WHERE T0.DocNum IN ( $docNum )
			ORDER BY T1.LineNum ASC");
$ctr = 1;

while (odbc_fetch_row($qry)) 
{
	
	$DocEntry = odbc_result($qry, "DocEntry");
	$DocStatus = odbc_result($qry, "DocStatus");
	$LineNum = odbc_result($qry, "LineNum");
	$ObjType = odbc_result($qry, "ObjType");
	$TargetType = odbc_result($qry, "TargetType");
	$TrgetEntry = odbc_result($qry, "TrgetEntry");
	$LineStatus = odbc_result($qry, "LineStatus");
	$BaseType = odbc_result($qry, "BaseType");
	
	$VisOrder = odbc_result($qry, "VisOrder");
	$ItemCode = odbc_result($qry, "ItemCode");
    $Dscription = odbc_result($qry, "Dscription");
	$AcctCode = odbc_result($qry, "AcctCode");
	$AcctName = odbc_result($qry, "AcctName");
	$Quantity = odbc_result($qry, "Quantity");
	$PriceAfVat = odbc_result($qry, "PriceAfVat");
	
	$Price = odbc_result($qry, "Price");
	$DiscSum = number_format(odbc_result($qry, "DiscSum"),6);
	$DiscSum2 = number_format(odbc_result($qry, "DiscSum2"),6);
	$DiscPrcnt = number_format(odbc_result($qry, "DiscPrcnt"),6);
	
	$RowTotal = odbc_result($qry, "RowTotal");
	$GrossTotal = odbc_result($qry, "GrossTotal");
	$TaxAmount = odbc_result($qry, "TaxAmount");
	$RowTotal2 = number_format(odbc_result($qry, "RowTotal2"),6);
	$GrossTotal2 = number_format(odbc_result($qry, "GrossTotal2"),6);
	$TaxAmount2 = number_format(odbc_result($qry, "TaxAmount2"),6);
	
	$VatGroup = odbc_result($qry, "VatGroup"); 
	$UoMEntry = odbc_result($qry, "UoMEntry"); 
	$UomCode = odbc_result($qry, "UomCode"); 
	$UnitMsr = odbc_result($qry, "UnitMsr"); 
	$taxcode = str_replace('val' . $VatGroup, 'selected', $taxcode2);
	
	$ManBtchNum = odbc_result($qry, "ManBtchNum"); 
	$ManSerNum = odbc_result($qry, "ManSerNum"); 
	
	$WhsCode = odbc_result($qry, "WhsCode"); 
	$WhsName = odbc_result($qry, "WhsName"); 
	
	$readonly = '';
	$inputGroup = 'input-group';
	$buttonHide = '';
	$disabled = '';
	$hasBatchSerial = '';

	if($ObjType == $objSession->objectType){
		$readonly = 'readonly';
		$buttonHide = 'd-none';
		$disabled = 'disabled';
	}

	if($ManBtchNum == 'Y'){
		if ($BaseType == '-1'){
			$hasBatchSerial = 'B';
		} else {
			$hasBatchSerial = '-B';	
		}
	}
	else if($ManSerNum == 'Y'){
		if ($BaseType == '-1'){
			$hasBatchSerial = 'S';
		} else {
			$hasBatchSerial = '-S';	
		}
	}
	else{
		$hasBatchSerial = '';
	}

				if($docType == 'I'){
					// if ($LineStatus == 'C' && $isBaseType)
					// 	continue;
					// else if ($Quantity > 1 && $TargetType != -1) {
					// 	if ($Quantity == 2){
					// 			$Quantity = 1;
					// 			$RowTotal = $Price * $Quantity;
					// 			$GrossTotal = $PriceAfVat * $Quantity;
					// 			$TaxAmount = ($PriceAfVat * $Quantity) - ($Price * $Quantity);
					// 	}
					// 	else {
					// 		odbc_free_result($qry);
							
					// 		$childTable1 = '';
					// 		$objectTablesArr = json_decode($_SESSION['objectTablesArr']);
							
					// 		foreach ($objectTablesArr as $item) {
					// 			if ($TargetType == $item->objectType) {
					// 				$childTable1 = $item->childTable1;
					// 				break;
					// 			}
					// 		}
							
					// 		$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
					// 			SELECT Quantity FROM $childTable1 WHERE DocEntry = $TrgetEntry
					// 		");
					// 		while (odbc_fetch_row($qry)){
					// 			$Quantity -= odbc_result($qry, "Quantity");
					// 		}
					// 		$RowTotal = $Price * $Quantity;
					// 		$GrossTotal = $PriceAfVat * $Quantity;
					// 		$TaxAmount = ($PriceAfVat * $Quantity) - ($Price * $Quantity);
					// 	}
					// }
					
					$PriceAfVat = number_format($PriceAfVat,6);
					$Price = number_format($Price,6);
					$Quantity = number_format($Quantity,6);
					$RowTotal = number_format($RowTotal,6);
					$GrossTotal = number_format($GrossTotal,6);
					$TaxAmount = number_format($TaxAmount,6);


   
					echo 
					'<tr style="background-color: white; "  >
					  <td class="rowno text-right" style="background-color: lightgray;color:black;">
						<span>'.$ctr.'</span>
						<button type="button" class="btn '.$buttonHide.' btnrowfunctions" data-toggle="dropdown" style="width:1px; padding-left: 0px !important;margin-left: 0px !important">
							<i class="fas fa-caret-down" ></i>
						</button>
						
					
						 <ul class="dropdown-menu rowfunctions" role="menu" style="background-color: #fdfd96;">
							<li class="deleterow" style="font-size:20px; color: black; font-weight:bold">Delete Row</a></li>
							<li class="duplicaterow"style="font-size:20px; color: black; font-weight:bold">Duplicate Row</a></li>
						  </ul>
						
					  </td>
					  <td >
						<div class="'.$inputGroup.' " >
						<input type="text" class="form-control itemcode"  style="outline: none; border:none; " readonly value="'.$ItemCode.'" />
						<input type="hidden" class="form-control batchorserial "  style="outline: none; border:none; " readonly value="'.$hasBatchSerial.'" />
						<input type="text" class="form-control baseentry"   style="outline: none; border:none; " value="'.$DocEntry.'" readonly/>
						<input type="text" class="form-control linenum"   style="outline: none; border:none; " value="'.$LineNum.'" readonly/>
						<input type="hidden" class="form-control visorder"  style="outline: none; border:none; " readonly value="'.$VisOrder.'" />
						  <button class="btn '.$buttonHide.' "  type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#itemModal" data-backdrop="false" >
							<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue " ></i>
						  </button>
						<input type="hidden" class="form-control matrix-cell uomgroup"   style="outline: none; border:none" readonly/>
						</div>
					  </td>
					  <td >
						<div class="'.$inputGroup.' ">
						<input type="text" class="form-control matrix-cell itemname"  style="outline: none; border:none"  value="'.$Dscription.'" / >
						  <button class="btn '.$buttonHide.' "   type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#itemModal" data-backdrop="false">
							<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue " ></i>
						  </button>
						<input type="hidden" class="form-control matrix-cell uomgroup"   style="outline: none; border:none" readonly value="'.$UomCode.'" />
						</div>
					  </td>
					  <td >
						<div class="'.$inputGroup.' ">
						<input type="text" class="form-control matrix-cell unitmsr"  style="outline: none; border:none" readonly value="'.$UnitMsr.'" />
						  <button class="btn '.$buttonHide.' " type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#uomModal" data-backdrop="false">
							<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue " ></i>
						  </button>
						<input type="hidden" class="form-control matrix-cell uomentry"  style="outline: none; border:none" value="'.$UoMEntry.'" />
						</div>
					  </td>
					   <td >
						<div class="'.$inputGroup.' ">
						<input type="text" class="form-control matrix-cell whsecode"   style="outline: none; border:none" readonly/  value="'.$WhsCode.'">
						  <button class="btn '.$buttonHide.' " type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#whseModal" data-backdrop="false">
							<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue " ></i>
						  </button>
						<input type="hidden" class="form-control matrix-cell whsename"   style="outline: none; border:none" value="'.$WhsName.'"/>
						</div>
					  </td>
					   <td >
					   <div class="'.$inputGroup.' ">
						<input type="text" class="form-control matrix-cell text-right quantity" value="'.$Quantity.'" aria-label="" aria-describedby="button-addon2" style="outline: none; border:none" maxlength="12" '.$readonly.'/>
						 <button class="btn '.$buttonHide.' btn-batch d-none" type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#batchModal" data-backdrop="false">
							<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue " ></i>
						  </button>
						   <button class="btn '.$buttonHide.' btn-serial d-none" type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#serialModal" data-backdrop="false">
							<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue " ></i>
						  </button>
						  <button class="btn '.$buttonHide.' btn-disabled d-none"   type="button" data-mdb-ripple-color="dark"  style="background-color: lightgray; "  data-toggle="modal" data-target="#" data-backdrop="false" >
							<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:black " ></i>
						</button>
						</div>
					  </td>
						<td >
						<input type="text" class="form-control matrix-cell text-right price" value="'.$Price.'"  aria-label="" aria-describedby="button-addon2" style="outline: none; border:none" maxlength="20" '.$readonly.' />
						
					  </td>
						<td >
						<input type="text" class="form-control matrix-cell text-right discount"  value="'.$DiscPrcnt.'" style="outline: none; border:none" maxlength="8" '.$readonly.'/>
						
					  </td>
					   <td >
							<div class="'.$inputGroup.' ">
								<input type="hidden" class="form-control text-right  taxamount" value="'.$TaxAmount.'" style="outline: none; border:none" maxlength="8" readonly/>
								<select type="text" class="form-control taxcode"  placeholder=""   readonly '.$disabled .'>
										"'.$taxcode.'"
								</select>
							</div>
					  </td>
					  
					   <td >
						<input type="text" class="form-control matrix-cell text-right grossprice"  value="'.$PriceAfVat.'" aria-label="" aria-describedby="button-addon2" style="outline: none; border:none" maxlength="20" readonly/>
						
					  </td>
					   <td >
						<input  type="text" class="form-control matrix-cell text-right rowtotal "  value="'.$RowTotal.'" style="outline: none; border:none" readonly/>	
					  </td>
					   <td >
						<input  type="text" class="form-control matrix-cell text-right grosstotal "  value="'.$GrossTotal.'" style="outline: none; border:none" readonly/>	
					  </td>
					</tr>'
					;
			
					$ctr += 1;
				}
				else{
					if ($LineStatus == 'C' && $isBaseType)
						continue;

					echo '<tr style="background-color: white; "  >
						  <td class="rowno text-right" style="background-color: lightgray;color:black;">
							<span>'.$ctr.'</span>
							<button type="button" class="btn '.$buttonHide.'" data-toggle="dropdown" style="width:1px; padding-left: 0px !important;margin-left: 0px !important">
								<i class="fas fa-caret-down" ></i>
							</button>
							<ul class="dropdown-menu rowfunctions" role="menu" style="background-color: #fdfd96;">
								<li class="deleterow" style="font-size:20px; color: black; font-weight:bold">Delete Row</a></li>
								<li class="duplicaterow"style="font-size:20px; color: black; font-weight:bold">Duplicate Row</a></li>
							  </ul>
						  </td>
						   <td >
							<input type="text" class="form-control matrix-cell gldescription"  value="'.$Dscription.'" style="outline: none; border:none" '.$readonly .'/>
							 
						  </td>
						  <td >
							<div class="'.$inputGroup.' ">
							<input type="text" class="form-control matrix-cell glaccount"   value="'.$AcctCode.'" style="outline: none; border:none" readonly/>
							<input type="hidden" class="form-control baseentry"   style="outline: none; border:none; " value="'.$DocEntry.'" readonly/>
							<input type="hidden" class="form-control linenum"   style="outline: none; border:none; " value="'.$LineNum.'" readonly/>
							<input type="hidden" class="form-control visorder"  style="outline: none; border:none; " readonly value="'.$VisOrder.'" />
							  <button class="btn '.$buttonHide.' "   type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#glModal" data-backdrop="false">
								<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue " ></i>
							  </button>
							</div>
						  </td>
						   <td >
							<input type="text" class="form-control matrix-cell glname"  value="'.$AcctName.'" aria-label="" aria-describedby="button-addon2" style="outline: none; border:none" maxlength="20" readonly/>
							
						  </td>
						   <td class="d-none">
							<input type="text" class="form-control matrix-cell text-right quantity"  value="1" aria-label="" aria-describedby="button-addon2" style="outline: none; border:none" maxlength="20" value="1"/>
							
						  </td>
							<td >
							<input type="text" class="form-control matrix-cell text-right price"   value="'.$Price.'" aria-label="" aria-describedby="button-addon2" style="outline: none; border:none" maxlength="20" '.$readonly .'/>
							
						  </td>
							<td >
							<input type="text" class="form-control matrix-cell text-right discount"   value="'.$DiscPrcnt.'" style="outline: none; border:none" maxlength="8" '.$readonly.'/>
							
						  </td>
						   <td >
								<div class="'.$inputGroup.' ">
									<input type="hidden" class="form-control text-right  taxamount"  value="'.$TaxAmount2.'"  style="outline: none; border:none" maxlength="8"/>
									<select type="text" class="form-control taxcode"  placeholder=""   readonly '.$disabled .'>
												 '.$taxcode.'
													</select>
								</div>
						  </td>
						   <td >
							<input type="text" class="form-control matrix-cell text-right grossprice"    value="'.$PriceAfVat.'"  style="outline: none; border:none" maxlength="20" readonly/>
							
						  </td>
						   <td >
							<input  type="text" class="form-control matrix-cell text-right rowtotal "   value="'.$RowTotal2.'" style="outline: none; border:none" readonly/>	
						  </td>
						   <td >
							<input  type="text" class="form-control matrix-cell text-right grosstotal "   value="'.$GrossTotal2.'" style="outline: none; border:none" readonly/>	
						  </td>
						</tr>';
						
						$ctr += 1;
				}
}
// //for another row
// 	if($isBaseType){
// 		$date = date("Y-m-d");
// 		if($docType == 'I'){
   
// 					echo 
// 					'<tr style="background-color: white; "  >
// 					  <td class="rowno text-right" style="background-color: lightgray;color:black;">
// 						<span>'.$ctr.'</span>
// 						<button type="button" class="btn d-none btnrowfunctions" data-toggle="dropdown" style="width:1px; padding-left: 0px !important;margin-left: 0px !important">
// 							<i class="fas fa-caret-down" ></i>
// 						</button>
						
					
// 						 <ul class="dropdown-menu rowfunctions" role="menu" style="background-color: #fdfd96;">
// 							<li class="deleterow" style="font-size:20px; color: black; font-weight:bold">Delete Row</a></li>
// 							<li class="duplicaterow"style="font-size:20px; color: black; font-weight:bold">Duplicate Row</a></li>
// 						  </ul>
// 					  </td>
// 					  <td >
// 						<div class="'.$inputGroup.' " >
// 						<input type="text" class="form-control itemcode"  style="outline: none; border:none; " readonly  />
// 						<input type="hidden" class="form-control batchorserial "  style="outline: none; border:none; " readonly  />
// 						<input type="hidden" class="form-control baseentry"   style="outline: none; border:none; "  readonly/>
// 						<input type="hidden" class="form-control linenum"   style="outline: none; border:none; " readonly/>
// 						<input type="hidden" class="form-control visorder"  style="outline: none; border:none; " readonly  />
// 						  <button class="btn '.$buttonHide.' "  type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#itemModal" data-backdrop="false" >
// 							<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue " ></i>
// 						  </button>
// 						<input type="hidden" class="form-control matrix-cell uomgroup"   style="outline: none; border:none" readonly/>
// 						</div>
// 					  </td>
// 					  <td >
// 						<div class="'.$inputGroup.' ">
// 						<input type="text" class="form-control matrix-cell itemname"  style="outline: none; border:none"   / >
// 						  <button class="btn '.$buttonHide.' "   type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#itemModal" data-backdrop="false">
// 							<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue " ></i>
// 						  </button>
// 						<input type="hidden" class="form-control matrix-cell uomgroup"   style="outline: none; border:none" readonly  />
// 						</div>
// 					  </td>
// 					  <td >
// 						<div class="'.$inputGroup.' ">
// 						<input type="text" class="form-control matrix-cell unitmsr"  style="outline: none; border:none" readonly  />
// 						  <button class="btn '.$buttonHide.' " type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#uomModal" data-backdrop="false">
// 							<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue " ></i>
// 						  </button>
// 						<input type="hidden" class="form-control matrix-cell uomentry"  style="outline: none; border:none"  />
// 						</div>
// 					  </td>
// 					   <td >
// 						<div class="'.$inputGroup.' ">
// 						<input type="text" class="form-control matrix-cell whsecode"   style="outline: none; border:none" readonly/>
// 						  <button class="btn '.$buttonHide.' " type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#whseModal" data-backdrop="false">
// 							<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue " ></i>
// 						  </button>
// 						<input type="hidden" class="form-control matrix-cell whsename"   style="outline: none; border:none" />
// 						</div>
// 					  </td>
// 					   <td >
// 					   <div class="'.$inputGroup.' ">
// 						<input type="text" class="form-control matrix-cell text-right quantity"  aria-label="" aria-describedby="button-addon2" style="outline: none; border:none" maxlength="20"/>
// 						 <button class="btn '.$buttonHide.' btn-batch d-none" type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#batchModal" data-backdrop="false">
// 							<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue " ></i>
// 						  </button>
// 						   <button class="btn '.$buttonHide.' btn-serial d-none" type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#serialModal" data-backdrop="false">
// 							<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue " ></i>
// 						  </button>
// 						  <button class="btn '.$buttonHide.' btn-disabled d-none"   type="button" data-mdb-ripple-color="dark"  style="background-color: lightgray; "  data-toggle="modal" data-target="#" data-backdrop="false" >
// 							<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:black " ></i>
// 						</button>
// 						</div>
// 					  </td>
// 						<td >
// 						<input type="text" class="form-control matrix-cell text-right price"   aria-label="" aria-describedby="button-addon2" style="outline: none; border:none" maxlength="12" />
						
// 					  </td>
// 						<td >
// 						<input type="text" class="form-control matrix-cell text-right discount"   style="outline: none; border:none" maxlength="8"/>
						
// 					  </td>
// 					   <td >
// 							<div class="'.$inputGroup.' ">
// 								<input type="hidden" class="form-control text-right  taxamount"  style="outline: none; border:none" maxlength="8" readonly/>
// 								<select type="text" class="form-control taxcode"  placeholder=""   readonly >
// 										"'.$taxcode.'"
// 								</select>
// 							</div>
// 					  </td>
					  
// 					   <td >
// 						<input type="text" class="form-control matrix-cell text-right grossprice"   aria-label="" aria-describedby="button-addon2" style="outline: none; border:none" maxlength="12" readonly/>
						
// 					  </td>
// 					   <td >
// 						<input  type="text" class="form-control matrix-cell text-right rowtotal "   style="outline: none; border:none" readonly/>	
// 					  </td>
// 					   <td >
// 						<input  type="text" class="form-control matrix-cell text-right grosstotal "   style="outline: none; border:none" readonly/>	
// 					  </td>
// 					</tr>'
// 					;
			
// 					$ctr += 1;
// 				}
// 				else{
// 					echo '<tr style="background-color: white; "  >
// 						  <td class="rowno text-right" style="background-color: lightgray;color:black;">
// 							<span>'.$ctr.'</span>
// 							<button type="button" class="btn '.$buttonHide.'" data-toggle="dropdown" style="width:1px; padding-left: 0px !important;margin-left: 0px !important">
// 								<i class="fas fa-caret-down" ></i>
// 							</button>
// 							<ul class="dropdown-menu rowfunctions" role="menu" style="background-color: #fdfd96;">
// 								<li class="deleterow" style="font-size:20px; color: black; font-weight:bold">Delete Row</a></li>
// 								<li class="duplicaterow"style="font-size:20px; color: black; font-weight:bold">Duplicate Row</a></li>
// 							  </ul>
// 						  </td>
// 						   <td >
// 							<input type="text" class="form-control matrix-cell gldescription"  style="outline: none; border:none" />
							 
// 						  </td>
// 						  <td >
// 							<div class="'.$inputGroup.' ">
// 							<input type="text" class="form-control matrix-cell glaccount"    style="outline: none; border:none" readonly/>
// 							<input type="hidden" class="form-control baseentry"   style="outline: none; border:none; "  readonly/>
// 							<input type="hidden" class="form-control linenum"   style="outline: none; border:none; "  readonly/>
// 							<input type="hidden" class="form-control visorder"  style="outline: none; border:none; " readonly  />
// 							  <button class="btn '.$buttonHide.' "   type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#glModal" data-backdrop="false">
// 								<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue " ></i>
// 							  </button>
// 							</div>
// 						  </td>
// 						   <td >
// 							<input type="text" class="form-control matrix-cell glname"   aria-label="" aria-describedby="button-addon2" style="outline: none; border:none" maxlength="12" readonly/>
							
// 						  </td>
// 						   <td class="d-none">
// 							<input type="text" class="form-control matrix-cell text-right quantity"  value="1" aria-label="" aria-describedby="button-addon2" style="outline: none; border:none" maxlength="12" value="1"/>
							
// 						  </td>
// 							<td >
// 							<input type="text" class="form-control matrix-cell text-right price"    aria-label="" aria-describedby="button-addon2" style="outline: none; border:none" maxlength="12" />
							
// 						  </td>
// 							<td >
// 							<input type="text" class="form-control matrix-cell text-right discount"  style="outline: none; border:none" maxlength="8"/>
							
// 						  </td>
// 						   <td >
// 								<div class="'.$inputGroup.' ">
// 									<input type="hidden" class="form-control text-right  taxamount"   style="outline: none; border:none" maxlength="8"/>
// 									<select type="text" class="form-control taxcode"  placeholder=""   readonly >
// 												 '.$taxcode.'
// 													</select>
// 								</div>
// 						  </td>
// 						   <td >
// 							<input type="text" class="form-control matrix-cell text-right grossprice"      style="outline: none; border:none" maxlength="12" readonly/>
							
// 						  </td>
// 						   <td >
// 							<input  type="text" class="form-control matrix-cell text-right rowtotal "    style="outline: none; border:none" readonly/>	
// 						  </td>
// 						   <td >
// 							<input  type="text" class="form-control matrix-cell text-right grosstotal "    style="outline: none; border:none" readonly/>	
// 						  </td>
// 						</tr>';
						
// 						$ctr += 1;
// 				}
// 	}
odbc_free_result($qry);
odbc_close($MSSQL_CONN);

?>
