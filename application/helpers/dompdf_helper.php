<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

function pdf_create($html, $filename='', $orientation='potrait', $paper='A4', $stream=TRUE) 
{
    $dompdf = new DOMPDF();
    $dompdf->load_html($html);
    $dompdf->setPaper($paper, $orientation);
    $dompdf->render();
    if ($stream) {
        $dompdf->stream($filename.".pdf", array("Attachment" => 0));
    } else {
        return $dompdf->output();
    }
}