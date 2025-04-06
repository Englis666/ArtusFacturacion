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

    public function calcularGastosPorProveedor(){
        return $this->productoModelo->calcularGastosPorProveedor();
    }
    public function calcularGastosPorCategoria(){
        return $this->productoModelo->calcularGastosPorCategoria();
    }

    public function calcularGastoTotalEnMes(){
        return $this->productoModelo->calcularGastoTotalEnMes();
    }
    public function calcularGastoTotalAnual(){
        return $this->productoModelo->calcularGastoTotalAnual();
    }

    public function calcularGananciaMensual(){
        return $this->productoModelo->calcularGananciaMensual();
    }
    public function calcularGananciaAnual(){
        return $this->productoModelo->calcularGananciaAnual();
    }
    public function calcularGananciaPorProducto(){
        return $this->productoModelo->calcularGananciaPorProducto();
    }
    public function calcularGananciaPorCategoria(){
        return $this->productoModelo->calcularGananciaPorCategoria();
    }

    public function obtenerGananciasDeHoyPorHora(){
        return $this->productoModelo->obtenerGananciasDeHoyPorHora();
    }
    
    public function obtenerStockProductos(){
        return $this->productoModelo->obtenerStockProductos();
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