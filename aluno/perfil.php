<?php
session_start(); // Inicia a sessão
// Verifica se a sessão está ativa
if (!isset($_SESSION["email"])) {
    // Se não estiver logado, redirecione para a página de login
    header('Location: index.php');
    exit();
}
// Acesse as variáveis de sessão
$email = $_SESSION["email"];
$telefone = $_SESSION["telefone"];
$cpf = $_SESSION["cpf"];
$nome = $_SESSION["nome"];
$imagem = $_SESSION["imagem"];
$datanasc = $_SESSION["data_nasc"];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acervo de Livros</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/acervo.css">
    <link rel="stylesheet" href="css/caixa_de_usuario.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/style.css">
    <script defer src="js/app.js"></script>
</head>
<body>
    <?php
    if (isset($_SESSION['nome'])): ?>
        <div class="user-box" id="userBox">
            <img src="../adm2/<?php echo $_SESSION['imagem']; ?>" class="user-avatar" id="userAvatar">
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
    <header class="header">
        <nav class="nav">
            <div class="logo">
                <img src="img/logo-bibli.png" alt="Ícone da biblioteca">
                <a href="/">Biblioteca Digital - Bibliotech</a>
            </div>
            <div class="mobilemenu">
                <button class="hamburger">
                    <div class="line1"></div>
                    <div class="line2"></div>
                    <div class="line3"></div>
                </button>
            </div>
            <ul class="nav-list">
                <li><a href="index.php" class="menu">Página inicial</a></li>
                <li><a href="acervo.php" class="menu">Acervo Digital</a></li>
                <li><a href="historico.php" class="menu">Meu Historico</a></li>
                <li><a href="#" class="menu">Sobre nós</a></li>
            </ul>
        </nav>
    </header>
    <main id="conteudo">
        <section class="acervo-row">
            <h1>Meu Perfil <br></h1>
            <?php
            include "../config.php";
            $sql1 = "SELECT * FROM usuario";
            $res = $conn->query($sql1);
            $qtd = $res->num_rows;
            include('../mensagem.php');
            if ($qtd > 0) {
                print "<img src='../adm2/" . $imagem . "'><br>";
                print "Nome: " . $nome . "<br>";
                print "Cpf: " . $cpf . "<br>";
                print "Email: " . $email . "<br>";
                print "Data de Nascimento: " . $datanasc . "<br>";
                print "Telefone: " . $telefone;
            } else {
                print "<p>Não encontrou resultados!</p>";
            }
            ?>
        </section>
    </main>
    <footer>
        <div id="footer_content">
            <div id="footer_contacts">
                <h1>Instituto Beijamim Constant - IBC</h1>
                <p>Elevando conhecimento a todos.</p>
                <div id="footer_social_media">
                    <a href="#" class="footer-link" id="instagram" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" class="footer-link" id="facebook" aria-label="Facebook"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#" class="footer-link" id="linkedin" aria-label="LinkedIn"><i class="fa-brands fa-linkedin"></i></a>
                    <a href="#" class="footer-link" id="x" aria-label="X Twitter"><i class="fa-brands fa-x-twitter"></i></a>
                </div>
            </div>
            <ul class="footer-list">
                <li>
                    <h3>Blog</h3>
                </li>
                <li><a href="#" class="footer-link">Criação</a></li>
                <li><a href="#" class="footer-link">Desenvolvimento</a></li>
                <li><a href="#" class="footer-link">Parcerias</a></li>
            </ul>
            <ul class="footer-list">
                <li>
                    <h3>Products</h3>
                </li>
                <li><a href="#" class="footer-link">App</a></li>
                <li><a href="#" class="footer-link">Desktop</a></li>
                <li><a href="#" class="footer-link">Cloud</a></li>
            </ul>
            <div id="footer_sub">
                <h3>Inscreva-se</h3>
                <p>Entre com seu email para receber nossas notícias e informações</p>
                <div id="input_group">
                    <input type="email" id="email" placeholder="Seu email" aria-label="Seu email">
                    <button aria-label="Enviar email">
                        <i class="fa-regular fa-envelope"></i>
                    </button>
                </div>
            </div>
        </div>
        <div id="footer_copyright">
            &#169; 2024 Todos os direitos reservados
        </div>
    </footer>
    <script src="js/navigation-auto.js"></script>
    <script src="js/scroll.js"></script>
    <script>
        function toggleMenu() {
            document.querySelector('.nav').classList.toggle('active');
        }
    </script>
</body>
</html>