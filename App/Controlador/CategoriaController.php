<?php
require_once '../App/Modelo/Categoria.php';
require_once '../App/Config/Database.php';

class CategoriaController{
    private $categoriaModelo;

    public function __construct(){
        global $conn;
        $this->categoriaModelo = new Categoria($conn);
    }

    public function obtenerTodasLasCategoriasDeProductos(){
        return $this->categoriaModelo->obtenerTodasLasCategoriasDeProductos();
    }

    public function obtenerProductosPorCategoria(){
        return $this->categoriaModelo->obtenerProductosPorCategoria();
    }

    public function agregarCategoria(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $nombreCategoria = $_POST['nombreCategoria'];

            if ($this->categoriaModelo->agregarCategoria($nombreCategoria)){
                header('Location: ProductosStock.php?success=1');
            } else {
                header('Location: ProductosStock.php?error=1');
            }
        }
    }

    public function desactivarCategoria(){
        if (isset($_GET['idCategoria'])){
            $idCategoria = $_GET['idCategoria'];
            $this->categoriaModelo->desactivarCategoria($idCategoria);
            header('Location: ProductosStock.php');
        }
    }


}