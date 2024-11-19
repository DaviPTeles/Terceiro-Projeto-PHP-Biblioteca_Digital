<div class="details">
    <div class="recentOrders">
        <div class="cardHeader">
            <h2>Editar Usuário</h2>
        </div>

        <?php
        if (isset($_GET['id'])) {
            $sql = "SELECT * FROM usuario INNER JOIN tipo_usuario ON usuario.tipo_usuario = tipo_usuario.id_tipo WHERE id=" . $_REQUEST['id'];
            $res = $conn->query($sql);
            $row = $res->fetch_object();
            if ($res->num_rows > 0) {
        ?>

        <div class="formulario">
                <form action="?page=salvar" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="acao" value="editar">
                    <input type="hidden" name="id" value="<?php print $row->id; ?>">

                    <div class="form-row">
                        <div class="form-column">
                        <label for="nome">Nome Completo</label>
                        <input type="text" name="nome" value="<?php print $row->nome . ' ' . $row->sobrenome; ?>">
                    
                        <label for="cpf">CPF</label>
                        <input type="number" name="cpf" value="<?php print $row->cpf; ?>">
                    
                        <label for="email">E-mail</label>
                        <input type="email" name="email" value="<?php print $row->email; ?>">
                    
                        <label for="senha">Senha</label>
                        <input type="password" name="senha">
                    
                        <label for="data_nasc">Data de Nascimento</label>
                        <input type="date" name="data_nasc" value="<?php print $row->data_nasc; ?>">
                    </div>

                    <div class="form-column">
                        <label for="telefone">Telefone</label>
                        <input type="number" name="telefone" value="<?php print $row->telefone; ?>">
                    
                        <label for="tipo_usuario">Tipo de Usuário</label>
                        <select name="tipo_usuario" required>
                            <?php
                            include('config.php');
                            $sql = "SELECT * FROM tipo_usuario";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row_tipo = $result->fetch_assoc()) {
                                    echo "<option value='{$row_tipo['id_tipo']}' " . ($row_tipo['id_tipo'] == $row->tipo_usuario ? 'selected' : '') . ">{$row_tipo['nome_usuario']}</option>";
                                }
                            } else {
                                echo "<option value=''>Nenhum tipo de usuário disponível</option>";
                            }
                            $conn->close();
                            ?>
                        </select>
                    
                        <label for="imagem">Nova Imagem</label>
                        <input type="file" name="imagem">

                        <label>Imagem Atual</label>
                        <p>
                            <img src="<?php echo $row->imagem; ?>" alt="Imagem do usuário" style="width:100px; height:auto;">
                        </p>
                    </div>
                </div>  

                    <div>
                        <button type="submit">Enviar</button>
                    </div>
                </form>
            <?php
                } else {
                    echo "<h5>Usuário não encontrado</h5>";
                }
            }
            ?>
        </div>
    </div>
</div>