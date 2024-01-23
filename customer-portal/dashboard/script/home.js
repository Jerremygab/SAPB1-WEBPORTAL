$(document).ready(function () {

$('#pageTitle').text('Home | SAP B1');
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
	$.getJSON('../proc/views/vw_getBPDetails.php', function (data){
		
			let cardCode;
		
		
		
		  $.each(data, function (key, val){
				
			cardCode = val.CardCode;
		
		
		  });
		  
		  	sessionStorage.setItem("cardCode", cardCode);
			
			
			
		  
		window.open('../../sales-order/templates/sales-order-document.php', '_blank');
		
	});
});
$(document.body).on('click', '#inventoryList', function () 
{
	
	window.open('../../inventory-reports/templates/inventory-listing-document.php', '_blank');
});

$(document.body).on('dblclick', '#tblDoc tbody > tr', function () 
{
	
	var docNum = $(this).children('td.item-3').text();
	var objType = 17;
	
	sessionStorage.setItem("docNum", docNum);
	sessionStorage.setItem("objType", objType);
	
	
	window.open('../../sales-order/templates/sales-order-document.php', '_blank');
       
});

	
});