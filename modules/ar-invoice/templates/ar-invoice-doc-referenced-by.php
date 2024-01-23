<?php 
	if (isset($_GET['rowNo'])){
?>
	<tr style=" margin: 0px;">
		<td class="rowNo" style="margin: 0; padding: 7px; height:0px;  width: 60px;">
			<span><?php echo $_GET['rowNo'] + 1;?></span>
		</td>
			
		<td style="padding:1px; height: 1px;">
			<div class="input-group" style="margin: 0; height:0; width:100%;">
				<input type="text" class="form-control txtTransactType"  aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none;" disabled="disabled"/>
			</div>
		</td>
	  	<td style="padding:1px; height: 1px;">
			<div class="input-group" style="margin: 0; height:0;">
				<input type="text" class="form-control txtRefDoc"  aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none;" disabled="disabled"/>
			</div>
		</td>
		<td style="padding:1px; height: 1px;">
			<div class="input-group" style="margin: 0; height:0; width:100%;">
				<input type="text" class="form-control txtRefType"  aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none;" disabled="disabled"/>
			</div>
		</td>
		<td style="padding:1px; height: 1px;">
			<div class="input-group" style="margin: 0; height:0; width:100%;">
				<input type="text" class="form-control txtRefDocDate"  aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none;" disabled="disabled"/>
			</div>
		</td>
		<td style="padding:1px; height: 1px;">
			<div class="input-group" style="margin: 0; height:0; width:100%;">
				<input type="text" class="form-control txtRefAmount"  aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none;" disabled="disabled"/>
			</div>
		</td>
		<td style="padding:1px; height: 1px;">
			<div class="input-group" style="margin: 0; height:0; width:100%;">
				<input type="text" class="form-control txtRefDocRemarks"  aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none;" disabled="disabled"/>
			</div>
		</td>
	</tr>

<?php
	} else {
?>

<table class="table table-striped table-bordered" id="tbldocRefBy" style="width:100%;  ">
	<thead>
		<tr >
			<th style="  position: sticky;top: 0;" >#</th>
			<th  style="  position: sticky;top: 0;">Transact. Type</th>
			<th  style="  position: sticky;top: 0; width: 1%; white-space: nowrap;">Ref. Document</th>
			<th  style="  position: sticky;top: 0; width: 1%; white-space: nowrap;">Reference Type</th>
			<th  style="  position: sticky;top: 0;">Date</th>
			<th  style="  position: sticky;top: 0; width: 1%; white-space: nowrap;">Ref. Amount</th>
			<th  style="  position: sticky;top: 0;">Remarks</th>
		</tr>
	</thead>
	<tbody id="tbodyDocRefBy">
		<tr style=" margin: 0px;">
			<td class="rowNo" style="margin: 0; padding: 7px; height:0px;  width: 60px;">
				<span>1</span>
			</td>
				
			<td style="padding:1px; height: 1px;">
				<div class="input-group" style="margin: 0; height:0; width:100%;">
					<input type="text" class="form-control txtTransactType"  aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none;" disabled="disabled"/>
				</div>
			</td>
		  	<td style="padding:1px; height: 1px;">
				<div class="input-group" style="margin: 0; height:0;">
					<input type="text" class="form-control txtRefDoc"  aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none;" disabled="disabled"/>
				</div>
			</td>
			<td style="padding:1px; height: 1px;">
				<div class="input-group" style="margin: 0; height:0; width:100%;">
					<input type="text" class="form-control txtRefType"  aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none;" disabled="disabled"/>
				</div>
			</td>
			<td style="padding:1px; height: 1px;">
				<div class="input-group" style="margin: 0; height:0; width:100%;">
					<input type="text" class="form-control txtRefDocDate"  aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none;" disabled="disabled"/>
				</div>
			</td>
			<td style="padding:1px; height: 1px;">
				<div class="input-group" style="margin: 0; height:0; width:100%;">
					<input type="text" class="form-control txtRefAmount"  aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none;" disabled="disabled"/>
				</div>
			</td>
			<td style="padding:1px; height: 1px;">
				<div class="input-group" style="margin: 0; height:0; width:100%;">
					<input type="text" class="form-control txtRefDocRemarks"  aria-label="Recipient's username" aria-describedby="button-addon2" style="outline: none; border:none;" disabled="disabled"/>
				</div>
			</td>
		</tr>
	</tbody>
</table>

<?php	
	}
?>