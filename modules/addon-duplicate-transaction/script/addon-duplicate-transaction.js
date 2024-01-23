$(document).ready(function () {

	const objTables = JSON.parse(sessionStorage.objectTablesArr);
	
	const mainFileName = sessionStorage.mainFileName;
	const objectTable = sessionStorage.objectTable;
	const objectTableName = sessionStorage.objectTableName;
	const objectType = parseInt(sessionStorage.objectType);
	const childTable1 = sessionStorage.childTable1;
	const childTable12 = sessionStorage.childTable12;
	const childTable21 = sessionStorage.childTable21;
	const SAPDateFormat = sessionStorage.SAPDateFormat;
	const copyFromArr = JSON.parse(sessionStorage.copyFromArr);
	
	let baseTableName;
	let baseTable;
	let baseType = -1;
	let copyFromModal;
	let copyFromModalTbl;
	const sapserver = '192.168.1.29'
	let objType = 0;
	$('#txtPostingDate').prop("disabled",false);
	$('#txtPostingDate2').prop("disabled",false);
	let multiCopyFromDR = [];
	$(document.body).on('click', 'ul.copyFromList li', function(){
		copyFromArr.map(item => {
			if ($(this).find('button').text() == item.baseTableName){
				baseTableName = item.baseTableName;
				baseTable = item.baseTable;
				baseType = item.baseType;
				copyFromModal = item.copyFromModal;
				copyFromModalTbl = item.copyFromModalTbl;
				return false;
			}
		});
	
		let cardCode = $('#txtCardCode').val();
		let table = baseTable;
		
		if(cardCode == '')
		{
			
			$('#tbl'+copyFromModalTbl+' tbody').html('');
		}
		else
		{	
			console.log(baseType)
			$.ajax({
				type: 'POST',
				url: '../proc/views/vw_copyFrom.php',
				data: {
					cardCode : cardCode,
					table: table, 
					copyFromModalTbl: copyFromModalTbl
				},
				success: function (html) 
				{
					$('#'+copyFromModal+'Result').html(html);
				}
			});
		}
	})
	


	
	

	
	/*Load Tabs*/
		//Contents
		$('#contents-tab').load('../templates/' + mainFileName + '-lines.php' ), function (){
			
		};
	
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
		let itemcode = $('#tblDetails tbody tr:last').find('td.rowno span').text()
			if ($('.selected-det').find('input.lineno').val() != ''){
				otArrLineNum.push($('.selected-det').find('input.visorder').val());
			}
		otArrLineNum.join(",");
		
			$('.selected-det').remove();
			
			var rowno2 = 1;
			$('#tblDetails tbody tr').each(function () 
			{
				$(this).find('td.rowno span').text(rowno2);
				rowno2 += 1;
			});
				ComputeFooterTotalBeforeDiscount();
				ComputeFooterTaxAmount();
				ComputeTotal();
	});

});