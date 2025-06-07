<?php
require_once 'App/Controlador/CategoriaController.php';
require_once 'App/Controlador/ProductoController.php';
require_once 'App/Helper/Sesion.php';

$categoriaController = new CategoriaController();
$categorias = $categoriaController->obtenerTodasLasCategoriasDeProductos();

$productoController = new ProductoController();
$productos = $productoController->obtenerProductos();

Sesion::obtenerUsuario();
$validar = $_SESSION['usuario'] ?? null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Generar Venta De Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f4;
        }
        .card {
            background-color: #ffffff;
            border-radius: 1rem;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .btn-primary { background-color: #007bff; border: none; }
        .btn-primary:hover { background-color: #0056b3; }
        .btn-danger { background-color: #dc3545; border: none; }
        .form-control { border-radius: 0.5rem; border: 1px solid #ccc; }
        .title { color: #007bff; }
        .table thead {
            position: sticky;
            top: 0;
            background: #fff;
            z-index: 2;
        }
    </style>
</head>
<body>

<section class="vh-100 d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card p-4">
                    <div class="card-body">

                        <!-- Tu encabezado PHP permanece igual -->

<form id="ventaForm" action="/agregarVenta" method="POST">
    <div class="text-center mb-4">
        <span class="h1 fw-bold title">Mundo Accesorio</span>
    </div>

    <h5 class="fw-normal mb-3 pb-2 text-center">Realización de ventas</h5>
    <p class="text-center text-muted">Vista para registrar una compra</p>

    <!-- Documento -->
    <div class="mb-3">
        <label class="form-label">Número de documento del cliente</label>
        <input type="number" class="form-control" name="numeroDocumento" id="numeroDocumento" required>
    </div>

    <!-- Selección -->
    <div class="row mb-3">
        <div class="col-md-4">
            <label class="form-label">Categoría</label>
            <select class="form-control" id="categoria">
                <option value="">Selecciona una categoría</option>
                <?php foreach ($categorias as $categoria): ?>
                    <option value="<?= $categoria['idCategoria'] ?>"><?= htmlspecialchars($categoria['nombreCategoria']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-4">
            <label class="form-label">Producto</label>
            <select class="form-control" id="producto">
                <option value="">Selecciona un producto</option>
                <?php foreach ($productos as $producto) : ?>
                    <option value="<?= $producto['codigoBarras'] ?>" data-precio="<?= $producto['precioVenta'] ?>" data-nombre="<?= htmlspecialchars($producto['nombre']) ?>">
                        <?= htmlspecialchars($producto['nombre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-2">
            <label class="form-label">Cantidad</label>
            <input type="number" id="cantidad" class="form-control" min="1" value="1">
        </div>

        <div class="col-md-2 d-flex align-items-end">
            <button type="button" class="btn btn-success w-100" onclick="agregarProducto()">Agregar</button>
        </div>
    </div>

    <!-- Tabla productos -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="productosTabla"></tbody>
        </table>
    </div>

    <!-- Totales -->
    <input type="hidden" name="totalCompra" id="totalCompraHidden">

    <div class="mb-3">
        <label class="form-label">Total de la compra</label>
        <input type="number" class="form-control" id="totalCompra" readonly>
    </div>

    <!-- Botones -->
    <button type="submit" class="btn btn-primary w-100" disabled>Registrar Compra</button>
    <button type="reset" class="btn btn-danger w-100 mt-2" onclick="reiniciarVenta()">Cancelar Compra</button>
</form>
    <a href="/logout" class="btn btn-danger w-100 mt-2">Cerrar sesion</a>

<script>
    let totalCompra = 0;

    function agregarProducto() {
        const productoSelect = document.getElementById("producto");
        const productoNombre = productoSelect.options[productoSelect.selectedIndex].getAttribute("data-nombre");
        const codigoBarras = productoSelect.value;
        const precio = parseFloat(productoSelect.options[productoSelect.selectedIndex].getAttribute("data-precio")) || 0;
        const cantidad = parseInt(document.getElementById("cantidad").value);

        if (!codigoBarras || isNaN(cantidad) || cantidad <= 0) {
            alert("Seleccione un producto y una cantidad válida.");
            return;
        }

        const subtotal = precio * cantidad;
        totalCompra += subtotal;

        const tabla = document.getElementById("productosTabla");
        const fila = document.createElement("tr");

        fila.innerHTML = `
            <td>${productoNombre}</td>
            <td>${cantidad}</td>
            <td>$${precio.toFixed(2)}</td>
            <td>$${subtotal.toFixed(2)}</td>
            <td>
                <button class="btn btn-danger btn-sm" onclick="eliminarProducto(this, ${subtotal})">Eliminar</button>
                <input type="hidden" name="productos[]" value='${JSON.stringify({
                    codigoBarras: codigoBarras,
                    cantidad: cantidad,
                    precioUnitario: precio
                })}'>
            </td>
        `;

        tabla.appendChild(fila);

        document.getElementById("totalCompra").value = totalCompra.toFixed(2);
        document.getElementById("totalCompraHidden").value = totalCompra.toFixed(2);
        document.querySelector('button[type="submit"]').disabled = false;
    }

    function eliminarProducto(boton, subtotal) {
        totalCompra -= subtotal;
        boton.closest("tr").remove();

        document.getElementById("totalCompra").value = totalCompra.toFixed(2);
        document.getElementById("totalCompraHidden").value = totalCompra.toFixed(2);

        if (totalCompra <= 0) {
            document.querySelector('button[type="submit"]').disabled = true;
        }
    }

    function reiniciarVenta() {
        totalCompra = 0;
        document.getElementById("totalCompra").value = "0.00";
        document.getElementById("totalCompraHidden").value = "0.00";
        document.getElementById("productosTabla").innerHTML = "";
        document.querySelector('button[type="submit"]').disabled = true;
    }
</script>
