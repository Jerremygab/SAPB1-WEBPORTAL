<?php

session_start();

$docentry = $_GET['docentry'];
$layout = $_GET['layout'];

include("layouts/$layout/form-data-prep.php");

ob_start();

include("layouts/$layout/form-template-header.php");
$dataHeader = ob_get_contents();
ob_end_clean();

ob_start();

include("layouts/$layout/form-template-body.php");
$dataBody = ob_get_contents();
ob_end_clean();

ob_start();

include("layouts/$layout/form-template-footer.php");
$dataFooter = ob_get_contents();
ob_end_clean();

require_once __DIR__ . '/../../../mpdf/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf([
    'tempDir' => __DIR__ . '/../../../mpdf/custom/temp/dir/path', 
    'orientation' => $formModel->mpdfOptions->orientation,
    'defaultPageNumStyle' => $formModel->mpdfOptions->defaultPageNumStyle,
    'pagenumPrefix' => $formModel->mpdfOptions->pagenumPrefix,
    'pagenumSuffix' => $formModel->mpdfOptions->pagenumSuffix,
    'nbpgPrefix' => $formModel->mpdfOptions->nbpgPrefix,
    'nbpgSuffix' => $formModel->mpdfOptions->nbpgSuffix
]);

$mpdf->mirrorMargins = 0.5;
$mpdf->defaultheaderfontsize = 8;
$mpdf->AddPageByArray([
    'margin-left' => $formModel->mpdfOptions->marginLeft,
    'margin-right' => $formModel->mpdfOptions->marginRight,
    'margin-top' => $formModel->mpdfOptions->marginTop,
    'margin-bottom' => $formModel->mpdfOptions->marginBottom,
    'margin-header' => $formModel->mpdfOptions->marginHeader,
    'margin-footer' => $formModel->mpdfOptions->marginFooter
]);

$mpdf->SetWatermarkText('');
$mpdf->watermark_font = 'DejaVuSansCondensed';
$mpdf->showWatermarkText = true;

$stylesheet = file_get_contents('../../mpdf/mpdf_css/pr_app-report.css');
$dataHeader = mb_convert_encoding($dataHeader, 'UTF-8', 'UTF-8');
$dataBody = mb_convert_encoding($dataBody, 'UTF-8', 'UTF-8');
$mpdf->WriteHTML($stylesheet, 1);
if ($dataHeader) {
    $mpdf->SetHTMLHeader($dataHeader, 'O', true);
    $mpdf->SetHTMLHeader($dataHeader, 'E', true);
}
if ($dataFooter) {
    $mpdf->SetHTMLFooter($dataFooter, 'O', true);
    $mpdf->SetHTMLFooter($dataFooter, 'E', true);
}
$mpdf->WriteHTML($dataBody);
$mpdf->Output();

?>
