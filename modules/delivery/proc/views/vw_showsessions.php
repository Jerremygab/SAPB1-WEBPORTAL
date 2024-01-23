<?php
session_start();
include('../../../../config/config.php');



print_r(scandir(session_save_path()));
?>
