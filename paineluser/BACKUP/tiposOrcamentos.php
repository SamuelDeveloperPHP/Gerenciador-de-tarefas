<?php
include 'verifica-sessionempresa.php';
include 'config.php';
include 'conexao.php';
include 'Acoes.php';

$paginaLink = basename($_SERVER['SCRIPT_NAME']);

$registrosPorPagina = 8;

if (empty($_GET['pagina']) || !isset($_GET['pagina'])) {
    $paginaAtual = 1;
} else {
    $paginaAtual = $_GET['pagina'];
}


if ($paginaAtual == 1) {
    $inicio = 0;
} else {
    $inicio = $registrosPorPagina * ($paginaAtual - 1);
}




if (!empty($_GET['acao']) && $_GET['acao'] == 'deletar' && $_GET['id_cliente'] > 0) {

    $id_cliente = $_GET['id_cliente'];


    $caminho_images = 'images/pecas/' . $id_cliente . '/';
    $caminho_pdf = 'pdfs/' . $id_cliente . '/';


    $acoes->deletarVistoria1($id_cliente);

    if (!empty($_GET['busca'])) {
        header('Location:' . $_SERVER['PHP_SELF'] . '?busca=' . $_GET['busca']);
        die;
    } else {
        header('Location: ' . $_SERVER['PHP_SELF']);
        die;
    }
}

if (!empty($_GET['busca'])) {
    $busca = $_GET['busca'];
    $listarVistoriasPage = $acoes->buscarVistoriasPaginate($busca, $inicio, $registrosPorPagina);
    $totalDeRegistros = count($listarVistoriasPage);
} else {
    $listarVistoriasPage = $acoes->listarEquipamentos($inicio, $registrosPorPagina, $id);
    $totalDeRegistros = $acoes->totalDeEqp();
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Master Clube | Espelhos</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <style>
        .style-action {
            padding-top: 1px;
            padding-bottom: 1px;
            padding-left: 7px;
            padding-right: 7px;
            font-size: 0.875rem !important;
        }

        .text-sm .btn {
            font-size: 0.875rem !important;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php include 'header.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h6 class="m-0 text-dark"><i class="fa fa-user-circle"></i> Empresas</h6>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Início</a></li>
                                <li class="breadcrumb-item active">Espelhos</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">


                            <div class="card">
                                <!-- /.card-header -->
                                <div class="card-body no-print">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <a href="cadastroempresa.php" class="btn btn-info"><i class="fas fa-plus-circle"></i> Novo tipo</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <hr>
                                        </div>
                                    </div>
                                    <form action="" method="get">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="">CNPJ</label>
                                                    <input type="text" class="form-control cnpj" name="busca" value="" required="" maxlength="18">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-success" style="margin-top: 30px"><i class="fas fa-search"></i> Pesquisar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>


                            <div class="card card-info">
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <!-- <form style="text-align:right; max-width:100%;" action="" method="get">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="input-group mb-3">
                                                    <input align="center" id="link" readonly="true" type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2" value="Total de espelhos gerados:&nbsp;&nbsp;<?php echo $acoes->contar('vistorias'); ?> &nbsp;&nbsp;">
                                                    <button onClick="copiarTexto()" class="btn btn-outline-secondary" type="button" id="button-addon2">COPIAR LINK</button>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="input-group mb-3">
                                                    <input type="text" name="busca" class="form-control" placeholder="Pesquisar">
                                                    <button class="btn btn-outline-secondary" type="submit">PESQUISAR</button>
                                                </div>
                                            </div>
                                        </div>
                                        <br><br>
                                    </form> -->
                                    <table id="example1" class="table table-hover text-nowrap table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Cod Eqp</th>
                                                <th colspan="2">Situção</th>
                                                <th>Tipo centro</th>
                                                <th>Tipo maquina</th>
                                                <th>Tipo hora</th>
                                                <th scope="col">Ações</th>
                                            </tr>
                                            <?php


                                            foreach ($listarVistoriasPage as $vistoria) :

                                                $data_realizacao_vistoria = date('d/m/Y', strtotime($vistoria['data_realizacao_vistoria']));
                                            ?>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?php echo $vistoria['cod_eqp']; ?></td>
                                                <td colspan="2"><?php echo $vistoria['situacao_eqp']; ?></td>
                                                <td><?php echo $vistoria['tipo_centro']; ?></td>
                                                <td><?php echo $vistoria['tipo_maquina']; ?></td>
                                                <td><?php echo $vistoria['tipo_hora']; ?></td>
                                                <td style="width:50px;">
                                                    <!-- <a alt="VER LAUDO" title="VER LAUDO" class="botaoacoes" href="editarEquipamento.php?id=<?php echo $vistoria['id']; ?>">
                                                        <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-subtract" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" d="M0 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2h2a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-2H2a2 2 0 0 1-2-2V2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H2z" />
                                                        </svg>
                                                    </a> -->
                                                    <a href="#" class="btn btn-success style-action"><i class="fas fa-dollar-sign"></i> PGTO</a> &nbsp; &nbsp;
                                                    <a href="#" class="btn btn-primary style-action"><i class="fas fa-folder-open"></i></a>
                                                    <a href="#" class="btn btn-warning style-action"><i class="fas fa-edit"></i></a>


                                                    <button type="button" class="btn btn-danger style-action" onclick="confirmaAcaoExcluir('Deseja realmente excluir essa Empresa? Essa ação não poderá ser desfeita.', '/empresas/delete/1')"><i class="fas fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Cod Eqp</th>
                                                <th colspan="2">Situção</th>
                                                <th>Tipo centro</th>
                                                <th>Tipo maquina</th>
                                                <th>Tipo hora</th>
                                                <th scope="col">Ações</th>
                                            </tr>
                                        </tfoot>  
                                    </table>
                                </div>
                                <!-- /.card-body -->
                                <div class="mb-4 d-flex justify-content-center">


                                    <ul class="pagination">


                                        <?php

                                        $quantidadeDePaginas = ceil($totalDeRegistros / $registrosPorPagina);

                                        if (!empty($_GET['busca'])) {
                                            $busca = '&busca=' . $_GET['busca'];
                                        } else {
                                            $busca = '';
                                        }


                                        if ($paginaAtual <= 1) {
                                        } else {
                                            echo '
							<li class="page-item"><a class="page-link" href="?pagina=' . ($paginaAtual - 1) . $busca . '"> < </a></li>
						';
                                        }


                                        for ($i = 1; $i <= $quantidadeDePaginas; $i++) {
                                            echo '
							<li class="page-item"><a class="page-link" href="?pagina=' . $i . $busca . '">' . $i . '</a></li>
						';
                                        }


                                        if ($paginaAtual >= $quantidadeDePaginas) {
                                        } else {
                                            echo '
							<li class="page-item"><a class="page-link" href="?pagina=' . ($paginaAtual + 1) . $busca . '"> > </a></li>
						';
                                        }


                                        ?>





                                    </ul>


                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php include 'footer.php' ?>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../../plugins/jszip/jszip.min.js"></script>
    <script src="../../plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../../plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
    <!-- Page specific script -->
    <!-- <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                "paging": true,
                "ordering": false,
                "searching": true,
                "info": true,
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": false,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script> -->
</body>

</html>