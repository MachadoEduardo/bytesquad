<?php
require 'conexao.class.php';

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
}   
?>

