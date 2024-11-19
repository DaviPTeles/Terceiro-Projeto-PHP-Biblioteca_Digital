<main class="table">
    <section class="table__header">
        <h1>Lista de Empréstimos</h1>
    </section>

    <section class="table__body">
        <?php 
            $sqlUpdate = "UPDATE emprestimo 
                          SET status = 'atrasado' 
                          WHERE status = 'pendente' AND dataprevista < CURDATE()";
            $conn->query($sqlUpdate);

            $sql1 = "SELECT e.emprestimoid, e.inicio, e.dataprevista, e.status, 
                    l.titulo, u.nome, u.sobrenome 
                    FROM emprestimo e 
                    INNER JOIN copia_livro cl ON e.idlivro = cl.id 
                    INNER JOIN livro l ON cl.livro_id = l.idlivro
                    INNER JOIN usuario u ON e.usuario = u.cpf 
                    ORDER BY e.emprestimoid";

            $res = $conn->query($sql1);
            $qtd = $res->num_rows;

            include('mensagem.php');

            if ($qtd > 0) {
                print "<table>";
                print "<tr>";
                print "<th>ID</th>";
                print "<th>Livro</th>";
                print "<th>Usuário</th>";
                print "<th>Data de Início</th>";
                print "<th>Data Prevista</th>";
                print "<th>Status</th>";
                print "<th>Ações</th>";
                print "</tr>";
                
                while ($row = $res->fetch_object()) {
                    print "<tr>";
                    print "<td>".$row->emprestimoid."</td>";
                    print "<td>".$row->titulo."</td>";
                    print "<td>".$row->nome." ".$row->sobrenome."</td>";
                    print "<td>".$row->inicio."</td>";
                    print "<td>".$row->dataprevista."</td>";
                    print "<td>".$row->status."</td>";
                    print "<td>
                            <button onclick=\"location.href='?page=visualizaremprestimo&id=".$row->emprestimoid."';\">Visualizar</button>
                            <button onclick=\"location.href='?page=editaremprestimo&id=".$row->emprestimoid."';\">Editar</button>
                            <button onclick=\"if(confirm('Tem certeza que deseja excluir?')){location.href='?page=salvaremprestimo&acao=excluir&id=".$row->emprestimoid."';}\">Excluir</button>
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
