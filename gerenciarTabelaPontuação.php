<?php include 'assets/inc/header.inc.php';
include 'assets/classes/tabelaPontuacao.class.php';
$tabela = new TabelaPontuacao();
?>

<main class="container mt-5">
    <div class="header-content mb-4">
        <h1>Gerenciar Usuários</h1>
        <p>Seção dedicada à criação, edição, leitura e exclusão de usuários.</p>
    </div>

    <!-- Tabela de Usuários -->
    <div class="table-responsive mb-4">
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <!-- Criando os cabeçalhos da tabela -->
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Nível</th>
                    <th>Pontuação</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <!-- Adicionar mais usuários usando foreach -->
                <?php
                $lista = $tabela->listar();
                foreach ($lista as $item):
                    ?>
                    <!-- Exemplo de linha de usuário -->
                    <tr>
                        <td><?php echo $item['id_tabelapontuacao'] ?></td>
                        <td><?php echo $item['nome_usuario'] ?></td>
                        <td><?php echo $item['nome_nivel'] ?></td>
                        <td><?php echo $item['pontuacao_tabela'] ?></td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#editarModal<?php echo $item['id_tabelapontuacao']; ?>">
                                Editar Tabela
                            </button>
                            <a href="deletarTabela.php?id_tabelapontuacao=<?php echo $item['id_tabelapontuacao']; ?>"
                                class="btn btn-sm btn-danger" onclick="return confirm('Você tem certeza que deseja excluir a pomtuação do <?php echo $item['nome_usuario']?>? ')">Excluir</a>
                        </td>
                    </tr>
                    <?php
                endforeach
                ?>
            </tbody>
        </table>