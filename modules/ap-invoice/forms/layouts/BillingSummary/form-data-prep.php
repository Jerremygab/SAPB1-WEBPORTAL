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
    $formModel->objRowArrResult = TestDataSource::getInstance()->billingSummary_objRowArrResult;
}

############################### FORM MPDF OPTIONS ###############################
$formModel->mpdfOptions->orientation = 'P';

############################### FORM PROPS ###############################
$formModel->title = 'BILLING SUMMARY';
$formModel->logo->alignment = 'right';

############################### HEADER ###############################
$formModel->header->companyName = 'Inteluck Corporation';
$formModel->header->companyAddress = 'UNIT 1802 & 1803 ANTEL 2000 CORPORATE CENTER,<br> 121 VALERO ST., SALCEDO VILLAGE,<br> BRGY. BEL-AIR,<br> MAKATI CITY, PHILIPPINES 1227';
$formModel->header->tinNo = '008-647-370-000';
$formModel->header->title = $formModel->title;
$formModel->header->datePeriod->from = date('F j, Y');
$formModel->header->datePeriod->to = date('F j, Y');

############################### BODY TABLE ###############################
$formModel->columnDefinitions = Util::arrayToObject([
    [
        'description' => 'Date',
        'type' => ColumnType::TEXT,
        'sqlColumnName' => 'key1'
    ],
    [
        'description' => 'VEHICLE PLATE NO.',
        'type' => ColumnType::TEXT,
        'sqlColumnName' => 'key2'
    ],
    [
        'description' => 'TRIP TICKET',
        'type' => ColumnType::TEXT,
        'sqlColumnName' => 'key3'
    ],
    [
        'description' => 'ROUTE #',
        'type' => ColumnType::TEXT,
        'sqlColumnName' => 'key4'
    ],
    [
        'description' => '',
        'type' => ColumnType::EMPTY,
        'sqlColumnName' => 'key5'
    ],
    [
        'description' => 'AMOUNT',
        'type' => ColumnType::MONEY,
        'sqlColumnName' => 'key6'
    ]
]);

############################### FOOTER ###############################
$formModel->signatories = [
    (object) [
        'name' => 'KATE GADDI',
        'description' => ''
    ],
    (object) [
        'name' => '',
        'description' => ''
    ],
    (object) [
        'name' => 'BRIGITTE GONZALES',
        'description' => ''
    ]
];
