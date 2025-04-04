<?php
require_once '../App/Controlador/CategoriaController.php';
require_once '../App/Controlador/ProductoController.php';

$categoriaController = new CategoriaController();
$categorias = $categoriaController->obtenerTodasLasCategoriasDeProductos();
$categoriaPorProducto = $categoriaController->obtenerProductosPorCategoria();

$productoController = new ProductoController();
$productos = $productoController->obtenerProductos();
$stock = $productoController->calcularProductosActualesDelNegocio();

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Productos Stock</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard">
                <div class="sidebar-brand-icon">
                     <i class="fas fa-globe"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Mundo Accesorio</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Inicio</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interfaces
            </div>

            <!-- Inventario -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#Inventario"
                    aria-expanded="false" aria-controls="Inventario">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Inventario</span>
                </a>
                <div id="Inventario" class="collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionSidebar">
                    <div class=" py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Productos y Proveedores:</h6>
                        <a class="collapse-item text-white" href="Proveedores">Proveedores</a>
                        <a class="collapse-item text-white" href="ProductosStock">Productos Stock</a>
                    </div>
                </div>
            </li>
                            

            <!-- Tienda -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#Tienda"
                    aria-expanded="false" aria-controls="Tienda">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Tienda</span>
                </a>
                <div id="Tienda" class="collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionSidebar">
                    <div class=" py-2 collapse-inner rounded">
                        <a class="collapse-item text-white" href="inversionDeProductos">Inversiones de productos</a>
                        <a class="collapse-item text-white" href="gananciaDeProductos">Ganancias de productos</a>
                        <a class="collapse-item text-white" href="#">Cierre de mes</a>
                    </div>
                </div>
            </li>
                        

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Adicionales
            </div>

            <!-- Estos son adicionales -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Vistas</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">SubVistas</h6>
                        <a class="collapse-item" href="">Ver proveedores</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- Fin del sidebar -->

        <!-- Contenido -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Nombre completo del administrador</span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Registro de Actividad
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cerrar Sesion
                                </a>
                            </div>
                        </li>
                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                     <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Gestión de productos</h1>
                        <div class="d-flex gap-2"> 
                            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generar Reporte
                            </a>
                            <button class="btn btn-primary btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#modalIframe">
                                <i class="fas fa-plus fa-sm text-white-50"></i> Agregar Producto
                            </button>
                        </div>
                    </div>
                    <?php include 'Modals/AgregarProductoModal.php'; ?>

                    <!-- Content Row -->
                    <div class="row">
                        <!-- Ganancias Anuales carta -->
                        <div class="col-xl-12 col-md-12 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row  align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs  text-success text-uppercase mb-1">
                                                Cantidad de productos actuales del negocio</div>
                                                <div class="h5 mb-0 text-gray-800">Los productos actuales del negocio son : <?php echo htmlspecialchars($stock); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-xl-6 col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex align-item-center justify-content-center">
                                    <h6 class="mb-0  text-primary">Productos Actuales Del Negocio</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table tabler-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <th>Codigo de barras</th>
                                            <th>Nombre del producto</th>
                                            <th>Cantidad</th>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($productos as $producto): ?>
                                                <tr>
                                                        <td class="text-center"><?php echo htmlspecialchars($producto['codigoBarras']); ?></td>
                                                        <td class="text-center"><?php echo htmlspecialchars($producto['nombre']);?></td>
                                                        <td class="text-center"><?php echo htmlspecialchars($producto['cantidad']);?></td>
                                                    </tr>
                                            <?php endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                                    
                            </div><
                        </div>
                         <div class="col-xl-6 col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex align-item-center justify-content-center">
                                    <h6 class="mb-0  text-primary">Productos Actuales Del Negocio Por Categoria</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table tabler-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <th>Codigo de barras</th>
                                            <th>Nombre del Producto</th>
                                            <th>Categoria de Productos</th>
                                            <th>Cantidad</th>
                                            <th>Precio de venta</th>
                                            <th>Precio de compra</th>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($categoriaPorProducto as $categoriaPorProducto): ?>
                                                <tr>
                                                    <td class="text-center"><?php echo htmlspecialchars($categoriaPorProducto['codigoBarras'])?></td>
                                                    <td class="text-center"><?php echo htmlspecialchars($categoriaPorProducto['nombre'])?></td>
                                                    <td class="text-center"><?php echo htmlspecialchars($categoriaPorProducto['nombreCategoria'])?></td>
                                                    <td class="text-center"><?php echo htmlspecialchars($categoriaPorProducto['cantidad'])?></td>
                                                    <td class="text-center"><?php echo htmlspecialchars($categoriaPorProducto['precioVenta'])?></td>
                                                    <td class="text-center"><?php echo htmlspecialchars($categoriaPorProducto['precioCompra'])?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex align-item-center justify-content-center">
                                    <h6 class="mb-0  text-primary">Historial de Productos Vendidos</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table tabler-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <th>Nombre del Producto</th>
                                            <th>Total De Compra</th>
                                            <th>Fecha y Hora</th>
                                            <th>Cantidad</th>
                                        </thead>
                                        <tbody>
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex align-item-center justify-content-center">
                                    <h6 class="mb-0  text-primary">Categorias De Productos</h6>
                                   <button class="btn btn-primary ms-5" data-bs-toggle="modal" data-bs-target="#modalIframe2">
                                        Agregar Categoría De Productos
                                    </button>
                                    <?php include 'Modals/AgregarCategoriaProductoModal.php'; ?>

                                </div>
                                <div class="card-body">
                                    <table class="table tabler-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <th class="text-center">Categoria De Productos</th>
                                        </thead>
                                        <tbody>
                                             <?php foreach ($categorias as $categoria): ?>
                                            <tr>
                                                <td class="text-center"><?php echo htmlspecialchars($categoria['nombreCategoria']); ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>    
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <!-- Content Column -->
                        <div class="col-lg-6 mb-4">
                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0  text-primary">Inventario de productos en stock actuales</h6>
                                </div>
                                <div class="card-body">
                                    <h4 class="small ">Server Migration <span
                                            class="float-right">20%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 20%"
                                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small ">Sales Tracking <span
                                            class="float-right">40%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 40%"
                                            aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small ">Customer Database <span
                                            class="float-right">60%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar" role="progressbar" style="width: 60%"
                                            aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small ">Payout Details <span
                                            class="float-right">80%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 80%"
                                            aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small ">Account Setup <span
                                            class="float-right">Complete!</span></h4>
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%"
                                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy;Artus Sistema De Inventarios Y Facturacion</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="public/js/sb-admin-2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>