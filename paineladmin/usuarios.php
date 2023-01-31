<?php
include '../verifica-session.php';
include '../config.php';
include '../conexao.php';
include '../Acoes.php';

$totalDeSistemas = $acoes->totalDeSistemas();

$Acessos = $acoes->nivelAcesso();

$paginaLink = basename($_SERVER['SCRIPT_NAME']);


if ($_GET['acao'] == 'editar') {

    $id_modulo = $_GET['id'];
    $vistoria = $acoes->listarUsuariosId($id_modulo);

    $id_sistema2 = $vistoria['id'];
    $nome = $vistoria['nome'];
    $email = $vistoria['email'];
    $contato = $vistoria['contato'];
    $nome_sistema = $vistoria['nome_sistema'];
    $status = $vistoria['status'];
    $tipo = $vistoria['tipo'];
    $nivelacesso = $vistoria['nivelacesso'];
}

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




if (!empty($_GET['acao']) && $_GET['acao'] == 'deletar' && $_GET['id'] > 0) {

    $id_cliente = $_GET['id'];


    $caminho_images = 'images/pecas/' . $id_cliente . '/';
    $caminho_pdf = 'pdfs/' . $id_cliente . '/';


    $acoes->deletarUsuario($id_cliente);

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
    $listarVistoriasPage = $acoes->buscarUsuariosPaginate($busca, $inicio, $registrosPorPagina);
    $totalDeRegistros = count($listarVistoriasPage);
} else {
    $listarVistoriasPage = $acoes->listarUsuarios($inicio, $registrosPorPagina, $id);
    $totalDeRegistros = $acoes->totalDeUsers();
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sango IT Soluções</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="./assets/styles.css">
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

        label.form-check-label {
            margin-right: 50px;
        }

        .form-check-input:checked {
            background-color: #1F53A0 !important;
            border-color: #1F53A0 !important;
        }

        i.fas.fa-pencil-alt {
            color: #1F53A0;
            font-size: 16px;
        }

        i.fas.fa-trash {
            color: #FD3B3B !important;
        }

        span.material-icons {
            font-size: 22px !important;
            color: #1F53A0;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php include '../header.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h6 class="m-0 text-dark" style="font-size:24px"> Cadastro de usuários</h6>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">


                            <div class="row">
                                <div class="col-lg-12 text-right">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row" style="display: flex;align-items: center;">
                                            <div class="col-lg-6" style="padding-right:12.5px;">
                                                <div class="form-group">
                                                    <input type="text" class="form-control cnpj" placeholder="Nome de usuário" id="nome" name="nome" value="<?php echo $nome ?>" required="">
                                                    <input type="hidden" class="form-control cnpj" placeholder="Tipo" id="tipo" name="tipo" value="User" required="">
                                                    <input type="hidden" class="form-control cnpj" placeholder="ID" id="id_user" name="id_user" value="<?php echo $id_sistema2 ?>" required="">
                                                </div>
                                            </div>

                                            <div class="col-lg-6" style="padding-left:12.5px;">
                                                <div class="form-group">
                                                    <select name="nome_sistema" id="nome_sistema" class="form-select" aria-label="Default select example">


                                                        <?php if ($_GET['acao'] == 'editar') {


                                                            $query = $bd->prepare("SELECT * FROM sistemas WHERE id = $nome_sistema");

                                                            try {

                                                                $query->execute();
                                                                $linhas = $query->fetch(PDO::FETCH_ASSOC);

                                                                $code1 = $linhas['name'];
                                                            } catch (PDOException $e) {

                                                                die($e->getMessage());
                                                            }


                                                        ?>

                                                            <option value="<?php echo $nome_sistema ?>"><?php echo $code1 ?> (Atual)</option>

                                                        <?php } else { ?>

                                                            <option value="">Selecione o sistema</option>

                                                        <?php } ?>

                                                        <?php foreach ($totalDeSistemas as $totalsis) : ?>
                                                            <option value="<?php echo $totalsis['id']; ?>"><?php echo $totalsis['name']; ?></option>
                                                        <?php endforeach; ?>


                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-6" style="padding-left:12.5px;">
                                                <div class="form-group">
                                                    <select name="tipo" id="nome_sistema" class="form-select" aria-label="Default select example">
                                                        <?php if ($_GET['acao'] == 'editar') {

                                                            $query = $bd->prepare("SELECT * FROM nivelacesso WHERE id = $nome_sistema");

                                                            try {

                                                                $query->execute();
                                                                $linhas = $query->fetch(PDO::FETCH_ASSOC);

                                                                $acess = $linhas['nivel_acesso'];
                                                            } catch (PDOException $e) {

                                                                die($e->getMessage());
                                                            }


                                                        ?>

                                                            <option value="<?php echo $nome_sistema ?>"><?php echo $acess ?> (Atual)</option>

                                                        <?php } else{?>

                                                            <option value="">Selecione o nível de acesso</option>

                                                        <?php } ?>

                                                        <?php foreach ($Acessos as $totalAcesso) : ?>
                                                            <option value="<?php echo $totalAcesso['id']; ?>"><?php echo $totalAcesso['nivel_acesso']; ?></option>
                                                        <?php endforeach; ?>


                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-6" style="padding-right:12.5px;">
                                                <div class="form-group">
                                                    <input type="email"  class="form-control cnpj" placeholder="Email" id="email" name="email" value="<?php echo $email ?>" required="">
                                                </div>
                                            </div>

                                            <div class="col-lg-6" style="padding-left:12.5px;">
                                                <div class="form-group">
                                                    <input type="text" style="margin-bottom:10px" class="form-control cnpj" placeholder="Contato" id="contato" name="contato" value="<?php echo $contato ?>" required="">
                                                </div>
                                            </div>


                                            <div class="col-lg-6">
                                                <div class="form-group" style="text-align: left;margin-top: -25px;padding: 0;margin-left: -15px;">
                                                    <div class="form-check form-switch">
                                                        <label class="form-check-label" for="status"><strong>Status:</strong> Ativo</label>


                                                        <?php if ($_GET['acao'] == 'editar') { ?>

                                                            <input class="form-check-input" type="checkbox" name="status" id="status2" <?php if ($status == 1) {
                                                                                                                                            echo 'value="1" checked style="background-color: #1F53A0 !important;"';
                                                                                                                                        } else {
                                                                                                                                            echo 'value="0"';
                                                                                                                                        } ?>>

                                                        <?php } else { ?>
                                                            <input class="form-check-input" type="checkbox" name="status" id="status2" value="1" checked>
                                                        <?php }  ?>

                                                        <script>
                                                            $(function() {
                                                                $('#status2').change(function() {
                                                                    $('#status2').val(0 + $(this).prop('checked'))
                                                                });
                                                            })
                                                            //  $(document).ready(function() {
                                                            //       $('input[id="status2"]').on('change', function() {
                                                            //           if ($(this).val = 1) {
                                                            //               $(this).val = 0;
                                                            //           } else {
                                                            //               $(this).val = 1;
                                                            //           }

                                                            //         alert($(this).val());
                                                            //       });
                                                            //     });
                                                        </script>

                                                    </div>
                                                </div>
                                            </div>




                                            <div class="col-lg-6" style="text-align: right">


                                                <?php

                                                if ($_GET['acao'] == 'editar') {

                                                    if (isset($_POST['cadastrar_plano'])) {

                                                        $id_user = htmlspecialchars($_POST['id_user']);
                                                        $nome = htmlspecialchars($_POST['nome']);
                                                        $tipo = htmlspecialchars($_POST['tipo']);
                                                        $nome_sistema = htmlspecialchars($_POST['nome_sistema']);
                                                        $email = htmlspecialchars($_POST['email']);
                                                        $contato = htmlspecialchars($_POST['contato']);
                                                        $status = htmlspecialchars($_POST['status']);


                                                        $cadastro = $acoes->atualizar_usuario(
                                                            $id_user,
                                                            $nome,
                                                            $tipo,
                                                            $nome_sistema,
                                                            $email,
                                                            $contato,
                                                            $status
                                                        );

                                                        if ($cadastro) {
                                                            echo '<script type="text/javascript">toastr.success("Usuário atualizado com sucesso.")</script>';
                                                            echo "<script>window.location.href = 'usuarios.php';</script>";
                                                        }
                                                    }
                                                } else {

                                                    if (isset($_POST['cadastrar_plano'])) {

                                                        $nome = htmlspecialchars($_POST['nome']);
                                                        $tipo = htmlspecialchars($_POST['tipo']);
                                                        $nome_sistema = htmlspecialchars($_POST['nome_sistema']);
                                                        $email = htmlspecialchars($_POST['email']);
                                                        $contato = htmlspecialchars($_POST['contato']);
                                                        $status = htmlspecialchars($_POST['status']);


                                                        $cadastro = $acoes->cadastrar_usuario(
                                                            $nome,
                                                            $tipo,
                                                            $nome_sistema,
                                                            $email,
                                                            $contato,
                                                            $status
                                                        );

                                                        if ($cadastro) {
                                                            echo '<script type="text/javascript">toastr.success("Usuário cadastrado com sucesso.")</script>';
                                                        }
                                                    }
                                                }


                                                ?>

                                                <button type="submit" name="cadastrar_plano" class="btn btn-success salvar">
                                                    <i class="fas fa-save" style="margin-right: 15px;" aria-hidden="true"></i>Salvar</button>
                                            </div>
                                        </div>
                                        <!-- /.card -->

                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">

                                </div>
                            </div>

                            <form action="" id="busca" method="get" enctype="multipart/form-data" style="padding-left: 7.5px;">
                                <div class="row" style="display: flex;align-items: center;">
                                    <div class="col-lg-4" style="padding:0;">
                                        <div class="form-group" style="margin-bottom:0px">
                                            <input type="text" class="form-control cnpj" placeholder="Filtrar" id="busca" name="busca" value="" required="">
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card -->

                            </form>

                            <div style="padding-left:7.5px;padding-right: 7.5px;">


                                <?php


                                foreach ($listarVistoriasPage as $vistoria) :

                                    $data_realizacao_vistoria = date('d/m/Y', strtotime($vistoria['data_realizacao_vistoria']));

                                    $id_sistema = $vistoria['nome_sistema'];
                                    $query = $bd->prepare("SELECT * FROM sistemas WHERE id = :nome_sistema");
                                    $query->bindValue(':nome_sistema', $id_sistema, PDO::PARAM_STR);

                                    try {

                                        $query->execute();
                                        $linhas = $query->fetch(PDO::FETCH_ASSOC);

                                        $code1 = $linhas['name'];
                                    } catch (PDOException $e) {

                                        die($e->getMessage());
                                    }


                                ?>




                                    <div class="row rounded" style="height:65px;border-radius:10px;border: 1px solid #EAEAEA; margin-bottom:10px">
                                        <div class="col-lg-6" style="display: flex;align-items: center;">
                                            <span class="title_foreach"><?php echo $vistoria['nome']; ?></span>
                                        </div>

                                        <div class="col-lg-6" style="display: flex;align-items: center;justify-content: flex-end;">
                                            <div class="form-check form-switch">



                                                <input class="form-check-input" readonly type="checkbox" name="status" id="status" <?php if ($vistoria['status'] == 1) {
                                                                                                                                        echo 'value="0" checked';
                                                                                                                                    } else {
                                                                                                                                        echo 'value="1"';
                                                                                                                                    } ?>>


                                            </div>
                                            <a type="button" style="color:#0d6efd" class="btn style-action" href="?acao=editar&id=<?php echo $vistoria['id']; ?>">
                                                <span class="material-icons" style="font-size: 22px !important;margin-top: 3px;">edit</span>

                                                <a type="button" style="color:#dc3545;padding-right: 30px;" class="btn style-action" onclick="return confirm('Deseja realmente excluir o usuário <?php echo $vistoria['id']; ?> ?');" href="?acao=deletar&id=<?php echo $vistoria['id']; ?>">
                                                    <i class="fas fa-trash" aria-hidden="true"></i></a>
                                        </div>
                                    </div>






                                <?php endforeach; ?>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="mb-4 d-flex justify-content-end">

                            <?php


                            if ($paginaAtual <= 1) {
                            } else {
                                echo '
                        							<a class="pageitembo" style="margin-right:15px" href="?pagina=' . ($paginaAtual - 1) . $busca . '"> < </a>
                        						';
                            }
                            ?>
                            <ul class="pagination">


                                <?php

                                $quantidadeDePaginas = ceil($totalDeRegistros / $registrosPorPagina);

                                if (!empty($_GET['busca'])) {
                                    $busca = '&busca=' . $_GET['busca'];
                                } else {
                                    $busca = '';
                                }





                                for ($i = 1; $i <= $quantidadeDePaginas; $i++) {
                                    echo '
							<li class="pageitem"><a class="pagelink" href="?pagina=' . $i . $busca . '">' . $i . '</a></li>
						';
                                }





                                ?>





                            </ul>

                            <?php


                            if ($paginaAtual >= $quantidadeDePaginas) {
                            } else {
                                echo '
							<a class="pageitembo" href="?pagina=' . ($paginaAtual + 1) . $busca . '"> > </a>
						';
                            }
                            ?>


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
    <!-- DataTables  & Plugins -->
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
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <script>
        $('input[name=switchbutton]').click(function() {
            var id = $(this).attr('id');
            var status = $(this).val();
            if (status == 1) {
                status = 0;
            } else {
                status = 1;
            }
            //alert(id);
            $.ajax({
                type: 'POST',
                url: 'updatestatus.php',
                data: 'id= ' + id + '&status=' + status
            });
        });
    </script>
</body>

</html>