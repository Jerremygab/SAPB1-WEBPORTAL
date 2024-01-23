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

	$generalRequiredErrors = 0;
	$generalInvalidValueErrors = 0;
	$generalDateFormatError=0;
	$generalDuplicateError=0;
	$existingBookingNumberCount = 0;
	$newBookingNumberCount=0;
	$podPostedInPODCount=0;
	$podPostedInBILLINGCount=0;

	$podPostedInSoCount=0;
	$podPostedInARCount=0;
	$podPostedInAPCount=0;
	$PCTPReadyCount=0;
	$SAPReadyCount=0;
	$ClientTotal=0;
	$ClientTotalUploaded=0;
	$TruckerTotal=0;
	$TruckerTotalUploaded=0;

	$RateBasis = [];
	$CardNameArray = [];
	$ExistingItemCodeArray = [];
	$ExistingBillingNumberArrayPOD = [];


	$VehicleOptionsQueryArray = [];
	$VehicleOptionsQueryArrayCode = [];

	$itemCodes = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT ItemCode FROM OITM ");

	while (odbc_fetch_row($itemCodes)) 
	{
		array_push($ExistingItemCodeArray,odbc_result($itemCodes, 'ItemCode'));
		
		
	}
	$billingNumbersPOD = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT U_BookingNumber FROM [dbo].[@PCTP_POD] ");

	while (odbc_fetch_row($billingNumbersPOD)) 
	{
		array_push($ExistingBillingNumberArrayPOD,odbc_result($billingNumbersPOD, 'U_BookingNumber'));
		
		
	}
	

	$VehicleOptionsQuery = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT * FROM [@RATEBASIS] ORDER BY Code");
	$VehicleOptionsResult = '';
	while (odbc_fetch_row($VehicleOptionsQuery)) 
	{
		$VehicleOptionsResult .= '<option data-code="'.odbc_result($VehicleOptionsQuery, 'Code').'" value="'.odbc_result($VehicleOptionsQuery, 'Name').'">' . odbc_result($VehicleOptionsQuery, 'Name') . '</option>';
		array_push($VehicleOptionsQueryArrayCode,odbc_result($VehicleOptionsQuery, 'Code'));
		array_push($VehicleOptionsQueryArray,odbc_result($VehicleOptionsQuery, 'Name'));


  
		
	}
	


	$filename=$_FILES["txtFile1"]["tmp_name"];		


	$cnt = 0;
	$arr=array();
	// if (($handle = fopen("1.csv", "r")) !== FALSE) {
	//     while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
	        
	//     }
	//     fclose($handle);
	// }
	// print_r($arrdup);


	
	if($_FILES["txtFile1"]["size"] > 0)
	{
		$file = fopen($filename, "r");
		$ctr = 1;
		
		$find_header = 0;
		while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
		{
			if($find_header != 0)
			{
				
				$row++;//starts off with $row = 1
				if (($row>2))//rows 2,3,4,5
			    {

			    	$requiredFieldError = 0;
			    	$validValuesFieldError = 0;
			    	$notInSapFieldError = 0;
			    	$dateFormatFieldError = 0;
			    	$duplicateFieldError = 0;
			    	$UploadStatus = '<span class="text-success">SUCCESS</span>';
			    	$ErrorMessage = '';
			    	

			    	$duplicateFieldIconCounter = '';
			    	$num=count($getData);
			        $cnt++;	
			        // for ($c=0; $c < $num; $c++) {
			           if(!empty($getData[4])){
			                if (array_key_exists($getData[4], $arr)) {
			                	$duplicateFieldError += 1;
			               		if ($duplicateFieldError > 0){
									$UploadStatus = '<span class="text-danger"><b>FAILED</b></span>';
									$duplicateFieldIconCounter = '<i class="fa fa-exclamation-triangle duplicate" style="font-size: 20px !important; color:black"aria-hidden="true"></i><span class="duplicate"></span><br/>';	
									$generalDuplicateError += 1;
								}

			                }
			                    
			                else{

			                    $arr[$getData[4]] = $getData[4];
			                }
			            }   
			       // }


					$RequiredFieldsArray = [ 
						empty($getData[3]) ? 'empty' : $getData[3],
					
						
					];

					
					$requiredFieldIconCounter = '';	
					if ($requiredFieldError > 0){
						$UploadStatus = '<span class="text-danger"><b>FAILED</b></span>';
						$requiredFieldIconCounter = '<i class="fa fa-exclamation-triangle text-danger required" style="font-size: 20px !important"aria-hidden="true"></i><span class="requirederror">' . $requiredFieldError . '</span><br/>';	
					}


					$key = array_search($getData[99], $VehicleOptionsQueryArray);
					$selectedVehicleCode = $VehicleOptionsQueryArrayCode[$key];

					$key2 = array_search($getData[103], $VehicleOptionsQueryArray);
					$selectedVehicleCode2 = $VehicleOptionsQueryArrayCode[$key2];

				


						//VALID DATE FORMAT
					$ExistingBookingNumberFieldIconInPOD = '';
					$ExistingBookingNumberFieldIcon = '';
					$validValuesFieldErrorCounter = '';	
					if(empty($getData[4])){

					}else{
						if (in_array($getData[4], $ExistingBillingNumberArrayPOD)){

						$ExistingBookingNumberFieldIconInPOD = '<i class="fa fa-exclamation-triangle text-secondary"style="font-size: 20px" aria-hidden="true" 
						></i>';
						$podPostedInPODCount+=1;
						}else{
							$UploadStatus = '<span class="text-danger"><b>FAILED</b></span>';
							$validValuesFieldErrorCounter = '<i class="fa fa-exclamation-triangle validerroricon" style="font-size: 20px !important; color: #964B00" aria-hidden="true"></i><span class="validerror">' . $validValuesFieldError . '</span><br/>';	
							$validValuesFieldError+=1;
							$generalInvalidValueErrors+=1;
						}
						
					}


					
					
					if ($validValuesFieldError > 0){
						$validValuesFieldErrorCounter = '<i class="fa fa-exclamation-triangle validerroricon" style="font-size: 20px !important; color: #964B00" aria-hidden="true"></i><span class="validerror">' . $validValuesFieldError . '</span><br/>';	
					}
					
					$notInSapFieldErrorCounter = '';	
					if ($notInSapFieldError > 0){
						$UploadStatus = '<span class="text-danger"><b>FAILED</b></span>';
						$notInSapFieldErrorCounter = '<i class="fa fa-exclamation-triangle " style="font-size: 20px !important;color: #E89020"aria-hidden="true"></i><span class="notinsaperror">' . $notInSapFieldError . '</span><br/>';	
					}
					$dateFormatFieldErrorCounter = '';	
					if ($dateFormatFieldError > 0){
						$UploadStatus = '<span class="text-danger"><b>FAILED</b></span>';
						$dateFormatFieldErrorCounter = '<i class="fa fa-exclamation-triangle text-warning" style="font-size: 20px !important;"aria-hidden="true"></i><span class="dateformaterror">' . $dateFormatFieldError . '</span><br/>';	
					}

				



					


					$requiredFieldIcon = '<i class="fa fa-exclamation-triangle text-danger" style="font-size: 20px !important"aria-hidden="true"></i>';
					$validValueFieldIcon = '<i class="fa fa-exclamation-triangle validerrorpercell" style="color: #964B00!important;font-size: 20px !important" aria-hidden="true"></i>';
					$dateNotValidFormatFieldIcon = '<i class="fa fa-exclamation-triangle text-warning" style="font-size: 20px" aria-hidden="true"></i>';


					$existingBookingNumber =  in_array($getData[4], $ExistingItemCodeArray) ? $ExistingBookingNumberFieldIcon : $getData[4];
					$ctrCheckBox =  '<div class="form-check text-center">
					  <input class="form-check-input selector-row" type="checkbox" id="check1" name="option1" value="'.$ctr.'" style="width: 30px; height: 30px;">
					</div>';

			

					if (in_array($getData[99], $VehicleOptionsQueryArray)){
					 
					}
					else{
							
							$UploadStatus = '<span class="text-danger"><b>FAILED</b></span>';
							$validValuesFieldError += 1;
							$generalInvalidValueErrors += 1;
					}
					
						$VehicleOptions = '<div class="input-group ">
						<select type="text" class="form-control taxcode"  placeholder="">'.
							$VehicleOptionsResult
						.'</select>
					</div>';

					if (in_array($getData[103], $VehicleOptionsQueryArray)){
					 
					}
					else{
							
							$UploadStatus = '<span class="text-danger"><b>FAILED</b></span>';
							$validValuesFieldError += 1;
							$generalInvalidValueErrors += 1;
					}
					
						$VehicleOptions = '<div class="input-group ">
						<select type="text" class="form-control taxcode"  placeholder="">'.
							$VehicleOptionsResult
						.'</select>
					</div>';
			


						$ClientTotal+=empty($getData[97]) ? 0 : str_replace(',', '', $getData[97]);
						$ClientTotalUploaded=0;
						$TruckerTotal+=empty($getData[101]) ? 0 : str_replace(',', '', $getData[101]);
						$TruckerTotalUploaded=0;


					$ErrorMessage = $requiredFieldIconCounter.$validValuesFieldErrorCounter.$dateFormatFieldErrorCounter.$duplicateFieldIconCounter.$ExistingBookingNumberFieldIcon.$ExistingBookingNumberFieldIconInPOD;

					$table[] = array(
				   'rowNumber'  => $ctr,
				   'ErrorMessage'  => $ErrorMessage,
				   'UploadStatus'  => $UploadStatus,
				   'BookingNumber'  =>  empty($getData[4]) ? $requiredFieldIcon : $getData[4],
				   
				   'GROSSClientRates'  => empty($getData[97]) ? 0 : $getData[97],
				   'RateBasis'  => in_array($getData[99], $VehicleOptionsQueryArray) ? 
							'<div class="input-group vehicleoption option valid">
							<select type="text" class="form-control required" style="border: none !important">
							<option data-code="'.$selectedVehicleCode.'" value="'.$getData[99].'">' . $getData[99] . '</option>'.

							$VehicleOptionsResult
							.'</select>
						</div>'
					   : '<div class="input-group vehicleoption option invalid">
					   		'.$validValueFieldIcon .'
							<select type="text" class="form-control required" style="border: none !important">
							<option data-code="'.$selectedVehicleCode.'" value="'.$getData[99].'">' . $getData[99] . '</option>'.

							$VehicleOptionsResult
							.'</select>
						</div>',

				   'GROSSTruckerrates'  => empty($getData[101]) ? 0 : $getData[101],
				   'RateBasisTrucker'  => in_array($getData[103], $VehicleOptionsQueryArray) ? 
							'<div class="input-group vehicleoption option valid">
							<select type="text" class="form-control required" style="border: none !important">
							<option data-code="'.$selectedVehicleCode2.'" value="'.$getData[103].'">' . $getData[103] . '</option>'.

							$VehicleOptionsResult
							.'</select>
						</div>'
					   : '<div class="input-group vehicleoption option invalid">
					   		'.$validValueFieldIcon .'
							<select type="text" class="form-control required" style="border: none !important">
							<option data-code="'.$selectedVehicleCode2.'" value="'.$getData[103].'">' . $getData[103] . '</option>'.

							$VehicleOptionsResult
							.'</select>
						</div>',

				  
				   'DemurrageClient'  => empty($getData[105]) ? 0 : $getData[105],
				   'AddtlDropClient'  =>  empty($getData[106]) ? 0 : $getData[106],
				   'BoomTruckClient'  =>  empty($getData[107]) ? 0 : $getData[107],
				   'ManpowerClient'  =>  empty($getData[108]) ? 0 : $getData[108],
				   'BackloadClient'  =>  empty($getData[109]) ? 0 : $getData[109],
				  
				   'DemurrageTrucker'  =>  empty($getData[113]) ? 0 : $getData[113],
				   'AddtlDropTrucker'  =>  empty($getData[114]) ? 0 : $getData[114],
				   'BoomTruckTrucker'  =>  empty($getData[115]) ? 0 : $getData[115],
				   'ManpowerTrucker'  =>  empty($getData[116]) ? 0 : $getData[116],
				   'BackloadTrucker'  => empty($getData[117]) ? 0 : $getData[117],
				  	
				);
					$ctr += 1;
				}
			
				
			 }
			$find_header++;
		}
		
		fclose($file);	
	}

	
	
	if ($err == 0) 
	{

		$data = array("table"=>$table, 
						"generalRequiredErrors"=>$generalRequiredErrors,
						"generalInvalidValueErrors"=>$generalInvalidValueErrors,
						"generalDateFormatError"=>$generalDateFormatError,
						"existingBookingNumberCount"=>$existingBookingNumberCount,
						"newBookingNumberCount"=>$newBookingNumberCount,
						"podPostedInPODCount"=>$podPostedInPODCount,
						"podPostedInBILLINGCount"=>$podPostedInBILLINGCount,
						"podPostedInSoCount"=>$podPostedInSoCount,
						"podPostedInARCount"=>$podPostedInARCount,
						"podPostedInAPCount"=>$podPostedInAPCount,
						"SAPReadyCount"=>$SAPReadyCount,
						"PCTPReadyCount"=>$PCTPReadyCount,
						"ClientTotal"=>number_format($ClientTotal,2),
						"ClientTotalUploaded"=>$ClientTotalUploaded,
						"TruckerTotal"=>number_format($TruckerTotal,2),
						"TruckerTotalUploaded"=>$TruckerTotalUploaded,

					);
		echo json_encode($data);
		//echo json_encode($table);
		
	}
	else
	{
		echo 'FAILURE!';
	
	}

?>
	