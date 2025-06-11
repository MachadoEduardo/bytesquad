<?php
session_start();
include 'assets/inc/header.inc.php';
include 'assets/classes/niveis.class.php';
$nivel = new Niveis();
require_once './assets/classes/administrador.class.php';
$admin = new Administrador();

// On protected admin pages
if (!isset($_SESSION['Logado'])) {
    header("Location: login.php");
    exit;
}
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
                    <th>XP Necessário</th>
                    <th>Nível Requerido</th>
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
                        <td><?php echo $item['xp_necessario']; ?></td>
                        <td><?php echo $item['nivel_requerido']; ?></td>
                        <td><?php echo $item['id_administrativo']; ?></td> <!-- Exibindo o id do administrador -->
                        <td>
                            <?php if ($admin->temPermissoes('EDIT')): ?>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#editarModal<?php echo $item['id_nivel']; ?>">
                                    Editar Nível
                                </button>
                            <?php endif; ?>
                            <?php if ($admin->temPermissoes('DELETE')): ?>
                                <a href="deletarNivel.php?id_nivel=<?php echo $item['id_nivel']; ?>"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Você tem certeza que deseja excluir <?php echo $item['nome_nivel'] ?>? ')">Excluir</a>
                            <?php endif; ?>
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
                                        <label for="xp_necessario<?php echo $item['id_nivel']; ?>" class="form-label">XP Necessário</label>
                                        <input type="number" class="form-control" id="xp_necessario<?php echo $item['id_nivel']; ?>" name="xp_necessario" value="<?php echo $item['xp_necessario']; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="nivel_requerido<?php echo $item['id_nivel']; ?>" class="form-label">Nível Requerido</label>
                                        <input type="number" class="form-control" id="nivel_requerido<?php echo $item['id_nivel']; ?>" name="nivel_requerido" value="<?php echo $item['nivel_requerido']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="id_administrativo<?php echo $item['id_administrativo']; ?>">Administrador:</label>
                                        <select name="id_administrativo" id="id_administrativo" class="form-control">
                                            <?php
                                            $listaAdmin = $nivel->listarAdministrador();
                                            foreach ($listaAdmin as $adminItem):
                                                $selected = ($adminItem['id_administrativo'] == $item['id_administrativo']) ? 'selected' : '';
                                            ?>
                                                <option value="<?php echo $adminItem['id_administrativo']; ?>" <?php echo $selected; ?>>
                                                    <?php echo $adminItem['id_administrativo']; ?> - <?php echo $adminItem['usuario']; ?>
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

    <?php if ($admin->temPermissoes('ADD')): ?>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Adicionar Nível
        </button>
    <?php endif; ?>

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
                                    <label for="xp_necessario" class="form-label">XP Necessário</label>
                                    <input type="number" class="form-control" id="xp_necessario" name="xp_necessario">
                                </div>
                                <div class="mb-3">
                                    <label for="nivel_requerido" class="form-label">Nível Requerido</label>
                                    <input type="number" class="form-control" id="nivel_requerido" name="nivel_requerido">
                                </div>
                                <div class="form-group">
                                    <label for="id_administrativo">Administrador:</label>
                                    <select name="id_administrativo" id="id_administrativo" class="form-control">
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