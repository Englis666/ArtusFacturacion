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