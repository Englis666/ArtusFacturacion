<?php

class Venta {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function agregarVenta($numeroDocumento, $productos) {
    $this->conn->beginTransaction();
    try {
        // 1. Verificar si el cliente existe
        $stmtCliente = $this->conn->prepare("SELECT numeroDocumento FROM clientes WHERE numeroDocumento = ?");
        $stmtCliente->execute([$numeroDocumento]);
        $cliente = $stmtCliente->fetch(PDO::FETCH_ASSOC);

        if (!$cliente) {
            // 2. Si no existe, insertarlo
            $stmtInsertCliente = $this->conn->prepare("INSERT INTO clientes (numeroDocumento) VALUES (?)");
            $stmtInsertCliente->execute([$numeroDocumento]);
        }

        // 3. Insertar en tabla ventas con total temporal = 0
        $stmtVenta = $this->conn->prepare("INSERT INTO ventas (numeroDocumento, total) VALUES (?, ?)");
        $stmtVenta->execute([$numeroDocumento, 0]);
        $idVenta = $this->conn->lastInsertId(); // ✅ ¡Este es el paso que te faltaba!

        $totalVenta = 0;

        foreach ($productos as $producto) {
            $codigoBarras = $producto['codigoBarras'];
            $cantidad = $producto['cantidad'];
            $precioUnitario = $producto['precioUnitario'];
            $subtotal = $cantidad * $precioUnitario;
            $totalVenta += $subtotal;

            // Insertar detalle de venta
            $stmtDetalle = $this->conn->prepare("INSERT INTO detalleVenta (venta_idVenta, codigoBarras, cantidad, precioUnitario, subtotal)
                                                 VALUES (?, ?, ?, ?, ?)");
            $stmtDetalle->execute([$idVenta, $codigoBarras, $cantidad, $precioUnitario, $subtotal]);

            // Actualizar stock de producto
            $restarProducto = $this->conn->prepare("UPDATE productos SET cantidad = cantidad - ? WHERE codigoBarras = ?");
            $restarProducto->execute([$cantidad, $codigoBarras]);
        }

        // 4. Actualizar total en la tabla ventas
        $stmtUpdate = $this->conn->prepare("UPDATE ventas SET total = ? WHERE idVenta = ?");
        $stmtUpdate->execute([$totalVenta, $idVenta]);

        $this->conn->commit();
        return json_encode(['success' => true, 'message' => 'Venta registrada correctamente']);

    } catch (Exception $e) {
        $this->conn->rollBack();
        return json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
}


    
    public function historialVenta(){

        $sql = $this->conn->query("SELECT * FROM ventas as v 
                INNER JOIN detalleVenta as d ON v.idVenta = d.venta_idVenta
                INNER JOIN productos as p ON d.codigoBarras = p.codigoBarras");
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>
