<?php
session_start();
include_once('../../../../config/config.php');

$docNum = $_GET['docNum'];
$docType = $_GET['docType'];
$objType = $_GET['objType'];

$html='';


$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
	SELECT 
		T0.U_DocEntry,
		T0.U_FileName,
		T0.U_FileLocation,
		T0.U_AttachmentDate,
		T0.U_Freetext

		
		
	FROM [@ATTACHMENT] T0 
	INNER JOIN OPRQ T1 ON T1.DocEntry = T0.U_DocEntry


	--WHERE T1.DocNum IN ( $docNum ) AND T0.U_ObjectType = 18
	
	WHERE T1.DocNum = $docNum AND T0.U_ObjectType = 1470000113
	ORDER BY T0.Code ASC");
$ctr = 1;

while (odbc_fetch_row($qry)) 
{
	
	$U_DocEntry = odbc_result($qry, "U_DocEntry");
	$U_FileName = odbc_result($qry, "U_FileName");
	$U_FileLocation = odbc_result($qry, "U_FileLocation");
	$U_AttachmentDate = date('Y-m-d' ,strtotime(odbc_result($qry, 'U_AttachmentDate')));
	$U_Freetext = odbc_result($qry, "U_Freetext");

			
	echo		
		'<tr style="background-color: white; "  >
		<td class="rowno text-right" style="background-color: lightgray;color:black; font-size:13px;">
			<span>'.$ctr.'</span>
			<ul class="dropdown-menu rowfunctions" role="menu" style="background-color: #fdfd96;">
				<li class="deleterow" style="font-size:20px; color: black; font-weight:bold">Delete Row</a></li>
				<li class="duplicaterow"style="font-size:20px; color: black; font-weight:bold">Duplicate Row</a></li>
			</ul>
	  </td>
	 <td >
	<div class="input-group " >
<input type="text" class="form-control matrix-cell targetpath"  aria-label="File Name"aria-describedby="button-addon2" style="outline: none; border:none" readonly value="'.$U_FileLocation.'"/>
		
	</div>
	  </td>
	  <td >
		<div class="input-group ">
			<a  href="../../../uploaded-files/'.$U_FileName.'" target="_blank" class="pdf btn btn-sm">
				'.$U_FileName.'
			</a>					
		</div>
	  </td>
	  <td >
	  <div class="input-group ">
			<input type="date" id="txtAttachmentDate"  min="01-01-2018" max="12-31-2050" class="form-control matrix-cell attachmentdate"  style="outline: none; border:none" readonly value="'.$U_AttachmentDate.'"/>	
		</div>
	  </td>
	  <td>
		<div class="input-group ">
			<input type="text" class="form-control matrix-cell freetext"style="outline: none; border:none;" readonly value="'.$U_Freetext.'"/>
		</div>
	  </td>
 </tr>';

 $ctr += 1;
		}		


		echo ' <tr style="background-color: white; "  >
		<td class="rowno text-right" style="background-color: lightgray;color:black; font-size:13px;">
			<span>'.$ctr.'</span>
			<ul class="dropdown-menu rowfunctions" role="menu" style="background-color: #fdfd96;">
				<li class="deleterow" style="font-size:20px; color: black; font-weight:bold">Delete Row</a></li>
				<li class="duplicaterow"style="font-size:20px; color: black; font-weight:bold">Duplicate Row</a></li>
			</ul>
	  </td>
	 <td >
	<div class="input-group " >
<input type="text" class="form-control matrix-cell targetpath"  aria-label="File Name"aria-describedby="button-addon2" style="outline: none; border:none" readonly/>
		
	</div>
	  </td>
	  <td >
			<div class="input-group ">
			<input type="file" class="form-control matrix-cell file file-from-update" name="file"  aria-label="File Name" aria-describedby="button-addon2" style="outline: none; border:none" readonly />
			
		</div>
	  </td>
	  <td >
	  <div class="input-group ">
				<input type="date" id="txtAttachmentDate"  min="01-01-2018" max="12-31-2050" class="form-control matrix-cell attachmentdate"  value="'.  date('Y-m-d') .'" style="outline: none; border:none" readonly/>	
			</div>
	  </td>
	  <td>
			<div class="input-group ">
				<input type="text" class="form-control matrix-cell freetext" style="outline: none; border:none;"/>
			</div>
	  </td>
 </tr>';
 

/*  echo $html; */
odbc_free_result($qry);
odbc_close($MSSQL_CONN);

?>

