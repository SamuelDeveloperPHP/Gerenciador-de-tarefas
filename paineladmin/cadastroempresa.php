<?php
include '../verifica-session.php';
include '../config.php';
include '../conexao.php';
include '../Acoes.php';

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
    <link rel="stylesheet" href="../plugins/select2/css/select2.css">
    <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <style>

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
        .form-check-input {
            background-color: #1F53A0 !important;
        }
        i.fas.fa-pencil-alt {
            color: #1F53A0;
            font-size: 16px;
        }
        i.fas.fa-trash {
            color: #FD3B3B !important;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <?php include '../header.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->

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
                                            <h6 class="m-0 text-dark"><i class="fa fa-database"></i> Nova Empresa</h6>
                                        </div><!-- /.col -->
                                        <div class="col-sm-6">
                                            <ol class="breadcrumb float-sm-right">
                                                <a href="/empresas" class="btn btn-success button-voltar"><i class="fa fa-arrow-alt-circle-left"></i> Voltar</a>
                                                <li class="breadcrumb-item"><a href="/inicio">Início</a></li>
                                                <li class="breadcrumb-item active">Nova Empresa</li>
                                            </ol>
                                        </div><!-- /.col -->
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="">CNPJ</label>
                                                <input type="text" class="form-control cnpj" id="CNPJ" name="CNPJ" onblur="validarCNPJ('CNPJ')" value="" required="" maxlength="18">
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label for="">Razão Social</label>
                                                <input type="text" class="form-control uppercase" id="input-razao-social" name="xNome" value="" required="">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="">Nome Fantasia</label>
                                                <input type="text" class="form-control uppercase" name="xFant" value="" required="">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="">I.E.</label>
                                                <input type="text" class="form-control" name="IE" value="" required="">
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label for="">Dia do Pagamento</label>
                                                <input type="number" class="form-control" name="dia_do_pagamento" value="" required="">
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
                                            <h6 class="m-0 text-dark"><i class="fa fa-database"></i> Endereço</h6>
                                        </div><!-- /.col -->
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label for="">CEP</label>
                                                <input type="text" class="form-control cep" id="cep" name="CEP" value="" required="" maxlength="9">
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="form-group">
                                                <label for="">Logradouro</label>
                                                <input type="text" class="form-control" id="logradouro" name="xLgr" value="" required="">
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <label for="">Número</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="nro" name="nro">
                                                <span class="input-group-append">
                                                    <button type="button" class="btn btn-info btn-flat" onclick="semNumero('nro')">S/N</button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <label for="">Complemento</label>
                                                <input type="text" class="form-control" id="complemento" name="xCpl" value="" required="">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="">Bairro</label>
                                                <input type="text" class="form-control" id="bairro" name="xBairro" value="" required="">
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label for="">UF</label>
                                                
                                                <input type="text" class="form-control" id="id_uf" name="id_uf" value="" required="">
                                               
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="">Municipio</label>
                                                <input type="text" class="form-control" id="id_municipio" name="id_municipio" value="" required="">
                                                
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="">Fone</label>
                                                <input type="text" class="form-control fone-sem-mascara" name="fone" value="" required="" maxlength="11">
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

                                            if (isset($_POST['cadastrar_empresa'])) {

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


                                                $cadastro = $acoes->cadastrar_empresa(
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

                                            <button type="submit" name="cadastrar_empresa" class="btn btn-primary">Cadastrar</button>
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