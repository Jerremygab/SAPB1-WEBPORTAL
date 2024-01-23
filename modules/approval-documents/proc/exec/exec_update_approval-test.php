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
$approvedbyapprovers = $_POST['approvedbyapprovers'];
$noapproversrequired = $_POST['noapproversrequired'];
$postedorDraft = $_POST['postedorDraft'];
$approved = '';


$docentryqry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB2."]; 
    UPDATE [USER-COMMON].[dbo].[SAP_DOCS_WITH_APPROVAL] SET ApprovedByApprovers = '$approved'
    

    WHERE SAPDraftEntry = '$docEntry'


");

if ($err == 0) 
{
	$data = array("valid"=>true, 
						"msg"=>"Operation completed successfully - " .$docEntry,
						"name"=>$approved);
	echo json_encode($data);
}
else
{
	$data = array("valid"=>false, "msg"=>$errmsg);
	echo json_encode($data);
}

// $objType = 13;
// $docentryString = ' T0.DocEntry ';
// $table = 'ODRF';

if($objType == 13){
	$table = 'ORDR';
	$table2 = 'RDR1';
}else if($objType == 15){
	$table = 'ODLN';
	$table2 = 'DLN1';
}

if ($postedorDraft == 'POSTED'){
	$table = 'OINV';
	$table2 = 'INV1';
	$objType = 13;
	$docentryString = ' T0.DocNum ';
}
else{
	$table = 'ODRF';
	$table2 = 'DRF1';
	$objType = 13;
	$docentryString = ' T0.DocEntry ';
}

$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
			SELECT DISTINCT
				T0.DocEntry,
				T0.DocNum,
				T0.DocEntry,
				T0.DocStatus,
				T0.Series,
				T0.DocCur,
				T0.DocType,
				
				CASE 
					WHEN T0.DocStatus = 'O' THEN 'Open' 
					WHEN T0.DocStatus = 'C' AND T0.Canceled = 'C' THEN 'Canceled' 
					WHEN T0.DocStatus = 'C' AND T0.Canceled = 'N' THEN 'Closed' 
				END AS 'DocStatusFullText',
				T0.CardCode,
				T0.CardName,
				T0.DocDate,
				--T0.DocDueDate,

				dateadd(day,T0.ExtraDays, T0.U_CRD) as DocDueDate,
				T0.TaxDate,
				T0.ReqDate,
				T0.CancelDate,
				T0.LicTradNum,

				CASE WHEN T0.DocCur <> 'PHP' THEN T0.VatSumFC ELSE T0.VatSum END AS 'VatSum',
				CASE WHEN T0.DocCur <> 'PHP' THEN T0.DiscSumFC ELSE T0.DiscSum END AS 'DiscSum',
				CASE WHEN T0.DocCur <> 'PHP' THEN T0.WTSumFC ELSE T0.WTSum END AS 'WTSum',
				CASE WHEN T0.DocCur <> 'PHP' THEN T0.DocTotalFC ELSE T0.DocTotal END AS 'DocTotal',
				CASE WHEN T0.DocCur <> 'PHP' THEN (T0.DocTotalFC + T0.DiscSumFC) - T0.VatSumFC ELSE (T0.DocTotal + T0.DiscSum) - T0.VatSum END AS 'TotalBeforeDisc',
				CASE WHEN T0.DocCur <> 'PHP' THEN T0.PaidFC ELSE T0.PaidToDate END AS 'PaidToDate',

				
				T0.DiscPrcnt,
				T0.NumAtCard,
				T0.Comments,

				T0.ShipToCode,
				T0.PayToCode,
				T0.TrnspCode,
				T0.JrnlMemo,
				T0.GroupNum,
				
				T1.SeriesName,
				T2.CntctCode,
				T2.Name AS 'ContactPerson',
				T3.SlpCode,
				T3.SlpName,
				T4.EmpID,
				T4.LastName + ', ' + T4.FirstName AS 'EmployeeName',

				CAST(ISNULL(T6.Address,'') AS VARCHAR) AS Address,
				CAST(ISNULL(T6.Street,'') AS VARCHAR) AS Street,
				CAST(ISNULL(T6.StreetNo,'') AS VARCHAR) AS StreetNo,
				CAST(ISNULL(T6.Block,'') AS VARCHAR) AS Block,
				CAST(ISNULL(T6.ZipCode,'') AS VARCHAR) AS ZipCode,
				CAST(ISNULL(T6.City,'') AS VARCHAR) AS City,
				CAST(ISNULL(T6.County,'') AS VARCHAR) AS County,
				CAST(ISNULL(T6.State,'') AS VARCHAR) AS State,
				CAST(ISNULL(T6.Country,'') AS VARCHAR) AS CountryCode,
				CAST(ISNULL(T7.Name,'') AS VARCHAR) AS Country,
				CAST(ISNULL(T6.Building,'') AS VARCHAR) AS Building,

				CAST(ISNULL(T8.Address,'') AS VARCHAR) AS Address2,
				CAST(ISNULL(T8.Street,'') AS VARCHAR) AS Street2,
				CAST(ISNULL(T8.StreetNo,'') AS VARCHAR) AS StreetNo2,
				CAST(ISNULL(T8.Block,'') AS VARCHAR) AS Block2,
				CAST(ISNULL(T8.ZipCode,'') AS VARCHAR) AS ZipCode2,
				CAST(ISNULL(T8.City,'') AS VARCHAR) AS City2,
				CAST(ISNULL(T8.County,'') AS VARCHAR) AS County2,
				CAST(ISNULL(T8.State,'') AS VARCHAR) AS State2,
				CAST(ISNULL(T8.Country,'') AS VARCHAR) AS CountryCode2,
				CAST(ISNULL(T9.Name,'') AS VARCHAR) AS Country2,
				CAST(ISNULL(T8.Building,'') AS VARCHAR) AS Building2,

				T10.PymntGroup,
				T0.ExtraDays,
				T0.ExtraMonth,
				T0.AtcEntry
				
				FROM " .$table. " T0
				INNER JOIN NNM1 T1 ON T0.Series= T1.Series
				LEFT JOIN OCPR T2 ON T0.CntctCode = T2.CntctCode
				LEFT JOIN OSLP T3 ON T0.SlpCode = T3.SlpCode
				LEFT JOIN OHEM T4 ON T0.OwnerCode = T4.empID
				LEFT JOIN OCRD T5 ON T5.CardCode = T0.CardCode
				LEFT JOIN CRD1 T6 ON T6.CardCode = T5.CardCode AND T6.AdresType = 'S' AND T6.Address = T0.ShipToCode
				LEFT JOIN OCRY T7 ON T6.Country = T7.Code
				LEFT JOIN CRD1 T8 ON T8.CardCode = T5.CardCode AND T8.AdresType = 'B' AND T8.Address = T0.PayToCode
				LEFT JOIN OCRY T9 ON T8.Country = T9.Code
				LEFT JOIN OCTG T10 ON T0.GroupNum = T10.GroupNum
				
			WHERE " .$docentryString. " = $docEntry AND T0.ObjType = $objType
		
		
		
			ORDER BY T0.DocNum");

$arr = array();

while (odbc_fetch_row($qry)) 
{
				$DocEntry = odbc_result($qry, 'DocEntry');	
				$DocNum = odbc_result($qry, 'DocNum');
				$DocStatus = odbc_result($qry, 'DocStatus');
				$DocStatusFullText = odbc_result($qry, 'DocStatusFullText');
				$Series = odbc_result($qry, 'Series');
				$DocCur = odbc_result($qry, 'DocCur');
				$DocType = odbc_result($qry, 'DocType');
				$AtcEntry = odbc_result($qry, 'AtcEntry');
				
				$DocDate = date('Y-m-d' ,strtotime(odbc_result($qry, 'DocDate')));
				$DocDueDate = date('Y-m-d' ,strtotime(odbc_result($qry, 'DocDueDate')));
				$TaxDate = date('Y-m-d' ,strtotime(odbc_result($qry, 'TaxDate')));
				$ReqDate = !is_null(odbc_result($qry, 'ReqDate')) ? date('Y-m-d' ,strtotime(odbc_result($qry, 'ReqDate'))) : '';
				$CancelDate = !is_null(odbc_result($qry, 'CancelDate')) ? date('Y-m-d' ,strtotime(odbc_result($qry, 'CancelDate'))) : '';
				
				$CardCode = odbc_result($qry, 'CardCode');
				$CardName = odbc_result($qry, 'CardName');
				$LicTradNum = odbc_result($qry, 'LicTradNum');
				
				$VatSum = number_format(odbc_result($qry, 'VatSum'),6);
				$DiscSum = number_format(odbc_result($qry, 'DiscSum'),6);
				$WTSum = number_format(odbc_result($qry, 'WTSum'),6);
				
				$DocTotal = number_format(odbc_result($qry, 'DocTotal'),6);
				$TotalBeforeDisc = number_format(odbc_result($qry, 'TotalBeforeDisc'),6);
				$PaidToDate = number_format(odbc_result($qry, 'PaidToDate'),6);
				$BalancedDue = number_format(((odbc_result($qry, 'DocTotal') - odbc_result($qry, 'PaidToDate')) < 0 ? 0 : odbc_result($qry, 'DocTotal') - odbc_result($qry, 'PaidToDate')),6);
				$DiscPrcnt = number_format(odbc_result($qry, 'DiscPrcnt'),6);
				
				$NumAtCard = odbc_result($qry, 'NumAtCard');
				$Comments = odbc_result($qry, 'Comments');
				$ShipToCode = odbc_result($qry, 'ShipToCode');
				$PayToCode = odbc_result($qry, 'PayToCode');
				
				$TrnspCode = odbc_result($qry, 'TrnspCode');
				$JrnlMemo = odbc_result($qry, 'JrnlMemo');
				
				$GroupNum = odbc_result($qry, 'GroupNum');
				
				$SeriesName = odbc_result($qry, 'SeriesName');
				$CntctCode = odbc_result($qry, 'CntctCode');
				$ContactPerson = odbc_result($qry, 'ContactPerson');
				$SlpCode = odbc_result($qry, 'SlpCode');
				$SlpName = odbc_result($qry, 'SlpName');
				
				$EmpID = odbc_result($qry, 'EmpID');
				$EmployeeName = odbc_result($qry, 'EmployeeName');
				$PymntGroup = odbc_result($qry, 'PymntGroup');
				$ExtraDays = odbc_result($qry, 'ExtraDays');
				$ExtraMonth = odbc_result($qry, 'ExtraMonth');            
}

odbc_free_result($qry);

$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; SELECT Code, Name, Rate FROM OVTG WHERE Inactive = 'N' AND Category='O'");

odbc_free_result($qry);

$qry = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."];
	SELECT 
		T0.DocEntry,
		T0.DocNum,
		T0.DocStatus,
		T0.ObjType,
		T1.TargetType,
		T1.TrgetEntry,
		T1.LineStatus,
		T1.BaseType,
		T1.ItemCode,
		T1.Dscription,
		T1.AcctCode,
		
		T1.Quantity,
		T1.PriceAfVat,
		T1.Price,
		T1.DiscPrcnt,
		
		(T1.DiscPrcnt/100) * T1.price AS 'DiscSum',
		T1.Price * T1.Quantity AS 'RowTotal',
		T1.PriceAfVat * T1.Quantity AS 'GrossTotal',
		(T1.PriceAfVat * T1.Quantity) - (T1.Price * T1.Quantity) AS 'TaxAmount',
		
		(T1.DiscPrcnt/100) * T1.price AS 'DiscSum2',
		T1.Price  AS 'RowTotal2',
		T1.PriceAfVat  AS 'GrossTotal2',
		(T1.PriceAfVat) - (T1.Price) AS 'TaxAmount2',
		
		T1.UoMEntry,
		T1.VatGroup,
		T1.GTotal,
		T1.LineNum,
		T1.VisOrder,
		
		T1.WhsCode,
		T5.WhsName,
		
		CASE 
		WHEN T1.UomEntry = '-1' THEN 'Manual'
		ELSE T1.UnitMsr 
		END AS UnitMsr,

		CASE 
		WHEN T1.WTLiable = 'Y' THEN '1'
		WHEN T1.WTLiable = 'N' THEN '0'
		END AS WTLiable,

		CASE 
		WHEN T1.WTLiable = 'Y' THEN 'Yes'
		WHEN T1.WTLiable = 'N' THEN 'No'
		END AS WTLiableText,

		T2.UomCode,
		T3.AcctName,
		
		T4.ManBtchNum,
		T4.ManSerNum
		
	FROM " .$table. " T0 
	INNER JOIN " .$table2. " T1 ON T0.DocEntry = T1.DocEntry
	LEFT JOIN OUOM T2 ON T1.UoMEntry = T2.UoMEntry
	LEFT JOIN OACT T3 ON T1.AcctCode = T3.AcctCode
	LEFT JOIN OITM T4 ON T4.ItemCode = T1.ItemCode
	LEFT JOIN OWHS T5 ON T5.WhsCode = T1.WhsCode

	WHERE " .$docentryString. " IN ( $docEntry ) AND T0.ObjType = $objType
	ORDER BY T1.LineNum ASC");
$ctr = 1;

while (odbc_fetch_row($qry)) 
{
	
	$DocEntry = odbc_result($qry, "DocEntry");
	$DocStatus = odbc_result($qry, "DocStatus");
	$LineNum = odbc_result($qry, "LineNum");
	$ObjType = odbc_result($qry, "ObjType");
	$TargetType = odbc_result($qry, "TargetType");
	$TrgetEntry = odbc_result($qry, "TrgetEntry");
	$LineStatus = odbc_result($qry, "LineStatus");
	$BaseType = odbc_result($qry, "BaseType");
	
	$VisOrder = odbc_result($qry, "VisOrder");
	$ItemCode = odbc_result($qry, "ItemCode");
    $Dscription = odbc_result($qry, "Dscription");
	$AcctCode = odbc_result($qry, "AcctCode");
	$AcctName = odbc_result($qry, "AcctName");
	$Quantity = odbc_result($qry, "Quantity");
	$PriceAfVat = odbc_result($qry, "PriceAfVat");
	$WTLiable = odbc_result($qry, "WTLiable");
	$WTLiableText = odbc_result($qry, "WTLiableText");
	
	$Price = odbc_result($qry, "Price");
	$DiscSum = number_format(odbc_result($qry, "DiscSum"),6);
	$DiscSum2 = number_format(odbc_result($qry, "DiscSum2"),6);
	$DiscPrcnt = number_format(odbc_result($qry, "DiscPrcnt"),6);
	
	$RowTotal = odbc_result($qry, "RowTotal");
	$GrossTotal = odbc_result($qry, "GrossTotal");
	$TaxAmount = odbc_result($qry, "TaxAmount");
	$WTLiable = odbc_result($qry, "WTLiable");
	$RowTotal2 = number_format(odbc_result($qry, "RowTotal2"),6);
	$GrossTotal2 = number_format(odbc_result($qry, "GrossTotal2"),6);
	$TaxAmount2 = number_format(odbc_result($qry, "TaxAmount2"),6);
	
	$VatGroup = odbc_result($qry, "VatGroup"); 
	$UoMEntry = odbc_result($qry, "UoMEntry"); 
	$UomCode = odbc_result($qry, "UomCode"); 
	$UnitMsr = odbc_result($qry, "UnitMsr"); 
	
	
	$ManBtchNum = odbc_result($qry, "ManBtchNum"); 
	$ManSerNum = odbc_result($qry, "ManSerNum"); 
	
	$WhsCode = odbc_result($qry, "WhsCode"); 
	$WhsName = odbc_result($qry, "WhsName"); 
	
	$readonly = '';
	$inputGroup = 'input-group';
	$buttonHide = '';
	$disabled = '';
	$hasBatchSerial = '';


	if($ManBtchNum == 'Y'){
		if ($BaseType == '-1'){
			$hasBatchSerial = 'B';
		} else {
			$hasBatchSerial = '-B';	
		}
	}
	else if($ManSerNum == 'Y'){
		if ($BaseType == '-1'){
			$hasBatchSerial = 'S';
		} else {
			$hasBatchSerial = '-S';	
		}
	}
	else{
		$hasBatchSerial = '';
	}

			
	}
odbc_free_result($qry);
odbc_close($MSSQL_CONN);


$docentry = $DocEntry;
$absentry = '';
$selSeries = $Series;
$txtCardCode = $CardCode;
$txtPostingDate  = $DocDate;
$txtDeliveryDate  = $DocDueDate;
$txtDocumentDate  = $TaxDate;
$txtContactPerson   = $ContactPerson;
$txtCustomerRefNo  = $NumAtCard;

$txtOwnerCode  = $EmpID;
$txtRemarks = $Comments;
$selShipToAddress  = $ShipToCode;
$selBillToAddress  = $PayToCode;
$txtJournalMemo  = $JrnlMemo;

$objectType = 13;

$txtDocNum = $DocNum;
$txtOwnerCode = $_SESSION['SESS_EMP'];

$ApprovalTemplateCode = $_SESSION['ApprovalTemplateCode']; 
$OriginatorEmpId = $_SESSION['OriginatorEmpId']; 
$ApprovalStageCode = $_SESSION['ApprovalStageCode']; 
$ApproverEmpId = $_SESSION['ApproverEmpId']; 
$ApprovalModules = $_SESSION['ApprovalModules']; 
$NoOfApprovals = $_SESSION['NoOfApprovals']; 
$NoOfDisapprovals = $_SESSION['NoOfDisapprovals'];

$ApproverEmpId = implode(', ', $_SESSION['ApproverEmpId']);



if ($err == 0) 
{
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

	$oRdr = $vCmp->GetBusinessObject($objectType);
	 	
			$oRdr->Series = $selSeries;
			$oRdr->CardCode = $txtCardCode;
			$oRdr->TaxDate = $txtDocumentDate;
			
			$oRdr->DocDate = $txtPostingDate;
		
			$oRdr->NumAtCard  = $txtCustomerRefNo;
			
			$oRdr->Comments  = $txtRemarks;
		
			$oRdr->DocumentsOwner  = $txtOwnerCode;
			

			// $serviceType2 = $serviceType == "I" ? 0 : 1;
			$oRdr->DocType = 1;
			
						$oRdr->Lines->ItemDescription = $Dscription;
						$oRdr->Lines->AccountCode = $AcctCode;
						$oRdr->Lines->UnitPrice = $Price; 
						$oRdr->Lines->DiscountPercent = $DiscPrcnt;
						$oRdr->Lines->VatGroup = $VatGroup;
			

			$retval = $oRdr->Add();
			if ($retval != 0) 
			{
				$errmsg .= $vCmp->GetLastErrorDescription;
				$err += 1;
			}
			else
			{
				$vCmp->GetNewObjectCode($docentry);


				if($NoOfApprovals > 0 ){
					

					$qryApp = odbc_exec($MSSQL_CONN, "USE [".$MSSQL_DB."]; 
	
					INSERT INTO [".$MSSQL_DB2."].[dbo].[SAP_DOCS_WITH_APPROVAL]  
					(
						SapDatabase,
						SapDraftEntry,
						ObjectType,
						OwnerCode,
						ApprovalStatus,
						ApproverIds,
						NoOfApprovalsRequired,
						NoOfDisapprovalRequired
					)
					
					VALUES 
					(
						'".$MSSQL_DB."',
						$docentry,
						13,
						$txtOwnerCode,
						'PENDING',
						'$ApproverEmpId',
						$NoOfApprovals,
						$NoOfDisapprovals


					)"

					);
				}
				else{
					
				}
		
			}	  
	}
}

?>

