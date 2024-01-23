$(document).ready(function () {
	
	$(document.body).on('click', '#btnLogout', function () 
	{
		$.ajax({
				type: 'GET',
				url: 'proc/exec/exec_logout.php',
				success: function (html) 
				{
					
					
				}
			}); 
	});
	
	
});