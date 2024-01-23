<?php 
session_start(); 
include_once('../../../config/config.php');	
if(!isset($_SESSION['SESS_USERID']) && empty($_SESSION['SESS_USERID'])) 
{
  header("Location: ../../login/login.php");
}
$GenSet = '';

?>

<!-- Sidebar -->
<div id="sideBarMenu" style="padding:10px;  " class="d-none">
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar" style="background-color:white; width:280px !important">

      <!-- Sidebar - Brand -->
     
	<div class="row">
		<div class="col-lg-9">
			<div class="sidebar-brand-text mx-3 my-1" style="font-weight:bold; color: Black; "><?php 
									$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
											SELECT CompnyName FROM OADM");
													
									while (odbc_fetch_row($qry)) 
									{
										echo odbc_result($qry, 'CompnyName');
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
	  <div id="navModules">
			
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
									echo (in_array('OLIC', $AccsLvl) ? '<a href="../../license/templates/license-document.php" class="collapse-item nav-collapse-a"  ><i class="far fa-window-maximize nav-collapse-i" ></i>License</a>' : '');
							
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
	  
	   	 <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item nav-li d-none" >
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
       <i class="fas fa-coins nav-icon"></i>
          <span class="nav-module nav-module-span">Banking</span>
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
				
				if(in_array('Inv', $MainAccsLvl)){
					echo '';
				} else { 
					echo 'd-none';
				}

			?> "
			
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
									
								
									echo (in_array('OWTR', $AccsLvl) ? '<a href="../../inventory-transfer/templates/inventory-transfer-document.php" class="collapse-item nav-collapse-a"><i class="far fa-window-maximize nav-collapse-i" ></i>Inventory Transfer</a>' : '');
									
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