<?php
require_once 'conexao.class.php';

class Respostas
{
    private $id_resposta;
    private $id_pergunta;
    private $texto_resposta;
    private $correta;
    private $ordem;

    private $con;

    public function __construct()
    {
        $this->con = new Conexao();
    }

    private function existeResposta($texto_resposta, $id_pergunta)
    {
        $sql = $this->con->conectar()->prepare("SELECT id_resposta FROM resposta WHERE texto_resposta = :texto_resposta AND id_pergunta = :id_pergunta");
        $sql->bindParam(':texto_resposta', $texto_resposta, PDO::PARAM_STR);
        $sql->bindParam(':id_pergunta', $id_pergunta, PDO::PARAM_INT);
        $sql->execute();

        return $sql->rowCount() > 0;
    }

    public function adicionar($id_pergunta, $texto_resposta, $correta = 0, $ordem = 1)
    {
        if (!$this->existeResposta($texto_resposta, $id_pergunta)) {
            try {
                $sql = $this->con->conectar()->prepare(
                    "INSERT INTO resposta (id_pergunta, texto_resposta, correta, ordem)
                     VALUES (:id_pergunta, :texto_resposta, :correta, :ordem)"
                );
                $sql->bindParam(':id_pergunta', $id_pergunta, PDO::PARAM_INT);
                $sql->bindParam(':texto_resposta', $texto_resposta, PDO::PARAM_STR);
                $sql->bindParam(':correta', $correta, PDO::PARAM_INT);
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

    public function listar($id_pergunta = null)
    {
        try {
            if ($id_pergunta) {
                $sql = $this->con->conectar()->prepare("SELECT * FROM resposta WHERE id_pergunta = :id_pergunta ORDER BY ordem ASC");
                $sql->bindParam(':id_pergunta', $id_pergunta, PDO::PARAM_INT);
            } else {
                $sql = $this->con->conectar()->prepare("SELECT * FROM resposta ORDER BY id_pergunta, ordem ASC");
            }
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            echo "ERRO: " . $ex->getMessage();
        }
    }

    public function buscarResposta($id_resposta)
    {
        try {
            $sql = $this->con->conectar()->prepare("SELECT * FROM resposta WHERE id_resposta = :id_resposta");
            $sql->bindParam(':id_resposta', $id_resposta, PDO::PARAM_INT);
            $sql->execute();
            return $sql->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            error_log("ERRO: " . $ex->getMessage());
            return false;
        }
    }

    public function editar($id_resposta, $id_pergunta, $texto_resposta, $correta, $ordem)
    {
        try {
            $sql = $this->con->conectar()->prepare(
                "UPDATE resposta SET id_pergunta = :id_pergunta, texto_resposta = :texto_resposta, correta = :correta, ordem = :ordem
                 WHERE id_resposta = :id_resposta"
            );
            $sql->bindParam(':id_resposta', $id_resposta, PDO::PARAM_INT);
            $sql->bindParam(':id_pergunta', $id_pergunta, PDO::PARAM_INT);
            $sql->bindParam(':texto_resposta', $texto_resposta, PDO::PARAM_STR);
            $sql->bindParam(':correta', $correta, PDO::PARAM_INT);
            $sql->bindParam(':ordem', $ordem, PDO::PARAM_INT);

            $sql->execute();
            return true;
        } catch (PDOException $ex) {
            echo 'ERRO: ' . $ex->getMessage();
            return false;
        }
    }

    public function deletar($id_resposta)
    {
        try {
            $sql = $this->con->conectar()->prepare("DELETE FROM resposta WHERE id_resposta = :id_resposta");
            $sql->bindParam(':id_resposta', $id_resposta, PDO::PARAM_INT);
            $sql->execute();
            return true;
        } catch (PDOException $ex) {
            echo 'ERRO: ' . $ex->getMessage();
            return false;
        }
    }
}