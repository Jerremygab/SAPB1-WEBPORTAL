$(document).ready(function () {

$('#pageTitle').text('Connected Clients | SAP B1');	

	$(document.body).on('click', '#tblConnected tbody > tr', function () 
	{
		//$(this).closest('tr').find('td').css("background-color", "#fdfd96");
		 //$(this).closest('tr').addClass('selected-batch-available');
		
		
		
		if($(this).closest('tr').hasClass("selected-client")){
			
			$(this).closest('tr').removeClass('selected-client');
			$(this).closest('tr').find('td').css("background-color", "white");
		}
		else{
			if (window.event.ctrlKey) 
			{
				
				$(this).closest('tr').css("background-color", "#fdfd96");
				$(this).closest('tr').addClass('selected-client');
				
			}
			else
			{
				/* $('.selected-client').map(function () 
				{
					$(this).removeClass('selected-client');
					
					$(this).closest('tr').find('td').css("background-color", "#fdfd96");
					
				}) */
				
				//$('#tblConnected tbody > tr').find('td').css("background-color", "white");
				$(this).closest('tr').find('td').css("background-color", "#696969");
				
				$(this).closest('tr').addClass('selected-client');
			} 
		}
      
		
    });
	$(document.body).on('click', '#btnDisconnect', function () 
	{
		
		
		let err = 0;
		let json = '{';
        let otArr = [];
       $('#tblConnected tbody tr.selected-client').each(function(i)
		{
            x = $(this).children();
            let itArr = [];
			
				
					itArr.push('"' + $(this).find('td.item-2').text() + '"');
				
					
				otArr.push('"' + i + '": [' + itArr.join(',') + ']'); 
				
			
			
		
		});
		
		json += otArr.join(",") + '}';
		
		if (err == 0) 
		{
			$('#loadModal').modal('show');
            $.ajax({
                type: 'POST',
                url: '../proc/exec/exec_disconnect.php',
				data: 
				{
					json: json.replace(/(\r\n|\n|\r)/gm, '[newline]'),
					
                },
			    success: function (data) 
				{
					let res = $.parseJSON(data);
					
					if(res.valid == true)
					{
						$('#messageBar2').addClass('d-none');
						$('#messageBar3').removeClass('d-none');
						$('#messageBar').text(res.msg).css({'background-color': '#00FF7F', 'color': 'black'});
						
						
							setTimeout(function()
							{
								$('#messageBar').text('').css({'background-color': '', 'color': ''});	
								
							window.location.replace("../templates/users-connected-clients-document.php");
							},3000)
					}
					else
					{
						$('#messageBar2').addClass('d-none');
						$('#messageBar3').removeClass('d-none');
						$('#messageBar').text(res.msg).css({'background-color': 'red', 'color': 'white'});
						
							setTimeout(function()
							{
								$('#messageBar').text('').css({'background-color': '', 'color': ''});	
								
							},5000)
					}
					$('#loadModal').modal('hide');
                }
            });
        }
	});
	
});