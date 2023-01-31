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
  <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="./plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./dist/css/adminlte.min.css">
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
</style>

<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-header text-center">
        <img src="./dist/img/logosango.png" alt="AdminLTE Logo" class="brand-image img-circle" style="width: 204px;height: 81px;">
      </div>
      <div class="card-body" style="padding: 0px 37px 54px 37px;">
        <p class="login-box-msg">Faça login para iniciar sua sessão</p>
        <form class="form-signin" action="" method="post">
          <div class="input-group mb-3">
            <input value="<?= $email ?>" type="email" name="email" class="form-control" placeholder="Email">
            <div class="input-group-append">
            </div>
          </div>
          <div class="input-group mb-3">
            <input value="<?= $senha ?>" type="password" name="senha" class="form-control" placeholder="Password">
            <div class="input-group-append">
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                
              </div>
            </div>
            <div class="col-4" style="text-align: right;">
              <?php include 'verifica-login.php'; ?>
              <a href="cadastro.php" style="color:#807E7E">Cadastre-se</a>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <?php include 'verifica-login.php'; ?>
              <button type="submit" class="btn btn-primary btn-block" style="width:100%; background-color:#1F53A0">Acessar</button>
              <input type="hidden" name="env" value="login">
            </div>
          </div>
        <!--</form>-->
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