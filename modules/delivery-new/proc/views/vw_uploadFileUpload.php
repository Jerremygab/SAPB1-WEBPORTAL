

<?php
session_start();

include('../../../../config/config.php');




$u_objecType = 13;
$u_docentry =$_POST['docentryAttachment'];
$u_freetext =$_POST['u_freetext'];

$count = count($_FILES['fileToUpload']['name']);
for ($i = 0; $i < $count; $i++) {
   
	$filename = $_FILES['fileToUpload']['name'][$i];
	$location = 'C:/xampp/htdocs/SAPB1Standard/uploaded-files/'.$filename;
	$uploadedFiles = 'C:/xampp/htdocs/SAPB1Standard/uploaded-files/'.$filename;
	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $location)
	
	// && move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $uploadedFiles)
	
	) {
    			// echo $location;

    			 $addQry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
					INSERT INTO [@ATTACHMENT]
						(U_ObjectType, U_DocEntry, U_LineNo, U_FileName, U_FileLocation, U_AttachmentDate, U_FreeText)
					VALUES
						($u_objecType, $u_docentry, $i,  '$filename', '$location' , '$date()' , '$u_freetext')
				");
    			 odbc_free_result($addQry);
    			
    		} 
			else {
    			echo 0;
    		}


			// NOT TESTED
			// if (file_exists($location)) {
			// 	$addQry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
			// 		UPDATE [@ATTACHMENT] SET U_FileName = '$filename'
			// 		");
    		// 	 odbc_free_result($addQry);
				
			// 	$sql = "UPDATE [@ATTACHMENT] SET U_FileName = '$filename'";
				
			// } else {
			// 	$addQry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
			// 		INSERT INTO [@ATTACHMENT]
			// 			(U_ObjectType, U_DocEntry, U_LineNo, U_FileName, U_FileLocation)
			// 		VALUES
			// 			($u_objecType, $u_docentry, $i,  '$filename', '$location' )
			// 	");
    		// 	 odbc_free_result($addQry);
			// }		
			// not tested
}

   
?>
