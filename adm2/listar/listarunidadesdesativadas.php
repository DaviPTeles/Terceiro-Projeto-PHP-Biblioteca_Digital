<main class="table">
    <section class="table__header">
        <h1>Lista de Unidades Desativadas</h1>
        <div class='filter'>
            <input type='text' id='filterInput' placeholder='Digite aqui' onkeyup='filterFunction()'>
        </div>
    </section>

    <section class="table__body">
    <?php  
    include('mensagem.php');
    // Define o estado para desativado
    $estado = 3; // O ID do status "desativado"

    // Consulta para pegar todas as cópias desativadas
    $sql = "SELECT copia_livro.*, livro.titulo, status_livro.descricao AS status 
            FROM copia_livro 
            INNER JOIN livro ON copia_livro.livro_id = livro.idlivro 
            INNER JOIN status_livro ON copia_livro.status_id = status_livro.id 
            WHERE copia_livro.status_id = '$estado' 
            ORDER BY copia_livro.id";
    
    $res = $conn->query($sql);
    
    if (!$res) {
        die("Erro na consulta: " . $conn->error);
    }
    
    if ($res->num_rows > 0) {
        echo "<table id='resultTable' border='1' cellspacing='0' cellpadding='10'>";
        echo "<tr>
                <th>ID</th>
                <th>Título</th>
                <th>Data de Aquisição</th>
                <th>Ações</th>
            </tr>";
        
        while ($row = $res->fetch_object()) {
            echo "<tr>
                    <td>{$row->id}</td>
                    <td>{$row->titulo}</td>
                    <td>{$row->data_aquisicao}</td>
                    <td>
                        <button onclick=\"if(confirm('Tem certeza que deseja ativar esta cópia?')){location.href='?page=salvarcopia&acao=ativar&id=".$row->id."';}\">Ativar</button>
                    </td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "<h5>Não há cópias desativadas.</h5>";
    }
    ?>
    </section>
</main>

<script>
function filterFunction() {
    const input = document.getElementById('filterInput');
    const filter = input.value.toLowerCase();
    const table = document.getElementById('resultTable');
    const rows = table.getElementsByTagName('tr');

    for (let i = 1; i < rows.length; i++) { // Começa do 1 para ignorar o cabeçalho
        const cells = rows[i].getElementsByTagName('td');
        let found = false;

        for (let j = 0; j < cells.length; j++) { // Verifica todas as colunas
            const cellValue = cells[j].textContent || cells[j].innerText;
            if (cellValue.toLowerCase().indexOf(filter) > -1) {
                found = true;
                break;
            }
        }

        rows[i].style.display = found ? '' : 'none'; // Mostra ou esconde a linha
    }
}
</script>

