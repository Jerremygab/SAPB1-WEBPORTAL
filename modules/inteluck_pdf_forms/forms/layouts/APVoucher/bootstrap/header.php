<div class="header-div container">
    <div class="padder">
        <div class="content">
            <div style="font-size: 1.2em; text-align: center;"><span><strong><?= $formModel->header->companyName ?></strong></span></div>
            <div style="text-align: center;"><span><?= $formModel->header->companyAddress ?></span></div>
            <div style="padding-top: 5px; text-align: center;"><span>VAT REG. TIN : <?= $formModel->header->tinNo ?></span></div>
            <div style="padding-top: 5px; text-align: center; font-size: 2em; font-weight: bold; color: <?= $formModel->colors['color1'] ?>;"><span><?= $formModel->header->title ?></span></div>
            <div style="padding-top: 40px;">
                <table>
                    <tbody>
                        <tr>
                            <td style="vertical-align: top; width: 450px;">
                                <div>
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td class="label" style="width: 80px;">
                                                    <span>
                                                        Billed to:
                                                    </span>
                                                </td>
                                                <td>
                                                    <span>
                                                        <?= $formModel->header->customerName ?>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="label">
                                                    <span>
                                                        TIN
                                                    </span>
                                                </td>
                                                <td>
                                                    <span>
                                                        <?= $formModel->header->customerTin ?>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="label">
                                                    <span>
                                                    ADDRESS
                                                    </span>
                                                </td>
                                                <td>
                                                    <span>
                                                        <?= $formModel->header->customerAddress ?>
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                            <td style="width: 50px;">

                            </td>
                            <td style="text-align: right;">
                                <div>
                                    <table style="text-align: left;">
                                        <tbody>
                                            <tr>
                                                <td class="label" style="padding-left: 20px; padding-bottom: 20px; width: 50px;">
                                                    <span>
                                                        Date
                                                    </span>
                                                </td>
                                                <td style="padding-left: 20px; padding-bottom: 20px;">
                                                    <div>
                                                        <span>
                                                            <?= $formModel->header->documentDate ?>
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <div style="font-size: 2em; font-weight: bold; color: <?= $formModel->colors['color1'] ?>;">
                                                        <span>NO.&nbsp;</span><span><?= $formModel->header->documentNumber ?></span>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>