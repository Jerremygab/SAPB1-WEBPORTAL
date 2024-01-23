<div class="modal fade" id="modalVerticalPOD" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"data-backdrop="false" >
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document" style="width:100%; " data-backdrop="false">
        <!--Content-->
        <div class="modal-content-full-width modal-content" style="height: 1200px; width: 2000px">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
            <h4 class="modal-title w-100" id="myModalLabel" style="color:black">Update POD</h4>
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
											 <input type="text" class="form-control pod podstatusrequired" id="U_BookingNumber" placeholder="" readonly>
											 <input type="hidden" class="form-control pod podstatusrequired podincharge" id="U_ClientLeadTime" placeholder="" readonly>

										</div>
									</div>	
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Booking Date</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control pod podstatusrequired general-required-date" id="U_BookingDate" placeholder="">
										</div>
									</div>	
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Client Name</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control pod podstatusrequired billing tp pricing" id="U_ClientName" placeholder="" readonly>
										</div>
									</div>	
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >SAP Client</label>
										<div class="col-sm-7 input-group" >
											 <input type="text" class="form-control pod podstatusrequired billing pricing" id="U_SAPClient" placeholder="" readonly>
											 	<div class="input-group-append">
													<button id="btnCustomer" class="btn btnGroup" type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#customerModal" data-backdrop="false" >
														<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue "></i>
													</button>
												</div>
										</div>
									</div>	
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Trucker Name</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control pod podstatusrequired tp pricing" id="U_TruckerName" placeholder="" readonly>
										</div>
									</div>	
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >SAP Trucker Code</label>
										<div class="col-sm-7 input-group" >
											 <input type="text" class="form-control pod podstatusrequired tp pricing" id="U_SAPTrucker" placeholder="" readonly>
											 <div class="input-group-append">
													<button id="btnVendor" class="btn btnGroup" type="button" data-mdb-ripple-color="dark"  style="background-color: #ADD8E6; "  data-toggle="modal" data-target="#vendorModal" data-backdrop="false" >
														<i class="fas fa-list-ul input-prefix" tabindex=0 style="color:blue "></i>
													</button>
												</div>
										</div>
									</div>	
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Plate Number</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control pod podstatusrequired billing" id="U_PlateNumber" placeholder="" >
										</div>
									</div>	
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Vehicle Type & Capcity</label>
										<div class="col-sm-7" >
											 <select type="text" class="form-control pod podstatusrequired required billing pricing" id="U_VehicleTypeCap" placeholder="" >
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
							<textarea type="text" class="form-control pod podstatusrequired billing pricing" id="U_DeliveryOrigin" placeholder="" rows="5"></textarea>
										</div>
									</div>	
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >ISLAND (Origin)</label>
										<div class="col-sm-7" >
											 <select type="text" class="form-control pod" id="U_ISLAND" placeholder="" >
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
											 <textarea type="text" class="form-control pod podstatusrequired billing pricing" id="U_Destination" placeholder="" rows="5"></textarea>
										</div>
									</div>	
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >ISLAND (Destination)</label>
										<div class="col-sm-7" >
											 <select type="text" class="form-control pod" id="U_ISLAND_D" placeholder="" >
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
											 <select type="text" class="form-control pod" id="U_IFINTERISLAND" placeholder="" >
											 		<option  value="Yes"  >Yes</option>
									 				<option  value="No"  >No</option>

											 </select>
										</div>
									</div>
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Delivery Status</label>
										<div class="col-sm-7" >
											 <select type="text" class="form-control pod podstatusrequired billing tp pricing" id="U_DeliveryStatus" placeholder="" >
											  		<option class="deliverystatus" value=""  ></option>
									 				<?php
															$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT Code,Name FROM [@DELIVERYSTATUS] ORDER BY Code ASC");
																while (odbc_fetch_row($qry)) 
																{
																	//echo odbc_result($qry, 'NextNumber');
																	echo '<option class="deliverystatus" value="' . odbc_result($qry, "Code") . '"  >' . odbc_result($qry, "Name") . '</option>';
																}
																
																odbc_free_result($qry);
														?>
												</select>
										</div>
									</div>	
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Delivery Completion Date (PER DTR)</label>
										<div class="col-sm-7" >
			<input type="text" class="form-control pod date podstatusrequired" id="U_DeliveryDateDTR" placeholder="" >
										</div>
									</div>	
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Delivery Complete Date (PER POD)</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control pod date podstatusrequired billing tp delivereddate" id="U_DeliveryDatePOD" placeholder="" >
										</div>
									</div>	
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >No of Drops</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control pod podstatusrequired billing" id="U_NoOfDrops" placeholder="" >
										</div>
									</div>	
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Trip Type</label>
										<div class="col-sm-7" >
										  <select type="text" class="form-control pod billing tp pricing" id="U_TripType" placeholder="" >
										  		<option class="triptype" value=""  ></option>
									 				<?php
															$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT Code,Name FROM [@TRIPTYPE] ORDER BY Code ASC");
																while (odbc_fetch_row($qry)) 
																{
																	//echo odbc_result($qry, 'NextNumber');
																	echo '<option class="triptype" value="' . odbc_result($qry, "Code") . '"  >' . odbc_result($qry, "Name") . '</option>';
																}
																
																odbc_free_result($qry);
														?>
											</select>
										</div>
									</div>	
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Remarks</label>
										<div class="col-sm-7" >
											 <textarea type="text" class="form-control pod  tp" id="U_Remarks" placeholder="" rows="5"></textarea>
										</div>
									</div>	
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Document Number</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control pod" maxlength="100" id="U_DocNum" placeholder="">
										</div>
									</div>
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Trip Ticket #</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control pod podstatusrequired unique" id="U_TripTicketNo" placeholder="" >
										</div>
									</div>	
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Shipment #</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control pod podstatusrequired billing tp" id="U_ShipmentNo" placeholder="" >
										</div>
									</div>
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Waybill #</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control pod podstatusrequired billing tp unique" id="U_WaybillNo" placeholder="" tanindex="-1">
										</div>
									</div>	
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Delivery Receipt #</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control pod podstatusrequired billing tp" id="U_DeliveryReceiptNo" placeholder="" >
										</div>
									</div>	
										<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Series #</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control pod podstatusrequired billing tp" id="U_SeriesNo" placeholder="" >
										</div>
									</div>	
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Other POD Document</label>
										<div class="col-sm-7" >
											 <textarea type="text" class="form-control pod podstatusrequired billing tp" id="U_OtherPODDoc" placeholder="" rows="5"></textarea>
										</div>
									</div>	
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Remarks (POD)</label>
										<div class="col-sm-7" >
											 <textarea type="text" class="form-control pod podstatusrequired billing pricing" id="U_RemarksPOD" placeholder="" rows="5"></textarea>
										</div>
									</div>
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Received by</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control pod podstatusrequired" id="U_Receivedby" placeholder="" >
										</div>
									</div>
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Client Received Date</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control pod date podstatusrequired ongoingrequired onholdrequired returnrequired billing
" id="U_ClientReceivedDate" placeholder="" >
										</div>
									</div>
										<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Actual date received Soft copy (Initial)	</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control pod date podstatusrequired
" id="U_ActualDateRec_Intitial" placeholder="" >
										</div>
									</div>

									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Initial HC Inteluck Received Date</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control pod date podstatusrequired pendingrequired ongoingrequired onholdrequired returnrequired inteluckdate" id="U_InitialHCRecDate" placeholder="" >
										</div>
									</div>
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Actual HC Inteluck Received Date</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control pod date podstatusrequired billing inteluckdate" id="U_ActualHCRecDate" placeholder="" >
										</div>
									</div>
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Date Returned</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control pod date podstatusrequired returnrequired notearlythandeldate" id="U_DateReturned" placeholder="" >
										</div>
									</div>
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >POD in Charge</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control pod podincharge billing" id="U_PODinCharge" placeholder="" readonly>
										</div>
									</div>	
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Verified Date Hard Copy GOOD</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control pod date podstatusrequired billing notearlythandeldate" id="U_VerifiedDateHC" placeholder="" >
										</div>
									</div>	
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >POD Status (Detail)</label>
										<div class="col-sm-7" >
								<select type="text" class="form-control pod billing verifiededitable" id="U_PODStatusDetail" placeholder="" >
										  		<option class="podstatus" value=""  ></option>
									 				<?php
															$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT Code,Name FROM [@PODSTATUS] ORDER BY Code ASC");
																while (odbc_fetch_row($qry)) 
																{
																	//echo odbc_result($qry, 'NextNumber');
																	echo '<option class="podstatus" value="' . odbc_result($qry, "Code") . '"  >' . odbc_result($qry, "Name") . '</option>';
																}
																
																odbc_free_result($qry);
														?>
											</select>
										</div>
									</div>	
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >PTF (POD Transmitall Form) #</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control pod billing" id="U_PTFNo" placeholder="" >
										</div>
									</div>	
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Date Forwarded to BT (Hard Copy)</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control pod date billing verifiededitable" id="U_DateForwardedBT" placeholder="" >
										</div>
									</div>	
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Verification Turnaround Time (TAT)</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control pod date billing verifiededitable" id="U_VERIFICATION_TAT" placeholder="" readonly>
										</div>
									</div>	
										<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >POD Turnaround Time (TAT)</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control pod date billing verifiededitable" id="U_POD_TAT" placeholder="" readonly>
										</div>
									</div>
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Billing Deadline</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control pod billing" id="U_BillingDeadline" placeholder="" readonly>
										</div>
									</div>	

									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Billing Status</label>
										<div class="col-sm-7" >
											<select type="text" class="form-control pod billing verifiededitable" id="U_BillingStatus" placeholder="" disabled>
										  		<option class="podstatus" value=""  ></option>
									 				<?php
															$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT Code,Name FROM [@BILLINGSTATUS] ORDER BY Code ASC");
																while (odbc_fetch_row($qry)) 
																{
																	//echo odbc_result($qry, 'NextNumber');
																	echo '<option class="podstatus" value="' . odbc_result($qry, "Code") . '"  >' . odbc_result($qry, "Name") . '</option>';
																}
																
																odbc_free_result($qry);
														?>
											</select>
										</div>
									</div>	
									<div class="form-group row my-1" >
										<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Service Type</label>
										<div class="col-sm-7" >
											 <input type="text" class="form-control pod billing" id="U_ServiceType" placeholder="" readonly>
										</div>
									</div>	
          		</div>

          		<div class="col-4">
        				<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >SI #</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control pod billing" id="U_SINo" placeholder="" readonly>
									</div>
								</div>	
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Billing Team in Charge</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control pod billing" id="U_BillingTeam" placeholder="" readonly>
									</div>
								</div>	
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >BT Remarks</label>
									<div class="col-sm-7" >
										 <textarea type="text" class="form-control pod billing" id="U_BTRemarks" placeholder="" rows="5"></textarea>
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >SOB Number</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control pod billing" id="U_SOBNumber" placeholder="" >
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Outlet No. (Criteria for GetCocaRates)</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control pod billing" id="U_OutletNo" placeholder="" >
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >CBM (Cubic meter) - Based on SI/DR</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control pod billing" id="U_CBM" placeholder="" >
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Sales Invoice No/ Delivery Receipt No</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control pod billing" id="U_SI_DRNo" placeholder="" >
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Delivery Mode</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control pod billing" id="U_DeliveryMode" placeholder="" >
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Source Whse - Based on DTT Stamp</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control pod billing" id="U_SourceWhse" placeholder="" >
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Destination - Client's Customer</label>
									<div class="col-sm-7" >
										 <textarea type="text" class="form-control pod billing" id="U_DestinationClient" placeholder="" rows="5"></textarea>
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Total Invoice Amount</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control pod billing" id="U_TotalInvAmount" placeholder="" >
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >SO No - Listed on Delivery Receipt</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control pod billing" id="U_SONo" placeholder="" >
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Name of Customer</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control pod billing" id="U_NameCustomer" placeholder="" >
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Category - Listed on Delivery Receipt</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control pod billing" id="U_CategoryDR" placeholder="" >
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Forward Load</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control pod billing" id="U_ForwardLoad" placeholder="" >
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Back Load</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control pod billing" id="U_BackLoad" placeholder="" >
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >ID Number</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control pod billing" id="U_IDNumber" placeholder="" >
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Type of Accessorial</label>
									<div class="col-sm-7" >
										 <select type="text" class="form-control pod billing" id="U_TypeOfAccessorial" placeholder="" >
										  		<option class="typeofaccessorial" value=""  ></option>
									 				<?php
															$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT Code,Name FROM [@TYPEOFACCESSORIAL] ORDER BY Code ASC");
																while (odbc_fetch_row($qry)) 
																{
																	//echo odbc_result($qry, 'NextNumber');
																	echo '<option class="typeofaccessorial" value="' . odbc_result($qry, "Code") . '"  >' . odbc_result($qry, "Name") . '</option>';
																}
																
																odbc_free_result($qry);
														?>
											</select>
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Approval Status of Accessorial</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control pod billing" id="U_ApprovalStatus" placeholder="" >
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Time In (Empty Demurrage)</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control pod billing time" id="U_TimeInEmptyDem" placeholder="" >
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Time Out (Empty Demurrage)</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control pod billing time" id="U_TimeOutEmptyDem" placeholder="" >
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Verified Empty Demurrage</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control pod billing" id="U_VerifiedEmptyDem" placeholder="" >
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Remarks</label>
									<div class="col-sm-7" >
										 <textarea type="text" class="form-control pod billing" id="U_Remarks2" placeholder="" rows="5"></textarea>
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Time In (Advance Loading)</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control pod billing time" id="U_TimeInAdvLoading" placeholder="" >
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Day Of The Week</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control pod billing" id="U_DayOfTheWeek" placeholder="" >
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Time In</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control pod billing time" id="U_TimeIn" placeholder="" >
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Time Out</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control pod billing time" id="U_TimeOut" placeholder="" >
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Total No. Exceed</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control pod billing" id="U_TotalNoExceed" placeholder="" >
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >ODO In</label>
									<div class="col-sm-7" >
										 <input type="number" class="form-control pod billing" id="U_ODOIn" placeholder="" >
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >ODO Out</label>
									<div class="col-sm-7" >
										 <input type="number" class="form-control pod billing" id="U_ODOOut" placeholder="" >
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Total Usage</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control pod billing" id="U_TotalUsage" placeholder="" >
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Client Submission Status</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control pod" id="U_ClientSubStatus" placeholder="" readonly>
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Client Sub Overdue Days</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control pod" id="U_ClientSubOverdue" placeholder="" readonly>
									</div>
								</div>
          		</div>
          		<div class="col-4">
          			<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Client Penalty Calculation</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control pod" id="U_ClientPenaltyCalc" placeholder="" readonly>
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >POD Status for Payment Processing</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control pod verifiededitable" id="U_PODStatusPayment" placeholder="" readonly>
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >POD Submit Deadline</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control pod" id="U_PODSubmitDeadline" placeholder="" readonly>
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Overdue Days</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control pod" id="U_OverdueDays" placeholder="" readonly>
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" readonly>Inteluck - Penalty Calculation</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control pod" id="U_InteluckPenaltyCalc" placeholder="" readonly>
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >CRD Waived Days</label>
									<div class="col-sm-7" >
								<input type="number" class="form-control pod verifiededitable" id="U_WaivedDays" placeholder="" >
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >IRD Waived Days</label>
									<div class="col-sm-7" >
										 <input type="number" class="form-control pod verifiededitable" id="U_HolidayOrWeekend" placeholder="" >
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Lost - Penalty Calculation</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control pod" id="U_LostPenaltyCalc" placeholder="" readonly>
									</div>
								</div>
									<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Penalties (Manual)</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control pod amountNumber verifiededitable" id="U_PenaltiesManual" placeholder="" value="0.00">
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Total Submission Penalties</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control pod amount" id="U_TotalSubPenalties" placeholder="" readonly>
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Waived?</label>
									<div class="col-sm-7" >
										 <select type="text" class="form-control pod verifiededitable" id="U_Waived" placeholder="" >
										 			<option class="typeofaccessorial" value=""  ></option>
										  		<option class="typeofaccessorial" value="N"  >No</option>
									 				<option class="typeofaccessorial" value="Y"  >Yes</option>
											</select>
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >% Penalty Charged</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control pod verifiededitable" id="U_PercPenaltyCharge" placeholder="" >
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Approved by</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control pod verifiededitable" id="U_Approvedby" placeholder="" >
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Total Penalty Waived</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control pod" id="U_TotalPenaltyWaived" placeholder="" readonly>
									</div>
								</div>
								<div class="form-group row my-1" >
									<label for="inputEmail3" class="col-sm-5 col-form-label py-1 mt-2" style="color: black;" >Row#</label>
									<div class="col-sm-7" >
										 <input type="text" class="form-control pod podincharge" id="RowNoVertical" placeholder="" readonly>
									</div>
								</div>
          		</div>
          	</div>
          </div>
          <!--Footer-->
          <div class="modal-footer">
						<button type="button" id="btnUpdatePODRow" class="btn btn-secondary mr-auto" >Update</button>
						<button type="button" id="btnUpdatePODRowNew" class="btn btn-secondary mr-auto d-none" >Update</button>
          </div>
        </div>
        <!--/.Content-->
      </div>
    </div>
    <!-- Bill To Details Modal -->

    <!-- Business Partner Modal -->
    <div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-dialog modal-xl" role="document" style="width:100%">
        <!--Content-->
        <div class="modal-content-full-width modal-content">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
            <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of Customers</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->
          <div class="modal-body">
            <table class="tblCustomer table table-striped table-bordered table-hover" id="tblCustomer" style="width: 100%">
						<thead>
							<tr>
								<th >#</th>
								<th>Customer Code</th>
								<th>Customer Name</th>
								<th>Group Project / Location</th>
						
							</tr>
						</thead>
						<tbody>
						<?php
							$itemno = 1;
							$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT DISTINCT
																						T0.CardCode, 
																						T0.CardName,
																						T0.U_GroupLocation
																						
																						FROM OCRD T0
																				
																						
																						WHERE T0.CardType = 'C'
																						
																						ORDER BY T0.CardCode ASC");
								while (odbc_fetch_row($qry)) 
								{
									echo '<tr class="tableHover">
												<td>'.$itemno.'</td>
													<td class="item-1">'.odbc_result($qry, 'CardCode').'</td>
													<td class="item-2">'.odbc_result($qry, 'CardName').'</td>
													<td class="item-3">'.odbc_result($qry, 'U_GroupLocation').'</td>
											  </tr>';
									$itemno++;	  
								}
								
								odbc_free_result($qry);
							

						?>
						</tbody>
					</table>
          </div>
          <!--Footer-->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!--/.Content-->
      </div>
    </div>
    <!-- Business Partner Modal -->

    <!-- Business Partner Modal -->
    <div class="modal fade" id="vendorModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-dialog modal-xl" role="document" style="width:100%">
        <!--Content-->
        <div class="modal-content-full-width modal-content">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
            <h4 class="modal-title w-100" id="myModalLabel" style="color:black">List of Vendors</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->
          <div class="modal-body">
            <table class="tblVendor table table-striped table-bordered table-hover" id="tblVendor" style="width: 100%">
						<thead>
							<tr>
								<th >#</th>
								<th>Vendor Code</th>
								<th>Vendor Name</th>
						
							</tr>
						</thead>
						<tbody>
						<?php
							$itemno = 1;
							$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT DISTINCT
																						T0.CardCode, 
																						T0.CardName
																						
																						FROM OCRD T0
																				
																						
																						WHERE T0.CardType = 'S'
																						
																						ORDER BY T0.CardCode ASC");
								while (odbc_fetch_row($qry)) 
								{
									echo '<tr class="tableHover">
												<td>'.$itemno.'</td>
												<td class="item-1">'.odbc_result($qry, 'CardCode').'</td>
												<td class="item-2">'.odbc_result($qry, 'CardName').'</td>
											
											  </tr>';
									$itemno++;	  
								}
								
								odbc_free_result($qry);
							

						?>
						</tbody>
					</table>
          </div>
          <!--Footer-->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!--/.Content-->
      </div>
    </div>
    <!-- Business Partner Modal -->

    <script>$('#tblCustomer').dataTable({"bLengthChange": false});</script>
    <script>$('#tblVendor').dataTable({"bLengthChange": false});</script>