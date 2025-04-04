<?php
require_once '../App/Controlador/CategoriaController.php';
require_once '../App/Controlador/ProveedoresController.php';

$controller = new CategoriaController();
$categorias = $controller->obtenerTodasLasCategoriasDeProductos();

$proveedoresController = new ProveedoresController();
$proveedores = $proveedoresController->obtenerProveedores();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="modal fade" id="modalIframe" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Agregar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Agregar Un Producto</h1>
                </div>
                <form class="user" action="/agregarProducto" method="POST">
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="text" class="form-control form-control-user" name="codigoBarras" placeholder="Código de barras">
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="form-control form-control-user" name="nombreProducto" placeholder="Nombre del producto">
                        </div>
                        <div class="col-sm-6 mt-2">
                            <input type="number" class="form-control form-control-user" name="cantidad" placeholder="Cantidad de producto">
                        </div>
                        <div class="col-sm-6 mt-2">
                            <input type="number" class="form-control form-control-user" name="precioCompra" placeholder="Precio de Compra">
                        </div>
                        <div class="col-sm-6 mt-2">
                            <input type="number" class="form-control form-control-user" name="precioVenta" placeholder="Precio de Venta">
                        </div>
                        <div class="col-sm-6 mt-2">
                            <select class="form-control" name="idCategoria">
                                <option value="">Selecciona la categoría del producto</option>
                                <?php foreach ($categorias as $categoria): ?>
                                    <option value="<?= $categoria['idCategoria'] ?>"><?= htmlspecialchars($categoria['nombreCategoria']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-sm-6 mt-2">
                            <select name="idProveedor" class="form-control">
                                <option value="">Selecciona el proveedor del producto</option>
                                <?php foreach ($proveedores as $proveedor): ?>
                                    <option value="<?= $proveedor['idProveedor']?>"><?= htmlspecialchars($proveedor['nombreProveedor']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        <button type="submit" class="btn btn-primary btn-user btn-block">Agregar Producto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    
</script>

</body>
</html>
