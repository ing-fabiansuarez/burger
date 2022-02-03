<div class="card">
    <div class="card-header header-list">
        <h3 class="card-title" style="color: #fff;"> <b> LOCAL</b></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body body-background">
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped projects">
                <thead>
                    <tr>
                        <th>Turno</th>
                        <th style="width: 10px;">Cant</th>
                        <th>N° Pedido</th>
                        <th>Detalle</th>
                        <th>Hora</th>
                        <th>Observaciones</th>
                        <th>Precio</th>
                        <th>Acci&oacute;n</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dailyOrdersLocal as $order) : //dd($dailyorders); 
                        // $order->durationTime();
                    ?>

                        <tr <?php if ($refOrder == $order->id_order) : ?> class="bg-impreso" <?php endif ?>>

                            <td>
                                <small style="font-size: 50px;"><?= $order->turnmachine_order ?></small>
                            </td>
                            <td>
                                <?= count($list_products = $order->getListofProducts()) ?>
                            </td>
                            <td>
                                <a href="<?= base_url() . route_to('view_load_order', $order->id_order) ?>">
                                    <?= $order->id_order . '<br><b>' . $order->getNameClient() . '</b>' ?>
                                </a>
                                <br><b><?= $order->getNamePaymentMethod() ?></b>
                            </td>
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
                                                                    <td><img alt="Avatar" class="table-avatar" src="<?= base_url() . route_to('img-menu') . '/' . $item['category_id_category'] . '/' . $item['image_product'] ?>"></td>
                                                                    <td><?= $item['quantity_detailorder'] . ' x ' . $item['name_product'] ?></td>
                                                                    <td><?= '$ ' . number_format($order->getPricesOfDetail($item['id_detailorder'])['total']) ?></td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php if ($refOrder == $order->id_order && $order->state_id_state == 2) :
                                    echo '<br>' . $order->durationTime();
                                endif ?>
                            </td>
                            <td>
                                <?= $order->hour_order . '<br>' . $order->date_order . '<br>' . $order->getNameEmployee() ?>

                            </td>
                            <td style="max-width: 100px;"><?= $order->observations_order ?></td>
                            <td><?= '$ ' . number_format($order->getTotalWthitOutDomicilio()) . '<br>';
                                if ($refOrder == $order->id_order && $order->state_id_state == 2) :
                                    echo 'PAGO CON $ ' . number_format($pago_con) . '<br>VUELTOS $ ' . number_format($pago_con - $order->getTotalWthitOutDomicilio());
                                endif; ?>
                            </td>
                            <td class="project-actions text-right">

                                <?php if ($order->state_id_state == 1 or $order->state_id_state == 2) : ?>
                                    <a class="btn btn-info btn-sm" href="<?= base_url() . route_to('chage_state', 3, $order->id_order) ?>">
                                        <i class="fas fa-arrow-right">
                                        </i>
                                        Despachar
                                    </a>
                                <?php endif; ?>

                            </td>
                            <td>
                                <?php if ($order->isPrint() == false) : ?>
                                    <form action="<?= base_url() . route_to('print_order') ?>" method="post">
                                        <input type="hidden" name="reference" value="<?= $order->id_order ?>">
                                        <button type="submit" class="btn btn-primary float-right" style="margin-right: 5px; margin-bottom: 5px;">
                                            <i class="fas fa-download"></i>Imprimir
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>

    </div>
    <!-- /.card-body -->
</div>
<div class="card">
    <div class="card-header header-list">
        <h3 class="card-title" style="color: #fff;"> <b> DOMICILIO</b></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body body-background">
        <div class="table-responsive">
            <table id="example2" class="table table-striped projects">
                <thead>
                    <tr>
                        <th>Turno</th>
                        <th style="width: 10px;">Cant</th>
                        <th>N° Pedido</th>
                        <th>Detalle</th>
                        <th>Hora</th>
                        <th>Observaciones</th>
                        <th>Precio</th>
                        <th>Acci&oacute;n</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dailyOrdersDomicilio as $order) : //dd($dailyorders); 
                    ?>
                        <tr <?php if ($refOrder == $order->id_order) : ?> class="bg-impreso" <?php endif ?>>
                            <td>
                                <small style="font-size: 50px;"><?= $order->turnmachine_order ?></small>
                            </td>
                            <td>
                                <?= count($list_products = $order->getListofProducts()) ?>
                            </td>
                            <td>
                                <a href="<?= base_url() . route_to('view_load_order', $order->id_order) ?>">
                                    <?= $order->id_order . '<br><b>' . $order->getNameClient() . '</b>'   ?>
                                </a>
                                <br><b><?= $order->getNamePaymentMethod() ?></b>
                            </td>
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
                                                                    <td><img alt="Avatar" class="table-avatar" src="<?= base_url() . route_to('img-menu') . '/' . $item['category_id_category'] . '/' . $item['image_product'] ?>"></td>
                                                                    <td><?= $item['quantity_detailorder'] . ' x ' . $item['name_product'] ?></td>
                                                                    <td><?= '$ ' . number_format($order->getPricesOfDetail($item['id_detailorder'])['total']) ?></td>
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
                                <?= $order->hour_order . '<br>' . $order->date_order . '<br>' . $order->getNameEmployee() ?>
                            </td>
                            <td style="max-width: 100px;"><?= $order->observations_order ?></td>
                            <td><?= '$ ' . number_format($order->getTotalWthitOutDomicilio()) . '<br>';
                                if ($refOrder == $order->id_order && $order->state_id_state == 2) :
                                    echo 'PAGO CON $ ' . number_format($pago_con) . '<br>VUELTOS $ ' . number_format($pago_con - $order->getTotalWthitOutDomicilio());
                                endif; ?>
                            </td>
                            <td class="project-actions text-right">

                                <?php if ($order->state_id_state == 1 or $order->state_id_state == 2) : ?>
                                    <a class="btn btn-info btn-sm" href="<?= base_url() . route_to('chage_state', 3, $order->id_order) ?>">
                                        <i class="fas fa-arrow-right">
                                        </i>
                                        Despachar
                                    </a>
                                <?php endif; ?>

                            </td>
                            <td>
                                <?php if ($order->isPrint() == false) : ?>
                                    <form action="<?= base_url() . route_to('print_order') ?>" method="post">
                                        <input type="hidden" name="reference" value="<?= $order->id_order ?>">
                                        <button type="submit" class="btn btn-primary float-right" style="margin-right: 5px; margin-bottom: 5px;">
                                            <i class="fas fa-download"></i>Imprimir
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>

            </table>
        </div>

    </div>
    <!-- /.card-body -->
</div>