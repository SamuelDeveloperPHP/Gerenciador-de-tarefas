<?php

include 'config.php';
include 'conexao.php';
include 'Acoes.php';

$email = (isset($_COOKIE['CookieEmail'])) ? base64_decode($_COOKIE['CookieEmail']) : '';
$senha = (isset($_COOKIE['CookieSenha'])) ? base64_decode($_COOKIE['CookieSenha']) : '';
$lembrete = (isset($_COOKIE['CookieLembrete'])) ? base64_decode($_COOKIE['CookieLembrete']) : '';
$checked = ($lembrete == 'SIM') ? 'checked' : '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sango IT Solutions</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon2.ico">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
</head>
<style>
    .card-header.text-center {
        border-bottom: none;
    }

    input.form-control {
        background-color: #F3F3F3;
        border-radius: 4px !important;
        border: 0.5px solid #DBDBDB;
        color: #4F4F4F;
    }

    input::placeholder {
        color: #4F4F4F !important;
    }

    .card {
        box-shadow: 0px 0px 2px rgb(0 0 0 / 25%);
        border-radius: 10px;
    }

    .login-page,
    .register-page {
        background-color: #ffffff !important;

    }

    select.form-control {
        background-color: #f3f3f3;
        color: #4F4F4F;
    }

    input.btn.btn-success.toastrDefaultSuccess {
        background: #1F53A0;
        border-radius: 5px;
        border-color: #1F53A0;
    }

    .card-footer {
        background-color: transparent;
        padding-top: 0px !important;
    }

    .card-body {
        padding-bottom: 0px;
        padding-top: 0px;
    }
</style>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-header text-center">
                <img src="../../dist/img/logosango.png" alt="AdminLTE Logo" class="brand-image img-circle" style="width: 204px;height: 81px;">
            </div>
            <div class="card-body">
                <!--<p class="login-box-msg">Faça login para iniciar sua sessão</p>-->

                <form action="" method="post">
                    <div class="card-body">
                        <div class="form-group">
                            <input type="text" id="nome" name="nome" class="form-control" placeholder="Nome completo">
                            <input type="hidden" id="tipo" name="tipo" class="form-control" value="User">
                        </div>

                        <div class="form-group">
                            <select class="form-control" name="nome_sistema" required>
                                <option>Selecione sua empresa</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="email" id="email" name="email" class="form-control" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input type="hidden" id="contato" name="contato" class="form-control" placeholder="Contato">
                            <input type="hidden" id="status" name="status" class="form-control" value="Ativo" placeholder="Contato">
                        </div>
                        <div class="form-group">
                            <input type="password" name="senha" class="form-control" id="senha" placeholder="Senha">
                        </div>
                        <div class="form-group">
                            <input type="password" name="confirmasenha" class="form-control" id="confirmasenha" placeholder="Confirmar senha">
                        </div>


                        <!--<div class="form-group">-->
                        <!--  <label for="exampleInputPassword1">Sexo</label>-->
                        <!--  <select class="form-control" name="sexo" required>-->
                        <!--    <option value="0">Feminino</option>-->
                        <!--    <option value="1">Masculino</option>-->
                        <!--  </select>-->
                        <!--</div>-->
                        <!--<div class="form-group">-->
                        <!--  <label for="exampleInputFile">Imagem de perfil</label>-->
                        <!--  <div class="input-group">-->
                        <!--    <div class="custom-file">-->
                        <!--      <input type="file" class="custom-file-input" accept="image/*" name="userfile">-->
                        <!--      <label class="custom-file-label" for="exampleInputFile">Escolher arquivo</label>-->
                        <!--    </div>-->
                        <!--    <div class="input-group-append">-->
                        <!--      <span class="input-group-text">Upload</span>-->
                        <!--    </div>-->
                        <!--  </div>-->
                        <!--</div>-->
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <input style="width:100%" type="submit" value="Cadastrar" name="cadastrar_tecnico" class="btn btn-success toastrDefaultSuccess">
                        <!--<input style="width:100%" type="submit" value="Cadastrar" name="cadastrar_tecnico" class="btn btn-success toastrDefaultSuccess">-->
                        <input type="hidden" name="env" value="cad">
                    </div>
                </form>
                <!--<a href="index" style="float: right;text-align: center;width: 100% !important;">Login</a>-->
                <p>
                    <?php

                    if (isset($_POST['cadastrar_tecnico'])) {


                        $nome = htmlspecialchars($_POST['nome']);
                        $tipo = htmlspecialchars($_POST['tipo']);
                        $nome_sistema = htmlspecialchars($_POST['nome_sistema']);
                        $email = htmlspecialchars($_POST['email']);
                        $contato = htmlspecialchars($_POST['contato']);
                        $status = htmlspecialchars($_POST['status']);
                        $senha = htmlspecialchars($_POST['senha']);


                        $cadastro = $acoes->cadastrar_usuario2(
                            $nome,
                            $tipo,
                            $nome_sistema,
                            $email,
                            $contato,
                            $status,
                            $senha
                        );

                        if ($cadastro) {
                            echo '<script type="text/javascript">toastr.success("Usuário cadastrado com sucesso.")</script>';
                        }
                    }


                    ?>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
</body>

</html>