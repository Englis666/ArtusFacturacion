<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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
                <form class="user">
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="text" class="form-control form-control-user" placeholder="Código de barras">
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="form-control form-control-user" placeholder="Nombre del producto">
                        </div>
                        <div class="col-sm-6 mt-2">
                            <input type="number" class="form-control form-control-user" placeholder="Cantidad de producto">
                        </div>
                        <div class="col-sm-6 mt-2">
                            <input type="number" class="form-control form-control-user" placeholder="Precio del producto">
                        </div>
                        <div class="col-sm-6 mt-2">
                            <select class="form-control">
                                <option value="">Selecciona la categoría del producto</option>
                                <option value="1">Electrónica</option>
                                <option value="2">Ropa</option>
                                <option value="3">Alimentos</option>
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

</body>
</html>