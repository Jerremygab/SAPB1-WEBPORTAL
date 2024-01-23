<div class="footer-div container">
    <div class="padder">
        <div class="content">
            <div>
                <table class="details">
                    <tr>
                        <td class="col1">
                            <div>Prepared by:</div>
                            <div>&nbsp;</div>
                            <div>&nbsp;</div>
                            <div>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<?= $formModel->signatories[0]->name ?></div>
                            <div><?= $formModel->signatories[0]->description ?></div>
                        </td>
                        <td>
                            <div>Received by:</div>
                            <div>&nbsp;</div>
                            <div>&nbsp;</div>
                            <div><?= $formModel->signatories[1]->name ?></div>
                            <div><?= $formModel->signatories[1]->description ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="col1">
                            <div>Checked by:</div>
                            <div>&nbsp;</div>
                            <div>&nbsp;</div>
                            <div>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<?= $formModel->signatories[2]->name ?></div>
                            <div><?= $formModel->signatories[2]->description ?></div>
                        </td>
                        <td>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
