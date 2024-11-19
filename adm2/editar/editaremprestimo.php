<div class="details">
    <div class="recentOrders">
        <div class="cardHeader">
            <h2>Editar Emprestimo</h2>
        </div>
            <?php 
                include('mensagem.php');
                if (isset($_GET['id'])) {
                    $sql = "SELECT e.*, l.titulo, u.nome, u.sobrenome 
                            FROM Emprestimo e 
                            INNER JOIN copia_livro cl ON e.idlivro = cl.id 
                            INNER JOIN livro l ON cl.livro_id = l.idlivro 
                            INNER JOIN usuario u ON e.usuario = u.cpf 
                            WHERE e.emprestimoid = ".$_REQUEST['id'];
                    
                    $res = $conn->query($sql);
                    $row = $res->fetch_object();
                    
                    if ($res->num_rows > 0) {
            ?>
            <div class="formulario">
                <form action="?page=salvaremprestimo" method="POST">
                    <input type="hidden" name="acao" value="editar">
                    <input type="hidden" name="id" value="<?php print $row->emprestimoid; ?>">
                    
                    <div class="form-row">
                        <div class="form-column">
                            <label for="idlivro">ID do Livro</label>
                            <input type="number" name="idlivro" value="<?php print $row->idlivro; ?>" required>
                        
                            <label for="usuario">Usuário (CPF)</label>
                            <input type="number" name="usuario" value="<?php print $row->usuario; ?>" required>
                       
                            <label for="inicio">Data de Início</label>
                            <input type="date" name="inicio" value="<?php print $row->inicio; ?>" required>
                        
                            <label for="dataprevista">Data Prevista de Devolução</label>
                            <input type="date" name="dataprevista" value="<?php print $row->dataprevista; ?>" required>
                       
                            <label for="datareal">Data Real de Devolução</label>
                            <input type="date" name="datareal" value="<?php print $row->datareal; ?>"> 
                        </div>
                    </div>
                        
                    <div>
                        <button type="submit">Enviar</button>
                    </div>
                </form>
            <?php
                } else {
                echo "<h5>Empréstimo não encontrado</h5>";
                    }
            }
            ?>

        </div>
        
    </div>

</div>