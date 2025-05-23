<?php
require_once 'conexao.class.php';

class Usuarios
{
    private $id;
    private $nome_usuario;
    private $email_usuario;
    private $senha_usuario;
    private $permissoes_usuario;
    private $ativo_usuario;
    private $url_foto;
    private $telefone;
    private $id_redesocial;

    private $con;

    public function __construct()
    {
        $this->con = new Conexao();
    }

    public function existeEmail($email_usuario)
    {
        $sql = $this->con->conectar()->prepare("SELECT id FROM usuario WHERE email_usuario = :email_usuario");
        $sql->bindParam(':email_usuario', $email_usuario, PDO::PARAM_STR);
        $sql->execute();

        return $sql->rowCount() > 0; // Retorna verdadeiro se o email já existir
    }

    public function adicionar($email_usuario, $nome_usuario, $senha_usuario, $permissoes_usuario, $ativo_usuario, $url_foto, $telefone, $id_redesocial)
    {
        if (!$this->existeEmail($email_usuario)) { // Verifica se o email não existe
            try {
                $sql = $this->con->conectar()->prepare(
                    "CALL InserirUsuario (:nome, :email, :senha, :permissoes_usuario, :ativo_usuario, :url_foto, :telefone, :id_redesocial)"
                );

                $sql->bindValue(':nome', $nome_usuario);
                $sql->bindValue(':email', $email_usuario);
                $sql->bindValue(':senha', $senha_usuario);
                $sql->bindValue(':permissoes_usuario', $permissoes_usuario);
                $sql->bindValue(':ativo_usuario', $ativo_usuario);
                $sql->bindValue(':url_foto', $url_foto);
                $sql->bindValue(':telefone', $telefone);
                $sql->bindValue(':id_redesocial', $id_redesocial);

                $sql->execute(); // Executa a consulta
                return true; // Retorna verdadeiro se a inserção for bem-sucedida
            } catch (PDOException $ex) {
                return 'ERRO: ' . $ex->getMessage();
            }
        } else {
            return false; // Retorna falso se o email já existir
        }
    }

    public function listar()
    {
        try {
            $sql = $this->con->conectar()->prepare("CALL ListarUsuario()");
            $sql->execute();
            return $sql->fetchAll();
        } catch (PDOException $ex) {
            echo "ERRO: " . $ex->getMessage();
        }
    }

    public function listarRedeSocial()
    {
        try {
            $sql = $this->con->conectar()->prepare("CALL ListarJoinRedeSocial()");
            $sql->execute();
            return $sql->fetchAll();
        } catch (PDOException $ex) {
            echo "ERRO: " . $ex->getMessage();
        }
    }

    public function deletar()
    {
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);

            try {
                $sql = $this->con->conectar()->prepare("CALL ExcluirUsuario(:id)");
                $sql->bindParam(':id', $id, PDO::PARAM_INT);
                $sql->execute();

                header('Location: gerenciarUsuario.php');
            } catch (PDOException $ex) {
                echo 'ERRO: ' . $ex->getMessage();
            }
        }
    }

    public function buscarUsuario($id)
    {
        try {
            // Verifique se a conexão está funcionando
            $conexao = $this->con->conectar();
            if (!$conexao) {
                throw new PDOException("Falha na conexão com o banco de dados");
            }

            $sql = $conexao->prepare("SELECT * FROM usuario WHERE id = :id");
            $sql->bindParam(':id', $id, PDO::PARAM_INT);

            if (!$sql->execute()) {
                throw new PDOException("Erro ao executar a consulta");
            }

            return $sql->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            // Log detalhado do erro
            error_log("ERRO NA CONSULTA: " . $ex->getMessage());
            return false;
        }
    }

    public function editar($id, $nome, $email, $telefone, $senhaAtual, $novaSenha, $url_foto)
    {
        $conexao = $this->con->conectar();
        if (!$conexao) {
            throw new PDOException("Falha na conexão com o banco de dados");
        }
        $sql = $conexao->prepare("SELECT senha_usuario FROM usuario WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $dados = $sql->fetch();
            if (password_verify($senhaAtual, $dados['senha_usuario'])) {
                // Atualiza senha se uma nova foi informada
                $senhaFinal = !empty($novaSenha) ? password_hash($novaSenha, PASSWORD_DEFAULT) : $dados['senha_usuario'];

                // CORREÇÃO: Removido o $this-> antes de $conexao
                $sql = $conexao->prepare("
                UPDATE usuario 
                SET nome_usuario = :nome, 
                    email_usuario = :email,
                    senha_usuario = :senha,
                    telefone = :telefone,
                    url_foto = :foto
                WHERE id = :id
            ");

                $sql->bindValue(":nome", $nome);
                $sql->bindValue(":email", $email);
                $sql->bindValue(":telefone", $telefone);
                $sql->bindValue(":senha", $senhaFinal);
                $sql->bindValue(":foto", $url_foto);
                $sql->bindValue(":id", $id);
                $sql->execute();

                return true;
            } else {
                return false; // Senha atual incorreta
            }
        } else {
            return false; // Usuário não encontrado
        }
    }

    public function fazerLogin($nome_usuario, $senha_usuario)
    {
        $sql = $this->con->conectar()->prepare("SELECT * FROM usuario WHERE nome_usuario = :nome_usuario");
        $sql->bindValue(":nome_usuario", $nome_usuario);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();
            // Verificando a senha com password_verify
            if (password_verify($senha_usuario, $sql['senha_usuario'])) {
                $_SESSION['Logado'] = $sql['id'];
                return true;
            }
        }
        return false;
    }

    public function atualizarSenha($email, $novaSenha)
    {
        $sql = $this->con->conectar()->prepare("UPDATE usuario SET senha_usuario = :senha_usuario WHERE email_usuario = :email_usuario");
        $senhaHash = password_hash($novaSenha, PASSWORD_DEFAULT); // Usa o password_hash
        $sql->bindValue(":senha_usuario", $senhaHash); // Armazena a senha criptografada
        $sql->bindValue(":email_usuario", $email);
        return $sql->execute(); // Executa a atualização
    }
}
