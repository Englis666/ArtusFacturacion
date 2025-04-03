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

}


?>