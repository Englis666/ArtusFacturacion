<?php
require_once '../App/Controlador/AuthController.php';
require_once '../App/Controlador/ProductoController.php';
require_once '../App/Controlador/ProveedorController.php';
require_once '../App/Controlador/CategoriaController.php';
require_once '../App/Controlador/VentaController.php';
require_once '../App/Controlador/ReporteController.php';

$route = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

if ($route === '') {
    $route = 'login';
}

// Manejar las rutas
switch ($route) {
    case 'login':
        $auth = new AuthController();
        $auth->login();
        break;
    case 'registro':
        $auth = new AuthController();
        $auth->registrar();
        break;
    case 'logout':
        $auth = new AuthController();
        $auth->logout();
        break;
    case 'reporte':
        $reporte = new ReporteController();
        $reporte->generarReporteInventario();
        break;
    case 'agregarCategoria':
        $categoria = new CategoriaController();
        $categoria->agregarCategoria();
        break;
    case 'agregarProducto':
        $producto = new ProductoController();
        $producto->agregarProducto();
        break;
    case 'agregarProveedor':
        $proveedor = new ProveedorController();
        $proveedor->agregarProveedor();
        break;
    default:
        http_response_code(404);
        echo "Página no encontrada.";
        break;
}

?>