
$(document).ready(function () {

    $('#pageTitle').text('User Management | SAP B1');	
    

 
//TopBar
$(document.body).on('click', '#btnFirstRecord', function (){
	
	let docNum = '';
	
	$.getJSON('../proc/views/vw_getFirstEntry.php', function (data){
		docNum = data;
		PreviewDoc(docNum);
	});
});
$(document.body).on('click', '#btnPrevRecord', function (){
	
	let docNum = $('#txtUserId').val();
	
	if(docNum != ''){
		$.getJSON('../proc/views/vw_getPrevEntry.php?docNum=' + docNum, function (data){
			docNum = data;
			PreviewDoc(docNum);
		});
	}
	else{
			$.getJSON('../proc/views/vw_getLastEntry.php', function (data){
			docNum = data;
			PreviewDoc(docNum);
		});
	}
});
$(document.body).on('click', '#btnNextRecord', function (){
	
	let docNum = $('#txtUserId').val();
	
	if(docNum != ''){
		$.getJSON('../proc/views/vw_getNextEntry.php?docNum=' + docNum, function (data){
			docNum = data;
			PreviewDoc(docNum);
		});
	}
	else{
			$.getJSON('../proc/views/vw_getFirstEntry.php', function (data){
			docNum = data;
			PreviewDoc(docNum);
		});
	}
});
$(document.body).on('click', '#btnLastRecord', function (){
	
	let docNum = '';
	$.getJSON('../proc/views/vw_getLastEntry.php', function (data){
		docNum = data;
		PreviewDoc(docNum);
	});
});
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

$(document.body).on('click','#btnNew',function()
{
	window.location.reload();
})
$(document.body).on('click','#btnCancel',function()
{
	window.location.replace('../../dashboard/templates/dashboard.php')

})
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
	})
	})
});
