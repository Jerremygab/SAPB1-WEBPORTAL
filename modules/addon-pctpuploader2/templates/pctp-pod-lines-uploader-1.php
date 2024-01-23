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
			<th style="color: black; white-space: nowrap ">Client Tag</th>
			<th style="color: black; white-space: nowrap ">Client Tag 2</th>
			<th style="color: black; white-space: nowrap ">Trucker Name</th>
			<th style="color: black; white-space: nowrap ">SAP VENDOR CODE</th>
			<th style="color: black; white-space: nowrap ">Truckers Tag_Existing</th>
			<th style="color: black; white-space: nowrap ">Plate number</th>
			<th style="color: black; white-space: nowrap ">Vehicle Type & Capacity	</th>
			<th style="color: black; white-space: nowrap ">Delivery Origin	</th>
			<th style="color: black; white-space: nowrap " >	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Destination	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
			<th style="color: black; white-space: nowrap ">Delivery Status	</th>
			<th style="color: black; white-space: nowrap  ">Delivery Completion Date</th>
			<th style="color: black; white-space: nowrap  ">Delivery Complete Date (PER POD)	</th>
			<th style="color: black; white-space: nowrap  ">No. of drops	</th>

			<th style="color: black; white-space: nowrap  ">Trip Type</th>
			<th style="color: black; white-space: nowrap  ">Remarks</th>
			<th style="color: black; white-space: nowrap  ">Trip Ticket No.</th>
			<th style="color: black; white-space: nowrap  ">Waybill No.</th>
			<th style="color: black; white-space: nowrap  ">Shipment No. / Manifest No.</th>
			<th style="color: black; white-space: nowrap  ">Delivery Receipt No.</th>
			<th style="color: black; white-space: nowrap  ">Series No.</th>
			<th style="color: black; white-space: nowrap  ">OTHER POD DOCUMENT</th>
			<th style="color: black; white-space: nowrap  ">Remarks</th>
			<th style="color: black; white-space: nowrap  ">Received by</th>
			<th style="color: black; white-space: nowrap  ">Client Received Date</th>
			<th style="color: black; white-space: nowrap  ">Initial HC Inteluck Received Date</th>
			<th style="color: black; white-space: nowrap  ">Actual HC Inteluck Received Date (on hand hc)</th>
			<th style="color: black; white-space: nowrap  ">Date returned by POD to Truckers</th>
			<th style="color: black; white-space: nowrap  ">POD in-charge</th>
			<th style="color: black; white-space: nowrap  ">VERIFIED DATE Hard Copy GOOD</th>
			<th style="color: black; white-space: nowrap  ">POD status (detail)</th>
			<th style="color: black; white-space: nowrap  ">PTF (POD Transmittal Form) No.</th>
			<th style="color: black; white-space: nowrap  ">Date forwarded to BT</th>
			<th style="color: black; white-space: nowrap  ">BILLING STATUS</th>
			<th style="color: black; white-space: nowrap  ">SERVICE TYPE</th>
			<th style="color: black; white-space: nowrap  ">SI No.</th>
			<th style="color: black; white-space: nowrap  ">Billing team in charge</th>
			<th style="color: black; white-space: nowrap  ">BT REMARKS</th>
			<th style="color: black; white-space: nowrap  ">SOB NUMBER</th>
			<th style="color: black; white-space: nowrap  ">Outlet No. (Criteria for GetColaRates)</th>
			<th style="color: black; white-space: nowrap  ">Sales Invoice No/ Delivery Receipt No.</th>
			<th style="color: black; white-space: nowrap  ">CBM (Cubic meter) - Based on SI/DR</th>
			<th style="color: black; white-space: nowrap  ">Delivery Mode - Always ""LAND TRIP""</th>
			<th style="color: black; white-space: nowrap  ">Source Whse- Based on DTT stamp</th>
			<th style="color: black; white-space: nowrap  ">Destination (Client's Customer)</th>
			<th style="color: black; white-space: nowrap  ">Total Invoice Amount</th>
			<th style="color: black; white-space: nowrap  ">SO No - listed on Delivery Receipt</th>
			<th style="color: black; white-space: nowrap  ">Name of Customer</th>
			<th style="color: black; white-space: nowrap  ">Category - listed on Delivery Receipt</th>
			<th style="color: black; white-space: nowrap  ">Forward Load - total the quantity listed on HTT</th>
			<th style="color: black; white-space: nowrap  ">Back Load - total the quantity listed on HTT</th>
			<th style="color: black; white-space: nowrap  ">ID Number</th>
			<th style="color: black; white-space: nowrap  ">TYPE OF ACCESSORIAL</th>
			<th style="color: black; white-space: nowrap  ">STATUS</th>
			<th style="color: black; white-space: nowrap  ">TIME IN (Empty Demurrage)</th>
			<th style="color: black; white-space: nowrap  ">TIME OUT (Empty Demurrage)</th>
			<th style="color: black; white-space: nowrap  ">VERIFIED EMPTY DEMURRAGE</th>
			<th style="color: black; white-space: nowrap  ">TIME IN (Loaded Demurrage)</th>
			<th style="color: black; white-space: nowrap  ">TIME OUT (Loaded Demurrage)</th>
			<th style="color: black; white-space: nowrap  ">VERIFIED LOADED DEMURRAGE</th>
			<th style="color: black; white-space: nowrap  ">Remarks</th>
			<th style="color: black; white-space: nowrap  ">TIME IN (Advance loading)</th>
			<th style="color: black; white-space: nowrap  ">DAY OF THE WEEK</th>
			<th style="color: black; white-space: nowrap  ">TIME IN</th>
			<th style="color: black; white-space: nowrap  ">TIME OUT</th>
			<th style="color: black; white-space: nowrap  ">TOTAL NO. EXCEED (Overtime)</th>

			<th style="color: black; white-space: nowrap  ">ODO IN</th>
			<th style="color: black; white-space: nowrap  ">ODO OUT</th>
			<th style="color: black; white-space: nowrap  ">TOTAL USAGE</th>
			<th style="color: black; white-space: nowrap  ">NAME OF DRIVER</th>
			<th style="color: black; white-space: nowrap  ">ISSUES ENCOUNTERED</th>
			<th style="color: black; white-space: nowrap  ">ACTION TAKEN/PLAN</th>
			<th style="color: black; white-space: nowrap  ">STATUS</th>
			<th style="color: black; white-space: nowrap  ">Warehouse Arrival (date hh:mm) (J&T)</th>
			<th style="color: black; white-space: nowrap  ">Start Loading (date hh:mm) (J&T)</th>
			<th style="color: black; white-space: nowrap  ">End Loading (date hh:mm)</th>
			<th style="color: black; white-space: nowrap  ">Time out on  Pick-Up Location (Departure time on DTR)</th>
			<th style="color: black; white-space: nowrap  ">Waiting Time (Loading)</th>
			<th style="color: black; white-space: nowrap  ">Warehouse Arrival (date hh:mm)</th>
			<th style="color: black; white-space: nowrap  ">Start Unloading (date hh:mm)</th>
			<th style="color: black; white-space: nowrap  ">End Unloading (date hh:mm)</th>
			<th style="color: black; white-space: nowrap  ">Time Out on Destination (Delivery Complete Time on DTR)</th>
			<th style="color: black; white-space: nowrap  ">Waiting Time (UnLoading)</th>
			<th style="color: black; white-space: nowrap  ">Total Waiting Time</th>
			<th style="color: black; white-space: nowrap  ">Charge to Client (Demurrage)</th>
			<th style="color: black; white-space: nowrap  ">Additional Pick-up</th>
			<th style="color: black; white-space: nowrap  ">Re-Route</th>
			<th style="color: black; white-space: nowrap  ">CLIENT SUBMISSION STATUS</th>
			<th style="color: black; white-space: nowrap  ">Client Submission Overdue Days</th>
			<th style="color: black; white-space: nowrap  ">C - Penalty Caculation</th>

			<th style="color: black; white-space: nowrap  ">POD STATUS for Payment processing</th>
			<th style="color: black; white-space: nowrap  ">POD SUBMIT DEADLINE</th>
			<th style="color: black; white-space: nowrap  ">OVERDUE DAYS (-)</th>
			<th style="color: black; white-space: nowrap  ">I - Pennalty Caculation (-)</th>
			<th style="color: black; white-space: nowrap  ">Waived days (Late POD response)</th>
			<th style="color: black; white-space: nowrap  ">Holiday or Weekend</th>
			<th style="color: black; white-space: nowrap  ">Lost - Pennalty Caculation</th>
			<th style="color: black; white-space: nowrap  ">TOTAL SUBMISSION PENALTIES</th>
			<th style="color: black; white-space: nowrap  ">WAIVED? IF Y, Add here reference. If N, Add here BSD approver</th>
			<th style="color: black; white-space: nowrap  ">% PENALTY CHARGED</th>
			<th style="color: black; white-space: nowrap  ">Approved by:</th>
			<th style="color: black; white-space: nowrap  ">TOTAL PENALTY WAIVED</th>
			<th style="color: black; white-space: nowrap  ">GROSS Client Rates</th>
			<th style="color: black; white-space: nowrap  ">GROSS Client rates (CONSIDERING NON VAT RATE - IF FORMULA)</th>
			<th style="color: black; white-space: nowrap  ">Rate Basis</th>
			<th style="color: black; white-space: nowrap  ">TAX TYPE (VAT/NON-VAT)</th>
			<th style="color: black; white-space: nowrap  ">GROSS Trucker rates</th>
			<th style="color: black; white-space: nowrap  ">GROSS Trucker rates (CONSIDERING NON VAT RATE - IF FORMULA)</th>

			<th style="color: black; white-space: nowrap  ">Rate Basis</th>
			<th style="color: black; white-space: nowrap  ">TAX TYPE (VAT/NON-VAT)</th>
			<th style="color: black; white-space: nowrap  ">Demurrage (Client)</th>
			<th style="color: black; white-space: nowrap  ">Addtl Drop (Client)</th>
			<th style="color: black; white-space: nowrap  ">Boom Truck (Client)</th>
			<th style="color: black; white-space: nowrap  ">Manpower (Client)</th>
			<th style="color: black; white-space: nowrap  ">Backload (Client)</th>
			<th style="color: black; white-space: nowrap  ">Total Additional Charges (Client)</th>
			<th style="color: black; white-space: nowrap  ">Demurrage - CONSIDERING NON VAT RATE</th>
			<th style="color: black; white-space: nowrap  ">Additional Charges CONSIDERING NON VAT RATE</th>
			<th style="color: black; white-space: nowrap  ">Demurrage (Trucker)</th>
			<th style="color: black; white-space: nowrap  ">Addtl Drop (Trucker)</th>
			<th style="color: black; white-space: nowrap  ">Boom Truck (Trucker)</th>

			<th style="color: black; white-space: nowrap  ">Manpower (Trucker)</th>
			<th style="color: black; white-space: nowrap  ">Backload (Trucker)</th>
			<th style="color: black; white-space: nowrap  ">Total Additional Charges (Trucker)</th>
			<th style="color: black; white-space: nowrap  ">Demurrage - CONSIDERING NON VAT RATE</th>
			<th style="color: black; white-space: nowrap  ">Additional Charges CONSIDERING NON VAT RATE</th>
			<th style="color: black; white-space: nowrap  ">TOTAL INITIAL Client Rates</th>
			<th style="color: black; white-space: nowrap  ">TOTAL Initial Truckers Rates</th>
			<th style="color: black; white-space: nowrap  ">TOTAL GROSS PROFIT</th>
			<th style="color: black; white-space: nowrap  ">Actual Billed amount (Per Service invoice) MAIN RATE</th>
			<th style="color: black; white-space: nowrap  ">Rate Adjustments(Other than col DV/DW)</th>
			<th style="color: black; white-space: nowrap  ">Actual Demurrage</th>
			<th style="color: black; white-space: nowrap  ">Actual additional charges (Backloads, drops)</th>
			<th style="color: black; white-space: nowrap  ">Total Receivable from Clients, per SI recon with BR</th>
			<th style="color: black; white-space: nowrap  ">CWT 2307</th>
			<th style="color: black; white-space: nowrap  ">Collected amount</th>
			<th style="color: black; white-space: nowrap  ">Actual rates charged by trucker</th>
			<th style="color: black; white-space: nowrap  ">Rate Adjustments</th>
			<th style="color: black; white-space: nowrap  ">Actual Approved Demurrage</th>
			<th style="color: black; white-space: nowrap  ">Actual additional charges (Backloads, drops)</th>
			<th style="color: black; white-space: nowrap  ">Boom Truck</th>
			<th style="color: black; white-space: nowrap  ">Other Charges (Charged to inteluck as Company expenses)</th>
			<th style="color: black; white-space: nowrap  ">Total Penalty</th>
			<th style="color: black; white-space: nowrap  ">Total Payable to Truckers</th>
			<th style="color: black; white-space: nowrap  ">EWT 2307</th>
			<th style="color: black; white-space: nowrap  ">TOTAL PAYABLE (RECEIVABLE from Trucker)</th>
			<th style="color: black; white-space: nowrap  ">Actual Payment Date</th>
			<th style="color: black; white-space: nowrap  ">Payment Reference</th>
			<th style="color: black; white-space: nowrap  ">OR reference number</th>
			<th style="color: black; white-space: nowrap  ">Payment Voucher Number</th>
			<th style="color: black; white-space: nowrap  ">Payment Status</th>
		</tr>
	</thead>
</table>

