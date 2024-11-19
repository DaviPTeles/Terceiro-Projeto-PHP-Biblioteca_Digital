<div class="details">
    <div class="recentOrders">
        <div class="cardHeader">
            <h2>Editar Livro</h2>
        </div>

            <?php 
            if (isset($_GET['id'])) {
                $sql = "SELECT * FROM livro WHERE idlivro=" . $_REQUEST['id'];
                $res = $conn->query($sql);
                $row = $res->fetch_object();
                if ($res->num_rows > 0) {
            ?>

             <div class="formulario">
                <form action="?page=salvarlivro" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="acao" value="editar">
                    <input type="hidden" name="idlivro" value="<?php print $row->idlivro; ?>">
                    
                    <div class="form-row">
                        <div class="form-column">
                            <label for="titulo">Título</label>
                            <input type="text" name="titulo" value="<?php print $row->titulo; ?>">
                        
                            <label for="isbn">ISBN</label>
                            <input type="text" name="isbn" value="<?php print $row->isbn; ?>">
                        
                            <label for="genero">Gênero:</label>
                            <select name="genero_id" id="genero">
                                <?php
                                $sql_genero = "SELECT * FROM genero";
                                $result_genero = $conn->query($sql_genero);
                                if ($result_genero->num_rows > 0) {
                                    while ($genero = $result_genero->fetch_assoc()) {
                                        $selected = ($genero['id'] == $row->genero_id) ? 'selected' : '';
                                        echo "<option value='{$genero['id']}' {$selected}>{$genero['descricao']}</option>";
                                    }
                                } else {
                                    echo "<option value=''>Nenhum gênero encontrado</option>";
                                }
                                ?>
                            </select>
                        

                        
                            <label for="autor">Autor:</label>
                            <select name="autor_id" id="autor">
                                <?php
                                $sql_autor = "SELECT * FROM autor";
                                $result_autor = $conn->query($sql_autor);
                                if ($result_autor->num_rows > 0) {
                                    while ($autor = $result_autor->fetch_assoc()) {
                                        $selected = ($autor['id'] == $row->autor_id) ? 'selected' : '';
                                        echo "<option value='{$autor['id']}' {$selected}>{$autor['nome']}</option>";
                                    }
                                } else {
                                    echo "<option value=''>Nenhum autor encontrado</option>";
                                }
                                ?>
                            </select>
                    
                            <label for="editora">Editora:</label>
                            <select name="editora_id" id="editora">
                                <?php
                                $sql_editora = "SELECT * FROM editora";
                                $result_editora = $conn->query($sql_editora);
                                if ($result_editora->num_rows > 0) {
                                    while ($editora = $result_editora->fetch_assoc()) {
                                        $selected = ($editora['id'] == $row->editora_id) ? 'selected' : '';
                                        echo "<option value='{$editora['id']}' {$selected}>{$editora['nome']}</option>";
                                    }
                                } else {
                                    echo "<option value=''>Nenhuma editora encontrada</option>";
                                }
                                ?>
                            </select>
                        </div>
                        
                        <div class="form-column">
                            <label for="paginas">Páginas</label>
                            <input type="number" name="paginas" value="<?php print $row->paginas; ?>">
                        
                            <label for="idioma">Idioma</label>
                            <input type="text" name="idioma" value="<?php print $row->idioma; ?>">
                        
                            <label for="ano_pub">Ano de Publicação</label>
                            <input type="number" name="ano_pub" value="<?php print $row->ano_publicacao; ?>">
                        
                            <label for="imagem">Imagem</label>
                            <input type="file" name="imagem" accept="image/*">
                            <p>Imagem atual: <img src="<?php print $row->imagem; ?>" alt="Imagem do Livro" style="width:100px; height:auto;"></p>
                        </div>
                    </div>

                    <div>
                        <button type="submit">Enviar</button>
                    </div>
                </form>
            <?php
                } else {
                    echo "<h5>Livro não encontrado</h5>";
                }
            }
            ?>

        </div>
    </div>
</div>