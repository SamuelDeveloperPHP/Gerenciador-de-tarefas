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
</head>
<script src="../js/functions.js"></script>

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="dashboard-func.php" class="nav-link">Início</a>
        </li>
    </ul>

    <!-- SEARCH FORM -->
    <!--<form class="form-inline ml-3">-->
    <!--    <div class="input-group input-group-sm">-->
    <!--        <input class="form-control form-control-navbar" type="search" placeholder="Pesquisar" aria-label="Search">-->
    <!--        <div class="input-group-append">-->
    <!--            <button class="btn btn-navbar" type="submit">-->
    <!--                <i class="fas fa-search"></i>-->
    <!--            </button>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</form>-->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <!-- <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-comments"></i>
                <span class="badge badge-danger navbar-badge">3</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#" class="dropdown-item">
                    <div class="media">
                        <img src="../../dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Teste depois
                                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">Call me whenever you can...</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <div class="media">
                        <img src="../../dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                John Pierce
                                <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">I got your message bro</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <div class="media">
                        <img src="../../dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Nora Silvester
                                <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">The subject goes here</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
            </div>
        </li> -->
        <!-- Notifications Dropdown Menu -->
        <!-- <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">15</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> 4 new messages
                    <span class="float-right text-muted text-sm">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-users mr-2"></i> 8 friend requests
                    <span class="float-right text-muted text-sm">12 hours</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-file mr-2"></i> 3 new reports
                    <span class="float-right text-muted text-sm">2 days</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li> -->
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="" data-slide="" href="../logout.php" role="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-door-open" viewBox="0 0 16 16">
                    <path d="M8.5 10c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z" />
                    <path d="M10.828.122A.5.5 0 0 1 11 .5V1h.5A1.5 1.5 0 0 1 13 2.5V15h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V1.5a.5.5 0 0 1 .43-.495l7-1a.5.5 0 0 1 .398.117zM11.5 2H11v13h1V2.5a.5.5 0 0 0-.5-.5zM4 1.934V15h6V1.077l-6 .857z" />
                </svg>
                Sair
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="../../dist/img/masterlogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
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
                <?php if ($_SESSION['tipo'] == "AdminDono") { ?>
                    <li class="nav-item">
                        <a href="../../dashboard-admin.php" <?php if ($paginaLink == "dashboard-admin.php") {
                                                                echo 'class="nav-link active"';
                                                            } else {
                                                                echo 'class="nav-link"';
                                                            } ?>>
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Inicío</p>
                        </a>
                    </li>
                    <li <?php if ($_GET['page'] == 'Sinistro') {
                            echo 'class="nav-item menu-open"';
                        }
                        if ($paginaLink == 'equipamentos.php') {
                            echo 'class="nav-item menu-open"';
                        }
                        if ($paginaLink == 'detalhessin.php') {
                            echo 'class="nav-item menu-open"';
                        }
                        if ($paginaLink == 'cadastrarEquipamento.php') {
                            echo 'class="nav-item menu-open"';
                        }
                        if ($paginaLink == 'detalhesaco.php') {
                            echo 'class="nav-item menu-open"';
                        }
                        if ($paginaLink == 'dataac.php') {
                            echo 'class="nav-item menu-open"';
                        }
                        if ($paginaLink == 'cadastrarac.php') {
                            echo 'class="nav-item menu-open"';
                        }
                        if ($paginaLink == 'dataac2.php') {
                            echo 'class="nav-item menu-open"';
                        }
                        if ($paginaLink == 'cadastrarac2.php') {
                            echo 'class="nav-item menu-open"';
                        } else {
                            echo 'class="nav-item"';
                        } ?>>



                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p style="text-decoration: underline;">
                                SINISTRO
                                <i class="fas fa-angle-left right"></i>
                                <span class="badge badge-info right">SETOR - 8</span>

                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="dashboard-func.php?page=Sinistro" <?php if ($_GET['page'] == 'Sinistro') {
                                                                                echo 'class="nav-link active"';
                                                                            } else {
                                                                                echo 'class="nav-link"';
                                                                            } ?>>
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="detalhessin.php" <?php if ($paginaLink == "detalhessin.php") {
                                                                echo 'class="nav-link active"';
                                                            } else {
                                                                echo 'class="nav-link"';
                                                            } ?>>
                                    <i class="nav-icon fas fa-chart-bar"></i>
                                    <p>Detalhes - Equipamentos</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="equipamentos.php" <?php if ($paginaLink == "equipamentos.php") {
                                                        echo 'class="nav-link active"';
                                                    } else {
                                                        echo 'class="nav-link"';
                                                    } ?>>
                                    <i class="nav-icon fas fa-table"></i>
                                    <p>Equipamentos</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="cadastrarEquipamento.php" <?php if ($paginaLink == "cadastrarEquipamento.php") {
                                                                    echo 'class="nav-link active"';
                                                                } else {
                                                                    echo 'class="nav-link"';
                                                                } ?>>
                                    <i class="nav-icon fas fa-edit"></i>
                                    <p>Cadastrar Equipamento</p>
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
                                    <i class="nav-icon fas fa-table"></i>
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
                        </ul>
                    </li>

















                    <li class="nav-header" style="text-decoration: underline;"><strong>SINISTRO</strong>
                        <span class="right badge badge-danger" style="float:right; margin-top:5px;">Setor</span>
                    </li>




                    <li class="nav-header" style="text-decoration: underline;"><strong>CADASTRO</strong>
                        <span class="right badge badge-danger" style="float:right; margin-top:5px;">Em Breve</span>
                    </li>
                    <li class="nav-item">
                        <a href="dashboard-func.php?page=Cadastro" <?php if ($_GET['page'] == 'Cadastro') {
                                                                        echo 'class="nav-link active"';
                                                                    } else {
                                                                        echo 'class="nav-link"';
                                                                    } ?>>
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Inicío</p>
                        </a>
                    </li>

                    <li class="nav-header" style="text-decoration: underline;"><strong>COBRANÇA</strong>
                        <span class="right badge badge-danger" style="float:right; margin-top:5px;">Em Breve</span>
                    </li>

                    <li class="nav-header" style="text-decoration: underline;"><strong>COMERCIAL</strong>
                        <span class="right badge badge-danger" style="float:right; margin-top:5px;">Em Breve</span>
                    </li>


                    <li class="nav-header" style="text-decoration: underline;"><strong>FINANCEIRO</strong>
                        <span class="right badge badge-danger" style="float:right; margin-top:5px;">Em Breve</span>
                    </li>


                    <li class="nav-header" style="text-decoration: underline;"><strong>GERÊNCIA</strong>
                        <span class="right badge badge-danger" style="float:right; margin-top:5px;">Administradores</span>
                    </li>
                    <li class="nav-item">
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
                    </li>
                    <li class="nav-item">
                        <a href="#" <?php if ($paginaLink == "cadastrar-func.php") {
                                        echo 'class="nav-link active"';
                                    } else {
                                        echo 'class="nav-link"';
                                    } ?>>
                            <i class="nav-icon far fa-image"></i>
                            <p>
                                Listar Funcionários
                            </p>
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