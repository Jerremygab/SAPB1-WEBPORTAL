<?php
$err = 0;
$errmsg = '';
session_start();
include('../../../../config/config.php');

$docentry = '';



// //-Create new COM object-depends on your Crystal Report version 
// $ObjectFactory= new COM("CrystalReports115.ObjectFactory.1") or die ("Error on load"); 

// // call COM port 
// $crapp = $ObjectFactory-> CreateObject("CrystalRuntime.Application.11"); 

// // create an instance for Crystal 
// $creport = $crapp->OpenReport($my_report, 1); // call rpt report

//rpt source file 
$my_pdf = "d:\\sauve\\report.pdf"; // RPT export to pdf file 
//-Create new COM object-depends on your Crystal Report version 
$ObjectFactory= new COM("CrystalReports115.ObjectFactory.1") or die ("Error on load"); // call COM port 
$crapp = $ObjectFactory-> CreateObject("CrystalRuntime.Application"); // create an instance for Crystal 
$creport = $crapp->OpenReport($my_report, 1); // call rpt report 

//- Set database logon info - must have 
$creport->Database->Tables(1)->SetLogOnInfo ("SUA_DB", "test.mdb", "", ""); 

//- field prompt or else report will hang - to get through 
$creport->EnableParameterPrompting = 0; 

//- DiscardSavedData - to refresh then read records 
$creport->DiscardSavedData; 
$creport->ReadRecords(); 


//export to PDF process 
$creport->ExportOptions->DiskFileName=$my_pdf; //export to pdf 
$creport->ExportOptions->PDFExportAllPages=true; 
$creport->ExportOptions->DestinationType=1; // export to file 
$creport->ExportOptions->FormatType=31; // PDF type 
$creport->Export(false); 

//------ Release the variables ------ 
$creport = null; 
$crapp = null; 
$ObjectFactory = null; 

//print "<embed src=\"D:\\pop\\EMMEC\\Etats\\RPT-list.pdf\" width=\"100%\" height=\"100%\">"
$file = 'E:/report.pdf';
$filename = 'report.pdf'; /* Note: Always use .pdf at the end. */

header('Content-type: application/pdf');
header('Content-Disposition: inline; filename="' . $filename . '"');
header('Content-Transfer-Encoding: binary');
header('Content-Length: ' . filesize($file));
header('Accept-Ranges: bytes');

@readfile($file);
?>


?>