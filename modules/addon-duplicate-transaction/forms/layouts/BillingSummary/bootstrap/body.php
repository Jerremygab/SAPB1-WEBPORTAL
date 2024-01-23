<div class="body-div container">
    <div class="padder">
        <div class="content">
            <div>
                <table>
                    <tr>
                        <td><strong>PERIOD COVERED: <?= $formModel->header->datePeriod->from ?> - <?= $formModel->header->datePeriod->from ?></strong></td>
                    </tr>
                </table>
            </div>
            <div>
                <table class="details">
                    <thead>
                        <tr>
                            <?php foreach($formModel->columnDefinitions as $column): ?>
                                <th><?= $column->description ?></th>
                            <?php endforeach ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($formModel->objRowArrResult)): ?>
                            <?php foreach ($formModel->objRowArrResult as $i => $rowObj): ?>
                                <tr>
                                <?php foreach ($formModel->columnDefinitions as $column): ?>
                                    <?php switch ($column->type):
                                        case ColumnType::MONEY->value: ?>
                                        <td style="text-align: right;"><?= Util::moneyFormat($rowObj->{$column->sqlColumnName}) ?></td>
                                        <?php break ?>
                                    <?php case ColumnType::ROW_NUMBER->value: ?>
                                        <td><?= ++$i ?></td>
                                        <?php break ?>
                                    <?php case ColumnType::EMPTY->value: ?>
                                        <td style="color: white;"><?= $rowObj->{$column->sqlColumnName} ?></td>
                                        <?php break ?>
                                    <?php default: ?>
                                        <td><?= $rowObj->{$column->sqlColumnName} ?></td>
                                    <?php endswitch ?>
                                <?php endforeach ?>
                                </tr>
                            <?php endforeach ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="<?= count($formModel->columnDefinitions) ?>">NO DATA</td>
                            </tr>
                        <?php endif ?>
                        <tr>
                            <td colspan="4"><strong>** NOTHING FOLLOWS **</strong></td>
                            <td><strong>GRAND TOTAL</strong></td>
                            <td style="text-align: right;">
                                <?= Util::moneyFormat(
                                    $formModel->getColumnTotal(
                                        Util::getObjPropValFromObjArrays(
                                            $formModel->columnDefinitions, 
                                            'description', 
                                            'AMOUNT', 
                                            'sqlColumnName'
                                        )
                                    )) 
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" style="border-right: 1px solid white;"><strong>TOTAL AMOUNT NET OF VAT</strong></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="4" style="border-right: 1px solid white;"><strong>12% VAT</strong></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="4" style="border-right: 1px solid white;"><strong>TOTAL GROSS AMOUNT</strong></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>