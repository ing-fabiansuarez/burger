<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= base_url() ?>" class="nav-link">Home</a>
        </li>
        <!--  <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li> -->
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fas fa-user-tie"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header"><b>Perfil</b></span>
                <div class="dropdown-divider"></div>
                <div class="text-center">
                    <img src="<?=base_url()?>/public/admin/dist/img/employees/<?=session()->image_employee?>" alt="" class="img-fluid">
                </div>

                <div class="dropdown-divider">
                </div>

                <a href="#" class="dropdown-item">
                    <i class="fas fa-user-tie mr-2"></i><?= session()->name_employee ?>
                </a>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-user-tie mr-2"></i>Desde <?= session()->date_start_employee?>
                </a>
                <div class="dropdown-divider">
                </div>

                <a href="<?= base_url() . route_to('logout') ?>" class="dropdown-item dropdown-footer"><i class="fas fa-sign-in-alt"></i> Salida Segura</a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url() . route_to('logout') ?>">
                <i class="fas fa-sign-in-alt"></i>
            </a>
        </li>

    </ul>
</nav>