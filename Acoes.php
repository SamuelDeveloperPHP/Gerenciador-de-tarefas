<?php

class Acoes
{

    private $bd;
    protected $usuario;
    public function __construct($banco_de_dados)
    {

        $this->bd = $banco_de_dados;

        $this->usuario = (isset($_SESSION['email']) ? $_SESSION['email'] : NULL);

        if ($this->usuario != null) {
            $this->atualiza_status();
        }
    }
    public function atualiza_status()
    {
        $dataAtualizada = date('d-m-Y H:i:s', strtotime('+2 minutes'));

        try {
            $query = $this->bd->prepare("UPDATE usuarios SET status = :status WHERE email = :email");
            $query->execute(array(':status' => $dataAtualizada, ':email' => $this->usuario));
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function contar($nome_tabela)
    {


        $query     = $this->bd->prepare("SELECT count(id_vistoria) AS total FROM " . $nome_tabela . "");


        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }


        return $query->fetchColumn();
    }



    public function login($email){


	    $query 	= $this->bd->prepare("SELECT * FROM usuarios WHERE email = :email LIMIT 1");
		$query->bindValue(':email', $email, PDO::PARAM_STR);
	    
		try{
			$query->execute();
		}
		
		catch(PDOException $e){
			die($e->getMessage());
		}
		
		return $query->fetch();
		
	}
    public function verifica_cadastro($email, $usuario)
    {
        try {
            $query = $this->bd->prepare("SELECT * FROM usuarios WHERE usuario = :usuario OR email = :email");
            $query->execute(array(':usuario' => $usuario, ':email' => $email));
            $total = $query->rowCount();

            if ($total > 0) {
                return false;
            } else {
                return true;
            }
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function nivelAcesso()
    {

        $query = $this->bd->prepare("SELECT * FROM nivelacesso");

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        
        return $query->fetchAll();

    }
    public function cadastro()
    {
        if (isset($_POST['env']) && $_POST['env'] == "cad") {
            $status = $this->verifica_cadastro($_POST['email'], $_POST['usuario']);
            $post_dados = array($_POST['nome'], $_POST['usuario'], $_POST['email'], $_POST['senha'], $_POST['sexo'], $_POST['tipo'], $_POST['nome_admin']);
            $uploaddir = 'chat/imagens/uploads';
            $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

            if ($status == TRUE) {
                try {
                    $query = $this->bd->prepare("INSERT INTO usuarios (nome, usuario, email, senha, sexo, foto, tipo, nome_admin) VALUES(:nome, :usuario, :email, :senha, :sexo, :foto, :tipo, :nome_admin); INSERT INTO admins (tipo, nome_admin, email, senha) VALUES (:tipo, :nome_admin, :email, :senha)");
                    $query->execute(array(
                        ':nome' => $post_dados[0],
                        ':usuario'  => $post_dados[1],
                        ':email' => $post_dados[2],
                        ':senha' => $post_dados[3],
                        ':sexo'  => $post_dados[4],
                        ':tipo' => $post_dados[5],
                        ':nome_admin'  => $post_dados[6],
                        ':foto' => $uploadfile
                    ));
                    $conta = $query->rowCount();

                    if ($conta > 0) {
                        move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
                        $this->alerta("success", "Cadastro efetuado com sucesso! Aguarde...", false);
                        $this->redirect("cadastrar-func.php");
                    }
                } catch (PDOException $e) {
                    $e->getMessage();
                }
            } else {
                echo "<div class='alert alert-danger'>Usuário ou email já cadastrados, tente outro!</div>";
            }
            echo 'Aqui está mais informações de debug:';
        }
    }
    
    
    public function cadastrar_demanda()
    {
        if (isset($_POST['env2'])) {
            // $status = $this->verifica_cadastro($_POST['email'], $_POST['usuario']);
            $status = 1;
            $post_dados = array($_POST['titulo'], $_POST['modulo'], $_POST['data'], $_POST['prioridade'], $_POST['descricao'], $_POST['regra_negocio']);
            
            $file_name = $_FILES['userfile']['name'];
            $file_temp = $_FILES['userfile']['tmp_name'];
            $location="imagens/uploads".$file_name;
            
            $uploaddir = 'imagens/uploads';
            $uploadfile = $file_name;

             if ($status <= 1) {
                try {
                    $query = $this->bd->prepare("INSERT INTO demandas (titulo, modulo, data, prioridade, descricao, regra_negocio) VALUES(:titulo, :modulo, :data, :prioridade, :descricao, :regra_negocio)");
                    // $query = $this->bd->prepare("INSERT INTO demandas (titulo, modulo, data, prioridade, descricao, regra_negocio) VALUES(:titulo, :modulo, :data, :prioridade, :descricao, :regra_negocio); INSERT INTO admins (tipo, nome_admin, email, senha) VALUES (:tipo, :nome_admin, :email, :senha)");
                    $query->execute(array(
                        ':titulo' => $post_dados[0],
                        ':modulo'  => $post_dados[1],
                        ':data' => $post_dados[2],
                        ':prioridade' => $post_dados[3],
                        ':descricao'  => $post_dados[4],
                        ':regra_negocio' => $post_dados[5],
                        ':foto' => $file_name
                    ));
                    $conta = $query->rowCount();

                    if ($conta > 0) {
                        move_uploaded_file($file_temp,$uploaddir);
                        $this->alerta("success", "Cadastro efetuado com sucesso! Aguarde...", false);
                        $this->redirect("cadastrar-func.php");
                    }
                } catch (PDOException $e) {
                    $e->getMessage();
                }
        
        } else {
                echo "<div class='alert alert-danger'>Usuário ou email já cadastrados, tente outro!</div>";
            }
            echo 'Aqui está mais informações de debug:';
        }
    }





    public function cadastrar_admin($tipo, $nome_admin, $email, $senha, $nome, $sexo, $usuario)
    {
        $uploaddir = 'images/uploads';
        $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

        $query     = $this->bd->prepare("INSERT INTO usuarios (nome, usuario, email, senha, sexo, foto, tipo, nome_admin) 
        VALUES(:nome, :usuario, :email, :senha, :sexo, :foto, :tipo, :nome_admin)");

        $query->bindValue(':tipo', $tipo, PDO::PARAM_STR);
        $query->bindValue(':nome_admin', $nome_admin, PDO::PARAM_STR);
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->bindValue(':senha', $senha, PDO::PARAM_STR);
        $query->bindValue(':nome', $nome, PDO::PARAM_STR);
        $query->bindValue(':sexo', $sexo, PDO::PARAM_STR);
        $query->bindValue(':usuario', $usuario, PDO::PARAM_STR);


        try {
            return $query->execute();
            move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
            $this->alerta("success", "Cadastro efetuado com sucesso! Aguarde...", false);
            $this->redirect("login");
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    
    public function cadastrar_sistema($name) {

        $dataExpiracao = date('Y-m-d H:i:s', (strtotime("+1 minutes")));

        $query     = $this->bd->prepare(
            "INSERT INTO sistemas (
		name
		
		) 
		
		VALUES (
        :name
		)
        
        "
        );

        $query->bindValue(':name', $name, PDO::PARAM_STR);


        try {
            return $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    
    
    public function cadastrar_historico($mensagem,$demanda_id,$user_id) {
        
        $dataExpiracao = date('d-m-y');


        $query     = $this->bd->prepare(
            "INSERT INTO historico (
		mensagem,
		demanda_id,
		user_id
		
		) 
		
		VALUES (
        :mensagem,
		:demanda_id,
		:user_id
		)
        
        "
        );

        $query->bindValue(':mensagem', $mensagem, PDO::PARAM_STR);
        $query->bindValue(':demanda_id', $demanda_id, PDO::PARAM_STR);
        $query->bindValue(':user_id', $user_id, PDO::PARAM_STR);


        try {
            return $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    
    
    public function cadastrar_usuario($nome, $tipo, $nome_sistema, $email, $contato, $status) {

        $query     = $this->bd->prepare(
            "INSERT INTO usuarios (
		nome,
		tipo,
		nome_sistema,
		email,
		contato,
		status
		
		) 
		
		VALUES (
        :nome,
		:tipo,
		:nome_sistema,
		:email,
		:contato,
		:status
		)
        
        "
        );

        $query->bindValue(':nome', $nome, PDO::PARAM_STR);
        $query->bindValue(':tipo', $tipo, PDO::PARAM_STR);
        $query->bindValue(':nome_sistema', $nome_sistema, PDO::PARAM_STR);
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->bindValue(':contato', $contato, PDO::PARAM_STR);
        $query->bindValue(':status', $status, PDO::PARAM_STR);


        try {
            return $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    
    
    public function cadastrar_usuario2($nome, $tipo, $nome_sistema, $email, $contato, $status, $senha) {

        $query     = $this->bd->prepare(
            "INSERT INTO usuarios (
		nome,
		tipo,
		nome_sistema,
		email,
		contato,
		status,
		senha
		
		) 
		
		VALUES (
        :nome,
		:tipo,
		:nome_sistema,
		:email,
		:contato,
		:status,
		:senha
		)
        
        "
        );

        $query->bindValue(':nome', $nome, PDO::PARAM_STR);
        $query->bindValue(':tipo', $tipo, PDO::PARAM_STR);
        $query->bindValue(':nome_sistema', $nome_sistema, PDO::PARAM_STR);
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->bindValue(':contato', $contato, PDO::PARAM_STR);
        $query->bindValue(':status', $status, PDO::PARAM_STR);
        $query->bindValue(':senha', $senha, PDO::PARAM_STR);


        try {
            return $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    
    
    public function cadastrar_modulo($name, $sistema_mod) {

        $dataExpiracao = date('Y-m-d H:i:s', (strtotime("+1 minutes")));

        $query     = $this->bd->prepare(
            "INSERT INTO modulos (
		name,
		sistema_mod
		
		) 
		
		VALUES (
        :name,
        :sistema_mod
		)
        
        "
        );

        $query->bindValue(':name', $name, PDO::PARAM_STR);
        $query->bindValue(':sistema_mod', $sistema_mod, PDO::PARAM_STR);


        try {
            return $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    
    
    public function cadastrar_demandas2($titulo, $modulo, $data, $prioridade, $descricao, $regra_negocio, $file_name) {

        
        // $uploaddir = 'imagens/uploads';
        // $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
        // $foto = $uploadfile;

        $query     = $this->bd->prepare(
            "INSERT INTO demandas (
		titulo,
		modulo,
		data,
		prioridade,
		descricao,
		regra_negocio,
		foto
		
		) 
		
		VALUES (
        :titulo,
		:modulo,
		:data,
		:prioridade,
		:descricao,
		:regra_negocio,
		:foto
		)
        
        "
        );

        $query->bindValue(':titulo', $titulo, PDO::PARAM_STR);
        $query->bindValue(':modulo', $modulo, PDO::PARAM_STR);
        $query->bindValue(':data', $data, PDO::PARAM_STR);
        $query->bindValue(':prioridade', $prioridade, PDO::PARAM_STR);
        $query->bindValue(':descricao', $descricao, PDO::PARAM_STR);
        $query->bindValue(':regra_negocio', $regra_negocio, PDO::PARAM_STR);
        $query->bindValue(':foto', $file_name, PDO::PARAM_STR);


        try {
            return $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    
    public function listarEmpresas($inicio, $registrosPorPagina)
    {

        $query = $this->bd->prepare("SELECT * FROM sistemas
        ORDER BY id DESC LIMIT " . $inicio . ", " . $registrosPorPagina . "");


        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $query->fetchAll();
    }
    public function listarEmSistemas($inicio, $registrosPorPagina)
    {

        $query = $this->bd->prepare("SELECT * FROM sistemas
        ORDER BY id DESC LIMIT " . $inicio . ", " . $registrosPorPagina . "");


        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $query->fetchAll();
    }
    
    public function listarDemandas($inicio, $registrosPorPagina)
    {

        $query = $this->bd->prepare("SELECT * FROM demandas
        ORDER BY id DESC LIMIT " . $inicio . ", " . $registrosPorPagina . "");

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $query->fetchAll();
    }
    
    public function listarModulos($inicio, $registrosPorPagina)
    {

        $query = $this->bd->prepare("SELECT * FROM modulos
        ORDER BY id DESC LIMIT " . $inicio . ", " . $registrosPorPagina . "");


        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $query->fetchAll();
    }
    
    public function listarUsuarios($inicio, $registrosPorPagina)
    {

        $query = $this->bd->prepare("SELECT * FROM usuarios
        ORDER BY id DESC LIMIT " . $inicio . ", " . $registrosPorPagina . "");


        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $query->fetchAll();
    }
    
    public function totalDeEmp()
    {

        $query = $this->bd->prepare("SELECT count(*) FROM empresas");

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }


        $count = $query->fetch(PDO::FETCH_NUM); // Return array indexed by column number
        return reset($count); // Resets array cursor and returns first value (the count)

    }
    
    public function totalDeSistemas()
    {

        $query = $this->bd->prepare("SELECT * FROM sistemas");

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        
        return $query->fetchAll();


        // $count = $query->fetch(PDO::FETCH_NUM); // Return array indexed by column number
        // return reset($count); // Resets array cursor and returns first value (the count)

    }
    
    public function totalDeModulos()
    {

        $query = $this->bd->prepare("SELECT * FROM modulos");

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        
        return $query->fetchAll();


        // $count = $query->fetch(PDO::FETCH_NUM); // Return array indexed by column number
        // return reset($count); // Resets array cursor and returns first value (the count)

    }
    
    public function totalDeUsers()
    {

        $query = $this->bd->prepare("SELECT * FROM usuarios");

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        
        $count = $query->fetch(PDO::FETCH_NUM); // Return array indexed by column number
        return reset($count); // Resets array cursor and returns first value (the count)


        // $count = $query->fetch(PDO::FETCH_NUM); // Return array indexed by column number
        // return reset($count); // Resets array cursor and returns first value (the count)

    }


    public function pegar_status($id_logado)
    {

        $query = $this->bd->prepare("SELECT * FROM usuarios WHERE id = '.$id_logado.'     ");

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        $id_logado = $query->fetch(PDO::FETCH_ASSOC);

        return $query->fetch();
    }

    
    
    public function listarSistemasID($id_sistema)
    {

        $query = $this->bd->prepare("SELECT * FROM sistemas WHERE id = :id_vistoria
		");

        $query->bindValue(':id_vistoria', $id_sistema, PDO::PARAM_INT);

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        
        return $query->fetch();

    }
    
     public function listarModulosId($id_modulo)
    {

        $query = $this->bd->prepare("SELECT * FROM modulos WHERE id = :id_modulo
		");

        $query->bindValue(':id_modulo', $id_modulo, PDO::PARAM_INT);

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        
        return $query->fetch();

    }
    
     public function listarUsuariosId($id_modulo)
    {

        $query = $this->bd->prepare("SELECT * FROM usuarios WHERE id = :id_vistoria
		");

        $query->bindValue(':id_vistoria', $id_modulo, PDO::PARAM_INT);

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        
        return $query->fetch();

    }
    
    public function atualizar_sistema($id_sistema, $name)
    {

        $query     = $this->bd->prepare(
            "UPDATE sistemas SET name = :name WHERE id = :id_sistema"

        );

        $query->bindValue(':id_sistema', $id_sistema, PDO::PARAM_STR);
        $query->bindValue(':name', $name, PDO::PARAM_STR);


        try {
            return $query->execute();
        } catch (PDOException $e) {
            return die($e->getMessage());
        }
    }
    public function editar_historico($id, $mensagem)
    {

        $query     = $this->bd->prepare(
            "UPDATE historico SET mensagem = :mensagem WHERE id = :id"

        );

        $query->bindValue(':id', $id, PDO::PARAM_STR);
        $query->bindValue(':mensagem', $mensagem, PDO::PARAM_STR);


        try {
            return $query->execute();
        } catch (PDOException $e) {
            return die($e->getMessage());
        }
    }
    
    
    public function atualizar_demandas($id_demanda,$titulo, $modulo, $data, $prioridade, $descricao, $regra_negocio, $file_name)
    {

        $query     = $this->bd->prepare(
            "UPDATE demandas SET titulo = :titulo, modulo = :modulo, data = :data, prioridade = :prioridade, descricao = :descricao, regra_negocio = :regra_negocio, foto = :foto WHERE id = :id_sistema"

        );

        $query->bindValue(':id_sistema', $id_demanda, PDO::PARAM_STR);
        $query->bindValue(':titulo', $titulo, PDO::PARAM_STR);
        $query->bindValue(':modulo', $modulo, PDO::PARAM_STR);
        $query->bindValue(':data', $data, PDO::PARAM_STR);
        $query->bindValue(':prioridade', $prioridade, PDO::PARAM_STR);
        $query->bindValue(':descricao', $descricao, PDO::PARAM_STR);
        $query->bindValue(':regra_negocio', $regra_negocio, PDO::PARAM_STR);
        $query->bindValue(':foto', $file_name, PDO::PARAM_STR);


        try {
            return $query->execute();
        } catch (PDOException $e) {
            return die($e->getMessage());
        }
    }
    
     public function atualizar_modulo($id_modulo, $name, $sistema_mod)
    {

        $query     = $this->bd->prepare(
            "UPDATE modulos SET name = :name, sistema_mod = :sistema_mod WHERE id = :id_modulo"

        );

        $query->bindValue(':id_modulo', $id_modulo, PDO::PARAM_STR);
        $query->bindValue(':name', $name, PDO::PARAM_STR);
        $query->bindValue(':sistema_mod', $sistema_mod, PDO::PARAM_STR);


        try {
            return $query->execute();
        } catch (PDOException $e) {
            return die($e->getMessage());
        }
    }
    
     public function atualizar_usuario($id_user, $nome,$tipo,$nome_sistema,$email,$contato,$status)
    {

        $query     = $this->bd->prepare(
            "UPDATE usuarios SET nome = :nome, tipo = :tipo, nome_sistema = :nome_sistema, email = :email, contato = :contato, status = :status 
            WHERE id = :id_modulo"

        );

        $query->bindValue(':id_modulo', $id_user, PDO::PARAM_STR);
        $query->bindValue(':nome', $nome, PDO::PARAM_STR);
        $query->bindValue(':tipo', $tipo, PDO::PARAM_STR);
        $query->bindValue(':nome_sistema', $nome_sistema, PDO::PARAM_STR);
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->bindValue(':contato', $contato, PDO::PARAM_STR);
        $query->bindValue(':status', $status, PDO::PARAM_STR);


        try {
            return $query->execute();
        } catch (PDOException $e) {
            return die($e->getMessage());
        }
    }
    public function deletarDemanda($id_vistoria)
    {

        $query = $this->bd->prepare("DELETE FROM demandas WHERE id = :id_vistoria LIMIT 1");

        $query->bindParam(':id_vistoria', $id_vistoria);

        try {
            return $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    public function deletarDemandaHis($id_cliente)
    {

        $query = $this->bd->prepare("DELETE FROM historico WHERE id = :id_vistoria LIMIT 1");

        $query->bindParam(':id_vistoria', $id_cliente);

        try {
            return $query->execute();
            echo '<script type="text/javacript">window.location.href("?funcao=editar&id='.$id_cliente.'");</script>';
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    public function deletarModulo($id_vistoria)
    {

        $query = $this->bd->prepare("DELETE FROM modulos WHERE id = :id_vistoria LIMIT 1");

        $query->bindParam(':id_vistoria', $id_vistoria);

        try {
            return $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    
    public function deletarUsuario($id_vistoria)
    {

        $query = $this->bd->prepare("DELETE FROM usuarios WHERE id = :id_vistoria LIMIT 1");

        $query->bindParam(':id_vistoria', $id_vistoria);

        try {
            return $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    public function deletarSistema($id_vistoria)
    {

        $query = $this->bd->prepare("DELETE FROM sistemas WHERE id = :id_vistoria LIMIT 1");

        $query->bindParam(':id_vistoria', $id_vistoria);

        try {
            return $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function listar($nome_coluna)
    {


        $query     = $this->bd->prepare("SELECT " . $nome_coluna . " FROM usuarios");

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $query->fetchAll();
    }
     public function buscarDemandasPaginate($busca, $modulos, $prioridade, $inicio, $registrosPorPagina)
    {
        
        $query = $this->bd->prepare("SELECT * FROM demandas WHERE titulo = '$busca' OR modulo = '$modulos' OR prioridade = '$prioridade' ORDER BY id DESC
		
		 LIMIT " . $inicio . " , " . $registrosPorPagina . "");

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $query->fetchAll();
        
    }
     public function buscarDemandasPaginate11($modulo, $inicio, $registrosPorPagina)
    {

        $query = $this->bd->prepare("SELECT * FROM demandas
        WHERE 
		modulo REGEXP '$modulo' 
		
		

		ORDER BY id DESC LIMIT " . $inicio . " , " . $registrosPorPagina . "");

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $query->fetchAll();
    }
    public function buscarModuloPaginate($busca, $inicio, $registrosPorPagina)
    {

        $query = $this->bd->prepare("SELECT modulos.*, admins.nome_admin, admins.email, clientesacio.nome_cliente, clientesacio.placa, clientesacio.veiculo, clientesacio.status1, pecas.numero_serie, pecas.nome_peca, pecas.modelo, pecas.codigo
		FROM acionamentos
		INNER JOIN admins ON acionamentos.id_admin = admins.id_admin
		INNER JOIN clientesacio ON acionamentos.id_cliente = clientesacio.id_cliente
		INNER JOIN pecas ON acionamentos.id_peca = pecas.id_peca
		
		WHERE 
		acionamentos.data_realizacao_vistoria REGEXP '$busca' OR 
		admins.nome_admin REGEXP '$busca' OR 
	    admins.email REGEXP '$busca' OR
		clientesacio.nome_cliente REGEXP '$busca' OR
		pecas.numero_serie REGEXP '$busca' OR
		pecas.nome_peca REGEXP '$busca' OR
		pecas.modelo REGEXP '$busca' OR
		pecas.codigo REGEXP '$busca' 

		ORDER BY modulos.id_empresa DESC LIMIT " . $inicio . " , " . $registrosPorPagina . "");

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $query->fetchAll();
    }
    public function buscarSistemaPaginate($busca, $inicio, $registrosPorPagina)
    {

        $query = $this->bd->prepare("SELECT sistemas.*, admins.nome_admin, admins.email, clientesacio.nome_cliente, clientesacio.placa, clientesacio.veiculo, clientesacio.status1, pecas.numero_serie, pecas.nome_peca, pecas.modelo, pecas.codigo
		FROM acionamentos
		INNER JOIN admins ON acionamentos.id_admin = admins.id_admin
		INNER JOIN clientesacio ON acionamentos.id_cliente = clientesacio.id_cliente
		INNER JOIN pecas ON acionamentos.id_peca = pecas.id_peca
		
		WHERE 
		acionamentos.data_realizacao_vistoria REGEXP '$busca' OR 
		admins.nome_admin REGEXP '$busca' OR 
	    admins.email REGEXP '$busca' OR
		clientesacio.nome_cliente REGEXP '$busca' OR
		pecas.numero_serie REGEXP '$busca' OR
		pecas.nome_peca REGEXP '$busca' OR
		pecas.modelo REGEXP '$busca' OR
		pecas.codigo REGEXP '$busca' 

		ORDER BY sistemas.id DESC LIMIT " . $inicio . " , " . $registrosPorPagina . "");

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $query->fetchAll();
    }
    
    public function buscarUsuariosPaginate($busca, $inicio, $registrosPorPagina)
    {

        $query = $this->bd->prepare("SELECT * FROM usuarios WHERE nome LIKE '%$busca%' ORDER BY id DESC
		
		 LIMIT " . $inicio . " , " . $registrosPorPagina . "");

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $query->fetchAll();
    }
    // public function buscarSistemasPaginate($busca, $inicio, $registrosPorPagina)
    // {

    //     $query = $this->bd->prepare("SELECT * FROM sistemas WHERE name LIKE '%$busca%' ORDER BY id DESC
		
	// 	 LIMIT " . $inicio . " , " . $registrosPorPagina . "");

    //     try {
    //         $query->execute();
    //     } catch (PDOException $e) {
    //         die($e->getMessage());
    //     }

    //     return $query->fetchAll();
    // }
}


$acoes = new Acoes($bd);





function base64ToImage($base64_string, $output_file)
{

    $file = fopen($output_file, "wb");

    $data = explode(',', $base64_string);

    if (fwrite($file, base64_decode($data[1]))) {
        fclose($file);
        $return = $output_file;
    } else {
        $return = false;
    }

    return $return;
}



function formata_dinheiro($val)
{
    $val = number_format((float)$val, 2, ',', '.');
    return "R$ " . $val;
}

function imageResize($img_name, $output_file)
{

    $width = 300;
    $height = 300;
    /* Get original file size */
    list($w, $h) = getimagesize($img_name);


    $ratio = $w / $h;
    $size = $width;

    $width = $height = min($size, max($w, $h));

    if ($ratio < 1) {
        $width = $height * $ratio;
    } else {
        $height = $width / $ratio;
    }
    $x = 0;

    /* Calculate new image size */
    /*
                    $ratio = max($width/$w, $height/$h);
                    $h = ceil($height / $ratio);
                    $x = ($w - $width / $ratio) / 2;
                    $w = ceil($width / $ratio);
                    */


    /* set new file name */
    $path = $output_file;

    $path_info = pathinfo($img_name);


    /* Save image */
    if ($path_info['extension'] == 'jpeg' || $path_info['extension'] == 'jpg') {
        /* Get binary data from image */
        $imgString = file_get_contents($img_name);
        /* create image from string */
        $image = imagecreatefromstring($imgString);
        $tmp = imagecreatetruecolor($width, $height);
        imagecopyresampled($tmp, $image, 0, 0, $x, 0, $width, $height, $w, $h);
        //imagejpeg($tmp, $path, 100);
    } else if ($path_info['extension'] == 'png') {
        $image = imagecreatefrompng($img_name);
        $tmp = imagecreatetruecolor($width, $height);
        imagepalettetotruecolor($tmp);
        imagealphablending($tmp, false);
        imagesavealpha($tmp, true);
        imagecopyresampled($tmp, $image, 0, 0, $x, 0, $width, $height, $w, $h);
        //imagepng($tmp, $path, 0);  
    } else if ($path_info['extension'] == 'webp') {
        $image = imagecreatefromwebp($img_name);
        $tmp = imagecreatetruecolor($width, $height);
        imagepalettetotruecolor($tmp);
        imagealphablending($tmp, false);
        imagesavealpha($tmp, true);
        imagecopyresampled($tmp, $image, 0, 0, $x, 0, $width, $height, $w, $h);
        //imagewebp($tmp, $path, 0);  
    } else if ($path_info['extension'] == 'gif') {
        $image = imagecreatefromgif($img_name);

        $tmp = imagecreatetruecolor($width, $height);
        $transparent = imagecolorallocatealpha($tmp, 0, 0, 0, 127);
        imagefill($tmp, 0, 0, $transparent);
        imagealphablending($tmp, false);

        imagecopyresampled($tmp, $image, 0, 0, 0, 0, $width, $height, $w, $h);
        //imagegif($tmp, $path);
    } else {
        $return = false;
    }

    if (imagewebp($tmp, $path, 100)) {
        $return = $path;
    } else {
        $return = false;
    }
    imagedestroy($image);
    imagedestroy($tmp);

    return $return;
}





function criarDiretorio($caminho)
{

    if (!file_exists($caminho)) {
        mkdir($caminho, 0777, true);
    }
}


function aprovado($string)
{
    if ($string == 'Aprovado') {
        $imagem = 'images/aprovado.png';
    } else {
        $imagem = 'images/reprovado.png';
    }

    return $imagem;
}


function status($string)
{
    if ($string == 'OK') {
        $imagem = 'images/ok.png';
    } else if ($string == 'Alerta') {
        $imagem = 'images/alerta.png';
    } else {
        $imagem = 'images/erro.png';
    }

    return $imagem;
}


function string($string)
{

    if (empty($string)) {
        $texto = '&nbsp;';
    } else {
        $texto = strip_tags($string);
    }

    return $texto;
}



function verificaFoto($caminho)
{

    if (file_exists($caminho)) {
        $foto = $caminho;
    } else {
        $foto = 'images/branco.jpg';
    }

    return $foto;
}

function deletaDiretorio($caminho)
{
    array_map('unlink', glob("$caminho/*.*"));
    rmdir($caminho);
}
function mostraMes($m)
{
    switch ($m) {
        case 01:
        case 1:
            $mes = "Janeiro";
            break;
        case 02:
        case 2:
            $mes = "Fevereiro";
            break;
        case 03:
        case 3:
            $mes = "Mar&ccedil;o";
            break;
        case 04:
        case 4:
            $mes = "Abril";
            break;
        case 05:
        case 5:
            $mes = "Maio";
            break;
        case 06:
        case 6:
            $mes = "Junho";
            break;
        case 07:
        case 7:
            $mes = "Julho";
            break;
        case 8:
        case 8:
            $mes = "Agosto";
            break;
        case 9:
        case 9:
            $mes = "Setembro";
            break;
        case 10:
            $mes = "Outubro";
            break;
        case 11:
            $mes = "Novembro";
            break;
        case 12:
            $mes = "Dezembro";
            break;
    }
    return $mes;
}

$acoes = new Acoes($bd);
class Url
{
    private static $url = null;
    private static $baseUrl = null;

    public static function getBase()
    {
        if (self::$baseUrl != null)
            return self::$baseUrl;

        global $_SERVER;
        $startUrl = strlen($_SERVER["DOCUMENT_ROOT"]);
        $excludeUrl = substr($_SERVER["SCRIPT_FILENAME"], $startUrl, -9);
        if ($excludeUrl[0] == "/")
            self::$baseUrl = $excludeUrl;
        else
            self::$baseUrl = "/" . $excludeUrl;
        return self::$baseUrl;
    }

    public static function getURL($id)
    {
        // Verifica se a lista de URL já foi preenchida
        if (self::$url == null)
            self::getURLList();

        // Valida se existe o ID informado e retorna.
        if (isset(self::$url[$id]))
            return self::$url[$id];

        // Caso não exista o ID, retorna nulo
        return null;
    }

    private static function getURLList()
    {
        global $_SERVER;

        // Primeiro traz todos as pastas abaixo do index.php
        $startUrl = strlen($_SERVER["DOCUMENT_ROOT"]) - 1;
        $excludeUrl = substr($_SERVER["SCRIPT_FILENAME"], $startUrl, -10);

        // a variável$request possui toda a string da URL após o domínio.
        $request = $_SERVER['REQUEST_URI'];

        // Agora retira toda as pastas abaixo da pasta raiz
        $request = substr($request, strlen($excludeUrl));

        // Explode a URL para pegar retirar tudo após o ?
        $urlTmp = explode("?", $request);
        $request = $urlTmp[0];

        // Explo a URL para pegar cada uma das partes da URL
        $urlExplodida = explode("/", $request);

        $retorna = array();

        for ($a = 0; $a <= count($urlExplodida); $a++) {
            if (isset($urlExplodida[$a]) and $urlExplodida[$a] != "") {
                array_push($retorna, $urlExplodida[$a]);
            }
        }
        self::$url = $retorna;
    }
}


