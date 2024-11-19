<?php
include('mensagem.php');
?>
<div class="details">
    <div class="recentOrders">
        <div class="cardHeader">
            <h2>Novo Emprestimo</h2>
        </div>

        <div class="formulario">
            <form action="?page=salvaremprestimo" method="POST">
                <input type="hidden" name="acao" value="cadastrar">

                <div class="form-row">
                    <div class="form-column">
                        <label for="nome">ID do Unidade:</label>
                        <input type="number" name="idlivro" id="idlivro">
                    
                        <label for="cpf">CPF do Usuário:</label>
                        <input type="number" name="cpf" id="cpf">
                    
                        <label for="email">Data de ínicio do emprestimo:</label>
                        <input type="date" name="inicio" id="inicio">
                    
                        <label for="senha">Data prevista de devolução:</label>
                        <input type="date" name="previsão" id="previsão">
                    </div>
                
                </div>
                <div>
                    <button class="button-form" type="submit">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>