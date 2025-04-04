<?php
require_once '../App/Config/Database.php';
require_once '../App/Modelo/Producto.php';

class ReporteController {
    private $producto;

    public function __construct(){
        global $conn;
        $this->producto = new Producto($conn);
    }

    public function generarReporteInventario(){
        $productos = $this->producto->obtenerTodosLosProductos();
        $fecha = date('d/m/Y');

        $pdf = new FPDF();
        $pdf->AddPage();

        // ENCABEZADO
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(190, 10, utf8_decode('EMPRESA XYZ S.A.S'), 0, 1, 'C');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(190, 6, 'NIT : AQUI VA EL NIT DE LA EMPRESA', 0, 1, 'C');
        $pdf->Cell(190, 6, utf8_decode('DIRECCIÓN:'), 0, 1, 'C');
        $pdf->Cell(190, 6, utf8_decode('Teléfono: +57 - Email: contacto@empresa.com'), 0, 1, 'C');
        $pdf->Cell(190, 6, utf8_decode('Fecha de emisión: ') . $fecha, 0, 1, 'C');
        $pdf->Ln(5);

        // TÍTULO
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(190, 10, 'Reporte de Inventario', 1, 1, 'C');
        $pdf->Ln(5);

        // ENCABEZADO DE LA TABLA
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(50, 10, 'Nombre', 1, 0, 'C');
        $pdf->Cell(60, 10, 'Descripción', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Precio (COP)', 1, 0, 'C');
        $pdf->Cell(20, 10, 'Stock', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Categoría', 1, 1, 'C'); // '1' al final indica nueva línea

        $pdf->SetFont('Arial', '', 10);

        // CUERPO DE LA TABLA
        foreach ($productos as $producto) {
            $pdf->Cell(50, 10, utf8_decode($producto['nombre']), 1, 0, 'C');
            $pdf->Cell(60, 10, utf8_decode($producto['descripcion']), 1, 0, 'C');
            $pdf->Cell(30, 10, number_format($producto['precio'], 2, ',', '.'), 1, 0, 'C');
            $pdf->Cell(20, 10, $producto['stock'], 1, 0, 'C');
            $pdf->Cell(30, 10, utf8_decode($producto['categoria']), 1, 1, 'C'); // '1' al final indica nueva línea
        }

        $pdf->Ln(10);

        // PIE DE PÁGINA
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(190, 10, 'Firma del Responsable', 0, 1, 'L');
        $pdf->Cell(50, 10, '________________________', 0, 1, 'L');

        // Salida del PDF
        $pdf->Output('D', 'reporte_inventario.pdf');
    }
}
