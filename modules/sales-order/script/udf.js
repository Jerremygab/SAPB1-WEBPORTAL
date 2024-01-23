$(document).ready(function () {
let mainTable = 'ORDR';

		$('#udfResult').load('../proc/views/udf/vw_generateUDF.php?mainTable=' + mainTable,function (){
			
				$('#udfResult select').each(function () 
				{
					let fieldId = $(this).attr('fieldId');
					let dflt = $(this).attr('default');
					
					let that = $(this);
					$.ajax({
						type: 'GET',
						url: '../proc/views/udf/vw_generateUDFValidValues.php',
						data: {
								mainTable : mainTable,
								fieldId : fieldId,
								},
						success: function (html) 
						{
							
							that.append(html);
						
							
						}
					});
				});
		});
		$(document.body).on('keyup', '.inputUdf', function () 
		{
			if($(this).attr('type') == 'text' && $(this).attr('table') == ''){	
				let value = $(this).val();
				$(this).parent().find('.udfcode').val(value);
			}
		});
		$(document.body).on('change', '.inputUdf', function () 
		{
			if($(this).attr('type') == 'date' && $(this).attr('table') == ''){	
				let value = $(this).val();
				$(this).parent().find('.udfcode').val(value);
			}
		});
		$(document.body).on('click', 'div.udfdiv', function () 
		{
			$('.selected-udf').map(function () 
			{
				$(this).removeClass('selected-udf');
			  
			})
		$(this).closest('div').addClass('selected-udf');
		
		
    });
	$('#udfModal').on('shown.bs.modal',function(){
		let udfTable =  $('.selected-udf').find('input.inputUdf').attr('table');
		
			$.ajax({
				type: 'GET',
				url: '../proc/views/udf/vw_udfTable.php',
				data: {udfTable : udfTable},
				success: function (html) 
				{
					$('#udfModalResult').html(html);
				}
			});
			$.ajax({
				type: 'GET',
				url: '../proc/views/udf/vw_udfTableDescription.php',
				data: {udfTable : udfTable},
				success: function (html) 
				{
					$('#udfModalTitle').html(html);
				}
			});
	});
	$(document.body).on('change', '.selectUdf', function () 
	{
		let option = $(this).find('option:selected').val();
		$(this).parent().find('.udfcode').val(option);
		
	});
	$(document.body).on('dblclick', '#tblUdf tbody > tr', function () 
	{
		
		var udfCode = $(this).children('td.item-1').text();
        var udfName = $(this).children('td.item-2').text();
	
		

        $('#udfModal').modal('hide');
	
		$('.selected-udf').find('input.udfcode').val(udfCode);
		$('.selected-udf').find('input.udfname').val(udfName);
       
    });
 });