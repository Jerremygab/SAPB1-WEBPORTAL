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
									echo (in_array('ADDON', $AccsLvl) ? '<a href="../../addons/templates/addons-document.php" class="collapse-item nav-collapse-a"  ><i class="far fa-window-maximize nav-collapse-i" ></i>Add On</a>' : '');

							
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
									echo (in_array('ODPI', $AccsLvl) || true ? '<a href="../../ar-down-payment/templates/ar-down-payment-document.php?modId=0" class="collapse-item nav-collapse-a"><i class="far fa-window-maximize nav-collapse-i" ></i>A/R DP Request</a>' : '');
									echo (in_array('ODPI', $AccsLvl) || true ? '<a href="../../ar-down-payment/templates/ar-down-payment-document.php?modId=1" class="collapse-item nav-collapse-a"><i class="far fa-window-maximize nav-collapse-i" ></i>A/R DP Invoice</a>' : '');
									
									
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
									echo (in_array('OPOR', $AccsLvl) ? '<a href="../../purchase-order/templates/purchase-order-document.php" class="collapse-item nav-collapse-a"><i class="far fa-window-maximize nav-collapse-i" ></i>Purchase Order</a>' : '');
									echo (in_array('OPDN', $AccsLvl) ? '<a href="../../goods-receipt-PO/templates/goods-receipt-PO-document.php" class="collapse-item nav-collapse-a"><i class="far fa-window-maximize nav-collapse-i" ></i>Goods Receipt PO</a>' : '');
									echo (in_array('OPCH', $AccsLvl) || true ? '<a href="../../ap-invoice/templates/ap-invoice-document.php" class="collapse-item nav-collapse-a"><i class="far fa-window-maximize nav-collapse-i" ></i>A/P Invoice</a>' : '');
									echo (in_array('ODPO', $AccsLvl) || true ? '<a href="../../ap-down-payment/templates/ap-down-payment-document.php?modId=0" class="collapse-item nav-collapse-a"><i class="far fa-window-maximize nav-collapse-i" ></i>A/P DP Request</a>' : '');
									echo (in_array('ODPO', $AccsLvl) || true ? '<a href="../../ap-down-payment/templates/ap-down-payment-document.php?modId=1" class="collapse-item nav-collapse-a"><i class="far fa-window-maximize nav-collapse-i" ></i>A/P DP Invoice</a>' : '');
									
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

			?>"
			style="background-color:#D0D0D0; ">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#banking" aria-expanded="true" aria-controls="collapsePages">
         <i class="fas fa-coins nav-icon"></i>
          <span class="nav-module nav-module-span" >Banking</span>
        </a>
     
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
									
								
										echo (in_array('ORCT', $AccsLvl) ? '<a href="../../incoming-payments/templates/incoming-payment-document.php" class="collapse-item nav-collapse-a"><i class="far fa-window-maximize nav-collapse-i" ></i>Incoming Payments</a>' : '');
										echo (in_array('OVPM', $AccsLvl) ? '<a href="../../outgoing-payments/templates/outgoing-payment-document.php" class="collapse-item nav-collapse-a"><i class="far fa-window-maximize nav-collapse-i" ></i>Outgoing Payments</a>' : '');
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
				
				if(in_array('Inv', $MainAccsLvl)){
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
									
									echo (in_array('ADDON', $AccsLvl) ? '<a href="../../addon-ap-uploader/templates/ap-uploader-document.php" class="collapse-item nav-collapse-a"><i class="far fa-window-maximize nav-collapse-i" ></i>RPOLL Uploader</a>' : '');	
									echo (in_array('ADDON', $AccsLvl) ? '<a href="../../addon-transOut/templates/addon-transOut-document.php" class="collapse-item nav-collapse-a"><i class="far fa-window-maximize nav-collapse-i" ></i>Transfer Out</a>' : '');
									echo (in_array('ADDON', $AccsLvl) ? '<a href="../../addon-transIn/templates/addon-transIn-document.php" class="collapse-item nav-collapse-a"><i class="far fa-window-maximize nav-collapse-i" ></i>Transfer In</a>' : '');
									echo (in_array('ADDON', $AccsLvl) ? '<a href="../../addon-wastage/templates/addon-wastage-document.php" class="collapse-item nav-collapse-a"><i class="far fa-window-maximize nav-collapse-i" ></i>Wastage</a>' : '');
									echo (in_array('ADDON', $AccsLvl) ? '<a href="../../addon-royalties/templates/addon-royalties-document.php" class="collapse-item nav-collapse-a"><i class="far fa-window-maximize nav-collapse-i" ></i>Royalties</a>' : '');
									echo (in_array('ADDON', $AccsLvl) ? '<a href="../../addon-jws/templates/addon-jws-document.php" class="collapse-item nav-collapse-a"><i class="far fa-window-maximize nav-collapse-i" ></i>JWS Uploader</a>' : '');
									echo (in_array('ADDON', $AccsLvl) ? '<a href="../../addon-incoming-payments/templates/addon-incoming-payments-document.php" class="collapse-item nav-collapse-a"><i class="far fa-window-maximize nav-collapse-i" ></i>Incoming Payments</a>' : '');
									
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