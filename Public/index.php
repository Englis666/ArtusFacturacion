<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../App/Controlador/VistaController.php';
require_once '../App/Controlador/AuthController.php';
require_once '../App/Controlador/ProductoController.php';
require_once '../App/Controlador/ProveedoresController.php';
require_once '../App/Controlador/CategoriaController.php';
require_once '../App/Controlador/VentaController.php';
require_once '../App/Controlador/ReporteController.php';

$base = "/ArtusFacturacion/";
$route = trim(str_replace($base, '', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)), '/');

if ($route === '') {
    header("Location: /login");
    exit;
}

$controllers = [
    'vista' => new VistaController(),
    'auth' => new AuthController(),
    'producto' => new ProductoController(),
    'proveedor' => new ProveedoresController(),
    'categoria' => new CategoriaController(),
    'venta' => new VentaController(),
    'reporte' => new ReporteController(),
];

// Rutas de frontend
$frontend = [
    'login' => ['vista', 'mostrar'],
    'registro' => ['vista', 'mostrar'],
    'dashboard' => ['vista', 'mostrar'],
    'ProductosStock' => ['vista', 'mostrar'],
    'Proveedores' => ['vista', 'mostrar'],
    'gananciaDeProductos' => ['vista', 'mostrar'],
    'inversionDeProductos' => ['vista', 'mostrar'],
    'formularioVenta' => ['vista' , 'mostrar'],
];

// Rutas de backend
$backend = [
    'registrar' => ['auth', 'registrar'],
    'logearse' => ['auth', 'logearse'],
    'logout' => ['auth', 'logout'],
    'agregarProducto' => ['producto', 'agregarProducto'],
    'agregarCategoria' => ['categoria', 'agregarCategoria'],
    'agregarProveedor' => ['proveedor', 'agregarProveedor'],
    'generarReporteProductos' => ['reporte', 'generarReporteProductos'],
    'generarReporteProveedores'=> ['reporte', 'generarReporteProveedores'],
    'generarReporteInversiones' => ['reporte', 'generarReporteInversiones'],
    'generarReporteGanancias' => ['reporte', 'generarReporteGanancias'],  
    'agregarVenta' => ['venta' , 'agregarVenta'],
    
    
];

// Verificar si la ruta está en frontend
if (isset($frontend[$route])) {
    [$controller, $method] = $frontend[$route];
    $controllers[$controller]->$method($route);
    exit;
}

// Verificar si la ruta está en backend
if (isset($backend[$route])) {
    [$controller, $method] = $backend[$route];
    $controllers[$controller]->$method();
    exit;
}

// Si la ruta no coincide, devolver error 404
http_response_code(404);
echo "Página no encontrada.";
