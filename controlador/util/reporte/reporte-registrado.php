<?php
// Modificado: 16/07/2020 14:05
require('fpdf/fpdf.php');

class PDF extends FPDF
{
    // Page header
    function Header()
    {
        // Logo
        //$this->Image('..img/logo.svg',10,6,30);
        // Arial bold 12
        $this->SetFont('Arial', 'B', 12);
        // Move to the right
        $this->Cell(92);
        // Title
        $this->Cell(80, 12, 'BOLETOS', 0, 0, 'C');
        // Line break
        $this->Ln(12);
        $this->SetFillColor(240, 240, 240);
        $this->Cell(10, 11, utf8_decode('Nº'), 1, 0, 'C', 1);
        $this->Cell(30, 11, utf8_decode('BOLETO'), 1, 0, 'C', 1);
        $this->Cell(65, 11, utf8_decode('COMPRADOR'), 1, 0, 'C', 1);
        $this->Cell(30, 11, utf8_decode('ESTADO'), 1, 0, 'C', 1);
        $this->Cell(65, 11, utf8_decode('ASISTENTE'), 1, 0, 'C', 1);
        $this->Cell(40, 11, utf8_decode('PLAN'), 1, 0, 'C', 1);
        $this->Cell(37, 11, utf8_decode('REGALO'), 1, 1, 'C', 1);
    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 9
        $this->SetFont('Arial', 'I', 9);
        // Page number
        $this->Cell(0, 10, utf8_decode('Página') . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

include_once '../../global/config.php';

$conn = new mysqli(SERVIDOR, USUARIO, CONTRASENA, BASEDATOS);

if ($conn->connect_error) {
    echo $error->$conn->connect_error;
}
$conn->set_charset("utf8");

$consulta = "SELECT * FROM v_boleto ";
$resultado = $conn->query($consulta);

// Instanciation of inherited class
//'L o P , 'mm', 'A4'
$pdf = new PDF('L', 'mm', 'A4');
$pdf->SetMargins(10, 10, 20);
$pdf->SetAutoPageBreak(true, 15);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 11);

$numero = 1;
while ($row = $resultado->fetch_assoc()) {

    $pdf->Cell(10, 10, $numero, 1, 0, 'C', 0);
    $pdf->Cell(30, 10, utf8_decode($row['boleto']), 1, 0, 'C', 0);
    $pdf->Cell(65, 10, utf8_decode($row['comprador']), 1, 0, 'J', 0);
    $pdf->Cell(30, 10, utf8_decode($row['estado_venta']), 1, 0, 'C', 0);
    $pdf->Cell(65, 10, utf8_decode($row['asistente']), 1, 0, 'J', 0);
    $pdf->Cell(40, 10, utf8_decode($row['plan']), 1, 0, 'C', 0);
    $pdf->Cell(37, 10, utf8_decode($row['regalo']), 1, 1, 'C', 0);
    $numero++;
}
$pdf->Output();

$conn->close();
