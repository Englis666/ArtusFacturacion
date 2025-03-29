<?php
require_once '../App/Modelo/Producto.php';
require_once '../App/Config/Database.php';

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
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $precio = $_POST['precio'];
            $stock = $_POST['stock'];

            if ($this->productoModelo->agregarProducto($nombre, $descripcion, $precio, $stock)){
                header('Location: productos.php?success=1');
            } else {
                header('Location: productos.php?error=1');
            }
        }
    }

    public function desactivarProducto(){
        if (isset($GEt['idProducto'])){
            $idProducto = $_GET['idProducto'];
            $this->productoModelo->desactivarProducto($idProducto);
            header('Location: productos.php');
        }
    }
}

?>