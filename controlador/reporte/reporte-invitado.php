<?php
    require('../fpdf/fpdf.php');

    class PDF extends FPDF {
        // Page header
        function Header() {
            // Logo
            //$this->Image('..img/logo.svg',10,6,30);
            // Arial bold 12
            $this->SetFont('Arial','B',12);
            // Move to the right
            $this->Cell(92);
            // Title
            $this->Cell(80,12,'REPORTE DE INVITADOS', 0, 0, 'C');
            // Line break
            $this->Ln(12);
            $this->SetFillColor(240,240,240);
            $this->Cell(10, 12, utf8_decode('Nº'), 1, 0, 'C', 1);
            $this->Cell(75, 12, 'NOMBRES Y APELLIDOS', 1, 0, 'C', 1);
            $this->Cell(90, 12, 'DESCRIPCION', 1, 0, 'C', 1);
            $this->Cell(92, 12, 'CONFERENCIA', 1, 1, 'C', 1);
        }

        // Page footer
        function Footer() {
            // Position at 1.5 cm from bottom
            $this->SetY(-15);
            // Arial italic 9
            $this->SetFont('Arial','I',9);
            // Page number
            $this->Cell(0,10,utf8_decode('Página').$this->PageNo().'/{nb}',0,0,'C');
        }
    }

    require_once('../bd_conexion.php');

    $consulta = "SELECT nombre_evento, nombre_invitado, apellidopa_invitado, apellidoma_invitado, descripcion FROM evento "; 
    $consulta .= " INNER JOIN invitado ON evento.id_inv = invitado.id_invitado ";
    $resultado = $conn->query($consulta);

    // Instanciation of inherited class
    //'L', 'mm', 'A4'
    $pdf = new PDF('L', 'mm', 'A4');
    $pdf->SetMargins(15, 15 , 15);
    $pdf->SetAutoPageBreak(true,15); 
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','',11);

    $numero=1;
    While($row = $resultado->fetch_assoc()) {
        $pdf->Cell(10, 10, $numero, 1, 0, 'C', 0);
        $pdf->Cell(75, 10, utf8_decode($row['nombre_invitado']. " " .$row['apellidopa_invitado']. " " .$row['apellidoma_invitado']), 1, 0, 'J', 0);
        $pdf->Cell(90, 10, $row['descripcion'], 1, 0, 'J', 0);
        $pdf->Cell(92, 10, utf8_decode($row['nombre_evento']), 1, 1, 'J', 0);
        $numero++;
    }
    $pdf->Output();
?>