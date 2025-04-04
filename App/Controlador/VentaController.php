<?php
require_once '../App/Modelo/Venta.php';
require_once '../App/Config/Database.php';

class VentaController {
    private $ventaModelo;

    public function __construct() {
        global $conn;
        $this->ventaModelo = new Venta($conn);
    }

    public function agregarVenta() {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $numeroDocumento = $_POST['numeroDocumento'] ?? null;
            $idUsuario = $_POST['idUsuario'] ?? null;
            $productos = $_POST['productos'] ?? [];

            if (empty($numeroDocumento) || empty($idUsuario) || empty($productos)) {
                header('Location: formularioVenta.php?error=campos_vacios');
                exit;
            }

            if ($this->ventaModelo->agregarVenta($numeroDocumento, $idUsuario, $productos)) {
                header('Location: formularioVenta.php?success=1');
            } else {
                header('Location: formularioVenta.php?error=1');
            }
            exit;
        }

        http_response_code(405);
        echo "Método no permitido";
    }
}
