<?php
require_once '../App/Modelo/ProductoVenta.php';
require_once '../App/Config/Database.php';

class ProductoVentaController{
    private $productoVentaModelo;

    public function __construct(){
        global $conn;
        $this->productoVentaModelo = new ProductoVenta($conn);
    }

    public function obtenerProductosVendidos(){
        if($_SERVER['REQUEST_METHOD'] === "POST"){
            $idVenta = $_GET['idVenta'];
            return $this->productoVentaModelo->obtenerProductosVendidos($idVenta);
        }
    }


    
}
