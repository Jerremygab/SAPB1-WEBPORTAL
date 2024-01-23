 <div class="modal fade" id="modalVerticalPRICING" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"data-backdrop="false" >
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document" style="width:100%; " data-backdrop="false">
        <!--Content-->
        <div class="modal-content-full-width modal-content" style="height: 1200px; width: 1500px">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
            <h4 class="modal-title w-100" id="myModalLabel" style="color:black">Update Pricing</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->
          <div class="modal-body" >
          	<div class="row">
          		<div class="col-4">
          				<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Booking ID</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control billInputs" id="U_BookingId" placeholder="" readonly>
										</div>
									</div>	
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Booking Date</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control billInputs" id="U_BookingDate" placeholder="" readonly>
										</div>
									</div>	
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >POD Number</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control billInputs" id="U_PODNum" placeholder="" readonly>
										</div>
									</div>
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Client Tag</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control billInputs" id="U_ClientTag" placeholder="" readonly>
										</div>
									</div>
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Client Name</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control billInputs" id="U_CustomerName" placeholder="" readonly>
										</div>
									</div>	
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Client Project</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control billInputs" id="U_ClientProject" placeholder="" readonly>
										</div>
									</div>
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Trucker Tag</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control billInputs" id="U_TruckerTag" placeholder="" readonly>
										</div>
									</div>
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Trucker Name</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control billInputs" id="U_TruckerName" placeholder="" readonly>
										</div>
									</div>	
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Vehicle Type & Capcity</label>
										<div class="col-sm-7" >
											 <select type="text" class="form-control pod podstatusrequired required billing pricing" id="U_VehicleTypeCap" placeholder="" disabled>
											 		<option class="vehicleoptions" value=""  ></option>
									 				<?php
															$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT Code,Name FROM [@VEHICLETYPEANDCAP] ORDER BY Code ASC");
																while (odbc_fetch_row($qry)) 
																{
																	//echo odbc_result($qry, 'NextNumber');
																	echo '<option class="vehicleoptions" value="' . odbc_result($qry, "Code") . '"  >' . odbc_result($qry, "Name") . '</option>';
																}
																
																odbc_free_result($qry);
														?>
											 </select>
										</div>
									</div>
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Delivery Origin</label>
										<div class="col-sm-7" >
											 <textarea type="text" class="form-control billInputs" id="U_DeliveryOrigin" placeholder="" readonly rows="5"></textarea>
										</div>
									</div>	
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >ISLAND (Origin)</label>
										<div class="col-sm-7" >
											 <select type="text" class="form-control pod podonly" id="U_ISLAND" placeholder="" disabled>
											 		<option class="" value=""  ></option>
									 					<?php
															$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT Code,Name FROM [@ISLAND] ORDER BY Code ASC");
																while (odbc_fetch_row($qry)) 
																{
																	//echo odbc_result($qry, 'NextNumber');
																	echo '<option class="" value="' . odbc_result($qry, "Code") . '"  >' . odbc_result($qry, "Name") . '</option>';
																}
																
																odbc_free_result($qry);
														?>
											 </select>
										</div>
									</div>	
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Destination</label>
										<div class="col-sm-7" >
											 <textarea type="text" class="form-control billInputs" id="U_Destination" placeholder="" readonly rows="5"></textarea>
										</div>
									</div>	
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >ISLAND (Destination)</label>
										<div class="col-sm-7" >
											 <select type="text" class="form-control pod podonly" id="U_ISLAND_D" placeholder="" disabled>
											 		<option class="" value=""  ></option>
									 					<?php
															$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT Code,Name FROM [@ISLAND] ORDER BY Code ASC");
																while (odbc_fetch_row($qry)) 
																{
																	//echo odbc_result($qry, 'NextNumber');
																	echo '<option class="" value="' . odbc_result($qry, "Code") . '"  >' . odbc_result($qry, "Name") . '</option>';
																}
																
																odbc_free_result($qry);
														?>
											 </select>
										</div>
									</div>
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >if Interisland</label>
										<div class="col-sm-7" >
											 <select type="text" class="form-control pod podonly" id="U_IFINTERISLAND" placeholder="" disabled>
											 		<option  value="Yes"  >Yes</option>
									 				<option  value="No"  >No</option>

											 </select>
										</div>
									</div>
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Delivery Status</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control billInputs" id="U_DeliveryStatus" placeholder="" readonly>
										</div>
									</div>	
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Trip Type</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control billInputs" id="U_TripType" placeholder="" readonly>
										</div>
									</div>	
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >No of Drops</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control billInputs" id="U_NoOfDrops" placeholder="" readonly>
										</div>
									</div>
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Remarks</label>
										<div class="col-sm-7" >
											 <textarea type="text" class="form-control billInputs" id="U_RemarksDTR" placeholder="" readonly rows="5"></textarea>
										</div>
									</div>	
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Remarks (POD)</label>
										<div class="col-sm-7" >
											 <textarea type="text" class="form-control billInputs" id="U_RemarksPOD" placeholder="" readonly rows="5"></textarea>
										</div>
									</div>
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Gross Client Rates</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control billInputs editable amount" id="U_GrossClientRates" placeholder="" >
										</div>
									</div>
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Gross Client Rates Based On Tax Type</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control billInputs editable amount" id="U_GrossClientRatesTax" placeholder="" readonly>
										</div>
									</div>
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Rate Basis</label>
										<div class="col-sm-7" >
											  <select type="text" class="form-control pod" id="U_RateBasis" placeholder="" >
											 		<option class="ratebasis" value=""  ></option>
									 				<?php
															$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT Code,Name FROM [@RATEBASIS] ORDER BY Code ASC");
																while (odbc_fetch_row($qry)) 
																{
																	//echo odbc_result($qry, 'NextNumber');
																	echo '<option class="ratebasis" value="' . odbc_result($qry, "Code") . '"  >' . odbc_result($qry, "Name") . '</option>';
																}
																
																odbc_free_result($qry);
														?>
											 </select>
										</div>
									</div>	
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Tax Type</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control billInputs" id="U_TaxType" placeholder="" readonly>
										</div>
									</div>
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Gross Trucker </label>
										<div class="col-sm-7" >
						<input type="text" class="form-control billInputs editable amount" id="U_GrossTruckerRates" placeholder="" >
										</div>
									</div>
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Gross Trucker Rates Based on Tax Type</label>
										<div class="col-sm-7" >
	<input type="text" class="form-control billInputs editable amount" id="U_GrossTruckerRatesTax" placeholder="" readonly>
										</div>
									</div>	
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Rate Basis (Trucker)</label>
										<div class="col-sm-7" >
											  <select type="text" class="form-control pod" id="U_RateBasisT" placeholder="" >
											 		<option class="ratebasis2" value=""  ></option>
									 				<?php
															$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT Code,Name FROM [@RATEBASIS] ORDER BY Code ASC");
																while (odbc_fetch_row($qry)) 
																{
																	//echo odbc_result($qry, 'NextNumber');
																	echo '<option class="ratebasis2" value="' . odbc_result($qry, "Code") . '"  >' . odbc_result($qry, "Name") . '</option>';
																}
																
																odbc_free_result($qry);
														?>
											 </select>
										</div>
									</div>	
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Tax Type (Trucker)</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control billInputs" id="U_TaxTypeT" placeholder="" readonly>
										</div>
									</div>
										<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Gross Profit</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control billInputs editable amount" id="U_GrossProfitNet" placeholder="" readonly>
										</div>
									</div>

          		</div>

          		<div class="col-4">
          						<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Demurrage (Client)</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control billInputs editable amount" id="U_Demurrage" placeholder="" >
										</div>
									</div>	
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Additional Drop (Client)</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control billInputs editable amount" id="U_AddtlDrop" placeholder="" >
										</div>
									</div>
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Boom Truck (Client)</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control billInputs editable amount" id="U_BoomTruck" placeholder="" >
										</div>
									</div>	
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Manpower (Client)</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control billInputs editable amount" id="U_Manpower" placeholder="" >
										</div>
									</div>	

									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Backload (Client)</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control billInputs editable amount" id="U_Backload" placeholder="" >
										</div>
									</div>	
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Total Additional Charges (Client)</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control billInputs editable amount" id="U_TotalAddtlCharges" placeholder="" readonly>
										</div>
									</div>
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Demurrage Client (Based on Tax Type)</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control billInputs editable amount" id="U_Demurrage4" placeholder="" readonly>
										</div>
									</div>	
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Additional Charges Client (Based on Tax Type)</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control billInputs editable amount" id="U_AddtlCharges2" placeholder="" readonly>
										</div>
									</div>
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Demurrage (Trucker)</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control billInputs editable amount" id="U_Demurrage2" placeholder="" >
										</div>
									</div>
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Additional Drop (Trucker)</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control billInputs editable amount" id="U_AddtlDrop2" placeholder="" >
										</div>
									</div>
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Boom Truck (Trucker)</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control billInputs editable amount" id="U_BoomTruck2" placeholder="" >
										</div>
									</div>
										
        				<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Manpower (Trucker)</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control billInputs editable amount" id="U_Manpower2" placeholder="" >
									</div>
								</div>	
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Backlod (Trucker)</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control billInputs editable amount" id="U_Backload2" placeholder="" >
									</div>
								</div>	
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Total Additional Charges (Truckers)</label>
									<div class="col-sm-7" >
								<input type="text" class="form-control billInputs editable amount" id="U_totalAddtlCharges2" placeholder="" readonly>
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Demurrage Trucker (Base on Tax Type)</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control billInputs editable amount" id="U_Demurrage3" placeholder="" readonly>
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Additional Charges Trucker (Base on Trucker)</label>
									<div class="col-sm-7" >
										<input type="text" class="form-control billInputs editable amount" id="U_AddtlCharges" placeholder="" readonly>
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Gross Profit (Other Charges)</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control billInputs editable amount" id="U_GrossProfit" placeholder="" readonly>
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Total Client Rate</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control billInputs  editable amount" id="U_TotalInitialClient" placeholder="" readonly>
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Total Trucker Cost</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control billInputs editable amount" id="U_TotalInitialTruckers" placeholder="" readonly>
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Total Gross Profit</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control billInputs editable amount" id="U_TotalGrossProfit" placeholder="" readonly>
									</div>
								</div>

								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Sales Order No.</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control billInputs" id="U_PODSONum" placeholder="" readonly>
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >AR Invoice</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control billInputs" id="U_ARDocNum" placeholder="" readonly>
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Actual Billed Amount Main Rates</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control billInputs" id="U_ActualBilledRate" placeholder="" readonly>
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Rate Adjustments</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control billInputs" id="U_RateAdjustments" placeholder="" readonly>
									</div>
								</div>
								<!-- ADDL FIELDS																	 -->
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Actual Demurrage</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control billInputs" id="" placeholder="" readonly>
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Actual Additional Charges</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control billInputs" id="" placeholder="" readonly>
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Total Receivable from Clients, Per SI Recon with BR</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control billInputs" id="" placeholder="" readonly>
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Total AR (Stand Alone)</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control billInputs" id="" placeholder="" readonly>
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Variance</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control billInputs" id="" placeholder="" readonly>
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Payment Voucher Number</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control billInputs" id="" placeholder="" readonly>
									</div>
								</div>

          		</div>
				  <div class="col-4">
				  			<div class="form-group row my-1" >
								<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >AP Invoice</label>
								<div class="col-sm-7" >
										<input type="text" class="form-control billInputs" id="RowNoVertical" placeholder="" readonly>
								</div>
							</div>	
							<div class="form-group row my-1" >
								<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Paid AP Invoice</label>
								<div class="col-sm-7" >
										<input type="text" class="form-control billInputs" id="RowNoVertical" placeholder="" readonly>
								</div>
							</div>
							<div class="form-group row my-1" >
								<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Actual Rates charged by Trucker</label>
								<div class="col-sm-7" >
										<input type="text" class="form-control billInputs" id="RowNoVertical" placeholder="" readonly>
								</div>
							</div>
							<div class="form-group row my-1" >
								<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Rate Adjustments</label>
								<div class="col-sm-7" >
										<input type="text" class="form-control billInputs" id="RowNoVertical" placeholder="" readonly>
								</div>
							</div>
							<div class="form-group row my-1" >
								<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Actual Approved Demurrage</label>
								<div class="col-sm-7" >
										<input type="text" class="form-control billInputs" id="RowNoVertical" placeholder="" readonly>
								</div>
							</div>
							<div class="form-group row my-1" >
								<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Actual Additional Charges</label>
								<div class="col-sm-7" >
										<input type="text" class="form-control billInputs" id="RowNoVertical" placeholder="" readonly>
								</div>
							</div>

							<div class="form-group row my-1" >
								<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Row#</label>
								<div class="col-sm-7" >
										<input type="text" class="form-control billInputs" id="RowNoVertical" placeholder="" readonly>
								</div>
							</div>							
				
				</div>
          	</div>
          </div>
          <!--Footer-->
          <div class="modal-footer">
<button type="button" id="btnUpdatePRICINGRow" class="btn btn-secondary mr-auto" >Update1</button>
          </div>
        </div>
        <!--/.Content-->
      </div>
    </div>
    <!-- Bill To Details Modal -->