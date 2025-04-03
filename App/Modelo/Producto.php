<?php
class Producto{
    private $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }
    public function obtenerTodosLosProductos(){ 
        $resultado = $this->conn->query("SELECT * FROM productos");
        return $resultado->fetch_all(PDO::FETCH_ASSOC); 
    }
    public function agregarProducto($nombre , $descripcion , $precio , $stock){
        $stmt = $this->conn->prepare("INSERT INTO productos (nombre,descripcion,precio,stock) VALUES ( ? , ? , ? , ?) ");
        return $stmt->execute([$nombre , $descripcion , $precio , $stock]);
    }

    public function actualizarStock($idProducto , $cantidad){
        $stmt = $this->conn->prepare("UPDATE productos SET stock = stock + ? WHERE = idProducto = ?");
        return $stmt->excute([$cantidad , $idProducto]);
    }

    public function desactivarProducto($idProducto){
        $stmt = $this->conn->prepare("UPDATE productos WHERE idProducto = ?");
        return $stmt->execute([$idProducto]); 
    }
}

?>