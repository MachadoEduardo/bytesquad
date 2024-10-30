<?php
require_once 'conexao.class.php';

class Compras
{
    private $id_compra;
    private $formapagamento;
    private $preco_compra;
    private $historico_compra;
    private $id;

    private $con;

    public function __construct()
    {
        $this->con = new Conexao();
    }

    public function listar()
    {
        try {
            $sql = $this->con->conectar()->prepare("
                SELECT compra.*
                FROM compra 
                
            ");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            echo "ERRO: " . $ex->getMessage();
        }
    }

    public function listarUsuario()
    {
        try {
            $sql = $this->con->conectar()->prepare("
                SELECT usuario.id, usuario.nome_usuario
                FROM compra 
                RIGHT JOIN usuario ON compra.id = usuario.id
                GROUP BY usuario.id, usuario.nome_usuario;
                
            ");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            echo "ERRO: " . $ex->getMessage();
        }
    }

    public function adicionar($formapagamento, $preco_compra, $historico_compra, $id)
    {
            try {
                $sql = $this->con->conectar()->prepare(
                    "INSERT INTO compra (formapagamento, preco_compra, historico_compra, id) 
                     VALUES (:formapagamento, :preco_compra, :historico_compra, :id)"
                );

                $sql->bindValue(':formapagamento', $formapagamento);    // Adiciona o id_usuario enviado pelo form
                $sql->bindValue(':preco_compra', $preco_compra);
                $sql->bindValue(':historico_compra', $historico_compra);
                $sql->bindValue(':id', $id);


                $sql->execute(); // Executa a consulta
                return true; // Retorna verdadeiro se a inserção for bem-sucedida
            } catch (PDOException $ex) {
                return 'ERRO: ' . $ex->getMessage();
            }
    }

    public function deletar()
    {
        if (isset($_GET['id_compra'])) {
            $id_compra = intval($_GET['id_compra']);

            try {
                $sql = $this->con->conectar()->prepare("DELETE FROM compra WHERE id_compra = :id_compra");
                $sql->bindParam(':id_compra', $id_compra, PDO::PARAM_INT);
                $sql->execute();

                header('Location: gerenciarCompra.php');
            } catch (PDOException $ex) {
                echo 'ERRO: ' . $ex->getMessage();
            }
        }
    }

    public function buscarCompra($id_compra)
    {
        try {
            $sql = $this->con->conectar()->prepare("SELECT * FROM compra WHERE id_compra = :id_compra");
            $sql->bindParam(':id_compra', $id_compra, PDO::PARAM_INT);
            $sql->execute();
            return $sql->fetch(PDO::FETCH_ASSOC); // Retorna os dados do usuário como array associativo
        } catch (PDOException $ex) {
            echo "ERRO: " . $ex->getMessage();
        }
    }

    public function editar($id_compra, $formapagamento, $preco_compra, $historico_compra, $id)
    {
        try {
            $sql = $this->con->conectar()->prepare(
                "UPDATE compra SET formapagamento = :formapagamento, preco_compra = :preco_compra, historico_compra = :historico_compra,  id = :id
                WHERE id_compra = :id_compra"
            );
            $sql->bindValue(':id_compra', $id_compra);
            $sql->bindValue(':formapagamento', $formapagamento);
            $sql->bindValue(':preco_compra', $preco_compra);
            $sql->bindValue(':historico_compra', $historico_compra);
            $sql->bindValue(':id', $id);

            $sql->execute();
            header('Location: gerenciarCompra.php');
        } catch (PDOException $ex) {
            echo 'ERRO: ' . $ex->getMessage();
        }
    }
}