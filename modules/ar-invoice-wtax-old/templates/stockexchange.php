<?php 
session_start(); 

if(!isset($_SESSION['SESS_USERID']) && empty($_SESSION['SESS_USERID'])) 
{
  header("Location: ../../login/login.php");
}
include '../../head.php' ;
?>


						<div id="realTimeData">
						
						</div>
					
		<script src="../script/stockexchange.js"></script>