<div class="visualizar-livro-container">
    <h4 class="visualizar-header">Visualizar Livro
        <a href="index.php?page=listarLivro" class="voltar-link">Voltar</a>
    </h4>
    <?php
    if (isset($_GET['id'])) {
        $livro_id = mysqli_real_escape_string($conn, $_GET["id"]);
        $sql = "SELECT livro.*, genero.descricao AS genero, autor.nome AS autor, editora.nome AS editora 
                FROM livro 
                INNER JOIN genero ON livro.genero_id = genero.id 
                INNER JOIN autor ON livro.autor_id = autor.id 
                INNER JOIN editora ON livro.editora_id = editora.id 
                WHERE livro.idlivro = '$livro_id'";
        
        $query = mysqli_query($conn, $sql);
        
        // Verifique se houve um erro na consulta
        if (!$query) {
            die("<h5 class='erro'>Erro na consulta: " . mysqli_error($conn) . "</h5>");
        }
        
        if (mysqli_num_rows($query) > 0) {
            $livro = mysqli_fetch_array($query);
    ?>
        <div class="info-group">
            <label>Título</label>
            <p><?=$livro['titulo']?></p>
        </div>
        <div class="info-group">
            <label>ISBN</label>
            <p><?=$livro['isbn']?></p>
        </div>
        <div class="info-group">
            <label>Gênero</label>
            <p><?=$livro['genero']?></p>
        </div>
        <div class="info-group">
            <label>Autor</label>
            <p><?=$livro['autor']?></p>
        </div>
        <div class="info-group">
            <label>Editora</label>
            <p><?=$livro['editora']?></p>
        </div>
        <div class="info-group">
            <label>Páginas</label>
            <p><?=$livro['paginas']?></p>
        </div>
        <div class="info-group">
            <label>Idioma</label>
            <p><?=$livro['idioma']?></p>
        </div>
        <div class="info-group">
            <label>Ano de Publicação</label>
            <p><?=$livro['ano_publicacao']?></p>
        </div>
        <div class="info-group">
            <label>Quantidade</label>
            <p><?=$livro['quantidade']?></p>
        </div>
        <div class="info-group">
            <label>Disponibilidade</label>
            <p><?=$livro['disponibilidade']?></p>
        </div>
        <div class="info-group">
            <label>Imagem</label>
            <p>
                <img src="<?=$livro['imagem']?>" alt="<?=$livro['titulo']?>" class="imagem-livro">
            </p>
        </div>
    <?php
        } else {
            echo "<h5 class='erro'>Livro não encontrado!</h5>";
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