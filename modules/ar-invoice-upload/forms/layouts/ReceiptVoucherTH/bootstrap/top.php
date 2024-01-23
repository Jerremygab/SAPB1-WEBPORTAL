<?php [$colWidth] = [100/3] ?>
<div class="top-div container">
    <div class="padder">
        <div class="content">
            <div>
                <table>
                    <tr>
                        <td style="text-align: left; width: <?= $colWidth ?>%;">
                            <div>
                                <img src="<?= $formModel->logo->path ?>" alt="logo" height="<?= $formModel->logo->height ?>" width="<?= $formModel->logo->width ?>">
                            </div>
                        </td>
                        <td style="text-align: center; vertical-align: bottom; width: <?= $colWidth ?>%;">
                            <div style="font-weight: bold; font-size: 1.2em;"><span><?= ucfirst(strtolower($formModel->header->title)) ?></span></div>
                        </td>
                        <td style="text-align: right; width: <?= $colWidth ?>%;">
                            <span></span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>  
</div>