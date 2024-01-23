<?php
session_start();
include_once('../../../../config/config.php');


$userid = '';
$err = 0;
$errmsg = '';

$EmpId = $_SESSION['SESS_EMP'];
$docEntry = $_POST['docEntry'];
$objType = $_POST['objType'];
$approvers = $_POST['approvers'];
$disapprovedbyapprovers =  preg_replace('/(\v|\s)+/', '', $_POST['disapprovedbyapprovers']); 
$nodisapproversrequired = $_POST['nodisapproversrequired'];
$postedorDraft = $_POST['postedorDraft'];
$disapproved  = '';
$approver = ',' . $EmpId;
if ($disapprovedbyapprovers == '') {
    $disapproved  = $EmpId;
}
else{
		if (!str_contains($disapprovedbyapprovers, $EmpId)) { 
			$approved = $disapprovedbyapprovers .= $approver;
		}
		else{
		$approved = $disapprovedbyapprovers;
	}
    
}
// echo "approvedbyapprovers: ".$approvedbyapprovers;
$approvedNoUnwantedSpace = preg_replace('/(\v|\s)+/', '', $disapproved);
$disapprovedbyapproversNoUnwantedSpace = preg_replace('/(\v|\s)+/', '', $disapprovedbyapprovers);
$nodisapproversrequiredNoUnwantedSpace = preg_replace('/(\v|\s)+/', '', $nodisapproversrequired);


$docentryqry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB2."]; 
    UPDATE [USER-COMMON].[dbo].[SAP_DOCS_WITH_APPROVAL] SET DisapprovedByApprovers = '$approvedNoUnwantedSpace'
    

    WHERE SAPDraftEntry = '$docEntry'


");

$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB2."];
														
		SELECT 
		T0.SAPDraftEntry,
		T0.SAPDocEntry,
		T0.NoOfApprovalsRequired,
		T0.ApproverIds,
		T0.DisapprovedbyApprovers,
		T0.NoOfDisapprovalRequired,
		--CONCAT('0', T0.ApprovedByApprovers) AS 
		T0.ApprovedByApprovers,
		T0.ApprovalStatus,
		T1.CardCode,
		T1.CardName,
		T1.DocTotal,
		T1.Comments,
		T1.ObjType,
		CASE WHEN
		T1.ObjType = 13 THEN 'AR Invoice'
		ELSE 'N/A'
		END AS Module,
		T1.OwnerCode,
		CONCAT(T2.firstName, ' ', T2.lastName) AS Name



		FROM [".$MSSQL_DB2."].[dbo].[SAP_DOCS_WITH_APPROVAL] T0
		INNER JOIN [".$MSSQL_DB."].[dbo].[ODRF] T1 ON T1.DocEntry = T0.SAPDraftEntry AND T1.ObjType = 13
		INNER JOIN [".$MSSQL_DB."].[dbo].[OHEM] T2 ON T2.Code = T0.OwnerCode
		
		WHERE SAPDraftEntry = '$docEntry'

		
				");
				
	$ctr=1;

	while (odbc_fetch_row($qry)) 
	{
		$ApprovedByApproversArray = [];
		$DocEntry = odbc_result($qry, "SAPDraftEntry");
		$SAPDocEntry = odbc_result($qry, "SAPDocEntry");
		$NoOfApprovalsRequired = odbc_result($qry, "NoOfApprovalsRequired");
		$NoOfDisapprovalsRequired = odbc_result($qry, "NoOfDisapprovalRequired");
		$ApproverIds = odbc_result($qry, "ApproverIds");
		$ApprovedByApprovers = odbc_result($qry, "ApprovedByApprovers");
		$DisapprovedByApprovers = odbc_result($qry, "DisapprovedByApprovers");

		$ApprovedByApproversArray = explode(',', odbc_result($qry, "ApprovedByApprovers"));
		$DisapprovedByApproversArray = explode(', ', odbc_result($qry, "DisapprovedByApprovers"));
		$ApproverIdsArray = explode(', ', odbc_result($qry, "ApproverIds"));

		$Status = 'Pending';
		$background = '';


		$a1=array(1, 2, 4);

		$a2=array(1);

		$result=array_intersect($ApprovedByApproversArray,$ApproverIdsArray);
		$result2=array_intersect($DisapprovedByApproversArray,$ApproverIdsArray);


		if( count($result2) == $NoOfDisapprovalsRequired){
			// $Status = 'Rejected';
			// $background = '#FF7276';
			// echo "Rejected";
			
		}
	}
	odbc_close($MSSQL_CONN);
if ($err == 0) 
{
	$data = array("valid"=>true, 
						"msg"=>"Operation completed successfully - " .$docEntry,
						"name"=>$approvedNoUnwantedSpace);
	echo json_encode($data);
}
else
{
	$data = array("valid"=>false, "msg"=>$errmsg);
	echo json_encode($data);
}





?>

