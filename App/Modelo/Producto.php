<?php
class Producto{
    private $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }
    public function obtenerTodosLosProductos(){ 
        $resultado = $this->conn->query("SELECT * FROM productos as p
                                        INNER JOIN categorias as c ON p.categoria_idCategoria = c.idCategoria");
        return $resultado->fetchAll(PDO::FETCH_ASSOC); 
    }
  public function obtenerStockProductos(){
    $resultado = $this->conn->query("
        SELECT 
            c.nombreCategoria AS categoria,
            SUM(p.cantidad) AS stock_categoria,
            (SELECT SUM(cantidad) FROM productos) AS stock_total
        FROM 
            productos p
        JOIN 
            categorias c ON p.categoria_idCategoria = c.idCategoria
        GROUP BY 
            c.idCategoria, c.nombreCategoria;
    ");

    $datosCrudos = $resultado->fetchAll(PDO::FETCH_ASSOC);
    $datosProcesados = [];

    foreach ($datosCrudos as $row) {
        $stockCategoria = $row['stock_categoria'];
        $stockTotal = $row['stock_total'];

        $porcentaje = $stockTotal > 0 ? round(($stockCategoria / $stockTotal) * 100) : 0;

        $datosProcesados[] = [
            'categoria' => $row['categoria'],
            'porcentaje' => $porcentaje
        ];
    }

    return $datosProcesados;
}


    public function agregarProducto($codigoBarras, $nombreProducto ,$precioCompra,$precioVenta,$idCategoria,$idProveedor,$cantidad){
        $fechaCreacion = (new DateTime('now', new DateTimeZone('America/Bogota')))->format('Y-m-d H:i:s');
        $stmt = $this->conn->prepare("INSERT INTO productos (codigoBarras, nombre, precioCompra, precioVenta,categoria_idCategoria,proveedor_idProveedor,cantidad,fechaCreacion) VALUES ( ? , ? , ? ,? ,? , ? , ? , ?) ");
        return $stmt->execute([$codigoBarras, $nombreProducto ,$precioCompra,$precioVenta,$idCategoria,$idProveedor,$cantidad,$fechaCreacion]);
    }

    

    public function calcularGastosPorProveedor() {
    $stmt = $this->conn->query("
            SELECT 
                p.codigoBarras,
                p.nombre,
                p.fechaCreacion,
                p.cantidad,
                pro.nombreProveedor,
                SUM(p.cantidad) AS cantidadProductos,
                SUM(p.precioCompra * p.cantidad) AS inversionTotal
            FROM productos AS p
            INNER JOIN proveedores AS pro ON p.proveedor_idProveedor = pro.idProveedor
            GROUP BY pro.idProveedor, pro.nombreProveedor
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function calcularGananciaPorProducto() {
        $stmt = $this->conn->query("
            SELECT 
                v.fecha AS fecha,
                p.codigoBarras,
                p.nombre,
                p.precioCompra,
                dv.precioUnitario,
                SUM(dv.cantidad) AS totalVendido,
                (dv.precioUnitario - p.precioCompra) AS gananciaPorUnidad,
                SUM((dv.precioUnitario - p.precioCompra) * dv.cantidad) AS gananciaTotal
            FROM detalleVenta dv
            INNER JOIN ventas as v ON dv.venta_idVenta = v.idVenta
            INNER JOIN productos p ON dv.codigoBarras = p.codigoBarras
            GROUP BY p.codigoBarras, dv.precioUnitario
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function calcularGananciaPorCategoria() {
        $stmt = $this->conn->query("
            SELECT 
                c.nombreCategoria,
                SUM((dv.precioUnitario - p.precioCompra) * dv.cantidad) AS gananciaTotal
            FROM detalleVenta dv
            INNER JOIN productos p ON dv.codigoBarras = p.codigoBarras
            INNER JOIN categorias c ON p.categoria_idCategoria = c.idCategoria
            GROUP BY c.idCategoria
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    public function calcularGastosPorCategoria(){
            $query = "
                SELECT 
                    c.nombreCategoria AS nombreCategoria,
                    p.nombreProveedor,
                    SUM(pr.precioCompra * pr.cantidad) AS gastoTotal,
                    MAX(pr.fechaCreacion) AS ultimaFecha
                FROM 
                    productos pr
                INNER JOIN 
                    categorias c ON pr.categoria_idCategoria = c.idCategoria
                INNER JOIN 
                    proveedores p ON pr.proveedor_idProveedor = p.idProveedor
                GROUP BY 
                    pr.categoria_idCategoria, pr.proveedor_idProveedor
                ORDER BY 
                    gastoTotal DESC
            ";

            $stmt = $this->conn->query($query); 
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

        public function obtenerGananciasDeHoyPorHora() {
            date_default_timezone_set('America/Bogota');
            $hoy = date('Y-m-d');

            $sql = "SELECT HOUR(v.fecha) AS hora, 
                        SUM((dv.precioUnitario - p.precioCompra) * dv.cantidad) AS ganancia
                    FROM ventas v
                    JOIN detalleVenta dv ON v.idVenta = dv.venta_idVenta
                    JOIN productos p ON dv.codigoBarras = p.codigoBarras
                    WHERE DATE(v.fecha) = :hoy
                    GROUP BY hora
                    ORDER BY hora";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':hoy', $hoy);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

    public function calcularGastoTotalEnMes(){
        $query = "
            SELECT 
                DATE_FORMAT(fechaCreacion, '%Y-%m') AS mes,
                SUM(precioCompra * cantidad) AS gastoTotal
            FROM productos
            WHERE fechaCreacion >= DATE_FORMAT(NOW(), '%Y-%m-01') 
            GROUP BY mes
        ";

        $stmt = $this->conn->query($query);
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }

    public function calcularGastoTotalAnual(){
        $query = "
                SELECT 
                    YEAR(fechaCreacion) AS anio,
                    SUM(precioCompra * cantidad) AS gastoTotal
                FROM productos
                WHERE YEAR(fechaCreacion) = YEAR(NOW())
                GROUP BY anio
            ";

        $stmt = $this->conn->query($query);
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }

   public function calcularGananciaMensual() {
    $mesActual = date('m');
    $anioActual = date('Y');

    $sql = "SELECT 
                SUM((p.precioVenta - p.precioCompra) * dv.cantidad) AS ganancia
            FROM detalleVenta dv
            INNER JOIN ventas v ON dv.venta_idVenta = v.idVenta
            INNER JOIN productos p ON dv.codigoBarras = p.codigoBarras
            WHERE MONTH(v.fecha) = :mes AND YEAR(v.fecha) = :anio";

    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':mes', $mesActual, PDO::PARAM_INT);
    $stmt->bindParam(':anio', $anioActual, PDO::PARAM_INT);
    $stmt->execute();

    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    return $resultado['ganancia'] ?? 0;
}

    public function calcularGananciaAnual() {
    $anioActual = date('Y');

    $sql = "SELECT 
                SUM((p.precioVenta - p.precioCompra) * dv.cantidad) AS ganancia
            FROM detalleVenta dv
            INNER JOIN ventas v ON dv.venta_idVenta = v.idVenta
            INNER JOIN productos p ON dv.codigoBarras = p.codigoBarras
            WHERE YEAR(v.fecha) = :anio";

    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':anio', $anioActual, PDO::PARAM_INT);
    $stmt->execute();

    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    return $resultado['ganancia'] ?? 0;
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