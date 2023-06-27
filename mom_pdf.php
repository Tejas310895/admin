<?php
require('fpdf/fpdf.php');
include "functions.php";

class PDF extends FPDF
{

    function Header()
    {
        global $title;

        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Calculate width of title and position
        $w = $this->GetStringWidth($title) + 6;
        $this->SetX((210 - $w) / 2);
        // Colors of frame, background and text
        $this->SetDrawColor(0, 80, 180);
        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(0, 0, 0);
        // Thickness of frame (1 mm)
        $this->SetLineWidth(0.5);
        // Title
        $this->Cell($w, 9, $title, 1, 1, 'C', true);
        // Line break
        $this->Ln(10);
    }
    // Load data
    function LoadData($objs)
    {
        $counter = 0;
        $temp = [];
        foreach ($objs as $vals) {
            unset($vals['mom_obj_id']);
            unset($vals['mom_id']);
            unset($vals['created_at']);
            unset($vals['updated_at']);
            array_unshift($vals, ++$counter);
            $temp[] = $vals;
        }
        return $temp;
    }

    function ImprovedTable($header)
    {
        $this->SetFont('', 'B');
        // Column widths
        $w = array(20, 120, 13, 30);
        // Header
        for ($i = 0; $i < count($header); $i++)
            $this->Cell($w[$i], 7, $header[$i], 0, 0, 'L');
        $this->Ln(10);
    }

    // Colored table
    function FancyTable($header, $data)
    {
        // Colors, line width and bold font
        $this->SetFillColor(0, 0, 255);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'B');
        // Header
        $w = array(10, 130, 50);
        for ($i = 0; $i < count($header); $i++)
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = false;
        foreach ($data as $row) {
            $this->Cell($w[0], 6, $row[0], 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 6, $row['mom_objective'], 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 6, $row['mom_raised_by'], 'LR', 0, 'C', $fill);
            $this->Ln();
            $fill = !$fill;
        }
        // Closing line
        $this->Cell(array_sum($w), 0, '', 'T');
    }
}

if (isset($_GET['mom_id'])) {
    $data = get_mom_pdf($_GET['mom_id']);
    $pdf = new PDF();
    $title = 'MOMENTS OF MEETING';
    $pdf->SetTitle($title);
    // Column headings
    $header = array('Sl.no', 'Objectives', 'Raised By');
    $subject = array('Subject : ', $data['mom_title'], 'Date :', date('D-M-y', strtotime($data['mom_date'])));
    // Data loading
    $data = $pdf->LoadData($data['objectives']);
    $pdf->SetFont('Arial', '', 10);
    $pdf->AddPage();
    $pdf->ImprovedTable($subject);
    $pdf->FancyTable($header, $data);
    $pdf->Output();
}
