<?php
session_start();
include_once('../../../config/config.php');
$serviceType = $_GET['serviceType'];

if ($serviceType == 'X'){

}

else{
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
		<div class="input-group ">
		<input type="text" class="form-control matrix-cell glaccount"  aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none" readonly/>
		  <button class="btn "   type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#glModal" data-backdrop="false">
			<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue " ></i>
		  </button>
		</div>
	  </td>
	   <td >
		<input type="text" class="form-control matrix-cell glname"  aria-label="" aria-describedby="button-addon2" style="outline: none; border:none" maxlength="12" readonly/>
		
	  </td>
	  
	    <td >
		<input type="text" class="form-control matrix-cell text-right docremarks"   aria-label="" aria-describedby="button-addon2" style="outline: none; border:none" maxlength="12" />
		
	  </td>
	   <td >
			<div class="input-group ">
				<input type="text" class="form-control matrix-cell text-right quantity d-none"  aria-label="" aria-describedby="button-addon2" style="outline: none; border:none" maxlength="12" value="1"/>
					
				<input type="text" class="form-control matrix-cell text-right discount d-none"   style="outline: none; border:none" maxlength="12" value=0/>

				<input type="text" class="form-control matrix-cell text-right rowtotal d-none"   style="outline: none; border:none" maxlength="12" value=0/>
				<select type="text" class="form-control taxcode"  placeholder=""   readonly >
							<?php
												$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT Code,Name,Rate FROM OVTG WHERE Inactive = 'N' AND Category='I' ORDER BY CASE WHEN Code = 'IVAT-N' THEN '1' ELSE Code END ASC");
													while (odbc_fetch_row($qry)) 
													{
														//echo odbc_result($qry, 'NextNumber');
														echo '<option  class="taxoptions" val-rate="' . number_format(odbc_result($qry, "Rate"), 2, '.', '.') . '" value="' . odbc_result($qry, "Code") . '"  >' . odbc_result($qry, "Code") . '</option>';
													}
													
													odbc_free_result($qry);
											?>
								</select>
			</div>
		<td >
		<input type="text" class="form-control matrix-cell text-right price"   style="outline: none; border:none" maxlength="12"/>
		
	  </td>
	  <!--</td>
	   <td >
		<input type="text" class="form-control matrix-cell text-right taxamount"    maxlength="12" />
		
	  </td>
	  <td >
		<input type="text" class="form-control matrix-cell text-right grossprice"    maxlength="12" readonly/>
		<input type="text" class="form-control matrix-cell text-right grosstotal d-none"    maxlength="12" readonly/>	
	  </td>
	  <td >
		<div class="input-group ">
			<input type="text" class="form-control matrix-cell ocrcode"  aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none" readonly/>
			  <button class="btn "   type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#ocrCodeModalAcctType" data-backdrop="false">
				<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue " ></i>
			  </button>
		</div>
	  </td>
	  <td >
		<div class="input-group ">
			<input type="text" class="form-control matrix-cell ocrcode2"  aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none" readonly/>
			  <button class="btn "   type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#ocrCode2ModalAcctType" data-backdrop="false">
				<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue " ></i>
			  </button>
		</div>
	  </td>
	  <td >
		<div class="input-group ">
			<input type="text" class="form-control matrix-cell ocrcode3"  aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none" readonly/>
			  <button class="btn "   type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#ocrCode3ModalAcctType" data-backdrop="false">
				<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue " ></i>
			  </button>
		</div>
	  </td>-->
      
    </tr>

	<?php
}
?>