<?php
session_start();
include_once('../../../config/config.php');
$serviceType = $_GET['serviceType'];
$text2 = $_GET['text2'];


if ($serviceType == 'I'){

?>

 <tr style="background-color: white; "  >
	  <td class="rowno text-right" style="background-color: lightgray;color:black;">
		
	  </td>
      <td >
		<div class="input-group " >
		<input type="text" class="form-control itemcode"  aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none; " />
		  <button class="btn "  type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#itemModal" data-backdrop="false" >
			<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue " ></i>
		  </button>
		<input type="hidden" class="form-control matrix-cell uomgroup"  aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none" />
		</div>
	  </td>
	  <td >
		<div class="input-group ">
		<input type="text" class="form-control matrix-cell itemname"  aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none" />
		  <button class="btn "   type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#itemModal" data-backdrop="false">
			<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue " ></i>
		  </button>
		<input type="hidden" class="form-control matrix-cell uomgroup"  aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none" />
		</div>
	  </td>
	  <td >
		<div class="input-group ">
		<input type="text" class="form-control matrix-cell unitmsr"  aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none" />
		  <button class="btn " type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#uomModal" data-backdrop="false">
			<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue " ></i>
		  </button>
		<input type="hidden" class="form-control matrix-cell uomentry"  aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none"/>
		</div>
	  </td>
	   <td >
		<input type="text" class="form-control matrix-cell text-right quantity"  aria-label="" aria-describedby="button-addon2" style="outline: none; border:none" maxlength="12"/>
		
	  </td>
	    <td >
		<input type="text" class="form-control matrix-cell text-right price"   aria-label="" aria-describedby="button-addon2" style="outline: none; border:none" maxlength="12" />
		
	  </td>
	    <td >
		<input type="text" class="form-control matrix-cell text-right discount"   style="outline: none; border:none" maxlength="8"/>
		
	  </td>
	   <td >
			<div class="input-group ">
				<input type="text" class="form-control text-right d-none taxamount"   style="outline: none; border:none" maxlength="8"/>
				<select type="text" class="form-control taxcode"  placeholder=""   readonly >
							<?php
												$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT Code,Name,Rate FROM OVTG WHERE Inactive = 'N' AND Category='O' ORDER BY CASE WHEN Code = 'OVAT-N' THEN '1' ELSE Code END ASC");
													while (odbc_fetch_row($qry)) 
													{
														//echo odbc_result($qry, 'NextNumber');
														echo '<option  class="taxoptions" val-rate="' . number_format(odbc_result($qry, "Rate"), 2, '.', '.') . '" value="' . odbc_result($qry, "Code") . '"  >' . odbc_result($qry, "Code") . '</option>';
													}
													
													odbc_free_result($qry);
											?>
								</select>
			</div>
	  </td>
	  
	   <td >
		<input type="text" class="form-control matrix-cell text-right grossprice"   aria-label="" aria-describedby="button-addon2" style="outline: none; border:none" maxlength="12" />
		
	  </td>
	   <td >
		<input  type="text" class="form-control matrix-cell text-right rowtotal " aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none" />	
	  </td>
	   <td >
		<input  type="text" class="form-control matrix-cell text-right grosstotal " aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none" />	
	  </td>

      
    </tr>
<?php
}

else{
?>

   <tr style="background-color: white; "  >
	  <td class="rowno text-right" style="background-color: lightgray;color:black; ">
		1
	  </td>
	   <td >
		<input type="text" class="form-control matrix-cell gldescription"  aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none" />
		 
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
	   <td class="d-none">
		<input type="text" class="form-control matrix-cell text-right quantity"  aria-label="" aria-describedby="button-addon2" style="outline: none; border:none" maxlength="12" value="1"/>
		
	  </td>
	    <td >
		<input type="text" class="form-control matrix-cell text-right price"   aria-label="" aria-describedby="button-addon2" style="outline: none; border:none" maxlength="12" />
		
	  </td>
	    <td >
		<input type="text" class="form-control matrix-cell text-right discount"   style="outline: none; border:none" maxlength="8"/>
		
	  </td>
	   <td >
			<div class="input-group ">
				<input type="text" class="form-control text-right d-none taxamount"   style="outline: none; border:none" maxlength="8"/>
				<select type="text" class="form-control taxcode"  placeholder=""   readonly >
							<?php
												$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT Code,Name,Rate FROM OVTG WHERE Inactive = 'N' AND Category='O' ORDER BY CASE WHEN Code = 'OVAT-N' THEN '1' ELSE Code END ASC");
													while (odbc_fetch_row($qry)) 
													{
														//echo odbc_result($qry, 'NextNumber');
														echo '<option  class="taxoptions" val-rate="' . number_format(odbc_result($qry, "Rate"), 2, '.', '.') . '" value="' . odbc_result($qry, "Code") . '"  >' . odbc_result($qry, "Code") . '</option>';
													}
													
													odbc_free_result($qry);
											?>
								</select>
			</div>
	  </td>
	   <td >
		<input type="text" class="form-control matrix-cell text-right grossprice"   aria-label="" aria-describedby="button-addon2" style="outline: none; border:none" maxlength="12" readonly/>
		
	  </td>
	   <td >
		<input  type="text" class="form-control matrix-cell text-right rowtotal " aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none" readonly/>	
	  </td>
	   <td >
		<input  type="text" class="form-control matrix-cell text-right grosstotal " aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none" readonly/>	
	  </td>

      
    </tr>

	<?php
}
?>