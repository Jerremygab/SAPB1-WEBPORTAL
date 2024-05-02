<?php 
session_start(); 
include_once('../../../config/config.php');	
if(!isset($_SESSION['SESS_USERID']) && empty($_SESSION['SESS_USERID'])) 
{
  header("Location: ../../login/login.php");
}
$GenSet = '';
//background-image: linear-gradient(#f2f7f8 , #ceeffa) !important;
?>

<!-- Sidebar -->
<div id="sideBarMenu" style="padding:10px;  background-color: transparent;" class="">
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar" style="background-color:white; width:280px !important;  background-color: transparent;">

      <!-- Sidebar - Brand -->
     
	<div class="row">
		<div class="col-lg-9">
			<div class="sidebar-brand-text mx-3 my-1" style="font-weight:bold; color: Black; ">
								<?php 
									$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
											SELECT CompnyName [Company] FROM OADM");
													
									while (odbc_fetch_row($qry)) 
									{
										echo odbc_result($qry, 'Company');
									}
									odbc_free_result($qry);
									?>
									<br/>
									<?php
									echo $_SESSION['SESS_SAPUSER']
									?>
			</div>
			
		</div>
		<div class="col-lg-3">
			
		</div>
	</div>
      <!-- Divider -->
      <hr class="sidebar-divider d-none " style="background-color: #f0ad4e !important; height: 5px;">

      <!-- Nav Item - Dashboard -->
       <li class="nav-item nav-li" style="background-color:#D0D0D0; border-bottom: 5px solid #f0ad4e; border-top: 5px solid #f0ad4e ;  ">
        <a class="nav-link " href="../../dashboard/templates/dashboard.php">
        <i class="fas fa-home nav-icon"></i>
          <span class="nav-module nav-module-span">Home</span>
        </a>
       
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none" style="background-color: #f0ad4e !important; height: 5px;">

      <!-- Heading -->
      <div class="sidebar-heading">
       
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
	  <div id="navModules" >
			
      <li class="nav-item nav-li 
		<?php
		if(!isset($_SESSION['SESS_SUPERUSER']) && empty($_SESSION['SESS_SUPERUSER'])) 
				{	
					$SuperUser = 'N'; 
				}
				else
				{
					if($_SESSION['SESS_SUPERUSER'] == 'Y'){
						if(!isset($_SESSION['SESS_USER_MAINMODULE']) && empty($_SESSION['SESS_USER_MAINMODULE'])) 
						{	
							$MainAccsLvl =  explode(', ', '');
						}
						else
						{
							$MainAccsLvl = explode(', ', $_SESSION['SESS_USER_MAINMODULE']);
						}
						
						if(in_array('GenSet', $MainAccsLvl)){
							echo '';
						} else { 
							echo 'd-none';
						}
					}
					else{
						echo 'd-none';
					}
				}
				
				
				

			?> "
			style="background-color:#D0D0D0; ">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#administration" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-clipboard-list nav-icon"></i>
          <span class="nav-module nav-module-span">Administration</span>
        </a>
       <div id="administration" class="collapse nav-collapse-parent" aria-labelledby="headingPages" data-parent="#accordionSidebar" >
          <div class="bg-white collapse-inner nav-collapse-child" >
            	<?php
									if(!isset($_SESSION['SESS_USER_MODULE']) && empty($_SESSION['SESS_USER_MODULE'])) 
									{	
										$AccsLvl =  explode(', ', '');
									}
									else
									{
										$AccsLvl = explode(', ', $_SESSION['SESS_USER_MODULE']);
									}
									
								
									echo (in_array('OUSR', $AccsLvl) ? '<a href="../../users/templates/users-document.php" class="collapse-item nav-collapse-a"  ><i class="far fa-window-maximize nav-collapse-i" ></i>Users</a>' : '');
									echo (in_array('CONC', $AccsLvl) ? '<a href="../../users/templates/users-connected-clients-document.php" class="collapse-item nav-collapse-a"  ><i class="far fa-window-maximize nav-collapse-i" ></i>Connected Clients</a>' : '');
									echo (in_array('OLIC', $AccsLvl) ? '<a href="../../license/templates/license-document.php" class="collapse-item nav-collapse-a"  ><i class="far fa-window-maximize nav-collapse-i" ></i>License</a>' : '');
					
								
							
								?>
          </div>
		  
        </div>
      </li>

        <li class="nav-item nav-li 
		<?php
		if(!isset($_SESSION['SESS_SUPERUSER']) && empty($_SESSION['SESS_SUPERUSER'])) 
				{	
					$SuperUser = 'N'; 
				}
				else
				{
					if($_SESSION['SESS_SUPERUSER'] == 'Y'){
						if(!isset($_SESSION['SESS_USER_MAINMODULE']) && empty($_SESSION['SESS_USER_MAINMODULE'])) 
						{	
							$MainAccsLvl =  explode(', ', '');
						}
						else
						{
							$MainAccsLvl = explode(', ', $_SESSION['SESS_USER_MAINMODULE']);
						}
						
						if(in_array('GenSet', $MainAccsLvl)){
							echo '';
						} else { 
							echo 'd-none';
						}
					}
					else{
						echo 'd-none';
					}
				}
				
				
				

			?> "
			style="background-color:#D0D0D0; ">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#approval" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-clipboard-list nav-icon"></i>
          <span class="nav-module nav-module-span">Approval</span>
        </a>
       <div id="approval" class="collapse nav-collapse-parent" aria-labelledby="headingPages" data-parent="#accordionSidebar" >
          <div class="bg-white collapse-inner nav-collapse-child" >

		  
            	<?php
									if(!isset($_SESSION['SESS_USER_MODULE']) && empty($_SESSION['SESS_USER_MODULE'])) 
									{	
										$AccsLvl =  explode(', ', '');
									}
									else
									{
										$AccsLvl = explode(', ', $_SESSION['SESS_USER_MODULE']);
									}
									
									echo '<a href="../../approval-documents/templates/for-approval-document.php" class="collapse-item nav-collapse-a"  ><i class="far fa-window-maximize nav-collapse-i" ></i>Approved/Reject List</a>';
									echo (in_array('APPR', $AccsLvl) ? '<a href="../../approval/templates/approval-document.php" class="collapse-item nav-collapse-a"  ><i class="far fa-window-maximize nav-collapse-i" ></i>Approval Process List</a>' : '');
									echo (in_array('APPT', $AccsLvl) ? '<a href="../../approval-template/templates/approval-template-document.php" class="collapse-item nav-collapse-a"  ><i class="far fa-window-maximize nav-collapse-i" ></i>Approval Template</a>' : '');
								
							
								?>
          </div>
		  
        </div>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item nav-li d-none">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-chart-pie nav-icon"></i>
          <span class="nav-module nav-module-span">Financials</span>
        </a>
        
      </li>




      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item nav-li d-none">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-user-friends nav-icon"></i>
          <span class="nav-module nav-module-span">CRM</span>
        </a>
        
     
      </li>
		
		 <!-- Nav Item - Pages Collapse Menu -->
     <li class="nav-item nav-li
		 <?php
				if(!isset($_SESSION['SESS_USER_MAINMODULE']) && empty($_SESSION['SESS_USER_MAINMODULE'])) 
				{	
					$MainAccsLvl =  explode(', ', '');
				}
				else
				{
					$MainAccsLvl = explode(', ', $_SESSION['SESS_USER_MAINMODULE']);
				}
				
				if(in_array('Sales', $MainAccsLvl)){
					echo '';
				} else { 
					echo 'd-none';
				}

			?> "
	   style="background-color:#D0D0D0; ">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#sales" aria-expanded="true" aria-controls="collapsePages" >
         <i class="fas fa-tags nav-icon" style=""></i>
          <span class="nav-module nav-module-span" >Sales</span>
        </a>
        <div id="sales" class="collapse nav-collapse-parent" aria-labelledby="headingPages" data-parent="#accordionSidebar" >
          <div class="bg-white collapse-inner nav-collapse-child" >
            	<?php
									if(!isset($_SESSION['SESS_USER_MODULE']) && empty($_SESSION['SESS_USER_MODULE'])) 
									{	
										$AccsLvl =  explode(', ', '');
									}
									else
									{
										$AccsLvl = explode(', ', $_SESSION['SESS_USER_MODULE']);
									}
									
								
									echo (in_array('OQUT', $AccsLvl) ? '<a href="../../sales-quotation/templates/sales-quotation-document.php" class="collapse-item nav-collapse-a"  ><i class="far fa-window-maximize nav-collapse-i" ></i>Sales Quotation</a>' : '');
									echo (in_array('ORDR', $AccsLvl) ? '<a href="../../sales-order/templates/sales-order-document.php" class="collapse-item nav-collapse-a"><i class="far fa-window-maximize nav-collapse-i" ></i>Sales Order</a>' : '');
									echo (in_array('ODLN', $AccsLvl) ? '<a href="../../delivery/templates/delivery-document.php" class="collapse-item nav-collapse-a"><i class="far fa-window-maximize nav-collapse-i" ></i>Delivery</a>' : '');
									echo (in_array('OINV', $AccsLvl) || true ? '<a href="../../ar-invoice/templates/ar-invoice-document.php" class="collapse-item nav-collapse-a"><i class="far fa-window-maximize nav-collapse-i" ></i>A/R Invoice</a>' : '');
							
									
								?>
          </div>
		  
        </div>
      </li>
	  	 <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item nav-li 
			<?php
				if(!isset($_SESSION['SESS_USER_MAINMODULE']) && empty($_SESSION['SESS_USER_MAINMODULE'])) 
				{	
					$MainAccsLvl =  explode(', ', '');
				}
				else
				{
					$MainAccsLvl = explode(', ', $_SESSION['SESS_USER_MAINMODULE']);
				}
				
				if(in_array('Purch', $MainAccsLvl)){
					echo '';
				} else { 
					echo 'd-none';
				}

			?>"
			style="background-color:#D0D0D0; ">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#purchasing" aria-expanded="true" aria-controls="collapsePages">
         <i class="fas fa-shopping-cart nav-icon"></i>
          <span class="nav-module nav-module-span" >Purchasing</span>
        </a>
        <div id="purchasing" class="collapse nav-collapse-parent" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner  nav-collapse-child">
            	<?php
									if(!isset($_SESSION['SESS_USER_MODULE']) && empty($_SESSION['SESS_USER_MODULE'])) 
									{	
										$AccsLvl =  explode(', ', '');
									}
									else
									{
										$AccsLvl = explode(', ', $_SESSION['SESS_USER_MODULE']);
									}
									
								
									echo (in_array('OPRQ', $AccsLvl) ? '<a href="../../purchase-request/templates/purchase-request-document.php" class="collapse-item nav-collapse-a"><i class="far fa-window-maximize nav-collapse-i" ></i>Purchase Request</a>' : '');
									echo (in_array('OPQT', $AccsLvl) ? '<a href="../../purchase-quotation/templates/purchase-quotation-document.php" class="collapse-item nav-collapse-a"><i class="far fa-window-maximize nav-collapse-i" ></i>Purchase Quotation</a>' : '');
									echo (in_array('OPOR', $AccsLvl) ? '<a href="../../purchase-order/templates/purchase-order-document.php" class="collapse-item nav-collapse-a"><i class="far fa-window-maximize nav-collapse-i" ></i>Purchase Order</a>' : '');
									echo (in_array('OPDN', $AccsLvl) ? '<a href="../../goods-receipt-PO/templates/goods-receipt-PO-document.php" class="collapse-item nav-collapse-a"><i class="far fa-window-maximize nav-collapse-i" ></i>Goods Receipt PO</a>' : '');
									echo (in_array('OPCH', $AccsLvl) ? '<a href="../../ap-invoice/templates/ap-invoice-document.php" class="collapse-item nav-collapse-a"><i class="far fa-window-maximize nav-collapse-i" ></i>AP Invoice</a>' : '');
									echo (in_array('OPDI', $AccsLvl) ? '<a href="../../ap-downpayment-invoice/templates/ap-downpayment-invoice-document.php"  class="collapse-item nav-collapse-a"><i class="far fa-window-maximize nav-collapse-i" ></i>A/P Downpayment <br> <i class="col ml-2"></i>	Invoice </a>' : '');
									echo (in_array('OPCM', $AccsLvl) ? '<a href="../../ap-credit-memo/templates/ap-credit-memo-document.php" class="collapse-item nav-collapse-a"><i class="far fa-window-maximize nav-collapse-i" ></i>A/P Credit Memo</a>' : '');

									echo (in_array('PurchasingReports', $AccsLvl) ? '
							        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#PurchasingReports" aria-expanded="true" aria-controls="collapsePages">
							         <i class="fas fa-file nav-icon"></i>
							          <span class="nav-module nav-module-span" >Purchasing Reports</span>
							        </a>
							        <div id="PurchasingReports" class="collapse nav-collapse-parent" aria-labelledby="headingPages" data-parent="#purchasing">
							          <div class="bg-white py-2 collapse-inner  nav-collapse-child">
															
																<a href="#"  data-toggle="modal" data-target="#paymentVoucherParameterModal" data-backdrop="false" class="collapse-item nav-collapse-a"><i class="fas fa-file nav-collapse-i" ></i>Payment Voucher</a>
																<a href="#"  data-toggle="modal" data-target="#paymentVoucherParameterModal2" data-backdrop="false" class="collapse-item nav-collapse-a"><i class="fas fa-file nav-collapse-i" ></i>Payment Voucher V2</a>
																<a href="#"  data-toggle="modal" data-target="#paymentVoucherParameterModal3" data-backdrop="false" class="collapse-item nav-collapse-a"><i class="fas fa-file nav-collapse-i" ></i>Payment Voucher V3</a>
																<a href="#"  data-toggle="modal" data-target="#paymentVoucherParameterModal4" data-backdrop="false" class="collapse-item nav-collapse-a"><i class="fas fa-file nav-collapse-i" ></i>Payment Voucher V4</a>
														
															
							          </div>
									  
							        </div>
								' 


										: '');
								
								?>

							
          </div>
		  
        </div>
      </li>
	  	 <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item nav-li d-none">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-user-tie nav-icon"></i>
          <span class="nav-module nav-module-span">Business Partner</span>
        </a>
       
      </li>
	  
	        <!-- Nav Item - Pages Collapse Menu - Banking Category-->
            <li class="nav-item nav-li 
		<?php
				if(!isset($_SESSION['SESS_USER_MAINMODULE']) && empty($_SESSION['SESS_USER_MAINMODULE'])) 
				{	
					$MainAccsLvl =  explode(', ', '');
				}
				else
				{
					$MainAccsLvl = explode(', ', $_SESSION['SESS_USER_MAINMODULE']);
				}
				
				if(in_array('Bank', $MainAccsLvl)){
					echo '';
				} else { 
					echo 'd-none';
				}

			?>" style="background-color:#D0D0D0; ">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#banking"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-coins nav-icon"></i>
                    <span class="nav-module nav-module-span">Banking</span>
                </a>

                <div id="banking" class="collapse nav-collapse-parent" aria-labelledby="headingPages"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner  nav-collapse-child">
                        <?php
									if(!isset($_SESSION['SESS_USER_MODULE']) && empty($_SESSION['SESS_USER_MODULE'])) 
									{	
										$AccsLvl =  explode(', ', '');
									}
									else
									{
										$AccsLvl = explode(', ', $_SESSION['SESS_USER_MODULE']);
									}
									
								
										echo (in_array('ORCT', $AccsLvl) ? '<a href="../../incoming-payments/templates/incoming-payments-document.php" class="collapse-item nav-collapse-a"><i class="far fa-window-maximize nav-collapse-i" ></i>Incoming Payments</a>' : '');
										echo (in_array('OVPM', $AccsLvl) ? '<a href="../../outgoing-payments/templates/outgoing-payments-document.php" class="collapse-item nav-collapse-a"><i class="far fa-window-maximize nav-collapse-i" ></i>Outgoing Payments</a>' : '');
								?>
                    </div>

                </div>
            </li>
     
	   	 <!-- Nav Item - Pages Collapse Menu -->
	   	  <div id="banking" class="collapse nav-collapse-parent" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner  nav-collapse-child">
            	<?php
									if(!isset($_SESSION['SESS_USER_MODULE']) && empty($_SESSION['SESS_USER_MODULE'])) 
									{	
										$AccsLvl =  explode(', ', '');
									}
									else
									{
										$AccsLvl = explode(', ', $_SESSION['SESS_USER_MODULE']);
									}
									
								
										echo (in_array('ORCTXX', $AccsLvl) ? '<a href="../../incoming-payments/templates/incoming-payment-document.php" class="collapse-item nav-collapse-a"><i class="far fa-window-maximize nav-collapse-i" ></i>Incoming Payments</a>' : '');
										echo (in_array('OVPMXX', $AccsLvl) ? '<a href="../../outgoing-payments/templates/outgoing-payment-document.php" class="collapse-item nav-collapse-a"><i class="far fa-window-maximize nav-collapse-i" ></i>Outgoing Payments</a>' : '');
								?>
          </div>
		  
        </div>
      </li>
	  	 <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item nav-li 
			<?php
				if(!isset($_SESSION['SESS_USER_MAINMODULE']) && empty($_SESSION['SESS_USER_MAINMODULE'])) 
				{	
					$MainAccsLvl =  explode(', ', '');
				}
				else
				{
					$MainAccsLvl = explode(', ', $_SESSION['SESS_USER_MAINMODULE']);
				}
				
				if(in_array('Inv', $MainAccsLvl)){
					echo '';
				} else { 
					echo 'd-none';
				}

			?>"
			style="background-color:#D0D0D0; ">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#inventory" aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-boxes nav-icon"></i>
          <span class="nav-module nav-module-span">Inventory</span>
        </a>
         <div id="inventory" class="collapse nav-collapse-parent" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner  nav-collapse-child">
            	<?php
									if(!isset($_SESSION['SESS_USER_MODULE']) && empty($_SESSION['SESS_USER_MODULE'])) 
									{	
										$AccsLvl =  explode(', ', '');
									}
									else
									{
										$AccsLvl = explode(', ', $_SESSION['SESS_USER_MODULE']);
									}
									
									echo (in_array('OIGN', $AccsLvl) ? '<a href="../../goods-receipt/templates/goods-receipt-document.php" class="collapse-item nav-collapse-a"><i class="far fa-window-maximize nav-collapse-i" ></i>Goods Receipt</a>' : '');	
									echo (in_array('OIGE', $AccsLvl) ? '<a href="../../goods-issue/templates/goods-issue-document.php" class="collapse-item nav-collapse-a"><i class="far fa-window-maximize nav-collapse-i" ></i>Goods Issue</a>' : '');
									echo (in_array('OWTR', $AccsLvl) ? '<a href="../../inventory-transfer/templates/inventory-transfer-document.php" class="collapse-item nav-collapse-a"><i class="far fa-window-maximize nav-collapse-i" ></i>Inventory Transfer</a>' : '');
									
								?>
          </div>
		  
        </div>
      </li>
       <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item nav-li 
			<?php
				if(!isset($_SESSION['SESS_USER_MAINMODULE']) && empty($_SESSION['SESS_USER_MAINMODULE'])) 
				{	
					$MainAccsLvl =  explode(', ', '');
				}
				else
				{
					$MainAccsLvl = explode(', ', $_SESSION['SESS_USER_MAINMODULE']);
				}
				
				if(in_array('GenSet', $MainAccsLvl)){
					echo '';
				} else { 
					echo 'd-none';
				}

			?>"
			style="background-color:#D0D0D0; ">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#addons" aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-puzzle-piece nav-icon"></i>
          <span class="nav-module nav-module-span">Add Ons</span>
        </a>
         <div id="addons" class="collapse nav-collapse-parent" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner  nav-collapse-child">
            	<?php
									if(!isset($_SESSION['SESS_USER_MODULE']) && empty($_SESSION['SESS_USER_MODULE'])) 
									{	
										$AccsLvl =  explode(', ', '');
									}
									else
									{
										$AccsLvl = explode(', ', $_SESSION['SESS_USER_MODULE']);
									}
									echo (in_array('ADDON', $AccsLvl) ? '<a href="../../addon-pctpuploader/templates/pctpuploader-document.php" class="collapse-item nav-collapse-a"><i class="far fa-window-maximize nav-collapse-i" ></i>PCTP Uploader 1</a>' : '');	
									echo (in_array('ADDON', $AccsLvl) ? '<a href="../../addon-pctpuploader2/templates/pctpuploader-document.php" class="collapse-item nav-collapse-a"><i class="far fa-window-maximize nav-collapse-i" ></i>PCTP Uploader 2</a>' : '');	
										echo (in_array('ADDON', $AccsLvl) ? '<a href="../../addon-pctpuploader-pricing/templates/pctpuploader-document.php" class="collapse-item nav-collapse-a"><i class="far fa-window-maximize nav-collapse-i" ></i>PCTP Pricing</a>' : '');	
							


									echo (in_array('ADDON', $AccsLvl) ? '<a href="../../addon-pctp-window/templates/addon-pctp-window-document.php" class="collapse-item nav-collapse-a"><i class="far fa-window-maximize nav-collapse-i" ></i>PCTP WINDOW (Beta)</a>' : '');
									echo (in_array('ADDON', $AccsLvl) ? '<a href="../../addon-pctp-window-test/templates/addon-pctp-window-document.php" class="collapse-item nav-collapse-a"><i class="far fa-window-maximize nav-collapse-i" ></i>PCTP WINDOW 10-01-TEST</a>' : '');
									echo (in_array('ADDON', $AccsLvl) ? '<a href="../../addon-pctp-window-dev/templates/addon-pctp-window-document.php" class="collapse-item nav-collapse-a d-none"><i class="far fa-window-maximize nav-collapse-i" ></i>PCTP WINDOW (Test)</a>' : '');	
									echo (in_array('ADDON', $AccsLvl) ? '<a href="../../addon-pctp-ptf/templates/addon-pctp-ptf-document.php" class="collapse-item nav-collapse-a"><i class="far fa-window-maximize nav-collapse-i" ></i>PTF Report</a>' : '');	
								?>
          </div>
		  
        </div>
      </li>
	   <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item nav-li d-none">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-wrench nav-icon"></i>
          <span class="nav-module nav-module-span">Service</span>
        </a>
       
      </li>
	   <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item nav-li d-none" >
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages" >
        <i class="fas fa-users-cog nav-icon"></i>
          <span class="nav-module nav-module-span" >Human Resources</span>
        </a>
        
      </li>
	  <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item nav-li d-none">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
         <i class="fas fa-chart-bar nav-icon"></i>
          <span class="nav-module nav-module-span">Reports</span>
        </a>
       
      </li>
      </div>
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
    
    </ul>
</div>
    <!-- End of Sidebar -->




    <!-- Payment Voucher Modal -->
    <div class="modal fade" id="paymentVoucherParameterModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-dialog modal-lg" role="document" style="width:100%">
        <!--Content-->
        <div class="modal-content-full-width modal-content">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
            <h4 class="modal-title w-100" id="myModalLabel" style="color:black">Payment Voucher Report</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->
          <div class="modal-body">
            <div class="form-group row my-1" >
                <label for="inputEmail3" class="col-sm-4 col-form-label py-1 mt-2" style="color: black;" >Enter Billing Period:</label>
                <div class="col-sm-6" >
                	  <input type="text" class="form-control pod" id="BillingPeriod" placeholder="" >
               </div>
            </div>
            <div class="form-group row my-1" >
                <label for="inputEmail3" class="col-sm-4 col-form-label py-1 mt-2" style="color: black;" >Enter Prepared By:</label>
                <div class="col-sm-6" >
                   <input type="text" class="form-control pod" id="PreparedBy" placeholder="" >
                </div>
            </div>
             <div class="form-group row my-1" >
                <label for="inputEmail3" class="col-sm-4 col-form-label py-1 mt-2" style="color: black;" >Enter Reviewed By:</label>
                <div class="col-sm-6" >
                   <input type="text" class="form-control pod" id="ReviewedBy" placeholder="" >
                </div>
            </div>
            <div class="form-group row my-1" >
                <label for="inputEmail3" class="col-sm-4 col-form-label py-1 mt-2" style="color: black;" >Enter Document Number:</label>
                <div class="col-sm-6" >
                   <input type="text" class="form-control pod" id="U_DocNum" placeholder="" >
                </div>
            </div>              
          </div>
          <!--Footer-->
          <div class="modal-footer">
          	<button type="button" id="btnPaymentVoucherReport" class="btn btn-secondary">Generate</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!--/.Content-->
      </div>
    </div>
    <!-- Payment Voucher Modal -->



    <!-- Payment Voucher Modal -->
    <div class="modal fade" id="paymentVoucherParameterModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-dialog modal-lg" role="document" style="width:100%">
        <!--Content-->
        <div class="modal-content-full-width modal-content">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
            <h4 class="modal-title w-100" id="myModalLabel" style="color:black">Payment Voucher Report</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->
          <div class="modal-body">
            <div class="form-group row my-1" >
                <label for="inputEmail3" class="col-sm-4 col-form-label py-1 mt-2" style="color: black;" >Enter Billing Period:</label>
                <div class="col-sm-6" >
                	  <input type="text" class="form-control pod" id="BillingPeriod2" placeholder="" >
               </div>
            </div>
            <div class="form-group row my-1" >
                <label for="inputEmail3" class="col-sm-4 col-form-label py-1 mt-2" style="color: black;" >Enter Prepared By:</label>
                <div class="col-sm-6" >
                   <input type="text" class="form-control pod" id="PreparedBy2" placeholder="" >
                </div>
            </div>
             <div class="form-group row my-1" >
                <label for="inputEmail3" class="col-sm-4 col-form-label py-1 mt-2" style="color: black;" >Enter Reviewed By:</label>
                <div class="col-sm-6" >
                   <input type="text" class="form-control pod" id="ReviewedBy2" placeholder="" >
                </div>
            </div>
            <div class="form-group row my-1" >
                <label for="inputEmail3" class="col-sm-4 col-form-label py-1 mt-2" style="color: black;" >Enter Document Number:</label>
                <div class="col-sm-6" >
                   <input type="text" class="form-control pod" id="U_DocNum2" placeholder="" >
                </div>
            </div>              
          </div>
          <!--Footer-->
          <div class="modal-footer">
          	<button type="button" id="btnPaymentVoucherReport2" class="btn btn-secondary">Generate</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!--/.Content-->
      </div>
    </div>
    <!-- Payment Voucher Modal -->

	<!-- Payment Voucher Modal -->
    <div class="modal fade" id="paymentVoucherParameterModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-dialog modal-lg" role="document" style="width:100%">
        <!--Content-->
        <div class="modal-content-full-width modal-content">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
            <h4 class="modal-title w-100" id="myModalLabel" style="color:black">Payment Voucher Report</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->
          <div class="modal-body">
            <div class="form-group row my-1" >
                <label for="inputEmail3" class="col-sm-4 col-form-label py-1 mt-2" style="color: black;" >Enter Billing Period:</label>
                <div class="col-sm-6" >
                	  <input type="text" class="form-control pod" id="BillingPeriod3" placeholder="" >
               </div>
            </div>
            <div class="form-group row my-1" >
                <label for="inputEmail3" class="col-sm-4 col-form-label py-1 mt-2" style="color: black;" >Enter Prepared By:</label>
                <div class="col-sm-6" >
                   <input type="text" class="form-control pod" id="PreparedBy3" placeholder="" >
                </div>
            </div>
             <div class="form-group row my-1" >
                <label for="inputEmail3" class="col-sm-4 col-form-label py-1 mt-2" style="color: black;" >Enter Reviewed By:</label>
                <div class="col-sm-6" >
                   <input type="text" class="form-control pod" id="ReviewedBy3" placeholder="" >
                </div>
            </div>
            <div class="form-group row my-1" >
                <label for="inputEmail3" class="col-sm-4 col-form-label py-1 mt-2" style="color: black;" >Enter Document Number:</label>
                <div class="col-sm-6" >
                   <input type="text" class="form-control pod" id="U_DocNum3" placeholder="" >
                </div>
            </div>              
          </div>
          <!--Footer-->
          <div class="modal-footer">
          	<button type="button" id="btnPaymentVoucherReport3" class="btn btn-secondary">Generate</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!--/.Content-->
      </div>
    </div>
    <!-- Payment Voucher Modal -->


	<!-- Payment Voucher Modal -->
    <div class="modal fade" id="paymentVoucherParameterModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-dialog modal-lg" role="document" style="width:100%">
        <!--Content-->
        <div class="modal-content-full-width modal-content">
          <!--Header-->
          <div class="modal-header"  style="background-color: #A8A8A8; border-bottom-width: thick; border-color: #f0ad4e;">
            <h4 class="modal-title w-100" id="myModalLabel" style="color:black">Payment Voucher Report</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!--Body-->
          <div class="modal-body">
            <div class="form-group row my-1" >
                <label for="inputEmail3" class="col-sm-4 col-form-label py-1 mt-2" style="color: black;" >Enter Billing Period:</label>
                <div class="col-sm-6" >
                	  <input type="text" class="form-control pod" id="BillingPeriod4" placeholder="" >
               </div>
            </div>
            <div class="form-group row my-1" >
                <label for="inputEmail3" class="col-sm-4 col-form-label py-1 mt-2" style="color: black;" >Enter Prepared By:</label>
                <div class="col-sm-6" >
                   <input type="text" class="form-control pod" id="PreparedBy4" placeholder="" >
                </div>
            </div>
             <div class="form-group row my-1" >
                <label for="inputEmail4" class="col-sm-4 col-form-label py-1 mt-2" style="color: black;" >Enter Reviewed By:</label>
                <div class="col-sm-6" >
                   <input type="text" class="form-control pod" id="ReviewedBy4" placeholder="" >
                </div>
            </div>
            <div class="form-group row my-1" >
                <label for="inputEmail4" class="col-sm-4 col-form-label py-1 mt-2" style="color: black;" >Enter Document Number:</label>
                <div class="col-sm-6" >
                   <input type="text" class="form-control pod" id="U_DocNum4" placeholder="" >
                </div>
            </div>              
          </div>
          <!--Footer-->
          <div class="modal-footer">
          	<button type="button" id="btnPaymentVoucherReport4" class="btn btn-secondary">Generate</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!--/.Content-->
      </div>
    </div>
    <!-- Payment Voucher Modal -->

    <script>
    	$(() => {

    		console.log('sidebar working')


			
			
			
			

				$(document.body).on('click', '#btnPaymentVoucherReport', function () 
				{
					var BillingPeriod = $('#BillingPeriod').val();
					var PreparedBy = $('#PreparedBy').val();
					var ReviewedBy = $('#ReviewedBy').val();
					var U_DocNum = $('#U_DocNum').val();
					console.log(BillingPeriod)
					console.log(PreparedBy)
					console.log(ReviewedBy)
					console.log(U_DocNum)
					// window.open("../forms/SOA-Red-Ribbon.php?docentry=" + encodeURI(docentry),"", "width=1130,height=550,left=220,top=110");

					if(U_DocNum != '')
					{

						window.open("../../../modules/purchasing-reports/payment-voucher/payment-voucher.php?BillingPeriod=" + encodeURI(BillingPeriod) + 
														"&PreparedBy=" + encodeURI(PreparedBy) +
														"&ReviewedBy=" + encodeURI(ReviewedBy) +
														"&U_DocNum=" + encodeURI(U_DocNum)
														,"", "width=1130,height=550,left=220,top=110");
					}
				});

				$(document.body).on('click', '#btnPaymentVoucherReport2', function () 
				{
					var BillingPeriod = $('#BillingPeriod2').val();
					var PreparedBy = $('#PreparedBy2').val();
					var ReviewedBy = $('#ReviewedBy2').val();
					var U_DocNum = $('#U_DocNum2').val();
					console.log(BillingPeriod)
					console.log(PreparedBy)
					console.log(ReviewedBy)
					console.log(U_DocNum)
					// window.open("../forms/SOA-Red-Ribbon.php?docentry=" + encodeURI(docentry),"", "width=1130,height=550,left=220,top=110");

					if(U_DocNum != '')
					{

						window.open("../../../modules/purchasing-reports/payment-voucher/payment-voucher2.php?BillingPeriod=" + encodeURI(BillingPeriod) + 
														"&PreparedBy=" + encodeURI(PreparedBy) +
														"&ReviewedBy=" + encodeURI(ReviewedBy) +
														"&U_DocNum=" + encodeURI(U_DocNum)
														,"", "width=1130,height=550,left=220,top=110");
					}
				});

				$(document.body).on('click', '#btnPaymentVoucherReport3', function () 
				{
					var BillingPeriod = $('#BillingPeriod3').val();
					var PreparedBy = $('#PreparedBy3').val();
					var ReviewedBy = $('#ReviewedBy3').val();
					var U_DocNum = $('#U_DocNum3').val();
					console.log(BillingPeriod)
					console.log(PreparedBy)
					console.log(ReviewedBy)
					console.log(U_DocNum)
					// window.open("../forms/SOA-Red-Ribbon.php?docentry=" + encodeURI(docentry),"", "width=1130,height=550,left=220,top=110");

					if(U_DocNum != '')
					{

						window.open("../../../modules/purchasing-reports/payment-voucher/payment-voucher3.php?BillingPeriod=" + encodeURI(BillingPeriod) + 
														"&PreparedBy=" + encodeURI(PreparedBy) +
														"&ReviewedBy=" + encodeURI(ReviewedBy) +
														"&U_DocNum=" + encodeURI(U_DocNum)
														,"", "width=1130,height=550,left=220,top=110");
					}
				});

				$(document.body).on('click', '#btnPaymentVoucherReport4', function () 
				{
					var BillingPeriod = $('#BillingPeriod4').val();
					var PreparedBy = $('#PreparedBy4').val();
					var ReviewedBy = $('#ReviewedBy4').val();
					var U_DocNum = $('#U_DocNum4').val();
					console.log(BillingPeriod)
					console.log(PreparedBy)
					console.log(ReviewedBy)
					console.log(U_DocNum)
					// window.open("../forms/SOA-Red-Ribbon.php?docentry=" + encodeURI(docentry),"", "width=1140,height=550,left=220,top=110");

					if(U_DocNum != '')
					{

						window.open("../../../modules/purchasing-reports/payment-voucher/payment-voucher4.php?BillingPeriod=" + encodeURI(BillingPeriod) + 
														"&PreparedBy=" + encodeURI(PreparedBy) +
														"&ReviewedBy=" + encodeURI(ReviewedBy) +
														"&U_DocNum=" + encodeURI(U_DocNum)
														,"", "width=1130,height=550,left=220,top=110");
					}
				});
					
					
					
    	})
    </script>