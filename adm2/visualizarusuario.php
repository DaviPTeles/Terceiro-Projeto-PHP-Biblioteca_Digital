<div class="usuario-container">
    <h4 class="usuario-header">
        Visualizar Usuário
        <a href="index.php?page=listar" class="back-link">Voltar</a>
    </h4>
    <?php
    if (isset($_GET['id'])) {
        $usuario_id = mysqli_real_escape_string($conn, $_GET["id"]);
        $sql = "SELECT * FROM usuario INNER JOIN tipo_usuario ON usuario.tipo_usuario = tipo_usuario.id_tipo WHERE id = '$usuario_id'";
        $query = mysqli_query($conn, $sql);
        if (mysqli_num_rows($query) > 0) {
            $usuario = mysqli_fetch_array($query);
    ?>
        <div class="usuario-info">
            <label>Nome Completo:</label>
            <p><?=$usuario['nome']?> <?=$usuario['sobrenome']?></p>
        </div>
        <div class="usuario-info">
            <label>CPF:</label>
            <p><?=$usuario['cpf']?></p>
        </div>
        <div class="usuario-info">
            <label>E-mail:</label>
            <p><?=$usuario['email']?></p>
        </div>
        <div class="usuario-info">
            <label>Data de Nascimento:</label>
            <p><?=date('d/m/Y', strtotime($usuario['data_nasc']))?></p>
        </div>
        <div class="usuario-info">
            <label>Telefone:</label>
            <p><?=$usuario['telefone']?></p>
        </div>
        <div class="usuario-info">
            <label>Tipo de Usuário:</label>
            <p><?=$usuario['nome_usuario']?></p>
        </div>
        <div class="usuario-info">
            <label>Imagem:</label>
            <p>
                <img src="<?=$usuario['imagem']?>" alt="Imagem do usuário" class="usuario-image">
            </p>
        </div>
    <?php
        } else {
            echo "<h5>Usuário não encontrado!</h5>";
        }
    }
    ?>
</div>

<style>

.usuario-container {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    max-width: 600px;
    margin: 0 auto;
}

.usuario-header {
    margin-bottom: 20px;
    color: #333;
    text-align: center;
}

.back-link {
    float: right;
    color: #007BFF;
    text-decoration: none;
}

.back-link:hover {
    text-decoration: underline;
}

.usuario-info {
    margin-bottom: 15px;
}

.usuario-info label {
    font-weight: bold;
    color: #555;
}

.usuario-info p {
    margin: 5px 0 10px;
    color: #333;
}

.usuario-image {
    width: 100px;
    height: auto;
    border-radius: 5px;
}

</style>