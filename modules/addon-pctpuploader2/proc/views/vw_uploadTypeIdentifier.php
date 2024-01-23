<?php 
session_start();
include('../../../../config/config.php');

	$err = 0;
	$errmsg = '';
	$ItemCode = '';

	
	$htmlHeader = '';
	$htmlBody = '';
	$table[] = '';
	$highlight = '';
	$row=1;
	$UploadStatus = '<span class="text-success">SUCCESS</span>';
	$ErrorMessage = '';


	$filename=$_FILES["txtFile1"]["tmp_name"];		


	$uploaderType = 0;
	
	if($uploaderType == 0){


	if($_FILES["txtFile1"]["size"] > 0)
	{
		$file = fopen($filename, "r");
		$ctr = 1;
		
		$find_header = 0;
		while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
		{
			
				
				$row++;//starts off with $row = 1
				if($row == 2)//rows 2,3,4,5
			    {
			    	if($getData[0] == 'PCTP UPLOADER 1'){
			    		$uploaderType = 1;
			    	}
					$ctr += 1;
				}
			
			
			$find_header++;
		}
		
		fclose($file);	
	}
}

	
	
	if ($err == 0) 
	{

		$data = array("table"=>$table, 
						"uploaderType"=>$uploaderType,
					

					);
		echo json_encode($data);
		
	}
	else
	{
		echo 'FAILURE!';
	
	}

?>
	