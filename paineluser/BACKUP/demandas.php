<?php
include '../verifica-session.php';
include '../config.php';
include '../conexao.php';
include '../Acoes.php';

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

if (!empty($_GET['acao']) && $_GET['acao'] == 'deletarhis' && $_GET['id'] > 0) {

    $id_cliente = $_GET['id'];


    // $caminho_images = 'images/pecas/' . $id_cliente . '/';
    // $caminho_pdf = 'pdfs/' . $id_cliente . '/';


    $acoes->deletarDemandaHis($id_cliente);
    
    if (!empty($_GET['busca'])) {
        header('Location:' . $_SERVER['PHP_SELF'] . '?busca=' . $_GET['busca']);
        die;
    } else {
        header('Location: ' . $_SERVER['PHP_SELF']);
        // header('Location: ' . $_SERVER['PHP_SELF'].'?funcao=editar&id='.$id_cliente.'');
        die;
    }
    
}


if (!empty($_GET['acao']) && $_GET['acao'] == 'deletar' && $_GET['id'] > 0) {

    $id_cliente = $_GET['id'];


    // $caminho_images = 'images/pecas/' . $id_cliente . '/';
    // $caminho_pdf = 'pdfs/' . $id_cliente . '/';


    $acoes->deletarDemanda($id_cliente);

    if (!empty($_GET['busca'] && $_GET['modulo'])) {
        header('Location:' . $_SERVER['PHP_SELF'] . '?busca=' . $_GET['busca']);
        die;
    } else {
        header('Location: ' . $_SERVER['PHP_SELF']);
        die;
    }
}

if(!empty($_GET['modulo'])) {
    $busca = $_GET['modulo'];
    $listarVistoriasPage = $acoes->buscarDemandasPaginate($busca, $inicio, $registrosPorPagina);
    $totalDeRegistros = count($listarVistoriasPage);
}

if(!empty($_GET['busca'])) {
    $busca = $_GET['busca'];
    $listarVistoriasPage = $acoes->buscarDemandasPaginate($busca, $inicio, $registrosPorPagina);
    $totalDeRegistros = count($listarVistoriasPage);
}

else {
    $listarVistoriasPage = $acoes->listarDemandas($inicio, $registrosPorPagina, $id);
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
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
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

        .row.titleacc {
            width: 100%;
        }

        .botaoacc {
            width: 147px;
            background: #2B4366;
            border-radius: 5px;
            padding: 10px;
            color: #ffffff;
        }

        .botaoacc2 {
            width: 147px;
            background: #42B1D5;
            border-radius: 5px;
            padding: 10px;
            color: #ffffff;
        }

        .accordion-button:not(.collapsed) {
            color: #000000;
            background-color: #ffffff;
            box-shadow: inset 0 -1px 0 rgb(0 0 0 / 13%);
            margin-bottom: 10p;
        }

        .accordion-item {
            margin-bottom: 15px;
        }

        .comment {
            margin-top: 10px;
            border: 1px solid #EAEAEA;
            padding: 15px;
            border-radius: 10px;
            margin-right:10px;
        }

        .overflow {
            /* max-height: 9%; */
            height: 40%;
            overflow-y: scroll;
        }

        .modal-body {

            height: 700px !important;
        }

        .modal-content {
            height: 700px;
        }
        input.cnpj {
            height: 40px;
            margin-bottom: 40px;
            background: #F3F3F3;
            border: 0.5px solid #DBDBDB;
            border-radius: 4px;
            float: right;
            width: 98%;
        }
        textarea.form-control {
            /* height: auto; */
                    height: 150px;
                    background-color: #f3f3f3;
                }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php include './headeradmin.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h6 class="m-0 text-dark" style="font-size:24px"> Demandas cadastradas</h6>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">

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



                                    <div class="row">
                                        <div class="col-lg-12 text-right">
                                            <form action="" id="busca" method="get" enctype="multipart/form-data">
                                                        <div class="row" style="display: flex;align-items: center;">
                                                            <div class="col-lg-4" style="padding:0;">
                                                                <div class="form-group"  style="margin-bottom:0px">
                                                                    <input type="text" class="form-control cnpj" placeholder="Filtro" id="busca" name="busca" value="" required="">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="form-group">
                                                                    <select name="busca" id="modulo" class="form-select" onchange="this.form.submit()" aria-label="Default select example">
                                                                            <option value="">Selecione o módulo</option>
                                                                            
                                                                            <?php foreach ($totalDeModulos as $totalsis): ?>
                                                                                <option value="<?php echo $totalsis['id']; ?>" ><?php echo $totalsis['name']; ?></option>
                                                                            <?php endforeach; ?>
                                                                            
                                                                            
                                                                        </select> 
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="form-group">
                                                                    <select name="prioridade" id="modulo" class="form-select" aria-label="Default select example">
                                                                            <option value="">Ordernar por</option>
                                                                            
                                                                            
                                                                            
                                                                            
                                                                        </select> 
                                                                </div>
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









                                    <?php


                                    foreach ($listarVistoriasPage as $vistoria) :

                                        $data_realizacao_vistoria = date('d/m/Y', strtotime($vistoria['data_realizacao_vistoria']));

                                        $id_sistema = $vistoria['modulo'];
                                        $id_demanda = $vistoria['id'];
                                        
                                        $query = $bd->prepare("SELECT * FROM modulos WHERE id = :modulo");
                                        $query->bindValue(':modulo', $id_sistema, PDO::PARAM_STR);
                                        
                                        
                                        try {

                                            $query->execute();
                                            $linhas = $query->fetch(PDO::FETCH_ASSOC);

                                            $code1 = $linhas['name'];
                                        } catch (PDOException $e) {

                                            die($e->getMessage());
                                        }
                                        
                                        
                                        
                                        $query2 = $bd->prepare("SELECT COUNT(demanda_id) FROM historico WHERE demanda_id = :id_demanda");
                                        $query2->bindValue(':id_demanda', $id_demanda, PDO::PARAM_STR);

                                        try {

                                            $query2->execute();
                                            $linhas2 = $query2->fetchColumn();
                                        } catch (PDOException $e) {

                                            die($e->getMessage());
                                        }

                                    ?>



                                        <div class="accordion" id="accordionFlushExample">
                                            <!--<div class="accordion-item">-->
                                            <!--    <h2 class="accordion-header" id="flush-headingOne">-->
                                            <!--        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"-->
                                            <!--            data-bs-target="#flush-collapseOne<?php echo $vistoria['id']; ?>" aria-expanded="false"-->
                                            <!--            aria-controls="flush-collapseOne">-->

                                            <!--        </button>-->
                                            <!--    </h2>-->
                                            <!--    <div id="flush-collapseOne<?php echo $vistoria['id']; ?>" class="accordion-collapse collapse"-->
                                            <!--        aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">-->
                                            <!--        <div class="accordion-body">-->
                                            <!--        </div>-->
                                            <!--    </div>-->
                                            <!--</div>-->


                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne<?php echo $vistoria['id']; ?>" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                                        <div class="row titleacc">

                                                            <div class="col-lg-2">
                                                                <strong>Task:</strong> <?php echo $vistoria['id']; ?>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <strong>Título:</strong> <?php echo $vistoria['titulo']; ?>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <strong>Módulo:</strong> <?php echo $code1 ?>
                                                            </div>
                                                            <div class="col-lg-2" style="display: flex;">
                                                                <div class="form-check form-switch">
                                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                                                                </div>
                                                                <a type="button" style="color:#0d6efd" class="btn style-action" href="?funcao=editar&id=<?php echo $vistoria['id']; ?>">
                                                                    <i class="fas fa-pencil-alt" aria-hidden="true"></i></a>

                                                                <a type="button" style="color:#dc3545" class="btn style-action" 
                                                                onclick="return confirm('Deseja realmente excluir a vistoria <?php echo $vistoria['id']; ?> ?');" href="?acao=deletar&id=<?php echo $vistoria['id']; ?>">
                                                                    <i class="fas fa-trash" aria-hidden="true"></i></a>

                                                            </div>


                                                        </div>

                                                    </button>
                                                </h2>
                                                <div id="panelsStayOpen-collapseOne<?php echo $vistoria['id']; ?>" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne">
                                                    <div class="accordion-body">
                                                        
                                                        <div class="headermodal" style="display: flex;justify-content: flex-end;margin-bottom:25px">
                                                            <div class="col-lg-6" style="text-align: left;">
                                                            <span style="padding: 5px;margin-right:20px;background-color:#FFE1E1;border-radius:30px;font-size:12px;"><strong>Prioridade:</strong> <?php echo $vistoria['prioridade']; ?></span>
                                                            </div>
                                                            <div class="col-lg-3" style="text-align: right;">
                                                            <span style="padding: 5px;background-color:#E0F3FB;border-radius:30px;font-size:12px;"><strong>Módulo:</strong> <?php echo $code1; ?></span>
                                                            </div>
                                                            <div class="col-lg-3" style="text-align: right;">
                                                            <span style="padding: 5px;background-color:#E0FBE0;border-radius:30px;font-size:12px;"><strong>Data de Criação:</strong> <?php echo $vistoria['data_cadastro']; ?></span>
                                                            </div>
                                                        </div>

                                                        <!--<div class="row titleacc">-->

                                                        <!--    <div class="col-lg-8">-->
                                                        <!--        <strong>Prioridade:</strong> <?php echo $vistoria['prioridade']; ?>-->
                                                        <!--    </div>-->

                                                        <!--    <div class="col-lg-2" style="text-align: right;">-->
                                                        <!--        <strong>Módulo:</strong> <?php echo $code1; ?>-->
                                                        <!--    </div>-->

                                                        <!--    <div class="col-lg-2" style="text-align: right;">-->
                                                        <!--        <strong>Data de criação:</strong> <?php echo $vistoria['data_cadastro']; ?>-->
                                                        <!--    </div>-->
                                                        <!--</div>-->



                                                        <strong style="color:#8A8484">Descrição:</strong> <?php echo $vistoria['descricao']; ?><br><br>
                                                        <strong style="color:#8A8484">Regra de negócio:</strong> <?php echo $vistoria['regra_negocio']; ?><br><br><br>



                                                        <a href="#" class="botaoacc" style="margin-right:15px">
                                                            <i class="fas fa-download" aria-hidden="true" style="margin-right:10px"></i>
                                                            Baixar imagem</a>
                                                        
                                                        <?php if ($linhas2 <= 0) { ?>
                                                            <a href="?funcao=editar&id=<?php echo $vistoria['id']; ?>" class="botaoacc2">
                                                                <i class="fas fa-plus" aria-hidden="true" style="margin-right:10px"></i>
                                                                Adicionar histórico</a>
                                                        <?php } else {  ?>
                                                            <a href="?funcao=ver&id=<?php echo $vistoria['id']; ?>" class="verhistorico">
                                                                <i class="fas fa-eye" aria-hidden="true" style="margin-right:10px"></i>
                                                                Visualizar histórico</a>
                                                        <?php } ?>

                                                        
                                                    </div>
                                                </div>
                                            </div>

                                        </div>




                                    <?php endforeach; ?>


































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

                                        if (!empty($_GET['busca']) && !empty($_GET['modulo'])) {
                                            $busca = '&busca=' . $_GET['busca'];
                                            $modulo = '&modulo=' . $_GET['modulo'];
                                        } else {
                                            $busca = '';
                                            $modulo = '';
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




        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <?php
                        if (@$_GET['funcao'] == 'editar' || @$_GET['funcao'] == 'ver') {
                            
                            if(@$_GET['funcao'] == 'editar') {
                                $tituloModal = "Adicionar histórico";
                            } else{
                                $tituloModal = "Histórico";
                            }
                            
                            $id2 = $_GET['id'];
                            $user_id = $_SESSION['id'];

                            $query = $bd->query("SELECT * FROM demandas where id = '" . $id2 . "' ");
                            $res = $query->fetchAll(PDO::FETCH_ASSOC);
                            $titulo = $res[0]['titulo'];
                            $descricao = $res[0]['descricao'];
                            $prioridade = $res[0]['prioridade'];
                            $modulo = $res[0]['modulo'];
                            $data_cadastro = $res[0]['data_cadastro'];


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
                        } else {
                            $tituloModal = "Inserir Registro";
                        }


                        ?>
                        <h5 class="modal-title" id="exampleModalLabel"><?php echo $tituloModal ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="headermodal" style="display: flex;justify-content: flex-end;">
                            <span style="margin-right:20px;background-color:#FFE1E1;border-radius:30px;font-size:11px;padding-right: 8px;padding-left: 8px;"><strong>Prioridade:</strong> <?php echo $prioridade ?></span>
                            <span style="margin-right:20px;background-color:#E0F3FB;border-radius:30px;font-size:11px;padding-right: 8px;padding-left: 8px;"><strong>Módulo:</strong> <?php echo $modulo ?></span>
                            <span style="margin-right:20px;background-color:#E0FBE0;border-radius:30px;font-size:11px;padding-right: 8px;padding-left: 8px;"><strong>Data de Criação:</strong> <?php echo $data_cadastro ?></span>
                        </div>
                        <span><strong>Título:</strong> <?php echo $titulo ?></span> <br>
                        <span style="word-break: break-all;"><strong>Descrição:</strong> <?php echo $descricao ?></span>
                        
                        

                        <?php if (@$_GET['funcao'] == 'editar') { ?>
                        
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row" style="display: flex;align-items: center;">
                                <div class="col-lg-12">
                                    <div class="form-group" style="margin-bottom:20px">
                                        <input type="hidden" class="form-control cnpj" placeholder="Descrição" id="demanda_id" name="demanda_id" value="<?php echo $id2 ?>" required="">
                                        <input type="hidden" class="form-control cnpj" placeholder="Descrição" id="user_id" name="user_id" value="<?php echo $user_id ?>" required="">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group" style="margin-bottom:20px">
                                        <textarea type="text" class="form-control cnpj" placeholder="Descrição" id="mensagem" name="mensagem" value="" required=""></textarea>

                                    </div>
                                </div>


                                <div class="col-lg-6" style="text-align: left">
                                    <span><strong>Data:</strong> <?php echo $dataExpiracao = date('d/m/Y'); ?></span>
                                </div>

                                <div class="col-lg-6" style="text-align: right">


                                    <?php

                                    if (isset($_POST['cadastrar_historico'])) {

                                        $mensagem = htmlspecialchars($_POST['mensagem']);
                                        $demanda_id = htmlspecialchars($_POST['demanda_id']);
                                        $user_id = htmlspecialchars($_POST['user_id']);
                                        // $IE = htmlspecialchars($_POST['IE']);
                                        // $dia_do_pagamento = htmlspecialchars($_POST['dia_do_pagamento']);
                                        // $CEP = htmlspecialchars($_POST['CEP']);

                                        // $xLgr = htmlspecialchars($_POST['xLgr']);
                                        // $nro = htmlspecialchars($_POST['nro']);
                                        // $xCpl = htmlspecialchars($_POST['xCpl']);
                                        // $xBairro = htmlspecialchars($_POST['xBairro']);
                                        // $id_uf = htmlspecialchars($_POST['id_uf']);
                                        // $id_municipio = htmlspecialchars($_POST['id_municipio']);
                                        // $fone = htmlspecialchars($_POST['fone']);

                                        // $email = htmlspecialchars($_POST['email']);
                                        // $senha = htmlspecialchars($_POST['senha']);
                                        // $status = htmlspecialchars($_POST['status']);


                                        $cadastro = $acoes->cadastrar_historico(
                                            $mensagem,
                                            $demanda_id,
                                            $user_id
                                            // $IE,
                                            // $dia_do_pagamento,
                                            // $CEP,
                                            // $xLgr,
                                            // $nro,
                                            // $xCpl,
                                            // $xBairro,
                                            // $id_uf,
                                            // $id_municipio,
                                            // $fone,
                                            // $email,
                                            // $senha,
                                            // $status
                                        );

                                        if ($cadastro) {
                                            echo '<script type="text/javascript">toastr.success("Histórico adicionado com sucesso.")</script>';
                                            echo "<script>window.location.href = 'demandas.php';</script>";
                                        }
                                    }


                                    ?>



















                                    <button type="submit" name="cadastrar_historico" class="btn btn-primary" style="background-color:#42B1D4;border-color:#42B1D4;margin-bottom:20px;">+ Adicionar histórico</button>
                                </div>
                            </div>
                            <!-- /.card -->

                        </form>
                        
                        <?php } ?>
                        
                        


                        


                        <div class="overflow" <?php if($_GET['funcao'] == 'ver') {echo 'style="height:85% !important;"';} ?>>
                            <?php

                            foreach ($res2 as $res) :


                                $id_user = $res['user_id'];
                                $query = $bd->prepare("SELECT * FROM usuarios WHERE id = :user_id");
                                $query->bindValue(':user_id', $id_user, PDO::PARAM_STR);

                                try {

                                    $query->execute();
                                    $linhas = $query->fetch(PDO::FETCH_ASSOC);

                                    $code1 = $linhas['nome'];
                                } catch (PDOException $e) {

                                    die($e->getMessage());
                                }

                            ?>



                                <div class="comment">

                                    <span><?php echo $code1; ?></span>
                                    <span style="float: right;font-size: 14px;background: #E0FBE0;border-radius:5px;padding:5px;"><strong>Data comentário:</strong> <?php echo $res['data_comentario']; ?></span><br>
                                    <small>Comentou:</small><br><br>
                                    
                                    <small>Descrição:</small><br>
                                    <span><?php echo $res['mensagem']; ?></span><br>

                                    <span style="float:right">
                                        <div class="col-lg-2" style="display: flex;">

                                            <a type="button" style="color:#0d6efd" class="btn style-action" onclick="confirmaAcaoExcluir('Deseja realmente excluir essa Empresa? Essa ação não poderá ser desfeita.', '/empresas/delete/1')">
                                                <i class="fas fa-pencil-alt" aria-hidden="true"></i></a>

                                            <a type="button" style="color:#dc3545" class="btn style-action" 
                                            onclick="return confirm('Deseja realmente excluir o comentário <?php echo $res['id']; ?> ?');" href="?acao=deletarhis&id=<?php echo $res['id']; ?>">
                                                <i class="fas fa-trash" aria-hidden="true"></i></a>

                                        </div>
                                    </span><br>

                                </div>






                            <?php endforeach; ?>
                        </div>









                    </div>
                    <!--<div class="modal-footer">-->
                    <!--  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>-->
                    <!--  <button type="button" class="btn btn-primary">Save changes</button>-->
                    <!--</div>-->
                </div>
            </div>
        </div>



        <?php


        if (@$_GET["funcao"] != null && @$_GET["funcao"] == "editar") {
            echo "<script>
            var myModal = new bootstrap.Modal(document.getElementById('exampleModal'), {
              keyboard: false
            })
            
            var modalToggle = document.getElementById('exampleModal') // relatedTarget
                                myModal.show(modalToggle)</script>";
        }
        
        
        if (@$_GET["funcao"] != null && @$_GET["funcao"] == "ver") {
            echo "<script>
            var myModal = new bootstrap.Modal(document.getElementById('exampleModal'), {
              keyboard: false
            })
            
            var modalToggle = document.getElementById('exampleModal') // relatedTarget
                                myModal.show(modalToggle)</script>";
        }
        ?>
























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