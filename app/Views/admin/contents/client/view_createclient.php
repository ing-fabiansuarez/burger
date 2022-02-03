<?= $this->extend('admin/structure/main_admin_view') ?>
<?= $this->section('title') ?> - Nuevo Pedido<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                    <li class="breadcrumb-item active">Cliente</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Clientes</span>
                        <span class="info-box-number">2,000</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->

                <form action="" method="get">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Cedula:</label>
                        <div class="col-sm-8">
                            <input name="cedula_search" type="text" class="form-control" placeholder="Cedula" value="">
                            <p class="text-danger"></p>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        BUSCAR
                    </button>
                </form>
            </div>
            <div class="col-md-4">
                <!-- DEBUG-VIEW START 1 APPPATH/Config/../Views/clients/form_client_view.php -->
                <div class="card card-success shadow-sm">
                    <div class="card-header">
                        <h3 class="card-title">Nuevo Cliente</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">

                        <form class="form-client" action="https://localhost/pera/createclient" method="post">

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Cedula</label>
                                <div class="col-sm-8">
                                    <input name="cedula" type="number" class="form-control" placeholder="Cedula" value="">
                                    <p class="text-danger"></p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Nombres</label>
                                <div class="col-sm-8">
                                    <input name="name" type="text" class="form-control" placeholder="Nombres" value="" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                    <p class="text-danger"></p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Apellidos</label>
                                <div class="col-sm-8">
                                    <input name="surname" type="text" class="form-control" value="" placeholder="Apellidos" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                    <p class="text-danger"></p>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">
                                    GUARDAR
                                </button>
                            </div>

                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- DEBUG-VIEW ENDED 1 APPPATH/Config/../Views/clients/form_client_view.php -->
            </div>
            <div class="col-md-4">

            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>