<?php 

switch ($_REQUEST["acao"]){
    case "cadastrar":
        $nome_completo = mysqli_real_escape_string($conn, trim($_POST['nome']));
        $partes = explode(' ', $nome_completo);
        $nome = array_shift($partes);
        $sobrenome = implode(' ', $partes);
        $email = mysqli_real_escape_string($conn, trim($_POST['email']));
        
        // Remover a máscara do CPF (pontos e traços)
        $cpf = preg_replace('/\D/', '', trim($_POST['cpf']));
    
        // Validação do CPF
        if (strlen($cpf) != 11) {
            $_SESSION['mensagem'] = 'CPF inválido. Deve conter exatamente 11 dígitos.';
            header('Location: index.php?page=listar');
            exit;
        }
    
        $data_nasc = mysqli_real_escape_string($conn, trim($_POST['data_nasc']));
        
        // Remover a máscara do telefone (parênteses, espaços e traços)
        $telefone = preg_replace('/\D/', '', trim($_POST["telefone"]));
        
        // Validação do telefone
        if (strlen($telefone) < 10 || strlen($telefone) > 11) {
            $_SESSION['mensagem'] = 'Telefone inválido. Deve conter entre 10 e 11 dígitos.';
            header('Location: index.php?page=listar');
            exit;
        }
    
        // Verifica se o número de CPF e telefone está dentro do limite
        if (strlen($cpf) > 11) {
            $_SESSION['mensagem'] = 'CPF não pode ter mais de 11 dígitos.';
            header('Location: index.php?page=listar');
            exit;
        }
    
        if (strlen($telefone) > 11) {
            $_SESSION['mensagem'] = 'Telefone não pode ter mais de 11 dígitos.';
            header('Location: index.php?page=listar');
            exit;
        }
    
        $imagem = "foto/" . $_FILES["imagem"]["name"];
        move_uploaded_file($_FILES["imagem"]["tmp_name"], $imagem);
    
        $tipo_usuario = mysqli_real_escape_string($conn, $_POST["tipo_usuario"]);
        $senha = isset($_POST['senha']) ? mysqli_real_escape_string($conn, password_hash(trim($_POST['senha']), PASSWORD_DEFAULT)) : '';
    
        if (empty($nome_completo) || empty($cpf) || empty($email) || empty($data_nasc) || empty($senha) || empty($telefone) || empty($tipo_usuario)) {
            $_SESSION['mensagem'] = 'Usuário não foi criado';
            header('Location: index.php?page=listar');
            exit;
        } 
    
        $sql = "INSERT INTO usuario (nome, sobrenome, cpf, email, senha, data_nasc, telefone, imagem, tipo_usuario) VALUES ('{$nome}', '{$sobrenome}', '{$cpf}', '{$email}', '{$senha}', '{$data_nasc}', '{$telefone}', '{$imagem}', '{$tipo_usuario}')";
        
        $res = $conn->query($sql);
    
        $_SESSION['mensagem'] = 'Usuário criado com sucesso';
        header('Location: index.php?page=listar');
        exit;
    
        break;
    
    
    case "editar":
        $usuario_id = mysqli_real_escape_string($conn, $_POST['id']);
        $nome_completo = mysqli_real_escape_string($conn, trim($_POST['nome']));
        $partes = explode(' ', $nome_completo);
        $nome = array_shift($partes);
        $sobrenome = implode(' ', $partes);
        $email = mysqli_real_escape_string($conn, trim($_POST['email']));
        $cpf = mysqli_real_escape_string($conn, trim($_POST['cpf']));
        $data_nascimento = mysqli_real_escape_string($conn, trim($_POST['data_nasc']));
        $telefone = mysqli_real_escape_string($conn, $_POST["telefone"]);
        $tipo_usuario = mysqli_real_escape_string($conn, $_POST["tipo_usuario"]);
        $senha = mysqli_real_escape_string($conn, trim($_POST['senha']));
        $imagem = null;
    if (!empty($_FILES['imagem']['name'])) {
        $imagem = "foto/". $_FILES["imagem"]["name"];
        move_uploaded_file($_FILES["imagem"]["tmp_name"], $imagem);
        // Atualiza a consulta para incluir a nova imagem
        $sql = "UPDATE usuario SET nome = '$nome', sobrenome = '$sobrenome', cpf = '$cpf', email = '$email', data_nasc = '$data_nascimento', telefone = '$telefone', tipo_usuario ='$tipo_usuario', imagem='$imagem' ";
    } else {
        // Se nenhuma nova imagem foi enviada, não atualize a coluna de imagem
        $sql = "UPDATE usuario SET nome = '$nome', sobrenome = '$sobrenome', cpf = '$cpf', email = '$email', data_nasc = '$data_nascimento', telefone = '$telefone', tipo_usuario ='$tipo_usuario' ";
    }
        if (!empty($senha)){
            $sql .= ", senha ='". password_hash($senha, PASSWORD_DEFAULT)."'";
        }

        $sql .=" WHERE id = '$usuario_id'";

        $res = $conn->query($sql);
        if ($res ==true) {
            $_SESSION['mensagem'] = 'Usuário atualizado com sucesso';
            header('Location: index.php?page=listar');
        } else {
            $_SESSION['mensagem'] = 'Não foi possível atualizar usuário';
            header('Location: index.php?page=listar');
        }
        break;
    case "excluir":
        $usuario_id = mysqli_real_escape_string($conn, $_REQUEST['id']);
        $sql = "UPDATE usuario SET status = 'desativado' WHERE id = $usuario_id";
        $res = $conn->query($sql);
        if ($res == true) {
            $_SESSION['mensagem'] = 'Usuário desativado com sucesso';
            header('Location: index.php?page=listar');
        } else {
            $_SESSION['mensagem'] = 'Não foi possível desativar o usuário';
            header('Location: index.php?page=listar');
        }
        break;
    case "ativar":
        $usuario_id = mysqli_real_escape_string($conn, $_REQUEST['id']);
        $sql = "UPDATE usuario SET status = 'ativado' WHERE id = $usuario_id";
        $res = $conn->query($sql);
        if ($res == true) {
            $_SESSION['mensagem'] = 'Usuário ativado com sucesso';
            header('Location: index.php?page=listar');
        } else {
            $_SESSION['mensagem'] = 'Não foi possível ativar o usuário';
            header('Location: index.php?page=listar');
        }
        break;

}

?>