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

        public function calcularGastosPorCategoria() {
            $stmt = $this->conn->prepare("
                SELECT 
                    ca.nombreCategoria,
                    pro.nombreProveedor,
                    SUM(p.precioCompra * p.cantidad) AS totalPorCategoriaAgrupadoPorProveedor
                FROM productos AS p
                INNER JOIN proveedores AS pro ON p.proveedor_idProveedor = pro.idProveedor
                INNER JOIN categorias AS ca ON p.categoria_idCategoria = ca.idCategoria
                GROUP BY ca.idCategoria, pro.idProveedor
            ");
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