<?= $this->extend('admin/structure/main_admin_view') ?>
<?= $this->section('title') ?> - Domiciliarios<?= $this->endSection() ?>

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
                    <li class="breadcrumb-item active">Domiciliarios</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-1">
            </div>
            <div class="col-md-4">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Domiciliarios</span>
                        <span class="info-box-number"><?= count($domiciliaries) ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->

                <!--   <form action="" method="get">
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
                </form> -->
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

                        <form class="form-client" action="<?= base_url() . route_to('createdomiciliaries') ?>" method="post">

                            <div class="form-group row">
                                <label class=" col-form-label">Cedula</label>

                                <input name="cedula_domiciliary" type="number" class="form-control" placeholder="Cedula" value="<?= old('cedula_domiciliary') ?>">
                                <p class="text-danger"> <?= session('validate_form_domiciliary.cedula_domiciliary') ?></p>

                            </div>
                            <div class="form-group row">
                                <label class="col-form-label">Nombres</label>
                                <input name="name_domiciliary" type="text" class="form-control" placeholder="Nombres" value="<?= old('name_domiciliary') ?>">
                                <p class="text-danger"> <?= session('validate_form_domiciliary.name_domiciliary') ?></p>
                            </div>
                            <div class="form-group row">
                                <label class=" col-form-label">Apellidos</label>
                                <input name="surname_domiciliary" type="text" class="form-control" value="<?= old('surname_domiciliary') ?>" placeholder="Apellidos">
                                <p class="text-danger"> <?= session('validate_form_domiciliary.surname_domiciliary') ?></p>
                            </div>
                            <div class="form-group row">
                                <label class=" col-form-label">Fecha de Inicio</label>
                                <input name="date_domiciliary" type="date" class="form-control" value="<?= old('date_domiciliary') ?>">
                                <p class="text-danger"> <?= session('validate_form_domiciliary.date_domiciliary') ?></p>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">
                                    GUARDAR
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <?php if (session()->error) : ?>
                    <div class="col-md-12 alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-ban"></i> <?= session('error.title') ?></h5>
                        <?= session('error.body') ?>
                    </div>
                <?php endif; ?>
                <?php if (session()->msg) :  ?>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-check"></i> <?= session('msg.title') ?></h5>
                        <?= session('msg.body') ?>
                    </div>
                <?php endif; ?>

                <div class="card card-dark shadow-sm">
                    <div class="card-header">
                        <h3 class="card-title">DOMICILIARIOS</h3>

                    </div>
                    <div class="card-body padding-0">
                        <div class="card-body table-responsive p-0" style="height: 59vh;">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Cedula</th>
                                        <th>Nombre</th>
                                        <th>Cantidad de Pedidos</th>
                                        <th>Fecha de Inicio</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($domiciliaries as $domiciliary) : ?>
                                        <tr>
                                            <td> <?= $domiciliary['id_domiciliary'] ?> </td>
                                            <td> <?= $domiciliary['name_domiciliary'] . '<br>' . $domiciliary['surname_domiciliary'] ?></td>
                                            <td class="text-center"><?= $domiciliary['quantity'] ?></td>
                                            <td><?= $domiciliary['datestart_domiciliary'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-1">
            </div>

        </div>
    </div>
</section>

<?= $this->endSection() ?>