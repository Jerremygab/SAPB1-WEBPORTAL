<?php
session_start();
include_once('../../../config/config.php');

$docentry = $_GET['docentry'];
$html = '';
require_once __DIR__ . '/../../../mpdf/vendor/autoload.php';

//$mpdf = new \Mpdf\Mpdf();


$mpdf = new \Mpdf\Mpdf(['tempDir' => __DIR__ . '/../../../mpdf/custom/temp/dir/path']);

$mpdf->mirrorMargins = 0.5;
$mpdf->defaultheaderfontsize = 10;
$mpdf->AddPageByArray([
    'margin-left' => 3,
    'margin-right' => 3,
    'margin-top' => 3,
    'margin-bottom' => 3,
]);


function numtowords($num){ 
$decones = array( 
            '01' => "One", 
            '02' => "Two", 
            '03' => "Three", 
            '04' => "Four", 
            '05' => "Five", 
            '06' => "Six", 
            '07' => "Seven", 
            '08' => "Eight", 
            '09' => "Nine", 
            10 => "Ten", 
            11 => "Eleven", 
            12 => "Twelve", 
            13 => "Thirteen", 
            14 => "Fourteen", 
            15 => "Fifteen", 
            16 => "Sixteen", 
            17 => "Seventeen", 
            18 => "Eighteen", 
            19 => "Nineteen" 
            );
$ones = array( 
            0 => " ",
            1 => "One",     
            2 => "Two", 
            3 => "Three", 
            4 => "Four", 
            5 => "Five", 
            6 => "Six", 
            7 => "Seven", 
            8 => "Eight", 
            9 => "Nine", 
            10 => "Ten", 
            11 => "Eleven", 
            12 => "Twelve", 
            13 => "Thirteen", 
            14 => "Fourteen", 
            15 => "Fifteen", 
            16 => "Sixteen", 
            17 => "Seventeen", 
            18 => "Eighteen", 
            19 => "Nineteen" 
            ); 
$tens = array( 
            0 => "",
            2 => "Twenty", 
            3 => "Thirty", 
            4 => "Forty", 
            5 => "Fifty", 
            6 => "Sixty", 
            7 => "Seventy", 
            8 => "Eighty", 
            9 => "Ninety" 
            ); 
$hundreds = array( 
            "Hundred", 
            "Thousand", 
            "Million", 
            "Billion", 
            "Trillion", 
            "Quadrillion" 
            ); //limit t quadrillion 
$num = number_format($num,2,".",","); 
$num_arr = explode(".",$num); 
$wholenum = $num_arr[0]; 
$decnum = $num_arr[1]; 
$whole_arr = array_reverse(explode(",",$wholenum)); 
krsort($whole_arr); 
$rettxt = ""; 
foreach($whole_arr as $key => $i){ 
    if($i < 20){ 
        $rettxt .= $ones[$i]; 
    }
    elseif($i < 100){ 
        $rettxt .= $tens[substr($i,0,1)]; 
        $rettxt .= " ".$ones[substr($i,1,1)]; 
    }
    else{ 
        $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
        $rettxt .= " ".$tens[substr($i,1,1)]; 
        $rettxt .= " ".$ones[substr($i,2,1)]; 
    } 
    if($key > 0){ 
        $rettxt .= " ".$hundreds[$key]." "; 
    } 

} 
$rettxt = $rettxt." peso/s";

if($decnum > 0){ 
    $rettxt .= " and "; 
    if($decnum < 20){ 
        $rettxt .= $decones[$decnum]; 
    }
    elseif($decnum < 100){ 
        $rettxt .= $tens[substr($decnum,0,1)]; 
        $rettxt .= " ".$ones[substr($decnum,1,1)]; 
    }
    $rettxt = $rettxt." centavo/s"; 
} 
return $rettxt;}

$htmldetails= '';
$DocNum = '';
$DocEntry= '';
$CardCode= '';
$CardName= '';
$Comments= '';
$BPLId= '';
$BPLName= '';
$RefDate= '';
$BPLAddress= '';
$BranchName= '';
$Memo = '';
$TransId ='';


										
	$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
			EXEC [dbo].[usp_EBI_CheckVoucher_JE] @DocKey = $docentry");
			$no = 1;
			while (odbc_fetch_row($qry)) 
									{
										
									
									
										
										$BPLId=odbc_result($qry, 'BPLId');
										$Name=odbc_result($qry, 'Name');
										$BPLTIN=odbc_result($qry, 'BPLTIN');
										$RefDate=date("m/d/Y", strtotime(odbc_result($qry, 'RefDate')));
										$BPLAddress=odbc_result($qry, 'BPLAddress');
										$BranchName=odbc_result($qry, 'BranchName');
										$Memo=odbc_result($qry, 'Memo');
										$TransId=odbc_result($qry, 'TransId');


									
										$htmldetails .= '<tr>
														<td align="center">'.odbc_result($qry, 'AcctCode').'</td>
														<td align="left" >'.odbc_result($qry, 'AcctName').'</td>
														<td align="right">'.number_format(odbc_result($qry, 'Debit'),2).'</td>
														<td align="right">'.number_format(odbc_result($qry, 'Credit'),2).'</td>
														
													</tr>';
										$no++;;
										
									}

		
$html = '<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>JOURNAL VOUCHER</title>
<link rel="icon" href="../../img/logo-ico.ics">
</head>
<body>
		<div class="row">
            <div class="col-lg-12">
				<table width="100%" border="0">
					<tbody class="text-center">
							
					</tbody>	
				</table>
				<br>
				<table width="100%" border="0" >
					<tbody>
							<tr>
								<td width="33%"></td>
								<td width="33%"><h2><center><span style="color:black;font-weight:bold;">&nbsp;&nbsp;'.$Name.'</span></center></h2></td>
								<td width="33%"><center><span style="color:black; font-weight:bold;"></span></center></td>
						
							</tr>
							<tr>
								<td width="33%"><center><span style="color:black; ">
								</span></center></td>
								<td width="100%" >
								<h2 style="font-weight:normal"><center><span style="color:black; font-weight:bold;" >'.$BPLAddress.'
								<br/>
								&nbsp;&nbsp;VAT REG. TIN: '.$BPLTIN.'
								</span>
								</center>
								</h2>
								</td>


								<td width="33%"><center><span style="color:black; ">
								</span></center></td>
								
							</tr>
							<tr>
								<td width="33%"></td>
								<td width="33%"><h2><center><span style="color:black;font-weight:bold;">&nbsp;&nbsp;</span></center></h2></td>
								<td width="33%"><h2><center><span style="color:black; font-weight:bold;">'.$BranchName.'</span></center><h2></td>
						
							</tr>
					</tbody>	
				</table>
				<table width="100%" border="0" style="border: 1px solid black"> 
					<thead>
						<tr>
							<td width="33%"></td>
							<th width="33%" colspan="4"><h5><center>JOURNAL VOUCHER</h5></center></th>
							<td width="33%"></td>
						</tr>
					</thead>
				</table>
				
				
				<table width="100%" border="0" style="border-left: 1px solid black; border-right: 1px solid black"> 
					<thead>
						<tr>
							<td width="10%" style="color:black;font-weight:bold; ">
								
							</td>
							<td width="90%" style="color:black;font-weight:bold; ">
								<table width="100%" border="0" style="border: 1px solid black"> 
									<thead>
										<tr>
											<td width="70%" style="color:black;font-weight:bold; "><h3><center>PARTICULARS</center></h3></td>
											
										</tr>									
									</thead>
								</table>
								<table width="100%" border="0" style="border: 1px solid black"> 
									<thead>
										<tr>
											<td width="70%" height="60px" style="color:black;font-weight:bold; "><h3>'.$Memo.'</h3></td>
										
										</tr>									
									</thead>
								</table>
							</td>
							<td width="30%" style="color:black;font-weight:bold; ">
								<table width="100%" border="0" style=""> 
									<thead>
										<tr>
												<td width="30%" style="color:black;font-weight:bold; "><h3>DATE &nbsp; '.$RefDate.'</h3></td>
										
										</tr>										
									</thead>
								</table>
								<table width="100%" border="0" style=""> 
									<thead>
										<tr>
											<td width="30%" height="60px" style="color:black;font-weight:bold; "><h3>&nbsp;</h3></td>
										
										</tr>									
									</thead>
								</table>
							</td>
							<td width="20%" style="color:black;font-weight:bold; ">
								
							</td>
						</tr>
						<br/>
						<br/>
						<tr>
							<td width="10%" style="color:black;font-weight:bold; ">
								
							</td>
							<td colspan="2" width="100%" style="color:black;font-weight:bold; ">
								<table width="100%" border="0"   style="border: 1px solid black;"> 
									<thead >
										<tr >
											<td width="20%"  style="color:black;font-weight:bold; "><h3><center>ACCT CODE</center></h3></td>
											<td width="50%" style="color:black;font-weight:bold; "><h3><center>ACCOUNT TITLE</center></h3></td>
											<td width="15%" style="color:black;font-weight:bold; "><h3><center>DEBIT</center></h3></td>
											<td width="15%" style="color:black;font-weight:bold; "><h3><center>CREDIT</center></h3></td>
											
										</tr>									
									</thead>
									<tbody>
										'.$htmldetails.'
									</tbody>
								</table>
							
							</td>
						</tr>
						<br/>
						<tr>
							<td width="20%" style="color:black;font-weight:bold; ">
								
							</td>
							<td width="100%" colspan="2" style="color:black;font-weight:bold; ">
								<table width="100%" border="0" style="border: 1px solid black"> 
									<thead>
										<tr>
											<td width="15%" style="color:black;font-weight:bold; "><h3>Prepared by:</h3></td>
											<td width="15%" style="color:black;font-weight:bold; "><h3>Verified by:</h3></td>
											<td width="15%" style="color:black;font-weight:bold; "><h3>Received by:</h3></td>
											<td width="15%" style="color:black;font-weight:bold; "><h3>Checked by:</h3></td>
											<td width="15%" style="color:black;font-weight:bold; "><h3><center>Noted by:</h3></td>
											<td width="15%" style="color:black;font-weight:bold; "><h3><center>Approved by:</h3></td>
											
										</tr>									
									</thead>
									<tbody>	
										<tr>
											<td width="15%" style="color:black;font-weight:bold; "><h3>&nbsp;</h3></td>
											<td width="15%" style="color:black;font-weight:bold; "><h3>&nbsp;</h3></td>
											<td width="15%" style="color:black;font-weight:bold; "><h3>&nbsp;</h3></td>
											<td width="15%" style="color:black;font-weight:bold; "><h3>&nbsp;</h3></td>
											<td width="15%" style="color:black;font-weight:bold; "><h3><center>&nbsp;</h3></td>
											<td width="15%" style="color:black;font-weight:bold; "><h3><center>&nbsp;</h3></td>
											
										</tr>				
									</tbody>
								</table>
							</td>
							<td width="20%" style="color:black;font-weight:bold; ">
								
							</td>
						</tr>
						<tr>
							<td width="10%" style="color:black;font-weight:bold; ">
								
							</td>
							<td colspan="2" width="100%" style="color:black;font-weight:bold; ">
								<table width="100%" border="0"  > 
									<thead >
										<tr >
											<td width="70%"  style="color:black;font-weight:bold; "><h6><span style="color:black;font-weight:bold;">
										Received from '. $Name.' The amount is stated above.</span></h6></td>
											<td width="10%" style="color:black;font-weight:bold; "><h3><center> </center></h3></td>
											<td width="10%" style="color:black;font-weight:bold; "><h3><center></center></h3></td>
											<td width="10%" style="color:black;font-weight:bold; "><h3><center></center></h3></td>
											
										</tr>									
									</thead>
								</table>
							
							</td>
						</tr>
						<tr>
							<td width="10%" style="color:black;font-weight:bold; ">
								
							</td>
							<td colspan="2" width="100%" style="color:black;font-weight:bold; ">
								<table width="100%" border="0"  > 
									<thead >
										<tr >
											<td  colspan= "5"width="70%"  style="color:black;font-weight:bold; "><h6><span style="color:black;font-weight:bold;"> </span></h6></td>
											<td width="10%" style="color:black;font-weight:bold; "><h3><center> </center></h3></td>
											<td width="10%" style="color:black;font-weight:bold; "><h3><center></center></h3></td>
											<td width="20%" class="text-right"style="color:black;font-weight:bold; "><h3 style="color: red">JV No.  '.$TransId.'</h3></td>
											
										</tr>									
									</thead>
								</table>
							
							</td>
						</tr>
					</thead>
				</table>
				
				<table width="100%" border="0" style="border-left: 1px solid black; border-right: 1px solid black;  border-bottom: 1px solid black"> 
					<tbody style="margin-bottom: 20px !important">
						<tr>
							<td width="100%" colspan="5" >&nbsp;</td>
						</tr>
						<tr>
							<td width="25%" style="border-top: 1px solid black"><h6 style="font-weight: normal"><center>PREPARED BY:</center></h6></td>
							<td width="10%"></td>
							<td width="25%" style="border-top: 1px solid black"><h6 style="font-weight: normal"><center>CHECKED BY:</center></h6></td>
							<td width="10%"></td>
							<td width="25%" style="border-top: 1px solid black"><h6 style="font-weight: normal"><center>NOTED BY:</center></h6></td>
						</tr>
						<tr>
							<td width="25%" style=""><h5 style="font-weight: normal"><center></center></h5></td>
							<td width="10%"></td>
							<td width="25%" style=""><h5 style="font-weight: normal"><center></center></h5></td>
							<td width="10%"></td>
							<td width="25%" style=""><h5 style="font-weight: normal"><center></center></h5></td>
						</tr>
						<tr>
							<td width="25%" style=""><h5 style="font-weight: normal"><center></center></h5></td>
							<td width="10%"></td>
							<td width="25%" style=""><h5 style="font-weight: normal"><center></center></h5></td>
							<td width="10%"></td>
							<td width="25%" style=""><h5 style="font-weight: normal"><center></center></h5></td>
						</tr>
						<tr>
							<td width="25%" style=""><h5 style="font-weight: normal"><center></center></h5></td>
							<td width="10%"></td>
							<td width="25%" style=""><h5 style="font-weight: normal"><center></center></h5></td>
							<td width="10%"></td>
							<td width="25%" style=""><h5 style="font-weight: normal"><center></center></h5></td>
						</tr>
						<tr>
							<td width="25%" style=""><h5 style="font-weight: normal"><center></center></h5></td>
							<td width="10%"></td>
							<td width="25%" style=""><h5 style="font-weight: normal"><center></center></h5></td>
							<td width="10%"></td>
							<td width="25%" style=""><h5 style="font-weight: normal"><center></center></h5></td>
						</tr>
					</tbody>
					<tfooter>

					
					</tfooter>

				</table>
				<table width="100%" border="0" style="border-left: 1px solid black; border-right: 1px solid black"> 
					
				</table>
				<table width="100%" border="0" style="border-left: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black"> 
					
				</table>
			</div>
		</div>
	</body>
</html>		
		';

$mpdf->SetWatermarkText('');
$mpdf->watermark_font = 'DejaVuSansCondensed';
$mpdf->showWatermarkText = true;

$stylesheet = file_get_contents('../../mpdf/mpdf_css/pr_app-report.css');
$html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML($html);
$mpdf->Output();

?>
