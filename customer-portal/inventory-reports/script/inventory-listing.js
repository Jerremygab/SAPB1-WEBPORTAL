$(document).ready(function () {

$('#pageTitle').text('Inventory Listing | SAP B1');
$(document.body).on('click', '#sideBarToggle', function () 
{
	if($('#sideBarMenu').hasClass('d-none') == false){
		$('#sideBarMenu').addClass('d-none');
		$('#topBarToggle').removeClass('d-none');
		$('#iconArrowRight').removeClass('d-none');
		$('#iconArrowLeft').addClass('d-none');
	}
	else{
		$('#sideBarMenu').removeClass('d-none');
		$('#topBarToggle').addClass('d-none');
		$('#iconArrowRight').addClass('d-none');
		$('#iconArrowLeft').removeClass('d-none');
	}
});
$(document.body).on('click', '#btnBack', function (){
	window.location.replace('../../dashboard/templates/dashboard.php');
});
$(document.body).on('click', '#btnLogout', function () 
{
	$('#logoutModal').modal('show');
});
$(document.body).on('click', '#btnLogoutConfirm', function () 
{
	$('#logoutModal').modal('hide');
	$.ajax({
		type: 'GET',
		url: '../proc/views/utilities/vw_logout.php',
		success: function (html) 
		{
			window.location.reload();
		}
	}); 
});
$(document.body).on('click', '#makeOrder', function () 
{
	
	window.open('../../sales-order/templates/sales-order-document.php', '_blank');
});
$(document.body).on('click', '#inventoryList', function () 
{
	
	window.open('../../reports/inventory-reports/templates/inventory-listing-document.php', '_blank');
});

$('#salesOrderModal').on('shown.bs.modal',function(){
		
		
			$.ajax({
				type: 'GET',
				url: '../../sales-order/templates/sales-order-document.php',
			
				success: function (html) 
				{
					$('#salesOrder').html(html);
				}
			});
		
	});
	
});