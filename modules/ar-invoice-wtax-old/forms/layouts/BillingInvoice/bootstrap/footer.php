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
                            <div><?= $formModel->signatories[0]->name ?></div>
                            <div><?= $formModel->signatories[0]->description ?></div>
                        </td>
                        <td>
                            <div>Checked by:</div>
                            <div>&nbsp;</div>
                            <div>&nbsp;</div>
                            <div><?= $formModel->signatories[1]->name ?></div>
                            <div><?= $formModel->signatories[1]->description ?></div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
