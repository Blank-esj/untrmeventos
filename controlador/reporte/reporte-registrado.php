<?php
    require('fpdf/fpdf.php');

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
            $this->Cell(80,12,'REPORTE DE REGISTRADOS', 0, 0, 'C');
            // Line break
            $this->Ln(12);
            $this->SetFillColor(240,240,240);
            $this->Cell(10, 12, utf8_decode('Nº'), 1, 0, 'C', 1);
            $this->Cell(80, 12, utf8_decode('NOMBRES Y APELLIDOS'), 1, 0, 'C', 1);
            $this->Cell(75, 12, 'E-MAIL', 1, 0, 'C', 1);
            $this->Cell(60, 12, utf8_decode('FECHA DE INSCRIPCIÓN'), 1, 0, 'C', 1);
            $this->Cell(40, 12, 'REGALO', 1, 1, 'C', 1);
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

    require_once('../includes/funciones/bd_conexion.php');

    $consulta = "SELECT registrado.*, regalo.nombre_regalo FROM registrado ";
    $consulta .= " JOIN regalo ";
    $consulta .= " ON registrado.regalo = regalo.id_regalo ";
    $resultado = $conn->query($consulta);

    // Instanciation of inherited class
    //'L o P , 'mm', 'A4'
    $pdf = new PDF('L', 'mm', 'A4');
    $pdf->SetMargins(15, 15 , 20);
    $pdf->SetAutoPageBreak(true,15); 
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial','',11);

    $numero=1;
    While($row = $resultado->fetch_assoc()) {
        
        $pdf->Cell(10, 10, $numero, 1, 0, 'C', 0);
        $pdf->Cell(80, 10, $row['nombre_registrado']. " " .$row['apellidopa_registrado']. " " .$row['apellidoma_registrado'], 1, 0, 'J', 0);
        $pdf->Cell(75, 10, $row['email_registrado'], 1, 0, 'C', 0);
        $pdf->Cell(60, 10, $row['fecha_registro'], 1, 0, 'C', 0);
        $pdf->Cell(40, 10, $row['nombre_regalo'], 1, 1, 'C', 0);
        $numero++;
    }
    $pdf->Output();
?>