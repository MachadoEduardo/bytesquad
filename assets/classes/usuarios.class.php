<?php
require_once 'conexao.class.php';

class Usuarios {
    private $id;
    private $nome_usuario;
    private $email_usuario;
    private $senha_usuario;

    private $con;

    public function __construct() {
        $this->con = new Conexao();
    }

    private function existeEmail($email_usuario) {
        $sql = $this->con->conectar()->prepare("SELECT id FROM usuario WHERE email_usuario = :email_usuario");
        $sql->bindParam(':email_usuario', $email_usuario, PDO::PARAM_STR);
        $sql->execute();

        return $sql->rowCount() > 0; // Retorna verdadeiro se o email já existir
    }

    public function adicionar($email_usuario, $nome_usuario, $senha_usuario) {
        if (!$this->existeEmail($email_usuario)) { // Verifica se o email não existe
            try {
                $senha_criptografada = password_hash($senha_usuario, PASSWORD_DEFAULT); // Criptografando a senha
                $sql = $this->con->conectar()->prepare(
                    "INSERT INTO usuario (nome_usuario, email_usuario, senha_usuario) 
                     VALUES (:nome, :email, :senha)"
                );

                $sql->bindParam(':nome', $nome_usuario, PDO::PARAM_STR);
                $sql->bindParam(':email', $email_usuario, PDO::PARAM_STR);
                $sql->bindParam(':senha', $senha_criptografada, PDO::PARAM_STR);

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
            $sql = $this->con->conectar()->prepare("SELECT * FROM usuario");
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
                $sql = $this->con->conectar()->prepare("DELETE FROM usuario WHERE id = :id");
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
            return $sql->fetch(PDO::FETCH_ASSOC); // Retorna os dados do usuário como array associativo
        } catch (PDOException $ex) {
            echo "ERRO: " . $ex->getMessage();
        }
    }

    public function editar($id, $nome_usuario, $email_usuario, $senha_usuario) {
        try {
            $senha_criptografada = password_hash($senha_usuario, PASSWORD_DEFAULT); // Criptografando a senha
            $sql = $this->con->conectar()->prepare(
                "UPDATE usuario SET nome_usuario = :nome, email_usuario = :email, senha_usuario = :senha WHERE id = :id"
            );
            $sql->bindParam(':id', $id, PDO::PARAM_INT);
            $sql->bindParam(':nome', $nome_usuario, PDO::PARAM_STR);
            $sql->bindParam(':email', $email_usuario, PDO::PARAM_STR);
            $sql->bindParam(':senha', $senha_criptografada, PDO::PARAM_STR);
    
            $sql->execute();
            header('Location: gerenciarUsuario.php');
        } catch (PDOException $ex) {
            echo 'ERRO: ' . $ex->getMessage();
        }
    }  
}
