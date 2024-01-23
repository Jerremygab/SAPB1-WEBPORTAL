$(document).ready(function () {
let mainTable = 'OPOR';
let objectType = 0;
$('#pageTitle').text('Approval Template | SAP B1');	
setTimeout(function()
	{
		$('#txtPostingDate').trigger('change');
		$('#txtDeliveryDate').trigger('change');
		$('#txtDocumentDate').trigger('change');
	},1000);
//TopBar
$(document.body).on('click', '#btnFirstRecord', function (){
	let table = 'OPOR';
	let docNum = '';
	let objType = 22;
	$.getJSON('../proc/views/vw_getFirstEntry.php?table=' + table, function (data){
		docNum = data;
		PreviewDoc(docNum,objType);
	});
});
$(document.body).on('click', '#btnPrevRecord', function (){
	let table = 'OPOR';
	let objType = 22;
	let docNum = $('#txtDocNum').val();
	if(docNum != ''){
		$.getJSON('../proc/views/vw_getPrevEntry.php?table=' + table + '&docNum=' + docNum, function (data){
			docNum = data;
			PreviewDoc(docNum,objType);
		});
	}
	else{
			$.getJSON('../proc/views/vw_getLastEntry.php?table=' + table, function (data){
			docNum = data;
			PreviewDoc(docNum,objType);
		});
	}
});
$(document.body).on('click', '#btnNextRecord', function (){
	let table = 'OPOR';
	let objType = 22;
	let docNum = $('#txtDocNum').val();
	if(docNum != ''){
		$.getJSON('../proc/views/vw_getNextEntry.php?table=' + table + '&docNum=' + docNum, function (data){
			docNum = data;
			PreviewDoc(docNum,objType);
		});
	}
	else{
			$.getJSON('../proc/views/vw_getFirstEntry.php?table=' + table, function (data){
			docNum = data;
			PreviewDoc(docNum,objType);
		});
	}
});
$(document.body).on('click', '#btnLastRecord', function (){
	let docNum = $('#txtDocNum').val();
	$.getJSON('../proc/views/vw_getLastEntry.php?docNum=' + docNum, function (data){
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
$(document.body).on('click', '#btnUDF', function () 
{
	if($('#containerUDF').hasClass('d-none') == false){
		$('#containerSystem').removeClass('col-lg-9');
		$('#containerUDF').removeClass('col-lg-3');
		$('#containerSystem').addClass('col-lg-12');
		$('#containerUDF').addClass('d-none');
		
		$('#bpCol').removeClass('col-lg-4');
		$('#midCol').removeClass('col-lg-4');
		$('#dateCol').removeClass('col-lg-4');
		
		$('#bpCol').addClass('col-lg-5');
		$('#midCol').addClass('col-lg-4');
		$('#dateCol').addClass('col-lg-3');
		
	}
	else{
		$('#containerSystem').removeClass('col-lg-12');
		$('#containerSystem').addClass('col-lg-9');
		$('#containerUDF').addClass('col-lg-3');
		$('#containerUDF').removeClass('d-none');
		
		$('#bpCol').removeClass('col-lg-5');
		$('#midCol').removeClass('col-lg-4');
		$('#dateCol').removeClass('col-lg-3');
		
		$('#bpCol').addClass('col-lg-5');
		$('#midCol').addClass('col-lg-3');
		$('#dateCol').addClass('col-lg-4');
		
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
	}); 
});
//delete row
var otArrLineNum = [];
$(document.body).on('click', '.deleterow', function () 
{
	let rowno = $('.selected-det').find('.rowno span').text();
	let lineno = $('.selected-det').find('.lineno').val();
	let linenum = $('.selected-det').find('.linenum').val();
	let itemcode = $('#tblDetails tbody tr:last').find('td.rowno span').text()
		// if ($('.selected-det').find('input.lineo').val() != ''){
		// 	otArrLineNum.push($('.selected-det').find('input.visorder').val());
		// }
		if ($('.selected-det').find('input.linenum').val() != ''){
			otArrLineNum.push("'" +$('.selected-det').find('input.linenum').val() + "'" + ',');
			
		}
	otArrLineNum.join(",");
		$('.selected-det').remove();
		
		var rowno2 = 1;
		$('#tblDetails tbody tr').each(function () 
		{
			$(this).find('td.rowno span').text(rowno2);
			rowno2 += 1;
		});
});

let txtCurrency = 'PHP';	
var fadeDelay = 1000;
	var fadeDuration = 1000;
	

   
	
var contextMenu = CtxMenu('#content');

 contextMenu.addItem("Item 1", function(){
  // fired on click
});

 
contextMenu.addSeparator();

var serviceType = 'I';
//Validations
	$('#txtCardCode').focus();

var serviceType = 'I';
//Validations
	$('#txtCardCode').focus();

/*Load Tabs*/
	//Contents
	$('#contents-tab').load('../templates/approval-template-lines.php'), function (){
		
	};



	
//Matrix Cell Effects
	
	$(document.body).on('focus', 'input, select, textarea', function (){
		
		$(this).css({'outline': 'none', 'background-color': '#fdfd96'});
		//$(this).closest('td').css('background-color', '#fdfd96');
		$(this).closest('span').show();
	
		
	});
	$(document.body).on('blur', 'input, select, textarea', function (){
		$(this).css({'outline': 'none', 'background-color': ''});
		//$(this).closest('td').css('background-color', '');
		$(this).closest('span').hide();
		
	});
	$(document.body).on('click', 'button', function (){
		
		$(this).removeClass('d-none');
		$(this).siblings('input').focus();
	});
	
//Selecting Row
	$(document.body).on('click', '#tblDetails tbody > tr > td.rowno', function () 
	{
        if (window.event.ctrlKey) 
		{
			if ($(this).closest('tr').hasClass('selected-det')) 
			{
                $(this).closest('tr').css("background-color", "transparent");
                $(this).closest('tr').removeClass('selected-det');
				console.log('1');
            }
			else 
			{
                $(this).closest('tr').css("background-color", "lightgray");
                $(this).closest('tr').addClass('selected-det');
				console.log('2');
            }
        }
		else 
		{
            $('.selected-det').map(function () 
			{
				$(this).closest('tr').css("background-color", "transparent");
                $(this).removeClass('selected-det');
				console.log('3');
            })

            $('#tblDetails tbody > tr').css("background-color", "transparent");
			$(this).closest('tr').css("background-color", "lightgray");
            $(this).closest('tr').addClass('selected-det');
			console.log('4');
        }
		
    });
	$(document.body).on('click', '#tblDetails > tbody tr > td > div.input-group', function () 
	{
		$('input').css('background-color', '');
        $('.selected-det').map(function () 
		{
            $(this).removeClass('selected-det');
            $(this).css("background-color", "transparent");
        })
		
        $(this).closest('tr').css("background-color", "lightgray");
        $(this).closest('tr').addClass('selected-det');
		
		$(this).children('input').css('background-color', '#fdfd96');
		
    });
	$(document.body).on('focus', '#tblDetails input, #tblDetails select, #tblDetails textarea', function () 
	{
        if (window.event.ctrlKey) 
		{
            $(this).closest('tr').css("background-color", "lightgray");
            $(this).closest('tr').addClass('selected-det');
        }
		else
		{
            $('.selected-det').map(function () 
			{
                $(this).removeClass('selected-det');
            })

            $('#tblDetails tbody > tr').css("background-color", "transparent");
            $(this).closest('tr').css("background-color", "lightgray");
            $(this).closest('tr').addClass('selected-det');
        }
		
    });
	
//Double Clicks
	$(document.body).on('dblclick', '#tblDoc tbody > tr', function () 
	{
		
		var docNum = $(this).children('td.item-2').text();
		var objType = 22;
        $('#documentModal').modal('hide');
		
		$('#txtDocNum').val(docNum);
		
		$('#btnAdd').addClass('d-none');
		$('#btnUpdate').removeClass('d-none');
		
		PreviewDoc(docNum, objType);
       
    });
	$(document.body).on('dblclick', '#tblPR tbody > tr', function () 
	{
		
		var docNum = $(this).children('td.item-1').text();
		var objType = 1470000113;
		
        $('#purchaseRequestModal').modal('hide');
		
		$('#txtBaseEntry').val(docNum);
		
		$('#btnAdd').removeClass('d-none');
		$('#btnUpdate').addClass('d-none');
		
		PreviewDoc(docNum, objType);
       
    });
	
	
	
	$(document.body).on('dblclick', '#tblApprover tbody > tr', function () 
	{
		
		var empid = $(this).children('td.item-1').text();
        var empname = $(this).children('td.item-2').text();
	
		
		$('.btnrowfunctions').removeClass('d-none');

        $('#ApproverModal').modal('hide');
	
		$('.selected-det').find('input.approverid').val(empid);
        $('.selected-det').find('input.approvername').val(empname);
		
		AddRowTemplate();
   
    });
	
	
//Click
	
	$(document.body).on('focus', 'div.input-group', function () 
	{
		
		$(this).children('input').css('background-color', '#fdfd96');
	
    });
	$(document.body).on('blur', 'div.input-group', function () 
	{
		
		$(this).children('input').css('background-color', '');
    });
	$(document.body).on('click', '#drpSeries > div.dropdown-menu > option', function () 
	{
		
		let seriesName = $(this).val();
		$('#txtSeries').val(seriesName);
		
		setTimeout(function () 
			{
				$('#txtSeries').css('background-color', '');
				
            }, 100) 
			
    });

	
//Submit
	//Add
	$(document.body).on('click', '#btnAdd', function () 
	{
		var err = 0;
        var errmsg = '';
		if($('#txtApprovalTemplateCode').val() == '' ){
			err = 1;
			$('#messageBar2').addClass('d-none');
						$('#messageBar3').removeClass('d-none');
						$('#messageBar').text('Input Approval Template Code').css({'background-color': 'red', 'color': 'white'});
						
							setTimeout(function()
							{
								$('#messageBar').text('').css({'background-color': '', 'color': ''});	
								$('#messageBar2').removeClass('d-none');
							},5000)
		}
		else if($('#txtApprovalTemplateName').val() == '' ){
			err = 1;
			$('#messageBar2').addClass('d-none');
						$('#messageBar3').removeClass('d-none');
						$('#messageBar').text('Input Approval Template Description').css({'background-color': 'red', 'color': 'white'});
						
							setTimeout(function()
							{
								$('#messageBar').text('').css({'background-color': '', 'color': ''});	
								$('#messageBar2').removeClass('d-none');
							},5000)
		}
		
		var txtCode = $('#txtApprovalTemplateCode').val();
		var txtDescription = $('#txtApprovalTemplateName').val();
		var txtDocNum = $('#txtDocNum').val();
		
		var chkActive = '';
		
		if($('#chkActive').is(':checked')) {
			chkActive = 'Y';
		}
		else{
			chkActive = 'N';
		}
	
		var json = '{';
        var otArr = [];
        var tbl = $('#tblDetails tbody tr').each(function (i) 
		{
            x = $(this).children();
            var itArr = [];
			

				if ($(this).find('input.approverid').val() != ''){
					itArr.push('"' + $(this).find('td.rowno span').text() + '"');
					itArr.push('"' + $(this).find('input.approverid').val() + '"');
					itArr.push('"' + $(this).find('input.approvername').val() + '"');
				
				otArr.push('"' + i + '": [' + itArr.join(',') + ']'); 
				}
			
		});
		
		json += otArr.join(",") + '}';


		
		
		console.log(json)
		if (err == 0) 
		{
			
			$('#loadModal').modal('show');
            $.ajax({
                type: 'POST',
                url: '../proc/exec/exec_add_approval-template.php',
				data: 
				{
					json: json.replace(/(\r\n|\n|\r)/gm, '[newline]'),
					txtCode : txtCode,
					txtDescription : txtDescription,
					txtDocNum : txtDocNum,
					chkActive : chkActive
				
                },
			    success: function (data) 
				{
					var res = $.parseJSON(data);
					
					if(res.valid == true)
					{
						$('#messageBar2').addClass('d-none');
						$('#messageBar3').removeClass('d-none');
						$('#messageBar').text(res.msg).css({'background-color': '#00FF7F', 'color': 'black'});
						
						
							setTimeout(function()
							{
								$('#messageBar').text('').css({'background-color': '', 'color': ''});	
								
							window.location.replace("../templates/approval-template-document.php");
							$('#loadModal').modal('hide');
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
								$('#loadModal').modal('hide');
							},5000)
					}
					
                }
            });
        }
		else 
		{
			$('#messageBar').val('Out of bounds').css({'background-color': 'red', 'color': 'white'});
				setTimeout(function()
				{
					$('#messageBar').val('').css({'background-color': '', 'color': ''});	
				},5000)
        }


    });
//Update	
	$(document.body).on('click', '#btnUpdate', function () 
	{
		var err = 0;
        var errmsg = '';
		
		if($('#tblDetails tbody tr').find('input.itemcode').val() == '' ){
			err = 1;
			$('#messageBar2').addClass('d-none');
						$('#messageBar3').removeClass('d-none');
						$('#messageBar').text('No item!').css({'background-color': 'red', 'color': 'white'});
						
							setTimeout(function()
							{
								$('#messageBar').text('').css({'background-color': '', 'color': ''});	
								$('#messageBar2').removeClass('d-none');
							},5000)
		}
		else if($('#tblDetails tbody tr').find('input.glaccount').val() == '' ){
			err = 1;
			$('#messageBar2').addClass('d-none');
						$('#messageBar3').removeClass('d-none');
						$('#messageBar').text('No GL Account!').css({'background-color': 'red', 'color': 'white'});
						
							setTimeout(function()
							{
								$('#messageBar').text('').css({'background-color': '', 'color': ''});	
								$('#messageBar2').removeClass('d-none');
							},5000)
		}
		if(err == 0){
		
		var txtCode = $('#txtApprovalTemplateCode').val();
		var txtDescription = $('#txtApprovalTemplateName').val();
		var txtDocNum = $('#txtDocNum').val();
        if (err == 0) 
		{
			otArrLineNum.push("''");
			$('#loadModal').modal('show');
            $.ajax({
                type: 'POST',
                url: '../proc/exec/exec_update_approval-template.php',
				data: 
				{
					txtCode : txtCode,
					txtDocNum : txtDocNum,
					otArrLineNum : otArrLineNum,
					txtDescription : txtDescription,
                },
			    success: function (data) 
				{
					var res = $.parseJSON(data);
					
					if(res.valid == true)
					{
						$('#messageBar2').addClass('d-none');
						$('#messageBar3').removeClass('d-none');
						$('#messageBar').text(res.msg).css({'background-color': '#00FF7F', 'color': 'black'});
						
						
							setTimeout(function()
							{
								$('#messageBar').text('').css({'background-color': '', 'color': ''});	
								
								window.location.reload();
							},1000)
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
		else 
		{
			$('#messageBar').val('Out of bounds').css({'background-color': 'red', 'color': 'white'});
				setTimeout(function()
				{
					$('#messageBar').val('').css({'background-color': '', 'color': ''});	
				},5000)
        }
		}
    });



//------------------------------------------------------------------------------------------------------------------------------------------------------------------		
/*Functions --------------------------------------------------------------------------------------------------------------------------------------------------------*/
//------------------------------------------------------------------------------------------------------------------------------------------------------------------		
	function AddRow(){
		
		var rowno = 0;
			rowno = ($('#tblDetails tbody tr:last').find('td.rowno span').text() == '') ? 1 : parseFloat($('#tblDetails tbody tr:last').find('td.rowno span').text()) + 1;
		var lastItem = $('#tblDetails tbody tr:last').find('input.approverid').val()
		
		if(lastItem != ""){
		setTimeout(function () 
			{
					
						$('#rowLoader').load('../templates/approval-template-lines-row.php', function (result) 
						{
							$('#tblDetails tbody').append(result);

							$('#tblDetails tbody tr:last').find('td.rowno span').text(rowno);
						})
			
							$(this).prop('disabled', false);
					
					
			}, 200)
		}
	}
	function AddRowTemplate(){
		
		var rowno = 0;
			rowno = ($('#tblDetails tbody tr:last').find('td.rowno span').text() == '') ? 1 : parseFloat($('#tblDetails tbody tr:last').find('td.rowno span').text()) + 1;
		var lastItem = $('#tblDetails tbody tr:last').find('input.approverid').val()
		
		if(lastItem != ""){
		setTimeout(function () 
			{
					
						$('#rowLoader').load('../templates/approval-template-lines-row.php', function (result) 
						{
							$('#tblDetails tbody').append(result);

							$('#tblDetails tbody tr:last').find('td.rowno span').text(rowno);
						})
			
							$(this).prop('disabled', false);
					
					
			}, 200)
		}
	}
	
	function PreviewDoc(docNum){
		
		$.getJSON('../proc/views/vw_getheaderdata.php?docNum=' + docNum, function (data){
            $.each(data, function (key, val){
				$('#txtApprovalTemplateCode').val(val.Code);
				$('#txtApprovalTemplateName').val(val.Description);
				$('#txtDocNum').val(val.DocEntry);
				if(val.Active == 'Y'){
					$('#chkActive').attr('checked',true)
				}else{
					$('#chkActive').attr('checked',false)
				}
			});
			
			setTimeout(function () 
			{
				PreviewRows(docNum,function () 
				{
					
				});
				
            }, 500) 
			
			
		});
		
		
	}
	function PreviewRows(docNum,callback){
        $('#tblDetails tbody').load('../proc/views/vw_getdetailsdata.php?docNum=' + docNum, function (result) 
		{
            callback();
		});
	}
});
