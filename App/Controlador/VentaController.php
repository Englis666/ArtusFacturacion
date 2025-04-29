<?php
require_once __DIR__. '/../Modelo/Venta.php';
require_once __DIR__.'/../Config/Database.php';

class VentaController {
    private $ventaModelo;

    public function __construct() {
        global $conn;
        $this->ventaModelo = new Venta($conn);
    }

    public function agregarVenta() {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $numeroDocumento = $_POST['numeroDocumento'] ?? null;
            $productosJson = $_POST['productos'] ?? [];

            $productos = array_map(function($json) {
                return json_decode($json, true);
            }, $productosJson);

            $resultado = json_decode($this->ventaModelo->agregarVenta($numeroDocumento, $productos), true);

            if ($resultado['success']) {
                header('Location: formularioVenta');
            } else {
                echo "<pre>Error al registrar venta: " . $resultado['error'] . "</pre>";
            }
            exit;
        }
        http_response_code(405);
        echo "Método no permitido";
    }
    public function historialVenta(){
        return $this->ventaModelo->historialVenta();
    }

    public function resumenGanancia(){
        return $this->ventaModelo->resumenGanancia();
    }

}
?>
