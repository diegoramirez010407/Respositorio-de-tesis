/*==================== mostrar navbar ====================*/
const showMenu = (headerToggle, navbarId) => {
    const toggleBtn = document.getElementById(headerToggle),
        nav = document.getElementById(navbarId);

    // Validación de las variables existentes
    if (headerToggle && navbarId) {
        toggleBtn.addEventListener("click", () => {
            // Se añade la clase show-menu al etiqueta div con la clase nav__menu
            nav.classList.toggle("show-menu");
            // Se cambia el icono
            toggleBtn.classList.toggle("bx-x");
        });
    }
};
showMenu("header-toggle", "navbar");

/*==================== link activado ====================*/
const linkColor = document.querySelectorAll(".nav__link");

function colorLink() {
    linkColor.forEach((l) => l.classList.remove("active"));
    this.classList.add("active");
}

linkColor.forEach((l) => l.addEventListener("click", colorLink));
