<?php
include '../../verifica-session.php';
include '../../config.php';
include '../../conexao.php';
include '../../Acoes.php';

$paginaLink = basename($_SERVER['SCRIPT_NAME']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Master Clube - Sinsitro</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="../../plugins/select2/css/select2.css">
    <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <style>
        /* .card {
            box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);
            margin-bottom: 1rem;
        }

        .card {
            position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #ffffff;
            background-clip: border-box;
            border: 0 solid rgba(0, 0, 0, 0.125);
            border-radius: 0.25rem;
        } */

        .breadcrumb {
            background-color: #fff;
            padding: 0 !important;
            margin-bottom: 0px !important;
            /* border-radius: 0.25rem; */
        }

        .button-voltar {
            height: 23px;
            padding-top: 0px !important;
            padding-bottom: 5px !important;
            margin-right: 15px;
        }

        .btn-success {
            color: #ffffff;
            background-color: #28a745;
            border-color: #28a745;
            box-shadow: none;
        }

        .breadcrumb-item.active {
            color: #6c757d;
        }

        .text-sm .btn {
            font-size: 0.875rem !important;
        }

        .text-dark {
            color: #343a40 !important;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <?php include '../headeradmin.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <!-- <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-12 breadcumb">
                            <h1 class="text-left text-breadcumb">Cadastrar Equipamento</h1>
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Início</a></li>
                                <li class="breadcrumb-item active">Cadastrar equipamento</li>

                            </ol>
                        </div>
                    </div>
                </div>
            </section> -->

            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="card-header">

                    <div class="row">
                        <div class="card-body">
                            <div class="form-group">
                                <span class="input-group-text"><?php echo $_SESSION['nome_admin']; ?></span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <span class="input-group-text"><?php echo $_SESSION['email']; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="padding:20px;">
                    <div>
                        <!-- <div class="card-header d-flex">
                                <div class="col-md-6">
                                    <h3 class="card-title">Dados do associado</h3>
                                </div>
                                <div class="col-md-6 float-end">
                                    <input disabled type="date" name="data" value="<?php echo date('Y-m-d'); ?>" />
                                </div>
                            </div> -->


                        <form action="" method="post" enctype="multipart/form-data">

                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h6 class="m-0 text-dark"><i class="fa fa-database"></i> Novo Plano</h6>
                                        </div><!-- /.col -->
                                        <div class="col-sm-6">
                                            <ol class="breadcrumb float-sm-right">
                                                <a href="/empresas" class="btn btn-success button-voltar"><i class="fa fa-arrow-alt-circle-left"></i> Voltar</a>
                                                <li class="breadcrumb-item"><a href="/inicio">Início</a></li>
                                                <li class="breadcrumb-item active">Novo Plano</li>
                                            </ol>
                                        </div><!-- /.col -->
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="name">Nome</label>
                                                <input type="text" class="form-control cnpj" id="name" name="name" value="" required="">
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label for="description">Descrição</label>
                                                <input type="text" class="form-control uppercase" id="description" name="description" value="" required="">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="price">Preço</label>
                                                <input type="text" class="form-control uppercase" name="price" id="price" value="" required="">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="">Intervalo do plano</label>
                                                <select name="invoice_interval" class="form-control" required="">
                                                    <option value="month">Month</option>
                                                    <option value="year">Year</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group required">
                                                <label for="trial_period">Período de teste (Dias)</label>
                                                <input name="trial_period" type="number" class="form-control" placeholder="Período de teste (Dias)" value="" required="">
                                                <small class="form-text text-muted">Set 0 to disable trial.</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->

                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h6 class="m-0 text-dark"><i class="fa fa-database"></i> Recursos do plano</h6>
                                        </div><!-- /.col -->
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                            <div class="col">
                                                <div class="form-group required">
                                                    <label for="features[customers]">Customers Count</label>
                                                    <input name="features[customers]" type="text" class="form-control" placeholder="Customers Count" value="-1" required="">
                                                    <small class="form-text text-muted">Set -1 to make this feature unlimited.</small>
                                                </div>
                                            </div> 
                                            <div class="col">
                                                <div class="form-group required">
                                                    <label for="features[products]">Products Count</label>
                                                    <input name="features[products]" type="text" class="form-control" placeholder="Products Count" value="-1" required="">
                                                    <small class="form-text text-muted">Set -1 to make this feature unlimited.</small>
                                                </div>
                                            </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group required">
                                                <label for="features[estimates_per_month]">Estimates per month</label>
                                                <input name="features[estimates_per_month]" type="text" class="form-control" placeholder="Estimates per month" value="-1" required="">
                                                <small class="form-text text-muted">Set -1 to make this feature unlimited.</small>
                                            </div>
                                        </div> 
                                        <div class="col">
                                            <div class="form-group required">
                                                <label for="features[invoices_per_month]">Invoices per month</label>
                                                <input name="features[invoices_per_month]" type="text" class="form-control" placeholder="Invoices per month" value="-1" required="">
                                                <small class="form-text text-muted">Set -1 to make this feature unlimited.</small>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group required">
                                                <label for="features[view_reports]">Can View Reports?</label>
                                                <select name="features[view_reports]" class="form-control" required="">
                                                    <option value="1" selected="&quot;&quot;">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group required">
                                                <label for="features[advertisement_on_mails]">Show Ads on Mails</label>
                                                <select name="features[advertisement_on_mails]" class="form-control" required="">
                                                    <option value="1" selected="&quot;&quot;">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->

                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h6 class="m-0 text-dark"><i class="fa fa-database"></i> Login</h6>
                                        </div><!-- /.col -->
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="">Usuário</label>
                                                <input type="text" class="form-control" id="email" name="email" onfocusout="verificaNomeDeUsuario()" required="">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="">Senha</label>
                                                <input type="password" class="form-control" name="senha" value="" required="">
                                            </div>
                                        </div>

                                        <input type="hidden" name="status" value="Ativo">



                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-lg-12" style="text-align: right">


                                            <?php

                                            if (isset($_POST['cadastrar_plano'])) {

                                                $CNPJ = htmlspecialchars($_POST['CNPJ']);
                                                $xNome = htmlspecialchars($_POST['xNome']);
                                                $xFant = htmlspecialchars($_POST['xFant']);
                                                $IE = htmlspecialchars($_POST['IE']);
                                                $dia_do_pagamento = htmlspecialchars($_POST['dia_do_pagamento']);
                                                $CEP = htmlspecialchars($_POST['CEP']);

                                                $xLgr = htmlspecialchars($_POST['xLgr']);
                                                $nro = htmlspecialchars($_POST['nro']);
                                                $xCpl = htmlspecialchars($_POST['xCpl']);
                                                $xBairro = htmlspecialchars($_POST['xBairro']);
                                                $id_uf = htmlspecialchars($_POST['id_uf']);
                                                $id_municipio = htmlspecialchars($_POST['id_municipio']);
                                                $fone = htmlspecialchars($_POST['fone']);

                                                $email = htmlspecialchars($_POST['email']);
                                                $senha = htmlspecialchars($_POST['senha']);
                                                $status = htmlspecialchars($_POST['status']);


                                                $cadastro = $acoes->cadastrar_plano(
                                                    $CNPJ,
                                                    $xNome,
                                                    $xFant,
                                                    $IE,
                                                    $dia_do_pagamento,
                                                    $CEP,
                                                    $xLgr,
                                                    $nro,
                                                    $xCpl,
                                                    $xBairro,
                                                    $id_uf,
                                                    $id_municipio,
                                                    $fone,
                                                    $email,
                                                    $senha,
                                                    $status
                                                );

                                                if ($cadastro) {
                                                    echo '<script type="text/javascript">toastr.success("Empresa cadastrado com sucesso.")</script>';
                                                }
                                            }


                                            ?>



















                                            <button type="submit" name="cadastrar_plano" class="btn btn-primary">Cadastrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card -->

                        </form>

                    </div>
                </div>
                <!-- /.card -->

            </section>
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
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <script src="../js/functions.js"></script>
    <script src="./js/funcoes.js"></script>
    <script src="./js/mascaras.js"></script>
    <script src="./js/validador.js"></script>
    <script src="./js/viaCep.js"></script>
    <script src="./js/jquery.mask.js"></script>
    <script src="./js/select2.full.js"></script>
    <script src="../plugins/select2/js/select2.full.js"></script>
    <script src="../plugins/select2-bootstrap4-theme/select2-bootstrap4.css"></script>
    <script src="../plugins/select2/css/select2.css"></script>
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../plugins/jszip/jszip.min.js"></script>
    <script src="../plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

    <!-- <script>
        $(document).ready(function() {
        const INPUT_CIDADE = document.querySelector('#id_uf');
        const INPUT_ESTADO = document.querySelector('#id_municipio');

        const buscarCEP = (cep) => {
            let check = false;
            if (cep.length < 8) return;
            let url = 'https://viacep.com.br/ws/${cep}/json/'.replace('${cep}', cep);
            fetch(url)
                .then((res) => {
                    if (res.ok) {
                        res.json().then((json) => {
                            if (!json.erro) {
                                let cidade = json.localidade;
                                let estado = json.uf;
                                // Preenche os campos
                                INPUT_CIDADE.value = cidade;
                                INPUT_ESTADO.value = estado;
                            }
                        });
                    }
                });
        }

        // Adiciona o evento click
        $("#cep").blur(function() {
            let campoCEP = document.querySelector('#cep');
            buscarCEP(campoCEP.value);
        });
    });
    </script> -->

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

            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

        });

        function confirmaAcaoExcluir(msg, rota) {
            if (confirm(msg)) {
                window.location.href = rota;
            }
        }

        function trocaVirguraPorPonto(id) {
            var valor = document.getElementById(id).value;
            document.getElementById(id).value = valor.replace(',', '.')
        }

        document.getElementById('2').className = "nav-link active";
    </script>
</body>

</html>