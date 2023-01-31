<?php

include '../conexao.php';

$cod_os = filter_input(INPUT_GET, 'cod_os', FILTER_SANITIZE_STRING);
if(!empty($cod_os)){
    
    $limit = 1;
    $result_aluno = "SELECT * FROM tipoos WHERE cod_os = :cod_os LIMIT :limit";
    
    $resultado_aluno = $bd->prepare($result_aluno);
    $resultado_aluno->bindParam(':cod_os', $cod_os, PDO::PARAM_STR);
    $resultado_aluno->bindParam(':limit', $limit, PDO::PARAM_INT);
    $resultado_aluno->execute();
    
    $array_valores = array();
    
    if($resultado_aluno->rowCount() > 0){
        $row_aluno = $resultado_aluno->fetch(PDO::FETCH_ASSOC);
        $array_valores['tipo_produto'] = $row_aluno['tipo_produto']; 
    }else{
        $array_valores['tipo_produto'] = 'Equipamento não encontrado';        
    }
    echo json_encode($array_valores);
}