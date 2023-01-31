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
    public function getPDO()
    {
        return $this->bd;
    }
    public function dadosGrafico()
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
    public function inseregrafico($id_vistoria, $title, $amounts)
    {
        $query     = $this->bd->prepare(
            "INSERT INTO chartjs (
		id_vistoria,
        title,
        amounts
		) 
		
		VALUES ( 
		:id_vistoria,
        :title,
        :amounts
		)"

        );

        $query->bindValue(':id_vistoria', $id_vistoria, PDO::PARAM_STR);
        $query->bindValue(':title', $title, PDO::PARAM_STR);
        $query->bindValue(':amounts', $amounts, PDO::PARAM_STR);


        try {
            $query->execute();
            return $this->bd->lastInsertId();
        } catch (PDOException $e) {
            return die($e->getMessage());
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
    public function contar2()
    {
        try {
            $query = $this->bd->prepare("SELECT tipo_evento, COUNT(tipo_evento) AS Quantidade FROM vistorias GROUP BY tipo_evento HAVING COUNT(tipo_evento) > 1 ORDER BY COUNT(tipo_evento) DESC");
            $contar_dados = array($_GET['tipo_evento']);
            $query->execute(array($contar_dados));
            $conta = $query->rowCount();

            if ($conta > 0) {
                $query->fetch(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        return $query->fetchAll();
    }
    public function contar_tipo()
    {


        $query     = $this->bd->prepare("SELECT tipo_evento, COUNT(tipo_evento) AS Quantidade FROM vistorias GROUP BY tipo_evento HAVING COUNT(tipo_evento) > 1 ORDER BY COUNT(tipo_evento) DESC");


        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $query->fetchAll(PDO::FETCH_ASSOC); // Return array indexed by column number
        
        
    }
    public function calcularcusto($nome_tabela)
    {


        $query     = $this->bd->prepare("SELECT SUM(" . $nome_tabela . ") AS total FROM vistorias ");


        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }


        return $query->fetchColumn();
    }
    public function custoaco($nome_tabela)
    {


        $query     = $this->bd->prepare("SELECT SUM(" . $nome_tabela . ") AS total FROM acordos ");


        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }


        return $query->fetchColumn();
    }
    public function pegarstatus($nome_tabela)
    {


        $query     = $this->bd->prepare("SELECT * FROM clientesacio WHERE status1 = :status1 ");
        $query->bindParam(':status1', $nome_tabela, PDO::PARAM_STR);

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }


        return $query->fetchColumn();
    }
    public function calcularcustomes($nome_tabela)
    {


        $query     = $this->bd->prepare("SELECT SUM(" . $nome_tabela . ") AS total FROM vistorias GROUP BY MONTH(data_realizacao_vistoria)");


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

    public function cadastrar_equipamento($cod_eqp, $situacao_eqp, $tipo_centro, $mapa_simulado1, $mapa_simulado2, $descricao,
    $tipo_maquina, $formato, $cores, $tipo_hora, $nph_turno, $minfunc_maquina,  $subsidio_preimpr,
    $subsidio_impressao, $subsidio_acabamento, $subsidio_percent, $manutencao, $materiais_aux, $n_funcionarios,  $salarios,
    $encargos, $bonus_benef, $sal_enc_bon_ben, $valor_depreciavel, $valor_depreciavel_mes, $num_maq,  $num_maq_turnos,
    $custo_total, $nhp_total, $custo_horare, $custo_horams1, $custo_horams2, $observacoes)
    {

        $dataExpiracao = date('Y-m-d H:i:s', (strtotime("+1 minutes")));

        $query     = $this->bd->prepare(
            "INSERT INTO equipamentos (
		cod_eqp, 
		situacao_eqp, 
		tipo_centro, 
		mapa_simulado1,
        mapa_simulado2,
        descricao,
        tipo_maquina,
        formato, 
		cores, 
		tipo_hora, 
		nph_turno,
        minfunc_maquina,
        subsidio_preimpr,
        subsidio_impressao,
        subsidio_acabamento, 
		subsidio_percent, 
		manutencao,
        materiais_aux, 
		n_funcionarios,
        salarios,
        encargos,
        bonus_benef,
        sal_enc_bon_ben, 
		valor_depreciavel, 
		valor_depreciavel_mes, 
		num_maq,
        num_maq_turnos,
        custo_total,
        nhp_total,
        custo_horare, 
		custo_horams1, 
		custo_horams2, 
		observacoes
		
		) 
		
		VALUES (
        :cod_eqp, 
		:situacao_eqp, 
		:tipo_centro, 
		:mapa_simulado1,
        :mapa_simulado2,
        :descricao,
        :tipo_maquina,
        :formato, 
		:cores, 
		:tipo_hora, 
		:nph_turno,
        :minfunc_maquina,
        :subsidio_preimpr,
        :subsidio_impressao,
        :subsidio_acabamento, 
		:subsidio_percent, 
		:manutencao,
        :materiais_aux, 
		:n_funcionarios,
        :salarios,
        :encargos,
        :bonus_benef,
        :sal_enc_bon_ben, 
		:valor_depreciavel, 
		:valor_depreciavel_mes, 
		:num_maq,
        :num_maq_turnos,
        :custo_total,
        :nhp_total,
        :custo_horare, 
		:custo_horams1, 
		:custo_horams2, 
		:observacoes
		)
        
        "
        );

        $query->bindValue(':cod_eqp', $cod_eqp, PDO::PARAM_STR);
        $query->bindValue(':situacao_eqp', $situacao_eqp, PDO::PARAM_STR);
        $query->bindValue(':tipo_centro', $tipo_centro, PDO::PARAM_STR);
        $query->bindValue(':mapa_simulado1', $mapa_simulado1, PDO::PARAM_STR);
        $query->bindValue(':mapa_simulado2', $mapa_simulado2, PDO::PARAM_STR);
        $query->bindValue(':descricao', $descricao, PDO::PARAM_STR);
        $query->bindValue(':tipo_maquina', $tipo_maquina, PDO::PARAM_STR);
        $query->bindValue(':formato', $formato, PDO::PARAM_STR);
        $query->bindValue(':cores', $cores, PDO::PARAM_STR);
        $query->bindValue(':tipo_hora', $tipo_hora, PDO::PARAM_STR);
        $query->bindValue(':nph_turno', $nph_turno, PDO::PARAM_STR);
        $query->bindValue(':minfunc_maquina', $minfunc_maquina, PDO::PARAM_STR);
        $query->bindValue(':subsidio_preimpr', $subsidio_preimpr, PDO::PARAM_STR);
        $query->bindValue(':subsidio_impressao', $subsidio_impressao, PDO::PARAM_STR);
        $query->bindValue(':subsidio_acabamento', $subsidio_acabamento, PDO::PARAM_STR);
        $query->bindValue(':subsidio_percent', $subsidio_percent, PDO::PARAM_STR);
        $query->bindValue(':manutencao', $manutencao, PDO::PARAM_STR);
        $query->bindValue(':materiais_aux', $materiais_aux, PDO::PARAM_STR);
        $query->bindValue(':n_funcionarios', $n_funcionarios, PDO::PARAM_STR);
        $query->bindValue(':salarios', $salarios, PDO::PARAM_STR);
        $query->bindValue(':encargos', $encargos, PDO::PARAM_STR);
        $query->bindValue(':bonus_benef', $bonus_benef, PDO::PARAM_STR);
        $query->bindValue(':sal_enc_bon_ben', $sal_enc_bon_ben, PDO::PARAM_STR);
        $query->bindValue(':valor_depreciavel', $valor_depreciavel, PDO::PARAM_STR);
        $query->bindValue(':valor_depreciavel_mes', $valor_depreciavel_mes, PDO::PARAM_STR);
        $query->bindValue(':num_maq', $num_maq, PDO::PARAM_STR);
        $query->bindValue(':num_maq_turnos', $num_maq_turnos, PDO::PARAM_STR);
        $query->bindValue(':custo_total', $custo_total, PDO::PARAM_STR);
        $query->bindValue(':nhp_total', $nhp_total, PDO::PARAM_STR);
        $query->bindValue(':custo_horare', $custo_horare, PDO::PARAM_STR);
        $query->bindValue(':custo_horams1', $custo_horams1, PDO::PARAM_STR);
        $query->bindValue(':custo_horams2', $custo_horams2, PDO::PARAM_STR);
        $query->bindValue(':observacoes', $observacoes, PDO::PARAM_STR);


        try {
            return $query->execute();
        } catch (PDOException $e) {
            echo 'Hovue um problema, confira se o equipamento não está cadastrado.
            <script>alert("Hovue um problema, confira se o equipamento não está cadastrado.")</script>
            
            ';
        }
    }

    public function atualizar_equipamento($id, $cod_eqp, $situacao_eqp, $tipo_centro, $mapa_simulado1, $mapa_simulado2, $descricao,
    $tipo_maquina, $formato, $cores, $tipo_hora, $nph_turno, $minfunc_maquina,  $subsidio_preimpr,
    $subsidio_impressao, $subsidio_acabamento, $subsidio_percent, $manutencao, $materiais_aux, $n_funcionarios,  $salarios,
    $encargos, $bonus_benef, $sal_enc_bon_ben, $valor_depreciavel, $valor_depreciavel_mes, $num_maq,  $num_maq_turnos,
    $custo_total, $nhp_total, $custo_horare, $custo_horams1, $custo_horams2, $observacoes)
    {

        $dataExpiracao = date('Y-m-d H:i:s', (strtotime("+1 minutes")));

        $query     = $this->bd->prepare(
            "UPDATE equipamentos SET id = :id, cod_eqp = :cod_eqp, situacao_eqp = :situacao_eqp, tipo_centro = :tipo_centro, 
		mapa_simulado1 =:mapa_simulado1,
        mapa_simulado2 = :mapa_simulado2,
        descricao = :descricao,
        tipo_maquina = :tipo_maquina,
        formato = :formato, 
		cores = :cores, 
		tipo_hora =:tipo_hora, 
		nph_turno = :nph_turno,
        minfunc_maquina = :minfunc_maquina,
        subsidio_preimpr = :subsidio_preimpr,
        subsidio_impressao = :subsidio_impressao,
        subsidio_acabamento = :subsidio_acabamento, 
		subsidio_percent = :subsidio_percent, 
		manutencao = :manutencao,
        materiais_aux = :materiais_aux, 
		n_funcionarios = :n_funcionarios,
        salarios = :salarios,
        encargos = :encargos,
        bonus_benef = :bonus_benef,
        sal_enc_bon_ben = :sal_enc_bon_ben, 
		valor_depreciavel = :valor_depreciavel, 
		valor_depreciavel_mes = :valor_depreciavel_mes, 
		num_maq = :num_maq,
        num_maq_turnos = :num_maq_turnos,
        custo_total = :custo_total,
        nhp_total = :nhp_total,
        custo_horare = :custo_horare, 
		custo_horams1 = :custo_horams1, 
		custo_horams2 = :custo_horams2, 
		observacoes = :observacoes
        WHERE id = :id
        "
        );
        $query->execute(array(':id' => $id, ':cod_eqp' => $cod_eqp, ':situacao_eqp' => $situacao_eqp, ':tipo_centro' => $tipo_centro, ':mapa_simulado1' => $mapa_simulado1, ':mapa_simulado2' => $mapa_simulado2,
        ':descricao' => $descricao, ':tipo_maquina' => $tipo_maquina, ':formato' => $formato, ':cores' => $cores, ':tipo_hora' => $tipo_hora,
        ':nph_turno' => $nph_turno, ':minfunc_maquina' => $minfunc_maquina, ':subsidio_preimpr' => $subsidio_preimpr, ':subsidio_impressao' => $subsidio_impressao, ':subsidio_acabamento' => $subsidio_acabamento, 
        ':subsidio_percent' => $subsidio_percent, ':manutencao' => $manutencao, ':materiais_aux' => $materiais_aux, ':n_funcionarios' => $n_funcionarios,
        ':salarios' => $salarios, ':encargos' => $encargos, ':bonus_benef' => $bonus_benef, ':sal_enc_bon_ben' => $sal_enc_bon_ben, ':valor_depreciavel' => $valor_depreciavel, 
        ':valor_depreciavel_mes' => $valor_depreciavel_mes, ':num_maq' => $num_maq, ':num_maq_turnos' => $num_maq_turnos, ':custo_total' => $custo_total, ':nhp_total' => $nhp_total,
        ':custo_horare' => $custo_horare, ':custo_horams1' => $custo_horams1, ':custo_horams2' => $custo_horams2, ':observacoes' => $observacoes));

        $query->bindValue(':id', $id, PDO::PARAM_STR);


        try {
            return $query->execute();
        } catch (PDOException $e) {
            echo 'Hovue um problema, confira se o equipamento não está cadastrado.
            <script>alert("Hovue um problema, confira se o equipamento não está cadastrado.")</script>
            
            ';
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







    public function cadastrar_cliente($nome_cliente, $placa, $estado, $veiculo, $envioaut, $data_entrada)
    {

        $query     = $this->bd->prepare(
            "INSERT INTO clientes (
		nome_cliente,
        placa,
        estado,
        veiculo,
        envioaut,
        data_entrada
		) 
		
		VALUES ( 
		:nome_cliente,
        :placa,
        :estado,
        :veiculo,
        :envioaut,
        :data_entrada
		)"

        );

        $query->bindValue(':nome_cliente', $nome_cliente, PDO::PARAM_STR);
        $query->bindValue(':placa', $placa, PDO::PARAM_STR);
        $query->bindValue(':estado', $estado, PDO::PARAM_STR);
        $query->bindValue(':veiculo', $veiculo, PDO::PARAM_STR);
        $query->bindValue(':envioaut', $envioaut, PDO::PARAM_STR);
        $query->bindValue(':data_entrada', $data_entrada, PDO::PARAM_STR);


        try {
            $query->execute();
            return $this->bd->lastInsertId();
        } catch (PDOException $e) {
            return die($e->getMessage());
        }
    }
    public function cadastrar_cliente2($nome_cliente, $placa, $estado, $veiculo, $fipe, $envioaut, $data_entrada)
    {

        $query     = $this->bd->prepare(
            "INSERT INTO clientesac (
		nome_cliente,
        placa,
        estado,
        veiculo,
        envioaut,
        data_entrada,
        fipe
		) 
		
		VALUES ( 
		:nome_cliente,
        :placa,
        :estado,
        :veiculo,
        :envioaut,
        :data_entrada,
        :fipe
		)"

        );

        $query->bindValue(':nome_cliente', $nome_cliente, PDO::PARAM_STR);
        $query->bindValue(':placa', $placa, PDO::PARAM_STR);
        $query->bindValue(':estado', $estado, PDO::PARAM_STR);
        $query->bindValue(':veiculo', $veiculo, PDO::PARAM_STR);
        $query->bindValue(':fipe', $fipe, PDO::PARAM_STR);
        $query->bindValue(':envioaut', $envioaut, PDO::PARAM_STR);
        $query->bindValue(':data_entrada', $data_entrada, PDO::PARAM_STR);


        try {
            $query->execute();
            return $this->bd->lastInsertId();
        } catch (PDOException $e) {
            return die($e->getMessage());
        }
    }
    public function cadastrar_clienteac($nome_cliente, $placa, $tel, $estado, $veiculo, $envioaut, $data_entrada, $status1)
    {

        $query     = $this->bd->prepare(
            "INSERT INTO clientesacio (
		nome_cliente,
        placa,
        tel,
        estado,
        veiculo,
        envioaut,
        data_entrada,
        status1
		) 
		
		VALUES ( 
		:nome_cliente,
        :placa,
        :tel,
        :estado,
        :veiculo,
        :envioaut,
        :data_entrada,
        :status1
        
		)"

        );

        $query->bindValue(':nome_cliente', $nome_cliente, PDO::PARAM_STR);
        $query->bindValue(':placa', $placa, PDO::PARAM_STR);
        $query->bindValue(':tel', $tel, PDO::PARAM_STR);
        $query->bindValue(':estado', $estado, PDO::PARAM_STR);
        $query->bindValue(':veiculo', $veiculo, PDO::PARAM_STR);
        $query->bindValue(':envioaut', $envioaut, PDO::PARAM_STR);
        $query->bindValue(':data_entrada', $data_entrada, PDO::PARAM_STR);
        $query->bindValue(':status1', $status1, PDO::PARAM_STR);


        try {
            $query->execute();
            return $this->bd->lastInsertId();
        } catch (PDOException $e) {
            return die($e->getMessage());
        }
    }
    public function atualizar_clienteac($id_cliente,$status1)
    {

        $query     = $this->bd->prepare(
            "UPDATE clientesacio SET status1 = :status1 WHERE id_cliente = :id_cliente"

        );

        $query->bindValue(':id_cliente', $id_cliente, PDO::PARAM_STR);
        $query->bindValue(':status1', $status1, PDO::PARAM_STR);


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
    public function verifica_cliente1($nome_cliente)
    {

        $query     = $this->bd->prepare("SELECT COUNT(`id_cliente`) FROM `clientesacio` WHERE `nome_cliente`= :nome_cliente");
        $query->bindValue(':nome_cliente', $nome_cliente, PDO::PARAM_STR);

        try {

            $query->execute();
            $linhas = $query->fetchColumn();

            if ($linhas == 0) {
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
    public function retorna_id_cliente1($nome_cliente)
    {

        $query     = $this->bd->prepare("SELECT id_cliente FROM `clientesacio` WHERE `nome_cliente`= :nome_cliente");
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
    public function cadastraob($observacoes)
    {

        $query     = $this->bd->prepare(
            "INSERT INTO clientesacio (
		observacoes
		) 
		
		VALUES ( 
		:observacoes
		)"

        );

        $query->bindValue(':observacoes', $observacoes, PDO::PARAM_STR);



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


    public function cadastrar_tipo($tipo)
    {

        $query     = $this->bd->prepare(
            "INSERT INTO chartjs (
		tipo_evento
		) 
		
		VALUES ( 
		:nome_cliente
		)"

        );

        $query->bindValue(':nome_cliente', $tipo, PDO::PARAM_STR);


        try {
            $query->execute();
            return $this->bd->lastInsertId();
        } catch (PDOException $e) {
            return die($e->getMessage());
        }
    }
    public function cadastrar_vistoria($id_admin, $id_cliente, $id_peca, $perito, $data_realizacao_vistoria,
    $custo_final, $participacao, $custo_rateio, $tipo_evento, $data, $protocolosga)
    {

        $query     = $this->bd->prepare(
            "INSERT INTO vistorias (
		id_admin,
		id_cliente,
		id_peca,
		perito,
		data_realizacao_vistoria,
        custo_final,
		participacao,
		custo_rateio,
        tipo_evento,
        data,
        protocolosga
        
		) 
		
		VALUES ( 
		:id_admin,
		:id_cliente,
		:id_peca,
		:perito,
		:data_realizacao_vistoria,
        :custo_final,
		:participacao,
		:custo_rateio,
        :tipo_evento,        
        :data,
        :protocolosga
        
		)"

        );

        $query->bindValue(':id_admin', $id_admin, PDO::PARAM_INT);
        $query->bindValue(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $query->bindValue(':id_peca', $id_peca, PDO::PARAM_INT);
        $query->bindValue(':perito', $perito, PDO::PARAM_STR);
        $query->bindValue(':data_realizacao_vistoria', $data_realizacao_vistoria, PDO::PARAM_STR);
        $query->bindValue(':custo_final', $custo_final, PDO::PARAM_INT);
        $query->bindValue(':participacao', $participacao, PDO::PARAM_STR);
        $query->bindValue(':custo_rateio', $custo_rateio, PDO::PARAM_STR);
        $query->bindValue(':tipo_evento', $tipo_evento, PDO::PARAM_STR);
        $query->bindValue(':data', $data, PDO::PARAM_STR);
        $query->bindValue(':protocolosga', $protocolosga, PDO::PARAM_STR);



        try {
            $query->execute();
            return $this->bd->lastInsertId();
        } catch (PDOException $e) {
            return die($e->getMessage());
        }
    }
    public function cadastrar_vistoria2($id_admin, $id_cliente, $id_peca, $perito,
    $custo_final, $participacao, $custo_rateio, $tipo_evento, $data, $protocolosga)
    {

        $query     = $this->bd->prepare(
            "INSERT INTO acordos (
		id_admin,
		id_cliente,
		id_peca,
		perito,
        custo_final,
		participacao,
		custo_rateio,
        tipo_evento,
        data,
        protocolosga
        
		) 
		
		VALUES ( 
		:id_admin,
		:id_cliente,
		:id_peca,
		:perito,
        :custo_final,
		:participacao,
		:custo_rateio,
        :tipo_evento,
        :data,
        :protocolosga
		)"

        );

        $query->bindValue(':id_admin', $id_admin, PDO::PARAM_INT);
        $query->bindValue(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $query->bindValue(':id_peca', $id_peca, PDO::PARAM_INT);
        $query->bindValue(':perito', $perito, PDO::PARAM_STR);
        $query->bindValue(':custo_final', $custo_final, PDO::PARAM_INT);
        $query->bindValue(':participacao', $participacao, PDO::PARAM_STR);
        $query->bindValue(':custo_rateio', $custo_rateio, PDO::PARAM_STR);
        $query->bindValue(':tipo_evento', $tipo_evento, PDO::PARAM_STR);
        $query->bindValue(':data', $data, PDO::PARAM_STR);
        $query->bindValue(':protocolosga', $protocolosga, PDO::PARAM_STR);



        try {
            $query->execute();
            return $this->bd->lastInsertId();
        } catch (PDOException $e) {
            return die($e->getMessage());
        }
    }
    public function cadastrar_vistoriaac($id_admin, $id_cliente, $id_peca, $perito, $data_realizacao_vistoria,
    $tipo_evento, $data, $protocolosga)
    {

        $query     = $this->bd->prepare(
            "INSERT INTO acionamentos (
		id_admin,
		id_cliente,
		id_peca,
		perito,
		data_realizacao_vistoria,
        tipo_evento,
        data,
        protocolosga
        
		) 
		
		VALUES ( 
		:id_admin,
		:id_cliente,
		:id_peca,
		:perito,
		:data_realizacao_vistoria,
        :tipo_evento,
        :data,
        :protocolosga
		)"

        );

        $query->bindValue(':id_admin', $id_admin, PDO::PARAM_INT);
        $query->bindValue(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $query->bindValue(':id_peca', $id_peca, PDO::PARAM_INT);
        $query->bindValue(':perito', $perito, PDO::PARAM_STR);
        $query->bindValue(':data_realizacao_vistoria', $data_realizacao_vistoria, PDO::PARAM_STR);
        $query->bindValue(':tipo_evento', $tipo_evento, PDO::PARAM_STR);
        $query->bindValue(':data', $data, PDO::PARAM_STR);
        $query->bindValue(':protocolosga', $protocolosga, PDO::PARAM_STR);



        try {
            $query->execute();
            return $this->bd->lastInsertId();
        } catch (PDOException $e) {
            return die($e->getMessage());
        }
    }
    public function cadastrarItemVistoria($id_vistoria, $nota, $ps, $fornecedor, $preco)
    {

        $query     = $this->bd->prepare(
            "INSERT INTO itens_vistoria (
			id_vistoria, 
			nota, 
			ps, 
			fornecedor, 
			preco
		) 
		
		VALUES ( 
			:id_vistoria,
			:nota,
			:ps,
			:fornecedor,
			:preco
		)"

        );

        $query->bindValue(':id_vistoria', $id_vistoria, PDO::PARAM_INT);
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
    public function cadastrarItemVistoria2($id_vistoria, $paragrafo, $detalhes, $preco, $datapag, $condicoesac, $valores2, 
    $nota, $ps,$fornecedor, $preco2)
    {

        $query     = $this->bd->prepare(
            "INSERT INTO itens_acordos (
			id_vistoria,
            paragrafo,
			detalhes,
			preco,
			datapag,
			condicoesac,
			valores2, 
			nota, 
			ps, 
			fornecedor, 
			preco2
		) 
		
		VALUES ( 
			:id_vistoria,
			:paragrafo,
			:detalhes,
			:preco,
			:datapag,
			:condicoesac,
			:valores2, 
			:nota, 
			:ps, 
			:fornecedor, 
			:preco2
		)"

        );

        $query->bindValue(':id_vistoria', $id_vistoria, PDO::PARAM_INT);
        $query->bindValue(':paragrafo', $paragrafo, PDO::PARAM_STR);
        $query->bindValue(':detalhes', $detalhes, PDO::PARAM_STR);
        $query->bindValue(':preco', $preco, PDO::PARAM_STR);
        $query->bindValue(':datapag', $datapag, PDO::PARAM_STR);
        $query->bindValue(':condicoesac', $condicoesac, PDO::PARAM_STR);
        $query->bindValue(':valores2', $valores2, PDO::PARAM_STR);
        $query->bindValue(':nota', $nota, PDO::PARAM_STR);
        $query->bindValue(':ps', $ps, PDO::PARAM_STR);
        $query->bindValue(':fornecedor', $fornecedor, PDO::PARAM_STR);
        $query->bindValue(':preco2', $preco2, PDO::PARAM_STR);


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
    public function listarVistorias2()
    {

        $query = $this->bd->prepare("SELECT acordos.*, admins.nome_admin, admins.email, clientesac.nome_cliente, pecas.numero_serie, pecas.nome_peca, pecas.modelo, pecas.codigo
		FROM acordos
		INNER JOIN admins ON acordos.id_admin = admins.id_admin
		INNER JOIN clientesac ON acordos.id_cliente = clientesac.id_cliente
		INNER JOIN pecas ON acordos.id_peca = pecas.id_peca
		ORDER BY acordos.id_vistoria DESC 
		");

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $query->fetchAll();
    }

    public function listarEquipamentos($inicio, $registrosPorPagina)
    {

        $query = $this->bd->prepare("SELECT * FROM equipamentos ORDER BY id DESC LIMIT " . $inicio . " , " . $registrosPorPagina . "");

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $query->fetchAll();
    }



    public function listarVistoriasPaginate($inicio, $registrosPorPagina)
    {

        $query = $this->bd->prepare("SELECT vistorias.*, admins.nome_admin, admins.email, clientes.nome_cliente, clientes.placa, clientes.veiculo, pecas.numero_serie, pecas.nome_peca, pecas.modelo, pecas.codigo
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
    public function listarVistoriasPaginate2($inicio, $registrosPorPagina)
    {

        $query = $this->bd->prepare("SELECT acordos.*, admins.nome_admin, admins.email, clientesac.nome_cliente, clientesac.placa, clientesac.veiculo, clientesac.data_entrada, pecas.numero_serie, pecas.nome_peca, pecas.modelo, pecas.codigo 
FROM acordos 
INNER JOIN admins ON acordos.id_admin = admins.id_admin 
INNER JOIN clientesac ON acordos.id_cliente = clientesac.id_cliente 
INNER JOIN pecas ON acordos.id_peca = pecas.id_peca 
ORDER BY clientesac.data_entrada DESC LIMIT " . $inicio . " , " . $registrosPorPagina . "");

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $query->fetchAll();
    }
    public function listarVistoriasPaginate3($inicio, $registrosPorPagina)
    {

        $query = $this->bd->prepare("SELECT acionamentos.*, admins.nome_admin, admins.email, clientesacio.nome_cliente, clientesacio.placa, clientesacio.veiculo, clientesacio.status1, clientesacio.tel, pecas.numero_serie, pecas.nome_peca, pecas.modelo, pecas.codigo
		FROM acionamentos
		INNER JOIN admins ON acionamentos.id_admin = admins.id_admin
		INNER JOIN clientesacio ON acionamentos.id_cliente = clientesacio.id_cliente
		INNER JOIN pecas ON acionamentos.id_peca = pecas.id_peca
		ORDER BY acionamentos.id_vistoria DESC LIMIT " . $inicio . " , " . $registrosPorPagina . "");

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
    public function totalDeVistorias2()
    {

        $query = $this->bd->prepare("SELECT count(*) FROM acordos");

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }


        $count = $query->fetch(PDO::FETCH_NUM); // Return array indexed by column number
        return reset($count); // Resets array cursor and returns first value (the count)

    }
    public function totalDeVistorias3()
    {

        $query = $this->bd->prepare("SELECT count(*) FROM acionamentos");

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }


        $count = $query->fetch(PDO::FETCH_NUM); // Return array indexed by column number
        return reset($count); // Resets array cursor and returns first value (the count)

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
    public function listarVistoriaPorId3($id_vistoria)
    {

        $query = $this->bd->prepare("SELECT acionamentos.*, admins.nome_admin, admins.email, clientesacio.nome_cliente, clientesacio.placa, clientesacio.veiculo, clientesacio.estado, clientesacio.envioaut,clientesacio.data_entrada, clientesacio.status1, clientesacio.tel, clientesacio.observacoes, pecas.numero_serie, pecas.nome_peca, pecas.modelo, pecas.codigo
		FROM acionamentos
		INNER JOIN admins ON acionamentos.id_admin = admins.id_admin
		INNER JOIN clientesacio ON acionamentos.id_cliente = clientesacio.id_cliente
		INNER JOIN pecas ON acionamentos.id_peca = pecas.id_peca
        INNER JOIN itens_vistoria ON acionamentos.id_peca = pecas.id_peca
		WHERE acionamentos.id_vistoria = :id_vistoria
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

    public function listarDadosEquipamento($id)
    {

        $query = $this->bd->prepare("SELECT * FROM equipamentos 
		WHERE id = :id
		");

        $query->bindValue(':id', $id, PDO::PARAM_INT);

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $query->fetch();
    }



    public function listarVistoriaPorId($id_vistoria)
    {

        $query = $this->bd->prepare("SELECT vistorias.*, admins.nome_admin, admins.email, clientes.nome_cliente, clientes.placa, clientes.veiculo, clientes.estado, clientes.envioaut,clientes.data_entrada, pecas.numero_serie, pecas.nome_peca, pecas.modelo, pecas.codigo
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


    public function listarVistoriaPorId2($id_vistoria)
    {

        $query = $this->bd->prepare("SELECT acordos.*, admins.nome_admin, admins.email, clientesac.nome_cliente, clientesac.placa, clientesac.veiculo, clientesac.fipe, clientesac.estado, clientesac.envioaut,clientesac.data_entrada, pecas.numero_serie, pecas.nome_peca, pecas.modelo, pecas.codigo
		FROM acordos
		INNER JOIN admins ON acordos.id_admin = admins.id_admin
		INNER JOIN clientesac ON acordos.id_cliente = clientesac.id_cliente
		INNER JOIN pecas ON acordos.id_peca = pecas.id_peca
        INNER JOIN itens_acordos ON acordos.id_peca = pecas.id_peca
		WHERE acordos.id_vistoria = :id_vistoria
		");

        $query->bindValue(':id_vistoria', $id_vistoria, PDO::PARAM_INT);

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        $vistoria = $query->fetch(PDO::FETCH_ASSOC);

        $vistoria["itensDeVistoria2"] = $this->itensDeVistoria2($id_vistoria);

        return $vistoria;
    }


    public function itensDeVistoria2($id_vistoria)
    {
        $itensDeVistoria2 = [];

        $query = $this->bd->prepare("SELECT itens_acordos.* FROM itens_acordos
		WHERE itens_acordos.id_vistoria = :id_vistoria
		");

        $query->bindValue(':id_vistoria', $id_vistoria, PDO::PARAM_INT);

        try {
            $query->execute();

            if ($query->rowCount() > 0) {
                $itensDeVistoria2 = $query->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $itensDeVistoria2;
    }


    public function itensDeVistoria($id_vistoria)
    {
        $itensDeVistoria = [];

        $query = $this->bd->prepare("SELECT itens_vistoria.* FROM itens_vistoria
		WHERE itens_vistoria.id_vistoria = :id_vistoria
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
    public function itensGrafico($id_vistoria)
    {
        $itensDeVistoria = [];

        $query = $this->bd->prepare("SELECT chartjs.* FROM chartjs
		WHERE chartjs.id_vistoria = :id_vistoria
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
    public function deletarVistoria1($id_cliente)
    {

        $query = $this->bd->prepare("DELETE FROM clientes WHERE id_cliente = :id_cliente LIMIT 1");

        $query->bindParam(':id_cliente', $id_cliente);

        try {
            return $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    public function deletarAcio($id_vistoria)
    {

        $query = $this->bd->prepare("DELETE FROM acionamentos WHERE id_vistoria = :id_vistoria LIMIT 1");

        $query->bindParam(':id_vistoria', $id_vistoria);

        try {
            return $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    public function atualizar()
    {

        //$query = $this->bd->prepare("SELECT * FROM clientesacio WHERE status1 = :status1");
        
            $query = $this->bd->prepare("UPDATE `clientesacio` SET `status1` = ? WHERE `id_cliente`= ? LIMIT 1");
            $query->bindValue(1 ,$_POST["status1"], PDO::PARAM_STR);
            $query->bindValue(2 ,$_POST["id_cliente"], PDO::PARAM_INT);

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

    public function buscarVistorias2($search)
    {

        $query = $this->bd->prepare("SELECT acordos.*, admins.nome_admin, admins.email, clientesac.nome_cliente, clientesac.numero_serie, pecas.nome_peca, pecas.modelo, pecas.codigo, itens_vistoria.id_vistoria
		FROM acordos
		INNER JOIN admins ON acordos.id_admin = admins.id_admin
		INNER JOIN clientesac ON acordos.id_cliente = clientes.id_cliente
		INNER JOIN pecas ON acordos.id_peca = pecas.id_peca
		
		WHERE 
		acordos.data_realizacao_vistoria REGEXP '$search' OR 
		admins.nome_admin REGEXP '$search' OR 
	    admins.email REGEXP '$search' OR
		clientesac.nome_cliente REGEXP '$search' OR
		pecas.numero_serie REGEXP '$search' OR
		pecas.nome_peca REGEXP '$search' OR
		pecas.modelo REGEXP '$search' OR
		pecas.codigo REGEXP '$search' OR
        itens_vistoria.id_vistoria'$search'
			
		ORDER BY acordos.id_vistoria DESC 
		");

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $query->fetchAll();
    }

    public function listar($nome_coluna){


	    $query 	= $this->bd->prepare("SELECT ".$nome_coluna." FROM usuarios");
	    
		try{
            $query->execute();
		   
		}
		
		catch(PDOException $e){
			die($e->getMessage());
		}
		
		return $query->fetchAll();
		
		
	}



    public function buscarVistoriasPaginate($search, $inicio, $registrosPorPagina)
    {

        $query = $this->bd->prepare("SELECT vistorias.*, admins.nome_admin, admins.email, clientes.nome_cliente, clientes.placa, clientes.veiculo, pecas.numero_serie, pecas.nome_peca, pecas.modelo, pecas.codigo
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
		pecas.codigo REGEXP '$search' 

		ORDER BY vistorias.id_vistoria DESC LIMIT " . $inicio . " , " . $registrosPorPagina . "");

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $query->fetchAll();
    }
    public function buscarVistoriasPaginate2($busca, $inicio, $registrosPorPagina)
    {

        $query = $this->bd->prepare("SELECT acordos.*, admins.nome_admin, admins.email, clientesac.nome_cliente, clientesac.placa, clientesac.veiculo, clientesac.data_entrada, pecas.numero_serie, pecas.nome_peca, pecas.modelo, pecas.codigo
		FROM acordos
		INNER JOIN admins ON acordos.id_admin = admins.id_admin
		INNER JOIN clientesac ON acordos.id_cliente = clientesac.id_cliente
		INNER JOIN pecas ON acordos.id_peca = pecas.id_peca
		
		WHERE 
		acordos.data_realizacao_vistoria REGEXP '$busca' OR 
		admins.nome_admin REGEXP '$busca' OR 
	    admins.email REGEXP '$busca' OR
		clientesac.nome_cliente REGEXP '$busca' OR
		clientesac.data_entrada REGEXP '$busca' OR
		clientesac.placa REGEXP '$busca' OR
		pecas.numero_serie REGEXP '$busca' OR
		pecas.nome_peca REGEXP '$busca' OR
		pecas.modelo REGEXP '$busca' OR
		pecas.codigo REGEXP '$busca' 

		ORDER BY clientesac.data_entrada DESC LIMIT " . $inicio . " , " . $registrosPorPagina . "");

        try {
            $query->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $query->fetchAll();
    }
    public function buscarVistoriasPaginate3($busca, $inicio, $registrosPorPagina)
    {

        $query = $this->bd->prepare("SELECT acionamentos.*, admins.nome_admin, admins.email, clientesacio.nome_cliente, clientesacio.placa, clientesacio.veiculo, clientesacio.status1, pecas.numero_serie, pecas.nome_peca, pecas.modelo, pecas.codigo
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

		ORDER BY acionamentos.id_vistoria DESC LIMIT " . $inicio . " , " . $registrosPorPagina . "");

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
            $query = $this->bd->prepare("SELECT * FROM usuarios WHERE usuario = :usuario");
            $query->execute(array(':usuario' => $usuario));
            $conta = $query->rowCount();

            if ($conta > 0) {
                $dados = $query->fetch(PDO::FETCH_ASSOC);
                return $dados[$arr];
            }
        } catch (PDOException $e) {
            $e->getMessage();
        }
        return $query->fetchAll();
    }
    public function editar_dados()
    {
        if (isset($_POST['env']) && $_POST['env'] == "alt") {
            //move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)
            $uploaddir = 'chat/imagens/';
            $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
            if ($_FILES['userfile']['size'] <= 0) {
                $stmt = $this->pdo->prepare("UPDATE usuarios SET nome = :nome, email = :email, senha = :senha, sexo = :sexo WHERE usuario = :usuario");
                $stmt->execute(array(
                    ':nome' => $_POST['nome'],
                    ':email' => $_POST['email'],
                    ':senha' => $_POST['senha'],
                    ':sexo' => $_POST['sexo'],
                    ':usuario' => $_POST['usuario']
                ));
            } else {
                $stmt = $this->pdo->prepare("UPDATE usuarios SET nome = :nome, email = :email, senha = :senha, sexo = :sexo, foto = :foto WHERE usuario = :usuario");
                $stmt->execute(array(
                    ':nome' => $_POST['nome'],
                    ':email' => $_POST['email'],
                    ':senha' => $_POST['senha'],
                    ':sexo' => $_POST['sexo'],
                    ':foto' => $uploadfile,
                    ':usuario' => $_POST['usuario']
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
        echo "<script>toastr.success{$tipo}('$mensagem','$col');</script>";
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
function mostraMes($m) {
    switch ($m) {
        case 01: case 1: $mes = "Janeiro";
        break;
        case 02: case 2: $mes = "Fevereiro";
        break;
        case 03: case 3: $mes = "Mar&ccedil;o";
        break;
        case 04: case 4: $mes = "Abril";
        break;
        case 05: case 5: $mes = "Maio";
        break;
        case 06: case 6: $mes = "Junho";
        break;
        case 07: case 7: $mes = "Julho";
        break;
        case 8: case 8: $mes = "Agosto";
        break;
        case 9: case 9: $mes = "Setembro";
        break;
        case 10: $mes = "Outubro";
            break;
        case 11: $mes = "Novembro";
            break;
        case 12: $mes = "Dezembro";
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
        if( self::$baseUrl != null )
            return self::$baseUrl;
 
        global $_SERVER;
        $startUrl = strlen( $_SERVER["DOCUMENT_ROOT"] );
        $excludeUrl = substr( $_SERVER["SCRIPT_FILENAME"], $startUrl, -9 );
        if( $excludeUrl[0] == "/" )
            self::$baseUrl = $excludeUrl;
        else
            self::$baseUrl = "/" . $excludeUrl;
        return self::$baseUrl;
    }
 
    public static function getURL( $id )
    {
        // Verifica se a lista de URL já foi preenchida
        if( self::$url == null )
            self::getURLList();
         
        // Valida se existe o ID informado e retorna.
        if( isset( self::$url[ $id ] ) )
            return self::$url[ $id ];
         
        // Caso não exista o ID, retorna nulo
        return null;
    }
     
    private static function getURLList()
    {
        global $_SERVER;
         
        // Primeiro traz todos as pastas abaixo do index.php
        $startUrl = strlen( $_SERVER["DOCUMENT_ROOT"] ) -1;
        $excludeUrl = substr( $_SERVER["SCRIPT_FILENAME"], $startUrl, -10 );
         
        // a variável$request possui toda a string da URL após o domínio.
        $request = $_SERVER['REQUEST_URI'];
         
        // Agora retira toda as pastas abaixo da pasta raiz
        $request = substr( $request, strlen( $excludeUrl ) );
         
        // Explode a URL para pegar retirar tudo após o ?
        $urlTmp = explode("?", $request);
        $request = $urlTmp[ 0 ];
         
        // Explo a URL para pegar cada uma das partes da URL
        $urlExplodida = explode("/", $request);
         
        $retorna = array();
 
        for($a = 0; $a <= count($urlExplodida); $a ++)
        {
            if(isset($urlExplodida[$a]) AND $urlExplodida[$a] != "")
            {
                array_push($retorna, $urlExplodida[$a]);
            }
        }
        self::$url = $retorna;
    }
}