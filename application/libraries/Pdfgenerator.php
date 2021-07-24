<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once(APPPATH . "third_party/dompdf/autoload.inc.php");
use Dompdf\Dompdf;

class Pdfgenerator
{

    public function generate($html, $filename = '', $stream = true, $paper = 'A4', $orientation = "portrait")
    {
        $dompdf = new DOMPDF();
        $dompdf->loadHtml($html);
        $dompdf->setPaper(array(0, 0, 200, 650));
        $dompdf->set_option('dpi', 66);
        $dompdf->render();
        if ($stream) {
            $dompdf->stream($filename.".pdf", array("Attachment" => 0));
        } else {
            return $dompdf->output();
        }
    }
}
