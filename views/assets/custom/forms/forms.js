/*=============================================
validar si es celular - tablet o celular
=============================================*/
document.addEventListener("DOMContentLoaded", function () {
    const bodyElement = document.getElementById("mainBody");

    function updateBodyClass() {
        if (window.innerWidth <= 768) {
            // Dispositivos móviles y tablets
            bodyElement.classList.remove("sidenav-toggled", "hover-submenu");
        } else {
            // Dispositivos de escritorio (PC)
            bodyElement.classList.add("sidenav-toggled", "hover-submenu");
        }
    }

    // Llama a la función al cargar la página
    updateBodyClass();

    // Llama a la función al cambiar el tamaño de la ventana
    window.addEventListener("resize", updateBodyClass);
});
