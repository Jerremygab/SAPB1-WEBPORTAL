$(document).ready(function () {
	 setInterval(function () {getRealData()}, 1000);//request every x seconds
	function getRealData() {
		var table = "OPQT";
	$.ajax({
			
			 url: '../proc/views/stockexchangedata.php',
			 type: "POST",
			 data: {
				 table: table
			 },
			 cache: false,
			 success: function (data) {
				 $('#realTimeData').html(data);
			 }
		 });
 }
 }); 

	
