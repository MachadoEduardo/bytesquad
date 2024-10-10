<?php include 'assets/inc/header.inc.php';
include 'assets/classes/compras.class.php';

$compras = new Compras();
?>

<main class="container mt-5">
    <div class="header-content mb-4">
        <h1>Gerenciar Pacotes de Compras</h1>
        <p>Secção dedicada à criação, edição, leitura e exclusão de pacotes de compras.</p>
    </div>

    <!-- Tabela de compras -->
    <div class="table-responsive mb-4">
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <!-- Criando os cabeçalhos da tabela -->
                    <th>ID</th>
                    <th>Forma de pagamento</th>
                    <th>Valor total</th>
                    <th>Histórico de compra</th>
                    <th>Usuário</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <!-- Adicionar mais pacotes usando foreach -->
                <?php
                $lista = $compras->listar();
                foreach ($lista as $item):
                    ?>
                    <!-- Exemplo de linha de compras -->
                    <tr>
                        <td><?php echo $item['id_compra'] ?></td>
                        <td><?php echo $item['formapagamento'] ?></td>
                        <td><?php echo $item['preco_compra'] ?></td>
                        <td><?php echo $item['historico_compra'] ?></td>
                        <td><?php echo $item['id'] ?></td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#editarModal<?php echo $item['id_compra']; ?>">
                                Editar Compra
                            </button>
                            <a href="deletarCompra.php?id_compra=<?php echo $item['id_compra']; ?>"
                                class="btn btn-sm btn-danger"
                                onclick="return confirm('Você tem certeza que deseja excluir a Compra <?php echo $item['id_compra'] ?>? ')">Excluir</a>
                        </td>
                    </tr>
                    <?php
                endforeach
                ?>
            </tbody>
        </table>

         <!-- Criando um modal (de edição) dentro de um foreach, para que dessa forma, exista um modal para cada uma das compras da tabela. Assim, ao clicar no modal automaticamente 
        as informações das compras serão exibidas dentro do formulário -->
        <?php foreach ($lista as $item): ?>
            <!-- Modal de Edição -->
            <div class="modal fade" id="editarModal<?php echo $item['id_compra']; ?>" tabindex="-1" role="dialog"
                aria-labelledby="editarModalLabel<?php echo $item['id_compra']; ?>" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editarModalLabel<?php echo $item['id_compra']; ?>">Editar Compra
                            </h5>
                        </div>
                        <!-- Corpo do modal, nesse caso, o formulário -->
                        <div class="modal-body">
                            <div class="card-body">
                                <!-- editarDicasSubmit -->
                                <form action="editarComprasSubmit.php" method="POST">
                                    <input type="hidden" name="id_compra" value="<?php echo $item['id_compra']; ?>">
                                    <div class="mb-3">
                                        <label for="formapagamento<?php echo $item['id_compra']; ?>"
                                            class="form-label">Forma de pagamento</label>
                                        <input type="text" class="form-control"
                                            id="formapagamento<?php echo $item['id_compra']; ?>" name="formapagamento"
                                            value="<?php echo $item['formapagamento']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="preco_compra<?php echo $item['preco_compra']; ?>"
                                            class="form-label">Valor total</label>
                                        <input type="text" class="form-control"
                                            id="preco_compra<?php echo $item['id_compra']; ?>" name="preco_compra"
                                            value="<?php echo $item['preco_compra']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="historico_compra<?php echo $item['historico_compra']; ?>"
                                            class="form-label">Histórico de compra</label>
                                        <input type="text" class="form-control"
                                            id="historico_compra<?php echo $item['historico_compra']; ?>"
                                            name="historico_compra" value="<?php echo $item['historico_compra']; ?>"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="id<?php echo $item['id']; ?>">Usuário:</label>
                                        <select name="id" id="id" class="form-control" type="text">
                                            <?php
                                            $lista = $compras->listarUsuario();
                                            foreach ($lista as $item):
                                                ?>
                                                <option value="<?php echo $item['id']; ?>"><?php echo $item['id']; ?> -
                                                    <?php echo $item['nome_usuario']; ?>
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

        <!-- Button trigger modal (botão o qual vai acionar o modal) -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Adicionar Compra
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Adicionar Compra</h5>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <form action="adicionarCompraSubmit.php" method="POST">
                            <div class="mb-3">
                                <label for="formapagamento" class="form-label">Forma de pagamento:</label>
                                <input type="text" class="form-control" id="formapagamento"
                                    name="formapagamento" required>
                            </div>
                            <div class="mb-3">
                                <label for="preco_compra" class="form-label">Valor total:</label>
                                <input type="text" class="form-control" id="preco_compra" name="preco_compra"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="historico_compra" class="form-label">Histórico de compra:</label>
                                <input type="text" class="form-control" id="historico_compra" name="historico_compra"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="id">Usuário:</label>
                                <select name="id" id="id" class="form-control" type="text">
                                    <?php
                                    $lista = $compras->listarUsuario();
                                    foreach ($lista as $item):
                                        ?>
                                        <option value="<?php echo $item['id']; ?>"><?php echo $item['id']; ?> -
                                            <?php echo $item['nome_usuario']; ?>
                                        </option>
                                        <?php
                                    endforeach;
                                    ?>

                                </select>
                            </div>

                            <input type="submit" class="btn btn-success" name="btCadastrar" value="Salvar" />
                            <button type="reset" class="btn btn-secondary">Limpar</button>
                        </form>
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