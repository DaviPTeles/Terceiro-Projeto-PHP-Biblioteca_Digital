<div class="details">
    <div class="recentOrders">
        <div class="cardHeader">
            <h2>Adicionar Nova Copia</h2>
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

                <?php
                // Display success or error message if set
                if (isset($_SESSION['mensagem'])) {
                    echo "<p>{$_SESSION['mensagem']}</p>";
                    unset($_SESSION['mensagem']); // Clear the message after displaying
                }
                ?>
            </form>

        </div>
    </div>
</div>

