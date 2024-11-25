<?php
require_once 'conexao.class.php';

class Administrador
{
    private $id;
    private $usuario;
    private $senha;
    private $permissoes;

    private $con;

    public function __construct()
    {
        $this->con = new Conexao();
    }

    // Verifica se o administrador já existe pelo nome do usuário
    private function existeAdministrador($usuario)
    {
        $sql = $this->con->conectar()->prepare("SELECT id_administrativo FROM administrativo WHERE usuario = :usuario");
        $sql->bindParam(':usuario', $usuario, PDO::PARAM_STR);
        $sql->execute();

        return $sql->rowCount() > 0; // Retorna verdadeiro se o administrador já existir
    }

    public function adicionar($usuario, $senha, $permissoes)
    {
        if (!$this->existeAdministrador($usuario)) {
            try {
                $senha_criptografada = password_hash($senha, PASSWORD_DEFAULT); // Criptografa a senha de forma segura
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
    public function listar()
    {
        try {
            $sql = $this->con->conectar()->prepare("SELECT * FROM administrativo");
            $sql->execute();
            return $sql->fetchAll();
        } catch (PDOException $ex) {
            echo "ERRO: " . $ex->getMessage();
        }
    }

    // Parte dois do comentário anterior!!
    public function deletar()
    {
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
    public function buscarAdministrador($id)
    {
        try {
            $sql = $this->con->conectar()->prepare("SELECT * FROM administrativo WHERE id_administrativo = :id");
            $sql->bindParam(':id', $id, PDO::PARAM_INT);
            $sql->execute();
            return $sql->fetch(PDO::FETCH_ASSOC); // Retorna os dados do usuário como array associativo
        } catch (PDOException $ex) {
            echo "ERRO: " . $ex->getMessage();
        }
    }

    public function editar($id, $usuario, $senha, $permissoes)
    {
        try {
            // Usando password_hash para criptografar a senha de maneira segura
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

    public function fazerLogin($usuario, $senha)
{
    $sql = $this->con->conectar()->prepare("SELECT * FROM administrativo WHERE usuario = :usuario");
    $sql->bindValue(":usuario", $usuario);
    $sql->execute();

    if ($sql->rowCount() > 0) {
        $sql = $sql->fetch();
        // Verificando a senha com password_verify
        if (password_verify($senha, $sql['senha_admin'])) {
            $_SESSION['Logado'] = $sql['id_administrativo'];
            return true;
        }
    }
    return false;
}


    public function setUsuario($id)
    {
        $this->id = $id;
        $sql = $this->con->conectar()->prepare("SELECT * FROM administrativo WHERE id_administrativo = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();
            $this->permissoes = explode(', ', $sql['permissoes_admin']); // Transforma em array
        }
    }
    public function getPermissoes()
    {
        return $this->permissoes;
    }
    public function temPermissoes($permissao)
    {
        if (isset($_SESSION['Logado'])) {
            $id = $_SESSION['Logado'];
            $this->setUsuario($id);  // Carrega as permissões do usuário

            // Verifique se a permissão está presente na lista de permissões do usuário
            return in_array($permissao, $this->permissoes);
        }
        return false;
    }
    public function verificarAdmin($usuario)
    {
        $sql = $this->con->conectar()->prepare("SELECT id_administrativo FROM administrativo WHERE usuario = :usuario");
        $sql->bindValue(":usuario", $usuario);
        $sql->execute();
        return $sql->rowCount() > 0; // Verifica se encontrou o usuario
    }


    // Atualiza a senha no banco
    public function atualizarSenha($usuario, $novaSenha)
    {
        $sql = $this->con->conectar()->prepare("UPDATE administrativo SET senha_admin = :senha_admin WHERE usuario = :usuario");
        $senhaHash = password_hash($novaSenha, PASSWORD_DEFAULT); // Usa o password_hash
        $sql->bindValue(":senha_admin", $senhaHash); // Armazena a senha criptografada
        $sql->bindValue(":usuario", $usuario);
        return $sql->execute(); // Executa a atualização
    }
}
