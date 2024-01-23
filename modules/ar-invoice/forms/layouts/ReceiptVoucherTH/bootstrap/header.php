<?php [$colWidth1, $colWidth2] = ['70%', '30%'] ?>
<div class="header-div container">
    <div class="padder">
        <div class="content">
            <div>
                <table>
                    <tr>
                        <td style="text-align: left; width: <?= $colWidth1 ?>;">
                            <div><span></span></div>
                        </td>
                        <td style="text-align: left; width: <?= $colWidth2 ?>;">
                            <div><span>Voucher No.: <?= $formModel->header->documentNumber ?><br>Date: <?= $formModel->header->documentDate ?></span></div>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: left; width: <?= $colWidth1 ?>;">
                            <div><span>Received from<br>Tax ID: <?= $formModel->header->tinNo ?><br>Branch: <?= $formModel->header->branch ?></span></div>
                        </td>
                        <td style="text-align: left; width: <?= $colWidth2 ?>;">
                            <div><span>Received Date: <?= $formModel->header->receivedDate ?><br>Bank</span></div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>