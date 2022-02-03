<?= $this->extend('admin/structure/main_admin_view') ?>
<?= $this->section('title') ?> - Permisos<?= $this->endSection() ?>
<?= $this->section('js') ?>
<?= $this->endSection() ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>



<?= $this->section('content') ?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Sin permisos</li>
                </ol>
            </div>
        </div>
    </div>
</section>


<section class="content">
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="card card-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-info">
                    <h3 class="widget-user-username"><?= session()->name_employee ?></h3>
                    <h5 class="widget-user-desc"><?= session()->id_employee ?></h5>
                </div>
                <div class="widget-user-image">
                    <img class="img-circle elevation-2" src="<?= base_url('public/admin/dist/img/employees') . '/' . session()->image_employee ?>" alt="User Avatar">
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger alert-dismissible">
                                <h5><i class="icon fas fa-ban"></i> Alerta!</h5>
                                No tienes permisos para realizar o ejecutar esta acción.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>