<?php

require __DIR__.'/../../../../addon-resources/print-form/components/inc/autoload.php';
require __DIR__.'/../../../../addon-resources/print-form/components/inc/globals.php';

$formModel = new FormModel();

############################### DATA SOURCE ###############################
$formModel->preProcessObjRowArrResult = new class implements IArrayProcessor {
    function processArray($arr): array
    {
        return $arr;
    }
};

$formModel->storedProcName = '';
if ($formModel->storedProcName !== '' && !str_contains($formModel->storedProcName, ' ')) {
    $query = "EXEC [dbo].[$formModel->storedProcName] @DocKey = $docentry";
    $formModel->objRowArrResult = $formModel->getQueryResultRowObj($query);
} else {
    //testing
    $formModel->objRowArrResult = TestDataSource::getInstance()->receiptVoucher_objRowArrResult;
}

############################### FORM MPDF OPTIONS ###############################
$formModel->mpdfOptions->orientation = 'P';

############################### FORM PROPS ###############################
$formModel->title = 'RECEIPT VOUCHER';
$formModel->logo->alignment = 'left';

############################### HEADER ###############################
$formModel->header->companyName = 'Inteluck Corporation';
$formModel->header->companyAddress = 'Inteluck (Thailand) Co.,Ltd. (Head Office)<br>1, CP Tower 2 (Fortune Town), 17 floors, Radchadapisek Road,<br>
        Dindaeng, Dindaeng, Bangkok 10400, Thailand';
$formModel->header->tinNo = '0105562135204';
$formModel->header->title = $formModel->title;
$formModel->documentDate = date('F j, Y');

$formModel->header->tinNo = '0105562135204';
$formModel->header->customerName = 'Juan';
$formModel->header->documentNumber = $docentry;
$formModel->header->documentDate = date('F j, Y');
$formModel->header->receivedDate = date('F j, Y');
$formModel->header->branch = 'test_branch';

############################### BODY TABLE ###############################
$formModel->columnDefinitions = Util::arrayToObject([
    [
        'description' => '#',
        'type' => ColumnType::ROW_NUMBER,
        'sqlColumnName' => 'key1'
    ],
    [
        'description' => 'Invoice No',
        'type' => ColumnType::NUMBER,
        'sqlColumnName' => 'key2'
    ],
    [
        'description' => 'Tax Invoice No',
        'type' => ColumnType::TEXT,
        'sqlColumnName' => 'key3'
    ],
    [
        'description' => 'Description',
        'type' => ColumnType::TEXT,
        'sqlColumnName' => 'key4'
    ],
    [
        'description' => 'Amount',
        'type' => ColumnType::MONEY,
        'sqlColumnName' => 'key5'
    ],
    [
        'description' => 'VAT',
        'type' => ColumnType::MONEY,
        'sqlColumnName' => 'key6'
    ],
    [
        'description' => 'WHT',
        'type' => ColumnType::TEXT,
        'sqlColumnName' => 'key7'
    ],
    [
        'description' => 'Net Paid',
        'type' => ColumnType::MONEY,
        'sqlColumnName' => 'key8'
    ]
]);

############################### FOOTER ###############################
$formModel->signatories = [
    (object) [
        'name' => 'TEST 1',
        'description' => ''
    ],
    (object) [
        'name' => 'TEST 2',
        'description' => ''
    ],
    (object) [
        'name' => 'TEST 3',
        'description' => ''
    ]
];
