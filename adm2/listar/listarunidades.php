<main class="table">
    <section class="table__header">
        <h1>Lista de Unidades</h1>
        <div class='filter'>
             <input type='text' id='filterInput' placeholder='Digite aqui' onkeyup='filterFunction()'>
        </div>
    </section>

    <section class="table__body">
    <?php 
    if (isset($_GET['id'])) {
        // Escape the book ID to prevent SQL injection
        $livro_id = mysqli_real_escape_string($conn, $_GET['id']);
        
        $sql = "SELECT copia_livro.*, livro.titulo, status_livro.descricao AS status 
                FROM copia_livro 
                INNER JOIN livro ON copia_livro.livro_id = livro.idlivro 
                INNER JOIN status_livro ON copia_livro.status_id = status_livro.id 
                WHERE copia_livro.livro_id = '$livro_id' AND copia_livro.status_id != 3  -- Exclui as cópias desativadas
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
                    <th>Status</th>
                    <th>Data de Aquisição</th>
                    <th>Ações</th>
                </tr>";
            
            while ($row = $res->fetch_object()) {
                echo "<tr>
                        <td>{$row->id}</td>
                        <td>{$row->titulo}</td>
                        <td>{$row->status}</td>
                        <td>{$row->data_aquisicao}</td>
                        <td>
                            <button onclick=\"location.href='?page=visualizarunidade&id=" .$row->id. "';\" class='btn view'>Visualizar</button>
                            <button onclick=\"location.href='?page=editarunidade&id=" .$row->id."';\" class='btn edit'>Editar</button>
                            <button onclick=\"if(confirm('Têm certeza que deseja desativar?')){location.href='?page=salvarcopia&acao=desativar&id=".$row->id."';}\">Desativar</button>
                        </td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "<h5>Esse livro não contém unidades disponíveis.</h5>";
        }
    } else {
        echo "<h5>ID do livro não especificado.</h5>";
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
