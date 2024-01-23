<div class="body-div container">
    <div class="padder">
        <div class="content">
            <div>
                <table>
                    <tr>
                        <td>&emsp;&emsp;Description:</td>
                    </tr>
                </table>
            </div>
            <div>
                <table class="details">
                    <thead>
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
                            <td colspan="6" style="text-align: left;"><span></span></td>
                            <td style="text-align: left;"><span>&emsp;&emsp;Amount<br>&emsp;&emsp;Vat<br>&emsp;&emsp;WHT</span><br><br><br></td>
                            <td style="border-bottom: 1px solid lightgray;"><span></span></td>
                        </tr>
                        <tr>
                            <td colspan="6" style="text-align: left;"><span></span></td>
                            <td style="text-align: left;"><span>&emsp;Net Received</td>
                            <td><span></span></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>