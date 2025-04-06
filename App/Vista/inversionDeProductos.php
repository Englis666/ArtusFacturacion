<?php
require_once '../App/Controlador/ProductoController.php';
$productoController = new ProductoController();
$calculoMensual = $productoController->calcularGastosPorProveedor();
$gastosPorCategoria = $productoController->calcularGastosPorCategoria();
$mes = $productoController->calcularGastoTotalEnMes();
$anual = $productoController->calcularGastoTotalAnual();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Inversion De Productos En La Tienda</title>

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
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
                <div class="sidebar-brand-icon">
                     <i class="fas fa-globe"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Mundo Accesorio</div>
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="dashboard.php">
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
                    </div>
                </div>
            </li>

             <li class="nav-item active" >
                <a class="nav-link" href="/logout">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Cerrar Sesion</span></a>
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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Nombre del usuario</span>
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
                        <h1 class="h3 mb-0 text-gray-800">Inversion De Productos</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generar Reporte
                        </a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <!-- Gastos Mensuales carta  -->
                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row  align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs  text-primary text-uppercase mb-1">
                                                Gastos Mensuales En Productos
                                            </div>
                                            <?php if($mes): ?>
                                            <div class="h5 mb-0  text-gray-800">$<?=number_format($mes['gastoTotal'], 0,',','.')?></div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Gastos Anuales carta  -->
                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row  align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs  text-success text-uppercase mb-1">
                                                Gastos Anuales En Productos</div>
                                            <?php if ($anual): ?>
                                                <div class="h5 mb-0 text-gray-800">$<?= number_format($anual['gastoTotal'], 0, ',', '.') ?></div>
                                            <?php endif; ?>

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
                                    <h6 class="mb-0  text-primary">Gastos por producto</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table tabler-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <th>Codigo de barras</th>
                                            <th>Nombre del producto</th>
                                            <th>Precio de compra al proovedor total</th>
                                            <th>Cantidad</th>
                                            <th>Nombre del proovedor</th>
                                            <th>Fecha y hora</th>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($calculoMensual as $calculo): ?>
                                                <tr>
                                                    <td class="text-center"><?= htmlspecialchars($calculo['codigoBarras']) ?></td>
                                                    <td class="text-center"><?= htmlspecialchars($calculo['nombre']) ?></td>
                                                    <td class="text-center">$<?= number_format($calculo['inversionTotal'], 0, ',', '.') ?></td>
                                                    <td class="text-center"><?= number_format($calculo['cantidad'], 0 , ',', '.')?></td>
                                                    <td class="text-center"><?= htmlspecialchars($calculo['nombreProveedor']) ?></td>
                                                    <td class="text-center"><?= htmlspecialchars($calculo['fechaCreacion']) ?></td>
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
                                    <h6 class="mb-0  text-primary">Gastos por Categoria De Producto</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table tabler-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <th>Nombre de la Categoria</th>
                                            <th>Nombre del proovedor</th>
                                            <th>Precio de compra al Proveedor</th>
                                            <th>Fecha y hora</th>
                                        </thead>
                                            <tbody>
                                                <?php foreach ($gastosPorCategoria as $gasto): ?>
                                                    <tr>
                                                        <td class="text-center"><?= htmlspecialchars($gasto['nombreCategoria']) ?></td>
                                                        <td class="text-center"><?= htmlspecialchars($gasto['nombreProveedor']) ?></td>
                                                        <td class="text-center">$<?= number_format($gasto['gastoTotal'], 0, ',', '.') ?></td>
                                                        <td class="text-center"><?= htmlspecialchars($gasto['ultimaFecha']) ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Artus Sistema De Inventario Y Facturacion</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->


    <!-- Custom scripts for all pages-->
    <script src="public/js/sb-admin-2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>