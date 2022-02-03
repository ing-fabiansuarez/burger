<?= $this->extend('admin/structure/main_admin_view') ?>
<?= $this->section('title') ?> - Cotizar Carne<?= $this->endSection() ?>
<?= $this->section('js') ?>
<?= $this->endSection() ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>



<?= $this->section('content') ?>

<section class="content">
    <br>
    <br>
    <div class="container">
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Cotizador de Carnes:</h3>
            </div>
            <div class="card-body">
                <form action="<?= base_url() . route_to('quote_meat') ?>" method="get">

                    <div class="row">

                        <div class="col-md-4">
                            <input name="number_burger" type="number" class="form-control" placeholder="Cantidad de hamburguesas por hacer">
                            <br>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-secondary">Calcular</button>
                            <br><br>
                        </div>
                        <?php if ($num_burgers != null) : ?>

                            <div class="col-md-4">
                                <h3><b><?= $num_burgers ?></b> hamburguesas, necesitan</h3>
                                <div class="info-box">
                                    <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">CARNE CHATA</span>
                                        <span class="info-box-number"><?= number_format((($num_burgers * 7.5) / 58), 2,) . ' Kgs' ?></span>
                                    </div>
                                </div>
                                <div class="info-box">
                                    <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">CARNE MORILLO</span>
                                        <span class="info-box-number"><?= number_format((($num_burgers * 2.5) / 58), 2) . ' Kgs' ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
                    </div>
                </form>
            </div>
        </div>
</section>
<?= $this->endSection() ?>