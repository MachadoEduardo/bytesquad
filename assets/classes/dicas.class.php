<?php
require 'conexao.class.php';

class Dicas {
    private $id_dicas;
    private $pacote_dicas;    
    private $preco_dicas;    
    private $quantidade_dicas;    
    private $id ;    

    private $con;

    public function __construct() {
        $this->con = new Conexao();
    }

    public function listar() {
        try {
            $sql = $this->con->conectar()->prepare("
                SELECT dicas.*
                FROM dicas 
                
            ");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            echo "ERRO: " . $ex->getMessage();
        }
    }

    // Listar para poder fazer a interligação da tabela usuário com a tabela dicas, assim dá para trazer o ID dos usuários quando for criar um novo registro na tabela
    // Usei GROUP BY pra no modal trazer em ordem e ficar bonitinho de maloca fashion week fala pra eles kyan (utilizei tambem na classe de Niveis)
    public function listarUsuario() {
        try {
            $sql = $this->con->conectar()->prepare("
                SELECT usuario.id, usuario.nome_usuario
                FROM dicas 
                RIGHT JOIN usuario ON dicas.id = usuario.id
                GROUP BY usuario.id, usuario.nome_usuario;
                
            ");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            echo "ERRO: " . $ex->getMessage();
        }
    }

    public function deletar() {
        if (isset($_GET['id_dicas'])) {
            $id_dicas = intval($_GET['id_dicas']);
            
            try {
                $sql = $this->con->conectar()->prepare("DELETE FROM dicas WHERE id_dicas = :id_dicas");
                $sql->bindParam(':id_dicas', $id_dicas, PDO::PARAM_INT);
                $sql->execute();
        
                header('Location: gerenciarDicas.php');
            } catch (PDOException $ex) {
                echo 'ERRO: ' . $ex->getMessage();
            }
        }
    } 

    private function existePacote($pacote_dicas) {
        $sql = $this->con->conectar()->prepare("SELECT id_dicas FROM dicas WHERE pacote_dicas = :pacote_dicas");
        $sql->bindParam(':pacote_dicas', $pacote_dicas, PDO::PARAM_STR);
        $sql->execute();

        return $sql->rowCount() > 0; // Retorna verdadeiro se o nivel já existir
    }

    public function adicionar($pacote_dicas, $preco_dicas, $quantidade_dicas, $id) {
        if (!$this->existePacote($pacote_dicas)) { // Verifica se o nivel não existe
            try {
                $sql = $this->con->conectar()->prepare(
                    "INSERT INTO dicas (pacote_dicas, preco_dicas, quantidade_dicas, id) 
                     VALUES (:pacote_dicas, :preco_dicas, :quantidade_dicas, :id )"
                );
    
                $sql->bindValue(':pacote_dicas', $pacote_dicas);
                $sql->bindValue(':preco_dicas', $preco_dicas);
                $sql->bindValue(':quantidade_dicas', $quantidade_dicas);
                $sql->bindValue(':id', $id); // Adiciona o id_usuario enviado pelo form
    
                $sql->execute(); // Executa a consulta
                return true; // Retorna verdadeiro se a inserção for bem-sucedida
            } catch (PDOException $ex) {
                return 'ERRO: ' . $ex->getMessage();
            }
        } else {
            return false; // Retorna falso se o nivel já existir
        }
    }

    public function buscarPacote($id_dicas)
    {
        try {
            $sql = $this->con->conectar()->prepare("SELECT * FROM dicas WHERE id_dicas = :id_dicas");
            $sql->bindParam(':id_dicas', $id_dicas, PDO::PARAM_INT);
            $sql->execute();
            return $sql->fetch(PDO::FETCH_ASSOC); // Retorna os dados do usuário como array associativo
        } catch (PDOException $ex) {
            echo "ERRO: " . $ex->getMessage();
        }
    }

    public function editar($id_dicas, $pacote_dicas, $preco_dicas, $quantidade_dicas, $id)
    {
        try {
            $sql = $this->con->conectar()->prepare(
                "UPDATE dicas SET pacote_dicas = :pacote_dicas, preco_dicas = :preco_dicas, quantidade_dicas = :quantidade_dicas,  id = :id
                WHERE id_dicas = :id_dicas"
            );
            $sql->bindValue(':id_dicas', $id_dicas);
            $sql->bindValue(':pacote_dicas', $pacote_dicas);
            $sql->bindValue(':preco_dicas', $preco_dicas);
            $sql->bindValue(':quantidade_dicas', $quantidade_dicas);
            $sql->bindValue(':id', $id);

            $sql->execute();
            header('Location: gerenciarDicas.php');
        } catch (PDOException $ex) {
            echo 'ERRO: ' . $ex->getMessage();
        }
    }
}