<?php
require_once '../App/Modelo/Venta.php';
require_once '../App/Config/Database.php';

class VentaController {
    private $ventaModelo;

    public function __construct(){
        global $conn;
        $this->ventaModelo = new Venta($conn);
    }

    public function agregarVenta(){
        
    }

}