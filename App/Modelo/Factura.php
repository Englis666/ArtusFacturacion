<?php

class Factura {
    private $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }

    public function obtenerVenta($idVenta){
        $stmt = $this->conn->prepare("SELECT v.idVenta, v.fecha, v.total, c.nombre AS cliente, c.documento
                                      FROM ventas v
                                      LEFT JOIN clientes c ON v.cliente_idCliente = c.idCliente
                                      WHERE v.idVenta = ?");
        $stmt->bind_param("i", $idVenta);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function obtenerProductosVendidos($idVenta){
        $stmt = $this->conn->prepare("SELECT p.nombre, dv.cantidad, dv.precioUnitario
                                      FROM detalleVenta dv
                                      JOIN productos p ON dv.producto_codigoBarras = p.codigoBarras
                                      WHERE dv.venta_idVenta = ?");
        $stmt->bind_param("i", $idVenta);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

   
    public function obtenerVentasDiarias() {
        $stmt = $this->conn->prepare("SELECT v.idVenta, p.nombre AS producto, dv.cantidad, dv.precioUnitario, v.total, v.fecha 
                                      FROM ventas v
                                      JOIN detalleVenta dv ON v.idVenta = dv.venta_idVenta
                                      JOIN productos p ON dv.producto_codigoBarras = p.codigoBarras
                                      WHERE DATE(v.fecha) = CURDATE()");
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function cerrarMes() {
        $stmt = $this->conn->prepare("SELECT SUM(total) AS totalDelMes FROM ventas 
                                      WHERE MONTH(fecha) = MONTH(CURDATE()) 
                                      AND YEAR(fecha) = YEAR(CURDATE())");
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
?>
