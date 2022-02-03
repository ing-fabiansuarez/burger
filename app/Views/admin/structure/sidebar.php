<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url() ?>" class="brand-link">
        <img src="<?= base_url() ?>/public/img/peraburgelogo1.png" alt="Logo" class="img-fluid" style="opacity: .8">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url() ?>/public/admin/dist/img/employees/<?= session()->image_employee ?>" class="img-circle elevation-2" alt="Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= session()->name_employee ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="<?= base_url() ?>" class="nav-link active">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Inicio
                        </p>
                    </a>
                </li>
                <li class="nav-header">PEDIDOS</li>
                <li class="nav-item">
                    <a href="<?= base_url() . route_to('view_createorder') ?>" class="nav-link">
                        <i class="nav-icon far fa-plus-square"></i>
                        <p>
                            Crear Pedido
                            <span class="badge badge-info right"><?php if (!empty($_SESSION['list_order'])) : echo count($_SESSION['list_order']);
                                                                    endif; ?></span>
                        </p>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a href="<?= base_url() . route_to('view_load_order', '2021-06-02-1622672054') ?>" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Pedido Cargado
                            <small class="badge badge-success right">Listo</small>
                        </p>
                    </a>
                </li> -->
                <li class="nav-item">
                    <a href="<?= base_url() . route_to('view_list_order', 2, date("Y-m-d")) ?>" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Lista de Pedidos
                        </p>
                    </a>
                </li>

                <li class="nav-header">COTIZADOR</li>
                <li class="nav-item">
                    <a href="<?= base_url() . route_to('quote_meat') ?>" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Carne
                        </p>
                    </a>
                </li>
                <li class="nav-header">BASE DE DATOS</li>
                <li class="nav-item">
                    <a href="<?= base_url() . route_to('view_domiciliaries') ?>" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Domiciliarios
                        </p>
                    </a>
                </li>



                <!--    <li class="nav-header">CLIENTES</li>
                <li class="nav-item">
                    <a href="<?= base_url() . route_to('view_createclient') ?>" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Crear Cliente
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li> -->
                <li class="nav-header">REPORTES</li>
                <li class="nav-item">
                    <a href="<?= base_url() . route_to('informe_daily_box', date("Y-m-d")) ?>" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Caja de cierre
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url() . route_to('informe_kathe', date("Y-m-d")) ?>" class="nav-link">
                        <i class="nav-icon fas fa-flag-checkered"></i>
                        <p>
                            Estadisticas Kathe
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url() . route_to('month_repot', date("Y"), date("m")) ?>" class="nav-link">
                        <i class="nav-icon fas fa-robot"></i>
                        <p>
                            Reporte Mensual
                        </p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="<?= base_url() . route_to('informe_general_report', date("Y-m-d"), date("Y-m-d")) ?>" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Reporte General
                        </p>
                    </a>
                </li>

                

                <li class="nav-header"></li>
                <li class="nav-item">
                    <a href="<?= base_url() . route_to('view_domiciliaries') ?>" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Crear Domiciliario
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>