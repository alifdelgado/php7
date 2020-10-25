<?php

require "vendor/autoload.php";

use Dompdf\Dompdf;
$domPdf = new Dompdf();
$html = "Nuevo archivo PDF con Dompdf";
$domPdf->loadHtml($html);
$domPdf->render();
$domPdf->stream("ejemplo.pdf", ["Attachment" => 0]);