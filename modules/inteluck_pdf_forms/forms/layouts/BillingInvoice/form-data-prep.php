<?php

require __DIR__.'/../../../../addon-resources/print-form/components/inc/autoload.php';
require __DIR__.'/../../../../addon-resources/print-form/components/inc/globals.php';

$formModel = new FormModel();

############################### DATA SOURCE ###############################
$formModel->storedProcName = '';
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
        'type' => ColumnType::ROW_NUMBER,
        'sqlColumnName' => ''
    ],
    [
        'description' => 'Dispatch Date',
        'type' => ColumnType::DATE,
        'sqlColumnName' => 'DocDate'
    ],
    [
        'description' => 'Plate #',
        'type' => ColumnType::NUMBER,
        'sqlColumnName' => 'DocNum'
    ],
    [
        'description' => 'Origin DC',
        'type' => ColumnType::TEXT,
        'sqlColumnName' => 'CardName'
    ],
    [
        'description' => 'Origin DC Code',
        'type' => ColumnType::TEXT,
        'sqlColumnName' => 'CardCode'
    ],
    [
        'description' => 'Drop Point',
        'type' => ColumnType::TEXT,
        'sqlColumnName' => 'Address1'
    ],
    [
        'description' => 'Destination',
        'type' => ColumnType::TEXT,
        'sqlColumnName' => 'Address2'
    ],
    [
        'description' => 'DC Code',
        'type' => ColumnType::TEXT,
        'sqlColumnName' => 'LicTradNum'
    ],
    [
        'description' => 'Total QTY',
        'type' => ColumnType::NUMBER,
        'sqlColumnName' => 'Quantity'
    ],
    [
        'description' => 'Cable Tie #',
        'type' => ColumnType::NUMBER,
        'sqlColumnName' => 'ItemCode'
    ],
    [
        'description' => 'Trip Tickets #',
        'type' => ColumnType::NUMBER,
        'sqlColumnName' => 'AcctCode'
    ],
    [
        'description' => "Addt'l Charge",
        'type' => ColumnType::MONEY,
        'sqlColumnName' => 'Price'
    ],
    [
        'description' => 'Amount',
        'type' => ColumnType::MONEY,
        'sqlColumnName' => 'Price'
    ],
    [
        'description' => 'Remarks',
        'type' => ColumnType::TEXT,
        'sqlColumnName' => 'AcctName'
    ],
    [
        'description' => 'Truck Type',
        'type' => ColumnType::TEXT,
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
