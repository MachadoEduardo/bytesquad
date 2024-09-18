<?php
require 'conexao.class.php';

class Niveis {
    private $id;
    private $nome_nivel;
    private $tempo_nivel;
    private $dificuldade;
    private $questoes;
    private $respostas;

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

    public function adicionar($nome_nivel, $tempo_nivel, $dificuldade, $questoes, $respostas) {
        if (!$this->existeNivel($nome_nivel)) { // Verifica se o nivel não existe
            try {
                $sql = $this->con->conectar()->prepare(
                    "INSERT INTO nivel (nome_nivel, tempo_nivel, dificuldade, perguntas, respostas) 
                     VALUES (:nome, :tempo, :dificuldade, :perguntas, :respostas)"
                );

                $sql->bindParam(':nome', $nome_nivel, PDO::PARAM_STR);
                $sql->bindParam(':tempo', $tempo_nivel, PDO::PARAM_INT);
                $sql->bindParam(':dificuldade', $dificuldade, PDO::PARAM_STR);
                $sql->bindParam(':perguntas', $questoes, PDO::PARAM_STR);
                $sql->bindParam(':respostas', $respostas, PDO::PARAM_STR);

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
            $sql = $this->con->conectar()->prepare("SELECT * FROM nivel");
            $sql->execute();
            return $sql->fetchAll();
        } catch (PDOException $ex) {
            echo "ERRO: " . $ex->getMessage();
        }
    }
}
