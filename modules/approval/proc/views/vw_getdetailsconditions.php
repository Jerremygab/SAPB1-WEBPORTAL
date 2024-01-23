<?php
session_start();
include_once('../../../../config/config.php');

$code = $_GET['code'];

?>
<div class="">
  

<?php
$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB2."];
	SELECT 
		T1.Code,
		T1.Description,
		T1.TemplateCode,
		T1.DocEntry,
		T1.LineNum
		
		
	FROM [@OAPR] T0 
	INNER JOIN [@APR2] T1 ON T0.Code = T1.Code

	WHERE T0.Code = '$code'
	ORDER BY T1.LineNum ASC");
$ctr = 1;

while (odbc_fetch_row($qry)) 
{
	
	$Code = odbc_result($qry, "Code");
	$Description = odbc_result($qry, "Description");
	$TemplateCode = odbc_result($qry, "TemplateCode");
	$DocEntry = odbc_result($qry, "DocEntry");
	$LineNum = odbc_result($qry, "LineNum");
    $txtNumberofApprovals = odbc_result($qry, "LineNum");
	$txtNumberofDisapprovals = odbc_result($qry, "LineNum");
    
	echo 
		'<div class="form-group row py-0 my-0 mb-2" >
        <div class="col-sm-5" >
            <label for="inputEmail3" class=" col-form-label " style="color: black;" >Number of Approvers required</label>
        </div>
        <div class="col-sm-2" >
            <input  type="number" id="txtNumberofApprovals" class="form-control inputRadius text-right" placeholder="">
        </div>
    </div>
    <div class="form-group row py-0 my-0 mb-2" >
        <div class="col-sm-5" >
            <label for="inputEmail3" class=" col-form-label " style="color: black;" >Number of Disapprovers required</label>
        </div>
        <div class="col-sm-2" >
            <input  type="number" id="txtNumberofDisapprovals" class="form-control inputRadius text-right" placeholder="">
        </div>
    </div>';
			
	$ctr += 1;
				
	}
	?>
		
</div>

<?php
odbc_free_result($qry);
odbc_close($MSSQL_CONN);

?>
