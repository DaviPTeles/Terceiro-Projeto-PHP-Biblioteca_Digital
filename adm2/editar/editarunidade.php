<div class="details">
    <div class="recentOrders">
        <div class="cardHeader">
            <h2>Editar Copia do Livro</h2>
        </div>

            <?php 
            if (isset($_GET['id'])) {
                $copia_id = mysqli_real_escape_string($conn, $_GET['id']);
                
                $sql = "SELECT cl.*, l.titulo 
                        FROM copia_livro cl 
                        INNER JOIN livro l ON cl.livro_id = l.idlivro 
                        WHERE cl.id = '$copia_id'";
                
                $res = $conn->query($sql);
                
                if ($res && $res->num_rows > 0) {
                    $row = $res->fetch_object();
            ?>
            <div class="formulario">
                <form action="?page=salvarcopia" method="POST">
                    <input type="hidden" name="acao" value="editar">
                    <input type="hidden" name="id" value="<?php print $row->id; ?>">
                        
                    <div class="form-row">
                        <div class="form-column">
                            <label for="livro_id">ID do Livro</label>
                            <input type="number" name="livro_id" value="<?php print $row->livro_id; ?>" required>
                        
                            <label for="data_aquisicao">Data de Aquisição</label>
                            <input type="date" name="data_aquisicao" value="<?php print date('Y-m-d', strtotime($row->data_aquisicao)); ?>" required>
                                                        <label for="edicao">Edição</label>
                            <input type="text" name="edicao" value="<?php print $row->edicao; ?>" required>
                        
                            <label for="localizacao">Localização</label>
                            <input type="text" name="localizacao" value="<?php print $row->localizacao; ?>" required>
                        </div>
                    </div>

                    
                    <div>
                        <button type="submit">Enviar</button>
                    </div>
                </form>
            <?php
                } else {
                    echo "<h5>Cópia do livro não encontrada</h5>";
                }
            }
            ?>
        </div>
    </div>
</div>