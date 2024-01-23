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
    $query = "EXEC [dbo].[INTL_Billing_Invoice] @DocKey = $docentry";
    $formModel->objRowArrResult = $formModel->getQueryResultRowObj($query);
} else {
    //testing
    $formModel->objRowArrResult = TestDataSource::getInstance()->billingInvoiceTh_objRowArrResult;
}

############################### FORM MPDF OPTIONS ###############################
$formModel->mpdfOptions->orientation = 'P';
$formModel->mpdfOptions->pagenumPrefix = '            ';
$formModel->mpdfOptions->marginTop = 17;
$formModel->mpdfOptions->marginHeader = 10;
$formModel->mpdfOptions->marginFooter = 0;
$formModel->mpdfOptions->marginBottom = 0;

############################### FORM PROPS ###############################
$formModel->title = 'TAX INVOICE RECEIPT TH';
$formModel->logo->alignment = 'left';
$formModel->colors['color1'] = 'rgb(0, 114, 171)';

############################### HEADER ###############################
$formModel->header->companyName = 'Inteluck Corporation';
$formModel->header->companyAddress = 'Inteluck (Thailand) Co.,Ltd. (Head Office)<br>1, CP Tower 2 (Fortune Town), 17 floors, Radchadapisek Road,<br>
        Dindaeng, Dindaeng,<br>Bangkok 10400, Thailand';
$formModel->header->title = 'Tax Invoice/ Receipt';
$formModel->header->documentDate = date('F j, Y');

$formModel->header->tinNo = '0105562135204';
$formModel->header->telNo = '02-119-7574';
$formModel->header->website = 'www.inteluck.com';
$formModel->header->customerName = 'Client';
$formModel->header->documentNumber = $docentry;
$formModel->header->documentDate = date('F j, Y');
$formModel->header->receivedDate = date('F j, Y');
$formModel->header->branch = 'test_branch';
$formModel->header->propsPath = INCLUDE_DIR.'/blue-gray.jpg';

############################### BODY TABLE ###############################
$formModel->columnDefinitions = Util::arrayToObject([
    [
        'description' => '#',
        'type' => ColumnType::ROW_NUMBER,
        'sqlColumnName' => ''
    ],
    [
        'description' => 'Description',
        'type' => ColumnType::TEXT,
        'sqlColumnName' => 'Dscription'
    ],
    [
        'description' => 'Quantity',
        'type' => ColumnType::NUMBER,
        'sqlColumnName' => 'Quantity'
    ],
    [
        'description' => 'Unit Price',
        'type' => ColumnType::MONEY,
        'sqlColumnName' => 'Price'
    ],
    [
        'description' => 'Discount',
        'type' => ColumnType::MONEY,
        'sqlColumnName' => 'DiscPrcnt'
    ],
    [
        'description' => 'Amount',
        'type' => ColumnType::MONEY,
        'sqlColumnName' => 'LineTotal'
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
    ]
];
