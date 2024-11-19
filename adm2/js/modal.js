function openModal(title) {
    // Atualiza o título do modal
    document.getElementById('modalTitle').innerText = title;
    
    // Limpa os campos do formulário
    document.getElementById('nome').value = '';
    document.getElementById('nacionalidade').value = '';
    document.getElementById('data_nasc').value = '';
    document.getElementById('bio').value = '';

    // Exibe o modal
    document.getElementById('myModal').style.display = 'block';
}

function closeModal() {
    // Oculta o modal
    document.getElementById('myModal').style.display = 'none';
}

// Fecha o modal ao clicar fora dele
window.onclick = function(event) {
    const modal = document.getElementById('myModal');
    if (event.target === modal) {
        closeModal();
    }
}

// Fechar o modal ao pressionar a tecla "Esc"
window.onkeydown = function(event) {
    if (event.key === "Escape") {
        closeModal();
    }
}
