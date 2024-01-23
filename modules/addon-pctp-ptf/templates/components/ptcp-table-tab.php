<?php 
    require_once __DIR__.'/../../res/inc/autoload.php';
    $model = PctpWindowFactory::getObject('PctpWindowController')->model;
    $tabKeyword = $_GET['tab'];
    $columnDefinitions = $model->{$tabKeyword.'Tab'}->columnDefinitions;
    $tableRows = $model->{$tabKeyword.'Tab'}->tableRows;
?>

<table id="tabtbl<?= $tabKeyword ?>" class="table text-center table-striped table-bordered table-sm detailsTable pctpTabTable" style="border-collapse: separate; background-color: lightgray; width: 100%; ">
    <thead style="position: sticky; top: 0px; border-bottom: 0 !important;">
        <tr>
            <th style="position: sticky; top: 0px; color: black; vertical-align: middle;">#</th>
            <?php if($tabKeyword !== 'summary'): ?>
                <th style="position: sticky; top: 0px; color: black; vertical-align: middle;"></th>
            <?php endif ?>
            <?php foreach($columnDefinitions as $columnDefinition): ?>
                <th style="position: sticky; top: 0px; color: black; vertical-align: middle;"><span><?= $columnDefinition->description ?></span></th>
            <?php endforeach ?>
        </tr>
    </thead>
    <tbody>
        <?php if(!(bool)$tableRows): ?>
            <tr>
                <td class="nodataplaceholder" style="text-align: left; vertical-align: middle; background-color: lightgray;" colspan="<?= count($columnDefinitions) + 2 ?>">NO DATA FOUND</td>
            </tr>
        <?php endif ?>
    </tbody>
</table>

<style>
    .pctpTabTable td {
        vertical-align: middle;
        background-color: <?= $model->viewOptions['td_background_color'] ?>;
    }
</style>