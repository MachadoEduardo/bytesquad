<?php include 'assets/inc/header.inc.php';
include 'assets/classes/niveis.class.php';

$nivel = new Niveis();
?>

<main class="container mt-5">
    <div class="header-content mb-4">
        <h1>Gerenciar Níveis</h1>
        <p>Secção dedicada à criação, edição, leitura e exclusão de níveis.</p>
    </div>

    <!-- Tabela de níveis -->
    <div class="table-responsive mb-4">
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <!-- Criando os cabeçalhos da tabela -->
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Tempo</th>
                    <th>Dificuldade</th>
                    <th>Perguntas</th>
                    <th>Respostas</th>
                    <th>Administrador</th>
                </tr>
            </thead>
            <tbody>
                <!-- Adicionar mais níveis usando foreach -->
                <?php
                $lista = $nivel->listar();
                foreach ($lista as $item):
                    ?>
                    <!-- Exemplo de linha de usuário -->
                    <tr>
                        <td><?php echo $item['id'] ?></td>
                        <td><?php echo $item['nome_nivel'] ?></td>
                        <td><?php echo $item['tempo_nivel'] ?></td>
                        <td><?php echo $item['dificuldade'] ?></td>
                        <td><?php echo $item['questoes'] ?></td>
                        <td><?php echo $item['respostas'] ?></td>
                        <td><?php echo $item['id_administrador'] ?></td>
                        <td>
                            <a href="#" class="btn btn-sm btn-primary">Editar</a>
                            <a href="#" class="btn btn-sm btn-danger">Excluir</a>
                        </td>
                    </tr>
                    <?php
                endforeach
                ?>
            </tbody>
        </table>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Adicionar/Editar Nível</h5>
        </div>
        <div class="card-body">
            <form action="adicionarNivelSubmit.php" method="POST">
                <div class="mb-3">
                    <label for="nome_nivel" class="form-label">Título</label>
                    <input type="text" class="form-control" id="nome_nivel" name="nome_nivel" required>
                </div>
                <div class="mb-3">
                    <label for="tempo_nivel" class="form-label">Tempo</label>
                    <input type="text" class="form-control" id="tempo_nivel" name="tempo_nivel" required>
                </div>
                <div class="mb-3">
                    <label for="dificuldade" class="form-label">Dificuldade</label>
                    <input type="text" class="form-control" id="dificuldade" name="dificuldade" required>
                </div>
                <div class="mb-3">
                    <label for="questoes" class="form-label">Perguntas</label>
                    <input type="text" class="form-control" id="questoes" name="questoes" required>
                </div>
                <div class="mb-3">
                    <label for="respostas" class="form-label">Respostas</label>
                    <input type="text" class="form-control" id="respostas" name="respostas" required>
                </div>

                <?php
                $lista = $nivel->listar();
                foreach ($lista as $item):
                    ?>
                    <div class="form-floating">
                        <select id="select1" class="form-select">
                            <option>lalaland</option>
                            <option>biscuti</option>
                            <!-- <option><?php echo $item['nome_nivel'] ?></option>
                            <option><?php echo $item['id_administrador'] ?></option> -->
                        </select>
                        <label for="select1">Escolbha um</label>
                    </div>
                <?php endforeach; ?>

                <input type="submit" class="btn btn-success" name="btCadastrar" value="Salvar" />
                <button type="reset" class="btn btn-secondary">Limpar</button>
            </form>
        </div>
    </div>
</main>

<?php include 'assets/inc/footer.inc.php'; ?>

<!-- Inclua os scripts necessários para o Bootstrap 5.x -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>