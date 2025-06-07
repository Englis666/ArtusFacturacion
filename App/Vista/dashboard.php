<?php
$productoController = new ProductoController();
$mes = $productoController->calcularGananciaMensual();
$anio = $productoController->calcularGananciaAnual();
$resumenHoy = $productoController->obtenerGananciasDeHoyPorHora();
$horas = [];
$ganancias = [];
foreach ($resumenHoy as $fila) {
    $horas[] = str_pad($fila['hora'], 2, '0', STR_PAD_LEFT) . ':00'; 
    $ganancias[] = floatval($fila['ganancia']);
}
$ventaController = new VentaController();
$historial = $ventaController->historialVenta();

$obtenerProductosPorcentaje = $productoController->obtenerStockProductos();

function obtenerColor($porcentaje) {
    if ($porcentaje < 30) return 'bg-danger';
    elseif ($porcentaje < 60) return 'bg-warning';
    elseif ($porcentaje < 90) return 'bg-info';
    else return 'bg-success';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Inicio</title>

    <!-- Custom fonts for this template-->
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

        <?php include 'App/Vista/Components/sidebar.php'; ?>
        <!-- Sidebar -->
        

        <!-- Contenido -->
        <div id="content-wrapper" class="d-flex flex-column">
            
            <?php include 'App/Vista/Components/navbar.php'; ?>

            <!-- Main Content -->
            <div id="content">

                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Panel Principal</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i>Agregar Ticketadora</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Ganancias Mensuales carta-->
                        <div class="col-xl-6 col-md-4 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row  align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs text-primary text-uppercase mb-1">
                                                Ganancias Mensuales
                                            </div>
                                          <?php if($mes): ?>
                                                <div class="h5 mb-0 text-gray-800">$<?= number_format($mes, 2) ?></div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Ganancias Anuales carta -->
                        <div class="col-xl-6 col-md-4 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row  align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs  text-success text-uppercase mb-1">
                                                Ganancias Anuales</div>
                                            <?php if($anio): ?>
                                            <div class="h5 mb-0 text-gray-800">$<?=number_format($anio, 2)?></div>
                                            <?php endif;?>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Porcentaje de productos validos en la tienda-->
                        
                    </div>
                            <!-- Content Row -->
                           <div class="row">
                        <!-- Area Chart -->
                        <div class="col-xl-6 col-lg-6">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown + título -->
                                <div class="card-header py-3 d-flex align-items-center justify-content-between">
                                    <h6 class="m-0 text-primary">Resumen de ganancias de hoy</h6>
                        

                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                    </div>
                                </div>
                                <canvas id="graficaGananciasHoy" height="100"></canvas>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex align-item-center justify-content-center">
                                    <h6 class="mb-0  text-primary">Historial de Ventas</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table tabler-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <th>Numero de documento del cliente</th>
                                            <th>Nombre del producto</th>
                                            <th>Total de compra</th>
                                            <th>Fecha y dia</th>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($historial as $historial):?>
                                            <tr>
                                                <td class="text-center"><?php echo htmlspecialchars($historial['numeroDocumento'])?></td>
                                                <td><?php echo htmlspecialchars($historial['nombre'])?></td>
                                                <td><?php echo htmlspecialchars($historial['total'])?></td>
                                                <td><?php echo htmlspecialchars($historial['fecha'])?></td>
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
                            <div class="col-lg-6 mb-4">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 text-primary">Inventario de productos en stock actuales</h6>
                                    </div>
                                    <div class="card-body">
                                        <?php foreach ($obtenerProductosPorcentaje as $item): 
                                            $color = obtenerColor($item['porcentaje']);
                                        ?>
                                            <h4 class="small"><?= htmlspecialchars($item['categoria']) ?>
                                                <span class="float-right"><?= $item['porcentaje'] ?>%</span>
                                            </h4>
                                            <div class="progress mb-4">
                                                <div class="progress-bar <?= $color ?>" role="progressbar"
                                                    style="width: <?= $item['porcentaje'] ?>%" 
                                                    aria-valuenow="<?= $item['porcentaje'] ?>" aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">

                            <!-- Approach -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 text-primary">Enfoque</h6>
                                </div>
                                <div class="card-body">
                                    <p>El software está diseñado para ofrecer herramientas eficientes y asertivas que optimizan la gestión de inventarios y el sistema de facturación, facilitando el control y seguimiento de las operaciones diarias de una tienda o negocio.</p>
                                    <p class="mb-0">Cuenta con una interfaz intuitiva, generación de reportes detallados, control de usuarios, impresión de facturas con ticketera, y análisis de ganancias por producto y categoría. Todo esto enfocado en mejorar la toma de decisiones y aumentar la productividad.</p>
                                </div>
                            </div>
                        </div>
                    
                
                
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
            <?php include 'App/Vista/Components/footer.php'; ?>
            <!-- Footer -->
            

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('graficaGananciasHoy').getContext('2d');

    const grafica = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?= json_encode($horas) ?>,
            datasets: [{
                label: 'Ganancia ($)',
                data: <?= json_encode($ganancias) ?>,
                borderColor: 'rgba(78, 115, 223, 1)',
                backgroundColor: 'rgba(78, 115, 223, 0.05)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Hora'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Ganancia ($)'
                    }
                }
            }
        }
    });
</script>

    <!-- Custom scripts for all pages-->
    <script src="public/js/sb-admin-2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>