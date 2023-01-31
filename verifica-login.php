<?php
	session_start();
	//Não é necessário definir session_start(); pois ele já está setado no arquivo verifica-session.php


	//Verificação de session no momento do login (quando os campos "email" e "senha" são enviados pelo form)
    if(isset($_POST['email']) && isset($_POST['senha'])){
		
        $email = htmlspecialchars($_POST['email']);
        $senha = htmlspecialchars($_POST['senha']);
		
		$dados = $acoes->login($email);
		

		if(!empty($dados['id']) && $dados['id'] > 0){
			
			if($senha == $dados['senha']){
				$_SESSION['id'] = $dados['id'];
				$_SESSION['tipo'] = $dados['tipo'];
				$_SESSION['nome'] = $dados['nome'];
                $_SESSION['email'] = $dados['email'];
				
				
				if($_SESSION['tipo'] == 'AdminDono'){
                	echo "<script>location.href='./paineladmin/demandas.php'</script>";
					die();
				}
				else{
               	echo "<script>location.href='./paineluser/demandas.php'</script>";
					die();
				}
                
            }else{
                //Erro de senha incorreta
                if(isset($_SESSION['id'])){
                    unset($_SESSION['id']);
                }
                if(isset($_SESSION['tipo'])){
                    unset($_SESSION['tipo']);
                }
                if(isset($_SESSION['nome'])){
                    unset($_SESSION['nome']);
                }
				if(isset($_SESSION['email'])){
					unset($_SESSION['email']);
				}


		
                echo '<div class="box_erro_login"><p><i class="fas fa-exclamation-circle"></i> Email ou senha incorretos!</p></div>';
            }
        }else{
            //Erro de usuário inexistente
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
		
            echo '<div class="box_erro_login"><p><i class="fas fa-exclamation-circle"></i> Email não cadastrado.</p></div>';
        }
    }
?>