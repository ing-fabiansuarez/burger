<?= $this->extend('admin/structure/main_admin_view') ?>
<?= $this->section('title') ?> - Pedido<?= $this->endSection() ?>
<?= $this->section('js') ?>
<?= $this->endSection() ?>
<?= $this->section('css') ?>
<?= $this->endSection() ?>



<?= $this->section('content') ?>

<section class="content">
    <div class="container-fluid">
        <br>
        <div class="row">
            <?php if (!empty(session('error'))) : ?>
                <div class="alert alert-danger alert-dismissible col-md-12">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-ban"></i> <?= session('error.title') ?></h5>
                    <?= session('error.body') ?>
                </div>
            <?php endif ?>
            <div class="col-md-1"></div>
            <div class="col-md-10">

                <div class="card card-success shadow-sm">
                    <div class="card-header">
                        <h3 class="card-title"><?= $order->id_order . '<br>' . $client['name_client'] . ' ' . $client['surname_client'] ?><br><?= $order->getState()['name_state'] ?> <br><?= $order->getNamePaymentMethod()  ?></h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-4">
                                <?php if (!empty(session('msg'))) : ?>
                                    <div class="alert alert-success alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <h5><i class="icon fas fa-check"></i> <?= session('msg.title') ?></h5>
                                        <?= session('msg.body') ?>
                                    </div>
                                <?php endif ?>
                                <div class="card card-dark shadow-sm">
                                    <div class="card-header">
                                        TURNO: <b><?= $order->turnmachine_order ?></b><br>
                                    </div>
                                    <div class="card-body">
                                        <b>Fecha:</b> <?= $order->date_order . ' ' . $order->hour_order ?>
                                        <br><b>Tipo de envio:</b> <?= $typeshipping['name_typeshipping'] ?>
                                        <br><b>Creado por:</b> <?= $order->getNameEmployee() ?>
                                    </div>
                                </div>
                                <?php if (isset($domi)) { ?>
                                    <div class="card card-dark shadow-sm">
                                        <div class="card-header">
                                            Domicilio<br>
                                        </div>
                                        <div class="card-body">

                                            <b>Direcci&oacute;n:</b> <?= $domi['address_domicilio'] ?> <br>
                                            <b>Barrio:</b> <?= $domi['neighborhood_domicilio'] ?><br>
                                            <b>Precio:</b> <?= $domi['price_domicilio'] ?><br>
                                            <b>WhatsApp:</b> <?= $domi['whatsapp_domicilio'] ?><br>
                                            <b>Observacion de Domicilio:</b> <?= $domi['observation_domicilio'] ?>
                                        </div>
                                    </div>
                                <?php } ?>

                                <div class="card card-dark shadow-sm">
                                    <div class="card-header">
                                        Observaciones:
                                    </div>
                                    <div class="card-body">
                                        <b>Observaciones de Cocina: </b> <?= $order->observations_order ?>
                                    </div>
                                </div>
                                <div class="card card-dark shadow-sm">
                                    <div class="card-header">
                                        Cambiar medio de pago
                                    </div>
                                    <div class="card-body">
                                        <b>Medio de pago Actual:</b> <?= $order->getNamePaymentMethod() ?>
                                        <br>
                                        <form action="<?= base_url() . route_to('change_method_payment') ?>" method="post">
                                            <div class="form-group">
                                                <label>Cambiar por</label>
                                                <input type="hidden" name="id_order" value="<?= $order->id_order ?>">
                                                <select name="method_payment" class="custom-select">
                                                    <?php foreach ($methodpayments as $payment) : ?>
                                                        <option value="<?= $payment['id_paymentmethod'] ?>"><?= $payment['name_paymentmethod'] ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-block btn-primary btn-sm">Guardar Cambios</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 ">
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>Producto</th>
                                                <th>Catidad</th>
                                                <th>Nombre</th>
                                                <th>Precio</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $total = 0;
                                            foreach ($list_of_products as $item_list) :
                                            ?>
                                                <tr>

                                                    <td class="text-center">
                                                        <img src="<?= base_url() . route_to('img-menu') . '/' . $item_list['category_id_category'] . '/' . $item_list['image_product'] ?>" alt="" class="img-fluid prodimg">
                                                    </td>
                                                    <td class="text-center">
                                                        <?= $item_list['quantity_detailorder'] ?>
                                                    </td>
                                                    <td>
                                                        <strong><?= $item_list['name_product'] ?></strong><br>
                                                        <?php //dd($item_list);
                                                        if (empty($item_list['whitout'])) :
                                                        else :
                                                            foreach ($item_list['whitout'] as $without) :
                                                                echo $without['name_ingredient'] . ' - $ ' . number_format($without['discount_hasnot']) . '(C/U)<br>';
                                                            endforeach;
                                                        endif;
                                                        if (empty($item_list['with'])) :
                                                        else :
                                                            echo '<b>Adiciones:</b><br>';
                                                            foreach ($item_list['with'] as $with) :
                                                                echo $with['name_addition'] . ' - $ ' . number_format($with['price_more_additions']) . '(C/U)<br>';
                                                            endforeach;
                                                        endif; ?>

                                                    </td>
                                                    <td class="float-right">
                                                        <?= '$ ' . number_format($order->getPricesOfDetail($item_list['id_detailorder'])['total']) ?>
                                                    </td>

                                                </tr>
                                            <?php endforeach; ?>
                                            <tr>
                                                <td>
                                                </td>
                                                <td>
                                                    <strong>TOTAL</strong>
                                                </td>
                                                <td>
                                                </td>
                                                <td class="float-right">
                                                    <strong> <?= '$ ' . number_format($order->getTotalWthitOutDomicilio()) ?></strong>
                                                </td>

                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>