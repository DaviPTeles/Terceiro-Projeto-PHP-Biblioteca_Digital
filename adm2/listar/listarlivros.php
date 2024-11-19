
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<style>
    /* Estilo do Filtro */

/* Estilo do Filtro */
.filter {
    display: flex;
    align-items: center;
    margin-top: 15px;
    gap: 10px; /* Espaçamento entre os elementos */
}

/* Container do Input */
.input-container {
   
    position: relative;
    flex-grow: 1; /* Faz o input ocupar o espaço disponível */
}

/* Campo de Entrada */
#filterInput {
    width: 100%;
    padding: 10px 40px 10px 10px; /* Espaçamento para o ícone */
    border: 1px solid #ccc;
    border-radius: 10rem;
    transition: border-color 0.3s;
    font-size: 16px; /* Tamanho da fonte */
}

#filterInput:focus {
    border-color: #007BFF;
    outline: none;
}

/* Estilo do Ícone */
.input-container i {
    position: absolute;
    right: 15px; 
    top: 37%;
    transform: translateY(-50%);
    color: #aaa; 
    pointer-events: none; 
}

.uni-des {
    margin-top: -12px;
    background-color: #28a745;
    border: none;
    border-radius: 10rem;
    color: white;
    cursor: pointer;
    padding: 10px 12px;
    transition: background-color 0.3s, transform 0.2s;
    font-size: 16px; 
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.btn-unidades-desativadas:hover {
    background-color: #218838; 
    transform: translateY(-2px); 
}

.btn-unidades-desativadas:active {
    transform: translateY(0);
}


</style>


<main class="table">
    <section class="table__header">
    <h1>Lista de Livros</h1>
    <div class='filter'>
        <div class="input-container">
            <input type='text' id='filterInput' placeholder='Digite aqui' onkeyup='filterFunction()'>
            <i class="fas fa-search"></i>
        </div>
        <button class="uni-des" onclick="location.href='index.php?page=listarcopiasdesativadas'">Unidades Desativadas</button>
    </div>
</section>


    <section class="table__body">
        <?php
            $sql1 = "SELECT * FROM livro
                      INNER JOIN autor ON livro.autor_id = autor.id
                      INNER JOIN genero ON livro.genero_id = genero.id";
            $res  = $conn->query($sql1);
            $qtd = $res->num_rows;
            include('mensagem.php');

            if ($qtd > 0) {

                print "<table id='resultTable'>";
                print "<thead>";
                print "<tr>";
                print "<th>Código</th>";
                print "<th>Título</th>";
                print "<th>Autor</th>";
                print "<th>Gênero</th>";
                print "<th>Quantidade</th>";
                print "<th>Disponibilidade</th>";
                print "<th>Ações</th>";
                print "</tr>";
                print "</thead>";
                print "<tbody>";

                while ($row = $res->fetch_object()) {
                    echo "<tr>";
                    echo "<td>" . $row->idlivro . "</td>";
                    echo "<td>" . $row->titulo . "</td>";
                    echo "<td>" . $row->nome . "</td>";
                    echo "<td>" . $row->descricao . "</td>";
                    echo "<td>" . $row->quantidade . "</td>";
                    echo "<td>" . $row->disponibilidade . "</td>";
                    echo "<td>
                        <button onclick=\"location.href='?page=visualizarlivro&id=" .$row->idlivro. "';\" class='btn view'>Visualizar</button>
                        <button onclick=\"location.href='?page=editarlivro&id=" .$row->idlivro."';\" class='btn edit'>Editar</button>
                        <button onclick=\"location.href='?page=listarunidades&id=" . $row->idlivro . "';\" class='btn delete'>Unidades</button>
                    </td>";
                    echo "</tr>";
                }

                print "</tbody>";
                print "</table>";
            } else {
                print "<p class='alert'> Não encontrou resultados!</p>";
            }

            $conn->close();
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
