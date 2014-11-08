<?php
require('../var/fpdf17/fpdf.php');

class PDF extends FPDF {

    function Footer() {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',9);
        // Text color in gray
        $this->SetTextColor(128);
        // Page number
        $this->Cell(0,10,'page '.$this->PageNo(),0,0,'C');
    }

    function ChapterBody($file) {
        // Read text file
        $txt = file_get_contents($file);
        // Times 12
        $this->SetFont('Times','',12);
        // Output justified text
        $this->MultiCell(150,6,$txt,0,'L');
    }

    function PrintChapter($num, $file) {
        $this->AddPage();
        $this->ChapterBody($file);
    }
}

function createPDF($fileName) {
    $pdf = new PDF();
    $pdf->SetTitle('50k novel');
    $pdf->SetAuthor('god is a tj');
    $pdf->SetMargins(24, 24);
    $pdf->SetAutoPageBreak(true, 36);
    $pdf->PrintChapter(1,$fileName);
    $pdf->Output($fileName . '.pdf', 'F');
}

