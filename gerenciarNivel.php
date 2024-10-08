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
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <!-- Adicionar mais níveis usando foreach -->
                <?php
                $lista = $nivel->listar();
                foreach ($lista as $item):
                    ?>
                    <!-- Exemplo de linha de Nível -->
                    <tr>
                        <td><?php echo $item['id_nivel'] ?></td>
                        <td><?php echo $item['nome_nivel'] ?></td>
                        <td><?php echo $item['tempo_nivel'] ?></td>
                        <td><?php echo $item['dificuldade'] ?></td>
                        <td><?php echo $item['questoes'] ?></td>
                        <td><?php echo $item['respostas'] ?></td>
                        <td><?php echo $item['id_administrativo']; ?></td> <!-- Exibindo o id do administrador -->
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#editarModal<?php echo $item['id_nivel']; ?>">
                                Editar Nível
                            </button>
                            <a href="deletarNivel.php?id_nivel=<?php echo $item['id_nivel']; ?>"
                                class="btn btn-sm btn-danger"
                                onclick="return confirm('Você tem certeza que deseja excluir <?php echo $item['nome_nivel'] ?>? ')">Excluir</a>
                        </td>
                    </tr>
                    <?php
                endforeach
                ?>
            </tbody>
        </table>

        <!-- Criando um modal (de edição) dentro de um foreach, para que dessa forma, exista um modal para cada um dos niveis da tabela. Assim, ao clicar no modal automaticamente 
        as informações do niveis serão exibidas dentro do formulário -->
        <?php foreach ($lista as $item): ?>
            <!-- Modal de Edição -->
            <div class="modal fade" id="editarModal<?php echo $item['id_nivel']; ?>" tabindex="-1" role="dialog"
                aria-labelledby="editarModalLabel<?php echo $item['id_nivel']; ?>" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editarModalLabel<?php echo $item['id_nivel']; ?>">Editar Nível
                            </h5>
                        </div>
                        <!-- Corpo do modal, nesse caso, o formulário -->
                        <div class="modal-body">
                            <div class="card-body">
                                <!-- editarNivelSubmit -->
                                <form action="editarNivelSubmit.php" method="POST">
                                    <input type="hidden" name="id_nivel" value="<?php echo $item['id_nivel']; ?>">
                                    <div class="mb-3">
                                        <label for="nome_nivel<?php echo $item['id_nivel']; ?>"
                                            class="form-label">Nome</label>
                                        <input type="text" class="form-control"
                                            id="nome_nivel<?php echo $item['id_nivel']; ?>" name="nome_nivel"
                                            value="<?php echo $item['nome_nivel']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tempo_nivel<?php echo $item['tempo_nivel']; ?>"
                                            class="form-label">Tempo</label>
                                        <input type="text" class="form-control"
                                            id="tempo_nivel<?php echo $item['id_nivel']; ?>" name="tempo_nivel"
                                            value="<?php echo $item['tempo_nivel']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="dificuldade<?php echo $item['dificuldade']; ?>"
                                            class="form-label">Dificuldade</label>
                                        <input type="text" class="form-control"
                                            id="dificuldade<?php echo $item['dificuldade']; ?>" name="dificuldade"
                                            value="<?php echo $item['dificuldade']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="questoes<?php echo $item['questoes']; ?>"
                                            class="form-label">Questões</label>
                                        <input type="text" class="form-control"
                                            id="questoes<?php echo $item['questoes']; ?>" name="questoes"
                                            value="<?php echo $item['questoes']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="respostas<?php echo $item['respostas']; ?>"
                                            class="form-label">Respostas</label>
                                        <input type="text" class="form-control"
                                            id="respostas<?php echo $item['respostas']; ?>" name="respostas"
                                            value="<?php echo $item['respostas']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="id_administrativo<?php echo $item['id_administrativo']; ?>">Administrador:</label>
                                        <select name="id_administrativo" id="id_administrativo" class="form-control"
                                            type="text">
                                            <?php
                                            $lista = $nivel->listarAdministrador();
                                            foreach ($lista as $item):
                                                ?>
                                                <option value="<?php echo $item['id_administrativo']; ?>"><?php echo $item['id_administrativo']; ?> - <?php echo $item['usuario']; ?>
                                                    </option>
                                                <?php
                                            endforeach;
                                            ?>

                                        </select>

                                    </div>

                                    <button type="submit" class="btn btn-primary">Salvar alterações</button>
                                </form>
                            </div>
                        </div>
                        <!-- Footer do modal, nesse caso, o botão de fechar -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Adicionar Nível
    </button>

    <!-- Modal para adicionar nível -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Adicionar Nível</h5>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Adicionar Nível</h5>
                        </div>
                        <div class="card-body">
                            <form action="adicionarNivelSubmit.php" method="POST">
                                <div class="mb-3">
                                    <label for="nome_nivel" class="form-label">Título</label>
                                    <input type="text" class="form-control" id="nome_nivel" name="nome_nivel" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tempo_nivel" class="form-label">Tempo</label>
                                    <input type="text" class="form-control" id="tempo_nivel" name="tempo_nivel"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="dificuldade" class="form-label">Dificuldade</label>
                                    <input type="text" class="form-control" id="dificuldade" name="dificuldade"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="questoes" class="form-label">Perguntas</label>
                                    <input type="text" class="form-control" id="questoes" name="questoes" required>
                                </div>
                                <div class="mb-3">
                                    <label for="respostas" class="form-label">Respostas</label>
                                    <input type="text" class="form-control" id="respostas" name="respostas" required>
                                </div>

                                <div class="form-group">
                                    <label for="id_administrativo">Administrador:</label>
                                    <select name="id_administrativo" id="id_administrativo" class="form-control"
                                        type="text">
                                        <?php
                                        $listaNova = $nivel->listarAdministrador();
                                        foreach ($listaNova as $itemNovo):
                                            ?>
                                            <option value="<?php echo $itemNovo['id_administrativo']; ?>">
                                                <?php echo $itemNovo['id_administrativo']; ?> -
                                                <?php echo $itemNovo['usuario']; ?> </option>
                                            <?php
                                        endforeach;
                                        ?>

                                    </select>

                                </div>

                        </div>

                        <input type="submit" class="btn btn-success my-2" name="btCadastrar" value="Salvar" />
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

<!-- Inclua os scripts necessários para o Bootstrap 5.x -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>