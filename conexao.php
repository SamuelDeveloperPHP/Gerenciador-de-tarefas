<?php      

    $db_type = "mysql";
    $host = "localhost";  
    $user = "root";  
    $pass = '';  
    $db = "sango";  

    /*$db_type = "mysql";
    $host = "localhost";  
    $user = "banco_sango";  
    $pass = 'Sango@#306677';  
    $db = "banco_sango";
    */

    try{
        $bd = new PDO($db_type.':host='.$host.';dbname='.$db,$user,$pass);
        $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$bd->exec("set names utf8");
    }
    
    catch(Exception $e){
        die('ERROR : '.$e->getMessage());
    } 
?>