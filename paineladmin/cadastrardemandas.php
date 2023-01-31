<?php
include '../verifica-session.php';
include '../config.php';
include '../conexao.php';
include '../Acoes.php';



if (@$_GET['funcao'] == 'editar') {



    $id2 = $_GET['id'];
    $user_id = $_SESSION['id'];

    $query = $bd->query("SELECT * FROM demandas where id = '" . $id2 . "' ");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $id_demanda = $res[0]['id'];
    $titulo = $res[0]['titulo'];
    $descricao = $res[0]['descricao'];
    $regra = $res[0]['regra_negocio'];
    $foto = $res[0]['foto'];
    $prioridade = $res[0]['prioridade'];
    $modulo = $res[0]['modulo'];
    $data_cadastro = $res[0]['data_cadastro'];
    $data_formatada = DateTime::createFromFormat('Y/m/Y', $data_cadastro);

    $query2 = $bd->query("SELECT * FROM historico where demanda_id = '" . $id2 . "' ");
    $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);

    $titulo2 = $res2[0]['mensagem'];

    // $subtitulo2 = $res[0]['subtitulo'];
    // $descricao2 = $res[0]['descricao'];
    // $textobt2 = $res[0]['textobt'];
    // $link2 = $res[0]['link'];
    // $imagem2 = $res[0]['imagem'];
    // $arquivo = $res[0]['arquivo'];
    // $ativo2 = $res[0]['ativo'];
}




$totalDeModulos = $acoes->totalDeModulos();
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
    $listarVistoriasPage = $acoes->buscarModuloPaginate($busca, $inicio, $registrosPorPagina);
    $totalDeRegistros = count($listarVistoriasPage);
} else {
    $listarVistoriasPage = $acoes->listarModulos($inicio, $registrosPorPagina, $id);
    $totalDeRegistros = $acoes->totalDeEmp();
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sango IT Solutions</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
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

        input {
            height: 40px;
            margin-bottom: 40px !important;
            background: #F3F3F3 !important;
            border: 0.5px solid #DBDBDB;
            border-radius: 4px;
        }

        select.form-select {
            background-color: #f3f3f3;
            margin-bottom: 40px;
            height: 40px;
        }

        textarea {
            background-color: #f3f3f3 !important;
            height: 150px !important;
        }

        input#userfile {
            height: 150px !important;
            min-height: 150px !important;
            /* display: flex; */
            /* align-content: center; */
            /* align-items: center; */
            /* justify-content: center; */
            /* flex-direction: row; */
        }

        label.custom-file-label {
            height: 150px;
            background-color: #f3f3f3;
            text-align: start;
            padding-top: 18% !important;
        }

        .custom-file {
            height: 150px;
        }

        img#image_userfile {
            width: 100% !important;
            height: 150px !important;
            border-radius: 4px;
        }

        .upload {
            width: 158px;
            height: 45px;
            overflow: hidden;
            position: relative;
            background-repeat: no-repeat;
            background-image: url(./imagens/uploadb.png);
        }

        .upload input {
            display: block !important;
            width: 158px !important;
            height: 45px !important;
            opacity: 0 !important;
            overflow: hidden !important;
        }

        .prioridadetexto {
            float: right !important;
            text-align: end;
            margin-bottom: 40px !important;
            padding-right: 0 !important;
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
                            <h6 class="m-0 text-dark" style="font-size:24px"> Cadastrar nova demanda</h6>
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
                                <div class="prioridadetexto">
                                    <span style="background: #FFE1E1;border-radius: 30px;padding: 3px 15px 3px 15px;margin-right: 10px;font-size: 12px;
    font-weight: 400;">Prioridade 1: Alta</span>
                                    <span style="background: #E1E8FF;border-radius: 30px;padding: 3px 15px 3px 15px;margin-right: 10px;font-size: 12px;
    font-weight: 400;">Prioridade 2: Normal</span>
                                    <span style="background: #E1FFE4;border-radius: 30px;padding: 3px 15px 3px 15px;margin-right: 10px;font-size: 12px;
    font-weight: 400;">Prioridade 3: Baixa</span>
                                </div>
                                <div class="col-lg-12 text-right">

                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row" style="display: flex;align-items: center;">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <input type="text" id="titulo" name="titulo" value="<?php echo $titulo ?>" class="form-control" placeholder="Insira o título">
                                                    <input type="hidden" id="id_demanda" name="id_demanda" value="<?php echo $id_demanda ?>" class="form-control" placeholder="Insira o título">
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <select name="modulo" id="modulo" class="form-select" aria-label="Default select example">

                                                        <?php
                                                        $query = $bd->prepare("SELECT * FROM modulos WHERE id = :modulo");
                                                        $query->bindValue(':modulo', $modulo, PDO::PARAM_STR);


                                                        try {

                                                            $query->execute();
                                                            $linhas = $query->fetch(PDO::FETCH_ASSOC);

                                                            $code1 = $linhas['name'];
                                                        } catch (PDOException $e) {

                                                            die($e->getMessage());
                                                        }
                                                        ?>

                                                        <?php if (@$_GET['funcao'] == 'editar') { ?>
                                                            <option value="<?php echo $modulo ?>"><?php echo $code1 ?> (Atual)</option>
                                                        <?php } else { ?>
                                                            <option value="<?php echo $modulo ?>">Selecione o módulo</option>
                                                        <?php } ?>


                                                        <?php foreach ($totalDeModulos as $totalsis) : ?>
                                                            <option value="<?php echo $totalsis['id']; ?>"><?php echo $totalsis['name']; ?></option>
                                                        <?php endforeach; ?>


                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">

                                                    <input type="date" id="data" name="data" placeholder="" value="<?php echo date('Y-m-d', strtotime($data_cadastro)) ?>" class="form-control" id="usuario" placeholder="Insira a data">
                                                </div>

                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <select class="form-select" name="prioridade" aria-label="Default select example">

                                                        <?php if (@$_GET['funcao'] == 'editar') { ?>
                                                            <option value="<?php echo $prioridade ?>"><?php echo $prioridade ?> (Atual)</option>
                                                        <?php } else { ?>
                                                            <option value="">Selecione a prioridade</option>
                                                        <?php } ?>

                                                        <option value="1">Alta</option>
                                                        <option value="2">Normal</option>
                                                        <option value="3">Baixa</option>
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <textarea type="textarea" name="descricao" class="form-control" id="descricao" placeholder="Descrição"><?php echo $descricao; ?></textarea>
                                                </div>
                                            </div>

                                            <div class="col-lg-10">
                                                <div class="form-group">
                                                    <textarea type="textarea" name="regra_negocio" class="form-control" id="regra_negocio" placeholder="Regra de negócio"><?php echo $regra; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">

                                                <div class="form-group">

                                                    <div class="input-group" style="height: 150px;">

                                                        <input type="hidden" id="userfile" name="userfile">
                                                        <img class="image-form photo_upload" id="image_userfile" src="./imagens/<?php echo $foto; ?>">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                        <p>
                                            <?php
                                            ?>

                                            <?php

                                            if (@$_GET['funcao'] == 'editar') {

                                                if (isset($_POST['cadastrar_tecnico'])) {

                                                    $id_demanda = htmlspecialchars($_POST['id_demanda']);
                                                    $titulo = htmlspecialchars($_POST['titulo']);
                                                    $modulo = htmlspecialchars($_POST['modulo']);
                                                    $data = htmlspecialchars($_POST['data']);
                                                    $prioridade = htmlspecialchars($_POST['prioridade']);
                                                    $descricao = htmlspecialchars($_POST['descricao']);
                                                    $regra_negocio = htmlspecialchars($_POST['regra_negocio']);




                                                    $file_name = $_FILES['userfile']['name'];
                                                    $file_temp = $_FILES['userfile']['tmp_name'];
                                                    $location = "imagens/" . $file_name;
                                                    move_uploaded_file($file_temp, $location);



                                                    $cadastro = $acoes->atualizar_demandas(
                                                        $id_demanda,
                                                        $titulo,
                                                        $modulo,
                                                        $data,
                                                        $prioridade,
                                                        $descricao,
                                                        $regra_negocio,
                                                        $file_name
                                                    );

                                                    if ($cadastro) {
                                                        echo '<script type="text/javascript">toastr.success("Demanda cadastrado com sucesso.")</script>';
                                                        echo '<script type="text/javascript">window.location.href = "demandas.php";</script>';
                                                    }
                                                }
                                            } else {

                                                if (isset($_POST['cadastrar_tecnico'])) {

                                                    $titulo = htmlspecialchars($_POST['titulo']);
                                                    $modulo = htmlspecialchars($_POST['modulo']);
                                                    $data = htmlspecialchars($_POST['data']);
                                                    $prioridade = htmlspecialchars($_POST['prioridade']);
                                                    $descricao = htmlspecialchars($_POST['descricao']);
                                                    $regra_negocio = htmlspecialchars($_POST['regra_negocio']);




                                                    $file_name = $_FILES['userfile']['name'];
                                                    $file_temp = $_FILES['userfile']['tmp_name'];
                                                    $location = "imagens/" . $file_name;
                                                    move_uploaded_file($file_temp, $location);



                                                    $cadastro = $acoes->cadastrar_demandas2(
                                                        $titulo,
                                                        $modulo,
                                                        $data,
                                                        $prioridade,
                                                        $descricao,
                                                        $regra_negocio,
                                                        $file_name
                                                    );

                                                    if ($cadastro) {
                                                        echo '<script type="text/javascript">toastr.success("Demanda cadastrado com sucesso.")</script>';
                                                    }
                                                }
                                            }




                                            ?>


                                            <?php




                                            ?>





                                        </p>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="input-group mb-3">
                                                   
                                                    <div class="upload">
                                                        <input style="margin-bottom: 0px !important;width: 104px;height: 33px;" onchange="handleFiles('userfile')" type="file" name="userfile" class="form-control userfile" id="inputGroupFile01">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <button type="submit" name="cadastrar_tecnico" class="btn btn-success salvar"><i class="fas fa-save" style="margin-right: 15px;" aria-hidden="true"></i>Salvar</button>
                                                <input type="hidden" name="env" value="cad">
                                            </div>
                                        </div>

                                    </form>
                                    <div class="row">
                                        <div class="col-lg-12">

                                        </div>
                                    </div>
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
    <script src="./js/funcoes.js"></script>
</body>

</html>