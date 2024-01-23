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


	$RateBasisOptionsQueryArray = [];
	$RateBasisOptionsQueryArrayCode = [];

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
	

	
	$RateBasisOptionsQuery = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT * FROM [@RATEBASIS] ORDER BY Code");
	$RateBasisOptionsResult = '';
	while (odbc_fetch_row($RateBasisOptionsQuery)) 
	{
		$RateBasisOptionsResult .= '<option data-code="'.odbc_result($RateBasisOptionsQuery, 'Code').'" value="'.odbc_result($RateBasisOptionsQuery, 'Name').'">' . odbc_result($RateBasisOptionsQuery, 'Name') . '</option>';
		array_push($RateBasisOptionsQueryArrayCode,odbc_result($RateBasisOptionsQuery, 'Code'));
		array_push($RateBasisOptionsQueryArray,odbc_result($RateBasisOptionsQuery, 'Name'));


  
		
	}

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
							"2024","2025","2026","2027","2028","2029","2030",
							"2031","2032","2033","2034","2035","2036","2037",
							"2038","2039","2040","2041","2042","2043","2044",
							"2045","2046","2047","2048","2049","2050","2051"
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
						empty(utf8_encode($getData[13])) ? 'empty' : utf8_encode($getData[13]),
					
						
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
					
					if(empty($getData[16])){

					}else{
						if(in_array($getData[16], $DeliveryStatusQueryArray)){
						
						}else{
							$UploadStatus = '<span class="text-danger"><b>FAILED</b></span>';
							$validValuesFieldError += 1;
							$generalInvalidValueErrors += 1;
						}
					}
				
					if(empty($getData[20])){

					}else{
						if(in_array($getData[20], $TripTypeQueryArray)){
						
						}else{
							$UploadStatus = '<span class="text-danger"><b>FAILED</b></span>';
							$validValuesFieldError += 1;
							$generalInvalidValueErrors += 1;
						}
					}


					if(!empty($getData[19]) && !is_numeric($getData[19])){
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
					!empty($getData[17]) ? (validDate($getData[17]) ? '' : $dateFormatFieldError+= 1) : ''; 
					!empty($getData[18]) ? (validDate($getData[18]) ? '' : $dateFormatFieldError+= 1) : ''; 
					!empty($getData[31]) ? (validDate($getData[31]) ? '' : $dateFormatFieldError+= 1) : ''; 
					!empty($getData[32]) ? (validDate($getData[32]) ? '' : $dateFormatFieldError+= 1) : ''; 
					!empty($getData[33]) ? (validDate($getData[33]) ? '' : $dateFormatFieldError+= 1) : ''; 
					!empty($getData[34]) ? (validDate($getData[34]) ? '' : $dateFormatFieldError+= 1) : ''; 
					!empty($getData[35]) ? (validDate($getData[35]) ? '' : $dateFormatFieldError+= 1) : ''; 
					!empty($getData[37]) ? (validDate($getData[37]) ? '' : $dateFormatFieldError+= 1) : ''; 
					!empty($getData[40]) ? (validDate($getData[40]) ? '' : $dateFormatFieldError+= 1) : ''; 
					!empty($getData[86]) ? (validDate($getData[86]) ? '' : $dateFormatFieldError+= 1) : '';
					!empty($getData[141]) ? (validDate($getData[141]) ? '' : $dateFormatFieldError+= 1) : '';





					$key = array_search($getData[99], $RateBasisOptionsQueryArray);
					$selectedRateBasisCode = $RateBasisOptionsQueryArrayCode[$key];

					$key2 = array_search($getData[103], $RateBasisOptionsQueryArray);
					$selectedRateBasisCode2 = $RateBasisOptionsQueryArrayCode[$key2];





					validDate($getData[3]) ?$generalDateFormatError : $generalDateFormatError+= 1;
					
					!empty($getData[17]) ? (validDate($getData[17]) ?$generalDateFormatError : $generalDateFormatError+= 1)  : $generalDateFormatError;
					!empty($getData[18]) ? (validDate($getData[18]) ?$generalDateFormatError : $generalDateFormatError+= 1)  : $generalDateFormatError;
					!empty($getData[31]) ? (validDate($getData[31]) ?$generalDateFormatError : $generalDateFormatError+= 1)  : $generalDateFormatError;
					!empty($getData[32]) ? (validDate($getData[32]) ?$generalDateFormatError : $generalDateFormatError+= 1)  : $generalDateFormatError;
					!empty($getData[33]) ? (validDate($getData[33]) ?$generalDateFormatError : $generalDateFormatError+= 1)  : $generalDateFormatError;
					!empty($getData[34]) ? (validDate($getData[34]) ?$generalDateFormatError : $generalDateFormatError+= 1)  : $generalDateFormatError;
					!empty($getData[35]) ? (validDate($getData[35]) ?$generalDateFormatError : $generalDateFormatError+= 1)  : $generalDateFormatError;
					!empty($getData[37]) ? (validDate($getData[37]) ?$generalDateFormatError : $generalDateFormatError+= 1)  : $generalDateFormatError;
					!empty($getData[40]) ? (validDate($getData[40]) ?$generalDateFormatError : $generalDateFormatError+= 1)  : $generalDateFormatError;
					!empty($getData[86]) ? (validDate($getData[86]) ?$generalDateFormatError : $generalDateFormatError+= 1)  : $generalDateFormatError;
					!empty($getData[141]) ? (validDate($getData[141]) ?$generalDateFormatError : $generalDateFormatError+= 1)  : $generalDateFormatError;


					
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

					$key2 = array_search($getData[16], $DeliveryStatusQueryArray);
					$selectedDeliveryCode = $DeliveryStatusQueryArrayCode[$key2];

					$selectedVehicleOption = '<option data-code="'.$selectedVehicleCode.'" value="'.$getData[10].'">' . $getData[10] . '</option>';
					$selectedDeliveryOption = '<option data-code="'.$selectedDeliveryCode.'" value="'.$getData[16].'">' . $getData[16] . '</option>';



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
				   'BookingDate'  => validDate($getData[3]) ? $getData[3] : $dateNotValidFormatFieldIcon .  ' ' . $getData[3] ,
				   'BookingNumber'  =>  empty($getData[4]) ? $requiredFieldIcon : $getData[4],
				   'ClientName'  => empty($getData[5]) ? $requiredFieldIcon : $getData[5],
				   'SAPClientCode'  => in_array($getData[6], $CardCodeArray) ? $getData[6] : $validValueFieldIcon .  ' ' .  $getData[6],
				   'TruckerName'  => empty($getData[7]) ? $requiredFieldIcon : $getData[7],
				   'SAPVendorCode'  => empty($getData[8]) ? $requiredFieldIcon : $getData[8],
				   'PlateNumber'  => empty($getData[9]) ? $requiredFieldIcon : $getData[9],
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
				   'IslandOrigin'  => empty($getData[12]) ? $requiredFieldIcon : $getData[12],
				   'Destination'  =>!empty(($getData[13])) ? strlen(($getData[13])) <= 10000 ? ($getData[13]) : $validValueFieldIcon .  ' ' .  ($getData[13]) : '-',
				   'IslandDestination'  => empty($getData[14]) ? $requiredFieldIcon : $getData[14],
				   'IfInterIsland'  => empty($getData[15]) ? $requiredFieldIcon : $getData[15],
				   'DeliveryStatus'  =>  empty($getData[16]) ? $requiredFieldIcon : 
							(in_array($getData[16], $DeliveryStatusQueryArray) ? 
							'<div class="input-group deliverystatusoption option valid">
							<select type="text" class="form-control required" style="border: none !important">
							<option data-code="'.$selectedDeliveryCode.'" value="'.$getData[16].'">'.$getData[16].'</option>'.
							$DeliveryStatusOptionsResult
							.'</select>
						</div>'
						: '<div class="input-group deliverystatusoption option invalid">
					   		'.$validValueFieldIcon .'
							<select type="text" class="form-control required" style="border: none !important">
							<option class="wrongvalue" data-code="'.$selectedDeliveryCode.'" value="'.$getData[16].'">'.$getData[16].'</option>'.
							$DeliveryStatusOptionsResult
							.'</select>
						</div>'),
				   'DeliveryCompletionDate'  =>validDate($getData[17]) ? $getData[17] : $dateNotValidFormatFieldIcon . ' ' .  $getData[17],


				   'DeliveryCompleteDatePERPOD'  => validDate($getData[18]) ? $getData[18] : $dateNotValidFormatFieldIcon . ' ' .  $getData[18],
				   'NoOfDropsOnTripTicket'  => empty($getData[19]) ? 0 : (is_numeric($getData[19]) ? $getData[19] : $validValueFieldIcon. ' ' .  $getData[19]),
				   'TripType'  => 
							!empty($getData[20]) ? in_array($getData[20], $TripTypeQueryArray) ? 
							'<div class="input-group triptype option valid">
							<select type="text" class="form-control " style="border: none !important">
							<option value="'.$getData[20].'">'.$getData[20].'</option>'.
							$TripTypeOptionsResult
							.'</select>
						</div>'
						: 	'<div class="input-group triptype option invalid">
							'.$validValueFieldIcon .'
							<select type="text" class="form-control " style="border: none !important">
							<option class="wrongvalue" value="'.$getData[20].'">'.$getData[20].'</option>'.
							$TripTypeOptionsResult
							.'</select>
						</div>'


						 : '<div class="input-group triptype option invalid">
							
							<select type="text" class="form-control " style="border: none !important">
							<option class="wrongvalue" value=""></option></select>',
				   'RemarksPOD'  => $getData[21],
				   'DocumentNumber'=> $getData[22],
				   'TripTicketNo'  => $getData[23],
				   'WayBillNo'  => $getData[24],
				   'ShipNoManifestNo'  => $getData[25],
				   'DeliveryReceiptNo'  => $getData[26],
				   'SeriesNo'  => $getData[27],
				   'OtherPODDocument'  => $getData[28],
				   'Remarks'  => $getData[29],
				   'ReceivedBy'  => $getData[30],
				   'ClientReceivedDate'  => validDate($getData[31]) ? $getData[31] : $dateNotValidFormatFieldIcon . ' ' . $getData[31],
				   'ActualDateRecievedSoftCopyInitial'=> validDate($getData[32]) ? $getData[32] : $dateNotValidFormatFieldIcon . ' ' . $getData[32],
				   'InitialHCInteluckReceivedDate'=> validDate($getData[33]) ? $getData[33] : $dateNotValidFormatFieldIcon . ' ' . $getData[33],
				   'ActualHC'=> validDate($getData[34]) ? $getData[34] : $dateNotValidFormatFieldIcon . ' ' . $getData[34],
				   'DateReturn'  => validDate($getData[35]) ? $getData[35] : $dateNotValidFormatFieldIcon . ' ' . $getData[35],
				   'PODincharge'  => $getData[36],
				   'VERIFIEDDATEHardCopyGOOD'   => validDate($getData[37]) ? $getData[37]: $dateNotValidFormatFieldIcon .  ' ' . $getData[37],
				   'PODstatusdetail'  => $getData[38],
				   'PTFPODTransmittalFormNo'  => $getData[39],
				   'Date'  => validDate($getData[40]) ? $getData[40] : $dateNotValidFormatFieldIcon . ' ' . $getData[40],
				   'PODTurnAround'  => empty($getData[41]) ? 0 : $getData[41],
				   'BILLINGSTATUS'  => $getData[42],
				   'SERVICETYPE'  => $getData[43],
				   'SINo'  => $getData[44],
				   'BillingTeamInCharge'  => $getData[45],
				   'BTRemarks'  => $getData[46],
				   'SOBNumber'  => $getData[47],
				   'OutletNoCriteriaforGetColaRates'  => $getData[48],
				   'SalesInvoiceNoDeliveryReceiptNo'  => $getData[49],
				   'CBMCubicmeterBasedonSIDR'  => empty($getData[50]) ? 0 : $getData[50],
				   'DeliveryModeAlwaysLANDTRIP'  => $getData[51],
				   'SourceWhseBasedonDTTstamp'  => $getData[52],
				   'DestinationClientsCustomer'  => $getData[53],
				   'TotalInvoiceAmount'  => empty($getData[54]) ? 0 : $getData[54],
				   'SONolistedonDeliveryReceipt'  => $getData[55],
				   'NameofCustomer'  => $getData[56],
				   'CategorylistedonDeliveryReceipt'  => $getData[57],
				   'ForwardLoadtotalthequantitylistedonHTT'  => $getData[58],
				   'BackLoadtotalthequantitylistedonHTT'  => $getData[59],
				   'IDNumber'  => $getData[60],
				   'TYPEOFACCESSORIAL'  => $getData[61],
				   'STATUS'  => $getData[62],
				   'TIMEINEmptyDemurrage'  => $getData[63],
				   'TIMEOUTEmptyDemurrage'  => $getData[64],
				   'VERIFIEDEMPTYDEMURRAGE'  => $getData[65],
				   'TIMEINLoadedDemurrage'  => $getData[66],
				   'TIMEOUTLoadedDemurrage'  => $getData[67],
				   'VERIFIEDLOADEDDEMURRAGE'  => $getData[68],
				   'Remarks2'  => $getData[69],
				   'TIMEINAdvanceloading'  => $getData[70],
				   'DAYOFTHEWEEK'  => empty($getData[71]) ? 0 : $getData[71],
				   'TIMEIN'  => empty($getData[72]) ? 0 : $getData[72], 
				   'TIMEOUT'  => empty($getData[73]) ? 0 : $getData[73],
				   'TOTALNOEXCEEDOvertime'  => empty($getData[74]) ? 0 : $getData[74],
				   'ODOIN'  => empty($getData[75]) ? 0 : $getData[75],
				   'ODOOUT'  => empty($getData[76]) ? 0 : $getData[76],
				   'TOTALUSAGE'  =>  empty($getData[77]) ? 0 : $getData[77],
				   'NAMEOFDRIVER'  => $getData[78],
				   'ISSUESENCOUNTERED'  => $getData[79],
				   'ACTIONTAKENPLAN'  => $getData[80],
				   'STATUS'  => $getData[81],
				 
				   'CLIENTSUBMISSIONSTATUS'  => $getData[82],
				   'ClientSubmissionOverdueDays'  => $getData[83],
				   'CPenaltyCaculation'  => $getData[84],
				   'PODSTATUSforPaymentprocessing'  => $getData[85],
				   'PODSUBMITDEADLINE'  => validDate($getData[86]) ? $getData[86] : $dateNotValidFormatFieldIcon .  ' ' . $getData[86] ,
				   'OVERDUEDAYS'  => empty($getData[87]) ? 0 : $getData[87],
				   'IPennaltyCaculation'  => $getData[88],
				   'WaiveddaysLatePODresponse'  => $getData[89],
				   'HolidayorWeekend'  => $getData[90],
				   'LostPennaltyCaculation'  => $getData[91],
				   'TOTALSUBMISSIONPENALTIES'  => empty($getData[92]) ? 0 : $getData[92],
				   'WAIVEDIFYAddherereferenceIfNAddhereBSDapprover'  => $getData[93],
				   'PENALTYCHARGED'  => $getData[94],
				   'Approvedby'  => $getData[95],
				   'TOTALPENALTYWAIVED'  => empty($getData[96]) ? 0 : $getData[96],
				   'GROSSClientRates'  => empty($getData[97]) ? 0 : $getData[97],
				   'GROSSClientratesCONSIDERINGNONVATRATEIFFORMULA'  => empty($getData[98]) ? 0 : $getData[98],
				   'RateBasis'  => in_array($getData[99], $RateBasisOptionsQueryArray) ? 
							'<div class="input-group RateBasisoption option valid">
							<select type="text" class="form-control required" style="border: none !important">
							<option data-code="'.$selectedRateBasisCode.'" value="'.$getData[99].'">' . $getData[99] . '</option>'.

							$RateBasisOptionsResult
							.'</select>
						</div>'
					   : '<div class="input-group RateBasisoption option invalid">
					   		'.$validValueFieldIcon .'
							<select type="text" class="form-control required" style="border: none !important">
							<option data-code="'.$selectedRateBasisCode.'" value="'.$getData[99].'">' . $getData[99] . '</option>'.

							$RateBasisOptionsResult
							.'</select>
						</div>',

				   'TAXTYPEVATNONVAT'  =>  $getData[100],
				   'GROSSTruckerrates'  => empty($getData[101]) ? 0 : $getData[101],
				   'GROSSTruckerratesCONSIDERINGNONVATRATEIFFORMULA'  => empty($getData[102]) ? 0 : $getData[102],
				   'RateBasis'  => in_array($getData[103], $RateBasisOptionsQueryArray) ? 
							'<div class="input-group RateBasisoption option valid">
							<select type="text" class="form-control required" style="border: none !important">
							<option data-code="'.$selectedRateBasisCode2.'" value="'.$getData[103].'">' . $getData[103] . '</option>'.

							$RateBasisOptionsResult
							.'</select>
						</div>'
					   : '<div class="input-group RateBasisoption option invalid">
					   		'.$validValueFieldIcon .'
							<select type="text" class="form-control required" style="border: none !important">
							<option data-code="'.$selectedRateBasisCode2.'" value="'.$getData[103].'">' . $getData[103] . '</option>'.

							$RateBasisOptionsResult
							.'</select>
						</div>',
				   'TAXTYPEVATNONVAT2'  => $getData[104],
				   'DemurrageClient'  => empty($getData[105]) ? 0 : $getData[105],
				   'AddtlDropClient'  =>  empty($getData[106]) ? 0 : $getData[106],
				   'BoomTruckClient'  =>  empty($getData[107]) ? 0 : $getData[107],
				   'ManpowerClient'  =>  empty($getData[108]) ? 0 : $getData[108],
				   'BackloadClient'  =>  empty($getData[109]) ? 0 : $getData[109],
				   'TotalAdditionalChargesClient'  => empty($getData[110]) ? 0 : $getData[110],
				   'DemurrageCONSIDERINGNONVATRATE'  => empty($getData[111]) ? 0 : $getData[111],
				   'AdditionalChargesCONSIDERINGNONVATRATE'  => empty($getData[112]) ? 0 : $getData[112],
				   'DemurrageTrucker'  =>  empty($getData[113]) ? 0 : $getData[113],
				   'AddtlDropTrucker'  =>  empty($getData[114]) ? 0 : $getData[114],
				   'BoomTruckTrucker'  =>  empty($getData[115]) ? 0 : $getData[115],
				   'ManpowerTrucker'  =>  empty($getData[116]) ? 0 : $getData[116],
				   'BackloadTrucker'  => empty($getData[117]) ? 0 : $getData[117],
				   'TotalAdditionalChargesTrucker'  => empty($getData[118]) ? 0 : $getData[118],
				   'DemurrageCONSIDERINGNONVATRATE'  => $getData[119],
				   'AdditionalChargesCONSIDERINGNONVATRATE'  =>  empty($getData[120]) ? 0 : $getData[120],
				   'TOTALINITIALClientRates'  => empty($getData[121]) ? 0 : $getData[121],
				   'TOTALInitialTruckersRates'  =>  empty($getData[122]) ? 0 : $getData[122],
				   'TOTALGROSSPROFIT'  => empty($getData[123]) ? 0 : $getData[123],
				   'ActualBilledamountPerServiceinvoiceMAINRATE'  => empty($getData[124]) ? 0 : $getData[124],
				   'RateAdjustmentsOtherthancolDVDW'  => empty($getData[125]) ? 0 : $getData[125],
				   'ActualDemurrage'  => empty($getData[126]) ? 0 : $getData[126],
				   'ActualadditionalchargesBackloadsdrops'  => empty($getData[127]) ? 0 : $getData[127],
				   'TotalReceivablefromClientsperSIreconwithBR'  => empty($getData[128]) ? 0 : $getData[128],
				   'CWT2307'  => empty($getData[129]) ? 0 : $getData[129],
				   'Collectedamount'  => $getData[130],
				   'Actualrateschargedbytrucker'  =>empty($getData[131]) ? 0 : $getData[131],
				   'RateAdjustments'  => empty($getData[132]) ? 0 : $getData[132],
				   'ActualApprovedDemurrage'  => $getData[133],
				   'ActualadditionalchargesBackloadsdrops2'  => empty($getData[134]) ? 0 : $getData[134],
				   'BoomTruck'  => $getData[135],
				   'OtherChargesChargedtointeluckasCompanyexpenses'  => empty($getData[136]) ? 0 : $getData[136],
				   'TotalPenalty'  => empty($getData[137]) ? 0 : $getData[137],
				   'TotalPayabletoTruckers'  => empty($getData[138]) ? 0 : $getData[138],
				   'EWT2307'  =>empty($getData[139]) ? 0 : $getData[139],
				   'TOTALPAYABLERECEIVABLEfromTrucker'  => empty($getData[140]) ? 0 : $getData[140],
				   'ActualPaymentDate'  => validDate($getData[141]) ? $getData[141] : $dateNotValidFormatFieldIcon .  ' ' . $getData[141] ,
				   'PaymentReference'  => $getData[142],
				   'ORreferencenumber'  => $getData[143],
				   'PaymentVoucherNumber'  => $getData[144],
				   'PaymentStatus'  => $getData[145],		
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

					);
		echo json_encode($data);
		//echo json_encode($table);
		
	}
	else
	{
		echo 'FAILURE!';
	
	}

?>
	