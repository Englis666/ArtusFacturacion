<?php
require_once __DIR__. '/../Modelo/Categoria.php';
require_once __DIR__.'/../Config/Database.php';

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
    public function filtrarProductosPorCategoria() {
    header('Content-Type: application/json');

    $idCategoria = $_GET['idCategoria'] ?? null;

    if ($idCategoria === null) {
        echo json_encode(['error' => 'idCategoria no proporcionado']);
        http_response_code(400);
        return;
    }

    $productos = $this->categoriaModelo->filtrarProductosPorCategoria($idCategoria);
    echo json_encode($productos);
}


    public function agregarCategoria(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $nombreCategoria = $_POST['nombreCategoria'];

            if ($this->categoriaModelo->agregarCategoria($nombreCategoria)){
                header('Location: ProductosStock');
            } else {
                header('Location: ProductosStock');
            }
        }
    }

    public function desactivarCategoria(){
        if (isset($_GET['idCategoria'])){
            $idCategoria = $_GET['idCategoria'];
            $this->categoriaModelo->desactivarCategoria($idCategoria);
            header('Location: ProductosStock');
        }
    }


}