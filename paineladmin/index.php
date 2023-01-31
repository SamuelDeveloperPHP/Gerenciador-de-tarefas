<?php
include '../verifica-session.php';
include '../config.php';
include '../conexao.php';
include '../Acoes.php';

if ($_SESSION['tipo'] == 'AdminDono') {
    echo "<script>location.href='./demandas.php'</script>";
    die();
} else {
    echo '<script type="text/javascript">window.location.href = "../logout.php";
    </script>';
}

?>