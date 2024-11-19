<?php
session_start();
if(empty($_SESSION)){
    print "<script>location.href='../index.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/cxuse.css">
    <style>h1{text-align: center;}</style>
  </head>
  <body>
    <div class="container">
        <div class="navigation">

            <div>
                <ul>
                    <li>
                        <a href="#">
                            <span class="logo">
                                <img src="../img/logo.png" alt="">
                            <span class="title-b">Bibliotech</span>
                        </a>
                    </li>

                    <li>
                        <a href="index.php">
                            <span class="icon">
                                <ion-icon name="home-outline"></ion-icon>
                            </span>
                            <span class="title">Início</span>
                        </a>
                    </li>

                    <li>
                    <a href="?page=novo">
                        <span class="icon">
                            <ion-icon name="person-add-outline"></ion-icon>
                        </span>
                        <span class="title">Novo Usuário</span>
                    </a>
                </li>

                <li>
                    <a href="?page=listar">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Listar Usuários</span>
                    </a>
                </li>

                <li>
                    <a href="?page=novolivro">
                        <span class="icon">
                            <ion-icon name="book-outline"></ion-icon>
                        </span>
                        <span class="title">Novo Livro</span>
                    </a>
                </li>

                <li>
                    <a href="?page=listarLivro">
                        <span class="icon">
                            <ion-icon name="bookmarks-outline"></ion-icon>
                        </span>
                        <span class="title">Listar Livros</span>
                    </a>
                </li>

                <li>
                    <a href="?page=novoemprestimo">
                        <span class="icon">
                            <ion-icon name="arrow-redo-outline"></ion-icon>
                        </span>
                        <span class="title">Novo Empréstimo</span>
                    </a>
                </li>

                <li>
                    <a href="?page=listaremprestimo">
                        <span class="icon">
                            <ion-icon name="folder-outline"></ion-icon>
                        </span>
                        <span class="title">Listar Empréstimos</span>
                    </a>
                </li>
                </ul>
            </div>
 
        </div>

        <?php if (isset($_SESSION['nome'])): ?>
            <div class="user-box" id="userBox">
                <img src="<?php echo $_SESSION['imagem']; ?>" class="user-avatar" id="userAvatar">
                <div class="user-info" id="userInfo">
                    <span class="user-name"><?php echo $_SESSION['nome']; ?></span>
                    <a href="logout.php" class="logout">Sair</a>
                </div>
            </div>
            <?php else: ?>
            <div class="user-box" id="userBox">
                <a href="login.php" class="login">Login</a>
            </div>
        <?php endif; ?>

        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
            </div>

            <div>
                <?php
                include "config.php";
                switch (@$_REQUEST["page"]){
                    case "novo":
                        include("novo/novousuario.php");
                        break;
                    case "listar":
                        include("listar/listarusuarios.php");
                        break;
                    case "salvar":
                        include("salvar/salvarusuario.php");
                        break;
                    case "editar":
                        include("editar/editarusuario.php");
                        break;
                    case "editarlivro":
                        include("editar/editarlivro.php");
                        break;
                    case "visualizar":
                        include("visualizarusuario.php");
                        break;
                    case "visualizarlivro":
                        include("visualizarlivro.php");
                        break;
                    case "novolivro":
                        include("novo/novolivro.php");
                        break;
                    case "novacopia":
                        include("novo/novacopia.php");
                        break;
                    case "salvarlivro":
                        include("salvar/salvarlivro.php");
                        break;
                    case "listarLivro":
                        include("listar/listarlivros.php");
                        break;
                    case "novaeditora":
                        include("novo/novaeditora.php");
                        break;
                    case "novogenero":
                        include("novo/novogenero.php");
                        break;
                    case "novoautor":
                        include("novo/novoautor.php");
                        break;
                    case "novoemprestimo":
                        include("novo/novoemprestimo.php");
                        break;
                    case "salvaremprestimo":
                        include("salvar/salvaremprestimo.php");
                        break;
                    case "listaremprestimo":
                        include("listar/listaremprestimo.php");
                        break;
                    case "editaremprestimo":
                        include("editar/editaremprestimo.php");
                        break;
                    case "visualizaremprestimo":
                        include("visualizaremprestimo.php");
                        break;
                    case "listarunidades":
                        include("listar/listarunidades.php");
                        break;
                    case "salvarcopia":
                        include("salvar/salvarcopia.php");
                        break;
                    case "visualizarunidade":
                        include("visualizarunidade.php");
                        break;
                    case "editarunidade":
                        include("editar/editarunidade.php");
                        break;
                    case "listarcopiasdesativadas":
                        include("listar/listarunidadesdesativadas.php");
                        break;
                    default:
                        print "<h1>Bem Vindo(a) ".$_SESSION["nome"]."</h1>";
                        print "<h2>SELECIONE UMA OPÇÃO AO LADO</h2>";
                        print "<h2><--</h2>";
                    }
                ?>
            </div>

        </div>

    </div>
     <!-- =========== Scripts =========  -->
     <script src="js/menu.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

  </body>

</html>
