<div class="visualizar-emprestimo-container">
    <h4 class="visualizar-header">Visualizar Empréstimo
        <a href="index.php?page=listaremprestimo" class="voltar-link">Voltar</a>
    </h4>
    <?php
    if (isset($_GET['id'])) {
        $emprestimo_id = mysqli_real_escape_string($conn, $_GET["id"]);
        $sql = "SELECT emprestimo.*, usuario.nome AS usuario_nome, livro.titulo AS livro_titulo 
                FROM emprestimo 
                INNER JOIN usuario ON emprestimo.usuario = usuario.cpf 
                INNER JOIN livro ON emprestimo.idlivro = livro.idlivro 
                WHERE emprestimo.emprestimoid = '$emprestimo_id'";

        $query = mysqli_query($conn, $sql);
        
        // Verifique se houve um erro na consulta
        if (!$query) {
            die("<h5 class='erro'>Erro na consulta: " . mysqli_error($conn) . "</h5>");
        }
        
        if (mysqli_num_rows($query) > 0) {
            $emprestimo = mysqli_fetch_array($query);
    ?>
        <div class="info-group">
            <label>ID do Empréstimo</label>
            <p><?=$emprestimo['emprestimoid']?></p>
        </div>
        <div class="info-group">
            <label>Usuário</label>
            <p><?=$emprestimo['usuario_nome']?></p>
        </div>
        <div class="info-group">
            <label>Livro</label>
            <p><?=$emprestimo['livro_titulo']?></p>
        </div>
        <div class="info-group">
            <label>Data de Início</label>
            <p><?=$emprestimo['inicio']?></p>
        </div>
        <div class="info-group">
            <label>Data Prevista para Devolução</label>
            <p><?=$emprestimo['dataprevista']?></p>
        </div>
        <div class="info-group">
            <label>Data de Devolução</label>
            <p><?= $emprestimo['datareal'] ? $emprestimo['datareal'] : 'Não devolvido' ?></p>
        </div>
        <div class="info-group">
            <label>Status</label>
            <p><?=$emprestimo['status']?></p>
        </div>
    <?php
        } else {
            echo "<h5 class='erro'>Empréstimo não encontrado!</h5>";
        }
    }
    ?>
</div>


<style> 
.visualizar-emprestimo-container {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    max-width: 600px;
    margin: 0 auto;
    
}

.visualizar-header {
    margin-bottom: 20px;
    color: #333;
    text-align: center;
}

.voltar-link {
    float: right;
    color: #007BFF;
    text-decoration: none;
}

.voltar-link:hover {
    text-decoration: underline;
}

.info-group {
    margin-bottom: 15px;
}

.info-group label {
    font-weight: bold;
    color: #555;
    display: block;
    margin-bottom: 5px;
}

.info-group p {
    margin: 0;
    color: #333;
}

.erro {
    color: red;
    margin-top: 20px;
}

</style>