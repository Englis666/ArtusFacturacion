<?php

class Venta {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function agregarVenta($numeroDocumento, $idUsuario, $productos) {
        if (empty($numeroDocumento) || empty($idUsuario) || empty($productos)) {
            return json_encode(['success' => false, 'message' => 'Datos incompletos']);
        }

        $this->conn->beginTransaction();
        try {
            $stmtVenta = $this->conn->prepare("INSERT INTO ventas (cliente_idCliente, usuario_idUsuario, total) 
                                               VALUES (?, ?, ?)");
            $stmtVenta->execute([$numeroDocumento, $idUsuario, 0]);
            $idVenta = $this->conn->lastInsertId();

            $totalVenta = 0;

            foreach ($productos as $producto) {
                $codigoBarras = $producto['codigoBarras'];
                $cantidad = $producto['cantidad'];
                $precioUnitario = $producto['precioUnitario'];
                $subtotal = $cantidad * $precioUnitario;
                $totalVenta += $subtotal;

                $stmtDetalle = $this->conn->prepare("INSERT INTO detalleVenta (venta_idVenta, codigoBarras, cantidad, subtotal)
                                                     VALUES (?, ?, ?, ?)");
                $stmtDetalle->execute([$idVenta, $codigoBarras, $cantidad, $subtotal]);
            }

            $stmtUpdate = $this->conn->prepare("UPDATE ventas SET total = ? WHERE idVenta = ?");
            $stmtUpdate->execute([$totalVenta, $idVenta]);

            $this->conn->commit();
            return json_encode(['success' => true, 'message' => 'Venta registrada correctamente']);
        } catch (Exception $e) {
            $this->conn->rollBack();
            return json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}

?>
