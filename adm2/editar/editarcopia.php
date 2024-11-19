<div class="details">
    <div class="recentOrders">
        <div class="cardHeader">
            <h2>Editar Copia do Livro</h2>
        </div>

            <?php 
                if(isset($_GET['id'])){
                $sql = "SELECT * FROM copia_livro WHERE id=".$_REQUEST['id'];
                $res = $conn->query($sql);
                $row = $res->fetch_object();
                if($res->num_rows > 0){
            ?>

            <div class="formulario">
                <form action="?page=salvarcopia" method="POST">
                    <input type="hidden" name="acao" value="editar">
                    <input type="hidden" name="id" value="<?php print $row->id; ?>">
                    
                    <div class="form-row">
                        <div class="form-column">
                            <label for="livro_id">Livro:</label>
                            <select name="livro_id" id="livro_id">
                                <?php
                                $sql_livro = "SELECT * FROM livro";
                                $result_livro = $conn->query($sql_livro);
                                if ($result_livro->num_rows > 0) {
                                    while ($livro = $result_livro->fetch_assoc()) {
                                        $selected = ($livro['idlivro'] == $row->livro_id) ? 'selected' : '';
                                        echo "<option value='{$livro['idlivro']}' {$selected}>{$livro['titulo']}</option>";
                                    }
                                } else {
                                    echo "<option value=''>Nenhum livro encontrado</option>";
                                }
                                ?>
                            </select>
                        
                            <label for="data_aquisicao">Data de Aquisição</label>
                            <input type="date" name="data_aquisicao" value="<?php print $row->data_aquisicao; ?>">
                        
                            <label for="edicao">Edição</label>
                            <input type="text" name="edicao" value="<?php print $row->edicao; ?>">
                        
                            <label for="localizacao">Localização</label>
                            <input type="text" name="localizacao" value="<?php print $row->localizacao; ?>">
                        </div>
                    </div>

                    <div>
                        <button type="submit">Salvar</button>
                    </div>
                </form>
            <?php
                } else {
                    echo "<h5>Cópia não encontrada</h5>";
                }}
            ?>

 </div>
    </div>
</div>  