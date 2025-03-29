<?php
require '../Config/Database.php';
require '../lib/FPDF/fpdf.php';
require '../Modelo/Producto.php';

class ReporteController {
    private $producto;

    public function __construct($conn){
        $this->producto = new Producto($conn);
    }

    //Investigar correctamente 
    public function generarReporteInventario(){
        $productos = $this->producto->obtenerProductos();
        $fecha = date('d/m/Y');

        $pdf = new FPDF();
        $pdf->Addpage();

        //ENCABEZADO
        $pdf->setFont('Arial', 'B' , 14);
        $pdf->Cell(190,10, utf8_decode('EMPRESA XYZ S.A.S'), 0 , 1 , 'C');
        $pdf->setFont('Arial', '' , 10);
        $pdf->Cell(190, 6, 'NIT : AQUI VA EL NIT DE LA EMPRESA', 0 , 1 , 'C');
        $pdf->Cell(190, 6 , utf8_decode('DIRECCIÓN:'), 0 , 1 , 'C');
        $pdf->Cell(190, 6 , utf8_decode('Teléfono: +57 - Email: contacto@empresa.com'), 0 , 1 , 'C');
        $pdf->Cell(190,6, utf8_decode('Fecha de emision: ') . $fecha , 0, 1, 'C');
        $pdf-Ln(5);

        //TITULO
        $pdf->SetFont('Arial', 'B' , 12);
        $pdf->Cell(190, 10, 'Reporte de inventario', 1, 1 , 'C');
        $pdf->Ln(5);

        // Tabla de productos
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(50 , 10, 'Nombre', 1,0, 'C');
        $pdf->Cell(50 , 10, 'Descripcion', 1, 0, 'C');
        $pdf->Cell(50, 10, 'Precio (COP)' , 1, 0, 'C');
        $pdf->Cell(30, 10, 'Stock', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Categoria', 1, 0 , 'C');

        $pdf->setFont('Arial', '' , 10);

        foreach($productos as $producto){
            $pdf->Cell(50,10, utf8_decode($producto['nombre']), 1, 0, 'C');
            $pdf->Cell(50,10, utf8_decode($producto['descripcion']), 1, 0, 'C');
            $pdf->Cell(50,10, number_format($producto['precio'], 2 , ',', '.'), 1,0,'C');
            $pdf->Cell(50,10, $producto['stock'], 1, 0, 'C');
            $pdf->Cell(50,10, utf8_decode($producto['categoria']), 1, 0, 'C');
        }
        $pdf->Ln(10);

        //PIE DE PAGINA
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(190,10, 'Firma del Responsable', 0, 1, 'L');
        $pdf->Cell(50, 10, '________________________', 0, 1, 'L');

        $pdf->Output('D', 'reporte_inventario.pdf');
    }

}