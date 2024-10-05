<?php
require 'conexao.class.php';

class Niveis {
    private $id_nivel;
    private $nome_nivel;
    private $tempo_nivel;
    private $dificuldade;
    private $questoes;
    private $respostas;
    private $id_administrativo;

    private $con;

    public function __construct() {
        $this->con = new Conexao();
    }

    private function existeNivel($nome_nivel) {
        $sql = $this->con->conectar()->prepare("SELECT id_nivel FROM nivel WHERE nome_nivel = :nome_nivel");
        $sql->bindParam(':nome_nivel', $nome_nivel, PDO::PARAM_STR);
        $sql->execute();

        return $sql->rowCount() > 0; // Retorna verdadeiro se o nivel já existir
    }

    public function adicionar($nome_nivel, $tempo_nivel, $dificuldade, $questoes, $respostas, $id_administrativo) {
        if (!$this->existeNivel($nome_nivel)) { // Verifica se o nivel não existe
            try {
                $sql = $this->con->conectar()->prepare(
                    "INSERT INTO nivel (nome_nivel, tempo_nivel, dificuldade, questoes, respostas, id_administrativo) 
                     VALUES (:nome_nivel, :tempo_nivel, :dificuldade, :questoes, :respostas, :id_administrativo)"
                );
    
                $sql->bindParam(':nome_nivel', $nome_nivel, PDO::PARAM_STR);
                $sql->bindParam(':tempo_nivel', $tempo_nivel, PDO::PARAM_INT);
                $sql->bindParam(':dificuldade', $dificuldade, PDO::PARAM_STR);
                $sql->bindParam(':questoes', $questoes, PDO::PARAM_STR);
                $sql->bindParam(':respostas', $respostas, PDO::PARAM_STR);
                $sql->bindParam(':id_administrativo', $id_administrativo, PDO::PARAM_INT); // Adiciona o id_administrativo enviado pelo form
    
                $sql->execute(); // Executa a consulta
                return true; // Retorna verdadeiro se a inserção for bem-sucedida
            } catch (PDOException $ex) {
                return 'ERRO: ' . $ex->getMessage();
            }
        } else {
            return false; // Retorna falso se o nivel já existir
        }
    }

    public function listar() {
        try {
            $sql = $this->con->conectar()->prepare("
                SELECT nivel.*
                FROM nivel 
                
            ");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            echo "ERRO: " . $ex->getMessage();
        }
    }

    public function listarAdministrador() {
        try {
            $sql = $this->con->conectar()->prepare("
                SELECT administrativo.id_administrativo, administrativo.usuario
FROM administrativo
LEFT JOIN nivel ON nivel.id_administrativo = administrativo.id_administrativo
GROUP BY administrativo.id_administrativo, administrativo.usuario;
            ");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            echo "ERRO: " . $ex->getMessage();
        }
    }

    public function deletar() {
        if (isset($_GET['id_nivel'])) {
            $id_nivel = intval($_GET['id_nivel']);
            
            try {
                $sql = $this->con->conectar()->prepare("DELETE FROM nivel WHERE id_nivel = :id_nivel");
                $sql->bindParam(':id_nivel', $id_nivel, PDO::PARAM_INT);
                $sql->execute();
        
                header('Location: gerenciarNivel.php');
            } catch (PDOException $ex) {
                echo 'ERRO: ' . $ex->getMessage();
            }
        }
    } 
    
    public function buscarNivel($id_nivel) {
        try {
            $sql = $this->con->conectar()->prepare("SELECT * FROM nivel WHERE id_nivel = :id_nivel");
            $sql->bindParam(':id_nivel', $id_nivel, PDO::PARAM_INT);
            $sql->execute();
            return $sql->fetch(PDO::FETCH_ASSOC); // Retorna os dados do usuário como array associativo
        } catch (PDOException $ex) {
            echo "ERRO: " . $ex->getMessage();
        }
    }

    public function editar($id_nivel, $nome_nivel, $tempo_nivel, $dificuldade, $questoes, $respostas, $id_administrativo) {
        try {
            $sql = $this->con->conectar()->prepare(
                "UPDATE nivel SET nome_nivel = :nome_nivel, tempo_nivel = :tempo_nivel, dificuldade = :dificuldade,  questoes = :questoes, respostas = :respostas, id_administrativo = :id_administrativo
                WHERE id_nivel = :id_nivel"
            );
            $sql->bindParam(':id_nivel', $id_nivel, PDO::PARAM_INT);
            $sql->bindParam(':nome_nivel', $nome_nivel, PDO::PARAM_STR);
            $sql->bindParam(':tempo_nivel', $tempo_nivel, PDO::PARAM_INT);
            $sql->bindParam(':dificuldade', $dificuldade, PDO::PARAM_STR);
            $sql->bindParam(':questoes', $questoes, PDO::PARAM_STR);
            $sql->bindParam(':respostas', $respostas, PDO::PARAM_STR);
            $sql->bindParam(':id_administrativo', $id_administrativo, PDO::PARAM_INT);
    
            $sql->execute();
            header('Location: gerenciarNivel.php');
        } catch (PDOException $ex) {
            echo 'ERRO: ' . $ex->getMessage();
        }
    }
}
