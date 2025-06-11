<?php
session_start();
include 'assets/inc/header.inc.php';
include 'assets/classes/perguntas.class.php';
include 'assets/classes/niveis.class.php';
$pergunta = new Perguntas();
$nivel = new Niveis();
require_once './assets/classes/administrador.class.php';
$admin = new Administrador();

if (!isset($_SESSION['Logado'])) {
    header("Location: login.php");
    exit;
}
?>
<main class="container mt-5">
    <div class="header-content mb-4">
        <h1>Gerenciar Perguntas</h1>
        <p>Secção dedicada à criação, edição, leitura e exclusão de perguntas.</p>
    </div>

    <!-- Tabela de perguntas -->
    <div class="table-responsive mb-4">
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Nível</th>
                    <th>Pergunta</th>
                    <th>Tipo</th>
                    <th>Ordem</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $lista = $pergunta->listar();
                foreach ($lista as $item):
                    $nivelInfo = $nivel->buscarNivel($item['id_nivel']);
                ?>
                    <tr>
                        <td><?php echo $item['id_pergunta']; ?></td>
                        <td><?php echo $nivelInfo ? $nivelInfo['nome_nivel'] : 'Nível não encontrado'; ?></td>
                        <td><?php echo $item['texto_pergunta']; ?></td>
                        <td><?php echo $item['tipo_pergunta']; ?></td>
                        <td><?php echo $item['ordem']; ?></td>
                        <td>
                            <?php if ($admin->temPermissoes('EDIT')): ?>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#editarModal<?php echo $item['id_pergunta']; ?>">
                                    Editar
                                </button>
                            <?php endif; ?>
                            <?php if ($admin->temPermissoes('DELETE')): ?>
                                <a href="deletarPergunta.php?id_pergunta=<?php echo $item['id_pergunta']; ?>"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Você tem certeza que deseja excluir esta pergunta?')">Excluir</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>

        <!-- Modais de edição -->
        <?php foreach ($lista as $item): ?>
            <div class="modal fade" id="editarModal<?php echo $item['id_pergunta']; ?>" tabindex="-1" role="dialog"
                aria-labelledby="editarModalLabel<?php echo $item['id_pergunta']; ?>" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editarModalLabel<?php echo $item['id_pergunta']; ?>">Editar Pergunta</h5>
                        </div>
                        <div class="modal-body">
                            <div class="card-body">
                                <form action="editarPerguntaSubmit.php" method="POST">
                                    <input type="hidden" name="id_pergunta" value="<?php echo $item['id_pergunta']; ?>">
                                    <div class="mb-3">
                                        <label for="id_nivel<?php echo $item['id_pergunta']; ?>" class="form-label">Nível</label>
                                        <select name="id_nivel" id="id_nivel<?php echo $item['id_pergunta']; ?>" class="form-control" required>
                                            <?php
                                            $niveis = $nivel->listar();
                                            foreach ($niveis as $n):
                                                $selected = ($n['id_nivel'] == $item['id_nivel']) ? 'selected' : '';
                                            ?>
                                                <option value="<?php echo $n['id_nivel']; ?>" <?php echo $selected; ?>>
                                                    <?php echo $n['nome_nivel']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="texto_pergunta<?php echo $item['id_pergunta']; ?>" class="form-label">Pergunta</label>
                                        <input type="text" class="form-control"
                                            id="texto_pergunta<?php echo $item['id_pergunta']; ?>" name="texto_pergunta"
                                            value="<?php echo $item['texto_pergunta']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tipo_pergunta<?php echo $item['id_pergunta']; ?>" class="form-label">Tipo</label>
                                        <input type="text" class="form-control"
                                            id="tipo_pergunta<?php echo $item['id_pergunta']; ?>" name="tipo_pergunta"
                                            value="<?php echo $item['tipo_pergunta']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="ordem<?php echo $item['id_pergunta']; ?>" class="form-label">Ordem</label>
                                        <input type="number" class="form-control"
                                            id="ordem<?php echo $item['id_pergunta']; ?>" name="ordem"
                                            value="<?php echo $item['ordem']; ?>" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Salvar alterações</button>
                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if ($admin->temPermissoes('ADD')): ?>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#adicionarPerguntaModal">
            Adicionar Pergunta
        </button>
    <?php endif; ?>

    <!-- Modal para adicionar pergunta -->
    <div class="modal fade" id="adicionarPerguntaModal" tabindex="-1" role="dialog" aria-labelledby="adicionarPerguntaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="adicionarPerguntaModalLabel">Adicionar Pergunta</h5>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Adicionar Pergunta</h5>
                        </div>
                        <div class="card-body">
                            <form action="adicionarPerguntaSubmit.php" method="POST">
                                <div class="mb-3">
                                    <label for="id_nivel" class="form-label">Nível</label>
                                    <select name="id_nivel" id="id_nivel" class="form-control" required>
                                        <?php
                                        $niveis = $nivel->listar();
                                        foreach ($niveis as $n):
                                        ?>
                                            <option value="<?php echo $n['id_nivel']; ?>">
                                                <?php echo $n['nome_nivel']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="texto_pergunta" class="form-label">Pergunta</label>
                                    <input type="text" class="form-control" id="texto_pergunta" name="texto_pergunta" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tipo_pergunta" class="form-label">Tipo</label>
                                    <input type="text" class="form-control" id="tipo_pergunta" name="tipo_pergunta" required>
                                </div>
                                <div class="mb-3">
                                    <label for="ordem" class="form-label">Ordem</label>
                                    <input type="number" class="form-control" id="ordem" name="ordem" required>
                                </div>
                                <input type="submit" class="btn btn-success my-2" value="Salvar" />
                                <button type="reset" class="btn btn-secondary">Limpar</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'assets/inc/footer.inc.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>