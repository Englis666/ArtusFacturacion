<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Proveedores</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ccc; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
        h2, h4 { text-align: center; }
    </style>
</head>
<body>
    <h2>Reporte de Proveedores</h2>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Dirección</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($proveedores as $proveedor): ?>
                <tr>
                    <td><?= htmlspecialchars($proveedor['nombreProveedor']) ?></td>
                    <td><?= htmlspecialchars($proveedor['telefono']) ?></td>
                    <td><?= htmlspecialchars($proveedor['email']) ?></td>
                    <td><?= htmlspecialchars($proveedor['direccion']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h4>Compras Realizadas</h4>

    <table>
        <thead>
            <tr>
                <th>Proveedor</th>
                <th>Categoría</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($comprasConProveedores as $compra): ?>
                <tr>
                    <td><?= htmlspecialchars($compra['nombreProveedor']) ?></td>
                    <td><?= htmlspecialchars($compra['nombreCategoria']) ?></td>
                    <td><?= htmlspecialchars($compra['fechaCreacion']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
