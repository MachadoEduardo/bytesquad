<?php include 'assets/inc/header.inc.php';
include 'assets/classes/tabelaPontuacao.class.php';

$tabelaPontuacao = new TabelaPontuacao();
?>

<main class="container mt-5">
    <div class="header-content mb-4">
        <h1>Gerenciar Tabela de Pontuação</h1>
        <p>Secção dedicada à leitura e exclusão de tabelas de pontuação.</p>
    </div>

    <!-- Tabela de tabelas (chega a ser irônico) -->
    <div class="table-responsive mb-4">
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <!-- Criando os cabeçalhos da tabela (tabela normal tabela) -->
                    <th>ID</th>
                    <th>Usuário</th>
                    <th>Nível</th>
                    <th>Pontuação</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <!-- Adicionar mais tabelas (?) usando foreach -->
                <?php
                $lista = $tabelaPontuacao->listar();
                foreach ($lista as $item):
                    ?>
                    <!-- Exemplo de linha de tabela dentro de tabela (help me) -->
                    <tr>
                        <td><?php echo $item['id_tabelapontuacao'] ?></td>
                        <td><?php echo $item['id_usuario'] ?></td>
                        <td><?php echo $item['id_nivel'] ?></td>
                        <td><?php echo $item['pontuacao_tabela'] ?></td>
                        <td>
                            <a href="deletarTabelaPontuacao.php?id_tabelapontuacao=<?php echo $item['id_tabelapontuacao']; ?>"
                                class="btn btn-sm btn-danger"
                                onclick="return confirm('Você tem certeza que deseja excluir a Tabela <?php echo $item['id_tabelapontuacao'] ?>? ')">Excluir</a>
                        </td>
                    </tr>
                    <?php
                endforeach
                ?>
            </tbody>
        </table>

        <?php include 'assets/inc/footer.inc.php'; ?>

        <!-- Inclua os scripts necessários para o Bootstrap 5.x -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        </body>

        </html>