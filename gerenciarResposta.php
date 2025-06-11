<?php
session_start();
include 'assets/inc/header.inc.php';
include 'assets/classes/respostas.class.php';
include 'assets/classes/perguntas.class.php';
$resposta = new Respostas();
$pergunta = new Perguntas();
require_once './assets/classes/administrador.class.php';
$admin = new Administrador();

if (!isset($_SESSION['Logado'])) {
    header("Location: login.php");
    exit;
}
?>
<main class="container mt-5">
    <div class="header-content mb-4">
        <h1>Gerenciar Respostas</h1>
        <p>Secção dedicada à criação, edição, leitura e exclusão de respostas.</p>
    </div>

    <!-- Tabela de respostas -->
    <div class="table-responsive mb-4">
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Pergunta</th>
                    <th>Resposta</th>
                    <th>Correta</th>
                    <th>Ordem</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $lista = $resposta->listar();
                foreach ($lista as $item):
                    $perguntaInfo = $pergunta->buscarPergunta($item['id_pergunta']);
                ?>
                    <tr>
                        <td><?php echo $item['id_resposta']; ?></td>
                        <td><?php echo $perguntaInfo ? $perguntaInfo['texto_pergunta'] : 'Pergunta não encontrada'; ?></td>
                        <td><?php echo $item['texto_resposta']; ?></td>
                        <td><?php echo $item['correta'] ? 'Sim' : 'Não'; ?></td>
                        <td><?php echo $item['ordem']; ?></td>
                        <td>
                            <?php if ($admin->temPermissoes('EDIT')): ?>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#editarModal<?php echo $item['id_resposta']; ?>">
                                    Editar
                                </button>
                            <?php endif; ?>
                            <?php if ($admin->temPermissoes('DELETE')): ?>
                                <a href="deletarResposta.php?id_resposta=<?php echo $item['id_resposta']; ?>"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Você tem certeza que deseja excluir esta resposta?')">Excluir</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>

        <!-- Modais de edição -->
        <?php foreach ($lista as $item): ?>
            <div class="modal fade" id="editarModal<?php echo $item['id_resposta']; ?>" tabindex="-1" role="dialog"
                aria-labelledby="editarModalLabel<?php echo $item['id_resposta']; ?>" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editarModalLabel<?php echo $item['id_resposta']; ?>">Editar Resposta</h5>
                        </div>
                        <div class="modal-body">
                            <div class="card-body">
                                <form action="editarRespostaSubmit.php" method="POST">
                                    <input type="hidden" name="id_resposta" value="<?php echo $item['id_resposta']; ?>">
                                    <div class="mb-3">
                                        <label for="id_pergunta<?php echo $item['id_resposta']; ?>" class="form-label">Pergunta</label>
                                        <select name="id_pergunta" id="id_pergunta<?php echo $item['id_resposta']; ?>" class="form-control" required>
                                            <?php
                                            $perguntas = $pergunta->listar();
                                            foreach ($perguntas as $p):
                                                $selected = ($p['id_pergunta'] == $item['id_pergunta']) ? 'selected' : '';
                                            ?>
                                                <option value="<?php echo $p['id_pergunta']; ?>" <?php echo $selected; ?>>
                                                    <?php echo $p['texto_pergunta']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="texto_resposta<?php echo $item['id_resposta']; ?>" class="form-label">Resposta</label>
                                        <input type="text" class="form-control"
                                            id="texto_resposta<?php echo $item['id_resposta']; ?>" name="texto_resposta"
                                            value="<?php echo $item['texto_resposta']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="correta<?php echo $item['id_resposta']; ?>" class="form-label">Correta?</label>
                                        <select name="correta" id="correta<?php echo $item['id_resposta']; ?>" class="form-control" required>
                                            <option value="1" <?php echo $item['correta'] ? 'selected' : ''; ?>>Sim</option>
                                            <option value="0" <?php echo !$item['correta'] ? 'selected' : ''; ?>>Não</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="ordem<?php echo $item['id_resposta']; ?>" class="form-label">Ordem</label>
                                        <input type="number" class="form-control"
                                            id="ordem<?php echo $item['id_resposta']; ?>" name="ordem"
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
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#adicionarRespostaModal">
            Adicionar Resposta
        </button>
    <?php endif; ?>

    <!-- Modal para adicionar resposta -->
    <div class="modal fade" id="adicionarRespostaModal" tabindex="-1" role="dialog" aria-labelledby="adicionarRespostaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="adicionarRespostaModalLabel">Adicionar Resposta</h5>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Adicionar Resposta</h5>
                        </div>
                        <div class="card-body">
                            <form action="adicionarRespostaSubmit.php" method="POST">
                                <div class="mb-3">
                                    <label for="id_pergunta" class="form-label">Pergunta</label>
                                    <select name="id_pergunta" id="id_pergunta" class="form-control" required>
                                        <?php
                                        $perguntas = $pergunta->listar();
                                        foreach ($perguntas as $p):
                                        ?>
                                            <option value="<?php echo $p['id_pergunta']; ?>">
                                                <?php echo $p['texto_pergunta']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="texto_resposta" class="form-label">Resposta</label>
                                    <input type="text" class="form-control" id="texto_resposta" name="texto_resposta" required>
                                </div>
                                <div class="mb-3">
                                    <label for="correta" class="form-label">Correta?</label>
                                    <select name="correta" id="correta" class="form-control" required>
                                        <option value="1">Sim</option>
                                        <option value="0">Não</option>
                                    </select>
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