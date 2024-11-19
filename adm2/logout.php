<?PHP
    session_start();
    unset($_SESSION["email"]);
    unset($_SESSION["nome"]);
    unset($_SESSION["cpf"]);
    unset($_SESSION["imagem"]);
    unset($_SESSION["tipo"]);
    session_destroy();
    header("location: ../index.php");
    exit;
?>