<?php
require 'conexao.class.php';

class Energia
{
    private $id_energia;
    private $id;
    private $quantidade_energia;
    private $tempo_energia;
    private $preco_energia;
    private $pacote_energia;

    private $con;

    public function __construct()
    {
        $this->con = new Conexao();
    }

    public function listar()
    {
        try {
            $sql = $this->con->conectar()->prepare("
                SELECT energia.*
                FROM energia 
                
            ");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            echo "ERRO: " . $ex->getMessage();
        }
    }

    public function listarUsuario()
    {
        try {
            $sql = $this->con->conectar()->prepare("
                SELECT usuario.id, usuario.nome_usuario
                FROM energia 
                RIGHT JOIN usuario ON energia.id = usuario.id
                GROUP BY usuario.id, usuario.nome_usuario;
                
            ");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            echo "ERRO: " . $ex->getMessage();
        }
    }

    private function existePacote($pacote_energia)
    {
        $sql = $this->con->conectar()->prepare("SELECT id_energia FROM energia WHERE pacote_energia = :pacote_energia");
        $sql->bindParam(':pacote_energia', $pacote_energia, PDO::PARAM_STR);
        $sql->execute();

        return $sql->rowCount() > 0; // Retorna verdadeiro se o pacote já existir
    }

    public function adicionar($id, $quantidade_energia, $tempo_energia, $preco_energia, $pacote_energia)
    {
        if (!$this->existePacote($pacote_energia)) { // Verifica se o pacote não existe
            try {
                $sql = $this->con->conectar()->prepare(
                    "INSERT INTO energia (id, quantidade_energia, tempo_energia, preco_energia, pacote_energia) 
                     VALUES (:id, :quantidade_energia, :tempo_energia, :preco_energia, :pacote_energia )"
                );

                $sql->bindValue(':id', $id);    // Adiciona o id_usuario enviado pelo form
                $sql->bindValue(':quantidade_energia', $quantidade_energia);
                $sql->bindValue(':tempo_energia', $tempo_energia);
                $sql->bindValue(':preco_energia', $preco_energia);
                $sql->bindValue(':pacote_energia', $pacote_energia);


                $sql->execute(); // Executa a consulta
                return true; // Retorna verdadeiro se a inserção for bem-sucedida
            } catch (PDOException $ex) {
                return 'ERRO: ' . $ex->getMessage();
            }
        } else {
            return false; // Retorna falso se o pacote já existir
        }
    }

    public function deletar()
    {
        if (isset($_GET['id_energia'])) {
            $id_energia = intval($_GET['id_energia']);

            try {
                $sql = $this->con->conectar()->prepare("DELETE FROM energia WHERE id_energia = :id_energia");
                $sql->bindParam(':id_energia', $id_energia, PDO::PARAM_INT);
                $sql->execute();

                header('Location: gerenciarEnergia.php');
            } catch (PDOException $ex) {
                echo 'ERRO: ' . $ex->getMessage();
            }
        }
    }

    public function buscarPacote($id_energia)
    {
        try {
            $sql = $this->con->conectar()->prepare("SELECT * FROM energia WHERE id_energia = :id_energia");
            $sql->bindParam(':id_energia', $id_energia, PDO::PARAM_INT);
            $sql->execute();
            return $sql->fetch(PDO::FETCH_ASSOC); // Retorna os dados do usuário como array associativo
        } catch (PDOException $ex) {
            echo "ERRO: " . $ex->getMessage();
        }
    }

    public function editar($id_energia, $id, $quantidade_energia, $tempo_energia, $preco_energia, $pacote_energia)
    {
        try {
            $sql = $this->con->conectar()->prepare(
                "UPDATE energia SET id = :id, quantidade_energia = :quantidade_energia, tempo_energia = :tempo_energia,  preco_energia = :preco_energia, pacote_energia = :pacote_energia
                WHERE id_energia = :id_energia"
            );
            $sql->bindValue(':id_energia', $id_energia);
            $sql->bindValue(':id', $id);
            $sql->bindValue(':quantidade_energia', $quantidade_energia);
            $sql->bindValue(':tempo_energia', $tempo_energia);
            $sql->bindValue(':preco_energia', $preco_energia);
            $sql->bindValue(':pacote_energia', $pacote_energia);

            $sql->execute();
            header('Location: gerenciarEnergia.php');
        } catch (PDOException $ex) {
            echo 'ERRO: ' . $ex->getMessage();
        }
    }
}