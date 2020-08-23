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
        $this->SetFont('Arial', 'B', 10);
        // Move to the right
        $this->Cell(92);
        // Title
        $this->Cell(80, 12, 'HORARIO', 0, 0, 'C');
        // Line break
        $this->Ln(12);
        $this->SetFillColor(240, 240, 240);
        $this->Cell(10, 11, utf8_decode('Nº'), 1, 0, 'C', 1);
        $this->Cell(25, 11, utf8_decode('DÍA'), 1, 0, 'C', 1);
        $this->Cell(20, 11, utf8_decode('HORA'), 1, 0, 'C', 1);
        $this->Cell(20, 11, utf8_decode('CLAVE'), 1, 0, 'C', 1);
        $this->Cell(80, 11, utf8_decode('EVENTO'), 1, 0, 'C', 1);
        $this->Cell(80, 11, utf8_decode('INVITADO'), 1, 0, 'C', 1);
        $this->Cell(40, 11, utf8_decode('GRADO'), 1, 1, 'C', 1);
    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 9
        $this->SetFont('Arial', 'I', 11);
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

$consulta = "SELECT
                e.clave,
                e.nombre_evento,
                CONCAT(p.nombres, ' ', p.apellidopa, ' ', p.apellidoma) invitado,
                gi.grado,
                e.fecha_evento,
                e.hora_evento
            FROM evento e, persona p, invitado i, grado_instruccion gi
            WHERE p.idpersona = e.id_inv
            AND p.idpersona = i.idpersona
            AND i.idgrado_instruccion = gi.idgrado_instruccion
            ORDER BY e.fecha_evento, e.hora_evento ASC;";

$resultado = $conn->query($consulta);

// Instanciation of inherited class
//'L o P , 'mm', 'A4'
$pdf = new PDF('L', 'mm', 'A4');
$pdf->SetMargins(10, 10, 20);
$pdf->SetAutoPageBreak(true, 15);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 9);

$numero = 1;
while ($row = $resultado->fetch_assoc()) {

    $pdf->Cell(10, 10, $numero, 1, 0, 'C', 0);
    $pdf->Cell(25, 10, utf8_decode($row['fecha_evento']), 1, 0, 'C', 0);
    $pdf->Cell(20, 10, utf8_decode($row['hora_evento']), 1, 0, 'C', 0);
    $pdf->Cell(20, 10, utf8_decode($row['clave']), 1, 0, 'C', 0);
    $pdf->Cell(80, 10, utf8_decode($row['nombre_evento']), 1, 0, 'C', 0);
    $pdf->Cell(80, 10, utf8_decode($row['invitado']), 1, 0, 'C', 0);
    $pdf->Cell(40, 10, utf8_decode($row['grado']), 1, 1, 'C', 0);
    $numero++;
}
$pdf->Output();

$conn->close();
