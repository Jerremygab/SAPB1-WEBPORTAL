<?php

require __DIR__.'/../../../../addon-resources/print-form/components/inc/scripts/autoload.php';
require __DIR__.'/../../../../addon-resources/print-form/components/inc/scripts/globals.php';

$formModel = new FormModel();

############################### DATA SOURCE ###############################
$formModel->storedProcName = 'usp_Inteluck_AP_Voucher';
if ($formModel->storedProcName !== '' && !str_contains($formModel->storedProcName, ' ')) {
    $query = "EXEC [dbo].[$formModel->storedProcName] @DocKey = $docentry";
    $formModel->objRowArrResult = $formModel->getQueryResultRowObj($query);
} else {
    //testing
    $formModel->objRowArrResult = TestDataSource::getInstance()->apVoucher_objRowArrResult;
}

############################### FORM MPDF OPTIONS ###############################
$formModel->mpdfOptions->orientation = 'P';
$formModel->mpdfOptions->marginTop = 10;
$formModel->mpdfOptions->marginLeft = 10;
$formModel->mpdfOptions->marginRight = 10;
$formModel->mpdfOptions->marginBottom = 10;

############################### FORM PROPS ###############################
$formModel->title = 'AP VOUCHER';
$formModel->colors['color1'] = 'rgb(26, 149, 214)';
$formModel->colors['color2'] = 'darkblue';
$formModel->colors['color3'] = 'rgb(222, 223, 224)';

############################### HEADER ###############################
$formModel->header->companyName = $formModel->objRowArrResult[0]->CompnyName;
$formModel->header->companyAddress = $formModel->objRowArrResult[0]->CompnyAddr;
$formModel->header->tinNo = $formModel->objRowArrResult[0]->TaxIdNum;
$formModel->header->title = 'AP Voucher';
$formModel->header->documentDate = date('m/d/Y', strtotime($formModel->objRowArrResult[0]->DocDate));
$formModel->header->documentNumber = $docentry;
$formModel->header->customerName = $formModel->objRowArrResult[0]->CardName;
$formModel->header->customerTin = $formModel->objRowArrResult[0]->LicTradNum;
$formModel->header->customerAddress = $formModel->objRowArrResult[0]->Address1;

############################### BODY TABLE ###############################
$formModel->columnDefinitions = Util::arrayToObject([
    [
        'description' => 'ITEM #',
        'type' => ColumnType::TEXT,
        'sqlColumnName' => 'ItemCode'
    ],
    [
        'description' => 'ITEM DESCRIPTION',
        'type' => ColumnType::TEXT,
        'sqlColumnName' => 'Dscription'
    ],
    [
        'description' => 'QTY',
        'type' => ColumnType::MONEY,
        'sqlColumnName' => 'Quantity'
    ],
    [
        'description' => 'GROSS PRICE',
        'type' => ColumnType::MONEY,
        'sqlColumnName' => 'PriceAfVAT'
    ],
    [
        'description' => 'TOTAL AMOUNT',
        'type' => ColumnType::MONEY,
        'sqlColumnName' => 'GTotal'
    ]
]);

############################### BODY FOOTER ###############################
$formModel->footer->totalPurchase = $formModel->objRowArrResult[0]->DocTotal;
$formModel->footer->lessEwt = $formModel->objRowArrResult[0]->WTSum;
$formModel->footer->totalAmount = $formModel->objRowArrResult[0]->AmountToPay;

############################### FOOTER ###############################
$formModel->signatories = [];
