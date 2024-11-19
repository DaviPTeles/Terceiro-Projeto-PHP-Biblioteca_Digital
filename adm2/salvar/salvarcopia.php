<?php 


switch ($_REQUEST["acao"]) {
    case "cadastrar":
        $livro_id = mysqli_real_escape_string($conn, trim($_POST['livro_id']));
        $status_id = 1; // Definido como 'Disponível'
        $data_aquisicao = mysqli_real_escape_string($conn, trim($_POST['data_aquisicao']));
        $edicao = mysqli_real_escape_string($conn, trim($_POST['edicao']));
        $localizacao = mysqli_real_escape_string($conn, trim($_POST['localizacao']));
    
        if (empty($livro_id) || empty($status_id) || empty($data_aquisicao)) {
            $_SESSION['mensagem'] = 'Cópia não foi criada. Preencha todos os campos obrigatórios.';
            header('Location: index.php?page=adicionar_copia');
            exit;
        } 
    
        // Inserir a nova cópia
        $sql = "INSERT INTO copia_livro (livro_id, status_id, data_aquisicao, edicao, localizacao) 
                VALUES ('$livro_id', '$status_id', '$data_aquisicao', '$edicao', '$localizacao')";
        
        $res = $conn->query($sql);
    
        if ($res) {
            // Contar as cópias com status_id = 1
            $sql_count = "SELECT COUNT(*) AS total_copias FROM copia_livro WHERE livro_id = '$livro_id' AND status_id = 1";
            $result_count = $conn->query($sql_count);
            $row_count = $result_count->fetch_assoc();
            $quantidade_copias = $row_count['total_copias'];
    
            // Atualizar a quantidade na tabela 'livro'
            $sql_update = "UPDATE livro SET quantidade = '$quantidade_copias' WHERE idlivro = '$livro_id'";
            $conn->query($sql_update);
    
            $_SESSION['mensagem'] = 'Cópia criada com sucesso e quantidade do livro atualizada.';
        } else {
            $_SESSION['mensagem'] = 'Erro ao criar cópia: ' . $conn->error;
        }
        
        header('Location: index.php?page=listarLivro'); // Redireciona para a lista de cópias
        exit;
        break;
    
        case "editar":
            $copia_id = mysqli_real_escape_string($conn, $_POST['id']);
            $livro_id = mysqli_real_escape_string($conn, trim($_POST['livro_id']));
            $status_id = 1; // Definido como 'Disponível'
            $data_aquisicao = mysqli_real_escape_string($conn, trim($_POST['data_aquisicao']));
            $edicao = mysqli_real_escape_string($conn, trim($_POST['edicao']));
            $localizacao = mysqli_real_escape_string($conn, trim($_POST['localizacao']));
        
            // Obter o livro_id atual da cópia
            $sql_get_livro = "SELECT livro_id FROM copia_livro WHERE id = '$copia_id'";
            $res_get_livro = $conn->query($sql_get_livro);
        
            if ($res_get_livro && $res_get_livro->num_rows > 0) {
                $row = $res_get_livro->fetch_assoc();
                $livro_atual_id = $row['livro_id'];
        
                // Atualizar a cópia
                $sql = "UPDATE copia_livro SET 
                            livro_id = '$livro_id', 
                            status_id = '$status_id', 
                            data_aquisicao = '$data_aquisicao', 
                            edicao = '$edicao', 
                            localizacao = '$localizacao' 
                        WHERE id = '$copia_id'";
        
                $res = $conn->query($sql);
                
                if ($res) {
                    // Contar as cópias com status_id = 1 para o livro_id atualizado
                    $sql_count = "SELECT COUNT(*) AS total_copias FROM copia_livro WHERE livro_id = '$livro_id' AND status_id = 1";
                    $result_count = $conn->query($sql_count);
                    $row_count = $result_count->fetch_assoc();
                    $quantidade_copias = $row_count['total_copias'];
        
                    // Atualizar a quantidade na tabela 'livro'
                    $sql_update = "UPDATE livro SET quantidade = '$quantidade_copias' WHERE idlivro = '$livro_id'";
                    $conn->query($sql_update);
        
                    $_SESSION['mensagem'] = 'Cópia atualizada com sucesso e quantidade do livro ajustada.';
                } else {
                    $_SESSION['mensagem'] = 'Não foi possível atualizar a cópia: ' . $conn->error;
                }
            } else {
                $_SESSION['mensagem'] = 'Cópia não encontrada.';
            }
        
            header('Location: index.php?page=listarLivro');
            exit;
        

    
        case "excluir":
            $copia_id = mysqli_real_escape_string($conn, $_REQUEST['id']);
            // Recuperar o livro_id da cópia antes de excluí-la
            $sql_get_livro = "SELECT livro_id FROM copia_livro WHERE id = '$copia_id'";
            $res_get_livro = $conn->query($sql_get_livro);
            if ($res_get_livro && $res_get_livro->num_rows > 0) {
                $row = $res_get_livro->fetch_assoc();
                $livro_id = $row['livro_id'];
        
                // Excluir a cópia
                $sql = "DELETE FROM copia_livro WHERE id = '$copia_id'";
                $res = $conn->query($sql);
                if ($res) {
                    // Contar as cópias restantes com status_id = 1 para o livro_id
                    $sql_count = "SELECT COUNT(*) AS total_copias FROM copia_livro WHERE livro_id = '$livro_id' AND status_id = 1";
                    $result_count = $conn->query($sql_count);
                    $row_count = $result_count->fetch_assoc();
                    $quantidade_copias = $row_count['total_copias'];
        
                    // Atualizar a quantidade na tabela 'livro'
                    $sql_update = "UPDATE livro SET quantidade = '$quantidade_copias' WHERE idlivro = '$livro_id'";
                    $conn->query($sql_update);
        
                    $_SESSION['mensagem'] = 'Cópia excluída com sucesso e quantidade do livro ajustada.';
                } else {
                    $_SESSION['mensagem'] = 'Não foi possível excluir a cópia: ' . $conn->error;
                }
            } else {
                $_SESSION['mensagem'] = 'Cópia não encontrada ou já foi excluída.';
            }
        
            header('Location: index.php?page=listarLivro');
            exit;
        
            break;
            
}

?>
