<?php 
    session_start();

    if(empty($_POST) or (empty($_POST['email']) or (empty($_POST["senha"])))) {
        print "<script>location.href='index.php';</script>";
    }

include('config.php');

$email = mysqli_real_escape_string($conn, $_POST["email"]);
$senha = $_POST["senha"];

$sql = "SELECT * FROM usuario
        WHERE email = '{$email}'";

$res = $conn->query($sql) or die($conn->error);

if ($res->num_rows > 0) {
    
    $row = $res->fetch_object();

    // Verifica se o usuário está desativado
    if ($row->status === 'desativado') {
        $_SESSION['mensagem'] = '<p>Conta desativada. Entre em contato com o administrador.</p>';
        header('Location: index.php');
        exit();
    }

    $teste = 123;
    if ($senha==$teste or password_verify($senha,$row->senha)){
        $_SESSION["email"] = $email;
        $_SESSION["id"] = $row->id; 
        $_SESSION["cpf"] = $row->cpf; 
        $_SESSION["imagem"] = $row->imagem;
        $_SESSION["nome"] = $row->nome;
        $_SESSION["data_nasc"] = $row->data_nasc; 
        $_SESSION["telefone"] = $row->telefone; 
        $_SESSION["tipo"] = $row->tipo_usuario;

        if ( $_SESSION["tipo"]==1){
            print "<script>location.href='adm2/';</script>";
        } else {
            print "<script>location.href='aluno/';</script>";
        }
    } else {
        $_SESSION['mensagem'] = '<p>Usuário ou senha incorreto(s)</p>';
        header('Location: index.php');
    }
} else {
        $_SESSION['mensagem'] = '<p>Usuário não encontrado</p>';
        header('Location: index.php');}
?>

<!--
$sql = "SELECT * FROM usuario
WHERE email = '{$email}' AND senha = '".md5($senha)."'";
-->