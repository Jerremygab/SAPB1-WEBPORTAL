$(() => {

console.log('ptf working')

$(document.body).on('click', '#btnPTFReportGenerate', function () 
{
	var U_PTFNo = $('#U_PTFNo').val();
	var U_PTFYear = $('#U_PTFYear').val();
	var U_DateForwardedBT = $('#U_DateForwardedBT').val();
	var U_PreparedBy = $('#U_PreparedBy').val();
	var U_ForwardedBy = $('#U_ForwardedBy').val();
	var U_ReceivedBy = $('#U_ReceivedBy').val();
	console.log(U_PTFNo)
	console.log(U_PTFYear)
	console.log(U_DateForwardedBT)
	console.log(U_PreparedBy)
	console.log(U_ForwardedBy)
	console.log(U_ReceivedBy)
	// window.open("../forms/SOA-Red-Ribbon.php?docentry=" + encodeURI(docentry),"", "width=1130,height=550,left=220,top=110");

	if(U_PTFNo != '')
	{

		window.open("../form/ptfform.php?U_PTFNo=" + encodeURI(U_PTFNo) + 
										"&U_PTFYear=" + encodeURI(U_PTFYear) +
										"&U_DateForwardedBT=" + encodeURI(U_DateForwardedBT) +
										"&U_PreparedBy=" + encodeURI(U_PreparedBy) +
										"&U_ForwardedBy=" + encodeURI(U_ForwardedBy) +
										"&U_ReceivedBy=" + encodeURI(U_ReceivedBy) 
										,"", "width=1130,height=550,left=220,top=110");
	}
});
		
	

});

