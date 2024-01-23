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
    $formModel->objRowArrResult = TestDataSource::getInstance()->deliveryReport_objRowArrResult;
}

############################### FORM MPDF OPTIONS ###############################
$formModel->mpdfOptions->orientation = 'L';

############################### FORM PROPS ###############################
$formModel->title = 'DELIVERY REPORT';
$formModel->logo->alignment = 'right';

############################### HEADER ###############################
$formModel->header->companyName = 'Inteluck Corporation';
$formModel->header->companyAddress = 'Inteluck (Thailand) Co.,Ltd. (Head Office)<br>1, CP Tower 2 (Fortune Town), 17 floors, Radchadapisek Road,<br>
        Dindaeng, Dindaeng, Bangkok 10400, Thailand';
$formModel->header->tinNo = '0105562135204';
$formModel->header->title = $formModel->title;
$formModel->header->documentDate = date('F j, Y');

$formModel->header->customerName = 'Juan';
$formModel->header->documentNumber = $docentry;
$formModel->header->documentDate = date('F j, Y');

############################### BODY TABLE ###############################
$formModel->columnDefinitions = Util::arrayToObject([
    [
        'description' => 'Reference No. ',
        'type' => ColumnType::NUMBER,
        'sqlColumnName' => 'key1'
    ],
    [
        'description' => 'Delivered Date',
        'type' => ColumnType::TEXT,
        'sqlColumnName' => 'key2'
    ],
    [
        'description' => 'Client Name',
        'type' => ColumnType::TEXT,
        'sqlColumnName' => 'key3'
    ],
    [
        'description' => 'Plate No.',
        'type' => ColumnType::NUMBER,
        'sqlColumnName' => 'key4'
    ],
    [
        'description' => 'Vehicle Type & Capacity',
        'type' => ColumnType::TEXT,
        'sqlColumnName' => 'key5'
    ],
    [
        'description' => 'Delivery Origin',
        'type' => ColumnType::TEXT,
        'sqlColumnName' => 'key6'
    ],
    [
        'description' => 'Destination',
        'type' => ColumnType::TEXT,
        'sqlColumnName' => 'key7'
    ],
    [
        'description' => 'Shipment Fee ',
        'type' => ColumnType::TEXT,
        'sqlColumnName' => 'key8'
    ],
    [
        'description' => 'Lift On/ Life Off',
        'type' => ColumnType::TEXT,
        'sqlColumnName' => 'key9'
    ],
    [
        'description' => 'Total',
        'type' => ColumnType::MONEY,
        'sqlColumnName' => 'key10'
    ],
    [
        'description' => 'Remark',
        'type' => ColumnType::TEXT,
        'sqlColumnName' => 'key11'
    ]
]);
