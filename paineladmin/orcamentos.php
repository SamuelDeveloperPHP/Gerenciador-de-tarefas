<?php
include 'verifica-sessionempresa.php';
include 'config.php';
include 'conexao.php';
include 'Acoes.php';

$paginaLink = basename($_SERVER['SCRIPT_NAME']);

$id = $_SESSION['id_empresa'];
$exibirdados = $acoes->pegar_statusempresa($id);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Master Clube - Sinsitro</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <script src="js/functions.js"></script>
    <style>
        .col-2.xlado {
            width: 20px;
            height: 0px !important;
            line-height: 90px;
        }

        .mda-form-group {
            position: relative;
            padding: 18px 0 24px;
        }

        .mda-form-control {
            position: relative;
            z-index: 5;
            width: 100%;
            height: 34px;
            padding: 2px;
            color: inherit;
            background: transparent;
            border: 0;
            border-bottom: 1px solid #bbbaba;
            border-radius: 0;
            box-shadow: none;
        }

        label {
            position: absolute;
            top: 0;
            left: 0;
            z-index: 0;
            display: inline-block;
            font-size: .85em;
            opacity: .8;
            transition: all .2s ease;
        }

        :focus {
            outline: 0 !important;
        }

        input.mda-form-control.ng-pristine.ng-invalid.ng-touched:focus {
            padding-bottom: 1px;
            border-color: #003584;
            border-bottom-width: 2px;
        }

        input:focus {
            padding-bottom: 1px;
            border-color: #003584;
            border-bottom-width: 2px;
        }

        .col-sm-12.breadcumb {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        h1.text-left.text-breadcumb {
            font-size: 16px;
        }

        .content-wrapper>.content {
            padding: 0 1.5rem;
        }

        .content-header {
            padding: 15px 1.5rem;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <?php include 'header.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
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
            </section>

            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="card">
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


                        <div class="card-tools">

                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                <i class="fas fa-times"></i>
                            </button>
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


                            <form action="" method="post" class="mb-5">


                                <div class="text-center mb-4">


                                    <h1 class="h3 mb-3">
                                        Cadastrar equipamento
                                    </h1>

                                </div>
                                <div class="row">

                                    <div class="col-4">
                                        <div class="mda-form-group">
                                            <input type="hidden" name="id_empresa" value="<?php echo $id ?>" class="mda-form-control ng-pristine ng-invalid ng-touched" autofocus required>
                                            <input type="text" name="cod_eqp" class="mda-form-control ng-pristine ng-invalid ng-touched" autofocus required>
                                            <label for="cod_eqp">Código</label>
                                        </div>
                                    </div>

                                    <div class="col-2">
                                        <div class="mda-form-group">
                                            <select class="mda-form-control ng-untouched ng-pristine ng-valid" aria-label=".form-select-lg example" name="situacao_eqp" id="situacao_eqp" required>

                                                <option value="Ativo">Ativo</option>
                                                <option value="Desativo">Desativado</option>
                                            </select>
                                            <label for="situacao_eqp">Situação</label>
                                        </div>
                                    </div>

                                    <div class="col-2">
                                        <div class="mda-form-group">

                                            <select class="mda-form-control ng-untouched ng-pristine ng-valid" aria-label=".form-select-lg example" name="tipo_centro" id="tipo_centro" required>

                                                <option value="Administracao">1 - Administração</option>
                                                <option value="Pre-Impressao">2 - Pré-Impressao</option>
                                                <option value="Impressao">3 - Administração</option>
                                                <option value="Acabamento">4 - Acabamento</option>
                                            </select>
                                            <label for="tipo_centro">Tipo de centro</label>
                                        </div>
                                    </div>

                                    <div class="col-2">

                                        <input type="hidden" name="status1" class="mda-form-control ng-pristine ng-invalid ng-touched" value="Nunca" readonly>
                                        <?php
                                        $query = $bd->prepare("SELECT associacao FROM associacoes");
                                        $query->execute();

                                        if ($query->rowCount() > 0) {
                                            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                                $dados = $dados . "\"" . $row["associacao"] . "\",";
                                            }
                                        }
                                        $dados = substr($dados, 0, -1); //retira a ultima virgula

                                        ?>

                                        <div class="mda-form-group">
                                            <select class="mda-form-control ng-untouched ng-pristine ng-valid" aria-label=".form-select-lg example" name="mapa_simulado1" id="mapa_simulado1" required>

                                                <option value="Manter">Manter</option>
                                                <option value="Outros">Outros</option>
                                            </select>
                                            <label for="mapa_simulado1">Mapa simulado 1</label>
                                        </div>
                                    </div>

                                    <div class="col-2">
                                        <div class="mda-form-group">
                                            <select class="mda-form-control ng-untouched ng-pristine ng-valid" aria-label=".form-select-lg example" name="mapa_simulado2" id="mapa_simulado2" required>

                                                <option value="Manter">Manter</option>
                                                <option value="Outros">Outros</option>
                                            </select>
                                            <label for="mapa_simulado2">Mapa simulado 2</label>
                                        </div>
                                    </div>










                                </div>

                                <div class="row">

                                    <div class="col-6">
                                        <div class="mda-form-group">
                                            <div class="mda-form-group">
                                                <input type="text" name="descricao" class="mda-form-control ng-pristine ng-invalid ng-touched" required>
                                                <label for="descricao">Descrição</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-2">
                                        <div class="mda-form-group">
                                            <div class="mda-form-group">
                                                <select class="mda-form-control ng-untouched ng-pristine ng-valid" aria-label=".form-select-lg example" name="tipo_maquina" id="tipo_maquina" required>

                                                    <option value="Arte">0 - Arte</option>
                                                    <option value="CTP">1 - CTP</option>
                                                    <option value="Prova">2 - Prova</option>
                                                    <option value="Gravacao">3 - Gravação</option>
                                                    <option value="Plana">4 - Plana</option>
                                                    <option value="Rotativa">5 - Rotativa</option>
                                                    <option value="CTP">6 - CTP</option>
                                                    <option value="CTP">7 - CTP</option>
                                                    <option value="CTP">8 - CTP</option>
                                                    <option value="CTP">9 - CTP</option>
                                                    <option value="CTP">10 - CTP</option>
                                                    <option value="CTP">12 - CTP</option>
                                                    <option value="CTP">13 - CTP</option>
                                                    <option value="CTP">14 - CTP</option>
                                                    <option value="CTP">15 - CTP</option>
                                                    <option value="CTP">16 - CTP</option>
                                                </select>
                                                <label for="tipo_maquina">Tipo máquina</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-2">
                                        <div class="mda-form-group">
                                            <div class="mda-form-group">
                                                <input type="text" name="formato" class="mda-form-control ng-pristine ng-invalid ng-touched" required>
                                                <label for="formato">Formato</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-2">
                                        <div class="mda-form-group">
                                            <div class="mda-form-group">
                                                <input type="text" name="cores" class="mda-form-control ng-pristine ng-invalid ng-touched" required>
                                                <label for="cores">Cores</label>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-2">
                                        <div class="mda-form-group">
                                            <div class="mda-form-group">
                                                <select class="mda-form-control ng-untouched ng-pristine ng-valid" aria-label=".form-select-lg example" name="tipo_hora" id="tipo_hora" required>
                                                    <option></option>
                                                    <option value="Maquina">M - Maquina</option>
                                                    <option value="Homem">H - Homem</option>
                                                </select>
                                                <label for="tipo_hora">Tipo hora</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-2">
                                        <div class="mda-form-group">
                                            <div class="mda-form-group">
                                                <input type="text" value="145 - h/turno" name="nph_turno" class="mda-form-control ng-pristine ng-invalid ng-touched" required>
                                                <label for="nph_turno">NHP/turno</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-1">
                                        <div class="mda-form-group">
                                            <div class="mda-form-group">
                                                <input type="text" value="1" name="minfunc_maquina" class="mda-form-control ng-pristine ng-invalid ng-touched" required>
                                                <label for="minfunc_maquina">Mn.func/máq.</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-1">
                                        <div class="mda-form-group">
                                            <div class="mda-form-group">
                                                <input type="text" value="0" name="subsidio_preimpr" class="mda-form-control ng-pristine ng-invalid ng-touched" required>
                                                <label for="subsidio_preimpr">Subsídio pré-impr.</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-2">
                                        <div class="mda-form-group">
                                            <div class="mda-form-group">
                                                <input type="text" value="0" name="subsidio_impressao" class="mda-form-control ng-pristine ng-invalid ng-touched" required>
                                                <label for="subsidio_impressao">Subsídio impressão</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-2">
                                        <div class="mda-form-group">
                                            <div class="mda-form-group">
                                                <input type="text" value="0" name="subsidio_acabamento" class="mda-form-control ng-pristine ng-invalid ng-touched" required>
                                                <label for="subsidio_acabamento">Subsídio acabamento</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="mda-form-group">
                                            <div class="mda-form-group">
                                                <input type="text" value="0" name="subsidio_percent" class="mda-form-control ng-pristine ng-invalid ng-touched" required>
                                                <label for="subsidio_percent">% Subsídio</label>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-1">
                                        <div class="mda-form-group">
                                            <div class="mda-form-group">
                                                <input type="text" value="0.00" name="manutencao" class="mda-form-control ng-pristine ng-invalid ng-touched" required>
                                                <label for="manutencao">Manutenção</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-1">
                                        <div class="mda-form-group">
                                            <div class="mda-form-group">
                                                <input type="text" value="0.00" name="materiais_aux" class="mda-form-control ng-pristine ng-invalid ng-touched" required>
                                                <label for="materiais_aux">Mat. aux.</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-2">
                                        <div class="mda-form-group">
                                            <div class="mda-form-group">
                                                <input type="text" value="0.00" name="n_funcionarios" class="mda-form-control ng-pristine ng-invalid ng-touched" readonly required>
                                                <label for="n_funcionarios">Nº Funcionários</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-2">
                                        <div class="mda-form-group">
                                            <div class="mda-form-group">
                                                <input type="text" value="0.00" name="salarios" class="mda-form-control ng-pristine ng-invalid ng-touched" readonly required>
                                                <label for="salarios">Salários</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-2">
                                        <div class="mda-form-group">
                                            <div class="mda-form-group">
                                                <input type="text" value="0.00" name="encargos" class="mda-form-control ng-pristine ng-invalid ng-touched" readonly required>
                                                <label for="encargos">Encargos</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-2">
                                        <div class="mda-form-group">
                                            <div class="mda-form-group">
                                                <input type="text" value="0.00" name="bonus_benef" class="mda-form-control ng-pristine ng-invalid ng-touched" readonly required>
                                                <label for="bonus_benef">Bônus Benefícios</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-2">
                                        <div class="mda-form-group">
                                            <div class="mda-form-group">
                                                <input type="text" value="0.00" name="sal_enc_bon_ben" class="mda-form-control ng-pristine ng-invalid ng-touched" readonly required>
                                                <label for="sal_enc_bon_ben">Sal+enc+bon+ben.</label>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-3">
                                        <div class="mda-form-group">
                                            <div class="mda-form-group">
                                                <input type="text" value="0.00" name="valor_depreciavel" class="mda-form-control ng-pristine ng-invalid ng-touched" readonly required>
                                                <label for="valor_depreciavel">Valor depreciável</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="mda-form-group">
                                            <div class="mda-form-group">
                                                <input type="text" value="0.00" name="valor_depreciavel_mes" class="mda-form-control ng-pristine ng-invalid ng-touched" readonly required>
                                                <label for="valor_depreciavel_mes">Depreciação/mês</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="mda-form-group">
                                            <div class="mda-form-group">
                                                <input type="text" value="0" name="num_maq" class="mda-form-control ng-pristine ng-invalid ng-touched" readonly required>
                                                <label for="num_maq">Nº máquinas</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="mda-form-group">
                                            <div class="mda-form-group">
                                                <input type="text" value="0" name="num_maq_turnos" class="mda-form-control ng-pristine ng-invalid ng-touched" readonly required>
                                                <label for="num_maq_turnos">Nº máq*turnos</label>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <div class="row">

                                    <div class="col-2">
                                        <div class="mda-form-group">
                                            <div class="mda-form-group">
                                                <input type="text" value="0" name="custo_total" class="mda-form-control ng-pristine ng-invalid ng-touched" readonly required>
                                                <label for="custo_total">Custo total</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-1">
                                        <div class="mda-form-group">
                                            <div class="mda-form-group">
                                                <input type="text" value="0" name="nhp_total" class="mda-form-control ng-pristine ng-invalid ng-touched" readonly required>
                                                <label for="nhp_total">NHP Total</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="mda-form-group">
                                            <div class="mda-form-group">
                                                <input type="text" value="0" name="custo_horare" class="mda-form-control ng-pristine ng-invalid ng-touched" readonly required>
                                                <label for="custo_horare">Custo hora real</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="mda-form-group">
                                            <div class="mda-form-group">
                                                <input type="text" value="0" name="custo_horams1" class="mda-form-control ng-pristine ng-invalid ng-touched" readonly required>
                                                <label for="custo_horams1">Custo hora MS1</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="mda-form-group">
                                            <div class="mda-form-group">
                                                <input type="text" value="0" name="custo_horams2" class="mda-form-control ng-pristine ng-invalid ng-touched" readonly required>
                                                <label for="custo_horams2">Custo hora MS2</label>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-12">
                                        <div class="mda-form-group">
                                            <div class="mda-form-group">
                                                <textarea type="textarea" value="0" name="observacoes" class="mda-form-control ng-pristine ng-invalid ng-touched" required></textarea>
                                                <label for="observacoes">Observações (Máximmo 150 caractéres)</label>
                                            </div>
                                        </div>
                                    </div>

                                </div>



                                <p>
                                    <?php

                                    if (isset($_POST['cadastrar_tecnico'])) {

                                        
                                        $cod_eqp = htmlspecialchars($_POST['cod_eqp']);
                                        $situacao_eqp = htmlspecialchars($_POST['situacao_eqp']);
                                        $tipo_centro = htmlspecialchars($_POST['tipo_centro']);
                                        $mapa_simulado1 = htmlspecialchars($_POST['mapa_simulado1']);
                                        $mapa_simulado2 = htmlspecialchars($_POST['mapa_simulado2']);
                                        $descricao = htmlspecialchars($_POST['descricao']);

                                        $tipo_maquina = htmlspecialchars($_POST['tipo_maquina']);
                                        $formato = htmlspecialchars($_POST['formato']);
                                        $cores = htmlspecialchars($_POST['cores']);
                                        $tipo_hora = htmlspecialchars($_POST['tipo_hora']);
                                        $nph_turno = htmlspecialchars($_POST['nph_turno']);
                                        $minfunc_maquina = htmlspecialchars($_POST['minfunc_maquina']);
                                        $subsidio_preimpr = htmlspecialchars($_POST['subsidio_preimpr']);

                                        $subsidio_impressao = htmlspecialchars($_POST['subsidio_impressao']);
                                        $subsidio_acabamento = htmlspecialchars($_POST['subsidio_acabamento']);
                                        $subsidio_percent = htmlspecialchars($_POST['subsidio_percent']);
                                        $manutencao = htmlspecialchars($_POST['manutencao']);
                                        $materiais_aux = htmlspecialchars($_POST['materiais_aux']);
                                        $n_funcionarios = htmlspecialchars($_POST['n_funcionarios']);
                                        $salarios = htmlspecialchars($_POST['salarios']);

                                        $encargos = htmlspecialchars($_POST['encargos']);
                                        $bonus_benef = htmlspecialchars($_POST['bonus_benef']);
                                        $sal_enc_bon_ben = htmlspecialchars($_POST['sal_enc_bon_ben']);
                                        $valor_depreciavel = htmlspecialchars($_POST['valor_depreciavel']);
                                        $valor_depreciavel_mes = htmlspecialchars($_POST['valor_depreciavel_mes']);
                                        $num_maq = htmlspecialchars($_POST['num_maq']);
                                        $num_maq_turnos = htmlspecialchars($_POST['num_maq_turnos']);

                                        $custo_total = htmlspecialchars($_POST['custo_total']);
                                        $nhp_total = htmlspecialchars($_POST['nhp_total']);
                                        $custo_horare = htmlspecialchars($_POST['custo_horare']);
                                        $custo_horams1 = htmlspecialchars($_POST['custo_horams1']);
                                        $custo_horams2 = htmlspecialchars($_POST['custo_horams2']);
                                        $observacoes = htmlspecialchars($_POST['observacoes']);
                                        $id_empresa = htmlspecialchars($_POST['id_empresa']);


                                        $cadastro = $acoes->cadastrar_equipamento(
                                            $cod_eqp,
                                            $situacao_eqp,
                                            $tipo_centro,
                                            $mapa_simulado1,
                                            $mapa_simulado2,
                                            $descricao,
                                            $tipo_maquina,
                                            $formato,
                                            $cores,
                                            $tipo_hora,
                                            $nph_turno,
                                            $minfunc_maquina,
                                            $subsidio_preimpr,
                                            $subsidio_impressao,
                                            $subsidio_acabamento,
                                            $subsidio_percent,
                                            $manutencao,
                                            $materiais_aux,
                                            $n_funcionarios,
                                            $salarios,
                                            $encargos,
                                            $bonus_benef,
                                            $sal_enc_bon_ben,
                                            $valor_depreciavel,
                                            $valor_depreciavel_mes,
                                            $num_maq,
                                            $num_maq_turnos,
                                            $custo_total,
                                            $nhp_total,
                                            $custo_horare,
                                            $custo_horams1,
                                            $custo_horams2,
                                            $observacoes,
                                            $id_empresa
                                        );

                                        if ($cadastro) {
                                            echo '<script type="text/javascript">toastr.success("Equipamento alterado com sucesso. "toast-bottom-right", "bottom right" {"toast-bottom-right", "bottom right")</script>';
                                        }
                                    }


                                    ?>
                                </p>


                                <button class="btn btn-lg btn-primary btn-block" name="cadastrar_tecnico" type="submit">Gravar</button>



                            </form>

                        </div>
                    </div>
                    <!-- /.card-body -->
                    <!-- /.card-footer-->
                </div>
                <!-- /.card -->

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
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
    <script src="../../js/functions.js"></script>
</body>

</html>