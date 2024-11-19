<div class="visualizar-livro-container">
    <h4 class="visualizar-header">Visualizar Cópia do Livro
        <a href="index.php?page=listarLivro"  class="voltar-link">Voltar</a>
    </h4>
    <?php
    if (isset($_GET['id'])) {
        $copia_id = mysqli_real_escape_string($conn, $_GET["id"]);
        $sql = "SELECT cl.*, sl.descricao AS status_descricao 
                FROM copia_livro cl 
                INNER JOIN status_livro sl ON cl.status_id = sl.id 
                WHERE cl.id = '$copia_id'";
        
        $query = mysqli_query($conn, $sql);
        
        // Verifica se a consulta falhou
        if (!$query) {
            echo "<h5>Erro ao executar a consulta: " . mysqli_error($conn) . "</h5>";
            exit;
        }

        if (mysqli_num_rows($query) > 0) {
            $copia = mysqli_fetch_array($query);
    ?>
        <div class="info-group">
            <label>ID</label>
            <p>
                <?=$copia['id']?>
            </p>
        </div>
        <div class="info-group">
            <label>ID do Livro</label>
            <p>
                <?=$copia['livro_id']?>
            </p>
        </div>
        <div class="info-group">
            <label>Status</label>
            <p>
                <?=$copia['status_descricao']?>
            </p>
        </div>
        <div class="info-group">
            <label>Data de Aquisição</label>
            <p>
                <?=date('d/m/Y', strtotime($copia['data_aquisicao']))?>
            </p>
        </div>
        <div class="info-group">
            <label>Edição</label>
            <p>
                <?=$copia['edicao']?>
            </p>
        </div>
        <div class="info-group">
            <label>Localização</label>
            <p>
                <?=$copia['localizacao']?>
            </p>
        </div>
    <?php
        } else {
            echo "<h5>Cópia do livro não encontrada!</h5>";
        }
    }
    ?>
</div>

<style>

.visualizar-livro-container {
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

.imagem-livro {
    width: 100px;
    height: auto;
}

.erro {
    color: red;
    margin-top: 20px;
}

</style>