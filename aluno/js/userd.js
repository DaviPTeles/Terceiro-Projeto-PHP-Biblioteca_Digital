window.addEventListener('scroll', function() {
    const userBox = document.getElementById('userBox');
    const userInfo = document.getElementById('userInfo');

    if (window.scrollY > 100) { // Ajuste a altura conforme necessário
        userBox.classList.add('minimized');
    } else {
        userBox.classList.remove('minimized');
    }
});
