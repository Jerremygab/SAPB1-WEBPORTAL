

<?php
session_start();

include('../../../../config/config.php');




$u_objecType = 19;

$type =$_POST['type'];
$u_docentry =$_POST['docentryAttachment'];
$atcEntry =$_POST['atcentry'];
$attachmentdate =$_POST['attachmentdate'];
$freetext =$_POST['freetext'];

$count = count($_FILES['fileToUpload']['name']);

include('../../../connect/connect.php');
	
$vCmp=new COM("SAPbobsCOM.company") or die ("No connection");

$vCmp->DbServerType = $DbServerType;
$vCmp->server =  $server;
$vCmp->UseTrusted =$UseTrusted;
$vCmp->DBusername = $DBusername;
$vCmp->DBpassword = $DBpassword;
$vCmp->CompanyDB = $CompanyDB;
$vCmp->username = $username;
$vCmp->password = $password;
$vCmp->LicenseServer = $LicenseServer;

$errid = 0;

$lRetCode = $vCmp->Connect;
	
if ($lRetCode != 0) 
{
	$errmsg .= $vCmp->GetLastErrorDescription;
	$err += 1;
}
else
{
	$oAtc = $vCmp->GetBusinessObject(221);
	if($atcEntry == ''){
		$absentry = '';
	}else{
		$absentry = '';
		$oAtc->GetByKey($atcEntry);
	}

	

for ($i = 0; $i < $count; $i++) {
	

	$filename = 'SAPB1-File' . $i-1 . '-' . $_FILES['fileToUpload']['name'][$i];
	$temp = $_FILES['fileToUpload']['tmp_name'][$i];
	$location = 'C:/xampp/htdocs/SAPB1Standard/uploaded-files/'.$filename;
	$uploadedFiles = 'C:/xampp/htdocs/SAPB1Standard/uploaded-files/'.$filename;

	$err  = $_FILES['fileToUpload']['error'][$i];

	
		if (move_uploaded_file($temp, $uploadedFiles)) {
			// echo $location;
			if($i > 0){

			
			$addQry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
			INSERT INTO [@ATTACHMENT]
				(U_ObjectType, U_DocEntry, U_LineNo, U_FileName, U_FileLocation, U_AttachmentDate, U_FreeText)
			VALUES
				($u_objecType, $u_docentry, $i,  '$filename', '$location' , '$attachmentdate' , '$freetext')
			");
			 odbc_free_result($addQry);

	

			$filename_without_ext = pathinfo($filename, PATHINFO_FILENAME);		  
			$extension = pathinfo($filename, PATHINFO_EXTENSION);  
			

			$oAtc->Lines->Add();
			$oAtc->Lines->SourcePath ="C:\\xampp\\htdocs\\SAPB1Standard\\uploaded-files";
			$oAtc->Lines->FileName = $filename_without_ext;
			$oAtc->Lines->FileExtension = $extension;
			$oAtc->Lines->Override = 1;
			
			}
			
		} 

		if($i == $count-1){

			if($type == 'add'){
				$attachmentReturnVal = $oAtc->Add();
				if ($attachmentReturnVal == 0) {
					$vCmp->GetNewObjectCode($absentry);
					// $oRdr->AttachmentEntry = intval($absentry);
					$atcentry = intval($absentry);

					$updateOPCHQry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
					UPDATE ORPC SET AtcEntry = $atcentry WHERE DocEntry = $u_docentry
					
					");
					odbc_free_result($updateOPCHQry);
				}else{
					
				}	
			}else{
				$attachmentReturnVal = $oAtc->Update();
			}
			
		}
		
	}
		
	
	
	
	
	
	
		

	

	
	
}

$arr[] = array(
	'returnVal'=>$attachmentReturnVal,
	'filename_without_ext'=>$filename_without_ext,
	'extension'=>$extension


);
	echo json_encode($arr);
  
?>
