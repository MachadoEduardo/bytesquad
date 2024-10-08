<?php
require 'conexao.class.php';

class RedeSocial {
    private $id_redesocial;
    private $credenciais_redesocial;    

    private $con;

    public function __construct() {
        $this->con = new Conexao();
    }

    public function listar() {
        try {
            $sql = $this->con->conectar()->prepare("
                SELECT redesocial.*
                FROM redesocial 
                
            ");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            echo "ERRO: " . $ex->getMessage();
        }
    }

    public function deletar() {
        if (isset($_GET['id_redesocial'])) {
            $id_redesocial = intval($_GET['id_redesocial']);
            
            try {
                $sql = $this->con->conectar()->prepare("DELETE FROM redesocial WHERE id_redesocial = :id_redesocial");
                $sql->bindParam(':id_redesocial', $id_redesocial, PDO::PARAM_INT);
                $sql->execute();
        
                header('Location: gerenciarRedeSocial.php');
            } catch (PDOException $ex) {
                echo 'ERRO: ' . $ex->getMessage();
            }
        }
    } 
}