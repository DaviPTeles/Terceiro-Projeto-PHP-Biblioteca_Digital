<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
      .input-container {
            position: relative;
            margin-bottom: 1rem;
        }
        .input-container input {
            padding-left: 2.5rem;
            width: 100%;
            box-sizing: border-box;
        }
        .input-container i {
            position: absolute;
            left: 0.5rem;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
        }

        #togglePassword {
            cursor: pointer;
            margin-left: 13.5em;
        }
    </style>
</head>
<body>
   <div class="container">
            <div class="login">
                <form action="login.php" method="POST">
                    <h1>Login</h1>
                    <hr>
                    <p>SISTEMA BIBLIOTECARIO  Bibliotech</p>
                    <div class="input-container">
                    <i class="fas fa-envelope"></i>
                    <input type="email" placeholder="Seu E-mail" name="email" id="emailfield">
                    </div>
                    <div class="input-container">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="Sua Senha!" name="senha" id="passwordfield">
                    <i class="fas fa-eye" id="togglePassword"></i>
                    </div>
                    <?php
                    include('mensagem.php')
                    ?>
                    <button type="submit">Entrar</button>
                    <p>
                        <a href="#">Esqueceu sua Senha?</a>
                    </p>
                </form>
            </div>
            <div class="pic">
                <img src="img/Logo.png">
            </div>
        </div>
        <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordField = document.getElementById('passwordfield');

        togglePassword.addEventListener('click', function () {
            // Toggle the type attribute
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);

            // Toggle the eye icon
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>