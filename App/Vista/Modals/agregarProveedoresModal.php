<?php
require_once 'App/Controlador/CategoriaController.php';
$controller = new CategoriaController();
$categorias = $controller->obtenerTodasLasCategoriasDeProductos();

?>

<div class="modal fade" id="modalIframe" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Agregar Proveedor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="p-3">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Agregar Un Proveedor</h1>
                    </div>
                    <form class="user" action="/agregarProveedor" method="POST">
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user"
                                    placeholder="Nombre del Proveedor" name="nombreProveedor" required>
                            </div>
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user"
                                    placeholder="Telefono del Proveedor" name="telefono">
                            </div>
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user"
                                    placeholder="Correo Electronico del Proveedor" name="email">
                            </div>
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user"
                                    placeholder="Direccion del proveedor" name="direccion">
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <button type="submit" class="btn btn-primary btn-user btn-block">Agregar Proveedor</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
