<?php
include '../verifica-session.php';
include '../config.php';
include '../conexao.php';
include '../Acoes.php';

// if ($_SESSION['tipo'] == 'AdminDono') {
//     echo "<script>location.href='./paineladmin/index.php'</script>";
//     die();
// } else {
//     echo '<script type="text/javascript">window.location.href = "logout.php";
//     </script>';
// }

$custo = $acoes->calcularcusto('custo_final');
$custo_participacao = $acoes->calcularcusto('participacao');
$custo_rateio = $acoes->calcularcusto('custo_rateio');

$sql = "SELECT estado, COUNT(estado) AS sumx FROM clientes GROUP BY estado HAVING COUNT(estado) > 0 ORDER BY COUNT(estado) DESC";
$data = array();
$query = $bd->query($sql);
if ($query) {
    while ($r = $query->fetch(PDO::FETCH_OBJ)) {
        $data[] = $r;
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Master Clube - Sinistros</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">


</head>
<script>
</script>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <?php include 'headeradmin.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Início</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Inicío</a></li>
                            </ol>
                        </div>
                        <!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <div class="row" style="margin-right:0px !important;margin-left:0px !important;">
                <div class="col-md-12">
                    <div class="card card-success">
                        <div class="card-header">
                            <h5 class="card-title ">Informações Sinistro</h5>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <div class="btn-group">
                                </div>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <section class="content" style="width:100%;">
                                    <div class="container-fluid">
                                        <!-- Small boxes (Stat box) -->
                                        <div class="row">
                                            <div class="col-lg-3 col-6">
                                                <!-- small box -->
                                                <div class="small-box bg-info">
                                                    <div class="inner">
                                                        <h3><?php echo $acoes->contar('vistorias'); ?></h3>

                                                        <p>Espelhos Gerados</p>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="ion ion-bag"></i>
                                                    </div>
                                                    <a href="data.php" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
                                                </div>
                                            </div>
                                            <!-- ./col -->
                                            <div class="col-lg-3 col-6">
                                                <!-- small box -->
                                                <div class="small-box bg-success">
                                                    <div class="inner">
                                                        <h3>
                                                            <?php echo formata_dinheiro($custo) ?>
                                                            </sup></h3>

                                                        <p>Custo Total</p>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="ion ion-stats-bars"></i>
                                                    </div>
                                                    <a href="#" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
                                                </div>
                                            </div>
                                            <!-- ./col -->
                                            <div class="col-lg-3 col-6">
                                                <!-- small box -->
                                                <div class="small-box bg-warning">
                                                    <div class="inner">
                                                        <h3><?php echo formata_dinheiro($custo_participacao) ?></h3>

                                                        <p>Participações</p>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="ion ion-person-add"></i>
                                                    </div>
                                                    <a href="#" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
                                                </div>
                                            </div>
                                            <!-- ./col -->
                                            <div class="col-lg-3 col-6">
                                                <!-- small box -->
                                                <div class="small-box bg-danger">
                                                    <div class="inner">
                                                        <h3><?php echo formata_dinheiro($custo_rateio) ?></h3>

                                                        <p>Custo total Rateio</p>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="ion ion-pie-graph"></i>
                                                    </div>
                                                    <a href="#" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
                                                </div>
                                            </div>
                                            <!-- ./col -->
                                        </div>
                                        <!-- /.row -->
                                        <!-- Main row -->
                                        <div class="row">
                                            <!-- Left col -->
                                            <section class="col-lg-6 connectedSortable">
                                                <!-- Custom tabs (Charts with tabs)-->
                                                <div class="card card-info">
                                                    <div class="card-header">
                                                        <h3 class="card-title">
                                                            <i class="fas fa-chart-pie mr-1"></i>
                                                            Espelhos gerados mensalmente
                                                        </h3>
                                                        <div class="card-tools">
                                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                                <i class="fas fa-minus"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        </div>
                                                        <!-- <div class="card-tools">
                                        <ul class="nav nav-pills ml-auto">
                                            <li class="nav-item">
                                                <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                                            </li>
                                        </ul>
                                    </div> -->
                                                    </div><!-- /.card-header -->
                                                    <div class="card-body">
                                                        <div class="tab-content p-0">
                                                            <!-- Morris chart - Sales -->
                                                            <div class="chart tab-pane active" id="revenue-chart" style="position: relative; ">
                                                                <canvas id="revenue-chart-canvas" height="300" width="300"></canvas>
                                                            </div>
                                                            <div class="chart tab-pane" id="sales-chart2" style="position: relative;">
                                                                <canvas id="myChart2" width="400" height="400"></canvas>

                                                            </div>
                                                        </div>
                                                    </div><!-- /.card-body -->
                                                </div>
                                                <!-- /.card -->

                                                <!-- DIRECT CHAT -->
                                                <div class="card card-success">
                                                    <div class="card-header border-0">
                                                        <div class="d-flex justify-content-between">
                                                            <h3 class="card-title">Espelhos gerados diariamente</h3>
                                                            <div class="card-tools">
                                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                                    <i class="fas fa-minus"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                                    <i class="fas fa-times"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="d-flex">
                                                            <p class="ml-auto d-flex flex-column text-right">
                                                                <span class="text-success">
                                                                    <i class="fas fa-arrow-up"></i> 12.5%
                                                                </span>
                                                                <span class="text-muted">Desde a semana passada</span>
                                                            </p>
                                                        </div>
                                                        <!-- /.d-flex -->

                                                        <div class="position-relative mb-4">
                                                            <canvas id="visitors-chart" height="200"></canvas>
                                                        </div>

                                                        <div class="d-flex flex-row justify-content-end">
                                                            <span class="mr-2">
                                                                <i class="fas fa-square text-primary"></i> This Week
                                                            </span>

                                                            <span>
                                                                <i class="fas fa-square text-gray"></i> Last Week
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--/.direct-chat -->

                                                <!-- TO DO List -->

                                                <!-- /.card -->
                                            </section>
                                            <!-- /.Left col -->
                                            <!-- right col (We are only adding the ID to make the widgets sortable)-->
                                            <section class="col-lg-6 connectedSortable">

                                                <!-- Map card -->
                                                <div class="card card-warning">
                                                    <div class="card-header">
                                                        <h3 class="card-title">
                                                            <i class="fas fa-chart-pie mr-1"></i>
                                                            Espelhos por tipo de evento
                                                        </h3>
                                                        <div class="card-tools">
                                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                                <i class="fas fa-minus"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        </div>
                                                        <!-- <div class="card-tools">
                                        <ul class="nav nav-pills ml-auto">
                                            <li class="nav-item">
                                                <a class="nav-link active" href="#sales-chart" data-toggle="tab">Donut</a>
                                            </li>
                                        </ul>
                                    </div> -->
                                                    </div><!-- /.card-header -->
                                                    <div class="card-body">
                                                        <div class="tab-content p-0" style="justify-content: center !important; display: flex !important;">
                                                            <!-- Morris chart - Sales -->
                                                            <div class="chart tab-pane active" id="sales-chart" style="position: relative; height:300px !important; width:300px !important;">
                                                                <canvas id="myChart" width="400" height="400"></canvas>

                                                            </div>
                                                        </div>
                                                    </div><!-- /.card-body -->
                                                </div>
                                                <!-- /.card -->

                                                <!-- Map card -->
                                                <div class="card card-danger">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Quantidade por estado</h3>

                                                        <div class="card-tools">
                                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                                <i class="fas fa-minus"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="chart">
                                                            <canvas id="barChart" style="min-height: 250px; height: 250px; max-width: 100%;"></canvas>
                                                        </div>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>

                                                <!-- Calendar -->
                                                <!-- <div class="card bg-gradient-success">
                                <div class="card-header border-0">

                                    <h3 class="card-title">
                                        <i class="far fa-calendar-alt"></i>
                                        Calendário
                                    </h3>
                                     
                                    <div class="card-tools">
                                       
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                                                <i class="fas fa-bars"></i>
                                            </button>
                                            <div class="dropdown-menu" role="menu">
                                                <a href="#" class="dropdown-item">Add new event</a>
                                                <a href="#" class="dropdown-item">Clear events</a>
                                                <div class="dropdown-divider"></div>
                                                <a href="#" class="dropdown-item">View calendar</a>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                    
                                </div>
                                
                                <div class="card-body pt-0">
                                    
                                    <div id="calendar" style="width: 100%"></div>
                                </div>
                                
                            </div> -->
                                                <!-- /.card -->
                                            </section>
                                            <!-- right col -->
                                        </div>
                                        <!-- /.row (main row) -->
                                    </div><!-- /.container-fluid -->
                                </section>
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- ./card-body -->
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-3 col-6">
                                    <div class="description-block border-right">
                                        <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span>
                                        <h5 class="description-header">$35,210.43</h5>
                                        <span class="description-text">TOTAL REVENUE</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-3 col-6">
                                    <div class="description-block border-right">
                                        <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 0%</span>
                                        <h5 class="description-header">$10,390.90</h5>
                                        <span class="description-text">TOTAL COST</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-3 col-6">
                                    <div class="description-block border-right">
                                        <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 20%</span>
                                        <h5 class="description-header">$24,813.53</h5>
                                        <span class="description-text">TOTAL PROFIT</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-3 col-6">
                                    <div class="description-block">
                                        <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 18%</span>
                                        <h5 class="description-header">1200</h5>
                                        <span class="description-text">GOAL COMPLETIONS</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <div class="row" style="margin-right:0px !important;margin-left:0px !important;">
                <div class="col-md-12">
                    <div class="card collapsed-card">
                        <div class="card-header">
                            <h5 class="card-title">Informações Cadastro</h5>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <!--INSERIOR AQUI OS DADOS DO CADASTRO -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- ./card-body -->
                        
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- Main content -->

            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php include '../footer.php' ?>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="../plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="../plugins/sparklines/sparkline.js"></script>
    <script src="https://cdnjs.com/libraries/Chart.js"></script>
    <!-- JQVMap -->
    <script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="../plugins/jqvmap/maps/jquery.vmap.brazil.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="../plugins/moment/moment.min.js"></script>
    <script src="../plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="../plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="../dist/js/pages/dashboard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="../app.js"></script>
    <script src="../app2.js"></script>
    <script src="../app3.js"></script>
    <script src="../app4.js"></script>
    <script>
        var data = {
            <?php foreach ($data as $d) : ?> "<?php echo $estado; ?>": <?php echo $sumx; ?> // estados unidos
            <?php endforeach; ?>
        };

        $('#world-map3').vectorMap({
            map: 'brazil_br',
            backgroundColor: 'transparent',
            regionStyle: {
                initial: {
                    fill: 'rgba(255, 255, 255, 0.7)',
                    'fill-opacity': 1,
                    stroke: 'rgba(0,0,0,.9)',
                    'stroke-width': 1,
                    'stroke-opacity': 1
                }
            },
            series: {
                regions: [{
                    values: data,
                    scale: ['#ffffff', '#0154ad'],
                    normalizeFunction: 'polynomial'
                }]
            },
            onRegionTipShow: function(e, el, code) { // al seleccionar una region se muestra el valor que tengan en el array
                el.html(el.html() + ' (Poblacion: ' + data[code] + ')');
            }
        });
    </script>
    <script>
        $(function() {
            /* ChartJS
             * -------
             * Here we will create a few charts using ChartJS
             */

            //--------------
            //- AREA CHART -
            //--------------

            // Get context with jQuery - using jQuery's .get() method.
            var areaChartCanvas = $('#revenue-chart-canvas2').get(0).getContext('2d')

            var areaChartData = {
                labels: <?php echo json_encode($json); ?>,
                datasets: [{
                        label: "2020",
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        pointRadius: true,
                        pointColor: '#ff0000',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#ff0000',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: <?php echo json_encode($json2); ?>,
                    },
                    {
                        label: '2021',
                        backgroundColor: 'rgba(210, 214, 222, 1)',
                        borderColor: 'rgba(210, 214, 222, 1)',
                        pointRadius: true,
                        pointColor: ' #ff0000',
                        pointStrokeColor: '#c1c7d1',
                        pointHighlightFill: ' #ff0000',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data: <?php echo json_encode($json2); ?>,
                    },
                ]
            }

            var areaChartOptions = {
                maintainAspectRatio: false,
                responsive: true,
                legend: {
                    display: true
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false,
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            display: false,
                        }
                    }]
                }
            }

            // This will get the first returned node in the jQuery collection.
            var areaChart = new Chart(areaChartCanvas, {
                type: 'line',
                data: areaChartData,
                options: areaChartOptions
            })

            //-------------
            //- LINE CHART -
            //--------------
            var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
            var lineChartOptions = $.extend(true, {}, areaChartOptions)
            var lineChartData = $.extend(true, {}, areaChartData)
            lineChartData.datasets[0].fill = false;
            lineChartData.datasets[1].fill = false;
            lineChartOptions.datasetFill = false

            var lineChart = new Chart(lineChartCanvas, {
                type: 'line',
                data: lineChartData,
                options: lineChartOptions
            })

            //-------------
            //- DONUT CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var donutChartCanvas = $('#sales-chart-canvas').get(0).getContext('2d')
            var donutData = {
                labels: [
                    'Chrome',
                    'IE',
                    'FireFox',
                    'Safari',
                    'Opera',
                    'Navigator',
                ],
                datasets: [{
                    data: [654, 500, 400, 600, 300, 100],
                    backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                }]
            }
            var donutOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            var donutChart = new Chart(donutChartCanvas, {
                type: 'doughnut',
                data: donutData,
                options: donutOptions
            })

            //-------------
            //- PIE CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
            var pieData = donutData;
            var pieOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            var pieChart = new Chart(pieChartCanvas, {
                type: 'pie',
                data: pieData,
                options: pieOptions
            })

            //-------------
            //- BAR CHART -
            //-------------
            var barChartCanvas = $('#barChart').get(0).getContext('2d')
            var barChartData = $.extend(true, {}, areaChartData)
            var temp0 = areaChartData.datasets[0]
            var temp1 = areaChartData.datasets[1]
            barChartData.datasets[0] = temp1
            barChartData.datasets[1] = temp0

            var barChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false
            }

            var barChart = new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
            })

            //---------------------
            //- STACKED BAR CHART -
            //---------------------
            var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
            var stackedBarChartData = $.extend(true, {}, barChartData)

            var stackedBarChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    xAxes: [{
                        stacked: true,
                    }],
                    yAxes: [{
                        stacked: true
                    }]
                }
            }

            var stackedBarChart = new Chart(stackedBarChartCanvas, {
                type: 'bar',
                data: stackedBarChartData,
                options: stackedBarChartOptions
            })
        })
    </script>
    <script>
        var ctx = document.getElementById('myChart22').getContext('2d');
        var myDoughnutChart = new Chart(ctx, {
            type: 'doughnut',
            data: donutData,
            options: donutOptions,
            data: {
                labels: <?php echo json_encode($json); ?>,
                datasets: [{
                    data: [5, 5, 5, 5, 5],
                    backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],

                }]
            },
            options: {
                maintainAspectRatio: false,
                responsive: true,
            }
        });
        var donutChartCanvas = $('#sales-chart-canvas').get(0).getContext('2d')
        var donutData = {
            labels: [
                'Chrome',
                'IE',
                'FireFox',
                'Safari',
                'Opera',
                'Navigator',
            ],
            datasets: [{
                data: [654, 500, 400, 600, 300, 100],
                backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
            }]
        }
        var donutOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        var donutChart = new Chart(donutChartCanvas, {
            type: 'doughnut',
            data: donutData,
            options: donutOptions
        })
    </script>
</body>

</html>