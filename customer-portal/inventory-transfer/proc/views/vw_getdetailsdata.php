<?php
session_start();
include_once('../../../../config/config.php');

$docNum = $_GET['docNum'];
$docType = $_GET['docType'];
$objType = $_GET['objType'];

$table = '';
$table2 = '';
if($objType == 67){
	$table = 'OWTR';
	$table2 = 'WTR1';
}
else if($objType == 1250000001){
	$table = 'OWTQ';
	$table2 = 'WTQ1';
}
else{
	$table = '';
	$table2 = '';
}

$taxcode2 = "";
$rate = 0;

$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT Code, Name, Rate FROM OVTG WHERE Inactive = 'N' AND Category='I'");

while (odbc_fetch_row($qry)) 
{
    $taxcode2 .= '<option val' . odbc_result($qry, "Code") . ' val-rate="' . number_format(odbc_result($qry, "Rate"), 4, '.', '.') . '" value="' . odbc_result($qry, "Code") . '">' . odbc_result($qry, "Code") .'</option>';
	$rate = number_format(odbc_result($qry, "Rate"), 4, '.', '.');
}

$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
	SELECT 
		T0.DocEntry,
		T0.DocNum,
		T0.DocStatus,
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
		T1.UnitMsr,
	
		
		T2.UomCode,
		T3.AcctName,
		
		T1.FromWhsCod,
		T1.WhsCode,
		T4.WhsName AS 'FromWhseName',
		T5.WhsName AS 'ToWhseName'
		
	FROM " . $table . " T0 
	INNER JOIN " . $table2 . " T1 ON T0.DocEntry = T1.DocEntry
	LEFT JOIN OUOM T2 ON T1.UoMEntry = T2.UoMEntry
	LEFT JOIN OACT T3 ON T1.AcctCode = T3.AcctCode
	LEFT JOIN OWHS T4 ON T1.FromWhsCod = T4.WhsCode
	LEFT JOIN OWHS T5 ON T1.WhsCode = T5.WhsCode

			WHERE T0.DocNum = $docNum
			ORDER BY T1.LineNum ASC");
$ctr = 1;

while (odbc_fetch_row($qry)) 
{
	
	$DocEntry = odbc_result($qry, "DocEntry");
	$DocStatus = odbc_result($qry, "DocStatus");
	$ItemCode = odbc_result($qry, "ItemCode");
	$LineNum = odbc_result($qry, "LineNum");
	$VisOrder = odbc_result($qry, "VisOrder");
    $Dscription = odbc_result($qry, "Dscription");
	$AcctCode = odbc_result($qry, "AcctCode");
	$AcctName = odbc_result($qry, "AcctName");
	$Quantity = number_format(odbc_result($qry, "Quantity"),2);
	$PriceAfVat = number_format(odbc_result($qry, "PriceAfVat"),2);
	
	$Price = number_format(odbc_result($qry, "Price"),2);
	$DiscSum = number_format(odbc_result($qry, "DiscSum"),2);
	$DiscSum2 = number_format(odbc_result($qry, "DiscSum2"),2);
	$DiscPrcnt = number_format(odbc_result($qry, "DiscPrcnt"),2);
	
	$RowTotal = number_format(odbc_result($qry, "RowTotal"),2);
	$GrossTotal = number_format(odbc_result($qry, "GrossTotal"),2);
	$TaxAmount = number_format(odbc_result($qry, "TaxAmount"),2);
	$RowTotal2 = number_format(odbc_result($qry, "RowTotal2"),2);
	$GrossTotal2 = number_format(odbc_result($qry, "GrossTotal2"),2);
	$TaxAmount2 = number_format(odbc_result($qry, "TaxAmount2"),2);
	
	$VatGroup = odbc_result($qry, "VatGroup"); 
	$UoMEntry = odbc_result($qry, "UoMEntry"); 
	$UomCode = odbc_result($qry, "UomCode"); 
	$UnitMsr = odbc_result($qry, "UnitMsr"); 
	
	$FromWhsCod = odbc_result($qry, "FromWhsCod"); 
	$WhsCode = odbc_result($qry, "WhsCode"); 
	$FromWhseName = odbc_result($qry, "FromWhseName"); 
	$ToWhseName = odbc_result($qry, "ToWhseName"); 
	
	$taxcode = str_replace('val' . $VatGroup, 'selected', $taxcode2);
	
	$readonly = '';
	$inputGroup = 'input-group';
	$buttonHide = '';
	$disabled = '';
	if($DocStatus != 'O'){
		$readonly = 'readonly';
		$inputGroup = '';
		$buttonHide = 'd-none';
		$disabled = 'disabled';
	}
				if($docType == 'I'){
   
					echo 
					'<tr style="background-color: white; "  >
					  <td class="rowno text-right" style="background-color: lightgray;color:black;">
						<span>'.$ctr.'</span>
						<button type="button" class="btn d-none" data-toggle="dropdown" style="width:1px; padding-left: 0px !important;margin-left: 0px !important">
							<i class="fas fa-caret-down" ></i>
						</button>
						<ul class="dropdown-menu rowfunctions" role="menu" style="background-color: #fdfd96;">
							<li class="deleterow" style="font-size:20px; color: black; font-weight:bold">Delete Row</a></li>
							<li class="duplicaterow"style="font-size:20px; color: black; font-weight:bold">Duplicate Row</a></li>
						  </ul>
					  </td>
					  <td >
						<div class="" >
						<input type="text" class="form-control itemcode"  style="outline: none; border:none; " readonly value="'.$ItemCode.'" />
						<input type="hidden" class="form-control baseentry"   style="outline: none; border:none; " value="'.$DocEntry.'" readonly/>
						<input type="hidden" class="form-control linenum"   style="outline: none; border:none; " value="'.$LineNum.'" readonly/>
						<input type="hidden" class="form-control visorder"  style="outline: none; border:none; " readonly value="'.$VisOrder.'" />
						 
						<input type="hidden" class="form-control matrix-cell uomgroup"   style="outline: none; border:none" readonly/>
						</div>
					  </td>
					  <td >
						<div class="">
						<input type="text" class="form-control matrix-cell itemname"  style="outline: none; border:none" readonly value="'.$Dscription.'" / >
						 
						<input type="hidden" class="form-control matrix-cell uomgroup"   style="outline: none; border:none" readonly value="'.$UomCode.'" />
						</div>
					  </td>
					  <td >
						<div class=" ">
						<input type="text" class="form-control matrix-cell fromwhsename"   style="outline: none; border:none" readonly value="'.$FromWhseName.'"/>
						  
						<input type="hidden" class="form-control matrix-cell fromwhsecode"  style="outline: none; border:none" readonly value="'.$FromWhsCod.'"/>
						</div>
					  </td>
						<td >
						<div class=" ">
						<input type="text" class="form-control matrix-cell towhsename"   style="outline: none; border:none" readonly value="'.$ToWhseName.'"/>
						  
						<input type="hidden" class="form-control matrix-cell towhsecode"    style="outline: none; border:none" readonly value="'.$WhsCode.'"/>
						</div>
					  </td>
					  <td >
						<div class=" ">
						<input type="text" class="form-control matrix-cell unitmsr"  style="outline: none; border:none" readonly value="'.$UnitMsr.'" />
						 
						<input type="hidden" class="form-control matrix-cell uomentry"  style="outline: none; border:none" value="'.$UoMEntry.'" />
						</div>
					  </td>
					   <td >
						<input type="text" class="form-control matrix-cell text-right quantity" value="'.$Quantity.'" aria-label="" aria-describedby="button-addon2" style="outline: none; border:none" maxlength="12" readonly/>
						
					  </td>
						<td >
						<input type="text" class="form-control matrix-cell text-right price" value="'.$Price.'"  aria-label="" aria-describedby="button-addon2" style="outline: none; border:none" maxlength="12" readonly/>
						
					  </td>
						<td >
						<input type="text" class="form-control matrix-cell text-right discount"  value="'.$DiscPrcnt.'" style="outline: none; border:none" maxlength="8" readonly/>
						
					  </td>
					   <td class="d-none">
							<div class="input-group ">
								<input type="hidden" class="form-control text-right  taxamount" value="'.$TaxAmount.'" style="outline: none; border:none" maxlength="8" readonly/>
								<select type="text" class="form-control taxcode"  placeholder=""   readonly >
										"'.$taxcode.'"
								</select>
							</div>
					  </td>
					  
					   <td class="d-none">
						<input type="text" class="form-control matrix-cell text-right grossprice"  value="'.$PriceAfVat.'" aria-label="" aria-describedby="button-addon2" style="outline: none; border:none" maxlength="12" readonly/>
						
					  </td>
					   <td >
						<input  type="text" class="form-control matrix-cell text-right rowtotal "  value="'.$RowTotal.'" style="outline: none; border:none" readonly/>	
					  </td>
					   <td class="d-none">
						<input  type="text" class="form-control matrix-cell text-right grosstotal "  value="'.$GrossTotal.'" style="outline: none; border:none" readonly/>	
					  </td>
					</tr>'
					;
			
					$ctr += 1;
				}
				
}
if($DocStatus == 'X'){
	if($docType == 'I'){
			echo 
					'<tr style="background-color: white; "  >
					  <td class="rowno text-right" style="background-color: lightgray;color:black;">
						<span>'.$ctr.'</span>
						<button type="button" class="btn d-none btnrowfunctions" data-toggle="dropdown" style="width:1px; padding-left: 0px !important;margin-left: 0px !important">
							<i class="fas fa-caret-down" ></i>
						</button>
						<ul class="dropdown-menu rowfunctions" role="menu" style="background-color: #fdfd96;">
							<li class="deleterow" style="font-size:20px; color: black; font-weight:bold">Delete Row</a></li>
							<li class="duplicaterow"style="font-size:20px; color: black; font-weight:bold">Duplicate Row</a></li>
						  </ul>
					  </td>
					  <td >
						<div class="input-group " >
						<input type="text" class="form-control itemcode"  style="outline: none; border:none; " readonly  />
						  <button class="btn "  type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#itemModal" data-backdrop="false" >
							<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue " ></i>
						  </button>
						<input type="hidden" class="form-control matrix-cell uomgroup"   style="outline: none; border:none" readonly/>
						</div>
					  </td>
					  <td >
						<div class="input-group ">
						<input type="text" class="form-control matrix-cell itemname"  style="outline: none; border:none" readonly  / >
						  <button class="btn "   type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#itemModal" data-backdrop="false">
							<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue " ></i>
						  </button>
						<input type="hidden" class="form-control matrix-cell uomgroup"   style="outline: none; border:none" readonly  />
						</div>
					  </td>
					  <td >
						<div class="input-group ">
						<input type="text" class="form-control matrix-cell fromwhsename"   style="outline: none; border:none" readonly value="'.$FromWhseName.'"/>
						  <button class="btn "   type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#fromWhseModalRow" data-backdrop="false">
							<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue " ></i>
						  </button>
						<input type="hidden" class="form-control matrix-cell fromwhsecode"  style="outline: none; border:none" readonly value="'.$FromWhsCod.'"/>
						</div>
					  </td>
						<td >
						<div class="input-group ">
						<input type="text" class="form-control matrix-cell towhsename"   style="outline: none; border:none" readonly value="'.$ToWhseName.'"/>
						  <button class="btn "   type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#toWhseModalRow" data-backdrop="false">
							<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue " ></i>
						  </button>
						<input type="hidden" class="form-control matrix-cell towhsecode"    style="outline: none; border:none" readonly value="'.$WhsCode.'"/>
						</div>
					  </td>
					  <td >
						<div class="input-group ">
						<input type="text" class="form-control matrix-cell unitmsr"  style="outline: none; border:none" readonly  />
						  <button class="btn " type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#uomModal" data-backdrop="false">
							<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue " ></i>
						  </button>
						<input type="hidden" class="form-control matrix-cell uomentry"  style="outline: none; border:none"  />
						</div>
					  </td>
					   <td >
						<input type="text" class="form-control matrix-cell text-right quantity"  aria-label="" aria-describedby="button-addon2" style="outline: none; border:none" maxlength="12"/>
						
					  </td>
						<td >
						<input type="text" class="form-control matrix-cell text-right price"   aria-label="" aria-describedby="button-addon2" style="outline: none; border:none" maxlength="12" readonly/>
						
					  </td>
						<td >
						<input type="text" class="form-control matrix-cell text-right discount"   style="outline: none; border:none" maxlength="8"/>
						
					  </td>
					   <td class="d-none">
							<div class="input-group ">
								<input type="hidden" class="form-control text-right  taxamount"  style="outline: none; border:none" maxlength="8"/>
								<select type="text" class="form-control taxcode"  placeholder=""   readonly >
										"'.$taxcode.'"
								</select>
							</div>
					  </td>
					  
					   <td >
						<input type="text" class="form-control matrix-cell text-right grossprice"   aria-label="" aria-describedby="button-addon2" style="outline: none; border:none" maxlength="12" readonly/>
						
					  </td>
					   <td >
						<input  type="text" class="form-control matrix-cell text-right rowtotal "  style="outline: none; border:none" readonly/>	
					  </td>
					   <td >
						<input  type="text" class="form-control matrix-cell text-right grosstotal "   style="outline: none; border:none" readonly/>	
					  </td>
					</tr>'
					;
		}
		
	}

odbc_free_result($qry);
odbc_close($MSSQL_CONN);

?>
