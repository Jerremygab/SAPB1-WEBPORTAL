<?php



// if(isset($_POST['submit'])) {
// 	$target_dir = "upload_file/"; // directory where uploaded files will be saved
// 	$target_file = $target_dir . basename($_FILES["file"]["name"]); // full path of uploaded file
// 	$uploadOk = 1; // flag to indicate whether the file was uploaded successfully
	
// 	// Check if file already exists
// 	if (file_exists($target_file)) {
// 		echo "Sorry, file already exists.";
// 		$uploadOk = 0;
// 	}
	
// 	// Check file size
// 	if ($_FILES["getFile"]["size"] > 500000) { // 500KB limit
// 		echo "Sorry, your file is too large.";
// 		$uploadOk = 0;
// 	}
	
// 	// Allow certain file formats
// 	$allowedExtensions = array("jpg", "jpeg", "png", "gif", "csv", "pdf", "xslx");
// 	$fileExtension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// 	if (!in_array($fileExtension, $allowedExtensions)) {
// 		echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
// 		$uploadOk = 0;
// 	}
	
// 	// Check if $uploadOk is set to 0 by an error
// 	if ($uploadOk == 0) {
// 		echo "Sorry, your file was not uploaded.";
// 	// If everything is ok, try to upload file
// 	} else {
// 		if (move_uploaded_file($_FILES["getFile"]["tmp_name"], $target_file)) {
// 			echo "The file ". htmlspecialchars( basename( $_FILES["getFile"]["name"])). " has been uploaded.";
// 		} else {
// 			echo "Sorry, there was an error uploading your file.";
// 		}
// 	}
// 	}


// $target_dir = "../Users/Administrator/Desktop/JCBA/ATTACHMENTS/";
// $target_file = $target_dir . basename($_FILES["getFile"]["name"]);
// $allowedExtensions = array("jpg", "jpeg", "png", "gif", "csv", "pdf", "xslx");
// $uploadOk = 1;
// $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// // Check if image file is a actual image or fake image
// if(isset($_POST["button"])) {
//   $check = getimagesize($_FILES["getFile"]["tmp_name"]);
//   if($check !== false) {
//     echo "File is an image - " . $check["mime"] . ".";
//     $uploadOk = 1;
//   } else {
//     echo "File is not an image.";
//     $uploadOk = 0;
//   }
//     if (move_uploaded_file($_FILES["getFile"]["tmp_name"], $target_file)) {
//         echo "The file ". htmlspecialchars( basename( $_FILES["getFile"]["name"])). " has been uploaded.";
//     } else {
//         echo "Sorry, there was an error uploading your file.";
//     }
//     	// Check file size
// 	if ($_FILES["getFile"]["size"] > 500000) { // 500KB limit
// 		echo "Sorry, your file is too large.";
// 		$uploadOk = 0;
// 	}
	
// }

// $target_dir = "upload_file/";
// $target_file = $target_dir . basename($_FILES["getFile"]["name"]);
// $uploadOk = 1;
// $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// // Check if image file is a actual image or fake image
// if(isset($_POST["submit"])) {
//   $check = getimagesize($_FILES["getFile"]["tmp_name"]);
//   if($check !== false) {
//     echo "File is an image - " . $check["mime"] . ".";
//     $uploadOk = 1;
//   } else {
//     echo "File is not an image.";
//     $uploadOk = 0;
//   }
// }

// // Check if file already exists
// if (file_exists($target_file)) {
//   echo "Sorry, file already exists.";
//   $uploadOk = 0;
// }

// // Check file size
// if ($_FILES["fileToUpload"]["size"] > 500000) {
//   echo "Sorry, your file is too large.";
//   $uploadOk = 0;
// }

// // Allow certain file formats
// if($imageFileType != "csv" && $imageFileType != "png" && $imageFileType != "csv"
// && $imageFileType != "csv" ) {
//   echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
//   $uploadOk = 0;
// }

// // Check if $uploadOk is set to 0 by an error
// if ($uploadOk == 0) {
//   echo "Sorry, your file was not uploaded.";
// // if everything is ok, try to upload file
// } else {
//   if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
//     echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
//   } else {
//     echo "Sorry, there was an error uploading your file.";
//   }
// }

if(isset($_POST['btnAdd'])) {
  $target_dir = '/Users/Administrator/Desktop/JCBA/ATTACHMENTS/'; // directory where uploaded files will be saved
  $target_file = $target_dir . basename($_FILES["getFile"]["name"]); // full path of uploaded file
  $uploadOk = 1; // flag to indicate whether the file was uploaded successfully
  
  // Check if file already exists
  if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
  }
  
  // Check file size
  if ($_FILES["getFile"]["size"] > 500000) { // 500KB limitgetFile
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
  }
  
  // Allow certain file formats
  $allowedExtensions = array("jpg", "jpeg", "png", "gif", "csv", "txt", "pdf" );
  $fileExtension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  if (!in_array($fileExtension, $allowedExtensions)) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
  }
  
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
  // If everything is ok, try to upload file
  } else {
      if (move_uploaded_file($_FILES["getFile"]["tmp_name"], $target_file)) {
          echo "The file ". htmlspecialchars( basename( $_FILES["getFile"]["name"])). " has been uploaded.";
      } else {
          echo "Sorry, there was an error uploading your file.";
      }
  }
  }

// $targetDirectory = 'Users/Administrator/Desktop/JCBA/ATTACHMENTS/'; // Specify the target directory where the file will be saved
// $targetFile = $targetDirectory . basename($_FILES['getFile']['name']); // Get the file name and append it to the target directory

// // Check if the file has been successfully uploaded
// if (move_uploaded_file($_FILES['getFile']['tmp_name'], $targetFile)) {
//     echo "File uploaded successfully.";
// } else {
//     echo "Error uploading file.";
// }


    ?>