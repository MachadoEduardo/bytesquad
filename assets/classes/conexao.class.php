<?php

class Conexao{
    private $servidor;
    private $senha;
    private $usuario;
    private $banco;

    private static $pdo;

    public function __construct(){
        // Atribui os valores para conectar com o seu servidor
        $this->servidor = "localhost";
        $this->banco = "bytesquad";
        $this->senha = "";
        $this->usuario = "root";
    }
    public function conectar(){
        try{
            // Faz a conexão
            if(is_null(self::$pdo)){
                self::$pdo = new PDO("mysql:host=".$this->servidor."; dbname=".$this->banco, $this->usuario, $this->senha);
            }
            return self::$pdo;
        } catch(PDOException $ex){
            echo $ex->getMessage();
        }
    }
}