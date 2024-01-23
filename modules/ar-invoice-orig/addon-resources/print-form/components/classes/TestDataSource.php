<?php

class TestDataSource
{
    public mixed $billingInvoice_objRowArrResult;
    public mixed $billingInvoiceTh_objRowArrResult;
    public mixed $billingSummary_objRowArrResult;
    public mixed $deliveryReport_objRowArrResult;
    public mixed $receiptVoucher_objRowArrResult;

    private function __construct()
    {
        $this->billingInvoice_objRowArrResult = Util::arrayToObject([
            [
                'key1' => 'value1_1',
                'key2' => 'value1_2',
                'key3' => 'value1_3',
                'key4' => 'value1_4',
                'key5' => 'value1_5',
                'key6' => 'value1_6',
                'key7' => 'value1_7',
                'key8' => 'value1_8',
                'key9' => 'value1_9',
                'key10' => 'value1_10',
                'key11' => 'value1_11',
                'key12' => 50,
                'key13' => 100.50,
                'key14' => 'value1_14',
                'key15' => 'value1_15'
            ],
            [
                'key1' => 'value2_1',
                'key2' => 'value2_2',
                'key3' => 'value2_3',
                'key4' => 'value2_4',
                'key5' => 'value2_5',
                'key6' => 'value2_6',
                'key7' => 'value2_7',
                'key8' => 'value2_8',
                'key9' => 'value2_9',
                'key10' => 'value2_10',
                'key11' => 'value2_11',
                'key12' => 500.75,
                'key13' => 350,
                'key14' => 'value2_14',
                'key15' => 'value2_15'
            ]
        ]);

        $this->billingSummary_objRowArrResult = Util::arrayToObject([
            [
                'key1' => 'value1_1',
                'key2' => 'value1_2',
                'key3' => 'value1_3',
                'key4' => 'value1_4',
                'key5' => 'value1_5',
                'key6' => 500.25
            ],
            [
                'key1' => 'value2_1',
                'key2' => 'value2_2',
                'key3' => 'value2_3',
                'key4' => 'value2_4',
                'key5' => 'value2_5',
                'key6' => 260.50
            ]
        ]);

        $this->deliveryReport_objRowArrResult = Util::arrayToObject([
            [
                'key1' => 'value1_1',
                'key2' => 'value1_2',
                'key3' => 'value1_3',
                'key4' => 'value1_4',
                'key5' => 'value1_5',
                'key6' => 'value1_6',
                'key7' => 'value1_7',
                'key8' => 'value1_8',
                'key9' => 'value1_9',
                'key10' => 520.75,
                'key11' => 'value1_11'
            ],
            [
                'key1' => 'value2_1',
                'key2' => 'value2_2',
                'key3' => 'value2_3',
                'key4' => 'value2_4',
                'key5' => 'value2_5',
                'key6' => 'value2_6',
                'key7' => 'value2_7',
                'key8' => 'value2_8',
                'key9' => 'value2_9',
                'key10' => 310.20,
                'key11' => 'value2_11'
            ]
        ]);

        $this->receiptVoucher_objRowArrResult = Util::arrayToObject([
            [
                'key1' => 'value1_1',
                'key2' => 'value1_2',
                'key3' => 'value1_3',
                'key4' => 'value1_4',
                'key5' => 150.50,
                'key6' => 90,
                'key7' => 'value1_7',
                'key8' => 10.25
            ],
            [
                'key1' => 'value2_1',
                'key2' => 'value2_2',
                'key3' => 'value2_3',
                'key4' => 'value2_4',
                'key5' => 32,
                'key6' => 12.75,
                'key7' => 'value2_7',
                'key8' => 60
            ]
        ]);
        
        $this->billingInvoiceTh_objRowArrResult = Util::arrayToObject([
            [
                'key1' => 'value1_1',
                'key2' => 'value1_2',
                'key3' => 'value1_3',
                'key4' => 150.50,
                'key5' => 90,
                'key6' => 10.25
            ],
            [
                'key1' => 'value2_1',
                'key2' => 'value2_2',
                'key3' => 'value2_3',
                'key4' => 32,
                'key5' => 12.75,
                'key6' => 60
            ]
        ]);
    }

    public static function getInstance(): TestDataSource
    {
        return new TestDataSource();
    }
}