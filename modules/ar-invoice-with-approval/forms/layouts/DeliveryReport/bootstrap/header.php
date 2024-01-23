<div class="header-div container">
    <div class="padder">
        <div class="content">
            <div>
                <table>
                    <tr>
                        <td>
                            <div><span><strong>Customer Name:</strong></span></div>
                        </td>
                        <td>
                            <div><span><strong><?= $formModel->header->customerName ?></strong></span></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div><span><strong>Invoice No.:</strong></span></div>
                        </td>
                        <td>
                            <div><span><strong><?= $formModel->header->documentNumber ?></strong></span></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div><span><strong>Invoice Date:</strong></span></div>
                        </td>
                        <td>
                            <div><span><strong><?= $formModel->header->documentDate ?></strong></span></div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>