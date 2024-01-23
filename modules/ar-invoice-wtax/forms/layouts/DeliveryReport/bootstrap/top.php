<div class="top-div container">
    <div class="padder">
        <div class="content">
            <div>
                <table>
                    <tr>
                        <td>
                            <div style="text-align: center; font-weight: bold; font-size: 1.2em;"><span><?= $formModel->header->title ?></span></div>
                            <br>
                            <div style="text-align: center;"><span><?= $formModel->header->companyAddress ?></span></div>
                            <div style="text-align: center;"><span>Tax ID <?= $formModel->header->tinNo ?></span></div>
                        </td>
                        <td style="text-align: right;">
                            <div>
                                <img src="<?= $formModel->logo->path ?>" alt="logo" height="<?= $formModel->logo->height ?>" width="<?= $formModel->logo->width ?>">
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>  
</div>