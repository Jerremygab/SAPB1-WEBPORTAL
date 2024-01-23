<div class="body-div container">
    <div class="padder">
        <div class="content">
            <div>
                <table class="details">
                    <thead>
                        <tr>
                            <th colspan="<?= count($formModel->columnDefinitions) ?>" style="text-align: right; border-top: 0px; height: 250px; vertical-align: top;">
                                <div class="pageNumber">{PAGENO}</div>
                            </th>
                        </tr>
                        <tr>
                            <?php foreach($formModel->columnDefinitions as $column): ?>
                                <?php switch ($column->type):
                                    case ColumnType::MONEY->value: ?>
                                    <th style="text-align: right;"><?= $column->description ?></th>
                                    <?php break ?>
                                <?php default: ?>
                                    <th><?= $column->description ?></th>
                                <?php endswitch ?>
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
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" style="text-align: left;"><span></span></td>
                            <td style="text-align: left; width: <?= 50/3 ?>%;"><span></span></td>
                            <td style="text-align: left; width: <?= 50/3 ?>%; color: <?= $formModel->colors['color1'] ?>;"><span><br> Total <br><br> Vat 0% <br><br> Grand Total</span></td>
                            <td style="width: <?= 50/3 ?>%;"><span></span></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: left;"><span></span></td>
                            <td colspan="3" ><div><hr style="margin: 2px 0px; width: 80%; color: <?= $formModel->colors['color1'] ?>;"></div></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: left;"><span></span></td>
                            <td style="text-align: left; width: <?= 50/3 ?>%;"><span></span></td>
                            <td style="text-align: left; width: <?= 50/3 ?>%; color: <?= $formModel->colors['color1'] ?>;"><span>WithholdingTax 1% <br><br> Payment Amount</span></td>
                            <td style="width: <?= 50/3 ?>%;"><span></span></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>