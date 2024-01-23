<?php 
	if (isset($_GET['rowNo'])){
?>
	<tr style=" margin: 0px;">
		<td class="rowNo" style="margin: 0; padding: 7px; height:0px;  width: 60px;">
			<span><?php echo $_GET['rowNo'] + 1;?></span>
			<button type="button" class="btn d-none btnRowRefDocTo" data-toggle="dropdown" style="width:15px; padding: 0px !important; margin: 0px !important">
			<i class="fas fa-caret-down" ></i>
			</button>

			<ul class="dropdown-menu rowfunctions" role="menu" style="background-color: #fdfd96;">
				<li class="deleteRefDocTorow" style="font-size:20px; color: black; font-weight:bold">Delete Row</a></li>
			</ul>
		</td>
			
		<td style="padding:1px; height: 1px;">
			<div class="input-group" style="margin: 0; height:0; width:100%;">
				<input type="text" class="form-control txtTransactType refDocToInput"  aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none;" readonly/>
			  	<button class="btn btnTransactType"  type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#transactTypeModal" data-backdrop="false" >
					<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue " ></i>
			  	</button>
			</div>
		</td>
	  	<td style="padding:1px; height: 1px;">
			<div class="input-group" style="margin: 0; height:0;">
				<input type="text" class="form-control txtRefDocNum refDocToInput"  aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none;" disabled="disabled" readonly/>
			  	<button class="btn btnRefDocNum"  type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#docNumModal" data-backdrop="false" disabled="disabled">
					<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue " ></i>
			  	</button>
			</div>
		</td>
		<td style="padding:1px; height: 1px;">
			<div class="input-group" style="margin: 0; height:0; width:100%;">
				<input type="text" class="form-control txtRefDocExtDocNum refDocToInput"  aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none;" disabled="disabled"/>
			</div>
		</td>
		<td style="padding:1px; height: 1px;">
			<div class="col-sm p-0 input-group" style="margin: 0; height:0; width:100%;">
				<input type="text" class="form-control txtRefDocDate refDocToInput col-auto dateType"  aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none;" disabled="disabled"/>
				<input type="date" id2="txtRefDocDate" class="form-control col-2 btnRefDocDate btnDateType d-none"  value="" min="01-01-2018" max="12-31-2050" style="color:transparent !important;">
			</div>
		</td>
		<td style="padding:1px; height: 1px;">
			<div class="input-group" style="margin: 0; height:0; width:100%;">
				<input type="text" class="form-control txtRefDocRemarks refDocToInput"  aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none;" disabled="disabled"/>
			</div>
		</td>
	</tr>

<?php
	} else {
?>

<table class="table table-striped table-bordered" id="tbldocRefTo" style="width:100%; border-collapse: collapse;">
	<thead>
		<tr>
			<th style="  position: sticky;top: 0; " >#</th>
			<th  style="  position: sticky;top: 0; width: 200px;">Transact. Type</th>
			<th  style="  position: sticky;top: 0; width: 100px;">Doc. Number</th>
			<th  style="  position: sticky;top: 0; width: 1%; white-space: nowrap;">Ext. Doc. Number</th>
			<th  style="  position: sticky;top: 0;  width: 200px;">Date</th>
			<th  style="  position: sticky;top: 0; width: 150px;">Remarks</th>
		</tr>
	</thead>
	<tbody id="tbodyDocRefTo">
		<tr style=" margin: 0px;">
			<td class="rowNo" style="margin: 0; padding: 7px; height:0px;  width: 60px;">
				<span>1</span>
				<button type="button" class="btn d-none btnRowRefDocTo" data-toggle="dropdown" style="width:15px; padding: 0px !important; margin: 0px !important">
				<i class="fas fa-caret-down" ></i>
				</button>

				<ul class="dropdown-menu rowfunctions" role="menu" style="background-color: #fdfd96;">
					<li class="deleteRefDocTorow" style="font-size:20px; color: black; font-weight:bold">Delete Row</a></li>
				</ul>
			</td>
				
			<td style="padding:1px; height: 1px;">
				<div class="input-group" style="margin: 0; height:0; width:100%;">
					<input type="text" class="form-control txtTransactType refDocToInput"  aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none;" readonly/>
				  	<button class="btn btnTransactType"  type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#transactTypeModal" data-backdrop="false" >
						<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue " ></i>
				  	</button>
				</div>
			</td>
		  	<td style="padding:1px; height: 1px;">
				<div class="input-group" style="margin: 0; height:0;">
					<input type="text" class="form-control txtRefDocNum refDocToInput"  aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none;" disabled="disabled" readonly/>
				  	<button class="btn btnRefDocNum"  type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#docNumModal" data-backdrop="false" disabled="disabled">
						<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue " ></i>
				  	</button>
				</div>
			</td>
			<td style="padding:1px; height: 1px;">
				<div class="input-group" style="margin: 0; height:0; width:100%;">
					<input type="text" class="form-control txtRefDocExtDocNum refDocToInput"  aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none;" disabled="disabled"/>
				</div>
			</td>
			<td style="padding:1px; height: 1px;">
				<div class="col-sm p-0 input-group" style="margin: 0; height:0; width:100%;">
					<input type="text" class="form-control txtRefDocDate refDocToInput col-auto dateType"  aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none;" disabled="disabled"/>
					<input type="date" id2="txtRefDocDate" class="form-control col-2 btnRefDocDate btnDateType d-none"  value="" min="01-01-2018" max="12-31-2050" style="color:transparent !important;">
				</div>
			</td>
			<td style="padding:1px; height: 1px;">
				<div class="input-group" style="margin: 0; height:0; width:100%;">
					<input type="text" class="form-control txtRefDocRemarks refDocToInput"  aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none;" disabled="disabled"/>
				</div>
			</td>
		</tr>
	</tbody>
</table>

<?php	
	}
?>