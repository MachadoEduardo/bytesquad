<?php
require 'conexao.class.php';

class Administrador {
    private $id;
    private $usuario;
    private $senha;
    private $permissoes;

    private $con;

    public function __construct() {
        $this->con = new Conexao();
    }

    // Verifica se o administrador já existe pelo nome do usuário
    private function existeAdministrador($usuario) {
        $sql = $this->con->conectar()->prepare("SELECT id_administrativo FROM administrativo WHERE usuario = :usuario");
        $sql->bindParam(':usuario', $usuario, PDO::PARAM_STR);
        $sql->execute();

        return $sql->rowCount() > 0; // Retorna verdadeiro se o administrador já existir
    }

    public function adicionar($usuario, $senha, $permissoes) {
        // Chama a função que verifica se o administrador com esse nome de usuário não existe
        if (!$this->existeAdministrador($usuario)) {
            try {
                $senha_criptografada = password_hash($senha, PASSWORD_DEFAULT); // Criptografando a senha (pode usar MD5 também inclusive acho que vou mudar depois tmj)
                $sql = $this->con->conectar()->prepare(
                    "INSERT INTO administrativo (usuario, senha_admin, permissoes_admin) 
                     VALUES (:nome, :senha, :permissoes)"
                );

                $sql->bindParam(':nome', $usuario, PDO::PARAM_STR);
                $sql->bindParam(':senha', $senha_criptografada, PDO::PARAM_STR);
                $sql->bindParam(':permissoes', $permissoes, PDO::PARAM_STR);

                $sql->execute(); // Executa a consulta
                return true; // Retorna verdadeiro se a inserção for bem-sucedida
            } catch (PDOException $ex) {
                return 'ERRO: ' . $ex->getMessage();
            }
        } else {
            return false; // Retorna falso se o administrador já existir
        }
    }

    // Método básico pra listar do banco não vou explica é muito simples
    public function listar() {
        try {
            $sql = $this->con->conectar()->prepare("SELECT * FROM administrativo");
            $sql->execute();
            return $sql->fetchAll();
        } catch (PDOException $ex) {
            echo "ERRO: " . $ex->getMessage();
        }
    }

    // Parte dois do comentário anterior!!
    public function deletar() {
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            
            try {
                $sql = $this->con->conectar()->prepare("DELETE FROM administrativo WHERE id_administrativo = :id");
                $sql->bindParam(':id', $id, PDO::PARAM_INT);
                $sql->execute();
        
                header('Location: gerenciarAdministrador.php');
            } catch (PDOException $ex) {
                echo 'ERRO: ' . $ex->getMessage();
            }
        }
    }    

    // Função para encontrar o administrador dono do ID especifico, para poder trazer as informações dele no editar
    public function buscarAdministrador($id) {
        try {
            $sql = $this->con->conectar()->prepare("SELECT * FROM administrativo WHERE id_administrativo = :id");
            $sql->bindParam(':id', $id, PDO::PARAM_INT);
            $sql->execute();
            return $sql->fetch(PDO::FETCH_ASSOC); // Retorna os dados do usuário como array associativo
        } catch (PDOException $ex) {
            echo "ERRO: " . $ex->getMessage();
        }
    }

    public function editar($id, $usuario, $senha, $permissoes) {
        try {
            $senha_criptografada = password_hash($senha, PASSWORD_DEFAULT); // Criptografando a senha
            $sql = $this->con->conectar()->prepare(
                "UPDATE administrativo SET usuario = :nome, senha_admin = :senha, permissoes_admin = :permissoes WHERE id_administrativo = :id"
            );
            $sql->bindParam(':id', $id, PDO::PARAM_INT);
            $sql->bindParam(':nome', $usuario, PDO::PARAM_STR);
            $sql->bindParam(':senha', $senha_criptografada, PDO::PARAM_STR);
            $sql->bindParam(':permissoes', $permissoes, PDO::PARAM_STR);
    
            $sql->execute();
            header('Location: gerenciarAdministrador.php');
        } catch (PDOException $ex) {
            echo 'ERRO: ' . $ex->getMessage();
        }
    }
    
    
}

