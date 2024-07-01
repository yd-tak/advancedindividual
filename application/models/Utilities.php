<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// use PdfParser;
use Smalot\PdfParser\Parser;
use Dompdf\Dompdf;
use Dompdf\Options;

class Utilities extends CI_Model {
    public function extractPdf($filePath) {
        $parser = new Parser();
        $pdf = $parser->parseFile($filePath);

        // Extract the text from the PDF
        $text = $pdf->getText();
        return $text;
    }
    public function savetopdf($content,$filename){
        // Initialize dompdf with options
        $options = new Options();
        $options->set('defaultFont', 'Courier');
        $dompdf = new Dompdf($options);

        // Load HTML content
        $html = $content;
        $dompdf->loadHtml($html);

        // (Optional) Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to browser
        $dompdf->stream('./assets/offering/'.$filename.".pdf", array("Attachment" => false));
        return true;
    }
}
?>
