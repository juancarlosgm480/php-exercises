<?php

require_once("fpdf/fpdf.php");

// Array de alumnos
$alumnos = [
    ["Juan", "García López", 8],
    ["María", "Pérez Sánchez", 9],
    ["Carlos", "Martínez Ruiz", 7]
];

// Crear PDF
$pdf = new FPDF();
$pdf->AddPage();

// Título
$pdf->SetFont("Arial", "B", 16);
$pdf->Cell(0, 15, "Listado de alumnos", 0, 1, "C");

// Cabecera de la tabla
$pdf->SetFont("Arial", "B", 12);
$pdf->Cell(60, 10, "Nombre", 1);
$pdf->Cell(90, 10, "Apellidos", 1);
$pdf->Cell(30, 10, "Nota", 1, 1);

// Datos
$pdf->SetFont("Arial", "", 12);

foreach ($alumnos as $alumno) {
    $pdf->Cell(60, 10, $alumno[0], 1);
    $pdf->Cell(90, 10, $alumno[1], 1);
    $pdf->Cell(30, 10, $alumno[2], 1, 1);
}

// Descargar PDF
header("Content-Type: application/pdf");
header('Content-Disposition: attachment; filename="lista_alumnos.pdf"');

$pdf->Output("D", "lista_alumnos.pdf");

?>