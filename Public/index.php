<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


require_once __DIR__ . '/App/Controlador/VistaController.php';
require_once __DIR__ . '/App/Controlador/AuthController.php';
require_once __DIR__ . '/App/Controlador/ProductoController.php';
require_once __DIR__ . '/App/Controlador/ProveedoresController.php';
require_once __DIR__ . '/App/Controlador/CategoriaController.php';
require_once __DIR__ . '/App/Controlador/VentaController.php';
require_once __DIR__ . '/App/Controlador/ReporteController.php';


$controllers = [
    'vista' => new VistaController(),
    'auth' => new AuthController(),
    'producto' => new ProductoController(),
    'proveedor' => new ProveedoresController(),
    'categoria' => new CategoriaController(),
    'venta' => new VentaController(),
    'reporte' => new ReporteController(),
];


$frontend = require __DIR__ . '/App/Config/frontend_routes.php';
$backend = require __DIR__ . '/App/Config/backend_routes.php';

$base = "/ArtusFacturacion/";
$route = trim(str_replace($base, '', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)), '/');

if ($route === '') {
    header("Location: /login");
    exit;
}


function runRoute($routes, $controllers, $route, $isFrontend = true) {
    if (isset($routes[$route])) {
        [$controllerKey, $method] = $routes[$route];
        if (isset($controllers[$controllerKey]) && method_exists($controllers[$controllerKey], $method)) {
            if ($isFrontend) {
                $controllers[$controllerKey]->$method($route);
            } else {
                $controllers[$controllerKey]->$method();
            }
            exit;
        }
    }
}


runRoute($frontend, $controllers, $route, true);
runRoute($backend, $controllers, $route, false);


http_response_code(404);
echo "<h1>Página no encontrada</h1>";