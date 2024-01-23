<div class="body-div container">
    <div class="padder">
        <div class="content">
            <div>
                <table>
                    <tr>
                        <td><strong><?= ucfirst(strtolower($formModel->header->title)) ?> No. <?= $docentry ?></strong></td>
                        <td style="text-align: right;"><strong>Date: <?= $formModel->header->documentDate ?></strong></td>
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
                                    <?php default: ?>
                                        <td><?= $rowObj->{$column->sqlColumnName} ?></td>
                                    <?php endswitch ?>
                                <?php endforeach ?>
                                </tr>
                            <?php endforeach ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="15">NO DATA</td>
                            </tr>
                        <?php endif ?>
                        <tr>
                            <td colspan="11"><strong>TOTAL</strong></td>
                            <td style="text-align: right;">
                                <?= Util::moneyFormat(
                                    $formModel->getColumnTotal(
                                        Util::getObjPropValFromObjArrays(
                                            $formModel->columnDefinitions, 
                                            'description', 
                                            "Addt'l Charge", 
                                            'sqlColumnName'
                                        )
                                    )) 
                                ?>
                            </td>
                            <td style="text-align: right;">
                                <?= Util::moneyFormat(
                                    $formModel->getColumnTotal(
                                        Util::getObjPropValFromObjArrays(
                                            $formModel->columnDefinitions, 
                                            'description', 
                                            'Amount', 
                                            'sqlColumnName'
                                        )
                                    )) 
                                ?>
                            </td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="11">&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>