<?php include 'assets/inc/header.inc.php';
include 'assets/classes/usuarios.class.php';
$usuario = new Usuarios();
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
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Senha</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <!-- Adicionar mais usuários usando foreach -->
                 <?php
                    $lista = $usuario->listar();
                    foreach ($lista as $item):
                ?>
                <!-- Exemplo de linha de usuário -->
                <tr>
                    <td><?php echo $item['id']?></td>
                    <td><?php echo $item['nome_usuario']?></td>
                    <td><?php echo $item['email_usuario']?></td>
                    <td><?php echo $item['senha_usuario']?></td>
                    <td>
                        <a href="editarUsuario.php?id=<?php echo $item['id']; ?>" class="btn btn-sm btn-primary">Editar</a>
                        <a href="deletarUsuario.php?id=<?php echo $item['id']; ?>" class="btn btn-sm btn-danger">Excluir</a>
                    </td>
                </tr>
                <?php
                    endforeach
                ?>
            </tbody>
        </table>
    </div>

    <!-- Formulário para Adicionar/Editar Usuário -->
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Adicionar/Editar Usuário</h5>
        </div>
        <div class="card-body">
            <form action="adicionarUsuarioSubmit.php" method="POST">
                <div class="mb-3">
                    <label for="userName" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="userName" name="userName" required>
                </div>
                <div class="mb-3">
                    <label for="userEmail" class="form-label">Email</label>
                    <input type="email" class="form-control" id="userEmail" name="userEmail" required>
                </div>
                <div class="mb-3">
                    <label for="userPassword" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="userPassword" name="userPassword" required>
                </div>
                <input type="submit" class="btn btn-success" name="btCadastrar" value="Salvar"/>
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