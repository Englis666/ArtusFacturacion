<?php

require_once '../App/vendor/autoload.php';
require_once '../App/Controlador/ProductoController.php';
require_once '../App/Controlador/ProveedoresController.php';
require_once '../App/Controlador/CategoriaController.php';
require_once '../App/Controlador/VentaController.php';

use Dompdf\Dompdf;
use Dompdf\Options;

class ReporteController {

    private function configurarDompdf($html, $nombreArchivo) {
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        if (ob_get_contents()) ob_end_clean();
        $dompdf->stream($nombreArchivo, ["Attachment" => true]); // true para descarga
        exit;
    }

public function generarReporteProveedores() {
    $proveedoresController = new ProveedoresController();
    $proveedores = $proveedoresController->obtenerProveedores();
    $comprasConProveedores = $proveedoresController->obtenerComprasDeProductoPorProveedor();

    if (empty($proveedores) || empty($comprasConProveedores)) {
        echo "No hay datos para generar el reporte.";
        return;
    }

    $html = '
    <html><head><style>
    body { font-family: Arial, sans-serif; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
    th { background-color: #f2f2f2; }
    h2 { text-align: center; }
    .card-header { text-align: center; font-weight: bold; color: #007bff; }
    .card-body { margin-top: 20px; }
    </style></head><body>
    
    <h2>Reporte de Proveedores</h2>

    <!-- Proveedores del Negocio -->
    <div class="card shadow mb-4">
        <div class="card-header">Proveedores del Negocio</div>
        <div class="card-body">
            <table>
                <thead>
                    <tr>
                        <th>Nombre del proveedor</th>
                        <th>Telefono</th>
                        <th>Email</th>
                        <th>Direccion</th>
                    </tr>
                </thead>
                <tbody>';
    foreach ($proveedores as $proveedor) {
        $html .= "<tr>
            <td class='text-center'>{$proveedor['nombreProveedor']}</td>
            <td class='text-center'>{$proveedor['telefono']}</td>
            <td class='text-center'>{$proveedor['email']}</td>
            <td class='text-center'>{$proveedor['direccion']}</td>
        </tr>";
    }

    $html .= '
                </tbody>
            </table>
        </div>
    </div>

    <!-- Historial de Compras con Proveedores -->
    <div class="card shadow mb-4">
        <div class="card-header">Historial de Compra de Productos Con Proveedores</div>
        <div class="card-body">
            <table>
                <thead>
                    <tr>
                        <th>Nombre del proveedor</th>
                        <th>Categoría de productos</th>
                        <th>Fecha y Hora</th>
                    </tr>
                </thead>
                <tbody>';
    foreach ($comprasConProveedores as $compra) {
        $html .= "<tr>
            <td class='text-center'>{$compra['nombreProveedor']}</td>
            <td class='text-center'>{$compra['nombreCategoria']}</td>
            <td class='text-center'>{$compra['fechaCreacion']}</td>
        </tr>";
    }

    $html .= '
                </tbody>
            </table>
        </div>
    </div>

    </body></html>';

    $this->configurarDompdf($html, "reporte_proveedores.pdf");
}


   public function generarReporteProductos() {
    $categoriaController = new CategoriaController();
    $categorias = $categoriaController->obtenerTodasLasCategoriasDeProductos();

    $productoController = new ProductoController();
    $productos = $productoController->obtenerProductos();
    $stockActual = $productoController->calcularProductosActualesDelNegocio();

    $ventaController = new VentaController();
    $historial = $ventaController->historialVenta();

    ob_start(); // Start output buffering

    $html = '
    <html><head><style>
    body { font-family: Arial, sans-serif; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
    th { background-color: #f2f2f2; }
    h2 { text-align: center; }
    .card { margin-top: 20px; border: 1px solid #ccc; padding: 20px; }
    </style></head><body>
    <h2>Reporte de Productos</h2>
    <p><strong>Stock Total:</strong> ' . $stockActual . '</p>
    <table><thead><tr>
        <th>Codigo Barras</th><th>Nombre</th><th>Cantidad</th><th>Precio de Compra</th><th>Precio de Venta</th><th>Categoría</th>
    </tr></thead><tbody>';

    foreach ($productos as $prod) {
            var_dump($prod); // Esto mostrará todos los campos de $prod
        $html .= "<tr>
            <td>{$prod['codigoBarras']}</td>
            <td>{$prod['nombre']}</td>
            <td>{$prod['cantidad']}</td>
            <td>$" . number_format($prod['precioCompra'], 2) . "</td>
            <td>$" . number_format($prod['precioVenta'], 2) . "</td>
            <td>{$prod['nombreCategoria']}</td>
        </tr>";
    }

    $html .= '</tbody></table>';

    // Historial de Productos Vendidos
    $html .= '
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-center">
            <h6 class="mb-0 text-primary">Historial de Productos Vendidos</h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nombre del Producto</th>
                        <th>Total de Compra</th>
                        <th>Fecha y Hora</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>';

    foreach ($historial as $h) {
        $html .= "<tr>
            <td class='text-center'>" . htmlspecialchars($h['numeroDocumento']) . "</td>
            <td>" . htmlspecialchars($h['nombre']) . "</td>
            <td>" . htmlspecialchars($h['total']) . "</td>
            <td>" . htmlspecialchars($h['fecha']) . "</td>
        </tr>";
    }

    $html .= '</tbody></table>
        </div>
    </div>';

    $html .= '</body></html>';

    $this->configurarDompdf($html, "reporte_productos.pdf");

    ob_end_clean(); // End output buffering
}

    public function generarReporteInversiones() {
        $productoController = new ProductoController();
        $proveedores = $productoController->calcularGastosPorProveedor();
        $categorias = $productoController->calcularGastosPorCategoria();
        $gastoMes = $productoController->calcularGastoTotalEnMes();
        $gastoAnual = $productoController->calcularGastoTotalAnual();

        $html = '
        <html><head><style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        h2 { text-align: center; }
        </style></head><body>

        <h3>Gastos por Proveedor</h3>
        <table><thead><tr><th>Proveedor</th><th>Total</th></tr></thead><tbody>';
        foreach ($proveedores as $p) {
            $html .= "<tr><td>{$p['nombreProveedor']}</td><td>$" . number_format($p['inversionTotal'], 2) . "</td></tr>";
        }

        $html .= '</tbody></table><h3>Gastos por Categoría</h3><table><thead><tr><th>Categoría</th><th>Total</th></tr></thead><tbody>';
        foreach ($categorias as $c) {
            $html .= "<tr><td>{$c['nombreCategoria']}</td><td>$" . number_format($c['gastoTotal'], 2) . "</td></tr>";
        }

        $html .= '</tbody></table></body></html>';
        $this->configurarDompdf($html, "reporte_inversiones.pdf");
    }

    public function generarReporteGanancias() {
        $productoController = new ProductoController();
        $mes = $productoController->calcularGananciaMensual();
        $anio = $productoController->calcularGananciaAnual();
        $porProducto = $productoController->calcularGananciaPorProducto();
        $porCategoria = $productoController->calcularGananciaPorCategoria();

        $html = '
        <html><head><style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        h2 { text-align: center; }
        </style></head><body>
        <h2>Reporte de Ganancias</h2>
        <p><strong>Ganancia mensual:</strong> $' . number_format($mes, 2) . '</p>
        <p><strong>Ganancia anual:</strong> $' . number_format($anio, 2) . '</p>

        <h3>Ganancia por Producto</h3>
        <table><thead><tr><th>Producto</th><th>Ganancia</th></tr></thead><tbody>';
        foreach ($porProducto as $p) {
            $html .= "<tr><td>{$p['nombre']}</td><td>$" . number_format($p['gananciaTotal'], 2) . "</td></tr>";
        }

        $html .= '</tbody></table><h3>Ganancia por Categoría</h3><table><thead><tr><th>Categoría</th><th>Ganancia</th></tr></thead><tbody>';
        foreach ($porCategoria as $c) {
            $html .= "<tr><td>{$c['nombreCategoria']}</td><td>$" . number_format($c['gananciaTotal'], 2) . "</td></tr>";
        }

        $html .= '</tbody></table></body></html>';

        $this->configurarDompdf($html, "reporte_ganancias.pdf");
    }
}
