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

	$CardCodeArray = [];
	$CardNameArray = [];
	$ExistingItemCodeArray = [];
	$ExistingBillingNumberArrayPOD = [];
	

	// select * from [@PODSTATUS]
	// select * from [@BILLINGSTATUS]
	// select * from [@DELIVERYSTATUS]
	// select * from [@TRIPTYPE]
	// select * from [@SERVICETYPE]
	// select * from [@CATEGORYDR]
	// select * from [@TYPEOFACCESSORIAL]


	$VehicleOptionsQueryArray = [];
	$VehicleOptionsQueryArrayCode = [];

	$PODStatusQueryArray = [];
	$DeliveryStatusQueryArray = [];
	$DeliveryStatusQueryArrayCode = [];
	$TripTypeQueryArray = [];



	$cardCodes = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT CardCode  FROM [dbo].[OCRD] Order By CardCode ");

	while (odbc_fetch_row($cardCodes)) 
	{
		array_push($CardCodeArray,odbc_result($cardCodes, 'CardCode'));
		
		
	}

	$cardNames = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT CardName  FROM [dbo].[OCRD] Order By CardCode ");

	while (odbc_fetch_row($cardNames)) 
	{
		array_push($CardNameArray,odbc_result($cardNames, 'CardName'));
		
		
	}


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
	

	// select * from [@PODSTATUS]
	// select * from [@BILLINGSTATUS]
	// select * from [@DELIVERYSTATUS]
	// select * from [@TRIPTYPE]
	// select * from [@SERVICETYPE]
	// select * from [@CATEGORYDR]
	// select * from [@TYPEOFACCESSORIAL]


	$VehicleOptionsQuery = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT * FROM [@VEHICLETYPEANDCAP] ORDER BY Code");
	$VehicleOptionsResult = '';
	while (odbc_fetch_row($VehicleOptionsQuery)) 
	{
		$VehicleOptionsResult .= '<option data-code="'.odbc_result($VehicleOptionsQuery, 'Code').'" value="'.odbc_result($VehicleOptionsQuery, 'Name').'">' . odbc_result($VehicleOptionsQuery, 'Name') . '</option>';
		array_push($VehicleOptionsQueryArrayCode,odbc_result($VehicleOptionsQuery, 'Code'));
		array_push($VehicleOptionsQueryArray,odbc_result($VehicleOptionsQuery, 'Name'));


  
		
	}
	$PODStatusQuery = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT * FROM [@PODSTATUS]");
	$PODStatusResult = '';
	while (odbc_fetch_row($PODStatusQuery)) 
	{
		$PODStatusResult .= '<option value="'.odbc_result($PODStatusQuery, 'Code').'">' . odbc_result($PODStatusQuery, 'Name') . '</option>';
		array_push($PODStatusQueryArray,odbc_result($PODStatusQuery, 'Name'));
		
	}

	$DeliveryStatusOptionsQuery = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT * FROM [@DELIVERYSTATUS]");
	$DeliveryStatusOptionsResult = '';
	while (odbc_fetch_row($DeliveryStatusOptionsQuery)) 
	{
		$DeliveryStatusOptionsResult .= '<option data-code="'.odbc_result($VehicleOptionsQuery, 'Code').'" value="'.odbc_result($DeliveryStatusOptionsQuery, 'Code').'">' . odbc_result($DeliveryStatusOptionsQuery, 'Name') . '</option>';
		array_push($DeliveryStatusQueryArrayCode,odbc_result($DeliveryStatusOptionsQuery, 'Code'));
		array_push($DeliveryStatusQueryArray,odbc_result($DeliveryStatusOptionsQuery, 'Name'));
		
	}
	$TripTypeOptionsQuery = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT * FROM [@TRIPTYPE]");
	$TripTypeOptionsResult = '';
	while (odbc_fetch_row($TripTypeOptionsQuery)) 
	{
		$TripTypeOptionsResult .= '<option value="'.odbc_result($TripTypeOptionsQuery, 'Code').'">' . odbc_result($TripTypeOptionsQuery, 'Name') . '</option>';
		array_push($TripTypeQueryArray,odbc_result($TripTypeOptionsQuery, 'Name'));
		
	}




	function validDate($value){
						$UploadStatus = '<span class="text-success">SUCCESS</span>';
						$ErrorMessage = '';
						
						$valueGiven = $value;
						$result = true;
						$valid = 0;
						$ValidMonthArray = [
							"01","02","03","04","05","06","07","08","09","10","11","12"

						];
						$ValidDayArray = [
							"01","02","03","04","05","06","07","08","09","10",
							"11","12","13","14","15","16","17","18","19","20",
							"21","22","23","24","25","26","27","28","29","30","31"
						];
						$ValidYearArray = [
							"2010","2011","2012","2013","2014","2015","2016",
							"2017","2018","2019","2020","2021","2022","2023",
							"2024","2025","2026","2027","2028","2029","2030"
						];

						$month = substr($valueGiven,-10, 2);
						$month2 = substr($valueGiven,-9, 1);
						$firstSlash = substr($valueGiven,-5, 1);
						$day = substr($valueGiven,-7, 2);
						$secondSlash = substr($valueGiven,-8, 1);
						$year = substr($valueGiven,-4, 4);

						if(strlen($valueGiven) == 10){
							$valid += 1;
						}
						if(in_array($month, $ValidMonthArray) ){
							$valid += 1;
						}

						if($firstSlash == '/' ){
							$valid += 1;
						}
						if(in_array($day, $ValidDayArray) ){
							$valid += 1;
						}
						if($secondSlash == '/' ){
							$valid += 1;
						}
						if(in_array($year, $ValidYearArray) ){
							$valid += 1;
						}

						if($valid == 6){
							$result = true;
							// $result = $year . '-' . $month . '-' . $day;
						}
						else{
							$result =  false;
							
						}
						
						return $result;

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
						empty($getData[4]) ? 'empty' : $getData[4],
						empty($getData[6]) ? 'empty' : $getData[6],
						empty($getData[8]) ? 'empty' : $getData[8],
						empty($getData[10]) ? 'empty' : $getData[10],
						empty($getData[13]) ? 'empty' : $getData[13],
					
						
					];

					$requiredFieldError = 0;
					$requiredFieldIconCounter = '';	
					foreach ($RequiredFieldsArray as $value) {
						if($value == 'empty'){
							$requiredFieldError += 1;
							$generalRequiredErrors +=1;
						}
					}
					if (in_array($getData[10], $VehicleOptionsQueryArray)){
					 
					}
					else{
							
							$UploadStatus = '<span class="text-danger"><b>FAILED</b></span>';
							$validValuesFieldError += 1;
							$generalInvalidValueErrors += 1;
					}



					if ($requiredFieldError > 0){
						$UploadStatus = '<span class="text-danger"><b>FAILED</b></span>';
						$requiredFieldIconCounter = '<i class="fa fa-exclamation-triangle text-danger required" style="font-size: 20px !important"aria-hidden="true"></i><span class="requirederror">' . $requiredFieldError . '</span><br/>';	
					}


				

					//VALID VALUES FROM SAP
					if(empty($getData[6])){

					}else{
						if (in_array($getData[6], $CardCodeArray)){
						 
						}
						else{
								$UploadStatus = '<span class="text-danger"><b>FAILED</b></span>';
								$validValuesFieldError += 1;
								$generalInvalidValueErrors += 1;
							
						}	
					}
					if(empty($getData[8])){

					}else{
						if (in_array($getData[8], $CardCodeArray)){
						 
						}
						else{
								$UploadStatus = '<span class="text-danger"><b>FAILED</b></span>';
								$validValuesFieldError += 1;
								$generalInvalidValueErrors += 1;
						}	
					}
					
					if(empty($getData[13])){

					}else{
						if(in_array($getData[13], $DeliveryStatusQueryArray)){
						
						}else{
							$UploadStatus = '<span class="text-danger"><b>FAILED</b></span>';
							$validValuesFieldError += 1;
							$generalInvalidValueErrors += 1;
						}
					}
				
					if(empty($getData[16])){

					}else{
						if(in_array($getData[16], $TripTypeQueryArray)){
						
						}else{
							$UploadStatus = '<span class="text-danger"><b>FAILED</b></span>';
							$validValuesFieldError += 1;
							$generalInvalidValueErrors += 1;
						}
					}

					if(!empty($getData[15]) && !is_numeric($getData[15])){
						$UploadStatus = '<span class="text-danger"><b>FAILED</b></span>';
						$validValuesFieldError += 1;
						$generalInvalidValueErrors += 1;
					}
					if(strlen($getData[11]) <= 100000){

					}else{
						$UploadStatus = '<span class="text-danger"><b>FAILED</b></span>';
						$validValuesFieldError += 1;
						$generalInvalidValueErrors += 1;
					}
					if(strlen($getData[12]) <= 100000){

					}else{
						$UploadStatus = '<span class="text-danger"><b>FAILED</b></span>';
						$validValuesFieldError += 1;
						$generalInvalidValueErrors += 1;
					}
					if(strlen($getData[17]) <= 100000){

					}else{
						$UploadStatus = '<span class="text-danger"><b>FAILED</b></span>';
						$validValuesFieldError += 1;
						$generalInvalidValueErrors += 1;
					}



						//VALID DATE FORMAT
					validDate($getData[3]) ? '' : $dateFormatFieldError+= 1 ;
					!empty($getData[14]) ? (validDate($getData[14]) ? '' : $dateFormatFieldError+= 1) : ''; 
					


					validDate($getData[3]) ?$generalDateFormatError : $generalDateFormatError+= 1;
					
					!empty($getData[14]) ? (validDate($getData[14]) ?$generalDateFormatError : $generalDateFormatError+= 1)  : $generalDateFormatError;

					
					$validValuesFieldErrorCounter = '';	
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

				


					$ExistingBookingNumberFieldIconInPOD = '';
					$ExistingBookingNumberFieldIcon = '';
					if(empty($getData[4])){

					}else{
						if (in_array($getData[4], $ExistingBillingNumberArrayPOD)){
						$ExistingBookingNumberFieldIconInPOD = '<i class="fa fa-exclamation-triangle text-secondary"style="font-size: 20px" aria-hidden="true" 
						></i>';
						$podPostedInPODCount+=1;
						}
						if (in_array($getData[4], $ExistingItemCodeArray)){
							$ExistingBookingNumberFieldIcon = '<i class="fa fa-exclamation-triangle text-primary"style="font-size: 20px" aria-hidden="true" 
							></i>';
								$existingBookingNumberCount +=1;
						}
					}
					


					$requiredFieldIcon = '<i class="fa fa-exclamation-triangle text-danger" style="font-size: 20px !important"aria-hidden="true"></i>';
					$validValueFieldIcon = '<i class="fa fa-exclamation-triangle validerrorpercell" style="color: #964B00!important;font-size: 20px !important" aria-hidden="true"></i>';
					$dateNotValidFormatFieldIcon = '<i class="fa fa-exclamation-triangle text-warning" style="font-size: 20px" aria-hidden="true"></i>';


					$existingBookingNumber =  in_array($getData[4], $ExistingItemCodeArray) ? $ExistingBookingNumberFieldIcon : $getData[4];
					$ctrCheckBox =  '<div class="form-check text-center">
					  <input class="form-check-input selector-row" type="checkbox" id="check1" name="option1" value="'.$ctr.'" style="width: 30px; height: 30px;">
					</div>';

					$VehicleOptions = '<div class="input-group ">
						<select type="text" class="form-control taxcode"  placeholder="">'.
							$VehicleOptionsResult
						.'</select>
					</div>';

					$key = array_search($getData[10], $VehicleOptionsQueryArray);
					$selectedVehicleCode = $VehicleOptionsQueryArrayCode[$key];

					$key2 = array_search($getData[13], $DeliveryStatusQueryArray);
					$selectedDeliveryCode = $DeliveryStatusQueryArrayCode[$key2];

					$selectedVehicleOption = '<option data-code="'.$selectedVehicleCode.'" value="'.$getData[10].'">' . $getData[10] . '</option>';
					$selectedDeliveryOption = '<option data-code="'.$selectedDeliveryCode.'" value="'.$getData[13].'">' . $getData[13] . '</option>';



					$DeliveryStatusOptions = '<div class="input-group ">
						<select type="text" class="form-control taxcode"  placeholder="">'.
							$DeliveryStatusOptionsResult
						.'</select>
					</div>';
					$TripTypeOptions = '<div class="input-group ">
						<select type="text" class="form-control taxcode"  placeholder="">'.
							$TripTypeOptionsResult
						.'</select>
					</div>';



					

					$key = array_search(trim($getData[6], " "), $CardCodeArray);
					$key2 = array_search(trim($getData[8], " "), $CardCodeArray);

					$ErrorMessage = $requiredFieldIconCounter.$validValuesFieldErrorCounter.$dateFormatFieldErrorCounter.$duplicateFieldIconCounter.$ExistingBookingNumberFieldIcon.$ExistingBookingNumberFieldIconInPOD;




					$table[] = array(
				   'rowNumber'  => $ctr,
				   'ErrorMessage'  => $ErrorMessage,
				   'UploadStatus'  => $UploadStatus,
				   'BookingDate'  =>  empty($getData[3]) ? $requiredFieldIcon : ($getData[3] ? $getData[3] : $dateNotValidFormatFieldIcon .  ' ' . $getData[3] ),
				   'BookingNumber'  => empty($getData[4]) ? $requiredFieldIcon : $getData[4],
				   'ClientName'  => $CardNameArray[$key],
				   'SAPClientCode'  =>  empty($getData[6]) ? $requiredFieldIcon : (in_array($getData[6], $CardCodeArray) ? $getData[6] : $validValueFieldIcon .  ' ' .  $getData[6]),
				   'TruckerName'  =>$CardNameArray[$key2],
				   'SAPVendorCode'  =>  empty($getData[8]) ? $requiredFieldIcon : (in_array($getData[8], $CardCodeArray) ? $getData[8] : $validValueFieldIcon .  ' ' .  $getData[8]),
				   'PlateNumber'  => empty($getData[9]) ? '-' : $getData[9],
				   'VehicleType'  =>  
							in_array($getData[10], $VehicleOptionsQueryArray) ? 
							'<div class="input-group vehicleoption option valid">
							<select type="text" class="form-control required" style="border: none !important">
							<option data-code="'.$selectedVehicleCode.'" value="'.$getData[10].'">' . $getData[10] . '</option>'.

							$VehicleOptionsResult
							.'</select>
						</div>'
					   : '<div class="input-group vehicleoption option invalid">
					   		'.$validValueFieldIcon .'
							<select type="text" class="form-control required" style="border: none !important">
							<option data-code="'.$selectedVehicleCode.'" value="'.$getData[10].'">' . $getData[10] . '</option>'.

							$VehicleOptionsResult
							.'</select>
						</div>',
				   'DeliveryOrigin'  => !empty($getData[11]) ? strlen($getData[11]) <= 10000 ? $getData[11] : $validValueFieldIcon .  ' ' .  $getData[11] : '-',
				   'Destination'  =>!empty($getData[12]) ? strlen($getData[12]) <= 10000 ? $getData[12] : $validValueFieldIcon .  ' ' .  $getData[12] : '-',
				   'DeliveryStatus'  =>  empty($getData[13]) ? $requiredFieldIcon : 
							(in_array($getData[13], $DeliveryStatusQueryArray) ? 
							'<div class="input-group deliverystatusoption option valid">
							<select type="text" class="form-control required" style="border: none !important">
							<option data-code="'.$selectedDeliveryCode.'" value="'.$getData[13].'">'.$getData[13].'</option>'.
							$DeliveryStatusOptionsResult
							.'</select>
						</div>'
						: '<div class="input-group deliverystatusoption option invalid">
					   		'.$validValueFieldIcon .'
							<select type="text" class="form-control required" style="border: none !important">
							<option class="wrongvalue" data-code="'.$selectedDeliveryCode.'" value="'.$getData[13].'">'.$getData[13].'</option>'.
							$DeliveryStatusOptionsResult
							.'</select>
						</div>'),
				   'DeliveryCompletionDate'  =>empty($getData[14]) ? $getData[14] : ($getData[14] ? $getData[14] : $dateNotValidFormatFieldIcon. ' ' .  $getData[14]),
				   'NoOfDropsOnTripTicket'  => empty($getData[15]) ? 0 : (is_numeric($getData[15]) ? $getData[15] : $validValueFieldIcon. ' ' .  $getData[15]),
				   'TripType'  => 
							!empty($getData[16]) ? in_array($getData[16], $TripTypeQueryArray) ? 
							'<div class="input-group triptype option valid">
							<select type="text" class="form-control " style="border: none !important">
							<option value="'.$getData[16].'">'.$getData[16].'</option>'.
							$TripTypeOptionsResult
							.'</select>
						</div>'
						: 	'<div class="input-group triptype option invalid">
							'.$validValueFieldIcon .'
							<select type="text" class="form-control " style="border: none !important">
							<option class="wrongvalue" value="'.$getData[16].'">'.$getData[16].'</option>'.
							$TripTypeOptionsResult
							.'</select>
						</div>'


						 : $getData[16],
				   'Remarks'  => strlen($getData[17]) <= 10000 ? $getData[17] : $validValueFieldIcon .  ' ' .  $getData[17],
				   'DocNum'  => strlen($getData[18]) <= 100 ? $getData[18] : $validValueFieldIcon .  ' ' .  $getData[18],
				 	

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
						"generalDuplicateError"=>$generalDuplicateError,
						"existingBookingNumberCount"=>$existingBookingNumberCount,
						"podPostedInPODCount"=>$podPostedInPODCount,
						"cardCode"=>"$key",
						"cardName"=>$CardNameArray[$key]

					);
		echo json_encode($data);
		//echo json_encode($table);
		
	}
	else
	{
		echo 'FAILURE!';
	
	}

?>
	