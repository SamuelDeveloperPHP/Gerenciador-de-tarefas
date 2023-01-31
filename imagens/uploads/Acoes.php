<?php

class Acoes
{

    private $bd;

    public function __construct($banco_de_dados)
    {

        $this->bd = $banco_de_dados;
    }
    public function grafico()
    {
        try {
            $stmt = $this->bd->prepare("SELECT * FROM chartjs");
            $stmt->execute();
            $json = [];
            $json2 = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $json[] = $title;
                $json2[] = $amounts;
            }
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
    public function contar($nome_tabela)
    {


        $query     = $this->bd->prepare("SELECT count(id_peca) AS total FROM " . $nome_tabela . "");


        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }


        return $query->fetchColumn();
    }
    public function calcularcusto($nome_tabela)
    {


        $query     = $this->bd->prepare("SELECT count(id_peca) AS total FROM " . $nome_tabela . "");


        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }


        return $query->fetchColumn();
    }



    public function login($email)
    {


        $query     = $this->bd->prepare("SELECT * FROM 
		usuarios WHERE email = :email AND senha = :senha");
        $query->execute(array(':email' => $_POST['email'], ':senha' => $_POST['senha']));
        $query->bindValue(':email', $email, PDO::PARAM_STR);

        try {
            $query->execute();
        } catch (PDOException $e) {
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
    public function cadastro()
    {
        if (isset($_POST['env']) && $_POST['env'] == "cad") {
            $status = $this->verifica_cadastro($_POST['email'], $_POST['usuario']);
            $post_dados = array($_POST['nome'], $_POST['usuario'], $_POST['email'], $_POST['senha'], $_POST['sexo'], $_POST['tipo'], $_POST['nome_admin']);
            $uploaddir = 'images/uploads/';
            $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

            if ($status == TRUE) {
                try {
                    $query = $this->bd->prepare("INSERT INTO usuarios (nome, usuario, email, senha, sexo, foto, tipo, nome_admin) VALUES(:nome, :usuario, :email, :senha, :sexo, :foto, :tipo, :nome_admin)");
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
        }
    }





    public function cadastrar_admin($tipo, $nome_admin, $email, $senha, $nome, $sexo, $usuario)
    {
        $uploaddir = 'images/uploads/';
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




    public function retorna_id_admin($email)
    {

        $query     = $this->bd->prepare("SELECT id_admin FROM `admins` WHERE `email`= :email");
        $query->bindValue(':email', $email, PDO::PARAM_STR);

        try {

            $query->execute();

            $dados = $query->fetch();

            return $dados['id_admin'];
        } catch (PDOException $e) {

            die($e->getMessage());
        }
    }







    public function cadastrar_cliente($nome_cliente)
    {

        $query     = $this->bd->prepare(
            "INSERT INTO clientes (
		nome_cliente
		) 
		
		VALUES ( 
		:nome_cliente
		)"

        );

        $query->bindValue(':nome_cliente', $nome_cliente, PDO::PARAM_STR);


        try {
            $query->execute();
            return $this->bd->lastInsertId();
        } catch (PDOException $e) {
            return die($e->getMessage());
        }
    }




    public function verifica_cliente($nome_cliente)
    {

        $query     = $this->bd->prepare("SELECT COUNT(`id_cliente`) FROM `clientes` WHERE `nome_cliente`= :nome_cliente");
        $query->bindValue(':nome_cliente', $nome_cliente, PDO::PARAM_STR);

        try {

            $query->execute();
            $linhas = $query->fetchColumn();

            if ($linhas == 1) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }



    public function retorna_id_cliente($nome_cliente)
    {

        $query     = $this->bd->prepare("SELECT id_cliente FROM `clientes` WHERE `nome_cliente`= :nome_cliente");
        $query->bindValue(':nome_cliente', $nome_cliente, PDO::PARAM_STR);

        try {

            $query->execute();

            $dados = $query->fetch();

            return $dados['id_cliente'];
        } catch (PDOException $e) {

            die($e->getMessage());
        }
    }







    public function cadastrar_peca($modelo, $numero_serie, $nome_peca, $codigo)
    {

        $query     = $this->bd->prepare(
            "INSERT INTO pecas (
		modelo,
		numero_serie,
		nome_peca,
		codigo
		) 
		
		VALUES ( 
		:modelo,
		:numero_serie,
		:nome_peca,
		:codigo
		)"

        );

        $query->bindValue(':modelo', $modelo, PDO::PARAM_STR);
        $query->bindValue(':numero_serie', $numero_serie, PDO::PARAM_STR);
        $query->bindValue(':nome_peca', $nome_peca, PDO::PARAM_STR);
        $query->bindValue(':codigo', $codigo, PDO::PARAM_STR);


        try {
            $query->execute();
            return $this->bd->lastInsertId();
        } catch (PDOException $e) {
            return die($e->getMessage());
        }
    }




    public function verifica_peca_codigo($codigo)
    {

        $query     = $this->bd->prepare("SELECT COUNT(`id_peca`) FROM `pecas` WHERE `codigo`= :codigo");
        $query->bindValue(':codigo', $codigo, PDO::PARAM_STR);

        try {

            $query->execute();
            $linhas = $query->fetchColumn();

            if ($linhas == 1) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }



    public function verifica_peca_numero_serie($numero_serie)
    {

        $query     = $this->bd->prepare("SELECT COUNT(`id_peca`) FROM `pecas` WHERE `numero_serie`= :numero_serie");
        $query->bindValue(':numero_serie', $numero_serie, PDO::PARAM_STR);

        try {

            $query->execute();
            $linhas = $query->fetchColumn();

            if ($linhas == 1) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }





    public function retorna_id_peca_codigo($codigo)
    {

        $query     = $this->bd->prepare("SELECT id_peca FROM `pecas` WHERE `codigo`= :codigo");
        $query->bindValue(':codigo', $codigo, PDO::PARAM_STR);

        try {

            $query->execute();

            $dados = $query->fetch();

            return $dados['id_peca'];
        } catch (PDOException $e) {

            die($e->getMessage());
        }
    }



    public function retorna_id_peca_numero_serie($numero_serie)
    {

        $query     = $this->bd->prepare("SELECT id_peca FROM `pecas` WHERE `numero_serie`= :numero_serie");
        $query->bindValue(':numero_serie', $numero_serie, PDO::PARAM_STR);

        try {

            $query->execute();

            $dados = $query->fetch();

            return $dados['id_peca'];
        } catch (PDOException $e) {

            die($e->getMessage());
        }
    }



    public function cadastrar_vistoria($id_admin, $id_cliente, $id_peca, $observacoes, $data_realizacao_vistoria)
    {

        $query     = $this->bd->prepare(
            "INSERT INTO vistorias (
		id_admin,
		id_cliente,
		id_peca,
		observacoes,
		data_realizacao_vistoria
		) 
		
		VALUES ( 
		:id_admin,
		:id_cliente,
		:id_peca,
		:observacoes,
		:data_realizacao_vistoria
		)"

        );

        $query->bindValue(':id_admin', $id_admin, PDO::PARAM_INT);
        $query->bindValue(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $query->bindValue(':id_peca', $id_peca, PDO::PARAM_INT);
        $query->bindValue(':observacoes', $observacoes, PDO::PARAM_STR);
        $query->bindValue(':data_realizacao_vistoria', $data_realizacao_vistoria, PDO::PARAM_STR);


        try {
            $query->execute();
            return $this->bd->lastInsertId();
        } catch (PDOException $e) {
            return die($e->getMessage());
        }
    }

    public function cadastrarItemVistoria($id_peca, $nota, $ps, $fornecedor, $preco)
    {

        $query     = $this->bd->prepare(
            "INSERT INTO itens_vistoria (
			id_peca, 
			nota, 
			ps, 
			fornecedor, 
			preco
		) 
		
		VALUES ( 
			:id_peca,
			:nota,
			:ps,
			:fornecedor,
			:preco
		)"

        );

        $query->bindValue(':id_peca', $id_peca, PDO::PARAM_INT);
        $query->bindValue(':nota', $nota, PDO::PARAM_STR);
        $query->bindValue(':ps', $ps, PDO::PARAM_STR);
        $query->bindValue(':fornecedor', $fornecedor, PDO::PARAM_STR);
        $query->bindValue(':preco', $preco, PDO::PARAM_STR);


        try {
            $query->execute();
            return $this->bd->lastInsertId();
        } catch (PDOException $e) {
            return die($e->getMessage());
        }
    }






    public function listarVistorias()
    {

        $query = $this->bd->prepare("SELECT vistorias.*, admins.nome_admin, admins.email, clientes.nome_cliente, pecas.numero_serie, pecas.nome_peca, pecas.modelo, pecas.codigo
		FROM vistorias
		INNER JOIN admins ON vistorias.id_admin = admins.id_admin
		INNER JOIN clientes ON vistorias.id_cliente = clientes.id_cliente
		INNER JOIN pecas ON vistorias.id_peca = pecas.id_peca
		ORDER BY vistorias.id_vistoria DESC 
		");

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $query->fetchAll();
    }



    public function listarVistoriasPaginate($inicio, $registrosPorPagina)
    {

        $query = $this->bd->prepare("SELECT vistorias.*, admins.nome_admin, admins.email, clientes.nome_cliente, pecas.numero_serie, pecas.nome_peca, pecas.modelo, pecas.codigo
		FROM vistorias
		INNER JOIN admins ON vistorias.id_admin = admins.id_admin
		INNER JOIN clientes ON vistorias.id_cliente = clientes.id_cliente
		INNER JOIN pecas ON vistorias.id_peca = pecas.id_peca
		ORDER BY vistorias.id_vistoria DESC LIMIT " . $inicio . " , " . $registrosPorPagina . "");

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $query->fetchAll();
    }




    public function totalDeVistorias()
    {

        $query = $this->bd->prepare("SELECT count(*) FROM vistorias");

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }


        $count = $query->fetch(PDO::FETCH_NUM); // Return array indexed by column number
        return reset($count); // Resets array cursor and returns first value (the count)

    }






    public function listarVistoriaPorId($id_vistoria)
    {

        $query = $this->bd->prepare("SELECT vistorias.*, admins.nome_admin, admins.email, clientes.nome_cliente, pecas.numero_serie, pecas.nome_peca, pecas.modelo, pecas.codigo 
		FROM vistorias
		INNER JOIN admins ON vistorias.id_admin = admins.id_admin
		INNER JOIN clientes ON vistorias.id_cliente = clientes.id_cliente
		INNER JOIN pecas ON vistorias.id_peca = pecas.id_peca
        INNER JOIN itens_vistoria ON vistorias.id_peca = pecas.id_peca
		WHERE vistorias.id_vistoria = :id_vistoria
		");

        $query->bindValue(':id_vistoria', $id_vistoria, PDO::PARAM_INT);

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        $vistoria = $query->fetch(PDO::FETCH_ASSOC);

        $vistoria["itensDeVistoria"] = $this->itensDeVistoria($id_vistoria);

        return $vistoria;
    }
    public function itensDeVistoria($id_vistoria)
    {
        $itensDeVistoria = [];

        $query = $this->bd->prepare("SELECT itens_vistoria.* FROM itens_vistoria
		WHERE itens_vistoria.id_peca = :id_vistoria
		");

        $query->bindValue(':id_vistoria', $id_vistoria, PDO::PARAM_INT);

        try {
            $query->execute();

            if ($query->rowCount() > 0) {
                $itensDeVistoria = $query->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $itensDeVistoria;
    }


    public function deletarVistoria($id_vistoria)
    {

        $query = $this->bd->prepare("DELETE FROM vistorias WHERE id_vistoria = :id_vistoria LIMIT 1");

        $query->bindParam(':id_vistoria', $id_vistoria);

        try {
            return $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }





    public function buscarVistorias($search)
    {

        $query = $this->bd->prepare("SELECT vistorias.*, admins.nome_admin, admins.email, clientes.nome_cliente, pecas.numero_serie, pecas.nome_peca, pecas.modelo, pecas.codigo, itens_vistoria.id_vistoria
		FROM vistorias
		INNER JOIN admins ON vistorias.id_admin = admins.id_admin
		INNER JOIN clientes ON vistorias.id_cliente = clientes.id_cliente
		INNER JOIN pecas ON vistorias.id_peca = pecas.id_peca
		
		WHERE 
		vistorias.data_realizacao_vistoria REGEXP '$search' OR 
		admins.nome_admin REGEXP '$search' OR 
	    admins.email REGEXP '$search' OR
		clientes.nome_cliente REGEXP '$search' OR
		pecas.numero_serie REGEXP '$search' OR
		pecas.nome_peca REGEXP '$search' OR
		pecas.modelo REGEXP '$search' OR
		pecas.codigo REGEXP '$search' OR
        itens_vistoria.id_vistoria'$search'
			
		ORDER BY vistorias.id_vistoria DESC 
		");

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $query->fetchAll();
    }





    public function buscarVistoriasPaginate($search, $inicio, $registrosPorPagina)
    {

        $query = $this->bd->prepare("SELECT vistorias.*, admins.nome_admin, admins.email, clientes.nome_cliente, pecas.numero_serie, pecas.nome_peca, pecas.modelo, pecas.codigo, itens_vistoria.id_vistoria 
		FROM vistorias
		INNER JOIN admins ON vistorias.id_admin = admins.id_admin
		INNER JOIN clientes ON vistorias.id_cliente = clientes.id_cliente
		INNER JOIN pecas ON vistorias.id_peca = pecas.id_peca
		INNER JOIN itens_vistoria ON vistorias.id_peca = peca.id_peca
		
		WHERE 
		vistorias.data_realizacao_vistoria REGEXP '$search' OR 
		admins.nome_admin REGEXP '$search' OR 
	    admins.email REGEXP '$search' OR
		clientes.nome_cliente REGEXP '$search' OR
		pecas.numero_serie REGEXP '$search' OR
		pecas.nome_peca REGEXP '$search' OR
		pecas.modelo REGEXP '$search' OR
		pecas.codigo REGEXP '$search' OR
        itens_vistoria.id_vistoria REGEXP '$search' 

		ORDER BY vistorias.id_vistoria DESC LIMIT " . $inicio . " , " . $registrosPorPagina . "");

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $query->fetchAll();
    }
    public function pega_mensagem_chat($id)
    {
        try {
            $sql = $this->pdo->prepare("SELECT * FROM mensagens WHERE id_chat = :id_chat ORDER BY id DESC LIMIT 1");
            $sql->execute(array(':id_chat' => $id));

            while ($dsql = $sql->fetch(PDO::FETCH_ASSOC)) {

                echo "{$this->verifica_chat_ativo($id)}
				  <a href='chat/{$id}' class='name-user' onclick='verifica_status()'>{$this->get_status($this->dados_user($this->verifica_nomes_chat($id), "usuario"))} 
							  {$this->dados_user($this->verifica_nomes_chat($id), "nome")}</a> <span class='chat_date'>{$this->diferencia_datas($dsql['data'])}</span></h5>
					  <p>{$dsql['mensagem']}</p>
					";
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function get_status($usuario)
    {
        $dataUser = $this->dados_user($usuario, "status");
        $data = $this->get_data();

        if ($data <= $dataUser) {
            return "<img src='images/status-online.png' title='Online'>";
        }
    }
    public function verifica_chat_ativo($id)
    {
        //$explode = $this->get_explode();
        if (isset($_GET['atual']) && $_GET['atual'] == $id) {
            echo "<div class='chat_list active_chat'>";
        } else {
            echo "<div class='chat_list'>";
        }
    }
    public function verifica_nomes_chat($id)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM chats WHERE id = :id");
            $stmt->execute(array(':id' => $id));

            $dados = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($dados['id_de'] == $this->usuario) {
                return $dados['id_para'];
            } else if ($dados['id_para'] == $this->usuario) {
                return $dados['id_de'];
            }
        } catch (PDOException $e) {
            return $e->getmessage();
        }
    }
    public function diferencia_datas($data1)
    {

        $data1 = new DateTime($data1);
        $data2 = new DateTime($this->get_data());

        $intervalo = $data1->diff($data2);

        if ($intervalo->y > 1) {
            return $intervalo->y . " Anos atrás";
        } elseif ($intervalo->y == 1) {
            return $intervalo->y . " Ano atrás";
        } elseif ($intervalo->m > 1) {
            return $intervalo->m . " Meses atrás";
        } elseif ($intervalo->m == 1) {
            return $intervalo->m . " Mês atrás";
        } elseif ($intervalo->d > 1) {
            return $intervalo->d . " Dias atrás";
        } elseif ($intervalo->d > 0) {
            return $intervalo->d . " Dia atrás";
        } elseif ($intervalo->h > 0) {
            return $intervalo->h . " Horas atrás";
        } elseif ($intervalo->i > 1 && $intervalo->i < 59) {
            return $intervalo->i . " Minutos atrás";
        } elseif ($intervalo->i == 1) {
            return $intervalo->i . " Minuto atrás";
        } elseif ($intervalo->s < 60 && $intervalo->i <= 0) {
            return $intervalo->s . " Segundo atrás";
        }
    }
    public function get_data()
    {
        date_default_timezone_set('America/Sao_Paulo');
        return date('d-m-Y H:i:s');
    }
    public function dados_user($usuario, $arr)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
            $stmt->execute(array(':email' => $usuario));
            $conta = $stmt->rowCount();

            if ($conta > 0) {
                $dados = $stmt->fetch(PDO::FETCH_ASSOC);
                return $dados[$arr];
            }
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
    public function editar_dados()
    {
        if (isset($_POST['env']) && $_POST['env'] == "alt") {
            //move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)
            $uploaddir = 'imagens/uploads';
            $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
            if ($_FILES['userfile']['size'] <= 0) {
                $stmt = $this->pdo->prepare("UPDATE usuarios SET nome = :nome, email = :email, senha = :senha, sexo = :sexo WHERE usuario = :usuario");
                $stmt->execute(array(
                    ':nome' => $_POST['nome'],
                    ':email' => $_POST['email'],
                    ':senha' => $_POST['senha'],
                    ':sexo' => $_POST['sexo'],
                    ':usuario' => $this->usuario
                ));
            } else {
                $stmt = $this->pdo->prepare("UPDATE usuarios SET nome = :nome, email = :email, senha = :senha, sexo = :sexo, foto = :foto WHERE usuario = :usuario");
                $stmt->execute(array(
                    ':nome' => $_POST['nome'],
                    ':email' => $_POST['email'],
                    ':senha' => $_POST['senha'],
                    ':sexo' => $_POST['sexo'],
                    ':foto' => $uploadfile,
                    ':usuario' => $this->usuario
                ));
                move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
            }

            if ($stmt->rowCount() > 0) {
                $this->alerta("success", "Dados alterados com sucesso!", false);
                $this->redirect("configs");
            } else {
                echo "Erro: " . $this->pdo->errorInfo();
            }
        }
    }
    public function redirect($url)
    {
        echo "<meta http-equiv='refresh' content='3;URL={$url}'>";
    }

    public function redirect_direct($url)
    {
        echo "<meta http-equiv='refresh' content='0;URL={$url}'>";
    }

    public function alerta($tipo, $mensagem, $col)
    {
        echo "<div class='alert alert-{$tipo} {$col}'>{$mensagem}</div>";
    }
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

$acoes = new Acoes($bd);
