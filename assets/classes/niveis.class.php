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
                SELECT nivel.*, administrativo.usuario 
                FROM nivel 
                JOIN administrativo ON nivel.id_administrativo = administrativo.id_administrativo
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
                SELECT administrativo.id_administrativo 
                FROM nivel 
                RIGHT JOIN administrativo ON nivel.id_administrativo = administrativo.id_administrativo
            ");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            echo "ERRO: " . $ex->getMessage();
        }
    }
}
