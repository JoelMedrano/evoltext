//* Función para validar datos del proveedor
function validateConsultaDocumento(event, type) {
    clearAdminsFields();

    validateRepeat(event, type, "users", "document_user");

    const dis_user = document.getElementById("dis_user").value;

    if (dis_user === "1" || dis_user === "6") {
        setTimeout(function () {
            const document_user =
                document.getElementById("document_user").value;

            if (document_user !== "") {
                const validLength = dis_user === "1" ? 8 : 11;

                if (document_user.length === validLength) {
                    fetchAdminsData(document_user, dis_user, event);
                } else {
                    handleInvalidDocumentLength(event, validLength);
                }
            }
        }, 100);
    }
}

function clearAdminsFields() {
    $("#name_user, #address_user, #postal_user").val("");
    $("#postal_user").select2();
}

function fetchAdminsData(document_user, dis_user, event) {
    matPreloader("on");
    fncSweetAlert("loading", "Loading...", "");

    const data = new FormData();
    data.append("documento", document_user);
    data.append("tipo", dis_user);

    $.ajax({
        url: "ajax/ajax-validate.php",
        method: "POST",
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        success: function (response) {
            if (response !== "error") {
                updateAdminsFields(JSON.parse(response).data, dis_user);
            } else {
                fncNotie(3, "No se encontro el documento");
            }
            matPreloader("off");
            fncSweetAlert("close", "", "");
        },
    });
}

function updateAdminsFields(data, dis_user) {
    // Actualizar campos del formulario
    $("#name_user")
        .val(data["nombre_o_razon_social"])
        .parent()
        .addClass("was-validated");
    $("#address_user")
        .val(data["direccion"])
        .parent()
        .addClass("was-validated");
    $("#postal_user")
        .val(data["ubigeo"][2])
        .select2()
        .parent()
        .addClass("was-validated");

    // Calcular iniciales
    let iniciales = "";

    if (dis_user == 1) {
        const cadena = data["nombres"];
        const palabras = cadena.split(" ");
        let iniciales_nombre = "";
        let apellido_paterno = data["apellido_paterno"].replace(/\s+/g, "");
        let apellido_materno = data["apellido_materno"].charAt(0);

        for (let i = 0; i < palabras.length; i++) {
            iniciales_nombre += palabras[i].charAt(0);
        }

        iniciales =
            iniciales_nombre.toLowerCase() +
            apellido_paterno.toLowerCase() +
            apellido_materno.toLowerCase();
    } else {
        const cadena = data["nombre_o_razon_social"];
        const palabras = cadena.split(" ");
        let iniciales_razon_social = "";

        for (let i = 0; i < palabras.length; i++) {
            iniciales_razon_social += palabras[i].charAt(0);
        }

        iniciales = iniciales_razon_social.toLowerCase();
    }

    $("#username_user").val(iniciales).parent().addClass("was-validated");
}

function handleInvalidDocumentLength(event, validLength) {
    event.target.value = "";
    $(event.target).parent().addClass("was-validated");
    const errorMsg =
        validLength === 8
            ? "El DNI debe tener 8 dígitos"
            : "El RUC debe tener 11 dígitos";
    $(event.target).parent().children(".invalid-feedback").html(errorMsg);
}
