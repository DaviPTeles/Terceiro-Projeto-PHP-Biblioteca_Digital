<div class="details">
    <div class="recentOrders">
        <div class="cardHeader">
            <h2>Novo(a) Usuário(a)</h2>
        </div>

        <div class="formulario">
            <form action="?page=salvar" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="acao" value="cadastrar">

                <div class="form-row">
                    <div class="form-column">
                        <label for="nome">Nome</label>
                        <input type="text" name="nome" id="nome" required>

                        <label for="cpf">CPF</label>
                        <input type="text" name="cpf" id="cpf" oninput="formatCpf(this)" required placeholder="xxx.xxx.xxx-xx">

                        <label for="email">E-mail</label>
                        <input type="email" name="email" id="email" required>

                        <label for="senha">Senha</label>
                        <input type="password" name="senha" id="senha" required>

                        <label for="telefone">Telefone</label>
                        <input type="text" name="telefone" id="telefone" oninput="formatTelefone(this)" required placeholder="(xx) xxxxx-xxxx">
                    </div>

                    <div class="form-column">
                        <label for="data_nasc">Data de Nascimento</label>
                        <input type="date" name="data_nasc" id="data_nasc">
                    
                        <label for="tipo_usuario">Tipo de Usuário</label>
                        <select name="tipo_usuario" id="tipo_usuario" required>
                            <?php
                            include('config.php');
                            $sql = "SELECT * FROM tipo_usuario";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='{$row['id_tipo']}'>{$row['nome_usuario']}</option>";
                                }
                            } else {
                                echo "<option value=''>Nenhum tipo de usuário disponível</option>";
                            }
                            $conn->close();
                            ?>
                        </select>

                        <label for="imagem">Foto do Usuário</label>
                        <input type="file" name="imagem" id="imagem">
                    </div>
                </div>

                <button type="submit">Enviar</button>
            </form>
        </div>
    </div>
</div>

<script>
function formatCpf(input) {
    // Remove tudo que não é dígito
    let value = input.value.replace(/\D/g, '');
    
    // Aplica a máscara
    if (value.length <= 11) {
        value = value.replace(/(\d{3})(\d)/, '$1.$2'); // XXX.XXX
        value = value.replace(/(\d{3})(\d)/, '$1.$2'); // XXX.XXX
        value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2'); // XXX.XXX-XX
    }
    
    input.value = value;
}

function formatTelefone(input) {
    // Remove tudo que não é dígito
    let value = input.value.replace(/\D/g, '');

    // Aplica a máscara
    if (value.length <= 11) {
        value = value.replace(/(\d{2})(\d)/, '($1) $2'); // (XX) X
        value = value.replace(/(\(\d{2}\)) (\d)(\d{4})(\d{1,4})?/, '$1 $2$3-$4'); // (XX) XXXX-XXXX
    }

    input.value = value;
}
</script>
