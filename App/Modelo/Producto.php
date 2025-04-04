<?php
class Producto{
    private $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }
    public function obtenerTodosLosProductos(){ 
        $resultado = $this->conn->query("SELECT * FROM productos");
        return $resultado->fetchAll(PDO::FETCH_ASSOC); 
    }
    public function agregarProducto($codigoBarras, $nombreProducto ,$precioCompra,$precioVenta,$idCategoria,$idProveedor,$cantidad){
        $fechaCreacion = (new DateTime('now', new DateTimeZone('America/Bogota')))->format('Y-m-d H:i:s');
        $stmt = $this->conn->prepare("INSERT INTO productos (codigoBarras, nombre, precioCompra, precioVenta,categoria_idCategoria,proveedor_idProveedor,cantidad,fechaCreacion) VALUES ( ? , ? , ? ,? ,? , ? , ? , ?) ");
        return $stmt->execute([$codigoBarras, $nombreProducto ,$precioCompra,$precioVenta,$idCategoria,$idProveedor,$cantidad,$fechaCreacion]);
    }

    public function actualizarStock($codigoBarras , $cantidad){
        $stmt = $this->conn->prepare("UPDATE productos SET stock = stock + ? WHERE = codigoBarras = ?");
        return $stmt->excute([$cantidad , $codigoBarras]);
    }

    public function desactivarProducto($codigoBarras){
        $stmt = $this->conn->prepare("UPDATE productos WHERE codigoBarras = ?");
        return $stmt->execute([$codigoBarras]); 
    }

    public function calcularProductosActualesDelNegocio(){
        $stmt = $this->conn->query("SELECT SUM(cantidad) AS Stock FROM productos");
        return $stmt->fetchColumn();
    }

}

?>