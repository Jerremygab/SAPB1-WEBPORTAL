$(document).ready(function () {

let branch = 67;
let month = $('#selMonth').val();
let year = $('#selYear').val();
let counter = 31;
const Months1 = ["1", "3", "5","7","8","10","12"];
const Months2 = ["4", "6", "9","11"];
const Months3 = ["2"];

 	$.ajax({
		type: 'GET',
		url: '../proc/views/sales-data/vw_year.php',
		success: function(data)
		{	
				
				//alert($(this).find('td.item-2').html())
				$('#selYear').append(data)
		
		
			
		}
		});


	let interval;
	let timer = function(){
 		interval = setInterval(function(){
  			GenerateData();
	},2000);
};
// setInterval(function() {
		
// },3000) 

	$(document.body).on('dblclick', '#tblBranch tbody > tr', function () 
	{
		let id = $(this).children('td.item-1').text();
		let code = $(this).children('td.item-2').text();
        let name = $(this).children('td.item-3').text();

        $('#branchModal').modal('hide');

		$('#txtBPLId').val(id);
		$('#txtBranchCode').val(code).css({'background-color': '', 'border-radius': '0px'});
		$('#txtBranchName').val(name).css({'background-color': '', 'border-radius': '0px'});
		clearInterval(interval);
  		//timer()
		GenerateData();
			
    });
    $(document.body).on('change', '#selMonth', function () 
	{
		Days();
		clearInterval(interval);
		GenerateData();
			
    });
    $(document.body).on('change', '#selYear', function () 
	{
		Days();
		clearInterval(interval);
		GenerateData();
			
    });

  

function Days(){
	if(jQuery.inArray($('#selMonth').val(), Months1) !== -1){
    		counter = 31;

    		$('#tblSalesData tbody tr.day29').removeClass('d-none');
			$('#tblSalesData tbody tr.day30').removeClass('d-none');
			$('#tblSalesData tbody tr.day31').removeClass('d-none');

    }else if(jQuery.inArray($('#selMonth').val(), Months2) !== -1){
    		counter = 30;

    		$('#tblSalesData tbody tr.day29').removeClass('d-none');
			$('#tblSalesData tbody tr.day30').removeClass('d-none');
			$('#tblSalesData tbody tr.day31').addClass('d-none');
    }else if(jQuery.inArray($('#selMonth').val(), Months3) !== -1){
    
		let z = $('#selYear').val() % 4;
		if(z == 0){
			counter = 29;

			$('#tblSalesData tbody tr.day29').removeClass('d-none');
			$('#tblSalesData tbody tr.day30').addClass('d-none');
			$('#tblSalesData tbody tr.day31').addClass('d-none');
		}
		else{
			counter = 28;

			$('#tblSalesData tbody tr.day29').addClass('d-none');
			$('#tblSalesData tbody tr.day30').addClass('d-none');
			$('#tblSalesData tbody tr.day31').addClass('d-none');
		}
    }
}
    
 

function GenerateData(){


	let txtUsername = $('#usercode').text();
	let txtPassword = $('#userpassword').text();
	let active = '';
	 branch = $('#txtBPLId').val();
	 month = $('#selMonth').val();
	 year = $('#selYear').val();
		

// $(document.body).on('click', '#btnGo', function () 
//{		

	
	$('#tblSalesData tbody tr').each(function (i ) 
	{
		if(i <= 31){


			let day = i;
			//alert(branch + '/' + month + '/' + year + '/' + day)
			$.ajax({
			type: 'GET',
			url: '../proc/views/sales-data/vw_foodsales.php',
			data: 
			{
					
					branch : branch,
					month : month,
					year : year,
					day : day,
			},
			success: function(data)
			{	
					
					//alert($(this).find('td.item-2').html())
					$('#tblSalesData tbody tr.day' + i).find('td.item-2').text(data)
				
			}
			});
			$.ajax({
			type: 'GET',
			url: '../proc/views/sales-data/vw_scdiscount.php',
			data: 
			{
					
					branch : branch,
					month : month,
					year : year,
					day : day,
			},
			success: function(data)
			{
				
					$('#tblSalesData tbody tr.day' + i).find('td.item-3').text(data)
			
				
			}
			});
			$.ajax({
			type: 'GET',
			url: '../proc/views/sales-data/vw_pwddiscount.php',
			data: 
			{
					
					branch : branch,
					month : month,
					year : year,
					day : day,
			},
			success: function(data)
			{
				
					$('#tblSalesData tbody tr.day' + i).find('td.item-4').text(data)
			
				
			}
			});
			$.ajax({
			type: 'GET',
			url: '../proc/views/sales-data/vw_otherdisc.php',
			data: 
			{
					
					branch : branch,
					month : month,
					year : year,
					day : day,
			},
			success: function(data)
			{
				
					$('#tblSalesData tbody tr.day' + i).find('td.item-7').text(data)
			
				
			}
			});
			
			$.ajax({
			type: 'GET',
			url: '../proc/views/sales-data/vw_deliverycharge.php',
			data: 
			{
					
					branch : branch,
					month : month,
					year : year,
					day : day,
			},
			success: function(data)
			{
				
					$('#tblSalesData tbody tr.day' + i).find('td.item-5').text(data)
			
				
			}
			});
			$.ajax({
			type: 'GET',
			url: '../proc/views/sales-data/vw_netsales.php',
			data: 
			{
					
					branch : branch,
					month : month,
					year : year,
					day : day,
			},
			success: function(data)
			{
				
					$('#tblSalesData tbody tr.day' + i).find('td.item-6').text(data)
			
				
			}
			});	
		}
	
	
		
		});

}	


/* setInterval(function() {
	$.ajax({
		type: 'POST',
		url: '../proc/exec/exec-update-login4.php',
		success: function(html)
		{
			
		}
		});
	
},15000) */


/* $(document.body).on('click', 'div:not(#discButtons)', function () 
{
	let txtUsername = $('#usercode').text();
	let txtPassword = $('#userpassword').text();
	let active = '';
	
	
	$.ajax({
		type: 'GET',
		url: '../proc/views/utilities/vw_active.php',
		data: 
		{
				
				txtUsername : txtUsername,
				txtPassword : txtPassword
		},
		success: function(data)
		{
			active = data;
			if(active == '0'){
				$('#disconnectedModal').modal('show');
			}
			else{
				
			}
			
		}
		});
		
}); */		
let theme = $('#theme').text();
if (theme == 1){
	
}
else if (theme == 2){
	$('#body').css('background-image', 'linear-gradient(to right bottom, #f2f7f8, #b5eafc, #bfebe0)');
}
$(document.body).on('click', '#pop', function () 
{
                //$("#dialog").dialog({modal: true, height: 590, width: 1005 });
                var w = window.open("", "popupWindow", "width=600, height=400, scrollbars=yes");
                var $w = $(w.document.body);
                $w.html("<textarea></textarea>");
            });
$(document.body).on('click', '#btnContinueConfirm', function () 
{
	
	let txtUsername = $('#usercode').text();
	let txtPassword = $('#userpassword').text();
	
	
	$.ajax({
		type: 'POST',
		url: '../proc/exec/exec-update-login2.php',
		data: 
		{
				
				txtUsername : txtUsername,
				txtPassword : txtPassword
		},
		success: function(html)
		{
			
		}
		});
});
$(document.body).on('click', '#btnNotContinueConfirm', function () 
{
	
	let txtUsername = $('#usercode').text();
	let txtPassword = $('#userpassword').text();
	
	
	$.ajax({
		type: 'POST',
		url: '../proc/exec/exec-update-login3.php',
		data: 
		{
				
				txtUsername : txtUsername,
				txtPassword : txtPassword
		},
		success: function(html)
		{
			
		}
		});
		$.ajax({
		type: 'GET',
		url: '../proc/views/utilities/vw_logout.php',
		success: function (html) 
		{
			window.location.reload();
		}
	}); 
});

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
	clearInterval(interval);
	
	$('#logoutModal').modal('show');
});
$(document.body).on('click', '#btnCancelLogout', function () 
{
	clearInterval(interval);
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


});