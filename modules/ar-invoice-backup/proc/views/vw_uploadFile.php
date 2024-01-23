

<?php
$filename = $_FILES['file']['name'];

$location = 'C:/Users/Administrator/Desktop/JCBA/ATTACHMENTS/'.$filename;

if (move_uploaded_file($_FILES["file"]["tmp_name"], $location)) {
    			echo $location;
    		} else {
    			echo 0;
    		}
?>
