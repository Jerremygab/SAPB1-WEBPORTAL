$(document).ready(function () {
let mainTable = 'OPOR';
let objectType = 0;
let codeofapp = '';
let viewing = 0;
$('#pageTitle').text('Approval | SAP B1');	
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
	let table = 'OPOR';
	let docNum = '';
	let objType = 22;
	$.getJSON('../proc/views/vw_getLastEntry.php?table=' + table, function (data){
		docNum = data;
		PreviewDoc(docNum,objType);
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
var otArrLineNumEmp = [];
$(document.body).on('click', '.deleterowemployee', function () 
{
	let rowno = $('#tblUsers tbody tr.selected-det').find('.rowno span').text();
	let lineno = $('#tblUsers tbody tr.selected-det').find('.lineno').val();
	let itemcode = $('#tblUsers tbody tr:last').find('td.rowno span').text()
		if ($('#tblUsers tbody tr.selected-det').find('input.lineno').val() != ''){
			otArrLineNumEmp.push($('#tblUsers tbody tr.selected-det').find('input.visorder').val());
		}
	otArrLineNumEmp.join(",");
	
		$('#tblUsers tbody tr.selected-det').remove();
		
		var rowno2 = 1;
		$('#tblUsers tbody tr').each(function () 
		{
			$(this).find('td.rowno span').text(rowno2);
			rowno2 += 1;
		});
			ComputeFooterTotalBeforeDiscount();
			ComputeFooterTaxAmount();
			ComputeTotal();
});
var otArrLineNumApprover = [];
$(document.body).on('click', '.deleterowapprover', function () 
{
	let rowno = $('#tblTemplate tbody tr.selected-det').find('.rowno span').text();
	let lineno = $('#tblTemplate tbody tr.selected-det').find('.lineno').val();
	let itemcode = $('#tblTemplate tbody tr:last').find('td.rowno span').text()
		if ($('#tblTemplate tbody tr.selected-det').find('input.lineno').val() != ''){
			otArrLineNumApprover.push($('#tblTemplate tbody tr.selected-det').find('input.visorder').val());
		}
	otArrLineNumApprover.join(",");
	
		$('#tblTemplate tbody tr.selected-det').remove();
		
		var rowno2 = 1;
		$('#tblTemplate tbody tr').each(function () 
		{
			$(this).find('td.rowno span').text(rowno2);
			rowno2 += 1;
		});
			ComputeFooterTotalBeforeDiscount();
			ComputeFooterTaxAmount();
			ComputeTotal();
});
var otArrLineNumQuery = [];
$(document.body).on('click', '.deleterowquery', function () 
{
	let rowno = $('#tblQueries tbody tr.selected-det').find('.rowno span').text();
	let lineno = $('#tblQueries tbody tr.selected-det').find('.lineno').val();
	let itemcode = $('#tblQueries tbody tr:last').find('td.rowno span').text()
		if ($('#tblQueries tbody tr.selected-det').find('input.lineno').val() != ''){
			otArrLineNumQuery.push($('#tblQueries tbody tr.selected-det').find('input.visorder').val());
		}
	otArrLineNumQuery.join(",");
	
		$('#tblQueries tbody tr.selected-det').remove();
		
		var rowno2 = 1;
		$('#tblQueries tbody tr').each(function () 
		{
			$(this).find('td.rowno span').text(rowno2);
			rowno2 += 1;
		});
			ComputeFooterTotalBeforeDiscount();
			ComputeFooterTaxAmount();
			ComputeTotal();
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
	$('#contents-tab').load('../templates/approval-lines.php'), function (){
		
	};

	//Queries
	$('#queries-tab').load('../templates/approval-queries-lines.php'), function (){
		
	};


	//Users
	$('#users-tab').load('../templates/approval-user-stage-lines.php'), function (){
		
	};

	//Approval Template
	$('#approval-template-tab').load('../templates/approval-template-stage-lines.php'), function (){
		
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
    //APPROVAL STAGES
    $(document.body).on('click', '#tblTemplate tbody > tr > td.rowno', function () 
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

            $('#tblTemplate tbody > tr').css("background-color", "transparent");
			$(this).closest('tr').css("background-color", "lightgray");
            $(this).closest('tr').addClass('selected-det');
			console.log('4');
        }
		
    });
	$(document.body).on('click', '#tblTemplate > tbody tr > td > div.input-group', function () 
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
	$(document.body).on('focus', '#tblTemplate input, #tblTemplate select, #tblTemplate textarea', function () 
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

            $('#tblTemplate tbody > tr').css("background-color", "transparent");
            $(this).closest('tr').css("background-color", "lightgray");
            $(this).closest('tr').addClass('selected-det');
        }
		
    });
    //USER
    $(document.body).on('click', '#tblUsers tbody > tr > td.rowno', function () 
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

            $('#tblUsers tbody > tr').css("background-color", "transparent");
			$(this).closest('tr').css("background-color", "lightgray");
            $(this).closest('tr').addClass('selected-det');
			console.log('4');
        }
		
    });
	$(document.body).on('click', '#tblUsers > tbody tr > td > div.input-group', function () 
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
	$(document.body).on('focus', '#tblUsers input, #tblUsers select, #tblUsers textarea', function () 
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

            $('#tblUsers tbody > tr').css("background-color", "transparent");
            $(this).closest('tr').css("background-color", "lightgray");
            $(this).closest('tr').addClass('selected-det');
        }
		
    });

    //QUERIES
    $(document.body).on('click', '#tblQueries tbody > tr > td.rowno', function () 
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

            $('#tblQueries tbody > tr').css("background-color", "transparent");
			$(this).closest('tr').css("background-color", "lightgray");
            $(this).closest('tr').addClass('selected-det');
			console.log('4');
        }
		
    });
	$(document.body).on('click', '#tblQueries > tbody tr > td > div.input-group', function () 
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
	$(document.body).on('focus', '#tblQueries input, #tblQueries select, #tblQueries textarea', function () 
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

            $('#tblQueries tbody > tr').css("background-color", "transparent");
            $(this).closest('tr').css("background-color", "lightgray");
            $(this).closest('tr').addClass('selected-det');
        }
		
    });
    
	
//Double Clicks
	$(document.body).on('dblclick', '#tblApproval tbody > tr', function () 
	{
		viewing = 1;
		var code = $(this).children('td.item-1').text().trim();
       	$('#btnCreateNew').trigger('click');
		
		
       codeofapp = code;

    });
    $(document.body).on('click', '#btnCreateNew', function () 
	{
		if(viewing == 1){

       		codeofapp = '';	
		}	
		
    });
     $('#approvalModal').on('shown.bs.modal',function(){
		
		var code = codeofapp;
		console.log(code)
		
		if(code != '')
		{
			PreviewDoc(code);
		}
		else{
			resetFieldsCreation();
		}
		
	}); 
	$(document.body).on('dblclick', '#tblDoc tbody > tr', function () 
	{
		
		var docNum = $(this).children('td.item-1').text();
		var objType = 22;
        $('#documentModal').modal('hide');
		
		$('#txtDocNum').val(docNum);
		
		$('#btnAdd').addClass('d-none');
		$('#btnUpdate').removeClass('d-none');
		
		PreviewDoc(docNum, objType);
       
    });
    $(document.body).on('dblclick', '#tblTemplateApproval tbody > tr', function () 
	{
		
		var approvalstageid = $(this).children('td.item-1').text();
        var approvalstagename = $(this).children('td.item-2').text();
	
		

		$('.btnrowfunctionstemplate').removeClass('d-none');

        $('#ApprovalStageModal').modal('hide');
	
		$('#tblTemplate tbody tr.selected-det ').find('input.approvalstageid').val(approvalstageid);
        $('#tblTemplate tbody tr.selected-det ').find('input.approvalstagename').val(approvalstagename);
		
		AddRowTemplate();
    });
    $(document.body).on('dblclick', '#tblUserApproval tbody > tr', function () 
	{
		
		var userid = $(this).children('td.item-1').text();
        var username = $(this).children('td.item-2').text();
		$('.btnrowfunctionsusers').removeClass('d-none');

        $('#UseraApprovalStageModal').modal('hide');
	
		$('#tblUsers tbody tr.selected-det ').find('input.userid').val(userid);
       	$('#tblUsers tbody tr.selected-det ').find('input.username').val(username);
		
		AddRowUser();
    });
    $(document.body).on('dblclick', '#tblQuery tbody > tr', function () 
	{
		
		var intrnalkey = $(this).children('td.item-1').text();
        var qname = $(this).children('td.item-2').text();
        var qtype = $(this).children('td.item-3').text();
		$('.btnrowfunctionsquery').removeClass('d-none');

        $('#queryModal').modal('hide');
		
		

		$('#tblQueries tbody tr.selected-det ').find('input.intrnalkey').val(intrnalkey);
       	$('#tblQueries tbody tr.selected-det ').find('input.qname').val(qname);
       	$('#tblQueries tbody tr.selected-det ').find('input.qtype').val(qtype);
		
		AddRowQuery();
    });

    

//Click
	//Check / Uncheck
	$(document.body).on('click', '#GenSet', function () 
	{
		$('#GenSet > .indetermine').addClass('d-none');
		if($('#GenSet > .checked').hasClass('d-none')){
			$('#GenSet > .checked').removeClass('d-none');
			$(this).css('background-color','#ADD8E6');
			
			$('.gensub > .checked-sub').removeClass('d-none');
			$('.gensub').css('background-color','#ADD8E6');
		
		}else{
			$('#GenSet > .checked').addClass('d-none');
			$('#GenSet > .indetermine').addClass('d-none');
			$('.gensub > .checked-sub').addClass('d-none');
			$('.gensub > .checked-sub').addClass('d-none');
			
			
			$(this).css('background-color','white');
			$('.gensub').css('background-color','white');
		}
	});
	//Check / Uncheck
	$(document.body).on('click', '#Fin', function () 
	{
		$('#Fin > .indetermine').addClass('d-none');
		if($('#Fin > .checked').hasClass('d-none')){
			$('#Fin > .checked').removeClass('d-none');
			$(this).css('background-color','#ADD8E6');
			
			$('.finsub > .checked-sub').removeClass('d-none');
			$('.finsub').css('background-color','#ADD8E6');
		
		}else{
			$('#Fin > .checked').addClass('d-none');
			$('#Fin > .indetermine').addClass('d-none');
			$('.finsub > .checked-sub').addClass('d-none');
			$('.finsub > .checked-sub').addClass('d-none');
			
			
			$(this).css('background-color','white');
			$('.finsub').css('background-color','white');
		}
	});
	//Check / Uncheck
	$(document.body).on('click', '#Inv', function () 
	{
		$('#Inv > .indetermine').addClass('d-none');
		if($('#Inv > .checked').hasClass('d-none')){
			$('#Inv > .checked').removeClass('d-none');
			$(this).css('background-color','#ADD8E6');
			
			$('.invsub > .checked-sub').removeClass('d-none');
			$('.invsub').css('background-color','#ADD8E6');
		
		}else{
			$('#Inv > .checked').addClass('d-none');
			$('#Inv > .indetermine').addClass('d-none');
			$('.invsub > .checked-sub').addClass('d-none');
			$('.invsub > .checked-sub').addClass('d-none');
			
			
			$(this).css('background-color','white');
			$('.invsub').css('background-color','white');
		}
	});
	//Check / Uncheck
	$(document.body).on('click', '#Sales', function () 
	{
		$('#Sales > .indetermine').addClass('d-none');
		if($('#Sales > .checked').hasClass('d-none')){
			$('#Sales > .checked').removeClass('d-none');
			$(this).css('background-color','#ADD8E6');
			
			$('.salessub > .checked-sub').removeClass('d-none');
			$('.salessub').css('background-color','#ADD8E6');
		
		}else{
			$('#Sales > .checked').addClass('d-none');
			$('#Sales > .indetermine').addClass('d-none');
			$('.salessub > .checked-sub').addClass('d-none');
			$('.salessub > .checked-sub').addClass('d-none');
			
			
			$(this).css('background-color','white');
			$('.salessub').css('background-color','white');
		}
	});
	//Check / Uncheck
	$(document.body).on('click', '#Purch', function () 
	{
		$('#Purch > .indetermine').addClass('d-none');
		if($('#Purch > .checked').hasClass('d-none')){
			$('#Purch > .checked').removeClass('d-none');
			$(this).css('background-color','#ADD8E6');
			
			$('.purchsub > .checked-sub').removeClass('d-none');
			$('.purchsub').css('background-color','#ADD8E6');
		
		}else{
			$('#Purch > .checked').addClass('d-none');
			$('#Purch > .indetermine').addClass('d-none');
			$('.purchsub > .checked-sub').addClass('d-none');
			$('.purchsub > .checked-sub').addClass('d-none');
			
			
			$(this).css('background-color','white');
			$('.purchsub').css('background-color','white');
		}
	});
	//Check / Uncheck
	$(document.body).on('click', '#Bank', function () 
	{
		$('#Bank > .indetermine').addClass('d-none');
		if($('#Bank > .checked').hasClass('d-none')){
			$('#Bank > .checked').removeClass('d-none');
			$(this).css('background-color','#ADD8E6');
			
			$('.banksub > .checked-sub').removeClass('d-none');
			$('.banksub').css('background-color','#ADD8E6');
		
		}else{
			$('#Bank > .checked').addClass('d-none');
			$('#Bank > .indetermine').addClass('d-none');
			$('.banksub > .checked-sub').addClass('d-none');
			$('.banksub > .checked-sub').addClass('d-none');
			
			
			$(this).css('background-color','white');
			$('.banksub').css('background-color','white');
		}
	});
	//GenSet Sub
	$(document.body).on('click', '#CANCEL', function () 
	{

		if($('#CANCEL > .checked-sub').hasClass('d-none')){
			$('#CANCEL > .checked-sub').removeClass('d-none');
			$(this).css('background-color','#ADD8E6');
			GenSetCheckBoxChecked();
			
		
		}
		
		else{
			$('#CANCEL > .checked-sub').addClass('d-none');
			$('#CANCEL > .checked-sub').addClass('d-none');
			$(this).css('background-color','white');
			GenSetCheckBoxChecked();
		}
	
	});
	$(document.body).on('click', '#CLOSING', function () 
	{
		if($('#CLOSING > .checked-sub').hasClass('d-none')){
			$('#CLOSING > .checked-sub').removeClass('d-none');
			$(this).css('background-color','#ADD8E6');
			GenSetCheckBoxChecked();
			
		
		}
		
		else{
			$('#CLOSING > .checked-sub').addClass('d-none');
			$('#CLOSING > .checked-sub').addClass('d-none');
			$(this).css('background-color','white');
			GenSetCheckBoxChecked();
		}
	
	});
	$(document.body).on('click', '#ADDON', function () 
	{
		if($('#ADDON > .checked-sub').hasClass('d-none')){
			$('#ADDON > .checked-sub').removeClass('d-none');
			$(this).css('background-color','#ADD8E6');
			GenSetCheckBoxChecked();
			
		
		}
		
		else{
			$('#ADDON > .checked-sub').addClass('d-none');
			$('#ADDON > .checked-sub').addClass('d-none');
			$(this).css('background-color','white');
			GenSetCheckBoxChecked();
		}
	
	});
	$(document.body).on('click', '#APPR', function () 
	{
		if($('#APPR > .checked-sub').hasClass('d-none')){
			$('#APPR > .checked-sub').removeClass('d-none');
			$(this).css('background-color','#ADD8E6');
			GenSetCheckBoxChecked();
			
		
		}
		
		else{
			$('#ADDON > .checked-sub').addClass('d-none');
			$('#ADDON > .checked-sub').addClass('d-none');
			$(this).css('background-color','white');
			GenSetCheckBoxChecked();
		}
	
	});
	$(document.body).on('click', '#APPT', function () 
	{
		if($('#APPT > .checked-sub').hasClass('d-none')){
			$('#APPT > .checked-sub').removeClass('d-none');
			$(this).css('background-color','#ADD8E6');
			GenSetCheckBoxChecked();
			
		
		}
		
		else{
			$('#ADDON > .checked-sub').addClass('d-none');
			$('#ADDON > .checked-sub').addClass('d-none');
			$(this).css('background-color','white');
			GenSetCheckBoxChecked();
		}
	
	});
	//Fin Sub
	$(document.body).on('click', '#OJDT', function () 
	{
		if($('#OJDT > .checked-sub').hasClass('d-none')){
			$('#OJDT > .checked-sub').removeClass('d-none');
			$(this).css('background-color','#ADD8E6');
			InvCheckBoxChecked();
			
		
		}
		
		else{
			$('#OJDT > .checked-sub').addClass('d-none');
			$('#OJDT > .checked-sub').addClass('d-none');
			$(this).css('background-color','white');
			InvCheckBoxChecked();
		}
	
	});
	//Inv Sub
	$(document.body).on('click', '#OIGN', function () 
	{
		if($('#OIGN > .checked-sub').hasClass('d-none')){
			$('#OIGN > .checked-sub').removeClass('d-none');
			$(this).css('background-color','#ADD8E6');
			InvCheckBoxChecked();
			
		
		}
		
		else{
			$('#OIGN > .checked-sub').addClass('d-none');
			$('#OIGN > .checked-sub').addClass('d-none');
			$(this).css('background-color','white');
			InvCheckBoxChecked();
		}
	
	});
	$(document.body).on('click', '#OIGE', function () 
	{
		if($('#OIGE > .checked-sub').hasClass('d-none')){
			$('#OIGE > .checked-sub').removeClass('d-none');
			$(this).css('background-color','#ADD8E6');
			InvCheckBoxChecked();
			
		
		}
		
		else{
			$('#OIGE > .checked-sub').addClass('d-none');
			$('#OIGE > .checked-sub').addClass('d-none');
			$(this).css('background-color','white');
			InvCheckBoxChecked();
		}
	
	});
	$(document.body).on('click', '#OWTR', function () 
	{
		if($('#OWTR > .checked-sub').hasClass('d-none')){
			$('#OWTR > .checked-sub').removeClass('d-none');
			$(this).css('background-color','#ADD8E6');
			InvCheckBoxChecked();
			
		
		}
		
		else{
			$('#OWTR > .checked-sub').addClass('d-none');
			$('#OWTR > .checked-sub').addClass('d-none');
			$(this).css('background-color','white');
			InvCheckBoxChecked();
		}
	
	});
	//Sales Sub
	$(document.body).on('click', '#OQUT', function () 
	{
		if($('#OQUT > .checked-sub').hasClass('d-none')){
			$('#OQUT > .checked-sub').removeClass('d-none');
			$(this).css('background-color','#ADD8E6');
			SalesCheckBoxChecked();
			
		
		}
		
		else{
			$('#OQUT > .checked-sub').addClass('d-none');
			$('#OQUT > .checked-sub').addClass('d-none');
			$(this).css('background-color','white');
			SalesCheckBoxChecked();
		}
	
	});
	$(document.body).on('click', '#ORDR', function () 
	{
		if($('#ORDR > .checked-sub').hasClass('d-none')){
			$('#ORDR > .checked-sub').removeClass('d-none');
			$(this).css('background-color','#ADD8E6');
			SalesCheckBoxChecked();
			
		
		}
		
		else{
			$('#ORDR > .checked-sub').addClass('d-none');
			$('#ORDR > .checked-sub').addClass('d-none');
			$(this).css('background-color','white');
			SalesCheckBoxChecked();
		}
	
	});
	$(document.body).on('click', '#ODLN', function () 
	{
		if($('#ODLN > .checked-sub').hasClass('d-none')){
			$('#ODLN > .checked-sub').removeClass('d-none');
			$(this).css('background-color','#ADD8E6');
			SalesCheckBoxChecked();
			
		
		}
		
		else{
			$('#ODLN > .checked-sub').addClass('d-none');
			$('#ODLN > .checked-sub').addClass('d-none');
			$(this).css('background-color','white');
			SalesCheckBoxChecked();
		}
	
	});
	$(document.body).on('click', '#OINV', function () 
	{
		if($('#OINV > .checked-sub').hasClass('d-none')){
			$('#OINV > .checked-sub').removeClass('d-none');
			$(this).css('background-color','#ADD8E6');
			SalesCheckBoxChecked();
			
		
		}
		
		else{
			$('#OINV > .checked-sub').addClass('d-none');
			$('#OINV > .checked-sub').addClass('d-none');
			$(this).css('background-color','white');
			SalesCheckBoxChecked();
		}
	
	});
	
	//Purchase Sub
	$(document.body).on('click', '#OPRQ', function () 
	{
		if($('#OPRQ > .checked-sub').hasClass('d-none')){
			$('#OPRQ > .checked-sub').removeClass('d-none');
			$(this).css('background-color','#ADD8E6');
			PurchCheckBoxChecked();
			
		
		}
		
		else{
			$('#OPRQ > .checked-sub').addClass('d-none');
			$('#OPRQ > .checked-sub').addClass('d-none');
			$(this).css('background-color','white');
			PurchCheckBoxChecked();
		}
	
	});
	$(document.body).on('click', '#OPOR', function () 
	{
		if($('#OPOR > .checked-sub').hasClass('d-none')){
			$('#OPOR > .checked-sub').removeClass('d-none');
			$(this).css('background-color','#ADD8E6');
			PurchCheckBoxChecked();
			
		
		}
		
		else{
			$('#OPOR > .checked-sub').addClass('d-none');
			$('#OPOR > .checked-sub').addClass('d-none');
			$(this).css('background-color','white');
			PurchCheckBoxChecked();
		}
	
	});
	$(document.body).on('click', '#OPDN', function () 
	{
		if($('#OPDN > .checked-sub').hasClass('d-none')){
			$('#OPDN > .checked-sub').removeClass('d-none');
			$(this).css('background-color','#ADD8E6');
			PurchCheckBoxChecked();
			
		
		}
		
		else{
			$('#OPDN > .checked-sub').addClass('d-none');
			$('#OPDN > .checked-sub').addClass('d-none');
			$(this).css('background-color','white');
			PurchCheckBoxChecked();
		}
	
	});
	$(document.body).on('click', '#OPCH', function () 
	{
		if($('#OPCH > .checked-sub').hasClass('d-none')){
			$('#OPCH > .checked-sub').removeClass('d-none');
			$(this).css('background-color','#ADD8E6');
			PurchCheckBoxChecked();
			
		
		}
		
		else{
			$('#OPCH > .checked-sub').addClass('d-none');
			$('#OPCH > .checked-sub').addClass('d-none');
			$(this).css('background-color','white');
			PurchCheckBoxChecked();
		}
	
	});

	//Banking Module
	$(document.body).on('click', '#ORCT', function () 
	{
		if($('#ORCT > .checked-sub').hasClass('d-none')){
			$('#ORCT > .checked-sub').removeClass('d-none');
			$(this).css('background-color','#ADD8E6');
			BankCheckBoxChecked();
			
		
		}
		
		else{
			$('#ORCT > .checked-sub').addClass('d-none');
			$('#ORCT > .checked-sub').addClass('d-none');
			$(this).css('background-color','white');
			BankCheckBoxChecked();
		}
	
	});
	$(document.body).on('click', '#OVPM', function () 
	{
		if($('#OVPM > .checked-sub').hasClass('d-none')){
			$('#OVPM > .checked-sub').removeClass('d-none');
			$(this).css('background-color','#ADD8E6');
			BankCheckBoxChecked();
			
		
		}
		
		else{
			$('#OVPM > .checked-sub').addClass('d-none');
			$('#OVPM > .checked-sub').addClass('d-none');
			$(this).css('background-color','white');
			BankCheckBoxChecked();
		}
	
	});
	
//Submit
	//Add
	$(document.body).on('click', '#btnAdd', function () 
	{
		var err = 0;
        var errmsg = '';
		if($('#txtCode').val() == '' ){
			err = 1;
			$('#messageBar2').addClass('d-none');
						$('#messageBar3').removeClass('d-none');
						$('#messageBar').text('Input Approval Code').css({'background-color': 'red', 'color': 'white'});
						
							setTimeout(function()
							{
								$('#messageBar').text('').css({'background-color': '', 'color': ''});	
								$('#messageBar2').removeClass('d-none');
							},5000)
		}
		else if($('#txtDescription').val() == '' ){
			err = 1;
			$('#messageBar2').addClass('d-none');
						$('#messageBar3').removeClass('d-none');
						$('#messageBar').text('Input Approval Description').css({'background-color': 'red', 'color': 'white'});
						
							setTimeout(function()
							{
								$('#messageBar').text('').css({'background-color': '', 'color': ''});	
								$('#messageBar2').removeClass('d-none');
							},5000)
		}
	
		

		
		var txtCode = $('#txtCode').val();
		var txtDescription = $('#txtDescription').val();
		var chkActive = '';
		var txtNumberofApprovals = $('#txtNumberofApprovals').val();
		var txtNumberofDisapprovals = $('#txtNumberofDisapprovals').val();
		
		if($('#chkActive').is(':checked')) {
			chkActive = 'Y';
		}
		else{
			chkActive = 'N';
		}
	
		


		var chkModule = new Array();
		$('.subModule').each(function() 
		{
		
			if(!$(this).find(".checked-sub").hasClass('d-none')){
				chkModule.push($(this).attr('id'));
			}
			else{
				
			}
			
		});
		
		var jsonQuery = '{';
        var otArrQuery = [];
        var tbl = $('#tblQueries tbody tr').each(function (i) 
		{
            x = $(this).children();
            var itArr = [];
			

				if ($(this).find('input.qname').val() != ''){
					itArr.push('"' + $(this).find('td.rowno span').text() + '"');
					itArr.push('"' + $(this).find('input.intrnalkey').val() + '"');
					itArr.push('"' + $(this).find('input.qname').val() + '"');
				
				otArrQuery.push('"' + i + '": [' + itArr.join(',') + ']'); 
				}
			
		});
		
		jsonQuery += otArrQuery.join(",") + '}';

		var jsonUser = '{';
        var otArrUser = [];
        var tbl = $('#tblUsers tbody tr').each(function (i) 
		{
            x = $(this).children();
            var itArr = [];

				if ($(this).find('input.userid').val() != ''){
					itArr.push('"' + $(this).find('td.rowno span').text() + '"');
					itArr.push('"' + $(this).find('input.userid').val() + '"');
					itArr.push('"' + $(this).find('input.username').val() + '"');
				
				otArrUser.push('"' + i + '": [' + itArr.join(',') + ']'); 
				}
			
		});
		
		jsonUser += otArrUser.join(",") + '}';

		var jsonTemplate = '{';
        var otArrTemplate = [];
        var tbl = $('#tblTemplate tbody tr').each(function (i) 
		{
            x = $(this).children();

            var itArr = [];
				if ($(this).find('input.approvalstageid').val() != ''){
					itArr.push('"' + $(this).find('td.rowno span').text() + '"');
					itArr.push('"' + $(this).find('input.approvalstageid').val() + '"');
					itArr.push('"' + $(this).find('input.approvalstagename').val() + '"');
				
				otArrTemplate.push('"' + i + '": [' + itArr.join(',') + ']'); 
				}
			
		});
		
		jsonTemplate += otArrTemplate.join(",") + '}';


		console.log(jsonQuery)
		console.log(jsonUser)
		console.log(jsonTemplate)
		console.log(chkModule)

		if (err == 0) 
		{
			
			$('#loadModal').modal('show');
            $.ajax({
                type: 'POST',
                url: '../proc/exec/exec_add_approval.php',
				data: 
				{
					jsonQuery: jsonQuery.replace(/(\r\n|\n|\r)/gm, '[newline]'),
					jsonUser: jsonUser.replace(/(\r\n|\n|\r)/gm, '[newline]'),
					jsonTemplate: jsonTemplate.replace(/(\r\n|\n|\r)/gm, '[newline]'),
					txtCode : txtCode,
					txtDescription : txtDescription,
					chkActive : chkActive,
					chkModule : chkModule,
					txtNumberofApprovals : txtNumberofApprovals,
					txtNumberofDisapprovals : txtNumberofDisapprovals

				
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
								
							// window.location.replace("../templates/approval-document.php");
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
		if($('#txtCode').val() == '' ){
			err = 1;
			$('#messageBar2').addClass('d-none');
						$('#messageBar3').removeClass('d-none');
						$('#messageBar').text('Input Approval Code').css({'background-color': 'red', 'color': 'white'});
						
							setTimeout(function()
							{
								$('#messageBar').text('').css({'background-color': '', 'color': ''});	
								$('#messageBar2').removeClass('d-none');
							},5000)
		}
		else if($('#txtDescription').val() == '' ){
			err = 1;
			$('#messageBar2').addClass('d-none');
						$('#messageBar3').removeClass('d-none');
						$('#messageBar').text('Input Approval Description').css({'background-color': 'red', 'color': 'white'});
						
							setTimeout(function()
							{
								$('#messageBar').text('').css({'background-color': '', 'color': ''});	
								$('#messageBar2').removeClass('d-none');
							},5000)
		}
	
		

		
		var txtCode = $('#txtCode').val();
		var txtDescription = $('#txtDescription').val();
		var txtNumberofApprovals = $('#txtNumberofApprovals').val()
		var txtNumberofDisapprovals = $('#txtNumberofDisapprovals').val()
		var chkActive = '';
		
		if($('#chkActive').is(':checked')) {
			chkActive = 'Y';
		}
		else{
			chkActive = 'N';
		}
	
		


		var chkModule = new Array();
		$('.subModule').each(function() 
		{
		
			if(!$(this).find(".checked-sub").hasClass('d-none')){
				chkModule.push($(this).attr('id'));
			}
			else{
				
			}
			
		});
		
		var jsonQuery = '{';
        var otArrQuery = [];
        var tbl = $('#tblQueries tbody tr').each(function (i) 
		{
            x = $(this).children();
            var itArr = [];
			

				if ($(this).find('input.qname').val() != ''){
					itArr.push('"' + $(this).find('td.rowno span').text() + '"');
					itArr.push('"' + $(this).find('input.intrnalkey').val() + '"');
					itArr.push('"' + $(this).find('input.qname').val() + '"');
				
				otArrQuery.push('"' + i + '": [' + itArr.join(',') + ']'); 
				}
			
		});
		
		jsonQuery += otArrQuery.join(",") + '}';

		var jsonUser = '{';
        var otArrUser = [];
        var tbl = $('#tblUsers tbody tr').each(function (i) 
		{
            x = $(this).children();
            var itArr = [];

				if ($(this).find('input.userid').val() != ''){
					itArr.push('"' + $(this).find('td.rowno span').text() + '"');
					itArr.push('"' + $(this).find('input.userid').val() + '"');
					itArr.push('"' + $(this).find('input.username').val() + '"');
				
				otArrUser.push('"' + i + '": [' + itArr.join(',') + ']'); 
				}
			
		});
		
		jsonUser += otArrUser.join(",") + '}';

		var jsonTemplate = '{';
        var otArrTemplate = [];
        var tbl = $('#tblTemplate tbody tr').each(function (i) 
		{
            x = $(this).children();

            var itArr = [];
				if ($(this).find('input.approvalstageid').val() != ''){
					itArr.push('"' + $(this).find('td.rowno span').text() + '"');
					itArr.push('"' + $(this).find('input.approvalstageid').val() + '"');
					itArr.push('"' + $(this).find('input.approvalstagename').val() + '"');
				
				otArrTemplate.push('"' + i + '": [' + itArr.join(',') + ']'); 
				}
			
		});
		
		jsonTemplate += otArrTemplate.join(",") + '}';


		console.log(jsonQuery)
		console.log(jsonUser)
		console.log(jsonTemplate)

		if (err == 0) 
		{
			
			$('#loadModal').modal('show');
            $.ajax({
                type: 'POST',
                url: '../proc/exec/exec_update_approval.php',
				data: 
				{
					jsonQuery: jsonQuery.replace(/(\r\n|\n|\r)/gm, '[newline]'),
					jsonUser: jsonUser.replace(/(\r\n|\n|\r)/gm, '[newline]'),
					jsonTemplate: jsonTemplate.replace(/(\r\n|\n|\r)/gm, '[newline]'),
					txtCode : txtCode,
					txtDescription : txtDescription,
					chkActive : chkActive,
					chkModule : chkModule,
					txtNumberofApprovals : txtNumberofApprovals,
					txtNumberofDisapprovals : txtNumberofDisapprovals
				
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
								
							window.location.replace("../templates/approval-document.php");
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
		else 
		{
			$('#messageBar').val('Out of bounds').css({'background-color': 'red', 'color': 'white'});
				setTimeout(function()
				{
					$('#messageBar').val('').css({'background-color': '', 'color': ''});	
				},5000)
        }


    });
/*Keyups*/
//Rows
	//Price
	$(document.body).on('keyup', '.price', function (e) 
	{
		
		CheckItemCode();
		let value = $(this).val();
		let price = $('.selected-det').find('input.price').val();
		let quantity = $('.selected-det').find('input.quantity').val();
		let discount = $('.selected-det').find('input.discount').val();
		let taxrate = $('.selected-det').find('option:selected').attr('val-rate');
			$(this).val(function(index, value) {
			value = value.replace(/,/g,'');
			return NumberWithCommas(value);
		});
		
		$('.selected-det').find('input.rowtotal').val(ComputeRowTotal(price,quantity,discount));
		ComputeRowGrossPrice();
		ComputeGrossTotal();
		
		ComputeFooterTotalBeforeDiscount();
		ComputeRowTaxAmount();
		ComputeFooterTaxAmount();
		ComputeTotal();
		
		
		$('txtFooterDiscountPercentage').trigger('blur');
		
	});
	$(document.body).on('blur', '.price', function () 
	{
		let amount = $('.selected-det').find('input.price').val();
		$('.selected-det').find('input.price').val(FormatMoney(amount));
		
	});
	//Quantity
	$(document.body).on('keyup', '.quantity', function (e) 
	{
		
		CheckItemCode();
		let price = $('.selected-det').find('input.price').val();
		let quantity = $('.selected-det').find('input.quantity').val();
		let discount = $('.selected-det').find('input.discount').val();
		let taxrate = $('.selected-det').find('option:selected').attr('val-rate');
		$('.selected-det').find('input.rowtotal').val(ComputeRowTotal(price,quantity,discount));
		ComputeRowGrossPrice();
		ComputeGrossTotal();
		ComputeFooterTotalBeforeDiscount();
		ComputeRowTaxAmount();
		ComputeFooterTaxAmount();
		ComputeTotal();
		
		$('txtFooterDiscountPercentage').trigger('blur');
		
	});
	$(document.body).on('blur', '.quantity', function () 
	{
		let amount = $('.selected-det').find('input.quantity').val();
		$('.selected-det').find('input.quantity').val(FormatQuantity(amount));
		
	});
	//Discount
	$(document.body).on('keyup', '.discount', function (e) 
	{
		CheckItemCode();
		if ($(this).val() > 100 
        && e.keyCode !== 46 // keycode for delete
        && e.keyCode !== 8 // keycode for backspace
		) {
		   e.preventDefault();
		   $(this).val(100);
		}
		let price = $('.selected-det').find('input.price').val();
		let quantity = $('.selected-det').find('input.quantity').val();
		let discount = $('.selected-det').find('input.discount').val();
		let taxrate = $('.selected-det').find('option:selected').attr('val-rate');
	
		$('.selected-det').find('input.rowtotal').val(ComputeRowTotal(price,quantity,discount));
		ComputeRowGrossPrice();
		ComputeGrossTotal();
		ComputeFooterTotalBeforeDiscount();
		ComputeRowTaxAmount();
		ComputeFooterTaxAmount();
		ComputeTotal();
		
		$('txtFooterDiscountPercentage').trigger('blur');
		
	});
	$(document.body).on('blur', '.discount', function () 
	{
		let amount = $('.selected-det').find('input.discount').val();
		$('.selected-det').find('input.discount').val(FormatMoney(amount));
		
	});
	//Tax
	$(document.body).on('change','.taxcode',function()
	{
		
		let taxrate = $(this).find('option:selected').attr('val-rate');
		let total = $('.selected-det').find('input.rowtotal').val();
		let amount;
		if(taxrate != 0.00){
			amount = parseFloat((taxrate / 100) * total);
		
		}
		else{
			amount = 0.00;
		}
		$('.selected-det').find('input.taxcode').attr('val-rate',FormatMoney(taxrate));
		$('.selected-det').find('input.taxamount').val(FormatMoney(amount));
		
		ComputeRowGrossPrice();
		ComputeGrossTotal();
		
		ComputeTotal();
		ComputeRowTaxAmount();
		ComputeFooterTaxAmount();
		$('txtFooterDiscountPercentage').trigger('blur');
		
		
	})
	

//Footer
	$(document.body).on('keyup', '#txtFooterDiscountSum', function (e) 
	{
		let value = $(this).val();
		let discAmount = $(this).val();
		let totalBeforeDiscount = $('#txtTotalBeforeDiscount').val();
		let amount = parseFloat(discAmount/totalBeforeDiscount) * 100;
			$(this).val(function(index, value) {
			value = value.replace(/,/g,'');
			return NumberWithCommas(value);
		});
		
		ComputeTotal();
		
	});	
	$(document.body).on('blur', '#txtFooterDiscountSum', function (e) 
	{
		let amount = $(this).val();
		let discAmount = $(this).val();
		let totalBeforeDiscount = $('#txtTotalBeforeDiscount').val();
		$(this).val(FormatMoney(amount));
		ComputeDiscountPercentageFooter(discAmount,totalBeforeDiscount);
	});	
	$(document.body).on('keyup', '#txtFooterDiscountPercentage', function (e) 
	{
		if ($(this).val() > 100 
        && e.keyCode !== 46 // keycode for delete
        && e.keyCode !== 8 // keycode for backspace
		) {
		   e.preventDefault();
		   $(this).val(100);
		}
		let discPercentage = $(this).val();
		let totalBeforeDiscount = $('#txtTotalBeforeDiscount').val();
		let amount = parseFloat(discPercentage/100) * totalBeforeDiscount;
		$('#txtFooterDiscountSum').val(FormatMoney(amount));
		ComputeTotal();
		
	});	
	$(document.body).on('blur', '#txtFooterDiscountPercentage', function (e) 
	{
		let amount = $(this).val();
		let discPercentage = $(this).val();
		let totalBeforeDiscount = $('#txtTotalBeforeDiscount').val();
		$(this).val(FormatMoney(amount));
		ComputeDiscountAmountFooter(discPercentage,totalBeforeDiscount);
	});	

/*Logistics Tab*/
//Address
	$(document.body).on('keyup', '.shipInputs', function (e) 
	{
		$('#btnShipToAddressOk').addClass('d-none');
		$('#btnShipToAddressUpdate').removeClass('d-none');
	});
	$(document.body).on('keyup', '.billInputs', function (e) 
	{
		$('#btnBillToAddressOk').addClass('d-none');
		$('#btnBillToAddressUpdate').removeClass('d-none');
	});
	$(document.body).on('click', '#btnShipToAddressUpdate', function (e) 
	{
		let txtStreetPOBoxS = $('#txtStreetPOBoxS').val();
		let txtStreetNoS = $('#txtStreetNoS').val();
		let txtBlockS = $('#txtBlockS').val();
		let txtCityS = $('#txtCityS').val();
		let txtZipCodeS = $('#txtZipCodeS').val();
		let txtCountyS = $('#txtCountyS').val();
		let txtStateS = $('#txtStateS').val();
		let txtCountryS = $('#txtCountryS').val();
		let txtCountrySName = $('#txtCountrySName').val();
		let txtBuildingS = $('#txtBuildingS').val();
		$('#txtShipToAddressTextArea').val(txtStreetPOBoxS + '\n' + '\n' + txtZipCodeS + ' ' + txtCityS + '\n'  + txtCountrySName);
		
		let shipArr2 = [];	
		let shipList2;
							shipArr2.push(txtStreetPOBoxS);
							shipArr2.push(txtStreetNoS);
							shipArr2.push(txtBlockS);
							shipArr2.push(txtZipCodeS);
							shipArr2.push(txtCityS);
							shipArr2.push(txtCountyS);
							shipArr2.push(txtStateS);
							shipArr2.push(txtCountrySName);
							shipArr2.push(txtBuildingS);
							shipArr2.push(txtCountryS);
							
			setTimeout(function () {
				shipList2 = shipArr2;	
				$('#txtShipArr2').val(shipList2);			
			
				}, 100) 
	});
	$(document.body).on('click', '#btnBillToAddressUpdate', function (e) 
	{
		let txtStreetPOBoxB = $('#txtStreetPOBoxB').val();
		let txtStreetNoB = $('#txtStreetNoB').val();
		let txtBlockB = $('#txtBlockB').val();
		let txtCityB = $('#txtCityB').val();
		let txtZipCodeB = $('#txtZipCodeB').val();
		let txtCountyB = $('#txtCountyB').val();
		let txtStateB = $('#txtStateB').val();
		let txtCountryB = $('#txtCountryB').val();
		let txtCountryBName = $('#txtCountryBName').val();
		let txtBuildingB = $('#txtBuildingB').val();
		
		$('#txtBillToAddressTextArea').val(txtStreetPOBoxB + '\n' + '\n' + txtZipCodeB + ' ' + txtCityB + '\n'  + txtCountryBName);
		
		let billArr2 = [];	
		let billList2;
							billArr2.push(txtStreetPOBoxB);
							billArr2.push(txtStreetNoB);
							billArr2.push(txtBlockB);
							billArr2.push(txtZipCodeB);
							billArr2.push(txtCityB);
							billArr2.push(txtCountyB);
							billArr2.push(txtStateB);
							billArr2.push(txtCountryBName);
							billArr2.push(txtBuildingB);
							billArr2.push(txtCountryB);
							
			setTimeout(function () {
				billList2 = billArr2;	
				$('#txtBillArr2').val(billList2);			
			
				}, 100) 
	});
//------------------------------------------------------------------------------------------------------------------------------------------------------------------		
/*Functions --------------------------------------------------------------------------------------------------------------------------------------------------------*/
//------------------------------------------------------------------------------------------------------------------------------------------------------------------		
	function AddRowTemplate(){
		
		var rowno = 0;
			rowno = ($('#tblTemplate tbody tr:last').find('td.rowno span').text() == '') ? 1 : parseFloat($('#tblTemplate tbody tr:last').find('td.rowno span').text()) + 1;
		var lastItem = $('#tblTemplate tbody tr:last').find('input.approvalstageid').val()
		
		if(lastItem != ""){
		setTimeout(function () 
			{
					
						$('#rowLoader').load('../templates/approval-template-stage-lines-row.php', function (result) 
						{
							$('#tblTemplate tbody').append(result);

							$('#tblTemplate tbody tr:last').find('td.rowno span').text(rowno);
						})
			
							$(this).prop('disabled', false);
					
					
			}, 200)
		}
	}
	function AddRowUser(){
		
		var rowno = 0;
			rowno = ($('#tblUsers tbody tr:last').find('td.rowno span').text() == '') ? 1 : parseFloat($('#tblUsers tbody tr:last').find('td.rowno span').text()) + 1;
		var lastItem = $('#tblUsers tbody tr:last').find('input.userid').val()
		
		if(lastItem != ""){
		setTimeout(function () 
			{
					
						$('#rowLoader').load('../templates/approval-user-stage-lines-row.php', function (result) 
						{
							$('#tblUsers tbody').append(result);

							$('#tblUsers tbody tr:last').find('td.rowno span').text(rowno);
						})
			
							$(this).prop('disabled', false);
					
					
			}, 200)
		}
	}
	function AddRowQuery(){
		
		var rowno = 0;
			rowno = ($('#tblQueries tbody tr:last').find('td.rowno span').text() == '') ? 1 : parseFloat($('#tblQueries tbody tr:last').find('td.rowno span').text()) + 1;
		var lastItem = $('#tblQueries tbody tr:last').find('input.intrnalkey').val()
		
		if(lastItem != ""){
		setTimeout(function () 
			{
					
						$('#rowLoader').load('../templates/approval-queries-lines-row.php', function (result) 
						{
							$('#tblQueries tbody').append(result);

							$('#tblQueries tbody tr:last').find('td.rowno span').text(rowno);
						})
			
							$(this).prop('disabled', false);
					
					
			}, 200)
		}
	}

	
	function PreviewDoc(code){
		
		
		$.getJSON('../proc/views/vw_getheaderdata.php?code=' + code, function (data){
			
				$('.subModule').each(function (i) 
				{
					$(this).find('.checked-sub').addClass('d-none');
					$(this).css('background-color','white');
				});
			
            $.each(data, function (key, val){
            		console.log(val.Code)
				setTimeout(function()	{
					
					$('#myModalLabelApproval').text('Approval Properties');
					$('#txtCode').val(val.Code).attr('readonly', 'readonly');
					$('#txtDescription').val(val.Description).attr('readonly', 'readonly');
					if(val.Active == 'Y'){
						$('#chkActive').attr('checked', 'checked')
					}
					$('#btnAdd').addClass('d-none');
					$('#btnUpdate').removeClass('d-none');
					$('#txtNumberofApprovals').val(val.NoOfApprovals)
					$('#txtNumberofDisapprovals').val(val.NoOfDisapprovals)
					var Modules = val.Modules.split(', ');
					
				 	
					var Module = val.Modules.split(', ');
				
							var fLen, i;
							fLen = Module.length;
							for (i = 0; i < fLen; i++) 
							{
								$('#'+Module[i]+'').find('.checked-sub').removeClass('d-none');
								$('#'+Module[i]+'').css('background-color','#ADD8E6');
							}

				},100)
				
				setTimeout(function () 
				{
					
						
						PreviewRowsUsers(code,function () 
						{
							
						});
						PreviewRowsTemplate(code,function () 
						{
							
						});
					
					
					
					
	            }, 500) 
				
				
			});
		});
	
			
	}
	function PreviewRowsUsers(code,callback){
        $('#users-tab').load('../proc/views/vw_getdetailsdatausers.php?code=' + code, function (result) 
		{
            callback();
		});
    }
	function PreviewRowsTemplate(code,callback){
        $('#approval-template-tab').load('../proc/views/vw_getdetailsdatatemplate.php?code=' + code, function (result) 
		{
            callback();
		});
	}
	function PreviewUDF(docNum){
		let udfJsonNames = '';
		$.getJSON('../proc/views/udf/vw_listUDFDescr.php?mainTable=' + mainTable, function (data){
			var udfArr = [];
			$.each(data, function (key, val){
					udfArr.push(val.Descr);
					udfArr.join(','); 
			});		
			udfJsonNames = JSON.stringify(udfArr);
		});
		$.getJSON('../proc/views/udf/vw_listUDF.php?mainTable=' + mainTable, function (data){
			
			var udfArr = [];
			$.each(data, function (key, val){
					udfArr.push(val.Column_Name);
					udfArr.join(','); 
			});		
			let udfJson = JSON.stringify(udfArr);
			let udfJson2 = udfJson.replace(/(\r\n|\n|\r)/gm, '[newline]');
			
			$('#udfvalueloader').load('../proc/views/udf/vw_getUDF.php?udfJson=' + udfJson + '&docNum=' + docNum + '&mainTable=' + mainTable,function (){
			
				let udfValues = $('#udfvalueloader').text();
				let udfValues2 = udfValues.replace(/['"]+/g, '');
				let udfValues3 = udfValues2.replace('[','');
				let udfValues4 = udfValues3.replace(']','');
				let udfValues5 = udfValues4.split(',');
				
				$('.inputUdf').each(function (i) 
				{
					
					
					if($(this).attr('type') == 'date'){
						//(udfValues5[i] != 'null') ? $(this).val(date) :'';
						let id2 = $(this).attr('id2');
						let that = $(this);
					
						$.ajax({
							type: 'GET',
							url: '../proc/views/udf/vw_getUDFDate.php?mainTable=' + mainTable,
							data: {
									id2 : id2,
									docNum : docNum
									},
							success: function (html) 
							{
							
								that.val(html);
							}
						}); 
					}
					else if($(this).hasClass('amount')){
						if(udfValues5[i] == '.000000' ){
							$(this).val('0.00');
						}
						else if(udfValues5[i] != 'null' ){
							$(this).val(udfValues5[i]);
						}
						
					}
					
					else{
						if(udfValues5[i] != 'null' ){
							$(this).val(udfValues5[i]);
						}
						
					}
					
					if($(this).attr('table') != ''){
						let value = $(this).val();
						let table = $(this).attr('table');
						
						let that = $(this);
						$.ajax({
							type: 'GET',
							url: '../proc/views/udf/vw_getUDFNameWithTable.php',
							data: {
									value : value,
									table : table
									
									},
							success: function (html) 
							{
								that.val(html);
							}
						}); 
					}
					
					$('.inputUdf').each(function (i) 
					{
						if($(this).val() == 'null'){
							$(this).val('');
						}
					});
					
				});
			}); 
		
		});
	}
	

	
	function CheckItemCode(){
		if($('.selected-det').find('input.itemcode').val() == '')
		{
			$('.selected-det').find('input.price').val('');
			$('.selected-det').find('input.quantity').val('');
			$('.selected-det').find('input.discount').val('');
			$('.selected-det').find('input.itemcode').focus();
			$('#messageBar').val('Enter Item!').css({'background-color': 'red', 'color': 'white'});
				setTimeout(function()	{
					$('#messageBar').val('').css({'background-color': '', 'color': ''});	
				},5000)
		}
	}
	
	function CheckCardCode(value){
		if($('#txtCardCode').val() != ''){
			value = '';
		}
		return value;
	}
	
	function CheckItemCode(){
		if($('.selected-det').find('input.itemcode').val() == '')
		{
			$('.selected-det').find('input.price').val('');
			$('.selected-det').find('input.quantity').val('');
			$('.selected-det').find('input.discount').val('');
			$('.selected-det').find('input.itemcode').focus();
			$('#messageBar').val('Enter Item!').css({'background-color': 'red', 'color': 'white'});
				setTimeout(function()	{
					$('#messageBar').val('').css({'background-color': '', 'color': ''});	
				},5000)
		}
	}

	function GenSetCheckBoxChecked(){
		//All are unchecked
		if($('.gensub > .checked-sub').length == $('.gensub > .checked-sub.d-none').length && $('.gensub > .checked-sub.d-none').length > 0) {
				$('#GenSet > .checked').addClass('d-none');
				$('#GenSet > .indetermine').addClass('d-none');
				$('#GenSet').css('background-color','white');
		}
		//All are checked
		else if($('.gensub > .checked-sub').length != $('.gensub > .checked-sub.d-none').length && $('.gensub > .checked-sub.d-none').length == 0) {
				$('#GenSet > .checked').removeClass('d-none');
				$('#GenSet > .indetermine').addClass('d-none');
				$('#GenSet').css('background-color','#ADD8E6');
		}
		//Not all are checked
		else if($('.gensub > .checked-sub').length != $('.gensub > .checked-sub.d-none').length){
				$('#GenSet > .checked').addClass('d-none');
				$('#GenSet > .indetermine').removeClass('d-none');
				$('#GenSet').css('background-color','#ADD8E6');
		}
		
	}
	function FinCheckBoxChecked(){
		//All are unchecked
		if($('.finsub > .checked-sub').length == $('.finsub > .checked-sub.d-none').length && $('.finsub > .checked-sub.d-none').length > 0) {
				$('#Fin > .checked').addClass('d-none');
				$('#Fin > .indetermine').addClass('d-none');
				$('#Fin').css('background-color','white');
		}
		//All are checked
		else if($('.finsub > .checked-sub').length != $('.finsub > .checked-sub.d-none').length && $('.finsub > .checked-sub.d-none').length == 0) {
				$('#Fin > .checked').removeClass('d-none');
				$('#Fin > .indetermine').addClass('d-none');
				$('#Fin').css('background-color','#ADD8E6');
		}
		//Not all are checked
		else if($('.finsub > .checked-sub').length != $('.finsub > .checked-sub.d-none').length){
				$('#Fin > .checked').addClass('d-none');
				$('#Fin > .indetermine').removeClass('d-none');
				$('#Fin').css('background-color','#ADD8E6');
		}
		
	}
	function InvCheckBoxChecked(){
		//All are unchecked
		if($('.invsub > .checked-sub').length == $('.invsub > .checked-sub.d-none').length && $('.invsub > .checked-sub.d-none').length > 0) {
				$('#Inv > .checked').addClass('d-none');
				$('#Inv > .indetermine').addClass('d-none');
				$('#Inv').css('background-color','white');
		}
		//All are checked
		else if($('.invsub > .checked-sub').length != $('.invsub > .checked-sub.d-none').length && $('.invsub > .checked-sub.d-none').length == 0) {
				$('#Inv > .checked').removeClass('d-none');
				$('#Inv > .indetermine').addClass('d-none');
				$('#Inv').css('background-color','#ADD8E6');
		}
		//Not all are checked
		else if($('.invsub > .checked-sub').length != $('.invsub > .checked-sub.d-none').length){
				$('#Inv > .checked').addClass('d-none');
				$('#Inv > .indetermine').removeClass('d-none');
				$('#Inv').css('background-color','#ADD8E6');
		}
		
	}
	function SalesCheckBoxChecked(){
		//All are unchecked
		if($('.salessub > .checked-sub').length == $('.salessub > .checked-sub.d-none').length && $('.salessub > .checked-sub.d-none').length > 0) {
				$('#Sales > .checked').addClass('d-none');
				$('#Sales > .indetermine').addClass('d-none');
				$('#Sales').css('background-color','white');
		}
		//All are checked
		else if($('.salessub > .checked-sub').length != $('.salessub > .checked-sub.d-none').length && $('.salessub > .checked-sub.d-none').length == 0) {
				$('#Sales > .checked').removeClass('d-none');
				$('#Sales > .indetermine').addClass('d-none');
				$('#Sales').css('background-color','#ADD8E6');
		}
		//Not all are checked
		else if($('.salessub > .checked-sub').length != $('.salessub > .checked-sub.d-none').length){
				$('#Sales > .checked').addClass('d-none');
				$('#Sales > .indetermine').removeClass('d-none');
				$('#Sales').css('background-color','#ADD8E6');
		}
		
	}
	function PurchCheckBoxChecked(){
		//All are unchecked
		if($('.purchsub > .checked-sub').length == $('.purchsub > .checked-sub.d-none').length && $('.purchsub > .checked-sub.d-none').length > 0) {
				$('#Purch > .checked').addClass('d-none');
				$('#Purch > .indetermine').addClass('d-none');
				$('#Purch').css('background-color','white');
		}
		//All are checked
		else if($('.purchsub > .checked-sub').length != $('.purchsub > .checked-sub.d-none').length && $('.purchsub > .checked-sub.d-none').length == 0) {
				$('#Purch > .checked').removeClass('d-none');
				$('#Purch > .indetermine').addClass('d-none');
				$('#Purch').css('background-color','#ADD8E6');
		}
		//Not all are checked
		else if($('.purchsub > .checked-sub').length != $('.purchsub > .checked-sub.d-none').length){
				$('#Purch > .checked').addClass('d-none');
				$('#Purch > .indetermine').removeClass('d-none');
				$('#Purch').css('background-color','#ADD8E6');
		}
		
	}
	function BankCheckBoxChecked(){
		//All are unchecked
		if($('.banksub > .checked-sub').length == $('.banksub > .checked-sub.d-none').length && $('.banksub > .checked-sub.d-none').length > 0) {
				$('#Bank > .checked').addClass('d-none');
				$('#Bank > .indetermine').addClass('d-none');
				$('#Bank').css('background-color','white');
		}
		//All are checked
		else if($('.banksub > .checked-sub').length != $('.banksub > .checked-sub.d-none').length && $('.banksub > .checked-sub.d-none').length == 0) {
				$('#Bank > .checked').removeClass('d-none');
				$('#Bank > .indetermine').addClass('d-none');
				$('#Bank').css('background-color','#ADD8E6');
		}
		//Not all are checked
		else if($('.banksub > .checked-sub').length != $('.banksub > .checked-sub.d-none').length){
				$('#Bank > .checked').addClass('d-none');
				$('#Bank > .indetermine').removeClass('d-none');
				$('#Bank').css('background-color','#ADD8E6');
		}
		
	}


	function FormatMoney(amount){
		let preAmount = accounting.formatMoney(amount, "", 2);
		
		
		return preAmount;
	} 
	function FormatQuantity(amount){
		let preAmount = accounting.formatMoney(amount, "", 2);
		
		
		return preAmount;
	}
	function FormatMoneyWithCurrency(amount){
		let preAmount = accounting.formatMoney(amount, txtCurrency + " " , 2);
		
		
		return preAmount;
	} 
	
	function NumberWithCommas(value) 
	{
		var parts = value.toString().split(".");
		parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
		return parts.join(".");
	}
	
	function IsNumberKey(e)
    {
		
        var charCode = (e.which) ? e.which : e.keyCode;
        if (charCode != 46 && charCode > 31 
			&& (charCode < 48 || charCode > 57))
          return false;

        return true;
    }

    function resetFieldsCreation(){
    	$('input').val('')
    	$('.checked-sub').addClass('d-none');
		$('.subModule').css('background-color','white');

    }
	
});