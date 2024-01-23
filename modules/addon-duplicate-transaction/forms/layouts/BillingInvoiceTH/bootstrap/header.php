<div class="header-div container">
    <div class="padder">
        <div class="content">
            <div>
                <table>
                    <tr>
                        <td style="text-align: left; width: 52%; vertical-align: top;">
                            <div>
                                <img src="<?= $formModel->logo->path ?>" alt="logo" height="<?= $formModel->logo->height ?>" width="<?= $formModel->logo->width ?>">
                            </div>
                            <div>
                                <span>
                                    <?= $formModel->header->companyAddress ?><br>
                                    Tax ID <?= $formModel->header->tinNo ?><br>
                                    Tel. <?= $formModel->header->telNo ?><br>
                                    <?= $formModel->header->website ?><br><br>
                                    <span style="color: <?= $formModel->colors['color1'] ?>;"><?= $formModel->header->customerName ?></span>
                                </span>
                            </div>
                        </td>
                        <td style="width: 48%;">
                            <div>
                                <table style="color: <?= $formModel->colors['color1'] ?>;">
                                    <tr>
                                        <td>
                                            <div>
                                                <table style="border-collapse: collapse; white-space: nowrap; table-layout: auto;">
                                                    <tr height="10px">
                                                        <td style="text-align: center; padding-top: 20px; padding-left: 60px; height: 10px; overflow: scroll;">
                                                            <div>
                                                                <span style="font-size: 1.5em;"><?= $formModel->header->title ?></span><br>
                                                                <span style="font-size: 1.1em;">Original (Set Document)</span>
                                                            </div>
                                                        </td>
                                                        <td rowspan="3" style="width: 10px; vertical-align: top;">
                                                            <div>
                                                                <img src="<?= $formModel->header->propsPath ?>" alt="logo" height="110px" width="100px">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><div><hr style="margin: 2px 0px;"></div></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div>
                                                                <span>
                                                                    Document No.<br>
                                                                    Date<br>
                                                                    Credit<br>
                                                                    Due Date<br>
                                                                    Seller<br>
                                                                    Reference
                                                                </span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><div><hr style="margin: 2px 0px;"></div></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div>
                                                <span>
                                                Project Name <br><br>
                                                Contact <br>
                                                Phone <br>
                                                Email
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>