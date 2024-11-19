document.addEventListener("DOMContentLoaded", function() {
    const mobilemenu = document.querySelector(".mobilemenu");
    const nav = document.querySelector(".nav");

    if (mobilemenu && nav ) {
        mobilemenu.addEventListener("click", () => {
            nav.classList.toggle("active");
            mobilemenu.classList.toggle("open");
        });
    } else {
        console.error("Elemento não encontrado no DOM.");
    }
});
