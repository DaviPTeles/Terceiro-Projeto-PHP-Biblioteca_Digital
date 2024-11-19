<?php 
switch($_REQUEST['acao']){
    case 'salvareditora':
        $nome = mysqli_real_escape_string($conn, trim($_POST['nome']));
        if (empty($nome)) {
            $_SESSION['mensagem'] = 'Editora não foi criada';
            header('Location: index.php?page=novolivro');
            exit;
        } 
        $sql = "INSERT INTO editora (nome) VALUES ('{$nome}')";
        
        $res = $conn->query($sql);
    
        $_SESSION['mensagem'] = 'Editora criada com sucesso';
        header('Location: index.php?page=novolivro');
        exit;
        break;
    case 'salvargenero':
        $nome = mysqli_real_escape_string($conn, trim($_POST['nome']));
        if (empty($nome)) {
            $_SESSION['mensagem'] = 'Gênero não foi criado';
            header('Location: index.php?page=novolivro');
            exit;
        } 
        $sql = "INSERT INTO genero (descricao) VALUES ('{$nome}')";
        
        $res = $conn->query($sql);
    
        $_SESSION['mensagem'] = 'Gênero criado com sucesso';
        header('Location: index.php?page=novolivro');
        exit;
        break;
    case 'salvarautor':
        $nome = mysqli_real_escape_string($conn, trim($_POST['nome']));
        $nacionalidade = mysqli_real_escape_string($conn, trim($_POST['nacionalidade']));
        $data_nasc = mysqli_real_escape_string($conn, trim($_POST['data_nasc']));
        $bio = mysqli_real_escape_string($conn, trim($_POST['bio']));
        if (empty($nome)) {
            $_SESSION['mensagem'] = 'Autor(a) não foi criado(a)';
            header('Location: index.php?page=novolivro');
            exit;
        } 
        $sql = "INSERT INTO autor (nome, nacionalidade, data_nascimento, biografia) VALUES ('{$nome}', '{$nacionalidade}','{$data_nasc}','{$bio}')";
        
        $res = $conn->query($sql);
    
        $_SESSION['mensagem'] = 'Autor(a) criado(a) com sucesso';
        header('Location: index.php?page=novolivro');
        exit;
        break;
    case 'cadastrar':
        $titulo = mysqli_real_escape_string($conn, trim($_POST['titulo']));
        $isbn = mysqli_real_escape_string($conn, trim($_POST['isbn']));
        $genero = mysqli_real_escape_string($conn, trim($_POST['genero']));
        $autor = mysqli_real_escape_string($conn, trim($_POST['autor']));
        $editora = mysqli_real_escape_string($conn, trim($_POST['editora']));
        $paginas = mysqli_real_escape_string($conn, trim($_POST['paginas']));
        $idioma = mysqli_real_escape_string($conn, trim($_POST['idioma']));
        $ano_pub = mysqli_real_escape_string($conn, trim($_POST['ano_pub']));
        $data_aqui = mysqli_real_escape_string($conn, trim($_POST['data_aqui']));
        $edicao = mysqli_real_escape_string($conn, trim($_POST['edicao']));
        //$localizacao = mysqli_real_escape_string($conn, trim($_POST['localizacao']));
        $quant_copia = mysqli_real_escape_string($conn, 1);
        $disponibilidade = mysqli_real_escape_string($conn, "Disponível");

        $imagem = "capa/". $_FILES["imagem"]["name"];
        move_uploaded_file($_FILES["imagem"]["tmp_name"],$imagem);

        if (empty($titulo||$genero||$idioma||$isbn)) {
            $_SESSION['mensagem'] = 'O livro não foi adicionado)';
            header('Location: index.php?page=listarLivro');
            exit;
        } 
        $conn->begin_transaction();
        try {

            $sqlLivro = "INSERT INTO livro (titulo, isbn, genero_id, autor_id, editora_id, paginas, idioma, ano_publicacao,imagem) VALUES   (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmtLivro = $conn->prepare($sqlLivro);
            $stmtLivro->bind_param("ssiiiisss", $titulo, $isbn, $genero, $autor, $editora, $paginas, $idioma, $ano_pub, $imagem);
            $stmtLivro->execute();
            $livro_id = $conn->insert_id;
            $status_disponivel = 1; 
            $sqlCopia = "INSERT INTO copia_livro (livro_id, status_id, data_aquisicao, edicao, localizacao) VALUES (?, ?, ?, ?, ?)";
            $stmtCopia = $conn->prepare($sqlCopia);
            $stmtCopia->bind_param("iisss", $livro_id, $status_disponivel, $data_aqui, $edicao, $localizacao);
            $stmtCopia->execute();
            $sqlLivro2 = "UPDATE livro SET quantidade=?, disponibilidade =? WHERE idlivro = ?";
            $smtLivro2 = $conn->prepare($sqlLivro2);
            $smtLivro2->bind_param("isi",$quant_copia,$disponibilidade,$livro_id);
            $smtLivro2->execute();
            $conn->commit();
            $_SESSION['mensagem'] = 'Livro adicionado com sucesso.';
            header('Location: index.php?page=listarLivro');
            exit;
        } catch (Exception $e) {
            $conn->rollback();
            $_SESSION['mensagem'] = 'Erro ao adicionar o livro: ' . $e->getMessage();
            header('Location: index.php?page=listarLivro');
            exit;
        }
        break;

    case "editar":
        
        $idlivro = mysqli_real_escape_string($conn, trim($_POST['idlivro']));
        $titulo = mysqli_real_escape_string($conn, trim($_POST['titulo']));
        $isbn = mysqli_real_escape_string($conn, trim($_POST['isbn']));
        $genero = mysqli_real_escape_string($conn, trim($_POST['genero_id']));
        $autor = mysqli_real_escape_string($conn, trim($_POST['autor_id']));
        $editora = mysqli_real_escape_string($conn, trim($_POST['editora_id']));
        $paginas = mysqli_real_escape_string($conn, trim($_POST['paginas']));
        $idioma = mysqli_real_escape_string($conn, trim($_POST['idioma']));
        $ano_pub = mysqli_real_escape_string($conn, trim($_POST['ano_pub']));

        // Defina o diretório para salvar a imagem
        $diretorio_imagens = 'caminho/para/salvar/capa/';

        // Verifique se o diretório existe, se não, crie-o
        if (!is_dir($diretorio_imagens)) {
            mkdir($diretorio_imagens, 0755, true);
        }

        // Verifique se uma nova imagem foi enviada
        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == UPLOAD_ERR_OK) {
            $imagem_nome = basename($_FILES['imagem']['name']);
            $imagem_destino = $diretorio_imagens . $imagem_nome;

            // Mova a imagem para o diretório desejado
            if (move_uploaded_file($_FILES['imagem']['tmp_name'], $imagem_destino)) {
                // Atualize a consulta para incluir a nova imagem
                $sql = "UPDATE livro SET titulo = '$titulo', isbn = '$isbn', genero_id = '$genero', 
                    autor_id = '$autor', 
                    editora_id = '$editora', 
                    paginas = '$paginas', 
                    idioma = '$idioma', 
                    ano_publicacao = '$ano_pub', 
                    imagem = '$imagem_destino' 
                WHERE idlivro = '$idlivro'";
            } else {
                $_SESSION['mensagem'] = 'Erro ao fazer upload da imagem.';
                header('Location: index.php?page=listarLivro');
                exit;
            }
        } else {
            // Se nenhuma nova imagem foi enviada, não a inclua na consulta
            $sql = "UPDATE livro SET titulo = '$titulo', isbn = '$isbn', genero_id = '$genero', 
                autor_id = '$autor', 
                editora_id = '$editora', 
                paginas = '$paginas', 
                idioma = '$idioma', 
                ano_publicacao = '$ano_pub' 
            WHERE idlivro = '$idlivro'";
        }

        $res = $conn->query($sql);
        if ($res === true) {
            $_SESSION['mensagem'] = 'Livro atualizado com sucesso';
            header('Location: index.php?page=listarLivro');
        } else {
            $_SESSION['mensagem'] = 'Não foi possível atualizar o livro: ' . $conn->error;
            header('Location: index.php?page=listarLivro');
        }
        break;

    case "excluir":
        $sql = "DELETE FROM livro WHERE idlivro=".$_REQUEST['id'];
        $res = $conn->query($sql);
        if ($res ==true) {
            $_SESSION['mensagem'] = 'Usuário excluído com sucesso';
            header('Location: index.php?page=listarLivro');
        } else {
            $_SESSION['mensagem'] = 'Não foi possível excluir'. $conn->error;
            header('Location: index.php?page=listarLivro');
        }
        break;
    
}

?>