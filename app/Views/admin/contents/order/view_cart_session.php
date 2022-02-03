<table class="table table-hover text-nowrap">
    <thead>
        <tr>
            <th>Producto</th>
            <th>Catidad</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php $total = 0;
        foreach ($list_order as $item_list) : ?>
            <tr>

                <td class="text-center">
                    <img src="<?= base_url() . route_to('img-menu') . '/' . $item_list['category_id_category'] . '/' . $item_list['image_product'] ?>" alt="" class="img-fluid prodimg">
                </td>
                <td class="text-center">
                    <?= $item_list['quantity'] ?>
                </td>
                <td>
                    <strong><?= $item_list['name_product'] ?></strong><br>

                    <?php if (empty($item_list['whitout_ingredients'])) :
                        $discounts = 0;
                    else : $discounts = 0;
                        foreach ($item_list['whitout_ingredients'] as $without) :

                            $discounts = $discounts + ($without['price_ingredient'] * $item_list['quantity']);
                    ?>
                            Sin <?= $without['name_ingredient'] . ' - $ ' . number_format($without['price_ingredient']) . '(C/U)<br>' ?>

                    <?php endforeach;
                    endif; ?>

                    <?php if (empty($item_list['whit_additions'])) :
                        $surcharges = 0;
                    else : $surcharges = 0;
                        echo '<b>Adiciones:</b> <br>';
                        foreach ($item_list['whit_additions'] as $addition) :
                            $surcharges = $surcharges + ($addition['price_addition'] * $item_list['quantity']);
                    ?>
                            <?= $addition['name_addition'] . ' + $ ' . number_format($addition['price_addition']) . '(C/U)<br>' ?>

                    <?php endforeach;
                    endif; ?>
                </td>
                <td class="float-right">
                    <?= '$ ' . number_format(($item_list['price_product'] * $item_list['quantity']) - $discounts + $surcharges) ?>
                    <?php $total = $total + (($item_list['price_product'] * $item_list['quantity']) - $discounts + $surcharges) ?>
                </td>
                <td>
                    <form action="<?= base_url() . route_to('deleteproductlistorder') ?>" method="post">
                        <input type="hidden" name="id" value="<?= $item_list['id_list_order'] ?>">
                        <button type="submit" style="border-color: transparent; background: transparent;">
                            <i class="far fa-times-circle action-product icon-green"></i>
                        </button>
                    </form>
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
                <strong> <?= '$ ' . number_format($total) ?></strong>
            </td>
            <td>
            </td>
        </tr>
    </tbody>
</table>