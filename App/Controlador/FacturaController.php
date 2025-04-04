<?php
require __DIR__ .'../modelo/Factura.php';
require __DIR__ .'../modelo/Venta.php';
require __DIR__ .'../Config/Database.php';
require __DIR__ .'../lib/vendor/autoload.php';

use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class FacturaController {
    private $conn;
    private $facturaModelo;

    public function __construct($conn) {
        $this->conn = $conn;
        $this->facturaModelo = new Factura($conn); 
    }

    public function imprimirFactura($idVenta) {
        $venta = $this->facturaModelo->obtenerVenta($idVenta);
        if (!$venta) {
            die("Venta no encontrada.");
        }

        // Productos vendidos
        $productos = $this->facturaModelo->obtenerProductosVendidos($idVenta);

        // Conectar con la impresora térmica
        $nombreImpresora = "TICKETERA";
        try {
            $connector = new WindowsPrintConnector($nombreImpresora);
            $printer = new Printer($connector);

            // ENCABEZADO
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->setTextSize(2, 2);
            $printer->text("EMPRESA XYZ S.A.S\n");
            $printer->setTextSize(1, 1);
            $printer->text("NIT: 900.1233.456\n");
            $printer->text("Ciudad, País\n");
            $printer->text("Tel: +57 \n");
            $printer->text("--------------------------------\n");

            // DETALLES DEL CLIENTE
            $printer->setJustification(Printer::JUSTIFY_LEFT);
            $printer->text("Cliente: " . $venta['cliente'] . "\n");
            $printer->text("Documento: " . $venta['documento'] . "\n");
            $printer->text("Factura # " . $venta['idVenta'] . "\n");
            $printer->text("Fecha: " . $venta['fecha'] . "\n");
            $printer->text("--------------------------------\n");

            // LISTA DE PRODUCTOS
            foreach ($productos as $producto) {
                $printer->text($producto['nombre'] . "\n");
                $printer->text(" x" . $producto['cantidad'] . "   $" . number_format($producto['precioUnitario'], 2, ',', '.') . "\n");
            }

            $printer->text("--------------------------------\n");
            $printer->setJustification(Printer::JUSTIFY_RIGHT);
            $printer->text("TOTAL: $" . number_format($venta['total'], 2, ',', '.') . "\n");
            $printer->text("--------------------------------\n");

            // MENSAJE FINAL
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->text("¡Gracias por su compra!\n");
            $printer->text("www.empresa.com\n");
            $printer->feed(3);
            $printer->cut();
            $printer->close();
        } catch (Exception $e) {
            die("Error al imprimir: " . $e->getMessage());
        }
    }
}
?>
