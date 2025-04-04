<?php
require_once __DIR__.'../App/Modelo/Producto.php';
require_once __DIR__.'../App/Config/Database.php';

class ProductoController{
    private $productoModelo;

    public function __construct(){
        global $conn;
        $this->productoModelo = new Producto($conn);
    } 

    public function obtenerProductos(){
        return $this->productoModelo->obtenerTodosLosProductos();
    }

    public function agregarProducto(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $codigoBarras = $_POST['codigoBarras'];
            $nombreProducto = $_POST['nombreProducto'];
            $precioCompra = $_POST['precioCompra'];
            $precioVenta = $_POST['precioVenta'];
            $idCategoria = $_POST['idCategoria'];
            $idProveedor = $_POST['idProveedor'];
            $cantidad = $_POST['cantidad'];


            if ($this->productoModelo->agregarProducto($codigoBarras, $nombreProducto, $precioCompra, $precioVenta, $idCategoria,$idProveedor,$cantidad)){
                header('Location: productos.php?success=1');
            } else {
                header('Location: productos.php?error=1');
            }
        }
    }

    public function desactivarProducto(){
        if (isset($_GET['codigoBarras'])){
            $codigoBarras = $_GET['codigoBarras'];
            $this->productoModelo->desactivarProducto($codigoBarras);
            header('Location: productos.php');
        }
    }

    public function calcularProductosActualesDelNegocio(){
        return $this->productoModelo->calcularProductosActualesDelNegocio();
    }

}

?>