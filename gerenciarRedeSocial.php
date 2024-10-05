<?php include 'assets/inc/header.inc.php';
include 'assets/classes/redeSocial.class.php';

$redeSocial = new RedeSocial();
?>

<main class="container mt-5">
    <div class="header-content mb-4">
        <h1>Gerenciar Rede Social</h1>
        <p>Secção dedicada à criação, edição, leitura e exclusão de níveis.</p>
    </div>

    <!-- Tabela de níveis -->
    <div class="table-responsive mb-4">
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <!-- Criando os cabeçalhos da tabela -->
                    <th>ID</th>
                    <th>Credenciais</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <!-- Adicionar mais níveis usando foreach -->
                <?php
                $lista = $redeSocial->listar();
                foreach ($lista as $item):
                    ?>
                    <!-- Exemplo de linha de Nível -->
                    <tr>
                        <td><?php echo $item['id_redesocial'] ?></td>
                        <td><?php echo $item['credenciais_redesocial'] ?></td>
                        <td>
                            <a href="deletarRedeSocial.php?id_redesocial=<?php echo $item['id_redesocial']; ?>"
                                class="btn btn-sm btn-danger"
                                onclick="return confirm('Você tem certeza que deseja excluir <?php echo $item['id_redesocial'] ?>? ')">Excluir</a>
                        </td>
                    </tr>
                    <?php
                endforeach
                ?>
            </tbody>
        </table>