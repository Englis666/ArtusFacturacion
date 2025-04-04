<?php
class Proveedores{
    private $conn;
    public function __construct($conn){
        $this->conn = $conn;
    }
    public function obtenerProveedores(){
        $resultado = $this->conn->query("SELECT * FROM proveedores");
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function agregarProveedor($nombreProveedor , $telefono , $email, $direccion){
        $stmt = $this->conn->prepare("INSERT INTO proveedores (nombreProveedor , telefono , email , direccion) VALUES (  ? , ? , ? , ?)");
        return $stmt->execute([$nombreProveedor, $telefono, $email, $direccion]);
    }

    public function obtenerComprasDeProductoPorProveedor(){
        $resultado = $this->conn->query("SELECT * FROM productos as p
                                         INNER JOIN categorias as c ON p.categoria_idCategoria = c.idCategoria 
                                         INNER JOIN proveedores as pro ON p.proveedor_idProveedor = pro.idProveedor;");
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

}

?>