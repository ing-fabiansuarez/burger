<?= $this->extend('admin/structure/main_admin_view') ?>
<?= $this->section('title') ?> - Caja Diaria<?= $this->endSection() ?>
<?= $this->section('js') ?>
<script src="<?= base_url() ?>/public/admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/public/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/public/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>/public/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/public/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url() ?>/public/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/public/admin/plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url() ?>/public/admin/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url() ?>/public/admin/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url() ?>/public/admin/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url() ?>/public/admin/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url() ?>/public/admin/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });

    });
</script>
<?= $this->endSection() ?>
<?= $this->section('css') ?>
<link rel="stylesheet" href="<?= base_url() ?>/public/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url() ?>/public/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url() ?>/public/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<?= $this->endSection() ?>



<?= $this->section('content') ?>

<section class="content">
    <div class="container-fluid">
        <br>
        <h1 class="h1reportdaily">REPORTE DIARIO</h1>
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
                <h2><?= $date ?></h2>
            </div>
            <div class="col-md-4">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Fecha:</h3>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url() . route_to('validate_date') ?>" method="post">
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
            <div class="col-md-12">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><sup style="font-size: 20px">$</sup> <?= number_format($info['totalSales']) ?></h3>

                        <p>VENTA DIARIA <b> <?= date("Y-m-d"); ?></b></p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>

                </div>
            </div>
            <!-- <div class="col-md-5">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><sup style="font-size: 20px">$</sup> <?= number_format($info['totalDomis']) ?></h3>
                        <p>DINERO DE DOMICILIOS: <b> <?= date("Y-m-d"); ?></b></p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                </div>
            </div> -->
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-store"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Local - <?= $info['quantityOrdersLocal'] ?></span>
                        <span class="info-box-number">$ <?= number_format($info['moneyOrdersLocal']) ?></span>

                    </div>

                </div>
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-motorcycle"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Domicilios - <?= $info['quantityOrdersDomis'] ?></span>
                        <span class="info-box-number">$ <?= number_format($info['moneyOrdersDomis']) ?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Ventas por Trabajor:</h3>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Cedula</th>
                                    <th>Nombre</th>
                                    <th>Efectivo</th>
                                    <th>Datafono</th>
                                    <th>Transf.</th>
                                    <th>Ventas Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($arrayEmployees as $employee) :
                                    if ($employee['total'] != 0) :
                                ?>
                                        <tr>
                                            <td><?= $employee['id_employee'] ?></td>
                                            <td><?= $employee['name_employee'] . ' ' . $employee['surname_employee'] ?></td>
                                            <td><?= '$ ' . number_format($employee['efectivo']) ?></td>
                                            <td><?= '$ ' . number_format($employee['datafono']) ?></td>
                                            <td><?= '$ ' . number_format($employee['transferencia']) ?></td>
                                            <td><?= '$ ' . number_format($employee['total']) ?></td>
                                        </tr>
                                <?php endif;
                                endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <!--   <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-trash-alt"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Deshabilitados - <?= $info['quantityOrdersDisabled'] ?></span>
                        <span class="info-box-number">$ <?= number_format($info['moneyOrdersDisabled']) ?></span>
                    </div>
                  
                </div> -->
            </div>
        </div>

        <div class="row">
            <div class="card" style="width: 100%;">
                <div class="card-header header-list">
                    <h3 class="card-title" style="color: #fff;"> <b> LISTA DE PEDIDOS</b></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body body-background">
                    <table id="example1" class="table table-bordered table-striped projects">
                        <thead>
                            <tr>

                                <th>N° Pedido</th>
                                <th>Detalle</th>
                                <th>Hora</th>
                                <th>Total</th>
                                <th>Tipo de Env&iacute;o</th>
                                <th>Medio de Pago</th>
                                <th>Estado</th>
                                <th>Turno</th>
                                <th>Consecutivo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($list_orders as $order) : ?>

                                <tr>
                                    <td><a href="<?= base_url() . route_to('view_load_order', $order->id_order) ?>"><?= '<b>' . $order->id_order . '</b><br>' . $order->getNameClient() ?></a></td>
                                    <td>
                                        <table class="table table-hover">
                                            <tbody>
                                                <tr data-widget="expandable-table" aria-expanded="false">
                                                    <td>
                                                        <i class="fas fa-caret-right fa-fw"></i>
                                                        Productos
                                                    </td>
                                                </tr>
                                                <tr class="expandable-body">
                                                    <td>
                                                        <div class="p-0">
                                                            <table class="table table-hover">
                                                                <tbody>
                                                                    <?php foreach ($order->getListofProducts() as $item) : ?>
                                                                        <tr>
                                                                            <td><?= $item['quantity_detailorder'] . ' x ' . $item['name_product'] ?></td>
                                                                            <td><?= '$' . number_format($item['priceunit_detailorder'] * $item['quantity_detailorder']) ?></td>
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
                                    <td>
                                        <?= $order->hour_order . '<br>' . $order->date_order . '<br><b>' . $order->getNameEmployee() . '</b>' ?>
                                    </td>
                                    <td><?= '$ ' . number_format($order->getTotalWthitOutDomicilio()) ?></td>
                                    <td><span class="badge <?php switch ($order->getTypeofShipping()['id_typeshipping']) {
                                                                case 1:
                                                                    echo 'bg-warning';
                                                                    break;
                                                                case 2:
                                                                    echo 'bg-primary';
                                                                    break;
                                                            }
                                                            ?>"><?= $order->getTypeofShipping()['name_typeshipping'] ?></span>
                                    </td>
                                    <td>
                                        <?= $order->getNamePaymentMethod() ?>
                                    </td>
                                    <td>
                                        <span class="badge <?php switch ($order->getState()['id_state']) {
                                                                case 1:
                                                                    echo 'badge-info';
                                                                    break;
                                                                case 2:
                                                                    echo 'badge-secondary';
                                                                    break;
                                                                case 3:
                                                                    echo 'badge-success';
                                                                    break;
                                                                case 4:
                                                                    echo 'badge-danger';
                                                                    break;
                                                            }
                                                            ?>"><?= $order->getState()['name_state'] ?></span>
                                    </td>
                                    <td>
                                        <?= $order->turnmachine_order ?>
                                    </td>
                                    <td>
                                        <?= $order->consecutive_order ?>
                                    </td>
                                </tr>


                            <?php endforeach; ?>

                        </tbody>

                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>

</section>
<?= $this->endSection() ?>