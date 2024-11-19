<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acervo de Livros</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/acervo.css"> 
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/style.css">
    <script defer src="js/app.js"></script>

    <style>
    
        .cx{
            width: 100%;
            height: 5%;
            display: flex;
            max-width: 650px;
            background: #ebf7f3;
            border-radius: 2rem; /* Bordas arredondadas */
            box-shadow: 0 4px 8px rgba(24, 148, 193, 0.81); /* Sombra mais pronunciada */
            border: 1px solid #0978ff; 
        }
        .livro{
            background-color:#ccf1e5;
            border-top-left-radius: 2rem;
            border-bottom-left-radius: 2rem;
            border-top-right-radius: 2rem;
            border-bottom-right-radius: 2rem;

        }
        .livro img{
            
            width: 250px;
            height: 100%;
            border-top-right-radius: 2rem;
            border-bottom-right-radius: 2rem;
            border-top-left-radius: 2rem;
            border-bottom-left-radius: 2rem;

        }
        .info{
            width: 250px;
            margin: 60px auto;
            
        }

        h3{
        margin: 20px;
        text-align: center;
        font-weight: bolder;
        text-transform: uppercase;
        font-size: 24px;
        }

        p{
        text-align: center;
        font-size: 18px;
        font-weight: 700;
        margin: 10px;
        }
        .button{
            border: none;
            outline: none;
            padding: 8px;
            width: 252px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
            border-radius: 5px;
            background: #135763;

        }
        .button:hover{
            background: rgb(64, 91, 214);
}


    </style>
</head>
<body>
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
          
                <!--Pegando informaçoes do Mysql-->
      <?php
      include "../config.php";

      // Verifica se o ISBN foi passado como parâmetro na URL
      if (isset($_GET["isbn"])) {
        $isbn = $_GET["isbn"];

        // Busca os dados do livro com o ISBN fornecido/escolhido
        $sql = "SELECT * FROM livro 
        inner join autor on livro.autor_id = autor.id
        inner join genero on livro.genero_id = genero.id WHERE isbn = '$isbn';";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();

        echo '<div class="cx">';
            echo '<div class="info">';
            echo "<h3>" . $row["titulo"] . "</h3>";
            echo "<p> Autor: " . $row["nome"] . "</p>";
            echo "<p> Genero: " . $row["descricao"] . "</p>";
            echo "<p> Ano de Publicaçao: " . $row["ano_publicacao"] . "</p>";
            echo "<p> ISBN: " . $row["isbn"] . "</p>";
            echo "<p> N° de Paginas: " . $row["paginas"] . "</p>";
            echo '</div>';

            echo '<div class="livro">';
            echo '<img src="../adm2/' . $row["imagem"] . '" alt="Capa do livro">';
            echo '</div>';
            
        echo '</div>';
        } else {
          echo "Livro não encontrado.";
          exit();
        }
      } else {
        echo "ISBN não fornecido.";
        exit();
      }
      ?>
        </section>
     <a class="button" href="acervo.php">Voltar</a>

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
                <li><h3>Blog</h3></li>
                <li><a href="#" class="footer-link">Criação</a></li>
                <li><a href="#" class="footer-link">Desenvolvimento</a></li>
                <li><a href="#" class="footer-link">Parcerias</a></li>
            </ul>
            <ul class="footer-list">
                <li><h3>Products</h3></li>
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