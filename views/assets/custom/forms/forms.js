//* validar si es celular - tablet o celular
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

//* Validacion desde BOOTSTRAP 5
(function () {
    "use strict";

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll(".needs-validation");

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms).forEach(function (form) {
        form.addEventListener(
            "submit",
            function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add("was-validated");
            },
            false
        );
    });
})();

//* Función para validar formulario
function validateJS(event, type) {
    var pattern;

    if (type == "text") pattern = /^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}$/;

    if (type == "text&number") pattern = /^[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,50}$/;

    if (type == "numbers") pattern = /^[.\\,\\0-9]{1,}$/;

    if (type == "t&n") pattern = /^[A-Za-z0-9]{1,}$/;

    if (type == "email")
        pattern =
            /^[.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/;

    if (type == "pass")
        pattern = /^[#\\=\\$\\;\\*\\_\\?\\¿\\!\\¡\\:\\.\\,\\0-9a-zA-Z]{1,}$/;

    if (type == "regex")
        pattern =
            /^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}$/;

    if (type == "icon") {
        pattern =
            /^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\"\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}$/;

        $(".viewIcon").html('<i class="' + event.target.value + '"></i>');
    }

    if (type == "phone") pattern = /^[-\\(\\)\\0-9 ]{1,}$/;

    if (!pattern.test(event.target.value)) {
        $(event.target).parent().addClass("was-validated");
        $(event.target)
            .parent()
            .children(".invalid-feedback")
            .html("Field syntax error");
    }
}

//* Activación de Bootstrap Switch
$("input[data-bootstrap-switch]").each(function () {
    $(this).bootstrapSwitch("state", $(this).prop("checked"));
});
