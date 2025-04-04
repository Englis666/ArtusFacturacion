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

// Capturar la ruta sin ".php"
$route = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

if (substr($route, -4) === '.php') {
    $newRoute = substr($route, 0, -4);
    header("Location: /$newRoute", true, 301);
    exit;
}

// Definir controladores
$controllers = [
    'vista' => new VistaController(),
    'auth' => new AuthController(),
    'producto' => new ProductoController(),
    'proveedor' => new ProveedoresController(),
    'categoria' => new CategoriaController(),
    'venta' => new VentaController(),
    'reporte' => new ReporteController($conn),
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
    'agregarProducto' => ['producto', 'agregarProducto'],
    'agregarCategoria' => ['categoria', 'agregarCategoria'],
    'agregarProveedor' => ['proveedor', 'agregarProveedor'],
    'reporte' => ['reporte', 'generarReporteInventario'],
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
