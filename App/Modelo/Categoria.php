<?php

class Categoria {
 
    private $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }

    public function obtenerTodasLasCategoriasDeProductos() {
        $stmt = $this->conn->prepare("SELECT * FROM categorias");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function agregarCategoria($nombreCategoria){
        $stmt = $this->conn->prepare("INSERT INTO categorias (nombreCategoria) VALUES ( ? )");
        return $stmt->execute([$nombreCategoria]);
    }

    public function obtenerProductosPorCategoria(){
        $stmt = $this->conn->prepare("SELECT * FROM productos as p
                                      INNER JOIN categorias as c ON  p.categoria_idCategoria = c.idCategoria");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function filtrarProductosPorCategoria($idCategoria) {
        $stmt = $this->conn->prepare("SELECT * FROM productos 
                                  WHERE categoria_idCategoria = ?");
        $stmt->execute([$idCategoria]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}


?>