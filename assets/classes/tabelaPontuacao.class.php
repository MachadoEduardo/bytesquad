<?php
require_once 'conexao.class.php';

class TabelaPontuacao {
    private $id_tabelapontuacao;
    private $id_usuario;    
    private $id_nivel;    
    private $pontuacao_tabela;    

    private $con;

    public function __construct() {
        $this->con = new Conexao();
    }

    public function listar() {
        try {
            $sql = $this->con->conectar()->prepare("
                SELECT tabelapontuacao.*
                FROM tabelapontuacao 
                
            ");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            echo "ERRO: " . $ex->getMessage();
        }
    }

    public function deletar() {
        if (isset($_GET['id_tabelapontuacao'])) {
            $id_tabelapontuacao = intval($_GET['id_tabelapontuacao']);
            
            try {
                $sql = $this->con->conectar()->prepare("DELETE FROM tabelapontuacao WHERE id_tabelapontuacao = :id_tabelapontuacao");
                $sql->bindParam(':id_tabelapontuacao', $id_tabelapontuacao, PDO::PARAM_INT);
                $sql->execute();
        
                header('Location: gerenciarTabelaPontuacao.php');
            } catch (PDOException $ex) {
                echo 'ERRO: ' . $ex->getMessage();
            }
        }
    }
}   

