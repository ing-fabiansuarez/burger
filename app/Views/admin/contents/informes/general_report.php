<?= $this->extend('admin/structure/main_admin_view') ?>
<?= $this->section('title') ?> - Reporte General<?= $this->endSection() ?>
<?= $this->section('js') ?>
<!-- RENGE DATE -->
<!-- Select2 -->
<script src="<?= base_url() ?>/public/admin/plugins/select2/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="<?= base_url() ?>/public/admin/plugins/moment/moment.min.js"></script>
<script src="<?= base_url() ?>/public/admin/plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->
<script src="<?= base_url() ?>/public/admin/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url() ?>/public/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>


<script src="<?= base_url() ?>/public/admin/plugins/chart.js/Chart.min.js"></script>
<script>
    $(function() {
        //Date range picker
        $('#reservation').daterangepicker({
            locale: {
                format: 'YYYY/MM/DD'
            }
        })
    })
</script>
<script>
    $(function() {
       
        "use strict";
        

        var ticksStyle = {
            fontColor: "#495057",
            fontStyle: "bold",
        };

        var mode = "index";
        var intersect = true;

        var $salesChart = $("#sales-chart");
        // eslint-disable-next-line no-unused-vars
        var salesChart = new Chart($salesChart, {
            type: "line",
            data: {
                labels: [<?= $sales_array['cadena_x'] ?>],
                datasets: [{
                    backgroundColor: "#d1e2b5",
                    borderColor: "#76b119",
                    data: [<?= $sales_array['cadena_y'] ?>],
                }, ],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    mode: mode,
                    intersect: intersect,
                },
                hover: {
                    mode: mode,
                    intersect: intersect,
                },
                legend: {
                    display: false,
                },
                scales: {
                    yAxes: [{
                        // display: false,
                        gridLines: {
                            display: true,
                            lineWidth: "4px",
                            color: "rgba(0, 0, 0, .2)",
                            zeroLineColor: "transparent",
                        },
                        ticks: $.extend({
                                beginAtZero: true,

                                // Include a dollar sign in the ticks
                                callback: function(value) {
                                    if (value >= 1000) {
                                        value /= 1000;
                                        value += "k";
                                    }

                                    return value;
                                },
                            },
                            ticksStyle
                        ),
                    }, ],
                    xAxes: [{
                        display: true,
                        gridLines: {
                            display: false,
                        },
                        ticks: ticksStyle,
                    }, ],
                },
            },
        });

        <?php $contador = 1;
        foreach ($array_to_grafic as $infografic) : ?>

            var $salesChart = $("#sales-chart<?= $contador ?>");
            // eslint-disable-next-line no-unused-vars
            var salesChart = new Chart($salesChart, {
                type: "bar",
                data: {
                    labels: [<?= $infografic['cadenaproducts'] ?>],
                    datasets: [{
                        backgroundColor: "#76b119",
                        borderColor: "#76b119",
                        data: [<?= $infografic['cadenaquantities'] ?>],
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        mode: mode,
                        intersect: intersect,
                    },
                    hover: {
                        mode: mode,
                        intersect: intersect,
                    },
                    legend: {
                        display: false,
                    },
                    scales: {
                        yAxes: [{
                            // display: false,
                            gridLines: {
                                display: true,
                                lineWidth: "4px",
                                color: "rgba(0, 0, 0, .2)",
                                zeroLineColor: "transparent",
                            },
                            ticks: $.extend({
                                    beginAtZero: true,

                                    // Include a dollar sign in the ticks
                                    callback: function(value) {
                                        if (value >= 1000) {
                                            value /= 1000;
                                            value += "k";
                                        }

                                        return value;
                                    },
                                },
                                ticksStyle
                            ),
                        }, ],
                        xAxes: [{
                            display: true,
                            gridLines: {
                                display: false,
                            },
                            ticks: ticksStyle,
                        }, ],
                    },
                },
            });

        <?php $contador += 1;
        endforeach; ?>

    });
</script>

<?= $this->endSection() ?>
<?= $this->section('css') ?>
<!-- daterange picker -->
<link rel="stylesheet" href="<?= base_url() ?>/public/admin/plugins/daterangepicker/daterangepicker.css">

<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="content">
    <div class="container-fluid">
        <br>
        <h1 class="h1reportdaily">REPORTE ENTRE FECHAS</h1>
        <div class="row">
            <div class="col-md-6">
                <form action="<?= base_url() . route_to('validateformdaterange') ?>" method="post">
                    <div class="form-group">
                        <label>Rango de fechas:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="far fa-calendar-alt"></i>
                                </span>
                            </div>
                            <input name="dates" type="text" class="form-control float-right" id="reservation" value="2021/07/20 - 2021/08/25">

                            <input type="submit" value="Buscar">

                        </div>
                        <!-- /.input group -->
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">VENTAS</h3>
                            <a href="javascript:void(0);">Reporte de Ventas</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex">
                            <p class="d-flex flex-column">
                                <span class="text-bold text-lg"><?= '$ ' . number_format($sales_array['totalSalesBetweenDates']) ?></span>
                                <span>Ventas entre fechas: <?= $initial_date . ' <b>a</b> ' . $final_date ?></span>
                            </p>
                            <p class="ml-auto d-flex flex-column text-right">
                                <span class="text-success">
                                    <i class="fas fa-arrow-up"></i> 33.1%
                                </span>
                                <span class="text-muted">Since last month</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->

                        <div class="position-relative mb-4">
                            <canvas id="sales-chart" height="300"></canvas>
                        </div>

                        <div class="d-flex flex-row justify-content-end">
                            <span class="mr-2">
                                Ventas - Solo se toman en cuenta los pedidos despachados, no incluye los deshabilitados, ni creados, ni en cocina
                            </span>
                        </div>
                    </div>

                </div>
                <!-- /.col -->
            </div>


        </div>
        <div class="row">

            <?php $contador = 1;

            foreach ($array_to_grafic as $infografic) : ?>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title"><?= $infografic['name_category'] ?></h3>
                                <a href="javascript:void(0);">PeRa Burger</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <p class="d-flex flex-column">
                                    <span class="text-bold text-lg"><?= 'CANTIDAD DE PRODUCTOS VENDIDOS: ' . $infografic['totalProductsForCategory'] ?></span>
                                    <span>Cantidad</span>
                                </p>
                                <p class="ml-auto d-flex flex-column text-right">

                                    <span class="text-muted"><?= $initial_date . ' <b>a</b> ' . $final_date ?></span>
                                </p>
                            </div>
                            <!-- /.d-flex -->
                            <div class="position-relative mb-4">
                                <canvas id="sales-chart<?= $contador ?>" height="200"></canvas>
                            </div>

                            <div class="d-flex flex-row justify-content-end">
                                <span class="mr-2">
                                    Productos - Solo se toman en cuenta los pedidos despachados, no incluye los deshabilitados, ni creados, ni en cocina
                                </span>


                            </div>
                        </div>
                    </div>
                </div>
            <?php $contador += 1;
            endforeach; ?>
        </div>

</section>
<?= $this->endSection() ?>