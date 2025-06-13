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

    <button type="button" class="btn btn-success m-2" data-bs-toggle="modal" data-bs-target="#gerarIaModal">
        Gerar com IA
    </button>

    <div class="modal fade" id="gerarIaModal" tabindex="-1" aria-labelledby="gerarIaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="formGerarIa" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="gerarIaModalLabel">Gerar Pergunta com IA</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="temaIa" class="form-label">Tema</label>
                        <input type="text" class="form-control" id="temaIa" name="tema" required>
                    </div>
                    <div class="mb-3">
                        <label for="nivelIa" class="form-label">Nível/Dificuldade</label>
                        <input type="text" class="form-control" id="nivelIa" name="nivel" required>
                    </div>
                    <div class="mb-3">
                        <label for="promptIa" class="form-label">Prompt (opcional)</label>
                        <label for="" class="text-secondary">Ex: Crie uma pergunta de múltipla escolha sobre [tema] para alunos do [nível].</label>
                        <textarea class="form-control" id="promptIa" name="prompt" rows="2" placeholder=""></textarea>
                    </div>
                    <div id="iaLoading" class="text-center text-muted d-none">Gerando pergunta...</div>
                    <div id="iaPerguntaGerada" class="mt-3">
                    </div>
                    <button id="btnAddPerguntaBanco" class="btn btn-success mt-2 d-none">Adicionar ao Banco</button>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Gerar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </form>
        </div>
    </div>

</main>

<?php include 'assets/inc/footer.inc.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('formGerarIa').addEventListener('submit', function(e) {
        e.preventDefault();
        document.getElementById('iaLoading').classList.remove('d-none');
        document.getElementById('iaPerguntaGerada').innerHTML = '';

        const tema = document.getElementById('temaIa').value;
        const nivel = document.getElementById('nivelIa').value;
        const promptCustom = document.getElementById('promptIa').value;

        console.log('Enviando para IA:', tema, nivel, promptCustom);
        fetch('api/gerar_pergunta_ia.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `tema=${encodeURIComponent(tema)}&nivel=${encodeURIComponent(nivel)}&prompt=${encodeURIComponent(promptCustom)}`
            })
            .then(res => res.json())
            .then(data => {
                console.log('JSON recebido:', data);
                document.getElementById('iaLoading').classList.add('d-none');
                if (!data.pergunta) {
                    document.getElementById('iaPerguntaGerada').innerHTML = 'A IA não conseguiu gerar uma pergunta. Tente novamente ou ajuste o prompt.';
                    return;
                }
                document.getElementById('iaPerguntaGerada').innerHTML = `<b>Pergunta:</b> ${data.pergunta}<br>
        <b>Alternativas:</b><br>
        <ul>${
    Object.entries(data.alternativas)
        .map(([letra, alt]) => `<li>${letra}) ${alt}</li>`)
        .join('')
}</ul>
<b>Correta:</b> ${data.correta}`;
                document.getElementById('btnAddPerguntaBanco').classList.remove('d-none');
            })
            .catch((err) => {
                console.error('Erro na requisição:', err);
                document.getElementById('iaLoading').classList.add('d-none');
                document.getElementById('iaPerguntaGerada').innerHTML = 'Erro ao gerar pergunta.';
            });

        let perguntaGerada = {};

        document.getElementById('formGerarIa').addEventListener('submit', function(e) {
            e.preventDefault();
            document.getElementById('iaLoading').classList.remove('d-none');
            document.getElementById('iaPerguntaGerada').innerHTML = '';
            document.getElementById('btnAddPerguntaBanco').classList.add('d-none');

            const tema = document.getElementById('temaIa').value;
            const nivel = document.getElementById('nivelIa').value;
            const promptCustom = document.getElementById('promptIa').value;

            fetch('api/gerar_pergunta_ia.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `tema=${encodeURIComponent(tema)}&nivel=${encodeURIComponent(nivel)}&prompt=${encodeURIComponent(promptCustom)}`
                })
                .then(res => res.json())
                .then(data => {
                    perguntaGerada = data;
                    document.getElementById('iaLoading').classList.add('d-none');
                    document.getElementById('iaPerguntaGerada').innerHTML = `<b>Pergunta:</b> ${data.pergunta}<br>
            <b>Alternativas:</b><br>
            <ul>${
    Object.entries(data.alternativas)
        .map(([letra, alt]) => `<li>${letra}) ${alt}</li>`)
        .join('')
}</ul>
            <b>Correta:</b> ${data.correta}`;
                    document.getElementById('btnAddPerguntaBanco').classList.remove('d-none');
                })
                .catch(() => {
                    document.getElementById('iaLoading').classList.add('d-none');
                    document.getElementById('iaPerguntaGerada').innerHTML = 'Erro ao gerar pergunta.';
                });
        });

        // Adicionar ao banco
        document.getElementById('btnAddPerguntaBanco').addEventListener('click', function() {
            const id_nivel = document.getElementById('nivelIa').value;
            fetch('api/adicionar_pergunta_ia.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id_nivel: id_nivel,
                        pergunta: perguntaGerada.pergunta,
                        alternativas: perguntaGerada.alternativas,
                        correta: perguntaGerada.correta
                    })
                })
                .then(res => res.json())
                .then(resp => {
                    if (resp.sucesso) {
                        alert('Pergunta adicionada com sucesso!');
                        document.getElementById('btnAddPerguntaBanco').classList.add('d-none');
                    } else {
                        alert('Erro ao adicionar pergunta!');
                    }
                });
        });
    });
</script>
</body>

</html>