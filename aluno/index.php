<?php
// Inicie a sessão
session_start();

if(empty($_SESSION)){
    print "<script>location.href='../index.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Serif+Text:ital@0;1&display=swap" rel="stylesheet">
    <title>Biblioteca Digital - Bibliotech</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://unpkg.com/scrollreveal"></script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/cookie.css">
    <link rel="stylesheet" href="css/cards.css">
    <link rel="stylesheet" href="css/caixa_de_usuario.css">
    <script defer src="js/app.js"></script>
    <script defer src="js/cookie.js"></script>
    <script defer src="js/userd.js"></script>
</head>
<body>
    <!-- Caixa de usuário -->
     <?php if (isset($_SESSION['nome'])): ?>
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
                <li><a href="acervo.php" class="menu">Acervo Digital</a></li>
                <li><a href="historico.php" class="menu">Meu Historico</a></li>
                <li><a href="#" class="menu">Sobre nós</a></li>
            </ul>
        </nav>
    </header>

    <!-- Barra inferior -->
    <div id="bottom-bar"></div>
    <!-- Resto do conteúdo -->
    <div class="cookis-msg" id="cookis-msg">
        <div class="cookis-txt">
            <p>Utilizamos cookies para melhorar sua experiência de navegação, personalizar conteúdos e anúncios, fornecer funcionalidades de redes sociais e analisar nosso tráfego. Também compartilhamos informações sobre o uso do nosso site com nossos parceiros de redes sociais, publicidade e análise. Ao continuar a usar nosso site, você concorda com o uso de cookies. Para mais informações, acesse nossa <a href="link_para_politica">Política de Cookies</a>.</p>
            <div class="cookis-btn">
                <button id="accept-cookies">Aceito</button>
            </div>
        </div>
    </div>
    
    <section class="hero-banner">
        <div class="hero-content">
            <h1>Bem-vindo ao Biblioteca Digital - Bibliotech</h1>
            <p>Descubra nossos recursos e inovações.</p>
            <a href="#sobre" class="cta-button">Saiba Mais</a>
        </div>
    </section>
    
    <style>
        /* Importando uma fonte moderna */
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');
    
        .hero-banner {
            top: -7rem;
            background: url('img/Bibliotecai.webp') no-repeat center center/cover;
            color: var(--color-neutral-0);
            padding: 120px 20px;
            text-align: center;
            position: relative;
            overflow: hidden;
            background-attachment: fixed; /* Efeito de paralaxe */
            /* Adicionando uma sobreposição suave */
        }
    
        .hero-banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4); /* Overlay escuro */
            z-index: 0;
        }
    
        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 800px;
            margin: 0 auto;
            padding: 0 20px;
        }
    
        .hero-content h1 {
            font-size: 4.5em;
            margin-bottom: 20px;
            color: var(--color-neutral-0);
            text-shadow: 3px 3px 6px rgba(255, 255, 255, 0.5);
            font-family: 'Roboto', sans-serif;
            font-weight: 700;
        }
    
        .hero-content p {
            font-size: 2em;
            margin-bottom: 30px;
            color: var(--color-neutral-0);
            text-shadow: 2px 2px 5px rgba(255, 255, 255, 0.5);
            font-family: 'Roboto', sans-serif;
            font-weight: 400;
        }
    
        .cta-button {
            background-color: var(--primary-color);
            color: #fff;
            padding: 15px 35px;
            border-radius: 30px;
            text-decoration: none;
            font-size: 1.4em;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
            display: inline-block;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
        }
    
        .cta-button:hover {
            background-color: var(--hover-color);
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.4);
        }
    </style>

<section class="gallery">
    <h2>Galeria de Imagens</h2>
    <div class="gallery-container">
        <img src="img/fundo1.webp" alt="Descrição da Imagem 1">
        <img src="img/fundo2.webp" alt="Descrição da Imagem 2">
        <img src="img/fundo3.jpg" alt="Descrição da Imagem 3">
        <!-- Adicione mais imagens conforme necessário -->
    </div>
</section>

<style>
    .gallery {
        margin-top: -7rem;
        padding: 20px 20px;
        text-align: center;
    }

    .gallery-container {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        justify-content: center;
    }

    .gallery-container img {
        max-width: 20%;
        height: auto;
        border-radius: 10px;
    }
</style>


<style>
    .slider-container {
        position: relative;
        max-width: 100%;
        margin: 0 auto;
        text-align: center;
    }

    .slider-container h2 {
        font-size: 2em;
        margin-bottom: 20px;
        color: var(--primary-color);
        font-weight: bold;
    }

    .slider {
        position: relative;
        width: 100%;
        overflow: hidden;
    }

    .slides {
        display: flex;
        transition: transform 0.5s ease-in-out;
    }

    .slide {
        min-width: 100%;
        box-sizing: border-box;
        position: relative;
    }

    .slide img {
        width: 100%;
        height: auto;
    }

    .caption {
        position: absolute;
        bottom: 20px;
        left: 20px;
        background-color: rgba(0, 0, 0, 0.5);
        color: #fff;
        padding: 10px;
        border-radius: 5px;
        font-size: 1.2em;
        font-weight: bold;
    }
</style>

<section class="news">
    <h2>Últimas Novidades</h2>
    <div class="news-container">
        <article class="news-item">
            <h3>Inauguração do Novo Laboratório de Eletrônica</h3>
            <p>O Instituto Beijamim Constant (IBC-cetam) tem o prazer de anunciar a inauguração de seu novo laboratório de eletrônica. Este espaço moderno e bem equipado foi projetado para fornecer aos nossos alunos as melhores ferramentas e recursos para suas experiências práticas. A inauguração será marcada por uma cerimônia especial no dia 5 de setembro, com a presença de autoridades e convidados. Não perca esta oportunidade de conhecer o novo laboratório e os projetos inovadores que serão desenvolvidos nele.</p>
            <a href="#">Leia Mais</a>
        </article>
        <article class="news-item">
            <h3>Curso de Inteligência Artificial Inicia no CETAM</h3>
            <p>O CETAM está lançando um novo curso de Inteligência Artificial com o objetivo de preparar os alunos para as demandas crescentes do mercado de tecnologia. O curso oferece uma abordagem prática e teórica, cobrindo tópicos como aprendizado de máquina, redes neurais e processamento de linguagem natural. As inscrições estão abertas e as aulas começam no dia 10 de setembro.</p>
            <a href="#">Leia Mais</a>
        </article>
        <article class="news-item">
            <h3>Conferência de Tecnologia e Inovação 2024</h3>
            <p>O CETAM sediará a Conferência de Tecnologia e Inovação 2024 no dia 15 de outubro. O evento contará com palestras de especialistas renomados, workshops e oportunidades de networking. É uma excelente oportunidade para aprender sobre as últimas tendências em tecnologia e inovação. Inscreva-se para garantir seu lugar!</p>
            <a href="#">Leia Mais</a>
        </article>
    </div>
</section>

<style>
    .news {
        padding: 60px 20px;
        background: linear-gradient(135deg, var(--color-neutral-10) 0%, var(--color-neutral-30) 100%);
        color: var(--color-neutral-40);
        text-align: center;
        border-bottom: 5px solid var(--primary-color);
    }

    .news h2 {
        font-family: 'Arial', sans-serif;
        font-weight: 700;
        font-size: 2.5rem;
        color: var(--primary-color);
        margin-bottom: 40px;
    }

    .news-container {
        display: flex;
        flex-direction: column;
        gap: 20px;
        max-width: 800px;
        margin: 0 auto;
    }

    .news-item {
        background-color: var(--color-neutral-0);
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .news-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 24px rgba(0,0,0,0.2);
    }

    .news-item h3 {
        margin-bottom: 10px;
        font-family: 'Arial', sans-serif;
        font-weight: 600;
        color: var(--primary-color);
    }

    .news-item p {
        line-height: 1.6;
        color: var(--color-neutral-40);
    }

    .news-item a {
        display: inline-block;
        margin-top: 10px;
        color: var(--primary-color);
        text-decoration: none;
        font-weight: bold;
        border-bottom: 2px solid var(--primary-color);
        padding-bottom: 2px;
        transition: color 0.3s ease, border-color 0.3s ease;
    }

    .news-item a:hover {
        color: var(--hover-color);
        border-color: var(--hover-color);
    }
</style>

    <div id="conteudo"></div>
    <section class="info1 box-home">
        <div class="ui-container">
            <div class="row acervo-row">
                <div class="acervo-item item-up">
                    <div class="acervo-item__text">Um acervo de eBooks com <span>milhares de histórias surpreendentes</span></div>
                </div>
                <div class="acervo-item item-up">
                    <div class="cicle1">
                        <p class="cicle-num1">+ 15 mil</p>
                        <span>títulos</span>
                    </div>
                </div>
                <div class="acervo-item item-up">
                    <div class="cicle2">
                        <p class="cicle-num2">+ 400</p>
                        <span>usuários</span>
                    </div>
                </div>
                <div class="acervo-item item-up">
                    <div class="cicle3">
                        <p class="cicle-num3">+ 950</p>
                        <span>instituições parceiras</span>
                    </div>
                </div>
                <div class="acervo-item item-up">
                    <div class="cicle4">
                        <p class="cicle-num4">+ 80</p>
                        <span>editoras parceiras</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="card1">
            <div class="overlay1"></div>
            <div class="circle1">
                <svg height="60px" width="60px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                viewBox="0 0 233.003 233.003" xml:space="preserve">
             <g>
               <path d="M58.24,201.255H47.904c-2.761,0-5,2.238-5,5c0,2.762,2.239,5,5,5H58.24c2.761,0,5-2.238,5-5
                 C63.24,203.493,61.001,201.255,58.24,201.255z"/>
               <path d="M210.503,3.755H42.513c-12.407,0-22.5,10.094-22.5,22.5v45.007H15.5c-8.547,0-15.5,6.953-15.5,15.5
                 v126.986c0,8.547,6.953,15.5,15.5,15.5h75.145c8.547,0,15.5-6.953,15.5-15.5v-11.167h54.529h22.167c4.142,0,7.5-3.357,7.5-7.5
                 c0-4.143-3.358-7.5-7.5-7.5h-22.167v-14.334h49.829c12.407,0,22.5-10.094,22.5-22.5V26.255
                 C233.003,13.849,222.91,3.755,210.503,3.755z M15.5,86.262h75.145c0.257,0,0.5,0.243,0.5,0.5v98.779H15V86.762
                 C15,86.505,15.243,86.262,15.5,86.262z M90.645,214.248H15.5c-0.257,0-0.5-0.243-0.5-0.5v-18.207h76.145v18.207
                 C91.145,214.005,90.901,214.248,90.645,214.248z M145.674,187.581h-38.333v-14.334h38.333V187.581z M218.003,150.747
                 c0,4.136-3.364,7.5-7.5,7.5H106.145V86.762c0-8.547-6.953-15.5-15.5-15.5H35.013V26.255c0-4.136,3.364-7.5,7.5-7.5h167.99
                 c4.136,0,7.5,3.364,7.5,7.5V150.747z"/>
             </g>
           </svg>
            </div>
            <p>User Experience</p>
        </div>
        <div class="card2">
            <div class="overlay2"></div>
            <div class="circle2">
                <svg fill="#000000" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                width="60px" height="60px" viewBox="0 0 97.391 97.391" xml:space="preserve">
             <g>
               <path d="M0,7.573h17.5v8.75H0V7.573z M0,19.823h17.5v59.501H0V19.823z M3.208,68.312c0,3.021,2.447,5.47,5.469,5.47
                 c3.021,0,5.469-2.447,5.469-5.47s-2.448-5.47-5.469-5.47C5.655,62.843,3.208,65.293,3.208,68.312z M0,89.824h17.5v-7H0V89.824z
                 M21,81.6v1.225v7h22.75v-8.268c-0.929-0.664-3.815-2.232-10.5-2.232C26.913,79.324,22.866,80.744,21,81.6z M21,31.257
                 c1.866,0.854,5.913,2.276,12.25,2.276c6.643-0.001,9.536-1.55,10.5-2.245v-6.215H21V31.257z M21,35.046V77.81
                 c2.534-0.948,6.592-1.985,12.25-1.985c5.105,0,8.417,0.854,10.5,1.767V35.268c-2.083,0.91-5.395,1.765-10.5,1.765
                 C27.592,37.031,23.534,35.994,21,35.046z M80.859,7.18l-12,2.462l1.76,8.571l12-2.462L80.859,7.18z M95.279,77.469l-11.998,2.463
                 L71.32,21.643l12-2.462L95.279,77.469z M91.116,67.08c-0.607-2.957-2.972-4.971-5.275-4.498c-2.307,0.475-3.688,3.258-3.077,6.215
                 c0.606,2.957,2.969,4.973,5.274,4.498C90.346,72.822,91.725,70.041,91.116,67.08z M95.984,80.893l-12.002,2.464l1.408,6.854
                 l12-2.463L95.984,80.893z M49,16.323h17.5v-8.75H49V16.323z M49,89.824h17.5v-7H49V89.824z M49,70.574h17.5V28.573H49V70.574z
                 M49,79.324h17.5v-5.25H49V79.324z M49,25.073h17.5v-5.25H49V25.073z"/>
             </g>
           </svg>
            </div>
            <p>Integração</p>
        </div>
        <div class="card3">
            <div class="overlay3"></div>
            <div class="circle3">
                <svg width="60px" height="60px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2 10L12 4.5L22 10L17.9457 12.2298M2 10L6.05427 12.2298M2 10V16M6 17.5V12.5C6 12.4084 6.01848 12.3182 6.05427 12.2298M6 17.5C6 18.6046 8.68629 19.5 12 19.5C15.3137 19.5 18 18.6046 18 17.5M6 17.5C6 16.3954 8.68629 15.5 12 15.5C15.3137 15.5 18 16.3954 18 17.5M18 17.5V12.5C18 12.4084 17.9815 12.3182 17.9457 12.2298M17.9457 12.2298C17.9334 12.1993 17.9189 12.1691 17.9025 12.139C17.3927 11.2067 14.9439 10.5 12 10.5C9.05606 10.5 6.60733 11.2067 6.09749 12.139C6.08105 12.1691 6.06663 12.1993 6.05427 12.2298" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
            </div>
            <p> Aprovado pelo MEC</p>
        </div>

        <a href="perfil.php">
        <div class="card4">
            <div class="overlay4"></div>
            <div class="circle4">
                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="78" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                </svg>
            </div>
            <p>Profile</p>
        </div>
        </a>

    </div>
    </body>
    </html>
    <footer>
        <div id="footer_content">
            <div id="footer_contacts">
                <h1>Biblioteca Digital - Bibliotech</h1>
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
</body>
</html>
