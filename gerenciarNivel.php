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
                    <td><?php echo $item['id']?></td>
                    <td><?php echo $item['nome_nivel']?></td>
                    <td><?php echo $item['tempo_nivel']?></td>
                    <td><?php echo $item['dificuldade']?></td>
                    <td><?php echo $item['questoes']?></td>
                    <td><?php echo $item['respostas']?></td>
                    <td><?php echo $item['id_administrador']?></td>
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
                    <label for="levelName" class="form-label">Título</label>
                    <input type="text" class="form-control" id="levelName" name="levelName" required>
                </div>
                <div class="mb-3">
                    <label for="levelTime" class="form-label">Tempo</label>
                    <input type="text" class="form-control" id="levelTime" name="levelTime" required>
                </div>
                <div class="mb-3">
                    <label for="levelDifficult" class="form-label">Dificuldade</label>
                    <input type="text" class="form-control" id="levelDifficult" name="levelDifficult" required>
                </div>
                <div class="mb-3">
                    <label for="levelQuestion" class="form-label">Perguntas</label>
                    <input type="text" class="form-control" id="levelQuestion" name="levelQuestion" required>
                </div>
                <div class="mb-3">
                    <label for="levelAnswer" class="form-label">Respostas</label>
                    <input type="text" class="form-control" id="levelAnswer" name="levelAnswer" required>
                </div>
                <input type="submit" class="btn btn-success" name="btCadastrar" value="Salvar"/>
                <button type="reset" class="btn btn-secondary">Limpar</button>
            </form>
        </div>
     </div>
</main>

<!-- Inclua os scripts necessários para o Bootstrap 5.x -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
