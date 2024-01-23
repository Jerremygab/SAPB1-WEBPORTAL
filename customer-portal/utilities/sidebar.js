$(document).ready(function () {
	$(document.body).on('click', '#salesbtn', function () 
	{
		$('#content1').load('../../sales-order/templates/sales-order-document.php');
	});
});