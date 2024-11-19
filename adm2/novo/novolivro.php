<div class="details">
    <div class="recentOrders">
        <div class="cardHeader">
            <h2>Novo Livro</h2>
        </div>
        <div >
        <a class="button" id="openModalAutor">Adicionar Novo(a) Autor(a)</a>
        <a class="button" id="openModalEditora">Adicionar Editora</a >
        <a  class="button" id="openModalCopia">Adicionar Nova Cópia</a >
        <a  class="button" id="openModalGenero">Adicionar Novo Gênero</a >

           
        </div>

        <div class="formulario">
            <form action="?page=salvarlivro" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="acao" value="cadastrar">

                <div class="form-row">
                    <div class="form-column">
                        <label for="titulo">Título</label>
                        <input type="text" name="titulo" id="titulo" placeholder="Digite o titulo do livro" required>
                    
                        <label for="isbn">ISBN</label>
                        <input type="number" name="isbn" id="isbn" placeholder="xxxxxx" required>
                    
                        <label for="genero">Gênero</label>
                        <select name="genero" id="genero" required>
                            <?php
                            include('config.php');
                            $sql = "SELECT * FROM genero";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='{$row['id']}'>{$row['descricao']}</option>";
                                }
                            } else {
                                echo "<option value=''>Nenhum tipo de gênero foi encontrado</option>";
                            }
                            $conn->close();
                            ?>
                        </select>
                    
                        <label for="autor">Autor</label>
                        <select name="autor" id="autor" required>
                            <?php
                            include('config.php');
                            $sql = "SELECT * FROM autor";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='{$row['id']}'>{$row['nome']}</option>";
                                }
                            } else {
                                echo "<option value=''>Nenhum tipo de autor foi encontrado</option>";
                            }
                            $conn->close();
                            ?>
                        </select>
                   
                        <label for="editora">Editora</label>
                        <select name="editora" id="editora" required>
                            <?php
                            include('config.php');
                            $sql = "SELECT * FROM editora";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='{$row['id']}'>{$row['nome']}</option>";
                                }
                            } else {
                                echo "<option value=''>Nenhuma editora foi encontrada</option>";
                            }
                            $conn->close();
                            ?>
                        </select>
                    
                        <label for="paginas">Páginas</label>
                        <input type="number" name="paginas" id="paginas" placeholder="Ex: 127" required>
                    </div>

                    <div class="form-column">
                        <label for="idioma">Idioma</label>
                        <input type="text" name="idioma" id="idioma" required>
                    
                        <label for="ano_pub">Ano de Publicação</label>
                        <input type="number" name="ano_pub" id="ano_pub" required>
                    
                        <label for="data_aqui">Data de Aquisição</label>
                        <input type="date" name="data_aqui" id="data_aqui" required>
                    
                        <label for="edicao">Edição</label>
                        <input type="text" name="edicao" id="edicao" required>
                    
                        <label for="imagem">Imagem</label>
                        <input type="file" name="imagem" id="imagem" required>
                    </div>
            
                </div>

                <div>
                    <button class="button-form" type="submit">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- Botão para abrir o modal de Autor -->


<!-- Modal de Adicionar Autor -->
<div id="modalAutor" class="modal">
    <div class="modal-content">
        <span class="close" id="closeModalAutor">&times;</span>
        <div class="cardHeader">
            <h2>Adicionar Novo(a) Autor(a)</h2>
        </div>
        <div class="formulario">
            <form action="?page=salvarlivro" method="POST">
                <input type="hidden" name="acao" value="salvarautor">
                <div class="form-row">
                    <div class="form-column">
                        <label for="nome">Nome</label>
                        <input type="text" name="nome" id="nome">
                        <label for="nacionalidade">Nacionalidade</label>
                        <input type="text" name="nacionalidade" id="nacionalidade">
                        <label for="data_nasc">Data de Nascimento</label>
                        <input type="date" name="data_nasc" id="data_nasc">
                        <label for="bio">Biografia</label>
                        <input type="text" name="bio" id="bio">
                    </div>
                </div>
                <div>
                    <button class="button-form" type="submit">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Botão para abrir o modal de Editora -->


<!-- Modal de Adicionar Editora -->
<div id="modalEditora" class="modal">
    <div class="modal-content">
        <span class="close" id="closeModalEditora">&times;</span>
        <div class="cardHeader">
            <h2>Adicionar Editora</h2>
        </div>
        <div class="formulario">
            <form action="?page=salvarlivro" method="POST">
                <input type="hidden" name="acao" value="salvareditora">
                <div class="form-row">
                    <div class="form-column">
                        <label for="nome">Nome</label>
                        <input type="text" name="nome" id="nome">
                    </div>
                </div>
                <div>
                    <button class="button-form" type="submit">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Botão para abrir o modal de Gênero -->


<!-- Modal de Adicionar Gênero -->
<div id="modalGenero" class="modal">
    <div class="modal-content">
        <span class="close" id="closeModalGenero">&times;</span>
        <div class="cardHeader">
            <h2>Adicionar Novo Gênero</h2>
        </div>
        <div class="formulario">
            <form action="?page=salvarlivro" method="POST">
                <input type="hidden" name="acao" value="salvargenero">
                <div class="form-row">
                    <div class="form-column">
                        <label for="nome">Descrição</label>
                        <input type="text" name="nome" id="nome">
                    </div>
                </div>
                <div>
                    <button class="button-form" type="submit">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Botão para abrir o modal de Cópia -->


<!-- Modal de Adicionar Cópia -->
<div id="modalCopia" class="modal">
    <div class="modal-content">
        <span class="close" id="closeModalCopia">&times;</span>
        <div class="cardHeader">
            <h2>Adicionar Nova Cópia</h2>
        </div>
        <div class="formulario">
            <form action="?page=salvarcopia" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="acao" value="cadastrar">
                <div class="form-row">
                    <div class="form-column">
                        <label for="livro_id">ID do Livro</label>
                        <input type="number" name="livro_id" id="livro_id" required>
                        <label for="data_aquisicao">Data de Aquisição</label>
                        <input type="date" name="data_aquisicao" id="data_aquisicao" required>
                        <label for="edicao">Edição</label>
                        <input type="text" name="edicao" id="edicao">
                        <label for="localizacao">Localização</label>
                        <input type="text" name="localizacao" id="localizacao">
                    </div>
                </div>
                <div>
                    <button class="button-form" type="submit">Adicionar Cópia</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Estilos CSS para os modais -->
<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.4);
    }
    
    .modal-content {
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 40%;
        background-color: #fff7;
        backdrop-filter: blur(10px);
        box-shadow: 0 .4rem .8rem #0005;
        border-radius: .8rem;
    }
    
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }
    
    .close:hover,
    .close:focus {
        color: black;
        cursor: pointer;
    }
</style>

<!-- JavaScript para abrir e fechar os modais -->
<script>
    var modalAutor = document.getElementById("modalAutor");
    var modalEditora = document.getElementById("modalEditora");
    var modalGenero = document.getElementById("modalGenero");
    var modalCopia = document.getElementById("modalCopia");

    var openModalAutor = document.getElementById("openModalAutor");
    var openModalEditora = document.getElementById("openModalEditora");
    var openModalGenero = document.getElementById("openModalGenero");
    var openModalCopia = document.getElementById("openModalCopia");

    var closeModalAutor = document.getElementById("closeModalAutor");
    var closeModalEditora = document.getElementById("closeModalEditora");
    var closeModalGenero = document.getElementById("closeModalGenero");
    var closeModalCopia = document.getElementById("closeModalCopia");

    openModalAutor.onclick = function() {
        modalAutor.style.display = "block";
    }

    closeModalAutor.onclick = function() {
        modalAutor.style.display = "none";
    }

    openModalEditora.onclick = function() {
        modalEditora.style.display = "block";
    }

    closeModalEditora.onclick = function() {
        modalEditora.style.display = "none";
    }

    openModalGenero.onclick = function() {
        modalGenero.style.display = "block";
    }

    closeModalGenero.onclick = function() {
        modalGenero.style.display = "none";
    }

    openModalCopia.onclick = function() {
        modalCopia.style.display = "block";
    }

    closeModalCopia.onclick = function() {
        modalCopia.style.display = "none";
    }

    // Fecha o modal se clicar fora do conteúdo
    window.onclick = function(event) {
        if (event.target == modalAutor) {
            modalAutor.style.display = "none";
        }
        if (event.target == modalEditora) {
            modalEditora.style.display = "none";
        }
        if (event.target == modalGenero) {
            modalGenero.style.display = "none";
        }
        if (event.target == modalCopia) {
            modalCopia.style.display = "none";
        }
    }
</script>
