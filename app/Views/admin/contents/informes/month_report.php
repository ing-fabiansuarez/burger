<?= $this->extend('admin/structure/main_admin_view') ?>
<?= $this->section('title') ?> - Reporte Mensual<?= $this->endSection() ?>
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

            </div>
            <div class="col-md-4">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Mes:</h3>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url() . route_to('validate_date') ?>" method="post">
                            <div class="row">
                                <div class="col-md-8">

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
                                <th>Nombre</th>
                                <th>Hora</th>
                                <th>Elaborado por</th>
                                <th>Total</th>
                                <th>Tipo de Env&iacute;o</th>
                                <th>Medio de Pago</th>
                                <th>Estado</th>
                                <th>Turno</th>
                                <th>N° Factura</th>
                                <th>Discriminaci&oacute;n</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($list_orders as $order) : ?>

                                <tr>
                                    <td><a href="<?= base_url() . route_to('view_load_order', $order->id_order) ?>"><?= $order->id_order  ?></a></td>
                                    <td><?= $order->getNameClient() ?></td>

                                    <td>
                                        <?= $order->date_order . ' <br>' .  $order->hour_order  ?>
                                    </td>
                                    <td>
                                        <?= $order->getNameEmployee() ?>
                                    </td>
                                    <td><?= $order->getTotalWthitOutDomicilio() ?></td>
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
                                    <td><?= $order->getNamePaymentMethod() ?></td>
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
                                    <td>
                                        <?php foreach ($order->getListofProducts() as $item) : ?>
                                            <?= '* ' . $item['quantity_detailorder'] . ' x ' . $item['name_product'] . ' ($' . number_format($item['priceunit_detailorder'] * $item['quantity_detailorder']) . '). <br>' ?>
                                        <?php endforeach; ?>
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