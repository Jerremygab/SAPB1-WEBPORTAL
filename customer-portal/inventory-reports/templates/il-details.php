<?php 
session_start();
include_once('../../config/config.php');
$servicetype = $_GET['servicetype']; 

if ($servicetype == 'I') 
{ ?>
    	<table class="table table-striped table-bordered table-hover" id="tblIL">
																		<thead>
																			<tr class="bg-primary">
																				<th>#</th>
																				<th>Item Code</th>
																				<th>Item Name</th>
																				<th>Brand</th>
																				<th style="min-width:150px;">No. of Stock</th>
																				
																				<th>Body Modal</th>
																				<th >WH</th>
																				<th >HP</th>
																				
																				<th >Drive Type</th>
																				<th >Emission STD</th>
																				
																				<th >Capacity</th>
																				<th>Engine Brand</th>
																				<th >Mast</th>
																				
																			</tr>
																		</thead>
																		<tbody id="ItemSearchTable">
																		
																	
																	
												<?php

																				$itemno = 1;
																				$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT DISTINCT 
																																			T0.ItemCode, 
																																			T0.ItemName, 
																																			T0.OnHand, 
																																			T0.U_BodyModel,
																																			T0.U_WH,
																																			T0.U_HP,
																																			T0.U_DriveType,
																																			T0.U_EmissionSTD,
																																			T0.U_Capacity,
																																			T0.U_EngineBrand,
																																			T0.U_Mast,
																																			
																																			
																																			
																																			
																																			T0.U_Brand
																																			
																																			
																																	FROM OITM T0
																																	LEFT JOIN OITB T1 ON T0.ItmsGrpCod = T1.ItmsGrpCod
																																	LEFT JOIN OUOM T3 ON T0.IUomEntry = T3.UomEntry
																																	LEFT JOIN OUGP T4 ON T4.UgpEntry = T0.UgpEntry
																																	LEFT JOIN ITM1 T5 ON T5.ItemCode = t0.ItemCode
																																	LEFT JOIN OPLN T6 ON T6.listnum = T5.pricelist
																																	LEFT JOIN OCRD T7 ON T7.ListNum = T6.ListNum
																																	
																																	WHERE T0.FrozenFor = 'N' 
																																	
																																 
																																	
																																	
																																	");
																				while (odbc_fetch_row($qry)) 
																				{
																					echo '<tr class="srch">
																								<td>'.$itemno.'</td>
																								<td class="item-1">'.odbc_result($qry, 'ItemCode').'</td>
																								<td class="item-2">'.odbc_result($qry, 'ItemName').'</td>
																								<td class="item-10">'.odbc_result($qry, 'U_Brand').'</td>
																								<td class="item-3">'.number_format(odbc_result($qry, 'OnHand'),0).'</td>
																								
																								<td class="item-4">'.odbc_result($qry, 'U_BodyModel').'</td>
																								<td class="item-5">'.odbc_result($qry, 'U_WH').'</td>
																								<td class="item-6">'.odbc_result($qry, 'U_HP').'</td>
																								<td class="item-7">'.odbc_result($qry, 'U_DriveType').'</td>
																								<td class="item-8">'.odbc_result($qry, 'U_EmissionSTD').'</td>
																								<td class="item-9">'.odbc_result($qry, 'U_Capacity').'</td>
																								<td class="item-11">'.odbc_result($qry, 'U_EngineBrand').'</td>
																								<td class="item-12">'.odbc_result($qry, 'U_Capacity').'</td>
																								
																							  </tr>';
																					$itemno++;	  
																				}
																				odbc_free_result($qry);
																				
												?>
													</tbody>
												</table>

<?php 
} ?>

<script>
	function isNumberKey(evt)
	{
		var charCode = (evt.which) ? evt.which : evt.keyCode;
          if (charCode != 46 && charCode > 31 
            && (charCode < 48 || charCode > 57))
				return false;

			return true;	
	}
</script>
<script>
$('#tblIL').dataTable();
</script>