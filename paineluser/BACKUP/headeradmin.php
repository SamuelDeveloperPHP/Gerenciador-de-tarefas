<?php
$paginaLink = basename($_SERVER['SCRIPT_NAME']);

if ($_GET['page'] == 'sinistro') {
    $_SESSION['variable'] = "Sinistro";
} elseif ($_GET['page'] == 'cadastro') {
    $_SESSION['variable'] = "Cadastro";
}



?>
<head>
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="stylesheet" href="./assets/styles.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
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
.sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active, .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link.active {
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
    box-shadow: 0 0px 2px rgba(0,0,0,.22)!important;
}
.main-header {
    border-bottom:none !important;
}
nav.main-header.navbar.navbar-expand.navbar-white.navbar-light {
    padding-right: 50px;
}
li.nav-item.green {
    background: rgba(30, 89, 89, 0.14) !important;
    box-shadow: none !important;
    
}
[class*=sidebar-light] .brand-link {
    border-bottom: none  !important;
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
        <img src="../../dist/img/masterlogo.png" alt="AdminLTE Logo" class="brand-image img-circle" style="opacity: .8">
        <span class="brand-text font-weight-light"></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <!--<div class="user-panel mt-3 pb-3 mb-3 d-flex">-->
        <!--    <div class="image">-->
        <!--        <img src="<?php echo $_SESSION['foto'] ?>" class="img-circle elevation-2" alt="User Image">-->
        <!--    </div>-->
        <!--    <div class="info">-->
        <!--        <a href="perfil.php" class="d-block"><?php echo $_SESSION['nome']; ?></a>-->
        <!--    </div>-->
        <!--</div>-->

        <!-- SidebarSearch Form -->
        <!--<div class="form-inline">-->
        <!--    <div class="input-group" data-widget="sidebar-search">-->
        <!--        <input class="form-control form-control-sidebar" type="search" placeholder="Pesquisar" aria-label="Search">-->
        <!--        <div class="input-group-append">-->
        <!--            <button class="btn btn-sidebar">-->
        <!--                <i class="fas fa-search fa-fw"></i>-->
        <!--            </button>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <!-- <li class="nav-item">
                    <a href="../../dashboard-admin.php" <?php if ($paginaLink == "dashboard-admin.php") {
                                                            echo 'class="nav-link active"';
                                                        } else {
                                                            echo 'class="nav-link"';
                                                        } ?>>
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Inicío</p>
                    </a>
                </li> -->
                <!-- <li class="nav-item">
                    <a href="chat/index.php" <?php if ($paginaLink == "chat/index.php") {
                                                    echo 'class="nav-link active"';
                                                } else {
                                                    echo 'class="nav-link"';
                                                } ?>>
                        <i class="nav-icon fas fa-file"></i>
                        <p>Conversas</p>
                    </a>
                </li> 
                <!--<li class="nav-item">-->
                <!--    <a href="#" class="nav-link">-->
                <!--        <i class="nav-icon far fa-calendar-alt"></i>-->
                <!--        <p>-->
                <!--            Calendário-->
                <!--            <span class="badge badge-info right">2</span>-->
                <!--        </p>-->
                <!--    </a>-->
                <!--</li>-->
                <!-- <li class="nav-item">
                    <a href="data.php" <?php if ($paginaLink == "data.php") {
                                            echo 'class="nav-link active"';
                                        } else {
                                            echo 'class="nav-link"';
                                        } ?>>
                        <i class="nav-icon fas fa-table"></i>
                        <p>Espelhos</p>
                    </a>
                </li> -->
                <!-- <li class="nav-item">
                    <a href="pages/charts/chartjs.html" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>Gráficos</p>
                    </a>
                </li> -->
                <!-- MENU PARA PERMISSOES DE ADMIN -->
                <?php if ($_SESSION['tipo'] == "User") { ?>
                    
                    <li class="nav-item">
                        <a href="cadastrardemandas.php" <?php if ($paginaLink == "cadastrardemandas.php") {
                                                                echo 'class="nav-link active"';
                                                            } else {
                                                                echo 'class="nav-link"';
                                                            } ?>>
                            <p>Cadastrar Demandas</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="demandas.php" <?php if ($paginaLink == "demandas.php") {
                                                                echo 'class="nav-link active"';
                                                            } else {
                                                                echo 'class="nav-link"';
                                                            } ?>>
                            <p>Demandas</p>
                        </a>
                    </li>
                    
                    <li class="nav-item" style="bottom: 0 !important;align-self: center;text-align: center;margin: auto;position: fixed;">
                        <a class="nav-link" style="color:red" data-widget="" data-slide="" href="../logout.php" role="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-door-open" viewBox="0 0 16 16">
                                <path d="M8.5 10c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z" />
                                <path d="M10.828.122A.5.5 0 0 1 11 .5V1h.5A1.5 1.5 0 0 1 13 2.5V15h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V1.5a.5.5 0 0 1 .43-.495l7-1a.5.5 0 0 1 .398.117zM11.5 2H11v13h1V2.5a.5.5 0 0 0-.5-.5zM4 1.934V15h6V1.077l-6 .857z" />
                            </svg>
                            Sair
                        </a>
                    </li>












                    <!-- MENU PARA PERMISSOES DE SINISTRO -->
                <?php } else if ($_SESSION['tipo'] == "Sinistro") { ?>
                    <li class="nav-header" style="text-decoration: underline;"><strong>SINISTRO</strong>
                        <span class="right badge badge-danger" style="float:right; margin-top:5px;">Setor</span>
                    </li>
                    <li class="nav-item">
                        <a href="dashboard-func.php?page=Sinistro" <?php if ($_GET['page'] == 'Sinistro') {
                                                                echo 'class="nav-link active"';
                                                            } else {
                                                                echo 'class="nav-link"';
                                                            } ?>>
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Inicío</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="detalhessin.php" <?php if ($paginaLink == "detalhessin.php") {
                                                        echo 'class="nav-link active"';
                                                    } else {
                                                        echo 'class="nav-link"';
                                                    } ?>>
                            <i class="nav-icon fas fa-chart-bar"></i>
                            <p>Detalhes - Espelhos</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="data.php" <?php if ($paginaLink == "data.php") {
                                                echo 'class="nav-link active"';
                                            } else {
                                                echo 'class="nav-link"';
                                            } ?>>
                            <i class="nav-icon fas fa-table"></i>
                            <p>Espelhos</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="cadastrarespelho.php" <?php if ($paginaLink == "cadastrarespelho.php") {
                                                            echo 'class="nav-link active"';
                                                        } else {
                                                            echo 'class="nav-link"';
                                                        } ?>>
                            <i class="nav-icon fas fa-edit"></i>
                            <p>Cadastrar Espelho</p>
                        </a>
                    </li>
                    <li class="nav-item">
                                <a href="detalhesaco.php" <?php if ($paginaLink == "detalhesaco.php") {
                                                            echo 'class="nav-link active"';
                                                        } else {
                                                            echo 'class="nav-link"';
                                                        } ?>>
                                    <i class="nav-icon fas fa-chart-bar"></i>
                                    <p>Detalhes - Acordos</p>
                                </a>
                            </li>
                    <li class="nav-item">
                        <a href="dataac.php" <?php if ($paginaLink == "dataac.php") {
                                                    echo 'class="nav-link active"';
                                                } else {
                                                    echo 'class="nav-link"';
                                                } ?>>
                            <i class="nav-icon fas fa-book"></i>
                            <p>Acordos</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="cadastrarac.php" <?php if ($paginaLink == "cadastrarac.php") {
                                                        echo 'class="nav-link active"';
                                                    } else {
                                                        echo 'class="nav-link"';
                                                    } ?>>
                            <i class="nav-icon fas fa-edit"></i>
                            <p>Acordo para Quitação</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="dataac2.php" <?php if ($paginaLink == "dataac2.php") {
                                                    echo 'class="nav-link active"';
                                                } else {
                                                    echo 'class="nav-link"';
                                                } ?>>
                            <i class="nav-icon fas fa-table"></i>
                            <p>Acionamentos</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="cadastrarac2.php" <?php if ($paginaLink == "cadastrarac2.php") {
                                                        echo 'class="nav-link active"';
                                                    } else {
                                                        echo 'class="nav-link"';
                                                    } ?>>
                            <i class="nav-icon fas fa-edit"></i>
                            <p>Cadastrar Acionamentos</p>
                        </a>
                    </li>

                    <!-- MENU PARA PERMISSOES DE CADASTRO -->
                <?php } else if ($_SESSION['tipo'] == "Cadastro") { ?>
                    <li class="nav-header" style="text-decoration: underline;"><strong>Cadastro</strong>
                        <span class="right badge badge-danger" style="float:right; margin-top:5px;">Setor</span>
                    </li>
                    <li class="nav-item">
                        <a href="../../dashboard-func.php" <?php if ($paginaLink == "dashboard-func.php") {
                                                                echo 'class="nav-link active"';
                                                            } else {
                                                                echo 'class="nav-link"';
                                                            } ?>>
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Inicío</p>
                        </a>
                    </li>


                    <!-- MENU PARA PERMISSOES DE SINISTRO -->
                <?php } else if ($_SESSION['tipo'] == "Financeiro") { ?>
                    <li class="nav-header" style="text-decoration: underline;"><strong>Financeiro</strong>
                        <span class="right badge badge-danger" style="float:right; margin-top:5px;">Setor</span>
                    </li>
                    <li class="nav-item">
                        <a href="../../dashboard-func.php" <?php if ($paginaLink == "dashboard-func.php") {
                                                                echo 'class="nav-link active"';
                                                            } else {
                                                                echo 'class="nav-link"';
                                                            } ?>>
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Inicío</p>
                        </a>
                    </li>
                <?php } else if ($_SESSION['tipo'] == "Comercial") { ?>
                    <li class="nav-header" style="text-decoration: underline;"><strong>Comercial</strong>
                        <span class="right badge badge-danger" style="float:right; margin-top:5px;">Setor</span>
                    </li>
                    <li class="nav-item">
                        <a href="../../dashboard-func.php" <?php if ($paginaLink == "dashboard-func.php") {
                                                                echo 'class="nav-link active"';
                                                            } else {
                                                                echo 'class="nav-link"';
                                                            } ?>>
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Inicío</p>
                        </a>
                    </li>
                <?php }; ?>








                <!-- <li class="nav-item">
                    <a href="cadastrarespelho.php" <?php if ($paginaLink == "cadastrarespelho.php") {
                                                        echo 'class="nav-link active"';
                                                    } else {
                                                        echo 'class="nav-link"';
                                                    } ?>>
                        <i class="nav-icon fas fa-edit"></i>
                        <p>Cadastrar Espelho</p>
                    </a>
                </li> -->
                <!-- <li class="nav-item">
                    <a href="chat/index.php" <?php if ($paginaLink == "chat/index.php") {
                                                    echo 'class="nav-link active"';
                                                } else {
                                                    echo 'class="nav-link"';
                                                } ?>>
                        <i class="nav-icon fas fa-file"></i>
                        <p>Conversas</p>
                    </a>
                </li> -->
                <!-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tree"></i>
                        <p>
                            UI Elements
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/UI/general.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>General</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/UI/icons.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Icons</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/UI/buttons.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Buttons</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/UI/sliders.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sliders</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/UI/modals.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Modals & Alerts</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/UI/navbar.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Navbar & Tabs</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/UI/timeline.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Timeline</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/UI/ribbons.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ribbons</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Forms
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/forms/general.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>General Elements</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/forms/advanced.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Advanced Elements</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/forms/editors.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Editors</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/forms/validation.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Validation</p>
                            </a>
                        </li>
                    </ul>
                </li> -->

                <!-- <li class="nav-header">GERÊNCIA</li> -->
                <!-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>
                            Calendário
                            <span class="badge badge-info right">2</span>
                        </p>
                    </a>
                </li> -->
                <!-- <li class="nav-item">
                    <a href="cadastrar-func.php" <?php if ($paginaLink == "cadastrar-func.php") {
                                                        echo 'class="nav-link active"';
                                                    } else {
                                                        echo 'class="nav-link"';
                                                    } ?>>
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Cadastrar Funcionário
                        </p>
                    </a>
                </li> -->
                <!-- <li class="nav-item">
                    <a href="pagamentpagseguro.php" <?php if ($paginaLink == "pagamentpagseguro.php") {
                                                        echo 'class="nav-link active"';
                                                    } else {
                                                        echo 'class="nav-link"';
                                                    } ?>>
                        <i class="nav-icon fas fa-columns"></i>
                        <p>
                            Pagamentos
                        </p>
                    </a>
                </li> -->
                <!-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-envelope"></i>
                        <p>
                            Mailbox
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/mailbox/mailbox.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Inbox</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/mailbox/compose.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Compose</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/mailbox/read-mail.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Read</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Pages
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/examples/invoice.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Invoice</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/profile.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Profile</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/e-commerce.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>E-commerce</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/projects.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Projects</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/project-add.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Project Add</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/project-edit.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Project Edit</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/project-detail.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Project Detail</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/contacts.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Contacts</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/faq.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>FAQ</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/contact-us.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Contact us</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-plus-square"></i>
                        <p>
                            Extras
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Login & Register v1
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="pages/examples/login.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Login v1</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/examples/register.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Register v1</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/examples/forgot-password.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Forgot Password v1</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/examples/recover-password.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Recover Password v1</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Login & Register v2
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="pages/examples/login-v2.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Login v2</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/examples/register-v2.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Register v2</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/examples/forgot-password-v2.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Forgot Password v2</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/examples/recover-password-v2.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Recover Password v2</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/lockscreen.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lockscreen</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/legacy-user-menu.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Legacy User Menu</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/language-menu.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Language Menu</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/404.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Error 404</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/500.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Error 500</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/pace.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pace</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/blank.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Blank Page</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="starter.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Starter Page</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-search"></i>
                        <p>
                            Search
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/search/simple.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Simple Search</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/search/enhanced.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Enhanced</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">MISCELLANEOUS</li>
                <li class="nav-item">
                    <a href="iframe.html" class="nav-link">
                        <i class="nav-icon fas fa-ellipsis-h"></i>
                        <p>Tabbed IFrame Plugin</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="https://adminlte.io/docs/3.1/" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>Documentation</p>
                    </a>
                </li>
                <li class="nav-header">MULTI LEVEL EXAMPLE</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-circle nav-icon"></i>
                        <p>Level 1</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                            Level 1
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Level 2</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Level 2
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Level 3</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Level 3</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Level 3</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Level 2</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-circle nav-icon"></i>
                        <p>Level 1</p>
                    </a>
                </li>
                <li class="nav-header">LABELS</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-circle text-danger"></i>
                        <p class="text">Important</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-circle text-warning"></i>
                        <p>Warning</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-circle text-info"></i>
                        <p>Informational</p>
                    </a>
                </li>
            </ul> -->
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>