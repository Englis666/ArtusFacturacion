<form id="facturaForm">
    <h3>Datos del Cliente</h3>
    <div class="mb-3">
        <label class="form-label">Nombre:</label>
        <input type="text" name="nombre" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Documento:</label>
        <input type="text" name="documento" class="form-control">
    </div>

    <h3>Productos</h3>
    <div id="productosContainer">
        <div class="producto mb-2">
            <input type="text" name="producto[]" placeholder="Producto" class="form-control mb-2" required>
            <input type="number" name="cantidad[]" placeholder="Cantidad" class="form-control mb-2" required>
            <input type="number" name="precio[]" placeholder="Precio unitario" class="form-control mb-2" required>
        </div>
    </div>
    <button type="button" id="agregarProducto" class="btn btn-secondary">Agregar Producto</button>

    <button type="submit" class="btn btn-primary mt-3">Generar Factura</button>
</form>

<script>
document.getElementById("agregarProducto").addEventListener("click", function() {
    let container = document.getElementById("productosContainer");
    let div = document.createElement("div");
    div.classList.add("producto", "mb-2");
    div.innerHTML = `
        <input type="text" name="producto[]" placeholder="Producto" class="form-control mb-2" required>
        <input type="number" name="cantidad[]" placeholder="Cantidad" class="form-control mb-2" required>
        <input type="number" name="precio[]" placeholder="Precio unitario" class="form-control mb-2" required>
    `;
    container.appendChild(div);
});

document.getElementById("facturaForm").addEventListener("submit", function(event) {
    event.preventDefault();
    let formData = new FormData(this);

    fetch("../controllers/FacturaController.php?action=generarFactura", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Venta registrada. Imprimiendo factura...");
            window.location.href = "../controllers/FacturaController.php?action=imprimirFactura&venta_id=" + data.venta_id;
        } else {
            alert("Error al registrar la venta.");
        }
    });
});
</script>
