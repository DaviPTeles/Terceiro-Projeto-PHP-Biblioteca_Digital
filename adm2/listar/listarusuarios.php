<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<?php 
// Verifica se o switch foi ativado via GET
$status = 'ativado'; // Define o status padrão

if (isset($_GET['status']) && $_GET['status'] === 'desativado') {
    $status = 'desativado';
}
?>

<main class="table">
    <section class="table__header">
        <h1>Lista de Usuarios</h1>

        <div class='filter'>
            <input type="checkbox" id="toggleSwitch" onchange="toggleDesativados()" <?php echo ($status === 'desativado') ? 'checked' : ''; ?> />
            <label for="toggleSwitch" class="switch-label">Estado: <?php echo $status; ?></label>
            <div class="input-container">
                <input type='text' id='filterInput' placeholder='Digite aqui' onkeyup='filterFunction()'>
                <i class="fas fa-search"></i>
            </div>
            
    </div>
    
    </section>

    

<section class="table__body">
        <?php 
       
        $sql1 = "SELECT * FROM usuario INNER JOIN tipo_usuario 
                WHERE usuario.tipo_usuario = tipo_usuario.id_tipo AND status = '$status' 
                ORDER BY id";

        $res  = $conn->query($sql1);
        $qtd = $res->num_rows;

        include('mensagem.php');

        if($qtd > 0){
            print "<table id='resultTable' ";
            print "<tr>";
            print "<th>ID</th>";
            print "<th>Nome Completo</th>";
            print "<th>E-mail</th>";
            print "<th>Tipo de Usuário</th>";
            print "<th>Ações</th>";
            print "</tr>";
            while($row = $res->fetch_object()) {
                print "<tr>";
                print "<td>".$row->id."</td>";
                print "<td>".$row->nome." ".$row->sobrenome."</td>";
                print "<td>".$row->email."</td>";
                print "<td>".$row->nome_usuario."</td>";
                print "<td>
                        <button onclick=\"location.href='?page=visualizar&id=".$row->id."';\">Visualizar</button>
                        <button onclick=\"location.href='?page=editar&id=".$row->id."';\">Editar</button>
                        <button onclick=\"toggleUser(".$row->id.", '".$row->status."')\">".($row->status === 'ativado' ? 'Desativar' : 'Ativar')."</button>
                    </td>";
                print "</tr>";
            }
            print "</table>";
        } else {
            print "<p>Não encontrou resultados!</p>";
        }
        ?>

</section>

</main>


<style>
/* Estilo do Filtro */
.filter {
    display: flex;
    align-items: center;
    gap: 15px; /* Espaçamento entre os elementos */
    margin-top: 10px;
}

/* Estilo do Toggle Switch */
#toggleSwitch {
    display: none; /* Esconde o checkbox padrão */
}

.switch-label {
    position: relative;
    padding-left: 40px; /* Espaço para o switch */
    cursor: pointer;
    font-size: 16px; /* Tamanho da fonte */
    color: #333; /* Cor do texto */
}

/* Estilo do Switch */
.switch-label:before {
    content: '';
    position: absolute;
    left: 0;
    top: 50%;
    transform: translateY(-50%);
    width: 34px; /* Largura do switch */
    height: 20px; /* Altura do switch */
    background-color: #ccc; /* Cor de fundo do switch */
    border-radius: 10px; /* Cantos arredondados */
    transition: background-color 0.3s;
}

#toggleSwitch:checked + .switch-label:before {
    background-color: #28a745; /* Cor quando ativado */
}

/* Estilo do botão de ativação */
#toggleSwitch:checked + .switch-label:after {
    content: '';
    position: absolute;
    left: 10px; /* Largura do botão do switch */
    top: 50%;
    transform: translateY(-50%);
    width: 18px; /* Largura do botão */
    height: 18px; /* Altura do botão */
    background-color: white; /* Cor do botão */
    border-radius: 50%; /* Forma circular */
    transition: left 0.3s;
}

#toggleSwitch:checked + .switch-label:after {
    left: 22px; /* Move o botão para a direita quando ativado */
}

/* Container do Input */
.input-container {
    position: relative;
    flex-grow: 1; /* Faz o input ocupar o espaço disponível */
}

/* Estilo do Campo de Entrada */
#filterInput {
    width: 100%;
    padding: 10px 40px 10px 10px; /* Espaçamento interno */
    border: 1px solid #ccc; /* Borda padrão */
    border-radius: 4px; /* Cantos arredondados */
    font-size: 16px; /* Tamanho da fonte */
    transition: border-color 0.3s; /* Efeito de transição */
}

#filterInput:focus {
    border-color: #007BFF; /* Cor da borda ao focar */
    outline: none; /* Remove a borda padrão */
}

/* Estilo do Ícone */
.input-container i {
    position: absolute;
    right: 10px; /* Posiciona o ícone à direita */
    top: 50%;
    transform: translateY(-50%);
    color: #aaa; /* Cor do ícone */
    pointer-events: none; /* Para que o clique no ícone não atrapalhe a entrada */
}

</style>

<script>
function filterFunction() {
    const input = document.getElementById('filterInput');
    const filter = input.value.toLowerCase();
    const table = document.getElementById('resultTable');
    const rows = table.getElementsByTagName('tr');

    for (let i = 1; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName('td');
        let found = false;

        for (let j = 0; j < cells.length; j++) {
            const cellValue = cells[j].textContent || cells[j].innerText;
            if (cellValue.toLowerCase().indexOf(filter) > -1) {
                found = true;
                break;
            }
        }

        rows[i].style.display = found ? '' : 'none';
    }
}

function toggleDesativados() {
    const isChecked = document.getElementById('toggleSwitch').checked;
    const status = isChecked ? 'desativado' : 'ativado';
    
    // Atualiza a URL com o status
    window.location.href = `?page=listar&status=${status}`;
}

function toggleUser(userId, currentStatus) {
    const newStatus = currentStatus === 'ativado' ? 'desativado' : 'ativado';
    const action = newStatus === 'desativado' ? 'excluir' : 'ativar';

    if (confirm(`Tem certeza que deseja ${action === 'excluir' ? 'desativar' : 'ativar'} este usuário?`)) {
        location.href = `?page=salvar&acao=${action}&id=${userId}`;
    }
}
</script>
