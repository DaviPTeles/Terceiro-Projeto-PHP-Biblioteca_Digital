<div class="details">
    <div class="recentOrders">
        <div class="cardHeader">
            <h2>Adicionar Novo Gênero</h2>
        </div>

        <div class="formulario">
            <form action="?page=salvarlivro" method="POST">
                <input type="hidden" name="acao" value="salvargenero">

                <div class="form-row">
                    <div class="form-column">
                        <label for="nome">Descrição</label>
                        <input type="text" name="nome" id="nome">
                    </div>
                </div>

                <div>
                    <button class="button-form" type="submit">Enviar</button>
                </div>
            </form>

        </div>
    </div>
</div>