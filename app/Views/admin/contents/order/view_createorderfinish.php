<?= $this->extend('admin/structure/main_admin_view') ?>
<?= $this->section('title') ?> - Nuevo Pedido<?= $this->endSection() ?>
<?= $this->section('js') ?>
<script src="<?= base_url() ?>/public/admin/dist/js/ajax_typeshipping.js"></script>

<?= $this->endSection() ?>


<?= $this->section('content') ?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Crear Nuevo Pedido</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                    <li class="breadcrumb-item active">Pedido</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-6">

                <div class="card card-dark shadow-sm">
                    <div class="card-header">
                        <h3 class="card-title">PASO 2: LISTA DEL PEDIDO</h3>

                    </div>
                    <div class="card-body padding-0">
                        <?php if (empty($list_order)) { ?>

                        <?php } else { ?>
                            <div class="card-body table-responsive p-0" style="height: 59vh;">
                                <?= $this->include('admin/contents/order/view_cart_session') ?>
                            </div>
                        <?php } ?>
                        <a href="<?= base_url() . route_to('view_createorder') ?>">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">
                                    ATRAS
                                </button>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">

                <div class="card card-success shadow-sm">
                    <div class="card-header">
                        <h3 class="card-title">PASO 3: INFORMACION DEL PEDIDO</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url() . route_to('create_order') ?>" method="post">
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label>Tipo</label>
                                        <select name="typeshipping" id="typeshipping" class="form-control">
                                            <option value="2">Local</option>
                                            <option value="3">Esperan para llevan - Domicilio sin dirección</option>
                                            <option value="1">Domicilio con dirección</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Medio de pago</label>
                                        <select name="payment_method" class="form-control" required>
                                            <option value="">Medio de pago*</option>
                                            <option value="1">EFETIVO</option>
                                            <option value="2">DATAFONO</option>
                                            <option value="3">TRANSFERENCIA</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="form-typeshipping">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<?= $this->endSection() ?>