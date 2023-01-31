<?php

include '../config.php';
include '../conexao.php';

if (isset($_POST['switchbutton'])){
    
    
    $id_user = htmlspecialchars($_POST['id_user']);
    var_dump($id_user);
    $switchbutton2 = htmlspecialchars($_POST['switchbutton']);
   
    $query     = $bd->prepare(
            "UPDATE usuarios SET status = :status WHERE id = :id_user"

        );

        $query->bindValue(':id_user', $id_user, PDO::PARAM_STR);
        $query->bindValue(':status', $switchbutton2, PDO::PARAM_STR);


        try {
            return $query->execute();
            
        } catch (PDOException $e) {
            return die($e->getMessage());
        }
}