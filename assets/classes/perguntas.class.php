<?php
require_once 'conexao.class.php';

class Perguntas
{
    private $id_pergunta;
    private $id_nivel;
    private $texto_pergunta;
    private $tipo_pergunta;
    private $ordem;

    private $con;

    public function __construct()
    {
        $this->con = new Conexao();
    }

    private function existePergunta($texto_pergunta, $id_nivel)
    {
        $sql = $this->con->conectar()->prepare("SELECT id_pergunta FROM pergunta WHERE texto_pergunta = :texto_pergunta AND id_nivel = :id_nivel");
        $sql->bindParam(':texto_pergunta', $texto_pergunta, PDO::PARAM_STR);
        $sql->bindParam(':id_nivel', $id_nivel, PDO::PARAM_INT);
        $sql->execute();

        return $sql->rowCount() > 0;
    }

    public function adicionar($id_nivel, $texto_pergunta, $tipo_pergunta = 'multipla_escolha', $ordem = 1)
    {
        if (!$this->existePergunta($texto_pergunta, $id_nivel)) {
            try {
                $sql = $this->con->conectar()->prepare(
                    "INSERT INTO pergunta (id_nivel, texto_pergunta, tipo_pergunta, ordem)
                     VALUES (:id_nivel, :texto_pergunta, :tipo_pergunta, :ordem)"
                );
                $sql->bindParam(':id_nivel', $id_nivel, PDO::PARAM_INT);
                $sql->bindParam(':texto_pergunta', $texto_pergunta, PDO::PARAM_STR);
                $sql->bindParam(':tipo_pergunta', $tipo_pergunta, PDO::PARAM_STR);
                $sql->bindParam(':ordem', $ordem, PDO::PARAM_INT);

                $sql->execute();
                return true;
            } catch (PDOException $ex) {
                return 'ERRO: ' . $ex->getMessage();
            }
        } else {
            return false;
        }
    }

    public function listar($id_nivel = null)
    {
        try {
            if ($id_nivel) {
                $sql = $this->con->conectar()->prepare("SELECT * FROM pergunta WHERE id_nivel = :id_nivel ORDER BY ordem ASC");
                $sql->bindParam(':id_nivel', $id_nivel, PDO::PARAM_INT);
            } else {
                $sql = $this->con->conectar()->prepare("SELECT * FROM pergunta ORDER BY id_nivel, ordem ASC");
            }
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            echo "ERRO: " . $ex->getMessage();
        }
    }

    public function buscarPergunta($id_pergunta)
    {
        try {
            $sql = $this->con->conectar()->prepare("SELECT * FROM pergunta WHERE id_pergunta = :id_pergunta");
            $sql->bindParam(':id_pergunta', $id_pergunta, PDO::PARAM_INT);
            $sql->execute();
            return $sql->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            error_log("ERRO: " . $ex->getMessage());
            return false;
        }
    }

    public function editar($id_pergunta, $id_nivel, $texto_pergunta, $tipo_pergunta, $ordem)
    {
        try {
            $sql = $this->con->conectar()->prepare(
                "UPDATE pergunta SET id_nivel = :id_nivel, texto_pergunta = :texto_pergunta, tipo_pergunta = :tipo_pergunta, ordem = :ordem
                 WHERE id_pergunta = :id_pergunta"
            );
            $sql->bindParam(':id_pergunta', $id_pergunta, PDO::PARAM_INT);
            $sql->bindParam(':id_nivel', $id_nivel, PDO::PARAM_INT);
            $sql->bindParam(':texto_pergunta', $texto_pergunta, PDO::PARAM_STR);
            $sql->bindParam(':tipo_pergunta', $tipo_pergunta, PDO::PARAM_STR);
            $sql->bindParam(':ordem', $ordem, PDO::PARAM_INT);

            $sql->execute();
            return true;
        } catch (PDOException $ex) {
            echo 'ERRO: ' . $ex->getMessage();
            return false;
        }
    }

    public function deletar($id_pergunta)
    {
        try {
            $sql = $this->con->conectar()->prepare("DELETE FROM pergunta WHERE id_pergunta = :id_pergunta");
            $sql->bindParam(':id_pergunta', $id_pergunta, PDO::PARAM_INT);
            $sql->execute();
            return true;
        } catch (PDOException $ex) {
            echo 'ERRO: ' . $ex->getMessage();
            return false;
        }
    }

    public function adicionarRetornandoId($id_nivel, $texto_pergunta, $tipo_pergunta = 'multipla_escolha', $ordem = 1)
    {
        if (!$this->existePergunta($texto_pergunta, $id_nivel)) {
            try {
                $sql = $this->con->conectar()->prepare(
                    "INSERT INTO pergunta (id_nivel, texto_pergunta, tipo_pergunta, ordem)
                 VALUES (:id_nivel, :texto_pergunta, :tipo_pergunta, :ordem)"
                );
                $sql->bindParam(':id_nivel', $id_nivel, PDO::PARAM_INT);
                $sql->bindParam(':texto_pergunta', $texto_pergunta, PDO::PARAM_STR);
                $sql->bindParam(':tipo_pergunta', $tipo_pergunta, PDO::PARAM_STR);
                $sql->bindParam(':ordem', $ordem, PDO::PARAM_INT);
                $sql->execute();
                return $this->con->conectar()->lastInsertId();
            } catch (PDOException $ex) {
                return false;
            }
        } else {
            return false;
        }
    }
}
