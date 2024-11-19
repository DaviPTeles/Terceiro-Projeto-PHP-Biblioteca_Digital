<main class="table">
    <section class="table__header">
        <h1>Lista de Empréstimos</h1>
    </section>

    <section class="table__body">
            <form action="?page=salvarlivro" method="POST">
                <input type="hidden" name="acao" value="salvarautor">

                <div class="form-row">
                    <div class="form-column">
                        <label for="nome">Nome</label>
                        <input type="text" name="nome" id="nome">
                    
                        <label for="nacionalidade">Nacionalidade</label>
                        <input type="text" name="nacionalidade" id="nacionalidade">
                    
                        <label for="data_nasc">Data de Nascimento</label>
                        <input type="date" name="data_nasc" id="data_nasc">
                    
                        <label for="bio">Biografia</label>
                        <input type="text" name="bio" id="bio">
                    </div>
                </div>

                <div>
                    <button class="button-form" type="submit">Enviar</button>
                </div>
            </form>

       
    </section>

</main>
