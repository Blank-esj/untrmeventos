<?php
// Modificado: 16/07/2020 13:19
// Modificado: 17/07/2020 10:32
include('fpdf/fpdf.php');

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
        $this->Cell(55);
        // Title
        $this->Cell(162, 12, 'ADMINISTRADORES', 0, 0, 'C');
        // Line break
        $this->Ln(12);
        $this->SetFillColor(240, 240, 240);
        $this->Cell(10, 11, utf8_decode('Nº'), 1, 0, 'C', 1);
        $this->Cell(25, 11, 'USUARIO', 1, 0, 'C', 1);
        $this->Cell(65, 11, 'NOMBRES Y APELLIDOS', 1, 0, 'C', 1);
        $this->Cell(60, 11, 'E-MAIL', 1, 0, 'C', 1);
        $this->Cell(30, 11, utf8_decode('TELÉFONO'), 1, 0, 'C', 1);
        $this->Cell(30, 11, 'DOC. ID', 1, 0, 'C', 1);
        $this->Cell(50, 11, 'NIVEL DE USUARIO', 1, 1, 'C', 1);
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

$consulta = "SELECT * FROM v_admins ";
$resultado = $conn->query($consulta);

// Instanciation of inherited class
//'L', 'mm', 'A4'
$pdf = new PDF('L', 'mm', 'A4');
$pdf->SetMargins(15, 15, 15);
$pdf->SetAutoPageBreak(true, 15);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 11);

$nivel = '';
$numero = 1;
while ($row = $resultado->fetch_assoc()) {
    if ($row['nivel'] == 1) {
        $nivel = 'Administrador';
    } else {
        $nivel = utf8_decode('Usuario Estándar');
    }
    $pdf->Cell(10, 10, $numero, 1, 0, 'C', 0);
    $pdf->Cell(25, 10, $row['usuario'], 1, 0, 'C', 0);
    $pdf->Cell(65, 10, utf8_decode($row['nombre_completo']), 1, 0, 'J', 0);
    $pdf->Cell(60, 10, $row['email'], 1, 0, 'J', 0);
    $pdf->Cell(30, 10, $row['telefono'], 1, 0, 'C', 0);
    $pdf->Cell(30, 10, $row['doc_identidad'], 1, 0, 'C', 0);
    $pdf->Cell(50, 10, $nivel, 1, 1, 'C', 0);
    $numero++;
}
$pdf->Output();

$conn->close();
