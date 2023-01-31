<?php

include '../conexao.php';

$cod_eqp = filter_input(INPUT_GET, 'cod_eqp', FILTER_SANITIZE_STRING);
if(!empty($cod_eqp)){
    
    $limit = 1;
    $result_aluno = "SELECT * FROM equipamentos WHERE cod_eqp = :cod_eqp LIMIT :limit";
    
    $resultado_aluno = $bd->prepare($result_aluno);
    $resultado_aluno->bindParam(':cod_eqp', $cod_eqp, PDO::PARAM_STR);
    $resultado_aluno->bindParam(':limit', $limit, PDO::PARAM_INT);
    $resultado_aluno->execute();
    
    $array_valores = array();
    
    if($resultado_aluno->rowCount() != 0){
        $row_aluno = $resultado_aluno->fetch(PDO::FETCH_ASSOC);
        $array_valores['descricao'] = $row_aluno['descricao']; 
    }else{
        $array_valores['descricao'] = 'Equipamento não encontrado';        
    }
    echo json_encode($array_valores);
}