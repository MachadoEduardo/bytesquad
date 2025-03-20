<?php
require_once 'conexao.class.php';

class Usuarios {
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

    public function __construct() {
        $this->con = new Conexao();
    }

    public function existeEmail($email_usuario) {
        $sql = $this->con->conectar()->prepare("SELECT id FROM usuario WHERE email_usuario = :email_usuario");
        $sql->bindParam(':email_usuario', $email_usuario, PDO::PARAM_STR);
        $sql->execute();

        return $sql->rowCount() > 0; // Retorna verdadeiro se o email já existir
    }

    public function adicionar($email_usuario, $nome_usuario, $senha_usuario, $permissoes_usuario, $ativo_usuario, $url_foto, $telefone, $id_redesocial) {
        if (!$this->existeEmail($email_usuario)) { // Verifica se o email não existe
            try {
                $senha_criptografada = password_hash($senha_usuario, PASSWORD_DEFAULT); // Criptografando a senha
                $sql = $this->con->conectar()->prepare(
                    "CALL InserirUsuario (:nome, :email, :senha, :permissoes_usuario, :ativo_usuario, :url_foto, :telefone, :id_redesocial)"
                );

                $sql->bindValue(':nome', $nome_usuario);
                $sql->bindValue(':email', $email_usuario);
                $sql->bindValue(':senha', $senha_criptografada);
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

    public function listar() {
        try {
            $sql = $this->con->conectar()->prepare("CALL ListarUsuario()");
            $sql->execute();
            return $sql->fetchAll();
        } catch (PDOException $ex) {
            echo "ERRO: " . $ex->getMessage();
        }
    }

    public function listarRedeSocial() {
        try {
            $sql = $this->con->conectar()->prepare("CALL ListarJoinRedeSocial()");
            $sql->execute();
            return $sql->fetchAll();
        } catch (PDOException $ex) {
            echo "ERRO: " . $ex->getMessage();
        }
    }

    public function deletar() {
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

    public function buscarUsuario($id) {
        try {
            $sql = $this->con->conectar()->prepare("SELECT * FROM usuario WHERE id = :id");
            $sql->bindParam(':id', $id, PDO::PARAM_INT);
            $sql->execute();
            return $sql->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            error_log("ERRO: " . $ex->getMessage());
            return false;
        }
    }

    public function editar($id, $nome_usuario, $email_usuario, $senha_usuario, $permissoes_usuario, $ativo_usuario, $url_foto, $telefone, $id_redesocial) {
        try {
            $senha_criptografada = password_hash($senha_usuario, PASSWORD_DEFAULT); // Criptografando a senha
            $sql = $this->con->conectar()->prepare(
                "UPDATE usuario SET nome_usuario = :nome, email_usuario = :email, senha_usuario = :senha, permissoes_usuario = :permissoes_usuario, ativo_usuario = :ativo_usuario,
                url_foto = :url_foto, telefone = :telefone, id_redesocial = :id_redesocial WHERE id = :id"
            );
            
            $sql->bindValue(':id', $id);
            $sql->bindValue(':nome', $nome_usuario);
            $sql->bindValue(':email', $email_usuario);
            $sql->bindValue(':senha', $senha_criptografada);
            $sql->bindValue(':permissoes_usuario', $permissoes_usuario);
            $sql->bindValue(':ativo_usuario', $ativo_usuario);
            $sql->bindValue(':url_foto', $url_foto);
            $sql->bindValue(':telefone', $telefone);
            $sql->bindValue(':id_redesocial', $id_redesocial);
            
            $sql->execute();
            header('Location: gerenciarUsuario.php');
        } catch (PDOException $ex) {
            echo 'ERRO: ' . $ex->getMessage();
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
}