<?= $this->extend('admin/structure/main_admin_view') ?>
<?= $this->section('title') ?> - Caja Diaria<?= $this->endSection() ?>
<?= $this->section('js') ?>
<?= $this->endSection() ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="content">
    <div class="container-fluid">
        <br>

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
        <?php endif;  ?>

        <div class="row">
            <div class="col-md-8">
                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text"></span>
                        <span style="font-size: 35px;" class="info-box-number"><?= $date ?></span>
                    </div>

                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Fecha:</h3>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url().route_to('validate_date_report_kathe') ?>" method="post">
                            <div class="row">
                                <div class="col-md-8">
                                    <input name="date" value="<?= $date ?>" type="date" class="form-control" placeholder="Fecha">
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-secondary">Buscar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">VENTAS</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-bordered table-hover text-nowrap">
                            <thead>
                                <tr>

                                    <th>Categor&iacute;a</th>
                                    

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($arrayCategories as $row) : ?>
                                    <tr>
                                        <td>
                                            <table class="table table-hover">
                                                <tbody>
                                                    <tr data-widget="expandable-table" aria-expanded="false">
                                                        <td>
                                                            <i class="fas fa-caret-right fa-fw"></i>
                                                            <?= $row['name_category'] . ' = ' . $row['sumatoria'] ?>
                                                        </td>
                                                    </tr>
                                                    <tr class="expandable-body d-none">
                                                        <td>
                                                            <div class="p-0" style="display: none;">
                                                                <table class="table table-hover">
                                                                    <tbody>
                                                                        <?php foreach ($row['products'] as $product) : ?>
                                                                            <tr>
                                                                                <td><?= $product['name_product'] ?></td>
                                                                                <td><?= $product['sumatoria'] ?></td>
                                                                            </tr>
                                                                        <?php endforeach; ?>

                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                        
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>

        </div>
    </div>
</section>
<?= $this->endSection() ?>