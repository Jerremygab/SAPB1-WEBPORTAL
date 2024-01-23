<?php
session_start();
include_once('../../../config/config.php');
	

?>

<table id="tblMain" class="table table-striped table-bordered table-hover table-lg detailsTable"   style="background-color: white; width= 100%">
	<thead style="border-bottom: 0 !important">
		<tr>
			<th style="color: black; white-space: nowrap ">#</th>
			<th style="color: black; white-space: nowrap ">Message</th>
			<th style="color: black; white-space: nowrap ">Upload Status</th>
			<th style="color: black; white-space: nowrap ">Booking Date</th>
			<th style="color: black; white-space: nowrap ">Booking Number &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
			<th style="color: black; white-space: nowrap ">Client Name</th>
			<th style="color: black; white-space: nowrap ">SAP CLIENT CODE</th>
			<th style="color: black; white-space: nowrap ">Trucker Name</th>
			<th style="color: black; white-space: nowrap ">SAP VENDOR CODE</th>
			<th style="color: black; white-space: nowrap ">Plate number</th>
			<th style="color: black; white-space: nowrap ">Vehicle Type & Capacity	</th>
			<th style="color: black; white-space: nowrap ">Delivery Origin	</th>
			<th style="color: black; white-space: nowrap " >	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Destination	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
			<th style="color: black; white-space: nowrap ">Delivery Status	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
			<th style="color: black; white-space: nowrap  ">Delivery Completion Date</th>
			<th style="color: black; white-space: nowrap  ">No. of drops	</th>
			<th style="color: black; white-space: nowrap  ">Trip Type &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
			<th style="color: black; white-space: nowrap  ">Remarks</th>
			<th style="color: black; white-space: nowrap  ">Document Number</th>
		</tr>
	</thead>
</table>

