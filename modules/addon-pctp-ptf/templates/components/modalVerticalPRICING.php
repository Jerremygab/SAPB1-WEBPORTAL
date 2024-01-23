 <div class="modal fade" id="modalVerticalPRICING" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"data-backdrop="false" >
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document" style="width:100%; " data-backdrop="false">
        <!--Content-->
        <div class="modal-content-full-width modal-content" style="height: 1500px; width: 1500px">
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
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Client Name</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control billInputs" id="U_ClientName" placeholder="" readonly>
										</div>
									</div>	
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Client Project</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control billInputs" id="U_ClientProject" placeholder="" readonly>
										</div>
									</div>	
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Delivery Origin</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control billInputs" id="U_DeliveryOrigin" placeholder="" readonly>
										</div>
									</div>	
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Destination</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control billInputs" id="U_Destination" placeholder="" readonly>
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
											 <input type="text" class="form-control billInputs" id="U_RemarksDTR" placeholder="" readonly>
										</div>
									</div>	
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Remarks (POD)</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control billInputs" id="U_RemarksPOD" placeholder="" readonly>
										</div>
									</div>
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Gross Client Rates</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control billInputs editable" id="U_GrossClientRates" placeholder="" >
										</div>
									</div>
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Gross Client Rates Based On Tax Type</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control billInputs editable" id="U_GrossClientRatesTax" placeholder="" readonly>
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
						<input type="text" class="form-control billInputs editable" id="U_GrossTruckerRates" placeholder="" >
										</div>
									</div>
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Gross Trucker Rates Based on Tax Type</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control billInputs editable" id="U_GrossTruckerRatesTax" placeholder="" readonly>
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
									

          		</div>

          		<div class="col-4">
          			<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Demurrage (Client)</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control billInputs editable" id="U_Demurrage" placeholder="" >
										</div>
									</div>	
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Additional Drop (Client)</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control billInputs editable" id="U_AddtlDrop" placeholder="" >
										</div>
									</div>
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Boom Truck (Client)</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control billInputs editable" id="U_BoomTruck" placeholder="" >
										</div>
									</div>	
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Manpower (Client)</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control billInputs editable" id="U_Manpower" placeholder="" >
										</div>
									</div>	

									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Backload (Client)</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control billInputs editable" id="U_Backload" placeholder="" >
										</div>
									</div>	
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Total Additional Charges (Client)</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control billInputs editable" id="U_TotalAddtlCharges" placeholder="" readonly>
										</div>
									</div>
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Demurrage Client (Based on Tax Type)</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control billInputs editable" id="U_Demurrage4" placeholder="" readonly>
										</div>
									</div>	
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Additional Charges Client (Based on Tax Type)</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control billInputs editable" id="U_AddtlCharges2" placeholder="" readonly>
										</div>
									</div>
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Demurrage (Trucker)</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control billInputs editable" id="U_Demurrage2" placeholder="" >
										</div>
									</div>
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Additional Drop (Trucker)</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control billInputs editable" id="U_AddtlDrop2" placeholder="" >
										</div>
									</div>
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Boom Truck (Trucker)</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control billInputs editable" id="U_BoomTruck2" placeholder="" >
										</div>
									</div>
										
        				<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Manpower (Trucker)</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control billInputs editable" id="U_Manpower2" placeholder="" >
									</div>
								</div>	
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Backlod (Trucker)</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control billInputs editable" id="U_Backload2" placeholder="" >
									</div>
								</div>	
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Total Additional Charges (Truckers)</label>
									<div class="col-sm-7" >
								<input type="text" class="form-control billInputs editable" id="U_totalAddtlCharges2" placeholder="" readonly>
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Demurrage Trucker (Base on Tax Type)</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control billInputs editable" id="U_Demurrage3" placeholder="" readonly>
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Additional Charges Trucker (Base on Trucker)</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control billInputs editable" id="AddtlCharges
" placeholder="" readonly>
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Gross Profit</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control billInputs editable" id="U_GrossProfit" placeholder="" readonly>
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Total Initial Client Rates</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control billInputs  editable" id="U_TotalInitialClient" placeholder="" >
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Total Initial Trucker Rates</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control billInputs editable" id="U_TotalInitialTruckers" placeholder="" readonly>
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Total Gross Rates</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control billInputs editable" id="U_TotalGrossProfit" placeholder="" readonly>
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Row#</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control billInputs" id="" placeholder="" readonly>
									</div>
								</div>
          		</div>
          	</div>
          </div>
          <!--Footer-->
          <div class="modal-footer">
<button type="button" id="btnUpdatePRICINGRow" class="btn btn-secondary" >Update</button>
          </div>
        </div>
        <!--/.Content-->
      </div>
    </div>
    <!-- Bill To Details Modal -->