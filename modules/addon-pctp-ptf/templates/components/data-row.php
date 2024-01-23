<?php 
    $formula = '';
    if (preg_match('/^_\S+$/', $columnDefinition->fieldName)) {
        $formula = 'data-pctp-formula="'.$columnDefinition->fieldName.'"';
    }
    $fieldName = preg_replace('/^_/', '', $columnDefinition->fieldName);
    $events = '';
    if (isset($model->getColumnValidations()[$tabKeyword][$fieldName])) {
        foreach ($model->getColumnValidations()[$tabKeyword][$fieldName]->events as $eventType => $eventOptions) {
            $events .= ' '.$eventType.'="fieldEvent($(this), \''.$eventType.'\')" ';
        }
    }
?>
<?php if($fieldName === 'Attachment'): ?>
    <a data-pctp-type="<?= $columnDefinition->columnType->value ?>" <?= $formula ?> data-pctp-model="<?= $fieldName ?>" 
        data-pctp-value="<?= $tableRow->{$fieldName} ?>" onclick="clickAttachmentLink(this, event)" href=""
        title="<?= (bool)$tableRow->{$fieldName} ? $tableRow->{$fieldName} : '' ?>">
        <?= (bool)$tableRow->{$fieldName} ? '1 attachment' : 'No attachment' ?>
    </a>
<?php else: ?>
    <?php $placeHolder = 'No data' ?>
    <?php switch($columnDefinition->columnViewType):
        case ColumnViewType::AUTO: 
            $value = $fieldName && !is_null($tableRow->{$fieldName}) ? $tableRow->{$fieldName} : '';
        ?>
            <?php switch ($columnDefinition->columnType):
                case ColumnType::DATE: ?>
                    <span data-pctp-type="<?= $columnDefinition->columnType->value ?>" <?= $formula ?> data-pctp-model="<?= $fieldName ?>" data-pctp-value="<?= $value ?>"><?= $value ?></span>
                    <?php break ?>
                <?php default: ?>
                    <span data-pctp-type="<?= $columnDefinition->columnType->value ?>" <?= $columnDefinition->columnType === ColumnType::FLOAT ? 'class="floatValue"' : '' ?> <?= $formula ?> data-pctp-model="<?= $fieldName ?>" data-pctp-value="<?= $value ?>"><?= $value ?></span>
                <?php endswitch ?>
        <?php break ?>
    <?php case ColumnViewType::DROPDOWN: ?>
        <select data-pctp-type="<?= $columnDefinition->columnType->value ?>" <?= $formula ?> <?= $events ? 'data-pctp-observer' : '' ?> <?= $events ?> <?= !str_contains($events, 'onchange') ? 'onkeypress="fieldOnchange($(this))" onchange="fieldOnchange($(this))"' : '' ?> data-pctp-model="<?= $fieldName ?>" data-pctp-value="<?= $tableRow->{$fieldName} ?>" 
            class="edit-field" id="sel<?= strtolower($fieldName) ?>" 
            style="width: 100%;" data-pctp-options="<?= $columnDefinition->options ?>">
            <?php 
                $options = $model->dropDownOptions[$columnDefinition->options]; 
                $data = $tableRow->{$fieldName};
            ?>
            <?php if((bool)$data): ?>
                <option value=""></option>
                <?php if(!(bool)array_filter($options, fn($z) => $z->Name === $data || $z->Code === $data)): ?>
                    <option value="<?= $data ?>" selected><?= $data ?></option>
                <?php endif ?>
            <?php else: ?>
                <option value="" style="display: none;" disabled selected>Select...</option>
                <option value=""></option>
            <?php endif ?>
            <?php foreach($options as $option): ?>
                <option value="<?= $option->Code ?>" <?= $option->Name === $data || $option->Code === $data ? 'selected' : '' ?>><?= $option->Name ?></option>
            <?php endforeach ?>
        </select>
        <?php break ?>
    <?php default: ?>
        <?php 
            $inputType;
            $inputValue = '';
            $inputPlaceholder = '';
            $alignment;
            switch ($columnDefinition->columnType) {
                case ColumnType::DATE:
                    $inputType = 'date';
                    if ((bool)$tableRow->{$fieldName}) {
                        $inputValue = date('Y-m-d', strtotime($tableRow->{$fieldName}));
                    } else {
                        $inputValue = '';
                    }
                    $alignment = 'left';
                    break;
                case ColumnType::INT:
                case ColumnType::FLOAT:
                    $inputType = 'number';
                    $alignment = 'right';
                    if ($fieldName) {
                        if (!(bool)$tableRow->{$fieldName}) {
                            $inputPlaceholder = $placeHolder;
                        } else {
                            $inputValue = str_replace(',', '', $tableRow->{$fieldName});
                        }
                    } else {
                        $inputPlaceholder = $placeHolder;
                    }
                    break;
                default:
                    $inputType = 'text';
                    $alignment = 'left';
                    if ($fieldName) {
                        if (!(bool)$tableRow->{$fieldName}) {
                            $inputPlaceholder = $placeHolder;
                        } else {
                            $inputValue = $tableRow->{$fieldName};
                        }
                    } else {
                        $inputPlaceholder = $placeHolder;
                    }
                    break;
            }
        ?>
        <input data-pctp-type="<?= $columnDefinition->columnType->value ?>" <?= $formula ?> <?= $events ? 'data-pctp-observer' : '' ?> <?= $events ?> <?= !str_contains($events, 'onchange') ? 'onkeypress="fieldOnchange($(this))" onchange="fieldOnchange($(this))"' : '' ?> data-pctp-model="<?= $fieldName ?>" data-pctp-value="<?= $inputValue ? $inputValue : '' ?>" class="edit-field" style="width: 100%; box-sizing: border-box; text-align: <?= $alignment ?>;" 
            type="<?= $inputType ?>" 
            value="<?= $inputValue ? $inputValue : '' ?>" 
            <?= $inputPlaceholder ? 'placeholder="'.$inputPlaceholder.'"' : '' ?>
        >
        <?php break ?>
    <?php endswitch ?>
<?php endif ?>