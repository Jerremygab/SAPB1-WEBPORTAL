<?php

require __DIR__.'/../../../../addon-resources/print-form/components/inc/autoload.php';
require __DIR__.'/../../../../addon-resources/print-form/components/inc/globals.php';



$formModel = new FormModel();

############################### DATA SOURCE ###############################
$formModel->storedProcName = 'usp_INTL_Billing_Invoice';
if ($formModel->storedProcName !== '' && !str_contains($formModel->storedProcName, ' ')) {
    $query = "EXEC [dbo].[$formModel->storedProcName] @DocKey = $docentry";
    $formModel->objRowArrResult = $formModel->getQueryResultRowObj($query);
} else {
    //testing
    $formModel->objRowArrResult = TestDataSource::getInstance()->billingInvoice_objRowArrResult;
}

############################### FORM MPDF OPTIONS ###############################
$formModel->mpdfOptions->orientation = 'L';
$formModel->mpdfOptions->marginTop = 10;
$formModel->mpdfOptions->marginLeft = 10;
$formModel->mpdfOptions->marginRight = 10;
$formModel->mpdfOptions->marginBottom = 10;

############################### FORM PROPS ###############################
$formModel->title = 'BILLING INVOICE';

############################### HEADER ###############################
$formModel->header->companyName = 'Inteluck Corporation';
$formModel->header->companyAddress = 'UNIT 1802 & 1803 ANTEL 2000 CORPORATE CENTER, 121 VALERO ST., SALCEDO VILLAGE, BRGY. BEL-AIR, MAKATI CITY';
$formModel->header->tinNo = '008-647-370-000';
$formModel->header->title = 'STATEMENT OF ACCOUNT';
$formModel->header->subTitle = 'SOA #';
$formModel->header->documentDate = date('F j, Y');


############################### BODY TABLE ###############################
$formModel->columnDefinitions = Util::arrayToObject([
    [
        'description' => 'No.',
        'type' => 4,
        'sqlColumnName' => ''
    ],
    [
        'description' => 'Dispatch Date',
        'type' => 2,
        'sqlColumnName' => 'DocDate'
    ],
    [
        'description' => 'Plate #',
        'type' => 1,
        'sqlColumnName' => 'DocNum'
    ],
    [
        'description' => 'Origin DC',
        'type' => 2,
        'sqlColumnName' => 'CardName'
    ],
    [
        'description' => 'Origin DC Code',
        'type' => 2,
        'sqlColumnName' => 'CardCode'
    ],
    [
        'description' => 'Drop Point',
        'type' => 2,
        'sqlColumnName' => 'Address1'
    ],
    [
        'description' => 'Destination',
        'type' => 2,
        'sqlColumnName' => 'Address2'
    ],
    [
        'description' => 'DC Code',
        'type' => 2,
        'sqlColumnName' => 'LicTradNum'
    ],
    [
        'description' => 'Total QTY',
        'type' => 1,
        'sqlColumnName' => 'Quantity'
    ],
    [
        'description' => 'Cable Tie #',
        'type' => 1,
        'sqlColumnName' => 'ItemCode'
    ],
    [
        'description' => 'Trip Tickets #',
        'type' => 1,
        'sqlColumnName' => 'AcctCode'
    ],
    [
        'description' => "Addt'l Charge",
        'type' => 0,
        'sqlColumnName' => 'Price'
    ],
    [
        'description' => 'Amount',
        'type' => 0,
        'sqlColumnName' => 'Price'
    ],
    [
        'description' => 'Remarks',
        'type' => 2,
        'sqlColumnName' => 'AcctName'
    ],
    [
        'description' => 'Truck Type',
        'type' => 2,
        'sqlColumnName' => 'PymntGroup'
    ],
]);

############################### FOOTER ###############################
$formModel->signatories = [
    (object) [
        'name' => 'ROSE VILLAZUR',
        'description' => 'Accounting Assistant'
    ],
    (object) [
        'name' => '_________________________________',
        'description' => 'Signature over printed name'
    ]
];
