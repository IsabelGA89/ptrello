<?php
require 'vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;


try {
  //Recoger el contenido de la plantilla html:
  ob_start();
  require_once 'print_view.php';
  $htmlContent = ob_get_clean();

 //Montar el html:
  $pdf = new \Spipu\Html2Pdf\Html2Pdf('P','A4','es', true, 'UTF-8', array(mL, mT, mR, mB));
  $pdf->writeHTML($htmlContent);
  $pdf->output("TrelloReport.pdf");
  //descarga obligatoriamente el pdf:
  // $pdf->output('report.pdf', 'D');
} catch (Html2PdfException $e) {
    $html2pdf->clean();

    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}

?>
