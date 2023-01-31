<?php
$paginaLink = basename($_SERVER['SCRIPT_NAME']);




?>

<head>
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="stylesheet" href="./assets/styles.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<style>
    .brand-link {
        text-align: center;
    }

    .brand-link .brand-image {
        float: none;
        /* line-height: .8; */
        /* margin-left: 0.8rem; */
        /* margin-right: 0.5rem; */
        /* margin-top: -3px; */
        max-height: 81px;
        width: 204px;
        height: 81px;
    }

    :not(.layout-fixed) .main-sidebar {
        height: inherit;
        min-height: 100%;
        position: fixed;
        top: 0;
        border-radius: 0px 16px 16px 0px;
    }

    .sidebar {
        height: calc(100% - (3.5rem + 1px));
        min-height: 100%;
        position: absolute;
        width: 100%;
        display: flex;
        justify-content: center;
    }

    nav.mt-2 {
        height: 100% !important;
        position: absolute;
        display: flex;
        text-align: center;
    }

    .nav-sidebar>.nav-item {
        margin-bottom: 13px;
        background: rgba(196, 196, 196, 0.14);
        border-radius: 5px;
        padding: 4px;
    }

    li.nav-item:hover {
        background: none !important;
    }

    li.nav-item.green:hover {
        background: rgba(30, 89, 89, 0.14) !important;
    }

    li.nav-item {
        font-weight: 800 !important;
    }

    .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active,
    .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link.active {
        background-color: #1E595924;
        color: #4A4949;
    }

    .navbar-white {
        background-color: #ffffff;
    }

    .content-wrapper {
        background-color: #ffffff;
    }

    .elevation-4 {
        box-shadow: 0 0px 2px rgba(0, 0, 0, .22) !important;
    }

    .main-header {
        border-bottom: none !important;
    }

    nav.main-header.navbar.navbar-expand.navbar-white.navbar-light {
        padding-right: 50px;
    }

    li.nav-item.green {
        background: rgba(30, 89, 89, 0.14) !important;
        box-shadow: none !important;

    }

    [class*=sidebar-light] .brand-link {
        border-bottom: none !important;
    }

    li.nav-item a svg {
        font-size: 12px !important;
        width: 17px;
        padding-bottom: 3px;
        margin-left: -3px;
    }

    span.material-icons {
        font-size: 17px !important;
        width: 17px;
        padding-bottom: 0px;
        margin-left: -3px;
    }
</style>
<script src="../js/functions.js"></script>

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <ul class="navbar-nav ml-auto">

        <li class="nav-item">
            <a class="nav-link" data-widget="" data-slide="" href="#" role="button">
                <img src="./assets/profile.png" width="40px" style="margin-right:15px">
                Administrador
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="../dist/img/masterlogo.png" alt="Sistema Sango" class="brand-image img-circle" style="opacity: .8">
        <span class="brand-text font-weight-light"></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- MENU PARA PERMISSOES DE ADMIN -->

                <?php if ($_SESSION['tipo'] == "AdminDono") { ?>

                    <li class="nav-item">
                        <a href="cadastrardemandas.php" class="nav-link">
                            <p>Cadastrar Demandas</p>
                        </a>
                    </li>
                    <li class="nav-item green">
                        <a href="demandas.php" class="nav-link">
                            <p>Demandas</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="cadastrosistemas.php" class="nav-link">
                            <p>Sistemas</p>
                        </a>
                    </li>
                    <li class="nav-item green">
                        <a href="cadastromodulos.php" class="nav-link">
                            <p>Módulos</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="usuarios.php" class="nav-link">
                            <p>Usuarios</p>
                        </a>
                    </li>

                <?php } else { ?>
                    <li class="nav-item">
                        <a href="cadastrardemandas.php" class="nav-link">
                            <p>Cadastrar Demandas</p>
                        </a>
                    </li>
                    <li class="nav-item green">
                        <a href="demandas.php" class="nav-link">
                            <p>Demandas</p>
                        </a>
                    </li>
                <?php } ?>

                <li class="nav-item" style="bottom: 34px !important;align-self: center;text-align: center;margin: auto;position: fixed;background-color: #F5F5F5 !important;padding: 1px;font-size: 14px;height: 34px;line-height: 0px;">
                    <a class="nav-link" style="font-weight: 500;color:red;display: flex;align-items: center;" data-widget="" data-slide="" href="../logout.php" role="button">
                        <span class="material-icons" style="    color: red;">
                            logout
                        </span>
                        Sair
                    </a>
                </li>
            </ul>

        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>