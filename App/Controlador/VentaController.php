<?php
require_once "../App/Modelo/Venta.php";
require_once "../App/Config/Database.php";
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class ventaController{
    private $ventaModelo;


    public function __construct(){
        global $conn;
        $this->ventaModelo = new Venta($conn);
    }
    
    public function index(){
        $venta = $this->ventaModelo->obtenerTodasLasVentas();
        require_once '../App/Vista/ventas.php';
    }
    public function registrarVenta(){
        //Se registra la venta y luego se envia la factura

        $connector = new WindowsPrintConnector("nombre_deTicketera");
        $printer = new Printer($connector);
        $printer->text("Factura\n");
        $printer->cut();
        $printer->close();

    }

}

?>

