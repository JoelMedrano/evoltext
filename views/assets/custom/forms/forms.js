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
$(document).ready(function () {
    $("input[data-bootstrap-switch]").each(function () {
        $(this).bootstrapSwitch("state", $(this).prop("checked"));
    });
});

//* Función para crear Url's
function createCorrelativo(name) {
    var codigo = name;
    console.log("🚀 ~ file: forms.js:97 ~ createCorrelativo ~ codigo:", codigo);

    var data = new FormData();
    data.append("codigo", codigo);

    $.ajax({
        url: "ajax/ajax-correlative.php",
        method: "POST",
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        success: function (response) {
            console.log(
                "🚀 ~ file: forms.js ~ line 224 ~ createCorrelativo ~ response",
                response
            );
        },
    });
}

//* Activar select2
$(document).ready(function () {
    $(".select2").select2();
});
// Usando JavaScript puro
/* document
    .getElementById("select2-adminsTable_length-bc-container")
    .classList.remove("select2"); */

//*validar repetidos
function validateRepeat(event, type, table, suffix) {
    const data = new FormData();
    data.append("data", event.target.value);
    data.append("table", table);
    data.append("suffix", suffix);

    $.ajax({
        url: "ajax/ajax-validate.php",
        method: "POST",
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        success: function (response) {
            if (response === "200") {
                event.target.value = "";
                $(event.target).parent().addClass("was-validated");
                $(event.target)
                    .parent()
                    .children(".invalid-feedback")
                    .html("Ya existe en la base de datos");
            } else {
                validateJS(event, type);
            }
        },
    });
}

//* Validamos imagen
function validateImageJS(event, input) {
    var image = event.target.files[0];

    if (
        image["type"] !== "image/png" &&
        image["type"] !== "image/jpeg" &&
        image["type"] !== "image/gif"
    ) {
        fncNotie(3, "The image must be in JPG, PNG or GIF format");

        return;
    } else if (image["size"] > 2000000) {
        fncNotie(3, "Image must not weigh more than 2MB");

        return;
    } else {
        var data = new FileReader();
        data.readAsDataURL(image);

        $(data).on("load", function (event) {
            var path = event.target.result;

            $("." + input).attr("src", path);
        });
    }
}
