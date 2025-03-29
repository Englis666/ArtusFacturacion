<?php
require_once '../App/Controlador/AuthController.php';

$auth = new AuthController();
$producto = new ProductoController();
$venta = new VentaController();


$route = $get['route'] ?? 'login';

switch ($route){
    case 'login':
        $auth->login();
        break;
    case 'registro':
        $auth->registrar();
        break;
    case 'logout':
        $auth->logout();
        break;

    case 'dashboard':
        require_once '../App/views/dashboard.php';
        break;
    case 'productos':
        $producto->index();
        break;
    case 'ventas':
        $venta->index();
        break;
    default: 
        echo "Pagina no encontrada.";
        break;
}
?>