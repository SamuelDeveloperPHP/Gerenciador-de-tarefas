<?php
	session_start();

	//Verificação de session a cada recarregamento ou troca de página
	if(!isset($_SESSION['tipo']) || empty($_SESSION['tipo'])){
		
		if(isset($_SESSION['email'])){
			unset($_SESSION['email']);
		}

		if(isset($_SESSION['nome'])){
			unset($_SESSION['nome']);
		}

		if(isset($_SESSION['tipo'])){
			unset($_SESSION['tipo']);
		}
		if(isset($_SESSION['id'])){
			unset($_SESSION['id']);
		}
		
		
		// if($_SERVER["REQUEST_URI"] == '/' || $_SERVER["REQUEST_URI"] == '/index.php'){

		// }
		// else{
		// 	header('Location: index.php');
		// 	exit;
		// }


		
	}

	else{
		
		
        // if($_SERVER["REQUEST_URI"] == 'paineluser/demandas.php' && $_SESSION['tipo'] !== 'User'){
		// 	header('Location: index.php');
		// 	exit;	
		// }

	}


