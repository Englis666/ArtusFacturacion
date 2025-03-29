<?php
require_once '../config/Database.php';
require_once '../Controlador/ProductoController.php';

$productoController = new ProductoController($conn);

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $productoController->agregar();
}

$productos = $productoController->mostrarProductos();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar inventario</title>
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
</head>
<body>
     <!-- Esto se debe convertir en modal -->
    <div class="container mt-5">
        <h2>Agregar Productos</h2>
        <form method="POST">
            <div class="mb-3">
                <label for=""></label>
                <input type="text" name="nombre" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for=""></label>
                <input type="text" name="descripcion" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for=""></label>
                <input type="number" name="precio" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for=""></label>
                <input type="text" name="stock" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Agregar</button>
        </form>
    </div>

    <h2 class="mt-5">Lista de productos (Inventario)</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $producto): ?>
                <tr>
                    <td><?= $producto['nombre'] ?></td>
                    <td><?= $producto['descripcion'] ?></td>
                    <td><?= number_format($producto['precio'], 2) ?></td>
                    <td><?= $producto['stock'] ?></td>
                    <a href="../rutas/web.php?reporte=generarReporteInventario" class="btn btn-warning mt-3">Generar Reporte PDF</a>
                </tr>
                <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
