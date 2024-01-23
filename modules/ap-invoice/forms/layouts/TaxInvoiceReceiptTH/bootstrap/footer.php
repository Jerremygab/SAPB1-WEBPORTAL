<div class="footer-div container">
    <div class="padder">
        <div class="content">
            <div>
                <span style="color: <?= $formModel->colors['color1'] ?>;">Remarks</span>
            </div>
            <div>
                <table>
                    <tr>
                        <td style="width: 45%; vertical-align: bottom;">
                            <table>
                                <tr>
                                    <td style="width: 38%;"><span><?= $formModel->signatories[0]->name ?><hr class="line">Received by:</span></td>
                                    <td style="width: 62%;"><span><br><hr class="line">Date</span></td>
                                </tr>
                            </table>
                        </td>
                        <td style="width: 10%; vertical-align: top;">
                            <div>
                                <img style="filter: grayscale(100%);" src="<?= $formModel->logo->path ?>" alt="logo" height="70px" width="100px"><br><br><br>
                            </div>
                        </td>
                        <td style="width: 45%; vertical-align: bottom;">
                            <table>
                                <tr>
                                    <td style="width: 38%;"><span><?= $formModel->signatories[1]->name ?><hr class="line">Delivered by:</span></td>
                                    <td style="width: 62%;"><span><br><hr class="line">Date</span></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
