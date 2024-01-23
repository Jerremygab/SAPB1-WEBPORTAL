

<?php
// $filename = $_FILES['fileToUpload']['name'];

// $location = 'C:/Users/karli.DESKTOP-T36732H/OneDrive/Pictures/MEME/upload/'.$filename;

// if (move_uploaded_file($_FILES["file"]["tmp_name"], $location)) {
//     			echo $location;
//     		} else {
//     			echo 0;
//     		}



			//PHP
$count = count($_FILES['fileToUpload']['name']);
for ($i = 0; $i < $count; $i++) {
    // echo 'Name: '.$_FILES['fileToUpload']['name'][$i].'<br/>';
	$filename = $_FILES['fileToUpload']['name'][$i];
	$location = 'C:/Users/karli.DESKTOP-T36732H/OneDrive/Pictures/MEME/upload/'.$filename;
	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $location)) {
    			echo $location;
    		} else {
    			echo 0;
    		}
}

?>
 