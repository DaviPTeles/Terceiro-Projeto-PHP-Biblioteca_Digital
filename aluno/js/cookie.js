document.addEventListener('DOMContentLoaded', function() {
    var cookiesMsg = document.getElementById('cookis-msg');
    setTimeout(function() {
        cookiesMsg.classList.add('show');
    }, 1000); // Delay de 1 segundo antes de mostrar a mensagem

    var acceptBtn = document.getElementById('accept-cookies');
    if (acceptBtn) {
        acceptBtn.addEventListener('click', function() {
            cookiesMsg.classList.remove('show');
            setTimeout(function() {
                cookiesMsg.style.display = 'none';
            }, 500); // Delay para esconder após a animação
        });
    }
});
