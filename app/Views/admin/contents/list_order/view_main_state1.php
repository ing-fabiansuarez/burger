<?= $this->extend('admin/structure/main_admin_view') ?>
<?= $this->section('title') ?> - Lista de Pedidos<?= $this->endSection() ?>
<?= $this->section('js') ?>

<?= $this->endSection() ?>
<?= $this->section('css') ?>

<?= $this->endSection() ?>



<?= $this->section('content') ?>

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

<div class="card card-primary card-tabs">
    <div class="card-header p-0 pt-1">
        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
            <li class="pt-2 px-3">
                <h3 class="card-title">ESTADOS</h3>
            </li>
            <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Por pasar a la cocina</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() . route_to('view_list_order', 2, $date) ?>">Preparaci&oacute;n</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() . route_to('view_list_order', 3, $date) ?>">Despachado</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() . route_to('view_list_order', 4, $date) ?>">Deshabilitado</a>
            </li>

        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="custom-tabs-one-tabContent">
            <div class="tab-pane fade active show" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                <?= $this->include('admin/contents/list_order/list_state') ?>
            </div>
        </div>
    </div>
    <!-- /.card -->
</div>
<?= $this->endSection() ?>